<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( isset( $_POST['updateGeneralStyles'] ) ) {
    
    $wbgGeneralStylesInfo = array(
        
        'wbg_loop_book_border_color'    => isset( $_POST['wbg_loop_book_border_color'] ) ? sanitize_text_field( $_POST['wbg_loop_book_border_color'] ) : '#DDDDDD',
        'wbg_loop_book_bg_color'        => isset( $_POST['wbg_loop_book_bg_color'] ) ? sanitize_text_field( $_POST['wbg_loop_book_bg_color'] ) : '#FFFFFF',
        'wbg_download_btn_color'        => isset( $_POST['wbg_download_btn_color'] ) ? sanitize_text_field( $_POST['wbg_download_btn_color'] ) : '#0274be',
        'wbg_download_btn_font_color'   => isset( $_POST['wbg_download_btn_font_color'] ) ? sanitize_text_field( $_POST['wbg_download_btn_font_color'] ) : '#FFFFFF',
        'wbg_title_color'               => isset( $_POST['wbg_title_color'] ) ? sanitize_text_field( $_POST['wbg_title_color'] ) : '#242424',
        'wbg_title_hover_color'         => isset( $_POST['wbg_title_hover_color'] ) ? sanitize_text_field( $_POST['wbg_title_hover_color'] ) : '#999999',
        'wbg_title_font_size'           => ( isset( $_POST['wbg_title_font_size'] ) && filter_var( $_POST['wbg_title_font_size'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_title_font_size'] : 12,
        'wbg_description_color'         => isset( $_POST['wbg_description_color'] ) ? sanitize_text_field( $_POST['wbg_description_color'] ) : '#242424',
        'wbg_description_font_size'     => ( isset( $_POST['wbg_description_font_size'] ) && filter_var( $_POST['wbg_description_font_size'], FILTER_SANITIZE_NUMBER_INT ) ) ? $_POST['wbg_description_font_size'] : 12,
    );
    
    $wbgShowGeneralMessage = update_option('wbg_general_styles', $wbgGeneralStylesInfo);
}

$wbgGeneralStyling          = get_option('wbg_general_styles');
$wbg_loop_book_border_color = isset( $wbgGeneralStyling['wbg_loop_book_border_color'] ) ? $wbgGeneralStyling['wbg_loop_book_border_color'] : '#DDDDDD';
$wbg_loop_book_bg_color     = isset( $wbgGeneralStyling['wbg_loop_book_bg_color'] ) ? $wbgGeneralStyling['wbg_loop_book_bg_color'] : '#FFFFFF';
$wbg_download_btn_color     = isset( $wbgGeneralStyling['wbg_download_btn_color'] ) ? $wbgGeneralStyling['wbg_download_btn_color'] : '#0274be';
$wbg_download_btn_font_color    = isset( $wbgGeneralStyling['wbg_download_btn_font_color'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color'] : '#FFFFFF';
$wbg_title_color            = isset( $wbgGeneralStyling['wbg_title_color'] ) ? $wbgGeneralStyling['wbg_title_color'] : '#242424';
$wbg_title_hover_color      = isset( $wbgGeneralStyling['wbg_title_hover_color'] ) ? $wbgGeneralStyling['wbg_title_hover_color'] : '#999999';
$wbg_title_font_size        = isset( $wbgGeneralStyling['wbg_title_font_size'] ) ? $wbgGeneralStyling['wbg_title_font_size'] : 12;
$wbg_description_color      = isset( $wbgGeneralStyling['wbg_description_color'] ) ? $wbgGeneralStyling['wbg_description_color'] : '#242424';
$wbg_description_font_size  = isset( $wbgGeneralStyling['wbg_description_font_size'] ) ? $wbgGeneralStyling['wbg_description_font_size'] : 12;
?>
<form name="wbg_general_style_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-style-form">
    
    <table class="wbg-general-style-settings-table">
        <tr class="wbg_download_btn">
            <th scope="row" colspan="2">
                <hr><label><?php _e('Book Item:', WBG_TXT_DOMAIN); ?></label><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_loop_book_border_color"><?php _e('Border Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_loop_book_border_color" id="wbg_loop_book_border_color" value="<?php esc_attr_e( $wbg_loop_book_border_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_loop_book_bg_color"><?php _e('Background Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_loop_book_bg_color" id="wbg_loop_book_bg_color" value="<?php esc_attr_e( $wbg_loop_book_bg_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_download_btn">
            <th scope="row" colspan="2">
                <hr><label><?php _e('Download Button', WBG_TXT_DOMAIN); ?>:</label><hr>
            </th>
        </tr>
        <tr class="wbg_download_btn_color">
            <th scope="row">
                <label for="wbg_download_btn_color"><?php _e('Button Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_download_btn_color" id="wbg_download_btn_color" value="<?php esc_attr_e( $wbg_download_btn_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_download_btn_font_color">
            <th scope="row">
                <label for="wbg_download_btn_font_color"><?php _e('Button Font Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_download_btn_font_color" id="wbg_download_btn_font_color" value="<?php esc_attr_e( $wbg_download_btn_font_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_download_btn">
            <th scope="row" colspan="2">
                <hr><label><?php _e('Title', WBG_TXT_DOMAIN); ?></label>:<hr>
            </th>
        </tr>
        <tr class="wbg_title_color">
            <th scope="row">
                <label for="wbg_title_color"><?php _e('Font Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_title_color" id="wbg_title_color" value="<?php esc_attr_e( $wbg_title_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_title_hover_color">
            <th scope="row">
                <label for="wbg_title_hover_color"><?php _e('Hover Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_title_hover_color" id="wbg_title_hover_color" value="<?php esc_attr_e( $wbg_title_hover_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_title_font_size">
            <th scope="row">
                <label for="wbg_title_font_size"><?php _e('Font Size', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input type="number" class="medium-text" min="12" max="50" name="wbg_title_font_size" id="wbg_title_font_size" value="<?php esc_attr_e( $wbg_title_font_size ); ?>">
                <code>px</code>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2">
                <hr><label><?php _e('Description', WBG_TXT_DOMAIN); ?>:</label><hr>
            </th>
        </tr>
        <tr">
            <th scope="row">
                <label><?php _e('Font Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_description_color" id="wbg_description_color" value="<?php esc_attr_e( $wbg_description_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr class="wbg_description_font_size">
            <th scope="row">
                <label for="wbg_description_font_size"><?php _e('Font Size', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input type="number" class="medium-text" min="10" max="30" name="wbg_description_font_size" id="wbg_description_font_size" value="<?php esc_attr_e( $wbg_description_font_size ); ?>">
                <code>px</code>
            </td>
        </tr>

        <?php do_action( 'wbg_admin_general_styles_before_table_end' ); ?>

    </table>
    
    <p class="submit"><button id="updateGeneralStyles" name="updateGeneralStyles" class="button button-primary wbg-button"><?php _e('Save Settings', WBG_TXT_DOMAIN); ?></button></p>

</form>