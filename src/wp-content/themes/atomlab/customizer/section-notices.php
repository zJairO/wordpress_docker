<?php
$section  = 'notices';
$priority = 1;
$prefix   = 'notice_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'notice_cookie_enable',
	'label'       => esc_html__( 'Cookie Notice', 'atomlab' ),
	'description' => esc_html__( 'The notice about cookie auto show when a user visits the site.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'notice_cookie_messages',
	'label'       => esc_html__( 'Cookie Notice Messages', 'atomlab' ),
	'description' => esc_html__( 'Enter the messages that displays for cookie notice.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => wp_kses( __( 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.', 'atomlab' ), 'atomlab-default' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'notice_cookie_ok',
	'label'       => esc_html__( 'Cookie Notice OK', 'atomlab' ),
	'description' => esc_html__( 'Enter the messages that displays for cookie notice when okay.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => wp_kses( __( 'Thank you! Hope you have the best experience on our website.', 'atomlab' ), 'atomlab-default' ),
) );
