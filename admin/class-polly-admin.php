<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://lougiequisel.com/
 * @since      1.0.0
 *
 * @package    Polly
 * @subpackage Polly/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Polly
 * @subpackage Polly/admin
 * @author     Lougie Quisel <lougie@brightideainteractive.com>
 */
class Polly_Admin{

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
		 * defined in Polly_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Polly_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/polly-admin.css', array(), $this->version, 'all' );

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
		 * defined in Polly_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Polly_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/polly-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Polly plugin's settings page
	 *
	 * @since    1.0.0
	 */
	public function polly_settings_page() {
		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-display.php' );
	}

	/**
	 * Settings page details
	 *
	 * @since    1.0.0
	 */
	public function polly_settings_page_details(){
          add_options_page("Polly", "Polly Settings Page", 'update_plugins', "polly", array(&$this,"polly_settings_page"));
     } 

    /**
	 * Settings page fields
	 *
	 * @since    1.0.0
	 */ 
	public function register_my_cool_plugin_settings() {
		//register our settings
		register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
		register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
		register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
	}

}
