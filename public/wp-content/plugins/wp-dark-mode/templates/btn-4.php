<div class="wp-dark-mode-switcher wp-dark-mode-ignore  style-4  <?php echo ! empty( $class ) ? $class : ''; ?> <?php echo 'yes' == $floating
	? "floating $position" : ''; ?>">

	<?php
	!empty($cta_text) && printf( '<span class="wp-dark-mode-switcher-cta wp-dark-mode-ignore">%s <span class="wp-dark-mode-ignore"></span></span>', $cta_text );
	?>

    <div class="<?php echo apply_filters( 'wp_dark_mode/switch_label_class', 'wp-dark-mode-ignore switch-wrap' ); ?>">
    <img class="sun-light" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-4/sun-light.png'; ?>" alt="<?php esc_html_e('Light', 'wp-dark-mode'); ?>">
    <img class="sun-dark" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-4/sun-dark.png'; ?>" alt="<?php esc_html_e('Dark', 'wp-dark-mode'); ?>">

    <label for="wp-dark-mode-switch" class="wp-dark-mode-ignore">
        <div class="toggle wp-dark-mode-ignore"></div>
    </label>

    <img class="moon-dark" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-4/moon-dark.png'; ?>" alt="<?php esc_html_e('Dark', 'wp-dark-mode'); ?>">
    <img class="moon-light" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-4/moon-light.png'; ?>" alt="<?php esc_html_e('Light', 'wp-dark-mode'); ?>">

    </div>


</div>