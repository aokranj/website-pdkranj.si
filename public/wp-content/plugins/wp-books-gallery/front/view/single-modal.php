<?php

# Silence is golden.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$post_id = ( isset( $_POST['postId'] ) ? sanitize_text_field( wp_unslash( $_POST['postId'] ) ) : '' );
// loading header
include 'single/header.php';
$post = get_post( $post_id );
if ( $post ) {
    ?>
    <style type="text/css">
        .wbg-details-wrapper .wbg-details-book-info .wbg-details-summary .wbg-single-book-info {
            display: block;
        }
    </style>
    <div class="wbg-book-single-section clearfix modal">
        
        <div class="wbg-details-column wbg-details-wrapper">
            
            <div class="wbg-details-book-info">
                
                <?php 
    include 'single/before-title.php';
    ?>

                <div class="wbg-details-summary">

                    <h1 class="wbg-details-book-title"><?php 
    echo $post->post_title;
    ?></h1>
                
                    <?php 
    include 'single/book-info.php';
    include 'single/buttons.php';
    ?>
                </div>
            </div>

            <?php 
    // Description
    if ( $wbg_display_description ) {
        if ( !empty( $post->post_content ) ) {
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
            echo $post->post_content;
            ?>
                        </div>
                    </div>
                    <?php 
        }
    }
    ?>

        </div>
        
    </div>
    <?php 
} else {
    _e( 'Nothing found!', 'wp-books-gallery' );
}