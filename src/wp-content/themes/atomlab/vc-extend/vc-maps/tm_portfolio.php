<?php

class WPBakeryShortCode_TM_Portfolio extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		global $atomlab_shortcode_md_css;
		global $atomlab_shortcode_sm_css;
		global $atomlab_shortcode_xs_css;
		extract( $atts );

		if ( isset( $atts['carousel_height'] ) && $atts['carousel_height'] !== '' ) {
			$arr = explode( ';', $atts['carousel_height'] );

			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				if ( $tmp['0'] === 'lg' ) {
					$atomlab_shortcode_lg_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'md' ) {
					$atomlab_shortcode_md_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'sm' ) {
					$atomlab_shortcode_sm_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'xs' ) {
					$atomlab_shortcode_xs_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				}
			}
		}

		$image_tmp = '';

		if ( $custom_styling_enable === '1' ) {
			Atomlab_VC::get_responsive_css( array(
				'element' => "$selector .post-overlay-title",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $overlay_title_font_size,
						'unit'      => 'px',
					),
				),
			) );

			if ( isset( $atts['image_rounded'] ) && $atts['image_rounded'] !== '' ) {
				$image_tmp .= Atomlab_Helper::get_css_prefix( 'border-radius', $atts['image_rounded'] );
			}
		}

		if ( $image_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .post-thumbnail img { {$image_tmp} }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_tab = esc_html__( 'Carousel Settings', 'atomlab' );
$styling_tab  = esc_html__( 'Styling', 'atomlab' );

vc_map( array(
	'name'     => esc_html__( 'Portfolio', 'atomlab' ),
	'base'     => 'tm_portfolio',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-portfoliogrid',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Portfolio Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'atomlab' )         => 'grid',
				esc_html__( 'Grid Metro', 'atomlab' )           => 'metro',
				esc_html__( 'Grid Masonry', 'atomlab' )         => 'masonry',
				esc_html__( 'Carousel Slider', 'atomlab' )      => 'carousel',
				esc_html__( 'Full Wide Slider', 'atomlab' )     => 'full-wide-slider',
				esc_html__( 'Grid Justify Gallery', 'atomlab' ) => 'justified',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'Metro Layout', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'metro_layout',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Size', 'atomlab' ),
					'type'        => 'dropdown',
					'param_name'  => 'size',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Width 1 - Height 1', 'atomlab' ) => '1:1',
						esc_html__( 'Width 1 - Height 2', 'atomlab' ) => '1:2',
						esc_html__( 'Width 2 - Height 1', 'atomlab' ) => '2:1',
						esc_html__( 'Width 2 - Height 2', 'atomlab' ) => '2:2',
					),
					'std'         => '1:1',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:1',
				),
				array(
					'size' => '1:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Columns', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 6,
			'step'        => 1,
			'suffix'      => '',
			'media_query' => array(
				'lg' => '3',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'atomlab' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 30,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
					'justified',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_html__( '480x480', 'atomlab' ) => '480x480',
				esc_html__( '480x311', 'atomlab' ) => '480x311',
				esc_html__( '481x325', 'atomlab' ) => '481x325',
				esc_html__( '500x324', 'atomlab' ) => '500x324',
			),
			'std'        => '480x480',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Row Height', 'atomlab' ),
			'description' => esc_html__( 'Controls the height of grid row.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'justify_row_height',
			'std'         => 300,
			'min'         => 50,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Max Row Height', 'atomlab' ),
			'description' => esc_html__( 'Controls the max height of grid row. Leave blank or 0 keep it disabled.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'justify_max_row_height',
			'std'         => 0,
			'min'         => 0,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Last row alignment', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'justify_last_row_alignment',
			'value'      => array(
				esc_html__( 'Justify', 'atomlab' )                              => 'justify',
				esc_html__( 'Left', 'atomlab' )                                 => 'nojustify',
				esc_html__( 'Center', 'atomlab' )                               => 'center',
				esc_html__( 'Right', 'atomlab' )                                => 'right',
				esc_html__( 'Hide ( if row can not be justified )', 'atomlab' ) => 'hide',
			),
			'std'        => 'justify',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Overlay Style', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'overlay_style',
			'value'      => array(
				esc_html__( 'None', 'atomlab' )                             => 'none',
				esc_html__( 'Modern', 'atomlab' )                           => 'modern',
				esc_html__( 'Image zoom - content below', 'atomlab' )       => 'zoom',
				esc_html__( 'Zoom and Move Up - content below', 'atomlab' ) => 'zoom2',
				esc_html__( 'Faded', 'atomlab' )                            => 'faded',
				esc_html__( 'Faded - Light', 'atomlab' )                    => 'faded-light',
			),
			'std'        => 'faded-light',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
					'carousel',
					'justified',
				),
			),
		),
		Atomlab_VC::get_animation_field( array(
			'std'        => 'move-up',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
					'justified',
				),
			),
		) ),
		Atomlab_VC::extra_class_field(),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Auto Play', 'atomlab' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'full-wide-slider',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Navigation', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Atomlab_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'full-wide-slider',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Pagination', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Atomlab_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'full-wide-slider',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Gutter', 'atomlab' ),
			'type'       => 'number',
			'param_name' => 'carousel_gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Items Display', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => 'carousel',
			),
		),
		array(
			'group'      => esc_html__( 'Data Settings', 'atomlab' ),
			'type'       => 'hidden',
			'param_name' => 'main_query',
			'std'        => '',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'atomlab' ),
			'heading'     => esc_html__( 'Items per page', 'atomlab' ),
			'description' => esc_html__( 'Number of items to show per page.', 'atomlab' ),
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
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Styling Enable', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'custom_styling_enable',
			'value'      => array( esc_html__( 'Yes', 'atomlab' ) => '1' ),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Overlay Title Font Size', 'atomlab' ),
			'type'        => 'number_responsive',
			'param_name'  => 'overlay_title_font_size',
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
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Image Rounded', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'image_rounded',
			'description' => esc_html__( 'Input a valid radius. Fox Ex: 10px. Leave blank to use default.', 'atomlab' ),
		),
		array(
			'group'      => esc_html__( 'Filter', 'atomlab' ),
			'heading'    => esc_html__( 'Filter Enable', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_enable',
			'value'      => array( esc_html__( 'Enable', 'atomlab' ) => '1' ),
			'std'        => '1',
		),
		array(
			'group'      => esc_html__( 'Filter', 'atomlab' ),
			'heading'    => esc_html__( 'Filter Counter', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_counter',
			'value'      => array( esc_html__( 'Enable', 'atomlab' ) => '1' ),
			'std'        => '1',
		),
		array(
			'group'       => esc_html__( 'Filter', 'atomlab' ),
			'heading'     => esc_html__( 'Filter Grid Wrapper', 'atomlab' ),
			'description' => esc_html__( 'Wrap filter into grid container.', 'atomlab' ),
			'type'        => 'checkbox',
			'param_name'  => 'filter_wrap',
			'value'       => array( esc_html__( 'Enable', 'atomlab' ) => '1' ),
		),
		array(
			'group'      => esc_html__( 'Filter', 'atomlab' ),
			'heading'    => esc_html__( 'Filter Align', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'filter_align',
			'value'      => array(
				esc_html__( 'Left', 'atomlab' )   => 'left',
				esc_html__( 'Center', 'atomlab' ) => 'center',
				esc_html__( 'Right', 'atomlab' )  => 'right',
			),
			'std'        => 'center',
		),
		array(
			'group'      => esc_html__( 'Pagination', 'atomlab' ),
			'heading'    => esc_html__( 'Pagination', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => array(
				esc_html__( 'No Pagination', 'atomlab' ) => '',
				esc_html__( 'Pagination', 'atomlab' )    => 'pagination',
				esc_html__( 'Button', 'atomlab' )        => 'loadmore',
				esc_html__( 'Custom Button', 'atomlab' ) => 'loadmore_alt',
				esc_html__( 'Infinite', 'atomlab' )      => 'infinite',
			),
			'std'        => '',
		),
		array(
			'group'      => esc_html__( 'Pagination', 'atomlab' ),
			'heading'    => esc_html__( 'Pagination Align', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination_align',
			'value'      => array(
				esc_html__( 'Left', 'atomlab' )   => 'left',
				esc_html__( 'Center', 'atomlab' ) => 'center',
				esc_html__( 'Right', 'atomlab' )  => 'right',
			),
			'std'        => 'left',
			'dependency' => array(
				'element' => 'pagination',
				'value'   => array( 'pagination', 'infinite', 'loadmore', 'loadmore_alt' ),
			),
		),
		array(
			'group'       => esc_html__( 'Pagination', 'atomlab' ),
			'heading'     => esc_html__( 'Button ID', 'atomlab' ),
			'description' => esc_html__( 'Input id of custom button to load more posts when click. For EX: #product-load-more-btn', 'atomlab' ),
			'type'        => 'el_id',
			'param_name'  => 'pagination_custom_button_id',
			'dependency'  => array(
				'element' => 'pagination',
				'value'   => 'loadmore_alt',
			),
		),
		array(
			'group'      => esc_html__( 'Pagination', 'atomlab' ),
			'heading'    => esc_html__( 'Pagination Button Text', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'pagination_button_text',
			'std'        => esc_html__( 'Load More', 'atomlab' ),
			'dependency' => array(
				'element' => 'pagination',
				'value'   => 'loadmore',
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );

