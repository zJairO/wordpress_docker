<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

add_action( 'tgmpa_register', 'techkit_register_required_plugins' );
function techkit_register_required_plugins() {
	$plugins = array(
		// Bundled
		array(
			'name'         => 'Techkit Core',
			'slug'         => 'techkit-core',
			'source'       => 'techkit-core.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '1.3'
		),
		array(
			'name'         => 'RT Framework',
			'slug'         => 'rt-framework',
			'source'       => 'rt-framework.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '2.4'
		),
		array(
			'name'         => 'RT Demo Importer',
			'slug'         => 'rt-demo-importer',
			'source'       => 'rt-demo-importer.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '4.3'
		),
		array(
			'name'     		=> 'Review Schema',
			'slug'     		=> 'review-schema',
			'required' 		=> false,
		),
		array(
			'name'         => 'Review Schema Pro',
			'slug'         => 'review-schema-pro',
			'source'       => 'review-schema-pro.zip',
			'required'     => false,
			'version'      => '1.0.2'
		),
		// Repository
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => true,
		),
		array(
			'name'     => 'Elementor Page Builder',
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'     => 'WP Fluent Forms',
			'slug'     => 'fluentform',
			'required' => false,
		),
		array(
			'name'     => 'Smash Balloon Social Photo Feed',
			'slug'     => 'instagram-feed',
			'required' => false,
		),
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'techkit',                 	// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => TECHKIT_PLUGINS_DIR,       	// Default absolute path to bundled plugins.
		'menu'         => 'techkit-install-plugins', 	// Menu slug.
		'has_notices'  => true,                    		// Show admin notices or not.
		'dismissable'  => true,                    		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   		// Automatically activate plugins after installation or not.
		'message'      => '',                      		// Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}