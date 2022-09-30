<!-- Social meta  -->
<section class="w-full max-md p-3  max-w-md h-auto group relative" x-show="isTab('social-meta')" :class=" {'opacity-20' : !isUltimate}" x-transition:enter.opacity.40>

    <!-- Enable social share  -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2" @click="!isUltimate ? showPromo : ''">
            <label for="enable_social_meta" class="font-semibold text-sm text-slate-700 cursor-pointer w-56 flex gap-1"><?php echo __('Enable Social Meta', 'wp-dark-mode'); ?> <span class="wpdarkmode-tooltip" title="<?php echo __('Visitors can share website content with the default share image in case the featured image is unavailable.', 'wp-dark-mode'); ?>"></span> <span x-show="!isPro" class="badge-ultimate"><?php echo __('Ultimate', 'wp-dark-mode'); ?></span></label>
            <label for="enable_social_meta" class="_switcher">
                <input type="checkbox" id="enable_social_meta" x-model="options.enable_social_meta" :disabled="!isUltimate">
                <span></span>
            </label>
        </div>
        <p class="text-slate-500 text-xs"><?php echo __('Social Meta allows website owners to have some control over what content shows up when a web page is shared on social media platforms.', 'wp-dark-mode'); ?></p>
    </div>

    <!-- Facebook Profile ID  -->
    <div class="mb-8">
        <div class="flex flex-col justify-between mb-2">
            <label for="facebook_profile_id" class="font-semibold text-sm text-slate-700 cursor-pointer block mb-2 flex gap-1"><?php echo __('Facebook App ID', 'wp-dark-mode'); ?> <span class="wpdarkmode-tooltip" title="<?php echo __('Enter your Facebook Profile/Page link to share content on your own profile/page.', 'wp-dark-mode'); ?>"></span> <span x-show="!isPro" class="badge-ultimate"><?php echo __('Ultimate', 'wp-dark-mode'); ?></span></label>
            <div>
                <input type="text" class="input-text  disabled:opacity-50" x-model="options.facebook_profile_id" placeholder="Facebook App ID" :disabled="!options.enable_social_meta">
            </div>
        </div>
        <!-- <p class="text-slate-500 text-xs"><?php echo __('Social Meta allows website owners to have some control over what content shows up when a web page is shared on social media platforms.', 'wp-dark-mode'); ?></p> -->
    </div>

    <!-- Twitter  -->
    <div class="mb-8">
        <div class="flex flex-col justify-between mb-0">
            <label for="twitter_username" class="font-semibold text-sm text-slate-700 cursor-pointer block mb-2 flex gap-1"><?php echo __('Twitter Username', 'wp-dark-mode'); ?> <span class="wpdarkmode-tooltip" title="<?php echo __('Enter your Twitter username to share content on your own profile.', 'wp-dark-mode'); ?>"></span> <span x-show="!isPro" class="badge-ultimate"><?php echo __('Ultimate', 'wp-dark-mode'); ?></span></label>
            <div>
                <input type="text" class="input-text  disabled:opacity-50" x-model="options.twitter_username" placeholder="@twitter_username" :disabled="!options.enable_social_meta">
            </div>
        </div>
        <!-- <p class="text-slate-500 text-xs"><?php echo __('Social Meta allows website owners to have some control over what content shows up when a web page is shared on social media platforms.', 'wp-dark-mode'); ?></p> -->
    </div>

    <!-- Default share image  -->
    <div class="mb-8">
        <div class="flex flex-col justify-between mb-0">
            <label for="default_share_image" class="font-semibold text-sm text-slate-700 cursor-pointer block mb-2 flex gap-1"><?php echo __('Default Share Image', 'wp-dark-mode'); ?> <span class="wpdarkmode-tooltip" title="<?php echo __('Upload an image that represents your website when sharing on social channels. This field is used only if Featured Image or post specific image is not set. Recommended size is 1200px by 628px.', 'wp-dark-mode'); ?>"></span> <span x-show="!isPro" class="badge-ultimate"><?php echo __('Ultimate', 'wp-dark-mode'); ?></span></label>
            <div class="flex items-center" :class="{'opacity-50 pointer-events-none' : !options.enable_social_meta}">
                <input type="text" class="input-text rounded-r-none disabled:opacity-50" x-model="options.default_share_image" placeholder="Choose Image or Enter Image Url" :disabled="!options.enable_social_meta">
                <button class="bg-blue-500 text-white px-3 py-2 ring-1 ring-blue-500 rounded-sm font-semibold rounded-l-none" @click.prevent="isUltimate ? openFileUploader : showPromo"><?php echo __('Upload', 'wp-dark-mode'); ?></button>
            </div>
        </div>
        <!-- <p class="text-slate-500 text-xs"><?php echo __('Social Meta allows website owners to have some control over what content shows up when a web page is shared on social media platforms.', 'wp-dark-mode'); ?></p> -->
    </div>

    <wpdm-upgrade @click.prevent="showPromo" x-show="!isUltimate"></wpdm-upgrade>


</section>