<?php

class WP_Dark_Mode_Update_2_0_0 {

	private static $instance = null;

	public function __construct() {
		$this->update_switch_settings();
		$this->update_includes_excludes();
		$this->update_advanced_settings();
		$this->update_color_settings();

		set_transient( 'wp_dark_mode_review_notice_interval', 'off', 7 * DAY_IN_SECONDS );

	}

	private function update_switch_settings() {
		$general_settings = (array) get_option( 'wp_dark_mode_general', [] );
		$display_settings = (array) get_option( 'wp_dark_mode_display', [] );

		$new_settings = array_merge( $general_settings, $display_settings );

		update_option( 'wp_dark_mode_switch', $new_settings );
	}

	private function update_includes_excludes() {
		$advanced_settings = (array) get_option( 'wp_dark_mode_advanced', [] );
		$display_settings  = (array) get_option( 'wp_dark_mode_display', [] );

		$new_settings = array_merge( $advanced_settings, $display_settings );

		update_option( 'wp_dark_mode_includes_excludes', $new_settings );
	}

	private function update_advanced_settings() {
		$general_settings  = (array) get_option( 'wp_dark_mode_general' );
		$advanced_settings = (array) get_option( 'wp_dark_mode_advanced' );

		$new_settings = array_merge( $general_settings, $advanced_settings );

		update_option( 'wp_dark_mode_advanced', $new_settings );
	}

	private function update_color_settings() {
		$color_settings                  = (array) get_option( 'wp_dark_mode_style' );
		$color_settings['enable_preset'] = 'on';

		update_option( 'wp_dark_mode_color', $color_settings );
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}


WP_Dark_Mode_Update_2_0_0::instance();
