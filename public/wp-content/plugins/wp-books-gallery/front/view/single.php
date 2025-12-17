<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// loading header
include 'single/header.php';
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
        <div id="post-<?php 
        the_ID();
        ?>" <?php 
        post_class( 'wbg-book-single-section clearfix' );
        ?>>
            
            <?php 
        ?>

            <div class="wbg-details-column wbg-details-wrapper">

                <div class="wbg-details-book-info">
                    
                    <?php 
        include 'single/before-title.php';
        ?>

                    <div class="wbg-details-summary">
                    
                        <h1 class="wbg-details-book-title"><?php 
        the_title();
        ?></h1>
                        
                        <?php 
        include 'single/book-info.php';
        if ( !$wbg_details_hide_load_more ) {
            ?>
                            <a href="#" id="wbgSingleLoadMoreDetails"><?php 
            _e( 'More Details', 'wp-books-gallery' );
            ?></a>
                            <?php 
        }
        ?>
                        <span class="wbg-single-button-container">
                            <?php 
        // Download Button
        if ( !$wbg_display_download_button ) {
            if ( !empty( $wbgLink ) ) {
                $download_icon = ( '' !== $wbg_download_btn_icon ? $wbg_download_btn_icon : 'fa-solid fa-download' );
                if ( $wbg_buynow_btn_txt !== '' ) {
                    if ( $wbg_download_when_logged_in ) {
                        if ( is_user_logged_in() ) {
                            ?>
                                                <a href="<?php 
                            echo esc_url( $wbgLink );
                            ?>" class="button wbg-btn" <?php 
                            esc_attr_e( $wbg_dwnld_btn_url_same_tab );
                            ?>>
                                                    <i class="<?php 
                            esc_attr_e( $download_icon );
                            ?>"></i>&nbsp;<?php 
                            esc_html_e( $wbg_buynow_btn_txt );
                            ?>
                                                </a>
                                                <?php 
                        } else {
                            ?>
                                                <a href="<?php 
                            echo esc_url( home_url( '/wp-login.php' ) );
                            ?>" class="button wbg-btn">
                                                    <i class="<?php 
                            esc_attr_e( $download_icon );
                            ?>"></i>&nbsp;<?php 
                            esc_html_e( $wbg_buynow_btn_txt );
                            ?>
                                                </a>
                                                <?php 
                        }
                    }
                    if ( !$wbg_download_when_logged_in ) {
                        ?>
                                            <a href="<?php 
                        echo esc_url( $wbgLink );
                        ?>" class="button wbg-btn" <?php 
                        esc_attr_e( $wbg_dwnld_btn_url_same_tab );
                        ?>>
                                                <i class="<?php 
                        esc_attr_e( $download_icon );
                        ?>"></i>&nbsp;<?php 
                        esc_html_e( $wbg_buynow_btn_txt );
                        ?>
                                            </a>
                                            <?php 
                    }
                }
            }
        }
        ?>
                        </span>
                    </div>
                </div>

                <?php 
        // Description
        if ( $wbg_display_description ) {
            if ( !empty( get_the_content() ) ) {
                ?>
                        <div class="wbg-details-description">
                            <div class="wbg-details-description-title">
                                <b><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_description_label );
                ?>:</b>
                                <hr>
                            </div>
                            <div class="wbg-details-description-content">
                                <?php 
                the_content();
                ?>
                            </div>
                        </div>
                        <?php 
            }
        }
        // Back Button
        if ( !$wbg_hide_back_button ) {
            if ( '' !== $wbg_gallery_page_slug ) {
                ?>
                        <a href="<?php 
                echo esc_url( home_url( '/' . $wbg_gallery_page_slug ) );
                ?>" class="button wbg-btn-back">
                            <i class="<?php 
                esc_attr_e( $wbg_back_button_icon );
                ?>" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_back_button_label );
                ?>
                        </a>
                        <?php 
            }
            if ( '' === $wbg_gallery_page_slug ) {
                ?>
                        <a href="#" onclick="javascript:history.back();" class="button wbg-btn-back">
                            <i class="<?php 
                esc_attr_e( $wbg_back_button_icon );
                ?>" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_back_button_label );
                ?>
                        </a>
                        <?php 
            }
        }
        ?>

            </div>
            <?php 
        // Sidebar
        if ( $wbg_display_sidebar ) {
            ?>
                <div class="wbg-details-column wbg-sidebar-right">
                    <?php 
            if ( function_exists( 'register_sidebar' ) ) {
                dynamic_sidebar( 'Books Gallery Sidebar' );
            }
            ?>
                </div>
                <?php 
        }
        ?>
        </div>
        <?php 
    }
    // while ( have_posts() ) {
}
// if ( have_posts() ) {
// Action After Main Wrapper
do_action( 'wbg_front_single_parent_section_after' );
get_footer();