<?php

class WPBakeryShortCode_TM_Pricing extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Pricing Table', 'atomlab' ),
	'base'                      => 'tm_pricing',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pricing',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'atomlab' ) => '1',
				esc_html__( '02', 'atomlab' ) => '2',
			),
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Featured', 'atomlab' ),
			'description' => esc_html__( 'Checked the box if you want make this item featured', 'atomlab' ),
			'type'        => 'checkbox',
			'param_name'  => 'featured',
			'value'       => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'     => esc_html__( 'Title', 'atomlab' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'title',
		),
		array(
			'heading'     => esc_html__( 'Description', 'atomlab' ),
			'description' => esc_html__( 'Controls the text that display under price', 'atomlab' ),
			'type'        => 'textarea',
			'param_name'  => 'desc',
		),
		array(
			'heading'          => esc_html__( 'Currency', 'atomlab' ),
			'type'             => 'textfield',
			'param_name'       => 'currency',
			'value'            => '$',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Price', 'atomlab' ),
			'type'             => 'textfield',
			'param_name'       => 'price',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Period', 'atomlab' ),
			'type'             => 'textfield',
			'param_name'       => 'period',
			'value'            => 'per monthly',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type'       => 'vc_link',
			'heading'    => esc_html__( 'Button', 'atomlab' ),
			'param_name' => 'button',
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
					'heading'    => esc_html__( 'Icon', 'atomlab' ),
					'type'       => 'iconpicker',
					'param_name' => 'icon',
					'settings'   => array(
						'emptyIcon'    => true,
						'iconsPerPage' => 4000,
					),
					'value'      => '',
				),
				array(
					'heading'     => esc_html__( 'Text', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'text',
					'admin_label' => true,
				),
			),
		),
	), Atomlab_VC::icon_libraries( array(
		'allow_none' => true,
	) ), Atomlab_VC::get_vc_spacing_tab() ),
) );
