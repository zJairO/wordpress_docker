<?php

class WPBakeryShortCode_TM_Box_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;
		$tmp         = '';
		$icon_tmp    = '';
		$heading_tmp = '';
		$text_tmp    = '';
		$btn_tmp     = '';

		$primary_color   = Atomlab::setting( 'primary_color' );
		$secondary_color = Atomlab::setting( 'secondary_color' );

		if ( $atts['background_color'] === 'primary' ) {
			$tmp .= "background-color: {$primary_color};";
		} elseif ( $atts['background_color'] === 'secondary' ) {
			$tmp .= "background-color: {$secondary_color};";
		} elseif ( $atts['background_color'] === 'custom' ) {
			$tmp .= "background-color: {$atts['custom_background_color']};";
		} elseif ( $atts['background_color'] === 'gradient' ) {
			$tmp .= $atts['background_gradient'];
		}

		if ( $atts['background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
			if ( $_url !== false ) {
				$tmp .= "background-image: url( $_url );";

				if ( $atts['background_size'] !== 'auto' ) {
					$tmp .= "background-size: {$atts['background_size']};";
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";
				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}
		}

		if ( $tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector{ $tmp }";
		}

		if ( $atts['icon_color'] === 'primary' ) {
			$icon_tmp .= "color: {$primary_color}; border-color: {$primary_color}; ";
		} elseif ( $atts['icon_color'] === 'secondary' ) {
			$icon_tmp .= "color: {$secondary_color}; border-color: {$secondary_color}; ";
		} elseif ( $atts['icon_color'] === 'custom' ) {
			$icon_tmp .= "color: {$atts['custom_icon_color']}; border-color: {$atts['custom_icon_color']}; ";
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Atomlab_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( $icon_tmp !== '' ) {
			if ( $atts['style'] === '2' ) {
				$atomlab_shortcode_lg_css .= "$selector .icon i{ $icon_tmp }";
			} else {
				$atomlab_shortcode_lg_css .= "$selector .icon{ $icon_tmp }";
			}
		}

		if ( $atts['heading_color'] === 'primary' ) {
			$heading_tmp .= "color: {$primary_color}; ";
		} elseif ( $atts['heading_color'] === 'secondary' ) {
			$heading_tmp .= "color: {$secondary_color}; ";
		} elseif ( $atts['heading_color'] === 'custom' ) {
			$heading_tmp .= "color: {$atts['custom_heading_color']}; ";
		}

		if ( $heading_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .heading{ $heading_tmp }";
		}

		if ( $atts['text_color'] === 'primary' ) {
			$text_tmp .= "color: {$primary_color}; ";
		} elseif ( $atts['text_color'] === 'secondary' ) {
			$text_tmp .= "color: {$secondary_color}; ";
		} elseif ( $atts['text_color'] === 'custom' ) {
			$text_tmp .= "color: {$atts['custom_text_color']}; ";
		}

		if ( $atts['text_width'] !== '' ) {
			$text_tmp .= "max-width: {$atts['text_width']};";
		}

		if ( $text_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .text{ $text_tmp }";
		}

		if ( $atts['text'] === '' && $atts['heading'] === '' ) {
			$atomlab_shortcode_lg_css .= "$selector .image{ margin-bottom: 0; }";
		}

		if ( $atts['button_color'] === 'custom' ) {
			$btn_tmp .= "color: {$atts['custom_button_color']}; ";
		}

		if ( $btn_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .tm-button .button-text{ $btn_tmp }";
		}

		$tmp = "text-align: {$atts['align']}; ";
		if ( $atts['align'] === 'left' ) {
			$tmp .= 'align-items: flex-start';
		} elseif ( $atts['align'] === 'center' ) {
			$tmp .= 'align-items: center;';
		} elseif ( $atts['align'] === 'right' ) {
			$tmp .= 'align-items: flex-end;';
		}

		$atomlab_shortcode_lg_css .= "$selector .content-wrap { $tmp }";

		$tmp = '';
		if ( $atts['md_align'] !== '' ) {
			$tmp .= "text-align: {$atts['md_align']};";

			if ( $atts['md_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['md_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['md_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$atomlab_shortcode_md_css .= "$selector .content-wrap { $tmp }";
		}

		$tmp = '';
		if ( $atts['sm_align'] !== '' ) {
			$tmp .= "text-align: {$atts['sm_align']};";

			if ( $atts['sm_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['sm_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['sm_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$atomlab_shortcode_sm_css .= "$selector .content-wrap { $tmp }";
		}

		$tmp = '';
		if ( $atts['xs_align'] !== '' ) {
			$tmp .= "text-align: {$atts['xs_align']};";

			if ( $atts['xs_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['xs_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['xs_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$atomlab_shortcode_xs_css .= "$selector .content-wrap { $tmp }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$content_tab = esc_html__( 'Content', 'atomlab' );
$styling_tab = esc_html__( 'Styling', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Box Icon', 'atomlab' ),
	'base'                      => 'tm_box_icon',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'description' => esc_html__( 'Select style for box icon.', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'atomlab' ) => '1',
				esc_html__( 'Style 02', 'atomlab' ) => '2',
				esc_html__( 'Style 03', 'atomlab' ) => '3',
				esc_html__( 'Style 04', 'atomlab' ) => '4',
				esc_html__( 'Style 05', 'atomlab' ) => '5',
				esc_html__( 'Style 06', 'atomlab' ) => '6',
				esc_html__( 'Style 07', 'atomlab' ) => '7',
				esc_html__( 'Style 08', 'atomlab' ) => '8',
				esc_html__( 'Style 09', 'atomlab' ) => '9',
				esc_html__( 'Style 10', 'atomlab' ) => '10',
				esc_html__( 'Style 11', 'atomlab' ) => '11',
				esc_html__( 'Style 12', 'atomlab' ) => '12',
				esc_html__( 'Style 13', 'atomlab' ) => '13',
				esc_html__( 'Style 14', 'atomlab' ) => '14',
				esc_html__( 'Style 15', 'atomlab' ) => '15',
			),
			'admin_label' => true,
			'std'         => '1',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
	), Atomlab_VC::get_alignment_fields(), Atomlab_VC::icon_libraries( array(
		'group'      => $content_tab,
		'allow_none' => true,
		'allow_svg'  => true,
	) ), array(
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Box Link', 'atomlab' ),
			'description' => esc_html__( 'Add a link wrap box icon. This ignore heading link & button link option.', 'atomlab' ),
			'type'        => 'vc_link',
			'param_name'  => 'box_link',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Heading', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'heading',
			'admin_label' => true,
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Heading Link', 'atomlab' ),
			'description' => esc_html__( 'Add a link to heading. Notice: Box Link option will ignore this option.', 'atomlab' ),
			'type'        => 'vc_link',
			'param_name'  => 'link',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Text Width', 'atomlab' ),
			'description' => esc_html__( 'Input width of box text. For Ex: 300px', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'text_width',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Button', 'atomlab' ),
			'description' => esc_html__( 'Notice: Box Link option will ignore this option.', 'atomlab' ),
			'type'        => 'vc_link',
			'param_name'  => 'button',
		),
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
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
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Heading Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'heading_color',
			'value'      => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Heading Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_heading_color',
			'dependency' => array(
				'element' => 'heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
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
			'std'        => '#999',
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
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Button Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'button_color',
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
			'heading'    => esc_html__( 'Custom Button Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_button_color',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'background_color',
			'value'      => array(
				esc_html__( 'None', 'atomlab' )            => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Gradient Color', 'atomlab' )  => 'gradient',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'        => '',
		),

		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_background_color',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'atomlab' ),
			'type'       => 'gradient',
			'param_name' => 'background_gradient',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'background_image',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Repeat', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'background_repeat',
			'value'      => array(
				esc_html__( 'No repeat', 'atomlab' )         => 'no-repeat',
				esc_html__( 'Tile', 'atomlab' )              => 'repeat',
				esc_html__( 'Tile Horizontally', 'atomlab' ) => 'repeat-x',
				esc_html__( 'Tile Vertically', 'atomlab' )   => 'repeat-y',
			),
			'std'        => 'no-repeat',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Size', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'background_size',
			'value'      => array(
				esc_html__( 'Auto', 'atomlab' )    => 'auto',
				esc_html__( 'Cover', 'atomlab' )   => 'cover',
				esc_html__( 'Contain', 'atomlab' ) => 'contain',
			),
			'std'        => 'cover',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Position', 'atomlab' ),
			'description' => esc_html__( 'Ex: left center', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'background_position',
			'dependency'  => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Overlay', 'atomlab' ),
			'description' => esc_html__( 'Choose an overlay background color.', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'overlay_background',
			'value'       => array(
				esc_html__( 'None', 'atomlab' )          => '',
				esc_html__( 'Primary Color', 'atomlab' ) => 'primary',
				esc_html__( 'Custom Color', 'atomlab' )  => 'overlay_custom_background',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Custom Background Overlay', 'atomlab' ),
			'description' => esc_html__( 'Choose an custom background color overlay.', 'atomlab' ),
			'type'        => 'colorpicker',
			'param_name'  => 'overlay_custom_background',
			'std'         => '#000000',
			'dependency'  => array(
				'element' => 'overlay_background',
				'value'   => array( 'overlay_custom_background' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Opacity', 'atomlab' ),
			'type'       => 'number',
			'param_name' => 'overlay_opacity',
			'value'      => 100,
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'suffix'     => '%',
			'std'        => 80,
			'dependency' => array(
				'element'   => 'overlay_background',
				'not_empty' => true,
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),

) );
