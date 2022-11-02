<?php
$section  = 'header_sticky';
$priority = 1;
$prefix   = 'header_sticky_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Enable', 'atomlab' ),
	'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'behaviour',
	'label'       => esc_html__( 'Behaviour', 'atomlab' ),
	'description' => esc_html__( 'Controls the behaviour of header sticky when you scroll down to page', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'both',
	'choices'     => array(
		'both' => esc_html__( 'Sticky on scroll up/down', 'atomlab' ),
		'up'   => esc_html__( 'Sticky on scroll up', 'atomlab' ),
		'down' => esc_html__( 'Sticky on scroll down', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'height',
	'label'     => esc_html__( 'Height', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 70,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'height',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Controls the background of header sticky.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-color'      => 'rgba( 255, 255, 255, 1 )',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.headroom--not-top #page-header-inner',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Bottom Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the border bottom color of navigation when sticky.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba( 0, 0, 0, 0 )',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'border-bottom-color',
			'suffix'   => '!important',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Navigation', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'item_padding',
	'label'       => esc_html__( 'Item Padding', 'atomlab' ),
	'description' => esc_html__( 'Controls the navigation item level 1 padding of navigation when sticky.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '25px',
		'bottom' => '26px',
		'left'   => '18px',
		'right'  => '18px',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array(
				'.desktop-menu .headroom--not-top.headroom--not-top .menu--primary .menu__container > li > a',
				'.desktop-menu .headroom--not-top.headroom--not-top .menu--primary .menu__container > ul > li >a',
			),
			'property' => 'padding',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of main menu items on sticky header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary > ul > li > a',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items on sticky header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
				.headroom--not-top .menu--primary > ul > li:hover > a,
				.headroom--not-top .menu--primary > ul > li > a:focus,
				.headroom--not-top .menu--primary .current-menu-ancestor > a,
				.headroom--not-top .menu--primary > ul > li.current-menu-item > a,
				.headroom--not-top .menu--primary > ul > li.current-menu-item > a .menu-item-title',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'icon_color',
	'label'       => esc_html__( 'Icon Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of icons in sticky header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => '
			.headroom--not-top .page-open-mobile-menu i,
			.headroom--not-top .page-open-main-menu i,
			.headroom--not-top .popup-search-wrap i,
			.headroom--not-top .mini-cart .mini-cart-icon,
			.headroom--not-top .header-social-networks a',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'icon_hover_color',
	'label'       => esc_html__( 'Icon Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when of icons in sticky header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
			.headroom--not-top .page-open-mobile-menu:hover i,
			.headroom--not-top .page-open-main-menu:hover i,
			.headroom--not-top .popup-search-wrap:hover i,
			.headroom--not-top .mini-cart .mini-cart-icon:hover,
			.headroom--not-top .header-social-networks a:hover',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'button_style',
	'label'    => esc_html__( 'Button Style', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'flat',
	'choices'  => Atomlab_Helper::get_header_button_style_list(),
) );
