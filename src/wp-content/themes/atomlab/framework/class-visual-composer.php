<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions, filters, actions for visual composer page builder.
 */
if ( ! class_exists( 'Atomlab_VC' ) ) {
	class Atomlab_VC {

		public function __construct() {
			if ( ! class_exists( 'Vc_Manager' ) ) {
				return;
			}

			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				vc_set_shortcodes_templates_dir( get_template_directory() . '/vc-extend/vc-templates' );
			}

			add_action( 'vc_before_init', array( $this, 'vc_set_as_theme' ) );
			add_action( 'vc_after_init', array( $this, 'load_vc_maps' ), 9999 );
			add_action( 'vc_after_init', array( $this, 'vc_after_init' ) );

			// Hook for admin editor.
			add_action( 'vc_build_admin_page', array( $this, 'remove_default_elements' ), 11 );
			// Hook for frontend editor.
			add_action( 'vc_load_shortcode', array( $this, 'remove_default_elements' ), 11 );

			/*
			 * Add styles & script file only on add new or edit post type.
			 */

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			add_filter( 'vc_google_fonts_get_fonts_filter', array( $this, 'update_google_fonts' ) );

			// Narrow data taxonomies.
			add_filter( 'vc_autocomplete_tm_blog_taxonomies_callback', array(
				$this,
				'autocomplete_blog_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_blog_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_callback', array(
				$this,
				'autocomplete_portfolio_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_callback', array(
				$this,
				'autocomplete_testimonial_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_taxonomies_callback', array(
				$this,
				'autocomplete_product_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_category_taxonomies_callback', array(
				$this,
				'autocomplete_product_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_category_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_items_pages_callback', array(
				$this,
				'autocomplete_pages_field_callback',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_items_pages_render', array(
				$this,
				'autocomplete_pages_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_icon_items_pages_callback', array(
				$this,
				'autocomplete_pages_field_callback',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_icon_items_pages_render', array(
				$this,
				'autocomplete_pages_field_render',
			), 10, 1 );
		}

		function vc_set_as_theme() {
			vc_set_as_theme();
		}

		function autocomplete_pages_field_render( $term ) {
			$args = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'name'        => $term['value'],
			);

			$query = new WP_Query( $args );
			$data  = false;
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) :
					$query->the_post();
					global $post;

					$data = array(
						'label' => get_the_title(),
						'value' => $post->post_name,
					);
				endwhile;
			}

			return $data;
		}

		function autocomplete_pages_field_callback( $search_string ) {
			$data = array();
			$args = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				's'           => $search_string,
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) :
					$query->the_post();
					global $post;

					$data[] = array(
						'label' => get_the_title(),
						'value' => $post->post_name,
					);
				endwhile;
			}

			return $data;
		}

		function vc_after_init() {
			$this->load_vc_params();
		}

		public function remove_default_elements() {
			vc_remove_element( 'vc_icon' );
			vc_remove_element( 'vc_empty_space' );
			vc_remove_element( 'vc_single_image' );
			vc_remove_element( 'vc_images_carousel' );
			vc_remove_element( 'vc_gallery' );
			vc_remove_element( 'vc_gmaps' );
			vc_remove_element( 'vc_custom_heading' );
			vc_remove_element( 'vc_posts_slider' );
			vc_remove_element( 'vc_hoverbox' );
			vc_remove_element( 'vc_toggle' );
			vc_remove_element( 'rev_slider_vc' );
			vc_remove_element( 'vc_pie' );
			vc_remove_element( 'contact-form-7' );
			vc_remove_element( 'vc_pinterest' );
			vc_remove_element( 'vc_facebook' );
			vc_remove_element( 'vc_tweetmeme' );
			vc_remove_element( 'vc_googleplus' );

			if ( class_exists( 'WooCommerce' ) ) {
				vc_remove_element( 'woocommerce_cart' );
				vc_remove_element( 'woocommerce_checkout' );
				vc_remove_element( 'woocommerce_order_tracking' );
				vc_remove_element( 'woocommerce_my_account' );
				vc_remove_element( 'product' );
				vc_remove_element( 'products' );
				vc_remove_element( 'add_to_cart' );
				vc_remove_element( 'add_to_cart_url' );
				vc_remove_element( 'product_page' );
				vc_remove_element( 'product_categories' );
				vc_remove_element( 'product_attribute' );
				vc_remove_element( 'product_category' );
				vc_remove_element( 'recent_products' );
				vc_remove_element( 'featured_products' );
				vc_remove_element( 'sale_products' );
				vc_remove_element( 'best_selling_products' );
				vc_remove_element( 'top_rated_products' );
			}
		}

		public function load_vc_maps() {
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_accordion.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_blog.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_categories.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_box_icon.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_card.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_icon.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_rotate_box.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_button_group.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_button.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_countdown.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_counter.php';

			if ( class_exists( 'WPCF7' ) ) {
				require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_contact_form_7.php';
			}

			if ( function_exists( 'mc4wp_show_form' ) ) {
				require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_mailchimp_form.php';
			}

			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_search_form.php';

			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_gmaps.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_gallery.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_heading.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_drop_cap.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_blockquote.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_list.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_image.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_table.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_grid.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_gradation.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_restaurant_menu.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_instagram.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_twitter.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_pie_chart.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_portfolio.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_info_boxes.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_banner.php';

			if ( class_exists( 'WooCommerce' ) ) {
				require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_product.php';
				require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_product_categories.php';
				require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_product_search_form.php';
			}

			if ( defined( 'DEVVN_IHOTSPOT_VER' ) ) {
				require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_image_hotspot.php';
				require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_hotspot_content.php';
			}

			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_pricing_group.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_pricing.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_popup_video.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_client.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_slider_icon_list.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_slider_group.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_slider.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_slider_vertical.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_slider_frame.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_product_banner_slider.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_group.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_team_member_group.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_team_member.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_testimonial.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_timeline.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_social_networks.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_view_demo.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_w_better_custom_menu.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_separator.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'tm_spacer.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_section.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_row.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_row_inner.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_column.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_column_inner.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_progress_bar.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_separator.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_widget_sidebar.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_tta_tabs.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_tta_section.php';
			require_once ATOMLAB_VC_MAPS_DIR . DS . 'vc_wp_custom_html.php';
		}

		public function load_vc_params() {
			require_once ATOMLAB_VC_PARAMS_DIR . DS . 'number' . DS . 'number.php';
			require_once ATOMLAB_VC_PARAMS_DIR . DS . 'number_responsive' . DS . 'number_responsive.php';
			require_once ATOMLAB_VC_PARAMS_DIR . DS . 'spacing' . DS . 'spacing.php';
			require_once ATOMLAB_VC_PARAMS_DIR . DS . 'datetime_picker' . DS . 'datetime_picker.php';
			require_once ATOMLAB_VC_PARAMS_DIR . DS . 'gradient' . DS . 'gradient.php';
			require_once ATOMLAB_VC_PARAMS_DIR . DS . 'radio_image' . DS . 'radio_image.php';
		}

		public static function get_slider_navs() {
			return array(
				esc_html__( 'None', 'atomlab' )     => '',
				esc_html__( 'Style 01', 'atomlab' ) => '1',
				esc_html__( 'Style 02', 'atomlab' ) => '2',
				esc_html__( 'Style 03', 'atomlab' ) => '3',
			);
		}

		public static function get_slider_dots() {
			return array(
				esc_html__( 'None', 'atomlab' )     => '',
				esc_html__( 'Style 01', 'atomlab' ) => '1',
				esc_html__( 'Style 02', 'atomlab' ) => '2',
				esc_html__( 'Style 03', 'atomlab' ) => '3',
				esc_html__( 'Style 04', 'atomlab' ) => '4',
			);
		}

		public static function equal_height_class_field() {
			return array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Equal Height Elements', 'atomlab' ),
				'param_name'  => 'equal_height_elements',
				'description' => esc_html__( 'Input class name or id of elements that you want to equal height. For Ex: .image OR .image, #content-wrap', 'atomlab' ),
				'std'         => '',
			);
		}

		public static function extra_class_field() {
			return array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'atomlab' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'atomlab' ),
				'std'         => '',
			);
		}

		public static function extra_id_field() {
			return array(
				'type'        => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'atomlab' ),
				'param_name'  => 'el_id',
				'description' => wp_kses( sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'atomlab' ), 'https://www.w3schools.com/tags/att_global_id.asp' ), array(
					'a' => array(
						'href'   => array(),
						'target' => array(),
					),
				) ),
			);
		}

		public static function css_editor_field() {
			return array(
				'group'      => esc_html__( 'Design Options', 'atomlab' ),
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'atomlab' ),
				'param_name' => 'css',
			);
		}

		public static function get_animation_field( $args = array() ) {
			$defaults = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'CSS Animation', 'atomlab' ),
				'desc'       => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'atomlab' ),
				'param_name' => 'animation',
				'value'      => array(
					esc_html__( 'Default', 'atomlab' )          => '',
					esc_html__( 'None', 'atomlab' )             => 'none',
					esc_html__( 'Fade In', 'atomlab' )          => 'fade-in',
					esc_html__( 'Move Up', 'atomlab' )          => 'move-up',
					esc_html__( 'Move Down', 'atomlab' )        => 'move-down',
					esc_html__( 'Move Left', 'atomlab' )        => 'move-left',
					esc_html__( 'Move Right', 'atomlab' )       => 'move-right',
					esc_html__( 'Scale Up', 'atomlab' )         => 'scale-up',
					esc_html__( 'Fall Perspective', 'atomlab' ) => 'fall-perspective',
					esc_html__( 'Fly', 'atomlab' )              => 'fly',
					esc_html__( 'Flip', 'atomlab' )             => 'flip',
					esc_html__( 'Helix', 'atomlab' )            => 'helix',
					esc_html__( 'Pop Up', 'atomlab' )           => 'pop-up',
				),
				'std'        => '',
			);
			$args     = wp_parse_args( $args, $defaults );

			return $args;
		}

		/**
		 * @param $term
		 *
		 * @return array|bool
		 */
		function autocomplete_taxonomies_field_render( $term ) {
			$t    = explode( ':', $term['value'] );
			$term = get_term_by( 'slug', $t[1], $t[0] );

			$data = false;
			if ( $term !== false ) {
				$data = $this->vc_get_term_object( $term );
			}

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_blog_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'post' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_portfolio_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'portfolio' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_product_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'product' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_testimonial_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'testimonial' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_get_data_from_post_type( $search_string, $post_type ) {
			$data             = array();
			$taxonomies_types = get_object_taxonomies( $post_type );
			$taxonomies       = get_terms( $taxonomies_types, array(
				'hide_empty' => false,
				'search'     => $search_string,
			) );
			if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = $this->vc_get_term_object( $t );
					}
				}
			}

			return $data;
		}

		function vc_get_term_object( $term ) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label'    => $term->name,
				'value'    => $term->taxonomy . ':' . $term->slug,
				'group_id' => $term->taxonomy,
				'group'    => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'atomlab' ),
			);
		}

		public static function get_tax_query_of_taxonomies( $atomlab_post_args, $taxonomies ) {
			if ( ! empty( $taxonomies ) ) {
				$terms = explode( ', ', $taxonomies );

				$atomlab_post_args['tax_query'] = array();
				$tax_queries                    = array(); // List of taxonomies.
				foreach ( $terms as $t ) {
					$tmp       = explode( ':', $t );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];
					if ( ! isset( $tax_queries[ $taxonomy ] ) ) {
						$tax_queries[ $taxonomy ] = array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => array( $term_slug ),
						);
					} else {
						$tax_queries[ $taxonomy ]['terms'][] = $term_slug;
					}
				}
				$atomlab_post_args['tax_query']             = array_values( $tax_queries );
				$atomlab_post_args['tax_query']['relation'] = 'OR';
			}

			return $atomlab_post_args;
		}

		public function admin_enqueue_scripts() {
			if ( ! function_exists( 'get_current_screen' ) ) {
				return;
			}

			$screen = get_current_screen();

			if ( $screen->base !== 'post' ) {
				return;
			}

			wp_enqueue_style( 'datetime-picker', ATOMLAB_THEME_URI . '/assets/libs/datetimepicker/jquery.datetimepicker.min.css' );
			wp_enqueue_script( 'datetime-picker', ATOMLAB_THEME_URI . '/assets/libs/datetimepicker/jquery.datetimepicker.full.min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );

			// Enqueue CSS.
			wp_enqueue_style( 'colorpicker-alt', ATOMLAB_THEME_URI . '/assets/libs/colorpicker/css/jquery-colorpicker.css' );
			wp_enqueue_style( 'classygradient-alt', ATOMLAB_THEME_URI . '/assets/libs/classygradient/css/jquery-classygradient-min.css' );

			wp_enqueue_script( 'colorpicker-alt', ATOMLAB_THEME_URI . '/assets/libs/colorpicker/js/jquery-colorpicker.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, false );
			wp_enqueue_script( 'classygradient-alt', ATOMLAB_THEME_URI . '/assets/libs/classygradient/js/jquery-classygradient-min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, false );
		}

		public static function get_progress_bar_inline_css( $selector = '', $atts ) {
			global $atomlab_shortcode_lg_css;
			extract( $atts );

			if ( $atts['bar_height'] !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector.vc_progress_bar .vc_general.vc_single_bar { height: {$atts['bar_height']}px; }";
			}

			if ( $atts['track_color'] === 'custom' ) {
				$atomlab_shortcode_lg_css .= "$selector .vc_single_bar { background-color: {$atts['custom_track_color']}; }";
			}

			if ( $atts['background_color'] === 'custom' ) {
				$atomlab_shortcode_lg_css .= "$selector .vc_single_bar .vc_bar { background-color: {$atts['custom_background_color']}; }";
			}

			if ( $atts['text_color'] === 'custom' ) {
				$atomlab_shortcode_lg_css .= "$selector .vc_single_bar_title { color: {$atts['custom_text_color']}; }";
			}

			$atomlab_shortcode_lg_css .= Atomlab_VC::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_section_css( $selector = '', $atts ) {
			global $atomlab_shortcode_lg_css;
			global $atomlab_shortcode_md_css;
			global $atomlab_shortcode_sm_css;
			global $atomlab_shortcode_xs_css;
			extract( $atts );
			$tmp = '';

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			if ( $atts['background_color'] === 'custom' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = self::get_lazy_load_image_url( $atts['background_image'] );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						if ( $atts['background_size'] === 'manual' ) {
							if ( $atts['background_size_manual'] !== '' ) {
								$tmp .= "background-size: {$atts['background_size_manual']};";
							}
						} else {
							$tmp .= "background-size: {$atts['background_size']};";
						}
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";
					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}
					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$atomlab_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$atomlab_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$atomlab_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector{ $tmp }";
			}

			$atomlab_shortcode_lg_css .= self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_row_css( $selector = '', $atts ) {
			global $atomlab_shortcode_lg_css;
			global $atomlab_shortcode_md_css;
			global $atomlab_shortcode_sm_css;
			global $atomlab_shortcode_xs_css;
			$gutter = '';
			extract( $atts );
			$tmp           = '';
			$primary_color = Atomlab::setting( 'primary_color' );
			$_color        = '#000';

			if ( $atts['separator_type'] !== '' ) {
				if ( $atts['separator_color'] === 'primary_color' ) {
					$_color = $primary_color;
				} elseif ( $atts['separator_color'] === 'custom' ) {
					$_color = $atts['custom_separator_color'];
				}
				$atomlab_shortcode_lg_css .= "$selector .vc_row-separator svg{ fill: $_color; }";

				if ( isset( $atts['separator_height'] ) ) {
					Atomlab_VC::get_responsive_css( array(
						'element' => "$selector .vc_row-separator svg",
						'atts'    => array(
							'height' => array(
								'media_str' => $atts['separator_height'],
								'unit'      => 'px',
							),
						),
					) );
				}
			}

			if ( isset( $layer_index ) && $layer_index !== '' ) {
				$tmp .= "position: relative; z-index: {$layer_index};";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			if ( $atts['background_color'] === 'custom' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = self::get_lazy_load_image_url( $atts['background_image'] );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						if ( $atts['background_size'] === 'manual' ) {
							if ( $atts['background_size_manual'] !== '' ) {
								$tmp .= "background-size: {$atts['background_size_manual']};";
							}
						} else {
							$tmp .= "background-size: {$atts['background_size']};";
						}
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";

					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}

					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $atts['effect'] === 'wavify' && isset( $atts['wavify_height'] ) && $atts['wavify_height'] !== '' ) {
				self::get_responsive_css( array(
					'element' => "$selector .wavify-wrapper svg",
					'atts'    => array(
						'height' => array(
							'media_str' => $atts['wavify_height'],
							'unit'      => 'px',
						),
					),
				) );
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$atomlab_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$atomlab_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$atomlab_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector{ $tmp }";
			}

			$atomlab_shortcode_lg_css .= self::get_vc_row_gutter( $selector, $gutter );

			$atomlab_shortcode_lg_css .= self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_row_inner_css( $selector = '', $atts ) {
			global $atomlab_shortcode_lg_css;
			global $atomlab_shortcode_md_css;
			global $atomlab_shortcode_sm_css;
			global $atomlab_shortcode_xs_css;
			$gutter = '';
			extract( $atts );
			$tmp = '';

			if ( $atts['max_width'] !== '' ) {
				$tmp .= "width: {$atts['max_width']}; max-width: 100%;";
				if ( $atts['content_alignment'] === 'center' ) {
					$tmp .= "margin: 0 auto;";
				} elseif ( $atts['content_alignment'] === 'right' ) {
					$tmp .= "float: right;";
				}

				if ( $atts['md_content_alignment'] !== '' ) {
					if ( $atts['md_content_alignment'] === 'left' ) {
						$atomlab_shortcode_md_css .= "$selector{ float: left; }";
					} elseif ( $atts['md_content_alignment'] === 'center' ) {
						$atomlab_shortcode_md_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['md_content_alignment'] === 'right' ) {
						$atomlab_shortcode_md_css .= "$selector{ float: right; }";
					}
				}

				if ( $atts['sm_content_alignment'] !== '' ) {
					if ( $atts['sm_content_alignment'] === 'left' ) {
						$atomlab_shortcode_sm_css .= "$selector{ float: left; }";
					} elseif ( $atts['sm_content_alignment'] === 'center' ) {
						$atomlab_shortcode_sm_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['sm_content_alignment'] === 'right' ) {
						$atomlab_shortcode_sm_css .= "$selector{ float: right; }";
					}
				}

				if ( $atts['xs_content_alignment'] !== '' ) {
					if ( $atts['xs_content_alignment'] === 'left' ) {
						$atomlab_shortcode_xs_css .= "$selector{ float: left; }";
					} elseif ( $atts['xs_content_alignment'] === 'center' ) {
						$atomlab_shortcode_xs_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['xs_content_alignment'] === 'right' ) {
						$atomlab_shortcode_xs_css .= "$selector{ float: right; }";
					}
				}
			}

			if ( isset( $layer_index ) && $layer_index !== '' ) {
				$tmp .= "position: relative; z-index: {$layer_index};";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			if ( $atts['background_color'] === 'custom' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = self::get_lazy_load_image_url( $atts['background_image'] );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						$tmp .= "background-size: {$atts['background_size']};";
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";

					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}

					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$atomlab_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$atomlab_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$atomlab_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector{ $tmp }";
			}

			$atomlab_shortcode_lg_css .= self::get_vc_row_gutter( $selector, $gutter );

			$atomlab_shortcode_lg_css .= self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_column_css( $selector = '', $atts ) {
			global $atomlab_shortcode_lg_css;
			global $atomlab_shortcode_md_css;
			global $atomlab_shortcode_sm_css;
			global $atomlab_shortcode_xs_css;
			$selector_inner   = "$selector > .vc_column-inner";
			$tmp              = '';
			$column_inner_tmp = '';

			if ( $atts['background_color'] === 'custom' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = self::get_lazy_load_image_url( $atts['background_image'] );

				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						$tmp .= "background-size: {$atts['background_size']};";
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";

					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}

					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $atts['hide_background_image'] === 'md' ) {
				$atomlab_shortcode_md_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'sm' ) {
				$atomlab_shortcode_sm_css .= "$selector { background-image: none !important; }";
			} elseif ( $atts['hide_background_image'] === 'xs' ) {
				$atomlab_shortcode_xs_css .= "$selector { background-image: none !important; }";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'border-radius', $atts['border_radius'] );
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= Atomlab_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
			}

			if ( isset( $atts['layer_index'] ) && $atts['layer_index'] !== '' ) {
				$tmp .= "position: relative; z-index: {$atts['layer_index']};";
			}

			if ( $tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector { $tmp }";
			}

			if ( $atts['max_width'] !== '' ) {
				$column_inner_tmp .= "width: {$atts['max_width']}; max-width: 100%;";
				if ( $atts['content_alignment'] === 'center' ) {
					$column_inner_tmp .= "margin: 0 auto;";
				} elseif ( $atts['content_alignment'] === 'right' ) {
					$column_inner_tmp .= "float: right;";
				}

				if ( $atts['md_content_alignment'] !== '' ) {
					if ( $atts['md_content_alignment'] === 'left' ) {
						$atomlab_shortcode_md_css .= "$selector_inner { float: left; }";
					} elseif ( $atts['md_content_alignment'] === 'center' ) {
						$atomlab_shortcode_md_css .= "$selector_inner { margin: 0 auto; float: none; }";
					} elseif ( $atts['md_content_alignment'] === 'right' ) {
						$atomlab_shortcode_md_css .= "$selector_inner { float: right; }";
					}
				}

				if ( $atts['sm_content_alignment'] !== '' ) {
					if ( $atts['sm_content_alignment'] === 'left' ) {
						$atomlab_shortcode_sm_css .= "$selector_inner { float: left; }";
					} elseif ( $atts['sm_content_alignment'] === 'center' ) {
						$atomlab_shortcode_sm_css .= "$selector_inner { margin: 0 auto; float: none; }";
					} elseif ( $atts['sm_content_alignment'] === 'right' ) {
						$atomlab_shortcode_sm_css .= "$selector_inner { float: right; }";
					}
				}

				if ( $atts['xs_content_alignment'] !== '' ) {
					if ( $atts['xs_content_alignment'] === 'left' ) {
						$atomlab_shortcode_xs_css .= "$selector_inner { float: left; }";
					} elseif ( $atts['xs_content_alignment'] === 'center' ) {
						$atomlab_shortcode_xs_css .= "$selector_inner { margin: 0 auto; float: none; }";
					} elseif ( $atts['xs_content_alignment'] === 'right' ) {
						$atomlab_shortcode_xs_css .= "$selector_inner { float: right; }";
					}
				}
			}

			if ( isset( $atts['order'] ) && $atts['order'] !== '' ) {
				$orders = explode( ';', $atts['order'] );
				foreach ( $orders as $order ) {
					$value = explode( ':', $order );
					if ( $value['0'] === 'lg' ) {
						$_css                     = Atomlab_Helper::get_css_prefix( 'order', $value['1'] );
						$atomlab_shortcode_lg_css .= "$selector { $_css }";
					} elseif ( $value['0'] === 'md' ) {
						$_css                     = Atomlab_Helper::get_css_prefix( 'order', $value['1'] );
						$atomlab_shortcode_md_css .= "$selector { $_css }";
					} elseif ( $value['0'] === 'sm' ) {
						$_css                     = Atomlab_Helper::get_css_prefix( 'order', $value['1'] );
						$atomlab_shortcode_sm_css .= "$selector { $_css }";
					} elseif ( $value['0'] === 'xs' ) {
						$_css                     = Atomlab_Helper::get_css_prefix( 'order', $value['1'] );
						$atomlab_shortcode_xs_css .= "$selector { $_css }";
					}
				}
			}

			if ( $column_inner_tmp !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector_inner { $column_inner_tmp }";
			}

			$spacing_selector = $selector . ' > .vc_column-inner';

			$atomlab_shortcode_lg_css .= self::get_vc_spacing_css( $spacing_selector, $atts );
		}

		public static function vc_spacing_has_border( $atts ) {
			$spacings = array(
				'lg_spacing',
				'md_spacing',
				'sm_spacing',
				'xs_spacing',
			);
			foreach ( $spacings as $val ) {
				if ( isset( $atts[ $val ] ) && $atts[ $val ] !== '' ) {
					if ( strpos( $atts[ $val ], 'border' ) !== false ) {
						return true;
					}
				}
			}

			return false;
		}

		public static function get_vc_spacing_tab() {
			$spacing_tab = esc_html__( 'Design Options', 'atomlab' );

			return array(
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Border Color', 'atomlab' ),
					'type'             => 'dropdown',
					'param_name'       => 'border_color',
					'value'            => array(
						esc_html__( 'Primary Color', 'atomlab' ) => 'primary',
						esc_html__( 'Custom Color', 'atomlab' )  => 'custom',
					),
					'std'              => 'custom',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Custom Border Color', 'atomlab' ),
					'type'             => 'colorpicker',
					'param_name'       => 'custom_border_color',
					'dependency'       => array(
						'element' => 'border_color',
						'value'   => array( 'custom' ),
					),
					'std'              => '#eeeeee',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Border Style', 'atomlab' ),
					'type'             => 'dropdown',
					'param_name'       => 'border_style',
					'value'            => array(
						esc_html__( 'Solid', 'atomlab' )  => 'solid',
						esc_html__( 'Dashed', 'atomlab' ) => 'dashed',
						esc_html__( 'Dotted', 'atomlab' ) => 'dotted',
						esc_html__( 'Double', 'atomlab' ) => 'double',
						esc_html__( 'Groove', 'atomlab' ) => 'groove',
						esc_html__( 'Ridge', 'atomlab' )  => 'ridge',
						esc_html__( 'Inset', 'atomlab' )  => 'inset',
						esc_html__( 'Outset', 'atomlab' ) => 'outset',
					),
					'std'              => 'solid',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Large Device Spacing', 'atomlab' ),
					'type'         => 'spacing',
					'param_name'   => 'lg_spacing',
					'spacing_icon' => 'fa-desktop',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Medium Device Spacing', 'atomlab' ),
					'type'         => 'spacing',
					'param_name'   => 'md_spacing',
					'spacing_icon' => 'fa-tablet fa-rotate-270',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Small Device Spacing', 'atomlab' ),
					'type'         => 'spacing',
					'param_name'   => 'sm_spacing',
					'spacing_icon' => 'fa-tablet',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Extra Small Spacing', 'atomlab' ),
					'type'         => 'spacing',
					'param_name'   => 'xs_spacing',
					'spacing_icon' => 'fa-mobile',
				),
			);
		}

		public static function get_alignment_fields( $args = array() ) {

			$defaults = array(
				'first_element' => false,
			);
			$args     = wp_parse_args( $args, $defaults );

			$_first_field_classes = 'vc_col-sm-3';
			if ( $args['first_element'] == true ) {
				$_first_field_classes .= ' vc_column-with-padding';
			}

			return array(
				array(
					'heading'          => '<label class="hint--right hint-bounce" style="margin-right: 10px;" data-hint="' . esc_html__( 'Large Device', 'atomlab' ) . '"><i class="fa fa-desktop"></i></label>' . esc_html__( 'Alignment', 'atomlab' ),
					'type'             => 'dropdown',
					'param_name'       => 'align',
					'value'            => array(
						esc_html__( 'Left', 'atomlab' )   => 'left',
						esc_html__( 'Center', 'atomlab' ) => 'center',
						esc_html__( 'Right', 'atomlab' )  => 'right',
					),
					'std'              => 'left',
					'edit_field_class' => $_first_field_classes,
				),
				array(
					'heading'          => '<label class="hint--top hint-bounce" style="margin-right: 10px;" data-hint="' . esc_html__( 'Medium Device', 'atomlab' ) . '"><i class="fa fa-tablet fa-rotate-270"></i></label>' . esc_html__( 'Alignment', 'atomlab' ),
					'type'             => 'dropdown',
					'param_name'       => 'md_align',
					'value'            => array(
						esc_html__( 'Inherit From Larger', 'atomlab' ) => '',
						esc_html__( 'Left', 'atomlab' )                => 'left',
						esc_html__( 'Center', 'atomlab' )              => 'center',
						esc_html__( 'Right', 'atomlab' )               => 'right',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'heading'          => '<label class="hint--top hint-bounce" style="margin-right: 10px;" data-hint="' . esc_html__( 'Small Device', 'atomlab' ) . '"><i class="fa fa-tablet"></i></label>' . esc_html__( 'Alignment', 'atomlab' ),
					'type'             => 'dropdown',
					'param_name'       => 'sm_align',
					'value'            => array(
						esc_html__( 'Inherit From Larger', 'atomlab' ) => '',
						esc_html__( 'Left', 'atomlab' )                => 'left',
						esc_html__( 'Center', 'atomlab' )              => 'center',
						esc_html__( 'Right', 'atomlab' )               => 'right',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-3',
				),
				array(
					'heading'          => '<label class="hint--top hint-bounce" style="margin-right: 10px;" data-hint="' . esc_html__( 'Extra Small Device', 'atomlab' ) . '"><i class="fa fa-mobile"></i></label>' . esc_html__( 'Alignment', 'atomlab' ),
					'type'             => 'dropdown',
					'param_name'       => 'xs_align',
					'value'            => array(
						esc_html__( 'Inherit From Larger', 'atomlab' ) => '',
						esc_html__( 'Left', 'atomlab' )                => 'left',
						esc_html__( 'Center', 'atomlab' )              => 'center',
						esc_html__( 'Right', 'atomlab' )               => 'right',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-3',
				),
			);
		}

		/**
		 * Generate to gutter CSS
		 *
		 * @param $selector
		 * @param $gutter
		 *
		 * @return string
		 */
		public static function get_vc_row_gutter( $selector, $gutter ) {
			$css = $default_css = $css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( $gutter !== '' ) {

				if ( ! is_numeric( $gutter ) ) {
					$arr = self::parse_responsive_string( $gutter );

					if ( ! empty( $arr ) ) {
						if ( count( $arr ) > 1 ) {

							foreach ( $arr as $key => $number ) {
								$number /= 2;
								switch ( $key ) {
									case 'xs':
										$css_xs_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_xs_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'sm':
										$css_sm_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_sm_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'md':
										$css_md_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_md_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'lg':
										$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									default:
										break;
								}
							}
						} else { // default css.
							$number     = $arr['lg'] / 2;
							$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
							$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
						}
					}
				} else {
					$number      = $gutter / 2;
					$default_css .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
					$default_css .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
				}

				if ( $default_css ) {
					$css .= $default_css;
				}

				if ( $css_lg_tmp ) {
					$css .= $css_lg_tmp;
				}
				if ( $css_md_tmp ) {
					$css .= "@media (max-width: 1199px){ $css_md_tmp }";
				}

				if ( $css_sm_tmp ) {
					$css .= "@media (max-width: 767px){ $css_sm_tmp }";
				}

				if ( $css_xs_tmp ) {
					$css .= "@media (max-width: 543px){ $css_xs_tmp }";
				}
			}

			return $css;
		}

		public static function get_vc_spacing_css( $selector = '', $atts ) {
			$css = '';

			if ( isset( $atts['lg_spacing'] ) && $atts['lg_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['lg_spacing'] );
			}

			if ( $atts['md_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['md_spacing'], 'max-width: 1199px' );
			}

			if ( $atts['sm_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['sm_spacing'], 'max-width: 992px' );
			}

			if ( $atts['xs_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['xs_spacing'], 'max-width: 767px' );
			}

			return $css;
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param $selector
		 * @param $values
		 * @param $media
		 *
		 * @return string
		 */
		public static function parse_spacing_value( $atts, $selector, $values, $media = '' ) {

			$css = '';
			if ( $selector ) {
				$spacing = explode( ';', $values );

				if ( $media !== '' ) {
					$css .= "@media ( $media ) {";
				}

				$css .= "$selector {";

				foreach ( $spacing as $value ) {
					$tmp  = explode( ':', $value );
					$attr = str_replace( '_', '-', $tmp[0] );
					$val  = $tmp[1];

					if ( strpos( $attr, 'border' ) !== false ) {
						$css          .= "$attr-width : {$val}px !important;";
						$border_color = '';
						if ( $atts['border_color'] === 'custom' ) {
							$border_color = $atts['custom_border_color'];
						} elseif ( $atts['border_color'] === 'primary' ) {
							$border_color = Atomlab::setting( 'primary_color' );
						}
						$css .= "$attr-color: $border_color;";
						$css .= "$attr-style: {$atts['border_style']};";
					} else {
						$css .= "$attr : {$val}px !important;";
					}
				}

				$css .= "}";

				if ( $media !== '' ) {
					$css .= "}";
				}
			}

			return $css;
		}

		public static function get_media_query_css( $selector, $attr, $value, $media ) {
			$css = '';
			if ( $selector ) {
				$css .= "@media ( $media ) { $selector { $attr:{$value}; } }";
			}

			return $css;
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param $args
		 *
		 * @return string
		 */
		public static function get_responsive_css( $args = array() ) {
			global $atomlab_shortcode_lg_css;
			global $atomlab_shortcode_md_css;
			global $atomlab_shortcode_sm_css;
			global $atomlab_shortcode_xs_css;

			$css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( ! empty( $args['element'] ) && ! empty( $args['atts'] ) ) {

				$element = $args['element'];

				foreach ( $args['atts'] as $prop => $prop_array ) {
					$unit = $prop_array['unit'];

					if ( ! is_numeric( $prop_array['media_str'] ) ) {
						$arr = self::parse_responsive_string( $prop_array['media_str'] );

						if ( ! empty( $arr ) ) {
							foreach ( $arr as $key => $number ) {
								switch ( $key ) {
									case 'xs':
										$css_xs_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									case 'sm':
										$css_sm_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									case 'md':
										$css_md_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									case 'lg':
										$css_lg_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									default:
										break;
								}
							}
						}
					} else {
						$css_lg_tmp .= $prop . ':' . $prop_array['media_str'] . $unit . ';';
					}
				}

				if ( $css_lg_tmp ) {
					$atomlab_shortcode_lg_css .= "$element { $css_lg_tmp }";
				}

				if ( $css_md_tmp ) {
					$atomlab_shortcode_md_css .= "$element { $css_md_tmp }";
				}

				if ( $css_sm_tmp ) {
					$atomlab_shortcode_sm_css .= "$element { $css_sm_tmp }";
				}

				if ( $css_xs_tmp ) {
					$atomlab_shortcode_xs_css .= "$element { $css_xs_tmp }";
				}
			}
		}

		/**
		 * Parse responsive string to array
		 *
		 * @param $str
		 *
		 * @return array
		 */
		public static function parse_responsive_string( $str ) {
			$data     = preg_split( '/;/', $str );
			$data_arr = array();

			foreach ( $data as $d ) {
				$pieces = explode( ':', $d );
				if ( count( $pieces ) == 2 ) {
					$key              = $pieces[0];
					$number           = $pieces[1];
					$data_arr[ $key ] = $number;
				}
			}

			return $data_arr;
		}

		public static function icon_libraries( $args = array() ) {
			$defaults = array(
				'dependency'     => array(),
				'admin_label'    => false,
				'allow_none'     => false,
				'param_name'     => 'icon_type',
				'icon_libraries' => array(
					esc_html__( 'Font Awesome', 'atomlab' ) => 'fontawesome',
					esc_html__( 'Ion', 'atomlab' )          => 'ion',
					esc_html__( 'Themify', 'atomlab' )      => 'themify',
					esc_html__( 'Flat', 'atomlab' )         => 'flat',
					esc_html__( 'Linea', 'atomlab' )        => 'linea',
				),
				'group'          => esc_html__( 'Icon', 'atomlab' ),
				'allow_svg'      => false,
			);
			$args     = wp_parse_args( $args, $defaults );

			$icon_libraries         = apply_filters( 'atomlab_vc_icon_libraries', $args['icon_libraries'] );
			$args['icon_libraries'] = $icon_libraries;

			if ( $args['allow_svg'] === true ) {
				$args['icon_libraries'] = $args['icon_libraries'] + array( esc_html__( 'Linea SVG', 'atomlab' ) => 'linea_svg' );
			}

			if ( $args['allow_none'] ) {
				$args['icon_libraries'] = array( esc_html__( 'None', 'atomlab' ) => '' ) + $args['icon_libraries'];
			}

			$type = array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon library', 'atomlab' ),
				'value'       => $args['icon_libraries'],
				'param_name'  => $args['param_name'],
				'description' => esc_html__( 'Select icon library.', 'atomlab' ),
			);

			if ( $args['admin_label'] ) {
				$type['admin_label'] = true;
			}

			if ( ! empty( $args['dependency'] ) ) {
				$type['dependency'] = $args['dependency'];
			}

			$results = array(
				$type,
			);

			foreach ( $args['icon_libraries'] as $key => $value ) {

				if ( $value === 'fontawesome' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'atomlab' ),
						'param_name'  => 'icon_fontawesome',
						'value'       => 'fa fa-adjust',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'fontawesome',
							'iconsPerPage' => 4000,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'fontawesome',
						),
						'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
					);
				} elseif ( $value === 'ion' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'atomlab' ),
						'param_name'  => 'icon_ion',
						'value'       => 'ion-alert',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'ion',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'ion',
						),
						'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
					);
				} elseif ( $value === 'themify' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'atomlab' ),
						'param_name'  => 'icon_themify',
						'value'       => 'ti-arrow-up',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'themify',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'themify',
						),
						'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
					);
				} elseif ( $value === 'flat' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'atomlab' ),
						'param_name'  => 'icon_flat',
						'value'       => 'flaticon-heartbeat',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'flat',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'flat',
						),
						'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
					);
				} elseif ( $value === 'linea' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'atomlab' ),
						'param_name'  => 'icon_linea',
						'value'       => 'linea-arrows-anticlockwise',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'linea',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'linea',
						),
						'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
					);
				} elseif ( $value === 'linea_svg' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'atomlab' ),
						'param_name'  => 'icon_linea_svg',
						'value'       => 'linea-arrows-anticlockwise',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'linea_svg',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'linea_svg',
						),
						'description' => esc_html__( 'Select icon from library.', 'atomlab' ),
					);
					$results[] = array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'SVG Animate Type', 'atomlab' ),
						'description' => esc_html__( 'Defines what kind of animation will be used.', 'atomlab' ),
						'param_name'  => 'icon_svg_animate_type',
						'value'       => array(
							esc_html__( 'One By One', 'atomlab' ) => 'oneByOne',
							esc_html__( 'Delayed', 'atomlab' )    => 'delayed',
							esc_html__( 'Sync', 'atomlab' )       => 'sync',
						),
						'std'         => 'oneByOne',
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'linea_svg',
						),
					);
				}
			}

			$results = apply_filters( 'atomlab_vc_icon_libraries_fields', $results, $args );

			if ( $args['group'] !== '' ) {
				foreach ( $results as $key => $item ) {
					$results[ $key ]['group'] = $args['group'];
				}
			}

			return $results;
		}

		public function update_google_fonts() {
			global $wp_filesystem;

			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();

			$path = get_template_directory() . '/vc-extend/vc_google_fonts.json';

			$fonts = array();

			if ( file_exists( $path ) ) {

				$json  = $wp_filesystem->get_contents( $path );
				$fonts = json_decode( $json );
			}

			return $fonts;
		}

		public static function get_separator_svg( $type ) {
			$output = '';

			switch ( $type ) {
				case 'triangle' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 0.156661 0.1"><polygon points="0.156661,3.93701e-006 0.156661,0.000429134 0.117665,0.05 0.0783307,0.0999961 0.0389961,0.05 -0,0.000429134 -0,3.93701e-006 0.0783307,3.93701e-006 "/></svg>';
					break;

				case 'big_triangle' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"/></svg>';
					break;

				case 'big_triangle_alt' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon points="0,0 50,100 100,0 101,100 0 101"></polygon></svg>';
					break;

				case 'big_triangle_left' :
				case 'big_triangle_right' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 2000 90" preserveAspectRatio="none"><polygon xmlns="https://www.w3.org/2000/svg" points="535.084,64.886 0,0 0,90 2000,90 2000,0 "></polygon></svg>';
					break;

				case 'tilt_left' :
				case 'tilt_right' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4 0.266661" preserveAspectRatio="none"><polygon class="fil0" points="4,0 4,0.266661 -0,0.266661 "/></svg>';
					break;

				case 'circle' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1"  viewBox="0 0 0.2 0.1"><path d="M0.200004 0c-3.93701e-006,0.0552205 -0.0447795,0.1 -0.100004,0.1 -0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1l0.200004 0z"/></svg>';
					break;

				case 'curve' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-7.87402e-006 0.0148858l0.00234646 0c0.052689,0.0154094 0.554437,0.154539 1.51807,0.166524l0.267925 0c0.0227165,-0.00026378 0.0456102,-0.000582677 0.0687992,-0.001 1.1559,-0.0208465 2.34191,-0.147224 2.79148,-0.165524l0.0180591 0 0 0.166661 -7.87402e-006 0 0 0.151783 -4.66666 0 0 -0.151783 -7.87402e-006 0 0 -0.166661z"/></svg>';
					break;

				case 'waves' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 6 0.1" preserveAspectRatio="none"><path d="M0.199945 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c-0.0541102,0 -0.0981929,-0.0430079 -0.0999409,-0.0967008l0 0.0967008 0.0999409 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm2.00004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm-0.1 0.1l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c-0.0552126,0 -0.0999921,-0.0447795 -0.1,-0.1 -7.87402e-006,0.0552205 -0.0447874,0.1 -0.1,0.1l0.2 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm-0.400008 0l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1 3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1zm1.90004 -0.1c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.200004 0c7.87402e-006,0.0552205 0.0447874,0.1 0.1,0.1l-0.2 0c0.0552126,0 0.0999921,-0.0447795 0.1,-0.1zm0.200004 0c3.93701e-006,0.0552205 0.0447795,0.1 0.100004,0.1l-0.200008 0c0.0552244,0 0.1,-0.0447795 0.100004,-0.1zm0.199945 0.00329921l0 0.0967008 -0.0999409 0c0.0541102,0 0.0981929,-0.0430079 0.0999409,-0.0967008z"/></svg>';
					break;

				case 'clouds' :
					$output = '<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 2.23333 0.1" preserveAspectRatio="none"><path class="fil0" d="M2.23281 0.0372047c0,0 -0.0261929,-0.000389764 -0.0423307,-0.00584252 0,0 -0.0356181,0.0278268 -0.0865354,0.0212205 0,0 -0.0347835,-0.00524803 -0.0579094,-0.0283701 0,0 -0.0334252,0.0112677 -0.0773425,-0.00116929 0,0 -0.0590787,0.0524724 -0.141472,0.000779528 0,0 -0.0288189,0.0189291 -0.0762362,0.0111535 -0.00458268,0.0141024 -0.0150945,0.040122 -0.0656811,0.0432598 -0.0505866,0.0031378 -0.076126,-0.0226614 -0.0808425,-0.0308228 -0.00806299,0.000854331 -0.0819961,0.0186969 -0.111488,-0.022815 -0.0076378,0.0114843 -0.059185,0.0252598 -0.083563,-0.000385827 -0.0295945,0.0508661 -0.111996,0.0664843 -0.153752,0.019 -0.0179843,0.00227559 -0.0571181,0.00573622 -0.0732795,-0.0152953 -0.027748,0.0419646 -0.110602,0.0366654 -0.138701,0.00688189 0,0 -0.0771732,0.0395709 -0.116598,-0.0147677 0,0 -0.0497598,0.02 -0.0773346,-0.00166929 0,0 -0.0479646,0.0302756 -0.0998937,0.00944094 0,0 -0.0252638,0.0107874 -0.0839488,0.00884646 0,0 -0.046252,0.000775591 -0.0734567,-0.0237087 0,0 -0.046252,0.0101024 -0.0769567,-0.00116929 0,0 -0.0450827,0.0314843 -0.118543,0.0108858 0,0 -0.0715118,0.0609803 -0.144579,0.00423228 0,0 -0.0385787,0.00770079 -0.0646299,0.000102362 0,0 -0.0387559,0.0432205 -0.125039,0.0206811 0,0 -0.0324409,0.0181024 -0.0621457,0.0111063l-3.93701e-005 0.0412205 2.2323 0 0 -0.0627953z"/></svg>';
					break;

			}

			return $output;
		}

		static function get_lazy_load_image_url( $image_id ) {
			$_url = wp_get_attachment_image_url( $image_id, 'full' );

			if ( Atomlab::setting( 'lazy_load_images' ) ) {
				$_url = Atomlab_Helper::aq_resize( array(
					'url'    => $_url,
					'width'  => 100,
					'height' => 100,
					'crop'   => true,
				) );
			}

			return $_url;
		}

		public static function get_grid_css( $selector = '', $atts ) {
			global $atomlab_shortcode_lg_css;
			global $atomlab_shortcode_md_css;
			global $atomlab_shortcode_sm_css;
			global $atomlab_shortcode_xs_css;

			$grid_css = '';

			if ( isset( $atts['columns'] ) && $atts['columns'] !== '' ) {
				$arr = explode( ';', $atts['columns'] );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );

					switch ( $tmp[0] ) {
						case 'sm' :
							$atomlab_shortcode_sm_css .= "$selector .modern-grid { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
							break;
						case 'md' :
							$atomlab_shortcode_md_css .= "$selector .modern-grid { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
							break;
						case 'xs' :
							$atomlab_shortcode_xs_css .= "$selector .modern-grid { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
							break;
						case 'lg' :
							$grid_css .= "grid-template-columns: repeat({$tmp[1]}, 1fr);";
							break;
					}
				}
			}

			if ( isset( $atts['gutter'] ) && $atts['gutter'] !== '' ) {
				$grid_css .= "grid-gap: {$atts['gutter']}px;";
			}

			if ( $grid_css !== '' ) {
				$atomlab_shortcode_lg_css .= "$selector .modern-grid { $grid_css }";
			}
		}
	}

	new Atomlab_VC();
}
