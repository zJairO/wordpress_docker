<?php

class WPBakeryShortCode_TM_Slider extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		$slide_tmp = '';

		if ( isset( $atts['text_align'] ) && $atts['text_align'] !== '' ) {
			$slide_tmp .= "text-align: {$atts['text_align']};";
		}

		if ( $slide_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .swiper-slide { $slide_tmp }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab  = esc_html__( 'Slides', 'atomlab' );
$styling_tab = esc_html__( 'Styling', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Slider', 'atomlab' ),
	'base'                      => 'tm_slider',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Style', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'style',
			'value'      => array(
				esc_html__( '01', 'atomlab' ) => '1',
				esc_html__( '02', 'atomlab' )  => '2',
			),
			'std' => '1',
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_html__( '1170x560 (1 Column)', 'atomlab' ) => '1170x560',
				esc_html__( '600x400 (1 Column)', 'atomlab' )  => '600x400',
				esc_html__( '500x338 (3 Columns)', 'atomlab' ) => '500x338',
				esc_html__( '500x676 (3 Columns)', 'atomlab' ) => '500x676',
				esc_html__( 'Full', 'atomlab' )                => 'full',
			),
			'std'        => '500x338',
		),
		array(
			'heading'    => esc_html__( 'Auto Height', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'auto_height',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
			'std'        => '1',
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
		),
		array(
			'heading'    => esc_html__( 'Equal Height', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'equal_height',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Vertically Center', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'v_center',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Navigation', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Atomlab_VC::get_slider_navs(),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Pagination', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Atomlab_VC::get_slider_dots(),
			'std'        => '',
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
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
		),
		array(
			'heading'    => esc_html__( 'Full-width Image', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'fw_image',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
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
					'heading'     => esc_html__( 'Sub Title', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'sub_title',
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
				array(
					'heading'    => esc_html__( 'Link', 'atomlab' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
					'value'      => esc_html__( 'Link', 'atomlab' ),
				),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Align', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'text_align',
			'value'      => array(
				esc_html__( 'Default', 'atomlab' ) => '',
				esc_html__( 'Left', 'atomlab' )    => 'left',
				esc_html__( 'Center', 'atomlab' )  => 'center',
				esc_html__( 'Right', 'atomlab' )   => 'right',
				esc_html__( 'Justify', 'atomlab' ) => 'justify',
			),
			'std'        => '',

		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
