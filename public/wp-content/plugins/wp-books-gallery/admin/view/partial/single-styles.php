<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//$wbgSingleStyles = [];
foreach ( $wbgSingleStyles as $option_name => $option_value ) {
    if ( isset( $wbgSingleStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_single_style_form" role="form" class="form-horizontal" method="post" action="" id="wbg-single-style-form">
<?php 
wp_nonce_field( 'wbg_detail_style_action', 'wbg_detail_style_nonce_field' );
?>
    <table class="hm-settings-table" cellpadding=0 cellspacing=0>
        <!-- Parent Container -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-expand"></i>&nbsp;<?php 
_e( 'Parent Container', 'wp-books-gallery' );
?></td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Width', 'wp-books-gallery' );
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
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="3">
                <input class="wbg-wp-color" type="text" name="wbg_single_container_bg_color" id="wbg_single_container_bg_color" value="<?php 
esc_attr_e( $wbg_single_container_bg_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Margin Top', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="0" max="200" name="wbg_single_container_margin_top" id="wbg_single_container_margin_top" value="<?php 
esc_attr_e( $wbg_single_container_margin_top );
?>">
                <code>px</code>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Margin Bottom', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="3">
                <input type="number" class="medium-text" min="0" max="200" name="wbg_single_container_margin_bottom" id="wbg_single_container_margin_bottom" value="<?php 
esc_attr_e( $wbg_single_container_margin_bottom );
?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Title -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-t"></i>&nbsp;<?php 
_e( 'Book Title', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Available in Professional',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available options - Book title font color, font size, Book subtitle font color & font size.",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Price -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-sack-xmark"></i>&nbsp;<?php 
_e( 'Book Price', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Available in Professional',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available options - Book price font color, before discount price font color & font size.",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Information Label -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-book"></i>&nbsp;<?php 
_e( 'Information Label', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Available in Professional',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available options - Information label font color and size, Information text font color, size and anchor hover color.",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Author Panel -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-solid fa-user-pen"></i>&nbsp;<?php 
_e( 'Author Panel', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Available in Professional',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available options - Author name font color and font size, Author bio font color and font size.",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
        <!-- Modal Popup -->
        <tr class="wbg-settings-section">
            <td colspan="6" class="wbg-settings-block-title"><i class="fa-regular fa-square-plus"></i>&nbsp;<?php 
_e( 'Modal - Popup', 'wp-books-gallery' );
?></td>
        </tr>
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Available in Professional',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available options - Popup height and width, background color, border color and border width.",
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
        <?php 
$jobwp_upgrade_arr = [
    'label'   => 'Available in Professional',
    'icon'    => 'fa-regular fa-hand-point-right',
    'message' => "Available options - Background color, font color, font size, hover background color and font color.",
    'colspan' => 6,
];
$this->wbg_upgrade_to_premium_section( $jobwp_upgrade_arr );
?>
    </table>
    <p class="submit">
        <button id="updateSingleStyles" name="updateSingleStyles" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>
</form>