=== Feature A Page Widget ===
Contributors: mrwweb
Donate link: https://www.paypal.me/rootwiley
Tags: Widget, Widgets, Sidebar, Page, Pages, Post, Posts, Featured Page, Featured Post, Featured Content, Custom Post Types, Thumbnail, Featured Image, Post Thumbnail, Excerpt, Simple
Requires at least: 3.9
Tested up to: 4.5.1
Stable tag: 2.0.10
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shows an attractive summary of any page in any sidebar.

== Description ==

Feature A Page Widget aims to provide a "just works" solution for showcasing a Page in any sidebar. It leverages Core WordPress features, a *simple* set of options with a thought-through UI including three widget layouts.

= How to Use the Widget =

This plugin enables Featured Images (aka "Post Thumbnails") and Excerpts for Pages and Posts (by default, with the ability to support custom post types) in WordPress. If you don't see one or both of those fields, they may be hidden in the "Screen Options" (look in top-right corner) while editing a Page or Post.

1. Edit the page you want to feature.
1. Fill out the [Excerpt](http://en.support.wordpress.com/splitting-content/excerpts/#creating-excerpts) and select a [Featured Image](http://en.support.wordpress.com/featured-images/#setting-a-featured-image) on that page.
1. Go to Appearance > Widgets.
1. Add an instance of the "Feature a Page Widget" to the sidebar of your choosing.
1. Select the Page, choose a layout, and give the widget a title if you want.
1. Save the widget. Admire your handiwork.

[Full Version 2.0 Documentation](http://mrwweb.com/wordpress-plugins/feature-a-page-widget/version-2-documentation/)

= A Word About Image Sizes =

This plugin creates multiple custom image sizes. If you use images that were uploaded to the  media library before you installed this plugin, you'd be wise to use a plugin like [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) or [Dynamic Image Resizer](http://wordpress.org/extend/plugins/regenerate-thumbnails/).

= Modifying the Widget =

Feature a Page Widget 2.0 includes even more useful ways to modify the plugins output:

1. Prewritten CSS selectors to help you get started.
1. Three default overrideable templates and ability to create custom templates.
1. Eight filters (three old, five new) to modify most parts of the widget output.

See the [FAQ page](https://wordpress.org/plugins/feature-a-page-widget/faq/) for links to code snippets and answers to common requests.

**IMPORTANT: Feature a Page Widget 2.0 changes to a new template override system. Sites using an old template should still work with existing widgets but can't take advantage of new options or add new widgets.**

= Tell Me How to Make The Plugin Better =

* [Vote on the options](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_5) you'd like to see in future versions of the plugin.
* Give me [in-depth feedback](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_4).
* [Rate/Review the plugin](http://wordpress.org/support/view/plugin-reviews/feature-a-page-widget).

= Available Languages =

* English (default)
* German (de_DE). Thanks to [Christoph Joschko](https://profiles.wordpress.org/jomit/).
* Serbian (sr_RS). Thanks to Ogi Djuraskovic of [FirstSiteGuide.com](http://firstsiteguide.com/).
* Polish (pl_PL). Thanks to [Maciej Gryniuk](http://maciej-gryniuk.tk/).
* Spanish (es_ES). Thanks to [Luuuciano](https://wordpress.org/support/profile/luuuciano).
* Italian (it_IT). Thanks to [Carmine Scaglione](https://profiles.wordpress.org/scaglione).
* Dutch (nl_NL). Thanks to [Patrick Catthoor](https://profiles.wordpress.org/pc1271).

= Other Plugins by MRWweb =

* [MRW Web Design Simple TinyMCE](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/) - Get rid of bad and obscure TinyMCE buttons. Move the rest to a single top row. Comes with a bit of help for adding custom CSS classes too.
* [Post Status Menu Items](http://wordpress.org/plugins/post-status-menu-items/) - Adds post status links–e.g. "Draft" (7)–to post type admin menus.
* [Advanced Custom Fields Repeater & Flexible Content Fields Collapser](http://wordpress.org/plugins/advanced-custom-field-repeater-collapser/) - Easier sorting for large repeated fields in the Advanced Custom Fields plugin.

== Installation ==

1. Upload the `feature-a-page-widget` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the "Plugins" menu in WordPress.
1. Fill out the Excerpt and select the Featured Image for the posts you will feature.
1. From "Appearance" > "Widgets," you can now drag the "Feature a Page" widget into any sidebar.
1. Find advanced instructions, code snippets, and more in the [FAQ](http://wordpress.org/extend/plugins/feature-a-page-widget/).

== Frequently Asked Questions ==

**[Full Version 2.0 Documentation](http://mrwweb.com/wordpress-plugins/feature-a-page-widget/version-2-documentation/)**

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

= Can I Feature Custom Post Types? =
As of 2.0 you can with the [`fpw_post_types` filter](https://gist.github.com/mrwweb/cb48eb0700aebc45c273).

= How can I modify the widget design or output? =

The widget offers three ways to customize its design and output. The right method for you depends on what you want to accomplish and what you're comfortable doing technically.

1. **Write your own CSS rules.** The plugin's CSS selectors have as low a priority as possible, so you should be able to override styles easily. See `/css/fpw_start_styles.css` for a starter stylesheet you can copy and modify.
1. **Filter the Title, Excerpt, or Image.** Version 1.0 included the `fpw_page_title`, `fpw_excerpt`, and `fpw_featured_image` filters. Version 2.0 adds new filters `fpw_post_types`, `fpw_widget_templates`, `fpw_read_more_text`, and `fpw_image_size`.
1. **Override the Widget's output template. (Updated in 2.0!)** Each widget layout can be overridden by a template in any parent or child theme. Create an `/fpw2_views/` in the active theme's folder and copy any layout files from `/wp-content/plugins/feature-a-page-widget/fpw2_views/` into the new folder to modify.
1. **Create a custom layout. (New in 2.0!)** See this example for using the [`fpw_widget_templates` filter](https://gist.github.com/mrwweb/fd2adace8679b6bfa711). You can add new custom layouts or remove installed ones. Using the filter to only return a single layout removes the layout option from the widget and automatically uses the remaining layout.

= Can I use HTML or a WYSIWYG/TinyMCE Editor with the Excerpt Field? =
Install the [Rich Text Excerpts plugin](http://wordpress.org/extend/plugins/rich-text-excerpts/) or [Advanced Excerpt](http://wordpress.org/extend/plugins/advanced-excerpt/) plugins. Either plugin should take note and display your nicely formatted excerpt.

= How can I get a "Read More…" link? =

As of 2.0, just check the "'Read More' Link" checkbox in the widget settings.

If you had previously used the code snippet provided here, please remove it and use the setting. The new "Read More" link is more accessible. (The new link reads as "'Read More' about {Page Title}..." for screen readers and Google.)

If you would like to change the "Read More" text, see this example for the new [`fpw_read_more_text` filter](https://gist.github.com/mrwweb/b1001f45e94b3c604791).

= How do I change the image's size? =
As of 2.0, use the new [`fpw_image_size` filter](https://gist.github.com/mrwweb/56edda993e0b7062c7af).

= Can I use an auto-generated Excerpt if I haven't filled on in? =
As of 2.0, there's a filter for that too. See [fpw_auto_excerpt](https://gist.github.com/mrwweb/bebf4cbdcf50d4eadd46).

= Why did the Widget Heading change in Version 2.0 =
Version 1.0 of this widget used the HTML5 Document Outline Model that allows lots of `<h1>`s, so long as they're appropriately nested in `<article>` or similarly appropriate elements. Despite much protest, this was not bad for SEO! However, one of the primary targets of good heading usage—screen readers—still mostly do not understand this document model. Therefore, I have switched back to the older document outline. Now all templates use `<h3>` for the page title by default.

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
= 2.0.10 (April 29, 2016) =
* **[Important Notice] Feature a Page Widget now requires WordPress 3.9 or higher.**
* [Fix] Custom Sidebars compatibility fix.

= 2.0.9 (March 29, 2016) =
* [Fix] Restore compatibility with Site Origin Page Builder plugin

= 2.0.8 (March 28, 2016) =
* [Fix] Inexplicable partial update caused old script names to attempt to be loaded. This completes the 2.0.7 update of Chosen and should resolve any issues.

= 2.0.7 (March 27, 2016) =
* [New] Support "selective refresh" feature in WordPress 4.5 for faster previews when using the widget in the customizer.
* Update Chosen to 1.5.1
* Bump "Tested up to:" to 4.5

= 2.0.6 (Dec 15, 2015) =
* [Fix] Add isset checks to resolve AJAX warnings. ([Props @maxwelton.](https://wordpress.org/support/topic/ajax-php-warning))
* [Fix] Support WPML in dropdown page list via `suppress_filters`. (Thanks, Maarten.)
* [Security][i18n] Escape translated strings for improved security.
* [Fix] Show Help Text again on Contextual Help tab of widget screen.
* [Layout] Center images if they don't fill full-width of widget.

= 2.0.5 (Sep 7, 2015) =
* [i18n] New Dutch translation. Thanks to [Patrick Catthoor](https://profiles.wordpress.org/pc1271)!
* [i18n News] If you have translation for this plugin, I would love to include it, ideally before the [move to translate.wordpress.org for plugins](https://make.wordpress.org/plugins/2015/09/01/plugin-translations-on-wordpress-org/). [Contact me](http://mrwweb.com/contact/) if you're interested.
* Bump "Tested to:" number

= 2.0.4 (Aug 28, 2015) =
- [Fix] Compatibility fix for WPMU Custom Sidebars (Thanks [oxygensmith for reporting](https://wordpress.org/support/topic/conflict-with-wpmu-custom-sidebars?replies=1))
- [i18n] New Italian translation. Thanks to [Carmine Scaglione](https://profiles.wordpress.org/scaglione).

= 2.0.3 (May 29, 2015) =
* [i18n] Spanish Translations. Thanks to [Luuuciano](https://wordpress.org/support/profile/luuuciano)!

= 2.0.2 (May 1, 2015) =
* [Fix] One string missing i18n. (Thanks, Maciej Gryniuk!)
* [Fix] Prevent clipped radio buttons with browser zoom.
* [New] `fpw_read_more_ellipsis` to filter punctuation in read more link. [Forum request.](https://wordpress.org/support/topic/excerpt-ellipses?replies=2#post-6861677)
* [i18n] Polish Translation from Maciej Gryniuk! (Update .pot file too.)
* [New] Added  missing space in "Read More" link noted in ["WordPress Plugin Review: Feature a Page Widget."](http://beyond-paper.com/wordpress-plugin-review-feature-a-page-widget/)
* [Documentation] New sticky [Support Forum post about accessible read more link](https://wordpress.org/support/topic/does-your-read-more-link-say-read-more-about-title).

= 2.0.1 (April 19, 2015) =
* [Fix] Give `fieldset` a full `name` attribute to avoid SiteOrigin Page Builder error.
* [New] Explicitly support SiteOrigin Page Builder via new script/style enqueues and JS event bindings.
* [Change] Rename "Chosen" library slug CSS/JS to hopefully avoid conflicts with other bundled versions.
* [Change] Remove priority of enqueues in admin. Not really sure why it was there in the first place...

= 2.0.0 (April 14, 2015) =
* **MAJOR UPDATE** Requires WordPress 3.8+. New template override system. Please update templates ASAP.
* [New] Updated widget form design matches WordPress 3.8 admin and replaces all but one image with Dashicons.
* [New] Options for hiding Title, Image, and Excerpt and adding "Read More" link.
* [New] Features Posts by default! (And new filter for adding other post types!)
* [New] Changes to templates for great flexibility. (Old templates will partially still work but support may be removed in future versions.)
* [New] Filters for adding post types, modifying "Read More" link, adding custom layouts, and more!
* [New] Docblock commenting throughout plugin for better in-code documentation.
* [Change] Rename widget title to "Feature a Page" in admin.
* [Fix] Remove `/assets/` folder from plugin package for faster downloads.
* [Fix] Drop hAtom support because it was broken without author and date. (Would you like to see schema.org support? Let me know.)
* [New] Introduce plugin compatibility fixes for Jetpack, DiggDigg, and podPress.
* Various small CSS changes to widget layouts for [hopefully] improved consistency.
* Reorganized files, WordPress code formatting improvements, and cleaner markup in most places
* Remove use of `extract()` for more readable code.
* [i18n] German translation files by [Christoph Toschko](https://profiles.wordpress.org/jomit/). Thanks, Christoph!
* [i18n] Serbian translation from Ogi Djuraskovic of [FirstSiteGuide.com](http://firstsiteguide.com/). Thanks, Ogi!
* [Update] Update Chosen JS library to v1.4.2.

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
= 2.0.10 =
New: Requires WordPress 3.9 or higher. Fix Custom Sidebars plugin compatibility.

= 2.0.9 =
Restore Site Origin Page Builder plugin compatibility

= 2.0.8 =
Fixes 2.0.7 release that added "Support for 4.5 'Selective Refresh' Customizer previews"

= 2.0.7 =
Support for 4.5 "Selective Refresh" Customizer previews

= 2.0.6 =
Better WPML support, resolve AJAX warning, and security hardening

= 2.0.5 =
New Dutch translation. v2.0.0 IS A MAJOR UPDATE. Visit plugin home for detailed information about updates. / 2.0.0: Improved interface, ability to feature any post type, new template system, more filters, and more!

= 2.0.4 =
Italian translation & WPMU Sidebars plugin compatibility fix.
v2.0 IS A MAJOR UPDATE. Visit plugin home for detailed information about updates. / 2.0.0: Improved interface, ability to feature any post type, new template system, more filters, and more!

= 2.0.3 =
v2.0 IS A MAJOR UPDATE. Visit plugin home for detailed information about updates. / 2.0.0: Improved interface, ability to feature any post type, new template system, more filters, and more! / 2.0.3: Add Spanish translation.

= 2.0.2 =
v2.0 IS A MAJOR UPDATE. Visit plugin home for detailed information about updates. / 2.0.0: Improved interface, ability to feature any post type, new template system, more filters, and more! / 2.0.2: New Polish translation, multiple small bug fixes, new `fpw_read_more_ellipsis` filter.

= 2.0.1 =
v2.0 IS A MAJOR UPDATE. Visit plugin home for detailed information about updates. / 2.0.0: Improved interface, ability to feature any post type, new template system, more filters, and more! / 2.0.1: Support for SiteOrigin Page Builder Widget Editing

= 2.0.0 =
**MAJOR UPDATE.** Improved interface, ability to feature any post type, new template system, more filters, and more! Visit plugin home for detailed information about updates.

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