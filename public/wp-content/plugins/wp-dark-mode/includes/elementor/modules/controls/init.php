<?php

defined( 'ABSPATH' ) || exit;

class WP_Dark_Mode_Controls_Init {

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	public function __construct() {

		// Includes necessary files
		$this->include_files();

		// Initilizating control hooks
		add_action( 'elementor/controls/controls_registered', array( $this, 'image_choose' ), 11 );
	}

	private function include_files() {
		// Controls_Manager
		include WP_DARK_MODE_INCLUDES . '/elementor/modules/controls/control-manager.php';

		// image choose
		include WP_DARK_MODE_INCLUDES . '/elementor/modules/controls/image-choose.php';
	}


	public function image_choose( $controls_manager ) {
		$controls_manager->register_control( 'image_choose', new WP_Dark_Mode_Control_Image_Choose() );
	}

}

WP_Dark_Mode_Controls_Init::instance();
