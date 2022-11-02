<?php
$panel    = 'shortcode';
$priority = 1;

Atomlab_Kirki::add_section( 'shortcode_animation', array(
	'title'    => esc_html__( 'CSS Animation', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'shortcode_box_icon', array(
	'title'    => esc_html__( 'Box Icon', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
