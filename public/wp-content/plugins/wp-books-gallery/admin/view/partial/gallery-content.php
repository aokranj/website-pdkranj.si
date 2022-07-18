<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wpsdGallerySettingsContent );
foreach ( $wpsdGallerySettingsContent as $option_name => $option_value ) {
    if ( isset( $wpsdGallerySettingsContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-settings-form">
    <table class="wbg-gallery-conent-settings-table">
        <tr class="wbg_gallary_column">
            <th scope="row">
                <label for="wbg_gallary_column"><?php 
_e( 'Gallary Columns', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td colspan="3">
                <label for="wbg_gallary_column_mobile"><?php 
_e( 'Desktop', WBG_TXT_DOMAIN );
?>:</label>
                <select name="wbg_gallary_column" class="medium-text">
                    <?php 
for ( $dc = 1 ;  $dc < 6 ;  $dc++ ) {
    ?>
                        <option value="<?php 
    esc_attr_e( $dc );
    ?>" <?php 
    echo  ( $dc == $wbg_gallary_column ? 'selected' : '' ) ;
    ?> ><?php 
    printf( '%d', $dc );
    ?></option>
                        <?php 
}
?>
                </select>
                &nbsp;&nbsp;&nbsp;
                <label for="wbg_gallary_column_mobile"><?php 
_e( 'Mobile', WBG_TXT_DOMAIN );
?>:</label>
                <select name="wbg_gallary_column_mobile" class="medium-text">
                    <option value="1" <?php 
echo  ( '1' == $wbg_gallary_column_mobile ? 'selected' : '' ) ;
?> ><?php 
_e( '1', WBG_TXT_DOMAIN );
?></option>
                    <option value="2" <?php 
echo  ( '2' == $wbg_gallary_column_mobile ? 'selected' : '' ) ;
?> ><?php 
_e( '2', WBG_TXT_DOMAIN );
?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Image Width', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="radio" name="wbg_book_cover_width" id="wbg_book_cover_width_d" value="default" <?php 
echo  ( 'full' !== $wbg_book_cover_width ? 'checked' : '' ) ;
?> >
                <label for="wbg_book_cover_width_d"><span></span><?php 
_e( 'Small', WBG_TXT_DOMAIN );
?></label>
                &nbsp;&nbsp;
                <input type="radio" name="wbg_book_cover_width" id="wbg_book_cover_width_f" value="full" <?php 
echo  ( 'full' === $wbg_book_cover_width ? 'checked' : '' ) ;
?> >
                <label for="wbg_book_cover_width_f"><span></span><?php 
_e( 'Full', WBG_TXT_DOMAIN );
?></label>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Image Animation', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <select name="wbg_book_image_animation" class="medium-text">
                    <option value=""><?php 
_e( 'None', WBG_TXT_DOMAIN );
?></option>
                    <option value="rotate-360" <?php 
echo  ( 'rotate-360' === $wbg_book_image_animation ? 'selected' : '' ) ;
?> ><?php 
_e( 'Rotate 360', WBG_TXT_DOMAIN );
?></option>
                    <?php 
?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Books Sorting By', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <select name="wbg_gallary_sorting" class="medium-text">
                    <option value="">--<?php 
_e( 'Select One', WBG_TXT_DOMAIN );
?>--</option>
                    <option value="title" <?php 
echo  ( 'title' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Name', WBG_TXT_DOMAIN );
?></option>
                    <option value="name" <?php 
echo  ( 'name' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Slug/Url', WBG_TXT_DOMAIN );
?></option>
                    <option value="wbg_author" <?php 
echo  ( 'wbg_author' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Author', WBG_TXT_DOMAIN );
?></option>
                    <option value="date" <?php 
echo  ( 'date' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Date', WBG_TXT_DOMAIN );
?></option>
                    <option value="wbg_publisher" <?php 
echo  ( 'wbg_publisher' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Publisher', WBG_TXT_DOMAIN );
?></option>
                    <option value="wbg_published_on" <?php 
echo  ( 'wbg_published_on' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Published On', WBG_TXT_DOMAIN );
?></option>
                    <option value="wbg_language" <?php 
echo  ( 'wbg_language' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Language', WBG_TXT_DOMAIN );
?></option>
                    <option value="wbg_country" <?php 
echo  ( 'wbg_country' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Country', WBG_TXT_DOMAIN );
?></option>
                </select>
            </td>
            <th scope="row">
                <label for="wbg_books_order"><?php 
_e( 'Order By', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="radio" name="wbg_books_order" id="wbg_books_order_a" value="ASC" <?php 
echo  ( 'DESC' !== $wbg_books_order ? 'checked' : '' ) ;
?> >
                <label for="wbg_books_order_a"><span></span><?php 
_e( 'Ascending', WBG_TXT_DOMAIN );
?></label>
                    &nbsp;&nbsp;
                <input type="radio" name="wbg_books_order" id="wbg_books_order_d" value="DESC" <?php 
echo  ( 'DESC' === $wbg_books_order ? 'checked' : '' ) ;
?> >
                <label for="wbg_books_order_d"><span></span><?php 
_e( 'Descending', WBG_TXT_DOMAIN );
?></label>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_display_details_page"><?php 
_e( 'Enable Book Details Page', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_details_page" id="wbg_display_details_page" value="1"
                    <?php 
echo  ( $wbg_display_details_page ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_details_is_external"><?php 
_e( 'Open in New Tab', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_details_is_external" id="wbg_details_is_external" value="1"
                    <?php 
echo  ( $wbg_details_is_external ? 'checked' : '' ) ;
?> >
            </td>
        </tr>
        <tr class="wbg_title_length">
            <th scope="row">
                <label for="wbg_title_length"><?php 
_e( 'Title Word Length', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td colspan="3">
                <input type="number" name="wbg_title_length" class="medium-text" min="1" max="50" step="1" value="<?php 
esc_attr_e( $wbg_title_length );
?>">
            </td>
        </tr>
        <tr class="wbg_display_category">
            <th scope="row">
                <label for="wbg_display_category"><?php 
_e( 'Display Category', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_category" class="wbg_display_category" id="wbg_display_category" value="1"
                    <?php 
echo  ( $wbg_display_category ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_cat_label_txt"><?php 
_e( 'Category Label Text', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_cat_label_txt" placeholder="<?php 
_e( 'Category', WBG_TXT_DOMAIN );
?>:" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_cat_label_txt );
?>">
            </td>
        </tr>
        <tr class="wbg_display_author">
            <th scope="row">
                <label for="wbg_display_author"><?php 
_e( 'Display Author', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_author" class="wbg_display_author" id="wbg_display_author" value="1"
                    <?php 
echo  ( $wbg_display_author ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_author_label_txt"><?php 
_e( 'Author Label Text', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_author_label_txt" placeholder="<?php 
_e( 'By:', WBG_TXT_DOMAIN );
?>" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_author_label_txt );
?>">
            </td>
        </tr>
        <tr class="wbg_display_description">
            <th scope="row">
                <label for="wbg_display_description"><?php 
_e( 'Display Description', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_description" class="wbg_display_description" id="wbg_display_description" value="1"
                    <?php 
echo  ( $wbg_display_description ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_description_length"><?php 
_e( 'Description Word Length', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="number" name="wbg_description_length" class="medium-text" min="1" max="100" step="1" value="<?php 
esc_attr_e( $wbg_description_length );
?>">
            </td>
        </tr>
        <tr class="wbg_display_buynow">
            <th scope="row">
                <label for="wbg_display_buynow"><?php 
_e( 'Display Download Button', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_buynow" class="wbg_display_buynow" id="wbg_display_buynow" value="1"
                    <?php 
echo  ( $wbg_display_buynow ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_buynow_btn_txt"><?php 
_e( 'Button Text', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_buynow_btn_txt" placeholder="<?php 
_e( 'Download', WBG_TXT_DOMAIN );
?>" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_buynow_btn_txt );
?>">
            </td>
        </tr>
        <tr class="wbg_display_buy_now">
            <th scope="row">
                <label for="wbg_display_buy_now"><?php 
_e( 'Display Buy Now Button', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label for="wbg_buy_now_btn_txt"><?php 
_e( 'Button Text', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wbg_display_total_books">
            <th scope="row">
                <label for="wbg_display_total_books"><?php 
_e( 'Display Total Books', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_total_books" class="wbg_display_total_books" id="wbg_display_total_books" value="1"
                    <?php 
echo  ( $wbg_display_total_books ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_display_sorting"><?php 
_e( 'Display Front Sorting', WBG_TXT_DOMAIN );
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
_e( 'Books Per Page', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label for="wbg_display_pagination"><?php 
_e( 'Display Pagination', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Currency', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="wbg_gallery_button_bottom_align"><?php 
_e( 'Button Bottom Align', WBG_TXT_DOMAIN );
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
                <label for="wbg_display_rating"><?php 
_e( 'Display Rating', WBG_TXT_DOMAIN );
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

        <?php 
do_action( 'wbg_admin_general_settings_after_display_total_books' );
?>

        <tr class="wbg_shortcode">
            <th scope="row">
                <label for="wbg_shortcode"><?php 
_e( 'Shortcode:', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_shortcode" id="wbg_shortcode" class="medium-text" value="[wp_books_gallery]" readonly />
                <br>
                <code><?php 
_e( 'Copy this shortcode and apply it to any page to display books gallery.', WBG_TXT_DOMAIN );
?></code>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateGalleryContentSettings" name="updateGalleryContentSettings" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', WBG_TXT_DOMAIN );
?>
        </button>
    </p>
</form>