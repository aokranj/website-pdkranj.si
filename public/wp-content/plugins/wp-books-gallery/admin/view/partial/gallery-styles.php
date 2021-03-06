<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wpsdGallerySettingsStyles );
foreach ( $wpsdGallerySettingsStyles as $option_name => $option_value ) {
    if ( isset( $wpsdGallerySettingsStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_general_style_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-style-form">
    <table class="wbg-general-style-settings-table">
        <!-- Parent Container -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Container', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Border Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_container_border_color" id="wbg_container_border_color" value="<?php 
esc_attr_e( $wbg_container_border_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Width', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td colspan="3">
                <input type="number" min="40" max="2000" step="1" name="wbg_container_width" value="<?php 
esc_attr_e( $wbg_container_width );
?>">
                <select name="wbg_container_width_type" class="medium-text">
                    <option value="px" <?php 
echo  ( 'px' === $wbg_container_width_type ? 'selected' : '' ) ;
?> ><?php 
echo  'px' ;
?></option>
                    <option value="%" <?php 
echo  ( '%' === $wbg_container_width_type ? 'selected' : '' ) ;
?> ><?php 
echo  '%' ;
?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Margin Top', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="0" max="200" name="wbg_container_margin_top" id="wbg_container_margin_top" value="<?php 
esc_attr_e( $wbg_container_margin_top );
?>">
                <code>px</code>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Margin Bottom', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="0" max="200" name="wbg_container_margin_bottom" id="wbg_container_margin_bottom" value="<?php 
esc_attr_e( $wbg_container_margin_bottom );
?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Book Item -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Book Item', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_loop_book_border_color"><?php 
_e( 'Border Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_loop_book_border_color" id="wbg_loop_book_border_color" value="<?php 
esc_attr_e( $wbg_loop_book_border_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label for="wbg_loop_book_bg_color"><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_loop_book_bg_color" id="wbg_loop_book_bg_color" value="<?php 
esc_attr_e( $wbg_loop_book_bg_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_download_btn">
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Title', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr class="wbg_title_color">
            <th scope="row">
                <label for="wbg_title_color"><?php 
_e( 'Font Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_title_color" id="wbg_title_color" value="<?php 
esc_attr_e( $wbg_title_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label for="wbg_title_hover_color"><?php 
_e( 'Hover Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_title_hover_color" id="wbg_title_hover_color" value="<?php 
esc_attr_e( $wbg_title_hover_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_title_font_size">
            <th scope="row">
                <label for="wbg_title_font_size"><?php 
_e( 'Font Size', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="12" max="50" name="wbg_title_font_size" id="wbg_title_font_size" value="<?php 
esc_attr_e( $wbg_title_font_size );
?>">
                <code>px</code>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Description', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr">
            <th scope="row">
                <label><?php 
_e( 'Font Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_description_color" id="wbg_description_color" value="<?php 
esc_attr_e( $wbg_description_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label for="wbg_description_font_size"><?php 
_e( 'Font Size', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="10" max="30" name="wbg_description_font_size" id="wbg_description_font_size" value="<?php 
esc_attr_e( $wbg_description_font_size );
?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Download Button -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Download Button', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr class="wbg_download_btn_color">
            <th scope="row">
                <label for="wbg_download_btn_color"><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_download_btn_color" id="wbg_download_btn_color" value="<?php 
esc_attr_e( $wbg_download_btn_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label for="wbg_download_btn_font_color"><?php 
_e( 'Font Color', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_download_btn_font_color" id="wbg_download_btn_font_color" value="<?php 
esc_attr_e( $wbg_download_btn_font_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Size', WBG_TXT_DOMAIN );
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
        <!-- Pagination -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Pagination', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
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
_e( 'Font Color', WBG_TXT_DOMAIN );
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
        <!-- Pagination Hover -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Pagination Hover', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
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
_e( 'Font Color', WBG_TXT_DOMAIN );
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
        <!-- Pagination Active -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="4" style="text-align: left;">
                <hr><label><?php 
_e( 'Pagination Active', WBG_TXT_DOMAIN );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
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
_e( 'Font Color', WBG_TXT_DOMAIN );
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
        <?php 
do_action( 'wbg_admin_general_styles_before_table_end' );
?>

    </table>
    <hr>
    <p class="submit">
        <button id="updateGalleryStylesSettings" name="updateGalleryStylesSettings" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', WBG_TXT_DOMAIN );
?>
        </button>
    </p>

</form>