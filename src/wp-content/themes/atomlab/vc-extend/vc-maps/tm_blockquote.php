<?php

class WPBakeryShortCode_TM_Blockquote extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$content_tab = esc_html__( 'Content', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Blockquote', 'atomlab' ),
	'base'                      => 'tm_blockquote',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-blockquote',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'atomlab' ) => '1',
			),
			'std'         => '1',
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Heading', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Photo', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'photo',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Position', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'position',
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
