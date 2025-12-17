<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Front Sorting Operation
// Sorting Operation
$wbg_orderby_arr = ['title', 'date', 'rand'];
if ( ! in_array( $wbg_gallary_sorting, $wbg_orderby_arr ) ) {
  $wbgBooksArr['meta_key'] = $wbg_gallary_sorting;
}
if ( isset( $_GET['orderby'] ) && ( $_GET['orderby'] === 'price-asc' ) ) {
  $wbgBooksArr['meta_key'] = 'wbgp_regular_price';
  $wbgBooksArr['orderby'] = 'meta_value_num';
  $wbgBooksArr['meta_type'] = 'DECIMAL';
  $wbgBooksArr['order'] = 'ASC';
}
if ( isset( $_GET['orderby'] ) && ( $_GET['orderby'] === 'price-desc' ) ) {
  $wbgBooksArr['meta_key'] = 'wbgp_regular_price';
  $wbgBooksArr['orderby'] = 'meta_value_num';
  $wbgBooksArr['meta_type'] = 'DECIMAL';
  $wbgBooksArr['order'] = 'DESC';
}
if ( isset( $_GET['orderby'] ) && ( $_GET['orderby'] === 'date-desc' ) ) {
  $wbgBooksArr['orderby'] = 'date';
  $wbgBooksArr['order'] = 'DESC';
  $wbgBooksArr['suppress_filters'] = true;
}
if ( isset( $_GET['orderby'] ) && ( $_GET['orderby'] === 'date-asc' ) ) {
  $wbgBooksArr['orderby'] = 'date';
  $wbgBooksArr['order'] = 'ASC';
  $wbgBooksArr['suppress_filters'] = true;
}
if ( isset( $_GET['orderby'] ) && ( $_GET['orderby'] === 'title-asc' ) ) {
  $wbgBooksArr['orderby'] = 'title';
  $wbgBooksArr['order'] = 'ASC';
  $wbgBooksArr['suppress_filters'] = true;
}
if ( isset( $_GET['orderby'] ) && ( $_GET['orderby'] === 'title-desc' ) ) {
  $wbgBooksArr['orderby'] = 'title';
  $wbgBooksArr['order'] = 'DESC';
  $wbgBooksArr['suppress_filters'] = true;
}
if ( isset( $_GET['orderby'] ) && ( $_GET['orderby'] === 'default' ) ) {
  $wbgBooksArr['orderby'] = $wbg_gallary_sorting;
  $wbgBooksArr['order'] = $wbg_books_order;
  $wbgBooksArr['suppress_filters'] = true;
}
?>