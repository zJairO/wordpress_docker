<?php
$panel    = 'portfolio';
$priority = 1;

Atomlab_Kirki::add_section( 'archive_portfolio', array(
	'title'    => esc_html__( 'Portfolio Archive', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'single_portfolio', array(
	'title'    => esc_html__( 'Portfolio Single', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
