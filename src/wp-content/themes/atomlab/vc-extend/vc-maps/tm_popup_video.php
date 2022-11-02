<?php

class WPBakeryShortCode_TM_Popup_Video extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Popup Video', 'atomlab' ),
	'base'                      => 'tm_popup_video',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-video',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Poster Style 01', 'atomlab' ) => 'poster-01',
				esc_html__( 'Poster Style 02', 'atomlab' ) => 'poster-02',
				esc_html__( 'Poster Style 03', 'atomlab' ) => 'poster-03',
				esc_html__( 'Button Style 01', 'atomlab' ) => 'button',
				esc_html__( 'Button Style 02', 'atomlab' ) => 'button-02',
				esc_html__( 'Button Style 03', 'atomlab' ) => 'button-03',
				esc_html__( 'Button Style 04', 'atomlab' ) => 'button-04',
			),
			'std'         => 'poster-01',
		),
		array(
			'heading'    => esc_html__( 'Video Url', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'video',
		),
		array(
			'heading'    => esc_html__( 'Video Text', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'video_text',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'button', 'button-02', 'button-04' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Poster Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'poster',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'poster-01', 'poster-02', 'poster-03' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Poster Image Size', 'atomlab' ),
			'description' => esc_html__( 'Controls the size of poster image.', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => array(
				esc_html__( 'Full', 'atomlab' )    => 'full',
				esc_html__( '570x364', 'atomlab' ) => '570x364',
			),
			'std'         => '570x364',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'poster-01', 'poster-02', 'poster-03' ),
			),
		),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
