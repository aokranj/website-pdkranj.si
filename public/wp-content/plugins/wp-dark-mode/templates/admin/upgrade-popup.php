<?php
/**
 * Promotional Popup (Legacy)
 * Shows when the user is NOT using the ultimate version of WP Dark Mode.
 *
 * @package WP Dark Mode
 * @since 1.0
 */
// phpcs:ignore
defined( 'ABSPATH' ) || exit();


// Count down time.
$countdown_timer = get_transient( 'wp_dark_mode_promo_countdown_timer' );


if ( empty( $countdown_timer ) || $countdown_timer < time() ) {
	$countdown_timer = strtotime( '+ 14 hours' );
	set_transient( 'wp_dark_mode_promo_countdown_timer', $countdown_timer, 14 * HOUR_IN_SECONDS );
}

$campaign_starts = strtotime( '2026-06-24 17:00:00' );
$campaign_ends = strtotime( '2026-07-14 23:59:59' );

$is_campaign = $campaign_ends > time() && $campaign_starts < time();

// Formatted data.
$data = [
	'counter_time' => $is_campaign ? $campaign_ends : $countdown_timer,
	'discount'     => $is_campaign ? 50 : 16,
];

$class = 'wp-dark-mode-promo-campaign';

?>

<div class="wp-dark-mode-promo hidden <?php echo ! empty( $class ) ? esc_attr( $class ) : ''; ?>">
	<div class="wp-dark-mode-promo-inner">

		<span class="close-promo">&times;</span>

		<img src="<?php echo esc_url( WP_DARK_MODE_ASSETS ) . '/images/gift-box.svg'; ?>" class="promo-img">

		<?php
		echo wp_sprintf( '<h3 class="promo-title">%s</h3>',
		$is_campaign ? esc_html__('SUMMER SALE ☀️', 'wp-dark-mode') : esc_html__( 'Unlock all the features', 'wp-dark-mode' ) );

		echo wp_sprintf( '<div class="discount"> <span class="discount-special">%s</span> <span class="discount-text">%s</span></div>',
			$is_campaign ? esc_html__( 'UP TO', 'wp-dark-mode' ) : esc_html__( 'SPECIAL', 'wp-dark-mode' ),
			/* translators: 1: discount amount, 2: percent sign */
			wp_sprintf( esc_html__( '%1$s%2$s OFF', 'wp-dark-mode' ), esc_html( $data['discount'] ), '%' )
		);
		?>

		<div class="wp-dark-mode-timer">
			<div class="days">
				<span data-days>00</span>
				<span><?php esc_html_e( 'DAYS', 'wp-dark-mode' ); ?></span>
			</div>
			<div class="hours">
				<span data-hours>00</span>
				<span><?php esc_html_e( 'HOURS', 'wp-dark-mode' ); ?></span>
			</div>
			<div class="minutes">
				<span data-minutes>00</span>
				<span><?php esc_html_e( 'MINUTES', 'wp-dark-mode' ); ?></span>
			</div>
			<div class="seconds">
				<span data-seconds>00</span>
				<span><?php esc_html_e( 'SECONDS', 'wp-dark-mode' ); ?></span>
			</div>
		</div>

		<a class="wpdm-popup-button" href="<?php echo esc_url( $is_campaign ? 'https://lnk.wppool.dev/AAGukuk' : 'https://go.wppool.dev/LaSV' ); ?>" target="_blank"><?php echo $is_campaign ? esc_html__( 'Save Now 💰', 'wp-dark-mode' ) : /* translators: 1: discount amount, 2: percent sign */ wp_sprintf( esc_html__( 'Claim %1$s%2$s Discount', 'wp-dark-mode' ), esc_html( $data['discount'] ), '%' ); ?></a>

		<a class="wpdm-popup-demo-link" href="https://go.wppool.dev/bjxy" target="_blank"><?php esc_html_e( 'Try a FREE demo', 'wp-dark-mode' ); ?></a>
	</div>

	<style>
		.promo-title {
			font-size: <?php echo $is_campaign ? 23 : 20; ?>px;
		}
		.wp-dark-mode-promo {
			opacity: .95;
		}

		.wp-dark-mode-promo-inner {
			animation: wp-dark-mode-promo .01s ease-in-out forwards;
		}
		@keyframes wp-dark-mode-promo {
			0% {
				opacity: 0;
				transform: scale(0.8);
			}

			100% {
				opacity: .95;
				transform: scale(1);
			}
		}


		.wp-dark-mode-timer {
			text-align: center;
			padding: 0 0 10px;
		}

		.wp-dark-mode-timer > div {
			display: inline-block;
			margin: 0 10px;

			width: 60px;
			background: url(<?php echo esc_url( WP_DARK_MODE_ASSETS ) . '/images/timer.svg'; ?>) no-repeat center 0;
			background-size: 60px 60px;
			line-height: 40px;
		}

		.wp-dark-mode-timer > div > span:first-child {
			font-size: 28px;
			color: #fff;
			height: 60px;
			margin: 0 0 2px;
			display: block;
			text-align: center;
			line-height: 60px;
			white-space: nowrap;
			overflow: hidden;
		}

		.wp-dark-mode-timer > div > span:last-child {
			font-family: Arial, serif;
			font-size: 12px;
			text-transform: uppercase;
			color: #fff;
		}

		.wp-dark-mode-promo-inner .discount {
			position: relative;
			margin: 45px 0 15px;
		}

		.wp-dark-mode-promo-inner .wpdm-popup-button {
			font-size: 18px;
			padding: 10px 20px;
		}
	</style>


	<script>
	(() => {
		window.WPDarkModePromo = {
			el (selector) {
				return document.querySelector(selector) || null;
			},
			get container() {
				return document.querySelector('.wp-dark-mode-promo') || null;
			},

			get close() {
				return document.querySelector('.wp-dark-mode-promo .close-promo') || null;
			},
			startCountdown () {
				// Use PHP Unix timestamp directly (× 1000 for JS ms).
				// This avoids timezone parsing bugs from date strings without timezone info.
				const countDownDate = <?php echo (int) $data['counter_time']; ?> * 1000;

				const pad = n => String( Math.max( 0, n ) ).padStart( 2, '0' );

				const calc = distance => ( {
					days:    Math.floor( distance / ( 1000 * 60 * 60 * 24 ) ),
					hours:   Math.floor( ( distance % ( 1000 * 60 * 60 * 24 ) ) / ( 1000 * 60 * 60 ) ),
					minutes: Math.floor( ( distance % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 ) ),
					seconds: Math.floor( ( distance % ( 1000 * 60 ) ) / 1000 ),
				} );

				const render = values => {
					['days', 'hours', 'minutes', 'seconds'].forEach( unit => {
						const el = document.querySelector( `[data-${unit}]` );
						if ( el ) el.textContent = pad( values[ unit ] );
					} );
				};

				const zero = () => {
					['days', 'hours', 'minutes', 'seconds'].forEach( unit => {
						const el = document.querySelector( `[data-${unit}]` );
						if ( el ) el.textContent = '00';
					} );
				};

				// Render immediately (no 1-second blank on open).
				const dist0 = countDownDate - Date.now();
				if ( dist0 > 0 ) {
					render( calc( dist0 ) );
				} else {
					zero();
					return;
				}

				const x = setInterval( function () {
					const distance = countDownDate - Date.now();

					if ( distance <= 0 ) {
						clearInterval( x );
						zero();
						return;
					}

					render( calc( distance ) );
				}, 1000 );
			},
			show() {
				this.container?.classList.remove('hidden');

				this.startCountdown();
			},
			hide() {
				this.container?.classList.add('hidden');
			},
			events(){
				// On click close button
				this.close?.addEventListener('click', (e) => {
					e.preventDefault();
					e.stopPropagation();
					this.hide();
				});

				// On click outside
				this.container?.addEventListener('click', e => {
					if (e.target !== this.container) {
						return;
					}

					e.preventDefault();
					e.stopPropagation();
					this.hide();
				});

				// On press escape
				document.addEventListener('keydown', e => {
					if (e.key === 'Escape') {
						e.preventDefault();
						e.stopPropagation();
						this.hide();
					}
				});

				// On click .wp-dark-mode-locked class
				document.addEventListener('click', e => {
					// Has class wp-dark-mode-locked or attribute data-wp-dark-mode-locked for current or parent element
					if ( e.target.closest('.wp-dark-mode-locked') || e.target.closest('[data-wp-dark-mode-locked="true"]') ) {
						e.preventDefault();
						e.stopPropagation();
						this.show();
					}
				});
			}
		}

		// Events
		document.addEventListener('DOMContentLoaded', () => {
			window.WPDarkModePromo.events();
		});
	})()
	</script>

</div>
