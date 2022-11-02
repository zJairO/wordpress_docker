<?php
vc_update_shortcode_param( 'vc_tta_section', array(
	'param_name' => 'i_type',
	'value'      => array(
		esc_html__( 'Font Awesome', 'atomlab' ) => 'fontawesome',
		esc_html__( 'Ion', 'atomlab' )          => 'ion',
		esc_html__( 'Themify', 'atomlab' )      => 'themify',
	),
) );

vc_update_shortcode_param( 'vc_tta_section', array(
	'param_name' => 'el_class',
	'weight'     => - 1,
) );

vc_remove_param( 'vc_tta_section', 'i_icon_openiconic' );
vc_remove_param( 'vc_tta_section', 'i_icon_typicons' );
vc_remove_param( 'vc_tta_section', 'i_icon_entypo' );
vc_remove_param( 'vc_tta_section', 'i_icon_linecons' );
vc_remove_param( 'vc_tta_section', 'i_icon_monosocial' );
vc_remove_param( 'vc_tta_section', 'i_icon_material' );

vc_add_params( 'vc_tta_section', array(
	array(
		'type'        => 'iconpicker',
		'heading'     => esc_html__( 'Icon', 'atomlab' ),
		'param_name'  => 'i_icon_ion',
		'value'       => 'ion-alert',
		'settings'    => array(
			'emptyIcon'    => false,
			'type'         => 'ion',
			'iconsPerPage' => 400,
		),
		'dependency'  => array(
			'element' => 'i_type',
			'value'   => 'ion',
		),
		'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
	),
	array(
		'type'        => 'iconpicker',
		'heading'     => esc_html__( 'Icon', 'atomlab' ),
		'param_name'  => 'i_icon_themify',
		'value'       => 'ti-arrow-up',
		'settings'    => array(
			'emptyIcon'    => false,
			'type'         => 'themify',
			'iconsPerPage' => 400,
		),
		'dependency'  => array(
			'element' => 'i_type',
			'value'   => 'themify',
		),
		'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
	),
) );
