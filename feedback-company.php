<?php
/*
Plugin Name: Feedback Company
Version: 1.0
Plugin URI: http://www.siteoptimo.com/#utm_source=wpadmin&utm_medium=plugin&utm_campaign=fc
Description: This WordPress plugin integrates with the API from The Feedback Company, allowing you to display your latest reviews directly on your website.
Author: SiteOptimo
Author URI: http://www.siteoptimo.com/
Text Domain: feedback-company
Domain Path: /i18n/languages/
License: GPL v3

Copyright (C) 2014, SiteOptimo - team@siteoptimo.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'FeedbackCompany' ) ) {
	/**
	 * Main FeedbackCompany Class
	 *
	 * @class FeedbackCompany
	 * @version 1.0
	 */
	final class FeedbackCompany {
		/**
		 * @var FeedbackCompany Singleton implementation
		 */
		private static $_instance = null;

		/**
		 * Current version number
		 *
		 * @var string
		 */
		public static $version = "1.0";


		/**
		 * Constructor method
		 *
		 * Bootstraps the plugin.
		 */
		function __construct() {
			// Register the autoloader classes.
			spl_autoload_register( array( $this, 'autoload' ) );

			$this->register_scripts();

			$this->includes();

			$this->bootstrap();

		}

		/**
		 * Returns an instance of the FeedbackCompany class.
		 *
		 * @return FeedbackCompany
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				// Create instance if not set.
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Autoloads the Feedback Company classes whenever they are needed.
		 *
		 * @param $class
		 */
		public function autoload( $class ) {
			if ( strpos( $class, 'FC_' ) !== 0 ) {
				return;
			}

			$class_exploded = explode( '_', $class );

			$filename = strtolower( implode( '-', $class_exploded ) ) . '.php';

			// first try the directory
			$file = 'includes/' . strtolower( $class_exploded[1] ) . '/' . $filename;

			if ( is_readable( $this->plugin_path() . $file ) ) {
				require_once $this->plugin_path() . $file;

				return;
			}

			// try without a subdirectory
			$filename = strtolower( implode( '-', $class_exploded ) ) . '.php';

			$file = 'includes/' . $filename;

			if ( is_readable( $this->plugin_path() . $file ) ) {
				require_once $this->plugin_path() . $file;

				return;
			}

			return;
		}

		private function includes() {
			require_once $this->plugin_path() . 'includes/fc-functions.php';
		}

		/**
		 * @return string The plugin URL
		 */
		public function plugin_url() {
			return plugins_url( '/', __FILE__ );
		}

		/**
		 * @return string The plugin path
		 */
		public function plugin_path() {
			return plugin_dir_path( __FILE__ );
		}

		/**
		 * @return string The plugin basename
		 */
		public function plugin_basename() {
			return plugin_basename( __FILE__ );
		}

		/**
		 * Hooks onto the admin_enqueue_scripts hook.
		 */
		private function register_scripts() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		/**
		 * Registers, localizes and enqueues the Javascript files.
		 */
		public function admin_enqueue_scripts() {
			wp_enqueue_style( 'fc-admin-style', $this->plugin_url() . 'assets/css/admin.css' );

			wp_register_script( 'fc-admin', $this->plugin_url() . 'assets/js/admin.js', array( 'jquery' ), self::$version, true );

			wp_localize_script( 'fc-admin', 'FC', array( 'plugin_url' => $this->plugin_url() ) );

			wp_enqueue_script( 'fc-admin' );
		}


		/**
		 * Initialize.
		 */
		private function bootstrap() {
			if ( is_admin() ) {
				$this->admin_init();

			} else {
				$this->frontend_init();
			}
			$this->init();
		}

		/**
		 * Initializes all of the admin classes.
		 */
		public function admin_init() {
			new FC_Admin_Settings();
		}

		/**
		 * Initializes all of the frontend classes.
		 */
		public function frontend_init() {
		}

		/**
		 * The site-wide hooks.
		 */
		private function init() {
			new FC_Main();
		}
	}

	// Our FeedbackCompany instance.
	$FC = FeedbackCompany::instance();
}
