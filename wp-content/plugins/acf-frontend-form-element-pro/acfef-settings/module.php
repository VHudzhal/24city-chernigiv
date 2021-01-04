<?php
namespace ACFFrontendForm\Module;

use Elementor\Core\Base\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ACFEFS_Module extends Module {
		
	private $components = [];
	
	public function get_name() {
		return 'acfef_settings';
	}

	public function get_widgets() {
		return [
			'ACF Frontend Settings'
		];
	}
	
	public function acfef_plugin_page() {
		global $acfef_settings;
		$acfef_settings = add_menu_page( 'ACF Frontend', 'ACF Frontend', 'manage_options', 'acfef-settings', [ $this, 'acfef_admin_settings_page' ], 'dashicons-feedback', '87.87778' );
	}
	
	function acfef_admin_settings_page(){
		global $acfef_active_tab;
		$acfef_active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'welcome'; ?>

		<h2 class="nav-tab-wrapper">
		<?php
			do_action( 'acfef_settings_tabs' );
		?>
		</h2>
		<?php
			do_action( 'acfef_settings_content' );
	}
	
	public function add_tabs(){
		add_action( 'acfef_settings_tabs', [ $this, 'acfef_settings_tabs' ], 1 );
		add_action( 'acfef_settings_content', [ $this, 'acfef_settings_render_options_page' ] );
	}
	
	public function acfef_settings_tabs(){
		
		global $acfef_active_tab; ?>
		<a class="nav-tab <?php echo $acfef_active_tab == 'welcome' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( '?page=acfef-settings&tab=welcome' ); ?>"><?php _e( 'Welcome', 'acfef' ); ?> </a>
		<?php if ( acfef()->is__premium_only() ) { ?>
			<a class="nav-tab <?php echo $acfef_active_tab == 'stripe' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( '?page=acfef-settings&tab=stripe' ); ?>"><?php _e( 'Stripe (BETA)', 'acfef' ); ?> </a>
			<a class="nav-tab <?php echo $acfef_active_tab == 'paypal' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( '?page=acfef-settings&tab=paypal' ); ?>"><?php _e( 'PayPal (BETA)', 'acfef' ); ?> </a>
		<?php }
	}	

	public function acfef_settings_render_options_page() {
		global $acfef_active_tab;
		if ( '' || 'welcome' == $acfef_active_tab ){
		?>
		<style>p.acfef-text{font-size:20px}</style>
		<h3><?php _e( 'Hello and welcome', 'acfef' ); ?></h3>
		<p class="acfef-text"><?php _e( 'If this is your first time using ACF Frontend, we recommend you watch Paul Charlton from WPTuts beautifully explain how to use it.', 'acf-frontend-form-element' )?></p>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/iHx7krTqRN0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br><p class="acfef-text"><?php _e( 'Here is a video where our lead developer and head of support, explains the basic usage of ACF Frontend.', 'acf-frontend-form-element' )?></p>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/lMkZzOVVra8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
		<p class="acfef-text"><?php _e( 'If you have any questions at all please feel welcome to email shabti at', 'acf-frontend-form-element' )?> <a href="mailto:shabti@frontendform.com">shabti@frontendform.com</a> <?php _e( 'or on whatsapp', 'acf-frontend-form-element' )?> <a href="https://api.whatsapp.com/send?phone=972584526441">+972-58-452-6441</a></p>
		<?php }
		
		if ( acfef()->is__premium_only() ) {
			if ( 'stripe' == $acfef_active_tab ) {

				$this->stripe_settings_options = get_option( 'stripe_settings_option_name' ); ?>

				<div class="wrap">
					<?php settings_errors(); ?>
					<form method="post" action="options.php">
						<?php
							settings_fields( 'stripe_settings_option_group' );
							do_settings_sections( 'stripe-settings-admin' );
							submit_button();
						?>
					</form>
				</div>
			<?php }
			if ( 'paypal' == $acfef_active_tab ) {

				$this->paypal_settings_options = get_option( 'paypal_settings_option_name' ); ?>

				<div class="wrap">
					<?php settings_errors(); ?>
					<form method="post" action="options.php">
						<?php
							settings_fields( 'paypal_settings_option_group' );
							do_settings_sections( 'paypal-settings-admin' );
							submit_button();
						?>
					</form>
				</div>
			<?php }
		}
	}
	
	/** Enqueue Stylesheets **/
	public function acfef_admin_scripts( $hook ){
        global $acfef_settings;
        if( !in_array( $hook, array( $acfef_settings ) ) ){
            return;
        }
		if ( acfef()->is__premium_only() ) {
			wp_enqueue_script( 'acfef-settings', ACFEF_URL . '/acfef-settings/admin-pages/stripe/settings.js', array( 'jquery' ), '5.5.5' );
			wp_enqueue_script( 'acfef-paypal-settings', ACFEF_URL . '/acfef-settings/admin-pages/paypal/settings.js', array( 'jquery' ), '5.5.5' );
		}
    }
	
	public function acfef_settings_sections(){
		if ( acfef()->is__premium_only() ) {
			require_once( __DIR__ . '/admin-pages/stripe/settings.php' );
			require_once( __DIR__ . '/admin-pages/paypal/settings.php' );
			new ACFEF_Stripe_Settings( $this );
			new ACFEF_Paypal_Settings($this);
		}
	}
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'acfef_plugin_page' ] );
		add_action( 'admin_init', [ $this, 'acfef_settings_sections' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'acfef_admin_scripts' ] );
		$this->add_tabs();
	}
}
