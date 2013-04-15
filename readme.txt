=== Plugin Name ===
Contributors: muxahuk1214
Donate link: http://m7-pro.ru/
Tags: top, back to top, return to top, go top, to top
Requires at least: 3.5.1
Tested up to: 3.5.1
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates "top" link on your web so that visitors could simply get back to the top of your site.

== Description ==

Creates "top" link on your web so that visitors could simply get back to the top of your site.

Plugin has it's own subpage in dashbord where you can specify:

*   Type of the button. 1) Button - simple button that is located in bottom of your site. 2) VK style - the button shows like on vk.com (it's on full height of screen).
*   Text of the button. By default its: "&uarr; Top".
*   Position of the button. Has 2 positions - left or right. (display on the left or on the right of the site)
*   The insets. Top,Right,Bottom,Left insets.
*   Colors: you can specify color of text, color on text hover, background color and background hover color.
*   Languages: Supports Russian and English.

    To-do:
     * Add font size change
     * Add shadow to button type
     * Add border radius to button type
     * Add opacity change
     * Add scrolltop height from wich to show button
     * Add speed to scrolltop
     * Add image support
     
Note: Plugin was developed on wordpress 3.5.1 (the latest at the moment) and I haven't tested it on lower versions. There might be some problems. So keep up to new version of wordpress!

== Installation ==

1. Download the .zip and extract it in plugins folder / or / In dashbord click plugins - add new, search for "M7 Go Top", click install
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Settings" - "M7 Go Top" subpage to custemize settings

== Frequently Asked Questions ==
= How can i get plugin translated to my language? =

You can download "CodeStyling Localization" plugin and create your own language file that will translate the plugin.
If you do so you might send me the .po and .mo files so i add them to the plugin.

= What will be done in future? =

    To-do:
     * Add font size change
     * Add shadow to button type
     * Add border radius to button type
     * Add opacity change
     * Add scrolltop height from wich to show button
     * Add speed to scrolltop
     * Add image support

== Screenshots ==

1. The setting page. Button type: "style like VK.com" selected
2. Screenshot of Button type: style like VK.com
3. The setting page. Button type: "button" selected
4. Screenshot of Button type: "button"

== Changelog ==

= 0.3 =
* Languages added. Now i'ts available in English and Russian language.
* Changed variables names so that they don't conflict with othere plugins
* Added install,uninstall hooks
* Removed maskedinput.js. Not used, not needed.
* Removed custom script output in wp_head, changed it on wp_localize_script in wp_enqueue_scripts
* Cleaned js and css files
* Made chack on initializing the output so thet if configs aren't created plugin not working

= 0.2 =
* Fixed custom js.

= 0.1 =
* Initial version.

== Upgrade Notice ==

= 0.3 =
* Languages added. Now i'ts available in English and Russian language.
* Changed variables names so that they don't conflict with othere plugins
* Added install,uninstall hooks
* Removed maskedinput.js. Not used, not needed.
* Removed custom script output in wp_head, changed it on wp_localize_script in wp_enqueue_scripts
* Cleaned js and css files as well as php
* Made chack on initializing the output so thet if configs aren't created plugin not working

= 0.2 =
* Fixed custom js. Now everithing is working fine. update)

= 0.1 =
* Initial version.