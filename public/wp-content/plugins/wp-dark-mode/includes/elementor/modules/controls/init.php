<?php
// if direct access than exit the file.
defined( 'ABSPATH' ) || exit();
/**
 * WP_Dark_Mode_Controls_Init class use for Includes necessary files and register and
 * Initilizating control hooks
 *
 * @version 1.0.0 
 */
class WP_Dark_Mode_Controls_Init {
	/**
	 * @var null
	 */
	private static $instance = null;
	/**
	 * Singleton instance WP_Dark_Mode_Controls_Init class
	 *
	 * @return WP_Dark_Mode_Controls_Init|null
	 * @version 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	/**
	 * WP_Dark_Mode_Controls_Init constructor.
	 *
	 * Calling method
	 * 
	 *
	 * @return void
	 * @version 1.0.0
	 */
	public function __construct() {

		// Includes necessary files
		$this->include_files();

		// Initilizating control hooks
		add_action( 'elementor/controls/controls_registered', array( $this, 'image_choose' ), 11 );
	}
	/**
	 * Includes necessary files
	 *
	 * @return void
	 * @version 1.0.0
	 */
	private function include_files() {
		// Controls_Manager
		include WP_DARK_MODE_INCLUDES . '/elementor/modules/controls/control-manager.php';

		// image choose
		include WP_DARK_MODE_INCLUDES . '/elementor/modules/controls/image-choose.php';
	}
	/**
	 * Register image choose control
	 * 
	 * @return void
	 * @version 1.0.0
	 */
	public function image_choose( $controls_manager ) {
		$controls_manager->register_control( 'image_choose', new WP_Dark_Mode_Control_Image_Choose() );
	}

}
/**
 * kick out the class
 */
WP_Dark_Mode_Controls_Init::instance();
