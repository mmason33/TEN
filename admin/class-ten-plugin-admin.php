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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ten_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ten_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ten-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ten_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ten_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ten-plugin-admin.js', array( 'jquery' ), $this->version, false );

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

	public function register_setting() {
		// Add a General section
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
			//var_dump(get_option($this->option_name . '_count'));

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
			 * Render the treshold day input for this plugin
			 *
			 * @since  1.0.0
			 */
			public function ten_plugin_count_cb() {
				echo '<input type="text" name="' . $this->option_name . '_count' . '" id="' . $this->option_name . '_count' . '"> '. __( 'Images', 'ten-plugin' );
			}

}
