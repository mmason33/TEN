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
// class Ten_Plugin_Widget extends WP_Widget {
//
// 	// /**
// 	//  * The ID of this plugin.
// 	//  *
// 	//  * @since    1.0.0
// 	//  * @access   private
// 	//  * @var      string    $plugin_name    The ID of this plugin.
// 	//  */
// 	// private $plugin_name;
// 	//
// 	// /**
// 	//  * The version of this plugin.
// 	//  *
// 	//  * @since    1.0.0
// 	//  * @access   private
// 	//  * @var      string    $version    The current version of this plugin.
// 	//  */
// 	// private $version;
// 	//
// 	//   /**
// 	//    * Constructs the new widget.
// 	//    *
// 	//    * @see WP_Widget::__construct()
// 	//    */
//   //  function __construct() {
//   //   //  $this->plugin_name = $plugin_name;
//   //   //  $this->version = $version;
//   //    parent::__construct(
//   //    // Base ID of your widget
//   //    'Ten_Plugin_Widget',
//   //    // Widget name will appear in UI
//   //    __('TEN Widget'),
//   //    // Widget description
//   //    array( 'description' => __( 'The TEN Plugin - Returns lovely cats!'), )
//   //    );
//   //  }
// 	//
//   // /**
//   //  * The widget's HTML output.
//   //  *
//   //  * @see WP_Widget::widget()
//   //  *
//   //  * @param array $args     Display arguments including before_title, after_title,
//   //  *                        before_widget, and after_widget.
//   //  * @param array $instance The settings for the particular instance of the widget.
//   //  */
//   // public function widget( $args, $instance ) {}
// 	//
//   // /**
//   //  * The widget update handler.
//   //  *
//   //  * @see WP_Widget::update()
//   //  *
//   //  * @param array $new_instance The new instance of the widget.
//   //  * @param array $old_instance The old instance of the widget.
//   //  * @return array The updated instance of the widget.
//   //  */
// 	//
//   // // public function update( $new_instance, $old_instance ) {
//   // //     return $new_instance;
//   // // }
// 	//
//   // /**
//   //  * Output the admin widget options form HTML.
//   //  *
//   //  * @param array $instance The current widget settings.
//   //  * @return string The HTML markup for the form.
//   //  */
// 	//  public function form( $instance ) {
// 	// 		 echo '<p class="no-options-widget">' . __('There are no options for this widget.') . '</p>';
// 	// 		 return 'noform';
// 	//  }
// 	//
//   // public function ten_plugin_widget() {
//   //   register_widget('Ten_Plugin_Widget');
//   // }
//
// }
// function ten_plugin_load_widget() {
//     register_widget( 'Ten_Plugin_Widget' );
// }
// add_action( 'widgets_init', 'ten_plugin_load_widget' );

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
