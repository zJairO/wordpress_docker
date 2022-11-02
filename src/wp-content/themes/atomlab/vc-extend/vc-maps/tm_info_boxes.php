<?php

class WPBakeryShortCode_TM_Info_Boxes extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Carousel Settings', 'atomlab' );

vc_map( array(
	'name'     => esc_html__( 'Info Boxes', 'atomlab' ),
	'base'     => 'tm_info_boxes',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-info-boxes',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Info Boxes Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Metro', 'atomlab' ) => 'metro',
			),
			'std'         => 'metro',
		),
		array(
			'heading'    => esc_html__( 'Metro Layout', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'metro_layout',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Size', 'atomlab' ),
					'type'        => 'dropdown',
					'param_name'  => 'size',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Width 1 - Height 1', 'atomlab' ) => '1:1',
						esc_html__( 'Width 1 - Height 2', 'atomlab' ) => '1:2',
						esc_html__( 'Width 2 - Height 1', 'atomlab' ) => '2:1',
						esc_html__( 'Width 2 - Height 2', 'atomlab' ) => '2:2',
					),
					'std'         => '1:1',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'size' => '2:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Columns', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 6,
			'step'        => 1,
			'suffix'      => '',
			'media_query' => array(
				'lg' => '3',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'atomlab' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 0,
			'min'         => 0,
			'max'         => 100,
			'step'        => 2,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
		array(

			'group'      => esc_html__( 'Items', 'atomlab' ),
			'heading'    => esc_html__( 'Items', 'atomlab' ),
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
					'heading'     => esc_html__( 'Skin', 'atomlab' ),
					'type'        => 'dropdown',
					'param_name'  => 'skin',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Primary', 'atomlab' )   => 'primary',
						esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
					),
					'std'         => 'primary',
				),
				array(
					'heading'     => esc_html__( 'Title', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Text', 'atomlab' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );

