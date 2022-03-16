<?php

// https://github.com/babobski/Bootstrap-on-WordPress/tree/master/css

// custom logo guttenberg
add_action('admin_head', function() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').
	'/css/admin-custom.css" />';
});

// login custom css
add_action('login_head', function() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css" />';
});

// login link the logo to the home of our website
add_filter('login_headerurl', function() {
	return get_bloginfo('url');
});

// login change the title text
add_filter('login_headertext', function() {
	return get_bloginfo('name');
});