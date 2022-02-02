<?php

defined( 'ABSPATH' ) || exit();

class WP_Dark_Mode_Theme_Supports {
	private static $instance = null;

	public function __construct() {
		add_action( 'wp_head', [ $this, 'theme_header' ] );
		//add_filter( 'wp_dark_mode/not', [ $this, 'not_selectors' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_filter( 'wp_dark_mode/excludes', [ $this, 'excludes' ], 99 );
	}

	public function excludes( $excludes ) {

		if ( $this->is_theme( 'Jannah' ) ) {
			$excludes .= ", .post-thumb-overlay-wrap, .post-thumb-overlay";
		}

		if ( $this->is_theme( 'OceanWP' ) ) {
			$excludes .= ", .wcmenucart-details";
		}

		if ( $this->is_theme( 'Salient' ) ) {
			$excludes .= ", .slide_out_area_close";
		}

		if ( $this->is_theme( 'Twenty Twenty' ) ) {
			$excludes .= ", .search-toggle, .woocommerce-product-gallery__trigger .emoji";
		}

		if ( $this->is_theme( 'Flatsome' ) ) {
			$excludes .= ", .section-title b, .box, .is-divider, .blog-share, .slider-wrapper";
		}

		if ( $this->is_theme( 'Avada' ) ) {
			$excludes .= ", .fusion-column-inner-bg-wrapper, .fusion-progressbar, .fusion-sliding-bar-wrapper, .fusion-button";
		}

		if ( $this->is_theme( 'The7' ) ) {
			$excludes .= ', .dt-btn, .soc-ico, .author-avatar, .post-thumbnail, .icon-inner';
		}

		if ( $this->is_theme( 'Betheme' ) ) {
			$excludes .= ', .mfn-rev-slider, .image_frame';
		}

		if ( $this->is_theme( 'Newspaper' ) ) {
			$excludes .= ', .td-module-meta-info';
		}

		return $excludes;
	}

	public function is_theme( $check_theme ) {
		$theme = wp_get_theme();

		$theme_name        = $theme->name;
		$theme_parent_name = ! empty( $theme->parent()->name ) ? $theme->parent()->name : '';

		return in_array( $check_theme, [ $theme_name, $theme_parent_name ] );

	}

	public function theme_header() {

	}

	public function not_selectors( $selectors ) {
		if ( $this->is_theme( 'Jannah' ) ) {
			$selectors = ':not(.breaking-title-text):not(.shopping-cart-icon):not(.menu-counter-bubble-outer):not(.menu-counter-bubble)';
		}

		return $selectors;
	}

	public function enqueue_scripts() {


		if ( $this->is_theme( 'Astra' ) ) {
			wp_enqueue_style( 'wp-dark-mode-astra', WP_DARK_MODE_ASSETS . '/css/themes/astra.css' );
		} elseif ( $this->is_theme( 'Jannah' ) ) {
			wp_enqueue_style( 'wp-dark-mode-jannah', WP_DARK_MODE_ASSETS . '/css/themes/jannah.css' );
		} elseif ( $this->is_theme( 'OceanWP' ) ) {
			wp_enqueue_style( 'wp-dark-mode-salient', WP_DARK_MODE_ASSETS . '/css/themes/oceanwp.css' );
		} elseif ( $this->is_theme( 'Salient' ) ) {
			wp_enqueue_style( 'wp-dark-mode-salient', WP_DARK_MODE_ASSETS . '/css/themes/salient.css' );
		} elseif ( $this->is_theme( 'Twenty Twenty' ) ) {
			wp_enqueue_style( 'wp-dark-mode-twentytwenty', WP_DARK_MODE_ASSETS . '/css/themes/twentytwenty.css' );
		} elseif ( $this->is_theme( 'Salient' ) ) {
			wp_enqueue_style( 'wp-dark-mode-salient', WP_DARK_MODE_ASSETS . '/css/themes/salient.css' );
		} elseif ( $this->is_theme( 'Flatsome' ) ) {
			wp_enqueue_style( 'wp-dark-mode-flatsome', WP_DARK_MODE_ASSETS . '/css/themes/flatsome.css' );
		} elseif ( $this->is_theme( 'Avada' ) ) {
			wp_enqueue_style( 'wp-dark-mode-avada', WP_DARK_MODE_ASSETS . '/css/themes/avada.css' );
		} elseif ( $this->is_theme( 'The7' ) ) {
			wp_enqueue_style( 'wp-dark-mode-the7', WP_DARK_MODE_ASSETS . '/css/themes/the7.css' );
		} elseif ( $this->is_theme( 'Betheme' ) ) {
			wp_enqueue_style( 'wp-dark-mode-betheme', WP_DARK_MODE_ASSETS . '/css/themes/betheme.css' );
		} elseif ( $this->is_theme( 'Newspaper' ) ) {
			wp_enqueue_style( 'wp-dark-mode-newspaper', WP_DARK_MODE_ASSETS . '/css/themes/newspaper.css' );
		} elseif ( $this->is_theme( 'GeneratePress' ) ) {
			wp_enqueue_style( 'wp-dark-mode-generatepress', WP_DARK_MODE_ASSETS . '/css/themes/generatepress.css' );
		}

	}


	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

WP_Dark_Mode_Theme_Supports::instance();