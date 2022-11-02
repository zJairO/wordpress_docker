<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Atomlab {

	const PRIMARY_FONT = 'Roboto';
	const PRIMARY_COLOR = '#38cb89';
	const SECONDARY_COLOR = '#0b88ee';
	const THIRD_COLOR = '#ababab';
	const HEADING_COLOR = '#454545';

	/**
	 * is_tablet
	 *
	 * @return bool
	 */
	public static function is_tablet() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		return Mobile_Detect::instance()->isTablet();
	}

	/**
	 * is_mobile
	 *
	 * @return bool
	 */
	public static function is_mobile() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		if ( self::is_tablet() ) {
			return false;
		}

		return Mobile_Detect::instance()->isMobile();
	}

	/**
	 * is_handheld
	 *
	 * @return bool
	 */
	public static function is_handheld() {
		return ( self::is_mobile() || self::is_tablet() );
	}

	/**
	 * is_desktop
	 *
	 * @since 0.9.8
	 * @return bool
	 */
	public static function is_desktop() {
		return ! self::is_handheld();
	}

	/**
	 * Get setting from Kirki
	 *
	 * @param string $setting
	 *
	 * @return mixed
	 */
	public static function setting( $setting = '' ) {
		$settings = Atomlab_Kirki::get_option( 'theme', $setting );

		return $settings;
	}

	/**
	 * Requirement one file.
	 *
	 * @param string $file Enter your file path here (included .php)
	 */
	public static function require_file( $file = '' ) {
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			wp_die( esc_html__( 'Could not load theme file: ', 'atomlab' ) . $file );
		}
	}

	/**
	 * Primary Menu
	 */
	public static function menu_primary( $args = array() ) {
		$defaults = array(
			'theme_location' => 'primary',
			'container'      => 'ul',
			'menu_class'     => 'menu__container sm sm-simple',
		);
		$args     = wp_parse_args( $args, $defaults );

		if ( has_nav_menu( 'primary' ) && class_exists( 'Atomlab_Walker_Nav_Menu' ) ) {
			$args['walker'] = new Atomlab_Walker_Nav_Menu;
		}

		$menu = Atomlab_Helper::get_post_meta( 'menu_display', '' );

		if ( $menu !== '' ) {
			$args['menu'] = $menu;
		}

		wp_nav_menu( $args );
	}

	/**
	 * Off Canvas Menu
	 */
	public static function off_canvas_menu_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'off-canvas-menu-primary',
		) );
	}

	/**
	 * Mobile Menu
	 */
	public static function menu_mobile_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'mobile-menu-primary',
		) );
	}

	/**
	 * Logo
	 */
	public static function branding_logo() {
		$logo_url       = '';
		$logo_light_url = Atomlab::setting( 'logo_light' );
		$logo_dark_url  = Atomlab::setting( 'logo_dark' );

		if ( Atomlab_Helper::get_post_meta( 'custom_logo' ) ) {
			$logo_url = Atomlab_Helper::get_post_meta( 'custom_logo' );
		}

		$sticky_logo_url = Atomlab_Helper::get_post_meta( 'custom_sticky_logo', '' );
		if ( $sticky_logo_url === '' ) {
			$sticky_logo_url = Atomlab::setting( 'sticky_logo' );
		}
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( $logo_url !== '' ) { ?>
				<img src="<?php echo esc_url( $logo_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="main-logo">
			<?php } else { ?>
				<img src="<?php echo esc_url( $logo_light_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="light-logo">
				<img src="<?php echo esc_url( $logo_dark_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="dark-logo">
			<?php } ?>
			<img src="<?php echo esc_url( $sticky_logo_url ); ?>"
			     alt="<?php bloginfo( 'name' ); ?>"
			     class="sticky-logo">
		</a>
		<?php
	}

	/**
	 * Adds custom attributes to the body tag.
	 */
	public static function body_attributes() {
		$attrs = apply_filters( 'insight_body_attributes', array() );

		$attrs_string = '';
		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $attr => $value ) {
				$attrs_string .= " {$attr}=" . '"' . esc_attr( $value ) . '"';
			}
		}

		echo '' . $attrs_string;
	}

	/**
	 * Adds custom classes to the branding.
	 */
	public static function branding_class( $class = '' ) {
		$classes = array( 'branding' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_branding_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the navigation.
	 */
	public static function navigation_class( $class = '' ) {
		$classes = array( 'navigation page-navigation' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_navigation_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the header.
	 */
	public static function header_class( $class = '' ) {
		$classes = array( 'page-header' );

		$header_type = Atomlab_Global::instance()->get_header_type();

		$classes[] = "header-{$header_type}";

		$_overlay_enable = Atomlab::setting( "header_style_{$header_type}_overlay" );

		if ( $_overlay_enable === '1' ) {
			$classes[] = 'header-layout-fixed';
		}

		$_logo     = Atomlab::setting( "header_style_{$header_type}_logo" );
		$classes[] = "{$_logo}-logo-version";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'atomlab_header_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the footer.
	 */
	public static function footer_class( $class = '' ) {
		$classes = array( 'page-footer' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_footer_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}
}
