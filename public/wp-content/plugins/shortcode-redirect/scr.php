<?php
/*
Plugin Name: Shortcode Redirect
Plugin URI: https://github.com/cartpauj/shortcode-redirect
Description: Redirect visitors from any post or page to a chosen URL — via a native block or the classic [redirect] shortcode. Optional delay and optional "redirecting" message.
Author: cartpauj
Version: 1.1.2
Author URI: https://github.com/cartpauj
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: shortcode-redirect

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software Foundation,
Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SCR_VERSION' ) ) {
	$scr_data = get_file_data( __FILE__, array( 'Version' => 'Version' ) );
	define( 'SCR_VERSION', $scr_data['Version'] ?: '0.0.0' );
	unset( $scr_data );
}

add_shortcode( 'redirect', 'scr_do_redirect' );
function scr_do_redirect( $atts ) {
	ob_start();
	$myURL   = ( isset( $atts['url'] ) && ! empty( $atts['url'] ) ) ? (string) $atts['url'] : '';
	$mySEC   = ( isset( $atts['sec'] ) && ! empty( $atts['sec'] ) && is_numeric( $atts['sec'] ) ) ? intval( $atts['sec'] ) : 0;
	$showMsg = true;
	if ( isset( $atts['show_message'] ) ) {
		$v = $atts['show_message'];
		if ( is_bool( $v ) ) {
			$showMsg = $v;
		} else {
			$lv      = strtolower( (string) $v );
			$showMsg = ! in_array( $lv, array( 'false', '0', 'no', 'off' ), true );
		}
	}
	if ( ! empty( $myURL ) ) {
		?>
		<meta http-equiv="refresh" content="<?php echo absint( $mySEC ); ?>; url=<?php echo esc_url( $myURL ); ?>">
		<?php if ( $showMsg ) { ?>
		Please wait while you are redirected...or <a href="<?php echo esc_url( $myURL ); ?>">Click Here</a> if you do not want to wait.
		<?php } ?>
		<?php
	}
	return ob_get_clean();
}

add_action( 'init', 'scr_register_block' );
function scr_register_block() {
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	register_block_type(
		__DIR__ . '/block',
		array(
			'render_callback' => 'scr_render_block',
		)
	);
}

function scr_render_block( $attributes ) {
	return scr_do_redirect(
		array(
			'url'          => isset( $attributes['url'] ) ? $attributes['url'] : '',
			'sec'          => isset( $attributes['sec'] ) ? $attributes['sec'] : 0,
			'show_message' => isset( $attributes['showMessage'] ) ? (bool) $attributes['showMessage'] : true,
		)
	);
}
