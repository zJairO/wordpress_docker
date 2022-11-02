<?php
$section  = 'search_popup';
$priority = 1;
$prefix   = 'search_popup_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'text',
	'label'       => esc_html__( 'Search Popup Text', 'atomlab' ),
	'description' => esc_html__( 'Enter the text that displays below search field in popup search.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Hit enter to search or ESC to close', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'background_color',
	'label'       => esc_html__( 'Background', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color for popup search', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, .85)',
	'output'      => array(
		array(
			'element'  => '.page-popup-search',
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the text color in popup search', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
				.page-popup-search .search-field,
				.page-popup-search .search-field:focus,
				.page-popup-search .form-description',
			'property' => 'color',
		),
		array(
			'element'  => '.page-popup-search .search-field:-webkit-autofill',
			'property' => '-webkit-text-fill-color',
		),
		array(
			'element'  => '.popup-search-opened .page-popup-search .search-field',
			'property' => 'border-bottom-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'icon_color',
	'label'       => esc_html__( 'Icon Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the icon color in popup search', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.popup-search-close',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'icon_hover_color',
	'label'       => esc_html__( 'Icon Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the icon color when hover in popup search', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.popup-search-close:hover',
			'property' => 'color',
		),
	),
) );
