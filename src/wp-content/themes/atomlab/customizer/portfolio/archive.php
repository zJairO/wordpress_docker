<?php
$section  = 'archive_portfolio';
$priority = 1;
$prefix   = 'archive_portfolio_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'external_url',
	'label'       => esc_html__( 'External Url', 'atomlab' ),
	'description' => esc_html__( 'Go to external portfolio url instead of go to single portfolio pages from portfolio list page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'No', 'atomlab' ),
		'1' => esc_html__( 'Yes', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_style',
	'label'       => esc_html__( 'Portfolio Style', 'atomlab' ),
	'description' => esc_html__( 'Select portfolio style that display for archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'grid',
	'choices'     => array(
		'grid'    => esc_attr__( 'Grid Classic', 'atomlab' ),
		'metro'   => esc_attr__( 'Grid Metro', 'atomlab' ),
		'masonry' => esc_attr__( 'Grid Masonry', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_thumbnail_size',
	'label'    => esc_html__( 'Thumbnail Size', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '480x480',
	'choices'  => array(
		'480x480' => esc_attr__( '480x480', 'atomlab' ),
		'480x311' => esc_attr__( '480x311', 'atomlab' ),
		'481x325' => esc_attr__( '481x325', 'atomlab' ),
		'500x324' => esc_attr__( '500x324', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'number',
	'settings' => 'archive_portfolio_gutter',
	'label'    => esc_html__( 'Gutter', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 30,
	'choices'  => array(
		'min'  => 0,
		'step' => 1,
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => 'archive_portfolio_columns',
	'label'    => esc_html__( 'Columns', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'xs:1;sm:2;md:3;lg:3',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_overlay_style',
	'label'    => esc_html__( 'Columns', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'faded-light',
	'choices'  => array(
		'none'        => esc_attr__( 'None', 'atomlab' ),
		'modern'      => esc_attr__( 'Modern', 'atomlab' ),
		'zoom'        => esc_attr__( 'Image zoom - content below', 'atomlab' ),
		'zoom2'       => esc_attr__( 'Zoom and Move Up - content below', 'atomlab' ),
		'faded'       => esc_attr__( 'Faded', 'atomlab' ),
		'faded-light' => esc_attr__( 'Faded - Light', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_animation',
	'label'       => esc_html__( 'CSS Animation', 'atomlab' ),
	'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'scale-up',
	'choices'     => array(
		'none'             => esc_attr__( 'None', 'atomlab' ),
		'fade-in'          => esc_attr__( 'Fade In', 'atomlab' ),
		'move-up'          => esc_attr__( 'Move Up', 'atomlab' ),
		'scale-up'         => esc_attr__( 'Scale Up', 'atomlab' ),
		'fall-perspective' => esc_attr__( 'Fall Perspective', 'atomlab' ),
		'fly'              => esc_attr__( 'Fly', 'atomlab' ),
		'flip'             => esc_attr__( 'Flip', 'atomlab' ),
		'helix'            => esc_attr__( 'Helix', 'atomlab' ),
		'pop-up'           => esc_attr__( 'Pop Up', 'atomlab' ),
	),
) );
