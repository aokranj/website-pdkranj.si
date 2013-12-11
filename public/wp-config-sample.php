<?php
/**
 * Osnovna Konfiguracija WordPress-a.
 *
 * Ta datoteka ima naslednje konfiguracije: MySQL, Predpona tabel (Table Prefix),
 * Skrivni Ključi, WordPress Jezik in ABSPATH. Več informacij lahko dobite,
 * če obiščete {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex strani. MySQL nastavitve lahko dobite od vašega ponudnika.
 *
 * To datoteko uporabi skripta za pripravo wp-config.php datoteke med namestitvijo.
 * Uporaba spletne strani ni nujno potrebna, lahko le prekopirate to datoteko v
 * "wp-config.php" in spremenite ustrezne vrednosti.
 *
 * @package WordPress
 */

// ** MySQL nastavitve - Te lahko pridobite od vašega ponudnika spletnih storitev ** //
/** Ime baze za WordPress */
define('DB_NAME', 'database_name_here');

/** MySQL uporabniško ime */
define('DB_USER', 'username_here');

/** MySQL geslo */
define('DB_PASSWORD', 'password_here');

/** MySQL ime gostitelja (hostname) */
define('DB_HOST', 'localhost');

/** Nabor znakov za nove tabele */
define('DB_CHARSET', 'utf8');

/** Zbirni tip baze (Database Collate). Če ste v dvomih, tega ne spreminjate */
define('DB_COLLATE', '');

/**#@+
 * Autentifikacijski ključi in kriptografska sol
 *
 * Spremenite to v unikatne vrednosti!
 * Tukaj je generator teh vrednosti: {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Te vrednosti lahko spremenite kadarkoli. Pri tem boste razveljavili vse brskalniške piškotke in vsi uporabniki se bodo mogli ponovno vpisati.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * Predpona (prefix) WordPress Tabel
 *
 * V eni bazi lahko imate več namestitev WordPress-a, če ima vsaka svojo predpono.
 * Samo številke, črke in podčrtaji!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Jezik.
 *
 * Spremenite to, da spremenite jezik WordPress-a. Pripadajoča MO datoteka za izbran
 * jezik mora biti nameščena v "wp-content/languages". Trenutno je nameščen paket
 * sl_SI.mo v wp-content/languages in WPLANG nastavljen na 'si_SL', kar omogoča
 * podporo slovenščine.
 */
define('WPLANG', 'sl_SI');

/**
 * Za razvijalce: WordPress Način Razhroščevanja
 *
 * Spremenite to v true, da omogočite prikaz obvestil med razvijanju.
 * Priporočeno je, da razvijalci tem in vtičnikov uporabijo WP_DEBUG
 * v njihovem razvijalnem okolju..
 */
define('WP_DEBUG', false);

/* To je vse. Veselo blogganje!  */

/** Absolutna pot v WordPress mapo */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Nastavi WordPress in vključene datoteke. */
require_once(ABSPATH . 'wp-settings.php');
