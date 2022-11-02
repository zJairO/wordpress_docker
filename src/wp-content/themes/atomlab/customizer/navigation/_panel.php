<?php
$panel    = 'navigation';
$priority = 1;

Atomlab_Kirki::add_section( 'navigation', array(
	'title'    => esc_html__( 'Desktop Menu', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'navigation_minimal', array(
	'title'    => esc_html__( 'Off Canvas Menu', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'navigation_mobile', array(
	'title'    => esc_html__( 'Mobile Menu', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
