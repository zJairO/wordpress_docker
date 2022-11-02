<?php
$section  = 'pre_loader';
$priority = 1;
$prefix   = 'pre_loader_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Preloader', 'atomlab' ),
	'description' => esc_html__( 'Turn on to enable preloader.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'background_color',
	'label'       => esc_html__( 'Background Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color for pre loader', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, .85)',
	'output'      => array(
		array(
			'element'  => '.page-loading',
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'shape_color',
	'label'       => esc_html__( 'Shape Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the shape color', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-loading .sk-child',
			'property' => 'background-color',
		),
	),
) );
