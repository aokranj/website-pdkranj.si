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

    <div class="wbg-wrap">

        <div class="wbg_personal_wrap wbg_personal_help" style="width: 75%; float: left;">
        
            <form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-settings-form">
            <table class="wbg-general-settings-table">
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Gallery Page Slug', WBG_TXT_DOMAIN );
?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wbg_gallery_page_slug" class="medium-text" value="<?php 
esc_attr_e( $wbg_gallery_page_slug );
?>">
                        <?php 
_e( 'This is your Gallery Page URL slug. Please do not use books as gallery page.', WBG_TXT_DOMAIN );
?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Prefered Author', WBG_TXT_DOMAIN );
?>:</label>
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
                        <label for="wbg_download_when_logged_in"><?php 
_e( 'Download When Logged-in', WBG_TXT_DOMAIN );
?>?</label>
                    </th>
                    <td colspan="3">
                        <?php 
?>
                            <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade to Professional!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                            <?php 
?>
                    </td>
                </tr>
            </table>
            <p class="submit"><button id="updateCoreSettings" name="updateCoreSettings"
                    class="button button-primary wbg-button"><?php 
_e( 'Save Settings', WBG_TXT_DOMAIN );
?></button></p>
            </form>

        </div>

        <?php 
include_once 'partial/admin-sidebar.php';
?> 

    </div>

</div>