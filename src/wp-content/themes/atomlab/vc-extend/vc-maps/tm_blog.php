<?php

class WPBakeryShortCode_TM_Blog extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;
		extract( $atts );
		$tmp      = '';
		$item_tmp = '';

		$style           = isset( $atts['style'] ) ? $atts['style'] : '';
		$gutter          = isset( $atts['gutter'] ) ? $atts['gutter'] : 0;
		$carousel_gutter = isset( $atts['carousel_gutter'] ) ? $atts['carousel_gutter'] : 0;

		if ( in_array( $style, array( 'grid_classic' ), true ) ) {
			if ( $gutter > 0 ) {
				$item_tmp .= "margin-bottom: {$gutter}px";
			}
		} elseif ( $style === 'carousel' ) {
			if ( $carousel_gutter == 0 ) {
				$atomlab_shortcode_lg_css .= "$selector .post-item:not(.swiper-slide-active){ margin-left: -1px; }";
			}
		}

		if ( $tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector{ {$tmp} }";
		}

		if ( $item_tmp !== '' ) {
			$atomlab_shortcode_lg_css .= "$selector .post-item { {$item_tmp} }";
		}

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Carousel Settings', 'atomlab' );

vc_map( array(
	'name'     => esc_html__( 'Blog', 'atomlab' ),
	'base'     => 'tm_blog',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-blog',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Blog Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List Large Image', 'atomlab' )         => 'list',
				esc_html__( 'List Small Image', 'atomlab' )         => 'small_image_list',
				esc_html__( 'Grid Classic', 'atomlab' )             => 'grid_classic',
				esc_html__( 'Grid Masonry', 'atomlab' )             => 'grid_masonry',
				esc_html__( 'Grid Magazine', 'atomlab' )            => 'magazine',
				esc_html__( 'Grid Magazine Classic', 'atomlab' )    => 'magazine_classic',
				esc_html__( 'Grid Metro - Magazine', 'atomlab' )    => 'metro_magazine',
				esc_html__( 'First Feature Image List', 'atomlab' ) => 'first_feature_image_list',
				esc_html__( 'Grid Metro', 'atomlab' )               => 'metro',
				esc_html__( 'Carousel Slider', 'atomlab' )          => 'carousel',
				esc_html__( 'Full Wide Slider', 'atomlab' )         => 'full_wide_slider',
			),
			'std'         => 'list',
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
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'metro', 'metro_magazine' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Blog Skin', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'atomlab' ) => '',
				esc_html__( 'Light', 'atomlab' )   => 'light',
			),
			'std'         => '',
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
					'grid_masonry',
					'grid_classic',
					'magazine_classic',
					'metro',
					'metro_magazine',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'atomlab' ),
			'description' => esc_html__( 'Controls the gutter of grid. Default 30px', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 30,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
		),
		Atomlab_VC::get_animation_field(),
		Atomlab_VC::extra_class_field(),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Auto Play', 'atomlab' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'atomlab' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'full_wide_slider',
				),
			),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Navigation', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Atomlab_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'full_wide_slider',
				),
			),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Pagination', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Atomlab_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'full_wide_slider',
				),
			),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Gutter', 'atomlab' ),
			'type'       => 'number',
			'param_name' => 'carousel_gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
			'dependency' => array( 'element' => 'style', 'value' => 'carousel' ),
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
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array( 'element' => 'style', 'value' => 'carousel' ),
		),
		array(
			'group'      => esc_html__( 'Data Settings', 'businext' ),
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
			'group'      => esc_html__( 'Filter', 'atomlab' ),
			'heading'    => esc_html__( 'Filter Enable', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_enable',
			'value'      => array( esc_html__( 'Enable', 'atomlab' ) => '1' ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid_masonry',
					'grid_classic',
					'magazine_classic',
					'metro',
					'metro_magazine',
				),
			),
		),
		array(
			'group'      => esc_html__( 'Filter', 'atomlab' ),
			'heading'    => esc_html__( 'Filter Counter', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_counter',
			'value'      => array( esc_html__( 'Enable', 'atomlab' ) => '1' ),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid_masonry',
					'grid_classic',
					'magazine_classic',
					'metro',
					'metro_magazine',
				),
			),
		),
		array(
			'group'       => esc_html__( 'Filter', 'atomlab' ),
			'heading'     => esc_html__( 'Filter Grid Wrapper', 'atomlab' ),
			'description' => esc_html__( 'Wrap filter into grid container.', 'atomlab' ),
			'type'        => 'checkbox',
			'param_name'  => 'filter_wrap',
			'value'       => array( esc_html__( 'Enable', 'atomlab' ) => '1' ),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid_masonry',
					'grid_classic',
					'magazine_classic',
					'metro',
					'metro_magazine',
				),
			),
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
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid_masonry',
					'grid_classic',
					'magazine_classic',
					'metro',
					'metro_magazine',
				),
			),
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
