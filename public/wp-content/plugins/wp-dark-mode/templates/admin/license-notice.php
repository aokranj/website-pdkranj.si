<div class="license-activation-notice">
    <div class="wp-dark-mode-notice-icon">
        <img src="<?php echo WP_DARK_MODE_ASSETS.'/images/wp-dark-mode-icon.png'; ?>" alt="WP Dark Mode Icon">
    </div>

    <div class="wp-dark-mode-notice-text">
        <p><strong><?php _e( 'Activate License', 'wp-dark-mode' ); ?> - <?php echo $plugin_name; ?> - <?php _e( 'Version', 'wp-dark-mode' ); ?> <?php echo $version; ?></strong></p>
        <p><?php _e( 'Activate the license for ', 'wp-dark-mode' ); ?><?php echo $plugin_name; ?><?php _e( ' to function properly.',
				'wp-dark-mode' ); ?></p>
    </div>

    <div class="wp-dark-mode-notice-actions">
        <a href="<?php echo admin_url( 'admin.php?page=wp-dark-mode-license' ); ?>" class="button button-primary activate-license"><?php _e( 'Activate License',
				'wp-dark-mode' ); ?></a>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.', 'wp-dark-mode'); ?></span></button>
    </div>
</div>