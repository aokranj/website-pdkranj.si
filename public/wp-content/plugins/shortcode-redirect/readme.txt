=== Shortcode Redirect ===
Contributors: cartpauj
Tags: redirect, block, gutenberg, url, shortcode
Requires at least: 6.0
Tested up to: 7.0
Stable tag: 1.1.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Redirect any post or page — with a native block or a classic shortcode. Optional delay. Optional "redirecting" message. Zero configuration.

== Description ==

Shortcode Redirect sends visitors from any post or page to another URL. No settings screens, no database tables — just drop it in where you need it.

There are two ways to use it, and both produce the exact same front-end output.

**1. The Redirect block (new in 1.1.0)**

In the block editor, add the **Redirect** block from the *Widgets* category. The block sidebar exposes three simple fields:

* **Destination URL** — where the visitor should end up
* **Seconds to wait** — how long to pause before redirecting (`0` = immediate)
* **Show "redirecting" message** — toggle the visible "Please wait..." line on or off

The editor shows a live summary of what the block will do, e.g. *"Redirects to https://example.com — after 3 seconds · message shown"*. No shortcode syntax to memorize.

**2. The classic shortcode**

Paste into any post or page:

`[redirect url='https://example.com' sec='3']`

Shortcode attributes:

* `url` — destination URL *(required)*
* `sec` — seconds to wait before redirecting *(optional, default `0`)*
* `show_message` — set to `false`, `0`, `no`, or `off` to hide the "redirecting" message *(optional, default `true`, new in 1.1.0)*

Example with all three:

`[redirect url='https://example.com' sec='5' show_message='false']`

**Same output either way**

Block or shortcode, the front-end renders the same single `<meta http-equiv="refresh">` tag (plus the optional one-line message). No JavaScript. No server-side redirect. No third-party tracking. Existing `[redirect]` shortcodes from earlier versions continue to work unchanged.

= Features =
* **Block editor support** — native "Redirect" block *(new in 1.1.0)*
* **Classic shortcode** — `[redirect]` works exactly like it always has
* **Optional delay** — choose how many seconds to wait before redirecting
* **Silent mode** — hide the "redirecting..." message for a clean, blank-page redirect *(new in 1.1.0)*
* **Lightweight** — a single PHP file plus a small block; no settings, no tables, no dependencies
* **Backwards compatible** — upgrading from 1.0.x is drop-in

== Installation ==
1. Install from the WordPress Plugin Directory, or upload `shortcode-redirect.zip` to `/wp-content/plugins/`.

2. Activate the plugin through the **Plugins** menu.

3. Either:
    * Add the **Redirect** block to any post/page (block inserter → *Widgets* → *Redirect*), **or**
    * Paste `[redirect url='https://example.com' sec='3']` into any post/page.

No configuration screen to visit — the plugin activates and is immediately usable.

== Frequently Asked Questions ==

= How do I hide the "Please wait while you are redirected..." message? =

**In the block:** toggle off *Show "redirecting" message* in the block sidebar.

**In the shortcode:** add `show_message='false'` (also accepts `0`, `no`, or `off`):

`[redirect url='https://example.com' sec='3' show_message='false']`

= Do the block and the shortcode behave the same? =

Yes. Both render the same `<meta http-equiv="refresh">` tag on the front-end. Same delay handling, same message toggle, same output.

= Can I mix blocks and shortcodes on the same site? =

Absolutely. Use whichever fits the page you're editing. Pages built with the old `[redirect]` shortcode keep working when you upgrade — no migration required.

= Does this require JavaScript in the visitor's browser? =

No. The redirect is a plain HTML `<meta http-equiv="refresh">` tag. It works with JavaScript disabled, in text browsers, and inside reader modes.

= Can I use this in a Reusable Block / Synced Pattern? =

Yes — the Redirect block supports reuse, so you can save a configured redirect once and drop it anywhere.

== Upgrade Notice ==
= 1.1.1 =
Adds a native block editor block alongside the existing shortcode, plus a show/hide toggle for the "redirecting" message.

== Changelog ==
= 1.1.2 =
* Ensure WP 7.0 Compat

= 1.1.1 =
* **New:** Native block editor "Redirect" block (shares the same render logic as the shortcode)
* **New:** Option to show or hide the "Please wait while you are redirected..." message — via the `show_message` shortcode attribute or the *Show "redirecting" message* block toggle
* Hardened output escaping, added proper license headers, and added direct-access protection to satisfy Plugin Check

= 1.0.4 =
* Ensure compat with WP 6.9

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
1. The **Redirect** block in the block editor — destination URL, delay, and "show message" toggle all live in the block sidebar, with a live summary inside the canvas.
2. Using the classic `[redirect]` shortcode via the core Shortcode block — fully backwards compatible.
3. The default "Please wait while you are redirected..." message that visitors see (with a manual fallback link) while the page waits to redirect.
