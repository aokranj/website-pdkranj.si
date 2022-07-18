<?php

defined( 'ABSPATH' ) || exit();

/** if class `WP_Dark_Mode` doesn't exists yet. */
if ( ! class_exists( 'WP_Dark_Mode' ) ) {

	/**
	 * Sets up and initializes the plugin.
	 * Main initiation class
	 *
	 * @since 1.0.0
	 */
	final class WP_Dark_Mode {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;


		/**
		 * Minimum PHP version required
		 *
		 * @var string
		 */
		private static $min_php = '5.6.0';

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @return void
		 * @since  1.0.0
		 * @access public
		 */
		public function __construct() {
			if ( $this->check_environment() ) {
				$this->load_files();

				add_filter( 'plugin_action_links_' . plugin_basename( WP_DARK_MODE_FILE ), array(
					$this,
					'plugin_action_links'
				) );
				add_action( 'admin_notices', [ $this, 'print_notices' ], 15 );
				add_action( 'init', [ $this, 'lang' ] );

				add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widget' ] );

				if ( did_action( 'elementor/loaded' ) ) {
					include_once WP_DARK_MODE_INCLUDES . '/elementor/modules/controls/init.php';
				}

				do_action( 'wp_dark_mode/loaded' );

				//init appsero tracker
				$this->appsero_init_tracker_wp_dark_mode();

				/** do the activation stuff */
				register_activation_hook( WP_DARK_MODE_FILE, [ $this, 'activation' ] );

				//chart widget
				register_deactivation_hook( WP_DARK_MODE_FILE, [ $this, 'deactivation' ] );

				add_action( 'admin_init', [ $this, 'activation_redirect' ] );
			}
		}

		/**
		 * Ensure theme and server variable compatibility
		 *
		 * @return boolean
		 * @since  1.0.0
		 * @access private
		 */
		private function check_environment() {
			$return = true;

			/** Check the PHP version compatibility */
			if ( version_compare( PHP_VERSION, self::$min_php, '<=' ) ) {
				$return = false;

				$notice = sprintf( esc_html__( 'Unsupported PHP version Min required PHP Version: "%s"', 'wp-dark-mode' ), self::$min_php );
			}

			/** Add notice and deactivate the plugin if the environment is not compatible */
			if ( ! $return ) {
				add_action(
					'admin_notices', function () use ( $notice ) { ?>
                    <div class="notice is-dismissible notice-error">
                        <p><?php echo $notice; ?></p>
                    </div>
					<?php
				}
				);

				return $return;
			} else {
				return $return;
			}
		}

		/**
		 * do the activation stuffs
		 */
		public function activation() {
			require WP_DARK_MODE_INCLUDES . '/admin/class-install.php';

			add_option( 'wp_dark_mode_do_activation_redirect', true );
		}

		public function deactivation() {
			wp_clear_scheduled_hook( 'wp_dark_mode_send_email_reporting' );
		}

		/**
		 *
		 * redirect to settings page after activation the plugin
		 */
		public function activation_redirect() {
			if ( get_option( 'wp_dark_mode_do_activation_redirect', false ) ) {
				delete_option( 'wp_dark_mode_do_activation_redirect' );

				wp_redirect( admin_url( 'admin.php?page=wp-dark-mode-settings' ) );
			}
		}


		/**
		 * check if the pro plugin is active or not
		 *
		 * @return bool
		 */
		public function is_pro_active() {
			return apply_filters( 'wp_dark_mode_pro_active', false );
		}

		/**
		 * check if the pro plugin is active or not
		 *
		 * @return bool
		 */
		public function is_ultimate_active() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			$is_ultimate_plan = $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Lifetime' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Yearly' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 1 Site' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 50 Sites' );

			$is_valid = $wp_dark_mode_license->is_valid() && $is_ultimate_plan;

			if ( $is_valid ) {
				return true;
			}

			return false;
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function load_files() {

			//core includes
			include_once WP_DARK_MODE_INCLUDES . '/class.wppool.php';
			include_once WP_DARK_MODE_INCLUDES . '/functions.php';
			include_once WP_DARK_MODE_INCLUDES . '/class-enqueue.php';
			include_once WP_DARK_MODE_INCLUDES . '/class-shortcode.php';
			include_once WP_DARK_MODE_INCLUDES . '/class-hooks.php';
			include_once WP_DARK_MODE_INCLUDES . '/scss.inc.php';
			include_once WP_DARK_MODE_INCLUDES . '/class-nav-menu.php';
			include_once WP_DARK_MODE_INCLUDES . '/class-theme-supports.php';

			/** load gutenberg block */
			include_once WP_DARK_MODE_INCLUDES . '/gutenberg/block.php';

			//admin includes
			if ( is_admin() ) {
				require WP_DARK_MODE_INCLUDES . '/admin/class-admin.php';
				require WP_DARK_MODE_INCLUDES . '/admin/class-settings-api.php';
				require WP_DARK_MODE_INCLUDES . '/admin/class-settings.php';
			}
		}

		/**
		 * Initialize plugin for localization
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function lang() {
			load_plugin_textdomain( 'wp-dark-mode', false, dirname( plugin_basename( WP_DARK_MODE_FILE ) ) . '/languages/' );
		}

		/**
		 * Plugin action links
		 *
		 * @param array $links
		 *
		 * @return array
		 */
		public function plugin_action_links( $links ) {
			$links[] = sprintf(
				'<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=wp-dark-mode-settings' ),
				__( 'Settings', 'wp-dark-mode' )
			);

			if ( ! $this->is_pro_active() && ! $this->is_ultimate_active() ) {
				$links[] = sprintf(
					'<a href="%1$s" target="_blank" style="color: orangered;font-weight: bold;">%2$s</a>',
					'https://go.wppool.dev/EeQ', __( 'GET PRO', 'wp-dark-mode' )
				);
			}

			return $links;
		}


		/**
		 * Returns path to template file.
		 *
		 * @param null $name
		 * @param boolean|array $args
		 *
		 * @return bool|string
		 * @since 1.0.0
		 */
		public function get_template( $name = null, $args = false ) {
			if ( ! empty( $args ) && is_array( $args ) ) {
				extract( $args );
			}

			$template = locate_template( 'wp-dark-mode/' . $name . '.php' );

			if ( ! $template ) {
				$template = WP_DARK_MODE_TEMPLATES . "/$name.php";
			}

			if ( file_exists( $template ) ) {
				include $template;
			} else {
				return false;
			}
		}

		/**
		 * register darkmode switch elementor widget
		 *
		 * @throws Exception
		 */
		public function register_widget() {
			require WP_DARK_MODE_INCLUDES . '/elementor/class-elementor-widget.php';
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new WP_Dark_Mode_Elementor_Widget() );
		}

		/**
		 * add admin notices
		 *
		 * @param           $class
		 * @param           $message
		 * @param string $only_admin
		 *
		 * @return void
		 */
		public function add_notice( $class, $message ) {
			$notices = get_option( sanitize_key( 'wp_dark_mode_notices' ), [] );
			if ( is_string( $message ) && is_string( $class )
			     && ! wp_list_filter( $notices, array( 'message' => $message ) ) ) {
				$notices[] = array(
					'message' => $message,
					'class'   => $class,
				);

				update_option( sanitize_key( 'wp_dark_mode_notices' ), $notices );
			}
		}

		/**
		 * Print the admin notices
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function print_notices() {
			$notices = get_option( sanitize_key( 'wp_dark_mode_notices' ), [] );
			foreach ( $notices as $notice ) {
				?>
                <div class="notice notice-large is-dismissible notice-<?php echo $notice['class']; ?>">
					<?php echo $notice['message']; ?>
                </div>
				<?php
				update_option( sanitize_key( 'wp_dark_mode_notices' ), [] );
			}
		}


		/**
		 * Initialize the plugin tracker
		 *
		 * @return void
		 */
		public function appsero_init_tracker_wp_dark_mode() {

			if ( ! class_exists( 'Appsero\Client' ) ) {
				require_once WP_DARK_MODE_INCLUDES . '/appsero/Client.php';
			}

			$client = new Appsero\Client( '10d1a5ba-96f5-48e1-bc0e-38d39b9a2f85', 'WP Dark Mode', WP_DARK_MODE_FILE );

			// Active insights
			$client->insights()->init();

			// Active automatic updater
			$client->updater();
		}


		/**
		 * Main WP_Dark_Mode Instance.
		 *
		 * Ensures only one instance of WP_Dark_Mode is loaded or can be loaded.
		 *
		 * @return WP_Dark_Mode - Main instance.
		 * @since 1.0.0
		 * @static
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

}

/** if function `wp_dark_mode` doesn't exists yet. */
if ( ! function_exists( 'wp_dark_mode' ) ) {
	function wp_dark_mode() {
		return WP_Dark_Mode::instance();
	}
}

/** fire off the plugin */
wp_dark_mode();
