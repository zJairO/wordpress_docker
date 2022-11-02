<?php
vc_map_update( 'vc_progress_bar', array(
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-processbar',
) );

vc_remove_param( 'vc_progress_bar', 'bgcolor' );
vc_remove_param( 'vc_progress_bar', 'custombgcolor' );
vc_remove_param( 'vc_progress_bar', 'customtxtcolor' );
vc_remove_param( 'vc_progress_bar', 'values' );
vc_remove_param( 'vc_progress_bar', 'css' );
vc_remove_param( 'vc_progress_bar', 'title' );

$weight = 100;

vc_add_params( 'vc_progress_bar', array_merge( Atomlab_VC::get_vc_spacing_tab(), array(
	array(
		'heading'    => esc_html__( 'Style', 'atomlab' ),
		'type'       => 'dropdown',
		'param_name' => 'style',
		'value'      => array(
			esc_html__( '01', 'atomlab' ) => '1',
			esc_html__( '02', 'atomlab' ) => '2',
		),
		'std'        => '1',
		'weight'     => $weight --,
	),
	array(
		'heading'     => esc_html__( 'Bar height', 'atomlab' ),
		'description' => esc_html__( 'Controls the height of bar.', 'atomlab' ),
		'type'        => 'number',
		'param_name'  => 'bar_height',
		'std'         => 4,
		'min'         => 1,
		'max'         => 50,
		'step'        => 1,
		'suffix'      => 'px',
		'weight'      => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Background Color', 'atomlab' ),
		'type'       => 'dropdown',
		'param_name' => 'background_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
			esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
			esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
		),
		'std'        => 'secondary',
		'weight'     => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Custom Background Color', 'atomlab' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_background_color',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#222',
		'weight'     => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Track Color', 'atomlab' ),
		'type'       => 'dropdown',
		'param_name' => 'track_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
			esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
			esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
		),
		'std'        => 'custom',
		'weight'     => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Custom Track Color', 'atomlab' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_track_color',
		'dependency' => array(
			'element' => 'track_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#ededed',
		'weight'     => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Text Color', 'atomlab' ),
		'type'       => 'dropdown',
		'param_name' => 'text_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
			esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
			esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
		),
		'std'        => 'custom',
		'weight'     => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Custom Text Color', 'atomlab' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_text_color',
		'dependency' => array(
			'element' => 'text_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#333',
		'weight'     => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Units Color', 'atomlab' ),
		'type'       => 'dropdown',
		'param_name' => 'units_color',
		'value'      => array(
			esc_html__( 'Default', 'atomlab' )         => '',
			esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
			esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
			esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight --,
	),
	array(
		'heading'    => esc_html__( 'Custom Units Color', 'atomlab' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_units_color',
		'dependency' => array(
			'element' => 'units_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#333',
		'weight'     => $weight --,
	),
	array(
		'group'       => esc_html__( 'Items', 'atomlab' ),
		'type'        => 'param_group',
		'heading'     => esc_html__( 'Values', 'atomlab' ),
		'param_name'  => 'values',
		'description' => esc_html__( 'Enter values for graph - value, title and color.', 'atomlab' ),
		'value'       => rawurlencode( wp_json_encode( array(
			array(
				'label' => esc_html__( 'Development', 'atomlab' ),
				'value' => '90',
			),
			array(
				'label' => esc_html__( 'Design', 'atomlab' ),
				'value' => '80',
			),
			array(
				'label' => esc_html__( 'Marketing', 'atomlab' ),
				'value' => '70',
			),
		) ) ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Label', 'atomlab' ),
				'param_name'  => 'label',
				'description' => esc_html__( 'Enter text used as title of bar.', 'atomlab' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Value', 'atomlab' ),
				'param_name'  => 'value',
				'description' => esc_html__( 'Enter value of bar.', 'atomlab' ),
				'admin_label' => true,
			),
			array(
				'heading'    => esc_html__( 'Background Color', 'atomlab' ),
				'type'       => 'dropdown',
				'param_name' => 'background_color',
				'value'      => array(
					esc_html__( 'Default', 'atomlab' )         => '',
					esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
					esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
					esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Background Color', 'atomlab' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_background_color',
				'dependency' => array(
					'element' => 'background_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#222',
			),
			array(
				'heading'    => esc_html__( 'Track Color', 'atomlab' ),
				'type'       => 'dropdown',
				'param_name' => 'track_color',
				'value'      => array(
					esc_html__( 'Default', 'atomlab' )         => '',
					esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
					esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
					esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Track Color', 'atomlab' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_track_color',
				'dependency' => array(
					'element' => 'track_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#ededed',
			),
			array(
				'heading'    => esc_html__( 'Text Color', 'atomlab' ),
				'type'       => 'dropdown',
				'param_name' => 'text_color',
				'value'      => array(
					esc_html__( 'Default', 'atomlab' )         => '',
					esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
					esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
					esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Text Color', 'atomlab' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_text_color',
				'dependency' => array(
					'element' => 'text_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#333',
			),
		),
	),
) ) );
