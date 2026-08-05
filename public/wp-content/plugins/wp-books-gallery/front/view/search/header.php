<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$search_dad_list = $this->get_search_items();
// Setting up the search form url
if ( '' === $wbg_gallery_page_slug ) {
    $wbg_gallery_page_slug = 'books';
}
$wbg_gallery_page_slug = ( isset( $attr['url'] ) ? $attr['url'] : $wbg_gallery_page_slug );
// Search Items
$wbg_title_s = ( isset( $_GET['wbg_title_s'] ) ? sanitize_text_field( wp_unslash( $_GET['wbg_title_s'] ) ) : '' );
$wbg_published_on_s = ( isset( $_GET['wbg_published_on_s'] ) ? sanitize_text_field( wp_unslash( $_GET['wbg_published_on_s'] ) ) : '' );
// Search Query
if ( '' != $wbg_title_s ) {
    $wbgBooksArr['s'] = $wbg_title_s;
    // Optional: Let WordPress sort by relevancy instead of date when searching
    unset($wbgBooksArr['orderby']);
    unset($wbgBooksArr['order']);
    // NEW: Restricts the 's' keyword search strictly to the book title column
    // Works on: WordPress 6.2 or higher
    //$wbgBooksArr['search_columns'] = array( 'post_title' );
}
if ( '' != $wbg_published_on_s ) {
    $wbgBooksArr['meta_query'][] = array(
        'key'     => 'wbg_published_on',
        'value'   => $wbg_published_on_s,
        'compare' => 'LIKE',
    );
}
// Map your GET parameter keys directly to your ACF / Meta keys
$wbg_meta_filters = array(
    'wbg_author_s'    => 'wbg_author',
    'wbg_publisher_s' => 'wbg_publisher',
    'wbg_language_s'  => 'wbg_language',
    'wbg_isbn_s'      => 'wbg_isbn',
);
// Array for tax query
$wbg_tax_filters = array(
    'wbg_category_s' => 'book_category',
);
//echo '<pre>'; print_r($wbg_tax_filters);
// Loop through and automatically append to meta_query if present
foreach ( $wbg_meta_filters as $get_key => $meta_key ) {
    if ( isset( $_GET[$get_key] ) && '' !== trim( $_GET[$get_key] ) ) {
        $wbg_clean_params[$get_key] = sanitize_text_field( wp_unslash( $_GET[$get_key] ) );
        $wbgBooksArr['meta_query'][] = array(
            'key'     => $meta_key,
            'value'   => $wbg_clean_params[$get_key],
            'compare' => '=',
        );
    } else {
        $wbg_clean_params[$get_key] = '';
    }
}
foreach ( $wbg_tax_filters as $get_key => $meta_key ) {
    if ( isset( $_GET[$get_key] ) && '' !== trim( $_GET[$get_key] ) ) {
        $wbg_clean_params[$get_key] = sanitize_text_field( wp_unslash( $_GET[$get_key] ) );
        $wbgBooksArr['tax_query'][] = array(
            'taxonomy' => $meta_key,
            'field'    => 'slug',
            'terms'    => $wbg_clean_params[$get_key],
        );
    } else {
        $wbg_clean_params[$get_key] = '';
    }
}
if ( !empty( $wbg_clean_params['wbg_category_s'] ) ) {
    $wbg_authors_by_cat = "SELECT DISTINCT pm.meta_value\r\n                        FROM {$wpdb->posts} p\r\n                        LEFT JOIN {$wpdb->term_relationships} rel ON rel.object_id = p.ID\r\n                        LEFT JOIN {$wpdb->term_taxonomy} tax ON tax.term_taxonomy_id = rel.term_taxonomy_id\r\n                        LEFT JOIN {$wpdb->terms} t ON t.term_id = tax.term_id\r\n                        LEFT JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID\r\n                        WHERE post_status = 'publish'\r\n                        AND post_type = 'books'\r\n                        AND t.slug = '" . $wbg_clean_params['wbg_category_s'] . "'\r\n                        AND tax.taxonomy = 'book_category'\r\n                        AND pm.meta_key = 'wbg_author'\r\n                        ORDER BY pm.meta_value {$wbg_display_author_order}";
    $wbg_authors = $wpdb->get_results( $wbg_authors_by_cat, ARRAY_A );
} else {
    $wbg_authors = $wpdb->get_results( "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_author' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_author_order}", ARRAY_A );
}