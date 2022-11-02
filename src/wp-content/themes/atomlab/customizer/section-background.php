<?php
$section  = 'background';
$priority = 1;
$prefix   = 'site_background_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Boxed Mode Background', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'image_body',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Controls background of the outer background area in boxed mode.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Content Background', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'image_main_content',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Controls background of the main content area.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => 'inherit',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-content',
		),
	),
) );
