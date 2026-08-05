<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">

    <div class="settings-banner">
        <h2><i class="fa-solid fa-cloud-arrow-down"></i>&nbsp;<?php 
_e( 'Import Books From API', 'wp-books-gallery' );
?></h2>
    </div>

    <?php 
if ( $wbgiUploadMsg ) {
    $this->wbg_display_notification( 'info', $wbgiUploadMsg );
}
?>
    <br>
    <div class="wbg-wrap">

        <div class="wbg_personal_wrap wbg_personal_help" style="width: 75%; float: left;">

            <form name="wbg_api_import_form" role="form" class="form-horizontal" method="post" action="" id="wbg-api-import-form">
            <?php 
wp_nonce_field( 'wbg_api_import_action', 'wbg_api_import_nonce_field' );
?>
                <table class="hm-settings-table" cellpadding=0 cellspacing=0>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Import API Source', 'wp-books-gallery' );
?></label>
                        </th>
                        <td colspan="3">
                            <input type="radio" name="wbg_api_from" id="wbg_api_from_ol" value="ol" <?php 
echo ( 'gb' !== $wbg_api_from ? 'checked' : '' );
?>>
                            <label for="wbg_api_from_ol"><?php 
_e( 'Open Library', 'wp-books-gallery' );
?></label>
                            &nbsp;&nbsp;
                            <?php 
?>
                                <input type="radio" readonly>
                                <label><?php 
_e( 'Google Books', 'wp-books-gallery' );
?></label>
                                <span class="wbg-sub-msg"><?php 
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Import from Google Books Available in Professional', 'wp-books-gallery' ) . '</a>';
?></span>
                                <?php 
?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label><?php 
_e( 'Enter ISBN-10 / ISBN-13', 'wp-books-gallery' );
?></label>
                        </th>
                        <td>
                            <input type="text" name="wbg_api_isbn" class="large-text" placeholder="<?php 
_e( 'ISBN-10, ISBN-13', 'wp-books-gallery' );
?>" required>
                        </td>    
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>
                            <span class="wbg-sub-msg"><?php 
_e( 'Use comma between multiple ISBN/s', 'wp-books-gallery' );
?></span>
                            <span class="wbg-sub-msg"><?php 
_e( 'Recommended size: 20 isbns at a time to avoid timeout', 'wp-books-gallery' );
?></span>
                            <span class="wbg-sub-msg"><?php 
_e( 'Avoid - simultaneous requests', 'wp-books-gallery' );
?></span>
                            <?php 
?>
                        </td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="submit" id="saveSettings" name="saveSettings" class="button button-primary wbg-button" 
                        value="<?php 
_e( 'Import Books', 'wp-books-gallery' );
?>">
                </p>
            </form>

        </div>

        <?php 
include_once WBG_PATH . 'admin/view/sidebar.php';
?>
    </div>
</div>