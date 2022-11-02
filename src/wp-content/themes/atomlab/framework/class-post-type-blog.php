<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Atomlab_Post' ) ) {
	class Atomlab_Post {

		public function __construct() {
			add_action( 'wp_ajax_post_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'infinite_load' ) );

			add_action( 'category_add_form_fields', array( $this, 'add_category_extra_fields' ) );
			add_action( 'category_edit_form_fields', array( $this, 'edit_category_extra_fields' ) );
			add_action( 'edit_term', array( $this, 'save_category_extra_fields' ) );
			add_action( 'create_term', array( $this, 'save_category_extra_fields' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'category_colorpicker_enqueue' ) );
			add_action( 'admin_print_scripts', array( $this, 'colorpicker_init_inline' ), 20 );
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

			if ( ! empty( $_POST['extra_taxonomy'] ) ) {
				$args = Atomlab_VC::get_tax_query_of_taxonomies( $args, $_POST['extra_taxonomy'] );
			}

			$style        = isset( $_POST['style'] ) ? $_POST['style'] : 'grid_classic';
			$metro_layout = isset( $_POST['metro_layout'] ) ? $_POST['metro_layout'] : '';

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

				get_template_part( 'loop/shortcodes/blog/style', $style );

			endif;
			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public function category_colorpicker_enqueue( $taxonomy ) {
			if ( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
				return;
			}

			// Colorpicker Scripts
			wp_enqueue_script( 'wp-color-picker' );

			// Colorpicker Styles
			wp_enqueue_style( 'wp-color-picker' );
		}

		function colorpicker_init_inline() {
			if ( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
				return;
			}
			?>
			<script>
                jQuery( document ).ready( function ( $ ) {
                    $( '.colorpicker' ).wpColorPicker();
                } );
			</script>
			<?php
		}

		public function add_category_extra_fields() {
			?>
			<div class="form-field term-color-wrap">
				<label for="category_color"><?php esc_html_e( 'Color', 'atomlab' ); ?></label>
				<input type="text" name="category_color" id="category_color" value=""
				       class="colorpicker"/>
				<p class="description"><?php esc_html_e( 'Controls the color of this category in Magazine style' ); ?></p>
			</div>
			<?php
		}

		public function save_category_extra_fields( $term_id ) {
			if ( isset( $_POST['category_color'] ) && ! empty( $_POST['category_color'] ) ) {
				update_option( 'category_color' . $term_id, $_POST['category_color'] );
			}
		}

		public function edit_category_extra_fields( $category ) {
			$color         = get_option( 'category_color' . $category->term_id, '' );
			?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="category_color"><?php esc_html_e( 'Color', 'atomlab' ); ?></label>
				</th>
				<td>
					<input type="text"
					       name="category_color"
					       id="category_color"
					       class="colorpicker"
					       value="<?php echo $color; ?>"
					/>
					<p class="description"><?php esc_html_e( 'Controls the color of this category in Magazine style' ); ?></p>
				</td>
			</tr>
			<?php
		}

		public static function get_category_color( $term_id ) {
			$color = get_option( 'category_color' . $term_id, '' );

			return $color;
		}
	}

	new Atomlab_Post();
}
