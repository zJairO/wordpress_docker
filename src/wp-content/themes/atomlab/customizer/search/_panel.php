<?php
$panel    = 'search';
$priority = 1;

Atomlab_Kirki::add_section( 'search_page', array(
	'title'    => esc_html__( 'Search Page', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'search_popup', array(
	'title'    => esc_html__( 'Search Popup', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
