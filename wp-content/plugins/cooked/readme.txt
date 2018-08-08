=== Cooked - Recipe Plugin ===
Contributors: boxystudio
Donate link: https://paypal.me/boxypayment
Tags: recipe, recipes, food, cooking, chef, culinary, nutrition, seo
Requires at least: 4.7
Tested up to: 4.9.7
Stable tag: 1.5.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Cooked is the absolute best way to create & display recipes with WordPress. SEO optimized (rich snippets), galleries, cooking timers, printable recipes and much more.

== Description ==

Cooked is the absolute best way to create & display recipes with WordPress. SEO optimized (rich snippets), galleries, cooking timers, printable recipes and much more. Check out the full list below.

Be sure to check out the **[online demo](https://demos.boxystudio.com/cooked/)** as well as the **[Cooked Documentation](http://docs.cooked.pro/)** if you need some help!

= Quality design & usability =

Using the drag & drop recipe builder, you can create your recipes quickly and without limitations. Add ingredients, directions—and then add a gallery, nutrition facts, cooking times and much more.

= Google-friendly =

Cooked automatically includes semantic structure and schema.org microdata into each and every recipe you publish. This allows Google to display your recipes across a variety of device sizes and platforms.

= Many premium features already included =

Most recipe plugins require that you purchase a PRO version for features like nutrition facts, galleries, powerful searching, timers, etc. The standard version of Cooked includes all of these. Here's what you get out of the box:

* Drag & drop ingredients and directions.
* SEO Optimized - Google Structured Data and Schema.org support.
* Beautiful grid-based masonry recipe lists.
* Prep & Cooking Times
* Photo Galleries
* Nutrition Facts
* Difficulty Levels
* Powerful recipe search with a text search, categories & sorting options.
* Author template to list recipes by a single author.
* Cooking times with clickable, interactive timers.
* Very developer-friendly with loads of hooks & filters.
* Servings switcher to adjust ingredient amounts.
* And more to come...

Of course, if you want even more, you can always check out the [PRO](https://cooked.pro) version of Cooked. It adds features like ratings & favorites, recipe submissions, and so much more.

= Developers love it =

Cooked has a whole bunch of actions and filters to customize Cooked as much as you need to. Be sure to check out the [Developer Documentation](http://docs.cooked.pro/collection/31-developers).

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/cooked` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Recipes > Settings screen to configure the plugin.
4. Go to Recipes > Add New to start adding your recipes!
5. Head over to the [Cooked Documentation](http://docs.cooked.pro/collection/1-cooked) for more help.

== Frequently Asked Questions ==

= Having issues with the plugin? =

Be sure to check the [Cooked Documentation](http://docs.cooked.pro/collection/1-cooked) for guides and documentation. If you're still having issues, create a new support topic and let me know what's going on. I'm happy to help! Please don't post a bad review without discussing here first, I really appreciate it!

= I purchased Cooked on CodeCanyon.net, is this the same thing? =

This version is **not** the same plugin. It has been completely rebuilt from the ground up and has now completely replaced the original plugin. For more information on Cooked and Cooked Pro, check out [https://cooked.pro](https://cooked.pro). There is a migration assistant as well for those using the original plugin. See the documentation here: [http://docs.cooked.pro/migration/](http://docs.cooked.pro/migration/)

== Screenshots ==

1. Adding Ingredients
2. Adding Directions
3. Recipe Template
4. Nutrition Facts
5. Interactive Cooking Timers
5. Gallery Builder
6. Recipe Shortcodes

== Upgrade Notice ==

= 1.5.1 =
Squashed some bugs with fullscreen mode, schema data and taxonomy shortcode queries.

== Changelog ==

= 1.5.1 =
* **FIX:** Fixed a JavaScript error with fullscreen mode.
* **FIX:** Swapped the mismatched "servings" and "serving size" for recipe schema data.
* **FIX:** Fixed a filter issue that was preventing custom taxonomy queries in the `[cooked-browse]` shortcode.
* **TWEAK:** Welcome screen style adjustments.
* **TWEAK:** Dropped support for PHP 5.6 (still works for now, just not testing with it anymore).

= 1.5 =
* **NEW:** New `[cooked-title]` shortcode to display the recipe title (for recipe template).
* **NEW:** Added option to hide the Author images (avatars) throughout the site.
* **NEW:** Added option to disable the Author link (linking to the author page).
* **NEW:** Moved "Total Time" into its own field. Will show "Prep Time + Cook Time" by default.
* **FIX:** Fixed issues with editing recipe ingredients, directions, etc. on iPads (and other tablets).
* **FIX:** Fixed and issue with times not showing up correctly if over 1,440 minutes.
* **FIX:** Fixed some issues with Recipe Schema output.

= 1.4.2 =
* **NEW:** Improved support for Yoast SEO (and other SEO plugins).
* **NEW:** French translation added.
* **FIX:** Fixed an issue with some incorrect Percent Daily Values on the front-end.
* **FIX:** Fixed a padding issue on the recipe grid (on smaller screens).
* **FIX:** Bug fixes for the WooCommerce Memberships' "Restrict Content" feature.

= 1.4.1 =
* **NEW:** Added support for WooCommerce Memberships' "Restrict Content" feature.
* **FIX:** Fixed some issues with the [cooked-browse] shortcode.

= 1.4.0.3 =
* **FIX:** Fixed an issue with pagination on recipe taxonomy templates.

= 1.4.0.2 =
* **NEW:** When viewing a parent category, it will now display sub-category items instead of recipes. This allows you to nicely nest your categories if desired.
* **TWEAK:** Added some adjustments for "Dark Mode".
* **TWEAK:** Added some adjustments to fix a few TwentySeventeen CSS conflicts.

= 1.4.0.1 =
* **FIX:** Fixed a major layout issue, sorry about that everyone!

= 1.4 =
* **NEW:** Added a "Dark Mode" setting for sites with dark backgrounds.
* **NEW:** Added a `[cooked-recipe-categories]` shortcode to display all categories in a beautiful, visual grid.
* **NEW:** The recipe list style now uses the same design as Recipe Cards.
* **TWEAK:** Removed "Garnish" as an option. This was just confusing to most users who saw it.
* **FIX:** Fixed some styling issues with the search bar.

= 1.3.05 =
* **TWEAK:** Minor adjustments to support the new Cooked Pro 1.1.

= 1.3.04 =
* **FIX:** Fixed some issues with the Settings page on some servers.
* **TWEAK:** Now loading the dynamic CSS files as inline to fix caching/loading issues.
* **TWEAK:** Tweaked the migration feature to support MUCH larger recipe collections.

= 1.3.03 =
* **FIX:** Fixes conflicts with the Cooked Pro plugin.
* **TWEAK:** Updated the language template file.

= 1.3.02 =
* **FIX:** Fixes a PHP error occuring on a large number of servers.

= 1.3.01 =
* **FIX:** Fixed a few issues with the new shortcodes displaying strangely.

= 1.3.0 =
* **NEW:** **"Cooked - Recipe List" Widget** — Display a list of recipes.
* **NEW:** **"Cooked - Recipe Card" Widget** — Display a fancy recipe card.
* **NEW:** `[cooked-recipe-list]` — Display a list of recipes.
* **NEW:** `[cooked-recipe-card]` — Display a fancy recipe card.
* **NEW:** Added "Nutrition" to the print options.
* **NEW:** Added a complete migration solution to update recipes from Cooked Classic.
* **TWEAK:** Added a progress bar to the "Apply to All" recipe template updater.
* **TWEAK:** Added an option to disable the "Servings Switcher".
* **TWEAK:** Full-screen mode has been refreshed a little bit. Mostly in the fact that the tabs are now at the top to avoid conflicts with the iPhone X.
* **FIX:** Fixed issues with slow loading times on recipe list pages.
* **FIX:** Fixed issues with the "Apply to All" template update feature.
* **FIX:** Fixed issues with the Default Template saving/loading buttons.
* **FIX:** Fixed an issue where "Authors" could not edit recipes.
* **FIX:** Fixed an issue with WPML not being able to translate recipe information.

= 1.2.0 =
* **NEW:** **"Cooked - Recipe Search" Widget** — Display the recipe search form.
* **NEW:** `[cooked-search]` — Display the recipe search form.
* **NEW:** Added REST API support to recipes and recipe categories.
* **TWEAK:** Added the same "search" shortcode options to `[cooked-browse]` so you can customize the recipe search bar from that shortcode as well. See the documentation for more shortcode options.
* **TWEAK:** Added some hooks and filters to the welcome screen to add the ability to include the Cooked Pro changelog information there as well.
* **TWEAK:** Direction images are formatted much better now (inline with the text and some margin below).
* **TWEAK:** Added an option to disable the "Servings Switcher".
* **TWEAK:** Converted all CSS "em" values to "rem" values.
* **FIX:** Fixed a bug where posts were being duplicated when embedding "draft" recipes using the shortcode.
* **FIX:** Disabling Public Recipes will now work as intended. Recipes will be hidden from search results, recipe URLs redirected to the homepage, etc.
* **FIX:** Added some missing language strings.

= 1.1.13 =
* **NEW:** Added kg (kilograms) as a measurement option.
* **FIX:** Fixed an issue where zeros were being removed from large numbers.
* **FIX:** Recipes will now 404 if "Disable Public Recipes" is active.
* **FIX:** Minor CSS adjustments throughout.

= 1.1.12 =
* Adjusted some code to support the upcoming Cooked Pro features.
* Some minor text changes in the Settings panel.

= 1.1.11 =
* **FIX:** Fixed an issue with ingredient amounts getting rounded up to 1.
* **FIX:** Fixed some theme compatibiltiy issues.
* **FIX:** Re-enabled structured data for recipes. Didn't mean to disable this, sorry!

= 1.1.10 =
* **NEW:** Ingredient amounts will now display as entered (fractions or decimals) in the number format based on your language settings.
* **NEW:** Added taxonomy filter dropdowns to the admin recipe list page.
* **NEW:** Added developer filters for customizing the "Percent Daily Value" calculations.
* **FIX:** Added compatibility for the "Bridge" theme.

= 1.1.9 =
* **FIX:** Added "1/5" support to measurements.
* **FIX:** Other minor bug fixes throughout.
* **FIX:** Fixed an edge-case issue where private Vimeo videos would not show up within recipe content.

= 1.1.8 =
* **NEW:** HTML is allowed in all ingredient/direction fields.
* **FIX:** Fixed some redirect issues.
* **FIX:** Some adjustments to support the upcoming Cooked Pro.

= 1.1.7 =
* **FIX:** Fixed an issue with the Cooked settings screens if a non-English language is enabled.
* **FIX:** Fixed an issue for when the "Browse Recipe Page" and "Single Recipe Post" slugs were the same (i.e. /recipes/). You can now use the same slug for both!

= 1.1.6 =
* **NEW:** Tested and working in WordPress 4.8!
* **NEW:** Custom checkbox toggles on the Settings page.
* **FIX:** Fixed an issue with category redirects. There was a double slash being added that has now been resolved. Huge thanks to **@travelnlass** and **@kitcatsz** for finding this one!

= 1.1.5 =
* **FIX:** A lot more fixes for the [cooked-recipe] shortcode. Huge thanks to Zoe and Mariana for donating their time and websites to help me work out these issues!
* **NEW:** Added an advanced ability to "Disable Cooked `<meta>` Tags" when needed.
* **NEW:** Added an advanced ability to "Disable Public Recipes" when needed.

= 1.1.4 =
* **FIX:** Several fixes for the `[cooked-recipe]` shortcode.
* **FIX:** Fixed some issue with printing recipes.
* **FIX:** Applied selected servings to print view.

= 1.1.3 =
* **FIX:** Fixed an issue with using decimals on Nutrition Facts.

= 1.1.2 =
* **FIX:** Fixed an error on the recipe author template.
* **FIX:** More minor tweaks to support the upcoming Cooked Pro plugin.

= 1.1.1 =
* **FIX:** Compatibility improvements with the Yoast SEO plugin.
* **FIX:** Some minor tweaks to support the upcoming Cooked Pro plugin.

= 1.1.0 =
* **NEW:** **Full-Screen Mode:** Just include "fullscreen" in the `[cooked-info]` shortcode. Really shines on mobile devices!
* **NEW:** **Printable Recipes:** Just include "print" in the `[cooked-info]`shortcode. Includes some handy "a-la-carte" print options.
* **FIX:** Some adjustments for layouts on smaller devices (responsive fixes).
* **FIX:** Fixed an issue where quantities and amounts would not show up without a "Servings" setting. Now it works no matter what!
* **FIX:** Minor code adjustments to better support Cooked Pro.

= 1.0.0 =
* **NEW:** *Everything is new!*
* **NEW:** Drag & drop ingredients and directions.
* **NEW:** Beautiful grid-based masonry recipe lists.
* **NEW:** Powerful recipe search with a text search, categories & sorting options.
* **NEW:** Author template to list recipes by a single author.
* **NEW:** Cooking times with clickable, interactive timers.
* **NEW:** Very developer-friendly with loads of hooks & filters.
* **NEW:** Servings switcher to adjust ingredient amounts.
* **NEW:** SEO Optimized - Google Structured Data and Schema support.
* **NEW:** Prep & cooking times.
* **NEW:** Nutrition facts.
* **NEW:** Difficulty levels.
* **NEW:** Photo galleries.
