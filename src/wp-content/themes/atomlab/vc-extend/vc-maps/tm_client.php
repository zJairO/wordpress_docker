<?php

class WPBakeryShortCode_TM_Client extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab = esc_html__( 'Slides', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Client Logos', 'atomlab' ),
	'base'                      => 'tm_client',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Normal', 'atomlab' )   => '',
				esc_html__( 'Two Rows', 'atomlab' ) => '2-rows',
			),
			'std'         => '',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'     => esc_html__( 'Auto Play', 'atomlab' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
			'std'         => 5000,
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'atomlab' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 6,
				'md' => 4,
				'sm' => 3,
				'xs' => 2,
			),
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => $slides_tab,
			'heading'    => esc_html__( 'Slides', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Image', 'atomlab' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Image Hover', 'atomlab' ),
					'type'        => 'attach_image',
					'param_name'  => 'image_hover',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Link', 'atomlab' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
					'value'      => esc_html__( 'Link', 'atomlab' ),
				),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
