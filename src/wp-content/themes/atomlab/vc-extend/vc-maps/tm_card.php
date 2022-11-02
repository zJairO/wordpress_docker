<?php

class WPBakeryShortCode_TM_Card extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;
		$tmp = '';

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

		if ( $atts['overlay_background'] !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .overlay{ background: {$atts['overlay_background']}; }";
		}

		if ( $tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector{ $tmp }";
		}

		if ( $atts['heading_color'] === 'custom' ) {
			$atomlab_shortcode_lg_css .= "$selector .heading {  color: {$atts['custom_heading_color']}; }";
		}

		if ( $atts['text_color'] === 'custom' ) {
			$atomlab_shortcode_lg_css .= "$selector .content-wrap {  color: {$atts['custom_text_color']}; }";
		}

		if ( $atts['icon_color'] === 'custom' ) {
			$atomlab_shortcode_lg_css .= "$selector .icon { color: {$atts['custom_icon_color']}; }";
		}

		if ( $atts['icon_bg_color'] === 'custom' ) {
			if ( $atts['style'] === '2' ) {
				$atomlab_shortcode_lg_css .= "$selector .icon:before { background-color: {$atts['custom_icon_bg_color']}; }";
			}
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
	'name'                      => esc_html__( 'Card', 'atomlab' ),
	'base'                      => 'tm_card',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'atomlab' ) => '1',
				esc_html__( 'Style 02', 'atomlab' ) => '2',
			),
			'admin_label' => true,
			'std'         => '1',
		),
	), Atomlab_VC::get_alignment_fields(), Atomlab_VC::icon_libraries( array(
		'group'      => $content_tab,
		'allow_none' => true,
	) ), array(
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Heading', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'heading',
			'admin_label' => true,
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Link', 'atomlab' ),
			'description' => esc_html__( 'Add a link to heading.', 'atomlab' ),
			'type'        => 'vc_link',
			'param_name'  => 'link',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Phone Number', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'phone_number',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Card List', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'list',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Title', 'atomlab' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Item Sub Title', 'atomlab' ),
					'type'       => 'textarea',
					'param_name' => 'sub_title',
				),
			),
		),
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Heading Color', 'atomlab' ),
			'type'             => 'dropdown',
			'param_name'       => 'heading_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' ) => '',
				esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break vc_column-no-padding',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Heading Color', 'atomlab' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_heading_color',
			'dependency'       => array(
				'element' => 'heading_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6 vc_column-no-padding',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Text Color', 'atomlab' ),
			'type'             => 'dropdown',
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' ) => '',
				esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Text Color', 'atomlab' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Icon Color', 'atomlab' ),
			'type'             => 'dropdown',
			'param_name'       => 'icon_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' ) => '',
				esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Icon Color', 'atomlab' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Icon Background Color', 'atomlab' ),
			'type'             => 'dropdown',
			'param_name'       => 'icon_bg_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' ) => '',
				esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Icon Background Color', 'atomlab' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_bg_color',
			'dependency'       => array(
				'element' => 'icon_bg_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'background_color',
			'value'      => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
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
			'type'        => 'colorpicker',
			'param_name'  => 'overlay_background',
			'dependency'  => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),

) );
