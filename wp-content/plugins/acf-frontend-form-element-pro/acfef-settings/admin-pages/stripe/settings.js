jQuery(document).ready(function() {
   
    jQuery('#acfef_stripe_live_mode').change(function() {
		if(this.checked) {
        	jQuery('.live_field').removeClass('hidden');
        	jQuery('.test_field').addClass('hidden');
        }else{
        	jQuery('.test_field').removeClass('hidden');
        	jQuery('.live_field').addClass('hidden');
		}
    });
});