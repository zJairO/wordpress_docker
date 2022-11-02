<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Atomlab_Global' ) ) {
	class Atomlab_Global {

		protected static $instance       = null;
		protected static $header_type    = '01';
		protected static $title_bar_type = '01';

		public $has_sidebar               = false;
		public $has_both_sidebar          = false;
		public $wishlist_tooltip_position = 'left';

		function __construct() {
			add_action( 'wp', array( $this, 'init_global_variable' ) );
		}

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init_global_variable() {
			global $atomlab_page_options;
			if ( is_singular( 'portfolio' ) ) {
				$atomlab_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_portfolio_options', true ) );
			} elseif ( is_singular( 'post' ) ) {
				$atomlab_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
			} elseif ( is_singular( 'page' ) ) {
				$atomlab_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_page_options', true ) );
			} elseif ( is_singular( 'product' ) ) {
				$atomlab_page_options = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_product_options', true ) );
			}
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				// Get page id of shop.
				$page_id              = wc_get_page_id( 'shop' );
				$atomlab_page_options = maybe_unserialize( get_post_meta( $page_id, 'insight_page_options', true ) );
			}

			$atomlab_page_options = apply_filters( 'atomlab_page_options_post_meta', $atomlab_page_options );

			$this->check_sidebar();
			$this->set_header_type();
			$this->set_title_bar_type();
		}

		function set_header_type() {
			$header_type = Atomlab_Helper::get_post_meta( 'header_type', '' );

			if ( $header_type === '' ) {
				if ( is_search() && ! is_post_type_archive( 'product' ) ) {
					$header_type = Atomlab::setting( 'global_header' );
				} elseif ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
					$header_type = Atomlab::setting( 'archive_product_header_type' );
				} elseif ( is_post_type_archive( 'portfolio' ) || Atomlab_Portfolio::is_taxonomy() ) {
					$header_type = Atomlab::setting( 'archive_portfolio_header_type' );
				} elseif ( is_category() || is_tax() ) {
					$header_type = Atomlab::setting( 'global_header' );
				} elseif ( is_home() ) {
					$header_type = Atomlab::setting( 'global_header' );
				} elseif ( is_singular( 'post' ) ) {
					$header_type = Atomlab::setting( 'single_post_header_type' );
				} elseif ( is_singular( 'portfolio' ) ) {
					$header_type = Atomlab::setting( 'single_portfolio_header_type' );
				} elseif ( is_singular( 'product' ) ) {
					$header_type = Atomlab::setting( 'single_product_header_type' );
				} elseif ( is_singular( 'page' ) ) {
					$header_type = Atomlab::setting( 'single_page_header_type' );
				} else {
					$header_type = Atomlab::setting( 'global_header' );
				}
			}

			if ( $header_type === '' ) {
				$header_type = Atomlab::setting( 'global_header' );
			}

			$header_type = apply_filters( 'atomlab_header_type', $header_type );

			self::$header_type = $header_type;
		}

		function get_header_type() {
			return self::$header_type;
		}

		function set_title_bar_type() {
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

			$title_bar_layout = apply_filters( 'atomlab_title_bar_type', $title_bar_layout );

			self::$title_bar_type = $title_bar_layout;
		}

		function get_title_bar_type() {
			return self::$title_bar_type;
		}

		function check_sidebar() {
			$page_sidebar1 = Atomlab_Helper::get_post_meta( 'page_sidebar_1', 'default' );
			$page_sidebar2 = Atomlab_Helper::get_post_meta( 'page_sidebar_2', 'default' );

			if ( is_singular( 'post' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['post_page_sidebar_1'] ) ? $_GET['post_page_sidebar_1'] : Atomlab::setting( 'post_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['post_page_sidebar_2'] ) ? $_GET['post_page_sidebar_2'] : Atomlab::setting( 'post_page_sidebar_2' );
				}
			} elseif ( is_singular( 'page' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['page_sidebar_1'] ) ? $_GET['page_sidebar_1'] : Atomlab::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['page_sidebar_2'] ) ? $_GET['page_sidebar_2'] : Atomlab::setting( 'page_sidebar_2' );
				}
			} elseif ( is_singular( 'portfolio' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['portfolio_page_sidebar_1'] ) ? $_GET['portfolio_page_sidebar_1'] : Atomlab::setting( 'portfolio_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['portfolio_page_sidebar_2'] ) ? $_GET['portfolio_page_sidebar_2'] : Atomlab::setting( 'portfolio_page_sidebar_2' );
				}
			} elseif ( is_singular( 'product' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['product_page_sidebar_1'] ) ? $_GET['product_page_sidebar_1'] : Atomlab::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['product_page_sidebar_2'] ) ? $_GET['product_page_sidebar_2'] : Atomlab::setting( 'product_page_sidebar_2' );
				}
			}

			if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
				$this->has_sidebar = true;
			}

			if ( $page_sidebar1 !== 'none' && $page_sidebar2 !== 'none' ) {
				$this->has_both_sidebar = true;
			}
		}
	}

	global $atomlab_vars;
	$atomlab_vars = new Atomlab_Global();
}
