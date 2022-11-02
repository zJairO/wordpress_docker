<?php

class WPBakeryShortCode_TM_Mailchimp_Form extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Mailchimp Form', 'atomlab' ),
	'base'                      => 'tm_mailchimp_form',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Form Id', 'atomlab' ),
			'description' => esc_html__( 'Input the id of form. Leave blank to show default form.', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'form_id',
		),
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '1', 'atomlab' ) => '1',
				esc_html__( '2', 'atomlab' ) => '2',
				esc_html__( '3', 'atomlab' ) => '3',
				esc_html__( '4', 'atomlab' ) => '4',
			),
			'std'         => '1',
		),
		Atomlab_VC::extra_class_field(),
	),
) );
