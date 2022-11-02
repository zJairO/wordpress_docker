<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Atomlab_Actions_Filters' ) ) {
	class Atomlab_Actions_Filters {

		protected static $instance = null;

		public function __construct() {
			add_filter( 'wp_kses_allowed_html', array( $this, 'wp_kses_allowed_html' ), 2, 99 );

			/* Move post count inside the link */
			add_filter( 'wp_list_categories', array( $this, 'move_post_count_inside_link_category' ) );
			/* Move post count inside the link */
			add_filter( 'get_archives_link', array( $this, 'move_post_count_inside_link_archive' ) );

			add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );

			add_filter( 'embed_oembed_html', array( $this, 'add_wrapper_for_video' ), 10, 3 );
			add_filter( 'video_embed_html', array( $this, 'add_wrapper_for_video' ) ); // Jetpack.

			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Adds custom attributes to body tag.
			add_filter( 'insight_body_attributes', array( $this, 'add_attributes_to_body' ) );

			remove_filter( 'the_excerpt', 'wpautop' );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', array( $this, 'alter_search_loop' ), 1 );
				add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
				add_filter( 'pre_get_posts', array( $this, 'empty_search_filter' ) );
			}

			// Add inline style for shortcode.
			add_action( 'wp_footer', array( $this, 'shortcode_style' ) );

			add_filter( 'insightcore_bmw_nav_args', array( $this, 'add_extra_params_to_insightcore_bmw' ) );

			add_filter( 'wp_nav_menu_items', array( $this, 'custom_menu_items' ), 10, 2 );

			add_filter( 'widget_title', array( $this, 'tag_cloud_empty_title' ), 10, 3 );
		}

		function tag_cloud_empty_title( $title, $instance = array(), $base = '' ) {
			if ( in_array( $base, array( 'tag_cloud', 'categories' ) ) ) {
				if ( trim( $instance['title'] ) == '' ) {
					return '';
				}
			}

			return $title;
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function wp_kses_allowed_html( $allowedtags, $context ) {
			switch ( $context ) {
				case 'atomlab-default' :
					$allowedtags = array(
						'a'      => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
						),
						'img'    => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'src'    => array(),
							'width'  => array(),
							'height' => array(),
							'alt'    => array(),
							'srcset' => array(),
							'sizes'  => array(),
						),
						'div'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'strong' => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'b'      => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'span'   => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'i'      => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'del'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'ins'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'br'     => array(),
						'ul'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'ol'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'li'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'mark'   => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
					);
					break;
			}

			return $allowedtags;
		}

		public function custom_menu_items( $items, $args ) {
			$header_type = Atomlab_Templates::get_header_type();

			if ( $args->theme_location === 'primary' && $header_type === '09' ) {

				ob_start();

				$button_text        = Atomlab::setting( "header_style_{$header_type}_button_text" );
				$button_link        = Atomlab::setting( "header_style_{$header_type}_button_link" );
				$button_link_target = Atomlab::setting( "header_style_{$header_type}_button_link_target" );
				$button_classes     = 'header-special-button';

				?>
				<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
					<div class="header-button">
						<a class="<?php echo esc_attr( $button_classes ); ?>"
						   href="<?php echo esc_url( $button_link ); ?>"
							<?php if ( $button_link_target === '1' ) : ?>
								target="_blank"
							<?php endif; ?>
						>
							<span class="button-text"><?php echo esc_html( $button_text ); ?></span>
							<span class="button-icon ion-arrow-right-a"></span>
						</a>
					</div>
				<?php endif;

				$button = ob_get_contents();
				ob_clean();

				$items .= "<li>{$button}</li>";
			}

			return $items;
		}

		function add_extra_params_to_insightcore_bmw( $args ) {
			$args['walker'] = new Atomlab_Walker_Nav_Menu;

			return $args;
		}

		function move_post_count_inside_link_category( $links ) {
			// First remove span that added by woocommerce.
			$links = str_replace( '<span class="count">', '', $links );
			$links = str_replace( '</span>', '', $links );

			// Then add span again for both blog & shop.

			$links = str_replace( '</a> ', ' <span class="count">', $links );
			$links = str_replace( ')', '</span></a>', $links );
			$links = str_replace( '<span class="count">(', '<span class="count">', $links );

			return $links;
		}

		function move_post_count_inside_link_archive( $links ) {
			$links = str_replace( '</a>&nbsp;(', ' (', $links );
			$links = str_replace( ')', ')</a>', $links );

			return $links;
		}


		function change_widget_tag_cloud_args( $args ) {
			/* set the smallest & largest size in px */
			$args['separator'] = ', ';

			return $args;
		}

		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		function shortcode_style() {
			global $atomlab_shortcode_lg_css;
			global $atomlab_shortcode_md_css;
			global $atomlab_shortcode_sm_css;
			global $atomlab_shortcode_xs_css;
			$css = '';

			if ( $atomlab_shortcode_lg_css && $atomlab_shortcode_lg_css !== '' ) {
				$css .= $atomlab_shortcode_lg_css;
			}

			if ( $atomlab_shortcode_md_css && $atomlab_shortcode_md_css !== '' ) {
				$css .= "@media (max-width: 1199px) { $atomlab_shortcode_md_css }";
			}

			if ( $atomlab_shortcode_sm_css && $atomlab_shortcode_sm_css !== '' ) {
				$css .= "@media (max-width: 992px) { $atomlab_shortcode_sm_css }";
			}

			if ( $atomlab_shortcode_xs_css && $atomlab_shortcode_xs_css !== '' ) {
				$css .= "@media (max-width: 767px) { $atomlab_shortcode_xs_css }";
			}

			if ( $css !== '' ) :
				$css = Atomlab_Minify::css( $css );
				echo '<style scoped>' . $css . '</style>';
			endif;
		}

		public function alter_search_loop( $query ) {
			if ( $query->is_main_query() && $query->is_search() ) {
				$number_results = Atomlab::setting( 'search_page_number_results' );
				$query->set( 'posts_per_page', $number_results );
			}
		}

		/**
		 * Apply filters to the search query.
		 * Determines if we only want to display posts/pages and changes the query accordingly
		 */
		public function search_filter( $query ) {
			if ( $query->is_main_query() && $query->is_search ) {
				$filter = Atomlab::setting( 'search_page_filter' );
				if ( $filter !== 'all' ) {
					$query->set( 'post_type', $filter );
				}
			}

			return $query;
		}

		/**
		 * Make wordpress respect the search template on an empty search
		 */
		public function empty_search_filter( $query ) {
			if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
				$query->is_search = true;
				$query->is_home   = false;
			}

			return $query;
		}

		public function custom_excerpt_length() {
			return 999;
		}

		/**
		 * Add responsive container to embeds
		 */
		public function add_wrapper_for_video( $html, $url ) {
			$array = array(
				'youtube.com',
				'wordpress.tv',
				'vimeo.com',
				'dailymotion.com',
				'hulu.com',
			);

			if ( Atomlab_Helper::strposa( $url, $array ) ) {
				$html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
			}

			return $html;
		}

		public function add_attributes_to_body( $attrs ) {
			$site_width = Atomlab_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Atomlab::setting( 'site_width' );
			}
			$attrs['data-content-width'] = $site_width;

			return $attrs;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			global $atomlab_vars;

			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			// Adds a class for mobile device.
			if ( Atomlab::is_mobile() ) {
				$classes[] = 'mobile';
			}

			// Adds a class for tablet device.
			if ( Atomlab::is_tablet() ) {
				$classes[] = 'tablet';
			}

			// Adds a class for handheld device.
			if ( Atomlab::is_handheld() ) {
				$classes[] = 'handheld';
				$classes[] = 'mobile-menu';
			}

			// Adds a class for desktop device.
			if ( Atomlab::is_desktop() ) {
				$classes[] = 'desktop';
				$classes[] = 'desktop-menu';
			}

			$one_page_enable = Atomlab_Helper::get_post_meta( 'menu_one_page', '' );
			if ( $one_page_enable === '1' ) {
				$classes[] = 'one-page';
			}

			$title_bar_layout = Atomlab_Helper::get_post_meta( 'page_title_bar_layout', 'default' );
			if ( $title_bar_layout === 'default' ) {
				if ( is_singular( 'post' ) ) {
					$title_bar_layout = Atomlab::setting( 'single_post_title_bar_layout' );
				} elseif ( is_singular( 'page' ) ) {
					$title_bar_layout = Atomlab::setting( 'single_page_title_bar_layout' );
				} elseif ( is_singular( 'product' ) ) {
					$title_bar_layout = Atomlab::setting( 'single_product_title_bar_layout' );
				} elseif ( is_singular( 'portfolio' ) ) {
					$title_bar_layout = Atomlab::setting( 'single_portfolio_title_bar_layout' );
				} else {
					$title_bar_layout = Atomlab::setting( 'title_bar_layout' );
				}
				if ( $title_bar_layout === 'default' ) {
					$title_bar_layout = Atomlab::setting( 'title_bar_layout' );
				}
			}

			if ( $title_bar_layout !== 'none' ) {
				$classes[] = "page-title-bar-$title_bar_layout";
			}

			if ( is_singular( 'portfolio' ) ) {
				$style = Atomlab_Helper::get_post_meta( 'portfolio_layout_style', '' );
				if ( $style === '' ) {
					$style = Atomlab::setting( 'single_portfolio_style' );
				}
				$classes[] = "single-portfolio-style-$style";
			}

			$header_position = Atomlab_Helper::get_post_meta( 'header_position', '' );
			if ( $header_position !== '' ) {
				$classes[] = "page-header-$header_position";
			}

			$header_sticky_behaviour = Atomlab::setting( 'header_sticky_behaviour' );
			$classes[]               = "header-sticky-$header_sticky_behaviour";

			$site_layout = Atomlab_Helper::get_post_meta( 'site_layout', '' );
			if ( $site_layout === '' ) {
				$site_layout = Atomlab::setting( 'site_layout' );
			}
			$classes[] = $site_layout;

			$header_type = Atomlab_Global::instance()->get_header_type();

			if ( '14' === $header_type ) {
				$classes[] = 'content-visible';
			}

			if ( is_singular( 'post' ) || is_singular( 'product' ) ) {

				if ( $atomlab_vars->has_sidebar === true ) {
					$classes[] = 'page-has-sidebar';
				} else {
					$classes[] = 'page-has-no-sidebar';
				}

				if ( $atomlab_vars->has_both_sidebar ) {
					$classes[] = 'page-has-both-sidebar';
				}
			}

			return $classes;
		}
	}

	new Atomlab_Actions_Filters();
}
