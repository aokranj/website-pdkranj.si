<?php
/**
 * Custom WPBakery param field: Dark Mode switch style picker.
 *
 * @version 1.0.0
 * @package WP_DARK_MODE
 */

// Namespace.
namespace WP_Dark_Mode\Module\WPBakery\Params;

// phpcs:ignore
defined( 'ABSPATH' ) || exit();

if ( ! class_exists( __NAMESPACE__ . 'SwitchStyle' ) ) {
	/**
	 * Renders the switch style picker field inside the WPBakery element settings form.
	 *
	 * @version 1.0.0
	 */
	class SwitchStyle {

		// Dark Mode Utility.
		use \WP_Dark_Mode\Traits\Utility;

		/**
		 * Whether the scoped style block has already been printed once on this page.
		 *
		 * @var bool
		 * @version 1.0.0
		 */
		protected static $style_printed = false;

		/**
		 * Renders the field markup.
		 *
		 * @param array  $settings Field settings from vc_map() params array.
		 * @param string $value    Current/default value.
		 * @return string
		 * @version 1.0.0
		 */
		public static function render( $settings, $value ) {
			$instance    = new self();
			$styles      = array_merge( array( 1, 2, 3, 23, 24, 22, 20, 21 ), range( 4, 19 ) );
			$is_ultimate = $instance->is_ultimate();
			$assets_url  = WP_DARK_MODE_ASSETS . 'images/switches/';
			$field_name  = esc_attr( $settings['param_name'] );
			$value       = $value ? $value : 1;

			ob_start();

			if ( ! self::$style_printed ) {
				self::$style_printed = true;
				?>
				<style>
					/* WPBakery's settings modal is wider than Elementor's control panel; constrain the shared switch grid so it doesn't stretch into 2 oversized columns. */
					.wp-dark-mode-wpbakery-switch-field ._wp-dark-mode-elementor-switches {
						max-width: 360px;
					}
					/* Elementor's control CSS sets box-sizing: content-box on the label, so its 4px selection border
					   adds to the box's width/height instead of being inset, pushing the box past the grid cell
					   and clipping the border on the far side. Force border-box so the border stays inside the cell. */
					.wp-dark-mode-wpbakery-switch-field ._wp-dark-mode-elementor-switches-item label {
						box-sizing: border-box;
					}
					/* Switch preview SVGs ship at different native sizes (some as large as 500x500); constrain them
					   to a uniform box so one oversized image doesn't blow up the whole grid row. */
					.wp-dark-mode-wpbakery-switch-field ._wp-dark-mode-elementor-switches-item img {
						max-width: 100%;
						max-height: 48px;
						width: auto;
						height: auto;
					}
					/* Positions the lock badge (matching the Gutenberg block's locked-style indicator)
					   in the corner of a locked style tile. */
					.wp-dark-mode-wpbakery-switch-field ._wp-dark-mode-elementor-switches-item {
						position: relative;
					}
					.wp-dark-mode-wpbakery-switch-field .wp-dark-mode-wpbakery-switch-lock {
						position: absolute;
						top: 4px;
						right: 4px;
						pointer-events: none;
					}
				</style>
				<?php
			}
			?>
			<div class="wp-dark-mode-wpbakery-switch-field _wp-dark-mode-elementor" data-field-name="<?php echo esc_attr( $field_name ); ?>">
				<input
					type="hidden"
					name="<?php echo esc_attr( $field_name ); ?>"
					class="wpb_vc_param_value wp-dark-mode-wpbakery-switch-input <?php echo esc_attr( $field_name ); ?>"
					value="<?php echo esc_attr( $value ); ?>"
				/>
				<div class="_wp-dark-mode-elementor-switches">
					<?php
					foreach ( $styles as $style_id ) {
						$locked = ! $is_ultimate && $style_id > 3 && 23 !== (int) $style_id;
						?>
						<div class="_wp-dark-mode-elementor-switches-item elementor-control-input-wrapper<?php echo $locked ? ' wp-dark-mode-locked' : ''; ?>">
							<input
								id="<?php echo esc_attr( $field_name . '-' . $style_id ); ?>"
								type="radio"
								name="<?php echo esc_attr( $field_name . '_radio' ); ?>"
								value="<?php echo esc_attr( $style_id ); ?>"
								<?php disabled( $locked ); ?>
								<?php checked( (int) $value, (int) $style_id ); ?>
							/>
							<label for="<?php echo esc_attr( $field_name . '-' . $style_id ); ?>" title="<?php echo esc_attr( 'Style ' . $style_id ); ?>">
								<img src="<?php echo esc_url( $assets_url . 'switch-' . $style_id . '.svg' ); ?>" alt="<?php echo esc_attr( 'Style ' . $style_id ); ?>" />
							</label>
							<?php if ( $locked ) { ?>
								<div class="wp-dark-mode-wpbakery-switch-lock">
									<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="23" height="23" rx="11.5" fill="white" />
										<path d="M14.7498 9.55H9.5498V8.25C9.5498 7.73 9.7448 7.275 10.1348 6.885C10.9148 6.105 12.1498 6.105 12.8648 6.885C13.1248 7.145 13.2548 7.47 13.3848 7.795C13.4498 8.12 13.8398 8.315 14.1648 8.25C14.4898 8.185 14.7498 7.795 14.6198 7.47C14.4898 6.885 14.1648 6.365 13.7748 5.975C13.1898 5.325 12.3448 5 11.4998 5C9.6798 5 8.2498 6.43 8.2498 8.25V9.55C7.1448 9.55 6.2998 10.395 6.2998 11.5V16.05C6.2998 17.155 7.1448 18 8.2498 18H14.7498C15.8548 18 16.6998 17.155 16.6998 16.05V11.5C16.6998 10.395 15.8548 9.55 14.7498 9.55ZM12.1498 14.75C12.1498 15.14 11.8898 15.4 11.4998 15.4C11.1098 15.4 10.8498 15.14 10.8498 14.75V12.8C10.8498 12.41 11.1098 12.15 11.4998 12.15C11.8898 12.15 12.1498 12.41 12.1498 12.8V14.75Z" fill="#FB923C" />
									</svg>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}
	}
}
