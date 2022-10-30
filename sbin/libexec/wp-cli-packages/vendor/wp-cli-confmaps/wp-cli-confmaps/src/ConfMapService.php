<?php
/*
 * ConfMaps configuration management for WordPress WP-CLI - Tame your wp_options using WP-CLI and git
 *
 * Copyright (C) 2022 Bostjan Skufca Jese
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * version 2 as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <https://www.gnu.org/licenses/gpl-2.0.html>.
 */

namespace WP\CLI\ConfMaps;

use WP_CLI;

class ConfMapService
{
    const CONF_MAP_SUPPORTED_VERSION_MIN = 1;
    const CONF_MAP_SUPPORTED_VERSION_MAX = 1;

    /**
     * An index of conf maps:
     * - array key is the ID of the map
     * - array values:
     *   - `file` is the path to the map file (a PHP file returning a conf map as an array)
     *   - `map` is the actual conf map (as an alternative, when maps are not provided as files)
     */
    public static $confMapIndex = [];

    /**
     * What class to use to interface with wp_options storage
     */
    protected static $wpOptionsIO = "WP\CLI\ConfMaps\WpOptionsIO\Db";

    /**
     * Configure which wp_options IO interface to use
     */
    public static function setWpOptionsIO ($ioClass)
    {
        $interfaces = class_implements($ioClass);
        if (!isset($interfaces["WP\CLI\ConfMaps\WpOptionsIO\WpOptionsIOInterface"])) {
            throw new Exception("Supplied class '$ioClass' does not implement 'WP\CLI\ConfMaps\WpOptionsIO\WpOptionsIOInterface' interface");
        }
        self::$wpOptionsIO = $ioClass;
    }

    /**
     * Configure which conf maps to use
     */
    public static function setCustomMaps ($confMaps)
    {
        self::$confMapIndex = [];

        foreach ($confMaps as $mapId => $mapFileOrContent) {
            if (is_string($mapFileOrContent)) {
                self::$confMapIndex[$mapId] = [
                    'file' => $mapFileOrContent,
                ];
            } elseif (is_array($mapFileOrContent)) {
                self::$confMapIndex[$mapId] = [
                    'map' => $mapFileOrContent,
                ];
            } else {
                throw new Exception("Unsupported map specification for map '$mapId'");
            }
        }
    }

    public static function getMapCount ()
    {
        return count(self::$confMapIndex);
    }

    public static function doesMapIdExist ($mapId)
    {
        return isset(self::$confMapIndex[$mapId]);
    }

    public static function getMapFile ($mapId)
    {
        return self::$confMapIndex[$mapId]['file'];
    }

    public static function getPrintableFilePath ($filePath)
    {
        return preg_replace("#^" . ABSPATH . "#", '[ABSPATH]/', $filePath);
    }

    public static function getAllMapsMetadata ()
    {
        return self::$confMapIndex;
    }

    public static function getMapsMetadata ()
    {
        return self::$confMapIndex;
    }

    public static function getMaps ()
    {
        $confMaps = [];
        foreach (self::$confMapIndex as $mapId => $mapMetadata) {
            // When dumping, unknown keys should only land in the first defined conf map, not in all of them
            if ($mapId == array_key_first(self::$confMapIndex)) {
                $undefKeyActionDump = "add";
            } else {
                $undefKeyActionDump = "ignore";
            }
            $confMaps[$mapId] = self::getMap($mapId, $undefKeyActionDump);
        }
        return $confMaps;
    }

    /**
     * Read the map from the file as specified in the conf map index
     */
    public static function getMap ($mapId, $undefKeyActionDump)
    {
        if (isset(self::$confMapIndex[$mapId]['file'])) {
            $mapFile = self::$confMapIndex[$mapId]['file'];
            if (!is_file($mapFile) || !is_readable($mapFile)) {
                throw new Exception("Conf map file '$mapFile' for conf map ID '$mapId' does not exist or it is not readable");
            }
            $confMapContainer = require $mapFile;
        } else {
            $confMapContainer = self::$confMapIndex[$mapId]['map'];
        }

        if ($confMapContainer === 1) {
            throw new Exception("Reading the file for conf map ID '$mapId' did not yield any content. Perhaps the conf map is missing the `return` statement?");
        }

        if (!isset($confMapContainer['metadata']['version'])) {
            throw new Exception("Conf map '$mapId' is missing version information (array['metadata']['version'] field)");
        }

        if (
            ($confMapContainer['metadata']['version'] < self::CONF_MAP_SUPPORTED_VERSION_MIN)
            ||
            ($confMapContainer['metadata']['version'] > self::CONF_MAP_SUPPORTED_VERSION_MAX)
        ) {
            throw new Exception(
                "Conf map version not supported. " .
                "Min=" . self::CONF_MAP_SUPPORTED_VERSION_MIN . ", " .
                "max=" . self::CONF_MAP_SUPPORTED_VERSION_MAX . ", " .
                "yours($mapId)=" . $confMapContainer['metadata']['version'] . "."
            );
        }

        if (!isset($confMapContainer['data'])) {
            throw new Exception("Container for conf map '$mapId' is missing data");
        }

        if (!is_array($confMapContainer['data'])) {
            throw new Exception("Container for conf map '$mapId' has an invalid data type (array['data'] is not an array)");
        }

        $minimizedConfMap = $confMapContainer['data'];
        $confMap = self::inflateMap($minimizedConfMap, $undefKeyActionDump);
        return $confMap;
    }

    /**
     * Convert a conf map to a corresponding (minimized) PHP code
     *
     * Takes a conf map (or an ID of a conf map and fetches a corresponding
     * conf map) and converts it to its minimal representation in a form of a
     * PHP code. The returned PHP content includes the starting PHP tag,
     * optionally a header and a `return [...];` statement.
     *
     * @param   mixed   $mapOrId        A conf map or an ID of a conf map
     * @param   string  $header         A header to include at the top of the returned PHP content
     * @return  string                  A PHP file content that, when include()/require()-d, it recreates a conf map
     */
    public static function getMapAsPhp ($mapOrId, $header="")
    {
        if (is_array($mapOrId)) {
            $confMap = $mapOrId;
        } else {
            $mapId = $mapOrId;
            $confMap = self::getMap($mapId);
        }
        $confMapMinimized = self::minimizeMap($confMap);

        $confMapContainer = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => $confMapMinimized,
        ];

        $confMapFileContent = "<?php\n\n";
        if ($header != "") {
            $confMapFileContent .= $header;
            if (substr($header, -1) == "\n") {
                $confMapFileContent .= "\n";
            } else {
                $confMapFileContent .= "\n\n";
            }
        }

        // Generate the actual conf map PHP code (+ condense it a bit)
        $confMapPhp = var_export($confMapContainer, true);
        $confMapPhp = preg_replace('#^array \(#', '[', $confMapPhp); // Starting 'array ('
        $confMapPhp = preg_replace('# => \n\s+array \(#', ' => [', $confMapPhp); // Every subsequent " => \n   array ("
        $confMapPhp = preg_replace('#(\s+)\),$#m', "$1],", $confMapPhp); // Every end of array
        $confMapPhp = preg_replace('#\)$#', "]", $confMapPhp); // The end of the very first array, in the last line

        $confMapFileContent .= "return " . $confMapPhp;
        $confMapFileContent .= ";\n";

        return $confMapFileContent;
    }

    /**
     * Create a conf map based on the current wp_options content
     *
     * This is a "I'll do my best to create a conf map for you" process. It
     * simply uses the default action values for a given option type + does a
     * few additional tweaks for some well known options (i.e. `recently_activated`
     * option that simply tracks recently activated plugins).
     *
     * @param   bool    $manualFixups   Apply manual fixups to make the map more relevant (default=true)
     * @return  array                   Conf map
     */
    public static function generateMapFromWpOptions ($manualFixups=true)
    {
        $rawOptions = self::$wpOptionsIO::getAllOptions();

        $confMap = [];
        foreach ($rawOptions as $optionName => $rawOptionValue) {

            WP_CLI::debug(__CLASS__.'::'.__FUNCTION__ . ": Processing wp_options entry: ". $optionName);

            if (preg_match('/^[aO]:[0-9]+:/', $rawOptionValue)) {

                // Serialized array/object
                $decodedOptionValue = unserialize($rawOptionValue);
                $optionSpec = self::generateDefaultOptionSpecFromValue($decodedOptionValue);
                $optionSpec['encoding'] = 'serialize';

            } elseif (preg_match('/^{/', $rawOptionValue)) {

                // JSON
                $decodedOptionValue = json_decode($rawOptionValue, true);
                $optionSpec = self::generateDefaultOptionSpecFromValue($decodedOptionValue);
                $optionSpec['encoding'] = 'json';

            } elseif (is_string($rawOptionValue)) {

                // String
                $optionSpec = self::generateDefaultOptionSpecFromValue($rawOptionValue);
                $decodedOptionValue = $rawOptionValue;

            } else {
                throw new Exception("Unsupported data type (1): ". gettype($optionValue) .", value=". $optionValue);
            }

            //ksort($optionSpec);
            $confMap[$optionName] = $optionSpec;
        }

        if ($manualFixups) {
            $confMap['can_compress_scripts']['action-apply']           = 'ignore';
            $confMap['can_compress_scripts']['action-dump']            = 'ignore';
            $confMap['can_compress_scripts']['value']                  = NULL;
            $confMap['finished_updating_comment_type']['action-apply'] = 'ignore';
            $confMap['finished_updating_comment_type']['action-dump']  = 'ignore';
            $confMap['finished_updating_comment_type']['value']        = NULL;
            $confMap['recently_activated']['action-apply']             = 'ignore';
            $confMap['recently_activated']['action-dump']              = 'ignore';
            $confMap['recently_activated']['value']                    = NULL;
            $confMap['recently_edited']['action-apply']                = 'ignore';
            $confMap['recently_edited']['action-dump']                 = 'ignore';
            $confMap['recently_edited']['value']                       = NULL;
            $confMap['uninstall_plugins']['action-apply']              = 'ignore';
            $confMap['uninstall_plugins']['action-dump']               = 'ignore';
            $confMap['uninstall_plugins']['value']                     = NULL;
        }

        return $confMap;
    }

    /**
     * Generate a default option spec from an option value
     */
    protected static function generateDefaultOptionSpecFromValue ($optionValue)
    {
        if (is_array($optionValue)) {
            $optionSpec = [
                'type'                   => 'array',
                'action-apply'           => 'walk',
                'action-dump'            => 'walk',
                'undef-key-action-apply' => 'ignore',
                'undef-key-action-dump'  => 'add',
                'value'                  => [],
            ];
            foreach ($optionValue as $key => $val) {
                $optionSpec['value'][$key] = self::generateDefaultOptionSpecFromValue($val);
            }
            ksort($optionSpec['value']);

        } elseif (is_object($optionValue)) {
            $optionSpec = [
                'type'                   => 'object',
                'class'                  => get_class($optionValue),
                'action-apply'           => 'walk',
                'action-dump'            => 'walk',
                'undef-key-action-apply' => 'ignore',
                'undef-key-action-dump'  => 'add',
                'value'                  => [],
            ];
            foreach ($optionValue as $key => $val) {
                $optionSpec['value'][$key] = self::generateDefaultOptionSpecFromValue($val);
            }
            ksort($optionSpec['value']);

        } elseif (is_string($optionValue)) {
            $optionSpec = [
                'type'         => 'string',
                'action-apply' => 'copy-as-is',
                'action-dump'  => 'copy-as-is',
                'value'        => $optionValue,
            ];

        } elseif (is_int($optionValue)) {
            $optionSpec = [
                'type'         => 'int',
                'action-apply' => 'copy-as-is',
                'action-dump'  => 'copy-as-is',
                'value'        => $optionValue,
            ];

        } elseif (is_bool($optionValue)) {
            $optionSpec = [
                'type'         => 'bool',
                'action-apply' => 'copy-as-is',
                'action-dump'  => 'copy-as-is',
                'value'        => $optionValue,
            ];

        } elseif (is_null($optionValue)) {
            $optionSpec = [
                'type'         => 'null',
                'action-apply' => 'copy-as-is',
                'action-dump'  => 'copy-as-is',
                'value'        => NULL,
            ];

        } else {
            throw new Exception("Unsupported data type (2): ". gettype($optionValue) .", value=". var_export($optionValue, true));
        }

        return $optionSpec;
    }

    /**
     * Minimize a full conf map
     */
    protected static function minimizeMap ($fullConfMap)
    {
        $minimizedConfMap = [];

        foreach ($fullConfMap as $optionName => $optionSpec) {
            switch ($optionSpec['type']) {
                case 'null':
                case 'string':
                case 'int':
                case 'bool':
                    if ($optionSpec['action-apply'] == $optionSpec['action-dump']) {
                        $optionSpec['action'] = $optionSpec['action-apply'];
                        unset($optionSpec['action-apply']);
                        unset($optionSpec['action-dump']);

                        if ($optionSpec['action'] == 'copy-as-is') {
                            $optionSpec = $optionSpec['value'];
                        }
                    }

                    break;

                case 'array':
                case 'object':
                    // Object-specific
                    if ($optionSpec['type'] == 'object') {
                        if ($optionSpec['class'] == 'stdClass') {
                            unset($optionSpec['class']);
                        }
                    }

                    if ($optionSpec['action-apply'] == $optionSpec['action-dump']) {
                        $optionSpec['action'] = $optionSpec['action-apply'];
                        unset($optionSpec['action-apply']);
                        unset($optionSpec['action-dump']);

                        // For copy-as-is do nothing

                        if ($optionSpec['action'] == 'walk') {
                            $optionSpec['value'] = self::minimizeMap($optionSpec['value']);
                            unset($optionSpec['action']);
                        }

                    } elseif ($optionSpec['action-apply'] == 'walk') {
                        $optionSpec['value'] = self::minimizeMap($optionSpec['value']);

                    } elseif ($optionSpec['action-apply'] == 'ignore') {
                        unset($optionSpec['value']);
                    }

                    if ($optionSpec['undef-key-action-apply'] == 'ignore') {
                        unset($optionSpec['undef-key-action-apply']);
                    }
                    if ($optionSpec['undef-key-action-dump'] == 'add') {
                        unset($optionSpec['undef-key-action-dump']);
                    }

                    break;
            }

            if (is_array($optionSpec)) {
                ksort($optionSpec);
            }
            $minimizedConfMap[$optionName] = $optionSpec;
        }

        ksort($minimizedConfMap);
        return $minimizedConfMap;
    }

    /**
     * Inflate a minimized conf map into full conf map
     */
    protected static function inflateMap ($minimizedConfMap, $undefKeyActionDump="add")
    {
        $fullConfMap = [];

        foreach ($minimizedConfMap as $optionName => $minimumOptionSpec) {

            if (is_array($minimumOptionSpec)) {
                $optionSpec = $minimumOptionSpec;
                switch ($optionSpec['type']) {
                    case 'null':
                    case 'string':
                    case 'int':
                    case 'bool':
                        if (!isset($optionSpec['action-apply'])) {
                            $optionSpec['action-apply'] = (isset($optionSpec['action']) ? $optionSpec['action'] : 'copy-as-is');
                        }
                        if (!isset($optionSpec['action-dump'])) {
                            $optionSpec['action-dump'] = (isset($optionSpec['action'])  ? $optionSpec['action'] : 'copy-as-is');
                        }
                        unset($optionSpec['action']);
                        break;

                    case 'array':
                    case 'object':
                        if (!isset($optionSpec['action-apply'])) {
                            $optionSpec['action-apply'] = (isset($optionSpec['action']) ? $optionSpec['action'] : 'walk');
                        }
                        if (!isset($optionSpec['action-dump'])) {
                            $optionSpec['action-dump'] = (isset($optionSpec['action'])  ? $optionSpec['action'] : 'walk');
                        }
                        unset($optionSpec['action']);

                        if (!isset($optionSpec['undef-key-action-apply'])) {
                            $optionSpec['undef-key-action-apply'] = 'ignore';
                        }
                        if (!isset($optionSpec['undef-key-action-dump'])) {
                            $optionSpec['undef-key-action-dump'] = $undefKeyActionDump;
                        }

                        if ($optionSpec['value'] != NULL) {
                            $optionSpec['value'] = self::inflateMap($optionSpec['value'], $undefKeyActionDump);
                        }

                        // Object-specific
                        if ($optionSpec['type'] == 'object') {
                            if (!isset($optionSpec['class'])) {
                                $optionSpec['class'] = 'stdClass';
                            }
                        }

                        break;

                    default:
                        throw new Exception("Unsupported data type specification encountered: ". $optionSpec['type'] ." (found at option '". $optionName ."')");
                }

            } elseif (is_string($minimumOptionSpec)) {
                $optionSpec = [
                    'type'         => 'string',
                    'action-apply' => 'copy-as-is',
                    'action-dump'  => 'copy-as-is',
                    'value'        => $minimumOptionSpec,
                ];

            } elseif (is_int($minimumOptionSpec)) {
                $optionSpec = [
                    'type'         => 'int',
                    'action-apply' => 'copy-as-is',
                    'action-dump'  => 'copy-as-is',
                    'value'        => $minimumOptionSpec,
                ];

            } elseif (is_bool($minimumOptionSpec)) {
                $optionSpec = [
                    'type'         => 'bool',
                    'action-apply' => 'copy-as-is',
                    'action-dump'  => 'copy-as-is',
                    'value'        => $minimumOptionSpec,
                ];

            } elseif (is_null($minimumOptionSpec)) {
                $optionSpec = [
                    'type'         => 'null',
                    'action-apply' => 'copy-as-is',
                    'action-dump'  => 'copy-as-is',
                    'value'        => NULL,
                ];

            } else {
                throw new Exception("Unsupported data type (3) for '$optionName': ". gettype($minimumOptionSpec) .", value/minOptionSpec=". $minimumOptionSpec);
            }

            $fullConfMap[$optionName] = $optionSpec;
        }

        return $fullConfMap;
    }

    /**
     * Merge all defined conf maps into a final single map that can then be applied to the database
     */
    public static function mergeDefinedMapSet ()
    {
        $mergedConfMap = [];

        foreach (self::$confMapIndex as $mapId => $mapMetadata) {
            // When dumping, unknown keys should only land in the first defined conf map, not in all of them
            if ($mapId == array_key_first(self::$confMapIndex)) {
                $undefKeyActionDump = "add";
            } else {
                $undefKeyActionDump = "ignore";
            }
            $confMap = self::getMap($mapId, $undefKeyActionDump);
            $mergedConfMap = self::mergeTwoMaps($mergedConfMap, $confMap, $mapId);
        }
        ksort($mergedConfMap);

        return $mergedConfMap;
    }

    /**
     * Merge two maps into one (options from the second map override options in the first map)
     */
    protected static function mergeTwoMaps ($firstMap, $secondMap, $secondMapId)
    {
        $mergedMap = $firstMap;

        // Handle null values correctly
        if (!isset($secondMap)) {
            return $mergedMap;
        }

        foreach ($secondMap as $optionName => $optionSpec) {
            switch ($optionSpec['type']) {
                case 'null':
                case 'string':
                case 'int':
                case 'bool':
                    $mergedMap[$optionName] = $optionSpec;
                    $mergedMap[$optionName]['source-map-id'] = $secondMapId;
                    break;

                case 'array':
                case 'object':
                    if (!isset($mergedMap[$optionName])) {
                        if ($optionSpec['type'] == 'array') {
                            $mergedMap[$optionName] = [
                                'type'  => 'array',
                                'value' => [],
                            ];
                        }

                        if ($optionSpec['type'] == 'object') {
                            $mergedMap[$optionName] = [
                                'type'  => 'object',
                                'class' => $optionSpec['class'],
                                'value' => [],
                            ];
                        }
                    }

                    // This is only useful at the very top-level
                    if (isset($optionSpec['encoding'])) {
                        $mergedMap[$optionName]['encoding'] = $optionSpec['encoding'];
                    }

                    $mergedMap[$optionName]['action-apply']           = $optionSpec['action-apply'];
                    $mergedMap[$optionName]['action-dump']            = $optionSpec['action-dump'];
                    $mergedMap[$optionName]['undef-key-action-apply'] = $optionSpec['undef-key-action-apply'];
                    $mergedMap[$optionName]['undef-key-action-dump']  = $optionSpec['undef-key-action-dump'];
                    $mergedMap[$optionName]['value'] = self::mergeTwoMaps($mergedMap[$optionName]['value'], $optionSpec['value'], $secondMapId);
                    $mergedMap[$optionName]['source-map-id'] = $secondMapId;
                    break;

                default:
                    throw new Exception("Unsupported data type specification encountered: ". $optionSpec['type'] ." (found at option '". $optionName ."')");
            }
        }
        ksort($mergedMap);

        return $mergedMap;
    }

    /**
     * Apply the given conf map to the database
     *
     * It takes the conf map and updates the `wp_options` table according to
     * the map's specifications.
     *
     * @param   array   $confMap      Map to apply
     * @param   bool    $dryRun         If true, do not perform the database updates (default: false)
     * @return  array                   Array of changes that were performed
     */
    public static function applyMap ($confMap, $dryRun=false)
    {
        // Let's call these arrays "value maps", since we'll only be consulting
        // their values to determine what needs to be updated in the database
        $currentValueMap = self::generateMapFromWpOptions(false);
        $newValueMap = $currentValueMap;

        // Apply the map + generate change descriptions
        $changes = [];
        foreach ($confMap as $optionName => $optionSpec) {
            $newChanges = self::applyOptionSpec($newValueMap, $optionName, $optionSpec);
            $changes = array_merge($changes, $newChanges);
        }

        // Update database where applicable
        if ($dryRun == false) {
            $currentWpOptionsArray = self::generateRawWpOptionsFromMap($currentValueMap);
            $newWpOptionsArray = self::generateRawWpOptionsFromMap($newValueMap);
            foreach ($currentWpOptionsArray as $optionName => $optionValue) {
                if (!isset($newWpOptionsArray[$optionName])) {
                    self::$wpOptionsIO::deleteOption($optionName);
                }
            }
            foreach ($newWpOptionsArray as $optionName => $optionValue) {
                if (!isset($currentWpOptionsArray[$optionName])) {
                    self::$wpOptionsIO::insertOption($optionName, $optionValue);
                } else {
                    if ($currentWpOptionsArray[$optionName] != $newWpOptionsArray[$optionName]) {
                        self::$wpOptionsIO::updateOption($optionName, $optionValue);
                    }
                }
            }
        }

        // Return an array of changes to be displayed in a console
        return $changes;
    }

    /**
     * Apply the given optionSpec to a given config/value map (in-place)
     *
     * It takes the option spec from a conf map and applies it (in-place!) to
     * a config/value map item.
     *
     * @param   array   &$targetValueMap A config/value map to work on, passed by reference
     * @param   string  $optionName      Option to work on in the $targetValueMap
     * @param   array   $optionSpec      Option spec to apply
     * @return  array                    An array of change descriptions that were performed
     */
    public static function applyOptionSpec (&$targetValueMap, $optionName, $optionSpec, $parentNames="")
    {
        $changes = [];
        switch ($optionSpec['action-apply']) {

            case 'ignore':
                break;


            case 'delete':
                if (isset($targetValueMap[$optionName])) {
                    $oldValue = ($optionSpec['type'] == 'array' ? '(array)' : $targetValueMap[$optionName]['value']);
                    unset($targetValueMap[$optionName]);

                    $changes[] = [
                        'Option name'   => $parentNames . $optionName,
                        'Action'        => 'Delete',
                        'Before'        => $oldValue,
                        'After'         => '',
                        'Conf map ID' => $optionSpec['source-map-id'],
                    ];
                }
                break;


            case 'copy-as-is':
                if ($optionSpec['type'] == 'array') {
                    throw new Exception("The 'action-apply' value 'copy-as-is' is not yet supported for data type 'array' (encoutered at '$optionName')");
                }

                if (!isset($targetValueMap[$optionName])) {
                    $targetValueMap[$optionName] = $optionSpec;

                    $changes[] = [
                        'Option name'   => $parentNames . $optionName,
                        'Action'        => 'Create',
                        'Before'        => '',
                        'After'         => $optionSpec['value'],
                        'Conf map ID' => $optionSpec['source-map-id'],
                    ];
                } else {
                    if ($targetValueMap[$optionName]['value'] != $optionSpec['value']) {
                        $oldValue = $targetValueMap[$optionName]['value'];
                        $targetValueMap[$optionName]['value'] = $optionSpec['value'];

                        $changes[] = [
                            'Option name'   => $parentNames . $optionName,
                            'Action'        => 'Update',
                            'Before'        => $oldValue,
                            'After'         => $optionSpec['value'],
                            'Conf map ID' => $optionSpec['source-map-id'],
                        ];
                    }
                }

                break;


            case 'walk':
                if (($optionSpec['type'] != 'array') && ($optionSpec['type'] != 'object')) {
                    throw new Exception("The 'action-apply' value 'walk' is only supported for data type 'array' or type 'object' (encoutered at '$optionName')");
                }

                if (!isset($targetValueMap[$optionName])) {
                    $targetValueMap[$optionName] = [
                        'type'                   => $optionSpec['type'],
                        'action-apply'           => $optionSpec['action-apply'],
                        'action-dump'            => $optionSpec['action-dump'],
                        'undef-key-action-apply' => $optionSpec['undef-key-action-apply'],
                        'undef-key-action-dump'  => $optionSpec['undef-key-action-dump'],
                        'value'                  => [],
                        'source-map-id'          => $optionSpec['source-map-id'],
                    ];
                    if (isset($optionSpec['encoding'])) {
                        $targetValueMap[$optionName]['encoding'] = $optionSpec['encoding'];
                    }
                    if (isset($optionSpec['class'])) {
                        $targetValueMap[$optionName]['class'] = $optionSpec['class'];
                    }

                    $changes[] = [
                        'Option name'   => $parentNames . $optionName,
                        'Action'        => 'Create',
                        'Before'        => '',
                        'After'         => '(array)',
                        'Conf map ID' => $optionSpec['source-map-id'],
                    ];
                }
                foreach ($optionSpec['value'] as $arrayOptionName => $arrayOptionSpec) {
                    $newChanges = self::applyOptionSpec($targetValueMap[$optionName]['value'], $arrayOptionName, $arrayOptionSpec, $parentNames.$optionName." => ");
                    $changes = array_merge($changes, $newChanges);
                }

                if ($optionSpec['undef-key-action-apply'] == 'delete') {
                    foreach ($targetValueMap[$optionName]['value'] as $arrayOptionName => $arrayOptionSpec) {
                        if (!isset($optionSpec['value'][$arrayOptionName])) {
                            $oldValue = $arrayOptionSpec['value'];
                            unset($targetValueMap[$optionName]['value'][$arrayOptionName]);

                            $changes[] = [
                                'Option name'   => $parentNames . $optionName ." => " . $arrayOptionName,
                                'Action'        => 'Delete',
                                'Before'        => $oldValue,
                                'After'         => '',
                                'Conf map ID' => $optionSpec['source-map-id'],
                            ];
                        }
                    }
                }

                break;


            default:
                throw new Exception("Unsupported action-apply value '". $optionSpec['action-apply'] ."' found (encountered at '$optionName')");
        }

        // $targetValueMap was passed by reference and worked on in-place, we're only returning a set of changes that were performed
        return $changes;
    }

    /**
     * Generate an array of wp_options from a conf map
     *
     * Generated array is suitable for database inserts/updates.
     *
     * @param   array   confMap       A config/value map to work on, passed by reference
     * @return  array                   An array of wp_options, as if it came directly from the database (suitable for DB inserts/updates)
     */
    protected static function generateRawWpOptionsFromMap ($confMap)
    {
        $wpOptions = [];

        // Convert back to usual types
        foreach ($confMap as $optionName => $optionSpec) {
            switch ($optionSpec['type']) {
                case 'null':
                case 'string':
                case 'int':
                case 'bool':
                    $wpOptions[$optionName] = $optionSpec['value'];
                    break;

                case 'array':
                case 'object':
                    $value = self::generateRawWpOptionsFromMap($optionSpec['value']);

                    if ($optionSpec['type'] == 'object') {
                        // Non-stdClass support is missing
                        $value = (object) $value;
                    }

                    if (!isset($optionSpec['encoding'])) {
                        $wpOptions[$optionName] = $value;
                    } else {
                        switch ($optionSpec['encoding']) {
                            case 'serialize':
                                $wpOptions[$optionName] = serialize($value);
                                break;
                            case 'json':
                                $wpOptions[$optionName] = json_encode($value);
                                break;
                            default:
                                throw new Exception("Unsupported encoding '". $optionSpec['encoding'] ."' requested (encountered at '$optionName')");
                        }
                    }
                    break;

                default:
                    throw new Exception("Unsupported value type '". $optionSpec['type'] ."' found (encountered at '$optionName')");
            }
        }

        return $wpOptions;
    }

    /**
     * Update values of a conf map by pulling them from another conf map (called "value map" in this case)
     *
     * Generated array is suitable for database inserts/updates.
     *
     * @param   array   $confMap      A conf map to work on
     * @param   array   $newValueMap    A value map to use (it's essentially a conf map, but all non-value metadata is ignored)
     * @param   array   $undefKeyAction Action to take with option keys that only appear in $newValueMap ('add' or 'ignore')
     * @return  array                   An updated conf map
     */
    public static function updateMapValues ($confMap, $newValueMap, $undefKeyAction)
    {
        $updatedConfMap = [];

        foreach ($confMap as $optionName => $optionSpec) {
            if ($optionSpec['action-dump'] == 'ignore') {
                $updatedConfMap[$optionName] = $optionSpec;
                continue;
            }
            if (!isset($newValueMap[$optionName])) {
                $updatedConfMap[$optionName] = $optionSpec;
                continue;
            }
            switch ($optionSpec['type']) {
                case 'null':
                case 'string':
                case 'int':
                case 'bool':
                    $updatedConfMap[$optionName] = $optionSpec;
                    $updatedConfMap[$optionName]['value'] = $newValueMap[$optionName]['value'];
                    break;

                case 'array':
                    $updatedConfMap[$optionName] = $optionSpec;
                    $updatedConfMap[$optionName]['value'] = self::updateMapValues($optionSpec['value'], $newValueMap[$optionName]['value'], $optionSpec['undef-key-action-dump']);
                    break;

                default:
                    throw new Exception("Unsupported value type '". $optionSpec['type'] ."' found (encountered at '$optionName')");
            }
        }

        if ($undefKeyAction == 'add' && !is_null($newValueMap)) {
            foreach ($newValueMap as $optionName => $optionSpec) {
                if (!isset($confMap[$optionName])) {
                    $updatedConfMap[$optionName] = $optionSpec;
                }
            }
        }

        return $updatedConfMap;
    }

    /**
     * Update a conf map file with the new content
     */
    public static function updateMapFile ($mapId, $newConfMap, $header="")
    {
        file_put_contents(
            self::getMapFile($mapId),
            self::getMapAsPhp($newConfMap, $header)
        );
    }
}
