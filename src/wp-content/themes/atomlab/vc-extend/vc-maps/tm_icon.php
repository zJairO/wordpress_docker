<?php

class WPBakeryShortCode_TM_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;

		$wrapper_tmp = $tmp = '';

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$atomlab_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$atomlab_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$atomlab_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		if ( $atts['icon_color'] === 'custom' ) {
			$tmp .= "color: {$atts['custom_icon_color']}; ";
		}

		if ( $wrapper_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector  { $wrapper_tmp }";
		}

		if ( $tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .icon { $tmp }";
		}

		if ( isset( $atts['font_size'] ) ) {
			Atomlab_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$params = array_merge( Atomlab_VC::icon_libraries( array(
	'allow_none' => true,
	'group'      => '',
) ), Atomlab_VC::get_alignment_fields(), array(
	array(
		'heading'     => esc_html__( 'Font Size', 'atomlab' ),
		'type'        => 'number_responsive',
		'param_name'  => 'font_size',
		'min'         => 8,
		'suffix'      => 'px',
		'media_query' => array(
			'lg' => '',
			'md' => '',
			'sm' => '',
			'xs' => '',
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Icon Color', 'atomlab' ),
		'type'       => 'dropdown',
		'param_name' => 'icon_color',
		'value'      => array(
			esc_html__( 'Default Color', 'atomlab' )   => '',
			esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
			esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
			esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Icon Color', 'atomlab' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_icon_color',
		'dependency' => array(
			'element' => 'icon_color',
			'value'   => 'custom',
		),
		'std'        => '#fff',
	),
	Atomlab_VC::get_animation_field(),
	Atomlab_VC::extra_class_field(),
), Atomlab_VC::get_vc_spacing_tab() );

vc_map( array(
	'name'                      => esc_html__( 'Icon', 'atomlab' ),
	'base'                      => 'tm_icon',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => $params,
) );
