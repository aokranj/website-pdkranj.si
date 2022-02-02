<?php

/** Block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Hooks` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Hooks' ) ) {
	class WP_Dark_Mode_Hooks {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Hooks constructor.
		 */
		public function __construct() {
			add_filter( 'wp_dark_mode/excludes', [ $this, 'excludes' ] );

			add_action( 'admin_footer', [ $this, 'display_promo' ] );
			add_action( 'wppool_after_settings', [ $this, 'pro_promo' ] );
			add_action('elementor/editor/footer', [ $this, 'pro_promo' ] );

			//display the dark mode switcher if the dark mode enabled on frontend
			add_action( 'wp_footer', [ $this, 'display_widget' ] );

			//declare custom color css variables
			add_action( 'wp_head', [ $this, 'header_scripts' ] );
			add_action( 'wp_footer', [ $this, 'footer_scripts' ], - 99 );

			//wptouch plugin compatibility
			add_action( 'wptouch_switch_bottom', [ $this, 'footer_scripts' ] );

			add_filter( 'wp_dark_mode/switch_label_class', [ $this, 'switch_label_class' ] );

		}

		public function not_selectors() {

			$selectors = '';

			$excludes = wp_dark_mode_get_settings( 'wp_dark_mode_display', 'excludes', '' );

			$excludes = trim( $excludes, ',' );
			$excludes = explode( ',', $excludes );

			if ( ! empty( $excludes ) ) {
				foreach ( $excludes as $exclude ) {
					$exclude   = trim( $exclude );
					$selectors .= ":not($exclude)";
				}
			}

			//elementor
			if ( defined( 'ELEMENTOR_VERSION' ) ) {
				$selectors .= ':not(.elementor-element-overlay):not(.elementor-background-overlay)';
			}

			//buddypress
			if ( class_exists( 'BuddyPress' ) ) {
				$selectors .= ':not(#item-header-cover-image):not(#item-header-avatar):not(.activity-content):not(.activity-header)';
			}

			return $selectors;
		}

		public function switch_label_class( $class ) {

			$animation = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'attention_effect', 'none' );

			if ( ! empty( $animation ) ) {
				$class .= ' wp-dark-mode-' . $animation;
			}

			return $class;
		}

		/**
		 * Declare custom color css variables
		 */
		public function header_scripts() {

			$performance_mode = apply_filters( 'wp_dark_mode/performance_mode', false );

			//Hide gutenberg block if darkmode is disabled
			if ( is_page() || is_single() ) {
				if ( ! wp_dark_mode_enabled() ) {
					printf( '<style>.wp-block-wp-dark-mode-block-dark-mode-switch{display: none;}</style>' );
				}
			}

			//do not anything is dark mode is not enabled
			if ( ! wp_dark_mode_enabled() ) {
				return;
			}

			$colors = wp_dark_mode_color_presets();

			$colors = [
				'bg'     => apply_filters( 'wp_dark_mode/bg_color', $colors['bg'] ),
				'text'   => apply_filters( 'wp_dark_mode/text_color', $colors['text'] ),
				'link'   => apply_filters( 'wp_dark_mode/link_color', $colors['link'] ),
				'border' => apply_filters( 'wp_dark_mode/border_color', wp_dark_mode_lighten( $colors['bg'], 30 ) ),
				'btn'    => apply_filters( 'wp_dark_mode/btn_color', wp_dark_mode_lighten( $colors['bg'], 20 ) ),
			];


			//check if is custom color
			$is_custom_color = wp_dark_mode_is_custom_color();

			// Add custom color init CSS
			if ( $is_custom_color ) { ?>
                <style>
                    html.wp-dark-mode-active {
                        --wp-dark-mode-bg: <?php echo $colors['bg']; ?>;
                        --wp-dark-mode-text: <?php echo $colors['text']; ?>;
                        --wp-dark-mode-link: <?php echo $colors['link']; ?>;
                        --wp-dark-mode-border: <?php echo $colors['border']; ?>;
                        --wp-dark-mode-btn: <?php echo $colors['btn']; ?>;
                    }
                </style>
			<?php }

			//custom color css
			if ( $is_custom_color ) {

				$scss = '
                html.wp-dark-mode-active :not(.wp-dark-mode-ignore):not(img):not(a)' . $this->not_selectors() . '{
                        color: var(--wp-dark-mode-text) !important;
                        border-color: var(--wp-dark-mode-border) !important;
                        background-color: var(--wp-dark-mode-bg) !important;
                }
                
                 html.wp-dark-mode-active{
                    a,
                    a *,
                    a:active,
                    a:active *,
                    a:visited,
                    a:visited * { 
                        &:not(.wp-dark-mode-ignore){
                            color: var(--wp-dark-mode-link) !important;
                        }
                    }
                    
                    
                    iframe,
                    iframe *,
                    input,
                    select,
                    textarea,
                    button{
                        &:not(.wp-dark-mode-ignore){
                            background: var(--wp-dark-mode-btn) !important;
                        }
                    }
                    
                    
                }';

				$scss_compiler = new scssc();

				printf( '<style>%s</style>', $scss_compiler->compile( $scss ) );

			}

			//if not elementor-preview
			if ( ! isset( $_REQUEST['elementor-preview'] ) ) { ?>
                <script>
					(function() { window.wpDarkMode = <?php echo json_encode(wp_dark_mode_localize_array()); ?> ; window.checkOsDarkMode = () => { if (!window.wpDarkMode.enable_os_mode || localStorage.getItem('wp_dark_mode_active')) return false; const darkMediaQuery = window.matchMedia('(prefers-color-scheme: dark)'); if (darkMediaQuery.matches) return true; try { darkMediaQuery.addEventListener('change', function(e) { return e.matches == true; }); } catch (e1) { try { darkMediaQuery.addListener(function(e) { return e.matches == true; }); } catch (e2) { console.error(e2); return false; } } return false; }; const is_saved = localStorage.getItem('wp_dark_mode_active'); const isCustomColor = parseInt("<?php echo $is_custom_color ?>"); const shouldDarkMode = is_saved == '1' || (!is_saved && window.checkOsDarkMode()); if (!shouldDarkMode) return; document.querySelector('html').classList.add('wp-dark-mode-active'); const isPerformanceMode = Boolean( <?php echo $performance_mode; ?> ); if (!isCustomColor && !isPerformanceMode) { var css = `body, div, section, header, article, main, aside{background-color: #2B2D2D !important;}`; var head = document.head || document.getElementsByTagName('head')[0], style = document.createElement('style'); style.setAttribute('id', 'pre_css'); head.appendChild(style); style.type = 'text/css'; if (style.styleSheet) { style.styleSheet.cssText = css; } else { style.appendChild(document.createTextNode(css)); } } })();
				</script>
				<?php
			}

		}

		/**
		 * Footer scripts
		 */
		public function footer_scripts() {

			if ( ! wp_dark_mode_enabled() ) {
				return;
			}

			$is_custom_color = wp_dark_mode_is_custom_color();

			$includes = wp_dark_mode_get_includes();

			$performance_mode = apply_filters( 'wp_dark_mode/performance_mode', false );

			?>


            <script>
                ;(function () { window.wpDarkMode = <?php echo json_encode( wp_dark_mode_localize_array() ); ?>; window.checkOsDarkMode = () => { if (!window.wpDarkMode.enable_os_mode || localStorage.getItem('wp_dark_mode_active')) return false; const darkMediaQuery = window.matchMedia('(prefers-color-scheme: dark)'); if (darkMediaQuery.matches) return true; try { darkMediaQuery.addEventListener('change', function(e) { return e.matches == true; }); } catch (e1) { try { darkMediaQuery.addListener(function(e) { return e.matches == true; }); } catch (e2) { console.error(e2); return false; } } return false; }; const is_saved = localStorage.getItem('wp_dark_mode_active'); const shouldDarkMode = is_saved == '1' || (!is_saved && window.checkOsDarkMode()); if (shouldDarkMode) { const isCustomColor = parseInt("<?php echo $is_custom_color ?>"); const isPerformanceMode = Boolean(<?php echo $performance_mode; ?>); if (!isCustomColor && !isPerformanceMode) { if (document.getElementById('pre_css')) { document.getElementById('pre_css').remove(); } if ('' === `<?php echo $includes; ?>`) { if(typeof DarkMode === 'object') DarkMode.enable(); } } } })(); 
            </script>

			<?php
		}

		/**
		 * display promo popup
		 */
		public function display_promo() {
			if ( $this->is_promo() ) {
				return;
			}

			if ( wp_dark_mode_is_gutenberg_page() ) {
				wp_dark_mode()->get_template( 'admin/promo' );
			}
		}

		/**
		 * Exclude elements
		 *
		 * @param $excludes
		 *
		 * @return string
		 */
		public function excludes( $excludes ) {

			$excludes .= ',rs-fullwidth-wrap,.mejs-container';

			if ( $this->is_promo() ) {
				$selectors = wp_dark_mode_get_settings( 'wp_dark_mode_includes_excludes', 'excludes' );

				if ( ! empty( $selectors ) ) {
					$excludes .= ", $selectors";
				}
			}

			return $excludes;
		}

		public function is_promo() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			return $wp_dark_mode_license->is_valid();
		}

		/**
		 * display the footer widget
		 */
		public function display_widget() {

			if ( ! wp_dark_mode_enabled() ) {
				return false;
			}

			if ( 'on' != wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'show_switcher', 'on' ) ) {
				return false;
			}

			$style = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_style', 1 );

			global $wp_dark_mode_license;
			if ( ! $wp_dark_mode_license || ! $wp_dark_mode_license->is_valid() ) {
				$style = $style > 3 ? 1 : $style;
			}

			echo do_shortcode( '[wp_dark_mode floating="yes" style="' . $style . '"]' );
		}

		/**
		 * Display promo popup to upgrade to PRO
		 *
		 * @param $section - setting section
		 */
		public function pro_promo() {
			wp_dark_mode()->get_template( 'admin/promo' );
		}

		/**
		 * @return WP_Dark_Mode_Hooks|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}
}

WP_Dark_Mode_Hooks::instance();

