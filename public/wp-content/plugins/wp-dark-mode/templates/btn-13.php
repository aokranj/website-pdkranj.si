<div class="wp-dark-mode-switcher wp-dark-mode-ignore  style-13  <?php echo ! empty( $class ) ? $class : ''; ?> <?php echo 'yes' == $floating ? "floating $position" : ''; ?>">

	<?php
	!empty($cta_text) && printf( '<span class="wp-dark-mode-switcher-cta wp-dark-mode-ignore">%s <span class="wp-dark-mode-ignore"></span></span>', $cta_text );
	?>

    <label for="wp-dark-mode-switch" class="<?php echo apply_filters( 'wp_dark_mode/switch_label_class', 'wp-dark-mode-ignore' ); ?>">
        <img class="sun-light" src="<?php echo WP_DARK_MODE_ASSETS . '/images/btn-13/sun.svg'; ?>" alt="<?php _e( 'Light',
			'wp-dark-mode' ); ?>">

        <div class="toggle wp-dark-mode-ignore"></div>

        <img class="moon-light" src="<?php echo WP_DARK_MODE_ASSETS . '/images/btn-13/moon.svg'; ?>" alt="<?php _e( 'Dark',
			'wp-dark-mode' ); ?>">
    </label>


</div>