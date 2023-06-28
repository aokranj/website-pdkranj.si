<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use WP\CLI\ConfMaps\ConfMapService;
use WP\CLI\ConfMaps\WpOptionsIO\TestStub;

final class DbValueParserTest extends TestCase
{



    public function testReadString (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'optStr' => "text",
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optStr' => "text",
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }



    public function testReadInteger (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'optInt' => "12345",
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optInt' => 12345,
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }



    public function testReadArray (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'optArray' => 'a:2:{s:7:"itemOne";s:4:"val1";s:7:"itemTwo";s:4:"val2";}'
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optArray' => [
                    'encoding' => "serialize",
                    'type' => "array",
                    'value' => [
                        'itemOne' => 'val1',
                        'itemTwo' => 'val2',
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }



    public function testReadObject (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'optObject' => 'O:8:"stdClass":2:{s:7:"propOne";s:4:"val1";s:7:"propTwo";s:4:"val2";}'
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optObject' => [
                    'encoding' => "serialize",
                    'type' => "object",
                    'class' => "stdClass",
                    'value' => [
                        'propOne' => 'val1',
                        'propTwo' => 'val2',
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }



    public function testReadArrayBool (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'optArray' => 'a:2:{s:8:"itemTrue";b:1;s:9:"itemFalse";b:0;}'
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'optArray' => [
                    'encoding' => "serialize",
                    'type' => "array",
                    'value' => [
                        'itemTrue'  => true,
                        'itemFalse' => false,
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }



    public function testReadNestedArrays (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'nestedArrays' => 'a:1:{s:6:"level1";a:1:{s:6:"level2";a:1:{s:6:"level3";a:1:{s:3:"var";s:3:"val";}}}}',
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'nestedArrays' => [
                    'encoding' => "serialize",
                    'type' => "array",
                    'value' => [
                        'level1' => [
                            'type' => "array",
                            'value' => [
                                'level2' => [
                                    'type' => "array",
                                    'value' => [
                                        'level3' => [
                                            'type' => "array",
                                            'value' => [
                                                'var' => 'val',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }



    public function testReadNestedObjects (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'nestedObjects' => 'O:8:"stdClass":1:{s:6:"level1";O:8:"stdClass":1:{s:6:"level2";O:8:"stdClass":1:{s:6:"level3";O:8:"stdClass":1:{s:7:"varName";s:3:"val";}}}}',
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'nestedObjects' => [
                    'encoding' => "serialize",
                    'type' => "object",
                    'value' => [
                        'level1' => [
                            'type' => "object",
                            'value' => [
                                'level2' => [
                                    'type' => "object",
                                    'value' => [
                                        'level3' => [
                                            'type' => "object",
                                            'value' => [
                                                'varName' => 'val',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }



    public function testReadNestedMix (): void
    {
        // Define raw option value(s)
        TestStub::$rawOptions = [
            'nestedMix' => 'O:8:"stdClass":1:{s:6:"level1";a:1:{s:6:"level2";O:8:"stdClass":1:{s:6:"level3";a:1:{s:7:"varName";s:3:"val";}}}}',
        ];
        ConfMapService::setWpOptionsIO("WP\CLI\ConfMaps\WpOptionsIO\TestStub");

        // Define conf map
        $confMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'nestedMix' => [
                    'encoding' => "serialize",
                    'type' => "object",
                    'value' => [
                        'level1' => [
                            'type' => "array",
                            'value' => [
                                'level2' => [
                                    'type' => "object",
                                    'value' => [
                                        'level3' => [
                                            'type' => "array",
                                            'value' => [
                                                'varName' => 'val',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $confMaps = [
            'cm1' => $confMap1,
        ];
        ConfMapService::setCustomMaps($confMaps);

        $mergedConfMap = ConfMapService::mergeDefinedMapSet();
        $changedItems  = ConfMapService::applyMap($mergedConfMap, true);

        $this->assertEquals(count($changedItems), 0, var_export($changedItems, true));
    }
}
