jQuery(function () {
	if (jQuery('#log-daterange').val() == 7) {
		jQuery('#log-date-start-container').show();
		jQuery('#log-date-end-container').show();
	} else {
		jQuery('#log-date-start-container').hide();
		jQuery('#log-date-end-container').hide();
	}
	jQuery('#log-daterange').change(function () {
		if (jQuery(this).val() == 7) {
			jQuery('#log-date-start-container').show();
			jQuery('#log-date-end-container').show();
		} else {
			jQuery('#log-date-start-container').hide();
			jQuery('#log-date-end-container').hide();
		}
	});


	jQuery('.toggle-information .click').click(function() {
		jQuery(this).parent().find('.content').toggle();
	});
});