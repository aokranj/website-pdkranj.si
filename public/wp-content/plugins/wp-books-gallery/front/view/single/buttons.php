<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<span class="wbg-single-button-container">
    <?php 
// Download Button
if ( !$wbg_display_download_button ) {
    if ( !empty( $wbgLink ) ) {
        $download_icon = ( '' !== $wbg_download_btn_icon ? $wbg_download_btn_icon : 'fa-solid fa-download' );
        if ( $wbg_buynow_btn_txt !== '' ) {
            if ( $wbg_download_when_logged_in ) {
                if ( is_user_logged_in() ) {
                    ?>
                        <a href="<?php 
                    echo esc_url( $wbgLink );
                    ?>" class="button wbg-btn" <?php 
                    esc_attr_e( $wbg_dwnld_btn_url_same_tab );
                    ?>>
                            <i class="<?php 
                    esc_attr_e( $download_icon );
                    ?>"></i>&nbsp;<?php 
                    esc_html_e( $wbg_buynow_btn_txt );
                    ?>
                        </a>
                        <?php 
                } else {
                    ?>
                        <a href="<?php 
                    echo esc_url( home_url( '/wp-login.php' ) );
                    ?>" class="button wbg-btn">
                            <i class="<?php 
                    esc_attr_e( $download_icon );
                    ?>"></i>&nbsp;<?php 
                    esc_html_e( $wbg_buynow_btn_txt );
                    ?>
                        </a>
                        <?php 
                }
            }
            if ( !$wbg_download_when_logged_in ) {
                ?>
                    <a href="<?php 
                echo esc_url( $wbgLink );
                ?>" class="button wbg-btn" <?php 
                esc_attr_e( $wbg_dwnld_btn_url_same_tab );
                ?>>
                        <i class="<?php 
                esc_attr_e( $download_icon );
                ?>"></i>&nbsp;<?php 
                esc_html_e( $wbg_buynow_btn_txt );
                ?>
                    </a>
                    <?php 
            }
        }
    }
}
?>
</span>