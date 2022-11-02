<?php
$section  = 'coming_soon_02';
$priority = 1;
$prefix   = 'coming_soon_02_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Select an image file for background.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => ATOMLAB_THEME_IMAGE_URI . '/coming-soon-02-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'contain',
		'background-attachment' => 'fixed',
		'background-position'   => 'center bottom',
	),
	'output'      => array(
		array(
			'element' => '.page-template-coming-soon-02',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Title', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => wp_kses( __( 'Something <mark>really good</mark> is coming very soon!', 'atomlab' ), array(
		'a'    => array(
			'href'   => array(),
			'target' => array(),
		),
		'mark' => array(),
	) ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'date',
	'settings' => $prefix . 'countdown',
	'label'    => esc_html__( 'Countdown', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => Atomlab_Helper::get_coming_soon_demo_date(),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'mailchimp_enable',
	'label'    => esc_html__( 'Mailchimp Form', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'atomlab' ),
		'1' => esc_html__( 'Show', 'atomlab' ),
	),
) );
