<?php
/**
 * Custom functions that attempt to resolve plugin-specific issues
 * 
 * These won't be added for everyone conflict. Just for particularly popular plugins.
 * 
 * Specific plugins with issues addressed
 * 		- Jetpack
 *	  	- Digg Digg
 *	   	- podPress
 * 
 * @package feature_a_page_widget
 * @author  Mark Root-Wiley (info@MRWweb.com)
 * @link    http://wordpress.org/plugins/feature-a-page-widget
 * @since   2.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html    GPLv2 or later
 */

/**
 * Remove Jetpack Sharing Buttons from Excerpt in Widget
 * 
 * @since  2.0.0
 */
function fpw_remove_jetpack_sharing_buttons() {

	if( function_exists( 'sharing_display' ) ) {
	    remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}

}
add_action( 'fpw_loop_start', 'fpw_remove_jetpack_sharing_buttons' );

function fpw_add_jetpack_sharing_buttons() {

	if( function_exists( 'sharing_display' ) ) {
	    add_filter( 'the_excerpt', 'sharing_display', 19 );
	}

}
add_action( 'fpw_loop_end', 'fpw_add_jetpack_sharing_buttons' );

/**
 * diggdigg compatibility, removes errors from excerpt in widget
 * 
 * @since  2.0.0
 */
function fpw_remove_diggdigg() {

	if( function_exists( 'dd_hook_wp_content' ) ) {
		remove_filter('the_excerpt', 'dd_hook_wp_content');
	}

}
add_action('fpw_loop_start', 'fpw_remove_diggdigg');

function fpw_add_diggdigg() {

	if( function_exists( 'dd_hook_wp_content' ) ) {
		add_filter('the_excerpt', 'dd_hook_wp_content');
	}

}
add_action('fpw_loop_end', 'fpw_add_diggdigg');

/**
 * podpress compatibility, remove play from widget excerpts
 * 
 * @since  2.0.0
 */
function fpw_remove_podpress() {

	if( class_exists( 'podPress_class' ) ) {
		global $podPress;
		remove_action( 'the_excerpt', array( $podPress, 'insert_the_excerptplayer' ) );
	}

}
add_action( 'fpw_loop_start', 'fpw_remove_podpress' );

function fpw_add_podpress() {

	if( class_exists( 'podPress_class' ) ) {
		global $podPress;
		add_action( 'the_excerpt', array( $podPress, 'insert_the_excerptplayer' ) );
	}

}
add_action( 'fpw_loop_end', 'fpw_add_podpress' );

/**
 * SiteOrigin Page Builder Support
 * 
 * @since  2.0.1
 * 
 * @see  https://siteorigin.com/docs/page-builder/widget-compatibility/
 */
function fpw_sopb_admin_scripts() {

	// Chosen fancy drop down scripts & styles
	wp_register_script( 'chosen', plugins_url( 'chosen/chosen.jquery.min.js', dirname(__FILE__) ), array( 'jquery' ), '1.5.1' );
	wp_register_style( 'chosen_css', plugins_url( 'chosen/chosen.min.css', dirname(__FILE__) ), false, '1.5.1' );

	// Plugin JS
	wp_enqueue_script( 'fpw_admin_js', plugins_url( 'js/fpw_admin.js', dirname(__FILE__) ), array( 'chosen' ), FPW_VERSION );
	
	// Plugin CSS
	wp_enqueue_style( 'fpw_admin_css', plugins_url( 'css/fpw_admin.css', dirname(__FILE__) ), array( 'chosen_css' ), FPW_VERSION );

}
add_action('siteorigin_panel_enqueue_admin_scripts', 'fpw_sopb_admin_scripts' );