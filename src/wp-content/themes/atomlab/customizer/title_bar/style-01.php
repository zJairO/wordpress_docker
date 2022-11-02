<?php
$section  = 'title_bar_01';
$priority = 1;
$prefix   = 'title_bar_01_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'bg_type',
	'label'       => esc_html__( 'Background Type', 'atomlab' ),
	'description' => esc_html__( 'Controls the background type of the page title bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
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
	'description' => esc_html__( 'Controls the background color of the page title bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '#fff',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'bg_color_2',
	'label'           => esc_html__( 'Color 2', 'atomlab' ),
	'description'     => esc_html__( 'Controls the background color of the page title bar. Use when background type is gradient', 'atomlab' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => '#f7fbfe',
	'active_callback' => array(
		array(
			'setting'  => 'title_bar_01_bg_type',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => $prefix . 'bg_image',
	'label'       => esc_html__( 'Background Image', 'atomlab' ),
	'description' => esc_html__( 'Select an image for the page title bar background. If left empty, the page title bar background color will be used.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'background-image',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_overlay_color',
	'label'       => esc_html__( 'Background Overlay Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background overlay color when has background image of page title bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-overlay',
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the border bottom color of the page title bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ededed',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 239,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 160,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Font Family', 'atomlab' ),
	'description' => esc_html__( 'Controls the font family for the page title heading.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.285',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		'color'          => Atomlab::HEADING_COLOR,
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-01 .page-title-bar-inner .heading',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'heading_font_size',
	'label'     => esc_html__( 'Font Size', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 56,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'breadcrumb_enable',
	'label'    => esc_html__( 'Visibility', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'atomlab' ),
		'1' => esc_html__( 'Yes', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'breadcrumb_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'breadcrumb_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-breadcrumb-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'breadcrumb_typography',
	'label'       => esc_html__( 'Typography', 'atomlab' ),
	'description' => esc_html__( 'Controls the typography for the breadcrumb text.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '700',
		'line-height'    => '1.71',
		'letter-spacing' => '3px',
		'text-transform' => 'uppercase',
		'font-size'      => '14px',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-01 .insight_core_breadcrumb li, .page-title-bar-01 .insight_core_breadcrumb li a',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_text_color',
	'label'       => esc_html__( 'Text Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of text on breadcrumb.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Atomlab::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb li',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_color',
	'label'       => esc_html__( 'Link Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of links on breadcrumb.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ababab',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb a,
                           .insight_core_breadcrumb li + li:before',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover of links on breadcrumb.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb a:hover',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Responsive Options', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Medium Device', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 160,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_md_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 160,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_md_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 50,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_md_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Small Device', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 130,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_sm_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 130,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_sm_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 40,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_sm_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Extra Small Device', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 130,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_xs_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 130,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_xs_media_query(),
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 30,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Atomlab_Helper::get_xs_media_query(),
		),
	),
) );
