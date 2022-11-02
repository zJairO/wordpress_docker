<?php

class WPBakeryShortCode_TM_Testimonial extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		$skin = $text_color = $custom_text_color = $name_color = $custom_name_color = $by_line_color = $custom_by_line_color = '';
		extract( $atts );

		if ( $skin === 'custom' ) {
			$text_tmp = $name_tmp = $by_line_tmp = '';

			if ( $text_color === 'custom' ) {
				$text_tmp .= "color: $custom_text_color;";
			}

			if ( $text_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .testimonial-desc{ $text_tmp }";
			}

			if ( $name_color === 'custom' ) {
				$name_tmp .= "color: $custom_name_color;";
			}

			if ( $name_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .testimonial-name{ $name_tmp }";
			}

			if ( $by_line_color === 'custom' ) {
				$by_line_tmp .= "color: $custom_by_line_color;";
			}

			if ( $by_line_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .testimonial-by-line{ $by_line_tmp }";
			}
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Slider Options', 'atomlab' );

vc_map( array(
	'name'                      => esc_html__( 'Testimonials', 'atomlab' ),
	'base'                      => 'tm_testimonial',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-testimonials',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'atomlab' ) => '1',
				esc_html__( 'Style 02', 'atomlab' ) => '2',
				esc_html__( 'Style 03', 'atomlab' ) => '3',
				esc_html__( 'Style 04', 'atomlab' ) => '4',
				esc_html__( 'Style 05', 'atomlab' ) => '5',
			),
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'atomlab' ) => '',
				esc_html__( 'Light', 'atomlab' )   => 'light',
				esc_html__( 'Custom', 'atomlab' )  => 'custom',
			),
			'std'         => '',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Text Color', 'atomlab' ),
			'param_name' => 'text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'atomlab' ) => '',
				esc_html__( 'Primary Color', 'atomlab' ) => 'primary',
				esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
			),
			'std'        => 'custom',
			'dependency' => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Custom Text Color', 'atomlab' ),
			'param_name'  => 'custom_text_color',
			'description' => esc_html__( 'Controls the color of testimonial text.', 'atomlab' ),
			'dependency'  => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'         => '#a9a9a9',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Name Color', 'atomlab' ),
			'param_name' => 'name_color',
			'value'      => array(
				esc_html__( 'Default Color', 'atomlab' ) => '',
				esc_html__( 'Primary Color', 'atomlab' ) => 'primary',
				esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
			),
			'std'        => 'custom',
			'dependency' => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Custom Name Color', 'atomlab' ),
			'param_name'  => 'custom_name_color',
			'description' => esc_html__( 'Controls the color of name text.', 'atomlab' ),
			'dependency'  => array(
				'element' => 'name_color',
				'value'   => array( 'custom' ),
			),
			'std'         => '#a9a9a9',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'By Line Color', 'atomlab' ),
			'param_name' => 'by_line_color',
			'value'      => array(
				esc_html__( 'Default Color', 'atomlab' ) => '',
				esc_html__( 'Primary Color', 'atomlab' ) => 'primary',
				esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
			),
			'std'        => 'custom',
			'dependency' => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Custom By Line Color', 'atomlab' ),
			'param_name'  => 'custom_by_line_color',
			'description' => esc_html__( 'Controls the color of by line text.', 'atomlab' ),
			'dependency'  => array(
				'element' => 'by_line_color',
				'value'   => array( 'custom' ),
			),
			'std'         => '#a9a9a9',
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'       => esc_html__( 'Data Settings', 'atomlab' ),
			'heading'     => esc_html__( 'Number', 'atomlab' ),
			'description' => esc_html__( 'Number of items to show.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => 9,
			'min'         => 1,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'group'              => esc_html__( 'Data Settings', 'atomlab' ),
			'heading'            => esc_html__( 'Narrow data source', 'atomlab' ),
			'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'atomlab' ),
			'type'               => 'autocomplete',
			'param_name'         => 'taxonomies',
			'settings'           => array(
				'multiple'       => true,
				'min_length'     => 1,
				'groups'         => true,
				// In UI show results grouped by groups, default false.
				'unique_values'  => true,
				// In UI show results except selected. NB! You should manually check values in backend, default false.
				'display_inline' => true,
				// In UI show results inline view, default false (each value in own line).
				'delay'          => 500,
				// delay for search. default 500.
				'auto_focus'     => true,
				// auto focus input, default true.
			),
			'param_holder_class' => 'vc_not-for-custom',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'atomlab' ),
			'heading'     => esc_html__( 'Order by', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'orderby',
			'value'       => array(
				esc_html__( 'Date', 'atomlab' )                  => 'date',
				esc_html__( 'Post ID', 'atomlab' )               => 'ID',
				esc_html__( 'Author', 'atomlab' )                => 'author',
				esc_html__( 'Title', 'atomlab' )                 => 'title',
				esc_html__( 'Last modified date', 'atomlab' )    => 'modified',
				esc_html__( 'Post/page parent ID', 'atomlab' )   => 'parent',
				esc_html__( 'Number of comments', 'atomlab' )    => 'comment_count',
				esc_html__( 'Menu order/Page Order', 'atomlab' ) => 'menu_order',
				esc_html__( 'Meta value', 'atomlab' )            => 'meta_value',
				esc_html__( 'Meta value number', 'atomlab' )     => 'meta_value_num',
				esc_html__( 'Random order', 'atomlab' )          => 'rand',
			),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'atomlab' ),
			'std'         => 'date',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'atomlab' ),
			'heading'     => esc_html__( 'Sort order', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'order',
			'value'       => array(
				esc_html__( 'Descending', 'atomlab' ) => 'DESC',
				esc_html__( 'Ascending', 'atomlab' )  => 'ASC',
			),
			'description' => esc_html__( 'Select sorting order.', 'atomlab' ),
			'std'         => 'DESC',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'atomlab' ),
			'heading'     => esc_html__( 'Meta key', 'atomlab' ),
			'description' => esc_html__( 'Input meta key for grid ordering.', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'meta_key',
			'dependency'  => array(
				'element' => 'orderby',
				'value'   => array(
					'meta_value',
					'meta_value_num',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Loop', 'atomlab' ),
			'group'      => $carousel_group,
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
			'std'        => '1',
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Auto Play', 'atomlab' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
			'std'         => 5000,
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Navigation', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Atomlab_VC::get_slider_navs(),
			'std'        => '',
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Pagination', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Atomlab_VC::get_slider_dots(),
			'std'        => '',
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Gutter', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_gutter',
			'min'         => 0,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => 30,
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Items Display', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_items_display',
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
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
