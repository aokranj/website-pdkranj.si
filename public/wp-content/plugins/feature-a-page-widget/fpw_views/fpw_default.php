<?php




/*
 * DO NOT MODIFY THIS FILE!
 * Instead, copy the /fpw_views/ folder to your active theme's folder.
 * Modify the file in the theme's folder and the plugin will use it.
 * See: http://wordpress.org/extend/plugins/feature-a-page-widget/faq/
 */






/*
 * A LIST OF AVAILABLE VARIABLES
 * $title - The "Widget Title" field value
 * $before_widget / $after_widget / $before_title / $after_title - wrapper markup defined in theme's functions.php file
 * $layout - The widget's selected layout, either 'wrapped', 'big', or 'banner'
 * $page_title - The featured page's title
 * $page_title_html - Full HTML markup used for the page title element
 * $post_classes - a string of post classes, added v1.1.1
 * $featured image - the full <img> markup for the feature page's post thumbnail, _if it exists_
 * $image_size - a string representing the defined image size. It iss selected based on the layout.
 * 		$image_size possible values: 'fpw_wrapped', 'fpw_banner', or 'fpw_big'
 * $excerpt - the post_excerpt field from the featured page, _if it exists_
 * $featured_page_id - the ID of the selected featured page
 * $featured_page - the post object returned by get_post( $featured_page_id )
 *
 * IF YOU MODIFY OR REMOVE THE HTML CLASSES BELOW, THE DEFAULT CSS STYLES WILL NO LONGER WORK
 * Be smart and santitize your outputs: codex.wordpress.org/Data_Validation
 **/

// Wrap the Widget
echo wp_kses_post( $before_widget );

// And now the widget title
if( $title ) {
	echo  wp_kses_post( $before_title ) . sanitize_text_field( $title ) .  wp_kses_post( $after_title );
}

// Open the article element for the page
printf( '<article class="%1$s fpw-widget-page">',
	esc_attr( $post_classes )
);

// Open link before for Title and Image
printf(
	'<a href="%1$s" title="%2$s" class="fpw-featured-link" rel="bookmark">',
	get_permalink( (int) $featured_page_id ),
	esc_attr( get_the_title( (int) $featured_page_id ) )
);

// Title goes before the image for the "wrapped layout"
if( $layout == 'wrapped' ) {
	echo wp_kses_post( $page_title_html );
}

// Show the featured image if it exists
if( $featured_image ) {
	printf(
		'<div class="fpw-featured-image size-%1$s">%2$s</div>',
		esc_attr( $image_size ),
		wp_kses_post( $featured_image )
	);
}

// All other layouts put the image after the image
if( $layout != 'wrapped' ) {
	echo wp_kses_post( $page_title_html );
}

// close the link
echo '</a>';

if( $excerpt ) {
	printf(
		'<div class="fpw-excerpt entry-summary">%1$s</div>',
		wp_kses_post( $excerpt )
	);
}

// Close Article and Widget Wrapper
echo '</article>' .  wp_kses_post( $after_widget );