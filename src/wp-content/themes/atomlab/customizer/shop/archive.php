<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'shop_archive_new_days',
	'label'       => esc_html__( 'New Badge (Days)', 'atomlab' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '90',
	'choices'     => array(
		'0'  => esc_html__( 'None', 'atomlab' ),
		'1'  => esc_html__( '1 day', 'atomlab' ),
		'2'  => esc_html__( '2 days', 'atomlab' ),
		'3'  => esc_html__( '3 days', 'atomlab' ),
		'4'  => esc_html__( '4 days', 'atomlab' ),
		'5'  => esc_html__( '5 days', 'atomlab' ),
		'6'  => esc_html__( '6 days', 'atomlab' ),
		'7'  => esc_html__( '7 days', 'atomlab' ),
		'8'  => esc_html__( '8 days', 'atomlab' ),
		'9'  => esc_html__( '9 days', 'atomlab' ),
		'10' => esc_html__( '10 days', 'atomlab' ),
		'15' => esc_html__( '15 days', 'atomlab' ),
		'20' => esc_html__( '20 days', 'atomlab' ),
		'25' => esc_html__( '25 days', 'atomlab' ),
		'30' => esc_html__( '30 days', 'atomlab' ),
		'60' => esc_html__( '60 days', 'atomlab' ),
		'90' => esc_html__( '90 days', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_quick_view',
	'label'       => esc_html__( 'Quick View', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display quick view button', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_compare',
	'label'       => esc_html__( 'Compare', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display compare button', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_wishlist',
	'label'       => esc_html__( 'Wishlist', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display love button', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_hover_image',
	'label'       => esc_html__( 'Hover Image', 'atomlab' ),
	'description' => esc_html__( 'Turn on to show first gallery image when hover', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'atomlab' ),
	'description' => esc_html__( 'Controls the number of products display on shop archive page', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 8,
	'choices'     => array(
		'min'  => 1,
		'max'  => 30,
		'step' => 1,
	),
) );
