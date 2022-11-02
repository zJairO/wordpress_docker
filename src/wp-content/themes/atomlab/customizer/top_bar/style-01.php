<?php
$section  = 'top_bar_style_01';
$priority = 1;
$prefix   = 'top_bar_style_01_';

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
			'element'  => '.top-bar-01',
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
			'element'  => '.top-bar-01',
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
		'variant'        => 'italic',
		'line-height'    => '1.71',
		'letter-spacing' => '0',
	),
	'output'      => array(
		array(
			'element' => '.top-bar-01, .top-bar-01 a',
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
			'element'  => '.top-bar-01, .top-bar-01 a',
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
	'default'     => '#6db8f5',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
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
			'element'  => '.top-bar-01',
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
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
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
			'element'  => '.top-bar-01 a',
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
	'default'     => Atomlab::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.top-bar-01 a:hover, .top-bar-01 a:focus',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'icon_color',
	'label'       => esc_html__( 'Icon Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of icons on top bar.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.top-bar-01 .top-bar-info .info-icon',
			'property' => 'color',
		),
	),
) );

// Text

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'text',
	'label'    => esc_html__( 'Text', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Welcome to Atomlab Wordpress theme!', 'atomlab' ),
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
			'text'       => wp_kses( __( '<strong>0122 8899900</strong>', 'atomlab' ), array(
				'strong' => array(),
			) ),
			'icon_class' => 'ion-ios-telephone',
		),
		array(
			'text'       => esc_html__( '614 Destany Village Apt. 968', 'atomlab' ),
			'icon_class' => 'ion-ios-location',
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
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'atomlab' ),
			'description' => esc_html__( 'This will be the link URL', 'atomlab' ),
			'default'     => '',
		),
	),
) );

/*--------------------------------------------------------------
# Top Bar Button
--------------------------------------------------------------*/

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_text',
	'label'    => esc_html__( 'Button Text', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Make an Appointment', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_link',
	'label'    => esc_html__( 'Button link', 'atomlab' ),
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
