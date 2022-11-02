<?php

class WPBakeryShortCode_TM_Gallery extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Gallery', 'atomlab' ),
	'base'     => 'tm_gallery',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-gallery',
	'params'   => array_merge( array(
		array(
			'heading'    => esc_html__( 'Images', 'atomlab' ),
			'type'       => 'attach_images',
			'param_name' => 'images',
		),
		array(
			'heading'     => esc_html__( 'Gallery Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'atomlab' )    => 'grid',
				esc_html__( 'Grid Metro', 'atomlab' )      => 'metro',
				esc_html__( 'Grid Masonry', 'atomlab' )    => 'masonry',
				esc_html__( 'Justify Gallery', 'atomlab' ) => 'justified',
			),
			'std'         => 'grid',
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
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
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
				'value'   => array(
					'grid',
					'metro',
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
					'metro',
					'masonry',
					'justified',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Row Height', 'atomlab' ),
			'description' => esc_html__( 'Controls the height of grid row.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'justify_row_height',
			'std'         => 300,
			'min'         => 50,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Max Row Height', 'atomlab' ),
			'description' => esc_html__( 'Controls the max height of grid row. Leave blank or 0 keep it disabled.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'justify_max_row_height',
			'std'         => 0,
			'min'         => 0,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Last row alignment', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'justify_last_row_alignment',
			'value'      => array(
				esc_html__( 'Justify', 'atomlab' )                              => 'justify',
				esc_html__( 'Left', 'atomlab' )                                 => 'nojustify',
				esc_html__( 'Center', 'atomlab' )                               => 'center',
				esc_html__( 'Right', 'atomlab' )                                => 'right',
				esc_html__( 'Hide ( if row can not be justified )', 'atomlab' ) => 'hide',
			),
			'std'        => 'justify',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		Atomlab_VC::get_animation_field( array(
			'std'        => 'move-up',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
					'justified',
				),
			),
		) ),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );

