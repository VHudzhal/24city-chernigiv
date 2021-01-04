<?php
namespace ACFFrontendForm\Module;

use Elementor\Core\Base\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACFEF_Stripe_Settings {

	public $admin_page; 
	
	public function acfef_stripe_section(){
		
		if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_live_mode'] ) ){
			$live_class = array( 'class' => 'live_field' );
			$test_class = array( 'class' => 'test_field hidden' );
		}else{
			$live_class = array( 'class' => 'live_field hidden' );
			$test_class = array( 'class' => 'test_field' );
		}		
		
		register_setting(
			'stripe_settings_option_group', // option_group
			'stripe_settings_option_name', // option_name
			array( $this, 'stripe_settings_sanitize' ) // sanitize_callback
		);


		add_settings_section(
			'stripe_settings_setting_section', // id
			__( 'Stripe (BETA)', 'acf-frontend-form-element' ),// title
			array( $this, 'stripe_settings_section_info' ), // callback
			'stripe-settings-admin' // page
		);

		add_settings_field(
			'acfef_stripe_active', // id
			__( 'Activate', 'acf-frontend-form-element' ),// title
			array( $this, 'acfef_stripe_active_callback' ), // callback
			'stripe-settings-admin', // page
			'stripe_settings_setting_section' // section
		);
		add_settings_field(
			'acfef_stripe_live_mode', // id
			__( 'Use Live Keys', 'acf-frontend-form-element' ),// title
			array( $this, 'acfef_stripe_live_mode_callback' ), // callback
			'stripe-settings-admin', // page
			'stripe_settings_setting_section' // section
		);

		add_settings_field(
			'live_acfef_stripe_publishable_key', // id
			__( 'Live Stripe Publishable Key', 'acf-frontend-form-element' ),// title
			array( $this, 'live_acfef_stripe_publishable_key_callback' ), // callback
			'stripe-settings-admin', // page
			'stripe_settings_setting_section', // section
			$live_class
		);

		add_settings_field(
			'live_acfef_stripe_secret_key', // id
			__( 'Live Stripe Secret Key', 'acf-frontend-form-element' ),// title
			array( $this, 'live_acfef_stripe_secret_key_callback' ), // callback
			'stripe-settings-admin', // page
			'stripe_settings_setting_section', // section
			$live_class
		);

		add_settings_field(
			'test_acfef_stripe_publishable_key', // id
			__( 'Test Stripe Publishable Key', 'acf-frontend-form-element' ),// title
			array( $this, 'test_acfef_stripe_publishable_key_callback' ), // callback
			'stripe-settings-admin', // page
			'stripe_settings_setting_section', // section
			$test_class
		);

		add_settings_field(
			'test_acfef_stripe_secret_key', // id
			__( 'Test Stripe Secret Key	', 'acf-frontend-form-element' ),// title
			array( $this, 'test_acfef_stripe_secret_key_callback' ), // callback
			'stripe-settings-admin', // page
			'stripe_settings_setting_section', // section
			$test_class
		);
	}

	public function stripe_settings_sanitize( $input ) {
		$sanitary_values = array();

		if ( isset( $input['acfef_stripe_active'] ) ) {
			$sanitary_values['acfef_stripe_active'] = $input['acfef_stripe_active'];
		}
		if ( isset( $input['acfef_stripe_live_mode'] ) ) {
			$sanitary_values['acfef_stripe_live_mode'] = $input['acfef_stripe_live_mode'];
		}

		if ( isset( $input['live_acfef_stripe_publishable_key'] ) ) {
			$sanitary_values['live_acfef_stripe_publishable_key'] = sanitize_text_field( $input['live_acfef_stripe_publishable_key'] );
		}

		if ( isset( $input['live_acfef_stripe_secret_key'] ) ) {
			$sanitary_values['live_acfef_stripe_secret_key'] = sanitize_text_field( $input['live_acfef_stripe_secret_key'] );
		}

		if ( isset( $input['test_acfef_stripe_publishable_key'] ) ) {
			$sanitary_values['test_acfef_stripe_publishable_key'] = sanitize_text_field( $input['test_acfef_stripe_publishable_key'] );
		}

		if ( isset( $input['test_acfef_stripe_secret_key'] ) ) {
			$sanitary_values['test_acfef_stripe_secret_key'] = sanitize_text_field( $input['test_acfef_stripe_secret_key'] );
		}

		return $sanitary_values;
	}

	public function stripe_settings_section_info() {
	}
	public function acfef_stripe_active_callback() {
		$live_mode = ( isset( $this->admin_page->stripe_settings_options['acfef_stripe_active'] ) && $this->admin_page->stripe_settings_options['acfef_stripe_active'] === 'acfef_stripe_active' ) ? 'checked' : '';
		
		printf(
			'<input type="checkbox" name="stripe_settings_option_name[acfef_stripe_active]" id="acfef_stripe_active" value="acfef_stripe_active" %s>',
			$live_mode
		);
	}
	public function acfef_stripe_live_mode_callback() {
		$live_mode = ( isset( $this->admin_page->stripe_settings_options['acfef_stripe_live_mode'] ) && $this->admin_page->stripe_settings_options['acfef_stripe_live_mode'] === 'acfef_stripe_live_mode' ) ? 'checked' : '';
		
		printf(
			'<input type="checkbox" name="stripe_settings_option_name[acfef_stripe_live_mode]" id="acfef_stripe_live_mode" value="acfef_stripe_live_mode" %s>',
			$live_mode
		);
	}

	public function live_acfef_stripe_publishable_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="stripe_settings_option_name[live_acfef_stripe_publishable_key]" id="live_acfef_stripe_publishable_key" value="%s">',
			isset( $this->admin_page->stripe_settings_options['live_acfef_stripe_publishable_key'] ) ? esc_attr( $this->admin_page->stripe_settings_options['live_acfef_stripe_publishable_key']) : ''
		);
	}

	public function live_acfef_stripe_secret_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="stripe_settings_option_name[live_acfef_stripe_secret_key]" id="live_acfef_stripe_secret_key" value="%s">',
			isset( $this->admin_page->stripe_settings_options['live_acfef_stripe_secret_key'] ) ? esc_attr( $this->admin_page->stripe_settings_options['live_acfef_stripe_secret_key']) : ''
		);
	}

	public function test_acfef_stripe_publishable_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="stripe_settings_option_name[test_acfef_stripe_publishable_key]" id="test_acfef_stripe_publishable_key" value="%s">',
			isset( $this->admin_page->stripe_settings_options['test_acfef_stripe_publishable_key'] ) ? esc_attr( $this->admin_page->stripe_settings_options['test_acfef_stripe_publishable_key']) : ''
		);
	}

	public function test_acfef_stripe_secret_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="stripe_settings_option_name[test_acfef_stripe_secret_key]" id="test_acfef_stripe_secret_key" value="%s">',
			isset( $this->admin_page->stripe_settings_options['test_acfef_stripe_secret_key'] ) ? esc_attr( $this->admin_page->stripe_settings_options['test_acfef_stripe_secret_key']) : ''
		);
	}

	public function __construct( $page ) {		
		$this->admin_page = $page;
		$this->acfef_stripe_section();
	}
}

