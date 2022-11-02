<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Atomlab_Portfolio' ) ) {
	class Atomlab_Portfolio {

		public function __construct() {
			add_action( 'wp_ajax_portfolio_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_portfolio_infinite_load', array( $this, 'infinite_load' ) );
		}

		public static function is_taxonomy() {
			return is_tax( get_object_taxonomies( 'portfolio' ) );
		}

		public static function get_categories( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			$terms    = get_terms( array(
				'taxonomy' => 'portfolio_category',
			) );
			$results  = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'atomlab' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		public static function get_tags( $args = array() ) {
			$defaults = array(
				'all' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			$terms    = get_terms( array(
				'taxonomy' => 'portfolio_tags',
			) );
			$results  = array();

			if ( $args['all'] === true ) {
				$results['-1'] = esc_html__( 'All', 'atomlab' );
			}

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$results[ $term->slug ] = $term->name;
				}
			}

			return $results;
		}

		public function infinite_load() {
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

			$style         = isset( $_POST['style'] ) ? $_POST['style'] : 'grid';
			$overlay_style = $_POST['overlay_style'];
			$image_size    = isset( $_POST['image_size'] ) ? $_POST['image_size'] : '480x480';
			$metro_layout  = isset( $_POST['metro_layout'] ) ? $_POST['metro_layout'] : '';

			$atomlab_query = new WP_Query( $args );
			$count         = $atomlab_query->post_count;

			$response = array(
				'max_num_pages' => $atomlab_query->max_num_pages,
				'found_posts'   => $atomlab_query->found_posts,
				'count'         => $atomlab_query->post_count,
			);

			ob_start();

			if ( $atomlab_query->have_posts() ) :
				set_query_var( 'atomlab_query', $atomlab_query );
				set_query_var( 'count', $count );
				set_query_var( 'metro_layout', $metro_layout );
				set_query_var( 'image_size', $image_size );
				set_query_var( 'overlay_style', $overlay_style );

				get_template_part( 'loop/shortcodes/portfolio/style', $style );
			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public static function get_the_permalink() {
			$external = Atomlab::setting( 'archive_portfolio_external_url' );

			$url = get_the_permalink();

			if ( $external === '1' ) {
				$_url = self::get_post_meta( 'portfolio_url', '' );

				if ( $_url !== '' ) {
					$url = $_url;
				}
			}

			return $url;
		}

		public static function the_permalink() {
			$url = self::get_the_permalink();
			
			echo esc_url( $url );
		}

		public static function get_post_meta( $name, $default = '' ) {
			$options = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_portfolio_options', true ) );
			if ( $options !== false && isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}

			return $default;
		}
	}

	new Atomlab_Portfolio();
}
