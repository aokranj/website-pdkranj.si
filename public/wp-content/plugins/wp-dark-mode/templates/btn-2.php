<?php

$light_text  = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_text_light', __('Light', 'wp-dark-mode') );
$dark_text   = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_text_dark', __('Dark', 'wp-dark-mode') );

if ( 'on' != wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'custom_switch_text', 'off' ) ) {
	$light_text = __('Light', 'wp-dark-mode');
	$dark_text  = __('Dark', 'wp-dark-mode');
}


?>

<div class="wp-dark-mode-switcher wp-dark-mode-ignore style-2  <?php echo !empty($class) ? $class : ''; ?> <?php echo 'yes' == $floating ? "floating $position" : ''; ?>">

	<?php
	!empty($cta_text) && printf( '<span class="wp-dark-mode-switcher-cta wp-dark-mode-ignore">%s <span class="wp-dark-mode-ignore"></span></span>', $cta_text );
	?>

    <label for="wp-dark-mode-switch" class="<?php echo apply_filters( 'wp_dark_mode/switch_label_class', 'wp-dark-mode-ignore' ); ?>">
        <div class="toggle wp-dark-mode-ignore"></div>
        <div class="modes wp-dark-mode-ignore">
            <p class="light wp-dark-mode-ignore switch-light-text"><?php echo $light_text; ?></p>
            <p class="dark wp-dark-mode-ignore switch-dark-text"><?php echo $dark_text; ?></p>
        </div>
    </label>

</div>