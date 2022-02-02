<p><?php esc_html_e('Hi there, you have been using WP Dark Mode for while now. Do you know that WP Dark Mode has an affiliate program?
    join now get 25% commission from each sale.', 'wp-dark-mode'); ?>
</p>

<div class="notice-actions">
    <a class="hide_notice button button-primary" data-value="hide_notice" href="https://wppool.dev/affiliates/" target="_blank">
        Tell me more <i class="dashicons dashicons-arrow-right-alt"></i></a>

    <span class="dashicons dashicons-dismiss"></span>

</div>

<div class="notice-overlay-wrap">
    <div class="notice-overlay">
        <h4><?php esc_html_e('Would you like us to remind you about this later?', 'wp-dark-mode'); ?></h4>

        <div class="notice-overlay-actions">
            <a href="#" data-value="3"><?php esc_html_e('Remind me in 3 days', 'wp-dark-mode'); ?></a>
            <a href="#" data-value="10"><?php esc_html_e('Remind me in 10 days', 'wp-dark-mode'); ?></a>
            <a href="#" data-value="hide_notice"><?php esc_html_e('Don\'t remind me about this', 'wp-dark-mode'); ?></a>
        </div>

        <button type="button" class="close-notice">&times;</button>
    </div>
</div>
