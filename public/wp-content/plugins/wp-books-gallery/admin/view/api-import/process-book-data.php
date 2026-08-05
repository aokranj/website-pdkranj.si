<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$inserted_books = 0;
$author_count = 0;

foreach ( $books as $book ) {

    $title = isset( $book['title'] ) ? sanitize_text_field( $book['title'] ) : '';
    $weight = isset( $book['weight'] ) ? sanitize_text_field( $book['weight'] ) : '';

    if ( 'gb' === $wbg_api_from ) {

        $description = isset( $book['description'] ) ? sanitize_text_field( $book['description'] ) : '';
        $authors = isset( $book['authors'] ) ? $book['authors'] : [];
        $primary_author = isset( $authors[0] ) ? sanitize_text_field( $authors[0] ) : '';
        $categories = isset( $book['categories'][0] ) ? sanitize_text_field( $book['categories'][0] ) : '';
        $publisher = isset( $book['publisher'] ) ? sanitize_text_field( $book['publisher'] ) : '';
        $pageCount = isset( $book['pageCount'] ) ? sanitize_text_field( $book['pageCount'] ) : '';
        $imageLink = isset( $book['imageLinks']['thumbnail'] ) ? sanitize_text_field( $book['imageLinks']['thumbnail'] ) : '';
        $isbn10 = isset( $book['isbn_10'][0] ) ? sanitize_text_field( $book['isbn_10'][0] ) : '';
        $isbn13 = isset( $book['industryIdentifiers'][0]['identifier'] ) ? sanitize_text_field( $book['industryIdentifiers'][0]['identifier'] ) : '';
        $publishedDate = isset( $book['publishedDate'] ) ? sanitize_text_field( $book['publishedDate'] ) : '';
        $publishedDate = ( 4 === strlen( $publishedDate ) ) ? $publishedDate . '-01-01' : $publishedDate;
        $language = isset( $book['language'] ) ? sanitize_text_field( $book['language'] ) : '';
        $language = ('en' === $language) ? 'English' : $language;
        $edition = isset( $book['edition_name'] ) ? sanitize_text_field( $book['edition_name'] ) : '';
        $formats = isset( $book['physical_format'] ) ? $book['physical_format'] : [];
        $dimension = isset( $book['physical_dimensions'] ) ? $book['physical_dimensions'] : '';
    }

    if ( 'ol' === $wbg_api_from ) {

        $description = isset( $book['description']['value'] ) ? sanitize_text_field( $book['description']['value'] ) : '';
        $authors = isset( $book['authors'] ) ? $book['authors'] : [];
        $primary_author = isset( $authors[0]['name'] ) ? sanitize_text_field( $authors[0]['name'] ) : '';
        $categories = isset( $book['subjects'] ) ? sanitize_text_field( $book['subjects'][0] ) : '';
        $publisher = isset( $book['publishers'][0] ) ? sanitize_text_field( $book['publishers'][0] ) : '';
        $pageCount = isset( $book['number_of_pages'] ) ? sanitize_text_field( $book['number_of_pages'] ) : '';
        $imageLink = sanitize_url( "http://covers.openlibrary.org/b/isbn/{$isbn}-L.jpg" );
        $isbn10 = isset( $book['isbn_10'][0] ) ? sanitize_text_field( $book['isbn_10'][0] ) : '';
        $isbn13 = isset( $book['isbn_13'][0] ) ? sanitize_text_field( $book['isbn_13'][0] ) : '';
        $publishedDate = isset( $book['publish_date'] ) ? sanitize_text_field( $book['publish_date'] ) : '';
        $publishedDate = ( 4 === strlen( $publishedDate ) ) ? $publishedDate . '-01-01' : date( 'Y-m-d', strtotime( $publishedDate ) );
        $language = isset( $book['languages'][0]['key'] ) ? sanitize_text_field( $book['languages'][0]['key'] ) : '';
        $language = ('/languages/eng' == $language) ? 'English' : $language;
        $edition = isset( $book['edition_name'] ) ? sanitize_text_field( $book['edition_name'] ) : '';
        $formats = isset( $book['physical_format'] ) ? $book['physical_format'] : [];
        $dimension = isset( $book['physical_dimensions'] ) ? $book['physical_dimensions'] : '';
    }


    if ( ! empty( $title ) ) {

        $post_arr = array(
            'post_type'		=> 'books',
            'post_title'   	=> $title,
            'post_content' 	=> $description,
            'post_status'  	=> 'publish',
            'post_author'  	=> get_current_user_id(),
            'meta_input'   => array(
                'wbg_status' 		=> 'active',
                'wbg_author'		=> $primary_author,
                'wbg_publisher'		=> $publisher,
                'wbg_published_on'	=> $publishedDate,
                'wbg_isbn' 			=> $isbn10,
                'wbg_pages'			=> $pageCount,
                'wbg_country' 		=> '',
                'wbg_language' 		=> $language,
                'wbg_filesize' 		=> '',
                'wbg_download_link'	=> '',
                'wbgp_buy_link'		=> '',
                'wbg_co_publisher'	=> '',
                'wbg_isbn_13' 		=> $isbn13,
                'wbgp_regular_price' => '',
                'wbgp_sale_price' 	=> '',
                'wbg_item_weight' 	=> $weight,
                'wbgp_img_url' 		=> $imageLink,
                'wbg_edition' 		=> $edition,
                'wbg_dimension'     => $dimension,
            ),
        );

        $post_id = wp_insert_post( $post_arr );

        if ( ! is_wp_error( $post_id ) ) {

            if ( ! empty( $categories ) ) {
                wp_set_object_terms( $post_id, [$categories], 'book_category' );
            }
            
            if ( ! empty( $authors ) ) {

                foreach ( $authors as $author ) {
                    
                    $author = ( 'gb' === $wbg_api_from ) ? $author : $author['name'];
                    wp_set_object_terms( $post_id, $author, 'book_author', true );
                    $author_count++;
                }
            }

            if ( ! empty( $formats ) ) {
                wp_set_object_terms( $post_id, [$formats], 'book_format' );
            }
        }

    } // if ( ! empty( $title ) ) {

    $inserted_books++;
}
?>