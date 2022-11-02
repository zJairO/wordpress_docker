<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do nothing if not an admin page.
if ( ! is_admin() ) {
	return;
}

/**
 * Hook & filter that run only on admin pages.
 */
if ( ! class_exists( 'Atomlab_Admin' ) ) {
	class Atomlab_Admin {

		protected static $instance = null;

		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'save_post', array( $this, 'delete_rev_sliders_transient' ) );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function delete_rev_sliders_transient( $post_id ) {
			delete_transient( 'atomlab_rev_sliders' );
		}

		/**
		 * Enqueue scrips & styles.
		 *
		 * @access public
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'admin', ATOMLAB_THEME_URI . '/assets/admin/css/style.min.css' );
			$screen = get_current_screen();
			if ( $screen->id === 'nav-menus' ) {
				wp_enqueue_media();
				wp_enqueue_script( 'menu-image-hover', ATOMLAB_THEME_URI . '/assets/admin/js/attach.js', array( 'jquery' ), null, true );
			}
		}

	}

	new Atomlab_Admin();
}
