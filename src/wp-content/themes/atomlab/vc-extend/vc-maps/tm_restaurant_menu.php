<?php

class WPBakeryShortCode_TM_Restaurant_Menu extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Restaurant Menu', 'atomlab' ),
	'base'                      => 'tm_restaurant_menu',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-restaurant-menu',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'description' => esc_html__( 'Select style for menu.', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( '01', 'atomlab' ) => '1',
			),
			'admin_label' => true,
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'atomlab' ),
			'heading'    => esc_html__( 'Items', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Title', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Item Description', 'atomlab' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Item Price', 'atomlab' ),
					'type'       => 'textfield',
					'param_name' => 'price',
				),
				array(
					'heading'     => esc_html__( 'Badge', 'atomlab' ),
					'type'        => 'dropdown',
					'param_name'  => 'badge',
					'value'       => array(
						esc_html__( 'None', 'atomlab' ) => '',
						esc_html__( 'New', 'atomlab' )  => 'new',
					),
					'admin_label' => true,
				),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
