<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Gallery Settings Content
$wbg_details_is_external = ( $wbg_details_is_external ? ' target="_blank"' : '' );
// Gallery Settings Styling
$wbgGeneralStyling = get_option( 'wbg_general_styles' );
$wbg_loop_book_border_color = ( isset( $wbgGeneralStyling['wbg_loop_book_border_color'] ) ? $wbgGeneralStyling['wbg_loop_book_border_color'] : '#DDDDDD' );
$wbg_loop_book_bg_color = ( isset( $wbgGeneralStyling['wbg_loop_book_bg_color'] ) ? $wbgGeneralStyling['wbg_loop_book_bg_color'] : '#FFFFFF' );
$wbg_download_btn_color = ( isset( $wbgGeneralStyling['wbg_download_btn_color'] ) ? $wbgGeneralStyling['wbg_download_btn_color'] : '#0274be' );
$wbg_download_btn_font_color = ( isset( $wbgGeneralStyling['wbg_download_btn_font_color'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color'] : '#FFFFFF' );
$wbg_title_color = ( isset( $wbgGeneralStyling['wbg_title_color'] ) ? $wbgGeneralStyling['wbg_title_color'] : '#242424' );
$wbg_title_hover_color = ( isset( $wbgGeneralStyling['wbg_title_hover_color'] ) ? $wbgGeneralStyling['wbg_title_hover_color'] : '#999999' );
$wbg_title_font_size = ( isset( $wbgGeneralStyling['wbg_title_font_size'] ) ? $wbgGeneralStyling['wbg_title_font_size'] : 12 );
$wbg_description_color = ( isset( $wbgGeneralStyling['wbg_description_color'] ) ? $wbgGeneralStyling['wbg_description_color'] : '#242424' );
$wbg_description_font_size = ( isset( $wbgGeneralStyling['wbg_description_font_size'] ) ? $wbgGeneralStyling['wbg_description_font_size'] : 12 );
// Shortcoded Options
$wbg_author = '';
$wbg_language = '';
$wbgCategory = ( isset( $attr['category'] ) ? $attr['category'] : '' );
$wbgDisplay = ( isset( $attr['display'] ) ? $attr['display'] : $wbg_books_per_page );
$wbgPagination = ( isset( $attr['pagination'] ) ? $attr['pagination'] : $wbg_display_pagination );

if ( is_front_page() ) {
    $wbgPaged = ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
} else {
    $wbgPaged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
}

// Search Items
$wbg_title_s = ( isset( $_GET['wbg_title_s'] ) ? sanitize_text_field( $_GET['wbg_title_s'] ) : '' );
$wbg_category_s = ( isset( $_GET['wbg_category_s'] ) ? sanitize_text_field( $_GET['wbg_category_s'] ) : '' );
$wbg_author_s = ( isset( $_GET['wbg_author_s'] ) ? sanitize_text_field( $_GET['wbg_author_s'] ) : '' );
$wbg_publisher_s = ( isset( $_GET['wbg_publisher_s'] ) ? sanitize_text_field( $_GET['wbg_publisher_s'] ) : '' );
$wbg_published_on_s = ( isset( $_GET['wbg_published_on_s'] ) ? sanitize_text_field( $_GET['wbg_published_on_s'] ) : '' );
$wbg_language_s = ( isset( $_GET['wbg_language_s'] ) ? sanitize_text_field( $_GET['wbg_language_s'] ) : '' );
$wbg_isbn_s = ( isset( $_GET['wbg_isbn_s'] ) ? sanitize_text_field( $_GET['wbg_isbn_s'] ) : '' );
// Main Query Arguments
$wbg_front_search_query_array = array(
    'post_type'   => 'books',
    'post_status' => 'publish',
    'order'       => $wbg_books_order,
    'orderby'     => $wbg_gallary_sorting,
    'meta_query'  => array( array(
    'key'     => 'wbg_status',
    'value'   => 'active',
    'compare' => '=',
) ),
);
$wbgBooksArr = apply_filters( 'wbg_front_search_query_array', $wbg_front_search_query_array );
// If display params found in shortcode
if ( $wbgDisplay != '' ) {
    $wbgBooksArr['posts_per_page'] = $wbgDisplay;
}
// If Pagination found in shortcode
if ( $wbgPagination ) {
    $wbgBooksArr['paged'] = $wbgPaged;
}
// Sorting Operation
if ( 'title' !== $wbg_gallary_sorting && 'date' !== $wbg_gallary_sorting ) {
    $wbgBooksArr['meta_key'] = $wbg_gallary_sorting;
}
// If Category params found in shortcode
if ( $wbgCategory != '' ) {
    $wbgBooksArr['tax_query'] = array( array(
        'taxonomy' => 'book_category',
        'field'    => 'name',
        'terms'    => $wbgCategory,
    ) );
}
// Search Query
if ( '' != $wbg_title_s ) {
    $wbgBooksArr['s'] = $wbg_title_s;
}
if ( '' !== $wbg_category_s ) {
    $wbgBooksArr['tax_query'] = array( array(
        'taxonomy' => 'book_category',
        'field'    => 'name',
        'terms'    => $wbg_category_s,
    ) );
}
if ( '' != $wbg_author_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_author',
        'value'   => $wbg_author_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_language ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_language',
        'value'   => $wbg_language,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_author ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_author',
        'value'   => $wbg_author,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_publisher_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_publisher',
        'value'   => $wbg_publisher_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_isbn_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_isbn',
        'value'   => $wbg_isbn_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_language_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_language',
        'value'   => $wbg_language_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_published_on_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_published_on',
        'value'   => $wbg_published_on_s,
        'compare' => 'LIKE',
    ) );
}
// Load Styling
include WBG_PATH . 'assets/css/wbg-loop.php';
// Search Panel Started
if ( $wbg_display_search_panel ) {
    include WBG_PATH . 'front/view/search.php';
}
// Perform query and assign it to wp_query
$wbgBooks = new WP_Query( $wbgBooksArr );

if ( $wbgBooks->have_posts() ) {
    
    if ( $wbg_display_total_books ) {
        $wbg_prev_posts = ($wbgPaged - 1) * $wbgBooks->query_vars['posts_per_page'];
        $wbg_from = 1 + $wbg_prev_posts;
        $wbg_to = count( $wbgBooks->posts ) + $wbg_prev_posts;
        $wbg_of = $wbgBooks->found_posts;
        ?>
    <h2 class="wbg-total-books-title"><?php 
        _e( 'Showing', WBG_TXT_DOMAIN );
        ?> <span><?php 
        printf(
            '%s-%s of %s',
            $wbg_from,
            $wbg_to,
            $wbg_of
        );
        ?></span> <?php 
        _e( 'Books', WBG_TXT_DOMAIN );
        ?></h2>
    <?php 
    }
    
    ?>

  <div class="wbg-main-wrapper <?php 
    echo  esc_attr( 'wbg-product-column-' . $wbg_gallary_column ) ;
    ?> <?php 
    echo  esc_attr( 'wbg-product-column-mobile-' . $wbg_gallary_column_mobile ) ;
    ?>">
      <?php 
    while ( $wbgBooks->have_posts() ) {
        $wbgBooks->the_post();
        $wbgImgUrl = get_post_meta( $post->ID, 'wbgp_img_url', true );
        //apply_filters( 'wbg_image_url', $post->ID );
        ?>
          <div class="wbg-item">
            <?php 
        // Book cover and title started
        
        if ( $wbg_display_details_page ) {
            ?>
              <a class="wgb-item-link" href="<?php 
            echo  esc_url( get_the_permalink( $post->ID ) ) ;
            ?>" <?php 
            esc_attr_e( $wbg_details_is_external );
            ?>>
                <?php 
            
            if ( $wbgImgUrl ) {
                ?>
                    <img src="<?php 
                echo  esc_url( $wbgImgUrl ) ;
                ?>" alt="<?php 
                _e( 'No Image Available', WBG_TXT_DOMAIN );
                ?>" width="200">
                    <?php 
            } else {
                
                if ( has_post_thumbnail() ) {
                    //the_post_thumbnail( array( 200 ) );
                    $feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                    ?>
                    <img src="<?php 
                    echo  esc_url( $feat_image ) ;
                    ?>" alt="<?php 
                    _e( 'No Image Available', WBG_TXT_DOMAIN );
                    ?>" width="200">
                    <?php 
                } else {
                    ?>
                    <img src="<?php 
                    echo  esc_attr( WBG_ASSETS . 'img/noimage.jpg' ) ;
                    ?>" alt="<?php 
                    _e( 'No Image Available', WBG_TXT_DOMAIN );
                    ?>" width="200">
                  <?php 
                }
            
            }
            
            ?>
                <?php 
            echo  wp_trim_words( get_the_title(), $wbg_title_length, '...' ) ;
            ?>
              </a>
              <?php 
        } else {
            
            if ( $wbgImgUrl ) {
                ?>
                <img src="<?php 
                echo  esc_url( $wbgImgUrl ) ;
                ?>" alt="<?php 
                _e( 'No Image Available', WBG_TXT_DOMAIN );
                ?>" width="200">
                <?php 
            } else {
                
                if ( has_post_thumbnail() ) {
                    $feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                    ?>
                    <img src="<?php 
                    echo  esc_url( $feat_image ) ;
                    ?>" alt="<?php 
                    _e( 'No Image Available', WBG_TXT_DOMAIN );
                    ?>" width="200">
                  <?php 
                } else {
                    ?>
                <img src="<?php 
                    esc_attr_e( WBG_ASSETS . 'img/noimage.jpg' );
                    ?>" alt="<?php 
                    _e( 'No Image Available', WBG_TXT_DOMAIN );
                    ?>" width="200">
              <?php 
                }
            
            }
            
            ?>
              <h3 class="wgb-item-link"><?php 
            echo  wp_trim_words( get_the_title(), $wbg_title_length, '...' ) ;
            ?></h3>
              <?php 
        }
        
        // Book cover and title ended
        if ( '1' == $wbg_display_description ) {
            
            if ( !empty(get_the_content()) ) {
                ?>
                <div class="wbg-description-content">
                  <?php 
                echo  wp_trim_words( get_the_content(), $wbg_description_length, '...' ) ;
                ?>
                </div>
                <?php 
            }
        
        }
        
        if ( '1' == $wbg_display_category ) {
            $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array(
                'fields' => 'all',
            ) );
            
            if ( !empty($wbgCategory) ) {
                ?>
                <span>
                    <?php 
                echo  esc_html( $wbg_cat_label_txt ) ;
                ?>
                    <?php 
                $wbgCatArray = array();
                foreach ( $wbgCategory as $cat ) {
                    $wbgCatArray[] = $cat->name . '';
                }
                echo  implode( ', ', $wbgCatArray ) ;
                ?>
                </span>
                <?php 
            }
        
        }
        
        
        if ( $wbg_display_author ) {
            $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
            
            if ( '' !== $wbgAuthor ) {
                ?>
                <span>
                    <?php 
                esc_html_e( $wbg_author_label_txt ) . '&nbsp;' . esc_html_e( $wbgAuthor );
                ?>
                </span>
                <?php 
            }
        
        }
        
        ?>

            <?php 
        do_action( 'wbg_front_list_load_price' );
        ?>

            <?php 
        ?>

            <?php 
        ?>

            <?php 
        
        if ( $wbg_display_buynow ) {
            ?>
              <?php 
            $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
            if ( $wbgLink !== '' ) {
                
                if ( $wbg_buynow_btn_txt !== '' ) {
                    
                    if ( $wbg_download_when_logged_in ) {
                        
                        if ( is_user_logged_in() ) {
                            ?>
                        <a href="<?php 
                            echo  esc_url( $wbgLink ) ;
                            ?>" class="button wbg-btn" target="_blank"><?php 
                            esc_html_e( $wbg_buynow_btn_txt );
                            ?></a>
                        <?php 
                        }
                        
                        /*
                        else {
                          ?>
                          <a href="<?php echo esc_url( '#' ); ?>" class="button wbg-btn"><?php _e('Login to Download', WBG_TXT_DOMAIN); ?></a>
                          <?php
                        }
                        */
                    }
                    
                    
                    if ( !$wbg_download_when_logged_in ) {
                        ?>
                      <a href="<?php 
                        echo  esc_url( $wbgLink ) ;
                        ?>" class="button wbg-btn" target="_blank"><?php 
                        esc_html_e( $wbg_buynow_btn_txt );
                        ?></a>
                      <?php 
                    }
                
                }
            
            }
            ?>
            <?php 
        }
        
        ?>
            
            <?php 
        ?>

          </div>
          <?php 
    }
    ?>
  </div>

  <?php 
    if ( $wbgPagination ) {
        $this->loop_fotter_content( $wbgBooks->max_num_pages, $wbgPaged );
    }
} else {
    ?><p class="wbg-no-books-found"><?php 
    _e( 'No books found.', WBG_TXT_DOMAIN );
    ?></p><?php 
}

// Reset Post Data
wp_reset_postdata();