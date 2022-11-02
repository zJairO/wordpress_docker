<?php
$section            = 'sliders';
$priority           = 1;
$prefix             = 'sliders_';
$revolution_sliders = array();

if ( is_customize_preview() ) {
	$revolution_sliders = Atomlab_Helper::get_list_revslider();
}

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Search Page', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'atomlab' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Front Latest Posts Page', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'atomlab' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Archive', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'atomlab' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Archive', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'atomlab' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Archive', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'atomlab' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );
