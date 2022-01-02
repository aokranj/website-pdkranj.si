<?php
/**
 * Feature a Page Widget "Helper Functions"
 *
 * You can change the widget output by copying any of the three template files
 * in the /fpw_views-2/ folder to an /fpw_views-2/ folder in the active theme.
 *
 * You'll find useful CSS selectors to copy into your own stylesheet in /css/fpw_starter_styles.css.
 *
 * There are a variety of filters documented below that are provided to modify the output.
 *
 * @package feature_a_page_widget
 * @author 	Mark Root-Wiley (info@MRWweb.com)
 * @link 	http://wordpress.org/plugins/feature-a-page-widget
 * @since	2.0.0
 * @license	http://www.gnu.org/licenses/gpl-2.0.html	GPLv2 or later
 */

/**
 * Generate and filter list of post types.
 *
 * 'Page' first. 'Post' second.
 *
 * Add post types with the fpw_post_types filter
 * IMPORTANT: All supported types will have thumbnails and excerpts enabled (see fpw_init.php)
 *
 * @since 2.0.0
 *
 * @return array of post_type slugs
 */
function fpw_post_types() {

	// default supported post types
	$fpw_post_types = array( 'page', 'post'	);

	/**
	 * allow developers to add or remove post types that are feature-able
	 *
	 * 	IMPORTANT: Post types passed through this filter will have post thumbnail and excerpt support added automatically in fpw_init.php
	 *
	 * @since 2.0.0
	 *
	 * @param $fpw_post_types	array	array of post_type slugs that should be supported
	 */
	$fpw_post_types = apply_filters( 'fpw_post_types', $fpw_post_types );

	return $fpw_post_types;

}

/**
 * Get list of posts for a post_type and output as "chosen-friendly" select list options
 *
 * Each <option> lists post title with ID as value
 *
 * First option is blank
 *
 * List is cached with a transient
 *
 * @since 2.0.0
 *
 * @param 	int 	$selected 		ID of selected page, if applicable
 * @return 	string 					HTML <optgroup> with <option> for each post type.
 */
function fpw_page_select_list_options( $selected = null ) {

	$post_types = fpw_post_types();

	// stop if there are no post types to display
	if( ! $post_types ) {
		return;
	}

	$fpw_select_list_options = get_transient( 'fpw_widget_select_list' );

	if( empty( $fpw_select_list_options ) ) {

		// setup string to build options on
		// first option is blank i.e. "no page selected"
		$fpw_select_list_options = '<option value=""></option>';

		// loop through each post type
		foreach( $post_types as $type ) {

			$post_type_object = get_post_type_object( $type );
			$name = $post_type_object->labels->name;

			// open optgroup with post type name
			$fpw_select_list_options .= '<optgroup label="' . esc_attr( $name ) . '">';

			// prepare list of pages
			$posts = get_posts( array(
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'post_type' => $type,
				'orderby' => 'title',
				'order' => 'DESC',
				'no_found_rows' => true,
				'update_post_term_cache' => false,
				'suppress_filters' => false
			));

			// loop through each post, output an <option>
			foreach( $posts as $post) {

				$post_id = $post->ID;
				$post_title = $post->post_title;

				// test for excerpt and feature image, set HTML classes if available
				$featured_image = null;
				if( has_post_thumbnail( $post_id ) ) {
					$featured_image = 'featured-image';
				}

				$excerpt = null;
				if( has_excerpt( $post_id) ) {
					$excerpt = 'excerpt';
				}

				$fpw_select_list_options .= sprintf( '<option class="%3$s %4$s" value="%1$s" data-edit-link="%5$s">%2$s</option>',
					$post_id,
					$post_title,
					$featured_image,
					$excerpt,
					esc_url( get_edit_post_link( $post_id ) )
				);

			}

			// close the optgroup, continue
			$fpw_select_list_options .= '</optgroup>';

		}

		set_transient( 'fpw_widget_select_list', $fpw_select_list_options, 4 * HOUR_IN_SECONDS );

	}

	// set the selected options for this specific widget
	if( ! empty( $selected ) ) {

		$selected_value = 'value="' . $selected . '"';
		$selected_value_selected = $selected_value . ' selected="selected"';
		$fpw_select_list_options = str_replace( $selected_value, $selected_value_selected, $fpw_select_list_options );

	}

	// Add special options - Eventually this will make it in
	/*$fpw_select_list_options .= '<optgroup label="Special">';
	// Most Recent Post
	$fpw_select_list_options .= sprintf(
		'<option value="most_recent" %1$s>Most Recent Post</option>',
		selected( $selected, 'most_recent', false )
	);
	$fpw_select_list_options .= '</optgroup>';*/

	return $fpw_select_list_options;

}


/**
 * Delete the widget's select list transient if publishing a post or updating a published post
 *
 * @param int $post_id ID of a post
 * @param object $post updated post object
 *
 * @since  2.1.0 
 */
function fpw_delete_select_list_transient( $post_id, $post ) {

	if( 'publish' === $post->post_status) {
		delete_transient( 'fpw_widget_select_list' );
	}
	
}

/**
 * make a filterable array of the available templates
 *
 * @since  2.0.0
 *
 * @return array registered templates for widget
 */
function fpw_widget_templates() {

	$default_templates = array(
		'wrapped' => esc_html__( 'Wrapped Image', 'feature-a-page-widget' ),
		'banner' => esc_html__( 'Banner Image', 'feature-a-page-widget' ),
		'big' => esc_html__( 'Big Image', 'feature-a-page-widget' )
	);

	/**
	 * filter the default templates or add custom templates
	 *
	 * @since  2.0.0
	 *
	 * @var $default_templates 	array 	slug/label pairs
	 */
	$templates = apply_filters( 'fpw_widget_templates', $default_templates );

	return $templates;

}