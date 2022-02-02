<?php

/** block direct access */
defined( 'ABSPATH' ) || exit;

/** check if class `WP_Dark_Mode_Install` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Install' ) ) {
	/**
	 * Class Install
	 */
	class WP_Dark_Mode_Install {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Do the activation stuff
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function __construct() {
			if ( ! class_exists( 'WP_Dark_Mode_Update' ) ) {
				require_once WP_DARK_MODE_INCLUDES . '/admin/class-update.php';
			}

			$updater = new WP_Dark_Mode_Update();

			if ( ! $updater->needs_update() ) {
				self::create_default_data();
			}
		}


		/**
		 * create default data
		 *
		 * @since 2.0.8
		 */
		private static function create_default_data() {
			update_option( 'wp_dark_mode_version', WP_DARK_MODE_VERSION );

			$install_date = get_option( 'wp_dark_mode_install_time' );

			if ( empty( $install_date ) ) {
				update_option( 'wp_dark_mode_install_time', time() );
			}

			set_transient( 'wp_dark_mode_review_notice_interval', 'off', 7 * DAY_IN_SECONDS );
			set_transient( 'wp_dark_mode_affiliate_notice_interval', 'off', 10 * DAY_IN_SECONDS );

		}

		/**
		 * @return WP_Dark_Mode_Install|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}
}

WP_Dark_Mode_Install::instance();
