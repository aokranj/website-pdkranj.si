<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( $wbg_hide_book_cover ) {
    $feat_image = '';
    echo '<style type="text/css">.wbg-main-wrapper .wbg-item a.wgb-item-link { min-height:40px!important; padding-top: 20px; }</style>';
}
?>
<div class="wbg-item">
    <?php 
// Book cover and title started
if ( !$wbg_display_details_page ) {
    ?>
        <a class="wgb-item-link" href="<?php 
    echo esc_url( get_the_permalink( $post->ID ) );
    ?>" target="_<?php 
    esc_attr_e( $wbg_details_is_external );
    ?>">
            <?php 
    echo $feat_image;
    ?>
            <?php 
    echo wp_trim_words( get_the_title(), $wbg_title_length, '...' );
    ?>
        </a>
        <?php 
} else {
    echo $feat_image;
    ?>
        <h3 class="wgb-item-link" data-post_id="<?php 
    esc_attr_e( $post->ID );
    ?>"><?php 
    echo wp_trim_words( get_the_title(), $wbg_title_length, '...' );
    ?></h3>
        <?php 
}
// Book cover and title ended
// Description
if ( '1' == $wbg_display_description ) {
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
// Category
if ( '1' == $wbg_display_category ) {
    $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array(
        'fields' => 'all',
    ) );
    if ( !empty( $wbgCategory ) ) {
        ?>
            <span class="loop-category">
                <?php 
        echo esc_html( $wbg_cat_label_txt ) . '&nbsp;';
        $wbgCatArray = [];
        foreach ( $wbgCategory as $cat ) {
            $cat_url = '?wbg_category_s=' . urlencode( $cat->name );
            $wbgCatArray[] = '<a href="' . esc_url( $cat_url ) . '" class="wbg-list-author">' . esc_html( $cat->name ) . '</a>';
        }
        echo implode( ', ', $wbgCatArray );
        ?>
            </span>
            <?php 
    }
}
// Author
if ( $wbg_display_author ) {
    $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
    if ( '' !== $wbgAuthor ) {
        $author_url = '?wbg_author_s=' . urlencode( $wbgAuthor );
        ?>
            <span class="loop-author">
                <?php 
        $wbgAuthorArray = [];
        esc_html_e( $wbg_author_label_txt );
        $wbgAuthorArray[] = '<a href="' . esc_url( $author_url ) . '" class="wbg-single-link">' . esc_html( $wbgAuthor ) . '</a>';
        if ( !empty( $wbgAuthorArray ) ) {
            echo "&nbsp;" . implode( ", ", $wbgAuthorArray );
        }
        ?>
            </span>
            <?php 
    }
}
do_action( 'wbg_front_list_load_price' );
?>
    <!-- Button Panel -->
    <div class="wbg-button-container">
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