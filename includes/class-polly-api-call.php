<?php 
/**
 * The file that has the API call functions
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://lougiequisel.com/
 * @since      1.0.0
 *
 * @package    Polly
 * @subpackage Polly/includes
 */

/**
 * Polly plugin's settings page
 *
 * @since    1.0.0
 */

class Polly_API_Call
{
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

	//Custom Variables
	private $default_voice = 'Joanna';	
	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * initiate nickolanack object
	 */
	public function initiateNickolanac(){
		$key = $this->getAWSKey();
		$secret = $this->getAWSSecret();
		$version = $this->getAWSVersion();
		$region = $this->getRegion();

		return (new nickolanack\Polly(
			array(
			    'region'  => $region,
			    'version' => $version,
			    'credentials'=>array('key'=>$key,
			    'secret'=>$secret)
			)
		));
	}
	
	/**
	 * Post submission hooks
	 *
	 * @param string $text The string to be converted as audio.
	 * @param string $voice The voice of the audio.
	 * @param stirng $version AWS Polly version.
	 * @param stirng $region AWS Polly region.
	 */
	public function convert_text_to_audio($text) 
	{
		$voice = $this->getVoice();
		$file = $this->initiateNickolanac()->setVoice($voice)->textToSpeach($text);
		return $file;
	}

	/**
	 * get voices names
	 */
	public function getVoiceNames(){
		return $this->initiateNickolanac()->getVoiceNames();
	}

	/**
	 * Save audio to the aws custom field
	 */
	public function saveAudio($post_id, $file, $isCustomText, $aws_custom_text){
		update_post_meta($post_id, 'aws_audio_path', $file);
		$url_path = $this->getAudioFileURL($file);
		update_post_meta($post_id, 'aws_audio_url', $url_path);
		//if the text is customized
		if($isCustomText){
			update_post_meta($post_id, 'aws_customized','yes');
			update_post_meta($post_id, 'aws_customized_text',$aws_custom_text);
		}
		else{
			update_post_meta($post_id, 'aws_customized','no');
			update_post_meta($post_id, 'aws_customized_text','');	
		}
	}

	/**
	 * is text customized
	 */
	public function isTextCustomized($post_id){
		$bol = get_post_meta($post_id, 'aws_customized', true);
		return ($bol == 'yes') ? true : false;
	}

	/**
	 * get customized text
	 */
	public function getCustomizedText($post_id){
		return get_post_meta($post_id, 'aws_customized_text', true);
	}

	/**
	 * Get audio file by DIR
	 */
	public function getAudioPath($post_id){
		return get_post_meta($post_id, 'aws_audio_path', true);
	}

	/**
	 * Get audio file by URL
	 */
	public function getAudioUrl($post_id){
		return get_post_meta($post_id, 'aws_audio_url', true);
	}

	/**
	 * Get audio file path
	 */
	public function getAudioFileURL($path){
		$path = explode('/', $path);
		$path = array_slice($path, -7);
		$url_path = plugin_dir_url( $this->plugin_name  ).implode('/', $path);
		return $url_path;
	}

	/**
	 * Getting aws voice.
	 */
	public function getVoice()
	{
		$voice = get_option('aws_voice');	
		return $voice ? $voice : $this->default_voice;
		
	}

	/**
	 * Getting aws region.
	 */
	public function getRegion()
	{
		return 'us-west-2';
	}

	/**
	 * Getting aws version.
	 */
	public function getAWSVersion()
	{
		return 'latest';
	}

	/**
	 * Getting aws API Key.
	 */
	public function getAWSKey()
	{
		return get_option('aws_key');
		//$this->key = 'AKIAIERNK7SRRSLLH2OA';
	}

	/**
	 * Getting aws API Key.
	 */
	public function getAWSSecret()
	{
		return get_option('aws_secret');
		//$this->secret = 'kFYym71Ng/I4MOtjMadyKjH7rOBCay8dRr+eheek';
	}

	/**
	 * Setting aws field.
	 */
	public function setAWSField($key, $value){
		update_option($key, $value);
	}

	/**
	* Get aws field.
	*/
	public function getAWSField($key)
	{
		return esc_attr( get_option($key));
	}
}