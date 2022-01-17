<?php
if ( ! defined( 'ABSPATH' ) ) {
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
    <table class="wbg-search-style-settings-table">
        <tr>
            <th scope="row" colspan="2">
                <hr><span><?php _e('Button', WBG_TXT_DOMAIN); ?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Background Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_color" id="wbg_btn_color" value="<?php esc_attr_e( $wbg_btn_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Border Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_border_color" id="wbg_btn_border_color" value="<?php esc_attr_e( $wbg_btn_border_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Color', WBG_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_font_color" id="wbg_btn_font_color" value="<?php esc_attr_e( $wbg_btn_font_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
    </table>
    <p class="submit"><button id="updateSearchStyles" name="updateSearchStyles" class="button button-primary wbg-button"><?php _e('Save Settings', WBG_TXT_DOMAIN); ?></button></p>

</form>