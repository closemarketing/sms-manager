jQuery(function(){	
	jQuery('#sms_message').keyup(function() {
		var len = jQuery('#sms_message').val().length;
		jQuery('#sms_left').val(160-len);
	});
	
	jQuery("#sms_loading").ajaxStart(function(){
		jQuery(this).show();
	});
	jQuery("#sms_loading").ajaxStop(function(){
		jQuery(this).hide();
	}); 
	
	jQuery('#sms_import_link').click(function() {
		jQuery('#sms_upload').show();
	});
	
	jQuery('#sms_change_country').click(function() {
		jQuery('#sms_country_div').show();
	});
	
	jQuery('#country').change(function() {
		jQuery('#sms_country_code').html(jQuery(this).val());
		jQuery('#sms_country_code_h').val(jQuery(this).val());
	});
});