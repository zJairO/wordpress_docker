<?php
$section  = 'socials';
$priority = 1;
$prefix   = 'social_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'social_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'atomlab' ),
		'1' => esc_html__( 'Yes', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'repeater',
	'settings'  => 'social_link',
	'section'   => $section,
	'priority'  => $priority ++,
	'choices'   => array(
		'labels' => array(
			'add-new-row' => esc_html__( 'Add new social network', 'atomlab' ),
		),
	),
	'row_label' => array(
		'type'  => 'field',
		'field' => 'tooltip',
	),
	'default'   => array(
		array(
			'tooltip'    => esc_html__( 'Twitter', 'atomlab' ),
			'icon_class' => 'ion-social-twitter',
			'link_url'   => 'https://twitter.com',
		),
		array(
			'tooltip'    => esc_html__( 'Facebook', 'atomlab' ),
			'icon_class' => 'ion-social-facebook',
			'link_url'   => 'https://facebook.com',
		),
		array(
			'tooltip'    => esc_html__( 'Instagram', 'atomlab' ),
			'icon_class' => 'ion-social-instagram',
			'link_url'   => 'https://www.instagram.com',
		),
		array(
			'tooltip'    => esc_html__( 'Linkedin', 'atomlab' ),
			'icon_class' => 'ion-social-linkedin',
			'link_url'   => 'https://www.linkedin.com',
		),
	),
	'fields'    => array(
		'tooltip'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Tooltip', 'atomlab' ),
			'description' => esc_html__( 'Enter your hint text for your icon', 'atomlab' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon Class', 'atomlab' ),
			'description' => esc_html__( 'This will be the icon class for your link', 'atomlab' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'atomlab' ),
			'description' => esc_html__( 'This will be the link URL', 'atomlab' ),
			'default'     => '',
		),
	),
) );
