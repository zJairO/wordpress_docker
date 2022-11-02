<?php
$section  = 'title_bar';
$priority = 1;
$prefix   = 'title_bar_';

$title_bar_stylish = array(
	'default' => esc_html__( 'Default', 'atomlab' ),
	'none'    => esc_html__( 'Hide', 'atomlab' ),
	'01'      => esc_html__( 'Style 01', 'atomlab' ),
);

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'layout',
	'label'    => esc_html__( 'Global Layout', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '01',
	'choices'  => array(
		'none' => esc_html__( 'Hide', 'atomlab' ),
		'01'   => esc_html__( 'Style 01', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'search_title',
	'label'       => esc_html__( 'Search Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text prefix that displays on search results page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Search results for: ', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'home_title',
	'label'       => esc_html__( 'Home Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text that displays on front latest posts page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Blog', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_category_title',
	'label'       => esc_html__( 'Archive Category Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive category page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Category: ', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_tag_title',
	'label'       => esc_html__( 'Archive Tag Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive tag page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Tag: ', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_author_title',
	'label'       => esc_html__( 'Archive Author Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive author page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Author: ', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_year_title',
	'label'       => esc_html__( 'Archive Year Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive year page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Year: ', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_month_title',
	'label'       => esc_html__( 'Archive Month Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive month page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Month: ', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_day_title',
	'label'       => esc_html__( 'Archive Day Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive day page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Day: ', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_blog_title',
	'label'       => esc_html__( 'Single Blog Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Blog', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_portfolio_title',
	'label'       => esc_html__( 'Single Portfolio Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text that displays on single portfolio pages. Leave blank to use portfolio title.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Portfolio', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_product_title',
	'label'       => esc_html__( 'Single Product Heading', 'atomlab' ),
	'description' => esc_html__( 'Enter text that displays on single product pages. Leave blank to use product title.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Shop', 'atomlab' ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_page_title_bar_layout',
	'label'       => esc_html__( 'Single Page Title Bar Layout', 'atomlab' ),
	'description' => esc_html__( 'Select default title Bar that displays on all single pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'default',
	'choices'     => $title_bar_stylish,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_title_bar_layout',
	'label'       => esc_html__( 'Single Blog Page Title Bar Layout', 'atomlab' ),
	'description' => esc_html__( 'Select default title Bar that displays on all single blog post pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'default',
	'choices'     => $title_bar_stylish,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_title_bar_layout',
	'label'       => esc_html__( 'Single Product Page Title Bar Layout', 'atomlab' ),
	'description' => esc_html__( 'Select default title Bar that displays on all single product pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'default',
	'choices'     => $title_bar_stylish,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_title_bar_layout',
	'label'       => esc_html__( 'Single Portfolio Page Title Bar Layout', 'atomlab' ),
	'description' => esc_html__( 'Select default title Bar that displays on all single profolio pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $title_bar_stylish,
) );
