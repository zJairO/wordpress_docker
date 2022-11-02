<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Atomlab_Register_Plugins' ) ) {
	class Atomlab_Register_Plugins {

		public function __construct() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins() {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'atomlab' ),
					'slug'     => 'insight-core',
					'source'   => 'https://api.thememove.com/download/insight-core-1.7.9-Ir5VJWPiQ4.zip',
					'version'  => '1.7.9',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Revolution Slider', 'atomlab' ),
					'slug'     => 'revslider',
					'source'  => 'https://api.thememove.com/download/revslider-6.3.5-PmzBJ2rZ1n.zip',
					'version' => '6.3.5',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'WPBakery Page Builder', 'atomlab' ),
					'slug'     => 'js_composer',
					'source'   => 'https://api.thememove.com/download/js_composer-6.5.0-GTz1qxX6Xb.zip',
					'version'  => '6.5.0',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'WPBakery Page Builder (Visual Composer) Clipboard', 'atomlab' ),
					'slug'    => 'vc_clipboard',
					'source'  => 'https://api.thememove.com/download/vc_clipboard-4.5.7-6x4EjSaacf.zip',
					'version' => '4.5.7',
				),
				array(
					'name' => esc_html__( 'Contact Form 7', 'atomlab' ),
					'slug' => 'contact-form-7',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'atomlab' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'WP-PostViews', 'atomlab' ),
					'slug' => 'wp-postviews',
				),
				array(
					'name' => esc_html__( 'Image Hotspot by DevVN', 'atomlab' ),
					'slug' => 'devvn-image-hotspot',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'atomlab' ),
					'slug' => 'woocommerce',
				),
				array(
					'name' => esc_html__( 'Insight Swatches', 'atomlab' ),
					'slug' => 'insight-swatches',
				),
				array(
					'name'     => esc_html__( 'YITH WooCommerce Compare', 'atomlab' ),
					'slug'     => 'yith-woocommerce-compare',
					'required' => false,
				),
				array(
					'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'atomlab' ),
					'slug'     => 'yith-woocommerce-wishlist',
					'required' => false,
				),
				array(
					'name'    => esc_html__( 'Instagram Feed', 'atomlab' ),
					'slug'    => 'elfsight-instagram-feed-cc',
					'source'  => 'https://api.thememove.com/download/elfsight-instagram-feed-cc-4.0.1-bfaRxLvWr9.zip',
					'version' => '4.0.1',
				),
			);

			return $plugins;
		}

	}

	new Atomlab_Register_Plugins();
}
