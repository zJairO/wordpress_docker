<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Atomlab_Metabox' ) ) {
	class Atomlab_Metabox {

		/**
		 * Atomlab_Metabox constructor.
		 */
		public function __construct() {
			add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}

		/**
		 * Register Metabox
		 *
		 * @param $meta_boxes
		 *
		 * @return array
		 */
		public function register_meta_boxes( $meta_boxes ) {
			$page_registered_sidebars = Atomlab_Helper::get_registered_sidebars( true );

			$general_options = array(
				array(
					'title'  => esc_attr__( 'Layout', 'atomlab' ),
					'fields' => array(
						array(
							'id'      => 'site_layout',
							'type'    => 'select',
							'title'   => esc_attr__( 'Layout', 'atomlab' ),
							'desc'    => esc_attr__( 'Controls the layout of this page.', 'atomlab' ),
							'options' => array(
								''      => esc_html__( 'Default', 'atomlab' ),
								'boxed' => esc_html__( 'Boxed', 'atomlab' ),
								'wide'  => esc_html__( 'Wide', 'atomlab' ),
							),
							'default' => '',
						),
						array(
							'id'    => 'site_width',
							'type'  => 'text',
							'title' => esc_attr__( 'Site Width', 'atomlab' ),
							'desc'  => esc_attr__( 'Controls the site width for this page. Enter value including any valid CSS unit, ex: 1200px. Leave blank to use global setting.', 'atomlab' ),
						),
						array(
							'id'      => 'content_padding',
							'type'    => 'switch',
							'title'   => esc_attr__( 'Page Content Padding', 'atomlab' ),
							'default' => '1',
							'options' => array(
								'0' => esc_html__( 'No Padding', 'atomlab' ),
								'1' => esc_html__( 'Default', 'atomlab' ),
							),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Background', 'atomlab' ),
					'fields' => array(
						array(
							'id'      => 'site_background_message',
							'type'    => 'message',
							'title'   => esc_attr__( 'Info', 'atomlab' ),
							'message' => esc_attr__( 'These options controls the background on boxed mode.', 'atomlab' ),
						),
						array(
							'id'    => 'site_background_color',
							'type'  => 'color',
							'title' => esc_attr__( 'Background Color', 'atomlab' ),
							'desc'  => esc_attr__( 'Controls the background color of the outer background area in boxed mode of this page.', 'atomlab' ),
						),
						array(
							'id'    => 'site_background_image',
							'type'  => 'media',
							'title' => esc_attr__( 'Background Image', 'atomlab' ),
							'desc'  => esc_attr__( 'Controls the background image of the outer background area in boxed mode of this page.', 'atomlab' ),
						),
						array(
							'id'      => 'site_background_repeat',
							'type'    => 'select',
							'title'   => esc_attr__( 'Background Repeat', 'atomlab' ),
							'desc'    => esc_attr__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'atomlab' ),
							'options' => array(
								'no-repeat' => esc_html__( 'No repeat', 'atomlab' ),
								'repeat'    => esc_html__( 'Repeat', 'atomlab' ),
								'repeat-x'  => esc_html__( 'Repeat X', 'atomlab' ),
								'repeat-y'  => esc_html__( 'Repeat Y', 'atomlab' ),
							),
						),
						array(
							'id'      => 'site_background_attachment',
							'type'    => 'select',
							'title'   => esc_attr__( 'Background Attachment', 'atomlab' ),
							'desc'    => esc_attr__( 'Controls the background attachment of the outer background area in boxed mode of this page.', 'atomlab' ),
							'options' => array(
								''       => esc_html__( 'Default', 'atomlab' ),
								'fixed'  => esc_html__( 'Fixed', 'atomlab' ),
								'scroll' => esc_html__( 'Scroll', 'atomlab' ),
							),
						),
						array(
							'id'    => 'site_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'atomlab' ),
							'desc'  => esc_attr__( 'Controls the background position of the outer background area in boxed mode of this page.', 'atomlab' ),
						),
						array(
							'id'      => 'content_background_message',
							'type'    => 'message',
							'title'   => esc_attr__( 'Info', 'atomlab' ),
							'message' => esc_attr__( 'These options controls the background of main content on this page.', 'atomlab' ),
						),
						array(
							'id'    => 'content_background_color',
							'type'  => 'color',
							'title' => esc_attr__( 'Background Color', 'atomlab' ),
							'desc'  => esc_attr__( 'Controls the background color of main content on this page.', 'atomlab' ),
						),
						array(
							'id'    => 'content_background_image',
							'type'  => 'media',
							'title' => esc_attr__( 'Background Image', 'atomlab' ),
							'desc'  => esc_attr__( 'Controls the background image of main content on this page.', 'atomlab' ),
						),
						array(
							'id'      => 'content_background_repeat',
							'type'    => 'select',
							'title'   => esc_attr__( 'Background Repeat', 'atomlab' ),
							'desc'    => esc_attr__( 'Controls the background repeat of main content on this page.', 'atomlab' ),
							'options' => array(
								'no-repeat' => esc_html__( 'No repeat', 'atomlab' ),
								'repeat'    => esc_html__( 'Repeat', 'atomlab' ),
								'repeat-x'  => esc_html__( 'Repeat X', 'atomlab' ),
								'repeat-y'  => esc_html__( 'Repeat Y', 'atomlab' ),
							),
						),
						array(
							'id'    => 'content_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'atomlab' ),
							'desc'  => esc_attr__( 'Controls the background position of main content on this page.', 'atomlab' ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Header', 'atomlab' ),
					'fields' => array(
						array(
							'id'      => 'top_bar_type',
							'type'    => 'select',
							'title'   => esc_attr__( 'Top Bar Type', 'atomlab' ),
							'desc'    => esc_attr__( 'Select top bar type that displays on this page.', 'atomlab' ),
							'default' => '',
							'options' => array(
								''     => esc_html__( 'Default', 'atomlab' ),
								'none' => esc_html__( 'None', 'atomlab' ),
								'01'   => esc_html__( 'Top Bar 01', 'atomlab' ),
								'02'   => esc_html__( 'Top Bar 02', 'atomlab' ),
							),
						),
						array(
							'id'      => 'header_type',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Type', 'atomlab' ),
							'desc'    => esc_attr__( 'Select header type that displays on this page.', 'atomlab' ),
							'default' => '',
							'options' => Atomlab_Helper::get_header_list( true ),
						),
						array(
							'id'      => 'menu_display',
							'type'    => 'select',
							'title'   => esc_attr__( 'Primary menu', 'atomlab' ),
							'desc'    => esc_attr__( 'Select which menu displays on this page.', 'atomlab' ),
							'default' => '',
							'options' => Atomlab_Helper::get_all_menus(),
						),
						array(
							'id'      => 'menu_one_page',
							'type'    => 'switch',
							'title'   => esc_attr__( 'One Page Menu', 'atomlab' ),
							'default' => '0',
							'options' => array(
								'0' => esc_html__( 'Disable', 'atomlab' ),
								'1' => esc_html__( 'Enable', 'atomlab' ),
							),
						),
						array(
							'id'      => 'custom_logo',
							'type'    => 'media',
							'title'   => esc_attr__( 'Custom Logo', 'atomlab' ),
							'desc'    => esc_attr__( 'Select custom logo for this page.', 'atomlab' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_logo_width',
							'type'    => 'text',
							'title'   => esc_attr__( 'Custom Logo Width', 'atomlab' ),
							'desc'    => esc_attr__( 'Controls the width of logo. For ex: 150px', 'atomlab' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_sticky_logo',
							'type'    => 'media',
							'title'   => esc_attr__( 'Custom Sticky Logo', 'atomlab' ),
							'desc'    => esc_attr__( 'Select custom sticky logo for this page.', 'atomlab' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_sticky_logo_width',
							'type'    => 'text',
							'title'   => esc_attr__( 'Custom Sticky Logo Width', 'atomlab' ),
							'desc'    => esc_attr__( 'Controls the width of sticky logo. For ex: 150px', 'atomlab' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Page Title Bar', 'atomlab' ),
					'fields' => array(
						array(
							'id'      => 'page_title_bar_layout',
							'type'    => 'switch',
							'title'   => esc_attr__( 'Layout', 'atomlab' ),
							'default' => 'default',
							'options' => array(
								'default' => esc_html__( 'Default', 'atomlab' ),
								'none'    => esc_html__( 'Hide', 'atomlab' ),
								'01'      => esc_html__( 'Style 01', 'atomlab' ),
							),
						),
						array(
							'id'      => 'page_title_bar_background_color',
							'type'    => 'color',
							'title'   => esc_attr__( 'Background Color', 'atomlab' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background',
							'type'    => 'media',
							'title'   => esc_attr__( 'Background Image', 'atomlab' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background_overlay',
							'type'    => 'color',
							'title'   => esc_attr__( 'Background Overlay', 'atomlab' ),
							'default' => '',
						),
						array(
							'id'    => 'page_title_bar_custom_heading',
							'type'  => 'text',
							'title' => esc_attr__( 'Custom Heading Text', 'atomlab' ),
							'desc'  => esc_attr__( 'Insert custom heading for the page title bar. Leave blank to use default.', 'atomlab' ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Sidebars', 'atomlab' ),
					'fields' => array(
						array(
							'id'      => 'page_sidebar_1',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 1', 'atomlab' ),
							'desc'    => esc_html__( 'Select sidebar 1 that will display on this page.', 'atomlab' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_2',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 2', 'atomlab' ),
							'desc'    => esc_html__( 'Select sidebar 2 that will display on this page.', 'atomlab' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_position',
							'type'    => 'switch',
							'title'   => esc_html__( 'Sidebar Position', 'atomlab' ),
							'default' => 'default',
							'options' => Atomlab_Helper::get_list_sidebar_positions( true ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Sliders', 'atomlab' ),
					'fields' => array(
						array(
							'id'      => 'revolution_slider',
							'type'    => 'select',
							'title'   => esc_attr__( 'Revolution Slider', 'atomlab' ),
							'desc'    => esc_attr__( 'Select the unique name of the slider.', 'atomlab' ),
							'options' => Atomlab_Helper::get_list_revslider(),
						),
						array(
							'id'      => 'slider_position',
							'type'    => 'select',
							'title'   => esc_attr__( 'Slider Position', 'atomlab' ),
							'default' => 'below',
							'options' => array(
								'above' => esc_attr__( 'Above Header', 'atomlab' ),
								'below' => esc_attr__( 'Below Header', 'atomlab' ),
							),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Footer', 'atomlab' ),
					'fields' => array(
						array(
							'id'      => 'footer_page',
							'type'    => 'select',
							'title'   => esc_attr__( 'Footer Page', 'atomlab' ),
							'default' => 'default',
							'options' => Atomlab_Footer::get_list_footers( true ),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_page_options',
				'title'      => esc_html__( 'Page Options', 'atomlab' ),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_post_options',
				'title'      => esc_html__( 'Page Options', 'atomlab' ),
				'post_types' => array( 'post' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_attr__( 'Post', 'atomlab' ),
								'fields' => array(
									array(
										'id'    => 'post_gallery',
										'type'  => 'gallery',
										'title' => esc_attr__( 'Gallery Format', 'atomlab' ),
									),
									array(
										'id'    => 'post_video',
										'type'  => 'textarea',
										'title' => esc_html__( 'Video Format', 'atomlab' ),
									),
									array(
										'id'    => 'post_audio',
										'type'  => 'textarea',
										'title' => esc_html__( 'Audio Format', 'atomlab' ),
									),
									array(
										'id'    => 'post_quote_text',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Text', 'atomlab' ),
									),
									array(
										'id'    => 'post_quote_name',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Name', 'atomlab' ),
									),
									array(
										'id'    => 'post_quote_url',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Url', 'atomlab' ),
									),
									array(
										'id'    => 'post_link',
										'type'  => 'text',
										'title' => esc_html__( 'Link Format', 'atomlab' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_product_options',
				'title'      => esc_html__( 'Page Options', 'atomlab' ),
				'post_types' => array( 'product' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_portfolio_options',
				'title'      => esc_html__( 'Page Options', 'atomlab' ),
				'post_types' => array( 'portfolio' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_attr__( 'Portfolio', 'atomlab' ),
								'fields' => array(
									array(
										'id'      => 'portfolio_layout_style',
										'type'    => 'select',
										'title'   => esc_attr__( 'Single Portfolio Style', 'atomlab' ),
										'desc'    => esc_attr__( 'Select style of this single portfolio post page.', 'atomlab' ),
										'default' => '',
										'options' => array(
											''             => esc_html__( 'Default', 'atomlab' ),
											'left_details' => esc_html__( 'Left Details', 'atomlab' ),
											'flat'         => esc_html__( 'Flat', 'atomlab' ),
											'slider'       => esc_html__( 'Image Slider', 'atomlab' ),
											'video'        => esc_html__( 'Video', 'atomlab' ),
											'fullscreen'   => esc_html__( 'Fullscreen', 'atomlab' ),
										),
									),
									array(
										'id'    => 'portfolio_gallery',
										'type'  => 'gallery',
										'title' => esc_attr__( 'Gallery', 'atomlab' ),
									),
									array(
										'id'    => 'portfolio_video_url',
										'type'  => 'textarea',
										'title' => esc_html__( 'Video Url', 'atomlab' ),
									),
									array(
										'id'    => 'portfolio_client',
										'type'  => 'text',
										'title' => esc_html__( 'Client', 'atomlab' ),
									),
									array(
										'id'    => 'portfolio_date',
										'type'  => 'text',
										'title' => esc_html__( 'Date', 'atomlab' ),
									),
									array(
										'id'    => 'portfolio_awards',
										'type'  => 'editor',
										'title' => esc_html__( 'Awards', 'atomlab' ),
									),
									array(
										'id'    => 'portfolio_team',
										'type'  => 'editor',
										'title' => esc_html__( 'Team', 'atomlab' ),
									),
									array(
										'id'    => 'portfolio_url',
										'type'  => 'text',
										'title' => esc_html__( 'Url', 'atomlab' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_testimonial_options',
				'title'      => esc_html__( 'Testimonial Options', 'atomlab' ),
				'post_types' => array( 'testimonial' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Testimonial Details', 'atomlab' ),
								'fields' => array(
									array(
										'id'      => 'by_line',
										'type'    => 'text',
										'title'   => esc_html__( 'By Line', 'atomlab' ),
										'desc'    => esc_html__( 'Enter a byline for the customer giving this testimonial (for example: "CEO of Thememove").', 'atomlab' ),
										'default' => '',
									),
									array(
										'id'      => 'url',
										'type'    => 'text',
										'title'   => esc_html__( 'Url', 'atomlab' ),
										'desc'    => esc_html__( 'Enter a URL that applies to this customer (for example: https://www.thememove.com/).', 'atomlab' ),
										'default' => '',
									),
									array(
										'id'      => 'rating',
										'type'    => 'select',
										'title'   => esc_attr__( 'Rating', 'atomlab' ),
										'default' => '',
										'options' => array(
											''  => esc_html__( 'Select a rating', 'atomlab' ),
											'1' => esc_html__( '1 Star', 'atomlab' ),
											'2' => esc_html__( '2 Stars', 'atomlab' ),
											'3' => esc_html__( '3 Stars', 'atomlab' ),
											'4' => esc_html__( '4 Stars', 'atomlab' ),
											'5' => esc_html__( '5 Stars', 'atomlab' ),
										),
									),
								),
							),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_footer_options',
				'title'      => esc_html__( 'Footer Options', 'atomlab' ),
				'post_types' => array( 'ic_footer' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Effect', 'atomlab' ),
								'fields' => array(
									array(
										'id'      => 'effect',
										'type'    => 'switch',
										'title'   => esc_attr__( 'Footer Effect', 'atomlab' ),
										'default' => '',
										'options' => array(
											''         => esc_html__( 'Normal', 'atomlab' ),
											'parallax' => esc_html__( 'Parallax', 'atomlab' ),
										),
									),
								),
							),
							array(
								'title'  => esc_html__( 'Styling', 'atomlab' ),
								'fields' => array(
									array(
										'id'      => 'widget_title_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Widget Title Color', 'atomlab' ),
										'desc'    => esc_attr__( 'Controls the color of widget title.', 'atomlab' ),
										'default' => '#cccccc',
									),
									array(
										'id'      => 'text_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Text Color', 'atomlab' ),
										'desc'    => esc_attr__( 'Controls the color of footer text.', 'atomlab' ),
										'default' => '#7e7e7e',
									),
									array(
										'id'      => 'link_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Link Color', 'atomlab' ),
										'desc'    => esc_attr__( 'Controls the color of footer links.', 'atomlab' ),
										'default' => '#7e7e7e',
									),
									array(
										'id'      => 'link_hover_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Link Hover Color', 'atomlab' ),
										'desc'    => esc_attr__( 'Controls the color when hover of footer links.', 'atomlab' ),
										'default' => Atomlab::SECONDARY_COLOR,
									),
								),
							),
						),
					),
				),
			);

			$meta_boxes = apply_filters( 'atomlab_register_meta_boxes', $meta_boxes, $general_options );

			return $meta_boxes;
		}

	}

	new Atomlab_Metabox();
}
