<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wbgSearchStyles );
foreach ( $wbgSearchStyles as $option_name => $option_value ) {
    if ( isset( $wbgSearchStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_search_style_form" role="form" class="form-horizontal" method="post" action="" id="wbg-search-style-form">
<?php 
wp_nonce_field( 'wbg_search_style_action', 'wbg_search_style_nonce_field' );
?>
    <table class="wbg-search-style-settings-table">
        <!-- Search Panel -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Search Panel', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?>:</label>
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
?>:</label>
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
_e( 'Border Radius', 'wp-books-gallery' );
?>:</label>
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
_e( 'Border Width', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="1">
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
_e( 'Margin Top', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="1">
                <input type="number" class="small-text" min="0" max="100" name="wbg_search_panel_margin_top" id="wbg_search_panel_margin_top" value="<?php 
esc_attr_e( $wbg_search_panel_margin_top );
?>">
                <code>px</code>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Margin Bottom', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="1">
                <input type="number" class="small-text" min="0" max="100" name="wbg_search_panel_margin_btm" id="wbg_search_panel_margin_btm" value="<?php 
esc_attr_e( $wbg_search_panel_margin_btm );
?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Input Fields -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Input Fields', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?>:</label>
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
?>:</label>
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
?>:</label>
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
        <!-- Search Button -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Search Button', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_color" id="wbg_btn_color" value="<?php 
esc_attr_e( $wbg_btn_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Border Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_border_color" id="wbg_btn_border_color" value="<?php 
esc_attr_e( $wbg_btn_border_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_font_color" id="wbg_btn_font_color" value="<?php 
esc_attr_e( $wbg_btn_font_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Size', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="number" class="small-text" min="11" max="36" name="wbg_search_btn_font_size" id="wbg_search_btn_font_size" value="<?php 
esc_attr_e( $wbg_search_btn_font_size );
?>">
                <code>px</code>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Font Weight', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_search_btn_font_weight" class="medium-text">
                    <option value="100" <?php 
echo ( '100' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '100', 'wp-books-gallery' );
?></option>
                    <option value="200" <?php 
echo ( '200' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '200', 'wp-books-gallery' );
?></option>
                    <option value="300" <?php 
echo ( '300' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '300', 'wp-books-gallery' );
?></option>
                    <option value="400" <?php 
echo ( '400' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '400', 'wp-books-gallery' );
?></option>
                    <option value="500" <?php 
echo ( '500' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '500', 'wp-books-gallery' );
?></option>
                    <option value="600" <?php 
echo ( '600' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '600', 'wp-books-gallery' );
?></option>
                    <option value="700" <?php 
echo ( '700' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '700', 'wp-books-gallery' );
?></option>
                    <option value="800" <?php 
echo ( '800' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '800', 'wp-books-gallery' );
?></option>
                    <option value="900" <?php 
echo ( '900' === $wbg_search_btn_font_weight ? 'selected' : '' );
?> ><?php 
_e( '900', 'wp-books-gallery' );
?></option>
                </select>
            </td>
        </tr>
        <!-- Search Button: Hover -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Search Button - Hover', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_btn_bg_color_hover" id="wbg_search_btn_bg_color_hover" value="<?php 
esc_attr_e( $wbg_search_btn_bg_color_hover );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_font_color_hover" id="wbg_search_font_color_hover" value="<?php 
esc_attr_e( $wbg_search_font_color_hover );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <!-- Reset Button -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Reset Button', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Button Width', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="number" class="small-text" min="45" max="200" name="wbg_reset_btn_width" id="wbg_reset_btn_width" value="<?php 
esc_attr_e( $wbg_reset_btn_width );
?>">
                <code>px</code>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_bg_color" id="wbg_search_reset_bg_color" value="<?php 
esc_attr_e( $wbg_search_reset_bg_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Border Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_border_color" id="wbg_search_reset_border_color" value="<?php 
esc_attr_e( $wbg_search_reset_border_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_font_color" id="wbg_search_reset_font_color" value="<?php 
esc_attr_e( $wbg_search_reset_font_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Font Size', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="number" class="small-text" min="12" max="45" name="wbg_reset_btn_font_size" id="wbg_reset_btn_font_size" value="<?php 
esc_attr_e( $wbg_reset_btn_font_size );
?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Reset Button: Hover -->
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span><?php 
_e( 'Reset Button - Hover', 'wp-books-gallery' );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_bg_color_hvr" id="wbg_search_reset_bg_color_hvr" value="<?php 
esc_attr_e( $wbg_search_reset_bg_color_hvr );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_font_color_hvr" id="wbg_search_reset_font_color_hvr" value="<?php 
esc_attr_e( $wbg_search_reset_font_color_hvr );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Border Color', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_border_color_hvr" id="wbg_search_reset_border_color_hvr" value="<?php 
esc_attr_e( $wbg_search_reset_border_color_hvr );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateSearchStyles" name="updateSearchStyles" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>

</form>