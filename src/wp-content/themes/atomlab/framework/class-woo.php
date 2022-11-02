<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions, filters, actions for WooCommerce.
 */
if ( ! class_exists( 'Atomlab_Woo' ) ) {
	class Atomlab_Woo {

		protected static $instance = null;

		public function __construct() {
			// Disable Woocommerce cart fragments on home page.
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woocommerce_cart_fragments' ), 11 );

			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'header_add_to_cart_fragment' ) );

			add_filter( 'woocommerce_checkout_fields', array( $this, 'override_checkout_fields' ) );

			add_action( 'wp_head', array( $this, 'init' ) );

			add_action( 'after_switch_theme', array( $this, 'change_woocommerce_image_dimensions' ), 1 );

			/* Begin hook for shop archive */
			add_filter( 'insight_sw_loop_action', array( $this, 'change_swatches_position' ) );
			add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );

			add_filter( 'woocommerce_pagination_args', array( $this, 'override_pagination_args' ) );

			// Remove the product rating display on product loops
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

			// Add link to the product title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			add_action( 'woocommerce_shop_loop_item_title', array(
				$this,
				'template_loop_product_title',
			), 10 );

			/* End hook for shop archive */

			/*
			 * Begin hooks for single product
			 */

			// Remove tab heading in on single product pages.
			add_filter( 'woocommerce_product_description_heading', array(
				$this,
				'remove_product_description_heading',
			) );
			add_filter( 'woocommerce_product_additional_information_heading', array(
				$this,
				'remove_product_additional_information_heading',
			) );

			add_filter( 'woocommerce_review_gravatar_size', array( $this, 'woocommerce_review_gravatar_size' ) );

			// Hide default wishlist button.
			add_filter( 'yith_wcwl_positions', function() {
				return array(
					'add-to-cart' => array(
						'hook'     => '',
						'priority' => 0,
					),
					'thumbnails'  => array(
						'hook'     => '',
						'priority' => 0,
					),
					'summary'     => array(
						'hook'     => '',
						'priority' => 0,
					),
				);
			} );

			add_filter( 'yith_wcwl_add_to_wishlist_params', array( $this, 'add_params_to_add_wishlist' ) );

			// Hide default compare button.
			add_filter( 'yith_woocompare_remove_compare_link_by_cat', function() {
				return true;
			} );

			/*
			 * End hooks for single product
			 */

			// Quick view.
			/*add_action( 'wp_ajax_woo_quickview', array( $this, 'woo_quickview' ) );
			add_action( 'wp_ajax_nopriv_woo_quickview', array( $this, 'woo_quickview' ) );*/

			// Notice Cookie Confirm.
			add_action( 'wp_ajax_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );
			add_action( 'wp_ajax_nopriv_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );

			// Switch Shop Layout View.
			add_action( 'wp_ajax_shop_layout_change', array( $this, 'shop_layout_change' ) );
			add_action( 'wp_ajax_nopriv_shop_layout_change', array( $this, 'shop_layout_change' ) );

			// Shortcode Product Infinity.
			add_action( 'wp_ajax_product_infinite_load', array( $this, 'product_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_product_infinite_load', array( $this, 'product_infinite_load' ) );

			add_action( 'insight_swatches', array( $this, 'add_insight_swatches' ) );
		}

		public function add_params_to_add_wishlist( $additional_params ) {
			if ( isset( $additional_params['container_classes'] ) ) {
				$additional_params['container_classes'] = $additional_params['container_classes'] . ' product-action';
			}

			$tooltip_position = 'left';
			$hint_classes     = '';
			$tooltip_position = apply_filters( 'woocommerce_wishlist_tooltip_position', $tooltip_position );

			$additional_params['atomlab_hint_classes'] = '';

			if ( $tooltip_position !== 'none' ) {
				$hint_classes                              .= "hint--rounded hint--bounce hint--{$tooltip_position}";
				$additional_params['atomlab_hint_classes'] = $hint_classes;
			}

			return $additional_params;
		}

		public function add_insight_swatches() {
			if ( class_exists( 'Insight_Swatches' ) ) {
				echo do_shortcode( '[insight_swatches]' );
			}
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function change_swatches_position() {
			return 'insight_swatches';
		}

		/**
		 * Custom product title instead of default product title
		 *
		 * @see woocommerce_template_loop_product_title()
		 */
		public function template_loop_product_title() {
			?>
			<h2 class="woocommerce-loop-product__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php
		}

		function woo_quickview() {
			global $post, $product;

			$post = get_post( $_REQUEST['pid'] );
			setup_postdata( $post );

			$product = wc_get_product( $post->ID );

			get_template_part( 'woocommerce/quick-view' );
			wp_reset_postdata();

			wp_die();
		}

		function loop_shop_per_page( $cols ) {
			if ( isset( $_GET['shop_archive_number_item'] ) && $_GET['shop_archive_number_item'] !== '' ) {
				$number = $_GET['shop_archive_number_item'];
			} else {
				$number = Atomlab::setting( 'shop_archive_number_item' );
			}

			return isset( $_GET['product_per_page'] ) ? wc_clean( $_GET['product_per_page'] ) : $number;
		}

		function change_woocommerce_image_dimensions() {
			global $pagenow;

			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}

			$catalog = array(
				'width'  => '480',
				'height' => '9999',
				'crop'   => 0,
			);

			$single = array(
				'width'  => '570',
				'height' => '9999',
				'crop'   => 0,
			);

			$thumbnail = array(
				'width'  => '150',
				'height' => '150',
				'crop'   => 1,
			);

			update_option( 'shop_catalog_image_size', $catalog );
			update_option( 'shop_single_image_size', $single );
			update_option( 'shop_thumbnail_image_size', $thumbnail );
		}

		function override_pagination_args( $args ) {
			$args['prev_text'] = esc_html__( 'Prev', 'atomlab' );
			$args['next_text'] = esc_html__( 'Next', 'atomlab' );

			return $args;
		}

		public function remove_product_description_heading() {
			return '';
		}

		public function remove_product_additional_information_heading() {
			return '';
		}

		public function woocommerce_review_gravatar_size() {
			return 70;
		}

		public function init() {
			if ( Atomlab::setting( 'single_product_up_sells_enable' ) === '0' ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}

			if ( Atomlab::setting( 'single_product_related_enable' ) === '0' ) {
				add_filter( 'woocommerce_related_products_args', array( $this, 'wc_remove_related_products' ), 10 );
			}

			// Remove Cross Sells from default position at Cart. Then add them back UNDER the Cart Table.
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			if ( Atomlab::setting( 'shopping_cart_cross_sells_enable' ) === '1' ) {
				add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );
			}
		}

		/**
		 * wc_remove_related_products
		 *
		 * Clear the query arguments for related products so none show.
		 */
		function wc_remove_related_products( $args ) {
			return array();
		}

		public function override_checkout_fields( $fields ) {
			$fields['billing']['billing_first_name']['placeholder'] = esc_html__( 'First Name *', 'atomlab' );
			$fields['billing']['billing_last_name']['placeholder']  = esc_html__( 'Last Name *', 'atomlab' );
			$fields['billing']['billing_company']['placeholder']    = esc_html__( 'Company Name', 'atomlab' );
			$fields['billing']['billing_email']['placeholder']      = esc_html__( 'Email Address *', 'atomlab' );
			$fields['billing']['billing_phone']['placeholder']      = esc_html__( 'Phone *', 'atomlab' );
			$fields['billing']['billing_address_1']['placeholder']  = esc_html__( 'Address *', 'atomlab' );
			$fields['billing']['billing_address_2']['placeholder']  = esc_html__( 'Address', 'atomlab' );
			$fields['billing']['billing_city']['placeholder']       = esc_html__( 'Town / City *', 'atomlab' );
			$fields['billing']['billing_postcode']['placeholder']   = esc_html__( 'Zip *', 'atomlab' );

			$fields['shipping']['shipping_first_name']['placeholder'] = esc_html__( 'First Name *', 'atomlab' );
			$fields['shipping']['shipping_last_name']['placeholder']  = esc_html__( 'Last Name *', 'atomlab' );
			$fields['shipping']['shipping_company']['placeholder']    = esc_html__( 'Company Name', 'atomlab' );
			$fields['shipping']['shipping_city']['placeholder']       = esc_html__( 'Town / City *', 'atomlab' );
			$fields['shipping']['shipping_postcode']['placeholder']   = esc_html__( 'Zip *', 'atomlab' );

			return $fields;
		}

		public function dequeue_woocommerce_cart_fragments() {
			if ( is_front_page() && class_exists( 'WooCommerce' ) && add_theme_support( 'woo_speed' ) ) {
				wp_dequeue_script( 'wc-cart-fragments' );
			}
		}

		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 * ========================================================================
		 *
		 * @param $fragments
		 *
		 * @return mixed
		 */
		function header_add_to_cart_fragment( $fragments ) {
			ob_start();
			$cart_html = self::get_minicart();
			echo '' . $cart_html;
			$fragments['.mini-cart__button'] = ob_get_clean();

			return $fragments;
		}

		/**
		 * Get mini cart HTML
		 * ==================
		 *
		 * @return string
		 */
		static function get_minicart() {
			$cart_html = '';
			$qty       = WC()->cart->get_cart_contents_count();
			$cart_html .= '<div class="mini-cart__button" title="' . esc_attr__( 'View your shopping cart', 'atomlab' ) . '">';
			$cart_html .= '<span class="mini-cart-icon" data-count="' . $qty . '"></span>';
			$cart_html .= '</div>';

			return $cart_html;
		}

		static function render_mini_cart() {
			$type                 = Atomlab_Global::instance()->get_header_type();
			$shopping_cart_enable = Atomlab::setting( "header_style_{$type}_cart_enable" );

			if ( class_exists( 'WooCommerce' ) && in_array( $shopping_cart_enable, array( '1', 'hide_on_empty' ) ) ) {
				global $woocommerce;
				$cart_url = '/cart';
				if ( isset( $woocommerce ) ) {
					$cart_url = wc_get_cart_url();
				}
				$classes = 'mini-cart';
				if ( $shopping_cart_enable === 'hide_on_empty' ) {
					$classes .= ' hide-on-empty';
				}
				?>
				<div id="mini-cart" class="<?php echo esc_attr( $classes ); ?>"
				     data-url="<?php echo esc_url( $cart_url ); ?>">
					<?php echo self::get_minicart(); ?>
					<div class="widget_shopping_cart_content"></div>
				</div>
			<?php }
		}

		static function get_percentage_price() {
			global $product;

			if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
				$_regular_price = $product->get_regular_price();
				$_sale_price    = $product->get_sale_price();

				$percentage = round( ( ( $_regular_price - $_sale_price ) / $_regular_price ) * 100 );

				return "-{$percentage}%";
			} else {
				return esc_html__( 'Sale', 'atomlab' );
			}
		}

		static function get_wishlist_button_template( $args = array() ) {
			$defaults = array(
				'tooltip_position' => 'left',
			);
			$args     = wp_parse_args( $args, $defaults );
			global $atomlab_vars;

			$atomlab_vars->wishlist_tooltip_position = $args['tooltip_position'];

			//Change tooltip position of current style.
			add_filter( 'woocommerce_wishlist_tooltip_position', function() {
				global $atomlab_vars;

				return $atomlab_vars->wishlist_tooltip_position;
			} );

			if ( ( Atomlab::setting( 'shop_archive_wishlist' ) === '1' ) && class_exists( 'YITH_WCWL' ) ) {
				echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
			}
		}

		static function get_compare_button_template( $args = array() ) {
			global $product;
			$product_id = $product->get_id();

			$defaults = array(
				'show_tooltip'     => true,
				'tooltip_position' => 'left',
			);
			$args     = wp_parse_args( $args, $defaults );

			if ( Atomlab::setting( 'shop_archive_compare' ) === '1' && class_exists( 'YITH_Woocompare' ) && ! wp_is_mobile() ) { ?>

				<?php
				$_wrapper_classes = 'product-action yith-compare-btn';
				if ( $args['show_tooltip'] === true ) {
					$_wrapper_classes .= ' hint--rounded hint--bounce';
					$_wrapper_classes .= " hint--{$args['tooltip_position']}";
				}
				?>

				<div class="<?php echo esc_attr( $_wrapper_classes ); ?>"
				     aria-label="<?php echo esc_attr__( 'Compare', 'atomlab' ) ?>">
					<a href="/?action=yith-woocompare-add-product&amp;id=<?php echo esc_attr( $product_id ); ?>"
					   class="compare"
					   data-product_id="<?php echo esc_attr( $product_id ); ?>"
					   rel="nofollow"><?php esc_html__( 'Compare', 'atomlab' ); ?></a>
				</div>

				<?php
			}
		}

		/**
		 * Get filtered min price for current products.
		 */
		static function get_filtered_price() {
			global $wpdb;

			$args       = wc()->query->get_main_query()->query_vars;
			$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
			$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

			if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
				$tax_query[] = array(
					'taxonomy' => $args['taxonomy'],
					'terms'    => array( $args['term'] ),
					'field'    => 'slug',
				);
			}

			foreach ( $meta_query + $tax_query as $key => $query ) {
				if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
					unset( $meta_query[ $key ] );
				}
			}

			$meta_query = new WP_Meta_Query( $meta_query );
			$tax_query  = new WP_Tax_Query( $tax_query );

			$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
			$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

			$sql = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
			$sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
			$sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
					AND {$wpdb->posts}.post_status = 'publish'
					AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND price_meta.meta_value > '' ";
			$sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

			if ( $search = WC_Query::get_main_search_query_sql() ) {
				$sql .= ' AND ' . $search;
			}

			return $wpdb->get_row( $sql );
		}

		static function get_filter_price_range() {
			global $wp;

			/*if ( ! wc()->query->get_main_query()->post_count ) {
				return;
			}*/

			wp_enqueue_script( 'wc-price-slider' );

			// Find min and max price in current result set.
			$prices = self::get_filtered_price();
			$min    = floor( $prices->min_price );
			$max    = ceil( $prices->max_price );

			if ( $min === $max ) {
				return;
			}

			if ( '' === get_option( 'permalink_structure' ) ) {
				$form_action = remove_query_arg( array(
					'page',
					'paged',
				), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
			} else {
				$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
			}

			/**
			 * Adjust max if the store taxes are not displayed how they are stored.
			 * Min is left alone because the product may not be taxable.
			 * Kicks in when prices excluding tax are displayed including tax.
			 */
			if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
				$tax_classes = array_merge( array( '' ), WC_Tax::get_tax_classes() );
				$class_max   = $max;

				foreach ( $tax_classes as $tax_class ) {
					if ( $tax_rates = WC_Tax::get_rates( $tax_class ) ) {
						$class_max = $max + WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max, $tax_rates ) );
					}
				}

				$max = $class_max;
			}

			$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : apply_filters( 'woocommerce_price_filter_widget_min_amount', $min );
			$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : apply_filters( 'woocommerce_price_filter_widget_max_amount', $max );

			echo '<div class="widget_price_filter"><form method="get" action="' . esc_url( $form_action ) . '">
			<div class="price_slider_wrapper">
				<div class="price_slider" style="display:none;"></div>
				<div class="price_slider_amount">
					<input type="text" id="min_price" name="min_price" value="' . esc_attr( $min_price ) . '" data-min="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_min_amount', $min ) ) . '" placeholder="' . esc_attr__( 'Min price', 'atomlab' ) . '" />
					<input type="text" id="max_price" name="max_price" value="' . esc_attr( $max_price ) . '" data-max="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_max_amount', $max ) ) . '" placeholder="' . esc_attr__( 'Max price', 'atomlab' ) . '" />
					<button type="submit" class="button">' . esc_html__( 'Filter', 'atomlab' ) . '</button>
					<div class="price_label" style="display:none;">
						' . esc_html__( 'Price:', 'atomlab' ) . ' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					' . wc_query_string_form_fields( null, array( 'min_price', 'max_price' ), '', true ) . '
					<div class="clear"></div>
				</div>
			</div>
		</form></div>';
		}

		static function get_sort_ordering( $sort = 'date:desc' ) {
			$catalog_orderby_options = array(
				'popularity' => __( 'Sort by popularity', 'atomlab' ),
				'rating'     => __( 'Sort by average rating', 'atomlab' ),
				'date:desc'  => __( 'Sort by newness', 'atomlab' ),
				'date:asc'   => __( 'Sort by oldest', 'atomlab' ),
				'price:asc'  => __( 'Sort by price: low to high', 'atomlab' ),
				'price:desc' => __( 'Sort by price: high to low', 'atomlab' ),
			);

			$output = '<div class="sorting"><select class="tm-grid-ajax-field product-sorting">';

			foreach ( $catalog_orderby_options as $value => $name ) {
				$output .= '<option value="' . $value . '"' . selected( $sort, $value, false ) . '>' . $name . '</option>';
			}

			$output .= '</select></div>';

			echo "{$output}";
		}

		static function get_filter_category() {
			$args       = array( 'taxonomy' => 'product_cat', 'hide_empty' => 0 );
			$categories = get_categories( $args );

			$output = '<div class="product-filter-category"><select class="tm-select-2 tm-grid-ajax-field product-category" name="product_cat[]">';

			foreach ( $categories as $cat ) {
				$output .= '<option value="' . $cat->slug . '">' . $cat->name . '</option>';
			}

			$output .= '</select></div>';

			echo "{$output}";
		}

		static function get_ajax_filter_template() {
			//self::get_filter_price_range();
			self::get_filter_category();
			self::get_sort_ordering();
		}

		public function product_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Atomlab_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			if ( in_array( $args['orderby'], array( 'meta_value', 'meta_value_num' ) ) ) {
				$args['meta_key'] = $_POST['meta_key'];
			}

			if ( isset( $_POST['minPrice'] ) && isset( $_POST['maxPrice'] ) ) {
				$args['meta_query'] = array(
					array(
						'key'     => '_price',
						'value'   => array( $_POST['minPrice'], $_POST['maxPrice'] ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					),
				);
			}

			$style = 'grid';
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}

			$atomlab_query = new WP_Query( $args );

			$response = array(
				'max_num_pages' => $atomlab_query->max_num_pages,
				'found_posts'   => $atomlab_query->found_posts,
				'count'         => $atomlab_query->post_count,
			);

			ob_start();

			if ( $atomlab_query->have_posts() ) :
				if ( $style === 'grid-simple' ) {
					/**
					 * Trim zeros in price decimals
					 **/
					add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

					//Change tooltip position of current style.
					add_filter( 'woocommerce_add_to_cart_tooltip_position', function( $position ) {
						return 'none';
					} );
					while ( $atomlab_query->have_posts() ) : $atomlab_query->the_post();
						wc_get_template_part( 'content', 'product-grid-simple' ); endwhile;
				} else {
					while ( $atomlab_query->have_posts() ) : $atomlab_query->the_post();
						wc_get_template_part( 'content', 'product' ); endwhile;
				}
			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public function shop_layout_change() {
			$layout = 'grid';

			if ( isset( $_POST['shop_layout'] ) && $_POST['shop_layout'] === 'list' ) {
				$layout = 'list';
			}

			setcookie( 'shop_layout', $layout, time() + 365 * 86400, COOKIEPATH, COOKIE_DOMAIN );

			wp_die();
		}

		public function notice_cookie_confirm() {
			setcookie( 'notice_cookie_confirm', 'yes', time() + 365 * 86400, COOKIEPATH, COOKIE_DOMAIN );

			wp_die();
		}
	}

	new Atomlab_Woo();
}
