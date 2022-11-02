<?php

class WPBakeryShortCode_TM_Pie_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {

		if ( isset( $atts['number_font_size'] ) ) {
			Atomlab_VC::get_responsive_css( array(
				'element' => "$selector .piecharts-number",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['number_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}
	}
}

$content_group = esc_html__( 'Content', 'atomlab' );
$style_group   = esc_html__( 'Styling', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Pie Chart', 'atomlab' ),
	'base'                      => 'tm_pie_chart',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pie-chart',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'atomlab' ) => '01',
				esc_html__( '02', 'atomlab' ) => '02',
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Number', 'atomlab' ),
			'description' => esc_html__( 'Controls the number you would like to display in pie chart.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'min'         => 1,
			'max'         => 100,
			'std'         => 75,
		),
		array(
			'heading'     => esc_html__( 'Circle Size', 'atomlab' ),
			'description' => esc_html__( 'Controls the size of the pie chart circle. Default: 200', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'size',
			'suffix'      => 'px',
			'std'         => 180,
		),
		array(
			'heading'     => esc_html__( 'Measuring unit', 'atomlab' ),
			'description' => esc_html__( 'Controls the unit of chart.', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'unit',
			'std'         => '%',
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => $content_group,
			'heading'    => esc_html__( 'Title', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'title',
		),
		array(
			'group'      => $content_group,
			'heading'    => esc_html__( 'Subtitle', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'subtitle',
		),
		array(
			'group'      => $style_group,
			'heading'    => esc_html__( 'Line Cap', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'line_cap',
			'value'      => array(
				esc_html__( 'Butt', 'atomlab' )   => 'butt',
				esc_html__( 'Round', 'atomlab' )  => 'round',
				esc_html__( 'Square', 'atomlab' ) => 'square',
			),
			'std'        => 'round',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Line Width', 'atomlab' ),
			'description' => esc_html__( 'Controls the line width of chart.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'line_width',
			'suffix'      => 'px',
			'min'         => 1,
			'max'         => 50,
			'std'         => 7,
		),
		array(
			'group'      => $style_group,
			'heading'    => esc_html__( 'Bar Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'bar_color',
			'value'      => array(
				esc_html__( 'Gradient Color', 'atomlab' )  => 'gradient',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'        => 'gradient',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Custom Bar Color', 'atomlab' ),
			'description' => esc_html__( 'Controls the color of bar', 'atomlab' ),
			'type'        => 'colorpicker',
			'param_name'  => 'custom_bar_color',
			'dependency'  => array( 'element' => 'bar_color', 'value' => array( 'custom' ) ),
		),
		array(
			'group'      => $style_group,
			'heading'    => esc_html__( 'Track Color', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'track_color',
			'value'      => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Custom Track Color', 'atomlab' ),
			'description' => esc_html__( 'Controls the color of track for the bar', 'atomlab' ),
			'type'        => 'colorpicker',
			'param_name'  => 'custom_track_color',
			'dependency'  => array( 'element' => 'track_color', 'value' => array( 'custom' ) ),
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Number Font Size', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'number_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
	),
) );
