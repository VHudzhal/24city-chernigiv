<?php
namespace ACFFrontendForm\Module\Classes;

use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as Query_Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class LimitSubmit{

	public function submit_limit_setting( $widget ){

		$user_roles = acfef_get_user_roles();

				
		$widget->add_control(
			'limit_reached',
			[
				'label' => __( 'Limit Reached Message', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'show_message',
				'options' => [
					'show_message'  => __( 'Limit Message', 'acf-frontend-form-element' ),
					'custom_content' => __( 'Custom Content', 'acf-frontend-form-element' ),
					'show_nothing' => __( 'Nothing', 'acf-frontend-form-element' ),
				],
			]
		);		
		$widget->add_control(
			'limit_submit_message',
			[
				'label' => __( 'Reached Limit Message', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'rows' => 4,
				'default' => __( 'You have already submitted this form the maximum amount of times that you are allowed', 'acf-frontend-form-element' ),
				'placeholder' => __( 'you have already submitted this form the maximum amount of times that you are allowed', 'acf-frontend-form-element' ),
				'condition' => [
					'limit_reached' => 'show_message',
				]
			]
		);
		$widget->add_control(
			 'limit_submit_content',
			[
				'label' => __( 'Reached Limit Content', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => 'You have already submitted this form the maximum amount of times that you are allowed',
				'label_block' => true,
				'render_type' => 'none',
				'condition' => [
					'limit_reached' => 'custom_content',
				]
			]
		);

		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'rule_name', [
				'label' => __( 'Rule Name', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Rule Name' , 'acf-frontend-form-element' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'allowed_submits',
			[
				'label' => __( 'Allowed Submissions', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
			]
		);

		$repeater->add_control(
			'limit_to_everyone',
			[
				'label' => __( 'Limit For Everyone', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
			]
		);
		
		$repeater->add_control(
			'limit_by_role',
			[
				'label' => __( 'Limit By Role', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'default' => 'subscriber',
				'options' => $user_roles,
				'condition' => [
					'limit_to_everyone' => ''
				]
			]
		);
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){		
			$repeater->add_control(
				'limit_by_user',
				[
					'label' => __( 'Limit By User', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18', 'acf-frontend-form-element' ),
					'description' => __( 'Enter a commma seperated list of user ids', 'acf-frontend-form-element' ),
					'condition' => [
						'limit_to_everyone' => ''
					]
				]
			);		
		}else{			
			$repeater->add_control(
				'limit_by_user',
				[
					'label' => __( 'Limit By User', 'acf-frontend-form-element' ),
					'type' => Query_Module::QUERY_CONTROL_ID,
					'label_block' => true,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_AUTHOR,
						'display' => 'detailed',
					],				
					'multiple' => true,
					'condition' => [
						'limit_to_everyone' => ''
					]
				]
			);
		}

		$widget->add_control(
			'limiting_rules',
			[
				'label' => __( 'Add Limiting Rules', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'rule_name' => __( 'Subscribers', 'acf-frontend-form-element' ),
					],
				],
				'title_field' => '{{{ rule_name }}}',
			]
		);

	}

	public function limit_form_rendering( $message, $settings, $wg_id ){
		$active_user = wp_get_current_user();
		$submitted = get_user_meta( $active_user->ID, $wg_id . '_submitted', true );

		if( empty( $submitted ) ){
			return false;
		}

		$submits = $message = '';

		$limit_rules = $settings[ 'limiting_rules' ];

		if( $limit_rules ){
			foreach( $limit_rules as $rule ){
				$roles = $rule[ 'limit_by_role' ];
				$users = $rule[ 'limit_by_user' ];
				if( is_string( $users ) ){
					$users = explode( ',', $users );
				}
				$in_rule = false;

				if( $rule[ 'limit_to_everyone' ] ){
					$in_rule = true;
				}
				if( is_array( $roles ) ){	
					if ( count( array_intersect( $roles, (array) $active_user->roles ) ) == 0 ) {
						$in_rule = false;
					}else{
						$in_rule = true;
					}
				}
				if( is_array( $users ) ){	
					if( in_array( $active_user->ID, $users ) ){
						$in_rule = true;
					}
				}

				if( $in_rule === true ){
					$submits = (int)$rule[ 'allowed_submits' ];
					if( $settings[ 'limit_reached' ] == 'show_message' ){
						$message = '<div class="acf-notice -limit acfef-limit-message"><p>' . $settings[ 'limit_submit_message' ] . '</p></div>';
					}
					elseif( $settings[ 'limit_reached' ] == 'custom_content' ){
						$message = $settings[ 'limit_submit_content' ];
					}
					else{
						$message = 'NOTHING';
					}

				}
			}
		}

		if( $submits == '' || $submits - (int)$submitted > 0 ){
			return false;
		}else{
			return $message;
		}
	}

	public function submit_record( $settings, $wg_id ){
		$active_user = wp_get_current_user();
		$submitted = get_user_meta( $active_user->ID, $wg_id . '_submitted', true );

		if( ! empty( $submitted ) ){
			update_user_meta( $active_user->ID, $wg_id . '_submitted', $submitted + 1 );
		}else{
			update_user_meta( $active_user->ID, $wg_id . '_submitted', 1 );
		}		
	}


	public function __construct() {
		add_action( 'acfef/limit_submit_settings', [ $this, 'submit_limit_setting' ] );
		add_filter( 'acfef/form_message', [ $this, 'limit_form_rendering' ], 10, 3 );
		add_action( 'acfef/on_submit' , [ $this, 'submit_record' ], 10, 2 );

	}

}

new LimitSubmit();
