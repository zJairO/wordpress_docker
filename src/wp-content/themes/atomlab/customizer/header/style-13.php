<?php
$section  = 'header_style_13';
$priority = 1;
$prefix   = 'header_style_13_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'overlay',
	'label'    => esc_html__( 'Header Overlay', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'atomlab' ),
		'1' => esc_html__( 'Yes', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'logo',
	'label'    => esc_html__( 'Logo', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'light',
	'choices'  => array(
		'light' => esc_html__( 'Light', 'atomlab' ),
		'dark'  => esc_html__( 'Dark', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'search_enable',
	'label'       => esc_html__( 'Search Button', 'atomlab' ),
	'description' => esc_html__( 'Controls the display of search button in the header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'atomlab' ),
		'1' => esc_html__( 'Show', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'cart_enable',
	'label'       => esc_html__( 'Mini Cart', 'atomlab' ),
	'description' => esc_html__( 'Controls the display of mini cart in the header', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0'             => esc_html__( 'Hide', 'atomlab' ),
		'1'             => esc_html__( 'Show', 'atomlab' ),
		'hide_on_empty' => esc_html__( 'Hide On Empty', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Bottom Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the border bottom color.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba( 255, 255, 255, 0.2 )',
	'output'      => array(
		array(
			'element'  => '.header-13 .page-header-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'atomlab' ),
	'description' => esc_html__( 'Input box shadow for header. For ex: 0 0 5px #ccc', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'output'      => array(
		array(
			'element'  => '.header-13 .page-header-inner',
			'property' => 'box-shadow',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Controls the background of header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-color'      => 'rgba(0, 0, 0, 0)',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-13 .page-header-inner',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_icon_color',
	'label'       => esc_html__( 'Icon Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of icons on header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#eee',
	'output'      => array(
		array(
			'element'  => '
				.header-13 .page-open-mobile-menu i,
				.header-13 .page-open-main-menu i,
				.header-13 .popup-search-wrap i,
				.header-13 .mini-cart .mini-cart-icon,
				.header-13 .header-social-networks a',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_icon_hover_color',
	'label'       => esc_html__( 'Icon Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover of icons on header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
				.header-13 .page-open-mobile-menu:hover i,
				.header-13 .page-open-main-menu:hover i,
				.header-13 .popup-search-wrap:hover i,
				.header-13 .mini-cart .mini-cart-icon:hover,
				.header-13 .header-social-networks a:hover',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Navigation
--------------------------------------------------------------*/

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Level 1', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_margin',
	'label'     => esc_html__( 'Menu Margin', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => '0px',
		'bottom' => '0px',
		'left'   => '0px',
		'right'  => '20px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-13 .menu__container',
			),
			'property' => 'margin',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_item_padding',
	'label'     => esc_html__( 'Item Padding', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => '51px',
		'bottom' => '51px',
		'left'   => '14px',
		'right'  => '14px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-13 .menu--primary .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_item_margin',
	'label'     => esc_html__( 'Item Margin', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => '0px',
		'bottom' => '0px',
		'left'   => '0px',
		'right'  => '0px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-13  .menu--primary .menu__container > li',
			),
			'property' => 'margin',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'navigation_typography',
	'label'       => esc_html__( 'Typography', 'atomlab' ),
	'description' => esc_html__( 'These settings control the typography for menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '700',
		'line-height'    => '1.2',
		'letter-spacing' => '0',
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.header-13 .menu--primary a',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'navigation_item_font_size',
	'label'       => esc_html__( 'Font Size', 'atomlab' ),
	'description' => esc_html__( 'Controls the font size for main menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.header-13 .menu--primary a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'navigation_link_color',
	'label'       => esc_html__( 'Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#eee',
	'output'      => array(
		array(
			'element'  => '.header-13 .menu--primary a',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'navigation_link_hover_color',
	'label'       => esc_html__( 'Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
            .header-13 .menu--primary li:hover > a,
            .header-13 .menu--primary > ul > li > a:hover,
            .header-13 .menu--primary > ul > li > a:focus,
            .header-13 .menu--primary .current-menu-ancestor > a,
            .header-13 .menu--primary .current-menu-item > a',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'navigation_link_background_color',
	'label'       => esc_html__( 'Background Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color for main menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.header-13 .menu--primary .menu__container > li > a',
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'navigation_link_hover_background_color',
	'label'       => esc_html__( 'Hover Background Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color when hover for main menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
            .header-13 .menu--primary .menu__container > li > a:hover,
            .header-13 .menu--primary .menu__container > li.current-menu-item > a',
			'property' => 'background-color',
		),
	),
) );

/*--------------------------------------------------------------
# Header Button
--------------------------------------------------------------*/

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'button_style',
	'label'    => esc_html__( 'Button Style', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'flat-black-alpha-3',
	'choices'  => Atomlab_Helper::get_header_button_style_list(),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_text',
	'label'    => esc_html__( 'Button Text', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Get started', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_link',
	'label'    => esc_html__( 'Button Link', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '#',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'button_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'atomlab' ),
		'1' => esc_html__( 'Yes', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'button_classes',
	'label'       => esc_html__( 'Button Class', 'atomlab' ),
	'description' => esc_html__( 'Add a class name and refer to it in custom CSS.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
) );
