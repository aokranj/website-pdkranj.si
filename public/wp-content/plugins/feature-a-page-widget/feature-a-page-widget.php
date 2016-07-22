<?php
/**
* Plugin Name: Feature a Page Widget
* Description: Feature a single page in any sidebar.
* Plugin URI: http://mrwweb.com/feature-a-page-widget-plugin-wordpress/
* Version: 1.2.5
* Author: Mark Root-Wiley (MRWweb)
* Author URI: http://mrwweb.com
* Donate Link: https://www.networkforgood.org/donation/MakeDonation.aspx?ORGID2=522061398
* License: GPLv2 or later
* Text Domain: fapw
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public Licchosense
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// because...
defined('ABSPATH') or die("Cannot access pages directly.");

define('FPW_VERSION', '1.2.5');

// Updates plugin version saved as option in database
function fpw_update_version() {
	// Update the Plugin Version if it doesn't exist or is out of sync
	$fpw_options = get_option( 'fpw_options' );
	if( !isset( $fpw_options['version'] ) || $fpw_options['version'] != FPW_VERSION ) {
		$fpw_options['version'] = FPW_VERSION;
		update_option( 'fpw_options', $fpw_options );
	}
}

// Update/Add version when activating plugin
function fpw_activate() {
	fpw_update_version();
}

// Update/Add version when upgrading plugin
function fpw_upgrade() {
	fpw_update_version();
}

// Clean up plugin option on uninstall
function fpw_uninstall() {
	delete_option( 'fpw_options' );
}

// Register scripts & styles for plugin in the admin
// Unregister any conflicting assets from other plugins
function fpw_admin_scripts( $hook ) {
	// Keep the rest of WordPress snappy. Only run on the widgets.php page.
	if( 'widgets.php' == $hook ) {
		// dequeue conflicting Chosens
		wp_dequeue_style( 'tribe-events-chosen-style' );
		wp_dequeue_script( 'tribe-events-chosen-jquery' );

		// The Chosen jQuery Plugin - http://harvesthq.github.com/chosen/
		wp_enqueue_script( 'fpw_chosen_js', plugins_url( 'chosen/chosen.jquery.min.js', __FILE__ ), array( 'jquery' ), '1.0.0' );
		wp_enqueue_style( 'fpw_chosen_css', plugins_url( 'chosen/chosen.css', __FILE__ ), false, '1.0.0' );

		// Plugin JS
		wp_enqueue_script( 'fpw_admin_js', plugins_url( 'js/fpw_admin.js', __FILE__ ), array( 'jquery', 'fpw_chosen_js' ), FPW_VERSION );
		// Plugin CSS
		wp_enqueue_style( 'fpw_admin_css', plugins_url( 'css/fpw_admin.css', __FILE__ ), false, FPW_VERSION );
	}
}

// Register necessary features to make this work
// hooked at late but reasonable priority to try to override themes
function fpw_page_supports() {
	// Enable core WP features on pages to allow widget to function
	add_theme_support( 'post-thumbnails' );
	add_post_type_support( 'page', 'excerpt' );
	add_post_type_support( 'page', 'thumbnail' );
	// For the "Wrapped" layout
	add_image_size( 'fpw_square', 200, 200, true );
	// For the "Banner" layout
	add_image_size( 'fpw_banner', 400, 150, true );
	// For the "Big" layout
	add_image_size( 'fpw_big', 400, 600 );
}

// any languages files
function fpw_textdomain() {
	load_plugin_textdomain( 'fapw', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

// Contextual Help Tab on Widget Screen
function fpw_contextual_help() {
    $screen = get_current_screen();

    /*
     * Check if current screen is Widgets Admin Page
     * Don't add help tab if it's not
     */
    if ( $screen && $screen->id != 'widgets' )
        return;

    // Add my_help_tab if current screen is My Admin Page
    $screen->add_help_tab( array(
        'id'	=> 'fpw_help_tab',
        'title'	=> __( 'Feature a Page Widget', 'fapw' ),
        'content'	=> sprintf( '<p><h2>' . __( 'Feature a Page Widget Help', 'fapw' ) . '</h2><p>' . __( 'The Feature a Page Widget uses the "Featured Image" and "Excerpt" fields <strong>which are saved and edited on the page you want to feature</strong>. The widget indicates whether those fields are set in the "Page to Feature" select list (%1$s) and widget form (%2$s / %3$s).', 'fapw' ) . '<p>' . __( ' If you need to add or modify the Featured Image or Excerpt, click the edit link (%4$s) in the widget settings form to edit the page in a new tab or window.', 'fapw' ) . '</p><h2>' . __( 'Frequently Asked Questions &amp; Support', 'fapw' ) . '</h2><p>' . __( 'For information about setting the Excerpt and Featured Image, changing the widget\'s look &amp; feel, modifying the widget output, and more, please visit the plugin\'s <a target="_blank" href="http://wordpress.org/extend/plugins/feature-a-page-widget/faq/">FAQ page</a> or <a href="%5$s" target="_blank">readme.txt</a>.', 'fapw' ) . '</p><p>' . __( 'If you are still having problems with the widget after reading the above help text and plugin FAQ, you can open a thread on <a href="http://wordpress.org/support/plugin/feature-a-page-widget" target="_blank">the plugin\'s support forum</a>.', 'fapw' ) . '</p><h2>' . __( 'Feedback, &amp; Future Versions', 'fapw' ) . '</h2><p>' . __( 'Feature additions and improvements to the plugin are primarily made in response to user feedback. Once you have used the plugin, please consider:', 'fapw' ) . '</p><ul><li><a href="http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_5" target="_blank">' . __( 'Voting for and suggesting new features', 'fapw' ) . '</a></li><li><a href="http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_4" target="_blank">' . __( 'Submitting feedback to the author', 'fapw' ) . '</a></li><li><a href="http://wordpress.org/support/view/plugin-reviews/feature-a-page-widget" target="_blank">'  . __( 'Rating and reviewing the plugin on WordPress.org', 'fapw' ) . '</a></li></ul>',
        	'<img src="' . esc_url( plugins_url( '/img/fpwFieldsPreviewHelp.gif', __FILE__ ) ). '" alt="' . __( 'Featured Image and Excerpt are present icon', 'fapw' ) . '" />',
        	'<img src="' . esc_url( plugins_url( '/img/tick.png', __FILE__ ) ). '" alt="' . __( 'Set Icon', 'fapw' ) . '" />',
        	'<img src="' . esc_url( plugins_url( '/img/exclamation-red.png', __FILE__ ) ). '" alt="' . __( 'Missing Icon', 'fapw' ) . '" />',
        	'<img alt="' . __('pencil icon', 'fapw') . '" src="' . esc_url( plugins_url( '/img/pencil.png', __FILE__ ) ) . '" />',
        	esc_url( plugins_url( '/readme.txt', __FILE__ ) )
        	)
    ) );
}

// Here we go. Register the widget. It's in fpw_widget.class.php.
function fpw_register_widget() {
	register_widget( 'FPW_Widget' );
}

// Activation, Upgrade, and Deactivation
register_activation_hook( __FILE__, 'fpw_activate' );
add_action( 'admin_init', 'fpw_upgrade' );
register_uninstall_hook( __FILE__, 'fpw_uninstall' );

// Admin Load Scripts and Styles
// (front-end styles are loaded in the widget class)
add_action( 'admin_enqueue_scripts', 'fpw_admin_scripts', 100 );

// Enable Excerpts, Post Thumbnails, and Custom Image Sizes. Load textdomain
add_action( 'init', 'fpw_page_supports', 20 );
add_action( 'plugins_loaded', 'fpw_textdomain' );

// Add contextual help
add_action( 'admin_head-widgets.php', 'fpw_contextual_help' );

// Register the widget class
add_action( 'widgets_init', 'fpw_register_widget' );

require_once ( 'fpw_widget.class.php' );