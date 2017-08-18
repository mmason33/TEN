<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://mmason33.github.io
 * @since      1.0.0
 *
 * @package    Ten_Plugin
 * @subpackage Ten_Plugin/public/partials
 */
?>

<section id="Ten-Plugin" class="ten-plugin ten-plugin-widget" data-count="<?php echo get_option('ten_plugin_count'); ?>">
  <?php


    $response = wp_remote_get('http://thecatapi.com/api/images/get?api_key=MjE1MDY5&format=xml&results_per_page=' .get_option('ten_plugin_count'));


  echo wp_remote_retrieve_body($response, 'url');
  ?>
</section>
