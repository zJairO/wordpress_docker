<?php

class WPBakeryShortCode_TM_Product_Search_Form extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Product Search Form', 'atomlab' ),
	'base'                      => 'tm_product_search_form',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '1', 'atomlab' ) => '1',
			),
			'std'         => '1',
		),
		Atomlab_VC::extra_class_field(),
	),
) );
