<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use Elementor\Plugin; 
use Rtrs\Models\Review; 
use Rtrs\Helpers\Functions; 

function techkit_get_maybe_rtl( $filename ){
	$file = get_template_directory_uri() . '/assets/';
	if ( is_rtl() ) {
		return $file . 'rtl-css/' . $filename;
	}
	else {
		return $file . 'css/' . $filename;
	}
}
add_action( 'wp_enqueue_scripts','techkit_enqueue_high_priority_scripts', 1500 );
function techkit_enqueue_high_priority_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'rtlcss', TECHKIT_CSS_URL . 'rtl.css', array(), TECHKIT_VERSION );
	}
}
//elementor animation dequeue
add_action('elementor/frontend/after_enqueue_scripts', function(){
    wp_deregister_style( 'e-animations' );
    wp_dequeue_style( 'e-animations' );
});

add_action( 'wp_enqueue_scripts', 'techkit_register_scripts', 12 );
if ( !function_exists( 'techkit_register_scripts' ) ) {
	function techkit_register_scripts(){
		wp_deregister_style( 'font-awesome' );
        wp_deregister_style( 'layerslider-font-awesome' );
        wp_deregister_style( 'yith-wcwl-font-awesome' );

		/*CSS*/
		// owl.carousel CSS
		wp_register_style( 'owl-carousel',       TECHKIT_CSS_URL . 'owl.carousel.min.css', array(), TECHKIT_VERSION );
		wp_register_style( 'owl-theme-default',  TECHKIT_CSS_URL . 'owl.theme.default.min.css', array(), TECHKIT_VERSION );		
		wp_register_style( 'magnific-popup',     techkit_get_maybe_rtl('magnific-popup.css'), array(), TECHKIT_VERSION );		
		wp_register_style( 'animate',        	 techkit_get_maybe_rtl('animate.min.css'), array(), TECHKIT_VERSION );
		wp_register_style( 'multiscroll',        techkit_get_maybe_rtl('jquery.multiscroll.min.css'), array(), TECHKIT_VERSION );

		/*JS*/
		// owl.carousel.min js
		wp_register_script( 'owl-carousel',      TECHKIT_JS_URL . 'owl.carousel.min.js', array( 'jquery' ), TECHKIT_VERSION, true );

		// counter js
		wp_register_script( 'rt-waypoints',      TECHKIT_JS_URL . 'waypoints.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		wp_register_script( 'counterup',         TECHKIT_JS_URL . 'jquery.counterup.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		wp_register_script( 'knob',         	 TECHKIT_JS_URL . 'jquery.knob.js', array( 'jquery' ), TECHKIT_VERSION, true );
		wp_register_script( 'appear',         	 TECHKIT_JS_URL . 'jquery.appear.js', array( 'jquery' ), TECHKIT_VERSION, true );
		
		// magnific popup
		wp_register_script( 'magnific-popup',    TECHKIT_JS_URL . 'jquery.magnific-popup.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		// hoverdir
		wp_register_script( 'jquery-hoverdir',   TECHKIT_JS_URL . 'jquery.hoverdir.js', array( 'jquery' ), TECHKIT_VERSION, true );
		wp_register_script( 'rt-modernizr',      TECHKIT_JS_URL . 'modernizr-3.5.0.min.js', array( 'jquery' ), TECHKIT_VERSION, true );

		// theia sticky
		wp_register_script( 'theia-sticky',    	 TECHKIT_JS_URL . 'theia-sticky-sidebar.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		
		// multiscroll
		wp_register_script( 'multiscroll',       TECHKIT_JS_URL . 'jquery.multiscroll.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		wp_register_script( 'rt-easings',        TECHKIT_JS_URL . 'jquery.easings.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		
		// parallax scroll js
		wp_register_script( 'parallax-scroll',   TECHKIT_JS_URL . 'jquery.parallax-scroll.js', array( 'jquery' ), TECHKIT_VERSION, true );
		wp_register_script( 'rt-parallax',   	 TECHKIT_JS_URL . 'rt-parallax.js', array( 'jquery' ), TECHKIT_VERSION, true );
		
		// wow js
		wp_register_script( 'rt-wow',   		 TECHKIT_JS_URL . 'wow.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		
		// vanilla tilt js
		wp_register_script( 'vanilla-tilt',   	 TECHKIT_JS_URL . 'vanilla-tilt.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		wp_register_script( 'swiper-slider',   	 TECHKIT_JS_URL . 'swiper.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
	}
}

add_action( 'wp_enqueue_scripts', 'techkit_enqueue_scripts', 15 );
if ( !function_exists( 'techkit_enqueue_scripts' ) ) {
	function techkit_enqueue_scripts() {
		$dep = array( 'jquery' );
		/*CSS*/
		// Google fonts
		wp_enqueue_style( 'techkit-gfonts', 	TechkitTheme_Helper::fonts_url(), array(), TECHKIT_VERSION );
		// Bootstrap CSS  //@rtl
		wp_enqueue_style( 'bootstrap', 			techkit_get_maybe_rtl('bootstrap.min.css'), array(), TECHKIT_VERSION );
		
		// Flaticon CSS
		wp_enqueue_style( 'flaticon-techkit',    TECHKIT_ASSETS_URL . 'fonts/flaticon-techkit/flaticon.css', array(), TECHKIT_VERSION );
		
		elementor_scripts();
		//Video popup
		wp_enqueue_style( 'magnific-popup' );
		// font-awesome CSS
		wp_enqueue_style( 'font-awesome',       TECHKIT_CSS_URL . 'font-awesome.min.css', array(), TECHKIT_VERSION );
		// animate CSS
		wp_enqueue_style( 'animate',            techkit_get_maybe_rtl('animate.min.css'), array(), TECHKIT_VERSION );
		// main CSS // @rtl
		wp_enqueue_style( 'techkit-default',    	techkit_get_maybe_rtl('default.css'), array(), TECHKIT_VERSION );
		// vc modules css
		wp_enqueue_style( 'techkit-elementor',   techkit_get_maybe_rtl('elementor.css'), array(), TECHKIT_VERSION );
			
		// Style CSS
		wp_enqueue_style( 'techkit-style',     	techkit_get_maybe_rtl('style.css'), array(), TECHKIT_VERSION );
		
		// Template Style
		wp_add_inline_style( 'techkit-style',   	techkit_template_style() );

		/*JS*/
		// bootstrap js
		wp_enqueue_script( 'bootstrap',         TECHKIT_JS_URL . 'bootstrap.min.js', array( 'jquery' ), TECHKIT_VERSION, true );

		// isotope js
		wp_enqueue_script( 'isotope-pkgd',      TECHKIT_JS_URL . 'isotope.pkgd.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		// Countdown
		wp_enqueue_script( 'countdown',      	TECHKIT_JS_URL . 'jquery.countdown.min.js', array( 'jquery' ), TECHKIT_VERSION, true );
		
		wp_enqueue_script( 'theia-sticky' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'jquery-hoverdir' );
		wp_enqueue_script( 'rt-modernizr' );
		wp_enqueue_script( 'rt-wow' );
		wp_enqueue_script( 'rt-parallax' );

		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'techkit-main',    	TECHKIT_JS_URL . 'main.js', $dep , TECHKIT_VERSION, true );
		
		if( !empty( TechkitTheme::$options['logo'] ) ) {
			$logo_dark = wp_get_attachment_image( TechkitTheme::$options['logo'], 'full' );
			$logo = $logo_dark;
		}else {
			$logo = "<img width='92' height='39' loading='lazy' class='logo-small' src='" . TECHKIT_IMG_URL . 'logo.png' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>"; 
		}
		
		// localize script
		$techkit_localize_data = array(
			'stickyMenu' 	=> TechkitTheme::$options['sticky_menu'],
			'siteLogo'   	=> '<a href="' . esc_url( home_url( '/' ) ) . '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '">' . esc_html ( $logo ) . '</a>',
			'extraOffset' => TechkitTheme::$options['sticky_menu'] ? 70 : 0,
			'extraOffsetMobile' => TechkitTheme::$options['sticky_menu'] ? 52 : 0,
			'rtl' => is_rtl()?'yes':'no',
			
			// Ajax
			'ajaxURL' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce( 'techkit-nonce' )
		);
		wp_localize_script( 'techkit-main', 'techkitObj', $techkit_localize_data );
	}	
}

function elementor_scripts() {
	
	if ( !did_action( 'elementor/loaded' ) ) {
		return;
	}
	
	if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		// do stuff for preview
		wp_enqueue_style(  'owl-carousel' );
		wp_enqueue_style(  'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
		
		wp_enqueue_script( 'knob' );
		wp_enqueue_script( 'appear' );
		wp_enqueue_script( 'counterup' );
		wp_enqueue_script( 'rt-waypoints' );		
		wp_enqueue_script( 'rt-wow' );
		wp_enqueue_script( 'vanilla-tilt' );
		wp_enqueue_script( 'swiper-slider' );		

	} 
}

add_action( 'wp_enqueue_scripts', 'techkit_high_priority_scripts', 1500 );
if ( !function_exists( 'techkit_high_priority_scripts' ) ) {
	function techkit_high_priority_scripts() {
		// Dynamic style
		TechkitTheme_Helper::dynamic_internal_style();
	}
}

function techkit_template_style(){
	ob_start();
	?>
	
	.entry-banner {
		<?php if ( TechkitTheme::$bgtype == 'bgcolor' ): ?>
			background-color: <?php echo esc_html( TechkitTheme::$bgcolor );?>;
		<?php else: ?>
			background: url(<?php echo esc_url( TechkitTheme::$bgimg );?>) no-repeat scroll center bottom / cover;
		<?php endif; ?>
	}

	.content-area {
		padding-top: <?php echo esc_html( TechkitTheme::$padding_top );?>px; 
		padding-bottom: <?php echo esc_html( TechkitTheme::$padding_bottom );?>px;
	}
	<?php if( isset( TechkitTheme::$pagebgimg ) && !empty( TechkitTheme::$pagebgimg ) ) { ?>
	#page .content-area {
		background-image: url( <?php echo TechkitTheme::$pagebgimg; ?> );
		background-color: <?php echo TechkitTheme::$pagebgcolor; ?>;
	}
	<?php } ?>
	.error-page-area {		 
		background-color: <?php echo esc_html( TechkitTheme::$options['error_bodybg'] );?>;
	}
	
	<?php
	return ob_get_clean();
}

function load_custom_wp_admin_script_gutenberg() {
	wp_enqueue_style( 'techkit-gfonts', TechkitTheme_Helper::fonts_url(), array(), TECHKIT_VERSION );
	// font-awesome CSS
	wp_enqueue_style( 'font-awesome',       TECHKIT_CSS_URL . 'font-awesome.min.css', array(), TECHKIT_VERSION );
	// Flaticon CSS
	wp_enqueue_style( 'flaticon-techkit',    TECHKIT_ASSETS_URL . 'fonts/flaticon-techkit/flaticon.css', array(), TECHKIT_VERSION );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script_gutenberg', 1 );

function load_custom_wp_admin_script() {
	wp_enqueue_style( 'techkit-admin-style',  TECHKIT_CSS_URL . 'admin-style.css', false, TECHKIT_VERSION );
	wp_enqueue_script( 'techkit-admin-main',  TECHKIT_JS_URL . 'admin.main.js', false, TECHKIT_VERSION, true );
	
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script' );

function review_schema_exist(){
	if( class_exists( Review::class )){
		wp_enqueue_style( 'rtrs-app' );
		return true;
	}
	return false;
}

//Review Icon Total view width blog
if( !function_exists( 'radius_review_total_rating' ) ) {
	function radius_review_total_rating() {
		if( review_schema_exist() ){
			if ( $avg_rating = Review::getAvgRatings( get_the_ID() ) ) { ?> 
			<div class="rtrs-rating-item">
		        <div class="rating-icon">
		            <?php echo Functions::review_stars( $avg_rating ); ?>
		            <span><?php $total_rating = Review::getTotalRatings( get_the_ID() );
		            	echo '(' . $total_rating . ')';
		            ?></span>
		        </div>			        
			</div>
		<?php }
		}
	}
}
