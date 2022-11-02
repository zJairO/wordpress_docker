<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';

$headers = Atomlab_Helper::get_header_list( true );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'global_header',
	'label'       => esc_html__( 'Default Header', 'atomlab' ),
	'description' => esc_html__( 'Select default header type for your site.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '02',
	'choices'     => Atomlab_Helper::get_header_list(),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_page_header_type',
	'label'       => esc_html__( 'Single Page', 'atomlab' ),
	'description' => esc_html__( 'Select default header type that displays on all single pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $headers,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_post_header_type',
	'label'       => esc_html__( 'Single Blog', 'atomlab' ),
	'description' => esc_html__( 'Select default header type that displays on all single blog post pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $headers,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_product_header_type',
	'label'       => esc_html__( 'Archive Product', 'atomlab' ),
	'description' => esc_html__( 'Select default header type that displays on all archive product.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '02',
	'choices'     => $headers,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_product_header_type',
	'label'       => esc_html__( 'Single Product', 'atomlab' ),
	'description' => esc_html__( 'Select default header type that displays on all single product pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '02',
	'choices'     => $headers,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_header_type',
	'label'       => esc_html__( 'Archive Portfolio', 'atomlab' ),
	'description' => esc_html__( 'Select default header type that displays on all archive portfolio.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $headers,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_header_type',
	'label'       => esc_html__( 'Single Portfolio', 'atomlab' ),
	'description' => esc_html__( 'Select default header type that displays on all single portfolio pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '01',
	'choices'     => $headers,
) );
