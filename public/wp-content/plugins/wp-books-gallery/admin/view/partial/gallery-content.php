<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wpsdGallerySettingsContent );
foreach ( $wpsdGallerySettingsContent as $option_name => $option_value ) {
    if ( isset( $wpsdGallerySettingsContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-settings-form">
    <?php 
wp_nonce_field( 'wbg_gallery_c_action', 'wbg_gallery_c_nonce_field' );
?>
    <table class="hm-settings-table" cellpadding=0 cellspacing=0>
        <!-- Gallery Template -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Gallery Template', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_gallary_template" class="medium-text">
                    <option value="grid" <?php 
selected( $wbg_gallary_template, 'grid' );
?>><?php 
_e( 'Grid Full', 'wp-books-gallery' );
?></option>
                    <option value="list" <?php 
selected( $wbg_gallary_template, 'list' );
?>><?php 
_e( 'List', 'wp-books-gallery' );
?></option>
                    <option value="grid-classic" <?php 
selected( $wbg_gallary_template, 'grid-classic' );
?>><?php 
_e( 'Grid Classic', 'wp-books-gallery' );
?></option>
                    <option value="grid-only-img" <?php 
selected( $wbg_gallary_template, 'grid-only-img' );
?>><?php 
_e( 'Grid Only Image', 'wp-books-gallery' );
?></option>
                </select>
            </td>
            <th scope="row">
                <label for="wbg_gallary_column"><?php 
_e( 'Gallery Columns', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <label for="wbg_gallary_column_mobile"><?php 
_e( 'Desktop', 'wp-books-gallery' );
?>:</label>
                <select name="wbg_gallary_column" class="medium-text">
                    <?php 
for ($dc = 1; $dc < 11; $dc++) {
    ?>
                        <option value="<?php 
    esc_attr_e( $dc );
    ?>" <?php 
    echo ( $dc == $wbg_gallary_column ? 'selected' : '' );
    ?> ><?php 
    printf( '%d', $dc );
    ?></option>
                        <?php 
}
?>
                </select>
                &nbsp;&nbsp;&nbsp;
                <label for="wbg_gallary_column_mobile"><?php 
_e( 'Mobile', 'wp-books-gallery' );
?>:</label>
                <select name="wbg_gallary_column_mobile" class="medium-text">
                    <option value="1" <?php 
echo ( '1' == $wbg_gallary_column_mobile ? 'selected' : '' );
?> ><?php 
_e( '1', 'wp-books-gallery' );
?></option>
                    <option value="2" <?php 
echo ( '2' == $wbg_gallary_column_mobile ? 'selected' : '' );
?> ><?php 
_e( '2', 'wp-books-gallery' );
?></option>
                </select>
            </td>
        </tr>
        <!-- Image Size -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Image Size', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_book_cover_size" class="medium-text">
                    <option value="default" <?php 
echo ( 'default' == $wbg_book_cover_size ? 'selected' : '' );
?>><?php 
_e( 'Default - 200 x 0', 'wp-books-gallery' );
?></option>
                    <option value="thumbnail" <?php 
echo ( 'thumbnail' == $wbg_book_cover_size ? 'selected' : '' );
?>><?php 
_e( 'Thumbnail - 150 x 150', 'wp-books-gallery' );
?></option>
                    <option value="medium" <?php 
echo ( 'medium' == $wbg_book_cover_size ? 'selected' : '' );
?>><?php 
_e( 'Medium - 300 x 300', 'wp-books-gallery' );
?></option>
                    <option value="full" <?php 
echo ( 'full' == $wbg_book_cover_size ? 'selected' : '' );
?>><?php 
_e( 'Full - 500 x 0', 'wp-books-gallery' );
?></option>
                </select>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Image Animation', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_book_image_animation" class="medium-text">
                    <option value=""><?php 
_e( 'None', 'wp-books-gallery' );
?></option>
                    <option value="rotate-360" <?php 
echo ( 'rotate-360' === $wbg_book_image_animation ? 'selected' : '' );
?> ><?php 
_e( 'Rotate 360', 'wp-books-gallery' );
?></option>
                    <?php 
?>
                </select>
            </td>
        </tr>
        <!-- Books Sorting By -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Books Sorting By', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_gallary_sorting" class="medium-text">
                    <option value="">--<?php 
_e( 'Select One', 'wp-books-gallery' );
?>--</option>
                    <option value="title" <?php 
echo ( 'title' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Name', 'wp-books-gallery' );
?></option>
                    <option value="name" <?php 
echo ( 'name' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Slug/Url', 'wp-books-gallery' );
?></option>
                    <option value="wbg_author" <?php 
echo ( 'wbg_author' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Author', 'wp-books-gallery' );
?></option>
                    <option value="date" <?php 
echo ( 'date' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Post Date', 'wp-books-gallery' );
?></option>
                    <option value="wbg_publisher" <?php 
echo ( 'wbg_publisher' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Publisher', 'wp-books-gallery' );
?></option>
                    <option value="wbg_published_on" <?php 
echo ( 'wbg_published_on' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Book Published Date', 'wp-books-gallery' );
?></option>
                    <option value="wbg_language" <?php 
echo ( 'wbg_language' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Language', 'wp-books-gallery' );
?></option>
                    <option value="wbg_country" <?php 
echo ( 'wbg_country' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Country', 'wp-books-gallery' );
?></option>
                    <option value="rand" <?php 
echo ( 'rand' === $wbg_gallary_sorting ? 'selected' : '' );
?> ><?php 
_e( 'Rand', 'wp-books-gallery' );
?></option>
                </select>
            </td>
            <th scope="row">
                <label for="wbg_books_order"><?php 
_e( 'Order By', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="radio" name="wbg_books_order" id="wbg_books_order_a" value="ASC" <?php 
echo ( 'DESC' !== $wbg_books_order ? 'checked' : '' );
?> >
                <label for="wbg_books_order_a"><span></span><?php 
_e( 'Ascending', 'wp-books-gallery' );
?></label>
                    &nbsp;&nbsp;
                <input type="radio" name="wbg_books_order" id="wbg_books_order_d" value="DESC" <?php 
echo ( 'DESC' === $wbg_books_order ? 'checked' : '' );
?> >
                <label for="wbg_books_order_d"><span></span><?php 
_e( 'Descending', 'wp-books-gallery' );
?></label>
            </td>
        </tr>
        <!-- Disable Book Details Page -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Disable Book Details Page / Enable Popup', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_display_details_page', $wbg_display_details_page );
?>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Detail Page in New Tab', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_details_is_external', $wbg_details_is_external );
?>
            </td>
        </tr>
        <tr class="wbg_title_length">
            <th scope="row">
                <label for="wbg_title_length"><?php 
_e( 'Title Word Length', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="number" name="wbg_title_length" class="medium-text" min="1" max="50" step="1" value="<?php 
esc_attr_e( $wbg_title_length );
?>">
            </td>
            <th scope="row">
                <label><?php 
_e( 'Display Total Books', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_display_total_books', $wbg_display_total_books );
?>
            </td>
        </tr>
        <!-- Books Per Page -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Books Per Page', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$wbg_max_book = 500;
$wbg_max_book = 30;
?>
                <input type="number" min="1" max="<?php 
esc_attr_e( $wbg_max_book );
?>" step="1" name="wbg_books_per_page" class="wbg_books_per_page" 
                    value="<?php 
esc_attr_e( $wbg_books_per_page );
?>">
            </td>
            <th scope="row">
                <label><?php 
_e( 'Display Pagination', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Premium', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Display Front Sorting -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Display Front Sorting', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label for="wbg_gallery_sorting_options"><?php 
_e( 'Sorting Options', 'wp-books-gallery' );
?>?</label>
            </th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Book Info -->
        <tr class="wbg-settings-section">
            <td colspan="4" class="wbg-settings-block-title"><i class="fa-solid fa-list"></i>&nbsp;<?php 
_e( 'Book Info', 'wp-books-gallery' );
?></td>
        </tr>
        <!-- Description -->
        <tr class="wbg_display_description">
            <th scope="row">
                <label><?php 
_e( 'Display Description', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_display_description', $wbg_display_description );
?>
            </td>
            <th scope="row">
                <label for="wbg_description_length"><?php 
_e( 'Word Length', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="number" name="wbg_description_length" class="medium-text" min="1" max="100" step="1" value="<?php 
esc_attr_e( $wbg_description_length );
?>">
            </td>
        </tr>
        <!-- Category -->
        <tr class="wbg_display_category">
            <th scope="row">
                <label><?php 
_e( 'Display Category', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_display_category', $wbg_display_category );
?>
            </td>
            <th scope="row">
                <label for="wbg_cat_label_txt"><?php 
_e( 'Label Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_cat_label_txt" placeholder="<?php 
_e( 'Category', 'wp-books-gallery' );
?>:" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_cat_label_txt );
?>">
            </td>
        </tr>
        <!-- Author -->
        <tr class="wbg_display_author">
            <th scope="row">
                <label><?php 
_e( 'Display Author', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_display_author', $wbg_display_author );
?>
            </td>
            <th scope="row">
                <label for="wbg_author_label_txt"><?php 
_e( 'Label Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_author_label_txt" placeholder="<?php 
_e( 'By:', 'wp-books-gallery' );
?>" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_author_label_txt );
?>">
            </td>
        </tr>
        <!-- Edition -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Display Edition', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Label Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Publish Date -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Display Publish Date', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Label Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Publisher -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Display Publisher', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Label Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Format -->
        <tr>
            <th scope="row"><?php 
_e( 'Hide Format', 'wp-books-gallery' );
?>?</th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Other Settings -->
        <tr class="wbg-settings-section">
            <td colspan="4" class="wbg-settings-block-title"><i class="fa-solid fa-sliders"></i>&nbsp;<?php 
_e( 'Other Settings', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_display_buynow">
            <th scope="row"><?php 
_e( 'Display Download Button', 'wp-books-gallery' );
?>?</th>
            <td>
                <?php 
$this->wbg_load_checkbox_settings_field( 'wbg_display_buynow', $wbg_display_buynow );
?>
            </td>
            <th scope="row">
                <label for="wbg_buynow_btn_txt"><?php 
_e( 'Button Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_buynow_btn_txt" placeholder="<?php 
_e( 'Download', 'wp-books-gallery' );
?>" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_buynow_btn_txt );
?>">
            </td>
        </tr>
        <tr class="wbg_display_buy_now">
            <th scope="row"><?php 
_e( 'Display Buy Now Button', 'wp-books-gallery' );
?>?</th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Premium', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label for="wbg_buy_now_btn_txt"><?php 
_e( 'Button Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Premium', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wbg_gallery_button_bottom_align">
            <th scope="row"><?php 
_e( 'Button Fixed Alignment', 'wp-books-gallery' );
?>?</th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wbg_gallery_hide_price">
            <th scope="row"><?php 
_e( 'Hide Price', 'wp-books-gallery' );
?>?</th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Premium', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Currency', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Premium', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Display Rating -->
        <tr>
            <th scope="row"><?php 
_e( 'Display Rating', 'wp-books-gallery' );
?>?</th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wbg_publish_date_format">
            <th scope="row">
                <label for="wbg_publish_date_format"><?php 
_e( 'Publish Date Format', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>

        <?php 
do_action( 'wbg_admin_general_settings_after_display_total_books' );
?>

        <tr class="wbg_shortcode">
            <th scope="row">
                <label for="wbg_shortcode"><?php 
_e( 'Shortcode:', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_shortcode" id="wbg_shortcode" class="medium-text" value="[wp_books_gallery]" readonly />
                <span class="wbg-sub-msg"><?php 
_e( 'Copy this shortcode and apply it to any page to display books gallery.', 'wp-books-gallery' );
?></span>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateGalleryContentSettings" name="updateGalleryContentSettings" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>
</form>