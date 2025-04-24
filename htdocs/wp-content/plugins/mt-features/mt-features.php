<?php
/**
 * Plugin Name: MT Features
 * Plugin URI: https://example.com
 * Description: Mainostoimisto features.
 * Version: 1.0.0
 * Author: Seravo
 * Author URI: https://seravo.com
 * License: GPL-2.0+
 * Text Domain: mt-features
 * Domain Path: /languages
 *
 * @package MT_Features
 */

namespace MT\Features;

// Halt if this file is called directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'MT_Features' ) ) {
	/**
	 * Main class for the MT Features plugin.
	 *
	 * @package MT_Features
	 */
	class MT_Features {
		/**
		 * Plugin version.
		 */
		const VERSION = '1.0.0';

		/**
		 * Singleton instance.
		 *
		 * @var MT_Features|null
		 */
		private static $instance = null;

		/**
		 * Get the singleton instance.
		 *
		 * @return MT_Features
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		private function __construct() {
			$this->includes();
			$this->load_textdomain();
			$this->init_hooks();
		}

		/**
		 * Define plugin constants.
		 */
		private function includes() {
			define( 'MT_FEATURES_VERSION', self::VERSION );
			define( 'MT_FEATURES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			define( 'MT_FEATURES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

			require_once MT_FEATURES_PLUGIN_DIR . 'includes/class-register-bindings.php';
			require_once MT_FEATURES_PLUGIN_DIR . 'includes/class-register-meta.php';
			require_once MT_FEATURES_PLUGIN_DIR . 'includes/class-register-office.php';
			require_once MT_FEATURES_PLUGIN_DIR . 'includes/class-register-taxonomies.php';
		}

		/**
		 * Load plugin textdomain for translations.
		 */
		private function load_textdomain() {
			load_plugin_textdomain( 'mt-features', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Initialize hooks.
		 */
		private function init_hooks() {
			register_activation_hook( __FILE__, array( $this, 'activate' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
			add_action( 'init', array( $this, 'init' ) );
		}

		/**
		 * Plugin activation callback.
		 */
		public function activate() {
			// Activation logic here.
		}

		/**
		 * Plugin deactivation callback.
		 */
		public function deactivate() {
			// Deactivation logic here.
		}

		/**
		 * Initialize plugin functionality.
		 */
		public function init() {
			// Plugin initialization logic here.
		}
	}

	// Initialize the plugin.
	MT_Features::get_instance();
}
