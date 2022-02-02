<div class="wrap">

    <div class="getting-started-wrap">
        <div class="tab-wrap">

            <div class="tab-links">

                <a href="gutenberg" class="tab-link active">
                    <?php _e( 'Gutenberg', 'wp-dark-mode' ); ?>
                </a>

                <a href="elementor" class="tab-link">
                    <?php _e( 'Elementor', 'wp-dark-mode' ); ?>
                </a>

                <a href="widget" class="tab-link">
                    <?php _e( 'Widget', 'wp-dark-mode' ); ?>
                </a>

                <a href="shortcodes" class="tab-link">
                    <?php _e( 'Shortcodes', 'wp-dark-mode' ); ?>
                </a>

                <a href="support" class="tab-link">
                    <?php _e( 'Support', 'wp-dark-mode' ); ?>
                </a>

            </div>



            <div id="gutenberg" class="tab-content active">
                <?php wp_dark_mode()->get_template( '/admin/get-started/gutenberg-block'); ?>
            </div>

            <div id="elementor" class="tab-content">
                <?php wp_dark_mode()->get_template( '/admin/get-started/elementor-widget'); ?>
            </div>

            <div id="widget" class="tab-content">
                <?php wp_dark_mode()->get_template( '/admin/get-started/switch-widget'); ?>
            </div>

            <div id="shortcodes" class="tab-content">
                <?php wp_dark_mode()->get_template( '/admin/get-started/shortcodes'); ?>
            </div>

            <div id="support" class="tab-content">
                <?php wp_dark_mode()->get_template( '/admin/get-started/support'); ?>
            </div>

        </div>
    </div>
</div>