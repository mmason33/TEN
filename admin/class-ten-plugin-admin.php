<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mmason33.github.io
 * @since      1.0.0
 *
 * @package    Ten_Plugin
 * @subpackage Ten_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ten_Plugin
 * @subpackage Ten_Plugin/admin
 * @author     Michael Mason <michael@michaeljmason.com>
 */
class Ten_Plugin_Admin {

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'ten_plugin';

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'TEN Plugin Settings', 'ten-plugin' ),
			__( 'TEN Plugin', 'ten-plugin' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/ten-plugin-admin-display.php';
	}
	/**
	* Register settings page and field
	*/
	public function register_setting() {

		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'ten-plugin' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		add_settings_field(
				$this->option_name . '_count',
				__( 'The number of lovely cat images displayed', 'ten-plugin' ),
				array( $this, $this->option_name . '_count_cb' ),
				$this->plugin_name,
				$this->option_name . '_general',
				array( 'label_for' => $this->option_name . '_count' )
			);

			register_setting( $this->plugin_name, $this->option_name . '_count', 'intval' );
	}

	/**
		 * Render the text for the general section
		 *
		 * @since  1.0.0
		 */
		public function ten_plugin_general_cb() {
			echo '<p>' . __( 'Please change the settings accordingly.', 'ten-plugin' ) . '</p>';
		}

		/**
			 * Render the input for the number of images
			 *
			 * @since  1.0.0
			 */
			public function ten_plugin_count_cb() {
				echo '<input type="text" name="' . $this->option_name . '_count' . '" id="' . $this->option_name . '_count' . '"> '. __( 'Images', 'ten-plugin' );
			}

}
