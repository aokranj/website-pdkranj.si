<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$wbgiUploadMsg = '';
if ( isset( $_POST['saveSettings'] ) ) {
    
    if ( !isset( $_POST['wbg_api_import_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_api_import_nonce_field'], 'wbg_api_import_action' ) ) {
        print 'Sorry, your nonce did not verify.';
        exit;
    } else {
        
        if ( '' !== $_POST['wbg_api_isbn'] ) {
            $isbns = @explode( ",", $_POST['wbg_api_isbn'] );
            
            if ( count( $isbns ) > 0 ) {
                foreach ( $isbns as $isbn ) {
                    $isbn = trim( $isbn );
                    $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:{$isbn}";
                    $call_api = wp_remote_get( $url );
                    //0689816138
                    $data = (array) json_decode( wp_remote_retrieve_body( $call_api ) );
                    
                    if ( isset( $data['items'] ) ) {
                        //echo '<pre>';
                        //print_r( $data );
                        $data = (array) $data['items'][0];
                        $data = (array) $data['volumeInfo'];
                        $title = ( isset( $data['title'] ) ? sanitize_text_field( $data['title'] ) : '' );
                        $authors = ( isset( $data['authors'][0] ) ? sanitize_text_field( $data['authors'][0] ) : '' );
                        $categories = ( isset( $data['categories'][0] ) ? sanitize_text_field( $data['categories'][0] ) : '' );
                        $publisher = ( isset( $data['publisher'] ) ? sanitize_text_field( $data['publisher'] ) : '' );
                        $publishedDate = ( isset( $data['publishedDate'] ) ? sanitize_text_field( $data['publishedDate'] ) : '' );
                        $pageCount = ( isset( $data['pageCount'] ) ? sanitize_text_field( $data['pageCount'] ) : '' );
                        $imageLink = ( isset( $data['imageLinks']->thumbnail ) ? sanitize_text_field( $data['imageLinks']->thumbnail ) : '' );
                        $isbn13 = ( isset( $data['industryIdentifiers'][0]->identifier ) ? sanitize_text_field( $data['industryIdentifiers'][0]->identifier ) : '' );
                        $language = ( isset( $data['language'] ) ? sanitize_text_field( $data['language'] ) : '' );
                        $description = ( isset( $data['description'] ) ? sanitize_text_field( $data['description'] ) : '' );
                        $language = ( 'en' === $language ? 'English' : $language );
                        $publishedDate = ( 4 === strlen( $publishedDate ) ? $publishedDate . '-01-01' : $publishedDate );
                        /*
                        echo "ISBN-10 = " . $isbn . '<br>';
                        echo "Title = " . $title . '<br>';
                        echo "Authors = " . $authors . '<br>'; //@implode(",", $data['authors']) . '<br>';
                        echo "Categories = " . $categories . '<br>';
                        echo "Publisher = " . $publisher . '<br>';
                        echo "Published Date = " . $publishedDate . '<br>';
                        echo "Pages = " . $pageCount . '<br>';    
                        echo "Images = " . $imageLink . '<br>';   
                        echo "ISBN-13 = " . $isbn13 . '<br>';    
                        echo "Language = " . $language . '<br>';  
                        echo "Description = " . $description . '<br>';
                        */
                        $post_arr = array(
                            'post_type'    => 'books',
                            'post_title'   => $title,
                            'post_content' => $description,
                            'post_status'  => 'publish',
                            'post_author'  => get_current_user_id(),
                            'meta_input'   => array(
                            'wbg_status'         => 'active',
                            'wbg_author'         => $authors,
                            'wbg_publisher'      => $publisher,
                            'wbg_published_on'   => $publishedDate,
                            'wbg_isbn'           => $isbn,
                            'wbg_pages'          => $pageCount,
                            'wbg_country'        => '',
                            'wbg_language'       => $language,
                            'wbg_dimension'      => '',
                            'wbg_filesize'       => '',
                            'wbg_download_link'  => '',
                            'wbgp_buy_link'      => '',
                            'wbg_co_publisher'   => '',
                            'wbg_isbn_13'        => $isbn13,
                            'wbgp_regular_price' => '',
                            'wbgp_sale_price'    => '',
                            'wbg_item_weight'    => '',
                            'wbgp_img_url'       => $imageLink,
                        ),
                        );
                        $post_exists = post_exists(
                            $title,
                            '',
                            '',
                            'books'
                        );
                        
                        if ( !$post_exists ) {
                            $post_id = wp_insert_post( $post_arr );
                            
                            if ( !is_wp_error( $post_id ) ) {
                                wp_set_object_terms( $post_id, [ $categories ], 'book_category' );
                            } else {
                                //there was an error in the post insertion,
                                $wbgiUploadMsg = $post_id->get_error_message();
                            }
                        
                        }
                    
                    } else {
                        $wbgiUploadMsg = __( "ISBN {$isbn} not found!", WBG_TXT_DOMAIN );
                    }
                
                }
                $wbgiUploadMsg = __( 'Import Books Successful', WBG_TXT_DOMAIN );
            }
        
        }
    
    }

}
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-download" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Import Books From API', WBG_TXT_DOMAIN );
?></h2>
    </div>

    <?php 
if ( $wbgiUploadMsg ) {
    $this->wbg_display_notification( 'info', $wbgiUploadMsg );
}
?>
    <br>
    <div class="wbg-wrap">

        <div class="wbg_personal_wrap wbg_personal_help" style="width: 75%; float: left;">
        
            <form name="wbg_api_import_form" role="form" class="form-horizontal" method="post" action="" id="wbg-api-import-form">
            <?php 
wp_nonce_field( 'wbg_api_import_action', 'wbg_api_import_nonce_field' );
?>
            <table class="wbg-general-settings-table">
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Provide Your ISBN', WBG_TXT_DOMAIN );
?>:</label>
                    </th>
                    <td>
                    <?php 
?>
                            <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                            <?php 
?>
                    </td>
                </tr>
            </table>
            <p class="submit"><input type="submit" id="saveSettings" name="saveSettings"
                    class="button button-primary wbg-button" value="<?php 
_e( 'Import Books', WBG_TXT_DOMAIN );
?>"></p>
            </form>

        </div>

        <?php 
include_once 'partial/admin-sidebar.php';
?> 

    </div>

</div>