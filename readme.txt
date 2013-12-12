=== Plugin Name ===
Contributors: muxahuk1214
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MKEDFTVMPGNFY
Tags: top, back to top, return to top, go top, to top
Requires at least: 3.5.1
Tested up to: 3.8
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates "top" link on your web so that visitors could simply get back to the top of your site.

== Description ==

Creates "top" link on your web so that visitors could simply get back to the top of your site.

Plugin has it's own subpage in dashbord where you can specify:

*   Plugin disable ( alown not to output enything on front end )
*   Distance from wich to show button ( can be set in px or % )
*   Scroll speed
*   Type of the button. Currently there's 3 types: button, image, vk style ( sticked to side and 100% height)
*   Text of the button
*   Images on default and hovered state
*   Text font size
*   Width and height
*   Wertical and horizontal position of the button
*   The insets.
*   Opacity on default and hovered state
*   Colors ( text and beckground defaults and hovered states )
*   Border
*   Border radius
*   Text shadow
*   Box shadow
*   You can specify element classes
*   Custom styles
*   Languages: Supports Russian and English.

    To-do:
     * Add image + text support

Note: In new plugin settings ( starting from version 1.0 ) by default "Disable plugin" setting is set to true ( checked ) it means that plugin wount output enuthing in front end. So you need to uncheck it to work! ( for thous who is updating the value will be changed automaticaly )

     
Note: Plugin was developed on WordPress 3.7.1 and haven't been tested on earlear versions.

If you find some bug or if plugin isn't working feel free to write in the support and i'll answer or make changes do fix bugs.

Also if you have translated plugin to your language you can send me .mo and .po files and i'll add them to plugin

And if you have suggestions how i can improve plugin write me about theme

== Installation ==

1. Download the .zip and extract it in plugins folder / or / In dashbord click plugins - add new, search for "M7 Go Top", click install
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Settings" - "M7 Go Top" subpage to custemize settings ( you should uncheck "Desible plugin" so that it works in front end )

== Frequently Asked Questions ==
= How can i get plugin translated to my language? =

You can download "CodeStyling Localization" plugin and create your own language file that will translate the plugin.
If you do so you might send me the .po and .mo files so i add them to the plugin.

= What will be done in future? =

    To-do:
     * Add image + text support

= I have an idea how to improve plugin, where to write it ? =

You can write me on mihailsemjonov@mail.ru or in "Support"

== Screenshots ==

1. Settings page
2. Settings page continue
3. Settings page end
4. 3 different button types that can be chosed ( left: VK style type, middle: image type, right: button type )

== Changelog ==

= 1.1 =
* bugfix
* new screenshots

= 1.0 =
* Compleately changed the way plugin is writen ( now it's in the class )
* Added image support, speed and start from settings fields, text-shadow, box-shadow, border, border-radius, opacity
* Changed js to use .on() methode
* All html, css and js now outputs in wp_footer
* You can turn off front end output cheking "disable plugin"
* jquery enqueue in case it's not enqueued
* Now plugin is using custom local translation load so that if plugin is added to theme of required not throught plugins, translations are still working fine
* with these version there's new options key where settings been stored ( the old one is being removed on update )
* Default language of plugin is english and Russian translation is added to plugin ( see FAQ on how to add your language )

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

= 1.1 =
* removed js debug in admin
* fixed small bugs when debug mode active
* new screenshots

= 1.0 =
* Compleately changed the way plugin is writen ( now it's in the class )
* Added image support, speed and start from settings fields, text-shadow, box-shadow, border, border-radius, opacity
* Changed js to use .on() methode
* All html, css and js now outputs in wp_footer
* You can turn off front end output cheking "disable plugin"
* jquery enqueue in case it's not enqueued
* Now plugin is using custom local translation load so that if plugin is added to theme of required not throught plugins, translations are still working fine
* with these version there's new options key where settings been stored ( the old one is being removed on update )
* Default language of plugin is english and Russian translation is added to plugin ( see FAQ on how to add your language )

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