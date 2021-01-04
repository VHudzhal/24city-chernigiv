<?php
namespace ACFFrontendForm\Module\Classes;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module\ACFEF_Module;
use ACFFrontendForm\Module\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class FormSubmit {

	public function __construct(){
		add_action( 'the_content', [ $this, 'form_message' ] );
		add_action( 'acf/validate_save_post', [ $this, 'validate_save_post' ], 1 );
		add_filter( 'acf/pre_save_post' , [ $this, 'on_submit' ], 10, 1 );
		add_action( 'acf/save_post' , [ $this, 'after_save' ], 20, 1 );
		add_action( 'wp' , [ $this, 'delete_post' ], 10, 1 );
	}
	
	public function form_message( $content ){
		$message = '';
		
		if ( isset( $_GET[ 'updated' ] ) ){
			$widget = $this->get_the_widget();
			
			if( ! $widget ){
				return $content;
			}
			$acfef = explode( '_', $_GET[ 'updated' ] );
			$widget_id = $acfef[0];
			$post_id = $acfef[1];
			
			$settings = $widget->get_settings_for_display();
			$message = '<div id="acfef-message" class="elementor-' . $post_id . '">
						<div class="elementor-element elementor-element-' . $widget_id . '">
							<div class="acf-notice -success acf-success-message -dismiss"><p class="success-msg">' . $settings[ 'update_message' ] . '</p><a href="#" onClick="closeMsg()" class="close-msg acf-notice-dismiss acf-icon -cancel"></a></div>
						</div>
						</div>';
		}
		
		return $message . $content;
	}
			
	
	public function validate_save_post(){		
		
		if( ! isset( $_POST[ 'acfef_widget_id' ] ) ){
			return;
		}
		
		$widget = $this->get_the_widget();
		
		$settings = $widget->get_settings_for_display();
		
		$module = ACFEF_Module::instance();
		
		if( isset( $_POST[ 'acfef_step_action' ] ) ){
			$main_action = $_POST[ 'acfef_step_action' ];
		}else{
			$main_action = $_POST[ 'acfef_main_action' ];
		}
		
		if( ! $main_action ){
			return;
		}
		
		if( $main_action == 'new_post' ||  $main_action == 'edit_post' ){
			$post_action = $module->get_main_actions( 'post' );
			$post_action->default_fields( $settings, $_POST[ 'acfef_widget_id' ] );
		}
		
		if( $main_action == 'new_user' ||  $main_action == 'edit_user' ){
			$user_action = $module->get_main_actions( 'user' );
			$user_action->default_fields( $settings, $_POST[ 'acfef_widget_id' ] );
		}
		
		if ( acfef()->is__premium_only() ){
			if( $main_action == 'edit_options' ){
				$options_action = $module->get_main_actions( 'options' );
				$options_action->default_fields( $settings, $_POST[ 'acfef_widget_id' ] );			
			}
			if( $main_action == 'edit_product' ||  $main_action == 'new_product' ){
				$product_action = $module->get_main_actions( 'product' );
				$product_action->default_fields( $settings, $_POST[ 'acfef_widget_id' ] );
			}
		}
		if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_active'] ) && isset( $_POST[ 'stripeToken' ] ) ){
			$stripe_action = $module->get_pay_actions( 'stripe' );	
			$paid = $stripe_action->pay( $settings );
			if( $paid != 'success' ){
				acf_add_validation_error( 'stripe_fields', 'Your payment failed. Please try again' );
			}
		}

	
	}
	
	public function on_submit( $post_id ){		
		
		if( isset( $_POST[ 'prev_step' ] ) ){
			wp_safe_redirect( $_POST[ 'prev_step_link' ] ); 
			exit();
		}
		
		if( ! isset( $_POST[ 'acfef_widget_id' ] ) ){
			return $post_id;
		}
		
		$widget = $this->get_the_widget();
		
		$settings = $widget->get_settings_for_display();
		
		$module = ACFEF_Module::instance();
				
		$actions = $module->get_main_actions();
				
		$step_index = $step_count = '';
		
		if( isset( $_POST[ 'acfef_step_index' ] ) ){
			$step_index = $_POST[ 'acfef_step_index' ];
			$steps = $settings[ 'form_steps' ];
			$settings = $steps[ $step_index ];
			$step_index++;
			$step_count = count( $steps );
			if( $settings[ 'main_action' ] == 'continue' ){
				do_action( 'acfef/on_submit', $settings, $widget->get_id() );	
				return $post_id;
			}
		}
		if( isset( $_POST[ 'acfef_step_action' ] ) ){
			$main_action = $_POST[ 'acfef_step_action' ];
		}else{
			$main_action = $_POST[ 'acfef_main_action' ];
		}
		
		if( ! $main_action ){
			return;
		}
		
		if( $main_action == 'new_post' || $main_action == 'edit_post' ){
			$post_action = $module->get_main_actions( 'post' );
			$post_id = $post_action->run( $post_id, $settings, $step_index, $step_count );
		}
		
		if( $main_action == 'new_user' || $main_action == 'edit_user' ){
			$user_action = $module->get_main_actions( 'user' );
			$post_id = $user_action->run( $post_id, $settings, $step_index, $step_count );
		}
		
		if ( acfef()->is__premium_only() ){
			if( $main_action == 'edit_options' ){
				$options_action = $module->get_main_actions( 'options' );
				$post_id = $options_action->run( $post_id, $settings, $step_index, $step_count );		
			}
			if( $main_action == 'edit_product' || $main_action == 'new_product' ){
				$product_action = $module->get_main_actions( 'product' );
				$post_id = $product_action->run( $post_id, $settings, $step_index, $step_count );
			}
		}		
		$main_action = explode( '_', $settings[ 'main_action' ] );
		
		do_action( 'acfef/on_submit', $settings, $widget->get_id() );
				
		return $post_id;

	}		
	
	public function after_save( $post_id ){					
		
		if( ! isset( $_POST[ 'acfef_widget_id' ] ) ){
			return $post_id;
		}
		
		$widget = $this->get_the_widget();
		
		$settings = $widget->get_settings_for_display();
		
		$module = ACFEF_Module::instance();
		
		$step_index = $steps = false;

		if ( acfef()->is__premium_only() ){
					
		if( isset( $_POST[ 'acfef_step_index' ] ) ){
			$step_index = $_POST[ 'acfef_step_index' ];
			$steps = count( $settings[ 'form_steps' ] );
		}
		
		$email_action = $module->get_submit_actions( 'email' );	
		
		
			if( is_array( $settings[ 'more_actions' ] ) && in_array( 'email', $settings[ 'more_actions' ] ) ){
				$email_action->run( $post_id, $settings, $step_index, $steps );
			}

		}
		
		if( isset( $_POST[ 'acfef_step_action' ] ) ){
			$main_action = $_POST[ 'acfef_step_action' ];
		}else{
			$main_action = $_POST[ 'acfef_main_action' ];
		}
		
		if( ! $steps && ( $main_action == 'new_post' || $main_action == 'new_user' ) && $settings[ 'redirect' ] == 'current' && $settings[ 'redirect_action' ] == 'edit' ) {
			$this->reload_page( $post_id );
		}
			
		do_action( 'acfef/after_save', $settings, $widget->get_id() );
		if ( acfef()->is__premium_only() ){
			if( $steps > 0 && ( $_POST[ 'acfef_step_action' ] == 'new_post' || 'new_user' ) && $step_index+1 < $steps ){ $this->reload_page( $post_id, $step_index+1, $steps );
			}else{
				return $post_id;
			}
		}
	}	

	public function reload_page( $post_id, $step_index = false, $steps = false ){
		if( $steps ){
			$main_action = $_POST[ 'acfef_step_action' ];
			$query_args = [
				'step' => ++$step_index,
			];
		}else{
			$main_action = $_POST[ 'acfef_main_action' ];
			$current_post_id = $_POST[ 'acfef_post_id' ]; 
			$wg_id = $_POST[ 'acfef_widget_id' ];
			$query_args = [ 'updated' => $wg_id . '_' . $current_post_id ];
		}
		
		if( $main_action == 'new_post' || 'new_product' ){
			$query_args[ 'post_id' ] = $post_id;
		}
		if( $main_action == 'new_user' && strpos( $post_id, 'user' ) !== false ){
			$query_args[ 'user_id' ] = explode( '_', $post_id )[1];
		}
		
		if( isset( $_POST[ 'acfef_modal_id' ] ) ) {
			$query_args[ 'modal' ] = $_POST[ 'acfef_modal_id' ];
		}	
		if( isset( $_POST[ 'acfef_widget_id' ] ) ) {
			$query_args[ 'form_id' ] = $_POST[ 'acfef_widget_id' ];
		}
		
		// Redirect user back to the form page, with proper new $_GET parameters.
		$redirect_url = add_query_arg( $query_args, wp_get_referer() );
		wp_safe_redirect( $redirect_url );

		exit();
	}

	public function delete_post(){		
		
		if( ! isset( $_POST[ 'acfef_widget_id' ] ) ||  ! isset( $_POST[ 'delete_post' ] ) ){
			return;
		}

		$widget = $this->get_the_widget();
		$settings = $widget->get_settings_for_display();

		$deleted = wp_delete_post( $_POST[ 'delete_post' ], true );
		if( $deleted ){
			if( $settings[ 'redirect_after_delete' ][ 'url' ] ){
				wp_safe_redirect( $settings[ 'redirect_after_delete' ][ 'url' ] );
				exit();
			}elseif( isset( $settings[ 'redirect_after_delete_product' ] ) && $settings[ 'redirect_after_delete_product' ][ 'url' ] ){
				wp_safe_redirect( $settings[ 'redirect_after_delete_product' ][ 'url' ] );
				exit();
			}else{
				global $wp;
				wp_safe_redirect( home_url( add_query_arg( array( 'trashed' => 1, 'ids' => $_POST[ 'delete_post' ] ), $wp->request) ) );
				exit();
			}
		}
		

	}

	protected function get_the_widget(){
		if( isset( $_POST['acfef_widget_id'] ) ){	
			$widget_id = $_POST['acfef_widget_id'];
			$post_id = $_POST['acfef_post_id'];
		}elseif ( isset( $_GET[ 'updated' ] ) ) {
			$acfef = explode( '_', $_GET[ 'updated' ] );
			$widget_id = $acfef[0];
			$post_id = $acfef[1];
		}else{
			return false;
		}
		
		$elementor = Plugin::instance()->elementor();
		
		$document = $elementor->documents->get( $post_id );
		
		$module = ACFEF_Module::instance();
		
		if( $document ){				
			$form = $module->find_element_recursive( $document->get_elements_data(), $widget_id );
		}
		
		if ( ! empty( $form[ 'templateID' ] ) ) {
			$template = $elementor->documents->get( $form['templateID'] );

			if ( $template ) {
				$global_meta = $template->get_elements_data();
				$form = $global_meta[0];
			}
		}
		
		if( ! $form ){
			return false;
		}
		
		$widget = $elementor->elements_manager->create_element_instance( $form );
		
		return $widget;
	}
	
}

new FormSubmit();