<?php
/**
 * License page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Design_Kit_Dashboard_Library' ) ) {

	/**
	 * Define Jet_Design_Kit_Dashboard_Library class
	 */
	class Jet_Design_Kit_Dashboard_Library extends Jet_Design_Kit_Dashboard_Base {

		public $update_plugins = null;
		public $has_license    = null;
		public $all_plugins    = array();

		/**
		 * Page slug
		 *
		 * @return string
		 */
		public function get_slug() {
			return 'library';
		}

		/**
		 * Get icon
		 *
		 * @return string
		 */
		public function get_icon() {
			return 'dashicons dashicons-images-alt2';
		}

		/**
		 * Page name
		 *
		 * @return string
		 */
		public function get_name() {
			return esc_attr__( 'Library', 'jet-design-kit' );
		}

		/**
		 * Clear templates Jet API cache
		 *
		 * @return void
		 */
		public function sync_library() {

			$api_source = jet_design_kit()->templates_manager->get_source( 'jet-api' );
			$redirect   = $this->get_current_page_link();

			if ( ! $api_source ) {
				wp_safe_redirect( $redirect );
				die();
			}

			$api_source->delete_templates_cache();
			$api_source->delete_categories_cache();
			$api_source->delete_keywords_cache();

			wp_safe_redirect( $redirect );
			die();

		}

		/**
		 * Renderer callback
		 *
		 * @return void
		 */
		public function render_page() {
			$this->render_actions();
		}

		/**
		 * Render plugins actions
		 * @return [type] [description]
		 */
		public function render_actions() {
			include jet_design_kit()->get_template( 'dashboard/library/actions.php' );
		}

		/**
		 * Return synchronize template library URL
		 *
		 * @return string
		 */
		public function sync_library_url() {

			return add_query_arg(
				array(
					'jet_action' => $this->get_slug(),
					'handle'     => 'sync_library',
				),
				admin_url( 'admin.php' )
			);

		}

	}

}
