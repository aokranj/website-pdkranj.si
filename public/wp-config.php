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
require_once ABSPATH . '/../conf/wp-config-local.php';

/*
 * Verify retrieved configuration
 */
if (!defined('WP_ENV')) {
    throw new Exception("Constant WP_ENV not defined. You must define it in your conf/wp-config-local.php file.");
}
if (WP_ENV != 'prod') {
    if (!defined('WP_DEBUG')) {
        define('WP_DEBUG', true);
    }
}

/*
 * Various per-environment settings (prod & stg only)
 */
if (WP_ENV == 'prod') {
    if (!defined('AOKRANJ_MAIL_FROM_ADDR')) define('AOKRANJ_MAIL_FROM_ADDR', "webmaster@pdkranj.si");
    if (!defined('AOKRANJ_MAIL_FROM_NAME')) define('AOKRANJ_MAIL_FROM_NAME', "PD Kranj");
}
if (WP_ENV == 'stg') {
    if (!defined('AOKRANJ_MAIL_FROM_ADDR')) define('AOKRANJ_MAIL_FROM_ADDR', "no-reply@pdkranj.si");
    if (!defined('AOKRANJ_MAIL_FROM_NAME')) define('AOKRANJ_MAIL_FROM_NAME', "STG PD Kranj STG");
}
if (WP_ENV == 'dev') {
    if (!defined('AOKRANJ_MAIL_FROM_ADDR')) define('AOKRANJ_MAIL_FROM_ADDR', "no-reply@pdkranj.si");
    if (!defined('AOKRANJ_MAIL_FROM_NAME')) define('AOKRANJ_MAIL_FROM_NAME', "DEV PD Kranj DEV");
}

/*
 * Define config maps (for `wp configmaps ...` CLI tool)
 */
$configMaps = [
    'common' => ABSPATH . '../conf/maps/common.php',
    WP_ENV   => ABSPATH . '../conf/maps/' . WP_ENV . '.php',
];
$localConfigMapPath = ABSPATH . '../conf/maps/local.php';
if (file_exists($localConfigMapPath)) {
    $configMaps['local'] = $localConfigMapPath;
}
define('WP_CLI_CONFIGMAPS', $configMaps);
unset($configMaps);

/*
 * Fill in common configuration directives, if undefined
 */
if (!defined('DB_HOST'))    define('DB_HOST',    'localhost');
if (!defined('DB_CHARSET')) define('DB_CHARSET', 'utf8');
if (!defined('DB_COLLATE')) define('DB_COLLATE', 'utf8_slovenian_ci');
if (!defined('WPLANG'))     define('WPLANG',     'sl_SI');
if (!defined('WP_DEBUG'))   define('WP_DEBUG',   false);
if (!isset($table_prefix))  $table_prefix = 'wp_';
if (!defined('WP_DEFAULT_THEME')) define('WP_DEFAULT_THEME', 'pdkranj'); // Defined to make the health check stop complaining about the missing default theme (which we removed)

/*
 * Site URL _must_ be defined in the configuration
 */
if (!defined('WP_HOME'))    throw new Exception('WP_HOME not defined in conf/wp-settings.php');
if (!defined('WP_SITEURL')) throw new Exception('WP_SITEURL not defined in conf/wp-settings.php');

/*
 * Inclute the rest of the WordPress configuration
 */
require_once ABSPATH . 'wp-settings.php';
