<?php
namespace ACFFrontendForm\Module;

use ACFFrontendForm\Plugin;
use Elementor\Core\Base\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACFEF_Module extends Module {
	
  	protected static $acf_form_header = false;
  	protected static $acf_enqueue_uploader = false;
	
	public $load_scripts = false;
	
	public $main_actions = [];
	public $submit_actions = [];
	public $pay_actions = [];
	
	public function get_name() {
		return 'acf_frontend_form';
	}

	public function get_widgets() {
		return [
			'ACF Frontend Form'
		];
	}
	
	public static function find_element_recursive( $elements, $widget_id ) {
		foreach ( $elements as $element ) {
			if ( $widget_id == $element['id'] ) {
				return $element;
			}

			if ( ! empty( $element['elements'] ) ) {
				$element = self::find_element_recursive( $element['elements'], $widget_id );

				if ( $element ) {
					return $element;
				}
			}
		}

		return false;
	}
	
	public function add_main_action( $id, $instance ) {
		$this->main_actions[ $id ] = $instance;
	}

	public function get_main_actions( $id = null ) {
		if ( $id ) {
			if ( ! isset( $this->main_actions[ $id ] ) ) {
				return null;
			}

			return $this->main_actions[ $id ];
		}

		return $this->main_actions;
	}
		
	public function add_submit_action( $id, $instance ) {
		$this->submit_actions[ $id ] = $instance;
	}

	public function get_submit_actions( $id = null ) {
		if ( $id ) {
			if ( ! isset( $this->submit_actions[ $id ] ) ) {
				return null;
			}

			return $this->submit_actions[ $id ];
		}

		return $this->submit_actions;
	}
	public function add_pay_action( $id, $instance ) {
		$this->pay_actions[ $id ] = $instance;
	}

	public function get_pay_actions( $id = null ) {
		if ( $id ) {
			if ( ! isset( $this->pay_actions[ $id ] ) ) {
				return null;
			}

			return $this->pay_actions[ $id ];
		}

		return $this->pay_actions;
	}
	
	public function init_widgets() {
		// Include Widget files
		
		require_once( __DIR__ . '/widgets/acf-ele-form.php' );
		require_once( __DIR__ . '/widgets/edit_post.php' );
		require_once( __DIR__ . '/widgets/new_post.php' );
		require_once( __DIR__ . '/widgets/delete-post.php' );

		if ( acfef()->is__premium_only() ) {
			require_once( __DIR__ . '/widgets/paypal-button.php' );
		}

		// Register widget
		$elementor = Plugin::instance()->elementor();

		$elementor->widgets_manager->register_widget_type( new Widgets\ACF_Elementor_Form_Widget() );
		$elementor->widgets_manager->register_widget_type( new Widgets\Edit_Post_Widget() );
		$elementor->widgets_manager->register_widget_type( new Widgets\New_Post_Widget() );
		$elementor->widgets_manager->register_widget_type( new Widgets\Delete_Post_Widget() );
		

		if ( acfef()->is__premium_only() ) {
			require_once( __DIR__ . '/widgets/paypal-button.php' );
			$elementor->widgets_manager->register_widget_type( new Widgets\Paypal_Buttons_Widget() );
		}

	}

	
	public function acf_form_head() {
		if( ! self::$acf_form_header ){
		  acf()->form_front->check_submit_form();
		  self::$acf_form_header = true;
		} 
		
	}	

    public function acfef_elementor_preview() {
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			echo '<style>.hide-if-no-js{display:none}</style>';
		}
	}
	
	public function acfef_enqueue_scripts() {
		wp_register_style( 'acfef-frontend', ACFEF_URL . 'acf-ele-form/assets/css/frontend.min.css', array(), '5.5.39' );		
		wp_register_script( 'acfef-frontend', ACFEF_URL . 'acf-ele-form/assets/js/frontend.js', array( 'jquery' ), '5.5.28', true );
		wp_register_script( 'acfef-password-strength', ACFEF_URL . 'acf-ele-form/assets/js/password-strength.js', array( 'jquery', 'password-strength-meter' ), '5.5.27', true );
		wp_register_style( 'paypal-editor', ACFEF_URL . 'acf-ele-form/assets/css/paypal-editor.css', [], '1.0.0' );
		wp_register_style( 'paypal-front', ACFEF_URL . 'acf-ele-form/assets/css/paypal-front.css', [], '1.0.0' );
		acf_enqueue_scripts();
		wp_enqueue_style( 'acfef-frontend' );
		
		$widget_scripts = [ 'jquery', 'password-strength-meter', 'acfef-password-strength', 'acfef-frontend' ];
		foreach( $widget_scripts as $script ){
			wp_enqueue_script( $script );
		}
	}	
	public function acfef_edit_mode_scripts() {
		if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_active'] ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ){
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
	}
	public function acfef_icon_file(){
		wp_enqueue_style( 'acfef-icon', ACFEF_URL . 'acf-ele-form/assets/css/icon.css', array(), '1.0.0' );
	}
	
	public function __construct() {		
		require_once( __DIR__ . '/classes/action_base.php' );
		
		//actions
		require_once( __DIR__ . '/actions/term.php' );
		require_once( __DIR__ . '/actions/user.php' );
		require_once( __DIR__ . '/actions/post.php' );
		
		if ( acfef()->is__premium_only() ) {
			require_once( __DIR__ . '/actions/options.php' );
			if ( class_exists( 'woocommerce' ) ){
				require_once( __DIR__ . '/actions/product.php' );
			}
			require_once( __DIR__ . '/actions/email.php' );
			require_once( __DIR__ . '/actions/stripe.php' );
			require_once( __DIR__ . '/actions/paypal.php' );
			require_once( __DIR__ . '/classes/limit_submit.php' );
			require_once( __DIR__ . '/classes/multi_step.php' );
			require_once( __DIR__ . '/classes/style_tab.php' );
			
		}
		
		$this->add_main_action( 'user', new Actions\EditUser() );
		$this->add_main_action( 'post', new Actions\EditPost() );
		$this->add_main_action( 'term', new Actions\EditTerm() );
		if ( acfef()->is__premium_only() ) {
			$this->add_main_action( 'options', new Actions\EditOptions() );
			if ( class_exists( 'woocommerce' ) ){
				$this->add_main_action( 'product', new Actions\EditProduct() );
			}
			$this->add_submit_action( 'email', new Actions\SendEmail() );
			$this->add_pay_action( 'stripe', new Actions\StripePayment() );
			$this->add_pay_action( 'paypal', new Actions\PaypalPayment() );
		}
		
		require_once( __DIR__ . '/classes/form_submit.php' );
				
		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'wp', [ $this, 'acf_form_head' ] );
		
		add_action( 'wp_footer', [ $this, 'acfef_elementor_preview' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'acfef_enqueue_scripts' ] );
		if ( acfef()->is__premium_only() ) {
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'acfef_edit_mode_scripts' ] );
		}
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'acfef_icon_file' ] );
	}
	
}

