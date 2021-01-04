<?php
namespace ACFFrontendForm\Module\Classes;

use ACFFrontendForm\Module\ACFEF_Module;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class MultiStep{

	public function multi_step_settings( $widget ){
		
		$field_group_choices = acfef_get_acf_field_group_choices();
		$field_choices = acfef_get_acf_field_choices();
		$post_type_choices = acfef_get_post_type_choices();    
		
		
		$main_action_options = array(	
			'continue' => __( 'Continue', 'acf-frontend-form-element' ),
			'edit_post' => __( 'Edit Post', 'acf-frontend-form-element' ),
			'new_post' => __( 'New Post', 'acf-frontend-form-element' ),
			'edit_user' => __( 'Edit User', 'acf-frontend-form-element' ),
			'new_user' => __( 'New User', 'acf-frontend-form-element' ),
			'new_user' => __( 'New User', 'acf-frontend-form-element' ),
			'edit_options' => __( 'Edit Options', 'acf-frontend-form-element' ),
			'none' => __( 'None', 'acf-frontend-form-element' ),
		);
			
		
		$widget->add_control(
			'multi',
			[
				'label' => __( 'Multi Step Form?', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Multi', 'acf-frontend-form-element' ),
				'label_off' => __( 'Single','acf-frontend-form-element' ),
				'return_value' => 'true',
			]
		);
		
		$widget->add_control(
			'steps_display',
			[
				'label' => __( 'Steps Display', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => [ 
					'tabs',
				],
				'multiple' => 'true',
				'options' => [
					'tabs' => __( 'Tabs', 'acf-frontend-form-element' ),
					'counter' => __( 'Counter', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'multi' => 'true',	
				],				
			]
		);		
		$widget->add_control(
			'responsive_description',
			[
				'raw' => __( 'Responsive visibility will take effect only on preview or live page, and not while editing in Elementor.', 'elementor' ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);
		$widget->add_control(
			'steps_tabs_display',
			[
				'label' => __( 'Step Tabs Display', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => 'true',				
				'default' => [
					'desktop', 'tablet', 'phone',
				],
				'multiple' => 'true',
				'options' => [
					'desktop' => __( 'Desktop', 'acf-frontend-form-element' ),
					'tablet' => __( 'Tablet', 'acf-frontend-form-element' ),
					'phone' => __( 'Mobile', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'multi' => 'true',	
					'steps_display' => 'tabs'	
				],				
			]
		);		
		$widget->add_control(
			'tabs_align',
			[
				'label' => __( 'Tabs Position', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Top', 'elementor' ),
					'vertical' => __( 'Side', 'elementor' ),
				],
				'prefix_class' => 'elementor-tabs-view-',
				'condition' => [
					'multi' => 'true',
					'steps_display' => 'tabs'	
				],						
			]
		);
		
		$widget->add_control(
			'steps_counter_display',
			[
				'label' => __( 'Step Counter Display', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => 'true',
				'default' => [
					'desktop', 'tablet', 'phone',
				],
				'multiple' => 'true',
				'options' => [
					'desktop' => __( 'Desktop', 'acf-frontend-form-element' ),
					'tablet' => __( 'Tablet', 'acf-frontend-form-element' ),
					'phone' => __( 'Mobile', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'multi' => 'true',
					'steps_display' => 'counter'	
				],				
			]
		);		
		
		$widget->add_control(
			'step_number',
			[
				'label' => __( 'Step Number in Tabs', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'show', 'acf-frontend-form-element' ),
				'label_off' => __( 'hide','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'multi' => 'true',	
					'steps_display' => 'tabs'	
				],
			]
		);	
		
		$widget->add_control(
			'tab_links',
			[
				'label' => __( 'Link to Step in Tabs', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'multi' => 'true',
					'steps_display' => 'tabs',	
				],
			]
		);	
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'main_action',
			[
				'label' => __( 'Step Action', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'edit_post',
				'options' => $main_action_options,
			]
		);
		$repeater->add_control(
			'emails_to_send',
			[
				'label' => __( 'Step Emails', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'description' => __( 'A comma seperated list of email names to send on completing this step.', 'acf-frontend-form-element' ),				
			]
		);
		$repeater->start_controls_tabs( 'tabs_step_settings' );

		$repeater->start_controls_tab(
			'tab_step_fields',
			[
				'label' => __( 'Fields', 'elementor-pro' ),
			]
		);
		
		$repeater->add_control(
			'form_title',
			[
				'label' => __( 'Step Title', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Edit Post', 'acf-frontend-form-element' ),
				'placeholder' => __( 'Edit Post', 'acf-frontend-form-element' ),
				'dynamic' => [
					'active' => true,
				],					
			]
		);
		
			
		if( ! $field_group_choices ){
			
		$repeater->add_control(
			'acf_fields_note',
			[
				'label' => __( 'ACF Fields', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( '<p>If you need to show custom fields in this form, please create them <a target="_blank" href="' . admin_url('post-new.php?post_type=acf-field-group') . '">here</a>. Then just reload this page.</p>', 'acf-frontend-form-element' ),
				'content_classes' => 'acf-fields-note',
			]
		);
			
		}else{
			
		do_action( 'acfef/add_field_settings', $this );
			
		$repeater->add_control(
			'form_fields',
			[
				'label' => __( 'ACF Fields', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'field_groups',
				'options' => [
					'field_groups' => __( 'Field Groups', 'acf-frontend-form-element' ),
					'fields' => __( 'Fields', 'acf-frontend-form-element' ),
				],
			]
		);
				
		$repeater->add_control(
			'field_groups_select',
			[
				'label' => __( 'ACF Field Groups', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $field_group_choices,
				'condition' => [
					'form_fields' => 'field_groups',
				],
			]
		);
		$repeater->add_control(
			'fields_select',
			[
				'label' => __( 'ACF Fields', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $field_choices,
				'condition' => [
					'form_fields' => 'fields',
				],
			]
		);
		
		}

		$repeater->add_control(
			'prev_button_text',
			[
				'label' => __( 'Previous Button', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Previous', 'acf-frontend-form-element' ),
				'placeholder' => __( 'Previous', 'acf-frontend-form-element' ),
				'dynamic' => [
					'active' => true,
				],					
			]
		);
		$repeater->add_control(
			'next_button_text',
			[
				'label' => __( 'Next Button', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Next', 'acf-frontend-form-element' ),
				'placeholder' => __( 'Next', 'acf-frontend-form-element' ),
				'dynamic' => [
					'active' => true,
				],					
			]
		);		

		$module = ACFEF_Module::instance();
		$post_action = $module->get_main_actions( 'post' );
		$user_action = $module->get_main_actions( 'user' );
		$options_action = $module->get_main_actions( 'options' );
		
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_step_post',
			[
				'label' => __( 'Post', 'elementor-pro' ),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'main_action',
							'operator' => '==',
							'value' => 'edit_post',
						],
						[
							'name' => 'main_action',
							'operator' => '==',
							'value' => 'new_post',
						],
					],
				],
			]
		);
	
		$repeater->add_control(
			'post_settings',
			[
				'label' => __( 'Post Settings', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$repeater->add_control(
			'new_post_status',
			[
				'label' => __( 'Post Status', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'publish',
				'options' => [
					'draft' => __( 'Draft', 'acf-frontend-form-element' ),
					'private' => __( 'Private', 'acf-frontend-form-element' ),
					'pending' => __( 'Pending Review', 'acf-frontend-form-element' ),
					'publish'  => __( 'Published', 'acf-frontend-form-element' ),
				],
			]
		);		
		
		$post_action->edit_post_settings( $repeater );
		$post_action->new_post_settings( $repeater );
	
		$post_action->register_fields_settings( $repeater );
		
		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_step_user',
			[
				'label' => __( 'User', 'elementor-pro' ),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'main_action',
							'operator' => '==',
							'value' => 'edit_user',
						],
						[
							'name' => 'main_action',
							'operator' => '==',
							'value' => 'new_user',
						],
					],
				],
			]
		);
		
		$repeater->add_control(
			'user_settings',
			[
				'label' => __( 'User Settings', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

				
		$user_action->edit_user_settings( $repeater );
		$user_action->new_user_settings( $repeater );
		
		$user_action->register_fields_settings( $repeater );

		
		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_step_options',
			[
				'label' => __( 'Options', 'elementor-pro' ),
				'condition' => [
					'main_action' => 'edit_options'
				],
			]
		);
				
		$options_action->register_fields_settings( $repeater );

		
		$repeater->end_controls_tab();
		
		$repeater->end_controls_tabs();

		
		$widget->add_control(
			'form_steps',
			[
				'label' => __( 'Form Steps', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'rule_name' => __( 'New Post', 'acf-frontend-form-element' ),
					],
				],
				'title_field' => '{{{ form_title }}}',
				'prevent_empty' => true,
				'condition' => [
					'multi' => 'true'	
				],
				'separator' => 'before',
			]
		);

	}

	public function multi_form_rendering( $settings, $form_args, $widget ){
		$wg_id = $widget->get_id();

		$editor = \Elementor\Plugin::$instance->editor->is_edit_mode();
		$current_post = get_post();
		$active_user = wp_get_current_user();
		$tabs_display = $settings[ 'steps_tabs_display' ];
		$counter_display = $settings[ 'steps_counter_display' ];
		$screens = [
					'desktop' => __( 'Desktop', 'acf-frontend-form-element' ),
					'tablet' => __( 'Tablet', 'acf-frontend-form-element' ),
					'phone' => __( 'Mobile', 'acf-frontend-form-element' ),
					];
		$is_step = isset( $_GET[ 'step' ] );
		$module = ACFEF_Module::instance();
		$post_action = $module->get_main_actions( 'post' );
		$user_action = $module->get_main_actions( 'user' );
		$options_action = $module->get_main_actions( 'options' );
		$modal = '';
		$id_int = substr( $widget->get_id_int(), 0, 3 );

		
		global $wp;
		$current_url = home_url( $wp->request );
		$query_args = $_GET;
		$full_link = add_query_arg( $query_args, $current_url );
		
		if( $settings[ 'show_in_modal' ] ){
			$modal = '<input type="hidden" value="' . $wg_id . '" name="acfef_modal_id"/>';
			$query_args[ 'modal' ] = $wg_id;
		}
	
		if( isset( $_GET[ 'post_id' ] ) ){
			$query_args[ 'modal' ] = $_GET[ 'post_id' ];
		}
		
		$tabs_responsive = '';	
		if( $tabs_display ){
			foreach( $screens as $screen => $label ){
				if( ! in_array( $screen, $tabs_display ) ){
					$tabs_responsive .= 'elementor-hidden-' . $screen . ' ';
				}
			}
		}
		
		$counter_responsive = '';
		if( $counter_display ){
			foreach( $screens as $screen => $label ){
				if( ! in_array( $screen, $counter_display ) ){
					$counter_responsive .= 'elementor-hidden-' . $screen . ' ';
				}
			}
		}
		
		$total_steps = count( $settings[ 'form_steps' ] );
		
		echo '<div class="elementor-tabs">
		<div class="' . $tabs_responsive . ' form-tabs elementor-tabs-wrapper">';
		foreach( $settings[ 'form_steps' ] as $index => $form_step ){
			$active = $step_num = $step_link = '';
			   
			$step_count = $index+1;
			
			if( $settings[ 'step_number' ] ){
				$step_num = $step_count . '. ';
			}
			
			if( in_array( 'tabs', $settings[ 'steps_display' ] ) ){
				if( ( $is_step && $_GET[ 'step' ] - 1 == $index ) || ( $index == 0 && ! $is_step ) ){
					$active = 'active';
				}

				if( $settings[ 'tab_links' ] && $active == '' ){
					$query_args[ 'step' ] = $step_count;
					$step_link = 'href="' . add_query_arg( $query_args, $current_url ) . '"';
				}
					
				$change_tabs = '';
				if( $editor ){
					$change_tabs = ' onclick="changeTab(' . $step_count . ')"';
					
				}
					
				echo '<a id="elementor-tab-title-' . $id_int . $step_count . '" class="form-tab ' . $active . ' step-' . $step_count . '" ' . $step_link . $change_tabs . '><p class="step-name">' . $step_num . $form_step[ 'form_title' ] . '</p></a>';
			}
			
		}
		echo '</div>';
	
		
		echo '<div class="form-steps elementor-tabs-content-wrapper">';
		
		foreach( $settings[ 'form_steps' ] as $index => $form_step ){
			$defaults = $field_groups = $fields = $post_id = $new_post = $show_title = $show_content = $display = $can_edit = false;
			$active_user = wp_get_current_user();

			$step_count = $index+1;
		
			$step_action = $form_step[ 'main_action' ];
			
			if( 'continue' == $step_action ){
				if( $index == 0 ){
					$step_action = 'edit_post';
				}else{
					$counter = $index;
					while( $counter > 0 && $step_action == 'continue' ) {
						$step_action = $settings[ 'form_steps' ][ $counter-1 ][ 'main_action' ];
						$counter--;
					}
				}
			}
			
			if( 'new_post' == $step_action ){
				$defaults = $post_action->render_form( $form_step, $wg_id . $step_count );
				$can_edit = false;

				if( isset( $_GET[ 'post_id' ] ) && isset( $_GET[ 'form_id' ] ) && $wg_id == $_GET[ 'form_id' ] ){		$edit_post = get_post( $_GET[ 'post_id' ] );
					
					if( is_user_logged_in() ){
						if( is_array( $active_user->roles ) ){
							if ( in_array( 'administrator', $active_user->roles ) ) {
								$can_edit = true;
							}else{
								if( $active_user->ID == $edit_post->post_author ){
									$can_edit = true;
								}
							}
						}
					}
					
					if( $can_edit ){
						$post_id = $_GET[ 'post_id' ];
					}
				}
				if( ! $can_edit ){
					$post_id = 'new_post';
					$new_post = array( 'post_type' => $form_step[ 'new_post_type' ] );
				}
			}
			if( 'edit_post' == $step_action ){
				$defaults = $post_action->render_form( $form_step, $wg_id . $step_count );
				$post_id = false;	
				
				if( $form_step[ 'post_to_edit' ] == 'select_post' ){
					$post_id = $form_step[ 'post_select' ];
				}
				if( $form_step[ 'post_to_edit' ] == 'url_query' ){
					if( isset( $_GET[ $form_step[ 'url_query_post' ] ] ) ){
						$post_id = $_GET[ $form_step[ 'url_query_post' ] ];
					}
				}					
			}

			if( 'new_user' == $step_action ){
				$defaults = $user_action->render_form( $form_step, $wg_id . $step_count );
				$can_edit = false;

				if( isset( $_GET[ 'user_id' ] ) && isset( $_GET[ 'form_id' ] ) && $wg_id == $_GET[ 'form_id' ] ){
					
					if( is_user_logged_in() ){
						if( is_array( $active_user->roles ) ){
							if ( in_array( 'administrator', $active_user->roles ) ) {
								$can_edit = true;
							}else{
								if( $active_user->ID == $_GET[ 'user_id' ] ){
									$can_edit = true;
								}
							}
						}
					}
					
					if( $can_edit ){
						$post_id = 'user_' . $_GET[ 'user_id' ];
					}
				}
				if( ! $can_edit ){
					$post_id = 'user_0';
				}
			}
			if( 'edit_user' == $step_action ){
				$defaults = $user_action->render_form( $form_step, $wg_id . $step_count );
				$post_id = 'user_' . $active_user->ID;		
				
				if( $form_step[ 'user_to_edit' ] == 'select_user' ){
					$post_id = 'user_' . $form_step[ 'user_select' ];
				}
				if( $form_step[ 'user_to_edit' ] == 'url_query' ){
					if( isset( $_GET[ $form_step[ 'url_query_user' ] ] ) ){
						$post_id = 'user_' . $_GET[ $form_step[ 'url_query_user' ] ];
					}
				}					
			}	


			if( 'field_groups' == $form_step[ 'form_fields' ] ){
				$field_groups = false;
				$fields = acfef_get_acf_field_choices( $form_step[ 'field_groups_select' ] );
			}

			if( 'fields' == $form_step[ 'form_fields' ] ){
				$fields = $form_step[ 'fields_select' ];
			}
			

			$defaults = apply_filters( 'acfef/default_step_fields', $defaults, $form_step, $wg_id . $step_count );

			if( ! empty( $defaults ) ){
				if( ! empty( $defaults[ 'fields' ] ) ){
					if( $fields ){
						$fields = array_merge( $defaults[ 'fields' ], $fields );
					}else{
						$fields = $defaults[ 'fields' ];
					}
				}
			}
			
			$next = $index + 2;
			$current = $index + 1;
			
			$query_args[ 'step' ] = $next;
			$redirect_url = add_query_arg( $query_args, $full_link );
			if( $index + 1 == count( $settings[ 'form_steps' ] ) ){
				$remove_query_args = [ 'modal', 'step' ];
				$redirect_url = remove_query_arg( $remove_query_args, $form_args[ 'return' ] );
			}
			
			$prev_button = $multi_buttons = '';

			
			if( $index > 0 && $form_step[ 'prev_button_text' ] ){
				$query_args[ 'step' ] = $index;
				$prev_button = '<input type="hidden" name="prev_step_link" value="' . add_query_arg( $query_args, $current_url ) . '"/>';
				$prev_button .= '<input type="submit" name="prev_step" class="acfef-prev-button acfef-submit-button acf-button button button-primary" value="' . $form_step[ 'prev_button_text' ] . '"/>';
				$multi_buttons = 'acfef-multi-buttons-align';
			}
			
			$next_button = '<input type="submit" class="acfef-submit-button acf-button button button-primary" value="%s" />';
			
			$submit_button =  '<div class="acfef-step-buttons ' . $multi_buttons . '">' . $prev_button . $next_button . '</div>';
			
			$hidden_fields = '<input type="hidden" value="' . $index . '" name="acfef_step_index"/>' . $modal . $form_args[ 'html_after_fields' ] . '<input type="hidden" value="' . $step_action . '" name="acfef_step_action"/>';

			
			if( $form_step[ 'save_progress_button' ] && in_array( $form_step[ 'new_post_status' ], [ 'publish', 'pending' ] ) ){
				$submit_button .= '<br><div class="acfef-draft-buttons">';
				if( $form_step[ 'saved_draft_desc' ] ){
					$submit_button .= '<p class="description"><span class="btn-dsc">' . $form_step[ 'saved_draft_desc' ] . '</span></p>';
				}
				$submit_button .= '<input type="submit" class="acfef-draft-button acf-button button button-secondary" value="' . $form_step[ 'saved_draft_text' ] . '" name="acfef_save_draft" /></div>';
			} 
			
			$title_structure = false;
			if( $form_step[ 'show_title' ] == 'structure' && ( $form_step[ 'main_action' ] == 'edit_post' || 'new_post' ) ){
				$title_structure = $form_step[ 'title_structure' ];
			}
			/*if( $form_step[ 'show_product_title' ] == 'structure' && $form_step[ 'main_action' ] == 'edit_product' ){
				$title_structure = $form_step[ 'product_title_structure' ];
			}*/
			
			$step_form_args = array( 'post_id' => $post_id, 'new_post' => $new_post, 'post_title' => $show_title, 'post_content' => $show_content, 'field_groups' => false, 'fields' => $fields, 'submit_value' => $form_step[ 'next_button_text' ], 'html_submit_button' => $submit_button, 'return' => $redirect_url, 'html_after_fields' => $hidden_fields, 'updated_message' => '', 'uploader' => $form_args[ 'uploader' ], 'html_before_fields' => $form_args[ 'html_before_fields' ], 'instruction_placement' => $form_args[ 'instruction_placement' ], 'label_placement' => $form_args[ 'label_placement' ], 'title_structure' => $title_structure );
			
			$step_form_args = apply_filters( 'acfef/step_form_args', $step_form_args, $form_step );

			if( ( $is_step && $_GET[ 'step' ] - 1 == $index ) || ( $index == 0 && ! $is_step ) || ( $editor ) ){
				$step_active = '';
				if( $editor ){ 
				   if( $index == 0 ){
						$step_active = ' active';
					}else{
						$step_active = ' step-hidden';
					}
				}
				
				echo '<div class="multi-step step-' . $step_count . $step_active . '">';
				
				if( in_array( 'counter', $settings[ 'steps_display' ] ) ){
					echo '<p class="' . $counter_responsive . 'step-count">Step ' . $step_count . '/' . $total_steps . '</p>';
				}
					
				if( $form_step[ 'form_title' ] ){
					echo '<h2 class="acfef-form-title">' . $form_step[ 'form_title' ] . '</h2>';
				}  
				acf_form( $step_form_args );
				if( $form_step[ 'saved_drafts' ] && $form_step[ 'main_action' ] == 'new_post' ){
					$form_step[ 'show_in_modal' ] = $settings[ 'show_in_modal' ];
					echo $widget->saved_drafts( $wg_id, $form_step );
				}
				
				echo '</div>';
			}
			
		}
		echo '</div></div>';
	
	}


	public function __construct() {
		add_action( 'acfef/multi_step_settings', [ $this, 'multi_step_settings' ] );
		add_action( 'acfef/multi_form_render', [ $this, 'multi_form_rendering' ], 10, 3 );
	}

}

new MultiStep();
