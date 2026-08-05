<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wbgiUploadMsg = '';
$wbg_api_from = 'gb';
$title = '';
$url = '';
$existed_books = 0;
$imported_books = 0;
$inserted_books = 0;

$wbgCoreSettings = get_option('wbg_core_settings');

if ( ! empty( $wbgCoreSettings ) ) {
    $apiKey = ( isset( $wbgCoreSettings['wbg_google_api_key'] ) ) ? sanitize_text_field( $wbgCoreSettings['wbg_google_api_key'] ) : '';
}

if ( isset( $_POST['saveSettings'] ) && current_user_can('manage_options') ) {

    if ( ! isset( $_POST['wbg_api_import_nonce_field'] ) 
        || ! wp_verify_nonce( $_POST['wbg_api_import_nonce_field'], 'wbg_api_import_action' ) ) {

        print 'Sorry, your nonce did not verify.';
        exit;

    } else {

        if ( '' !== $_POST['wbg_api_isbn'] ) {

            $wbg_api_from = isset( $_POST['wbg_api_from'] ) ? sanitize_text_field( $_POST['wbg_api_from'] ) : '';

            if ( '' === $wbg_api_from ) {

                $wbgiUploadMsg = __("No API source selected", 'wp-books-gallery');
                return $wbgiUploadMsg;
            }

            if ( ( 'gb' === $wbg_api_from ) && empty( $apiKey ) ) {

                $wbgiUploadMsg = __("No Google API Key Found!", 'wp-books-gallery');
                return $wbgiUploadMsg;
            }

            $isbns = @explode(",", $_POST['wbg_api_isbn']);

            $books = [];

            if ( count( $isbns ) > 0 ) {
    
                foreach ( $isbns as $isbn ) {
    
                    $isbn = trim( $isbn );

                    $check_existed_books = get_posts([
                        'post_type' => 'books',
                        'posts_per_page' => 1,
                        'meta_query'     => array(
                            'relation' => 'OR',
                            array(
                                'key'     => 'wbg_isbn',
                                'value'   => $isbn,
                                'compare' => '='
                            ),
                            array(
                                'key'     => 'wbg_isbn_13',
                                'value'   => $isbn,
                                'compare' => '='
                            )
                        )
                    ]);
                    
                    if ( empty( $check_existed_books ) ) {

                        include 'api-data.php';

                    } else {
                        $existed_books++;
                    }
                }

                //echo '<pre>';
                //print_r($books);
                
                if ( count( $books ) > 0 ) {

                    $imported_books = count( $books );

                    include 'process-book-data.php';
                }

                $wbgiUploadMsg = __("Books Imported = {$imported_books}, Inserted = {$inserted_books}, Alreay Existed = {$existed_books}", 'wp-books-gallery');
            }

        } else {
            $wbgiUploadMsg = __('No ISBN Provided!', 'wp-books-gallery');
        }
    }
}
?>