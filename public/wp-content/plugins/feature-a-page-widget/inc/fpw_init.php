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

/**
 * define and update the plugin option in the database
 */
define( 'FPW_VERSION', '2.0.6' );
function fpw_update_version() {
	// Update the Plugin Version if it doesn't exist or is out of sync
	$fpw_options = get_option( 'fpw_options' );
	if( !isset( $fpw_options['version'] ) || $fpw_options['version'] != FPW_VERSION ) {
		$fpw_options['version'] = FPW_VERSION;
		update_option( 'fpw_options', $fpw_options );
	}
}

/**
 * update plugin version when activated
 */
register_activation_hook( dirname(__FILE__), 'fpw_activate' );
function fpw_activate() {
	fpw_update_version();
}

/**
 * update plugin version when updated
 */
add_action( 'admin_init', 'fpw_upgrade' );
function fpw_upgrade() {
	fpw_update_version();
}

/**
 * remove plugin settings when uninstalled
 */
register_uninstall_hook( dirname(__FILE__), 'fpw_uninstall' );
function fpw_uninstall() {
	delete_option( 'fpw_options' );
}

/**
 * load text domain
 */
add_action( 'plugins_loaded', 'fpw_textdomain' );
function fpw_textdomain() {
	load_plugin_textdomain( 'feature-a-page-widget', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
}

/**
 * load scripts & styles required for widget admin
 */
add_action( 'admin_enqueue_scripts', 'fpw_admin_scripts' );
function fpw_admin_scripts( $hook ) {
	// Keep the rest of WordPress snappy. Only run on the widgets.php page.
	if( 'widgets.php' == $hook ) {
		// The Chosen jQuery Plugin - http://harvesthq.github.com/chosen/
		wp_register_script( 'chosen', plugins_url( 'chosen/chosen.jquery.min.js', dirname(__FILE__) ), array( 'jquery' ), '1.5.1' );
		wp_register_style( 'chosen_css', plugins_url( 'chosen/chosen.min.css', dirname(__FILE__) ), false, '1.5.1' );

		// Plugin JS
		wp_enqueue_script( 'fpw_admin_js', plugins_url( 'js/fpw_admin.js', dirname(__FILE__) ), array( 'chosen' ), FPW_VERSION );
		// Plugin CSS
		wp_enqueue_style( 'fpw_admin_css', plugins_url( 'css/fpw_admin.css', dirname(__FILE__) ), array( 'chosen_css' ), FPW_VERSION );
	}
}


/**
 * load scripts & styles required for front end
 */
add_action( 'wp_enqueue_scripts', 'fpw_enqueue_scripts', 5 );
function fpw_enqueue_scripts() {
	// only load styles if there is at least one active widget on the site
	if( is_active_widget( false, false, 'fpw_widget' ) || is_customize_preview() ) {
		wp_enqueue_style( 'fpw_styles_css', plugins_url( 'css/fpw_styles.css', dirname(__FILE__) ), false, FPW_VERSION );
	}
};

/**
 * Set up theme support functions and image sizes for widget
 *
 * Enables Excerpt and Post Thumbnail for all post_types added via fpw_post_types filter
 */
add_action( 'init', 'fpw_page_supports', 20 );
function fpw_page_supports() {
	// Enable core WP features on pages to allow widget to function
	add_theme_support( 'post-thumbnails' );

	// automatically enable excerpt and thumbnails for all supported post types
	$fpw_post_types = fpw_post_types();
	foreach( $fpw_post_types as $type ) {
		if( post_type_exists( $type ) ) {
			add_post_type_support( $type, 'excerpt' );
			add_post_type_support( $type, 'thumbnail' );
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

/**
 * initialize the widget class
 */
add_action( 'widgets_init', 'fpw_register_widget' );
function fpw_register_widget() {
	register_widget( 'FPW_Widget' );
}