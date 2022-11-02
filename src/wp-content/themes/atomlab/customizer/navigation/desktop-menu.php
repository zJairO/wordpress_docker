<?php
$section  = 'navigation';
$priority = 1;
$prefix   = 'navigation_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Dropdown', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'dropdown_link_typography',
	'label'       => esc_html__( 'Typography', 'atomlab' ),
	'description' => esc_html__( 'Controls the typography for all dropdown menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.2',
		'letter-spacing' => '0em',
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.menu--primary .sub-menu a, .menu--primary .children a, .menu--primary .tm-list .item-wrapper',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'atomlab' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.menu--primary .sub-menu a, .menu--primary .children a, .menu--primary .tm-list .item-title',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_bg_color',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color for dropdown menu', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu',
				'.menu--primary .children',
			),
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_border_bottom_color',
	'label'       => esc_html__( 'Border Bottom', 'atomlab' ),
	'description' => esc_html__( 'Controls the border bottom color for dropdown menu', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => array(
				'.desktop-menu .menu--primary .sub-menu,
                .desktop-menu .menu--primary .children',
			),
			'property' => 'border-bottom-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Atomlab::THIRD_COLOR,
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu a',
				'.menu--primary .children a',
				'.menu--primary .tm-list .item-wrapper',
			),
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_hover_color',
	'label'       => esc_html__( 'Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover for dropdown menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu li:hover > a',
				'.menu--primary .children li:hover > a',
				'.menu--primary .tm-list li:hover .item-wrapper',
				'.menu--primary .sub-menu li:hover > a:after',
				'.menu--primary .children li:hover > a:after',
				'.menu--primary .sub-menu li.current-menu-item > a',
				'.menu--primary .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_link_hover_bg_color',
	'label'       => esc_html__( 'Hover Background', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color when hover for dropdown menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba( 255, 255, 255, 0 )',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu li:hover > a',
				'.menu--primary .children li:hover > a',
				'.menu--primary .tm-list li:hover > a',
				'.menu--primary .sub-menu li.current-menu-item > a',
				'.menu--primary .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_separator_top_color',
	'label'       => esc_html__( 'Separator', 'atomlab' ),
	'description' => esc_html__( 'Controls the separator top color between dropdown menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba( 255, 255, 255, 0 )',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .children li + li > a',
				'.menu--primary .sub-menu li + li > a',
				'.menu--primary .tm-list li + li .item-wrapper',
				'.menu--primary .mega-menu .menu li + li > a',
			),
			'property' => 'border-color',
		),
	),
) );
