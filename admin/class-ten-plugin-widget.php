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
		array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'ten_plugin_domain' ), )
		);
		}

		public function ten_plugin_load_widget() {
		    register_widget( 'Ten_Plugin_Widget' );
		}

		// Creating widget front-end

		public function widget( $args, $instance ) {
		?>
			<section id="Ten-Plugin" class="ten-plugin ten-plugin-widget widget" data-count="<?php echo get_option('ten_plugin_count'); ?>">
			  <?php

			    $url      = 'http://thecatapi.com/api/images/get?api_key=MjE1MDY5&format=xml&results_per_page=' .get_option('ten_plugin_count');
			    $response = wp_remote_get($url);
			    $body     = wp_remote_retrieve_body($response);
			    $xml  = simplexml_load_string($body);
			    $code = $xml->data->images;

			    // var_dump($code);

			    foreach ($xml->data->images->image as $image ) {
			      // var_dump($image->url);
			      echo '<figure class="ten-plugin--image--wrap" style="background-image: url(' . $image->url . ');background-repeat:no-repeat;background-position:center center; background-size:cover;">
			      </figure>';
			    }

			  ?>
			</section>
		<?php
		}

		// Widget Backend
		public function form( $instance ) {

		// Widget admin form
		?>
		<p>
		There are no options for this Widget
		</p>
		<?php
		}
}

?>
