=== Advanced Custom Fields: Tag It Field ===
Contributors: iambriansreed
Tags: acf, custom, field, custom field, advanced, simple fields, magic fields, more fields, repeater, matrix, post, type, text, textarea, file, image, edit, admin. tags, tagit, tag it, tag-it
Requires at least: 3.5
Tested up to: 4.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Tag It field for ACF using ACF 5's built-in Select2 library.

== Description ==

Do you need to be able to select multiple bits of text but a repeater field is overkill? Use the tag-it field. This plugin brings uses ACF 5's built-in Select2 library.

This field currently includes the following options:

* available tags : Used as source for the autocompletion.

The jQuery UI plugin used in the first version of this plugin can be found here: https://github.com/aehlke/tag-it
The Select2 library used in ACF 5 can be found here: http://select2.github.io/select2/

= Compatibility =

This ACF field type is compatible with:
* ACF 5

== Installation ==

1. Copy the `acf-tag-it` folder into your `wp-content/plugins` folder
2. Activate the Tag It plugin via the plugins admin page
3. Create a new field via ACF and select the Tag It type
4. Please refer to the description for more info regarding the field type settings

== Changelog ==

= 1.0.0 =
* Initial Release.

= 2.0.0 =
* Removed old tag-it library and replaced with Select2 library. Fixed font_size issue: @JoelStransky