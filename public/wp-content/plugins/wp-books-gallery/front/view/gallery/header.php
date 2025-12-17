<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$wbg_search_settings = get_option( 'wbg_search_settings' );
if ( empty( $wbg_search_settings ) ) {
    $wbg_display_search_panel = 1;
    $wbg_display_search_title = 1;
    $wbg_display_search_isbn = 1;
    $wbg_display_search_category = 1;
    $wbg_display_search_author = 1;
}
$wbg_general_settings = get_option( 'wbg_general_settings' );
if ( empty( $wbg_general_settings ) ) {
    $wbg_display_description = 1;
    $wbg_display_category = 1;
    $wbg_display_author = 1;
    $wbg_display_buynow = 1;
}
$wbgpCurrencySymbol = $this->wbg_get_currency_symbol( $wbgp_currency );
// Load Styling
include WBG_PATH . 'assets/css/search.php';
include WBG_PATH . 'assets/css/gallery.php';
// Gallery Settings Content
$wbg_details_is_external = ( $wbg_details_is_external ? 'blank' : 'self' );
$wbg_dwnld_btn_url_same_tab = ( !$wbg_dwnld_btn_url_same_tab ? 'target="_blank"' : '' );
// Shortcoded Options
$wbg_author = '';
$wbg_language = '';
$wbgCategory = ( isset( $attr['category'] ) ? explode( ",", $attr['category'] ) : [] );
$wbgDisplay = ( isset( $attr['isdisplay'] ) ? $attr['isdisplay'] : $wbg_books_per_page );
$wbgPagination = ( isset( $attr['ispagination'] ) ? $attr['ispagination'] : $wbg_display_pagination );
// true/0
$wbgLayout = ( isset( $attr['layout'] ) ? $attr['layout'] : 'grid' );