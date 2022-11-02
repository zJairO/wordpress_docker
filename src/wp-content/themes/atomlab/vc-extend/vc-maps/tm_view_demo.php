<?php

class WPBakeryShortCode_TM_View_Demo extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'View Demo', 'atomlab' ),
	'base'                      => 'tm_view_demo',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-iconbox',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'atomlab' ),
			'heading'    => esc_html__( 'Items', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Page', 'atomlab' ),
					'type'        => 'autocomplete',
					'param_name'  => 'pages',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Image', 'atomlab' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Category', 'atomlab' ),
					'description' => esc_html__( 'Multi categories separator with comma', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'category',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Badge', 'atomlab' ),
					'type'       => 'dropdown',
					'param_name' => 'badge',
					'value'      => array(
						esc_html__( 'None', 'atomlab' ) => '',
						esc_html__( 'New', 'atomlab' )  => 'new',
						esc_html__( 'Hot', 'atomlab' )  => 'hot',
					),
					'std'        => '',
				),
				Atomlab_VC::extra_class_field(),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
