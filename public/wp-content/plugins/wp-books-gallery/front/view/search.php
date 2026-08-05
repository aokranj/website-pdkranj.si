<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
include 'search/header.php';
?>
<form method="GET" action="<?php 
echo esc_url( home_url( '/' . $wbg_gallery_page_slug ) );
?>" id="wbg-search-form">
  <?php 
//wp_nonce_field( 'wbg_search_nonce_action', 'wbg_search_nonce_field' );
?>
  <div class="wrap wbg-search-container">
    <?php 
foreach ( $search_dad_list as $search_item ) {
    if ( 'title' === $search_item ) {
        if ( $wbg_display_search_title ) {
            ?>
          <div class="wbg-search-item">
            <input type="text" name="wbg_title_s" placeholder="<?php 
            esc_attr_e( $wbg_display_search_title_placeholder );
            ?>" value="<?php 
            esc_attr_e( stripslashes( $wbg_title_s ) );
            ?>">
          </div>
          <?php 
        }
    }
    if ( 'isbn' === $search_item ) {
        if ( $wbg_display_search_isbn ) {
            ?>
          <div class="wbg-search-item">
            <input type="text" name="wbg_isbn_s" placeholder="<?php 
            esc_attr_e( $wbg_display_search_isbn_placeholder );
            ?>" 
              value="<?php 
            echo esc_attr( $wbg_clean_params['wbg_isbn_s'] );
            ?>">
          </div>
          <?php 
        }
    }
    if ( 'category' === $search_item ) {
        if ( $wbg_display_search_category ) {
            ?>
          <div class="wbg-search-item">
            <select id="wbg_category_s" name="wbg_category_s" class="wbg-selectize">
                <option value=""><?php 
            esc_html_e( $wbg_search_category_default );
            ?></option>
                <?php 
            $wbg_book_categories = get_terms( array(
                'taxonomy'   => 'book_category',
                'hide_empty' => true,
                'order'      => $wbg_display_category_order,
                'parent'     => 0,
            ) );
            foreach ( $wbg_book_categories as $book_category ) {
                ?>
                  <option value="<?php 
                esc_attr_e( $book_category->slug );
                ?>" <?php 
                selected( $wbg_clean_params['wbg_category_s'], $book_category->slug );
                ?>><?php 
                esc_html_e( $book_category->name );
                ?></option>
                  <?php 
                $loterms = get_terms( array(
                    'taxonomy'   => 'book_category',
                    'hide_empty' => true,
                    'order'      => $wbg_display_category_order,
                    'parent'     => $book_category->term_id,
                ) );
                if ( $loterms ) {
                    foreach ( $loterms as $key => $loterm ) {
                        ?>
                      <option value="<?php 
                        esc_attr_e( $loterm->slug );
                        ?>" <?php 
                        selected( $wbg_clean_params['wbg_category_s'], $loterm->slug );
                        ?>>- <?php 
                        esc_html_e( $loterm->name );
                        ?></option>
                      <?php 
                    }
                }
            }
            ?>
            </select>
          </div>
          <?php 
        }
    }
    if ( 'year' === $search_item ) {
        if ( $wbg_display_search_year ) {
            ?>
          <div class="wbg-search-item">
              <select id="wbg_published_on_s" name="wbg_published_on_s" class="wbg-selectize">
                  <option value=""><?php 
            esc_html_e( $wbg_search_year_default );
            ?></option>
                  <?php 
            $wbg_years = $wpdb->get_results( "SELECT DISTINCT YEAR(meta_value) year FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_published_on' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_year_order}", ARRAY_A );
            foreach ( $wbg_years as $year ) {
                if ( NULL != $year['year'] ) {
                    ?>
                      <option value="<?php 
                    echo esc_attr( $year['year'] );
                    ?>" <?php 
                    echo ( $wbg_published_on_s == $year['year'] ? "Selected" : "" );
                    ?> ><?php 
                    echo esc_html( $year['year'] );
                    ?></option>
                      <?php 
                }
            }
            ?>
              </select>
          </div>
          <?php 
        }
    }
    if ( 'language' === $search_item ) {
        if ( $wbg_display_search_language ) {
            ?>
            <div class="wbg-search-item">
                <select id="wbg_language_s" name="wbg_language_s" class="wbg-selectize">
                    <option value=""><?php 
            esc_html_e( $wbg_search_language_default );
            ?></option>
                    <?php 
            $wbg_languages = $wpdb->get_results( "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_language' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_language_order}", ARRAY_A );
            foreach ( $wbg_languages as $lang ) {
                ?>
                        <option value="<?php 
                echo esc_attr( $lang['meta_value'] );
                ?>" <?php 
                selected( $wbg_clean_params['wbg_language_s'], $lang['meta_value'] );
                ?> ><?php 
                echo esc_html( $lang['meta_value'] );
                ?></option>
                    <?php 
            }
            ?>
                </select>
            </div>
            <?php 
        }
    }
    if ( 'author' === $search_item ) {
        if ( $wbg_display_search_author ) {
            ?>
            <div class="wbg-search-item">
              <select id="wbg_author_s" name="wbg_author_s" class="wbg-selectize">
                  <option value=""><?php 
            esc_html_e( $wbg_search_author_default );
            ?></option>
                  <?php 
            foreach ( $wbg_authors as $author ) {
                ?>
                    <option value="<?php 
                echo esc_attr( $author['meta_value'] );
                ?>" <?php 
                selected( $wbg_clean_params['wbg_author_s'], $author['meta_value'] );
                ?>><?php 
                echo esc_html( $author['meta_value'] );
                ?></option>
                  <?php 
            }
            ?>
              </select>
            </div>
            <?php 
        }
    }
    if ( 'publisher' === $search_item ) {
        if ( $wbg_display_search_publisher ) {
            ?>
            <div class="wbg-search-item">
              <select id="wbg_publisher_s" name="wbg_publisher_s" class="wbg-selectize">
                  <option value=""><?php 
            esc_html_e( $wbg_search_publishers_default );
            ?></option>
                  <?php 
            $wbg_publishers = $wpdb->get_results( "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_publisher' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_publisher_order}", ARRAY_A );
            foreach ( $wbg_publishers as $publisher ) {
                ?>
                    <option value="<?php 
                echo esc_attr( $publisher['meta_value'] );
                ?>" <?php 
                selected( $wbg_clean_params['wbg_publisher_s'], $publisher['meta_value'] );
                ?>><?php 
                echo esc_html( $publisher['meta_value'] );
                ?></option>
                  <?php 
            }
            ?>
              </select>
            </div>
            <?php 
        }
    }
}
// foreach ( $search_dad_list as $search_item )
apply_filters( 'wbg_front_search_load_items', $search_item );
?>

    <div class="wbg-search-item">
      <input type="submit" class="button submit-btn" value="<?php 
esc_attr_e( $wbg_search_btn_txt );
?>">
    </div>

    <?php 
if ( !$wbg_hide_refresh_btn ) {
    ?>
      <div class="wbg-search-item refresh">
        <a href="<?php 
    echo esc_url( home_url( '/' . $wbg_gallery_page_slug ) );
    ?>" id="wbg-search-refresh">
          <?php 
    if ( $wbg_refresh_display_txt ) {
        ?>
            <span><?php 
        esc_attr_e( $wbg_refresh_btn_txt );
        ?></span>
            <?php 
    } else {
        ?>
              <span class="<?php 
        esc_attr_e( $wbg_refresh_btn_txt );
        ?>"></span>
              <?php 
    }
    ?>
        </a>
      </div>
      <?php 
}
?>
  </div>
</form>