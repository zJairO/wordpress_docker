<?php
$section  = 'shortcode_animation';
$priority = 1;
$prefix   = 'shortcode_animation_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shortcode_animation_mobile_enable',
	'label'       => esc_html__( 'Mobile Animation', 'atomlab' ),
	'description' => esc_html__( 'Controls the css animations on mobile & tablet.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'None', 'atomlab' ),
		'1' => esc_html__( 'Yes', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_heading_css_animation',
	'label'    => esc_html__( 'Heading', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'move-up',
	'choices'  => Atomlab_Helper::get_animation_list(),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_button_css_animation',
	'label'    => esc_html__( 'Button', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'move-up',
	'choices'  => Atomlab_Helper::get_animation_list(),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_image_css_animation',
	'label'    => esc_html__( 'Single Image', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'move-up',
	'choices'  => Atomlab_Helper::get_animation_list(),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_blog_css_animation',
	'label'    => esc_html__( 'Blog', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'move-up',
	'choices'  => Atomlab_Helper::get_animation_list(),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_portfolio_css_animation',
	'label'    => esc_html__( 'Portfolio', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'move-up',
	'choices'  => Atomlab_Helper::get_animation_list(),
) );
