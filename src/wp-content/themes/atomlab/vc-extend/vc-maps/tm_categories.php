<?php

add_filter( 'vc_autocomplete_tm_categories_items_category_callback', array(
	'WPBakeryShortCode_TM_Categories',
	'autocomplete_category_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_categories_items_category_render', array(
	'WPBakeryShortCode_TM_Categories',
	'autocomplete_category_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Categories extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	public static function autocomplete_category_field_search( $search_string ) {
		$terms = get_terms( array(
			'taxonomy'   => 'category',
			'hide_empty' => false,
			'search'     => $search_string,
		) );

		$data = array();
		if ( ! empty( $terms ) || ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$data[] = array(
					'label' => $term->name,
					'value' => $term->slug,
				);
			}
		}

		return $data;
	}

	public static function autocomplete_category_field_render( $term ) {
		$term = get_term_by( 'slug', $term['value'], 'category' );

		$data = false;
		if ( $term ) {
			$data = array(
				'label' => $term->name,
				'value' => $term->slug,
			);
		}

		return $data;
	}

	public function get_inline_css( $selector = '', $atts ) {
		Atomlab_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Blog Categories', 'atomlab' ),
	'base'     => 'tm_categories',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-product-categories',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Categories Style', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'atomlab' ) => 'grid',
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
				'md' => '3',
				'sm' => '2',
				'xs' => '1',
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
		),
		Atomlab_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'atomlab' ),
			'heading'    => esc_html__( 'Items', 'atomlab' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'            => esc_html__( 'Category', 'atomlab' ),
					'description'        => esc_html__( 'Enter category name.', 'atomlab' ),
					'type'               => 'autocomplete',
					'param_name'         => 'category',
					'settings'           => array(
						'multiple'       => false,
						'min_length'     => 1,
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
					'admin_label'        => true,
				),
				array(
					'heading'    => esc_html__( 'Image', 'atomlab' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
			),
		),
	), Atomlab_VC::get_vc_spacing_tab() ),
) );
