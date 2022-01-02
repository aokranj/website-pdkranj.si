=== Feature A Page Widget ===
Contributors: mrwweb
Donate link: https://www.paypal.me/rootwiley
Tags: Widget, Widgets, Sidebar, Featured Page, Featured Post
Requires at least: 3.9
Tested up to: 5.5
Stable tag: 2.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget to display an attractive summary of any page in any widget area.

== Description ==

Feature A Page Widget provides a "just works" solution for showcasing a Page, Post, or custom post type in any widget area (aka sidebar). It leverages core WordPress features, a *simple* set of options, and a sleek UI for selecting one of three widget layouts.

= How to Use the Widget =

1. Install and activate the plugin.
1. Edit the page you want to feature.
1. Fill out the [Excerpt](http://en.support.wordpress.com/splitting-content/excerpts/#creating-excerpts) and select a [Featured Image](http://en.support.wordpress.com/featured-images/#setting-a-featured-image) on that page.
1. Go to Appearance > Widgets or Customize > Widgets.
1. Add an instance of the "Feature a Page Widget" to the widget area (Sidebar, Footer, etc.) of your choosing.
1. Select the page, choose a layout, and optionally give the widget a title.
1. Save the widget!
1. Admire your handiwork.

This plugin enables Featured Images (aka "Post Thumbnails") and Excerpts for Pages and Posts (by default) with the ability to support custom post types. If you don't see one or both of those fields, they may be hidden in the "Screen Options" (top-right corner) while editing a Page or Post.

= Important Note: Image Sizes =

This plugin creates multiple custom image sizes. If you use images that were uploaded to the  media library before you installed this plugin, you may need to use a plugin like [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) to create the correctly-sized images.

= Customizing the Widget =

There are multiple ways to modify the widget based on your needs:

1. Prewritten CSS selectors in `/css/fpw_starter_styles.css` to help you get started with custom CSS styles in a child theme or the Custom CSS Customizer field
1. Three default overridable templates and the ability to create custom templates
1. Eight filters to modify most parts of the widget output (Title, Read More, Image sizes, etc.)
1. Interested in commissioning a custom layout just for your site? [Get in touch.](https://mrwweb.com/contact/)

See [the FAQs](https://wordpress.org/plugins/feature-a-page-widget/faq/) for links to code snippets with inline documentation.

= Like the Plugin? =

* [We love 5-star ratings!](http://wordpress.org/support/view/plugin-reviews/feature-a-page-widget)
* [Donations accepted](https://www.paypal.me/rootwiley)

= Available Languages =

Please [help translate Feature A Page Widget](https://translate.wordpress.org/projects/wp-plugins/feature-a-page-widget). Users have contributed translations in the following languages:

English (default), German (`de_DE`), Serbian (`sr_RS`), Polish (`pl_PL`), Spanish (`es_ES`), Italian (`it_IT`), Dutch (`nl_NL`)

= Other Plugins by @MRWweb =

* [MRW Web Design Simple TinyMCE](https://wordpress.org/plugins/mrw-web-design-simple-tinymce/) - Get rid of bad and obscure TinyMCE buttons. Move the rest to a single top row. Comes with a bit of help for adding custom CSS classes too.
* [Post Status Menu Items](http://wordpress.org/plugins/post-status-menu-items/) - Adds post status links–e.g. "Draft" (7)–to post type admin menus.
* [Post Type Archive Description](http://wordpress.org/plugins/post-type-archive-descriptions/) - Enables an editable description for a post type to display at the top of the post type archive page.
* [Hawaiian Characters](http://wordpress.org/plugins/hawaiian-characters/) - Adds the correct characters with diacriticals to the WordPress editor Character Map for Hawaiian

== Frequently Asked Questions ==

**[Full Version 2.0 Documentation](http://mrwweb.com/wordpress-plugins/feature-a-page-widget/version-2-documentation/)**

= Is this plugin compatible with WordPress 5.0 / "Gutenberg"? =
Yes.

Because this is a widget, there is no direct integration with the WordPress post editor and the basic features of this plugin are uneffected. However, if you are using the new editor, note the new location of the Excerpt field in the sidebar.

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

= Can I feature Custom Post Types? =

Indeed! Pages and Posts are feature-able by default. Use [`fpw_post_types` filter](https://gist.github.com/mrwweb/cb48eb0700aebc45c273) to add support for custom post types or remove Posts or Pages.

= How can I modify the widget design or output? =

The widget offers three ways to customize its design and output. The right method for you depends on what you want to accomplish and what you're comfortable doing technically.

1. **Write your own CSS rules.** The plugin's CSS selectors have as low a priority as possible, so you should be able to override styles easily. See `/css/fpw_start_styles.css` for a starter stylesheet you can copy and modify.
1. **Filter the Title, Excerpt, or Image.** Version 1.0 included the `fpw_page_title`, `fpw_excerpt`, and `fpw_featured_image` filters. Version 2.0 adds new filters `fpw_post_types`, `fpw_widget_templates`, `fpw_read_more_text`, and `fpw_image_size`.
1. **Override the Widget's output template.** Each widget layout can be overridden by a template in any parent or child theme. Create an `/fpw2_views/` in the active theme's folder and copy any layout files from `/wp-content/plugins/feature-a-page-widget/fpw2_views/` into the new folder to modify.
1. **Create a custom layout.** See this example for using the [`fpw_widget_templates` filter](https://gist.github.com/mrwweb/fd2adace8679b6bfa711). You can add new custom layouts or remove installed ones. Using the filter to only return a single layout removes the layout option from the widget and automatically uses the remaining layout.

= Can I use HTML or a WYSIWYG/TinyMCE Editor with the Excerpt Field? =

Install the [Rich Text Excerpts plugin](http://wordpress.org/extend/plugins/rich-text-excerpts/) or [Advanced Excerpt](http://wordpress.org/extend/plugins/advanced-excerpt/) plugins. Either plugin should take note and display your nicely formatted excerpt.

= Can I change the "Read More…" text? =

Use the [`fpw_read_more_text` filter](https://gist.github.com/mrwweb/b1001f45e94b3c604791).

= How do I change the image's size? =

Use the [`fpw_image_size` filter](https://gist.github.com/mrwweb/56edda993e0b7062c7af).

= Can I use an auto-generated Excerpt if I haven't filled one in? =

There's a filter for that too. See [`fpw_auto_excerpt`](https://gist.github.com/mrwweb/bebf4cbdcf50d4eadd46).

= What are those icons in the "Select Page" drop down? =

When selecting the page to feature in the widget settings, the list of pages includes two icons. The first icon is the featured image, and the second is the excerpt. If the icon is "lit-up," that means that page has that piece of information. If both are lit-up, the page is ready for optimal use in the widget. See this interface in the "Screenshots" tab.

= This widget isn't what I want... =

This widget is intended to be straightforward and avoid melting into "option soup." However, that means it might not be perfect for what you need.

If you think the widget is *almost right*, double-check that can't use the one of the plugin's filters or the widget view template (see "I want to modify how the widget looks/works"). If that doesn't work, [submit some feedback](http://mrwweb.com/feature-a-page-widget-plugin-wordpress/#gform_wrapper_4) for future versions of the plugins. And of course, there's always [the support forum](http://wordpress.org/support/plugin/feature-a-page-widget).

If this plugin is more than a little off, you might be looking for a different plugin like [Posts in Sidebar](http://wordpress.org/extend/plugins/posts-in-sidebar/) or [Genesis Featured Page Advanced](https://wordpress.org/plugins/genesis-featured-page-advanced/) (Genesis only).

== Screenshots ==

1. Choose from three theme-agnostic layouts.
2. No need to choke down "option soup."
3. Widget interface shows you which pages have featured images and excerpts.
4. Uses standard WordPress fields (Title, Featured Image, and Excerpt) that you already know and love.

== Changelog ==

= 2.2.0 (August 12, 2020) =
- Support for WordPress 5.5
- Fix deprecated use of jQuery.live(). Props, Roy!
- Upgrade Chosen to 1.8.7 (supports jQuery 3.X)

[Full Changelog](https://plugins.trac.wordpress.org/browser/feature-a-page-widget/trunk/changelog.txt)

== Upgrade Notice ==
= 2.2.0 =
WordPress 5.5/jQuery compatibility