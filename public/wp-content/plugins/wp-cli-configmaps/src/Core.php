<?php
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

namespace WP\CLI\ConfigMaps;

use WP_CLI;

if (!defined('ABSPATH')) {
    throw new Exception('Direct calling of this file is not supported: ' . __FILE__);
}
if (!defined('WP_CLI')) {
    throw new Exception('WP CLI plugin is required by: ' . __FILE__);
}

class Core
{

    public static function init ($configMaps)
    {
        require_once __DIR__ . '/Commands.php';
        require_once __DIR__ . '/ConfigMapService.php';
        require_once __DIR__ . '/Db.php';
        require_once __DIR__ . '/Exception.php';

        ConfigMapService::setCustomMaps($configMaps);

        WP_CLI::add_command('configmaps', __NAMESPACE__ . '\\Commands');
    }
}
