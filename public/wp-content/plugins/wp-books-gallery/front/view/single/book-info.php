<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'wbg_front_single_book_info_one' );
// Author
if ( $wbg_author_info ) {
    if ( !empty( $wbgAuthor ) ) {
        $author_url = '/' . $wbg_gallery_page_slug . '/?wbg_author_s=' . urlencode( $wbgAuthor );
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_author_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        $wbgAuthorArray = [];
        $wbgAuthorArray[] = '<a href="' . esc_url( home_url( $author_url ) ) . '" class="wbg-single-link">' . esc_html( $wbgAuthor ) . '</a>';
        if ( !empty( $wbgAuthorArray ) ) {
            echo implode( ', ', $wbgAuthorArray );
        }
        ?>
            </span>
        </span>
        <?php 
    }
}
// Category
if ( $wbg_display_category ) {
    if ( !empty( $wbgCategory ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_category_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        $wbgCatArray = [];
        foreach ( $wbgCategory as $cat ) {
            $cat_url = $wbg_gallery_page_slug . '?wbg_category_s=' . urlencode( $cat->name );
            $wbgCatArray[] = "<a href='" . esc_url( home_url( $cat_url ) ) . "' class='wbg-single-link'>" . esc_html( $cat->name ) . "</a>";
        }
        echo implode( ', ', $wbgCatArray );
        ?>
            </span>
        </span>
        <?php 
    }
}
// Publisher
if ( $wbg_display_publisher ) {
    if ( !empty( $wbgPublisher ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-building" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_publisher_label );
        ?>:</b>
            <span class="single-book-info-value">
                <a href="<?php 
        echo esc_url( home_url( '/' . $wbg_gallery_page_slug . '/?wbg_publisher_s=' . urlencode( $wbgPublisher ) ) );
        ?>" class="wbg-single-link"><?php 
        esc_html_e( $wbgPublisher );
        ?></a>
        
            </span>
        </span>
        <?php 
    }
}
// Publish Date
if ( $wbg_display_publish_date ) {
    if ( !empty( $wbgPublished ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_publish_date_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        if ( 'full' === $wbg_publish_date_format ) {
            echo date_i18n( get_option( 'date_format' ), strtotime( $wbgPublished ) );
        } else {
            echo date( 'Y', strtotime( $wbgPublished ) );
        }
        ?>
            </span>
        </span>
    <?php 
    }
}
// ISBN
if ( $wbg_display_isbn ) {
    if ( !empty( $wbgIsbn ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-barcode" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_isbn_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        esc_html_e( $wbgIsbn );
        ?>
            </span>
        </span>
        <?php 
    }
}
// Pages
if ( $wbg_display_page ) {
    if ( !empty( $wbgPages ) ) {
        ?>
    <span class="wbg-single-book-info">
        <b><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_page_label );
        ?>:</b>
        <span class="single-book-info-value">
            <?php 
        esc_html_e( $wbgPages );
        ?>
        </span>
    </span>
    <?php 
    }
}
// Country
if ( $wbg_display_country ) {
    if ( !empty( $wbgCountry ) ) {
        ?>
    <span class="wbg-single-book-info">
        <b><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_country_label );
        ?>:</b>
        <span class="single-book-info-value">
            <?php 
        esc_html_e( $wbgCountry );
        ?>
        </span>
    </span>
    <?php 
    }
}
// Language
if ( $wbg_display_language ) {
    if ( !empty( $wbgLanguage ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_language_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        esc_html_e( $wbgLanguage );
        ?>
            </span>
        </span>
        <?php 
    }
}
// Dimension
if ( $wbg_display_dimension ) {
    if ( !empty( $wbgDimension ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-arrows" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_dimension_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        esc_html_e( $wbgDimension );
        ?>
            </span>
        </span>
        <?php 
    }
}
// Filesize
if ( $wbg_display_filesize ) {
    if ( !empty( $wbgFilesize ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa fa-file" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_filesize_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        esc_html_e( $wbgFilesize );
        ?>
            </span>
        </span>
        <?php 
    }
}
do_action( 'wbg_front_single_load_custom_fields_data' );
// Tags
if ( !$wbg_details_hide_tag ) {
    $wbgPostTags = get_the_tags();
    if ( !empty( $wbgPostTags ) ) {
        ?>
        <span class="wbg-single-book-info">
            <b><i class="fa-solid fa-tags" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_details_tag_label );
        ?>:</b>
            <span class="single-book-info-value">
                <?php 
        $tag_arr = [];
        foreach ( $wbgPostTags as $tag ) {
            $tag_arr[] = '<a href="' . get_tag_link( $tag->term_id ) . '" class="wbg-single-link">' . $tag->name . '</a>';
        }
        echo implode( ' | ', $tag_arr );
        ?>
            </span>
        </span>
        <?php 
    }
}