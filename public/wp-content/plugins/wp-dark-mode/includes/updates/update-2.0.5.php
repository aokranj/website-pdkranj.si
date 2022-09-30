<?php
// if direct access than exit the file.
defined( 'ABSPATH' ) || exit();
/**
 * if the customer use the 2.0.5 version call this class
 * update some Necessary option setting value for compatible this version
 * 
 * @version 1.0.0
 */
class WP_Dark_Mode_Update_2_0_5 {
	/** 
	 * @var null
	 */
	private static $instance = null;
	/**
	 * WP_Dark_Mode_Update_2_0_5 constructor.
	 *
	 * @return void
	 * @version 1.0.0 
	 */
	public function __construct() {
		$this->update_switch_settings();

	}
	/**
	 * update switch settings option value
	 * 
	 * @return void
	 * @version 1.0.0
	 */
	private function update_switch_settings() {
		$switch_settings = (array) get_option( 'wp_dark_mode_switch' );

		if ( $switch_settings['switch_style'] == 13 ) {
			$switch_settings['switch_style'] = 3;
		}elseif ( $switch_settings['switch_style'] > 2 ) {
			$switch_settings['switch_style'] += 1;
		}

		update_option( 'wp_dark_mode_switch', $switch_settings );

	}
	/**
	 * Singleton instance WP_Dark_Mode_Update_2_0_0 class
	 *
	 * @return WP_Dark_Mode_Update_2_0_5|null
	 * @version 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

/**
 * kick out the class
 */
WP_Dark_Mode_Update_2_0_5::instance();
