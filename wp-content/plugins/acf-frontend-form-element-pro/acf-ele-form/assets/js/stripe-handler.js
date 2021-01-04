function createTokenHandler(e, r) {
    var t = jQuery(".stripepurchase");
    if (r.error) return alert(r.error.message), !1;
    var a = r.id;
	t.append(jQuery('<input type="hidden" name="stripeToken" />').val(a));
}
Stripe.setPublishableKey(spk),
    jQuery(function (e) {
        e(".stripepurchase").submit(function (r) {
			var t = e(this);
			if(t.find("input[name=stripeToken]").length == 0){
				r.preventDefault();
				Stripe.card.createToken(t, createTokenHandler);
				args = {
					form: t,
					reset: true,
				};
				acf.validateForm( args );
			} 
        });
    });


if( jQuery('form.stripepurchase').length){

   var card = new Card({
	// a selector or DOM element for the form where users will
	// be entering their information
	form: 'form.stripepurchase', // *required*
	// a selector or DOM element for the container
	// where you want the card to appear
	container: '.card-wrapper', // *required*

	formSelectors: {
		numberInput: 'input.number', // optional — default input[name="number"]
		expiryInput: 'input.exp', // optional — default input[name="expiry"]
		cvcInput: 'input.cvc', // optional — default input[name="cvc"]
		nameInput: 'input.name' // optional - defaults input[name="name"]
	},

	width: 300, // optional — default 350px
	formatting: true, // optional - default true

	// Strings for translation - optional
	messages: {
		validDate: 'valid\ndate', // optional - default 'valid\nthru'
		monthYear: 'mm/yyyy', // optional - default 'month/year'
	},

	// Default placeholders for rendered fields - optional
	placeholders: {
		number: '•••• •••• •••• ••••',
		name: 'Full Name',
		expiry: '••/••',
		cvc: '•••'
	},

	masks: {
		cardNumber: '•' // optional - mask card number
	},

	// if true, will log helpful messages for setting up Card
	debug: false // optional - default false
});
}