<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<style type="text/css">
/* Search Panel */
.wbg-search-container {
    background: <?php esc_html_e( $wbg_search_panel_bg_color ); ?>;
    border: <?php esc_html_e( $wbg_search_panel_border_width ); ?>px solid <?php esc_html_e( $wbg_search_panel_border_color ); ?>;
    border-radius: <?php esc_html_e( $wbg_search_panel_border_radius ); ?>px;
    margin-top: <?php esc_html_e( $wbg_search_panel_margin_top ); ?>px;
    margin-bottom: <?php esc_html_e( $wbg_search_panel_margin_btm ); ?>px;
}
/* Search Input */
.wbg-search-container .wbg-search-item input[type="text"],
.selectize-control.single .selectize-input,
.selectize-dropdown [data-selectable].option {
    background-color: <?php esc_html_e( $wbg_search_panel_input_bg_color ); ?>;
    color: <?php esc_html_e( $wbg_search_input_font_color ); ?>!important;
    font-size: <?php esc_html_e( $wbg_search_input_font_size ); ?>px;
}
.selectize-input input {
    color: <?php esc_html_e( $wbg_search_input_font_color ); ?>!important;
}

.selectize-dropdown [data-selectable].option {
    cursor: pointer;
    border-bottom: 1px solid #EEE;
    padding-bottom: 5px;
}
/* Search Button */
.wbg-search-container .wbg-search-item .submit-btn {
    background: <?php echo esc_html( $wbg_btn_color ); ?>;
    border: 1px solid <?php echo esc_html( $wbg_btn_border_color ); ?>;
    color: <?php echo esc_html( $wbg_btn_font_color ); ?>;
    font-size: <?php esc_html_e( $wbg_search_btn_font_size ); ?>px;
    font-weight: <?php esc_html_e( $wbg_search_btn_font_weight ); ?>;
}
.wbg-search-container .wbg-search-item .submit-btn:hover {
    background: <?php echo esc_html( $wbg_search_btn_bg_color_hover ); ?>;
    color: <?php echo esc_html( $wbg_search_font_color_hover ); ?>;
}
/* Search Reset Button */
.wbg-search-container .wbg-search-item a#wbg-search-refresh {
    background: <?php echo esc_html( $wbg_search_reset_bg_color ); ?>;
    border: 1px solid <?php echo esc_html( $wbg_search_reset_border_color ); ?>;
    color: <?php echo esc_html( $wbg_search_reset_font_color ); ?>;
    width: <?php esc_html_e( $wbg_reset_btn_width ); ?>px;
    font-size: <?php esc_html_e( $wbg_reset_btn_font_size ); ?>px;
}
.wbg-search-container .wbg-search-item a#wbg-search-refresh:hover {
    background: <?php echo esc_html( $wbg_search_reset_bg_color_hvr ); ?>;
    color: <?php echo esc_html( $wbg_search_reset_font_color_hvr ); ?>;
    border: 1px solid <?php echo esc_html( $wbg_search_reset_border_color_hvr ); ?>;
}
</style>