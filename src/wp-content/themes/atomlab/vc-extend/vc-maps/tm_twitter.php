<?php

class WPBakeryShortCode_TM_Twitter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$_slider_tab = esc_html__( 'Slider Settings', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Twitter', 'atomlab' ),
	'base'                      => 'tm_twitter',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-twitter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List', 'atomlab' )            => 'list',
				esc_html__( 'Slider', 'atomlab' )          => 'slider',
				esc_html__( 'Slider Quote', 'atomlab' )    => 'slider-quote',
				esc_html__( 'Slider Quote 02', 'atomlab' ) => 'slider-quote-02',
			),
			'std'         => 'slider-quote',
		),
		array(
			'heading'    => esc_html__( 'Consumer Key', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_key',
		),
		array(
			'heading'    => esc_html__( 'Consumer Secret', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_secret',
		),
		array(
			'heading'    => esc_html__( 'Access Token', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'access_token',
		),
		array(
			'heading'    => esc_html__( 'Access Token Secret', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'access_token_secret',
		),
		array(
			'heading'    => esc_html__( 'Twitter Username', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'heading'    => esc_html__( 'Number of tweets', 'atomlab' ),
			'type'       => 'number',
			'param_name' => 'number_items',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
			'std'        => esc_html__( 'From Twitter', 'atomlab' ),
		),
		array(
			'heading'    => esc_html__( 'Show date.', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'show_date',
			'value'      => array(
				esc_html__( 'Yes', 'atomlab' ) => '1',
			),
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'       => $_slider_tab,
			'heading'     => esc_html__( 'Speed', 'atomlab' ),
			'description' => esc_html__( 'Duration of transition between slides (in ms), ex: 1000. Leave blank to use default.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_speed',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-02',
				),
			),
		),
		array(
			'group'       => $_slider_tab,
			'heading'     => esc_html__( 'Auto Play', 'atomlab' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-02',
				),
			),
		),
		array(
			'group'      => $_slider_tab,
			'heading'    => esc_html__( 'Navigation', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Atomlab_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-02',
				),
			),
		),
		array(
			'group'      => $_slider_tab,
			'heading'    => esc_html__( 'Pagination', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Atomlab_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
					'slider-quote-02',
				),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
