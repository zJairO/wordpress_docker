<?php

class WPBakeryShortCode_TM_Instagram extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;
		$tmp = '';

		if ( $atts['align'] === 'left' ) {
			$tmp .= 'justify-content: flex-start';
		} elseif ( $atts['align'] === 'center' ) {
			$tmp .= 'justify-content: center;';
		} elseif ( $atts['align'] === 'right' ) {
			$tmp .= 'justify-content: flex-end;';
		}

		if ( $tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['md_align'] !== '' ) {
			if ( $atts['md_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['md_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['md_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$atomlab_shortcode_md_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['sm_align'] !== '' ) {
			if ( $atts['sm_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['sm_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['sm_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$atomlab_shortcode_sm_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['xs_align'] !== '' ) {
			if ( $atts['xs_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['xs_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['xs_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$atomlab_shortcode_xs_css .= "$selector { $tmp }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Instagram', 'atomlab' ),
	'base'                      => 'tm_instagram',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-instagram',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'atomlab' )               => 'grid',
				esc_html__( 'Small Rounded List', 'atomlab' ) => 'small-rounded-list',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'User Name', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'text',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'small-rounded-list',
				),
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Image Size', 'atomlab' ),
			'param_name'  => 'size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Thumbnail 150x150', 'atomlab' )   => 'thumbnail',
				esc_html__( 'Small 240x240', 'atomlab' )       => 'small',
				esc_html__( 'Small 320x320', 'atomlab' )       => 'medium',
				esc_html__( 'Large 480x480', 'atomlab' )       => 'large',
				esc_html__( 'Extra Large 640x640', 'atomlab' ) => 'extra_large',
				esc_html__( 'Original', 'atomlab' )            => 'original',
			),
			'std'         => 'large',
		),
		array(
			'heading'    => esc_html__( 'Number of items', 'atomlab' ),
			'type'       => 'number',
			'param_name' => 'number_items',
			'std'        => '6',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'step'        => 1,
			'suffix'      => 'column (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'atomlab' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
	), Atomlab_VC::get_alignment_fields(), array(
		array(
			'heading'    => esc_html__( 'Show User Name', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'show_user_name',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Show overlay likes and comments', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'overlay',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Open links in a new tab.', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'link_target',
			'value'      => array(
				esc_html__( 'Yes', 'atomlab' ) => '1',
			),
			'std'        => '1',
		),
		Atomlab_VC::extra_class_field(),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
