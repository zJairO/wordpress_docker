<?php
$section  = 'search_page';
$priority = 1;
$prefix   = 'search_page_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_filter',
	'label'       => esc_html__( 'Search Results Filter', 'atomlab' ),
	'description' => esc_html__( 'Controls the type of content that displays in search results.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'all',
	'choices'     => array(
		'all'       => esc_html__( 'All Post Types and Pages', 'atomlab' ),
		'page'      => esc_html__( 'Only Pages', 'atomlab' ),
		'post'      => esc_html__( 'Only Blog Posts', 'atomlab' ),
		'portfolio' => esc_html__( 'Only Portfolio Items', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'search_page_number_results',
	'label'       => esc_html__( 'Number of Search Results Per Page', 'atomlab' ),
	'description' => esc_html__( 'Controls the number of search results per page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 10,
	'choices'     => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'search_page_search_form_display',
	'label'       => esc_html__( 'Search Form Display', 'atomlab' ),
	'description' => esc_html__( 'Controls the display of the search form on the search results page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'disabled',
	'choices'     => array(
		'below'    => esc_html__( 'Below Result List', 'atomlab' ),
		'above'    => esc_html__( 'Above Result List', 'atomlab' ),
		'disabled' => esc_html__( 'Hide', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'search_page_no_results_text',
	'label'       => esc_html__( 'No Results Text', 'atomlab' ),
	'description' => esc_html__( 'Enter the text that displays on search no results page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'atomlab' ),
) );
