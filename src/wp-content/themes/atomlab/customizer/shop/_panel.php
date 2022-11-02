<?php
$panel    = 'shop';
$priority = 1;

Atomlab_Kirki::add_section( 'shop_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'shop_single', array(
	'title'    => esc_html__( 'Shop Single', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'shopping_cart', array(
	'title'    => esc_html__( 'Shopping Cart', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
