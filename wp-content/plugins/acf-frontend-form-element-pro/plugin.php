<?php
namespace ACFFrontendForm;

use Elementor\Plugin as EL;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Plugin {
		
		/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var ACF_Elementor_Form The single instance of the class.
	 */
	private static $_instance = null;
	
	private $modules = [];


	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return ACF_Elementor_Form An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
	
	/**
	 * @return \Elementor\Plugin
	 */

	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}
	
	public static function get_current_post_id() {
		if ( isset( EL::$instance->documents ) ) {
			return EL::$instance->documents->get_current()->get_main_id();
		}

		return get_the_ID();
	}
	
	public function add_module( $id, $instance ) {
		$this->modules[ $id ] = $instance;
	}
	
	public function get_modules( $id = null ) {
		if ( $id ) {
			if ( ! isset( $this->modules[ $id ] ) ) {
				return null;
			}

			return $this->modules[ $id ];
		}

		return $this->modules;
	}
	
	public function elementor_init() {
			

		$elementor = \Elementor\Plugin::$instance;

		// Add element category in panel
		$elementor->elements_manager->add_category(
			'acfef-widgets',
		[
			'title' => __( 'ACF FRONTEND WIDGETS', 'acf-frontend-form-element' ),
			'icon' => 'fa fa-plug',
		],
			1
		);
		
	}


	public function __construct() {
		if ( acfef()->is__premium_only() ) {
			if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_active'] ) ){
				require_once( dirname(__FILE__) . '/../../../wp-load.php' );
				require_once( __DIR__ . '/acf-ele-form/assets/stripe-api/init.php' );
			}
		}
		require_once ( __DIR__ . '/acf-ele-form/helpers/data_fetch.php' );
		require_once ( __DIR__ . '/acf-ele-form/module.php' );
		require_once ( __DIR__ . '/hide-admin/module.php' );
		require_once ( __DIR__ . '/uploads-privacy/module.php' );
		require_once ( __DIR__ . '/acf-field-settings/module.php' );
		require_once ( __DIR__ . '/acfef-settings/module.php' );
		require_once ( __DIR__ . '/local-avatar/module.php' );
		
		$this->add_module( 'acfef_widget', Module\ACFEF_Module::instance() );	
		$this->add_module( 'hide_admin', Module\HA_Module::instance() );	
		$this->add_module( 'uploads_privacy', Module\UP_Module::instance() );	
		$this->add_module( 'acf_settings', Module\ACFS_Module::instance() );
		$this->add_module( 'acfef_settings', Module\ACFEFS_Module::instance() );
		// Add new category for Elementor
		add_action( 'elementor/init', array( $this, 'elementor_init' ) );		
		
		do_action( 'acfef/widget_loaded' );
	}	
	
}

Plugin::instance();