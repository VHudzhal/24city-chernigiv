<?php
namespace ACFFrontendForm\Module;

use Elementor\Core\Base\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACFEF_Paypal_Settings {

	public $admin_page; 
	
	public function acfef_paypal_section(){
		
		if( isset( get_option( 'paypal_settings_option_name' )['acfef_paypal_live_mode'] ) ){
			$live_class = array( 'class' => 'live_field' );
			$test_class = array( 'class' => 'test_field hidden' );
		}else{
			$live_class = array( 'class' => 'live_field hidden' );
			$test_class = array( 'class' => 'test_field' );
		}		
		
		register_setting(
			'paypal_settings_option_group', // option_group
			'paypal_settings_option_name', // option_name
			array( $this, 'paypal_settings_sanitize' ) // sanitize_callback
		);


		add_settings_section(
			'paypal_settings_setting_section', // id
			__( 'paypal (BETA)', 'acf-frontend-form-element' ),// title
			array( $this, 'paypal_settings_section_info' ), // callback
			'paypal-settings-admin' // page
		);

		add_settings_field(
			'acfef_paypal_active', // id
			__( 'Activate', 'acf-frontend-form-element' ),// title
			array( $this, 'acfef_paypal_active_callback' ), // callback
			'paypal-settings-admin', // page
			'paypal_settings_setting_section' // section
		);
		
		add_settings_field(
			'acfef_paypal_live_mode', // id
			__( 'Use Live Keys', 'acf-frontend-form-element' ),// title
			array( $this, 'acfef_paypal_live_mode_callback' ), // callback
			'paypal-settings-admin', // page
			'paypal_settings_setting_section' // section
		);

		add_settings_field(
			'acfef_paypal_clientid', // id
			__( 'Instructions', 'acf-frontend-form-element' ),// title
			array( $this, 'acfef_paypal_clientid_callback' ), // callback
			'paypal-settings-admin', // page
			'paypal_settings_setting_section' // section
		);

		add_settings_field(
			'live_acfef_paypal_publishable_key', // id
			__( 'Live paypal Client ID', 'acf-frontend-form-element' ),// title
			array( $this, 'live_acfef_paypal_publishable_key_callback' ), // callback
			'paypal-settings-admin', // page
			'paypal_settings_setting_section', // section
			$live_class
		);


		add_settings_field(
			'test_acfef_paypal_publishable_key', // id
			__( 'Sandbox Client ID', 'acf-frontend-form-element' ),// title
			array( $this, 'test_acfef_paypal_publishable_key_callback' ), // callback
			'paypal-settings-admin', // page
			'paypal_settings_setting_section', // section
			$test_class
		);
	}

	public function paypal_settings_sanitize( $input ) {
		$sanitary_values = array();

		if ( isset( $input['acfef_paypal_active'] ) ) {
			$sanitary_values['acfef_paypal_active'] = $input['acfef_paypal_active'];
		}
		if ( isset( $input['acfef_paypal_live_mode'] ) ) {
			$sanitary_values['acfef_paypal_live_mode'] = $input['acfef_paypal_live_mode'];
		}

		if ( isset( $input['live_acfef_paypal_publishable_key'] ) ) {
			$sanitary_values['live_acfef_paypal_publishable_key'] = sanitize_text_field( $input['live_acfef_paypal_publishable_key'] );
		}



		if ( isset( $input['test_acfef_paypal_publishable_key'] ) ) {
			$sanitary_values['test_acfef_paypal_publishable_key'] = sanitize_text_field( $input['test_acfef_paypal_publishable_key'] );
		}

		return $sanitary_values;
	}

	public function paypal_settings_section_info() {
	}
	public function acfef_paypal_active_callback() {
		$live_mode = ( isset( $this->admin_page->paypal_settings_options['acfef_paypal_active'] ) && $this->admin_page->paypal_settings_options['acfef_paypal_active'] === 'acfef_paypal_active' ) ? 'checked' : '';
		
		printf(
			'<input type="checkbox" name="paypal_settings_option_name[acfef_paypal_active]" id="acfef_paypal_active" value="acfef_paypal_active" %s>',
			$live_mode
		);
	}
	public function acfef_paypal_live_mode_callback() {
		$live_mode = ( isset( $this->admin_page->paypal_settings_options['acfef_paypal_live_mode'] ) && $this->admin_page->paypal_settings_options['acfef_paypal_live_mode'] === 'acfef_paypal_live_mode' ) ? 'checked' : '';
		
		printf(
			'<input type="checkbox" name="paypal_settings_option_name[acfef_paypal_live_mode]" id="acfef_paypal_live_mode" value="acfef_paypal_live_mode" %s>',
			$live_mode
		);
	}

	public function acfef_paypal_clientid_callback() {		
		printf(
			__('<p>You need to create PayPal App to get the Client ID</p><p><a target="_blank" href="https://developer.paypal.com/developer/applications/create">Click here</a> to create new PayPal App or to get your App Client ID.</p>', 'acf-frontend-form-element' )
		);
	}

	public function live_acfef_paypal_publishable_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="paypal_settings_option_name[live_acfef_paypal_publishable_key]" id="live_acfef_paypal_publishable_key" value="%s">',
			isset( $this->admin_page->paypal_settings_options['live_acfef_paypal_publishable_key'] ) ? esc_attr( $this->admin_page->paypal_settings_options['live_acfef_paypal_publishable_key']) : ''
		);
	}

	public function test_acfef_paypal_publishable_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="paypal_settings_option_name[test_acfef_paypal_publishable_key]" id="test_acfef_paypal_publishable_key" value="%s">',
			isset( $this->admin_page->paypal_settings_options['test_acfef_paypal_publishable_key'] ) ? esc_attr( $this->admin_page->paypal_settings_options['test_acfef_paypal_publishable_key']) : ''
		);
	}


	public function __construct( $page ) {		
		$this->admin_page = $page;
		$this->acfef_paypal_section();
	}
}

