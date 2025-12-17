<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<style type="text/css">
    .wbg-book-single-section {
        background: <?php 
esc_attr_e( $wbg_single_container_bg_color );
?> !important;
    }
    .wbg-details-wrapper {
        <?php 
if ( $wbg_display_sidebar ) {
    ?>
            width: -webkit-calc(100% - 340px);
            width: -moz-calc(100% - 340px);
            width: calc(100% - 340px);
            <?php 
} else {
    ?>
            width: 100%;
            <?php 
}
?>
        min-height: 100px;
    }
    .wbg-single-subtitle {
        margin-bottom: 10px;
        font-size: 18px;
        font-style: italic;
    }
    a.wbg-single-link {
        color: #242424;
        text-decoration: none;
    }
    .wbg-details-wrapper .wbg-details-summary .wbg-single-book-info a.wbg-single-link:hover {
        color: <?php 
esc_attr_e( $wbg_single_anchor_hv_color );
?>;
    }
    .wbg-details-summary .wbg-single-button-container a.button.wbg-btn,
    .wbg-details-wrapper a.button.wbg-btn-back {
        display: inline-block;
    }
    .wbg-details-summary .wbg-single-button-container a.button.wbg-btn:hover {
        background: <?php 
esc_attr_e( $wbg_download_btn_color_hvr );
?> !important;
        color: <?php 
esc_attr_e( $wbg_download_btn_font_color_hvr );
?> !important;
    }
    .wbg-details-wrapper a.button.wbg-btn-back:hover {
        background: <?php 
esc_attr_e( $wbg_back_btn_bg_color_hvr );
?> !important;
        color: <?php 
esc_attr_e( $wbg_back_btn_font_color_hvr );
?> !important;
    }
    .wbg-details-wrapper .wbg-details-summary .wbg-single-book-info b .fa,
    .wbg-details-wrapper .wbg-details-summary .wbg-single-book-info b .fa-solid {
        width: 25px;
        text-align: center;
    }
    <?php 
if ( $wbg_enable_rtl ) {
    ?>
        .wbg-details-wrapper .wbg-details-summary {
            padding-right: 70px;
        }

        .wbg-details-wrapper .wbg-details-image {
            margin-right: 0!important;
        }
        <?php 
}
?>

    @media only screen and (max-width: 1024px) and (min-width: 768px) {
        .wbg-details-wrapper {
            width: 100%;
            float: none;
            padding-right: 0;
        }
    }

    @media only screen and (max-width: 767px) {
        .wbg-details-wrapper {
            width: 100%;
            float: none;
            padding-right: 0;
        }
        .wbg-sidebar-right {
            display: block;
            width: 300px;
            margin: 0 auto;
        }
        <?php 
if ( $wbg_enable_rtl ) {
    ?>
            .wbg-details-wrapper .wbg-details-book-info .wbg-details-image {
                text-align: right;
            }
            <?php 
}
if ( $wbg_single_display_search_mobile ) {
    ?>
            .wbg-book-single-section form#wbg-search-form {
                display: none;
            }
            <?php 
}
?>
    }

</style>