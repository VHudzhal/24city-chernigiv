<?php
/**
 * User guide page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Design_Kit_Dashboard_Guide' ) ) {

	/**
	 * Define Jet_Design_Kit_Dashboard_Guide class
	 */
	class Jet_Design_Kit_Dashboard_Guide extends Jet_Design_Kit_Dashboard_Base {

		/**
		 * Page slug
		 *
		 * @return string
		 */
		public function get_slug() {
			return 'guide';
		}

		/**
		 * Get icon
		 *
		 * @return string
		 */
		public function get_icon() {
			return 'dashicons dashicons-info';
		}

		/**
		 * Page name
		 *
		 * @return string
		 */
		public function get_name() {
			return esc_attr__( 'User Guide', 'jet-design-kit' );
		}

		/**
		 * Renderer callback
		 *
		 * @return void
		 */
		public function render_page() {

			$guide = jet_design_kit()->config->get( 'guide' );

			$title   = ! empty( $guide['title'] ) ? $guide['title'] : '';
			$content = ! empty( $guide['content'] ) ? $guide['content'] : '';

			include jet_design_kit()->get_template( 'dashboard/guide/heading.php' );

			if ( ! empty( $guide['links'] ) ) {
				$links = $guide['links'];
				include jet_design_kit()->get_template( 'dashboard/guide/links.php' );
			}

		}

	}

}
