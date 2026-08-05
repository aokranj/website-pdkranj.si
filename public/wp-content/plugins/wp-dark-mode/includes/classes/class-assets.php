<?php
/**
 * Enqueues script and styles to frontend for WP Dark Mode
 *
 * @package WP Dark Mode
 * @since 5.0.0
 */

// Namespace.
namespace WP_Dark_Mode;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit( 1 );

if ( ! class_exists( __NAMESPACE__ . 'Assets' ) ) {
	/**
	 * Enqueues script and styles to frontend for WP Dark Mode
	 *
	 * @package WP Dark Mode
	 * @since 5.0.0
	 */
	class Assets extends Base {

		// Use options trait.
		use \WP_Dark_Mode\Traits\Options;

		// Use utility trait.
		use \WP_Dark_Mode\Traits\Utility;

		/**
		 * Register hooks.
		 *
		 * @since 5.0.0
		 */
		public function actions() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 0 );
			add_action( 'login_enqueue_scripts', array( $this, 'enqueue_scripts' ), 0 );

			// Modify script async.
			add_filter( 'script_loader_tag', array( $this, 'script_loader_tag' ), 10, 2 );
		}

		/**
		 * Check if elementor editor mode.
		 *
		 * @since 5.0.0
		 * @return bool
		 */
		public function is_elementor_editor_mode() {
			if ( ! class_exists( '\Elementor\Plugin' ) ) {
				return false;
			}

			$is_editor_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();

			return $is_editor_mode;
		}

		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 5.0.0
		 */
		public function enqueue_scripts() {

			// Check if the plugin is enabled.
			if ( ! $this->get_option( 'frontend_enabled' ) ) {
				return;
			}

			// Enqueue styles.
			wp_enqueue_style( 'wp-dark-mode', WP_DARK_MODE_ASSETS . 'css/app.min.css', array(), WP_DARK_MODE_VERSION );

			$css = $this->get_inline_styles();
			wp_add_inline_style( 'wp-dark-mode', $css );

			// Load scripts in footer.
			$script_in_footer = apply_filters( 'wp_dark_mode_loads_scripts_in_footer', $this->get_option( 'performance_load_scripts_in_footer' ) );

			wp_enqueue_script( 'wp-dark-mode-automatic', WP_DARK_MODE_ASSETS . 'js/dark-mode.js', [], WP_DARK_MODE_VERSION, false );
			wp_enqueue_script( 'wp-dark-mode', WP_DARK_MODE_ASSETS . 'js/app.min.js', [ 'wp-dark-mode-automatic' ], WP_DARK_MODE_VERSION, $script_in_footer );

			// Localize scripts.
			$localize_scripts = array(
				'security_key' => wp_create_nonce( 'wp_dark_mode_security' ),
				'is_pro' => $this->is_ultimate(),
				'version' => WP_DARK_MODE_VERSION,
				'is_excluded' => apply_filters( 'wp_dark_mode_is_excluded', false ),
				'excluded_elements' => $this->get_excluded_elements(),
				'options' => $this->get_options(),
				'analytics_enabled' => $this->get_option( 'analytics_enabled' ),
				'url' => [
					'ajax' => admin_url( 'admin-ajax.php' ),
					'home' => home_url(),
					'admin' => admin_url(),
					'assets' => WP_DARK_MODE_ASSETS,
				],
				'debug' => defined( 'WP_DEBUG' ) && WP_DEBUG,
				'additional' => [
					'is_elementor_editor' => class_exists( 'Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode(),
				],
			);

			wp_localize_script( 'wp-dark-mode', 'wp_dark_mode_json', apply_filters( 'wp_dark_mode_json', $localize_scripts ) );

			// Inline Scripts.
			$inline_scripts = $this->get_inline_scripts();

			if ( ! empty( $inline_scripts ) ) {
				wp_add_inline_script( 'wp-dark-mode', $inline_scripts );
			}

			// SVG Icons.
			$config = new \WP_Dark_Mode\Config();
			$svg_icons = $config->get_svg_icons();
			wp_localize_script( 'wp-dark-mode', 'wp_dark_mode_icons', $svg_icons );
		}

		/**
		 * Get inline scripts
		 *
		 * @since 5.0.0
		 * @return string
		 */
		public function get_inline_scripts() {
			$js = '';

			return apply_filters( 'wp_dark_mode_inline_scripts', $js );
		}

		/**
		 * Get excluded elements
		 *
		 * @since 5.0.0
		 * @return string
		 */
		public function get_excluded_elements() {
			$excluded = '';

			if ( true === $this->get_option('excludes_elements_all' ) ) {
				$exclude_all_except = $this->get_option( 'excludes_elements_except', '' );
				$excluded = ! empty( $exclude_all_except ) ? 'html *:not(' . $exclude_all_except . ')' : '*';
			} else {
				$excluded = $this->get_option( 'excludes_elements', '' );
			}

			return apply_filters( 'wp_dark_mode_excluded_elements', $excluded );
		}


		/**
		 * Returns inline styles for WP Dark Mode
		 *
		 * @since 5.0.0
		 * @return string
		 */
		public function get_inline_styles() {

			// Filter for body.
			$filter_brightness = $this->get_option( 'color_filter_brightness' );
			$filter_contrast = $this->get_option( 'color_filter_contrast' );
			$filter_grayscale = $this->get_option( 'color_filter_grayscale' );
			$filter_sepia = $this->get_option( 'color_filter_sepia' );

			$body_filter = wp_sprintf( 'brightness(%s%%) contrast(%s%%) grayscale(%s%%) sepia(%s%%)', $filter_brightness, $filter_contrast, $filter_grayscale, $filter_sepia );

			// Image and video filters.
			$img_brightness = $this->get_option( 'image_enabled_low_brightness' ) ? $this->get_option( 'image_brightness' ) : '100';
			$img_grayscale = $this->get_option( 'image_enabled_low_grayscale' ) ? $this->get_option( 'image_grayscale' ) : '0';
			$video_brightness = $this->get_option( 'video_enabled_low_brightness' ) ? $this->get_option( 'video_brightness' ) : '100';
			$video_grayscale = $this->get_option( 'video_enabled_low_grayscale' ) ? $this->get_option( 'video_grayscale' ) : '0';

			$typography_enabled = $this->get_option( 'typography_enabled' );
			$typography_font_size = $this->get_option( 'typography_font_size' );

			$font_size = 1;
			if ( $typography_enabled ) {
				$font_size = $typography_font_size;
				if ( 'custom' === $typography_font_size ) {
					$font_size = $this->get_option( 'typography_font_size_custom' ) / 100;
				}
			}

			$font_size = wp_sprintf( '%sem', $font_size );

			$css = wp_sprintf('html[data-wp-dark-mode-active], [data-wp-dark-mode-loading] {
				--wpdm-body-filter: %s;
				--wpdm-grayscale: %s%%;
	--wpdm-img-brightness: %s%%;
	--wpdm-img-grayscale: %s%%;
	--wpdm-video-brightness: %s%%;
	--wpdm-video-grayscale: %s%%;

	--wpdm-large-font-sized: %s;
}' . "\n", $body_filter, $filter_grayscale, $img_brightness, $img_grayscale, $video_brightness, $video_grayscale, $font_size);

			// Preset styles.
			$css .= $this->get_preset_styles();

			// Get Custom CSS.
			$css .= $this->get_custom_css();

			// Minify CSS.
			// $css = $this->minify( $css );

			return apply_filters( 'wp_dark_mode_inline_styles', $css );
		}

		/**
		 * Returns preset styles for WP Dark Mode
		 *
		 * @since 5.0.0
		 * @return string
		 */
		public function get_preset_styles() {

			$color_preset_id = $this->get_option( 'color_preset_id' );

			if ( $color_preset_id < 1 ) {
				return sprintf(
					'.wp-dark-mode-active, [data-wp-dark-mode-active] {
						--wpdm-background-color: %s;
						--wpdm-text-color: %s; }',
					'#232323', '#f0f0f0'
				);

				return '';
			}

			$color_presets = $this->get_option( 'color_presets' );
			--$color_preset_id;

			if ( ! isset( $color_presets[ $color_preset_id ] ) ) {
				return '';
			}

			// Reset preset id if not premium.
			// Allow first 2 predefined presets (indices 0, 1) and first AI custom preset for free users.
			$predefined_count    = count( \WP_Dark_Mode\Config::predefined_presets() );
			$first_ai_preset_idx = $predefined_count; // Index 13 for ID 14.

			if ( ! $this->is_ultimate() && $color_preset_id > 1 && $color_preset_id !== $first_ai_preset_idx ) {
				$color_preset_id = 0;
			}

			$preset = $color_presets[ $color_preset_id ];

			// Variables.
			$background_color = isset( $preset['bg'] ) && ! empty( $preset['bg'] ) ? $preset['bg'] : '';

			$text_color = isset( $preset['text'] ) && ! empty( $preset['text'] ) ? $preset['text'] : '';
			$link_color = isset( $preset['link'] ) && ! empty( $preset['link'] ) ? $preset['link'] : '';
			$link_hover_color = isset( $preset['link_hover'] ) && ! empty( $preset['link_hover'] ) ? $preset['link_hover'] : '';

			$input_background_color = isset( $preset['input_bg'] ) && ! empty( $preset['input_bg'] ) ? $preset['input_bg'] : '';
			$input_text_color = isset( $preset['input_text'] ) && ! empty( $preset['input_text'] ) ? $preset['input_text'] : '';
			$input_placeholder_color = isset( $preset['input_placeholder'] ) && ! empty( $preset['input_placeholder'] ) ? $preset['input_placeholder'] : '';

			$button_text_color = isset( $preset['button_text'] ) && ! empty( $preset['button_text'] ) ? $preset['button_text'] : '';
			$button_hover_text_color = isset( $preset['button_hover_text'] ) && ! empty( $preset['button_hover_text'] ) ? $preset['button_hover_text'] : '';
			$button_background_color = isset( $preset['button_bg'] ) && ! empty( $preset['button_bg'] ) ? $preset['button_bg'] : '';
			$button_hover_background_color = isset( $preset['button_hover_bg'] ) && ! empty( $preset['button_hover_bg'] ) ? $preset['button_hover_bg'] : '';
			$button_border_color = isset( $preset['button_border'] ) && ! empty( $preset['button_border'] ) ? $preset['button_border'] : '';

			$enable_scrollbar = isset( $preset['enable_scrollbar'] ) && wp_validate_boolean( $preset['enable_scrollbar'] ) ? true : false;

			// Get scrollbar colors with fallbacks to input colors
			$track_color = $enable_scrollbar ? ( isset( $preset['scrollbar_track'] ) && ! empty( $preset['scrollbar_track'] ) ? $preset['scrollbar_track'] : $input_background_color ) : '';
			$thumb_color = $enable_scrollbar ? ( isset( $preset['scrollbar_thumb'] ) && ! empty( $preset['scrollbar_thumb'] ) ? $preset['scrollbar_thumb'] : $input_text_color ) : '';

			$elements = array( 'div', 'aside', 'header', 'footer', 'main', 'section', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'article', 'nav', 'ul', 'ol', 'li', 'nav', 'span', 'i', 'b', 'strong', 'em', 'small', 'big', 'pre', 'code', 'blockquote', 'q', 'cite' );
			$not = array( 'a', 'button', '.button', 'template', 'iframe', 'video', 'media', 'svg', 'img', 'audio', 'input', 'textarea', 'form', 'select', '.elementor-button' );
			$not = implode('', array_map( function ( $item ) {
				return ':not(' . $item . '):not(' . $item . ' *)';
			}, $not )) . ':not(.wp-dark-mode-ignore):not(.wp-dark-mode-ignore *):not(.wp-dark-mode-switch):not(.wp-dark-mode-switch *):not(.wp-dark-mode-transparent):not(.wp-dark-mode-transparent *)';
			// $elements = implode(', ', array_map( function( $item ) use ($not) {
			//  return '[data-wp-dark-mode-active] body ' . $item . $not;
			// }, $elements ));

			// Variables.
			$styles = sprintf(
				'[data-wp-dark-mode-active] { 
	--wpdm-background-color: %s;

	--wpdm-text-color: %s;
	--wpdm-link-color: %s;
	--wpdm-link-hover-color: %s;

	--wpdm-input-background-color: %s;
	--wpdm-input-text-color: %s;
	--wpdm-input-placeholder-color: %s;

	--wpdm-button-text-color: %s;
	--wpdm-button-hover-text-color: %s;
	--wpdm-button-background-color: %s;
	--wpdm-button-hover-background-color: %s;
	--wpdm-button-border-color: %s;

	--wpdm-scrollbar-track-color: %s;
	--wpdm-scrollbar-thumb-color: %s;
}
',
				$background_color, $text_color, $link_color, $link_hover_color, $input_background_color, $input_text_color, $input_placeholder_color, $button_text_color, $button_hover_text_color, $button_background_color, $button_hover_background_color, $button_border_color, $track_color, $thumb_color
			);

			// Has scrollbar - inject via JS to override dark mode engine
			if ( $enable_scrollbar ) {
				$thumb = ! empty( $thumb_color ) ? $thumb_color : '#888888';
				$track = ! empty( $track_color ) ? $track_color : '#2d2d2d';

				add_action(
					'wp_footer',
					function () use ( $thumb, $track ) {
						$this->render_scrollbar_script( $thumb, $track );
					},
					9999
				);
			}

			// Return the styles.
			return apply_filters( 'wp_dark_mode_preset_styles', $styles );
		}

		/**
		 * Renders scrollbar script for dark mode.
		 *
		 * @since 5.0.0
		 *
		 * @param string $thumb Scrollbar thumb color.
		 * @param string $track Scrollbar track color.
		 */
		public function render_scrollbar_script( $thumb, $track ) {
			?>
			<script>
			(function() {
				function applyScrollbarStyles() {
					if (!document.documentElement.hasAttribute('data-wp-dark-mode-active')) {
						document.documentElement.style.removeProperty('scrollbar-color');
						return;
					}
					document.documentElement.style.setProperty('scrollbar-color', '<?php echo esc_js( $thumb ); ?> <?php echo esc_js( $track ); ?>', 'important');

					// Find and remove dark mode engine scrollbar styles.
					var styles = document.querySelectorAll('style');
					styles.forEach(function(style) {
						if (style.id === 'wp-dark-mode-scrollbar-custom') return;
						if (style.textContent && style.textContent.indexOf('::-webkit-scrollbar') !== -1 && style.textContent.indexOf('<?php echo esc_js( $track ); ?>') === -1) {
							style.textContent = style.textContent.replace(/::-webkit-scrollbar[^}]*\{[^}]*\}/g, '');
							style.textContent = style.textContent.replace(/::-webkit-scrollbar-track[^}]*\{[^}]*\}/g, '');
							style.textContent = style.textContent.replace(/::-webkit-scrollbar-thumb[^{]*\{[^}]*\}/g, '');
							style.textContent = style.textContent.replace(/::-webkit-scrollbar-corner[^}]*\{[^}]*\}/g, '');
						}
					});

					// Inject our styles.
					var existing = document.getElementById('wp-dark-mode-scrollbar-custom');
					if (!existing) {
						var customStyle = document.createElement('style');
						customStyle.id = 'wp-dark-mode-scrollbar-custom';
						customStyle.textContent =
							'::-webkit-scrollbar { width: 12px !important; height: 12px !important; background: <?php echo esc_js( $track ); ?> !important; }' +
							'::-webkit-scrollbar-track { background: <?php echo esc_js( $track ); ?> !important; }' +
							'::-webkit-scrollbar-thumb { background: <?php echo esc_js( $thumb ); ?> !important; border-radius: 6px; }' +
							'::-webkit-scrollbar-thumb:hover { filter: brightness(1.2); }' +
							'::-webkit-scrollbar-corner { background: <?php echo esc_js( $track ); ?> !important; }';
						document.body.appendChild(customStyle);
					}
				}

				// Listen for dark mode changes.
				document.addEventListener('wp_dark_mode', function(e) {
					setTimeout(applyScrollbarStyles, 100);
					setTimeout(applyScrollbarStyles, 500);
					setTimeout(applyScrollbarStyles, 1000);
				});

				// Observe attribute changes.
				var observer = new MutationObserver(function(mutations) {
					mutations.forEach(function(mutation) {
						if (mutation.attributeName === 'data-wp-dark-mode-active') {
							var existing = document.getElementById('wp-dark-mode-scrollbar-custom');
							if (existing && !document.documentElement.hasAttribute('data-wp-dark-mode-active')) {
								existing.remove();
							}
							setTimeout(applyScrollbarStyles, 100);
							setTimeout(applyScrollbarStyles, 500);
						}
					});
				});
				observer.observe(document.documentElement, { attributes: true });

				// Initial apply.
				setTimeout(applyScrollbarStyles, 100);
				setTimeout(applyScrollbarStyles, 500);
				setTimeout(applyScrollbarStyles, 1000);
			})();
			</script>
			<?php
		}

		/**
		 * Returns custom CSS for WP Dark Mode
		 *
		 * @since 5.0.0
		 * @return string
		 */
		public function get_custom_css() {

			$custom_css = $this->get_option( 'frontend_custom_css' );

			// return if empty
			if ( empty( $custom_css ) ) {
				return '';
			}

			return $this->add_selector( $custom_css, '[data-wp-dark-mode-active]' );
		}

		/**
		 * Adds parent selector to all selectors for a given CSS string, keeping the CSS properties in one line.
		 *
		 * @param string $css CSS string; Nested 1 level only.
		 * @param string $custom_selector Parent selector.
		 * @return string Fixed CSS string.
		 */
		public function add_selector( $css, $custom_selector ) {
			$css = $this->minify( $css );

			// Split the CSS string into an array of individual rules.
			$css_rules = preg_split('/}/', $css);
			// Initialize the new CSS string.
			$new_css = '';
			// Loop through each rule.
			foreach ( $css_rules as $rule ) {
				// Split the rule into the selector and properties.
				$parts = preg_split('/{/', $rule, 2);
				// If the rule has a selector and properties.
				if ( count($parts) === 2 ) {
					// Add the selector to the new CSS string, followed by a newline.
					$new_css .= $custom_selector . ' ' . trim($parts[0]) . " {\n";
					// Add the properties to the new CSS string, indented by one tab.
					$new_css .= "\t" . trim($parts[1]) . "\n";
					// Add the closing curly brace for the rule.
					$new_css .= "}\n";
				}
			}
			return $new_css;
		}

		/**
		 * Minifies CSS.
		 *
		 * @param string $css CSS string.
		 * @return string Minified CSS string.
		 */
		public function minify( $css ) {
			// Remove comments.
			$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

			// Remove space after colons.
			$css = str_replace(': ', ':', $css);

			// Remove whitespace.
			$css = str_replace([ "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ], '', $css);

			return $css;
		}
		/**
		 * Adds async attribute to script tag
		 *
		 * @since 5.0.0
		 * @param string $tag Script tag.
		 * @param string $handle Script handle.
		 * @return string
		 */
		public function script_loader_tag( $tag, $handle ) {

			// Check if the script is wp-dark-mode.
			if ( 'wp-dark-mode' === $handle ) {

				$execute_as = $this->get_option( 'performance_execute_as' );

				switch ( $execute_as ) {
					case 'async':
						$tag = str_replace( ' src', ' async="true" src', $tag );
						break;

					case 'defer':
						$tag = str_replace( ' src', ' defer src', $tag );
						break;

					case 'sync':
					default:
						// Do nothing.
						break;
				}
			}

			// Exclude wp-dark-mode-js-extra from cache.
			if ( 'wp-dark-mode-js-extra' === $handle ) {
				$tag = str_replace( ' src', ' data-no-minify="true" nowprocket data-no-optimize="true" data-no-litespeed="true" src', $tag );
			}

			return $tag;
		}

		/**
		 * Get SVG icons
		 *
		 * @since 5.0.0
		 * @return array
		 */
		public function get_svg_icons() {
			$svg_icons = [
				'HalfMoonFilled' => '<svg viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.8956 0.505198C11.2091 0.818744 11.3023 1.29057 11.1316 1.69979C10.4835 3.25296 10.125 4.95832 10.125 6.75018C10.125 13.9989 16.0013 19.8752 23.25 19.8752C25.0419 19.8752 26.7472 19.5167 28.3004 18.8686C28.7096 18.6979 29.1814 18.7911 29.495 19.1046C29.8085 19.4182 29.9017 19.89 29.731 20.2992C27.4235 25.8291 21.9642 29.7189 15.5938 29.7189C7.13689 29.7189 0.28125 22.8633 0.28125 14.4064C0.28125 8.036 4.17113 2.57666 9.70097 0.269199C10.1102 0.098441 10.582 0.191653 10.8956 0.505198Z" fill="currentColor"/></svg>',
				'HalfMoonOutlined' => '<svg viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"> <path d="M23.3773 16.5026C22.0299 17.0648 20.5512 17.3753 19 17.3753C12.7178 17.3753 7.625 12.2826 7.625 6.00031C7.625 4.44912 7.9355 2.97044 8.49773 1.62305C4.38827 3.33782 1.5 7.39427 1.5 12.1253C1.5 18.4076 6.59276 23.5003 12.875 23.5003C17.606 23.5003 21.6625 20.612 23.3773 16.5026Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
				'CurvedMoonFilled' => '<svg  viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M6.11767 1.57622C8.52509 0.186296 11.2535 -0.171447 13.8127 0.36126C13.6914 0.423195 13.5692 0.488292 13.4495 0.557448C9.41421 2.88721 8.09657 8.15546 10.503 12.3234C12.9105 16.4934 18.1326 17.9833 22.1658 15.6547C22.2856 15.5855 22.4031 15.5123 22.5174 15.4382C21.6991 17.9209 20.0251 20.1049 17.6177 21.4948C12.2943 24.5683 5.40509 22.5988 2.23017 17.0997C-0.947881 11.5997 0.79427 4.64968 6.11767 1.57622ZM4.77836 10.2579C4.70178 10.3021 4.6784 10.4022 4.72292 10.4793C4.76861 10.5585 4.86776 10.5851 4.94238 10.542C5.01896 10.4978 5.04235 10.3977 4.99783 10.3206C4.95331 10.2435 4.85495 10.2137 4.77836 10.2579ZM14.0742 19.6608C14.1508 19.6166 14.1741 19.5165 14.1296 19.4394C14.0839 19.3603 13.9848 19.3336 13.9102 19.3767C13.8336 19.4209 13.8102 19.521 13.8547 19.5981C13.8984 19.6784 13.9976 19.705 14.0742 19.6608ZM6.11345 5.87243C6.19003 5.82822 6.21341 5.72814 6.16889 5.65103C6.1232 5.57189 6.02405 5.54526 5.94943 5.58835C5.87285 5.63256 5.84947 5.73264 5.89399 5.80975C5.93654 5.88799 6.03687 5.91665 6.11345 5.87243ZM9.42944 18.3138C9.50603 18.2696 9.52941 18.1695 9.48489 18.0924C9.4392 18.0133 9.34004 17.9867 9.26543 18.0297C9.18885 18.074 9.16546 18.174 9.20998 18.2511C9.25254 18.3294 9.35286 18.358 9.42944 18.3138ZM6.25969 15.1954L7.35096 16.3781L6.87234 14.8416L8.00718 13.7644L6.50878 14.2074L5.41751 13.0247L5.89613 14.5611L4.76326 15.6372L6.25969 15.1954Z" fill="white"/></svg>',
				'CurvedMoonOutlined' => '<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"> <path d="M5.99222 9.70618C8.30834 12.0223 12.0339 12.0633 14.4679 9.87934C14.1411 11.0024 13.5331 12.0648 12.643 12.9549C9.85623 15.7417 5.38524 15.7699 2.65685 13.0415C-0.0715325 10.3132 -0.0432656 5.84217 2.74352 3.05539C3.63362 2.16529 4.69605 1.55721 5.81912 1.23044C3.63513 3.66445 3.67608 7.39004 5.99222 9.70618Z" stroke="currentColor"/> </svg>',
				'SunFilled' => '<svg viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.9999 3.73644C11.1951 3.73644 11.3548 3.57676 11.3548 3.3816V0.354838C11.3548 0.159677 11.1951 0 10.9999 0C10.8048 0 10.6451 0.159677 10.6451 0.354838V3.38515C10.6451 3.58031 10.8048 3.73644 10.9999 3.73644ZM10.9998 4.61291C7.47269 4.61291 4.6127 7.4729 4.6127 11C4.6127 14.5271 7.47269 17.3871 10.9998 17.3871C14.5269 17.3871 17.3868 14.5271 17.3868 11C17.3868 7.4729 14.5269 4.61291 10.9998 4.61291ZM10.9998 6.3871C8.45559 6.3871 6.38688 8.4558 6.38688 11C6.38688 11.1951 6.22721 11.3548 6.03205 11.3548C5.83688 11.3548 5.67721 11.1951 5.67721 11C5.67721 8.06548 8.06526 5.67742 10.9998 5.67742C11.1949 5.67742 11.3546 5.8371 11.3546 6.03226C11.3546 6.22742 11.1949 6.3871 10.9998 6.3871ZM10.6451 18.6184C10.6451 18.4232 10.8048 18.2635 10.9999 18.2635C11.1951 18.2635 11.3548 18.4197 11.3548 18.6148V21.6451C11.3548 21.8403 11.1951 22 10.9999 22C10.8048 22 10.6451 21.8403 10.6451 21.6451V18.6184ZM6.88367 4.58091C6.95109 4.69446 7.06819 4.75833 7.19238 4.75833C7.2527 4.75833 7.31302 4.74414 7.3698 4.7122C7.54012 4.61285 7.59689 4.3964 7.50109 4.22608L5.98593 1.60383C5.88658 1.43351 5.67013 1.37673 5.4998 1.47254C5.32948 1.57189 5.27271 1.78834 5.36851 1.95867L6.88367 4.58091ZM14.6298 17.2877C14.8001 17.1919 15.0166 17.2487 15.1159 17.419L16.6311 20.0413C16.7269 20.2116 16.6701 20.428 16.4998 20.5274C16.443 20.5593 16.3827 20.5735 16.3224 20.5735C16.1982 20.5735 16.0811 20.5096 16.0137 20.3961L14.4985 17.7738C14.4027 17.6035 14.4595 17.3871 14.6298 17.2877ZM1.60383 5.98611L4.22608 7.50127C4.28285 7.5332 4.34317 7.5474 4.4035 7.5474C4.52769 7.5474 4.64478 7.48353 4.7122 7.36998C4.81156 7.19966 4.75124 6.98321 4.58091 6.88385L1.95867 5.36869C1.78834 5.26934 1.57189 5.32966 1.47254 5.49998C1.37673 5.67031 1.43351 5.88676 1.60383 5.98611ZM17.774 14.4986L20.3963 16.0137C20.5666 16.1131 20.6234 16.3295 20.5276 16.4999C20.4601 16.6134 20.3431 16.6773 20.2189 16.6773C20.1585 16.6773 20.0982 16.6631 20.0414 16.6312L17.4192 15.116C17.2489 15.0166 17.1885 14.8002 17.2879 14.6299C17.3873 14.4596 17.6037 14.3992 17.774 14.4986ZM3.73644 10.9999C3.73644 10.8048 3.57676 10.6451 3.3816 10.6451H0.354837C0.159677 10.6451 0 10.8048 0 10.9999C0 11.1951 0.159677 11.3548 0.354837 11.3548H3.38515C3.58031 11.3548 3.73644 11.1951 3.73644 10.9999ZM18.6148 10.6451H21.6451C21.8403 10.6451 22 10.8048 22 10.9999C22 11.1951 21.8403 11.3548 21.6451 11.3548H18.6148C18.4197 11.3548 18.26 11.1951 18.26 10.9999C18.26 10.8048 18.4197 10.6451 18.6148 10.6451ZM4.7122 14.6299C4.61285 14.4596 4.3964 14.4028 4.22608 14.4986L1.60383 16.0138C1.43351 16.1131 1.37673 16.3296 1.47254 16.4999C1.53996 16.6135 1.65705 16.6773 1.78125 16.6773C1.84157 16.6773 1.90189 16.6631 1.95867 16.6312L4.58091 15.116C4.75124 15.0167 4.80801 14.8002 4.7122 14.6299ZM17.5963 7.54732C17.4721 7.54732 17.355 7.48345 17.2876 7.36991C17.1918 7.19958 17.2486 6.98313 17.4189 6.88378L20.0412 5.36862C20.2115 5.27282 20.4279 5.32959 20.5273 5.49991C20.6231 5.67023 20.5663 5.88669 20.396 5.98604L17.7737 7.5012C17.717 7.53313 17.6566 7.54732 17.5963 7.54732ZM7.37009 17.2877C7.19976 17.1883 6.98331 17.2487 6.88396 17.419L5.3688 20.0412C5.26945 20.2115 5.32977 20.428 5.50009 20.5274C5.55687 20.5593 5.61719 20.5735 5.67751 20.5735C5.8017 20.5735 5.9188 20.5096 5.98622 20.3961L7.50138 17.7738C7.59718 17.6035 7.54041 17.387 7.37009 17.2877ZM14.8072 4.7583C14.7469 4.7583 14.6866 4.7441 14.6298 4.71217C14.4595 4.61281 14.4027 4.39636 14.4985 4.22604L16.0137 1.60379C16.113 1.43347 16.3295 1.37315 16.4998 1.4725C16.6701 1.57186 16.7304 1.78831 16.6311 1.95863L15.1159 4.58088C15.0485 4.69443 14.9314 4.7583 14.8072 4.7583ZM8.68659 3.73643C8.72917 3.89611 8.87111 3.99901 9.02724 3.99901C9.05917 3.99901 9.08756 3.99546 9.11949 3.98837C9.30756 3.93869 9.4211 3.74353 9.37143 3.55546L8.86401 1.65708C8.81433 1.46902 8.61917 1.35547 8.43111 1.40515C8.24304 1.45483 8.1295 1.64999 8.17917 1.83805L8.68659 3.73643ZM12.8805 18.0152C13.0686 17.9655 13.2637 18.079 13.3134 18.2671L13.8208 20.1655C13.8705 20.3535 13.757 20.5487 13.5689 20.5984C13.537 20.6055 13.5086 20.609 13.4766 20.609C13.3205 20.609 13.1786 20.5061 13.136 20.3464L12.6286 18.4481C12.5789 18.26 12.6925 18.0648 12.8805 18.0152ZM5.36172 5.86548C5.43269 5.93645 5.5214 5.96838 5.61365 5.96838C5.70591 5.96838 5.79462 5.9329 5.86559 5.86548C6.00397 5.72709 6.00397 5.50355 5.86559 5.36516L4.47817 3.97775C4.33979 3.83936 4.11624 3.83936 3.97785 3.97775C3.83947 4.11613 3.83947 4.33968 3.97785 4.47807L5.36172 5.86548ZM16.138 16.1346C16.2764 15.9962 16.4999 15.9962 16.6383 16.1346L18.0293 17.522C18.1677 17.6604 18.1677 17.8839 18.0293 18.0223C17.9583 18.0897 17.8696 18.1252 17.7774 18.1252C17.6851 18.1252 17.5964 18.0933 17.5254 18.0223L16.138 16.6349C15.9996 16.4965 15.9996 16.273 16.138 16.1346ZM1.65365 8.86392L3.55203 9.37134C3.58396 9.37843 3.61235 9.38198 3.64429 9.38198C3.80041 9.38198 3.94235 9.27908 3.98493 9.1194C4.03461 8.93134 3.92461 8.73618 3.73299 8.6865L1.83461 8.17908C1.64655 8.1294 1.45139 8.2394 1.40171 8.43102C1.35203 8.61908 1.46558 8.81069 1.65365 8.86392ZM18.4517 12.6287L20.3466 13.1361C20.5346 13.1894 20.6482 13.381 20.5985 13.569C20.5595 13.7287 20.414 13.8316 20.2578 13.8316C20.2259 13.8316 20.1975 13.8281 20.1656 13.821L18.2708 13.3135C18.0791 13.2639 17.9691 13.0687 18.0188 12.8806C18.0685 12.689 18.2637 12.579 18.4517 12.6287ZM1.74579 13.835C1.77773 13.835 1.80612 13.8315 1.83805 13.8244L3.73643 13.317C3.9245 13.2673 4.03804 13.0721 3.98837 12.8841C3.93869 12.696 3.74353 12.5825 3.55546 12.6321L1.65708 13.1395C1.46902 13.1892 1.35547 13.3844 1.40515 13.5725C1.44418 13.7286 1.58967 13.835 1.74579 13.835ZM18.2671 8.68643L20.1619 8.17901C20.35 8.12579 20.5451 8.23934 20.5948 8.43095C20.6445 8.61901 20.5309 8.81417 20.3429 8.86385L18.4481 9.37127C18.4161 9.37837 18.3877 9.38191 18.3558 9.38191C18.1997 9.38191 18.0577 9.27901 18.0151 9.11933C17.9655 8.93127 18.079 8.73611 18.2671 8.68643ZM5.86559 16.1346C5.7272 15.9962 5.50365 15.9962 5.36527 16.1346L3.97785 17.522C3.83947 17.6604 3.83947 17.8839 3.97785 18.0223C4.04882 18.0933 4.13753 18.1252 4.22979 18.1252C4.32204 18.1252 4.41075 18.0897 4.48172 18.0223L5.86914 16.6349C6.00397 16.4965 6.00397 16.273 5.86559 16.1346ZM16.3865 5.96838C16.2942 5.96838 16.2055 5.93645 16.1346 5.86548C15.9962 5.72709 15.9962 5.50355 16.1381 5.36516L17.5255 3.97775C17.6639 3.83936 17.8875 3.83936 18.0258 3.97775C18.1642 4.11613 18.1642 4.33968 18.0258 4.47807L16.6384 5.86548C16.5675 5.9329 16.4788 5.96838 16.3865 5.96838ZM9.11929 18.0151C8.93123 17.9654 8.73607 18.0754 8.68639 18.267L8.17897 20.1654C8.1293 20.3534 8.2393 20.5486 8.43091 20.5983C8.46284 20.6054 8.49123 20.6089 8.52317 20.6089C8.67929 20.6089 8.82478 20.506 8.86381 20.3463L9.37123 18.448C9.42091 18.2599 9.31091 18.0647 9.11929 18.0151ZM12.973 3.99548C12.9411 3.99548 12.9127 3.99193 12.8808 3.98484C12.6891 3.93516 12.5791 3.74 12.6288 3.55194L13.1362 1.65355C13.1859 1.46194 13.3811 1.35194 13.5691 1.40162C13.7607 1.4513 13.8707 1.64646 13.8211 1.83452L13.3137 3.7329C13.2711 3.89258 13.1291 3.99548 12.973 3.99548Z" fill="currentColor"/></svg>',
				'SunOutlined' => '<svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"> <path  fill-rule="evenodd" clip-rule="evenodd" d="M7.39113 2.94568C7.21273 2.94568 7.06816 2.80111 7.06816 2.62271V0.322968C7.06816 0.144567 7.21273 0 7.39113 0C7.56953 0 7.7141 0.144567 7.7141 0.322968V2.62271C7.7141 2.80111 7.56953 2.94568 7.39113 2.94568ZM7.39105 11.5484C6.84467 11.5484 6.31449 11.4414 5.81517 11.2302C5.33308 11.0262 4.9002 10.7344 4.52843 10.3628C4.15665 9.99108 3.86485 9.5582 3.66103 9.07611C3.44981 8.57679 3.34277 8.04661 3.34277 7.50023C3.34277 6.95385 3.44981 6.42367 3.66103 5.92435C3.86496 5.44225 4.15676 5.00937 4.52843 4.6377C4.9001 4.26603 5.33298 3.97413 5.81507 3.7703C6.31439 3.55909 6.84457 3.45205 7.39095 3.45205C7.93733 3.45205 8.46751 3.55909 8.96683 3.7703C9.44893 3.97423 9.88181 4.26603 10.2535 4.6377C10.6251 5.00937 10.917 5.44225 11.1209 5.92435C11.3321 6.42367 11.4391 6.95385 11.4391 7.50023C11.4391 8.04661 11.3321 8.57679 11.1209 9.07611C10.9169 9.5582 10.6251 9.99108 10.2535 10.3628C9.88181 10.7344 9.44893 11.0263 8.96683 11.2302C8.46761 11.4414 7.93743 11.5484 7.39105 11.5484ZM7.39105 4.09778C5.51497 4.09778 3.98871 5.62404 3.98871 7.50013C3.98871 9.37621 5.51497 10.9025 7.39105 10.9025C9.26714 10.9025 10.7934 9.37621 10.7934 7.50013C10.7934 5.62404 9.26714 4.09778 7.39105 4.09778ZM5.41926 3.02731C5.46693 3.15845 5.59079 3.23985 5.72274 3.23985C5.75935 3.23985 5.79667 3.2336 5.83317 3.22037C6.0008 3.15937 6.08724 2.9741 6.02623 2.80646L5.23962 0.645342C5.17862 0.477706 4.99335 0.391273 4.82571 0.452278C4.65808 0.513283 4.57164 0.698554 4.63265 0.86619L5.41926 3.02731ZM4.25602 4.08639C4.16384 4.08639 4.07228 4.04713 4.00841 3.97105L2.53013 2.20928C2.41551 2.07261 2.43335 1.86888 2.56992 1.75426C2.70659 1.63963 2.91031 1.65747 3.02494 1.79404L4.50322 3.5558C4.61784 3.69248 4.6 3.8962 4.46343 4.01083C4.40294 4.06158 4.32922 4.08639 4.25602 4.08639ZM3.00535 5.34148C3.0562 5.3709 3.11177 5.38485 3.16652 5.38485C3.27808 5.38485 3.38665 5.32692 3.44643 5.22326C3.53563 5.06875 3.48273 4.87128 3.32821 4.78208L1.33657 3.63221C1.18206 3.543 0.98459 3.59591 0.895389 3.75042C0.806188 3.90493 0.859094 4.10241 1.01361 4.19161L3.00535 5.34148ZM2.58819 6.97619C2.56953 6.97619 2.55067 6.97455 2.5317 6.97126L0.266921 6.57191C0.0912879 6.54095 -0.0260062 6.37341 0.00495775 6.19778C0.0359217 6.02215 0.203455 5.90485 0.379088 5.93582L2.64387 6.33507C2.8195 6.36603 2.93679 6.53357 2.90583 6.7092C2.87825 6.86597 2.74199 6.97619 2.58819 6.97619ZM0.00495775 8.80286C0.0325382 8.95962 0.1688 9.06984 0.322595 9.06984C0.341153 9.06984 0.36012 9.0682 0.379088 9.06482L2.64387 8.66547C2.8195 8.6345 2.93679 8.46697 2.90583 8.29134C2.87486 8.1157 2.70733 7.99841 2.5317 8.02937L0.266921 8.42873C0.0912879 8.45969 -0.0260062 8.62722 0.00495775 8.80286ZM1.1754 11.4112C1.06374 11.4112 0.955266 11.3533 0.895389 11.2496C0.806188 11.0951 0.859094 10.8976 1.01361 10.8084L3.00524 9.65857C3.15965 9.56937 3.35723 9.62228 3.44643 9.77679C3.53563 9.9313 3.48273 10.1288 3.32821 10.218L1.33657 11.3678C1.28572 11.3972 1.23025 11.4112 1.1754 11.4112ZM2.56995 13.2452C2.63044 13.296 2.70406 13.3208 2.77737 13.3208C2.86954 13.3208 2.9611 13.2815 3.02498 13.2055L4.50325 11.4437C4.61788 11.307 4.60014 11.1033 4.46347 10.9887C4.3268 10.874 4.12307 10.8918 4.00844 11.0284L2.53017 12.7902C2.41554 12.9269 2.43328 13.1306 2.56995 13.2452ZM4.93614 14.5672C4.89943 14.5672 4.86221 14.5609 4.82571 14.5476C4.65808 14.4866 4.57164 14.3012 4.63265 14.1337L5.41926 11.9725C5.48026 11.8049 5.66564 11.7185 5.83317 11.7795C6.0008 11.8405 6.08724 12.0259 6.02623 12.1934L5.23962 14.3545C5.19195 14.4857 5.06809 14.5672 4.93614 14.5672ZM7.06836 14.6774C7.06836 14.8558 7.21293 15.0004 7.39133 15.0004C7.56973 15.0004 7.7143 14.8558 7.7143 14.6774V12.3777C7.7143 12.1993 7.56973 12.0547 7.39133 12.0547C7.21293 12.0547 7.06836 12.1993 7.06836 12.3777V14.6774ZM9.84569 14.5672C9.71374 14.5672 9.58988 14.4857 9.54221 14.3545L8.7556 12.1934C8.69459 12.0258 8.78103 11.8405 8.94866 11.7795C9.1163 11.7185 9.30157 11.8049 9.36257 11.9725L10.1492 14.1337C10.2102 14.3013 10.1238 14.4866 9.95612 14.5476C9.91962 14.5609 9.8823 14.5672 9.84569 14.5672ZM11.757 13.2056C11.8209 13.2816 11.9125 13.3209 12.0046 13.3209C12.0779 13.3209 12.1516 13.2961 12.2121 13.2454C12.3486 13.1307 12.3665 12.927 12.2518 12.7903L10.7736 11.0286C10.6589 10.892 10.4552 10.8741 10.3185 10.9888C10.182 11.1034 10.1641 11.3071 10.2788 11.4438L11.757 13.2056ZM13.6064 11.4112C13.5516 11.4112 13.496 11.3973 13.4452 11.3678L11.4535 10.218C11.299 10.1288 11.2461 9.9313 11.3353 9.77679C11.4245 9.62228 11.622 9.56937 11.7765 9.65857L13.7682 10.8084C13.9227 10.8976 13.9756 11.0951 13.8864 11.2496C13.8265 11.3533 13.718 11.4112 13.6064 11.4112ZM14.4029 9.06482C14.4219 9.0681 14.4407 9.06974 14.4594 9.06974C14.6132 9.06974 14.7494 8.95942 14.777 8.80286C14.808 8.62722 14.6907 8.45969 14.5151 8.42873L12.2502 8.02937C12.0745 7.99841 11.907 8.1157 11.8761 8.29134C11.8451 8.46697 11.9624 8.6345 12.138 8.66547L14.4029 9.06482ZM12.194 6.976C12.0402 6.976 11.9039 6.86578 11.8763 6.70901C11.8454 6.53337 11.9627 6.36584 12.1383 6.33488L14.4032 5.93552C14.5788 5.90456 14.7464 6.02185 14.7773 6.19749C14.8083 6.37312 14.691 6.54065 14.5154 6.57162L12.2505 6.97097C12.2315 6.97435 12.2126 6.976 12.194 6.976ZM11.3353 5.22326C11.3952 5.32692 11.5037 5.38485 11.6153 5.38485C11.6702 5.38485 11.7257 5.3709 11.7765 5.34148L13.7682 4.19161C13.9227 4.10241 13.9756 3.90493 13.8864 3.75042C13.7972 3.59591 13.5996 3.543 13.4452 3.63221L11.4535 4.78208C11.299 4.87128 11.2461 5.06875 11.3353 5.22326ZM10.5259 4.08647C10.4526 4.08647 10.379 4.06166 10.3185 4.01091C10.1818 3.89628 10.1641 3.69255 10.2787 3.55588L11.757 1.79411C11.8716 1.65744 12.0753 1.6396 12.212 1.75433C12.3487 1.86896 12.3664 2.07269 12.2518 2.20936L10.7735 3.97102C10.7096 4.0472 10.6181 4.08647 10.5259 4.08647ZM8.94866 3.22037C8.98516 3.2337 9.02238 3.23996 9.05909 3.23996C9.19094 3.23996 9.3148 3.15855 9.36257 3.02731L10.1492 0.86619C10.2102 0.698657 10.1237 0.513283 9.95612 0.452278C9.78858 0.391273 9.60321 0.477706 9.54221 0.645342L8.7556 2.80646C8.69459 2.97399 8.78103 3.15937 8.94866 3.22037Z"  fill="currentColor"/> </svg>',
				'DoubleUpperT' => '<svg viewBox="0 0 22 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M17.1429 6.42857V15H15V6.42857H10.7143V4.28571H21.4286V6.42857H17.1429ZM8.57143 2.14286V15H6.42857V2.14286H0V0H16.0714V2.14286H8.57143Z" fill="currentColor"/></svg>',
				'LowerA' => '',
				'DoubleT' => '<svg viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M0.880682 2.34375V0.454545H12.1378V2.34375H7.59943V15H5.41193V2.34375H0.880682ZM19.5472 4.09091V5.79545H13.5884V4.09091H19.5472ZM15.1864 1.47727H17.31V11.7969C17.31 12.2088 17.3716 12.5189 17.4947 12.7273C17.6178 12.9309 17.7764 13.0705 17.9705 13.1463C18.1694 13.2173 18.3848 13.2528 18.6168 13.2528C18.7873 13.2528 18.9364 13.241 19.0643 13.2173C19.1921 13.1937 19.2915 13.1747 19.3626 13.1605L19.7461 14.9148C19.623 14.9621 19.4478 15.0095 19.2205 15.0568C18.9933 15.1089 18.7092 15.1373 18.3683 15.142C17.8095 15.1515 17.2887 15.0521 16.8058 14.8438C16.3228 14.6354 15.9322 14.3134 15.6339 13.8778C15.3356 13.4422 15.1864 12.8954 15.1864 12.2372V1.47727Z" fill="currentColor"/></svg>',
				'UpperA' => '<svg viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="wp-dark-mode-ignore"><path d="M2.32955 14.5455H0L5.23438 0H7.76989L13.0043 14.5455H10.6747L6.5625 2.64205H6.44886L2.32955 14.5455ZM2.72017 8.84943H10.277V10.696H2.72017V8.84943Z" fill="currentColor"/><path fill-rule="evenodd" clip-rule="evenodd" d="M19.9474 8.33333L17.7085 5L15.5029 8.33333H17.1697V11.6667H15.5029L17.7085 15.0001L19.9474 11.6667H18.2808V8.33333H19.9474Z" fill="currentColor"/></svg>',
				'Stars' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 55" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M135.831 3.00688C135.055 3.85027 134.111 4.29946 133 4.35447C134.111 4.40947 135.055 4.85867 135.831 5.71123C136.607 6.55462 136.996 7.56303 136.996 8.72727C136.996 7.95722 137.172 7.25134 137.525 6.59129C137.886 5.93124 138.372 5.39954 138.98 5.00535C139.598 4.60199 140.268 4.39114 141 4.35447C139.88 4.2903 138.936 3.85027 138.16 3.00688C137.384 2.16348 136.996 1.16425 136.996 0C136.996 1.16425 136.607 2.16348 135.831 3.00688ZM31 23.3545C32.1114 23.2995 33.0551 22.8503 33.8313 22.0069C34.6075 21.1635 34.9956 20.1642 34.9956 19C34.9956 20.1642 35.3837 21.1635 36.1599 22.0069C36.9361 22.8503 37.8798 23.2903 39 23.3545C38.2679 23.3911 37.5976 23.602 36.9802 24.0053C36.3716 24.3995 35.8864 24.9312 35.5248 25.5913C35.172 26.2513 34.9956 26.9572 34.9956 27.7273C34.9956 26.563 34.6075 25.5546 33.8313 24.7112C33.0551 23.8587 32.1114 23.4095 31 23.3545ZM0 36.3545C1.11136 36.2995 2.05513 35.8503 2.83131 35.0069C3.6075 34.1635 3.99559 33.1642 3.99559 32C3.99559 33.1642 4.38368 34.1635 5.15987 35.0069C5.93605 35.8503 6.87982 36.2903 8 36.3545C7.26792 36.3911 6.59757 36.602 5.98015 37.0053C5.37155 37.3995 4.88644 37.9312 4.52481 38.5913C4.172 39.2513 3.99559 39.9572 3.99559 40.7273C3.99559 39.563 3.6075 38.5546 2.83131 37.7112C2.05513 36.8587 1.11136 36.4095 0 36.3545ZM56.8313 24.0069C56.0551 24.8503 55.1114 25.2995 54 25.3545C55.1114 25.4095 56.0551 25.8587 56.8313 26.7112C57.6075 27.5546 57.9956 28.563 57.9956 29.7273C57.9956 28.9572 58.172 28.2513 58.5248 27.5913C58.8864 26.9312 59.3716 26.3995 59.9802 26.0053C60.5976 25.602 61.2679 25.3911 62 25.3545C60.8798 25.2903 59.9361 24.8503 59.1599 24.0069C58.3837 23.1635 57.9956 22.1642 57.9956 21C57.9956 22.1642 57.6075 23.1635 56.8313 24.0069ZM81 25.3545C82.1114 25.2995 83.0551 24.8503 83.8313 24.0069C84.6075 23.1635 84.9956 22.1642 84.9956 21C84.9956 22.1642 85.3837 23.1635 86.1599 24.0069C86.9361 24.8503 87.8798 25.2903 89 25.3545C88.2679 25.3911 87.5976 25.602 86.9802 26.0053C86.3716 26.3995 85.8864 26.9312 85.5248 27.5913C85.172 28.2513 84.9956 28.9572 84.9956 29.7273C84.9956 28.563 84.6075 27.5546 83.8313 26.7112C83.0551 25.8587 82.1114 25.4095 81 25.3545ZM136 36.3545C137.111 36.2995 138.055 35.8503 138.831 35.0069C139.607 34.1635 139.996 33.1642 139.996 32C139.996 33.1642 140.384 34.1635 141.16 35.0069C141.936 35.8503 142.88 36.2903 144 36.3545C143.268 36.3911 142.598 36.602 141.98 37.0053C141.372 37.3995 140.886 37.9312 140.525 38.5913C140.172 39.2513 139.996 39.9572 139.996 40.7273C139.996 39.563 139.607 38.5546 138.831 37.7112C138.055 36.8587 137.111 36.4095 136 36.3545ZM101.831 49.0069C101.055 49.8503 100.111 50.2995 99 50.3545C100.111 50.4095 101.055 50.8587 101.831 51.7112C102.607 52.5546 102.996 53.563 102.996 54.7273C102.996 53.9572 103.172 53.2513 103.525 52.5913C103.886 51.9312 104.372 51.3995 104.98 51.0053C105.598 50.602 106.268 50.3911 107 50.3545C105.88 50.2903 104.936 49.8503 104.16 49.0069C103.384 48.1635 102.996 47.1642 102.996 46C102.996 47.1642 102.607 48.1635 101.831 49.0069Z" fill="currentColor"></path></svg>',
			];

			return $svg_icons;
		}
	}

	// Instantiate the class.
	Assets::init();
}
