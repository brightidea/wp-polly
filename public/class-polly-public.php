<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://lougiequisel.com/
 * @since      1.0.0
 *
 * @package    Polly
 * @subpackage Polly/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Polly
 * @subpackage Polly/public
 * @author     Lougie Quisel <lougie@brightideainteractive.com>
 */
class Polly_Public extends Polly_API_Call{

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/polly-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/polly-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Polly Shortcode
	 *
	 * @since    1.0.0
	 */
	public function polly_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'post_id' => 0,
		), $atts );

		global $post;
		//use current's post ID when no attributes found
		$post_id = $atts['post_id'] ? $atts['post_id'] : $post->ID; 
		$audio_path = $this->getAudioUrl($post_id);
		
		return ($audio_path) ? '<audio controls><source src="'.$audio_path.'" type="audio/mpeg"/></audio>' : '';
	}

}
