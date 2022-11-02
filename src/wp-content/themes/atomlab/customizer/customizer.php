<?php
/**
 * Theme Customizer
 *
 * @package TM Atomlab
 * @since   1.0
 */

/**
 * Setup configuration
 */
Atomlab_Kirki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add sections
 */
$priority = 1;

Atomlab_Kirki::add_section( 'layout', array(
	'title'    => esc_html__( 'Layout', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'color_', array(
	'title'    => esc_html__( 'Colors', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'background', array(
	'title'    => esc_html__( 'Background', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'typography', array(
	'title'    => esc_html__( 'Typography', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'top_bar', array(
	'title'    => esc_html__( 'Top bar', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'header', array(
	'title'    => esc_html__( 'Header', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'logo', array(
	'title'    => esc_html__( 'Logo', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'navigation', array(
	'title'    => esc_html__( 'Navigation', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'sliders', array(
	'title'    => esc_html__( 'Sliders', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'title_bar', array(
	'title'    => esc_html__( 'Page Title Bar', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'sidebars', array(
	'title'    => esc_html__( 'Sidebars', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'footer', array(
	'title'    => esc_html__( 'Footer', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'blog', array(
	'title'    => esc_html__( 'Blog', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'portfolio', array(
	'title'    => esc_html__( 'Portfolio', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'shop', array(
	'title'    => esc_html__( 'Shop', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'socials', array(
	'title'    => esc_html__( 'Social Networks', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'social_sharing', array(
	'title'    => esc_html__( 'Social Sharing', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'search', array(
	'title'    => esc_html__( 'Search', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'error404_page', array(
	'title'    => esc_html__( 'Error 404 Page', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'maintenance', array(
	'title'    => esc_html__( 'Maintenance', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'shortcode', array(
	'title'    => esc_html__( 'Shortcodes', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_panel( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'notices', array(
	'title'    => esc_html__( 'Notices', 'atomlab' ),
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'custom_code', array(
	'title'    => esc_html__( 'Custom Code', 'atomlab' ),
	'priority' => $priority ++,
) );

/**
 * Load panel & section files
 */
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'top_bar' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'top_bar' . DS . 'general.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'top_bar' . DS . 'style-01.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'top_bar' . DS . 'style-02.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'general.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'sticky.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-01.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-02.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-03.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-04.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-05.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-06.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-07.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-08.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-09.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-10.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-11.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-12.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-13.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-14.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-15.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-16.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-17.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-18.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-19.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'header' . DS . 'style-20.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'navigation' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'navigation' . DS . 'desktop-menu.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'navigation' . DS . 'off-canvas-menu.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'navigation' . DS . 'mobile-menu.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-sliders.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'title_bar' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'title_bar' . DS . 'general.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'title_bar' . DS . 'style-01.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'footer' . DS . 'general.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'advanced' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'advanced' . DS . 'advanced.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'advanced' . DS . 'pre-loader.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'advanced' . DS . 'light-gallery.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-notices.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'shortcode' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'shortcode' . DS . 'animation.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'shortcode' . DS . 'box-icon.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-background.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-color.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-custom.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-error404.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-layout.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-logo.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'blog' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'blog' . DS . 'archive.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'blog' . DS . 'single.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'portfolio' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'portfolio' . DS . 'archive.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'portfolio' . DS . 'single.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'shop' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'shop' . DS . 'archive.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'shop' . DS . 'single.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'shop' . DS . 'cart.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'search' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'search' . DS . 'search-page.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'search' . DS . 'search-popup.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'maintenance' . DS . '_panel.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'maintenance' . DS . 'general.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'maintenance' . DS . 'maintenance.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'maintenance' . DS . 'coming-soon-01.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'maintenance' . DS . 'coming-soon-02.php';

require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-sharing.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-sidebars.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-socials.php';
require_once ATOMLAB_CUSTOMIZER_DIR . DS . 'section-typography.php';
