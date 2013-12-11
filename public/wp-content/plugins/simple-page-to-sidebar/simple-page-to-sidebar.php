<?php
/*
Plugin Name: Simple Page to Sidebar
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Lets you simply add page content to a sidebar.
Version: 1.0
Author: Steffen Lohaus
Author URI: github.com/steffenlohaus

Copyright 2012  Steffen Lohaus  (github.com/steffenlohaus)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( !class_exists( 'SimplePageToSidebar' ) )
{
	
	/*
	 * ------------------------------------
	 * Class
	 * ------------------------------------
	 */
	// Take a look at "/wp-includes/default-widgets.php" for how to create widgets.
	class SimplePageToSidebar extends WP_Widget
	{
		
		/*
		 * ------------------------------------
		 * Constructor
		 * ------------------------------------
		 */
		function __construct()
		{
			// Language Setup.
			load_plugin_textdomain( 'simple-page-to-sidebar' , false , dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			
			$widget_ops = array(
				'classname' => 'widget_simple_page_to_sidebar',
				'description' => __( 'Lets you simply add page content to a sidebar.' , 'simple-page-to-sidebar' )
			);
			parent::__construct( 'simple_page_to_sidebar' , 'Simple Page to Sidebar' , $widget_ops );
		}
		
		/*
		 * ------------------------------------
		 * Widget
		 * ------------------------------------
		 * Displays the widget content to the frontend.
		 */
		function widget( $args , $instance )
		{
			extract( $args );
			$title = apply_filters('widget_title', $instance['title'] );
			$page_id = $instance[ 'page_id' ];
			echo $before_widget;
			if ( !empty( $title ) )
			{
				echo $before_title . $title . $after_title;
			}
			
			// Show the page content.
			$this->print_page_content( $page_id );
			
			echo $after_widget;
		}
		
		/*
		 * ------------------------------------
		 * Update
		 * ------------------------------------
		 */
		function update( $new_instance , $old_instance ) {
			$instance = $old_instance;
			$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
			$instance[ 'page_id' ] = $new_instance[ 'page_id' ];
			return $instance;
		}
		
		/*
		 * ------------------------------------
		 * Form
		 * ------------------------------------
		 */
		function form( $instance )
		{
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' , 'page_id' => '' ) );
			$title = strip_tags( $instance[ 'title' ] );
			$page_id = $instance[ 'page_id' ];
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' , 'simple-page-to-sidebar' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e( 'Choose your page' , 'simple-page-to-sidebar' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id('page_id'); ?>" name="<?php echo $this->get_field_name('page_id'); ?>">
					<option value="-1" <?php selected( $page_id , -1 ); ?>>-</option>
					<?php $this->pages_to_option_elements( $page_id ); ?>
				</select>
			</p>
			<?php
		}
		
		/*
		 * ------------------------------------
		 * Print pages as option-elements
		 * ------------------------------------
		 */
		function pages_to_option_elements ( $current_page_id )
		{
			
			// Arguments
			$args = array(
			  'post_type' => 'page'
			);
			
			// The Query
			query_posts( $args );
			
			// The Loop
			while ( have_posts() ) : the_post()
			?>
			
				<option value="<?php the_id(); ?>" <?php selected( $current_page_id , get_the_ID() ); ?>>
					<?php
					
					// Check if title is set.
					if ( get_the_title() != '' )
					{
						the_title();
					} else
					{
						_e( '(no title)' , 'simple-page-to-sidebar' );
					};
					
					?>	
				</option>
				
			<?php
			endwhile;
			
			// Reset Query
			wp_reset_query();
			
		}
		
		/*
		 * ------------------------------------
		 * Print page content
		 * ------------------------------------
		 */
		function print_page_content ( $page_id )
		{
			
			// Check if page ID is set.
			if ( $page_id != -1 )
			{
				$page = get_page( $page_id );
				echo apply_filters( 'the_content' , $page->post_content );
			}
			
		}
	
	}

}

/*
 * ------------------------------------
 * Register
 * ------------------------------------
 */
function simple_page_to_sidebar_load_widget()
{
	register_widget( 'SimplePageToSidebar' );
}

/*
 * ------------------------------------
 * Add action
 * ------------------------------------
 */
add_action( 'widgets_init' , 'simple_page_to_sidebar_load_widget' );

?>