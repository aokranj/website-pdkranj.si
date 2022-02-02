<?php

defined( 'ABSPATH' ) || exit;

$is_hidden = isset( $is_hidden ) && $is_hidden;
$is_pro    = isset( $is_pro_promo ) && $is_pro_promo;

$data_transient_key = 'wp_dark_mode_promo_data';

$data = [
	'discount' => '50',
	'campaign'      => 'no',
];


if ( get_transient( $data_transient_key ) ) {

    # get saved data 
	$data = get_transient( $data_transient_key );

} else {

    # otherwise get remote data 

	$url = 'https://wppool.dev/wp-json/wppool/plugin_offers';

	$res = wp_remote_get( $url );

	if ( ! is_wp_error( $res ) ) {
		$json      = wp_remote_retrieve_body( $res );
		$formatted = json_decode( $json );

		if ( ! empty( $formatted ) && ! empty( $formatted->wp_dark_mode ) ) {

			$data = [
                'campaign' => $formatted->campaign,
                'counter_time' => $formatted->counter_time,
                'discount' => $formatted->wp_dark_mode->discount,
                'discount_image' => $formatted->wp_dark_mode->discount_image,
            ]; 

            # updates every hour
			set_transient( $data_transient_key, $data, HOUR_IN_SECONDS );
		}

	}
}
 

$time = ! empty( $data['counter_time'] ) ? strtotime( $data['counter_time'] ) : strtotime( '+ 14 hours' );

if ( $time < time() ) {
	$time = strtotime( '+ 14 hours' );
}

$countdown_time = [
	'year'   => date( 'Y', $time ),
	'month'  => date( 'm', $time ),
	'day'    => date( 'd', $time ),
	'hour'   => date( 'H', $time ),
	'minute' => date( 'i', $time ),
];

$pro_title      = __( 'Unlock the PRO features', 'wp-dark-mode' );
$ultimate_title = __( 'Unlock all the features', 'wp-dark-mode' );
$title          = $is_pro ? $pro_title : $ultimate_title;


?>

<div class="wp-dark-mode-promo <?php echo ! empty( $class ) ? $class : ''; ?> hidden">
    <div class="wp-dark-mode-promo-inner">

        <span class="close-promo">&times;</span>

        <img src="<?php echo WP_DARK_MODE_ASSETS . '/images/gift-box.svg'; ?>" class="promo-img">

		<?php

		if ( ! empty( $title ) ) {
			printf( '<h3 class="promo-title">%s</h3>', $title );
		}

		if ( $data['campaign'] == true ) {
			printf( '<img src="%s" class="offer-img">', $data['discount_image'] );
		} else {
			printf( '<div class="discount"> <span class="discount-special">SPECIAL</span> <span class="discount-text">%s\% OFF</span></div>', $data['discount'] );
		}


		if ( ! empty( $countdown_time ) ) {
			echo '<div class="simple_timer"></div>';
		}

		?>

        <a href="https://go.wppool.dev/jrp"
           target="_blank"><?php echo $is_pro ? __('GET PRO', 'wp-dark-mode') : __('GET ULTIMATE', 'wp-dark-mode'); ?></a>

    </div>

    <style>
        .syotimer {
            text-align: center;
            padding: 0 0 10px;
        }

        .syotimer-cell {
            display: inline-block;
            margin: 0 14px;

            width: 50px;
            background: url(<?php echo WP_DARK_MODE_ASSETS.'/images/timer.svg'; ?>) no-repeat 0 0;
            background-size: contain;
        }

        .syotimer-cell__value {
            font-size: 28px;
            color: #fff;

            height: 54px;
            line-height: 54px;

            margin: 0 0 5px;
        }

        .syotimer-cell__unit {
            font-family: Arial, serif;
            font-size: 12px;
            text-transform: uppercase;
            color: #fff;
        }
    </style>


    <script>
        (function ($) {
            $(document).ready(function () {

                //show popup
                $(document).on('click', '.wp-dark-mode-settings-page .disabled', function (e) {
                    e.preventDefault();

                    if ($(this).closest('tr').hasClass('specific_category')) {
                        $(this).closest('form').find('.wp-dark-mode-promo.ultimate_promo').removeClass('hidden');
                    } else {
                        $(this).closest('table').next('.wp-dark-mode-promo').removeClass('hidden');
                    }

                    $('html, body').animate({
                        scrollTop: $('.wp-dark-mode-promo').offset().top
                    }, 'slow');

                });

                //close promo
                $(document).on('click', '.close-promo', function () {
                    $(this).closest('.wp-dark-mode-promo').addClass('hidden');
                });

                //close promo
                $(document).on('click', '.wp-dark-mode-promo', function (e) {

                    if (e.target !== this) {
                        return;
                    }

                    $(this).addClass('hidden');
                });

				<?php
				if ( ! empty( $countdown_time ) ) {

				?>

                if (typeof window.timer_set === 'undefined') {
                    window.timer_set = $('.simple_timer').syotimer({
                        year: <?php echo $countdown_time['year']; ?>,
                        month: <?php echo $countdown_time['month']; ?>,
                        day: <?php echo $countdown_time['day']; ?>,
                        hour: <?php echo $countdown_time['hour']; ?>,
                        minute: <?php echo $countdown_time['minute']; ?>, 
                    });
                }
				<?php } ?>

            })
        })(jQuery);
    </script>

</div>