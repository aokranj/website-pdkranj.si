<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wbgSearchContent );
foreach ( $wbgSearchContent as $option_name => $option_value ) {
    if ( isset( $wbgSearchContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_search_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-search-settings-form">
<?php 
wp_nonce_field( 'wbg_search_content_action', 'wbg_search_content_nonce_field' );
?>
    <table class="hm-settings-table" id="wbg-search-settings-table" cellpadding=0 cellspacing=0>
        <tr class="wbg_display_search_panel">
            <th scope="row" style="text-align: right;">
                <?php 
_e( 'Display Search Panel', 'wp-books-gallery' );
?>
            </th>
            <td colspan="5">
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_display_search_panel', $wbg_display_search_panel );
?>
            </td>
        </tr>
        <!-- Search Items -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title">
                <i class="fa-solid fa-magnifying-glass"></i>&nbsp;<?php 
_e( 'Search Items', 'wp-books-gallery' );
?>&nbsp;::
                <span style="text-transform: none;"><?php 
_e( 'Drag & drop to sort them at the front search panel', 'wp-books-gallery' );
?></span>
            </td>
        </tr>
        <?php 
$search_dad_list = $this->get_search_items();
foreach ( $search_dad_list as $search_item ) {
    //echo $search_item;
    if ( 'title' === $search_item ) {
        ?>
                <tr class="wbg_list_item" id="wbg_search_sort_items_title">
                    <th>
                        <?php 
        _e( 'Display Book Name', 'wp-books-gallery' );
        ?>
                    </th>
                    <td style="width: 80px;">
                        <?php 
        $this->wbg_load_checkbox_settings_field( 'wbg_display_search_title', $wbg_display_search_title );
        ?>
                    </td>
                    <th style="text-align: right;">
                        <label for="wbg_display_search_title_placeholder"><?php 
        _e( 'Placeholder Text', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_display_search_title_placeholder" placeholder="<?php 
        _e( 'Book Name', 'wp-books-gallery' );
        ?>" class="medium-text" value="<?php 
        esc_attr_e( $wbg_display_search_title_placeholder );
        ?>">
                    </td>
                </tr>
                <?php 
    }
    // title ends
    if ( 'isbn' === $search_item ) {
        ?>
                <tr class="wbg_list_item" id="wbg_search_sort_items_isbn">
                    <th>
                        <?php 
        _e( 'Display ISBN', 'wp-books-gallery' );
        ?>
                    </th>
                    <td>
                        <?php 
        $this->wbg_load_checkbox_settings_field( 'wbg_display_search_isbn', $wbg_display_search_isbn );
        ?>
                    </td>
                    <th style="text-align: right;">
                        <label for="wbg_display_search_isbn_placeholder"><?php 
        _e( 'Placeholder Text', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_display_search_isbn_placeholder" placeholder="<?php 
        _e( 'ISBN', 'wp-books-gallery' );
        ?>" class="medium-text" value="<?php 
        esc_attr_e( $wbg_display_search_isbn_placeholder );
        ?>">
                    </td>
                </tr>
                <?php 
    }
    // isbn ends
    if ( 'category' === $search_item ) {
        ?>
                <tr class="wbg_list_item" id="wbg_search_sort_items_category">
                    <th>
                        <?php 
        _e( 'Display Category', 'wp-books-gallery' );
        ?>
                    </th>
                    <td>
                        <?php 
        $this->wbg_load_checkbox_settings_field( 'wbg_display_search_category', $wbg_display_search_category );
        ?>
                    </td>
                    <th style="text-align: right;">
                        <label for="wbg_display_category_order"><?php 
        _e( 'Order By', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="radio" name="wbg_display_category_order" class="wbg_display_category_order" id="wbg_display_category_order_asc" value="asc" <?php 
        echo ( 'desc' !== $wbg_display_category_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_category_order_asc"><?php 
        _e( 'Ascending', 'wp-books-gallery' );
        ?></label>
                            &nbsp;&nbsp;
                        <input type="radio" name="wbg_display_category_order" class="wbg_display_category_order" id="wbg_display_category_order_desc" value="desc" <?php 
        echo ( 'desc' === $wbg_display_category_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_category_order_desc"><?php 
        _e( 'Descending', 'wp-books-gallery' );
        ?></label>
                    </td>
                    <th>
                        <label for="wbg_search_category_default"><?php 
        _e( 'Default Option', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="text" name="wbg_search_category_default" placeholder="<?php 
        _e( 'All Categories', 'wp-books-gallery' );
        ?>" class="medium-text" value="<?php 
        echo esc_attr( $wbg_search_category_default );
        ?>">
                    </td>
                </tr>
                <?php 
    }
    // category ends
    if ( 'year' === $search_item ) {
        ?>
                <tr class="wbg_list_item" id="wbg_search_sort_items_year">
                    <th>
                        <?php 
        _e( 'Display Year', 'wp-books-gallery' );
        ?>
                    </th>
                    <td>
                        <?php 
        $this->wbg_load_checkbox_settings_field( 'wbg_display_search_year', $wbg_display_search_year );
        ?>
                    </td>
                    <th style="text-align: right;">
                        <label for="wbg_display_year_order"><?php 
        _e( 'Order By', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="radio" name="wbg_display_year_order" class="wbg_display_year_order" id="wbg_display_year_order_asc" value="asc" <?php 
        echo ( 'desc' !== $wbg_display_year_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_year_order_asc"><?php 
        _e( 'Ascending', 'wp-books-gallery' );
        ?></label>
                            &nbsp;&nbsp;
                        <input type="radio" name="wbg_display_year_order" class="wbg_display_year_order" id="wbg_display_year_order_desc" value="desc" <?php 
        echo ( 'desc' === $wbg_display_year_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_year_order_desc"><?php 
        _e( 'Descending', 'wp-books-gallery' );
        ?></label>
                    </td>
                    <th>
                        <label for="wbg_search_year_default"><?php 
        _e( 'Default Option', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="text" name="wbg_search_year_default" placeholder="<?php 
        _e( 'All Years', 'wp-books-gallery' );
        ?>" class="medium-text" value="<?php 
        esc_attr_e( $wbg_search_year_default );
        ?>">
                    </td>
                </tr>
                <?php 
    }
    // year ends
    if ( 'language' === $search_item ) {
        ?>
                <tr class="wbg_list_item" id="wbg_search_sort_items_language">
                    <th>
                        <?php 
        _e( 'Display Language', 'wp-books-gallery' );
        ?>
                    </th>
                    <td>
                        <?php 
        $this->wbg_load_checkbox_settings_field( 'wbg_display_search_language', $wbg_display_search_language );
        ?>
                    </td>
                    <th style="text-align: right;">
                        <label for="wbg_display_language_order"><?php 
        _e( 'Order By', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="radio" name="wbg_display_language_order" class="wbg_display_language_order" id="wbg_display_language_order_asc" value="asc" <?php 
        echo ( 'desc' !== $wbg_display_language_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_language_order_asc"><?php 
        _e( 'Ascending', 'wp-books-gallery' );
        ?></label>
                            &nbsp;&nbsp;
                        <input type="radio" name="wbg_display_language_order" class="wbg_display_language_order" id="wbg_display_language_order_desc" value="desc" <?php 
        echo ( 'desc' === $wbg_display_language_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_language_order_desc"><?php 
        _e( 'Descending', 'wp-books-gallery' );
        ?></label>
                    </td>
                    <th>
                        <label for="wbg_search_language_default"><?php 
        _e( 'Default Option', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="text" name="wbg_search_language_default" placeholder="<?php 
        _e( 'All Languages', 'wp-books-gallery' );
        ?>" class="medium-text" value="<?php 
        esc_attr_e( $wbg_search_language_default );
        ?>">
                    </td>
                </tr>
                <?php 
    }
    // language ends
    if ( 'author' === $search_item ) {
        ?>
                <tr class="wbg_list_item" id="wbg_search_sort_items_author">
                    <th>
                        <?php 
        _e( 'Display Author', 'wp-books-gallery' );
        ?>
                    </th>
                    <td>
                        <?php 
        $this->wbg_load_checkbox_settings_field( 'wbg_display_search_author', $wbg_display_search_author );
        ?>
                    </td>
                    <th style="text-align: right;">
                        <label for="wbg_display_author_order"><?php 
        _e( 'Order By', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="radio" name="wbg_display_author_order" class="wbg_display_author_order" id="wbg_display_author_order_asc" value="asc" <?php 
        echo ( 'desc' !== $wbg_display_author_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_author_order_asc"><?php 
        _e( 'Ascending', 'wp-books-gallery' );
        ?></label>
                            &nbsp;&nbsp;
                        <input type="radio" name="wbg_display_author_order" class="wbg_display_author_order" id="wbg_display_author_order_desc" value="desc" <?php 
        echo ( 'desc' === $wbg_display_author_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_author_order_desc"><?php 
        _e( 'Descending', 'wp-books-gallery' );
        ?></label>
                    </td>
                    <th>
                        <label for="wbg_search_author_default"><?php 
        _e( 'Default Option', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="text" name="wbg_search_author_default" placeholder="<?php 
        _e( 'All Authors', 'wp-books-gallery' );
        ?>" class="medium-text" value="<?php 
        echo esc_attr( $wbg_search_author_default );
        ?>">
                    </td>
                </tr>
                <?php 
    }
    // author ends
    if ( 'publisher' === $search_item ) {
        ?>
                <tr class="wbg_list_item" id="wbg_search_sort_items_publisher">
                    <th>
                        <?php 
        _e( 'Display Publisher', 'wp-books-gallery' );
        ?>
                    </th>
                    <td>
                        <?php 
        $this->wbg_load_checkbox_settings_field( 'wbg_display_search_publisher', $wbg_display_search_publisher );
        ?>
                    </td>
                    <th style="text-align: right;">
                        <label for="wbg_display_publisher_order"><?php 
        _e( 'Order By', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="radio" name="wbg_display_publisher_order" class="wbg_display_publisher_order" id="wbg_display_publisher_order_asc" value="asc" <?php 
        echo ( 'desc' !== $wbg_display_publisher_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_publisher_order_asc"><?php 
        _e( 'Ascending', 'wp-books-gallery' );
        ?></label>
                            &nbsp;&nbsp;
                        <input type="radio" name="wbg_display_publisher_order" class="wbg_display_publisher_order" id="wbg_display_publisher_order_desc" value="desc" <?php 
        echo ( 'desc' === $wbg_display_publisher_order ? 'checked' : '' );
        ?> >
                        <label for="wbg_display_publisher_order_desc"><?php 
        _e( 'Descending', 'wp-books-gallery' );
        ?></label>
                    </td>
                    <th>
                        <label for="wbg_search_publishers_default"><?php 
        _e( 'Default Option', 'wp-books-gallery' );
        ?></label>
                    </th>
                    <td>
                        <input type="text" name="wbg_search_publishers_default" placeholder="<?php 
        _e( 'All Publishers', 'wp-books-gallery' );
        ?>" class="medium-text" value="<?php 
        esc_attr_e( $wbg_search_publishers_default );
        ?>">
                    </td>
                </tr>
                <?php 
    }
    apply_filters( 'wbg_admin_search_load_items', $search_item );
}
// foreach ( $search_dad_list as $search_item )
$jobwp_upgrade_arr = [
    'label'   => 'Available in Professional',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Search by formats, series, ISBN-13, tags, co-authors, and reading age available in Professional",
    'colspan' => 5,
    'plan'    => 'basic',
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>

        <?php 
do_action( 'wbg_admin_search_settings_before_search_button_text' );
?>

        <!-- Search Button -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-toggle-off"></i></i>&nbsp;<?php 
_e( 'Search Button', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_cat_label_txt">
            <th scope="row" style="text-align: right;">
                <label for="wbg_search_btn_txt"><?php 
_e( 'Button Text', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="5">
                <input type="text" name="wbg_search_btn_txt" placeholder="<?php 
_e( 'Search Books', 'wp-books-gallery' );
?>" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_search_btn_txt );
?>">
            </td>
        </tr>
        <!-- Refresh Button -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-rotate"></i>&nbsp;<?php 
_e( 'Refresh Button', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_cat_label_txt">
            <th scope="row" style="text-align: right;">
                <?php 
_e( 'Hide Button', 'wp-books-gallery' );
?>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_hide_refresh_btn', $wbg_hide_refresh_btn );
?>
            </td>
            <th scope="row" style="text-align: right;">
                <label for="wbg_refresh_btn_txt"><?php 
_e( 'Button Icon/Text', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="text" name="wbg_refresh_btn_txt" placeholder="<?php 
_e( 'Search Books', 'wp-books-gallery' );
?>" class="medium-text" value="<?php 
esc_attr_e( $wbg_refresh_btn_txt );
?>">
                <span class="wbg-sub-msg"><?php 
_e( 'Use font awesome icon class only, like: "fa fa-refresh", or any text', 'wp-books-gallery' );
?></span>
            </td>
            <th scope="row" style="text-align: right;">
                <?php 
_e( 'Display as Text', 'wp-books-gallery' );
?>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_refresh_display_txt', $wbg_refresh_display_txt );
?>
                <span class="wbg-sub-msg"><?php 
_e( 'If you enable this, refrest button with display Button Icon as Text', 'wp-books-gallery' );
?></span>
            </td>
        </tr>
    </table>
    <p class="submit">
        <button id="updateSearchContent" name="updateSearchContent" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>
</form>