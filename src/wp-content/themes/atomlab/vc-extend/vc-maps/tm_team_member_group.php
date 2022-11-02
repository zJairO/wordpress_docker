<?php

class WPBakeryShortCode_TM_Team_Member_Group extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Team Member Group', 'atomlab' ),
	'base'                      => 'tm_team_member_group',
	'as_parent'                 => array( 'only' => 'tm_team_member' ),
	'content_element'           => true,
	'show_settings_on_create'   => false,
	'is_container'              => true,
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'allowed_container_element' => 'vc_row',
	'icon'                      => 'insight-i insight-i-member',
	'js_view'                   => 'VcColumnView',
	'params'                    => array_merge( array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Style', 'atomlab' ),
			'param_name' => 'style',
			'value'      => array(
				esc_html__( 'Carousel ZigZag', 'atomlab' ) => 'carousel_zigzag',
			),
			'std'        => 'carousel_zigzag',
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
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
