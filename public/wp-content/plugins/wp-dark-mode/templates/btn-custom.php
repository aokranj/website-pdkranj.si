<?php

$is_floating = isset( $floating ) && 'yes' == $floating;
$position    = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switcher_position', 'right_bottom' );

$light_img = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_icon_light', WP_DARK_MODE_ASSETS.'/images/btn-7/moon.png' );
$dark_img  = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_icon_dark', WP_DARK_MODE_ASSETS.'/images/btn-7/sun.png' );

?>

<div class="custom-switch wp-dark-mode-switcher wp-dark-mode-ignore  <?php echo $class; ?> <?php echo $is_floating ? "floating $position" : ''; ?>">
    <label for="wp-dark-mode-switch" class="wp-dark-mode-ignore">
        <div class="modes">
            <img src="<?php echo $light_img; ?>" class="light wp-dark-mode-switch-icon wp-dark-mode-switch-icon__light" alt="<?php esc_html_e('Light', 'wp-dark-mode'); ?>">
            <img src="<?php echo $dark_img; ?>" class="dark wp-dark-mode-switch-icon wp-dark-mode-switch-icon__dark" alt="<?php esc_html_e('Dark', 'wp-dark-mode'); ?>">
        </div>
    </label>
</div>