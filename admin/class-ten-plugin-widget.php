<?php

/**
 * The widget functionality of the plugin.
 *
 * @link       https://mmason33.github.io
 * @since      1.0.0
 *
 * @package    Ten_Plugin
 * @subpackage Ten_Plugin/admin
 */

/**
 * The widget functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ten_Plugin
 * @subpackage Ten_Plugin/admin
 * @author     Michael Mason <michael@michaeljmason.com>
 */

// Creating the widget
class Ten_Plugin_Widget extends WP_Widget {

		function __construct() {
			parent::__construct(

			// Base ID of your widget
			'Ten_Plugin_Widget',

			// Widget name will appear in UI
			__('TEN Widget', 'ten_plugin_domain'),

			// Widget description
			array( 'description' => __( 'A Lovely Kitty Plugin', 'ten_plugin_domain' ), )
			);
		}
		/**
		* Register the Widget
		*/
		public function ten_plugin_load_widget() {
		    register_widget( 'Ten_Plugin_Widget' );
		}
		/**
		* Initial API call on when page request is made
		* Consume the XML returned and render the data
		* and HTML markup to the page
		*/
		public function widget( $args, $instance ) {
		?>
			<section id="Ten-Plugin" class="ten-plugin ten-plugin-widget widget" data-count="<?php echo get_option('ten_plugin_count'); ?>">
			  <?php
					libxml_use_internal_errors(true);
			    $url = 'http://thecatapi.com/api/images/get?api_key=MjE1MDY5&format=xml&results_per_page=' . get_option('ten_plugin_count');
			    $response = wp_remote_get($url);
					$body = wp_remote_retrieve_body($response);
					$xml  = simplexml_load_string($body);

					if ($xml === false) {
						echo '<strong>No data available at this time</strong>';
					} else {
					
						echo '<h4>Ten Plugin</h4>';

				    foreach ($xml->data->images->image as $image ) {
				      echo '<figure class="ten-plugin--image--wrap"><div class="ten-plugin--image" style="background-image: url(' . $image->url . ');background-repeat:no-repeat;background-position:center center; background-size:cover;">
							<small class="ten-plugin--hover--message hide">Load new kitty</small>
				      </div><a href="'. $image->url . '" class="ten-plugin--download" download>&#9889 <small>Download</small></a></figure>';
				    }

					}
			  ?>
			</section>
		<?php
		}
		/**
		* The form for the widget admin area
		* No options for this widget
		*/
		public function form( $instance ) {
			echo '<p>There are no options for this Widget, please see the TEN Plugin settings page</p>';
		}
}
?>
