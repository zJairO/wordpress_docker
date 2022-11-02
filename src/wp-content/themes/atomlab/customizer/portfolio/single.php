<?php
$section  = 'single_portfolio';
$priority = 1;
$prefix   = 'single_portfolio_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_sticky_detail_enable',
	'label'       => esc_html__( 'Sticky Detail Column', 'atomlab' ),
	'description' => esc_html__( 'Turn on to enable sticky of detail column.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_style',
	'label'       => esc_html__( 'Single Portfolio Style', 'atomlab' ),
	'description' => esc_html__( 'Select style of all single portfolio post pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'flat',
	'choices'     => array(
		'left_details' => esc_attr__( 'Left Details', 'atomlab' ),
		'slider'       => esc_attr__( 'Image Slider', 'atomlab' ),
		'flat'         => esc_attr__( 'Flat', 'atomlab' ),
		'video'        => esc_attr__( 'Video', 'atomlab' ),
		'fullscreen'   => esc_attr__( 'Fullscreen', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_related_enable',
	'label'       => esc_html__( 'Related Portfolios', 'atomlab' ),
	'description' => esc_html__( 'Turn on this option to display related portfolio section.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'portfolio_related_title',
	'label'           => esc_html__( 'Related Title Section', 'atomlab' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => esc_html__( 'Related Projects', 'atomlab' ),
	'active_callback' => array(
		array(
			'setting' => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => 'portfolio_related_by',
	'label'           => esc_attr__( 'Related By', 'atomlab' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => array( 'portfolio_category' ),
	'choices'         => array(
		'portfolio_category' => esc_html__( 'Portfolio Category', 'atomlab' ),
		'portfolio_tags'     => esc_html__( 'Portfolio Tags', 'atomlab' ),
	),
	'active_callback' => array(
		array(
			'setting' => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );


Atomlab_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'portfolio_related_number',
	'label'           => esc_html__( 'Number portfolios', 'atomlab' ),
	'description'     => esc_html__( 'Controls the number of related portfolios', 'atomlab' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => 5,
	'choices'         => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting' => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_comment_enable',
	'label'       => esc_html__( 'Comments', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_share_enable',
	'label'       => esc_html__( 'Share', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display Share list on single portfolio posts.', 'atomlab' ),
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
	'settings'    => 'single_portfolio_meta_view_enable',
	'label'       => esc_html__( 'View', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display View on single portfolio posts.', 'atomlab' ),
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
	'settings'    => 'single_portfolio_meta_like_enable',
	'label'       => esc_html__( 'Like', 'atomlab' ),
	'description' => esc_html__( 'Turn on to display Like on single portfolio posts.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'atomlab' ),
		'1' => esc_html__( 'On', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'single_portfolio_return_link',
	'label'       => esc_html__( 'Return button url', 'atomlab' ),
	'description' => esc_html__( 'Controls the url when you click on return button', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '/portfolio',
) );
