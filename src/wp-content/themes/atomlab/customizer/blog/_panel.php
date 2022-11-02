<?php
$panel    = 'blog';
$priority = 1;

Atomlab_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'blog_single', array(
	'title'    => esc_html__( 'Blog Single Post', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
