<?php
$section  = 'social_sharing';
$priority = 1;
$prefix   = 'social_sharing_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'atomlab' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array( 'facebook', 'twitter', 'linkedin', 'google_plus', 'tumblr', 'email' ),
	'choices'     => array(
		'facebook'    => esc_attr__( 'Facebook', 'atomlab' ),
		'twitter'     => esc_attr__( 'Twitter', 'atomlab' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'atomlab' ),
		'google_plus' => esc_attr__( 'Google+', 'atomlab' ),
		'tumblr'      => esc_attr__( 'Tumblr', 'atomlab' ),
		'email'       => esc_attr__( 'Email', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'sortable',
	'settings'    => $prefix . 'order',
	'label'       => esc_attr__( 'Order', 'atomlab' ),
	'description' => esc_html__( 'Controls the order of social share links.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'facebook',
		'twitter',
		'google_plus',
		'tumblr',
		'linkedin',
		'email',
	),
	'choices'     => array(
		'facebook'    => esc_attr__( 'Facebook', 'atomlab' ),
		'twitter'     => esc_attr__( 'Twitter', 'atomlab' ),
		'google_plus' => esc_attr__( 'Google+', 'atomlab' ),
		'tumblr'      => esc_attr__( 'Tumblr', 'atomlab' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'atomlab' ),
		'email'       => esc_attr__( 'Email', 'atomlab' ),
	),
) );
