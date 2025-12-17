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
            <table class="wbg-general-settings-table">
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
                        <?php 
_e( 'This is your Gallery Page URL slug.', 'wp-books-gallery' );
?>
                    </td>
                </tr>
                <!-- Prefered Author -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Prefered Author', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <!-- Download When Logged-in -->
                <tr>
                    <th scope="row">
                        <label for="wbg_download_when_logged_in"><?php 
_e( 'Download When Logged-in', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <!-- Affiliate Code -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Affiliate Code', 'wp-books-gallery' );
?></label>
                    </th>
                    <td>
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                    <th scope="row">
                        <label><?php 
_e( 'Code Apply To URL', 'wp-books-gallery' );
?></label>
                    </th>
                    <td>
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <!-- Book Cover Priority -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Book Cover Priority', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <!-- Hide Book Cover -->
                <tr>
                    <th scope="row">
                        <label for="wbg_hide_book_cover"><?php 
_e( 'Hide Book Cover', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <!-- Default Cover Image Url -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Default Cover Image Url', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_default_book_cover_url" class="widefat" value="<?php 
esc_attr_e( $wbg_default_book_cover_url );
?>"><br>
                        <?php 
_e( 'This image will display when there is no book cover image', 'wp-books-gallery' );
?>.
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
                        <input type="text" name="wbg_no_book_message" class="widefat" value="<?php 
esc_attr_e( $wbg_no_book_message );
?>">
                    </td>
                </tr>
                <!-- Button Url in the Same Window -->
                <tr>
                    <th scope="row">
                        <label for="wbg_dwnld_btn_url_same_tab"><?php 
_e( 'Button Url in the Same Window', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td colspan="3">
                        <input type="checkbox" name="wbg_dwnld_btn_url_same_tab" class="wbg_dwnld_btn_url_same_tab" id="wbg_dwnld_btn_url_same_tab" value="1"
                            <?php 
echo ( $wbg_dwnld_btn_url_same_tab ? 'checked' : '' );
?>>
                    </td>
                </tr>
                <tr class="download-btn-icon">
                    <th scope="row">
                        <label><?php 
_e( 'Download Button Icon', 'wp-books-gallery' );
?></label>
                    </th>
                    <td>
                        <input type="text" name="wbg_download_btn_icon" class="medium-text icp icp-auto" value="<?php 
esc_attr_e( $wbg_download_btn_icon );
?>">
                    </td>
                </tr>
                <tr class="buy-btn-icon">
                    <th scope="row">
                        <label><?php 
_e( 'Buy Button Icon', 'wp-books-gallery' );
?></label>
                    </th>
                    <td>
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <tr class="wbg_enable_rtl">
                    <th scope="row">
                        <label for="wbg_enable_rtl"><?php 
_e( 'Enable RTL', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td colspan="3">
                        <input type="checkbox" name="wbg_enable_rtl" class="wbg_enable_rtl" id="wbg_enable_rtl" value="1" <?php 
echo ( $wbg_enable_rtl ? 'checked' : '' );
?>>
                    </td>
                </tr>
                <!-- Price Format -->
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Price Format', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <tr class="wbg_enable_rtl">
                    <th scope="row">
                        <label for="wbg_display_free_as_price"><?php 
_e( 'Display Free Instead of 0 Price', 'wp-books-gallery' );
?>?</label>
                    </th>
                    <td>
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                    <th scope="row">
                        <label><?php 
_e( 'Free Label Text', 'wp-books-gallery' );
?></label>
                    </th>
                    <td>
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Subtitle Prefix', 'wp-books-gallery' );
?></label>
                    </th>
                    <td>
                        <?php 
?>
                            <span><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                            <?php 
?>
                    </td>
                </tr>
            </table>
            <br><hr>
            <b><?php 
_e( 'Multiple Sale Sources', 'wp-books-gallery' );
?> ::</b>
            <hr><br>
            <table class="wbg-general-settings-table" style="width: 100%;">
                <tr>
                    <th scope="row" style="width: 15%;"><b><?php 
_e( 'Source', 'wp-books-gallery' );
?></b></th>
                    <td style="background: #FFF; border:0px; text-align:left; width: 20%;"><b><?php 
_e( 'Alter Text', 'wp-books-gallery' );
?></b></td>
                    <td style="background: #FFF; border:0px; text-align:left; width: 20%;"><b><?php 
_e( 'Choose Icon', 'wp-books-gallery' );
?></b></td>
                    <td style="background: #FFF; border:0px; text-align:left;"><b><?php 
_e( 'Button Color', 'wp-books-gallery' );
?></b></td>
                </tr>
            </table>
            <div style="height: 320px; overflow-y: scroll; overflow-x:hidden;">
                <table class="wbg-general-settings-table" style="width: 100%;">
                    <?php 
$wbg_sale_sources = $this->wbg_mss_items();
foreach ( $wbg_sale_sources as $source ) {
    $var = 'wbg_mss_alt_txt_' . str_replace( ' ', '_', strtolower( $source ) );
    $icon = 'wbg_mss_' . str_replace( ' ', '_', strtolower( $source ) ) . '_icon';
    $color = 'wbg_mss_' . str_replace( ' ', '_', strtolower( $source ) ) . '_color';
    ?>
                        <tr>
                            <th scope="row" style="width: 15%;">
                                <label><?php 
    esc_html_e( $source );
    ?></label>
                            </th>
                            <td style="width: 20%;">
                                <?php 
    ?>
                                    <span><?php 
    echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
    ?></span>
                                    <?php 
    ?>
                            </td>
                            <td style="width: 20%;">
                                <?php 
    ?>
                                    <span><?php 
    echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
    ?></span>
                                    <?php 
    ?>
                            </td>
                            <td>
                                <?php 
    ?>
                                    <span><?php 
    echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
    ?></span>
                                    <?php 
    ?>
                            </td>
                        </tr>
                        <?php 
}
?>
                </table>
            </div>
            <br>
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
include_once 'partial/admin-sidebar.php';
?> 

    </div>

</div>