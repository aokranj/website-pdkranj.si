<?php

/**
 * Handles ajax requests for WP Dark Mode
 *
 * @package WP Dark Mode
 * @since 5.0.0
 */

// Namespace.
namespace WP_Dark_Mode;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit( 1 );

if ( ! class_exists( __NAMESPACE__ . 'Ajax' ) ) {
	/**
	 * Handles ajax requests for WP Dark Mode
	 *
	 * @package WP Dark Mode
	 * @since 5.0.0
	 */
	class Ajax extends \WP_Dark_Mode\Base {

		// Use options trait.
		use \WP_Dark_Mode\Traits\Options;

		// Utility trait.
		use \WP_Dark_Mode\Traits\Utility;

		/**
		 * Register ajax actions
		 *
		 * @since 5.0.0
		 */
		public function actions() {
			add_action( 'wp_ajax_wp_dark_mode_update_visitor', array( $this, 'update_visitor' ) );
			add_action( 'wp_ajax_nopriv_wp_dark_mode_update_visitor', array( $this, 'update_visitor' ) );
		}

		/**
		 * Updates options
		 *
		 * @since 5.0.0
		 */
		public function update_visitor() {
			// Check nonce.
			check_ajax_referer( 'wp_dark_mode_security', 'security_key' );

			// Check for honeypot.
			if ( isset( $_POST['website'] ) && ! empty( $_POST['website'] ) ) {
				wp_send_json_error( array( 'message' => 'Invalid request' ) );
			}

			// Check for rate limiting.
			$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
			$rate_limit_key = 'wpdm_visitor_rate_' . md5( $ip );
			$request_count = get_transient( $rate_limit_key );
			$max_requests = apply_filters( 'wp_dark_mode_visitor_rate_limit', 10 );

			if ( $request_count && $request_count >= $max_requests ) {
				wp_send_json_error( array(
					'message'     => 'Rate limit exceeded. Please try again later.',
					'retry_after' => 3600,
				) );
			}

			// Increment rate limit counter.
			set_transient( $rate_limit_key, ( $request_count ? $request_count + 1 : 1 ), HOUR_IN_SECONDS );

			$visitor_id = isset( $_POST['visitor_id'] ) ? intval( wp_unslash( $_POST['visitor_id'] ) ) : false;

			if ( $visitor_id && $visitor_id > 0 ) {
				// Update visitor.
				$this->update_existing_visitor( $visitor_id );
			} else {
				// Insert visitor.
				$this->insert_new_visitor();
			}
		}

		/**
		 * Inserts visitor
		 *
		 * @since 5.0.0
		 */
		public function insert_new_visitor() {
			// Check nonce.
			check_ajax_referer( 'wp_dark_mode_security', 'security_key' );

			$user_id = get_current_user_id();
			$ip = isset( $_POST['ip'] ) ? sanitize_text_field( wp_unslash( $_POST['ip'] ) ) : ( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );

			$mode = isset( $_POST['mode'] ) ? sanitize_text_field( wp_unslash( $_POST['mode'] ) ) : 'dark';
			$meta = isset( $_POST['meta'] ) ? sanitize_text_field( wp_unslash( $_POST['meta'] ) ) : '';

			$visitor = new \WP_Dark_Mode\Model\Visitor();

			try {
				$visitor_id = $visitor->add( array(
					'meta' => $meta,
					'user_id' => $user_id,
					'ip' => $ip,
					'mode' => $mode,
				) );
			} catch ( \Exception $e ) {
				wp_send_json_error( $e->getMessage() );
			}

			// Return success.
			if ( $visitor_id ) {
				wp_send_json_success( [
					'visitor_id' => $visitor_id,
					'message' => 'Visitor inserted successfully',
				] );
			} else {
				global $wpdb;
				wp_send_json_error( [
					'message' => 'Visitor not inserted',
					'error' => $wpdb->last_error,
				] );
			}
		}

		/**
		 * Updates visitor
		 *
		 * @param int $visitor_id Visitor ID.
		 * @since 5.0.0
		 */
		public function update_existing_visitor( $visitor_id ) {

			// Check nonce.
			check_ajax_referer( 'wp_dark_mode_security', 'security_key' );

			// Validate visitor ownership.
			$visitor_model    = new \WP_Dark_Mode\Model\Visitor();
			$existing_visitor = $visitor_model->get_by_id( $visitor_id );

			if ( ! $existing_visitor ) {
				wp_send_json_error( array( 'message' => 'Visitor not found' ) );
			}

			// Check ownership.
			$current_ip      = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
			$current_user_id = get_current_user_id();

			$is_owner = false;

			// Check if IP matches OR user_id matches.
			if ( $existing_visitor->ip === $current_ip ) {
				$is_owner = true;
			} elseif ( $current_user_id > 0 && $existing_visitor->user_id == $current_user_id ) {
				$is_owner = true;
			}

			if ( ! $is_owner ) {
				wp_send_json_error( array(
					'message' => 'You do not have permission to update this visitor record',
				) );
			}

			$mode = isset( $_POST['mode'] ) ? sanitize_text_field( wp_unslash( $_POST['mode'] ) ) : 'dark';

			$visitor = new \WP_Dark_Mode\Model\Visitor();

			try {
				$updated = $visitor->update( array(
					'mode' => $mode,
					'user_id' => is_user_logged_in() ? get_current_user_id() : null,
				), intval($visitor_id) );
			} catch ( \Exception $e ) {
				wp_send_json_error( $e->getMessage() );
			}

			// Return success.
			if ( $updated ) {
				wp_send_json_success( [
					'visitor_id' => $visitor_id,
					'message' => 'Visitor updated successfully',
				] );
			} else {
				wp_send_json_error( [
					'visitor_id' => $visitor_id,
					'message' => 'Visitor not updated',
				] );
			}
		}
	}

	// Instantiate the class.
	Ajax::init();
}
