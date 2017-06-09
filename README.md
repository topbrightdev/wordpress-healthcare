# healthcare-provider-news

Healthcare Provider News is a WordPress framework designed to deliver organizational news
to a network of health system providers.

## Installation
Theme and plugin files can be extracted and used with an existing WordPress install. Otherwise, place the contents of the _dist_ directory in your website's root directory then follow the standard [WordPress install instructions(https://codex.wordpress.org/Installing_WordPress#APS). This process may vary depending on your host or server requirements.

Activate the Healthcare Provider News **Child Theme** (not the parent) theme, select Appearance > Customize and you'll be able to add a a logo, configure link/button colors, add Google Analytics scripts and adjust additional settings.

## Included Plugins
* [Advanced Custom Fields 5 (Free version)](https://www.advancedcustomfields.com/resources/beta-test-version-5/)

Term and post meta fields used in the parent theme require Advanced Custom Fields (ACF). This plugin is included but must be activated.

## Recommended Plugins
* [Download Monitor](https://wordpress.org/plugins/download-monitor/) - Can be used to provide secure file downloads. Ensure that permissions are restricted on the plugin's subdirectory in the downloads directory. Actions/filters are included in the parent theme to hide Downloads from the media library.
* [Disable REST API](https://wordpress.org/plugins/disable-json-api/) – Assuming you want content to be private (requiring authentication) you'll want to disable the WordPress REST API. This plugin is a convenient way to do just that.

_Note: logic is included in the parent theme to disable RSS feeds._

## Authentication
A WordPress installation running The Healthcare Provider News theme requires authentication to view content.
You can leverage the standard WordPress registration process to create a usernames and passwords for your users,
or you could authenticate using ADFS or similar protocol. Various plugins are available to facilitate third
party authentication including [Auth0 for Wordpress](https://auth0.com/wordpress).

## Change Log

*06/08/2017* - Version 1.0 Released
