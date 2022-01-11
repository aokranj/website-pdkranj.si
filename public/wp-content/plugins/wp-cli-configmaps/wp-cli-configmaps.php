<?php
/**
 * Plugin Name:       ConfigMaps for WordPress CLI
 * Plugin URI:        https://github.com/wp-cli-configmaps/wp-cli-configmaps
 * Description:       Configuration management for your wp_options table
 * Version:           1.0.0beta1
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Bostjan Skufca Jese
 * Author URI:        https://github.com/bostjan
 * License:           GPLv2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */
/*
 * ConfigMaps for WordPress CLI - Configuration management for your wp_options table
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

/*
 * Ensure basic environment sanity
 */
if (!defined('ABSPATH')) {
    throw new Exception('Direct calling of this file is not supported: ' . __FILE__);
}

/*
 * Plugin initialization method
 */
function wp_cli_configmaps_plugin_init ()
{
    if (is_multisite()) {
        throw new Exception("Multisite WordPress installs are currently not (yet) supported by the wp-cli-configmaps plugin.");
    }

    if (defined('WP_CLI_CONFIGMAPS')) {
        $configMaps = WP_CLI_CONFIGMAPS;
    } else {
        $configMaps = array();
    }

    // Init the plugin
    require_once __DIR__ . "/src/Core.php";
    \WP\CLI\ConfigMaps\Core::init($configMaps);
}

/*
 * Register the initialization method, but only in the CLI context
 */
if (defined('WP_CLI')) {
    add_action( 'init', 'wp_cli_configmaps_plugin_init');
}
