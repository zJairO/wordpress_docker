<?php
$panel    = 'title_bar';
$priority = 1;

Atomlab_Kirki::add_section( 'title_bar', array(
	'title'    => esc_html__( 'General', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'title_bar_01', array(
	'title'    => esc_html__( 'Style 01', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
