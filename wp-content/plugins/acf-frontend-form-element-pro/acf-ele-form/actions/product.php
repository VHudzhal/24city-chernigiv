<?php
namespace ACFFrontendForm\Module\Actions;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module\ACFEF_Module;
use ACFFrontendForm\Module\Classes\ActionBase;
use ACFFrontendForm\Module\Widgets;
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as Query_Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EditProduct extends ActionBase {
	
	public function get_name() {
		return 'product';
	}

	public function get_label() {
		return __( 'Product', 'acf-frontend-form-element' );
	}
	
	public function register_fields_settings( $widget ){
		
		$widget->add_control(
			'product_fields',
			[
				'label' => __( 'Product Fields', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		
		$widget->add_control(
			'show_product_title',
			[
				'label' => __( 'Title Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default Product Title Field', 'acf-frontend-form-element' ),
					'structure'  => __( 'Custom Structure', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$widget->add_control(
			'product_title_structure',
			[
				'label' => __( 'Title Structure', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Product Title', 'acf-frontend-form-element' ),
				'description' => __( 'Structure the title field. You can use shortcodes for text fields. Foe example: [acf name="text"]', 'acf-frontend-form-element' ),
				'default' => __( 'Product Title', 'acf-frontend-form-element' ),
				'condition' => [
					'show_product_title' => 'structure',
				],
			]
		);	

		$widget->add_control(
			'product_title_slug',
			[
				'label' => __( 'Set as Slug', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'show_product_title' => 'default'
				]
			]
		);		
		$this->add_field_options( $widget, 'product_title', __( 'Product Title', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'show_product_content',
			[
				'label' => __( 'Description Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Product Description Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'product_content', __( 'Product Content', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );

		
		$widget->add_control(
			'show_product_featured_image',
			[
				'label' => __( 'Main Image Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Image Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'product_featured_image', __( 'Product Main Image', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
				
		$widget->add_control(
			'show_product_images',
			[
				'label' => __( 'Product Images Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Product Images Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'product_images', __( 'Product Images', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'show_product_excerpt',
			[
				'label' => __( 'Short Description Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Short Description Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'product_excerpt', __( 'Product Short Description', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'show_product_categories',
			[
				'label' => __( 'Categories Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Categories Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'product_categories', __( 'Product Categories', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );

		
		$widget->add_control(
			'show_product_tags',
			[
				'label' => __( 'Tags Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Tags Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'product_tags', __( 'Product Tags', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		do_action( 'acfef/product_fields', $widget );
		

	}

	public function register_settings_section( $widget ) {
		
						
		$widget->start_controls_section(
			'section_edit_product',
			[
				'label' => $this->get_label(),
				'tab' => Controls_Manager::TAB_CONTENT,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'main_action',
							'operator' => 'in',
							'value' => [ 'new_product', 'edit_product' ],
						],	
						[
							'name' => 'multi',
							'operator' => '==',
							'value' => '',
						],
					],
				],
			]
		);
				
		$widget->add_control(
			'product_settings',
			[
				'label' => __( 'Product Settings', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$widget->add_control(
			'new_product_status',
			[
				'label' => __( 'Product Status', 'acf-frontend-form-element' ),
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

		$this->edit_product_settings( $widget );
		$this->new_product_settings( $widget );	
		

		
		$widget->add_control(
			'show_product_delete_button',
			[
				'label' => __( 'Delete Product Option', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'main_action' => 'edit_product',
				],
			]
		);
		
		$widget->add_control(
			'delete_product_button_text',
			[
				'label' => __( 'Delete Button Text', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Delete', 'acf-frontend-form-element' ),
				'placeholder' => __( 'Delete', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'edit_product',
					'show_product_delete_button' => 'true',
				],
			]
		);
		$widget->add_control(
			'delete_product_button_icon',
			[
				'label' => __( 'Delete Button Icon', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'main_action' => 'edit_product',
					'show_product_delete_button' => 'true',
				],
			]
		);
	
		

		$widget->add_control(
			'confirm_delete_product_message',
			[
				'label' => __( 'Confirm Delete Message', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => __( 'The product will be deleted. Are you sure?', 'acf-frontend-form-element' ),
				'placeholder' => __( 'The product will be deleted. Are you sure?', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'edit_product',
					'show_product_delete_button' => 'true',
				],
			]
		);
		$widget->add_control(
			'redirect_after_delete_product',
			[
				'label' => __( 'Redirect After Delete', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'Enter Url Here', 'acf-frontend-form-element' ),
				'show_external' => false,
				'dynamic' => [
					'active' => true,
				],	
				'condition' => [
					'main_action' => 'edit_product',
					'show_product_delete_button' => 'true',
				],			
			]
		);
			
		$widget->add_control(
			'product_settings_end_product',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->register_fields_settings( $widget );
		
		$widget->end_controls_section();
		
		$widget->start_controls_section(
			'section_product_data',
			[
				'label' => $this->get_label() . ' Data',
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
							'main_action' => [ 'new_product', 'edit_product' ],
							'multi' => '',
				],
			]
		);
		
		$this->register_product_data_fields( $widget );
		
		$widget->end_controls_section();
	}
	
	public function register_product_data_fields( $widget ){
		
		$widget->add_control(
			'show_product_price',
			[
				'label' => __( 'Price Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default Product Price Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);		
		$this->add_field_options( $widget, 'product_price', __( 'Product Price', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'show_sale_price',
			[
				'label' => __( 'Sale Price Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Sale Price Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);		
		$this->add_field_options( $widget, 'sale_price', __( 'Sale Price', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
	}
	
	public function edit_product_settings( $widget ){
		$widget->add_control(
			'product_to_edit',
			[
				'label' => __( 'Product To Edit', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'current_product',
				'options' => [
					'current_product'  => __( 'Current Product', 'acf-frontend-form-element' ),
					'select_product' => __( 'Select Product', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'main_action' => 'edit_product',
				],
			]
		);
		
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){
			$widget->add_control(
				'product_select',
				[
					'label' => __( 'Product', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18', 'acf-frontend-form-element' ),
					'description' => __( 'Enter the product ID', 'acf-frontend-form-element' ),
					'condition' => [
						'main_action' => 'edit_product',
						'product_to_edit' => 'select_product',
					],
				]
			);		
		}else{
			$widget->add_control(
				'product_select',
				[
					'label' => __( 'Product', 'acf-frontend-form-element' ),
					'type' => Query_Module::QUERY_CONTROL_ID,
					'options' => [
						'' => 0,
					],
					'label_block' => true,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_POST,
						'display' => 'detailed',
						'query' => [
							'post_type' => 'product',
							'post_status' => 'any',
						],
					],
					'default' => 0,
					'condition' => [
						'main_action' => 'edit_product',
						'product_to_edit' => 'select_product',
					],
				]
			);
		}
	}
	
	public function new_product_settings( $widget ){
	
		$widget->add_control(
			'new_product_terms',
			[
				'label' => __( 'New Product Terms', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'product',
				'options' => [
					'current_term'  => __( 'Current Term', 'acf-frontend-form-element' ),
					'select_terms' => __( 'Select Term', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'main_action' => 'new_product',
				],
			]
		);
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){
			$widget->add_control(
				'new_product_terms_select',
				[
					'label' => __( 'Terms', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18, 12, 11', 'acf-frontend-form-element' ),
					'description' => __( 'Enter the a comma-seperated list of term ids', 'acf-frontend-form-element' ),
					'condition' => [
						'main_action' => 'new_product',
						'new_product_terms' => 'select_terms',
					],
				]
			);		
		}else{		
			$widget->add_control(
				'new_product_terms_select',
				[
					'label' => __( 'Terms', 'acf-frontend-form-element' ),
					'type' => Query_Module::QUERY_CONTROL_ID,
					'label_block' => true,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_TAX,
						'display' => 'detailed',
					],		
					'multiple' => true,
					'condition' => [
						'main_action' => 'new_product',
						'new_product_terms' => 'select_terms',
					],
				]
			);
		}
		

	}
	
	
	public function render_form( $settings, $wg_id ){
		$product_data[ 'fields' ] = $this->default_fields( $settings, $wg_id );
		
		$product_data = apply_filters( 'acfef/product_fields_render', $product_data, $settings );
		
		return $product_data;
	}
	
	public function default_fields( $settings, $wg_id ){
		$default_fields = [];
		
		$title = $settings[ 'show_product_title' ];
		$price = $settings[ 'show_product_price' ];
		$sale_price = $settings[ 'show_sale_price' ];
		$content = $settings[ 'show_product_content' ];		
		$image = $settings[ 'show_product_featured_image' ];
		$images = $settings[ 'show_product_images' ];
		$excerpt = $settings[ 'show_product_excerpt' ];
		$cats = $settings[ 'show_product_categories' ];
		$tags = $settings[ 'show_product_tags' ];

		if( $title == 'default' ){
			$field = 'product_title';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_product_title',
				'key'		=> $wg_id . '_product_title',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'text',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'custom_title' => true,
				'custom_slug' => $settings[ 'title_slug' ]
			) );
			$default_fields[] = $wg_id . '_product_title';
		}		
		if( $content == 'default' ){
			$field = 'product_content';			
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_product_content',
				'key'		=> $wg_id . '_product_content',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'wysiwyg',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'custom_content' => true
			) );
			$default_fields[] = $wg_id . '_product_content';
		}
		if( $image == 'default' ){
			$field = 'product_featured_image';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_thumbnail_id',
				'key'		=> $wg_id . '_product_featured_image',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'image',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ],
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'return_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
				'custom_feature_image' => 1,
			) );
			$default_fields[] = $wg_id . '_product_featured_image';
		}
		if( $images == 'default' ){
			$field = 'product_images';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_' . $field,
				'key'		=> $wg_id . '_' . $field,
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'gallery',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ],
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'return_format' => 'id',
				'preview_size' => 'medium',
				'insert' => 'append',
				'library' => 'all',
				'custom_product_gallery' => 1,
			) );
			$default_fields[] = $wg_id . '_' . $field;
		}
		if( $excerpt == 'default' ){
			$field = 'product_excerpt';			
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_product_excerpt',
				'key'		=> $wg_id . '_product_excerpt',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'type'		=> 'textarea',
				'custom_excerpt' => true
			) );
			$default_fields[] = $wg_id . '_product_excerpt';
		}
		if( $cats == 'default' ){
			$field = 'product_categories';			
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_product_categories',
				'key'		=> $wg_id . '_product_categories',
				'label'		=> $settings[ $field . '_text' ],
				'type' 		=> 'taxonomy',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ],
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'taxonomy' 	=> 'product_cat',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'id',
				'multiple' => 0,
			) );
			$default_fields[] = $wg_id . '_product_categories';
		}
		if( $tags == 'default' ){
			$field = 'product_tags';			
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_product_tags',
				'key'		=> $wg_id . '_product_tags',
				'label'		=> $settings[ $field . '_text' ],
				'type' 		=> 'taxonomy',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ],
				'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'taxonomy' 	=> 'product_tag',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'id',
				'multiple' => 0,
			) );
			$default_fields[] = $wg_id . '_product_tags';
		}	
		if( $price == 'default' ){
			$field = 'product_price';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_regular_price',
				'key'		=> $wg_id . '_product_price',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'number',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'custom_price' => true,
			) );
			$default_fields[] = $wg_id . '_' . $field;
		}		
		if( $sale_price == 'default' ){
			$field = 'sale_price';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_sale_price',
				'key'		=> $wg_id . '_sale_price',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'number',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 'wrapper' => [ 'class' => $field . '-wrapper width' ],
				'custom_sale_price' => true,
			) );
			$default_fields[] = $wg_id . '_' . $field;
		}
		
		return $default_fields;
	} 
	
	
	public function run( $product_id, $settings, $step_index = false, $steps = 0 ){			
		$module = ACFEF_Module::instance();
		
		$form_submit = $module->get_components( 'form_submit' );	
				
		$product_to_edit = array(
		  'ID' => $product_id,
		);

		$product_to_edit[ 'post_status' ] = $settings[ 'new_product_status' ];
		
		if( $settings[ 'save_progress_button' ] && isset( $_POST[ 'acfef_save_draft' ] ) ){
			$product_to_edit[ 'post_status' ] = 'draft';
		}
		
		remove_filter('acf/pre_save_product', array( $form_submit, 'on_submit' ), 10);

		$product_id = wp_update_post( $product_to_edit );
		
		if( isset( $_POST[ 'acfef_widget_id' ] ) ){
			update_post_meta( $product_id, 'acfef_form_source', $_POST[ 'acfef_widget_id' ] );
		}
		
		if( $settings[ 'new_product_terms' ] ){
			if( $settings[ 'new_product_terms' ] == 'select_terms' ){
				$first = false;
				$new_terms = $settings[ 'new_terms_select' ];
				if( is_string( $new_terms ) ){
					$new_terms = explode( ',', $settings[ 'new_terms_select' ] );
				}
				if( is_array( $new_terms ) ){
					foreach( $new_terms as $term_id ){
						$term = get_term( $term_id );
						if( $term ){
							wp_set_object_terms( $product_id, $term->term_id, $term->taxonomy, $first );
						}
						$first = true;
					}
				}
			}
			if( $settings[ 'new_product_terms' ] == 'current_term' ){
				$term = get_queried_object();
				if( $term ){
					wp_set_object_terms( $product_id, $term->term_id, $term->taxonomy );
				}
			} 
		}

		add_filter('acf/pre_save_product', array( $form_submit, 'on_submit' ), 10);
		
		return $product_id;
	}
	

}
