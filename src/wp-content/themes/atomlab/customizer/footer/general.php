<?php
$section  = 'footer';
$priority = 1;
$prefix   = 'footer_';

$pages = array();

if ( is_customize_preview() ) {
	$pages = Atomlab_Footer::get_list_footers();
}

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'page',
	'label'       => esc_html__( 'Footer', 'atomlab' ),
	'description' => esc_html__( 'Select a default footer for all pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'footer-01',
	'choices'     => $pages,
) );
