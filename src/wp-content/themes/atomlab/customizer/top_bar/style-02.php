<?php
$section  = 'top_bar_style_02';
$priority = 1;
$prefix   = 'top_bar_style_02_';

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
			'element'  => '.top-bar-02',
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
			'element'  => '.top-bar-02',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_html__( 'Typography', 'atomlab' ),
	'description' => esc_html__( 'These settings control the typography of texts of top bar section.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => 'normal',
		'line-height'    => '1.71',
		'letter-spacing' => '0',
	),
	'output'      => array(
		array(
			'element' => '.top-bar-02, .top-bar-02 a',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'font_size',
	'label'     => esc_html__( 'Font size', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-02, .top-bar-02 a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color of top bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#222',
	'output'      => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Bottom Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the border bottom color of top bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'border-bottom-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of text on top bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#ababab',
	'output'      => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of links on top bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.top-bar-02 a',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color when hover of links on top bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.top-bar-02 a:hover, .top-bar-02 a:focus',
			'property' => 'color',
		),
	),
) );

//Info List.

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'repeater',
	'settings'  => $prefix . 'info',
	'label'     => esc_html__( 'Info', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'choices'   => array(
		'labels' => array(
			'add-new-row' => esc_html__( 'Add new info', 'atomlab' ),
		),
	),
	'row_label' => array(
		'type'  => 'field',
		'field' => 'text',
	),
	'default'   => array(
		array(
			'text'       => esc_html__( 'Trending', 'atomlab' ),
			'icon_class' => 'ion-flash',
			'icon_color' => '#0D3BFF',
			'link_url'   => '#',
		),
		array(
			'text'       => esc_html__( 'Hot', 'atomlab' ),
			'icon_class' => 'ion-flame',
			'icon_color' => '#D3122A',
			'link_url'   => '#',
		),
		array(
			'text'       => esc_html__( 'Popular', 'atomlab' ),
			'icon_class' => 'ion-android-star',
			'icon_color' => '#FFC929',
			'link_url'   => '#',
		),
	),
	'fields'    => array(
		'text'       => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Text', 'atomlab' ),
			'description' => esc_html__( 'Enter your text for your info item', 'atomlab' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Font Icon Class', 'atomlab' ),
			'description' => esc_html__( 'This will be the icon class for your item', 'atomlab' ),
			'default'     => '',
		),
		'icon_color' => array(
			'type'        => 'color-alpha',
			'label'       => esc_html__( 'Icon Color', 'atomlab' ),
			'description' => esc_html__( 'Control the color of item icon', 'atomlab' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'atomlab' ),
			'description' => esc_html__( 'This will be the link URL', 'atomlab' ),
			'default'     => '',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'social_enable',
	'label'       => esc_html__( 'Social Networks', 'atomlab' ),
	'description' => esc_html__( 'Controls the display of social networks.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'atomlab' ),
		'1' => esc_html__( 'Show', 'atomlab' ),
	),
) );
