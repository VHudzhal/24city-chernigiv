<?php
/**
 * Scripts and styles
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Design_Kit_Assets' ) ) {

	/**
	 * Define Jet_Design_Kit_Assets class
	 */
	class Jet_Design_Kit_Assets {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Constructor for the class
		 */
		public function __construct() {

			add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'editor_scripts' ), 0 );
			add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_styles' ) );
			add_action( 'elementor/editor/footer', array( $this, 'print_templates' ) );
			add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );

		}

		public function suffix() {
			return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		}

		/**
		 * Load preview assets
		 *
		 * @return void
		 */
		public function preview_styles() {

			wp_enqueue_style(
				'jet-design-kit-preview',
				jet_design_kit()->plugin_url( 'assets/css/preview.css' ),
				array(),
				jet_design_kit()->get_version()
			);

		}

		/**
		 * Enqueue elemnetor editor scripts
		 *
		 * @return void
		 */
		public function editor_scripts() {

			wp_enqueue_script(
				'jet-design-kit-editor',
				jet_design_kit()->plugin_url( 'assets/js/editor' . $this->suffix() . '.js' ),
				array( 'jquery', 'underscore', 'backbone-marionette' ),
				jet_design_kit()->get_version(),
				true
			);

			$icon   = $this->get_library_icon();
			$button = jet_design_kit()->config->get( 'library_button' );

			wp_localize_script( 'jet-design-kit-editor', 'JetDesignKitData', apply_filters(
				'jet-design-kit/assets/editor/localize',
				array(
					'libraryButton' => ( false !== $button ) ? $icon . $button : false,
					'modalRegions'  => $this->get_modal_regions(),
					'license'       => array(
						'activated' => true,
						'link'      => '',
					),
				)
			) );

		}

		/**
		 * Returns modal regions
		 * @return [type] [description]
		 */
		public function get_modal_regions() {

			if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '2.1.0-beta1', '>=' ) ) {
				return array(
					'modalHeader'  => '.dialog-header',
					'modalContent' => '.dialog-message',
				);
			} else {
				return array(
					'modalContent' => '.dialog-message',
					'modalHeader'  => '.dialog-widget-header',
				);
			}

		}

		/**
		 * Get library icon markup
		 *
		 * @return string
		 */
		public function get_library_icon() {

			ob_start();
			include jet_design_kit()->plugin_path( 'assets/img/library-icon.svg' );
			$icon = ob_get_clean();

			return apply_filters( 'jet-design-kit/library-button/icon', $icon );
		}

		/**
		 * Enqueue elemnetor editor-related styles
		 *
		 * @return void
		 */
		public function editor_styles() {

			wp_enqueue_style(
				'jet-design-kit-editor',
				jet_design_kit()->plugin_url( 'assets/css/editor.css' ),
				array(),
				jet_design_kit()->get_version()
			);

		}

		/**
		 * Prints editor templates
		 *
		 * @return void
		 */
		public function print_templates() {

			foreach ( glob( jet_design_kit()->plugin_path( 'templates/editor/*.php' ) ) as $file ) {
				$name = basename( $file, '.php' );
				ob_start();
				include $file;
				printf( '<script type="text/html" id="tmpl-jet-%1$s">%2$s</script>', $name, ob_get_clean() );
			}

		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}
