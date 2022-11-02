<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Atomlab_Widgets' ) ) {
	class Atomlab_Widgets {

		public function __construct() {
			$this->require_widgets();
			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );
			add_action( 'widgets_init', array(
				$this,
				'register_widgets',
			) );
		}

		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {

			$defaults = array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			);

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'blog_sidebar',
				'name'        => esc_html__( 'Blog Sidebar', 'atomlab' ),
				'description' => esc_html__( 'Default Sidebar of blog.', 'atomlab' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'page_sidebar',
				'name'        => esc_html__( 'Page Sidebar', 'atomlab' ),
				'description' => esc_html__( 'Add widgets here.', 'atomlab' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar',
				'name'        => esc_html__( 'Shop Sidebar', 'atomlab' ),
				'description' => esc_html__( 'Default Sidebar of shop.', 'atomlab' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'left_header_widget',
				'name'        => esc_html__( 'Left Header Widget', 'atomlab' ),
				'description' => esc_html__( 'Add widgets to left header.', 'atomlab' ),
			) ) );
		}

		public function require_widgets() {
			require_once ATOMLAB_WIDGETS_DIR . DS . 'facebook-page.php';
			require_once ATOMLAB_WIDGETS_DIR . DS . 'flickr.php';
			require_once ATOMLAB_WIDGETS_DIR . DS . 'posts.php';
		}

		public function register_widgets() {
			register_widget( 'TM_Posts_Widget' );
			register_widget( 'TM_Facebook_Page_Widget' );
			register_widget( 'TM_Flickr_Widget' );
		}

	}

	new Atomlab_Widgets();
}
