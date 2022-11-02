<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$techkit_theme_data = wp_get_theme();
	$action  = 'techkit_theme_init';
	do_action( $action );

	define( 'TECHKIT_VERSION', ( WP_DEBUG ) ? time() : $techkit_theme_data->get( 'Version' ) );
	define( 'TECHKIT_AUTHOR_URI', $techkit_theme_data->get( 'AuthorURI' ) );
	define( 'TECHKIT_NAME', 'techkit' );

	// DIR
	define( 'TECHKIT_BASE_DIR',    get_template_directory(). '/' );
	define( 'TECHKIT_INC_DIR',     TECHKIT_BASE_DIR . 'inc/' );
	define( 'TECHKIT_VIEW_DIR',    TECHKIT_INC_DIR . 'views/' );
	define( 'TECHKIT_LIB_DIR',     TECHKIT_BASE_DIR . 'lib/' );
	define( 'TECHKIT_WID_DIR',     TECHKIT_INC_DIR . 'widgets/' );
	define( 'TECHKIT_PLUGINS_DIR', TECHKIT_INC_DIR . 'plugins/' );
	define( 'TECHKIT_MODULES_DIR', TECHKIT_INC_DIR . 'modules/' );
	define( 'TECHKIT_ASSETS_DIR',  TECHKIT_BASE_DIR . 'assets/' );
	define( 'TECHKIT_CSS_DIR',     TECHKIT_ASSETS_DIR . 'css/' );
	define( 'TECHKIT_JS_DIR',      TECHKIT_ASSETS_DIR . 'js/' );
	define( 'TECHKIT_WOO_DIR',     TECHKIT_BASE_DIR . 'woocommerce/' );

	// URL
	define( 'TECHKIT_BASE_URL',    get_template_directory_uri(). '/' );
	define( 'TECHKIT_ASSETS_URL',  TECHKIT_BASE_URL . 'assets/' );
	define( 'TECHKIT_CSS_URL',     TECHKIT_ASSETS_URL . 'css/' );
	define( 'TECHKIT_JS_URL',      TECHKIT_ASSETS_URL . 'js/' );
	define( 'TECHKIT_IMG_URL',     TECHKIT_ASSETS_URL . 'img/' );
	define( 'TECHKIT_LIB_URL',     TECHKIT_BASE_URL . 'lib/' );
	
	// icon trait Plugin Activation
	require_once TECHKIT_INC_DIR . 'icon-trait.php';
	// Includes
	require_once TECHKIT_INC_DIR . 'helper-functions.php';
	require_once TECHKIT_INC_DIR . 'techkit.php';
	require_once TECHKIT_INC_DIR . 'general.php';
	require_once TECHKIT_INC_DIR . 'scripts.php';
	require_once TECHKIT_INC_DIR . 'template-vars.php';
	require_once TECHKIT_INC_DIR . 'includes.php';

	// Includes Modules
	require_once TECHKIT_MODULES_DIR . 'rt-post-related.php';
	require_once TECHKIT_MODULES_DIR . 'rt-case-related.php';
	require_once TECHKIT_MODULES_DIR . 'rt-team-related.php';
	require_once TECHKIT_MODULES_DIR . 'rt-breadcrumbs.php';

	// TGM Plugin Activation
	require_once TECHKIT_LIB_DIR . 'class-tgm-plugin-activation.php';
	require_once TECHKIT_INC_DIR . 'tgm-config.php';

	add_editor_style( 'style-editor.css' );

	// Update Breadcrumb Separator
	add_action('bcn_after_fill', 'techkit_hseparator_breadcrumb_trail', 1);
	function techkit_hseparator_breadcrumb_trail($object){
		$object->opt['hseparator'] = '<span class="dvdr"> / </span>';
		return $object;
	}


