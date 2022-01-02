<?php
/**
 * Configuring WordPress and Loading Assets Required for Widget
 *
 * @package feature_a_page_widget
 * @author 	Mark Root-Wiley (info@MRWweb.com)
 * @link 	http://wordpress.org/plugins/feature-a-page-widget
 * @since	2.0.0
 * @license	http://www.gnu.org/licenses/gpl-2.0.html	GPLv2 or later
 */

/**
 * 1. Set & Update Version
 * 2. Load translation files
 * 3. Enqueue JS and CSS
 * 4. Setup Theme Supports and Image Sizes
 * 5. Init Widget
 */

define( 'FPW_VERSION', '2.1.0' );
/**
 * update the plugin version option in the database
 */
function fpw_update_version() {

	// Update the Plugin Version if it doesn't exist or is out of sync
	$fpw_options = get_option( 'fpw_options' );
	if( !isset( $fpw_options['version'] ) || $fpw_options['version'] !== FPW_VERSION ) {
		$fpw_options['version'] = FPW_VERSION;
		update_option( 'fpw_options', $fpw_options );
	}

}

/**
 * update plugin version when activated
 */
function fpw_activate() {

	fpw_update_version();

}
register_activation_hook( dirname(__FILE__), 'fpw_activate' );

/**
 * update plugin version when updated
 */
function fpw_upgrade() {

	fpw_update_version();

}
add_action( 'admin_init', 'fpw_upgrade' );

/**
 * remove plugin settings when uninstalled
 */
function fpw_uninstall() {

	delete_option( 'fpw_options' );

}
register_uninstall_hook( dirname( __FILE__ ), 'fpw_uninstall' );

/**
 * load text domain
 */
function fpw_textdomain() {

	load_plugin_textdomain( 'feature-a-page-widget', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );

}
add_action( 'plugins_loaded', 'fpw_textdomain' );

/**
 * load scripts & styles required for widget admin
 */
function fpw_admin_scripts( $hook ) {

	// Keep the rest of WordPress snappy. Only run on the widgets.php page.
	if( 'widgets.php' == $hook ) {

		// The Chosen jQuery Plugin - http://harvesthq.github.com/chosen/
		wp_register_script( 'chosen', plugins_url( 'chosen/chosen.jquery.min.js', dirname(__FILE__) ), array( 'jquery' ), '1.7.0' );
		wp_register_style( 'chosen', plugins_url( 'chosen/chosen.min.css', dirname(__FILE__) ), false, '1.7.0' );

		// Plugin JS
		wp_enqueue_script( 'fpw_admin_js', plugins_url( 'js/fpw_admin.js', dirname(__FILE__) ), array( 'chosen' ), FPW_VERSION );

		// Plugin CSS
		wp_enqueue_style( 'fpw_admin_css', plugins_url( 'css/fpw_admin.css', dirname(__FILE__) ), array( 'chosen' ), FPW_VERSION );

	}

}
add_action( 'admin_enqueue_scripts', 'fpw_admin_scripts' );

/**
 * load scripts & styles required for front end
 */
function fpw_enqueue_scripts() {

	// only load styles if there is at least one active widget on the site
	if( is_active_widget( false, false, 'fpw_widget' ) || is_customize_preview() ) {
		wp_enqueue_style( 'fpw_styles_css', plugins_url( 'css/fpw_styles.css', dirname(__FILE__) ), false, FPW_VERSION );
	}

};
add_action( 'wp_enqueue_scripts', 'fpw_enqueue_scripts', 5 );

/**
 * Set up theme support functions and image sizes for widget
 *
 * Enables Excerpt and Post Thumbnail for all post_types added via fpw_post_types filter
 */
function fpw_page_supports() {

	// Enable core WP features on pages to allow widget to function
	add_theme_support( 'post-thumbnails' );

	$fpw_post_types = fpw_post_types();
	foreach( $fpw_post_types as $type ) {

		if( post_type_exists( $type ) ) {
		
			// automatically enable excerpt and thumbnails for all supported post types
			add_post_type_support( $type, 'excerpt' );
			add_post_type_support( $type, 'thumbnail' );
		
			// clear fpw_widget_select_list transient when publishing/updating post
			add_action( 'save_post_' . $type, 'fpw_delete_select_list_transient', 10, 2 );
		
		}

	}

	// Register image sizes
	// For the "Wrapped" layout
	add_image_size( 'fpw_square', 200, 200, true );
	// For the "Banner" layout
	add_image_size( 'fpw_banner', 400, 150, true );
	// For the "Big" layout
	add_image_size( 'fpw_big', 400, 600 );

}
add_action( 'init', 'fpw_page_supports', 20 );

/**
 * initialize the widget class
 */
function fpw_register_widget() {

	register_widget( 'FPW_Widget' );
	
}
add_action( 'widgets_init', 'fpw_register_widget' );