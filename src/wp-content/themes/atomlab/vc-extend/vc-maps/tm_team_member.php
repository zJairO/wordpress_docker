<?php

class WPBakeryShortCode_TM_Team_Member extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Team Member', 'atomlab' ),
	'base'                      => 'tm_team_member',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'allowed_container_element' => 'vc_row,tm_team_member_group',
	'icon'                      => 'insight-i insight-i-member',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '1', 'atomlab' ) => '1',
				esc_html__( '2', 'atomlab' ) => '2',
			),
			'std'         => '1',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Photo of member', 'atomlab' ),
			'param_name'  => 'photo',
			'admin_label' => true,
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Photo Effect', 'atomlab' ),
			'param_name' => 'photo_effect',
			'value'      => array(
				esc_html__( 'None', 'atomlab' )      => '',
				esc_html__( 'Grayscale', 'atomlab' ) => 'grayscale',
			),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '1' ),
			),
			'std'        => '',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Name', 'atomlab' ),
			'admin_label' => true,
			'param_name'  => 'name',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Position', 'atomlab' ),
			'param_name'  => 'position',
			'description' => esc_html__( 'Example: CEO/Founder', 'atomlab' ),
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Description', 'atomlab' ),
			'param_name' => 'desc',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Profile url', 'atomlab' ),
			'param_name' => 'profile',
		),
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Social Networks', 'atomlab' ),
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Social Networks', 'atomlab' ),
			'param_name' => 'social_networks',
			'params'     => array_merge( Atomlab_VC::icon_libraries( array( 'allow_none' => true ) ), array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Link', 'atomlab' ),
					'param_name'  => 'link',
					'admin_label' => true,
				),
			) ),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-twitter',
				),
				array(
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-facebook',
				),
				array(
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-googleplus',
				),
				array(
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-linkedin',
				),
			) ) ),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
