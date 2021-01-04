<?php
namespace ACFFrontendForm\Module\Actions;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module;
use ACFFrontendForm\Module\Classes\ActionBase;
use ACFFrontendForm\Module\Widgets;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	
class StripePayment extends ActionBase{

	public $site_domain = '';

	public function get_name() {
		return 'stripe';
	}

	public function get_label() {
		return __( 'Stripe', 'acf-frontend-form-element' );
	}


	public function register_settings_section( $widget ) {

		$site_domain = acfef_get_site_domain();
		
		$repeater = new \Elementor\Repeater();

		$widget->start_controls_section(
			 'section_stripe',
			[
				'label' => $this->get_label() . ' (BETA)',
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'pay_action' => 'stripe',
				],
			]
		);


		
		$widget->add_control(
			'card_number_label',
			[
				'label' => __( 'Card Number Label', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Card Number', 'acf-frontend-form-element' ),
				'default' => __( 'Card Number', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_control(
			'card_number_place',
			[
				'label' => __( 'Card Number Placeholder', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '•••• •••• •••• ••••', 'acf-frontend-form-element' ),
				'default' => __( '•••• •••• •••• ••••', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_responsive_control(
			'card_number_width',
			[
				'label' => __( 'Field Width', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 20,
				'max' => 100,
				'default' => 50,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'default' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}} .acf-field-acfef-stripe-number' => 'width: {{VALUE}}%',
				],
				'separator' => 'after',
			]
		);		
		$widget->add_control(
			'card_name_label',
			[
				'label' => __( 'Card Name Label', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Card Name', 'acf-frontend-form-element' ),
				'default' => __( 'Card Name', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_control(
			'card_name_place',
			[
				'label' => __( 'Card Name Place', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Full Name', 'acf-frontend-form-element' ),
				'default' => __( 'Full Name', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_responsive_control(
			'card_name_width',
			[
				'label' => __( 'Field Width', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 20,
				'max' => 100,
				'default' => 50,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'default' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}} .acf-field-acfef-stripe-name' => 'width: {{VALUE}}%',
				],
				'separator' => 'after',
			]
		);				
		$widget->add_control(
			'card_exp_label',
			[
				'label' => __( 'Card Expiration Label', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Card Expiration', 'acf-frontend-form-element' ),
				'default' => __( 'Card Expiration', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_control(
			'card_exp_place',
			[
				'label' => __( 'Card Expiration Placceholder', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '••/••', 'acf-frontend-form-element' ),
				'default' => __( '••/••', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_responsive_control(
			'card_exp_width',
			[
				'label' => __( 'Field Width', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 20,
				'max' => 100,
				'default' => 50,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'default' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}} .acf-field-acfef-stripe-exp' => 'width: {{VALUE}}%',
				],
				'separator' => 'after',
			]
		);		
		$widget->add_control(
			'card_cvc_label',
			[
				'label' => __( 'Card CVC Label', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Card CVC', 'acf-frontend-form-element' ),
				'default' => __( 'Card CVC', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_control(
			'card_cvc_place',
			[
				'label' => __( 'Card CVC Placeholder', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '•••', 'acf-frontend-form-element' ),
				'default' => __( '•••', 'acf-frontend-form-element' ),
			]
		);	
		$widget->add_responsive_control(
			'card_cvc_width',
			[
				'label' => __( 'Field Width', 'elementor' ) . ' (%)',
				'type' => Controls_Manager::NUMBER,
				'min' => 20,
				'max' => 100,
				'default' => 50,
				'required' => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'max' => 100,
						'required' => false,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'default' => 100,
						'required' => false,
					],
				],
				'min_affected_device' => [
					Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
					Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
				],
				'selectors' => [
					'{{WRAPPER}} .acf-field-acfef-stripe-cvc' => 'width: {{VALUE}}%',
				],
				'separator' => 'after',
			]
		);		

	
		$widget->add_control(
			'price_stripe',
			[
				'label' => __( 'Amount To Charge', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'placeholder' => __( '20', 'acf-frontend-form-element' ),
				'default' => __( '20', 'acf-frontend-form-element' ),
				'required' => true,
				'description' => __( 'Must be equal to or greater than 50 cents in USD', 'acf-frontend-form-element' ),
				'dynamic' => [
					'active' => true,
				],			
				'frontend_available' => true,
			]
		);		
		$widget->add_control(
			'currency_stripe',
			[
				'label' => __( 'Currency', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'USD', 'acf-frontend-form-element' ),
				'default' => __( 'USD', 'acf-frontend-form-element' ),
				'required' => true,
				'dynamic' => [
					'active' => true,
				],
                'frontend_available' => true,
			]
		);
		$widget->add_control(
			'stripe_currencies',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( '<p><a target="_blank" href="https://stripe.com/docs/currencies/">Click here</a> to learn about Stripe\'s supported currencies.</p>', 'acf-frontend-form-element' ),
				'content_classes' => 'acf-fields-note',
			]
		);
		$widget->add_control(
			'description_stripe',
			[
				'label' => __( 'Purchase Description', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'required' => true,
				'placeholder' => get_bloginfo( 'name' ),
				'default' => get_bloginfo( 'name' ),
				'dynamic' => [
					'active' => true,
				],			
                'frontend_available' => true,
			]
		);
		$widget->end_controls_section();
	
	}
	
	public function render_form( $settings ){
		if(isset($_GET['payment']) && $_GET['payment'] == 'paid') {
			echo '<p class="success">' . __('Thank you for your payment.', 'acf-frontend-form-element') . '</p>';
		} else { 
			
			if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_active'] ) ){
				$spk_localized = get_option( 'stripe_settings_option_name' )[ 'test_acfef_stripe_publishable_key' ];
				if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_live_mode'] ) ){
					$spk_localized = get_option( 'stripe_settings_option_name' )[ 'live_acfef_stripe_publishable_key' ];  
				}
				wp_register_style( 'acfef-card', ACFEF_URL . 'acf-ele-form/assets/css/card.css', array(), '5.5.25' );
				wp_register_script( 'acfef-card', ACFEF_URL . 'acf-ele-form/assets/js/card.js', array( 'jquery' ), '5.5.15', true );

				wp_register_script( 'stripe', 'https://js.stripe.com/v2/' );
				wp_register_script( 'acfef-stripe-handler', ACFEF_URL . 'acf-ele-form/assets/js/stripe-handler.js', array( 'jquery', 'stripe', 'acfef-card' ), '5.5.18', true );
				if( $spk_localized ){
					wp_localize_script( 'acfef-stripe-handler', 'spk', $spk_localized );
				}			
				wp_enqueue_style( 'acfef-card' );
	
				$widget_scripts = [ 'acfef-card', 'stripe', 'acfef-stripe-handler' ];
				foreach( $widget_scripts as $script ){
					wp_enqueue_script( $script );
				}
			}

			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				$stripe_fields = $this->get_card_preview();
			}else{
				$stripe_fields = '<div class="acf-field acf-field-group" data-type="group">
				<div class="acf-fields -top -border">
				<div class="card-wrapper"></div>';
			}			

			$stripe_fields .= $this->get_card_fields( $settings );

			$stripe_fields .= '</div></div>';
			
			$stripe_fields .= '<input type="hidden" name="pay_action" value="stripe"/>
				<input type="hidden" name="stripe_nonce" value="' . wp_create_nonce('stripe-nonce') . '"/>
				<input type="hidden" name="redirect" value="' . get_permalink() . '"/>';



			return $stripe_fields;
		}
	}

	public function get_card_preview(){ 
		return '
		<div class="acf-field acf-field-group" data-type="group">
			<div class="acf-fields -top -border">
				 <div class="card-wrapper">
					<div class="jp-card-container">
						<div class="jp-card">
							<div class="jp-card-front" style="text-align: center;padding-top: 25px">
								<span style="font-size: 20px">' . __( 'Preview not available', 'acf-frontend-form-element' ) . '</span>
							</div>
						</div>
					</div>
				</div>
			';		
	}	
	public function get_card_fields( $settings ){
		$fields = [ 'number', 'name', 'exp', 'cvc' ];
		$form_fields = '';
		foreach( $fields as $field ){
			$form_fields .= '
				<div class="acf-field width acf-field-text acf-field-acfef-stripe-' . $field . ' is-required" data-name="_stripe_' . $field . '" data-type="text" data-key="field_acfef_stripe_' . $field . '" data-required="1" data-width>
					<div class="acf-label">
						<label for="acf-field_acfef_stripe_' . $field . '">' . $settings[ 'card_' . $field . '_label' ] . ' <span class="acf-required">*</span></label>
					</div>
					<div class="acf-input">
						<div class="acf-input-wrap"><input type="text" id="acf-field_acfef_stripe_' . $field . '" required="required" class="' . $field . '" data-stripe="' . $field . '" placeholder="' . $settings[ 'card_' . $field . '_place' ] . '"></div>
					</div>
				</div>	
			';	
		}
		return $form_fields;
	}
	
	public function pay( $settings ){	

		$price = $settings[ 'price_stripe' ];
		$currency = $settings[ 'currency_stripe' ];
		
		$zero_dec_cur = [
			'BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'XOF', 'XPF', 'XAF', 'VND', 'VUV', 'UGX', 'RWF', 'PYG', 'MGA'
		];
		
		if( ! in_array( $currency, $zero_dec_cur ) ){
			$price *= 100;
		}
		$description = $settings[ 'description_stripe' ];

		$secret = get_option( 'stripe_settings_option_name' )[ 'test_acfef_stripe_secret_key' ];  
		if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_live_mode'] ) ){
			$secret = get_option( 'stripe_settings_option_name' )[ 'live_acfef_stripe_secret_key' ];  
		}

		\Stripe\Stripe::setApiKey( $secret );

		try {
			if ( !isset( $_POST[ 'stripeToken' ] ) )
				throw new \Exception('The Stripe Token was not generated correctly');
			\Stripe\Charge::create( array( 'amount' => $price, 'currency' => strtolower( $currency ), 'source' => $_POST[ 'stripeToken' ], 'description' => $description ) );

			return 'success';
			unset( $_POST[ 'stripeToken' ] );

		} catch (\Exception $e) {
			/*
				* if something went wrong
				*/
			echo $e->getMessage();

		}
	}
	



}
