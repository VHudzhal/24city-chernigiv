 jQuery( document ).ready(function($) {
     var settings = $('.elementor-widget-acf_ele_form').data('settings');
 // Render the PayPal button into #paypal-button-container

 if(paypal){
    paypal.Buttons({
            style: {
                layout: settings['hide_card'],
                color:  settings['button_color'],
                shape:  settings['button_style'],
                label:  'pay',
                height: 40
            },
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                    
                        amount: {
                            value: settings['price_paypal'],
                        },
                        description: settings['description_paypal'],
                    }]
                });
            },
            
        
            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                    $('[data-id=form-submit]').submit();
                });
            }


        }).render('#paypal-button-container');
    }
});