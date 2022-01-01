<?php

/*
 * Absolute path to the WordPress directory
 */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/*
 * Include the actual site configuration that is stored outside public directory
 */
require_once ABSPATH . '/../conf/wp-config.php';

/*
 * Fill in common configuration directives, if undefined
 */
if (!defined('DB_HOST'))    define('DB_HOST',    'localhost');
if (!defined('DB_CHARSET')) define('DB_CHARSET', 'utf8');
if (!defined('DB_COLLATE')) define('DB_COLLATE', 'utf8_slovenian_ci');
if (!defined('WPLANG'))     define('WPLANG',     'sl_SI');
if (!defined('WP_DEBUG'))   define('WP_DEBUG',   false);
if (!isset($table_prefix))  $table_prefix = 'wp_';

/*
 * Site URL _must_ be defined in the configuration
 */
if (!defined('WP_HOME'))    throw new Exception('WP_HOME not defined in conf/wp-settings.php');
if (!defined('WP_SITEURL')) throw new Exception('WP_SITEURL not defined in conf/wp-settings.php');

/*
 * Inclute the rest of the WordPress configuration
 */
require_once ABSPATH . 'wp-settings.php';
