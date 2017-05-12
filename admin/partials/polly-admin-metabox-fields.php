<?php

/**
 * Polly's custom meta box.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://lougiequisel.com/
 * @since      1.0.0
 *
 * @package    Polly
 * @subpackage Polly/admin/partials
 */
$post_id = !empty($_GET['post']) ? $_GET['post'] : 0;
$audio_file_url = $polly_api_call->getAudioUrl($post_id);
$isTextCustomized = $polly_api_call->isTextCustomized($post_id);
$customizedText = $polly_api_call->getCustomizedText($post_id);
$aws_key = $polly_api_call->getAWSField('aws_key');
$aws_secret = $polly_api_call->getAWSField('aws_secret');
$aws_voice = $polly_api_call->getAWSField('aws_voice');
?>
<div class="polly_custom_metabox">
	<?php if($aws_key && $aws_secret && $aws_voice): ?>
		<ul class="aws_form_list">
			<li>
				<div class="audiocontent">
				<?php echo ($audio) ? '<audio controls><source src="'.$audio_file_url.'" type="audio/mpeg"/></audio>' : ''; ?>
				</div>
			</li>
			<li class="abs_li">			
				<input type="button" id="aws-polly-btn"  data-json-url='<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'json/generate-audio.php' ?>' data-post-id='<?php echo $post_id; ?>' class="button-primary aws-btn" value="<?php echo ($audio) ? 'Regenerate Audio' : 'Generate Audio'; ?>">
				<img id="aws-loading" src="<?php bloginfo('url'); ?>/wp-admin/images/loading.gif" alt="">
			</li>
			<li>
				<label><input type="checkbox" id="isCustomText" <?php echo ($isTextCustomized) ? 'checked' : ''; ?>> Check to use custom text.</label>
			</li>
			<li>
				<textarea <?php echo ($isTextCustomized) ? 'style="display:block;"' : ''; ?> id="aws_custom_text" cols="10" rows="10"><?php echo $customizedText; ?></textarea>
			</li>
		</ul>
	<?php else: ?>
		<p>Please make sure to complete the required fields in the settings page.</p>
	<?php endif; ?>
</div>
<!-- /.polly_custom_metabox -->

