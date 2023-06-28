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
_e( 'General Settings', WBG_TXT_DOMAIN );
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
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Gallery Page Slug', WBG_TXT_DOMAIN );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_gallery_page_slug" class="medium-text" value="<?php 
esc_attr_e( $wbg_gallery_page_slug );
?>">
                        <?php 
_e( 'This is your Gallery Page URL slug.', WBG_TXT_DOMAIN );
?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Prefered Author', WBG_TXT_DOMAIN );
?></label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="wbg_download_when_logged_in"><?php 
_e( 'Download When Logged-in', WBG_TXT_DOMAIN );
?>?</label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Affiliate Code', WBG_TXT_DOMAIN );
?></label>
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
                    <th scope="row">
                        <label><?php 
_e( 'Code Apply To URL', WBG_TXT_DOMAIN );
?></label>
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
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Book Cover Priority', WBG_TXT_DOMAIN );
?></label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                            <?php 
?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Default Cover Image Url', WBG_TXT_DOMAIN );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_default_book_cover_url" class="widefat" value="<?php 
esc_attr_e( $wbg_default_book_cover_url );
?>"><br>
                        <?php 
_e( 'This image will display when there is no book cover image', WBG_TXT_DOMAIN );
?>.
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'No Book Message', WBG_TXT_DOMAIN );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="text" name="wbg_no_book_message" class="widefat" value="<?php 
esc_attr_e( $wbg_no_book_message );
?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="wbg_dwnld_btn_url_same_tab"><?php 
_e( 'Button Url in the Same Window', WBG_TXT_DOMAIN );
?>?</label>
                    </th>
                    <td colspan="3">
                        <input type="checkbox" name="wbg_dwnld_btn_url_same_tab" class="wbg_dwnld_btn_url_same_tab" id="wbg_dwnld_btn_url_same_tab" value="1"
                            <?php 
echo  ( $wbg_dwnld_btn_url_same_tab ? 'checked' : '' ) ;
?>>
                    </td>
                </tr>
            </table>
            <hr>
            <p class="submit">
                <button id="updateCoreSettings" name="updateCoreSettings"
                    class="button button-primary wbg-button"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', WBG_TXT_DOMAIN );
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