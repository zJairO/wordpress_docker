<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles.
 */
if ( ! class_exists( 'Atomlab_Enqueue' ) ) {
	class Atomlab_Enqueue {

		protected static $instance = null;

		public function __construct() {
			// Remove WordPress version from any enqueued scripts.
			add_filter( 'style_loader_src', array( $this, 'at_remove_wp_ver_css_js' ), 9999 );
			add_filter( 'script_loader_src', array( $this, 'at_remove_wp_ver_css_js' ), 9999 );

			add_filter( 'stylesheet_uri', array( $this, 'use_minify_stylesheet' ), 10, 2 );

			add_action( 'wp_enqueue_scripts', array(
				$this,
				'enqueue',
			) );

			// Disable all contact form 7 scripts.
			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );

			// Re queue contact form 7 scripts when used.
			add_action( 'wp_enqueue_scripts', array( $this, 'requeue_wpcf7_scripts' ), 99 );

			add_action( 'init', array( $this, 'remove_hint_from_swatches' ), 99 );

			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woocommerce_styles_scripts' ), 99 );
		}

		function requeue_wpcf7_scripts() {
			global $post;
			if ( is_a( $post, 'WP_Post' ) &&
			     ( has_shortcode( $post->post_content, 'contact-form-7' ) ||
			       has_shortcode( $post->post_content, 'tm_contact_form_7' )
			     )
			) {
				if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
					wpcf7_enqueue_scripts();
				}

				if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
					wpcf7_enqueue_styles();
				}
			}
		}

		/**
		 * @param $src
		 *
		 * @return mixed|string
		 */
		public function at_remove_wp_ver_css_js( $src ) {
			$override = apply_filters( 'pre_at_remove_wp_ver_css_js', false, $src );
			if ( $override !== false ) {
				return $override;
			}

			if ( strpos( $src, 'ver=' ) ) {
				$src = remove_query_arg( 'ver', $src );
			}

			return $src;
		}

		function use_minify_stylesheet( $stylesheet, $stylesheet_dir ) {
			if ( file_exists( get_template_directory_uri() . '/style.min.css' ) ) {
				$stylesheet = get_template_directory_uri() . '/style.min.css';
			}

			return $stylesheet;
		}

		function dequeue_woocommerce_styles_scripts() {
			if ( function_exists( 'is_woocommerce' ) ) {
				if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
					# Styles
					/*wp_dequeue_style( 'woocommerce-general' );
					wp_dequeue_style( 'woocommerce-layout' );
					wp_dequeue_style( 'woocommerce-smallscreen' );
					wp_dequeue_style( 'woocommerce_frontend_styles' );
					wp_dequeue_style( 'woocommerce_fancybox_styles' );
					wp_dequeue_style( 'woocommerce_chosen_styles' );
					wp_dequeue_style( 'woocommerce_prettyPhoto_css' );*/
					# Scripts
					/*wp_dequeue_script( 'wc_price_slider' );
					wp_dequeue_script( 'wc-single-product' );
					wp_dequeue_script( 'wc-add-to-cart' );
					wp_dequeue_script( 'wc-cart-fragments' );
					wp_dequeue_script( 'wc-checkout' );
					wp_dequeue_script( 'wc-add-to-cart-variation' );
					wp_dequeue_script( 'wc-single-product' );
					wp_dequeue_script( 'wc-cart' );
					wp_dequeue_script( 'wc-chosen' );
					wp_dequeue_script( 'woocommerce' );
					wp_dequeue_script( 'prettyPhoto' );
					wp_dequeue_script( 'prettyPhoto-init' );
					wp_dequeue_script( 'jquery-blockui' );
					wp_dequeue_script( 'jquery-placeholder' );
					wp_dequeue_script( 'fancybox' );
					wp_dequeue_script( 'jqueryui' );*/


					// Dequeue scripts & styles YITH Compare
					wp_dequeue_style( 'jquery-colorbox' );
					wp_dequeue_script( 'yith-woocompare-main' );
					wp_dequeue_script( 'jquery-colorbox' );

					// Dequeue scripts & styles YITH Wishlist
					wp_dequeue_script( 'jquery-yith-wcwl' );
					wp_dequeue_script( 'jquery-yith-wcwl-user' );
				}
			}
		}

		function enqueue_woocommerce_styles_scripts() {
			wp_enqueue_script( 'jquery-yith-wcwl' );
			wp_enqueue_script( 'jquery-yith-wcwl-user' );

			wp_enqueue_style( 'jquery-colorbox' );
			wp_enqueue_script( 'yith-woocompare-main' );
			wp_enqueue_script( 'jquery-colorbox' );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function remove_hint_from_swatches() {
			add_action( 'wp_enqueue_scripts', array(
				$this,
				'remove_hint',
			) );

		}

		public function remove_hint() {
			wp_dequeue_style( 'hint' );
		}

		/**
		 * Enqueue scripts & styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$post_type = get_post_type();
			$min       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ? '' : '.min';

			// Remove prettyPhoto, default light box of woocommerce.
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			// Prevent enqueue ihotspot on all pages then only enqueue when use.
			wp_dequeue_script( 'ihotspot-js' );
			wp_dequeue_style( 'ihotspot' );

			// Remove font awesome from Yith Wishlist plugin.
			wp_dequeue_style( 'yith-wcwl-font-awesome' );

			wp_register_style( 'font-ion', ATOMLAB_THEME_URI . '/assets/fonts/ion/font-ion.min.css', null, null );

			wp_register_style( 'justifiedGallery', ATOMLAB_THEME_URI . '/assets/libs/justifiedGallery/justifiedGallery.min.css', null, '3.6.3' );
			wp_register_script( 'justifiedGallery', ATOMLAB_THEME_URI . '/assets/libs/justifiedGallery/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.6.3', true );

			wp_register_style( 'lightgallery', ATOMLAB_THEME_URI . '/assets/libs/lightGallery/css/lightgallery.min.css', null, '1.6.4' );
			wp_register_script( 'lightgallery', ATOMLAB_THEME_URI . "/assets/libs/lightGallery/js/lightgallery-all{$min}.js", array(
				'jquery',
				'picturefill',
				'mousewheel',
			), null, true );

			wp_register_style( 'swiper', ATOMLAB_THEME_URI . '/assets/libs/swiper/css/swiper.min.css', null, '4.0.3' );
			wp_register_script( 'swiper', ATOMLAB_THEME_URI . "/assets/libs/swiper/js/swiper{$min}.js", array( 'jquery' ), '4.0.3', true );

			wp_register_style( 'magnific-popup', ATOMLAB_THEME_URI . '/assets/libs/magnific-popup/magnific-popup.css' );
			wp_register_script( 'magnific-popup', ATOMLAB_THEME_URI . '/assets/libs/magnific-popup/jquery.magnific-popup.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );

			wp_register_style( 'growl', ATOMLAB_THEME_URI . '/assets/libs/growl/css/jquery.growl.min.css', null, '1.3.3' );
			wp_register_script( 'growl', ATOMLAB_THEME_URI . "/assets/libs/growl/js/jquery.growl{$min}.js", array( 'jquery' ), '1.3.3', true );

			/*
			 * Begin Register scripts to be enqueued later using the wp_enqueue_script() function.
			 */

			// Fix VC waypoints.
			if ( ! wp_script_is( 'vc_waypoints', 'registered' ) ) {
				wp_register_script( 'vc_waypoints', ATOMLAB_THEME_URI . '/assets/libs/vc-waypoints/vc-waypoints.min.js', array( 'jquery' ), null, true );
			}

			wp_register_script( 'slimscroll', ATOMLAB_THEME_URI . '/assets/libs/slimscroll/jquery.slimscroll.min.js', array( 'jquery' ), '1.3.8', true );
			wp_register_script( 'easing', ATOMLAB_THEME_URI . '/assets/libs/easing/jquery.easing.min.js', array( 'jquery' ), '1.3', true );
			wp_register_script( 'matchheight', ATOMLAB_THEME_URI . '/assets/libs/matchHeight/jquery.matchHeight-min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			wp_register_script( 'gmap3', ATOMLAB_THEME_URI . '/assets/libs/gmap3/gmap3.min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			wp_register_script( 'countdown', ATOMLAB_THEME_URI . '/assets/libs/jquery.countdown/js/jquery.countdown.min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			wp_register_script( 'easy-pie-chart', ATOMLAB_THEME_URI . '/assets/libs/ease-pie-chart/jquery.easypiechart.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'typed', ATOMLAB_THEME_URI . '/assets/js/typed.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'pie-chart', ATOMLAB_THEME_URI . '/assets/js/pie_chart.js', array(
				'jquery',
				'vc_waypoints',
			), null, true );

			wp_register_script( 'sticky-kit', ATOMLAB_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array(
				'jquery',
				'atomlab-script',
			), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'smooth-scroll', ATOMLAB_THEME_URI . '/assets/libs/smooth-scroll-for-web/SmoothScroll.min.js', array(
				'jquery',
			), '1.4.6', true );

			wp_register_script( 'picturefill', ATOMLAB_THEME_URI . '/assets/libs/picturefill/picturefill.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'mousewheel', ATOMLAB_THEME_URI . "/assets/libs/mousewheel/jquery.mousewheel{$min}.js", array( 'jquery' ), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'lazyload', ATOMLAB_THEME_URI . "/assets/libs/lazyload/lazyload{$min}.js", array(), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'tween-max', ATOMLAB_THEME_URI . '/assets/libs/tween-max/TweenMax.min.js', array(
				'jquery',
			), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'firefly', ATOMLAB_THEME_URI . '/assets/js/firefly.js', array(
				'jquery',
			), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'wavify', ATOMLAB_THEME_URI . '/assets/js/wavify.js', array(
				'jquery',
				'tween-max',
			), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'odometer', ATOMLAB_THEME_URI . '/assets/libs/odometer/odometer.min.js', array(
				'jquery',
			), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'counter-up', ATOMLAB_THEME_URI . '/assets/libs/counterup/jquery.counterup.min.js', array(
				'jquery',
			), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'counter', ATOMLAB_THEME_URI . '/assets/js/counter.js', array(
				'jquery',
			), ATOMLAB_THEME_VERSION, true );

			wp_register_script( 'circle-progress', ATOMLAB_THEME_URI . '/assets/libs/circle-progress/circle-progress.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'pricing', ATOMLAB_THEME_URI . '/assets/js/pricing.js', array(
				'jquery',
				'matchheight',
			), null, true );

			wp_register_script( 'accordion-simple', ATOMLAB_THEME_URI . '/assets/js/accordion.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );

			/*
			 * Enqueue the theme's style.css.
			 * This is recommended because we can add inline styles there
			 * and some plugins use it to do exactly that.
			 */
			wp_enqueue_style( 'atomlab-style', get_stylesheet_uri() );
			wp_enqueue_style( 'font-ion' );
			wp_enqueue_style( 'swiper' );

			/*
			 * End register scripts
			 */

			if ( Atomlab::setting( 'header_sticky_enable' ) ) {
				wp_enqueue_script( 'headroom', ATOMLAB_THEME_URI . "/assets/js/headroom{$min}.js", array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			}

			if ( Atomlab::setting( 'smooth_scroll_enable' ) ) {
				wp_enqueue_script( 'smooth-scroll' );
			}

			wp_enqueue_script( 'matchheight' );
			wp_enqueue_script( 'jquery-smooth-scroll', ATOMLAB_THEME_URI . '/assets/libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			wp_enqueue_script( 'swiper' );
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'isotope-masonry', ATOMLAB_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			wp_enqueue_script( 'isotope-packery', ATOMLAB_THEME_URI . '/assets/js/packery-mode.pkgd.min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			wp_enqueue_script( 'vc_waypoints' );
			wp_enqueue_script( 'smartmenus', ATOMLAB_THEME_URI . '/assets/libs/smartmenus/jquery.smartmenus.min.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			wp_enqueue_script( 'slimscroll' );

			if ( Atomlab::setting( 'notice_cookie_enable' ) && ! isset( $_COOKIE['notice_cookie_confirm'] ) ) {
				wp_enqueue_script( 'growl' );
				wp_enqueue_style( 'growl' );
			}

			if ( Atomlab::setting( 'lazy_load_images' ) ) {
				wp_enqueue_script( 'lazyload' );
			}

			//  Enqueue styles & scripts for single portfolio pages.
			if ( is_singular() ) {

				switch ( $post_type ) {
					case 'portfolio':
						$single_portfolio_sticky = Atomlab::setting( 'single_portfolio_sticky_detail_enable' );
						if ( $single_portfolio_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );
						break;

					case 'product':
						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );
						break;
				}
			}

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				if ( $post_type === 'post' ) {
					if ( Atomlab::setting( 'single_post_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} elseif ( $post_type === 'portfolio' ) {
					if ( Atomlab::setting( 'single_portfolio_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} else {
					wp_enqueue_script( 'comment-reply' );
				}
			}

			$maintenance_templates = Atomlab_Maintenance::get_maintenance_templates_dir();

			if ( is_page_template( $maintenance_templates ) ) {
				wp_enqueue_script( 'countdown' );
				wp_enqueue_script( 'maintenance', ATOMLAB_THEME_URI . '/assets/js/maintenance.js', array( 'jquery' ), ATOMLAB_THEME_VERSION, true );
			}

			wp_enqueue_script( 'wpb_composer_front_js' );


			if ( class_exists( 'WooCommerce' ) ) {
				if ( Atomlab::setting( 'shop_archive_quick_view' ) === '1' && ( is_shop() || is_cart() || is_product() || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) ) {
					wp_enqueue_style( 'magnific-popup' );
					wp_enqueue_script( 'magnific-popup' );
				}

				wp_enqueue_script( 'atomlab-woo', ATOMLAB_THEME_URI . "/assets/js/woo{$min}.js", array(), ATOMLAB_THEME_VERSION, true );
			}

			/*
			 * Enqueue main JS
			 */
			wp_enqueue_script( 'atomlab-script', ATOMLAB_THEME_URI . "/assets/js/main{$min}.js", array(
				'jquery',
			), ATOMLAB_THEME_VERSION, true );


			if ( is_page_template( 'templates/one-page-scroll.php' ) ) {
				wp_enqueue_script( 'full-page', ATOMLAB_THEME_URI . '/assets/js/jquery.fullPage.js', array( 'jquery' ), null, true );
			}

			/*
			 * Enqueue custom variable JS
			 */

			$js_variables = array(
				'templateUrl'               => ATOMLAB_THEME_URI,
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'primary_color'             => Atomlab::setting( 'primary_color' ),
				'header_sticky_enable'      => Atomlab::setting( 'header_sticky_enable' ),
				'header_sticky_height'      => Atomlab::setting( 'header_sticky_height' ),
				'scroll_top_enable'         => Atomlab::setting( 'scroll_top_enable' ),
				'lazyLoadImages'            => Atomlab::setting( 'lazy_load_images' ),
				'light_gallery_auto_play'   => Atomlab::setting( 'light_gallery_auto_play' ),
				'light_gallery_download'    => Atomlab::setting( 'light_gallery_download' ),
				'light_gallery_full_screen' => Atomlab::setting( 'light_gallery_full_screen' ),
				'light_gallery_zoom'        => Atomlab::setting( 'light_gallery_zoom' ),
				'light_gallery_thumbnail'   => Atomlab::setting( 'light_gallery_thumbnail' ),
				'light_gallery_share'       => Atomlab::setting( 'light_gallery_share' ),
				'mobile_menu_breakpoint'    => Atomlab::setting( 'mobile_menu_breakpoint' ),
				'isSingleProduct'           => is_singular( 'product' ),
				'noticeCookieEnable'        => Atomlab::setting( 'notice_cookie_enable' ),
				'noticeCookieConfirm'       => isset( $_COOKIE['notice_cookie_confirm'] ) ? 'yes' : 'no',
				'noticeCookieMessages'      => Atomlab::setting( 'notice_cookie_messages' ) . wp_kses( __( '<a id="tm-button-cookie-notice-ok" class="tm-button tm-button-xs tm-button-full-wide tm-button-secondary style-outline">OK, GOT IT</a>', 'atomlab' ), 'atomlab-default' ),
				'noticeCookieOKMessages'    => Atomlab::setting( 'notice_cookie_ok' ),
				'like'                      => esc_html__( 'Like', 'atomlab' ),
				'unlike'                    => esc_html__( 'Unlike', 'atomlab' ),
			);
			wp_localize_script( 'atomlab-script', '$insight', $js_variables );

			if ( Atomlab::setting( 'custom_css_enable' ) ) {
				wp_add_inline_style( 'atomlab-style', html_entity_decode( Atomlab::setting( 'custom_css' ), ENT_QUOTES ) );
			}

			if ( Atomlab::setting( 'custom_js_enable' ) == 1 ) {
				wp_add_inline_script( 'atomlab-script', html_entity_decode( Atomlab::setting( 'custom_js' ) ) );
			}
		}
	}

	new Atomlab_Enqueue();
}
