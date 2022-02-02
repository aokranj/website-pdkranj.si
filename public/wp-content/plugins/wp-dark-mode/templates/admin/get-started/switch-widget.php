<h3 class="tab-content-title">
    <?php _e( 'Switch Widget', 'wp-dark-mode' ) ?>

    <?php if(!wp_dark_mode()->is_pro_active() && !wp_dark_mode()->is_ultimate_active()){ ?>
    <a href="https://wppool.dev/wp-dark-mode" target="_blank" class="get_pro_btn">
        <img src="<?php echo WP_DARK_MODE_ASSETS . '/images/gift-box.svg'; ?>" class="promo-img">
	    <?php esc_html_e('50% OFF! &nbsp; GET PRO NOW!', 'wp-dark-mode'); ?>
    </a>
    <?php } ?>

</h3>

<hr>
<br>

<div class="wp-dark-mode-switch-widget-doc">
    <h2><?php esc_html_e('Display Switch Button Using The WP Dark Mode widget.', 'wp-dark-mode'); ?></h2>
    <p><?php _e('You can display the switch button by using the (WP Dark Mode ) wordpress widget, for your users to switch between the dark and normal mode.
        <br>
        <br>
        Dark Mode Switch Widget is available in the PRO version.
        <br>
        <br> For displaying the Darkmode Switch button using the WP Dark Mode widget follow the below steps:', 'wp-dark-mode'); ?></p>
    <p>
        <br>
        ➡️ <?php _e('Add the WP Dark Mode Widget to a sidebar where you want to display the switch button. ', 'wp-dark-mode'); ?><br>
        ➡️ <?php _e('Enter the widget title, if you want to display the widget title ', 'wp-dark-mode'); ?><br>
        ➡️ <?php _e('Select The Switch Style ', 'wp-dark-mode'); ?><br>
        ➡️ <?php _e('Select the position alignment ', 'wp-dark-mode'); ?><br>
        ➡️ <?php _e('Save & you are done. ', 'wp-dark-mode'); ?><br>
        <br>
    </p>

    <p><img src="<?php echo WP_DARK_MODE_ASSETS . '/images/switch-widget.png'; ?>" alt=""></p>

</div>

<a href="https://wppool.dev/docs/" class="doc_button button-primary" target="_blank"><?php esc_html_e('Explore More', 'wp-dark-mode'); ?></a>

