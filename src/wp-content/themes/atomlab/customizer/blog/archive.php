<?php
$section  = 'blog_archive';
$priority = 1;
$prefix   = 'blog_archive_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'style',
	'label'       => esc_html__( 'Blog Style', 'atomlab' ),
	'description' => esc_html__( 'Select blog style that display for archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'list',
	'choices'     => array(
		'list'             => esc_html__( 'List Large Image', 'atomlab' ),
		'small_image_list' => esc_html__( 'List Small Image', 'atomlab' ),
	),
) );
