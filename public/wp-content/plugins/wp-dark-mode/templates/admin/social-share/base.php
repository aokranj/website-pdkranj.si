<div class="wrap wpdarkmode-section wpdarkmode-social-share" x-data="SocialShare" tabindex="0">

    <!-- header  -->
    <h3 class="text-xl font-medium mb-4"><?php echo __('Social Share (Inline Button)', 'wp-dark-mode'); ?></h3>

    <!-- body  -->
    <div class="flex flex-col gap-2 border border-gray-300 bg-white relative">


        <?php

        /**
         * Loader
         */
        wp_dark_mode()->get_template('admin/social-share/loader');

        /**
         * Sidebar nav menu
         */
        wp_dark_mode()->get_template('admin/social-share/sidebar');
        ?>




        <!-- content  -->
        <section class="w-full flex flex-col md:flex-row">
            <!-- 
            <div class="flex items-center gap-3 border-b border-gray-200 py-1.5 px-3">
                <div class="bg-blue-500 text-white rounded-sm h-7 w-7 flex items-center justify-center">
                    <i class="text-sm" :class="currentTab.icon"> </i>
                </div>
                <h3 class="text-lg font-medium" x-text="currentTab.title"></h3>
            </div> -->

            <div class="_content-section">

                <?php


                # Manage channels
                wp_dark_mode()->get_template('admin/social-share/channels');

                # Inline button customization
                wp_dark_mode()->get_template('admin/social-share/customization');

                # Inline button customization
                // wp_dark_mode()->get_template('admin/social-share/social-meta');


                ?>



            </div>


            <?php


# Inline button customization
wp_dark_mode()->get_template('admin/social-share/preview');
?>


        </section>

       


        <!-- content end  -->
    </div>

    <!-- footer  -->

    <?php do_action('wpdarkmode_social_share_footer'); ?>


    <?php wp_dark_mode()->get_template( '/admin/promo'); ?>

</div>