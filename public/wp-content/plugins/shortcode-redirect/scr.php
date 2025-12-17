<?php
/*
Plugin Name: ShortCode Redirect
Plugin URI: http://cartpauj.icomnow.com/projects/shortcode-redirect-plugin/
Description: This plugin allows you to add a shortcode to a page. When this shortcode is executed it re-directs the user to a pre-defined URL. You can also set how many seconds to wait before redirecting the user.
Author: Cartpauj
Version: 1.0.03
Author URI: http://cartpauj.icomnow.com

GNU General Public License, Free Software Foundation <http://creativecommons.org/licenses/GPL/2.0/>
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

add_shortcode('redirect', 'scr_do_redirect');
function scr_do_redirect($atts)
{
	ob_start();
	$myURL = (isset($atts['url']) && !empty($atts['url'])) ? esc_url($atts['url']) : "";
	$mySEC = (isset($atts['sec']) && !empty($atts['sec']) && is_numeric($atts['sec'])) ? intval($atts['sec']) : 0;
	if(!empty($myURL))
  {
?>
		<meta http-equiv="refresh" content="<?php echo $mySEC; ?>; url=<?php echo $myURL; ?>">
		Please wait while you are redirected...or <a href="<?php echo $myURL; ?>">Click Here</a> if you do not want to wait.
<?php
	}
	return ob_get_clean();
}

?>
