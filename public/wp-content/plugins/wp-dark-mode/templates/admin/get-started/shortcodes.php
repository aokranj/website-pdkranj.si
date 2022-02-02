<h3 class="tab-content-title">
    <?php _e( 'Shortcodes', 'wp-dark-mode' ) ?>
	<?php if ( ! wp_dark_mode()->is_pro_active() && ! wp_dark_mode()->is_ultimate_active() ) { ?>
        <a href="https://wppool.dev/wp-dark-mode" target="_blank" class="get_pro_btn">
            <img src="<?php echo WP_DARK_MODE_ASSETS . '/images/gift-box.svg'; ?>" class="promo-img">
	        <?php esc_html_e('50% OFF! GET PRO NOW!', 'wp-dark-mode'); ?>
        </a>
	<?php } ?>
</h3>

<hr>
<br>

<div class="wp-dark-mode-shortcode-doc">
	<p><b>✅</b>
		<b><code>[wp_dark_mode_switch]</code></b> - <?php _e('<b>[wp_dark_mode_switch]</b> shortcode, you can place the dark mode switch button anywhere in your website.
		This shortcode supports an optional <code>style</code> attribute for the switch style from the 7 switch style.
		<br>This shortcode is available in the PRO version.', 'wp-dark-mode'); ?>Using the
	</p>

	<p><b><?php esc_html_e('Examples:', 'wp-dark-mode'); ?></b></p>

	<p style="margin: 10px 0 0 40px"> → <code>[wp_dark_mode_switch]</code> - <?php esc_html_e('Display the default dark mode switch.', 'wp-dark-mode'); ?></p>
	<p style="margin: 10px 0 0 40px"> →
		<code>[wp_dark_mode_switch style="3"]</code> - <?php esc_html_e('Display specific switch style from 7 switch styles.', 'wp-dark-mode'); ?>
	</p>
</div>
<a href="https://wppool.dev/docs/" class="doc_button button-primary" target="_blank"><?php esc_html_e('Explore More', 'wp-dark-mode'); ?></a>


