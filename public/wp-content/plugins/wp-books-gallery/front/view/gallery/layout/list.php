<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $wbg_hide_book_cover ) {
    echo '<style type="text/css">.wbg-main-wrapper.list .wbg-item-list-wrapper { grid-template-columns: 100% 1fr; }</style>';
}
?>
<div class="wbg-item-list-wrapper">

    <?php 
if ( !$wbg_hide_book_cover ) {
    ?>
        <div class="wbg-item-list-img">
            <?php 
    echo $feat_image;
    ?>
        </div>
        <?php 
}
?>
    <div class="wbg-item-list-detials">
        <div class="wbg-title">
            <?php 
if ( !$wbg_display_details_page ) {
    ?>
            <a class="wgb-item-link" href="<?php 
    echo esc_url( get_the_permalink( $post->ID ) );
    ?>" <?php 
    esc_attr_e( $wbg_details_is_external );
    ?>>
                <?php 
    echo wp_trim_words( get_the_title(), $wbg_title_length, '...' );
    ?>
            </a>
            <?php 
} else {
    ?>
            <h3 class="wgb-item-link" data-post_id="<?php 
    esc_attr_e( $post->ID );
    ?>"><?php 
    echo wp_trim_words( get_the_title(), $wbg_title_length, '...' );
    ?></h3>
            <?php 
}
?>
        </div>

        <div class="wbg-rating">
            <?php 
?>
        </div>
        <?php 
do_action( 'wbg_front_list_load_price' );
// Display Author
if ( $wbg_display_author ) {
    $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
    $wbg_author_term = get_term_by( 'name', $wbgAuthor, 'book_author' );
    $wbg_author_slug = ( !empty( $wbg_author_term ) ? $wbg_author_term->slug : '' );
    if ( '' !== $wbgAuthor ) {
        ?>
                <span class="loop-author">
                    <?php 
        $wbg_author_term = get_term_by( 'name', $wbgAuthor, 'book_author' );
        $wbg_author_slug = ( !empty( $wbg_author_term ) ? $wbg_author_term->slug : '' );
        //echo esc_html( $wbg_author_label_txt ) . '&nbsp;' . esc_html( $wbgAuthor );
        ?>
                    <?php 
        esc_html_e( $wbg_author_label_txt );
        ?>
                    <a href="<?php 
        echo esc_url( home_url( '/book-author/' . $wbg_author_slug ) );
        ?>" class="wbg-list-author">
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
// Display Category
if ( $wbg_display_category ) {
    $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array(
        'fields' => 'all',
    ) );
    if ( !empty( $wbgCategory ) ) {
        ?>
                <span class="loop-category">
                    <?php 
        echo esc_html( $wbg_cat_label_txt );
        ?>
                    <?php 
        $wbgCatArray = array();
        foreach ( $wbgCategory as $cat ) {
            //$wbgCatArray[] = $cat->name . '';
            $wbgCatArray[] = '<a href="' . esc_url( home_url( '/book-category/' . urlencode( $cat->slug ) ) ) . '" class="wbg-list-cat">' . $cat->name . '</a>';
        }
        echo implode( ', ', $wbgCatArray );
        ?>
                </span>
                <?php 
    }
}
// Display Description
if ( $wbg_display_description ) {
    if ( !empty( get_the_content() ) ) {
        ?>
                <div class="wbg-description-content">
                    <?php 
        echo force_balance_tags( html_entity_decode( wp_trim_words( htmlentities( wpautop( get_the_content() ) ), $wbg_description_length, '...' ) ) );
        ?>
                </div>
                <?php 
    }
}
?>
        <div class="wbg-button-container-loop">
            <?php 
if ( $wbg_display_buynow ) {
    $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
    if ( $wbgLink !== '' ) {
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
        </div>
    </div>
</div>