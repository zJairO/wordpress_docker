<?php

class WPBakeryShortCode_TM_Button extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;

		$wrapper_tmp     = '';
		$button_tmp      = $button_hover_tmp = '';
		$primary_color   = Atomlab::setting( 'primary_color' );
		$secondary_color = Atomlab::setting( 'secondary_color' );

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

		if ( $atts['rounded'] !== '' ) {
			$button_tmp .= Atomlab_Helper::get_css_prefix( 'border-radius', $atts['rounded'] );
		}

		if ( $atts['size'] === 'custom' ) {
			if ( $atts['width'] !== '' ) {
				$button_tmp .= "min-width: {$atts['width']}px;";
			}

			if ( $atts['height'] !== '' ) {
				$button_tmp   .= "min-height: {$atts['height']}px;";
				$_line_height = $atts['height'];
				if ( $atts['border_width'] !== '' ) {
					$_line_height = $_line_height - ( $atts['border_width'] * 2 );
					$button_tmp   .= "border-width: {$atts['border_width']}px;";
				}

				$button_tmp .= "line-height: {$_line_height}px;";
			}
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Atomlab_VC::get_responsive_css( array(
				'element' => "$selector .button-icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( $atts['color'] === 'custom' ) {
			if ( $atts['button_bg_color'] === 'primary' ) {
				$button_tmp .= "background-color: {$primary_color};";
			} elseif ( $atts['button_bg_color'] === 'secondary' ) {
				$button_tmp .= "background-color: {$secondary_color};";
			} elseif ( $atts['button_bg_color'] === 'custom' ) {
				if ( $atts['custom_button_bg_color'] !== '' ) {
					$button_tmp .= "background-color: {$atts['custom_button_bg_color']};";
				} else {
					$button_tmp .= "background-color: transparent;";
				}
			}

			if ( $atts['font_color'] === 'primary' ) {
				$button_tmp .= "color: {$primary_color};";
			} elseif ( $atts['font_color'] === 'secondary' ) {
				$button_tmp .= "color: {$secondary_color};";
			} elseif ( $atts['font_color'] === 'custom' ) {
				if ( $atts['custom_font_color'] !== '' ) {
					$button_tmp .= "color: {$atts['custom_font_color']};";
				} else {
					$button_tmp .= "color: transparent;";
				}
			}

			if ( $atts['button_border_color'] === 'primary' ) {
				$button_tmp .= "border-color: {$primary_color};";
			} elseif ( $atts['button_border_color'] === 'secondary' ) {
				$button_tmp .= "border-color: {$secondary_color};";
			} elseif ( $atts['button_border_color'] === 'custom' ) {
				if ( $atts['custom_button_border_color'] !== '' ) {
					$button_tmp .= "border-color: {$atts['custom_button_border_color']};";
				} else {
					$button_tmp .= "border-color: transparent;";
				}
			}

			// Hover.
			if ( $atts['button_bg_color_hover'] === 'primary' ) {
				$button_hover_tmp .= "background-color: {$primary_color};";
			} elseif ( $atts['button_bg_color_hover'] === 'secondary' ) {
				$button_hover_tmp .= "background-color: {$secondary_color};";
			} elseif ( $atts['button_bg_color_hover'] === 'custom' ) {
				if ( $atts['custom_button_bg_color_hover'] !== '' ) {
					$button_hover_tmp .= "background-color: {$atts['custom_button_bg_color_hover']};";
				} else {
					$button_hover_tmp .= "background-color: transparent;";
				}
			}

			if ( $atts['font_color_hover'] === 'primary' ) {
				$button_hover_tmp .= "color: {$primary_color};";
			} elseif ( $atts['font_color_hover'] === 'secondary' ) {
				$button_hover_tmp .= "color: {$secondary_color};";
			} elseif ( $atts['font_color_hover'] === 'custom' ) {
				if ( $atts['custom_font_color_hover'] !== '' ) {
					$button_hover_tmp .= "color: {$atts['custom_font_color_hover']};";
				} else {
					$button_hover_tmp .= "color: transparent;";
				}
			}

			if ( $atts['button_border_color_hover'] === 'primary' ) {
				$button_hover_tmp .= "border-color: {$primary_color} !important;";
			} elseif ( $atts['button_border_color_hover'] === 'secondary' ) {
				$button_hover_tmp .= "border-color: {$secondary_color} !important;";
			} elseif ( $atts['button_border_color_hover'] === 'custom' ) {
				if ( $atts['custom_button_border_color_hover'] !== '' ) {
					$button_hover_tmp .= "border-color: {$atts['custom_button_border_color_hover']};";
				} else {
					$button_hover_tmp .= "border-color: transparent;";
				}
			}
		}

		if ( $wrapper_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		if ( $button_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .tm-button{ $button_tmp }";
		}

		if ( $button_hover_tmp !== '' ) {
			if ( $atts['style'] === 'text' ) {
				$atomlab_shortcode_lg_css .= "$selector .tm-button:hover span { $button_hover_tmp }";
			} else {
				$atomlab_shortcode_lg_css .= "$selector .tm-button:hover{ $button_hover_tmp }";
			}
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'atomlab' );

vc_map( array(
	'name'     => esc_html__( 'Button', 'atomlab' ),
	'base'     => 'tm_button',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-button',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Flat', 'atomlab' )    => 'flat',
				esc_html__( 'Outline', 'atomlab' ) => 'outline',
				esc_html__( 'Text', 'atomlab' )    => 'text',
			),
			'std'         => 'flat',
		),
		array(
			'heading'     => esc_html__( 'Size', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Large', 'atomlab' )       => 'lg',
				esc_html__( 'Normal', 'atomlab' )      => 'nm',
				esc_html__( 'Small', 'atomlab' )       => 'sm',
				esc_html__( 'Extra Small', 'atomlab' ) => 'xs',
				esc_html__( 'Custom', 'atomlab' )      => 'custom',
			),
			'std'         => 'nm',
		),
		array(
			'heading'     => esc_html__( 'Width', 'atomlab' ),
			'description' => esc_html__( 'Controls the width of button.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'width',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Height', 'atomlab' ),
			'description' => esc_html__( 'Controls the height of button.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'height',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Border Width', 'atomlab' ),
			'description' => esc_html__( 'Controls the border width of button.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'border_width',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Force Full Width', 'atomlab' ),
			'description' => esc_html__( 'Make button full wide.', 'atomlab' ),
			'type'        => 'checkbox',
			'param_name'  => 'full_wide',
			'value'       => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		array(
			'heading'     => esc_html__( 'Rounded', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'rounded',
			'description' => esc_html__( 'Input a valid radius. Fox Ex: 10px. Leave blank to use default.', 'atomlab' ),
		),
		array(
			'heading'    => esc_html__( 'Button', 'atomlab' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
			'value'      => esc_html__( 'Button', 'atomlab' ),
		),
		array(
			'group'      => esc_html__( 'Icon', 'atomlab' ),
			'heading'    => esc_html__( 'Icon Align', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_align',
			'value'      => array(
				esc_html__( 'Left', 'atomlab' )  => 'left',
				esc_html__( 'Right', 'atomlab' ) => 'right',
			),
			'std'        => 'right',
		),
		array(
			'heading'     => esc_html__( 'Button Action', 'atomlab' ),
			'description' => esc_html__( 'To make smooth scroll action work then input button url like this: #about-us-section. )', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'action',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'atomlab' )                    => '',
				esc_html__( 'Smooth scroll to a section', 'atomlab' ) => 'smooth_scroll',
				esc_html__( 'Open link as popup video', 'atomlab' )   => 'popup_video',

			),
			'std'         => '',
		),
	), Atomlab_VC::get_alignment_fields(), array(
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
		Atomlab_VC::extra_id_field(),
	), Atomlab_VC::icon_libraries( array(
		'allow_none' => true,
	) ), array(
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Icon Font Size', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'icon_font_size',
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
			'group'       => $styling_tab,
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Color', 'atomlab' ),
			'param_name'  => 'color',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Grey', 'atomlab' )      => 'grey',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'         => 'primary',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color', 'atomlab' ),
			'param_name'       => 'button_bg_color',
			'value'            => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color', 'atomlab' ),
			'param_name'       => 'custom_button_bg_color',
			'dependency'       => array(
				'element' => 'button_bg_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color', 'atomlab' ),
			'param_name'       => 'font_color',
			'value'            => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom text color', 'atomlab' ),
			'param_name'       => 'custom_font_color',
			'dependency'       => array(
				'element' => 'font_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color', 'atomlab' ),
			'param_name'       => 'button_border_color',
			'value'            => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color', 'atomlab' ),
			'param_name'       => 'custom_button_border_color',
			'dependency'       => array(
				'element' => 'button_border_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color (on hover)', 'atomlab' ),
			'param_name'       => 'button_bg_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color (on hover)', 'atomlab' ),
			'param_name'       => 'custom_button_bg_color_hover',
			'dependency'       => array(
				'element' => 'button_bg_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color (on hover)', 'atomlab' ),
			'param_name'       => 'font_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text color (on hover)', 'atomlab' ),
			'param_name'       => 'custom_font_color_hover',
			'dependency'       => array(
				'element' => 'font_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color (on hover)', 'atomlab' ),
			'param_name'       => 'button_border_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'              => 'default',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color (on hover)', 'atomlab' ),
			'param_name'       => 'custom_button_border_color_hover',
			'dependency'       => array(
				'element' => 'button_border_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	),

		Atomlab_VC::get_vc_spacing_tab() ),
) );
