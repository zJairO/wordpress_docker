<?php
$section  = 'top_bar';
$priority = 1;
$prefix   = 'top_bar_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_top_bar',
	'label'    => esc_html__( 'Default Top Bar', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'none',
	'choices'  => array(
		'none' => esc_attr__( 'Hide', 'atomlab' ),
		'01'   => esc_attr__( 'Top Bar 01', 'atomlab' ),
		'02'   => esc_attr__( 'Top Bar 02', 'atomlab' ),
	),
) );
