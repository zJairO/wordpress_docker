<?php

class WPBakeryShortCode_TM_List extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;

		$marker_tmp = $heading_tmp = $text_tmp = '';

		if ( $atts['marker_color'] === 'custom' ) {
			$marker_tmp .= "color: {$atts['custom_marker_color']}; ";
		}

		if ( $marker_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .tm-list__marker{ $marker_tmp }";
		}

		if ( $atts['title_color'] === 'custom' ) {
			$heading_tmp .= "color: {$atts['custom_title_color']}; ";
		}

		if ( $heading_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .tm-list__title{ $heading_tmp }";
		}

		if ( $atts['desc_color'] === 'custom' ) {
			$text_tmp .= "color: {$atts['custom_desc_color']}; ";
		}

		if ( $text_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .tm-list__desc{ $text_tmp }";
		}

		if ( $atts['columns'] !== '' ) {
			$arr = explode( ';', $atts['columns'] );
			foreach ( $arr as $value ) {
				$key = explode( ':', $value );

				switch ( $key[0] ) {
					case 'xs':
						if ( $key[1] > 1 ) {
							$atomlab_shortcode_xs_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$atomlab_shortcode_xs_css .= "$selector .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					case 'sm':
						if ( $key[1] > 1 ) {
							$atomlab_shortcode_sm_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$atomlab_shortcode_sm_css .= "$selector  .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					case 'md':
						if ( $key[1] > 1 ) {
							$atomlab_shortcode_md_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$atomlab_shortcode_md_css .= "$selector  .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					case 'lg':
						if ( $key[1] > 1 ) {
							$atomlab_shortcode_lg_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$atomlab_shortcode_lg_css .= "$selector  .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					default:
						break;
				}
			}
		}

		Atomlab_VC::get_responsive_css( array(
			'element' => "$selector .tm-list__title",
			'atts'    => array(
				'font-size' => array(
					'media_str' => $atts['heading_font_size'],
					'unit'      => 'px',
				),
			),
		) );

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'List', 'atomlab' ),
	'base'                      => 'tm_list',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'List Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'list_style',
			'value'       => array(
				esc_html__( 'Basic List', 'atomlab' )                => 'basic',
				esc_html__( 'Circle List', 'atomlab' )               => 'circle',
				esc_html__( 'Plus List', 'atomlab' )                 => 'plus',
				esc_html__( 'Icon List', 'atomlab' )                 => 'icon',
				esc_html__( 'Icon Above List', 'atomlab' )           => 'icon-above',
				esc_html__( 'Delimited List', 'atomlab' )            => 'delimited',
				esc_html__( 'Modern Icon List', 'atomlab' )          => 'modern-icon',
				esc_html__( '(Automatic) Numbered List', 'atomlab' ) => 'auto-numbered',
				esc_html__( '(Manual) Numbered List', 'atomlab' )    => 'manual-numbered',
			),
			'admin_label' => true,
			'std'         => 'icon',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 1,
				'md' => '',
				'sm' => '',
				'xs' => 1,
			),
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Marker Color', 'atomlab' ),
			'type'             => 'dropdown',
			'param_name'       => 'marker_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Marker Color', 'atomlab' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_marker_color',
			'dependency'       => array(
				'element' => 'marker_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Title Color', 'atomlab' ),
			'type'             => 'dropdown',
			'param_name'       => 'title_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Title Color', 'atomlab' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_title_color',
			'dependency'       => array(
				'element' => 'title_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Description Color', 'atomlab' ),
			'type'             => 'dropdown',
			'param_name'       => 'desc_color',
			'value'            => array(
				esc_html__( 'Default Color', 'atomlab' )   => '',
				esc_html__( 'Primary Color', 'atomlab' )   => 'primary',
				esc_html__( 'Secondary Color', 'atomlab' ) => 'secondary',
				esc_html__( 'Custom Color', 'atomlab' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Description Color', 'atomlab' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_desc_color',
			'dependency'       => array(
				'element' => 'desc_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Heading Font Size', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'heading_font_size',
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

		Atomlab_VC::icon_libraries( array(
			'allow_none' => true,
			'group'      => '',
			'dependency' => array(
				'element' => 'list_style',
				'value'   => array(
					'icon',
					'modern-icon',
					'icon-above',
				),
			),
		) ), array(
			Atomlab_VC::get_animation_field(),
			Atomlab_VC::extra_class_field(),
			array(
				'group'      => esc_html__( 'Items', 'atomlab' ),
				'heading'    => esc_html__( 'Items', 'atomlab' ),
				'type'       => 'param_group',
				'param_name' => 'items',
				'params'     => array_merge( array(
					array(
						'heading'     => esc_html__( 'Number', 'atomlab' ),
						'type'        => 'textfield',
						'param_name'  => 'item_number',
						'admin_label' => true,
						'description' => esc_html__( 'Only work with List Type: (Manual) Numbered list.', 'atomlab' ),
					),
					array(
						'heading'     => esc_html__( 'Item title', 'atomlab' ),
						'type'        => 'textfield',
						'param_name'  => 'item_title',
						'admin_label' => true,
					),
					array(
						'heading'    => esc_html__( 'Link', 'atomlab' ),
						'type'       => 'vc_link',
						'param_name' => 'link',
					),
					array(
						'heading'     => esc_html__( 'Description', 'atomlab' ),
						'type'        => 'textarea',
						'param_name'  => 'item_desc',
						'description' => esc_html__( 'Only work with List Type: (Automatic) & (Manual) Numbered list', 'atomlab' ),
					),
				), Atomlab_VC::icon_libraries( array(
					'allow_none' => true,
					'param_name' => 'type',
				) ) ),

			),

		), Atomlab_VC::get_vc_spacing_tab() ),
) );
