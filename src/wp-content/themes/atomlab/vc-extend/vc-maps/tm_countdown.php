<?php

class WPBakeryShortCode_TM_CountDown extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		$skin = $number_color = $custom_number_color = $text_color = $custom_text_color = '';
		extract( $atts );

		$_primary_color   = Atomlab::setting( 'primary_color' );
		$_secondary_color = Atomlab::setting( 'secondary_color' );

		if ( $skin === 'custom' ) {
			$_number_tmp = $_text_tmp = '';

			if ( $number_color === 'primary' ) {
				$_number_tmp .= "color: $_primary_color;";
			} elseif ( $number_color === 'secondary' ) {
				$_number_tmp .= "color: $_secondary_color;";
			} elseif ( $number_color === 'custom' ) {
				$_number_tmp .= "color: $custom_number_color;";
			}

			if ( $_number_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .number { $_number_tmp }";
			}

			if ( $text_color === 'primary' ) {
				$_text_tmp .= "color: $_primary_color;";
			} elseif ( $text_color === 'secondary' ) {
				$_text_tmp .= "color: $_secondary_color;";
			} elseif ( $text_color === 'custom' ) {
				$_text_tmp .= "color: $custom_text_color;";
			}

			if ( $_text_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .text { $_text_tmp }";
			}
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Countdown', 'atomlab' ),
	'base'                      => 'tm_countdown',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-countdownclock',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'atomlab' ) => '1',
				esc_html__( '02', 'atomlab' ) => '2',
			),
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Custom', 'atomlab' ) => 'custom',
				esc_html__( 'Dark', 'atomlab' )   => 'dark',
				esc_html__( 'Light', 'atomlab' )  => 'light',
			),
			'std'         => 'dark',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Number Color', 'atomlab' ),
			'param_name'       => 'number_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => 'secondary',
			'edit_field_class' => 'vc_col-sm-6 col-break',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Number Color', 'atomlab' ),
			'param_name'       => 'custom_number_color',
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => array(
				'element' => 'number_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text Color', 'atomlab' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => 'custom',
			'edit_field_class' => 'vc_col-sm-6 col-break',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text Color', 'atomlab' ),
			'param_name'       => 'custom_text_color',
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#ababab',
		),
		array(
			'heading'     => esc_html__( 'Date Time', 'atomlab' ),
			'description' => esc_html__( 'Date and time format (yyyy/mm/dd hh:mm).', 'atomlab' ),
			'type'        => 'datetimepicker',
			'param_name'  => 'datetime',
			'value'       => '',
			'admin_label' => true,
			'settings'    => array(
				'minDate' => 0,
			),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Days" text', 'atomlab' ),
			'param_name' => 'days',
			'value'      => esc_attr( 'Days', 'atomlab' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Hours" text', 'atomlab' ),
			'param_name' => 'hours',
			'value'      => 'Hours',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Minutes" text', 'atomlab' ),
			'param_name' => 'minutes',
			'value'      => esc_attr( 'Minutes', 'atomlab' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Seconds" text', 'atomlab' ),
			'param_name' => 'seconds',
			'value'      => esc_attr( 'Seconds', 'atomlab' ),
		),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );

