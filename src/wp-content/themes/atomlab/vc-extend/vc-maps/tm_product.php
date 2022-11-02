<?php

class WPBakeryShortCode_TM_Product extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $atomlab_shortcode_lg_css;

		$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$ajax_filter_tab = esc_html__( 'Ajax Filter', 'atomlab' );

vc_map( array(
	'name'     => esc_html__( 'Product', 'atomlab' ),
	'base'     => 'tm_product',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-product',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Product Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'atomlab' )        => 'grid',
				esc_html__( 'Grid Simple', 'atomlab' ) => 'grid-simple',
			),
			'std'         => 'grid',
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
				'lg' => '4',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'grid', 'grid-simple' ),
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
				'value'   => array( 'grid', 'grid-simple' ),
			),
		),
		Atomlab_VC::get_animation_field( array( 'std' => 'move-up' ) ),
		Atomlab_VC::extra_class_field(),
		array(
			'group'       => esc_html__( 'Data Settings', 'atomlab' ),
			'heading'     => esc_html__( 'Items per page', 'atomlab' ),
			'description' => esc_html__( 'Number of items to show per page.', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => 12,
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
			'group'      => $ajax_filter_tab,
			'heading'    => esc_html__( 'Show Product Ajax Filter', 'atomlab' ),
			'type'       => 'checkbox',
			'param_name' => 'ajax_filter_enable',
			'value'      => array(
				esc_html__( 'Yes', 'atomlab' ) => '1',
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
