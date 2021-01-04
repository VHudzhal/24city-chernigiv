<?php
/**
 * Dashboard manager
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Design_Kit_Dashboard' ) ) {

	/**
	 * Define Jet_Design_Kit_Dashboard class
	 */
	class Jet_Design_Kit_Dashboard {

		/**
		 * Dashboard page slug
		 *
		 * @var string
		 */
		public static $main_slug = 'jet-design-kit';

		/**
		 * Dashboard pages
		 *
		 * @var array
		 */
		private $_pages = array();

		/**
		 * Constructor for the class
		 */
		public function __construct() {

			add_action( 'admin_menu', array( $this, 'register_main_menu_page' ), 10 );
			add_action( 'init', array( $this, 'do_dashboard_actions' ), 0 );
			add_action( 'admin_enqueue_scripts', array( $this, 'dashboard_assets' ), 0 );

			$this->register_dashboard_pages();

		}

		/**
		 * Enqueue dashboard assets
		 *
		 * @return void
		 */
		public function dashboard_assets() {

			if ( ! isset( $_GET['page'] ) || $this->slug() !== $_GET['page'] ) {
				return;
			}

			wp_enqueue_style(
				'jet-design-kit-dashboard',
				jet_design_kit()->plugin_url( 'assets/css/dashboard.css' ),
				array(),
				jet_design_kit()->get_version()
			);

		}

		/**
		 * Get dashboard page object by ID.
		 *
		 * @param  string $page [description]
		 * @return [type]       [description]
		 */
		public function get( $page = '' ) {
			return isset( $this->_pages[ $page ] ) ? $this->_pages[ $page ] : false;
		}

		/**
		 * Run dashboard actions
		 *
		 * @return [type] [description]
		 */
		public function do_dashboard_actions() {

			if ( ! isset( $_GET['jet_action'] ) ) {
				return;
			}

			$action = esc_attr(  $_GET['jet_action'] );

			if ( ! array_key_exists( $action, $this->_pages ) ) {
				return;
			}

			/**
			 * Run page specific actions
			 */
			do_action( 'jet-design-kit/dashboard/actions/' . $action );

		}

		/**
		 * Register dashboard pages
		 *
		 * @return void
		 */
		public function register_dashboard_pages() {

			$base_path = jet_design_kit()->plugin_path( 'includes/dashboard/' );

			require $base_path . 'base.php';

			if ( jet_design_kit()->api->is_enabled() ) {

				$default = array(
					'Jet_Design_Kit_Dashboard_Library'  => $base_path . 'page-library.php',
				);

			} else {
				$default = array();
			}

			$guide = jet_design_kit()->config->get( 'guide' );

			if ( ! empty( $guide['enabled'] ) && true === $guide['enabled'] ) {
				$default['Jet_Design_Kit_Dashboard_Guide'] = $base_path . 'page-guide.php';
			}

			foreach ( $default as $class => $file ) {
				require $file;
				$this->register_dashboard_page( $class );
			}

			/**
			 * You could register custom dashboard on this hook.
			 */
			do_action( 'jet-design-kit/dashboard/pages/register', $this );

		}

		/**
		 * Register new dashboard page
		 *
		 * @return [type] [description]
		 */
		public function register_dashboard_page( $class ) {
			$page = new $class( $this );
			$this->_pages[ $page->get_slug() ] = $page;
		}

		/**
		 * Register menu page
		 *
		 * @return void
		 */
		public function register_main_menu_page() {

			$menu_icon = jet_design_kit()->config->get( 'menu_icon' );

			if ( ! $menu_icon ) {
				$menu_icon = 'dashicons-admin-generic';
			}

			add_menu_page(
				jet_design_kit()->config->get( 'dashboard_page_name' ),
				jet_design_kit()->config->get( 'dashboard_page_name' ),
				'manage_options',
				$this->slug(),
				array( $this, 'render_dashboard' ),
				$menu_icon
			);

		}

		/**
		 * Render Admin page
		 * @return
		 */
		public function render_dashboard() {

			$pages        = $this->_pages;
			$current_page = $this->get_current_page();

			if ( ! $current_page ) {
				return;
			}

			echo '<div class="wrap jet-core-dashboard">';
				echo '<div class="cx-ui-kit cx-component cx-tab cx-tab--vertical">';
					echo '<div class="cx-tab__body">';
						include jet_design_kit()->get_template( 'dashboard/tabs.php' );
						echo '<div class="cx-ui-kit__content cx-component__content cx-tab__content tab-' . $current_page->get_slug() . '">';
							$current_page->render_page();
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}

		/**
		 * Returns URL to passed page.
		 *
		 * @param  [type] $page [description]
		 * @return [type]       [description]
		 */
		public function get_page_link( $page ) {

			if ( is_string( $page ) ) {
				$page = isset( $this->_pages[ $page ] ) ? $this->_pages[ $page ] : false;
			}

			if ( ! $page ) {
				return false;
			}

			return add_query_arg(
				array(
					'page' => $this->slug(),
					'tab'  => $page->get_slug(),
				),
				esc_url( admin_url( 'admin.php' ) )
			);

		}

		/**
		 * Get current page object
		 *
		 * @return object
		 */
		public function get_current_page() {

			$pages        = $this->_pages;
			$current_page = isset( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : '';

			if ( ! $current_page ) {
				$tabs         = array_keys( $pages );
				$current_page = $tabs[0];
			}

			return isset( $pages[ $current_page ] ) ? $pages[ $current_page ] : false;

		}

		/**
		 * Returns slug
		 *
		 * @return staing
		 */
		public function slug() {
			return self::$main_slug;
		}

	}

}
