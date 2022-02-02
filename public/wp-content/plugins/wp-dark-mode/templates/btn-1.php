<div class="wp-dark-mode-switcher wp-dark-mode-ignore  style-1 <?php echo !empty($class) ? $class : ''; ?> <?php echo 'yes' == $floating ? "floating $position" : ''; ?>">

	<?php
	!empty($cta_text) && printf( '<span class="wp-dark-mode-switcher-cta wp-dark-mode-ignore">%s <span class="wp-dark-mode-ignore"></span></span>', $cta_text );
	?>

    <label for="wp-dark-mode-switch" class="<?php echo apply_filters( 'wp_dark_mode/switch_label_class', 'wp-dark-mode-ignore' ); ?>">
        <div class="modes wp-dark-mode-ignore">
            <img class="light" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-1/light.png'; ?>" alt="<?php _e('Light', 'wp-dark-mode'); ?>">
            <img class="dark" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-1/dark.png'; ?>" alt="<?php _e('Dark', 'wp-dark-mode'); ?>">
        </div>
    </label>

</div>