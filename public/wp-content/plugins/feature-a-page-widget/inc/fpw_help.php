<?php
/**
 * All documentation/help outside of the widget form itself
 *
 * @package feature_a_page_widget
 * @author  Mark Root-Wiley (info@MRWweb.com)
 * @link    http://wordpress.org/plugins/feature-a-page-widget
 * @since   2.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html    GPLv2 or later
 */
/**
 * setup contextual help tab contents on widgets.php screen
 */
add_action( 'admin_head-widgets.php', 'fpw_contextual_help' );
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
        'id'	    => 'fpw_help_tab',
        'title'     => esc_html__( 'Feature a Page Widget', 'feature-a-page-widget' ),
        'content'	=> sprintf( '<p><h2>' . esc_html__( 'Feature a Page Widget Help', 'feature-a-page-widget' ) . '</h2><p>' . wp_kses_post( __( 'The Feature a Page Widget uses the "Featured Image" and "Excerpt" fields <strong>which are saved and edited on the page you want to feature</strong>. The widget indicates whether those fields are set in the "Page to Feature" select list (%1$s) and widget form (%2$s / %3$s).', 'feature-a-page-widget' ) ) . '<p>' . esc_html__( ' If you need to add or modify the Featured Image or Excerpt, click the edit link (%4$s) in the widget settings form to edit the page in a new tab or window.', 'feature-a-page-widget' ) . '</p><h2>' . esc_html__( 'Frequently Asked Questions &amp; Support', 'feature-a-page-widget' ) . '</h2><p>' . wp_kses_post( __( 'For information about setting the Excerpt and Featured Image, changing the widget\'s look &amp; feel, modifying the widget output, and more, please visit the plugin\'s <a target="_blank" href="http://wordpress.org/extend/plugins/feature-a-page-widget/faq/">FAQ page</a> or <a href="%5$s" target="_blank">readme.txt</a>.', 'feature-a-page-widget' ) ) . '</p><p>' . wp_kses_post( __( 'If you are still having problems with the widget after reading the above help text and plugin FAQ, you can open a thread on <a href="http://wordpress.org/support/plugin/feature-a-page-widget" target="_blank">the plugin\'s support forum</a>.', 'feature-a-page-widget' ) ) . '</p><h2>' . esc_html__( 'Feedback, &amp; Future Versions', 'feature-a-page-widget' ) . '</h2><p>' . esc_html__( 'Feature additions and improvements to the plugin are primarily made in response to user feedback. Once you have used the plugin, please consider:', 'feature-a-page-widget' ) . '</p><ul><li><a href="http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_5" target="_blank">' . esc_html__( 'Voting for and suggesting new features', 'feature-a-page-widget' ) . '</a></li><li><a href="http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_4" target="_blank">' . esc_html__( 'Submitting feedback to the author', 'feature-a-page-widget' ) . '</a></li><li><a href="http://wordpress.org/support/view/plugin-reviews/feature-a-page-widget" target="_blank">'  . esc_html__( 'Rating and reviewing the plugin on WordPress.org', 'feature-a-page-widget' ) . '</a></li></ul>',
        	'<span class="dashicons dashicons-format-image"><span class="screen-reader-text">' . esc_html__( '"Featured Image" Icon', 'feature-a-page-widget' ) . '</span></span><span class="dashicons dashicons-editor-justify"><span class="screen-reader-text">' . esc_html__( '"Excerpt" Icon', 'feature-a-page-widget' ) . '</span></span>',
        	'<span class="dashicons dashicons-yes"><span class="screen-reader-text">' . esc_html__( '"Yes" Icon', 'feature-a-page-widget' ) . '</span></span>',
        	'<span class="dashicons dashicons-no-alt"><span class="screen-reader-text">' . esc_html__( '"No" Icon', 'feature-a-page-widget' ) . '</span></span>',
        	'<span class="dashicons dashicons-edit"><span class="screen-reader-text">' . esc_html__( '"Edit" Icon', 'feature-a-page-widget' ) . '</span></span>',
        	esc_url( plugins_url( '/readme.txt', dirname(__FILE__) ) )
        )
    ) );
}