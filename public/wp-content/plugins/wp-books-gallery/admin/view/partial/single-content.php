<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wbgDetailsContent );
foreach ( $wbgDetailsContent as $option_name => $option_value ) {
    if ( isset( $wbgDetailsContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_detail_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-detail-settings-form">
<?php 
wp_nonce_field( 'wbg_detail_content_action', 'wbg_detail_content_nonce_field' );
?>
    <table class="hm-settings-table" cellpadding=0 cellspacing=0>
        <!-- Search Panel -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;<?php 
_e( 'Search Panel', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Search Panel in Details Page',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Sidebar -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-regular fa-square-check"></i>&nbsp;<?php 
_e( 'Sidebar', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_display_sidebar">
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_sidebar"><?php 
_e( 'Display Sidebar', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="5">
                <input type="checkbox" name="wbg_display_sidebar" id="wbg_display_sidebar" value="1" <?php 
echo ( $wbg_display_sidebar ? 'checked' : null );
?> >
            </td>
        </tr>
        <!-- Book Sub-Title -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-toggle-on"></i>&nbsp;<?php 
_e( 'Sub-Title', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Display Sub-Title',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Book Price -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-sack-xmark"></i>&nbsp;<?php 
_e( 'Book Price', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Book Price',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Book Information -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-book"></i>&nbsp;<?php 
_e( 'Book Information', 'wp-books-gallery' );
?></td>
        </tr>
        <!-- Book Author -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_author_info"><?php 
_e( 'Display Author', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_author_info" id="wbg_author_info" value="1" <?php 
echo ( $wbg_author_info ? 'checked' : null );
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Author Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_author_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_author_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_author_label );
?>">
            </td>
        </tr>
        <!-- Book Category -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_category"><?php 
_e( 'Display Category', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_category" id="wbg_display_category" value="1" <?php 
echo ( $wbg_display_category ? 'checked' : null );
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Category Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_category_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_category_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_category_label );
?>">
            </td>
        </tr>
        <!-- Book Publisher -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_publisher"><?php 
_e( 'Display Publisher', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_publisher" id="wbg_display_publisher" value="1" <?php 
echo ( $wbg_display_publisher ? 'checked' : null );
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Publisher Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_publisher_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_publisher_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_publisher_label );
?>">
            </td>
        </tr>
        <!-- Book Co-Publisher -->
        <?php 
?>
        <!-- Book Publish Date -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_publish_date"><?php 
_e( 'Display Publish Date', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_publish_date" id="wbg_display_publish_date" value="1" <?php 
echo ( $wbg_display_publish_date ? 'checked' : null );
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Publish Date Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_publish_date_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_publish_date_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_publish_date_label );
?>">
            </td>
            <th scope="row" style="text-align: right;">
                <label for="wbg_publish_date_format"><?php 
_e( 'Date Format', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="radio" name="wbg_publish_date_format" id="wbg_publish_date_format_full" value="full" <?php 
echo ( 'year' !== $wbg_publish_date_format ? 'checked' : '' );
?> >
                <label for="wbg_publish_date_format_full"><?php 
_e( 'Full', 'wp-books-gallery' );
?></label>
                    &nbsp;&nbsp;
                <input type="radio" name="wbg_publish_date_format" id="wbg_publish_date_format_year" value="year" <?php 
echo ( 'year' === $wbg_publish_date_format ? 'checked' : '' );
?> >
                <label for="wbg_publish_date_format_year"><?php 
_e( 'Only Year', 'wp-books-gallery' );
?></label>
            </td>
        </tr>
        <!-- Book ISBN-10 -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_isbn"><?php 
_e( 'Display ISBN', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_isbn" id="wbg_display_isbn" value="1" <?php 
echo ( $wbg_display_isbn ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'ISBN Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_isbn_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_isbn_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_isbn_label );
?>">
            </td>
        </tr>
        <!-- Book ISBN-13 -->
        <?php 
?>
        <!-- Book Pages -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_page"><?php 
_e( 'Display Pages', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_page" id="wbg_display_page" value="1" <?php 
echo ( $wbg_display_page ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Pages Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_page_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_page_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_page_label );
?>">
            </td>
        </tr>
        <!-- Book Format & Series -->
        <?php 
// Also Available in Professional
$jobwp_upgrade_arr = [
    'label'   => 'Book Format & Series',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 6,
    'plan'    => 'basic',
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Country -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_country"><?php 
_e( 'Display Country', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_country" id="wbg_display_country" value="1" <?php 
echo ( $wbg_display_country ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Country Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_country_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_country_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_country_label );
?>">
            </td>
        </tr>
        <!-- Language -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_language"><?php 
_e( 'Display Language', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_language" id="wbg_display_language" value="1" <?php 
echo ( $wbg_display_language ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Language Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_language_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_language_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_language_label );
?>">
            </td>
        </tr>
        <!-- Dimension -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_dimension"><?php 
_e( 'Display Dimension', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_dimension" id="wbg_display_dimension" value="1" <?php 
echo ( $wbg_display_dimension ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Dimension Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_dimension_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_dimension_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_dimension_label );
?>">
            </td>
        </tr>
        <!-- File Size -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_filesize"><?php 
_e( 'Display File Size', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_filesize" id="wbg_display_filesize" value="1" <?php 
echo ( $wbg_display_filesize ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'File Size Label', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_filesize_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_filesize_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_filesize_label );
?>">
            </td>
        </tr>
        <?php 
// Also Available in Professional
$jobwp_upgrade_arr = [
    'label'   => 'Othe Available Book Information',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Reading Age, Grade Level, Book Weight, Edition, Illustrator, Translator all available in the Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Book Tags -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-tags"></i>&nbsp;<?php 
_e( 'Book Tags', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_details_hide_tag">
            <th scope="row" style="text-align: right;">
                <label for="wbg_details_hide_tag"><?php 
_e( 'Hide Book Tags', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="checkbox" name="wbg_details_hide_tag" id="wbg_details_hide_tag" value="1" <?php 
echo ( $wbg_details_hide_tag ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Tags Label Text', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_details_tag_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_details_tag_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_details_tag_label );
?>">
            </td>
        </tr>
        <!-- Share Option -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-share"></i>&nbsp;<?php 
_e( 'Book Sharing', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Share Books to Multiple Social Platforms',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Load More Button -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-angles-down"></i>&nbsp;<?php 
_e( 'Load More Button', 'wp-books-gallery' );
?></td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_details_hide_load_more"><?php 
_e( 'Hide Load More Button', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="5">
                <input type="checkbox" name="wbg_details_hide_load_more" class="wbg_details_hide_load_more" id="wbg_details_hide_load_more" value="1"
                    <?php 
checked( $wbg_details_hide_load_more, 1 );
?>>
            </td>
        </tr>
        <!-- Download & Buy Button -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-toggle-off"></i>&nbsp;<?php 
_e( 'Download & Buy Button', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_display_download_button">
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_download_button"><?php 
_e( 'Hide Download Button', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_download_button" id="wbg_display_download_button" value="1" <?php 
echo ( $wbg_display_download_button ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label for="wbg_details_hide_buynow_btn"><?php 
_e( 'Hide Buy Now Button', 'wp-books-gallery' );
?></label>
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
        <!-- Book Formats Price & Buy URL -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-tablet-screen-button"></i>&nbsp;<?php 
_e( 'Book Formats Price & Buy URL', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Book Formats Price & Buy URL',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Book Description -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-book"></i>&nbsp;<?php 
_e( 'Book Description', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_display_description">
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_description"><?php 
_e( 'Display Description', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_description" id="wbg_display_description" value="1" <?php 
echo ( $wbg_display_description ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Description Label', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_description_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_description_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_description_label );
?>">
            </td>
        </tr>
        <!-- Editorial Reviews -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-file-pen"></i>&nbsp;<?php 
_e( 'Editorial Reviews', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Editorial Reviews',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Books From Category -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-book-open"></i>&nbsp;<?php 
_e( 'Books From Category Slider', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Books From Category Slider',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Display books slider from this category and Slider title option - Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Books By Author -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-user-pen"></i>&nbsp;<?php 
_e( 'Books By Author Slider', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Books By Author Slider',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Display books slider from this author and Slider title option - Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Author Bio Panel -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-regular fa-address-card"></i>&nbsp;<?php 
_e( 'Author Bio Panel', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Author Bio Panel',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Show-hide author bio panel and panel title option - Available in Professional",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Back Button -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-circle-arrow-left"></i>&nbsp;<?php 
_e( 'Back Button', 'wp-books-gallery' );
?></td>
        </tr>
        <tr class="wbg_hide_back_button">
            <th scope="row" style="text-align: right;">
                <label for="wbg_hide_back_button"><?php 
_e( 'Hide Back Button', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="checkbox" name="wbg_hide_back_button" id="wbg_hide_back_button" value="1" <?php 
echo ( $wbg_hide_back_button ? 'checked' : null );
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Button Text', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="text" name="wbg_back_button_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_back_button_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_back_button_label );
?>">
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Button Icon', 'wp-books-gallery' );
?></label>
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
    </table>
    <p class="submit">
        <button id="updateDetailsContent" name="updateDetailsContent" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>
</form>