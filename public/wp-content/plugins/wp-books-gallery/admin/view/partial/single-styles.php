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
    <table class="wbg-single-style-settings-table">
        <!-- Master Container -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Master Container', 'wp-books-gallery' );
?></span><hr>
            </th>
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
echo '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>';
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
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Title', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Font Size', 'wp-books-gallery' );
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
        <!-- Sub Title -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Sub Title', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Font Size', 'wp-books-gallery' );
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
        <!-- Price -->
        <tr>
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Price', 'wp-books-gallery' );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Before Discount Color', 'wp-books-gallery' );
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
_e( 'Font Size', 'wp-books-gallery' );
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
        <!-- Information Label -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Information Label', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Font Size', 'wp-books-gallery' );
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
        <!-- Information Text -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Information Text', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Font Size', 'wp-books-gallery' );
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
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Anchor Hover Color', 'wp-books-gallery' );
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
        <!-- Modal Popup -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Modal Popup', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Height', 'wp-books-gallery' );
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
_e( 'Width', 'wp-books-gallery' );
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
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
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
_e( 'Border Color', 'wp-books-gallery' );
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
_e( 'Border Width', 'wp-books-gallery' );
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
        <!-- Back Button -->
         <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Back Button', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
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
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Font Size', 'wp-books-gallery' );
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
        <!-- Back Button: Hover -->
         <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Back Button: Hover', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
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
_e( 'Font Color', 'wp-books-gallery' );
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
    </table>
    <hr>
    <p class="submit">
        <button id="updateSingleStyles" name="updateSingleStyles" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>
</form>