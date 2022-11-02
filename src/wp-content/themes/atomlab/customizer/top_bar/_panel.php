<?php
$panel    = 'top_bar';
$priority = 1;

Atomlab_Kirki::add_section( 'top_bar', array(
	'title'    => esc_html__( 'General', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'top_bar_style_01', array(
	'title'    => esc_html__( 'Top Bar Style 01', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'top_bar_style_02', array(
	'title'    => esc_html__( 'Top Bar Style 02', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
