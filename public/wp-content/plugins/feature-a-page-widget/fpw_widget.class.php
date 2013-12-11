<?php
if( !class_exists('FPW_Widget') ) :
class FPW_Widget extends WP_Widget {

	// widget actual processes
	public function __construct() {
		parent::__construct(
	 		'fpw_widget', // Base ID
			__( 'Feature a Page Widget', 'fapw' ), // Name
			array( 'description' => __( 'A widget to feature a single page', 'fapw' ) )
		);
	}

	/**
	* Options for the widget
	*/
 	public function form( $instance ) {
		
		// Some default values for the widgets
		$defaults = array(
			'title' => '',
			'featured_page_id' => '',
			'layout' => 'wrapped'
		);
		// any options not set get the default
		$instance = wp_parse_args( $instance, $defaults );
		// extract them for cleaner code
		extract( $instance, EXTR_SKIP );

		// prepare list of pages
		$pages_array = get_pages( array(
			'hierarchical' => 0,
			'post_status' => 'publish'
		));
		// make blank first option
		$page_select_list = array( '' => '' );
		foreach( $pages_array as $page ){
			$page_select_list[$page->ID] = esc_attr( $page->post_title );
		}

		// widget admin form begins
		?>

		<p class="fpw-widget-title">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_attr_e( 'Widget Title', 'fapw' ); ?>
			</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>

		<p class="fpw-featured-page-id">
			<label for="<?php echo $this->get_field_id( 'featured_page_id' ); ?>" class="fpw-widget-heading">
				<?php esc_attr_e( 'Page to feature:', 'fapw' ); ?>
			</label>
			<select class="fpw-page-select" data-placeholder="<?php _e( 'Select Featured Page&hellip;', 'fapw' ); ?>" id="<?php echo $this->get_field_id( 'featured_page_id' ); ?>" name="<?php echo $this->get_field_name('featured_page_id'); ?>">
				<?php foreach( $page_select_list as $page_id => $page_title ) {
					// We'll give people a hint if the excerpt and image are set
					$featured_image = null; $excerpt = null;
					if( has_post_thumbnail( $page_id ) )
						$featured_image = 'featured-image';
					if( has_excerpt( $page_id) )
						$excerpt = 'excerpt';
					printf( '<option class="%4$s %5$s" value="%1$s" data-edit-link="%6$s" %3$s>%2$s</option>',
						$page_id,
						$page_title,
						selected( $featured_page_id, $page_id, false ),
						$featured_image,
						$excerpt,
						esc_url( get_edit_post_link( $page_id ) )
					);
				} ?>
			</select>
		</p>

		<noscript>
			<p>This widget will display the Title, Featured Image, and Excerpt from the page you select. Make sure those fields are set for any page you wish to feature.</p>
		</noscript>

		<p class="fpw-page-status">

			<span class="fpw-widget-heading">Page Status: <a href="#" class="fpw-help-button"><img alt="<?php _e( 'Help', 'fapw' ); ?>" src="<?php echo esc_url( plugins_url( '/img/question-white.png', __FILE__ ) ); ?>" /></a></span>
			
			<span class="fpw-page-status-image">
				<?php _e( 'Featured Image', 'fapw' ); ?> 
				<img class="fpw-page-status-set" src="<?php echo esc_url( plugins_url( '/img/tick.png', __FILE__ ) ); ?>" alt="<?php _e( 'Set', 'fapw' ); ?>" /><img class="fpw-page-status-missing" src="<?php echo esc_url( plugins_url( '/img/exclamation-red.png', __FILE__ ) ); ?>" alt="<?php _e( 'Missing', 'fapw' ); ?>" />
			</span>&nbsp;&nbsp;|&nbsp;&nbsp;

			<span class="fpw-page-status-excerpt">
				<?php _e( 'Excerpt', 'fapw' ); ?> 
				<img class="fpw-page-status-set" src="<?php echo esc_url( plugins_url( '/img/tick.png', __FILE__ ) ); ?>" alt="<?php _e( 'Set', 'fapw' ); ?>" /><img class="fpw-page-status-missing" src="<?php echo esc_url( plugins_url( '/img/exclamation-red.png', __FILE__ ) ); ?>" alt="<?php _e( 'Missing', 'fapw' ); ?>" />
			</span>&nbsp;&nbsp;
			
			<span class="fpw-page-status-edit">
				<a class="fpw-page-status-edit-link" href="" target="_blank"><img alt="<?php _e( 'Edit Page in New Window', 'fapw' ); ?>" title="<?php _e( 'Edit Page in New Window', 'fapw' ); ?>" src="<?php echo esc_url( plugins_url( '/img/pencil.png', __FILE__ ) ); ?>" /></a>
			</span>

		</p>

		<p class="fpw-layouts">
			<span class="fpw-widget-heading"><?php _e( 'Layout Options:', 'fapw' ); ?></span>
			<input type="radio" class="fpw-layout-wrapped" id="<?php echo $this->get_field_id( 'layout-wrapped' ); ?>" name="<?php echo $this->get_field_name('layout'); ?>" value="wrapped" <?php checked( 'wrapped', $layout ); ?> />
			<label for="<?php echo $this->get_field_id( 'layout-wrapped' ); ?>">
				<?php esc_attr_e( 'Wrapped Image', 'fapw' ); ?>
			</label><br />
			<input type="radio" class="fpw-layout-banner" id="<?php echo $this->get_field_id( 'layout-banner' ); ?>" name="<?php echo $this->get_field_name('layout'); ?>" value="banner" <?php checked( 'banner', $layout ); ?> />
			<label for="<?php echo $this->get_field_id( 'layout-banner' ); ?>">
				<?php esc_attr_e( 'Banner Image', 'fapw' ); ?>
			</label><br />
			<input type="radio" class="fpw-layout-big" id="<?php echo $this->get_field_id( 'layout-big' ); ?>" name="<?php echo $this->get_field_name('layout'); ?>" value="big" <?php checked( 'big', $layout ); ?> />
			<label for="<?php echo $this->get_field_id( 'layout-big' ); ?>">
				<?php esc_attr_e( 'Big Image', 'fapw' ); ?>
			</label>
		</p>

		<?php

	}

	// processes widget options to be saved
	public function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( $new_instance, $old_instance );

		// Sanitize all the args
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		// the featured id should be an int
		$instance['featured_page_id'] = (int) $new_instance['featured_page_id'];

		// validate layout against accepted options
		$accepted_layouts = array(
			'banner',
			'big',
			'wrapped'
		);
		$instance['layout'] = esc_attr( $new_instance['layout'] );
		if ( ! in_array( $instance['layout'], $accepted_layouts ) )
			$instance['layout'] = '';
		
		return $instance;
	}

	// outputs the content of the widget
	public function widget( $args, $instance ) {
		
		/** 
		 * Extract, sanitize, and compile attributes
		 *----------------------------------------------------*/

		// lets get lots of awesome values to work with
		extract($args);
		extract($instance);

		// without an ID, we're done.
		if( ! $featured_page_id )
			return;
		$featured_page = get_post( $featured_page_id );

		// if the ID didn't return a page, we're also done
		if( ! $featured_page )
			return;

		if( $title )
			$title = apply_filters( 'widget_title', $title );

		// Let's make a post_class string
		$post_class = get_post_class( 'hentry fpw-clearfix fpw-layout-' . esc_attr( $layout ), (int) $featured_page_id );
		$post_classes = '';
		foreach ($post_class as $class) {
			$post_classes .= $class . ' ';
		}

		// see if there's a page title. if so, put it together nicely for use in the widget
		if ( $featured_page->post_title ) {
			$page_title = apply_filters( 'fpw_page_title', esc_attr__( $featured_page->post_title ) );
			$page_title_html = sprintf( 
				'<h1 class="fpw-page-title entry-title">%1$s</h1>',
				sanitize_text_field( $page_title )
			);
		} else {
			$page_title = null;
			$page_title_html = null;
		}

		// if there's an excerpt, grab it and filter
		if( $featured_page->post_excerpt ) {
			$excerpt = $featured_page->post_excerpt;
			$excerpt = apply_filters( 'the_excerpt', $excerpt );
			$excerpt = apply_filters( 'fpw_excerpt', $excerpt, $featured_page_id );
		} else {
			$excerpt = null;
		}

		// the featured image size is dependant on layout
		switch ($layout) {
			case 'wrapped':
				$image_size = 'fpw_square';
				break;

			case 'big':
				$image_size = 'fpw_big';
				break;

			case 'banner':
				$image_size = 'fpw_banner';
				break;
			
			default:
				$image_size = 'fpw_square';
				break;
		}

		// see if there is a post_thumbnail grab it and filter it
		if ( has_post_thumbnail( $featured_page_id ) ) {
			$featured_image = get_the_post_thumbnail( $featured_page_id, $image_size );
			$featured_image = apply_filters( 'fpw_featured_image', $featured_image, $featured_page_id );
		} else {
			$featured_image = null;
		}

		/** 
		 * Widget Output Begins
		 *----------------------------------------------------*/
		// use a version of the widget template from the theme if it exists
		// otherwise, use the default widget template from the plugin folder
		$fpw_template = locate_template( 'fpw_views/fpw_default.php', false, true );
		if( $fpw_template ) {
			require( $fpw_template );
		} else {
			require( plugin_dir_path( __FILE__ ) . 'fpw_views/fpw_default.php' );
		}

	}

} #end FPW_Widget

endif;