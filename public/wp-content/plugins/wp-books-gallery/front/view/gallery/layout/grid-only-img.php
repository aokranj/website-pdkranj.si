<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<style type="text/css">
    .wbg-main-wrapper .wbg-item {
        padding: 0;
        min-height: auto;
    }
    .wbg-main-wrapper .wbg-item a.wgb-item-link {
        margin: 0;
    }
    .wbg-main-wrapper .wbg-item img {
        margin: 0 auto;
        display: inline-block;
        height: auto !important;
        width: 100% !important;
    }
</style>
<div class="wbg-item" style="box-shadow: none;">
    <?php
    if ( ! $wbg_display_details_page ) {
        ?>
        <a class="wgb-item-link" href="<?php echo esc_url( get_the_permalink( $post->ID ) ); ?>" <?php esc_attr_e( $wbg_details_is_external ); ?>>
            <?php echo $feat_image; ?>
        </a>
        <?php
    } else {
        echo $feat_image;
    }
    ?>
</div>