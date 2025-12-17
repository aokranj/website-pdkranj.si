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
    <?php 
wp_nonce_field( 'wbg_gallery_s_action', 'wbg_gallery_s_nonce_field' );
?>
    <table class="wbg-general-style-settings-table">
        <!-- Parent Container -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Container', 'wp-books-gallery' );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Border Color', 'wp-books-gallery' );
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
_e( 'Width', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" min="40" max="2000" step="1" name="wbg_container_width" value="<?php 
esc_attr_e( $wbg_container_width );
?>">
                <select name="wbg_container_width_type" class="medium-text">
                    <option value="px" <?php 
echo ( 'px' === $wbg_container_width_type ? 'selected' : '' );
?> ><?php 
echo 'px';
?></option>
                    <option value="%" <?php 
echo ( '%' === $wbg_container_width_type ? 'selected' : '' );
?> ><?php 
echo '%';
?></option>
                </select>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Margin Top', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="0" max="200" name="wbg_container_margin_top" id="wbg_container_margin_top" value="<?php 
esc_attr_e( $wbg_container_margin_top );
?>">
                <code>px</code>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Margin Bottom', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="0" max="200" name="wbg_container_margin_bottom" id="wbg_container_margin_bottom" value="<?php 
esc_attr_e( $wbg_container_margin_bottom );
?>">
                <code>px</code>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Padding', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="0" max="50" name="wbg_loop_container_padding" id="wbg_loop_container_padding" value="<?php 
esc_attr_e( $wbg_loop_container_padding );
?>">
                <code>px</code>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Border Radius', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="0" max="50" name="wbg_loop_container_radius" id="wbg_loop_container_radius" value="<?php 
esc_attr_e( $wbg_loop_container_radius );
?>">
                <code>px</code>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_container_bg_color" id="wbg_container_bg_color" value="<?php 
esc_attr_e( $wbg_container_bg_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <!-- Book Item -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Book Item', 'wp-books-gallery' );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_loop_book_border_color"><?php 
_e( 'Border Color', 'wp-books-gallery' );
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
_e( 'Background Color', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_loop_book_bg_color" id="wbg_loop_book_bg_color" value="<?php 
esc_attr_e( $wbg_loop_book_bg_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label for="wbg_hide_hover_shadow"><?php 
_e( 'Hide Hover Shadow', 'wp-books-gallery' );
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
        <!-- Title -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Title', 'wp-books-gallery' );
?></label><hr>
            </th>
        </tr>
        <tr class="wbg_title_color">
            <th scope="row">
                <label for="wbg_title_color"><?php 
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Hover Color', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_title_hover_color" id="wbg_title_hover_color" value="<?php 
esc_attr_e( $wbg_title_hover_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label for="wbg_title_font_size"><?php 
_e( 'Font Size', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="12" max="50" name="wbg_title_font_size" id="wbg_title_font_size" value="<?php 
esc_attr_e( $wbg_title_font_size );
?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Description -->
        <tr>
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Description', 'wp-books-gallery' );
?></label><hr>
            </th>
        </tr>
        <tr">
            <th scope="row">
                <label><?php 
_e( 'Font Color', 'wp-books-gallery' );
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
_e( 'Font Size', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input type="number" class="medium-text" min="10" max="30" name="wbg_description_font_size" id="wbg_description_font_size" value="<?php 
esc_attr_e( $wbg_description_font_size );
?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Format -->
        <tr>
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Format', 'wp-books-gallery' );
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
        <!-- Category -->
        <tr>
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Category', 'wp-books-gallery' );
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
        <!-- Author -->
        <tr>
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Author', 'wp-books-gallery' );
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
        <!-- Download Button -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Download Button', 'wp-books-gallery' );
?></label><hr>
            </th>
        </tr>
        <tr class="wbg_download_btn_color">
            <th scope="row">
                <label for="wbg_download_btn_color"><?php 
_e( 'Background Color', 'wp-books-gallery' );
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
_e( 'Font Color', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_download_btn_font_color" id="wbg_download_btn_font_color" value="<?php 
esc_attr_e( $wbg_download_btn_font_color );
?>">
                <div id="colorpicker"></div>
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
        <!-- Download Button Hover -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Download Button Hover', 'wp-books-gallery' );
?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_download_btn_color_hvr"><?php 
_e( 'Background Color', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_download_btn_color_hvr" id="wbg_download_btn_color_hvr" value="<?php 
esc_attr_e( $wbg_download_btn_color_hvr );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label for="wbg_download_btn_font_color_hvr"><?php 
_e( 'Font Color', 'wp-books-gallery' );
?></label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_download_btn_font_color_hvr" id="wbg_download_btn_font_color_hvr" value="<?php 
esc_attr_e( $wbg_download_btn_font_color_hvr );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <!-- Pagination -->
        <tr class="wbg_download_btn">
            <th scope="row" colspan="6" style="text-align: left;">
                <hr><label><?php 
_e( 'Pagination', 'wp-books-gallery' );
?></label><hr>
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
_e( 'Hover Background Color', 'wp-books-gallery' );
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
_e( 'Hover Font Color', 'wp-books-gallery' );
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
_e( 'Active Background Color', 'wp-books-gallery' );
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
_e( 'Active Font Color', 'wp-books-gallery' );
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
_e( 'Border Radius', 'wp-books-gallery' );
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
        <?php 
do_action( 'wbg_admin_general_styles_before_table_end' );
?>

    </table>
    <hr>
    <p class="submit">
        <button id="updateGalleryStylesSettings" name="updateGalleryStylesSettings" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>

</form>