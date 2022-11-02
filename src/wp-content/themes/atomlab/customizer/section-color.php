<?php
$section  = 'color_';
$priority = 1;
$prefix   = 'color_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'primary_color',
	'label'       => esc_html__( 'Primary Color', 'atomlab' ),
	'description' => esc_html__( 'A light color.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::PRIMARY_COLOR,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'secondary_color',
	'label'       => esc_html__( 'Secondary Color', 'atomlab' ),
	'description' => esc_html__( 'A dark color.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'third_color',
	'label'       => esc_html__( 'Third Color', 'atomlab' ),
	'description' => esc_html__( 'A dark color.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::THIRD_COLOR,
) );
