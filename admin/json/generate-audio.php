<?php 
/**
 * The file for JSON to generate audio from text.
 *
 * @link       http://lougiequisel.com/
 * @since      1.0.0
 *
 * @package    Polly
 * @subpackage Polly/includes
 */
require_once('../../../../../wp-load.php');
//Only give's access if the user is logged in
if(is_user_logged_in()){
	//isCustomText : isCustomText, custom_text: aws_custom_text

	$post_id = ($_POST['post_id']) ? $_POST['post_id'] : '';
	$isCustomText = ($_POST['isCustomText'] == 'true') ? true : false;
	$aws_custom_text = $_POST['custom_text'] ? $_POST['custom_text'] : '';
	/*
	* Get the content without tags
	*/
	$text = ($isCustomText) ? $aws_custom_text : apply_filters('the_content', strip_shortcodes(get_post_field('post_content', $post_id)));
	$text = strip_tags($text);
	/*
	* Process text to speech library
	*/
	$audio = ($text) ?  $polly_api_call->convert_text_to_audio($text) : 0;
	/*
	* Save to custom field once there is a valid $audio
	*/
	if($audio){
		$polly_api_call->saveAudio($post_id,$audio, $isCustomText, $aws_custom_text);
		$audio_url = $polly_api_call->getAudioUrl($post_id);
	}
	/*
	* For json purposes
	*/
	echo json_encode($audio_url,JSON_UNESCAPED_SLASHES);
}
