<?php
if( ! class_exists('FPW_Widget') ) :

/**
 * Widget Class for Feature a Page Widget
 *
 * @package feature_a_page_widget
 * @author 	Mark Root-Wiley (info@MRWweb.com)
 * @link 	http://wordpress.org/plugins/feature-a-page-widget
 * @since	1.0.0
 * @license	http://www.gnu.org/licenses/gpl-2.0.html	GPLv2 or later
 */
class FPW_Widget extends WP_Widget {

	// set up the widget
	public function __construct() {

		parent::__construct(
	 		'fpw_widget', // Base ID
			esc_html__( 'Feature a Page', 'feature-a-page-widget' ), // Name
			array(
				'description' => esc_html__( 'A widget to feature a single page', 'feature-a-page-widget' ),
				'customize_selective_refresh' => true,
			)
		);

	}

	// Options for the widget
 	public function form( $instance ) {

		// Some default values for the widget options
		$defaults = array(
			'title' => '',
			'featured_page_id' => '',
			'layout' => 'wrapped',
			'show_title' => true,
			'show_image' => true,
			'show_excerpt' => true,
			'show_read_more' => false
		);
		
		// any options not set get the default
		$instance = wp_parse_args( $instance, $defaults );

		// widget admin form begins
		?>

		<p class="fpw-widget-title">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Widget Title', 'feature-a-page-widget' ); ?>
			</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p class="fpw-featured-page-id">
			<label for="<?php echo $this->get_field_id( 'featured_page_id' ); ?>">
				<span  class="fpw-widget-heading"><?php _e( 'Page to Feature', 'feature-a-page-widget' ); ?></span>
				<?php
				/**
				 * if true, replace select list in favor of text input for featured post ID, saving memory required to generate list of ALL pages and posts
				 * @var bool
				 * @since 2.1.0
				 */
				if( apply_filters( 'fpw_temp_memory_fix', false ) ) : ?>
					<input type="text" id="<?php echo $this->get_field_id( 'featured_page_id' ); ?>" name="<?php echo $this->get_field_name('featured_page_id'); ?>" value="<?php echo intval( $instance['featured_page_id'] ); ?>" />
				<?php else : ?>
					<select class="fpw-page-select" data-placeholder="<?php _e( 'Select Featured Page&hellip;', 'feature-a-page-widget' ); ?>" id="<?php echo $this->get_field_id( 'featured_page_id' ); ?>" name="<?php echo $this->get_field_name('featured_page_id'); ?>">
						<?php echo fpw_page_select_list_options( intval( $instance['featured_page_id'] ) ); ?>
					</select>
				<?php endif; ?>
			</label>
		</p>

		<noscript>
			<p>
				<?php _e( 'This widget will display the Title, Featured Image, and Excerpt from the page you select. Make sure those fields are set for any page you wish to feature.', 'feature-a-page-widget' ); ?>
			</p>
		</noscript>

		<p class="fpw-page-status">
			<span class="fpw-widget-heading fpw-form-field">
				<?php
				_e( 'Featured Page Status', 'feature-a-page-widget' );

				// check if we're in the customizer, can't get help link when we're there :(
				global $wp_customize;
				if( ! isset( $wp_customize ) ) :
				?>
					<a href="#0" class="fpw-help-button">
						<span class="fpw-visually-hidden"><?php _e( 'What is this?', 'feature-a-page-widget' ); ?></span>
						<span class="fpw-help-icon dashicons dashicons-editor-help"></span>
					</a>
				<?php endif; ?>
				<span class="fpw-page-status-edit">
					<a class="fpw-page-status-edit-link" href="" target="_blank">
						<span class="fpw-visually-hidden"><?php _e( 'Edit Page in New Window', 'feature-a-page-widget' ); ?></span>
						<span class="fpw-edit-icon dashicons dashicons-edit"></span>
					</a>
				</span>
			</span>

			<span class="fpw-page-status-image fpw-form-field">
				<?php _e( 'Featured Image:', 'feature-a-page-widget' ); ?>
				<span class="fpw-page-status-set">
					<span class="fpw-visually-hidden"><?php _e( 'Set', 'feature-a-page-widget' ); ?></span>
					<span class="fpw-status-icon dashicons dashicons-yes"></span>
				</span>
				<span class="fpw-page-status-missing">
					<span class="fpw-visually-hidden"><?php _e( 'Missing', 'feature-a-page-widget' ); ?></span>
					<span class="fpw-status-icon dashicons dashicons-no-alt"></span>
				</span>
			</span>&nbsp;

			<span class="fpw-page-status-excerpt fpw-form-field">
				<?php _e( 'Excerpt:', 'feature-a-page-widget' ); ?>
				<span class="fpw-page-status-set">
					<span class="fpw-visually-hidden"><?php _e( 'Set', 'feature-a-page-widget' ); ?></span>
					<span class="fpw-status-icon dashicons dashicons-yes"></span>
				</span>
				<span class="fpw-page-status-missing">
					<span class="fpw-visually-hidden"><?php _e( 'Missing', 'feature-a-page-widget' ); ?></span>
					<span class="fpw-status-icon dashicons dashicons-no-alt"></span>
				</span>
			</span>
		</p>

		<?php

		$available_layouts = fpw_widget_templates();

		// only display layout settings if there's more than one available layout
		// allows forcing a single layout with fpw_widget_templates
		if( count( $available_layouts ) > 1 ) :
		?>

		<fieldset class="fpw-layouts"><div><!-- div solely for normalizing positioning between browsers -->

			<legend class="fpw-widget-heading">
				<?php _e( 'Layout Options', 'feature-a-page-widget' ); ?>
			</legend>

			<?php
			foreach( $available_layouts as $slug => $label ) :
			?>
				<div class="layout-option">
					<input type="radio" class="fpw-layout-<?php echo $slug; ?>" id="<?php echo $this->get_field_id( 'layout-' . $slug ); ?>" name="<?php echo $this->get_field_name('layout'); ?>" value="<?php echo $slug; ?>" <?php checked( $slug, $instance['layout'] ); ?> />
					<label for="<?php echo $this->get_field_id( 'layout-' . $slug ); ?>">
						<?php echo $label; ?>
					</label>
				</div>

			<?php endforeach; ?>

		</div></fieldset>
		<?php endif; ?>

		<?php

		// Check if 1.X template override is present in active theme
		// Display a warning if so
		$fpw_template = locate_template( 'fpw_views/fpw_default.php', false, true );

		if( $fpw_template ) {

			echo '<p class="fpw-error"><span class="dashicons dashicons-info"></span>' . esc_html__( 'Your theme is using an outdated widget template. It will continue to work, but new widget options added in Version 2.0 will not. Please rename or remove the custom template and update to one or more new templates.', 'feature-a-page-widget' ) . ' ' . esc_html__( '<a href="http://mrwweb.com/wordpress-plugins/feature-a-page-widget/version-2-documentation/" target="_blank">Full Version 2.0 Documentation</a>', 'feature-a-page-widget' ) . '</p>';

		} else {

			// new v2.X advanced options only available if 1.X template override isn't present
			
			?>

			<fieldset name="<?php echo $this->get_field_name('fpw_advanced'); ?>" class="fpw-advanced">

				<legend class="fpw-widget-heading"><?php _e( 'Show Page Elements', 'feature-a-page-widget' ); ?></legend>
				<?php
				$things_that_can_be_hidden = array(
					'title' => esc_html__( 'Page Title', 'feature-a-page-widget' ),
					'image' => esc_html__( 'Featured Image', 'feature-a-page-widget' ),
					'excerpt' => esc_html__( 'Excerpt', 'feature-a-page-widget' ),
					'read_more' => esc_html__( '"Read More" Link', 'feature-a-page-widget' )
				);
				foreach( $things_that_can_be_hidden as $slug => $label ) :
				?>

					<label for="<?php echo $this->get_field_id( 'show_' . $slug ); ?>" class="fpw-form-filed">
						<input type="checkbox" id="<?php echo $this->get_field_id( 'show_' . $slug ); ?>" name="<?php echo $this->get_field_name('show_' . $slug); ?>" value="show_<?php echo $slug; ?>" <?php checked( true, $instance['show_' . $slug] ); ?> />
						<span class="fpw-visually-hidden"><?php _e( 'Show ', 'feature-a-page-widget' ); ?></span>
						<?php echo $label; ?>
					</label>

				<?php endforeach; ?>

			</fieldset>

		<?php }

	}

	// processes widget options to be saved
	public function update( $new_instance, $old_instance ) {

		// update old options with the new ones
		$instance = wp_parse_args( $new_instance, $old_instance );

		/*************************************
		 * SANITIZE ALL THE OPTIONS
		 *************************************/
		
		// Plain Text
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		// Option must be in pre-defined array
		// test for Special values, otherwise, it's an integer
		$special_features = array(/* 'most_recent' */);
		if( in_array( $new_instance['featured_page_id'], $special_features ) ) {
			$instance['featured_page_id'] = $new_instance['featured_page_id'];
		} else {
			$instance['featured_page_id'] = intval( $new_instance['featured_page_id'] );
		}

		// esc layout key
		$instance['layout'] = esc_attr( $new_instance['layout'] );
		// validate layout for accepted options
		$accepted_layouts = fpw_widget_templates();
		if( ! in_array( $instance['layout'], array_keys(  $accepted_layouts ) ) ) {

			$accepted_layouts_keys = array_keys( $accepted_layouts );
			$instance['layout'] = $accepted_layouts_keys[0];

		}

		// boolean options to sanitize
		$true_falses = array( 'show_title', 'show_image', 'show_excerpt', 'show_read_more' );
		foreach ( $true_falses as $option ) {

			$instance[$option] = isset( $new_instance[$option] ) ? (bool) $new_instance[$option] : false;

		}

		return $instance;

	}

	// outputs the content of the widget
	public function widget( $args, $instance ) {

		// Validate widget options
		$defaults = array(
			'title' => '',
			'featured_page_id' => '',
			'layout' => 'wrapped',
			'show_title' => true,
			'show_image' => true,
			'show_excerpt' => true,
			'show_read_more' => false
		);

		// any options not set get the default
		$instance = wp_parse_args( $instance, $defaults );

		// if there's no featured post ID, we can stop now.
		if( 0 === $instance['featured_page_id'] ) {
			return;
		}

		// apply widget_title filter if there's a title
		if( ! empty( $instance['title'] ) ) {

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		}

		// set a required layout if filters result in only 1 available template
		$accepted_layouts = fpw_widget_templates();
		if( 1 === count( $accepted_layouts ) ) {

			$accepted_layouts_keys = array_keys( $accepted_layouts );
			$instance['layout'] = $accepted_layouts_keys[0];

		}

		// Implement advanced widget options via template function filters
		// removing filters ensures that later instances don't accidentally inherit settings

		if( (bool) $instance['show_read_more'] ) {
			add_filter( 'fpw_excerpt', 'fpw_read_more', 999 );
		} else {
			remove_filter( 'fpw_excerpt', 'fpw_read_more', 999 );
		}

		if( ! (bool) $instance['show_title'] ) {
			add_filter( 'fpw_page_title', '__return_empty_string', 999 );
		} else {
			remove_filter( 'fpw_page_title', '__return_empty_string', 999 );
		}

		if( ! (bool) $instance['show_excerpt'] ) {
			add_filter( 'fpw_excerpt', '__return_empty_string', 999 );
		} else {
			remove_filter( 'fpw_excerpt', '__return_empty_string', 999 );
		}

		if( ! (bool) $instance['show_image'] ) {
			add_filter( 'fpw_featured_image', '__return_empty_string', 999 );
		} else {
			remove_filter( 'fpw_featured_image', '__return_empty_string', 999 );
		}

		/*************************************
		 * WIDGET OUTPUT BEGINS
		 *************************************/

		// check active theme for widget template,
		// then use default plugin template file(s)
		// will use 1.X version template if present in active theme
		// (this may be deprecated at a later time)
		
		// v 1.X template
		$fpw_template = locate_template( 'fpw_views/fpw_default.php', false, true );

		// v 2.X templates
		$fpw2_template = locate_template( 'fpw2_views/' . esc_attr( $instance['layout'] ) . '.php', false, true );

		// Make our new WP_Query instance for the widget. We use it either way
		$widget_loop = new WP_Query(
			array(
				'post_type' => fpw_post_types(),
				'post__in' => array( intval( $instance['featured_page_id'] ) ),
				'ignore_sticky_posts' => true
			)
		);

		// Allow themes to override template
		if( $fpw_template ) {

			// THIS IF() CLAUSE IS FOR THE LEGACY TEMPLATE SYSTEM
			// WILL EVENTUALLY BE REMOVED

			// for the legacy templates :( now I know better
			extract($args);
			extract($instance);

			// Stuff only required for legacy templates
			$featured_page = get_post( $instance['featured_page_id'] );

			// Let's make a post_class string
			$post_class = get_post_class( 'hentry fpw-clearfix fpw-layout-' . esc_attr( $instance['layout'] ), intval( $instance['featured_page_id'] ) );
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
				$excerpt = apply_filters( 'fpw_excerpt', $excerpt, $instance['featured_page_id'] );

			} else {

				$excerpt = null;

			}

			// the featured image size is dependant on layout
			switch ( $instance['layout'] ) {
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
			if ( has_post_thumbnail( $instance['featured_page_id'] ) ) {

				$featured_image = get_the_post_thumbnail( $instance['featured_page_id'], $image_size );
				$featured_image = apply_filters( 'fpw_featured_image', $featured_image, $instance['featured_page_id'] );

			} else {

				$featured_image = null;

			}

			// load the template
			require( $fpw_template );

		} else {

			// THIS IF() CLAUSE IS THE NEW 2.0 TEMPLATE SYSTEM.

			echo $args['before_widget'];

			if( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			// Action run immediately before the Feature a Page Template and after the widget opening wrapper and title are output.
 
			// Useful for unhooking filters that apply to loop functions like the_content that may interfere with the widget.
 
			// Filters that apply Show/Hide options for the widget are hooked here.

			do_action( 'fpw_loop_start' );

			while( $widget_loop->have_posts() ) : $widget_loop->the_post();

				if( $fpw2_template ) {

					require( $fpw2_template );

				} else {

					require( plugin_dir_path( dirname( __FILE__ ) ) . 'fpw2_views/' . esc_attr( $instance['layout'] ) . '.php' );

				}

			endwhile;

			// Action run immediately after the Feature a Page Template and before the widget closing wrapper.
			// Useful for adding back filters unhooked on `fpw_loop_start`

			do_action( 'fpw_loop_end' );

			wp_reset_postdata();

			echo $args['after_widget'];

		}

	}

} # end FPW_Widget

endif;