<?php
namespace ACFFrontendForm\Module\Widgets;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module\ACFEF_Module;
use ACFFrontendForm\Module\Classes;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use ElementorPro\Modules\QueryControl\Module as Query_Module;

	
/**
 * Elementor ACF Frontend Form Widget.
 *
 * Elementor widget that inserts an ACF frontend form into the page.
 *
 * @since 1.0.0
 */
class ACF_Elementor_Form_Widget extends Widget_Base {

	public $form_defaults;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve acf ele form widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'acf_ele_form';
	}
	
	/**
	* Get widget action.
	*
	* Retrieve acf ele form widget action.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget action.
	*/
   public function get_form_defaults() {
	   return [ 
			'main_action' => 'all',
			'form_title' => __( 'Edit Post', 'acf-frontend-form-element' ),
			'submit' => __( 'Update', 'acf-frontend-form-element' ),
			'success_message' => __( 'Your post has been updated successfully.', 'acf-frontend-form-element' ),
		];
   }

	/**
	 * Get widget title.
	 *
	 * Retrieve acf ele form widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'ACF Frontend Form', 'acf-frontend-form-element' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve acf ele form widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-wpforms frontend-icon';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the acf ele form widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'acfef-widgets' ];
	}
	/**
	 * Register acf ele form widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		
		//get all field group choices
		$field_group_choices = acfef_get_acf_field_group_choices();
		$field_choices = acfef_get_acf_field_choices();
				
		$who_can_see = [ 
			'logged_in' => __( 'Only Logged In Users', 'acf-frontend-form-element' ),
			'logged_out' => __( 'Only Logged Out', 'acf-frontend-form-element'), 
			'all' => __( 'All Users', 'acf-frontend-form-element' ) 
		];
			
		//get all user role choices
		$user_roles = acfef_get_user_roles();   		    	

			if ( acfef()->is__premium_only() && $this->form_defaults[ 'main_action' ] == 'all' ) {
				$this->start_controls_section(
					'multi_step_section',
					[
						'label' => __( 'Multi Step', 'acf-frontend-form-element' ),
						'tab' => Controls_Manager::TAB_CONTENT,
					]
				);
		
				do_action( 'acfef/multi_step_settings', $this );
			
				$this->end_controls_section();		
			}			
		
		
		$this->start_controls_section(
			'actions_section',
			[
				'label' => __( 'Actions', 'acf-frontend-form-element' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->main_action_control(); 
		
		if ( ! acfef()->is__premium_only() || $this->form_defaults[ 'main_action' ] != 'all' ){
			$this->add_control(
				'multi',
				[
					'label' => __( 'Single', 'acf-frontend-form-element' ),
					'type' => \Elementor\Controls_Manager::HIDDEN,
					'default' => '',
				]
			);
			$this->add_control(
				'more_actions_promo',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( '<p><a target="_blank" href="https://www.frontendform.com/"><b>Go pro</b></a> to unlock more actions.</p>', 'acf-frontend-form-element' ),
					'content_classes' => 'acf-fields-note',
				]
			);
		}else{
			$this->add_control(
				'more_actions',
				[
					'label' => __( 'Submit Actions', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => true,
					'options' => [
						'email' => __( 'Emails', 'acf-frontend-form-element' ),
					],
				]
			);

		
		}
		if ( acfef()->is__premium_only() ){
			if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_active'] ) ){
				$this->add_control(
					'pay_action',
					[
						'label' => __( 'Payment', 'acf-frontend-form-element' ),
						'type' => Controls_Manager::SELECT,
						'default' => '',
						'options' => [
							'' => __( 'None', 'acf-frontend-form-element' ),
							'stripe' => __( 'Stripe (BETA)', 'acf-frontend-form-element' ),
						],
						'condition' => [
							'multi' => '',
						],
					]
				);
			}		
		}
		$this->add_control(
			'redirect',
			[
				'label' => __( 'Redirect After Submit', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'current',
				'options' => [
					'current'  => __( 'Reload Current Page/Post', 'acf-frontend-form-element' ),
					'custom_url' => __( 'Custom Url', 'acf-frontend-form-element' ),
					'post_url' => __( 'New Post Url', 'acf-frontend-form-element' ),
				],
			]
		);

		$this->add_control(
			'redirect_action',
			[
				'label' => __( 'After Reload', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'clear',
				'options' => [
					'clear'  => __( 'Clear Form', 'acf-frontend-form-element' ),
					'edit' => __( 'Edit Form', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'redirect' => 'current',
					'main_action' => [ 'new_post', 'new_user', 'new_product'  ],
				],
			]
		);
		
		$this->add_control(
			'custom_url',
			[
				'label' => __( 'Custom Url', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'Enter Url Here', 'acf-frontend-form-element' ),
				'show_external' => false,
				'condition' => [
					'redirect' => 'custom_url',
				],
				'dynamic' => [
					'active' => true,
				],				
			]
		);
		$this->add_control(
			'update_message',
			[
				'label' => __( 'Submit Message', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => $this->form_defaults[ 'success_message' ],
				'placeholder' => $this->form_defaults[ 'success_message' ],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		
		$this->end_controls_section();
		
		


		$this->start_controls_section(
			'fields_section',
			[
				'label' => __( 'Form', 'acf-frontend-form-element' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'multi' => '',
				],
			]
		);
		
		$this->add_control(
			'form_title',
			[
				'label' => __( 'Form Title', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,				
				'default' => $this->form_defaults[ 'form_title' ],
				'placeholder' => $this->form_defaults[ 'form_title' ],
				'dynamic' => [
					'active' => true,
				],				
			]
		);
		
			
		if( ! $field_group_choices ){
			
		$this->add_control(
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

		$this->add_control(
			'form_fields',
			[
				'label' => __( 'ACF Fields', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'field_groups',
				'options' => [
					'default' => __( 'Default Field Groups', 'acf-frontend-form-element' ),
					'field_groups' => __( 'Field Groups', 'acf-frontend-form-element' ),
					'fields' => __( 'Fields', 'acf-frontend-form-element' ),
				],
			]
		);	
		$this->add_control(
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
		$this->add_control(
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

		$this->add_control(
			'fields_select_exclude',
			[
				'label' => __( 'Exclude Specific Fields', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $field_choices,
				'condition' => [
					'form_fields' => 'field_groups',
				],
			]
		);				

		}


		$this->add_control(
			'submit_button_text',
			[
				'label' => __( 'Submit Button Text', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,				
				'default' => $this->form_defaults[ 'submit' ],
				'placeholder' => $this->form_defaults[ 'submit' ],
				'dynamic' => [
					'active' => true,
				],				
			]
		);
		
		$this->add_control(
			'submit_button_desc',
			[
				'label' => __( 'Submit Button Description', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'All done?', 'acf-frontend-form-element' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->main_action_controls_section();
		
		$this->start_controls_section(
			'permissions_section',
			[
				'label' => __( 'Permissions', 'acf-frontend-form-element' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
												
		$this->add_control(
			'who_can_see',
			[
				'label' => __( 'Who Can See This...', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'logged_in',
				'options' => $who_can_see,
			]
		);
			
		$this->add_control(
			'by_role',
			[
				'label' => __( 'Select By Role', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'default' => [
					'administrator',
				],
				'options' => $user_roles,
				'condition' => [
					'who_can_see' => 'logged_in',
				],
			]
		);
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){		
			$this->add_control(
				'user_id',
				[
					'label' => __( 'Select By User', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18, 12, 11', 'acf-frontend-form-element' ),
					'default' => get_current_user_id(),
					'description' => __( 'Enter the a comma-seperated list of user ids', 'acf-frontend-form-element' ),
					'condition' => [
						'who_can_see' => 'logged_in',
					],
				]
			);		
		}else{		
			$this->add_control(
				'user_id',
				[
					'label' => __( 'Select By User', 'acf-frontend-form-element' ),
					'label_block' => true,
					'type' => Query_Module::QUERY_CONTROL_ID,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_AUTHOR,
						'display' => 'detailed',
					],				
					'multiple' => true,
					'default' => [ 
						get_current_user_id(), 
					],
					'condition' => [
						'who_can_see' => 'logged_in',
					],
				]
			);
		}
		
		$this->add_control(
			'dynamic',
			[
				'label' => __( 'Dynamic Selection', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'description' => 'Use a dynamic acf user field that returns a user ID to filter the form for that user dynamically. You may also select the post\'s author',
				'options' => acfef_get_user_id_fields(),
				'condition' => [
					'who_can_see' => 'logged_in',
				],
			]
		);
		
		$this->add_control(
			'wp_uploader',
			[
				'label' => __( 'WP uploader', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => 'Whether to use the Wp uploader for file fields or just a basic input',
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'default' => 'true',
				'return_value' => 'true',
			]
		);
		
		$this->add_control(
			'media_privacy_note',
			[
				'label' => __( '<h3>Media Privacy</h3>', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( '<p>Click <a target="_blank" href="' . admin_url('options-media.php') . '">here</a> </p> to limit the files displayed in the media library to the user who uploaded them', 'acf-frontend-form-element' ),
				'content_classes' => 'media-privacy-note',
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'limit_submit_section',
			[
				'label' => __( 'Limit Submissions', 'acf-frontend-form-element' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		if ( ! acfef()->is__premium_only() ) {
			$this->add_control(
				'limit_submit_promo',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( '<p><a target="_blank" href="https://www.frontendform.com/"><b>Go pro</b></a> to unlock limit submissions.</p>', 'acf-frontend-form-element' ),
					'content_classes' => 'acf-fields-note',
				]
			);
		}
		
		
		do_action( 'acfef/limit_submit_settings', $this );
	
		$this->end_controls_section();

		
		$this->start_controls_section(
			'display_section',
			[
				'label' => __( 'Display Options', 'acf-frontend-form-element' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'show_in_modal',
			[
				'label' => __( 'Show in Modal', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
			]
		);
		$this->add_control(
			'modal_button_text',
			[
				'label' => __( 'Modal Button Text', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => $this->form_defaults[ 'form_title' ],
				'placeholder' => $this->form_defaults[ 'form_title' ],
				'condition' => [
					'show_in_modal' => 'true',
				],
				'dynamic' => [
					'active' => true,
				],		
			]
		);		
		$this->add_control(
			'modal_button_icon',
			[
				'label' => __( 'Modal Button Icon', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'show_in_modal' => 'true',
				],
			]
		);
		
		$this->add_control(
			'hide_field_labels',
			[
				'label' => __( 'Hide Field Labels', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'acf-frontend-form-element' ),
				'label_off' => __( 'Show','acf-frontend-form-element' ),
				'return_value' => 'true',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .acf-label' => 'display: none',
				]
			]
		);
		$this->add_control(
			'field_label_position',
			[
				'label' => __( 'Label Position', 'elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Above', 'elementor-pro' ),
					'left' => __( 'Inline', 'elementor-pro' ),
				],
				'default' => 'top',
				'condition' => [
					'show_field_labels' => 'true',
				],
			]
		);
		$this->add_control(
			'hide_mark_required',
			[
				'label' => __( 'Hide Required Mark', 'elementor-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'elementor-pro' ),
				'label_off' => __( 'Show', 'elementor-pro' ),
				'return_value' => 'true',
				'condition' => [
					'hide_field_labels!' => 'true',
				],
				'selectors' => [
					'{{WRAPPER}} .acf-required' => 'display: none',
				],
			]
		);
		
		$this->add_control(
			'field_instruction_position',
			[
				'label' => __( 'Instruction Position', 'elementor-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'label' => __( 'Above Field', 'elementor-pro' ),
					'field' => __( 'Below Field', 'elementor-pro' ),
				],
				'default' => 'label',
				'separator' => 'before',
			]
		);

		
		$this->add_control(
			'field_seperator',
			[
				'label' => __( 'Field Seperator', 'elementor-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'elementor-pro' ),
				'label_off' => __( 'Show', 'elementor-pro' ),
				'default' => 'true',
				'return_value' => 'true',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .acf-fields>.acf-field' => 'border-top: none',
					'{{WRAPPER}} .acf-field[data-width]+.acf-field[data-width]' => 'border-left: none',
				],
			]
		);			
		

		$this->end_controls_section();
			
		if ( ! acfef()->is__premium_only() ) {

		$this->start_controls_section(
			'style_promo_section',
			[
				'label' => __( 'Styles', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
				
		$this->add_control(
			'styles_promo',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( '<p><a target="_blank" href="https://www.frontendform.com/"><b>Go Pro</b></a> to unlock styles.</p>', 'acf-frontend-form-element' ),
				'content_classes' => 'acf-fields-note',
			]
		);
			
		$this->end_controls_section();
	
		}else{			
			do_action( 'acfef/style_tab_settings', $this );		
		}
		
	}

	public function main_action_control(){
		if( $this->form_defaults[ 'main_action' ] == 'all' ){
		
			$main_action_options = array(	
				'edit_post' => __( 'Edit Post', 'acf-frontend-form-element' ),
				'new_post' => __( 'New Post', 'acf-frontend-form-element' ),
				'edit_user' => __( 'Edit User', 'acf-frontend-form-element' ),
				'new_user' => __( 'New User', 'acf-frontend-form-element' ),
				'edit_term' => __( 'Edit Term', 'acf-frontend-form-element' ),			
			);
		
			
			if ( acfef()->is__premium_only() ) {
				$main_action_options[ 'edit_options' ] = __( 'Edit Options', 'acf-frontend-form-element' );
				if ( class_exists( 'woocommerce' ) ){
					$main_action_options[ 'edit_product' ] = __( 'Edit Product', 'acf-frontend-form-element' );
					$main_action_options[ 'new_product' ] = __( 'New Product', 'acf-frontend-form-element' );
				}
				$main_action_options[ 'none' ] = __( 'None', 'acf-frontend-form-element' );		
			}
				
			$main_action_options = apply_filters( 'acfef/main_actions', $main_action_options );
			
			$this->add_control(
				'main_action',
				[
					'label' => __( 'Main Action', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'edit_post',
					'options' => $main_action_options,
					'condition' => [
						'multi' => '',
					],
				]
			);
				
		}else{
			$this->add_control(
				'main_action',
				[
					'type' => Controls_Manager::HIDDEN,
					'default' => $this->form_defaults[ 'main_action' ],
				]
			);
		}
	}

	public function main_action_controls_section(){
		$module = ACFEF_Module::instance();
		$main_actions = $module->get_main_actions();
		$pay_actions = $module->get_pay_actions();
		$more_actions = $module->get_submit_actions();

		foreach( $main_actions as $name => $action ){
			if( strpos( $this->form_defaults[ 'main_action' ], $name ) !== false ||  $this->form_defaults[ 'main_action' ] == 'all' ){
				$action->register_settings_section( $this );
			}
		}		
		foreach( $pay_actions as $action ){
			$action->register_settings_section( $this );
		}	
		foreach( $more_actions as $action ){
			$action->register_settings_section( $this );
		}
	}

	
	public function show_widget( $wg_id, $settings ){		
		
		if( empty( $wg_id ) ){
			return true;
		}
		
		global $post;
		$active_user = wp_get_current_user();
		$display = false;
		
		if( 'all' == $settings[ 'who_can_see' ] ){
			$display = true;
		}elseif( 'logged_out' == $settings[ 'who_can_see' ] ){
			$display = ! is_user_logged_in();
		}else{
			if( ! is_user_logged_in() ){
				$display = false;
			}else{
				$by_role = $user_id = $dynamic = false;
				if( is_array( $settings[ 'by_role' ] ) ){
					if ( count( array_intersect( $settings[ 'by_role' ], (array) $active_user->roles ) ) == 0 ) {
						$by_role = false;
					}else{
						$by_role = true;
					}		
				}
				$user_ids = $settings[ 'user_id' ];
				if( is_string( $user_ids ) ){
					$user_ids = explode( ',', $user_ids );
				}
				if( is_array( $user_ids ) ){
					if( in_array( $active_user->ID, $user_ids ) ){
						$user_id = true;
					}else{
						$user_id = false;
					}
				}
				if( $settings[ 'dynamic' ] ){
					$current_user = '';
					if( '[author]' == $settings[ 'dynamic' ] ){
						$current_user = get_the_author_meta( 'ID' );
					}else{
						$current_user = get_field( $settings[ 'dynamic' ], get_the_ID() );	
					}
					if( $current_user == $active_user->ID ){
						$dynamic = true;
					}else{
						$dynamic = false;
					}
				}
				
				if( $by_role || $user_id || $dynamic ){
					$display = true;
				}else{
					$display = false;
				}
			}
		}	
		return $display;
	}

	/**
	 * Render acf ele form widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {				
		
		$wg_id = $this->get_id();
		global $post;
		$current_post_id = Plugin::get_current_post_id(); 
		$current_post = get_post( $post->ID );
		$active_user = wp_get_current_user();
		$settings = $this->get_settings_for_display();
		$defaults = $post_id = $new_post = $show_title = $show_content = $show_form = $display = $message = $fields = $field_groups = $fields_exclude = false;
		$wp_uploader = 'wp';
		$delete_button = '';
		
		$submit_button = '<div class="acfef-step-buttons">';
		if( $settings[ 'submit_button_desc' ] ){
			$submit_button .= '<p class="description"><span class="btn-dsc">' . $settings[ 'submit_button_desc' ] . '</span></p>';
		}
		$submit_button .= '<input type="submit" class="acfef-submit-button acf-button button button-primary" value="%s" /></div>';
		
		if( $settings[ 'save_progress_button' ]  && in_array( $settings[ 'new_post_status' ], [ 'publish', 'pending' ] ) ){
			$submit_button .= '<br><div class="acfef-draft-buttons">';
			if( $settings[ 'saved_draft_desc' ] ){
				$submit_button .= '<p class="description"><span class="btn-dsc">' . $settings[ 'saved_draft_desc' ] . '</span></p>';
			}
			$submit_button .= '<input type="submit" class="acfef-draft-button acf-button button button-secondary" value="' . $settings[ 'saved_draft_text' ] . '" name="acfef_save_draft" /></div>';
		} 
		

		$module = ACFEF_Module::instance();
		
		$before_fields = '';
		
		if( 'new_post' || 'new_product' == $settings[ 'main_action' ] ){
			$can_edit = false;
			$post_type = 'post';
			
			if( isset( $_GET[ 'post_id' ] ) && isset( $_GET[ 'form_id' ] ) && $wg_id == $_GET[ 'form_id' ] ){
				$edit_post = get_post( $_GET[ 'post_id' ] );

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
			if( 'new_post' == $settings[ 'main_action' ] ){
				$post_action = $module->get_main_actions( 'post' );
				$defaults = $post_action->render_form( $settings, $wg_id );
				$post_type = $settings[ 'new_post_type' ];
			}
			if ( acfef()->is__premium_only() ){
				if( 'new_product' == $settings[ 'main_action' ] && class_exists( 'woocommerce' ) ){
					$post_type = 'product';
					$product_action = $module->get_main_actions( 'product' );
					$defaults = $product_action->render_form( $settings, $wg_id );
				}
			}
			if( ! $can_edit ){
				$post_id = 'new_post';
				$new_post = array( 'post_type' => $post_type );
			}
		}
		if( 'edit_post' == $settings[ 'main_action' ] ){
			$post_id = $post->ID;
			if( $settings[ 'post_to_edit' ] == 'select_post' ){
				$post_id = $settings[ 'post_select' ];
			}
			if( $settings[ 'post_to_edit' ] == 'url_query' ){
				if( isset( $_GET[ $settings[ 'url_query_post' ] ] ) ){
					$post_id = $_GET[ $settings[ 'url_query_post' ] ];
				}
			}
			$post_action = $module->get_main_actions( 'post' );
			$defaults = $post_action->render_form( $settings, $wg_id );
		}
		if ( acfef()->is__premium_only() ){
			if ( class_exists( 'woocommerce' ) ){
				$product_action = $module->get_main_actions( 'product' );
				
				if( 'edit_product' == $settings[ 'main_action' ] && class_exists( 'woocommerce' ) ){
					$first_product = get_posts( array( 'posts_per_page' => 1, 'post_type' => 'product' ) );

					if( $first_product ){
						$post_id = $first_product[0]->ID;
					}else{
						$post_id = 'none';
					}

					if( $settings[ 'product_to_edit' ] == 'select_product' && $settings[ 'product_select' ] ){
						$post_id = $settings[ 'product_select' ];
					}else{
						if( $post->post_type == 'product' ){
							$post_id = $post->ID;		
						}
					}
					$defaults = $product_action->render_form( $settings, $wg_id );
				}
			
			
			}
		}
			   
		if( 'new_user' == $settings[ 'main_action' ] ){
			$user_action = $module->get_main_actions( 'user' );
			$defaults = $user_action->render_form( $settings, $wg_id );
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
		if( 'edit_user' == $settings[ 'main_action' ] ){
			$user_action = $module->get_main_actions( 'user' );
			$defaults = $user_action->render_form( $settings, $wg_id );
			$post_id = 'user_' . $active_user->ID;
			
			if( $settings[ 'user_to_edit' ] == 'select_user' ){
				$post_id = 'user_' . $settings[ 'user_select' ];
			}
			if( $settings[ 'user_to_edit' ] == 'url_query' ){
				if( isset( $_GET[ $settings[ 'url_query_user' ] ] ) ){
					$post_id = 'user_' . $_GET[ $settings[ 'url_query_user' ] ];
				}
			}
		}	
	
		if( 'edit_term' == $settings[ 'main_action' ] ){
			$term_name = get_queried_object()->name;
			$term_action = $module->get_main_actions( 'term' );
			$before_fields = $term_action->render_form( $settings, $term_name );
			if( $settings[ 'term_to_edit' ] == 'select_term' ){
				$post_id = 'term_' . $settings[ 'term_select' ];
				if( $settings[ 'term_select' ] ){
					$term = get_term( $settings[ 'term_select' ] );
					$term_name = $term->name;
					$before_fields = $term_action->render_form( $settings, $term_name );
				}
			}else{
				$post_id = 'term_' . get_queried_object()->term_id;
			} 
			
		}	
		
		$defaults = apply_filters( 'acfef/default_fields', $defaults, $settings, $wg_id );
		
		if( isset( $settings[ 'form_fields' ] ) ){
			if( 'default' == $settings[ 'form_fields' ] ){
				$default_groups = acf_get_field_groups( array( 'post_id' => $post_id ) );
				$fields = acfef_get_acf_field_choices( $default_groups ); 
			}
			if( 'field_groups' == $settings[ 'form_fields' ] ){
				$fields = acfef_get_acf_field_choices( $settings[ 'field_groups_select' ] );
			}

			if( 'fields' == $settings[ 'form_fields' ] ){
				$fields = $settings[ 'fields_select' ];
			}
		}
		
		$fields_exclude = $settings[ 'fields_select_exclude' ];
		if( $fields_exclude ){
			$fields = array_diff( $fields, $fields_exclude );
		}
		
		if( $defaults[ 'fields' ] ){
			if( $fields ){
				$fields = array_merge( $defaults[ 'fields' ], $fields );
			}else{
				$fields = $defaults[ 'fields' ];
			}
		}
		
		$display = $this->show_widget( $wg_id, $settings );

		$redirect_url = '';
		$redirect_query = 'updated=' . $wg_id . '_' . $current_post_id;
		
		if( 'post_url' == $settings[ 'redirect' ] ){
			$redirect_url = '%post_url%?' . $redirect_query;
		}else{
			if( 'custom_url' == $settings[ 'redirect' ] ){
				$redirect_url = $settings[ 'custom_url' ][ 'url' ];
			}else{				
				$redirect_url = home_url( add_query_arg( NULL, NULL ) );
			}
			
			$current_query = parse_url( $redirect_url, PHP_URL_QUERY );
			
			if ( ! $current_query ){ 
				$redirect_url .= '?' . $redirect_query;
			}else{
				if( strpos( $current_query, $redirect_query ) == false ){
					$redirect_url .= '&' . $redirect_query;
				}
			}
		}
		
		if( $settings[ 'show_delete_button' ] && 'edit_post' == $settings[ 'main_action' ] ){
			$confirm_message = $settings[ 'confirm_delete_message' ];
			$delete_button_icon = $settings['delete_button_icon'][ 'value' ];
			$delete_button_text = $settings[ 'delete_button_text' ];

			if ( acfef()->is__premium_only() ){
				if( 'edit_product' == $settings[ 'main_action' ] && class_exists( 'woocommerce' ) && $settings[ 'show_product_delete_button' ] ){
					$confirm_message = $settings[ 'confirm_delete_product_message' ];
					$delete_button_text = $settings[ 'delete_product_button_text' ];
					$delete_button_icon = $settings['delete_product_button_icon'][ 'value' ];

				}
			}

			$delete_button = ' 
			<form class="delete-form" action="" method="POST" >

			<input type="hidden" name="acfef_widget_id" value="' . $wg_id . '">
			<input type="hidden" name="acfef_post_id" value="' . $current_post_id . '">
			<input type="hidden" name="delete_post" value="' . $post->ID . '">

			<div class="acfef-delete-button-container">
			<button onclick="return confirm(\'' . $confirm_message . '\')" type="submit" class="button acfef-delete-button">';
			
			if( $delete_button_icon ){
				$delete_button .= '<i class="' . $delete_button_icon . '"></i> '; 
			}		
		
			$delete_button .= $delete_button_text . '</button>
				</div>
			</form>';
		}


		
		if( ! $settings[ 'wp_uploader' ] ){
			$wp_uploader = 'basic';
		} 
		
		$hidden_fields = '<input type="hidden" value="' . $wg_id . '" name="acfef_widget_id"/>
						  <input type="hidden" value="' . $current_post_id . '" name="acfef_post_id"/>
						  <input type="hidden" value="' . $settings[ 'update_message' ] . '" name="acfef_success"/>';
		
		if( ! $settings[ 'multi' ] ){
			$hidden_fields .= '<input type="hidden" value="' . $settings[ 'main_action' ] . '" name="acfef_main_action"/>';
		}
		
		if( $settings[ 'main_action' ] == 'edit_user' || $settings[ 'main_action' ] == 'new_user' ){
			$hidden_fields .= '<input class="password-strength" type="hidden" value="' . $settings['password_strength'] . '" name="required-strength"/>';
		}
		$form_class = '';
		if ( acfef()->is__premium_only() ){
			if( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_active'] ) ){
				if( $settings[ 'pay_action' ] == 'stripe' ){
					$module = ACFEF_Module::instance();
					$stripe_action = $module->get_pay_actions( 'stripe' );
					$hidden_fields .= $stripe_action->render_form( $settings );
					$form_class .= ' stripepurchase';
				}
			}
			if( isset( get_option( 'paypal_settings_option_name' )['acfef_paypal_active'] ) ){
				if( $settings[ 'pay_action' ] == 'paypal' ){
					$module = ACFEF_Module::instance();
					$paypal_action = $module->get_pay_actions( 'paypal' );
					$hidden_fields .= $paypal_action->render_form( $settings );
					$form_class .= ' paypalpurchase';
					wp_enqueue_script( 'paypal', ACFEF_URL . 'acf-ele-form/assets/js/paypal.js', 'jquery', '5.5.18' );
					
					if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
						wp_enqueue_style( 'paypal-editor', ACFEF_URL . 'acf-ele-form/assets/css/paypal-editor.css', [], '1.0.0' );	
					}else{
						wp_enqueue_style( 'paypal-front', ACFEF_URL . 'acf-ele-form/assets/css/paypal-front.css', [], '1.0.0' );	
					}
				}
			}
		}
		$fields = apply_filters( 'acfef/chosen_fields', $fields, $settings );
		
		$title_structure = false;
		if( $settings[ 'show_title' ] == 'structure' && strpos( $settings[ 'main_action' ], '_post' ) !== false ){
			$title_structure = $settings[ 'title_structure' ];
		}
		if ( acfef()->is__premium_only() ){
			if( class_exists( 'woocommerce' ) && $settings[ 'show_product_title' ] == 'structure' && strpos( $settings[ 'main_action' ], '_product' ) !== false ){
				$title_structure = $settings[ 'product_title_structure' ];
			}
		}
		$form_args = array( 'id' => 'acf-form-' . $wg_id . get_the_ID(), 'post_id' => $post_id, 'new_post' => $new_post, 'post_title' => $show_title, 'form_attributes' => array( 'class' => $form_class ), 'post_content' => $show_content, 'field_groups' => $field_groups, 'fields' => $fields, 'submit_value' => $settings[ 'submit_button_text' ], 'html_submit_button' => $submit_button, 'return' => $redirect_url, 'updated_message' => '', 'uploader' => $wp_uploader, 'html_before_fields' => $before_fields, 'html_after_fields' => $hidden_fields, 'instruction_placement' => $settings[ 'field_instruction_position' ], 'title_structure' => $title_structure );

		if( ! $settings[ 'hide_field_labels' ] ){
			$form_args[ 'label_placement' ] = $settings[ 'field_label_position' ];
		}

		$form_args = apply_filters( 'acfef/form_args', $form_args, $settings );
		$message = apply_filters( 'acfef/form_message', $message, $settings, $wg_id );
		
		
		if( $message ){
			$display = false;
			if( $message !== 'NOTHING' ){
				echo $message;
			}
		}
		
		$display = apply_filters( 'acfef/form_display', $display );
		
		if( $display ){

			if( $settings[ 'show_in_modal' ] !== 'true' ){
				if( $settings[ 'multi' ] == 'true' ){
					do_action( 'acfef/multi_form_render', $settings, $form_args, $this );
				}else{
					if( $settings[ 'form_title' ] ){
						echo '<h2 class="acfef-form-title">' . $settings[ 'form_title' ] . '</h2>';
					}
					acf_form( $form_args );
					echo $delete_button;
					if( $settings[ 'saved_drafts' ] ){
						echo $this->saved_drafts( $wg_id, $settings );
					}
				}

			}else{
			?>
				<button class="acfef-edit-button edit-button" onClick="openModal('<?php echo $wg_id . get_the_ID() ?>')" ><?php 
				if( $settings['modal_button_icon'][ 'value' ] ){
					\Elementor\Icons_Manager::render_icon( $settings['modal_button_icon'], [ 'aria-hidden' => 'true' ] );  
					echo ' '; 
				}
				echo $settings[ 'modal_button_text' ];  
				?>
				</button>

				<!-- The Modal -->
					<div id="modal_<?php echo $wg_id . get_the_ID() ?>" class="modal edit-modal hide">

					  <!-- Modal content -->
					  <div class="modal-content"> 
						  <div class="modal-inner"> 
							<span onClick="closeModal('<?php echo $wg_id . get_the_ID() ?>')" class="acf-icon -cancel close"></span>
								<div class="form-container">
									
								<?php 
								if( $settings[ 'multi' ] == 'true' ){
									do_action( 'acfef/multi_form_render', $settings, $form_args, $this );
								}else{
									if( $settings[ 'form_title' ] ){
										echo '<h2 class="acfef-form-title">' . $settings[ 'form_title' ] . '</h2>';
									}  
									acf_form( $form_args ); 
									echo $delete_button;
									if( $settings[ 'main_action' ] == 'new_post' && $settings[ 'saved_drafts' ] ){
										echo $this->saved_drafts( $wg_id, $settings );
									}
								}

								?>
								</div>
						  </div>
					  </div>
					</div>
			<?php
			}
			if ( acfef()->is__premium_only() ) {
				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && $settings[ 'style_messages' ] ) {
					echo '<div class="acf-notice -success acf-sucess-message -dismiss"><p>' . $settings[ 'update_message' ] . '</p><a href="#" class="acf-notice-dismiss acf-icon -cancel"></a></div>';
					echo '<div class="acf-notice -error acf-error-message -dismiss"><p>' . __( 'Validation failed.', 'acf-frontend-form-element' ) . '</p><a href="#" class="acf-notice-dismiss acf-icon -cancel"></a></div>';
					echo '<div class="acf-notice -limit acfef-limit-message"><p>' . __( 'Limit Reached.', 'acf-frontend-form-element' ) . '</p></div>';
				}
			}
			
			if( isset( $_GET[ 'modal' ] ) && isset( $_GET[ 'step' ] ) && $_GET[ 'step' ] > 0 && $settings[ 'show_in_modal' ] && $settings[ 'multi' ] == 'true' ){
					echo '<script>
						jQuery(function() {
							jQuery( "div#modal_' . $_GET[ 'modal' ] . get_the_ID() . '" ).addClass("show");
						});
					</script>';
			}
			
		}

	}

	public function saved_drafts( $wg_id, $settings ){
		global $wp;
		$current_url = home_url( $wp->request );
		$query_args = $_GET;
		$full_link = add_query_arg( $query_args, $current_url );
		$new_link = remove_query_arg( [ 'post_id', 'form_id', 'updated' ], $full_link );
		
		$submits = '<br>';
		$drafts_args = array(
			'posts_per_page' => -1,
			'post_status' => 'draft',	
			'post_type' => 'any',
			'author' => get_current_user_id(),
			'meta_query'  => array(
				array(
					'value'   => $wg_id,
					'compare' => '==',
					'key'     => 'acfef_form_source',
				),
			)
		);
		$drafts_select_start = '<div class"drafts"><p class="drafts-heading">' . $settings[ 'saved_drafts_label' ] . '</p><select id="acfef-form-drafts" ><option selected value="' . $new_link . '">' . $settings[ 'saved_drafts_new' ] . '</option>';
		$drafts_select_end = '</select></div>';
		
		$form_submits = get_posts( $drafts_args );
		if( $form_submits ){
			$submits .= $drafts_select_start;

			foreach( $form_submits as $submit ){
				$post_time = get_the_time('F j, Y, h:i:sa', $submit->ID);
				$selected = '';
				if( isset( $_GET[ 'post_id' ] ) && isset( $_GET[ 'form_id' ] ) && $submit->ID == $_GET[ 'post_id' ] && $wg_id == $_GET[ 'form_id' ] ){
					$selected = 'selected';
				}
				$query_args[ 'post_id' ] = $submit->ID;
				$query_args[ 'form_id' ] = $wg_id;
				if( $settings[ 'show_in_modal' ] ){
					$query_args[ 'modal' ] = $wg_id;
				}
				$draft_link = add_query_arg( $query_args, $current_url );
				$new_link = remove_query_arg( 'updated', $draft_link );
				$submits .= '<option '. $selected .' value="' . $new_link . '" class="form_submit">' . $submit->post_title . ' (' . $post_time . ')' . '</option>';
			}
			$submits .= $drafts_select_end;
		}elseif( \Elementor\Plugin::$instance->editor->is_edit_mode() ){
			$submits .= $drafts_select_start;
			for( $x = 1; $x < 4; $x++ ){
				$submits .= '<option class="form_submit">Draft ' . $x . '(' . date('F j, Y, h:i:sa') . ')</option>';
			}
			$submits .= $drafts_select_end;		
		}
		return $submits;

	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	
		$this->form_defaults = $this->get_form_defaults();
     }
	
}