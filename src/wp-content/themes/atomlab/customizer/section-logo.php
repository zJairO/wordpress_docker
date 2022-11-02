<?php
$section  = 'logo';
$priority = 1;
$prefix   = 'logo_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'logo',
	'label'       => esc_html__( 'Default Logo', 'atomlab' ),
	'description' => esc_html__( 'Choose default logo.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'logo_dark',
	'choices'     => array(
		'logo_dark'  => esc_html__( 'Dark Logo', 'atomlab' ),
		'logo_light' => esc_html__( 'Light Logo', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_dark',
	'label'    => esc_html__( 'Dark Version', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => ATOMLAB_THEME_URI . '/assets/images/logo.png',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_light',
	'label'    => esc_html__( 'Light Version', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => ATOMLAB_THEME_URI . '/assets/images/logo_light.png',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Logo Width', 'atomlab' ),
	'description' => esc_html__( 'Ex: 200px', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '153px',
	'output'      => array(
		array(
			'element'  => '.branding__logo img,
			.error404--header .branding__logo img
			',
			'property' => 'width',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Logo Padding', 'atomlab' ),
	'description' => esc_html__( 'Ex: 30px 0px 30px 0px', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '20px',
		'right'  => '0px',
		'bottom' => '20px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.branding__logo img',
			'property' => 'padding',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sticky Logo', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'sticky_logo',
	'label'       => esc_html__( 'Logo', 'atomlab' ),
	'description' => esc_html__( 'Select an image file for your sticky header logo.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => ATOMLAB_THEME_URI . '/assets/images/logo.png',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'sticky_logo_width',
	'label'       => esc_html__( 'Logo Width', 'atomlab' ),
	'description' => esc_html__( 'Controls the width of sticky header logo. Ex: 120px', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '140px',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'width',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => 'sticky_logo_padding',
	'label'       => esc_html__( 'Logo Padding', 'atomlab' ),
	'description' => esc_html__( 'Controls the padding of sticky header logo.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
	),
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'padding',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Mobile Menu Logo', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'mobile_menu_logo',
	'label'       => esc_html__( 'Logo', 'atomlab' ),
	'description' => esc_html__( 'Select an image file for mobile menu logo.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => ATOMLAB_THEME_URI . '/assets/images/logo_simple_dark.png',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'mobile_logo_width',
	'label'       => esc_html__( 'Logo Width', 'atomlab' ),
	'description' => esc_html__( 'Controls the width of mobile menu logo. Ex: 120px', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '56px',
	'output'      => array(
		array(
			'element'  => '.page-mobile-menu-logo img',
			'property' => 'width',
		),
	),
) );
