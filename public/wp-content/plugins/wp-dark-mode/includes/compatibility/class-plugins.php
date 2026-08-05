<?php
/**
 * WP Dark Mode Plugin Compatibility Handler
 *
 * This class handles plugins that require PHP logic (hooks, filters, dynamic behavior).
 * For CSS-only fixes, add SCSS files to src/assets/plugins/ - they auto-load.
 *
 * @package WP_Dark_Mode
 */

namespace WP_Dark_Mode\Compatibility;

//phpcs:ignore
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Plugins' ) ) {

	/**
	 * Plugin Compatibility Handler
	 *
	 * Only loaded when plugins requiring PHP logic are active.
	 * CSS-only compatibility is handled automatically via SCSS files.
	 */
	class Plugins extends \WP_Dark_Mode\Base {

		/**
		 * This class is intentionally minimal.
		 *
		 * Add methods here only when plugins need PHP hooks, filters, or dynamic behavior.
		 * For CSS-only fixes, use SCSS files in src/assets/plugins/ instead.
		 *
		 * Example method structure:
		 *
		 * public function plugin_name() {
		 *     add_filter( 'plugin_hook', [ $this, 'modify_plugin_behavior' ] );
		 * }
		 *
		 * private function modify_plugin_behavior( $value ) {
		 *     // Plugin-specific logic here
		 *     return $value;
		 * }
		 */
	}
}
