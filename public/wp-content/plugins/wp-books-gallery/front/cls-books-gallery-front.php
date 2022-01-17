<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
*	Master Class: Front
*/
class WBG_Front
{
    use 
        Wbg_Core,
        Wbg_Core_Settings,
        Wbg_Gallery_Settings_Content,
        Wbg_Search_Content_Settings,
        Wbg_Search_Styles_Settings,
        Wbg_Single_Content_Settings
    ;
    private  $wbg_version ;
    function __construct( $version )
    {
        $this->wbg_version = $version;
        $this->wbg_assets_prefix = substr( WBG_PRFX, 0, -1 ) . '-';
    }
    
    function wbg_front_assets()
    {
        wp_enqueue_style(
            $this->wbg_assets_prefix . 'font-awesome',
            WBG_ASSETS . 'css/font-awesome/css/font-awesome.min.css',
            array(),
            $this->wbg_version,
            FALSE
        );
        wp_enqueue_style(
            'wbg-slick',
            WBG_ASSETS . 'css/slick.css',
            array(),
            $this->wbg_version,
            FALSE
        );
        wp_enqueue_style(
            'wbg-slick-theme',
            WBG_ASSETS . 'css/slick-theme.css',
            array(),
            $this->wbg_version,
            FALSE
        );
        wp_enqueue_style(
            'wbg-front',
            WBG_ASSETS . 'css/' . $this->wbg_assets_prefix . 'front.css',
            array(),
            $this->wbg_version,
            FALSE
        );
        if ( !wp_script_is( 'jquery' ) ) {
            wp_enqueue_script( 'jquery' );
        }
        wp_enqueue_script(
            'wbg-slick',
            WBG_ASSETS . 'js/slick.js',
            '',
            '2.4.20',
            TRUE
        );
        wp_enqueue_script(
            'wbg-front',
            WBG_ASSETS . 'js/wbg-front.js',
            array( 'jquery' ),
            $this->wbg_version,
            TRUE
        );
    }
    
    function wbg_load_shortcode()
    {
        add_shortcode( 'wp_books_gallery', array( $this, 'wbg_load_shortcode_view' ) );
    }
    
    function wbg_load_shortcode_view( $attr )
    {
        global  $wpdb, $post ;
        // Gallery Content
        $wpsdGallerySettingsContent = $this->wbg_get_gallery_settings_content();
        foreach ( $wpsdGallerySettingsContent as $gscKey => $gscValue ) {
            if ( isset( $wpsdGallerySettingsContent[$gscKey] ) ) {
                ${"" . $gscKey} = $gscValue;
            }
        }
        // Search Content
        $wbgSearchContent = $this->wbg_get_search_content_settings();
        foreach ( $wbgSearchContent as $sc_name => $sc_value ) {
            if ( isset( $wbgSearchContent[$sc_name] ) ) {
                ${"" . $sc_name} = $sc_value;
            }
        }
        // Search Styling
        $wbgSearchStyles = $this->wbg_get_search_styles_settings();
        foreach ( $wbgSearchStyles as $ss_name => $ss_value ) {
            if ( isset( $wbgSearchStyles[$ss_name] ) ) {
                ${"" . $ss_name} = $ss_value;
            }
        }
        // General Settings
        $wbgCoreSettings = $this->wbg_get_core_settings();
        foreach ( $wbgCoreSettings as $core_name => $core_value ) {
            if ( isset( $wbgCoreSettings[$core_name] ) ) {
                ${"" . $core_name} = $core_value;
            }
        }
        $output = '';
        ob_start();
        include WBG_PATH . 'front/view/gallery.php';
        $output .= ob_get_clean();
        return $output;
    }
    
    function wbg_load_featured_view( $attr )
    {
        global  $post ;
        $output = '';
        ob_start();
        include WBG_PATH . 'front/view/featured-view.php';
        $output .= ob_get_clean();
        return $output;
    }
    
    function wbg_load_single_template( $template )
    {
        global  $post ;
        if ( 'books' === $post->post_type ) {
            return WBG_PATH . 'front/view/single.php';
        }
        return $template;
    }
    
    function wbg_load_rating( $post_id )
    {
        global  $wpdb ;
        $posts = get_posts( array(
            'post_type'      => 'wpcr3_review',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => array( array(
            'key'     => 'wpcr3_review_post',
            'value'   => $post_id,
            'compare' => '=',
        ) ),
        ) );
        //echo '<pre>';
        //print_r($posts);
        
        if ( !empty($posts) ) {
            $star_sum = 0;
            $star_count = 0;
            foreach ( $posts as $p ) {
                $star_sum = $star_sum + get_post_meta( $p, "wpcr3_review_rating", true );
                $star_count++;
            }
            
            if ( $star_sum > 0 ) {
                $hmt_star = round( $star_sum / $star_count );
                ?>
				<div class="wbg-rating">
					<?php 
                for ( $rs = 1 ;  $rs <= $hmt_star ;  $rs++ ) {
                    ?>
						<i class="fa fa-star"></i>
					<?php 
                }
                ?>
					<?php 
                if ( 5 - $hmt_star > 0 ) {
                    for ( $rns = 1 ;  $rns <= 5 - $hmt_star ;  $rns++ ) {
                        ?>
							<i class="fa fa-star-o"></i>
							<?php 
                    }
                }
                echo  '&nbsp;' . $star_count ;
                ?>
				</div>
				<?php 
            }
        
        }
    
    }

}