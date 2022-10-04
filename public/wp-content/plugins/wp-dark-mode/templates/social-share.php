<!-- Social Share Buttons  -->
<?php


# Share count in a single page
global $wpdb;
$counters = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT count(ID) as count, channel FROM {$wpdb->prefix}wpdm_social_shares WHERE post_id = %d OR url = %s group by channel",
        get_the_ID(),
        get_permalink()
    ),
    ARRAY_A
);

$totalShares = array_sum(array_column($counters, 'count'));


/**
 * Channels
 */

if ($social_share->channels) {

    $channels = array_map(function ($channel) use ($counters, $social_share) {

        $mother_channel = array_filter($social_share->all_channels, function ($item) use ($channel) {
            return $item['id'] === $channel['id'];
        });

        $svg = array_values($mother_channel)[0]['svg'];

        $channel['svg'] = $svg ?? '';


        $count = array_values(array_filter($counters, function ($counter) use ($channel) {
            return $counter['channel'] === $channel['id'];
        }));

        if ($social_share->button_label === 'both' || $social_share->button_label === 'share_count') {
            $count = $count[0]['count'] ?? 0;

            $channel['count'] = apply_filters('wpdm_social_share_count', $count);
        }

        return $channel;
    }, $social_share->channels);
} else {
    $channels = false;
}

/**
 * Visible channels
 */

$channel_visibility = intval($social_share->channel_visibility);

$visible_channels = $channels;

if ($channel_visibility > 0) {
    $visible_channels = array_slice($visible_channels, 0, $channel_visibility);
}


/***
 * Right after the social share buttons
 */
do_action('before_wpdm_social_share');

?>


<section class="_social-share-container wp-dark-mode-ignore _align-<?php echo $social_share->button_alignment; ?> <?php echo $social_share->hide_button_on['mobile'] ? '' : '_hide-on-mobile' ?> <?php echo $social_share->hide_button_on['desktop'] ? '' : '_hide-on-desktop' ?>">

    <!-- Share label  -->
    <?php if (!empty($social_share->share_via_label)) : ?>
        <div class="_share-label wp-dark-mode-ignore"><?php echo esc_html($social_share->share_via_label); ?></div>
    <?php endif; ?>

    <div class="_channels-container wp-dark-mode-ignore _channel-animation-1 <?php

                                                                                echo '_channel-template-' . esc_html($social_share->button_template);
                                                                                echo ' ';
                                                                                echo ((bool) $social_share->button_spacing) == true ? '_spaced' : '_no-spaced';
                                                                                echo ' ';
                                                                                echo ('_' . esc_html($social_share->button_shape ?? 'rounded'));
                                                                                echo ' ';
                                                                                echo $social_share->button_label === 'both' ? '_both-label' : '';
                                                                                echo ' '; ?>">

        <!-- Share label  -->
        <?php if ((bool) $social_share->show_total_share_count && $social_share->minimum_share_count <= $totalShares) : ?>
            <div class="_total-share wp-dark-mode-ignore">


                <div class="_total-share-count">
                    <span><?php echo apply_filters('wpdm_social_share_count', intval($totalShares)); ?></span>
                    <span><?php echo esc_html($social_share->shares_label); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <div class="_channels wp-dark-mode-ignore">
            <!-- Share Icons  -->
            <?php

            if ($visible_channels && count($visible_channels) > 0) :

                foreach ($visible_channels as $channel) :

            ?>

                    <div class="wpdm-social-share-button wp-dark-mode-ignore _channel _icon-<?php echo esc_html($channel['id']); ?> <?php echo $channel['visibility']['mobile'] ? '' : '_hide-on-mobile'; ?> <?php echo $channel['visibility']['desktop'] ? '' : '_hide-on-desktop'; ?>" data-channel="<?php echo esc_html($channel['id']); ?>">
                        <span class="_channel-icon wp-dark-mode-ignore <?php echo $social_share->button_label === 'none' ? '_channel-icon-full' : ''; ?>">
                            <span>
                                <?php echo wp_kses($channel['svg'], $social_share->get_kses_extended_ruleset);  ?>
                            </span>
                        </span>

                        <?php if ($social_share->button_label !== 'none') : ?>

                            <div class="_channel-label">
                                <?php if ($social_share->button_label !== 'share_count') : ?>
                                    <span class="_channel-name wp-dark-mode-ignore">
                                        <span>
                                            <?php echo esc_html($channel['name']); ?>
                                        </span>
                                    </span>
                                <?php endif; ?>

                                <?php if (isset($channel['count']) && $social_share->button_label !== 'channel_label') : ?>
                                    <span class="_channel-count wp-dark-mode-ignore">
                                        <span><?php echo esc_html($channel['count']); ?></span>
                                    </span>
                                <?php else : ?>
                                    <span></span>
                                <?php endif; ?>
                            </div>

                        <?php endif; ?>

                        <div class="_channel-overlay"></div>



                    </div>

            <?php endforeach;
            endif;
            ?>

            <!-- more buttons  -->

            <?php
            if (count($social_share->channels) > $social_share->channel_visibility) : ?>
                <div class="wpdm-social-share-button wp-dark-mode-ignore _channel _icon-light _<?php echo esc_html($social_share->button_shape ?? 'rounded'); ?>" data-channel="more">
                    <span class="_channel-icon wp-dark-mode-ignore">
                        <span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg></span>
                    </span>
                    <div class="_channel-label">
                        <span class="_channel-name wp-dark-mode-ignore"><?php echo esc_html($social_share->more_label); ?></span>
                        <span></span>
                        <div class="_channel-overlay"></div>
                    </div>


                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- modal  -->
    <?php
    if (count($social_share->channels) > $social_share->channel_visibility) : ?>

        <div class="_wpdm-social-share-modal-overlay wp-dark-mode-ignore" style="display: none;"></div>

        <div class="_wpdm-social-share-modal _fixed-size-large" style="display: none;">

            <div class="_wpdm-social-share-modal-header wp-dark-mode-ignore">
                <div class="_wpdm-social-share-modal-title">
                    <?php echo !empty($social_share->share_via_label) ? esc_html($social_share->share_via_label) : __('Share via:', 'wp-dark-mode'); ?>
                </div>
                <!-- close  -->
                <div class="_wpdm-social-share-modal-close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </div>

            </div>

            <div class="_wpdm-social-share-modal-body wp-dark-mode-ignore">

                <div class="_channels-container _inside_modal wp-dark-mode-ignore _spaced _rounded _channel-animation-5 _channel-template-1">
                    <div class="_channels _channels-inside-modal wp-dark-mode-ignore">
                        <!-- Share Icons  -->
                        <?php

                        if ($channels && count($channels) > 0) :

                            foreach ($channels as $channel) :

                        ?>

                                <div class="wpdm-social-share-button wp-dark-mode-ignore _channel _icon-<?php echo esc_html($channel['id']); ?> _rounded <?php echo $channel['visibility']['mobile'] ? '' : '_hide-on-mobile'; ?> <?php echo $channel['visibility']['desktop'] ? '' : '_hide-on-desktop'; ?>" data-channel="<?php echo esc_html($channel['id']); ?>">
                                    <span class="_channel-icon wp-dark-mode-ignore">
                                        <span>
                                            <?php echo wp_kses($channel['svg'], $social_share->get_kses_extended_ruleset); ?>
                                        </span>
                                    </span>

                                    <div class="_channel-label">
                                        <span class="_channel-name wp-dark-mode-ignore"><span><?php echo esc_html($channel['name']); ?></span></span>
 
                                        <span class="_channel-count wp-dark-mode-ignore"><span><?php echo esc_html($channel['count'] ?? 0); ?></span></span> 
                                    </div>

                                    <div class="_channel-overlay"></div>
                                </div>

                        <?php endforeach;
                        endif;
                        ?>

                    </div>
                </div>

            </div>

        </div>
    <?php endif; ?>


</section>


<?php

/***
 * Right after the social share buttons
 */
do_action('after_wpdm_social_share');

?>