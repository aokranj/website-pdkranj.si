<?php

// scripts and styles
add_action('wp_enqueue_scripts', function() {
	$theme = wp_get_theme();
	$min = WP_DEBUG ? '' : 'min.';
	wp_dequeue_script('jquery');
	wp_deregister_script('jquery');
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_register_script('pdkranj', get_template_directory_uri() . '/public/pdkranj.'.$min.'js', [], $theme->get('Version'), true );
	wp_enqueue_script('pdkranj');
	wp_register_style('pdkranj', get_template_directory_uri() . '/public/pdkranj.'.$min.'css', [], $theme->get('Version'), 'screen');
	wp_enqueue_style('pdkranj');
});

// setup theme
add_action('after_setup_theme', function() {
	// add language support to theme
	//load_theme_textdomain('pdkranj', get_template_directory() . '/language');
	
	// add html 5 support to wordpress elements
	add_theme_support('html5', [
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	]);

	// add post image support
	add_theme_support('post-thumbnails');

	// register menus
	register_nav_menus([
		'header' => 'Header Menu',
		'footer' => 'Footer Menu',
	]);
});

// register sidebar
add_action('widgets_init', function() {
	register_sidebar([
		'name' 					=> 'Sidebar',
		'id' 						=> 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="widget-title">',
		'after_title' 	=> '</h4>',
	]);
	register_sidebar([
		'name' 					=> 'Footer',
		'id' 						=> 'footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4 class="widget-title">',
		'after_title' 	=> '</h4>',
	]);
});

// body class
add_filter('body_class', function($classes) {
	global $post;

	if( is_home() ) {			
		$key = array_search('blog', $classes );
		if($key > -1) {
			unset( $classes[$key] );
		};
	} elseif( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif(is_singular()) {
		$classes[] = sanitize_html_class( $post->post_name );
	};

	return $classes;
});

// remove wp version
add_filter('the_generator', function() {
	return '';
});

// limit excerpt length
add_filter('excerpt_length', function($length) {
	return 20;
});

// remove default footer text
add_filter('admin_footer_text', function() {
	echo "";
});

// exclude category novice from homepage
add_action('pre_get_posts', function($query) {
	if( $query->is_main_query() && !is_admin() && $query->is_home() ) {
		$query->set('category__not_in', [2]);
	}
});

// remove wordpress logo from adminbar
add_action('wp_before_admin_bar_render', function() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}, 0);

// remove default Dashboard widgets
add_action('admin_menu', function() {
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_activity', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
});

// remove welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

// disable the emoji's
add_action('init', function() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

	// Remove from TinyMCE
	add_filter('tiny_mce_plugins', function($plugins) {
		if (is_array($plugins)) {
			return array_diff($plugins, array('wpemoji'));
		} else {
			return array();
		}
	});
});

/**
 * Prevent update notification for plugin
 * http://www.thecreativedev.com/disable-updates-for-specific-plugin-in-wordpress/
 * Place in theme functions.php or at bottom of wp-config.php
 */
add_filter('site_transient_update_plugins', function($value) {
	$pluginsToDisable = [
		'wp-gatsby/wp-gatsby.php',
	];
	if ( isset($value) && is_object($value) ) {
		foreach ($pluginsToDisable as $plugin) {
			if (isset($value->response[$plugin])) {
				unset($value->response[$plugin]);
			}
		}
	}
	return $value;
});