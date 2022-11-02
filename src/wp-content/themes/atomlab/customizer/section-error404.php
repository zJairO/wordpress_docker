<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'error404_page_title',
	'label'       => esc_html__( 'Title', 'atomlab' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Oops! Page not found!', 'atomlab' ),
) );
