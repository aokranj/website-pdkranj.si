<?php
/**
 * Controls all the switch actions for WP Dark Mode
 *
 * @package WP Dark Mode
 * @since 5.0.0
 */

// Namespace.
namespace WP_Dark_Mode;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit( 1 );

if ( ! class_exists( __NAMESPACE__ . 'Switches' ) ) {
	/**
	 * Controls all the switch actions for WP Dark Mode
	 *
	 * @package WP Dark Mode
	 * @since 5.0.0
	 */
	class Switches extends Base {

		// Use options trait.
		use \WP_Dark_Mode\Traits\Options;

		// Use utility trait.
		use \WP_Dark_Mode\Traits\Utility;

		/**
		 * Actions
		 *
		 * @since 5.0.0
		 */
		public function actions() {
			// Add a template in the footer.
			add_action( 'wp_footer', array( $this, 'load_floating_switch' ), 10 );
			add_action( 'login_footer', array( $this, 'load_floating_switch' ), 10 );
		}

		/**
		 * Adds a template in the footer
		 *
		 * @since 5.0.0
		 * @return void
		 */
		public function load_floating_switch() {

			// Bail, if frontend dark-mode is disabled.
			if ( ! $this->get_option( 'frontend_enabled' ) ) {
				return;
			}

			// Bail, if floating switch is disabled.
			if ( ! $this->get_option( 'floating_switch_enabled' ) ) {
				return;
			}

			if ( $this->is_login_page() && ! $this->get_option( 'floating_switch_enabled_login_pages' ) ) {
				return;
			}

			// Triggers.
			$is_excluded = apply_filters( 'wp_dark_mode_is_excluded', false );

			// If is_exclude is true, then return.
			if ( $is_excluded ) {
				return;
			}

			$options_keys = [
				'display',
				'style',
				'size',
				'size_custom',
				'position',
				'position_side',
				'position_side_value',
				'position_bottom_value',
				'enabled_attention_effect',
				'attention_effect',
				'enabled_cta',
				'cta_text',
				'cta_color',
				'cta_background',
				'enabled_custom_texts',
				'text_light',
				'text_dark',
				'enabled_custom_icons',
				'icon_light',
				'icon_dark',
			];

			$args = [];
			foreach ( $options_keys as $key ) {
				$args[ $key ] = $this->get_option( 'floating_switch_' . $key );
			}

			$this->render_template( 'frontend/floating-switch', $args );
		}

		/**
		 * Check if current page is a login/register page
		 *
		 * @return bool
		 * @since 5.1.0
		 */
		private function is_login_page() {
			global $pagenow;

			// WordPress login page (all actions).
			if ( 'wp-login.php' === $pagenow ) {
				return true;
			}
			return false;
		}
	}

	// Initialize the class.
	Switches::init();
}
