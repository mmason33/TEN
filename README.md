# Ten Plugin
Contributors: Michael Mason
Link: https://mmason33.github.io
Tags: CATS
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a plugin that returns lovely cat images.

== Description ==

The plugin is a class based object oriented approach recommended by WordPress.
The Ten Plugin is as follows:
- A setting page in the WordPress Admin with one option: the number of images displayed in the sidebar.
- Available widget to place in a sidebar.
- The plugin make a GET request to the [`http://thecatapi.com/`](http://thecatapi.com/) API to return images of cats.
- The initial API call is done on the server-side via [`wp_remote_get()`](https://developer.wordpress.org/reference/functions/wp_remote_get/).
- The number of cat images rendered will be based off of the setting specified in the plugin settings page
- Once the page has loaded, if one of the returned cat images is clicked and new one will be loaded.
- This functionality is achieved via JavaScript but more specifically the jQuery AJAX method.
- Each time a cat image is clicked, a client AJAX GET request is made to the API and one new image is returned, replacing the on/just clicked image.
- __Note* The API sometimes will return outdated or deleted image URL's__
