<?php
$section  = 'shop_single';
$priority = 1;
$prefix   = 'single_product_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_categories_enable',
	'label'       => esc_html__( 'Categories', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display the categories.', 'atomlab' ),
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
	'settings'    => 'single_product_tags_enable',
	'label'       => esc_html__( 'Tags', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display the tags.', 'atomlab' ),
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
	'settings'    => 'single_product_sharing_enable',
	'label'       => esc_html__( 'Sharing', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display the sharing.', 'atomlab' ),
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
	'settings'    => 'single_product_up_sells_enable',
	'label'       => esc_html__( 'Up-sells products', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display the up-sells products section.', 'atomlab' ),
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
	'settings'    => 'single_product_related_enable',
	'label'       => esc_html__( 'Related products', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display the related products section.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );
