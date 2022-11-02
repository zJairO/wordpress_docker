<?php
$section  = 'maintenance';
$priority = 1;
$prefix   = 'maintenance_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => $prefix . 'single_image',
	'label'       => esc_html__( 'Single Image', 'atomlab' ),
	'description' => esc_html__( 'Select an image file for right image.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => ATOMLAB_THEME_IMAGE_URI . '/maintenance-01-image.png',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'progress_bar',
	'label'       => esc_html__( 'Progress bar', 'atomlab' ),
	'description' => esc_html__( 'Turn on to show progress bar form in maintenance mode', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'atomlab' ),
		'1' => esc_html__( 'Show', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'slider',
	'settings' => $prefix . 'percent',
	'label'    => esc_attr__( 'Percent Done', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 85,
	'choices'  => array(
		'min'  => '1',
		'max'  => '100',
		'step' => '1',
	),
	'output'   => array(
		array(
			'element'  => '
			.maintenance-progress-labels,
			.maintenance-progress',
			'property' => 'width',
			'units'    => '%',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Title', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Site maintenance', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'text',
	'label'       => esc_html__( 'Text', 'atomlab' ),
	'description' => esc_html__( 'Controls the text that display below title.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'We sincerely apologize for the inconvenience. Our site is currently undergoing scheduled maintenance and upgrades, but will return shortly after.
', 'atomlab' ),
) );
