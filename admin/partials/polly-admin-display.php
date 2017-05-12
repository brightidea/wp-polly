<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://lougiequisel.com/
 * @since      1.0.0
 *
 * @package    Polly
 * @subpackage Polly/admin/partials
 */
?>
<div class="wrap">	
	<h1>Polly settings page</h1>
	<?php 
	global $polly_api_call;
	//when the user submit's the form
	if(isset($_POST['submit'])){
		$aws_key = $_POST['aws_key'];
		$aws_secret = $_POST['aws_secret'];
		$aws_voice = $_POST['aws_voice'];
		if($aws_key && $aws_secret && $aws_voice){
			$polly_api_call->setAWSField('aws_key', $aws_key);
			$polly_api_call->setAWSField('aws_secret', $aws_secret);
			$polly_api_call->setAWSField('aws_voice', $aws_voice);
			echo '<div id="message" class="updated below-h2"><p>Settings Updated.</p></div>';
		}
		else{
			echo '<div id="message" class="error below-h2"><p>Please fill up all required fields.</p></div>';
		}
	}
	//get all fields
	$voices = $polly_api_call->getVoiceNames();
	$aws_key = $polly_api_call->getAWSField('aws_key');
	$aws_secret = $polly_api_call->getAWSField('aws_secret');
	$aws_voice = $polly_api_call->getVoice();
	?>
    <form method="post" action="">
		<table class="form-table">
	        <tr valign="top">
		        <th scope="row">AWS Key<em>*</em></th>
		        <td>
		        	<input type="text" name="aws_key" value="<?php echo $aws_key; ?>" />
		        </td>
	        </tr>
	         
	        <tr valign="top">
		        <th scope="row">AWS Secret<em>*</em></th>
		        <td>
		        	<input type="text" name="aws_secret" value="<?php echo $aws_secret; ?>" />
		        </td>
	        </tr>
	        
	        <tr valign="top">
		        <th scope="row">Voice<em>*</em></th>
		        <td> 
		        	<select name="aws_voice">
		        		<option value="">Select Voice</option>
		        		<?php foreach($voices as $key => $voice): ?>
		        			<option <?php echo ($voice == $aws_voice) ? 'selected' : '';  ?> value="<?php echo $voice; ?>"><?php echo $voice; ?></option>
		        		<?php endforeach; ?>
		        	</select>
		        </td>
	        </tr>
	    </table>
	    <?php submit_button(); ?>
	</form>
</div>
