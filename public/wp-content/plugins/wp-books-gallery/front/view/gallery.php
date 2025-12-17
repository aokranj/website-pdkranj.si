<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
include 'gallery/header.php';
if ( is_front_page() ) {
    $wbgPaged = ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
} else {
    $wbgPaged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
}
// Main Query Arguments
$wbg_front_search_query_array = array(
    'post_type'   => 'books',
    'post_status' => 'publish',
    'meta_query'  => array(
        'relation' => 'AND',
        array(
            'key'     => 'wbg_status',
            'value'   => 'active',
            'compare' => '=',
        ),
    ),
    'tax_query'   => array(
        'relation' => 'AND',
    ),
);
$wbgBooksArr = apply_filters( 'wbg_front_search_query_array', $wbg_front_search_query_array );
include 'gallery/main-query.php';
include 'gallery/sorting.php';
//echo '<pre>';
//print_r($wbgBooksArr);
?>
<div class="wbg-parent-wrapper">
  <?php 
// Search Panel Started
if ( $wbg_display_search_panel ) {
    include WBG_PATH . 'front/view/search.php';
}
// Main Query
$wbgBooks = new WP_Query($wbgBooksArr);
if ( $wbgBooks->have_posts() ) {
    include 'gallery/sorting-view-mode.php';
    ?>
    <div class="wbg-main-wrapper <?php 
    echo 'wbg-product-column-' . esc_attr( $wbg_gallary_column ) . ' wbg-product-column-mobile-' . esc_attr( $wbg_gallary_column_mobile );
    ?> <?php 
    echo ( 'list' !== $wbg_gallary_template ? 'grid' : $wbg_gallary_template );
    ?>">
      <?php 
    while ( $wbgBooks->have_posts() ) {
        $wbgBooks->the_post();
        $wbgImgUrl = get_post_meta( $post->ID, 'wbgp_img_url', true );
        //apply_filters( 'wbg_image_url', $post->ID );
        $wbg_book_cover_size_imp = 200;
        $wbg_book_cover_resulution = 'thumbnail';
        if ( 'default' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = [0, 200];
        }
        if ( 'thumbnail' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = 'thumbnail';
            $wbg_book_cover_size_imp = 150;
        }
        if ( 'medium' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = 'medium';
            $wbg_book_cover_size_imp = 300;
        }
        if ( 'full' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = [0, 500];
            $wbg_book_cover_size_imp = 500;
        }
        $wbg_default_book_cover_url = ( '' !== $wbg_default_book_cover_url ? $wbg_default_book_cover_url : WBG_ASSETS . 'img/noimage.jpg' );
        $feat_image = '<img src="' . esc_url( $wbg_default_book_cover_url ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
        if ( 'f' === $wbg_book_cover_priority ) {
            if ( get_the_post_thumbnail( get_the_ID() ) ) {
                //$feat_image = get_the_post_thumbnail(  $post->ID, $wbg_book_cover_resulution );
                $feat_image = '<img src="' . esc_url( get_the_post_thumbnail_url( $post->ID, $wbg_book_cover_resulution ) ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
            } else {
                if ( $wbgImgUrl ) {
                    $feat_image = '<img src="' . esc_url( $wbgImgUrl ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
                }
            }
        } else {
            if ( $wbgImgUrl ) {
                $feat_image = '<img src="' . esc_url( $wbgImgUrl ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
            } else {
                if ( get_the_post_thumbnail( get_the_ID() ) ) {
                    $feat_image = get_the_post_thumbnail( $post->ID, $wbg_book_cover_resulution );
                }
            }
        }
        if ( 'grid' === $wbg_gallary_template ) {
            include 'gallery/layout/grid.php';
        }
        if ( 'list' === $wbg_gallary_template ) {
            include 'gallery/layout/list.php';
        }
        if ( 'grid-classic' === $wbg_gallary_template ) {
            include 'gallery/layout/grid-classic.php';
        }
    }
    ?>
    </div>
    <?php 
    if ( $wbgPagination ) {
        $this->loop_fotter_content( $wbgBooks->max_num_pages, $wbgPaged );
    }
} else {
    if ( '' !== $wbg_no_book_message ) {
        ?>
      <p class="wbg-no-books-found"><?php 
        esc_html_e( $wbg_no_book_message );
        ?></p>
      <?php 
    }
}
// Reset Post Data
wp_reset_postdata();
?>
</div>
