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

namespace WP\CLI\ConfMaps\WpOptionsIO;

class TestStub implements WpOptionsIOInterface
{
    /**
     * Defined options
     *
     * This is an array of optionName => optionValue pairs, with optionValues serialized.
     */
    public static $rawOptions = [];

    /**
     * Retrieve all options from the wp_options table
     */
    public static function getAllOptions ()
    {
        return self::$rawOptions;
    }

    /**
     * Insert an option value into the wp_options table
     *
     * (no further description)
     *
     * @param   string  $optionName     Name identifier of an option in wp_options table
     * @param   string  $value       Value of the option
     * @return  void
     */
    public static function insertOption ($optionName, $value)
    {
        self::$rawOptions[$optionName] = $value;
    }

    /**
     * Update an option value in the wp_options table
     *
     * (no further description)
     *
     * @param   string  $optionName     Name identifier of an option in wp_options table
     * @param   string  $newValue       New value of the option
     * @return  void
     */
    public static function updateOption ($optionName, $newValue)
    {
        self::$rawOptions[$optionName] = $value;
    }

    /**
     * Delete an option (row) from the wp_options table
     *
     * (no further description)
     *
     * @param   string  $optionName     Name identifier of an option in wp_options table
     * @return  void
     */
    public static function deleteOption ($optionName)
    {
        unset(self::$rawOptions[$optionName]);
    }
}
