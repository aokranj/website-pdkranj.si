<style type="text/css">
  .wbg-search-container .wbg-search-item .submit-btn {
    background: <?php echo esc_html( $wbg_btn_color ); ?>;
    border: 1px solid <?php echo esc_html( $wbg_btn_border_color ); ?>;
    color: <?php echo esc_html( $wbg_btn_font_color ); ?>;
  }
  .wbg-main-wrapper .wbg-item {
    border: 1px solid <?php esc_html_e( $wbg_loop_book_border_color ); ?>;
    background-color: <?php esc_html_e( $wbg_loop_book_bg_color ); ?>;
  }
  .wbg-main-wrapper .wbg-item img {
    width: <?php echo ( 'full' === $wbg_book_cover_width ) ? '100%' : 'auto'; ?> !important;
    height: <?php echo ( 'full' === $wbg_book_cover_width ) ? 'auto' : '150px'; ?> !important;
  }
  .wbg-main-wrapper .wbg-item img:hover {
    <?php
    if ( 'rotate-360' === $wbg_book_image_animation ) {
      ?>
      -webkit-animation: rotation 0.8s  linear;
      <?php
    }
    if ( 'flip' === $wbg_book_image_animation ) {
      ?>
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
      <?php
    }
    ?>
  }
  .wbg-main-wrapper .wbg-item a.wbg-btn {
    background: <?php esc_html_e( $wbg_download_btn_color ); ?> !important;
    color: <?php esc_html_e( $wbg_download_btn_font_color ); ?> !important;
  }
  .wbg-main-wrapper .wbg-item .wgb-item-link {
    color: <?php esc_html_e( $wbg_title_color ); ?> !important;
    font-size: <?php esc_html_e( $wbg_title_font_size ); ?>px !important;
  }
  .wbg-main-wrapper .wbg-item .wgb-item-link:hover {
    color: <?php esc_html_e( $wbg_title_hover_color ); ?> !important;
  }
  .wbg-main-wrapper .wbg-item .wbg-description-content {
    font-size: <?php esc_html_e( $wbg_description_font_size ); ?>px !important;
    color: <?php esc_html_e( $wbg_description_color ); ?> !important;
  }

  @-webkit-keyframes rotation {
        from {
                -webkit-transform: rotate(0deg);
        }
        to {
                -webkit-transform: rotate(360deg);
        }
  }
</style>