<?php
namespace ACFFrontendForm\Module\Actions;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module\ACFEF_Module;
use ACFFrontendForm\Module\Classes\ActionBase;
use ACFFrontendForm\Module\Widgets;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class EditOptions extends ActionBase {
	
	public function get_name() {
		return 'options';
	}

	public function get_label() {
		return __( 'Options', 'acf-frontend-form-element' );
	}
	

	public function register_settings_section( $widget ) {
								
		$widget->start_controls_section(
			'section_edit_options',
			[
				'label' => $this->get_label(),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'main_action' => 'edit_options',
					'multi' => ''
				],
			]
		);
		
		$this->register_fields_settings( $widget );
		
		$widget->end_controls_section();

	}
	
	
	
	public function register_fields_settings( $widget ){
		$widget->add_control(
			'show_site_title',
			[
				'label' => __( 'Site Title Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Site Title Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'site_title', __( 'Site Title', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );		

		$widget->add_control(
			'show_site_tagline',
			[
				'label' => __( 'Site Tagline Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Site Tagline Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'site_desc', __( 'Site Tagline', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );	
		
		$widget->add_control(
			'show_site_logo',
			[
				'label' => __( 'Site Logo Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Site Logo Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'site_logo', __( 'Site Logo', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );		


	}

		
	public function options_fields( $defaults, $settings, $wg_id ){	
		if( 'edit_options' == $settings[ 'main_action' ] ){
			$defaults[ 'fields' ] = $this->default_fields( $settings, $wg_id );
		}
		
		return $defaults;
	}
	
	public function default_fields( $settings, $wg_id ) {
		$defaults = [];
		if( $settings[ 'show_site_title' ] == 'default' ){
			$field = 'site_title';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'key' => $wg_id . '_site_title',
				'label' => $settings[ $field . '_text' ],
				'name' => '_site_title',
				'type' => 'text',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'custom_site_title' => 1,
			) );
			$defaults[] = $wg_id . '_site_title';
		}
		if( $settings[ 'show_site_tagline' ] == 'default' ){
			$field = 'site_desc';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'key' => $wg_id . '_site_desc',
				'label' => $settings[ $field . '_text' ],
				'name' => '_site_desc',
				'type' => 'text',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'custom_site_desc' => 1,
			) );
			$defaults[] = $wg_id . '_site_desc';	
		}
		if( $settings[ 'show_site_logo' ] == 'default' ){
			$field = 'site_logo';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'key' => $wg_id . '_site_logo',
				'label' => $settings[ $field . '_text' ],
				'name' => '_site_logo',
				'type' => 'image',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'return_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'custom_site_logo' => 1,
			) );
			$defaults[] = $wg_id . '_site_logo';	
		}
		return $defaults;
	}
	

	public function options_arg( $form_args, $settings ){
		if( 'edit_options' == $settings[ 'main_action' ] ){
			$form_args[ 'post_id' ] = 'options';
			$form_args[ 'new_post' ] = false;
			$form_args[ 'post_title' ] = false;
			$form_args[ 'post_content' ] = false;
		}
		return $form_args;
	}
	
	
	public function __construct() {
		add_filter( 'acfef/form_args', [ $this, 'options_arg' ], 10, 2 );
		add_filter( 'acfef/default_fields', [ $this, 'options_fields' ], 10, 3 );
		add_filter( 'acfef/default_step_fields', [ $this, 'options_fields' ], 10, 3 );
		add_filter( 'acfef/step_form_args', [ $this, 'options_arg' ], 10, 2 );

	}
	
}

