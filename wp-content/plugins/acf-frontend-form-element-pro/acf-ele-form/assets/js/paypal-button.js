 jQuery( document ).ready(function($) {
     var settings = $('.paypal-button-acf-warp').data('id');

     if(paypal){
        paypal.Buttons({
            style: {
                layout: settings['hide_card'],
                color:  settings['button_color_button'],
                shape:  settings['button_style_button'],
                label:  'pay',
                height: 40
            },
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                    
                        amount: {
                            value: settings['price_paypal_button'],
                        },
                        description: settings['description_paypal_button'],
                    }]
                });
            },
            
        
            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                    var settings = $('.paypal-button-acf-warp').data('id');
                    $('#paypal-button-container').addClass('hide');
                    if(settings['thank_you']){
                    $('#success').addClass('acf-notice');
                    }
                    if(settings['redirect']){
                    window.location.href= settings['redirect'];
                    }

                });
            }


        }).render('#paypal-button-container');
    }
 });