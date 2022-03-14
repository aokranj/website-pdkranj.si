<?php

/**
 * Template Name: Wbg Books Single
 *
 */
get_header();
require_once WBG_PATH . 'front/' . WBG_CLS_PRFX . 'front.php';
$wbg_front_new = new WBG_Front( WBG_VERSION );
// Gallery Settings Content
$wpsdGallerySettingsContent = $wbg_front_new->wbg_get_gallery_settings_content();
//print_r( $wpsdGallerySettingsContent );
foreach ( $wpsdGallerySettingsContent as $gscKey => $gscValue ) {
    if ( isset( $wpsdGallerySettingsContent[$gscKey] ) ) {
        ${"" . $gscKey} = $gscValue;
    }
}
// General Settings
$wbgCoreSettings = $wbg_front_new->wbg_get_core_settings();
foreach ( $wbgCoreSettings as $core_name => $core_value ) {
    if ( isset( $wbgCoreSettings[$core_name] ) ) {
        ${"" . $core_name} = $core_value;
    }
}
$wbgpCurrencySymbol = $wbg_front_new->wbg_get_currency_symbol( $wbgp_currency );
// Gallery Settings Styling
$wbgGeneralStyling = get_option( 'wbg_general_styles' );
$wbg_download_btn_color = ( isset( $wbgGeneralStyling['wbg_download_btn_color'] ) ? $wbgGeneralStyling['wbg_download_btn_color'] : '#0274be' );
$wbg_download_btn_font_color = ( isset( $wbgGeneralStyling['wbg_download_btn_font_color'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color'] : '#FFFFFF' );
// Detail Content Settings
$wbgDetailsContent = $wbg_front_new->wbg_get_single_content_settings();
//print_r( $wbgDetailsContent );
foreach ( $wbgDetailsContent as $dc_name => $dc_value ) {
    if ( isset( $wbgDetailsContent[$dc_name] ) ) {
        ${"" . $dc_name} = $dc_value;
    }
}
// General Settings
$wbgGeneralSettings = get_option( 'wbg_core_settings' );
$wbg_gallery_page_slug = ( isset( $wbgGeneralSettings['wbg_gallery_page_slug'] ) ? $wbgGeneralSettings['wbg_gallery_page_slug'] : null );
// Load Styling
include WBG_PATH . 'assets/css/wbg-single.php';
?>
<div class="wbg-book-single-section clearfix">

    <div class="wbg-details-column wbg-details-wrapper">

        <?php 
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        $wbgFormat = wp_get_post_terms( $post->ID, 'book_format', array(
            'fields' => 'all',
        ) );
        $wbgSeries = wp_get_post_terms( $post->ID, 'book_series', array(
            'fields' => 'all',
        ) );
        $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array(
            'fields' => 'all',
        ) );
        $reading_ages = wp_get_post_terms( $post->ID, 'reading_age', array(
            'fields' => 'all',
        ) );
        $grade_levels = wp_get_post_terms( $post->ID, 'grade_level', array(
            'fields' => 'all',
        ) );
        $wbgImgUrl = get_post_meta( $post->ID, 'wbgp_img_url', true );
        $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
        $wbgPublisher = get_post_meta( $post->ID, 'wbg_publisher', true );
        $wbg_co_publisher = get_post_meta( $post->ID, 'wbg_co_publisher', true );
        $wbgPublished = get_post_meta( $post->ID, 'wbg_published_on', true );
        $wbgIsbn = get_post_meta( $post->ID, 'wbg_isbn', true );
        $wbg_isbn_13 = get_post_meta( $post->ID, 'wbg_isbn_13', true );
        $wbgPages = get_post_meta( $post->ID, 'wbg_pages', true );
        $wbgCountry = get_post_meta( $post->ID, 'wbg_country', true );
        $wbgLanguage = get_post_meta( $post->ID, 'wbg_language', true );
        $wbgDimension = get_post_meta( $post->ID, 'wbg_dimension', true );
        $wbgFilesize = get_post_meta( $post->ID, 'wbg_filesize', true );
        $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
        $wbg_item_weight = get_post_meta( $post->ID, 'wbg_item_weight', true );
        ?>
                <div class="wbg-details-image">
                    <?php 
        
        if ( $wbgImgUrl ) {
            ?>
                        <img src="<?php 
            echo  esc_url( $wbgImgUrl ) ;
            ?>" alt="No Image Available">
                        <?php 
        } else {
            
            if ( has_post_thumbnail() ) {
                $feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                ?>
                        <img src="<?php 
                echo  esc_url( $feat_image ) ;
                ?>" alt="<?php 
                _e( 'No Image Available', WBG_TXT_DOMAIN );
                ?>" width="300">
                        <?php 
            } else {
                ?>
                        <img src="<?php 
                echo  esc_attr( WBG_ASSETS . 'img/noimage.jpg' ) ;
                ?>" alt="No Image Available">
                    <?php 
            }
        
        }
        
        ?>
                </div>
                <!-- Details Section Started -->
                <div class="wbg-details-summary">
                    <h5 class="wbg-details-book-title"><?php 
        the_title();
        ?></h5>
                    <?php 
        ?>
                    <?php 
        ?>
                    <?php 
        if ( $wbg_author_info ) {
            
            if ( !empty($wbgAuthor) ) {
                ?>
                            <span>
                                <b><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_author_label );
                ?>:</b>
                                <a href="<?php 
                echo  esc_url( home_url( '/' . $wbg_gallery_page_slug . '/?wbg_author_s=' . urlencode( $wbgAuthor ) ) ) ;
                ?>" class="wbg-single-link">
                                    <?php 
                esc_html_e( $wbgAuthor );
                ?>
                                </a>
                                <?php 
                ?>
                            </span>
                            <?php 
            }
        
        }
        
        if ( $wbg_display_category ) {
            ?>
                        <span>
                            <b><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;<?php 
            esc_html_e( $wbg_category_label );
            ?>:</b>
                            <?php 
            $wbgCatArray = array();
            foreach ( $wbgCategory as $cat ) {
                $wbgCatArray[] = "<a href='" . esc_url( home_url( '/' . $wbg_gallery_page_slug . '/?wbg_category_s=' . urlencode( $cat->name ) ) ) . "' class='wbg-single-link'>" . $cat->name . "</a>";
            }
            echo  implode( ', ', $wbgCatArray ) ;
            ?>
                        </span>
                        <?php 
        }
        
        if ( $wbg_display_publisher ) {
            
            if ( !empty($wbgPublisher) ) {
                ?>
                            <span>
                                <b><i class="fa fa-building-o" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_publisher_label );
                ?>:</b>
                                <?php 
                esc_html_e( $wbgPublisher );
                ?>
                            </span>
                            <?php 
            }
        
        }
        if ( $wbg_display_publish_date ) {
            
            if ( !empty($wbgPublished) ) {
                ?>
                            <span>
                                <b><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_publish_date_label );
                ?>:</b>
                                <?php 
                
                if ( 'full' === $wbg_publish_date_format ) {
                    echo  date( 'd M, Y', strtotime( $wbgPublished ) ) ;
                } else {
                    echo  date( 'Y', strtotime( $wbgPublished ) ) ;
                }
                
                ?>
                            </span>
                        <?php 
            }
        
        }
        if ( $wbg_display_isbn ) {
            
            if ( !empty($wbgIsbn) ) {
                ?>
                            <span>
                                <b><i class="fa fa-barcode" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_isbn_label );
                ?>:</b>
                                <?php 
                esc_html_e( $wbgIsbn );
                ?>
                            </span>
                            <?php 
            }
        
        }
        if ( $wbg_display_page ) {
            
            if ( !empty($wbgPages) ) {
                ?>
                        <span>
                            <b><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_page_label );
                ?>:</b>
                            <?php 
                esc_html_e( $wbgPages );
                ?>
                        </span>
                        <?php 
            }
        
        }
        if ( $wbg_display_country ) {
            
            if ( !empty($wbgCountry) ) {
                ?>
                        <span>
                            <b><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_country_label );
                ?>:</b>
                            <?php 
                esc_html_e( $wbgCountry );
                ?>
                        </span>
                        <?php 
            }
        
        }
        if ( $wbg_display_language ) {
            
            if ( !empty($wbgLanguage) ) {
                ?>
                            <span>
                                <b><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_language_label );
                ?>:</b>
                                <?php 
                esc_html_e( $wbgLanguage );
                ?>
                            </span>
                            <?php 
            }
        
        }
        if ( $wbg_display_dimension ) {
            
            if ( !empty($wbgDimension) ) {
                ?>
                            <span>
                                <b><i class="fa fa-arrows" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_dimension_label );
                ?>:</b>
                                <?php 
                esc_html_e( $wbgDimension );
                ?>
                            </span>
                            <?php 
            }
        
        }
        if ( $wbg_display_filesize ) {
            
            if ( !empty($wbgFilesize) ) {
                ?>
                            <span>
                                <b><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_filesize_label );
                ?>:</b>
                                <?php 
                esc_html_e( $wbgFilesize );
                ?>
                            </span>
                            <?php 
            }
        
        }
        ?>
                    
                    <?php 
        do_action( 'wbg_front_single_load_custom_fields_data' );
        ?>

                    <?php 
        $wbgPostTags = get_the_tags();
        $wbgTagsSeparator = ' | ';
        $wgbOutput = '';
        
        if ( !empty($wbgPostTags) ) {
            $wgbOutput .= "<span><b>" . __( 'Tags', WBG_TXT_DOMAIN ) . ":</b>";
            foreach ( $wbgPostTags as $tag ) {
                $wgbOutput .= '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a>' . $wbgTagsSeparator;
            }
            $wgbOutput .= '</span>';
            echo  trim( $wgbOutput, $wbgTagsSeparator ) ;
        }
        
        ?>
                    <span>
                    <?php 
        if ( $wbg_display_download_button ) {
            if ( !empty($wbgLink) ) {
                
                if ( $wbg_buynow_btn_txt !== '' ) {
                    
                    if ( $wbg_download_when_logged_in ) {
                        
                        if ( is_user_logged_in() ) {
                            ?>
                                      <a href="<?php 
                            echo  esc_url( $wbgLink ) ;
                            ?>" class="button wbg-btn" target="_blank"><?php 
                            esc_html_e( $wbg_buynow_btn_txt );
                            ?></a>
                                      <?php 
                        }
                        
                        /*
                        else {
                          ?>
                          <a href="<?php echo esc_url( '#' ); ?>" class="button wbg-btn"><?php _e('Login to Download', WBG_TXT_DOMAIN); ?></a>
                          <?php
                        }
                        */
                    }
                    
                    
                    if ( !$wbg_download_when_logged_in ) {
                        ?>
                                    <a href="<?php 
                        echo  esc_url( $wbgLink ) ;
                        ?>" class="button wbg-btn" target="_blank"><?php 
                        esc_html_e( $wbg_buynow_btn_txt );
                        ?></a>
                                    <?php 
                    }
                    
                    ?>
                                <?php 
                }
            
            }
        }
        ?>
                    </span>

                </div>
                
                <div class="wbg-details-description">
                    <?php 
        if ( $wbg_display_description ) {
            
            if ( !empty(get_the_content()) ) {
                ?>
                            <div class="wbg-details-description-title">
                                <b><?php 
                esc_html_e( $wbg_description_label );
                ?>:</b>
                                <hr>
                            </div>
                            <div class="wbg-details-description-content">
                                <?php 
                the_content();
                ?>
                            </div>
                            <?php 
            }
        
        }
        
        if ( null !== $wbg_gallery_page_slug ) {
            ?>
                        <a href="<?php 
            echo  esc_url( home_url( '/' . $wbg_gallery_page_slug ) ) ;
            ?>" class="button wbg-btn-back"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;<?php 
            _e( 'Back', WBG_TXT_DOMAIN );
            ?></a>
                        <?php 
        }
        
        ?>
                </div>

                <?php 
        //echo do_shortcode('[WPCR_SHOW POSTID="' . $post->ID . '" NUM="10"]');
        ?>
                
            <?php 
    }
}
?>
    </div>
    <?php 

if ( $wbg_display_sidebar ) {
    ?>
        <div class="wbg-details-column wbg-sidebar-right">
            <?php 
    dynamic_sidebar();
    ?>
        </div>
        <?php 
}

?>
</div>

<?php 
get_footer();