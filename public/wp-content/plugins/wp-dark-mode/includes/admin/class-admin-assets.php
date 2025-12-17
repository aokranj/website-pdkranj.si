<?php
/**
 * Enqueues script and styles to frontend for WP Dark Mode
 *
 * @package WP Dark Mode
 * @since 5.0.0
 */

// Namespace.
namespace WP_Dark_Mode\Admin;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit( 1 );

if ( ! class_exists( __NAMESPACE__ . 'Assets' ) ) {
	/**
	 * Enqueues script and styles to frontend for WP Dark Mode
	 *
	 * @package WP Dark Mode
	 * @since 5.0.0
	 */
	class Assets extends \WP_Dark_Mode\Base {

		// Use utility trait.
		use \WP_Dark_Mode\Traits\Utility;

		// Use options trait.
		use \WP_Dark_Mode\Traits\Options;

		/**
		 * Register hooks.
		 *
		 * @since 5.0.0
		 */
		public function actions() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			// add_action( 'admin_xml_ns', array( $this, 'admin_html_tag' ) );

			// Enqueue scripts for Elementor.
			add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			// Text-domain.
			add_action( 'init', array( $this, 'load_textdomain' ) );

			add_action( 'admin_init', array( $this, 'load_classic_editor_scripts' ) );
		}


		/**
		 * Filters
		 *
		 * @since 5.0.0
		 */
		public function filters() {
			// Modify script async.
			add_filter( 'script_loader_tag', array( $this, 'script_loader_tag' ), 10, 2 );
			add_filter( 'wp_dark_mode_admin_activated', array( $this, 'wp_dark_mode_admin_activated' ) );
		}

		/**
		 * Load text-domain.
		 *
		 * @since 5.0.0
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'wp-dark-mode', false, dirname ( plugin_basename( WP_DARK_MODE_FILE ) ) . '/languages/' );
		}


		/**
		 * Get default presets.
		 *
		 * @since 5.0.0
		 * @return array
		 */
		public function get_predefined_presets() {
			return \WP_Dark_Mode\Config::predefined_presets();
		}

		/**
		 * Enqueue scripts and styles for admin.
		 *
		 * @param string $hook The current admin page.
		 * @since 5.0.0
		 */
		public function admin_enqueue_scripts( $hook ) {

			// Enqueue styles.
			wp_enqueue_style( 'wp-dark-mode-admin-common', WP_DARK_MODE_ASSETS . 'css/admin-common.css', array(), WP_DARK_MODE_VERSION );

			// Enqueue inline CSS.
			wp_add_inline_style( 'wp-dark-mode-admin-common', $this->get_inline_css() );

			// Enqueue scripts.
			$editor_type = get_option( 'classic-editor-replace', 'block' );
			// If the current page is not edit post page.
			if ( 'classic' === $editor_type || ! in_array( $hook, [ 'post.php', 'post-new.php' ], true ) ) {
				wp_enqueue_script( 'wp-dark-mode-dark-mode', WP_DARK_MODE_ASSETS . 'js/admin-dark-mode.min.js', [], WP_DARK_MODE_VERSION, false );
			}

			wp_enqueue_script( 'wp-dark-mode-common', WP_DARK_MODE_ASSETS . 'js/admin-common.min.js', [ 'wp-i18n' ], WP_DARK_MODE_VERSION, true );

			// Localize scripts.
			wp_localize_script( 'wp-dark-mode-common', 'wp_dark_mode_admin_json', $this->get_admin_json() );
			wp_set_script_translations('wp-dark-mode-common', 'wp-dark-mode');

			// SVG Icons.
			$config = new \WP_Dark_Mode\Config();
			$svg_icons = $config->get_svg_icons();
			wp_localize_script( 'wp-dark-mode-common', 'wp_dark_mode_icons', $svg_icons );

			// Load settings style when on settings page.
			if ( in_array( $hook, [ 'toplevel_page_wp-dark-mode', 'toplevel_page_wp-dark-mode-settings', 'wp-dark-mode_page_wp-dark-mode-get-started' ], true ) ) {

				// Enqueue WP Media.
				wp_enqueue_media();

				// Enqueue styles.
				wp_enqueue_style( 'wp-dark-mode-admin-settings', WP_DARK_MODE_ASSETS . 'css/admin-settings.css', array(), WP_DARK_MODE_VERSION );

				echo '<style> #wpcontent { padding: 0 !important; }</style>';
				wp_enqueue_script( 'wp-dark-mode-settings', WP_DARK_MODE_ASSETS . 'js/admin-settings.min.js', [ 'wp-i18n' ], WP_DARK_MODE_VERSION, true );
			}
		}

		/**
		 * Get localize scripts.
		 *
		 * @since 5.0.0
		 * @return array
		 */
		public function get_admin_json( $hook = '' ) {

			$scripts = array(
				'default' => $this->get_default_options(),

				'options' => $this->get_options(),
				'predefined_presets' => $this->get_predefined_presets(),
				'version' => WP_DARK_MODE_VERSION,

				/**
				 * REST API.
				 */
				'rest_url' => rest_url( 'wp-dark-mode' ),
				'rest_security_key' => wp_create_nonce( 'wp_rest' ),

				// urls.
				'url' => array(
					'ajax' => admin_url( 'admin-ajax.php' ),
					'images' => WP_DARK_MODE_ASSETS . 'images/',
					'plugin' => WP_DARK_MODE_URL,
					'home' => home_url(),
					'admin' => admin_url(),
				),

				// WooCommerce.
				'wc' => [
					'is_installed' => file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' ),
					'is_active' => class_exists( 'WooCommerce' ) && is_plugin_active( 'woocommerce/woocommerce.php' ),
				],

				// Additional parameters.
				'additional' => array(
					'show_upgrade_notice' => 'hide' !== $this->get_value( 'upgrade_notice' ),
					'show_rating_notice' => 'hide' !== $this->get_value( 'rating_notice' ),
					'show_affiliate_notice' => 'hide' !== $this->get_value( 'affiliate_notice' ),
					'installed_at' => $this->get_option( 'installed_at', null ),
					'is_multisite' => is_multisite(),
					'is_elementor_editor' => class_exists( 'Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode(),
					// Detect if the current editor is the classic editor.
					'is_classic_editor_mode' => $this->is_classic_editor_mode(),
				),

				'is_excluded' => $this->is_excluded (),

				// Debug.
				'debug' => defined( 'WP_DEBUG' ) && WP_DEBUG,
			);

			return apply_filters( 'wp_dark_mode_admin_json', $scripts, $hook );
		}

		/**
		 *
		 * Check if the current editor is the classic editor.
		 *
		 * @since 5.0.0
		 * @return bool
		 */
		public function is_classic_editor_mode() {
			return class_exists( 'Classic_Editor' );
		}


		/**
		 * Get inline CSS.
		 *
		 * @since 5.0.0
		 * @return string
		 */
		public function get_inline_css() {
			$css = '[data-wp-dark-mode-loading] #wpcontent, [data-wp-dark-mode-loading] #wpcontent *:not(.wp-dark-mode-ignore):not(.wp-dark-mode-ignore *) {
				background: #222 !important;
				color: #F0F0F0 !important;
				border-color: #666 !important;
			}
			';

			// variables.
			$css .= wp_sprintf(
				':root{
					--wpdm-get-started-hero-background : url(%s);
					--wpdm-get-started-nav-background : url(%s);
					--wpdm-upgrade-box1-background : url(%s);
					--wpdm-upgrade-box2-background : url(%s);

					--wpdm-text-color : %s;
					--wpdm-background-color : %s;
					--wpdm-secondary-background-color : %s;
					--wpdm-border-color : %s;
				}',
				WP_DARK_MODE_ASSETS . 'images/get-started/hero-background.png',
				WP_DARK_MODE_ASSETS . 'images/get-started/nav-background.svg',
				WP_DARK_MODE_ASSETS . 'images/upgrade-box1-background.png',
				WP_DARK_MODE_ASSETS . 'images/upgrade-box2-background.png',
				'#F0F0F0',
				'#222',
				'#333',
				'#666'
			);

			return apply_filters( 'wp_dark_mode_admin_inline_css', $css );
		}

		/**
		 * Add HTML tag to admin.
		 *
		 * @since 5.0.0
		 */
		public function admin_html_tag() {

			if ( $this->is_excluded() ) {
				return;
            }

			$is_dark_moe_backend_activated = apply_filters( 'wp_dark_mode_admin_activated', false );

			if ( $is_dark_moe_backend_activated ) {
				echo 'data-wp-dark-mode-loading="true" ';
			}
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
			if ( is_admin() && 'wp-dark-mode-admin' === $handle ) {

				$tag = str_replace( ' src', ' nowprocket src', $tag );
			}

			return $tag;
		}

		/**
		 * Check if WP Dark Mode is activated.
		 *
		 * @since 5.0.0
		 * @return bool
		 */
		public function wp_dark_mode_admin_activated( $is_activated ) {

			$admin_enabled = $this->get_option( 'admin_enabled' );
			$admin_choice = isset( $_COOKIE['wp-dark-mode-admin'] ) ? wp_validate_boolean( sanitize_text_field( wp_unslash( $_COOKIE['wp-dark-mode-admin'] ) ) ) : false;

			if ( $admin_enabled && $admin_choice ) {
				$is_activated = true;
			}

			return $is_activated;
		}

		/**
		 * Check if the current page is excluded.
		 *
		 * @since 5.0.0
		 * @return bool
		 */
		public function is_excluded() {
			$current_screen = get_current_screen();

			if ( $current_screen && isset( $current_screen->id ) && 'post' === $current_screen->base && 'page' === $current_screen->post_type ) {
				// This is a page editor screen.
				if ( function_exists( 'register_block_type' ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Load classic editor scripts.
		 *
		 * @since 5.0.0
		 */
		public function load_classic_editor_scripts() {
			if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
				return;
            }
			if ( get_user_option('rich_editing') !== 'true' ) {
				return;
            }

			// Bail if admin_classic_editor is not enabled.
			if ( ! wp_validate_boolean ( get_option( 'wp_dark_mode_admin_enabled_classic_editor' ) ) ) {
				return;
			}

			add_filter('mce_external_plugins', function ( $plugins ) {
				$plugins['dark_mode_button'] = plugins_url('assets/js/admin-classic-editor.js', WP_DARK_MODE_FILE);
				return $plugins;
			});

			add_filter('mce_buttons', function ( $buttons ) {
				$buttons[] = 'dark_mode_button';
				return $buttons;
			});
		}
	}

	// Instantiate the class.
	Assets::init();
}
