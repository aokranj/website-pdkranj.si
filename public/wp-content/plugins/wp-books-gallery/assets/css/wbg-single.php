<style type="text/css">
    a.wbg-single-link {
        color: #242424;
        text-decoration: none;
    }
    a.wbg-single-link:hover {
        color: #CC0000;
    }
    .wbg-details-summary span a.wbg-btn,
    a.wbg-btn-back {
        background: <?php esc_html_e( $wbg_download_btn_color ); ?> !important;
        color: <?php esc_html_e( $wbg_download_btn_font_color ); ?> !important;
    }

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
    }

</style>