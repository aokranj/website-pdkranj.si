=== Shortcode Redirect ===
Contributors: cartpauj
Donate link: http://www.memberpress.com/?aff=20
Tags: redirect, rewrite, page, post, url
Requires at least: 6.0
Tested up to: 6.8
Stable tag: 1.0.03
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt

A super easy way to automatically redirect a user to another page when viewing a post/page on your site.

== Description ==
Shortcode Redirect allows site owners to automatically redirect a user after a chosen amount of seconds when viewing a page or post on the site. The plugin instructions are very simple. Add a shortcode to the post/page that looks like the following `[redirect url='http://somesite.com' sec='3']` the url= part is where you define the URL to redirect the user to and the sec= part is where you define how many seconds to wait before redirecting.

= Donate =
[If you like this plugin please consider donating](http://www.memberpress.com/?aff=20)

= Features =
* Works on pages and posts
* NO settings or configurations to deal with
* Define a URL to redirect the user to
* Define how many seconds to wait before re-directing the user.

== Installation ==
1. Upload 'shortcode-redirect.zip' to the '/wp-content/plugins/' directory.

2. Activate the plugin through the 'Plugins' menu in WordPress.

3. Add the shortcode on the pages/posts that you want to redirect. Shortcodes should look like `[redirect url='http://somesite.com' sec='5']` where the url= part is the URL to redirect to, and sec= is the seconds to wait before redirecting the page.

4. Done!

== Note ==
Shortcode redirect should work with older versions of WordPress as well but was not tested with anything older than 2.7

== Frequently Asked Questions ==
* How do I get rid of the "Please wait while you are being re-directed..." line? - Later I will have an option for this, but for now, just edit the scr.php file and delete line 36 which contains that text then save the file.

== Upgrade Notice ==
n/a

== Changelog ==
= 1.0.03 =
* Fix XSS vulnerability (patchstack report efd671f0-81c0-4ca8-bbdb-11e6b63d3fe6)
= 1.0.02 =
* Fixed a low risk security hole
= 1.0.01 =
* Added output buffer to make text show up in the right place
* Added license to main file
* Fixed URL bug
= 1.0.00 =
* Initial release

== Screenshots ==
none
