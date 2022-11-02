<?php
$section             = 'sidebars';
$priority            = 1;
$prefix              = 'sidebars_';
$sidebar_positions   = Atomlab_Helper::get_list_sidebar_positions();
$registered_sidebars = Atomlab_Helper::get_registered_sidebars();

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => sprintf( '<div class="desc">
			<strong class="insight-label insight-label-info">%s</strong>
			<p>%s</p>
			<p>%s</p>
		</div>', esc_html__( 'IMPORTANT NOTE: ', 'atomlab' ), esc_html__( 'Sidebar 2 can only be used if sidebar 1 is selected.', 'atomlab' ), esc_html__( 'Sidebar position option will control the position of sidebar 1. If sidebar 2 is selected, it will display on the opposite side.', 'atomlab' ) ),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'General Settings', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'sidebars_breakpoint',
	'label'       => esc_html__( 'Breakpoint', 'atomlab' ),
	'description' => esc_html__( 'Controls the breakpoint to make sidebars 100% width.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'postMessage',
	'default'     => 768,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'sidebars_below_content_mobile',
	'label'       => esc_html__( 'Sidebars Below Content', 'atomlab' ),
	'description' => esc_html__( 'Move sidebars display after main content on smaller screens.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'No', 'atomlab' ),
		'1' => esc_html__( 'Yes', 'atomlab' ),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Sidebar Layouts', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'single_sidebar_width',
	'label'       => esc_html__( 'Single Sidebar Width', 'atomlab' ),
	'description' => esc_html__( 'Controls the width of the sidebar when only one sidebar is present. Input value as % unit. Ex: 33.33333', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '33.33333',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'single_sidebar_offset',
	'label'       => esc_html__( 'Single Sidebar Offset', 'atomlab' ),
	'description' => esc_html__( 'Controls the offset of the sidebar when only one sidebar is present. Enter value including any valid CSS unit. Ex: 70px.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '30px',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Dual Sidebar Layouts', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'dual_sidebar_width',
	'label'       => esc_html__( 'Dual Sidebar Width', 'atomlab' ),
	'description' => esc_html__( 'Controls the width of sidebars when dual sidebars are present. Enter value including any valid CSS unit. Ex: 33.33333.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '25',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'dual_sidebar_offset',
	'label'       => esc_html__( 'Dual Sidebar Offset', 'atomlab' ),
	'description' => esc_html__( 'Controls the offset of sidebars when dual sidebars are present. Enter value including any valid CSS unit. Ex: 70px.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Pages', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on all pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on all pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );


Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Search Page', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on search results page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on search results page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'search_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Front Latest Posts Page', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on front latest posts page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on front latest posts page.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'home_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Posts', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single blog post pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single blog post pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'post_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Archive', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on blog archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on blog archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Posts', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single portfolio pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single portfolio pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Archive', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on portfolio archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on portfolio archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

//
Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Product', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single product pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single product pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'left',
	'choices'  => $sidebar_positions,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Archive', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on product archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'shop_sidebar',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'atomlab' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on product archive pages.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'atomlab' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'left',
	'choices'  => $sidebar_positions,
) );
