<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// If display params found in shortcode
if ( $wbgDisplay != '' ) {
    $wbgBooksArr['posts_per_page'] = $wbgDisplay;
}
// If Pagination found in shortcode
if ( $wbgPagination ) {
    $wbgBooksArr['paged'] = $wbgPaged;
}
// Order by
$wbg_orderby_arr = ['wbg_published_on', 'wbg_publisher'];
if ( in_array( $wbg_gallary_sorting, $wbg_orderby_arr ) ) {
    $wbgBooksArr['orderby'] = 'meta_value meta_value_num';
    $wbgBooksArr['meta_key'] = $wbg_gallary_sorting;
}
if ( !in_array( $wbg_gallary_sorting, $wbg_orderby_arr ) ) {
    $wbgBooksArr['orderby'] = $wbg_gallary_sorting;
    $wbgBooksArr['order'] = $wbg_books_order;
}
// If Category params found in shortcode
if ( !empty( $wbgCategory ) ) {
    $wbgBooksArr['tax_query'] = array(array(
        'taxonomy' => 'book_category',
        'field'    => 'name',
        'terms'    => $wbgCategory,
    ));
}
// For Template Category
if ( is_tax( 'book_category' ) ) {
    $wbg_archive_cat_slug = ( isset( get_queried_object()->slug ) ? get_queried_object()->slug : '' );
    if ( $wbg_archive_cat_slug != '' ) {
        $wbgBooksArr['tax_query'] = array(array(
            'taxonomy' => 'book_category',
            'field'    => 'slug',
            'terms'    => $wbg_archive_cat_slug,
        ));
    }
}
// For Template Tag
if ( is_tag() ) {
    $wbg_tag_for_temp = ( isset( get_queried_object()->slug ) ? get_queried_object()->slug : '' );
    if ( '' !== $wbg_tag_for_temp ) {
        $wbgBooksArr['tag'] = $wbg_tag_for_temp;
    }
}