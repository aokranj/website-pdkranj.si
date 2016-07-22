=== Feature A Page Widget ===
Contributors: mrwweb
Donate link: https://www.networkforgood.org/donation/MakeDonation.aspx?ORGID2=522061398
Tags: Widget, Widgets, Sidebar, Page, Pages, Featured Page, Thumbnail, Featured Image, Content, Link, Post Thumbnail, Excerpt, Simple
Requires at least: 3.0.0
Tested up to: 3.6
Stable tag: 1.2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shows a summary of any Page in any sidebar.

== Description ==

Feature A Page Widget aims to provide a "just works" solution for showcasing a Page in any sidebar. It leverages Core WordPress features, a *simple* set of options with a thought-through UI including three widget layouts.

For those more technically adept, there are three filters and a template to customize the output of the widget (see the [FAQ](http://wordpress.org/extend/plugins/feature-a-page-widget/) for more information). It's also i18n ready.

= How to Use the Widget =

This plugin enables Featured Images (aka "Post Thumbnails") and Excerpts for **Pages** in WordPress. If you don't see one or both of those fields, they may be hidden in the "Screen Options" (look in top-right corner) for Pages.

1. Edit the page you want to feature.
1. Fill out the [Excerpt](http://en.support.wordpress.com/splitting-content/excerpts/#creating-excerpts) and select a [Featured Image](http://en.support.wordpress.com/featured-images/#setting-a-featured-image) on that page.
1. Go to Appearance > Widgets.
1. Add an instance of the "Feature a Page Widget" to the sidebar of your choosing.
1. Select the Page, choose a layout, and give the widget a title if you want.
1. Save the widget. Admire your handiwork.

= A Word About Image Sizes =

This plugin creates multiple custom image sizes. If you use images that were uploaded to the  media library before you installed this plugin, you'd be wise to use a plugin like [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) or [Dynamic Image Resizer](http://wordpress.org/extend/plugins/regenerate-thumbnails/).

= Tell Me How to Make The Plugin Better =

* [Vote on the options](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_5) you'd like to see in future versions of the plugin.
* Give me [in-depth feedback](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_4).
* [Rate/Review the plugin](http://wordpress.org/support/view/plugin-reviews/feature-a-page-widget).

= Themes Tested =

Twenty Twelve, Twenty Eleven, Twenty Ten, P2, Kubrick (for old times' sake), Multiple Custom Themes. [Known theme & plugin incompatibilities.](http://wordpress.org/extend/plugins/feature-a-page-widget/other_notes/)

= Other Plugins by MRWweb =

* [Post Status Menu Items](http://wordpress.org/plugins/post-status-menu-items/) - Adds post status links–e.g. "Draft" (7)–to post type admin menus.
* [Advanced Custom Fields Repeater & Flexible Content Fields Collapser](http://wordpress.org/plugins/advanced-custom-field-repeater-collapser/) - Easier sorting for large repeated fields in the Advanced Custom Fields plugin.

== Installation ==

1. Upload the `feature-a-page-widget` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Fill out the excerpt and select the featured image for the Page(s) you will feature.
1. From "Appearance" > "Widgets," you can now drag the "Feature a Page" widget into any sidebar.
1. Find advanced instructions, code snippets, and more in the [FAQ](http://wordpress.org/extend/plugins/feature-a-page-widget/).

== Frequently Asked Questions ==

= How do I set the widget image? =

The widget gets its image from the "Featured Image" field on the page you are featuring.

1. Go to the page you're featuring.
1. In the right sidebar, look for the "Set Featured Image" link.
1. Use the media picker to find the image and then select "Use as Featured Image."
1. Update the page and you're ready to go.

= How do I set the widget text? =

The widget gets its text from the "Excerpt" field on the page you are featuring. See also: "Can I use HTML or a WYSIWYG/TinyMCE Editor with the Excerpt Field?"

1. Go to the page you want to featured.
1. Below the body field, look for the "Excerpt" field.
1. Fill it in.
1. Update the page.

= Where do I find the Featured Image or Excerpt fields? I don't see them. =

The Featured Image and Excerpt fields are found on the Page editing screen of the Page you want to feature. If you don't see them:
1. In the top right corner of any **Page**, click "Screen Options."
1. From the menu that slides down, make sure the "Excerpt" and "Featured Image" are both checked.
1. WordPress will remember this choice on all pages.

= How can I tell if a page has a featured image or excerpt already? / What are those icons in the "Select Page" drop down? =

When selecting the page to feature in the widget settings, the list of pages includes two icons. The first icon is the featured image, and the second is the excerpt. If the icon is "lit-up," that means that page has that piece of information. If both are lit-up, the page is ready for optimal use in the widget. See this interface in the "Screenshots" tab.

= How can I modify the widget design or output? =

The widget offers three ways to customize its design and output. The right method for you depends on what you want to accomplish and what you're comfortable doing technically.

1. **Write your own CSS rules.** The plugin's CSS selectors have as low a priority as possible, so you should be able to override styles easily. See `/css/fpw_start_styles.css` for a starter stylesheet you can copy and modify.
1. **Filter the Title, Excerpt, or Image.** The plugin gives you three filters to modify the outputs in the widget: `fpw_page_title`, `fpw_excerpt`, and `fpw_featured_image`. The widget's title also goes through the `widget_title` filter.
  * Those comfortable writing filters can see the specifics in `fpw_widget.class.php`.
  * See the next FAQ for an example of adding a "Read More…" link.
1. **Override the Widget's output template.** The widget output can be overridden by a template in any parent or child theme. Copy the `/fpw_views/` folder from the plugin's folder to your theme's folder (or child theme folder!) and modify `fpw_default.php` to your heart's content. The template itself contains additional information on what data is available to work with.

= Can I use HTML or a WYSIWYG/TinyMCE Editor with the Excerpt Field? =
Install the [Rich Text Excerpts plugin](http://wordpress.org/extend/plugins/rich-text-excerpts/) or [Advanced Excerpt](http://wordpress.org/extend/plugins/advanced-excerpt/) plugins. Either plugin should take note and display your nicely formatted excerpt.

= How can I get a "Read More…" link? =

This may become a widget option some day. For now, it's easy to add with a filter. Place this code in your theme's `functions.php` file or in a [functionality plugin](http://justintadlock.com/archives/2011/02/02/creating-a-custom-functions-plugin-for-end-users):

`function fapw_custom_read_more_link( $excerpt, $featured_page_id ) {
    return $excerpt . ' <a href="' . get_permalink( $featured_page_id ) . '">Read More…</a>';
}
add_filter( 'fpw_excerpt', 'fapw_custom_read_more_link', 10, 2 );`

= How do I change the image's size? =
Asked and answered in the support forum thread: ["Changing the default thumbnail size"](http://wordpress.org/support/topic/changing-the-default-thumbnail-size-1)

= I need to support IE8 and my theme doesn't use HTML5 =

If you are having trouble with this widget's layout in IE8, it may be due to the use of the `<article>` element in the widget. Double-check that your theme isn't using the HTML5 shiv/shim. If it's not, then adding the following to your theme's `functions.php` file may fix the issue ([snippet source](http://css-tricks.com/snippets/wordpress/html5-shim-in-functions-php/)):
`// add ie conditional html5 shim to header
function add_ie_html5_shim () {
	global $is_IE;
	if ($is_IE)
   	echo '<!--[if lt IE 9]>';
    	echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    	echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');`

= This widget isn't what I want... =

This widget is intended to be straightforward and avoid melting into "option soup." However, that means it might not be perfect for what you need.

If you think the widget is *almost right*, double-check that can't use the one of the plugin's filters or the widget view template (see "I want to modify how the widget looks/works"). If that doesn't work, [submit some feedback](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_4) or [vote on possible features](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_5) for future versions of the plugins. And of course, there's always [the support forum](http://wordpress.org/support/plugin/feature-a-page-widget).

If this plugin is more than a little off, you might be looking for a different plugin like [Posts in Sidebar](http://wordpress.org/extend/plugins/posts-in-sidebar/), [Query Posts Widget](http://wordpress.org/extend/plugins/query-posts/), [Featured Page Widget](http://wordpress.org/extend/plugins/featured-page-widget/), or [Simple Featured Posts Widget](http://wordpress.org/extend/plugins/simple-featured-posts-widget/).

= How do you make the "Featured page" select list look so cool? =

I'm using the [Chosen](http://harvesthq.github.com/chosen/) jQuery plugin. It's awesome. I first saw it in Gravity Forms.

== Screenshots ==

1. Choose from three theme-agnostic layouts.
2. No need to choke down "option soup."
3. Widget interface shows you which pages have featured images and excerpts.
4. Uses standard WordPress fields (Title, Featured Image, and Excerpt) that you already know and love.

== Changelog ==
= 1.2.5 (September 27, 2013) =
* [Fix] Removed compatibility "fixes" for Digg Digg and PodPress. See support forum for details and recommended fixes.
* Thanks to [@phrenq](http://wordpress.org/support/profile/phrenq) for troubleshooting help.

= 1.2.4 (September 18, 2013) =
* [Fix] Page selection menu no longer disappears after saving widget in WordPress 3.6.
* [Fix] Remove `the_excerpt` filters for Digg Digg and podPress plugins before outputting widget excerpt.
* [Fix] Add class to `<article>` wrapper to consistently apply bottom-margin to Widget Title, Page Title, and Image
* [Improvement] Minor CSS tweaks to admin interface.
* [Improvement] Only load frontend CSS if widget is active.
* [New] Example stylesheet added to `/css/fpw_start_styles.css`.
* [Update] Now using Chosen v1.0.0! (Dev note: new CSS classes & events)
* [News] This bug fix update should be the last one before v1.5.0 which will include new features including the ability to feature Posts!

= 1.2.3 =
* [Fix] Modification to widget HTML. Wrap excerpt in div element, not paragraph. Developers: If you have changed the `fpw_default.php` files, please make this change in line 66. Overly-specific CSS selectors (e.g. `p.fpw-excerpt`) may break on this change.
* [Notice] Developers, please copy the `/fpw_views/` folder to your theme rather than modifying the core plugin file.

= 1.2.2 =
* [New] Apply `the_excerpt` and `get_the_excerpt` filters to excerpt in widget.
* [New] First-pass at qTranslate support
* [New] Tested with Advanced Excerpt plugin
* Tested with 3.6-beta2

= 1.2.1 =
* "Read More" filter fix.
* Accessibility mode invisible "Page Select List" fix.
* Upgraded to most recent version of Chosen script. (And included Chosen MIT License for clarity.)

= 1.2.0 =
* New "Page Status" instant feedback determines whether the featured image and excerpt are set for selected page.
* New contextual help. (And access to it via help button in widget settings.)
* Fixed Rich Text Excerpts support
* Minor JS improvement: Only reactivate "chosen" script on saved widget instance.

= 1.1.2 =
* Fixed image-size class.

= 1.1.1 =
* Fixed version number and plugin update hook.
* Added post classes & hAtom markup to widget view (see [thread](http://wordpress.org/support/topic/applying-a-ahover-featured-image-possible?replies=5)). If you have customized `fpw_default.php`, review changes to the template (see [diff #644501](http://plugins.trac.wordpress.org/changeset/644501#file1), lines 31-32, 37, 66) and update your copy to take advantage of new classes.
* Added known incompatibilites list to "Other Notes" section.

= 1.1.0 =
* Tested for WordPress 3.5 support.
* Fixed i18n issues. Added `.pot` file and `/languages/` folder.
* Only load admin scripts & styles on widgets page.
* Added support for ["Rich Text Excerpts" plugin](http://wordpress.org/extend/plugins/rich-text-excerpts/).

= 1.0.0 =
* Public release into repository.
* Thanks to awesome tester: [Jeremy Green](http://endocreative.com/) (clearfix!)

= 0.9.5 =
 * Private beta release for #wpseattle.
 * Awesome new icons to indicate whether page has featured image and/or excerpt.
 * Fix for fatal error. That was bad.
 * Change `require_once()` to `require()` to allow multiple widget instances.
 * Fix for select list not working when widget first added to sidebar.
 * Some other small CSS compatibility tweaks.
 * Significantly more complete `readme.txt`.
 * Caught some strings missing i18n. Pig Latin plugin says this is i18n ready.
 * Lots more testing on themes and with Developer plugin.
 * Thanks to awesome testers: [Bob Dunn](http://BobWP.com) and [Grant Landram](http://GrantLandram.com)

= 0.9.0 =
* Initial private alpha release.
* Thanks to awesome tester: [Christine Winckler](http://ChristineTheDesigner.com)

== Upgrade Notice ==
= 1.2.5 =
Fix for missing excerpts.

= 1.2.4 =
Fix for disappearing page selector menu after widget save. Minor style improvements.

= 1.2.3 =
Very minor widget HTML fix. See changelog if you've customized `fpw_default.php`. Please stop hacking the layout file :)

= 1.2.2 =
Minor Update: qTranslate support & better excerpt handling.

= 1.2.1 =
"Read More" fix. Accessibility mode fix. Upgraded "Chosen" script.

= 1.2.0 =
UI improvements. Contextual Help. Rich Text Excerpt compatibility fix. JS improvements.

= 1.1.2 =
Minor bug fix for version 1.1.1 update.

= 1.1.1 =
Improved widget markup & a few tiny fixes. Anyone who has customized fpw_default.php may want to integrate the new changes (see changelog for more details).

= 1.1.0 =
i18n fixes. Smarter admin JS. Support for "Rich Text Excerpts" plugin.

= 1.0.0 =
Plugin's now in the repository. Upgrade for a few small CSS fixes.

= 0.9.5 =
Cool icons in the "Select page" interface plus fixes for two nasty bugs.

== Other Notes ==

= Known Theme Incompatibilities =
* "Theme ID". [Support thread with fix.](http://wordpress.org/support/topic/text-not-wrapped-around-image?replies=4)

= Known Plugin Incompatibilities =
* Digg Digg (resolved in v1.2.4, unresolved v1.2.5, see Support Forum)
* podPress (resolved v1.2.4, unresolved v1.2.5, see Support Forum)
* qTranslate (resolved v1.2.2)

= Plugin Philosophy =
I'm open to adding more features, but the widget options _must_ remain straight-forward and quick to set up. Following the 80/20 rule, I'm hoping this widget will contain the 20% of useful features that 80% of people need. To effect the direction of the plugin, [view and vote on feature and option requests](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_5).