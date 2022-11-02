<?php

class WPBakeryShortCode_TM_Counter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		$align = 'center';
		$skin  = $number_color = $custom_number_color = $text_color = $custom_text_color = $icon_color = $custom_icon_color = '';
		$tmp   = '';
		extract( $atts );

		$tmp .= "text-align: {$align}";

		if ( $skin === 'custom' ) {
			$number_tmp = $text_tmp = $icon_tmp = '';

			if ( $number_color === 'custom' ) {
				$number_tmp .= "color: $custom_number_color;";
			}

			if ( $number_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .number-wrap{ $number_tmp }";
			}

			if ( $text_color === 'custom' ) {
				$text_tmp .= "color: $custom_text_color;";
			}

			if ( $text_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .text{ $text_tmp }";
			}

			if ( $icon_color === 'custom' ) {
				$icon_tmp .= "color: $custom_icon_color;";
			}

			if ( $icon_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .icon{ $icon_tmp }";
			}
		}

		$atomlab_shortcode_lg_css .= "$selector { $tmp }";
		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Counter', 'atomlab' ),
	'base'                      => 'tm_counter',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-counter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'atomlab' ) => '1',
				esc_html__( '02', 'atomlab' ) => '2',
			),
			'std'         => '1',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Counter Animation', 'atomlab' ),
			'param_name' => 'animation',
			'value'      => array(
				esc_html__( 'Counter Up', 'atomlab' ) => 'counter-up',
				esc_html__( 'Odometer', 'atomlab' )   => 'odometer',
			),
			'std'        => 'counter-up',
		),
		array(
			'heading'    => esc_html__( 'Text Align', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'align',
			'value'      => array(
				esc_html__( 'Left', 'atomlab' )   => 'left',
				esc_html__( 'Center', 'atomlab' ) => 'center',
				esc_html__( 'Right', 'atomlab' )  => 'right',
			),
			'std'        => 'center',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Skin', 'atomlab' ),
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Dark', 'atomlab' )   => 'dark',
				esc_html__( 'Light', 'atomlab' )  => 'light',
				esc_html__( 'Custom', 'atomlab' ) => 'custom',
			),
			'std'         => 'dark',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Number Color', 'atomlab' ),
			'param_name'       => 'number_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary_color',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => 'primary_color',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Number Color', 'atomlab' ),
			'param_name'       => 'custom_number_color',
			'dependency'       => array(
				'element' => 'number_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text Color', 'atomlab' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary_color',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => 'custom',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text Color', 'atomlab' ),
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
			'std'              => '#a9a9a9',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon Color', 'atomlab' ),
			'param_name'       => 'icon_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary_color',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => 'custom',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon Color', 'atomlab' ),
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
			'std'              => '#a9a9a9',
		),
		array(
			'group'       => esc_html__( 'Data', 'atomlab' ),
			'heading'     => esc_html__( 'Number', 'atomlab' ),
			'type'        => 'number',
			'admin_label' => true,
			'param_name'  => 'number',
		),
		array(
			'group'       => esc_html__( 'Data', 'atomlab' ),
			'heading'     => esc_html__( 'Number Prefix', 'atomlab' ),
			'description' => esc_html__( 'Prefix your number with a symbol or text.', 'atomlab' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_prefix',
		),
		array(
			'group'       => esc_html__( 'Data', 'atomlab' ),
			'heading'     => esc_html__( 'Number Suffix', 'atomlab' ),
			'description' => esc_html__( 'Suffix your number with a symbol or text.', 'atomlab' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_suffix',
		),
		array(
			'group'       => esc_html__( 'Data', 'atomlab' ),
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Text', 'atomlab' ),
			'admin_label' => true,
			'param_name'  => 'text',
		),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::icon_libraries( array( 'allow_none' => true ) ), Atomlab_VC::get_vc_spacing_tab() ),
) );
