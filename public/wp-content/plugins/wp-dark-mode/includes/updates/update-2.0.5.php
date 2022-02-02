<?php

class WP_Dark_Mode_Update_2_0_5 {

	private static $instance = null;

	public function __construct() {
		$this->update_switch_settings();

	}

	private function update_switch_settings() {
		$switch_settings = (array) get_option( 'wp_dark_mode_switch' );

		if ( $switch_settings['switch_style'] == 13 ) {
			$switch_settings['switch_style'] = 3;
		}elseif ( $switch_settings['switch_style'] > 2 ) {
			$switch_settings['switch_style'] += 1;
		}

		update_option( 'wp_dark_mode_switch', $switch_settings );

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}


WP_Dark_Mode_Update_2_0_5::instance();
