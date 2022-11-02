<?php

class WPBakeryShortCode_TM_Social_Networks extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;

		$tmp              = $icon_css = $icon_hover_css = $text_css = $text_hover_css = '';
		$icon_color       = $custom_icon_color = $icon_hover_color = $custom_icon_hover_color = $text_color = $custom_text_color = $text_hover_color = $custom_text_hover_color = '';
		$_primary_color   = Atomlab::setting( 'primary_color' );
		$_secondary_color = Atomlab::setting( 'secondary_color' );

		extract( $atts );

		if ( $icon_color === 'primary' ) {
			$icon_css .= "color: {$_primary_color};";
		} elseif ( $icon_color === 'secondary' ) {
			$icon_css .= "color: {$_secondary_color};";
		} elseif ( $icon_color === 'custom' ) {
			$icon_css .= "color: {$custom_icon_color};";
		}

		if ( $icon_hover_color === 'primary' ) {
			$icon_hover_css .= "color: {$_primary_color};";
		} elseif ( $icon_hover_color === 'secondary' ) {
			$icon_hover_css .= "color: {$_secondary_color};";
		} elseif ( $icon_hover_color === 'custom' ) {
			$icon_hover_css .= "color: {$custom_icon_hover_color};";
		}

		if ( $text_color === 'primary' ) {
			$text_css .= "color: {$_primary_color};";
		} elseif ( $text_color === 'secondary' ) {
			$text_css .= "color: {$_secondary_color};";
		} elseif ( $text_color === 'custom' ) {
			$text_css .= "color: {$custom_text_color};";
		}

		if ( $text_hover_color === 'primary' ) {
			$text_hover_css .= "color: {$_primary_color};";
		} elseif ( $text_hover_color === 'secondary' ) {
			$text_hover_css .= "color: {$_secondary_color};";
		} elseif ( $text_hover_color === 'custom' ) {
			$text_hover_css .= "color: {$custom_text_hover_color};";
		}

		if ( $atts['align'] !== '' ) {
			$tmp .= "text-align: {$atts['align']};";
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

		if ( $tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector { $tmp }";
		}

		if ( $icon_css !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .link-icon { $icon_css }";
		}

		if ( $icon_hover_css !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .item:hover .link-icon { $icon_hover_css }";
		}

		if ( $text_css !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .link-text { $text_css }";
		}

		if ( $text_hover_css !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .item:hover .link-text { $text_hover_css }";
		}
	}
}

$styling_tab = esc_html__( 'Styling', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Social Networks', 'atomlab' ),
	'base'                      => 'tm_social_networks',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-social-networks',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Icons', 'atomlab' )        => 'icons',
				esc_html__( 'Title', 'atomlab' )        => 'title',
				esc_html__( 'Icon + Title', 'atomlab' ) => 'icon-title',
			),
			'std'         => 'icons',
		),
		array(
			'heading'     => esc_html__( 'Layout', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'layout',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Inline', 'atomlab' )    => 'inline',
				esc_html__( 'List', 'atomlab' )      => 'list',
				esc_html__( '2 Columns', 'atomlab' ) => 'two-columns',
			),
			'std'         => 'inline',
		),

	), Atomlab_VC::get_alignment_fields(), array(
		array(
			'heading'    => esc_html__( 'Open link in a new tab.', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'target',
			'value'      => array(
				esc_html__( 'Yes', 'atomlab' ) => '1',
			),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Show tooltip as item title.', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'tooltip_enable',
			'value'      => array(
				esc_html__( 'Yes', 'atomlab' ) => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Tooltip Position', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_position',
			'value'      => array(
				esc_html__( 'Top', 'atomlab' )    => 'top',
				esc_html__( 'Right', 'atomlab' )  => 'right',
				esc_html__( 'Bottom', 'atomlab' ) => 'bottom',
				esc_html__( 'Left', 'atomlab' )   => 'left',
			),
			'std'        => 'top',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'atomlab' ),
			'heading'    => esc_html__( 'Items', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array_merge( array(
				array(
					'heading'     => esc_html__( 'Title', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Link', 'atomlab' ),
					'type'       => 'textfield',
					'param_name' => 'link',
				),
			), Atomlab_VC::icon_libraries() ),

			'value' => rawurlencode( wp_json_encode( array(
				array(
					'title'     => esc_html__( 'Twitter', 'atomlab' ),
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-twitter',
				),
				array(
					'title'     => esc_html__( 'Facebook', 'atomlab' ),
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-facebook',
				),
				array(
					'title'     => esc_html__( 'Google+', 'atomlab' ),
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-googleplus',
				),
				array(
					'title'     => esc_html__( 'Linkedin', 'atomlab' ),
					'link'      => '#',
					'icon_type' => 'ion',
					'icon_ion'  => 'ion-social-linkedin',
				),
			) ) ),

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
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Icon Hover Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_hover_color',
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
			'heading'    => esc_html__( 'Custom Icon Hover Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_icon_hover_color',
			'dependency' => array(
				'element' => 'icon_hover_color',
				'value'   => 'custom',
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
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
			'heading'    => esc_html__( 'Custom Text Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Hover Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'text_hover_color',
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
			'heading'    => esc_html__( 'Custom Text Hover Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_hover_color',
			'dependency' => array(
				'element' => 'text_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
	) ),
) );
