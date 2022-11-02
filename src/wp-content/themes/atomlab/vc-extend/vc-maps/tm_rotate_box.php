<?php

class WPBakeryShortCode_TM_Rotate_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		$front_tmp         = '';
		$front_heading_tmp = '';
		$front_text_tmp    = '';
		$back_tmp          = '';
		$back_heading_tmp  = '';
		$back_text_tmp     = '';

		if ( $atts['front_heading_color'] === 'custom' ) {
			$front_heading_tmp .= "color: {$atts['front_custom_heading_color']};";
		}

		if ( $atts['front_text_color'] === 'custom' ) {
			$front_text_tmp .= "color: {$atts['front_custom_text_color']};";
		}

		if ( $atts['back_heading_color'] === 'custom' ) {
			$back_heading_tmp .= "color: {$atts['back_custom_heading_color']};";
		}

		if ( $atts['back_text_color'] === 'custom' ) {
			$back_text_tmp .= "color: {$atts['back_custom_text_color']};";
		}

		if ( $atts['front_background_color'] === 'custom' ) {
			$front_tmp .= "background-color: {$atts['front_custom_background_color']};";
		} elseif ( $atts['front_background_color'] === 'gradient' ) {
			$front_tmp .= $atts['front_background_gradient'];
		}

		if ( $atts['front_background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['front_background_image'], 'full' );
			if ( $_url !== false ) {
				$front_tmp .= "background-image: url( $_url );";

				$front_tmp .= "background-size: cover; background-repeat: no-repeat;";
			}
		}

		if ( $atts['back_background_color'] === 'custom' ) {
			$back_tmp .= "background-color: {$atts['back_custom_background_color']};";
		} elseif ( $atts['back_background_color'] === 'gradient' ) {
			$back_tmp .= $atts['back_background_gradient'];
		}

		if ( $atts['back_background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['back_background_image'], 'full' );
			if ( $_url !== false ) {
				$back_tmp .= "background-image: url( $_url );";

				$back_tmp .= "background-size: cover; background-repeat: no-repeat;";
			}
		}

		if ( $front_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .front{ $front_tmp }";
		}

		if ( $front_heading_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .front .heading{ $front_heading_tmp }";
		}

		if ( $front_text_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .front .text{ $front_text_tmp }";
		}

		if ( $back_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .back{ $back_tmp }";
		}

		if ( $back_heading_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .back .heading{ $back_heading_tmp }";
		}

		if ( $back_text_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .back .text{ $back_text_tmp }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$front_tab = esc_html__( 'Front', 'atomlab' );
$back_tab  = esc_html__( 'Back', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Flip Box', 'atomlab' ),
	'base'                      => 'tm_rotate_box',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-flip-box',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Direction', 'atomlab' ),
			'description' => esc_html__( 'Select direction for box.', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'direction',
			'value'       => array(
				esc_html__( 'To Top', 'atomlab' )    => 'top',
				esc_html__( 'To Right', 'atomlab' )  => 'right',
				esc_html__( 'To Bottom', 'atomlab' ) => 'bottom',
				esc_html__( 'To Left', 'atomlab' )   => 'left',
			),
			'admin_label' => true,
			'std'         => 'top',
		),
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Heading', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'front_heading',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'front_text',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Button', 'atomlab' ),
			'type'       => 'vc_link',
			'param_name' => 'front_button',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Heading Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'front_heading_color',
			'value'      => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'        => 'primary',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Custom Heading Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'front_custom_heading_color',
			'dependency' => array(
				'element' => 'front_heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Text Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'front_text_color',
			'value'      => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Custom Text Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'front_custom_text_color',
			'dependency' => array(
				'element' => 'front_text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'       => $front_tab,
			'heading'     => esc_html__( 'Button', 'atomlab' ),
			'description' => esc_html__( 'Select color for button.', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'front_button_color',
			'value'       => array(
				esc_html__( 'Default', 'atomlab' )   => 'default',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Black', 'atomlab' )     => 'black',
				esc_html__( 'Grey', 'atomlab' )      => 'grey',
				esc_html__( 'White', 'atomlab' )     => 'white',
			),
			'std'         => 'primary',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Background Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'front_background_image',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Background Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'front_background_color',
			'value'      => array(
				esc_html__( 'None', 'atomlab' )      => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
				esc_html__( 'Gradient', 'atomlab' )  => 'gradient',
			),
			'std'        => 'secondary',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'front_custom_background_color',
			'dependency' => array(
				'element' => 'front_background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Background Gradient', 'atomlab' ),
			'type'       => 'gradient',
			'param_name' => 'front_background_gradient',
			'dependency' => array(
				'element' => 'front_background_color',
				'value'   => array( 'gradient' ),
			),
		),

		// Back Content Tab.
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Heading', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'back_heading',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'back_text',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Button', 'atomlab' ),
			'type'       => 'vc_link',
			'param_name' => 'back_button',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Heading Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'back_heading_color',
			'value'      => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'        => 'primary',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Custom Heading Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'back_custom_heading_color',
			'dependency' => array(
				'element' => 'back_heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Text Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'back_text_color',
			'value'      => array(
				esc_html__( 'Default', 'atomlab' )   => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Custom Text Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'back_custom_text_color',
			'dependency' => array(
				'element' => 'back_text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'       => $back_tab,
			'heading'     => esc_html__( 'Button', 'atomlab' ),
			'description' => esc_html__( 'Select color for button.', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'back_button_color',
			'value'       => array(
				esc_html__( 'Default', 'atomlab' )   => 'default',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Black', 'atomlab' )     => 'black',
				esc_html__( 'Grey', 'atomlab' )      => 'grey',
				esc_html__( 'White', 'atomlab' )     => 'white',
			),
			'std'         => 'primary',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Background Image', 'atomlab' ),
			'type'       => 'attach_image',
			'param_name' => 'back_background_image',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Background Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'back_background_color',
			'value'      => array(
				esc_html__( 'None', 'atomlab' )      => '',
				esc_html__( 'Primary', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom', 'atomlab' )    => 'custom',
				esc_html__( 'Gradient', 'atomlab' )  => 'gradient',
			),
			'std'        => 'secondary',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'atomlab' ),
			'type'       => 'colorpicker',
			'param_name' => 'back_custom_background_color',
			'dependency' => array(
				'element' => 'back_background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Background Gradient', 'atomlab' ),
			'type'       => 'gradient',
			'param_name' => 'back_background_gradient',
			'dependency' => array(
				'element' => 'back_background_color',
				'value'   => array( 'gradient' ),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),

) );
