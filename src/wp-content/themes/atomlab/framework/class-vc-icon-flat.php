<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Atomlab_VC_Icon_Flat' ) ) {
	class Atomlab_VC_Icon_Flat {

		public function __construct() {
			/*
			 * Add styles & script file only on add new or edit post type.
			 */
			add_action( 'load-post.php', array( $this, 'enqueue_scripts' ) );
			add_action( 'load-post-new.php', array( $this, 'enqueue_scripts' ) );

			add_filter( 'vc_iconpicker-type-flat', array( $this, 'add_fonts' ) );

			add_action( 'vc_enqueue_font_icon_element', array( $this, 'vc_element_enqueue' ) );
		}

		public function vc_element_enqueue( $font ) {
			switch ( $font ) {
				case 'flat':
					wp_enqueue_style( 'font-flat', ATOMLAB_THEME_URI . '/assets/fonts/flat/font-flat.min.css', null, null );
					break;
			}
		}

		public function enqueue_scripts() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		function admin_enqueue_scripts() {
			wp_enqueue_style( 'font-flat', ATOMLAB_THEME_URI . '/assets/fonts/flat/font-flat.min.css', null, null );
		}

		public function add_fonts( $icons ) {
			$new_icons = array(
				array( 'flaticon-tooth' => 'tooth' ),
				array( 'flaticon-heartbeat' => 'heartbeat' ),
				array( 'flaticon-lungs' => 'lungs' ),
				array( 'flaticon-eye' => 'eye' ),
				array( 'flaticon-smiling-baby' => 'smiling baby' ),
			);

			return array_merge( $icons, $new_icons );
		}
	}

	new Atomlab_VC_Icon_Flat();
}
