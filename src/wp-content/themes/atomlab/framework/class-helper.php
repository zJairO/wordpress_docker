<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper functions
 */
class Atomlab_Helper {

	public static function get_post_meta( $name, $default = false ) {
		global $atomlab_page_options;
		if ( $atomlab_page_options != false && isset( $atomlab_page_options[ $name ] ) ) {
			return $atomlab_page_options[ $name ];
		}

		return $default;
	}

	public static function get_the_post_meta( $options, $name, $default = false ) {
		if ( $options != false && isset( $options[ $name ] ) ) {
			return $options[ $name ];
		}

		return $default;
	}

	public static function get_the_footer_page_options() {
		$options = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_footer_options', true ) );

		return $options;
	}

	/**
	 * @return array
	 */
	public static function get_list_revslider() {
		$rev_sliders = array(
			'' => esc_html__( 'Select a slider', 'atomlab' ),
		);

		if ( function_exists( 'rev_slider_shortcode' ) ) {

			$sliders = get_transient( 'atomlab_rev_sliders' );

			if ( false === $sliders ) {
				global $wpdb;
				$table_name = $wpdb->prefix . "revslider_sliders";
				$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE type != %s ORDER BY title ASC", 'template' );
				$results    = $wpdb->get_results( $query );
				$sliders    = array();

				if ( ! empty( $results ) ) {


					foreach ( $results as $result ) {
						$sliders[ $result->alias ] = $result->title;
					}
				}
			}

			set_transient( 'atomlab_rev_sliders', $sliders, HOUR_IN_SECONDS * 1 );

			if ( is_array( $sliders ) && ! empty( $sliders ) ) {
				$rev_sliders += $sliders;
			}
		}

		return $rev_sliders;
	}

	/**
	 * @return array|int|WP_Error
	 */
	public static function get_all_menus() {
		$args = array(
			'hide_empty' => true,
		);

		$menus   = get_terms( 'nav_menu', $args );
		$results = array();

		foreach ( $menus as $key => $menu ) {
			$results[ $menu->slug ] = $menu->name;
		}
		$results[''] = esc_html__( 'Default Menu', 'atomlab' );

		return $results;
	}

	/**
	 * @param bool $default_option
	 *
	 * @return array
	 */
	public static function get_registered_sidebars( $default_option = false, $empty_option = true ) {
		global $wp_registered_sidebars;
		$sidebars = array();
		if ( $empty_option == true ) {
			$sidebars['none'] = esc_html__( 'No Sidebar', 'atomlab' );
		}
		if ( $default_option == true ) {
			$sidebars['default'] = esc_html__( 'Default', 'atomlab' );
		}
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}

		return $sidebars;
	}

	/**
	 * Get list sidebar positions
	 *
	 * @return array
	 */
	public static function get_list_sidebar_positions( $default = false ) {
		$positions = array(
			'left'  => esc_html__( 'Left', 'atomlab' ),
			'right' => esc_html__( 'Right', 'atomlab' ),
		);


		if ( $default == true ) {
			$positions['default'] = esc_html__( 'Default', 'atomlab' );
		}

		return $positions;
	}

	/**
	 * Get content of file
	 *
	 * @param string $path
	 *
	 * @return mixed
	 */
	static function get_file_contents( $path = '' ) {
		$content = '';
		if ( $path !== '' ) {
			global $wp_filesystem;

			Atomlab::require_file( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();

			if ( file_exists( $path ) ) {
				$content = $wp_filesystem->get_contents( $path );
			}
		}

		return $content;
	}

	/**
	 * @param $var
	 *
	 * Output anything in debug bar.
	 */
	public static function d( $var ) {
		if ( function_exists( 'kint_debug_ob' ) ) {
			ob_start( 'kint_debug_ob' );
			d( $var );
			ob_end_flush();
		}
	}

	public static function strposa( $haystack, $needle, $offset = 0 ) {
		if ( ! is_array( $needle ) ) {
			$needle = array( $needle );
		}
		foreach ( $needle as $query ) {
			if ( strpos( $haystack, $query, $offset ) !== false ) {
				return true;
			} // stop on first true result
		}

		return false;
	}

	/**
	 * Get size information for all currently-registered image sizes.
	 *
	 * @global $_wp_additional_image_sizes
	 * @uses   get_intermediate_image_sizes()
	 * @return array $sizes Data for all currently-registered image sizes.
	 */
	public static function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array( 'full' => 'full' );

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$_size_w                               = get_option( "{$_size}_size_w" );
				$_size_h                               = get_option( "{$_size}_size_h" );
				$sizes["$_size {$_size_w}x{$_size_h}"] = $_size;
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes["$_size {$_wp_additional_image_sizes[ $_size ]['width']}x{$_wp_additional_image_sizes[ $_size ]['height']}"] = $_size;
			}
		}

		return $sizes;
	}

	public static function get_attachment_info( $attachment_id ) {
		$attachment     = get_post( $attachment_id );
		$attachment_url = wp_get_attachment_url( $attachment_id );

		$result = array(
			'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink( $attachment->ID ),
			'src'         => $attachment_url,
			'title'       => $attachment->post_title,
		);
		
		return $result;
	}

	public static function w3c_iframe( $iframe ) {
		$iframe = str_replace( 'frameborder="0"', '', $iframe );
		$iframe = str_replace( 'frameborder="no"', '', $iframe );
		$iframe = str_replace( 'scrolling="no"', '', $iframe );
		$iframe = str_replace( 'gesture="media"', '', $iframe );
		$iframe = str_replace( 'allow="encrypted-media"', '', $iframe );
		$iframe = str_replace( 'allowfullscreen', '', $iframe );

		return $iframe;
	}

	public static function get_md_media_query() {
		return '@media (max-width: 991px)';
	}

	public static function get_sm_media_query() {
		return '@media (max-width: 767px)';
	}

	public static function get_xs_media_query() {
		return '@media (max-width: 554px)';
	}

	public static function aq_resize( $args = array() ) {
		$defaults = array(
			'url'     => '',
			'width'   => null,
			'height'  => null,
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
			'echo'    => false,
		);

		$args  = wp_parse_args( $args, $defaults );
		$image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );

		if ( $image === false ) {
			$image = $args['url'];
		}

		return $image;
	}

	public static function get_lazy_load_image( $args = array() ) {
		$defaults = array(
			'url'         => '',
			'width'       => null,
			'height'      => null,
			'crop'        => true,
			'single'      => true,
			'upscale'     => false,
			'echo'        => false,
			'placeholder' => '',
			'src'         => '',
			'alt'         => '',
			'full_size'   => false,
		);

		$args = wp_parse_args( $args, $defaults );

		if ( ! isset( $args['lazy'] ) ) {
			$lazy_load_enable = Atomlab::setting( 'lazy_image_enable' );

			if ( $lazy_load_enable ) {
				$args['lazy'] = true;
			} else {
				$args['lazy'] = false;
			}
		}

		$image      = false;
		$attributes = array();

		if ( $args['full_size'] === false ) {
			$image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
		}

		if ( $image === false ) {
			$image = $args['url'];
		}

		$output   = '';
		$_classes = '';

		if ( $args['lazy'] === true ) {
			if ( $args['full_size'] === false ) {
				$placeholder_w = round( $args['width'] / 10 );
				$placeholder_h = $args['height'];

				if ( $args['height'] !== 9999 ) {
					$placeholder_h = round( $args['height'] / 10 );
				}
			} else {
				$placeholder_w = 50;
				$placeholder_h = 9999;
				$args['crop']  = false;
			}

			$placeholder_image = aq_resize( $image, $placeholder_w, $placeholder_h, $args['crop'], $args['single'], $args['upscale'] );

			$attributes[] = 'src="' . $placeholder_image . '"';
			$attributes[] = 'data-src="' . $image . '"';

			if ( $args['width'] !== '' && $args['width'] !== null ) {
				$attributes[] = 'width="' . $args['width'] . '"';
			}

			if ( $args['height'] !== '' && $args['height'] !== null && $args['height'] !== 9999 ) {
				$attributes[] = 'height="' . $args['height'] . '"';
			}

			$_classes .= ' tm-lazy-load';
		} else {
			$attributes[] = 'src="' . $image . '"';
		}

		$attributes[] = 'alt="' . $args['alt'] . '"';

		if ( $_classes !== '' ) {
			$attributes[] = 'class="' . $_classes . '"';
		}

		$output .= '<img ' . implode( ' ', $attributes ) . ' />';

		if ( $args['echo'] === true ) {
			echo $output;
		} else {
			return $output;
		}
	}

	public static function get_animation_list( $args = array() ) {
		return array(
			'none'             => esc_html__( 'None', 'atomlab' ),
			'fade-in'          => esc_html__( 'Fade In', 'atomlab' ),
			'move-up'          => esc_html__( 'Move Up', 'atomlab' ),
			'move-down'        => esc_html__( 'Move Down', 'atomlab' ),
			'move-left'        => esc_html__( 'Move Left', 'atomlab' ),
			'move-right'       => esc_html__( 'Move Right', 'atomlab' ),
			'scale-up'         => esc_html__( 'Scale Up', 'atomlab' ),
			'fall-perspective' => esc_html__( 'Fall Perspective', 'atomlab' ),
			'fly'              => esc_html__( 'Fly', 'atomlab' ),
			'flip'             => esc_html__( 'Flip', 'atomlab' ),
			'helix'            => esc_html__( 'Helix', 'atomlab' ),
			'pop-up'           => esc_html__( 'Pop Up', 'atomlab' ),
		);
	}

	public static function get_animation_classes( $animation ) {
		$classes = '';
		if ( isset( $animation ) && $animation !== '' && $animation !== 'none' ) {
			if ( Atomlab::is_handheld() ) {
				$mobile_animation_enable = Atomlab::setting( 'shortcode_animation_mobile_enable' );
				if ( $mobile_animation_enable === '1' ) {
					$classes .= " tm-animation $animation";
				}
			} else {
				$classes .= " tm-animation $animation";
			}
		}

		return $classes;
	}

	public static function get_grid_animation_classes( $animation ) {
		$classes = '';
		if ( isset( $animation ) && $animation !== '' && $animation !== 'none' ) {
			if ( Atomlab::is_handheld() ) {
				$mobile_animation_enable = Atomlab::setting( 'shortcode_animation_mobile_enable' );
				if ( $mobile_animation_enable === '1' ) {
					$classes .= " has-animation $animation";
				}
			} else {
				$classes .= " has-animation $animation";
			}
		}

		return $classes;
	}

	public static function get_css_prefix( $property, $value ) {
		$css = '';
		switch ( $property ) {
			case 'border-radius' :
				$css = "-moz-border-radius: {$value};-webkit-border-radius: {$value};border-radius: {$value};";
				break;

			case 'box-shadow' :
				$css = "-moz-box-shadow: {$value};-webkit-box-shadow: {$value};box-shadow: {$value};";
				break;

			case 'order' :
				$css = "-webkit-order: $value; -moz-order: $value; order: $value;";
				break;
		}

		return $css;
	}

	public static function get_list_hotspot() {
		$atomlab_post_args = array(
			'post_type'      => 'points_image',
			'posts_per_page' => - 1,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_status'    => 'publish',
		);

		$results = array();

		$atomlab_query = new WP_Query( $atomlab_post_args );

		if ( $atomlab_query->have_posts() ) :
			while ( $atomlab_query->have_posts() ) : $atomlab_query->the_post();
				$title             = get_the_title();
				$results[ $title ] = get_the_ID();
			endwhile;
		endif;
		wp_reset_postdata();

		return $results;
	}

	public static function get_vc_icon_template( $args = array() ) {

		$defaults = array(
			'type'         => '',
			'icon'         => '',
			'class'        => '',
			'parent_hover' => '',
		);

		$args         = wp_parse_args( $args, $defaults );

		vc_icon_element_fonts_enqueue( $args['type'] );

		switch ( $args['type'] ) {
			case 'linea_svg':
				$icon = str_replace( 'linea-', '', $args['icon'] );
				$_svg = ATOMLAB_THEME_URI . "/assets/svg/linea/{$icon}.svg";

				$_duration = Atomlab::setting( 'shortcode_box_icon_svg_animation_duration' );
				?>
				<div class="icon">
					<div class="tm-svg"
					     data-svg="<?php echo esc_url( $_svg ); ?>"

						<?php if ( isset( $args['svg_animate'] ) ): ?>
							data-type="<?php echo esc_attr( $args['svg_animate'] ); ?>"
						<?php endif; ?>

						<?php if ( $_duration !== '' ): ?>
							data-duration="<?php echo esc_attr( $_duration ); ?>"
						<?php endif; ?>

						<?php if ( $args['parent_hover'] !== '' ) : ?>
							data-hover="<?php echo esc_attr( $args['parent_hover'] ); ?>"
						<?php endif; ?>
					></div>
				</div>
				<?php
				break;
			default:
				?>
				<div class="icon">
					<span class="<?php echo esc_attr( $args['icon'] ); ?>"></span>
				</div>
				<?php
				break;
		}
	}

	public static function get_header_list( $default_option = false ) {

		$headers = array(
			'none' => esc_html__( 'Hide', 'atomlab' ),
			'01'   => esc_html__( 'Header 01', 'atomlab' ),
			'02'   => esc_html__( 'Header 02', 'atomlab' ),
			'03'   => esc_attr__( 'Header 03', 'atomlab' ),
			'04'   => esc_attr__( 'Header 04', 'atomlab' ),
			'05'   => esc_attr__( 'Header 05', 'atomlab' ),
			'06'   => esc_attr__( 'Header 06', 'atomlab' ),
			'07'   => esc_attr__( 'Header 07', 'atomlab' ),
			'08'   => esc_attr__( 'Header 08', 'atomlab' ),
			'09'   => esc_attr__( 'Header 09', 'atomlab' ),
			'10'   => esc_attr__( 'Header 10', 'atomlab' ),
			'11'   => esc_attr__( 'Header 11', 'atomlab' ),
			'12'   => esc_attr__( 'Header 12', 'atomlab' ),
			'13'   => esc_attr__( 'Header 13', 'atomlab' ),
			'14'   => esc_attr__( 'Header 14', 'atomlab' ),
			'15'   => esc_attr__( 'Header 15', 'atomlab' ),
			'16'   => esc_attr__( 'Header 16', 'atomlab' ),
			'17'   => esc_attr__( 'Header 17', 'atomlab' ),
			'18'   => esc_attr__( 'Header 18', 'atomlab' ),
			'19'   => esc_attr__( 'Header 19', 'atomlab' ),
			'20'   => esc_attr__( 'Header 20', 'atomlab' ),
		);

		if ( $default_option === true ) {
			$headers = array( '' => esc_html__( 'Default', 'atomlab' ) ) + $headers;
		}

		return $headers;
	}

	public static function get_header_button_style_list( $default_option = false ) {
		return array(
			'outline'            => esc_html__( 'Outline', 'atomlab' ),
			'flat'               => esc_html__( 'Flat', 'atomlab' ),
			'flat-white-alt'     => esc_html__( 'Flat White Alt', 'atomlab' ),
			'flat-black-alpha'   => esc_html__( 'Black Flat Alpha', 'atomlab' ),
			'flat-black-alpha-2' => esc_html__( 'Black Flat Alpha 2', 'atomlab' ),
			'flat-black-alpha-3' => esc_html__( 'Black Flat Alpha 3', 'atomlab' ),
		);
	}

	public static function get_coming_soon_demo_date() {
		$date = date( 'm/d/Y', strtotime( '+2 months', strtotime( date( 'Y/m/d' ) ) ) );

		return $date;
	}

	public static function the_date( $date_string ) {
		$date_format = get_option( 'date_format' );

		echo date( $date_format, strtotime( $date_string ) );
	}
}
