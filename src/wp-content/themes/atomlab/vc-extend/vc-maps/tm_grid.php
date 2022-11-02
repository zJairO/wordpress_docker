<?php

class WPBakeryShortCode_TM_Grid extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		if ( $atts['margin_bottom'] !== '' && $atts['margin_bottom'] !== 0 ) {
			$atomlab_shortcode_lg_css .= "$selector .grid-item { margin-bottom: {$atts['margin_bottom']}px; }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'            => esc_html__( 'Grid', 'atomlab' ),
	'base'            => 'tm_grid',
	'category'        => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'            => 'insight-i insight-i-portfoliogrid',
	'as_parent'       => array( 'only' => array( 'tm_box_icon', 'tm_card' ) ),
	'content_element' => true,
	'is_container'    => true,
	'js_view'         => 'VcColumnView',
	'params'          => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'atomlab' ) => 'grid',
				esc_html__( 'Grid Masonry', 'atomlab' ) => 'masonry',
			),
			'std'         => 'grid',
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
				'lg' => '4',
				'md' => '3',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'masonry',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'atomlab' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 30,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'masonry',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Margin Bottom', 'atomlab' ),
			'description' => esc_html__( 'Controls the margin bottom grid items.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'margin_bottom',
			'std'         => 0,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'masonry',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Item Equal Height', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'equal_height',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
		Atomlab_VC::equal_height_class_field(),
		Atomlab_VC::get_animation_field( array(
			'std'        => 'move-up',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'masonry',
				),
			),
		) ),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );

