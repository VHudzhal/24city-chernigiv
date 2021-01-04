<?php
/**
 * Logo Carousel
 */
namespace Happy_Addons_Pro\Widget;

defined( 'ABSPATH' ) || die();


class WPML_Logo_Carousel extends \WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'logo_items';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return ['link', 'name'];
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'link':
				return __( 'Logo Carousel: Link', 'happy-addons-pro' );
			case 'name':
				return __( 'Logo Carousel: Name', 'happy-addons-pro' );
			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'link':
				return 'LINK';
			case 'name':
				return 'LINE';
			default:
				return '';
		}
	}
}
