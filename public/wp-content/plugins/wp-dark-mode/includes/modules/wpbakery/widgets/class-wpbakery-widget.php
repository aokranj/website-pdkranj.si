<?php
/**
 * Handles the WPBakery element for wp dark mode.
 *
 * @since 1.0.0
 * @package WP_DARK_MODE
 */

// Namespace.
namespace WP_Dark_Mode\Module\WPBakery\Widgets;

// phpcs:ignore
defined( 'ABSPATH' ) || exit();

if ( ! class_exists( __NAMESPACE__ . 'DarkModeElement' ) ) {
	/**
	 * Renders the Dark Mode Switch element output for WPBakery Page Builder.
	 *
	 * @version 1.0.0
	 */
	class DarkModeElement extends \WPBakeryShortCode {

		/**
		 * Renders the shortcode output using the shared core renderer.
		 *
		 * @param array  $atts Shortcode attributes.
		 * @param string $content Inner content, unused.
		 * @return string
		 * @version 1.0.0
		 */
		public function content( $atts, $content = null ) {
			return $this->render_switch( $atts );
		}

		/**
		 * Renders the switch via the plugin's shared shortcode renderer.
		 *
		 * @param array $atts Shortcode attributes.
		 * @return string
		 * @version 1.0.0
		 */
		protected function render_switch( $atts ) {
			$atts = shortcode_atts(
				array(
					'style'   => 1,
					'size'    => 1,
					'classes' => '',
				),
				$atts
			);

			return do_shortcode(
				wp_sprintf(
					'[wp_dark_mode style="%s" size="%s" classes="%s"]',
					esc_attr( $atts['style'] ),
					esc_attr( $atts['size'] ),
					esc_attr( $atts['classes'] )
				)
			);
		}
	}
}
