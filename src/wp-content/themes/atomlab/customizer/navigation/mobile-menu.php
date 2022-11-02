<?php
$section  = 'navigation_mobile';
$priority = 1;
$prefix   = 'mobile_menu_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'breakpoint',
	'label'       => esc_html__( 'Breakpoint', 'atomlab' ),
	'description' => esc_html__( 'Controls the breakpoint of the mobile menu.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'postMessage',
	'default'     => 1199,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typo',
	'label'       => esc_html__( 'Typography', 'atomlab' ),
	'description' => esc_html__( 'Controls the typography for all mobile menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '700',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .menu__container a, .page-mobile-main-menu .menu__container .tm-list__title',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_bg',
	'label'       => esc_html__( 'Header Background Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color of the mobile menu header.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-menu-header',
			'property' => 'background',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'close_button_color',
	'label'       => esc_html__( 'Close Button Color', 'frankcoin' ),
	'description' => esc_html__( 'Controls the color of close button.', 'frankcoin' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default Color', 'frankcoin' ),
		'hover'   => esc_attr__( 'Hover Color', 'frankcoin' ),
	),
	'default'     => array(
		'default' => '#222222',
		'hover'   => Atomlab::SECONDARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '.page-close-mobile-menu',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-close-mobile-menu:hover',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'bg_type',
	'label'       => esc_html__( 'Background Type', 'atomlab' ),
	'description' => esc_html__( 'Controls the background type of the mobile menu.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'gradient',
	'choices'     => array(
		'solid'    => esc_html__( 'Solid', 'atomlab' ),
		'gradient' => esc_html__( 'Gradient', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color_1',
	'label'       => esc_html__( 'Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color of the mobile menu.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '#0B88EE',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'bg_color_2',
	'label'           => esc_html__( 'Color 2', 'atomlab' ),
	'description'     => esc_html__( 'Controls the background color of the mobile menu. Use when background type is gradient', 'atomlab' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => '#2AC3DB',
	'active_callback' => array(
		array(
			'setting'  => 'mobile_menu_bg_type',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => $prefix . 'text_align',
	'label'     => esc_html__( 'Text Align', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => 'left',
	'choices'   => array(
		'left'   => esc_html__( 'Left', 'atomlab' ),
		'center' => esc_html__( 'Center', 'atomlab' ),
		'right'  => esc_html__( 'Right', 'atomlab' ),
	),
	'output'    => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container',
			'property' => 'text-align',
		),
	),
) );

// Level 1.

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Level 1', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_padding',
	'label'     => esc_html__( 'Item Padding', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => '18px',
		'bottom' => '18px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'item_font_size',
	'label'       => esc_html__( 'Font Size', 'atomlab' ),
	'description' => esc_html__( 'Controls the font size of items level 1.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 24,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of items level 1.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0.7)',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover of items level 1.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a:hover,
            .page-mobile-main-menu .menu__container > li.opened > a',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'divider_color',
	'label'       => esc_html__( 'Divider Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the divider color between items level 1', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0.2)',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li + li > a, .page-mobile-main-menu .menu__container > li.opened > a',
			'property' => 'border-color',
		),
	),
) );

// Mobile Menu Drop down Menu.

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sub Items', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'sub_item_padding',
	'label'     => esc_html__( 'Item Padding', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => array(
		'top'    => '10px',
		'bottom' => '10px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .sub-menu a',
			),
			'property' => 'padding',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'sub_item_font_size',
	'label'       => esc_html__( 'Font Size', 'atomlab' ),
	'description' => esc_html__( 'Controls the font size of sub items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 17,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a,
			.page-mobile-main-menu .tm-list__item
			',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_color',
	'label'       => esc_html__( 'Link Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of sub items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0.7)',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .sub-menu a, .page-mobile-main-menu .tm-list__item',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover of sub items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .sub-menu a:hover,
            .page-mobile-main-menu .tm-list__item:hover,
            .page-mobile-main-menu .sub-menu .opened > a',
			'property' => 'color',
		),
	),
) );

// Widget Title

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'widget_title_typo',
	'label'       => esc_html__( 'Typography', 'atomlab' ),
	'description' => esc_html__( 'Controls the typography for all mobile menu items.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '700',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'text-transform' => 'uppercase',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .widgettitle',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'widget_title_font_size',
	'label'       => esc_html__( 'Font Size', 'atomlab' ),
	'description' => esc_html__( 'Controls the font size of widget title in sub mega menu.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .widgettitle',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'widget_title_color',
	'label'       => esc_html__( 'Widget Title Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of widget title.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .widgettitle',
			'property' => 'color',
		),
	),
) );

$button_selector       = '.tm-button.mobile-menu-button';
$button_hover_selector = '.tm-button.mobile-menu-button:hover';

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'button_color',
	'label'       => esc_html__( 'Button Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of button.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'atomlab' ),
		'background' => esc_attr__( 'Background', 'atomlab' ),
		'border'     => esc_attr__( 'Border', 'atomlab' ),
	),
	'default'     => array(
		'color'      => Atomlab::SECONDARY_COLOR,
		'background' => '#fff',
		'border'     => '#fff',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => $button_selector,
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => $button_selector,
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => $button_selector,
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'button_hover_color',
	'label'       => esc_html__( 'Button Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of button when hover.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'atomlab' ),
		'background' => esc_attr__( 'Background', 'atomlab' ),
		'border'     => esc_attr__( 'Border', 'atomlab' ),
	),
	'default'     => array(
		'color'      => '#fff',
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => '#fff',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => $button_hover_selector,
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => $button_hover_selector,
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => $button_hover_selector,
			'property' => 'background-color',
		),
	),
) );
