<?php
$panel    = 'advanced';
$priority = 1;

Atomlab_Kirki::add_section( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'pre_loader', array(
	'title'    => esc_html__( 'Pre Loader', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'light_gallery', array(
	'title'    => esc_html__( 'Light Gallery', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
