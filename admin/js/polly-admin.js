jQuery(document).ready(function($){
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	/*
	* Convert text to audio json
	*/
	$('#aws-polly-btn').on( "click", function() {
		var json_url = $(this).data('json-url');
		var post_id = $(this).data('post-id');
		var isCustomText = $('#isCustomText').is(':checked');
		var aws_custom_text = $('#aws_custom_text').val();
		if(post_id != 0){
			var _this = $(this);
			var _loading_img = $('#aws-loading');
			_this.prop('disabled', true);
			$('#isCustomText').prop('disabled', true);
			$('#aws_custom_text').prop('disabled', true);
			_loading_img.show();
			$.post( json_url, { post_id: post_id, isCustomText : isCustomText, custom_text: aws_custom_text })
			  .done(function( data ) {  
			    $('.audiocontent').html('<audio controls><source src="'+JSON.parse(data)+'" type="audio/mpeg"/></audio>');
			    _this.val('Regenerate Audio');
			   _this.prop('disabled', false);
			   $('#isCustomText').prop('disabled', false);
			   $('#aws_custom_text').prop('disabled', false);
			   _loading_img.hide();
			});
		}
	});
	/*
	* Hide and show custom text textarea
	*/
	$('#isCustomText').click(function(event) {
		var _this = $(this);
		if(_this.is(':checked')){
			$('#aws_custom_text').show();
		}
		else{
			$('#aws_custom_text').hide();
		}
	});
});
