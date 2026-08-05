<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
get_header();

require_once WBG_PATH . 'front/' . WBG_CLS_PRFX . 'front.php';
$wbg_front_new = new WBG_Front(WBG_VERSION);

// General Settings
$wbgGeneralSettings = $wbg_front_new->wbg_get_core_settings();

foreach ( $wbgGeneralSettings as $core_name => $core_value ) {
    if ( isset( $wbgGeneralSettings[$core_name] ) ) {
        ${"" . $core_name} = $core_value;
    }
}
?>
<style type="text/css">
    .wbg-archive-page-wrapper {
        display: inline-block;
        width: 100%;
        min-height: 100px;
        position: relative;
        clear: both;
        margin-top: 50px;
    }
    .wbg-parent-wrapper {
        float: left;
        width: calc(100% - 340px);
        min-height: 100px;
    }
    .wbg-sidebar-right {
        float: left;
        width: 300px;
        min-height: 100px;
        margin-left: 40px;
    }
    @media only screen and (max-width: 766px) {
        .wbg-parent-wrapper {
            width: 100%;
        }
        .wbg-sidebar-right {
            display: none;
        }
    }
</style>
<div class="wbg-archive-page-wrapper">
<?php 
echo do_shortcode("[wp_books_gallery]"); 

if ( $wbg_display_sidebar_archive_page ) {
    ?>
    <div class="wbg-sidebar-right">
        <?php
        if ( function_exists('register_sidebar') ) {
            dynamic_sidebar('Books Gallery Sidebar');
        }
        ?>
    </div>
    <?php
}
?>
</div>
<?php get_footer(); ?>