<?php 
/**
 * The plugin's own custom metabox
 *
 * @link       http://lougiequisel.com/
 * @since      1.0.0
 *
 * @package    Polly
 * @subpackage Polly/admin
 */

class Polly_MetaBox extends Polly_API_Call{

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Polly's custom metabox.
	 */
	public function polly_metabox()
	{
		global $post, $polly_api_call;
        $custom = get_post_custom($post->ID);         
        $audio = isset($custom["aws_audio_url"][0]) ? $custom["aws_audio_url"][0] : null;         
        wp_nonce_field(plugin_basename( __FILE__ ),'polly_noncename' );

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/polly-admin-metabox-fields.php';
	}

	/**
	 * initiate metabox
	 */
	public function polly_add_metabox(){
       add_meta_box("polly_metabox", "Polly", array(&$this,"polly_metabox"), "post", "side", "default");
    }

}