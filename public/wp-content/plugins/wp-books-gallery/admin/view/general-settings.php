<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wbgCoreSettings );
foreach ( $wbgCoreSettings as $option_name => $option_value ) {
    if ( isset( $wbgCoreSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
/*
$roles = get_editable_roles();
foreach ( $roles as $role_id => $role_data ) {
    echo '<br>' . $role_data['name'];
}
*/
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?php 
_e( 'General Settings', 'wp-books-gallery' );
?></h2>
    </div>

    <?php 
if ( $wbgShowCoreMessage ) {
    $this->wbg_display_notification( 'success', 'Your information updated successfully.' );
}
?>
    <br>
    <div class="wbg-wrap">

        <div class="wbg_personal_wrap wbg_personal_help" style="width: 75%; float: left;">
        
            <form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-settings-form">
            <?php 
wp_nonce_field( 'wbg_general_action', 'wbg_general_nonce_field' );
?>
            <table class="hm-settings-table" cellpadding=0 cellspacing=0>
                <!-- Gallery Page Slug -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Gallery Page Slug', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_gallery_page_slug" class="medium-text" value="<?php 
esc_attr_e( $wbg_gallery_page_slug );
?>">
                        <span class="wbg-sub-msg"><?php 
_e( 'This is your Gallery Page URL slug.', 'wp-books-gallery' );
?></span>
                    </td>
                </tr>
                <!-- Prefered Author -->
                <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Prefered Author',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
// Download When Logged-in
$jobwp_upgrade_arr = [
    'label'   => 'Download When Logged-in',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
// Affiliate Code
$jobwp_upgrade_arr = [
    'label'   => 'Affiliate Code Tag',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
// Book Cover Priority
$jobwp_upgrade_arr = [
    'label'   => 'Books Cover Priority',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
// Hide Book Cover
$jobwp_upgrade_arr = [
    'label'   => 'Hide Book Cover',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
                <!-- Default Cover Image Url -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Default Cover Image Url', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_default_book_cover_url" class="large-text" value="<?php 
esc_attr_e( $wbg_default_book_cover_url );
?>"><br>
                        <span class="wbg-sub-msg"><?php 
_e( 'This image will display when there is no book cover image', 'wp-books-gallery' );
?></span>
                    </td>
                </tr>
                <!-- No Book Message -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'No Book Message', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_no_book_message" class="regular-text" value="<?php 
esc_attr_e( $wbg_no_book_message );
?>">
                    </td>
                </tr>
                <!-- Button Url in the Same Window -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Button Url in the Same Window', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td colspan="3">
                        <input type="checkbox" name="wbg_dwnld_btn_url_same_tab" class="wbg_dwnld_btn_url_same_tab" id="wbg_dwnld_btn_url_same_tab" value="1"
                            <?php 
echo ( $wbg_dwnld_btn_url_same_tab ? 'checked' : '' );
?>>
                        <label for="wbg_dwnld_btn_url_same_tab"><?php 
_e( 'Enable', 'wp-books-gallery' );
?></label>
                    </td>
                </tr>
                <tr class="download-btn-icon">
                    <th scope="row">
                        <label><?php 
_e( 'Download Button Icon', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_download_btn_icon" class="medium-text icp icp-auto" value="<?php 
esc_attr_e( $wbg_download_btn_icon );
?>">
                    </td>
                </tr>
                <?php 
// Buy Button Icon
$jobwp_upgrade_arr = [
    'label'   => 'Buy Button Icon',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
                <tr class="wbg_enable_rtl">
                    <th scope="row">
                        <label><?php 
_e( 'Enable RTL', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td colspan="3">
                        <input type="checkbox" name="wbg_enable_rtl" class="wbg_enable_rtl" id="wbg_enable_rtl" value="1" <?php 
echo ( $wbg_enable_rtl ? 'checked' : '' );
?>>
                        <label for="wbg_enable_rtl"><?php 
_e( 'Enable', 'wp-books-gallery' );
?></label>
                    </td>
                </tr>
                <!-- Price Format -->
                <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Choose Price Format',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
// Display Free Instead of 0 Price
$jobwp_upgrade_arr = [
    'label'   => 'Display Free Instead of 0 Price',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
// Subtitle Prefix
$jobwp_upgrade_arr = [
    'label'   => 'Subtitle Prefix',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
                <tr class="wbg_inc_book_post_cat">
                    <th scope="row">
                        <label><?php 
_e( 'Include Books in Post Category', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td colspan="3">
                        <input type="checkbox" name="wbg_inc_book_post_cat" class="wbg_inc_book_post_cat" id="wbg_inc_book_post_cat" value="1" 
                            <?php 
checked( $wbg_inc_book_post_cat, 1 );
?>/>
                        <label for="wbg_inc_book_post_cat"><?php 
_e( 'Enable', 'wp-books-gallery' );
?></label>
                    </td>
                </tr>
                <tr class="wbg_display_sidebar_archive_page">
                    <th scope="row">
                        <label><?php 
_e( 'Display Sidebar in Archive Page', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td colspan="3">
                        <input type="checkbox" name="wbg_display_sidebar_archive_page" class="wbg_display_sidebar_archive_page" id="wbg_display_sidebar_archive_page" value="1" 
                            <?php 
checked( $wbg_display_sidebar_archive_page, 1 );
?> />
                        <label for="wbg_display_sidebar_archive_page"><?php 
_e( 'Enable', 'wp-books-gallery' );
?></label>
                    </td>
                </tr>
                <?php 
// Google API Key
$jobwp_upgrade_arr = [
    'label'   => 'Google API Key',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
                <!-- Multiple Sale Sources -->
                <tr class="wbg-settings-section">
                    <td colspan="3" class="wbg-settings-block-title" style="border-right:0;"><i class="fa-solid fa-cart-plus"></i>&nbsp;<?php 
_e( 'Multiple Sale Sources', 'wp-books-gallery' );
?></td>
                    <td class="wbg-settings-block-title" style="text-align: right; border-left:0; background: #FFF; text-transform: none;">
                        <?php 
?>
                    </td>
                </tr>
                <?php 
// Multiple Sale Sources
$jobwp_upgrade_arr = [
    'label'   => 'Multiple Sale Sources',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available in Professional",
    'colspan' => 3,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
            </table>
            <hr>
            <p class="submit">
                <button id="updateCoreSettings" name="updateCoreSettings"
                    class="button button-primary wbg-button"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
                </button>
            </p>
            </form>
        </div>

        <?php 
include_once 'sidebar.php';
?> 

    </div>

</div>