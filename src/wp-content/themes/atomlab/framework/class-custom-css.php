<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue custom styles.
 */
if ( ! class_exists( 'Atomlab_Custom_Css' ) ) {
	class Atomlab_Custom_Css {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'extra_css' ) );
		}

		/**
		 * Responsive styles.
		 *
		 * @access public
		 */
		public function extra_css() {
			$primary_color = Atomlab::setting( 'primary_color' );
			$px            = 'px';

			// Responsive body font-size.
			$body_font_sensitive       = Atomlab::setting( 'body_font_sensitive' );
			$body_font_size_max        = Atomlab::setting( 'body_font_size' );
			$body_font_size_min        = $body_font_size_max * $body_font_sensitive;
			$body_font_size_responsive = "calc($body_font_size_min$px + ($body_font_size_max - $body_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H1 font-size.
			$heading_font_sensitive  = Atomlab::setting( 'heading_font_sensitive' );
			$h1_font_size_max        = Atomlab::setting( 'h1_font_size' );
			$h1_font_size_min        = $h1_font_size_max * $heading_font_sensitive;
			$h1_font_size_responsive = "calc($h1_font_size_min$px + ($h1_font_size_max - $h1_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H2 font-size.
			$h2_font_size_max        = Atomlab::setting( 'h2_font_size' );
			$h2_font_size_min        = $h2_font_size_max * $heading_font_sensitive;
			$h2_font_size_responsive = "calc($h2_font_size_min$px + ($h2_font_size_max - $h2_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H3 font-size.
			$h3_font_size_max        = Atomlab::setting( 'h3_font_size' );
			$h3_font_size_min        = $h3_font_size_max * $heading_font_sensitive;
			$h3_font_size_responsive = "calc($h3_font_size_min$px + ($h3_font_size_max - $h3_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H4 font-size.
			$h4_font_size_max        = Atomlab::setting( 'h4_font_size' );
			$h4_font_size_min        = $h4_font_size_max * $heading_font_sensitive;
			$h4_font_size_responsive = "calc($h4_font_size_min$px + ($h4_font_size_max - $h4_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H5 font-size.
			$h5_font_size_max        = Atomlab::setting( 'h5_font_size' );
			$h5_font_size_min        = $h5_font_size_max * $heading_font_sensitive;
			$h5_font_size_responsive = "calc($h5_font_size_min$px + ($h5_font_size_max - $h5_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H6 font-size.
			$h6_font_size_max        = Atomlab::setting( 'h6_font_size' );
			$h6_font_size_min        = $h6_font_size_max * $heading_font_sensitive;
			$h6_font_size_responsive = "calc($h6_font_size_min$px + ($h6_font_size_max - $h6_font_size_min) * ((100vw - 554px) / 646))";

			$body_typo     = Atomlab::setting( 'typography_body' );
			$_primary_font = $body_typo['font-family'];
			$_primary_font = trim( $_primary_font, ' ,' );

			$extra_style = "
				.primary-font, .tm-button, button, input, select, textarea{ font-family: $_primary_font }
				.primary-font-important { font-family: $_primary_font !important }
				body{font-size: $body_font_size_min$px}
				h1,.h1{font-size: $h1_font_size_min$px}
				h2,.h2{font-size: $h2_font_size_min$px}
				h3,.h3{font-size: $h3_font_size_min$px}
				h4,.h4{font-size: $h4_font_size_min$px}
				h5,.h5{font-size: $h5_font_size_min$px}
				h6,.h6{font-size: $h6_font_size_min$px}

				@media (min-width: 544px) and (max-width: 1199px) {
					body{font-size: $body_font_size_responsive}
					h1,.h1{font-size: $h1_font_size_responsive}
					h2,.h2{font-size: $h2_font_size_responsive}
					h3,.h3{font-size: $h3_font_size_responsive}
					h4,.h4{font-size: $h4_font_size_responsive}
					h5,.h5{font-size: $h5_font_size_responsive}
					h6,.h6{font-size: $h6_font_size_responsive}
				}
			";

			$custom_logo_width        = Atomlab_Helper::get_post_meta( 'custom_logo_width', '' );
			$custom_sticky_logo_width = Atomlab_Helper::get_post_meta( 'custom_sticky_logo_width', '' );

			if ( $custom_logo_width !== '' ) {
				$extra_style .= ".branding__logo img { 
                    width: {$custom_logo_width} !important; 
                }";
			}

			if ( $custom_sticky_logo_width !== '' ) {
				$extra_style .= ".headroom--not-top .branding__logo .sticky-logo { 
                    width: {$custom_sticky_logo_width} !important; 
                }";
			}

			$headerStickyHeight = Atomlab::setting( 'header_sticky_height' );
			$stickyPadding      = $headerStickyHeight + 30;
			if ( is_admin_bar_showing() ) {
				$stickyPadding += 32;
			}

			$extra_style .= ".tm-sticky-kit.is_stuck { 
				padding-top: {$stickyPadding}px; 
			}";

			$site_width = Atomlab_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Atomlab::setting( 'site_width' );
			}
			if ( $site_width !== '' ) {
				$extra_style .= ".boxed {
                max-width: $site_width;
            }
            @media (min-width: 1200px) { .container {
				max-width: $site_width;
			}}";
			}

			$tmp = '';

			$site_background_color = Atomlab_Helper::get_post_meta( 'site_background_color', '' );
			if ( $site_background_color !== '' ) {
				$tmp .= "background-color: $site_background_color !important;";
			}

			$site_background_image = Atomlab_Helper::get_post_meta( 'site_background_image', '' );
			if ( $site_background_image !== '' ) {
				$site_background_repeat = Atomlab_Helper::get_post_meta( 'site_background_repeat', '' );
				$tmp                    .= "background-image: url( $site_background_image ) !important; background-repeat: $site_background_repeat !important;";
			}

			$site_background_position = Atomlab_Helper::get_post_meta( 'site_background_position', '' );
			if ( $site_background_position !== '' ) {
				$tmp .= "background-position: $site_background_position !important;";
			}

			$site_background_attachment = Atomlab_Helper::get_post_meta( 'site_background_attachment', '' );
			if ( $site_background_attachment !== '' ) {
				$tmp .= "background-attachment: $site_background_attachment !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= "body { $tmp; }";
			}

			$tmp = '';

			$content_background_color = Atomlab_Helper::get_post_meta( 'content_background_color', '' );
			if ( $content_background_color !== '' ) {
				$tmp .= "background-color: $content_background_color !important;";
			}

			$content_background_image = Atomlab_Helper::get_post_meta( 'content_background_image', '' );
			if ( $content_background_image !== '' ) {
				$content_background_repeat = Atomlab_Helper::get_post_meta( 'content_background_repeat', '' );
				$tmp                       .= "background-image: url( $content_background_image ) !important; background-repeat: $content_background_repeat !important;";
			}

			$content_background_position = Atomlab_Helper::get_post_meta( 'content_background_position', '' );
			if ( $content_background_position !== '' ) {
				$tmp .= "background-position: $content_background_position !important;";
			}

			$content_padding = Atomlab_Helper::get_post_meta( 'content_padding' );
			if ( $content_padding === '0' ) {
				$tmp .= 'padding-top: 0;';
				$tmp .= 'padding-bottom: 0;';
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".page-content { $tmp; }";
			}

			$extra_style .= $this->primary_color_css();
			$extra_style .= $this->secondary_color_css();
			$extra_style .= $this->third_color_css();
			$extra_style .= $this->sidebar_css();
			$extra_style .= $this->title_bar_css();
			$extra_style .= $this->footer_css();
			$extra_style .= $this->mobile_menu_css();
			$extra_style .= $this->light_gallery_css();

			//$extra_style = Atomlab_Minify::css( $extra_style );

			wp_add_inline_style( 'atomlab-style', html_entity_decode( $extra_style, ENT_QUOTES ) );
		}

		function sidebar_css() {
			$css = '';

			if ( is_search() && ! is_post_type_archive( 'product' ) ) {
				$page_sidebar1 = Atomlab::setting( 'search_page_sidebar_1' );
				$page_sidebar2 = Atomlab::setting( 'search_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
				$page_sidebar1 = Atomlab::setting( 'product_archive_page_sidebar_1' );
				$page_sidebar2 = Atomlab::setting( 'product_archive_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'portfolio' ) || Atomlab_Portfolio::is_taxonomy() ) {
				$page_sidebar1 = Atomlab::setting( 'portfolio_archive_page_sidebar_1' );
				$page_sidebar2 = Atomlab::setting( 'portfolio_archive_page_sidebar_2' );
			} elseif ( is_archive() ) {
				$page_sidebar1 = Atomlab::setting( 'blog_archive_page_sidebar_1' );
				$page_sidebar2 = Atomlab::setting( 'blog_archive_page_sidebar_2' );
			} elseif ( is_home() ) {
				$page_sidebar1 = Atomlab::setting( 'home_page_sidebar_1' );
				$page_sidebar2 = Atomlab::setting( 'home_page_sidebar_2' );
			} elseif ( is_singular( 'post' ) ) {
				$page_sidebar1 = Atomlab_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Atomlab_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Atomlab::setting( 'post_page_sidebar_1' );
				}
				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Atomlab::setting( 'post_page_sidebar_2' );
				}
			} elseif ( is_singular( 'portfolio' ) ) {
				$page_sidebar1 = Atomlab_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Atomlab_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Atomlab::setting( 'portfolio_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Atomlab::setting( 'portfolio_page_sidebar_2' );
				}
			} elseif ( is_singular( 'product' ) ) {
				$page_sidebar1 = Atomlab_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Atomlab_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Atomlab::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Atomlab::setting( 'product_page_sidebar_2' );
				}
			} else {
				$page_sidebar1 = Atomlab_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Atomlab_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Atomlab::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Atomlab::setting( 'page_sidebar_2' );
				}
			}

			if ( 'none' !== $page_sidebar1 ) {
				$sidebars_breakpoint = Atomlab::setting( 'sidebars_breakpoint' );
				$sidebars_below      = Atomlab::setting( 'sidebars_below_content_mobile' );

				if ( 'none' !== $page_sidebar2 ) {
					$sidebar_width  = Atomlab::setting( 'dual_sidebar_width' );
					$sidebar_offset = Atomlab::setting( 'dual_sidebar_offset' );
					$content_width  = 100 - $sidebar_width * 2;
				} else {
					$sidebar_width  = Atomlab::setting( 'single_sidebar_width' );
					$sidebar_offset = Atomlab::setting( 'single_sidebar_offset' );
					$content_width  = 100 - $sidebar_width;
				}

				$css .= "
				@media (min-width: {$sidebars_breakpoint}px) {
					.page-content .page-sidebar {
						flex: 0 0 $sidebar_width%;
						max-width: $sidebar_width%;
					}
					.page-main-content {
						flex: 0 0 $content_width%;
						max-width: $content_width%;
					}
				}
				@media (min-width: 1200px) {
					.page-sidebar-left .page-sidebar-inner {
						padding-right: $sidebar_offset;
					}
					.page-sidebar-right .page-sidebar-inner {
						padding-left: $sidebar_offset;
					}
				}";

				$_max_width_breakpoint = $sidebars_breakpoint - 1;

				if ( $sidebars_below === '1' ) {
					$css .= "
					@media (max-width: {$_max_width_breakpoint}px) {
						.page-main-content {
							-webkit-order: -1;
							-moz-order: -1;
							order: -1;
							margin-bottom: 50px;
						}
					}";
				}
			}

			return $css;
		}

		function title_bar_css() {
			$css = $title_bar_tmp = $overlay_tmp = '';

			$bg_color   = Atomlab_Helper::get_post_meta( 'page_title_bar_background_color', '' );
			$bg_image   = Atomlab_Helper::get_post_meta( 'page_title_bar_background', '' );
			$bg_overlay = Atomlab_Helper::get_post_meta( 'page_title_bar_background_overlay', '' );

			if ( $bg_color !== '' ) {
				$title_bar_tmp .= "background-color: {$bg_color}!important;";
			}

			if ( $bg_image !== '' ) {
				$title_bar_tmp .= "background-image: url({$bg_image})!important;";
			}

			if ( $bg_overlay !== '' ) {
				$overlay_tmp .= "background-color: {$bg_overlay}!important;";
			}

			if ( $title_bar_tmp !== '' ) {
				$css .= ".page-title-bar-inner{ {$title_bar_tmp} }";
			}

			if ( $overlay_tmp !== '' ) {
				$css .= ".page-title-bar-overlay{ {$overlay_tmp} }";
			}

			$title_bar_01_bg_type = Atomlab::setting( 'title_bar_01_bg_type' );

			if ( $title_bar_01_bg_type === 'gradient' ) {
				$_color_1 = Atomlab::setting( 'title_bar_01_bg_color_1' );
				$_color_2 = Atomlab::setting( 'title_bar_01_bg_color_2' );


				$css .= ".page-title-bar-01 .page-title-bar-inner {
                	background: {$_color_2};
                    background: -moz-linear-gradient(-180deg, {$_color_1} 0%, {$_color_2} 100%);
                    background: -webkit-linear-gradient(-180deg, {$_color_1} 0%,{$_color_2} 100%);
                    background: -o-linear-gradient(-180deg, {$_color_1} 0%,{$_color_2} 100%);
                    background: -ms-linear-gradient(-180deg, {$_color_1} 0%,{$_color_2} 100%);
                    background: linear-gradient(-180deg, {$_color_1} 0%,{$_color_2} 100%);    
                }";
			}

			return $css;
		}

		function mobile_menu_css() {
			$css = '';

			$bg_type  = Atomlab::setting( 'mobile_menu_bg_type' );
			$_color_1 = Atomlab::setting( 'mobile_menu_bg_color_1' );
			$_color_2 = Atomlab::setting( 'mobile_menu_bg_color_2' );
			if ( $bg_type === 'gradient' ) {
				$css .= ".page-mobile-main-menu {
                	background: {$_color_2};
                    background: -moz-linear-gradient(-151deg, {$_color_1} 0%, {$_color_2} 100%);
                    background: -webkit-linear-gradient(-151deg, {$_color_1} 0%,{$_color_2} 100%);
                    background: -o-linear-gradient(-151deg, {$_color_1} 0%,{$_color_2} 100%);
                    background: -ms-linear-gradient(-151deg, {$_color_1} 0%,{$_color_2} 100%);
                    background: linear-gradient(-151deg, {$_color_1} 0%,{$_color_2} 100%);
                }";
			} else {
				$css .= ".page-mobile-main-menu {
                	background: {$_color_1};
                }";
			}

			return $css;
		}

		function footer_css() {
			$footer_page = Atomlab_Helper::get_post_meta( 'footer_page', 'default' );
			$css         = '';
			if ( $footer_page === 'default' ) {
				$footer_page = Atomlab::setting( 'footer_page' );
			}

			if ( $footer_page === '' ) {
				return '';
			}

			$_atomlab_args = array(
				'post_type' => 'ic_footer',
				'name'      => $footer_page,
			);

			$_atomlab_query = new WP_Query( $_atomlab_args );

			if ( $_atomlab_query->have_posts() ) {
				while ( $_atomlab_query->have_posts() ) : $_atomlab_query->the_post();
					$footer_options = Atomlab_Helper::get_the_footer_page_options();

					$css                = '';
					$widget_title_color = Atomlab_Helper::get_the_post_meta( $footer_options, 'widget_title_color', '' );
					$text_color         = Atomlab_Helper::get_the_post_meta( $footer_options, 'text_color', '' );
					$link_color         = Atomlab_Helper::get_the_post_meta( $footer_options, 'link_color', '' );
					$link_hover_color   = Atomlab_Helper::get_the_post_meta( $footer_options, 'link_hover_color', '' );

					if ( $widget_title_color !== '' ) {
						$css .= ".page-footer .widgettitle { color: {$widget_title_color}; }";
					}

					if ( $text_color !== '' ) {
						$css .= "
						.page-footer,
						.page-footer .widget_text { 
							color: {$text_color};
						}";
					}

					if ( $link_color !== '' ) {
						$css .= "
			                .page-footer a,
			                .page-footer .widget_recent_entries li a,
			                .page-footer .widget_recent_comments li a,
			                .page-footer .widget_archive li a,
			                .page-footer .widget_categories li a,
			                .page-footer .widget_meta li a,
			                .page-footer .widget_product_categories li a,
			                .page-footer .widget_rss li a,
			                .page-footer .widget_pages li a,
			                .page-footer .widget_nav_menu li a,
			                .page-footer .insight-core-bmw li a { 
			                    color: {$link_color};
			                }";
					}

					if ( $link_hover_color !== '' ) {
						$css .= "
			                .page-footer a:hover,
			                .page-footer .widget_recent_entries li a:hover,
			                .page-footer .widget_recent_comments li a:hover,
			                .page-footer .widget_archive li a:hover,
			                .page-footer .widget_categories li a:hover,
			                .page-footer .widget_meta li a:hover,
			                .page-footer .widget_product_categories li a:hover,
			                .page-footer .widget_rss li a:hover,
			                .page-footer .widget_pages li a:hover,
			                .page-footer .widget_nav_menu li a:hover,
			                .page-footer .insight-core-bmw li a:hover {
			                    color: {$link_hover_color}; 
			                }";
					}
				endwhile;
			}

			wp_reset_postdata();

			return $css;
		}

		function primary_color_css() {
			$color = Atomlab::setting( 'primary_color' );

			// Color.
			$css = "
				.primary-color,
				.topbar a,
				.tm-button.tm-button-primary.style-text,
				.tm-button.tm-button-primary.style-text:hover .button-icon,
				.tm-button,
				.highlight-text-02 mark,
				.highlight-text-04 mark,
				.tm-button.style-flat.tm-button-primary:hover,
				.tm-mailchimp-form.style-4 .form-submit:hover,
				.header-20 .heading mark,
				.wpcf7-text.wpcf7-text, .wpcf7-textarea,
				.tm-list--auto-numbered .tm-list__marker,
				.tm-list--manual-numbered .tm-list__marker,
				.tm-info-boxes.style-metro .grid-item.skin-secondary .box-title,
				.tm-twitter.style-slider-quote .tweet-text a:hover,
				.tm-twitter.style-slider-quote-02 .tweet-text a:hover,
				.tm-slider-icon-list .marker,
				.tm-portfolio [data-overlay-animation='faded'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='faded'] .post-overlay-categories,
				.tm-portfolio [data-overlay-animation='modern'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='modern'] .post-overlay-categories,
				.tm-portfolio.style-full-wide-slider .post-overlay-categories,
				.tm-portfolio.style-full-wide-slider .post-overlay-title a:hover,
				.page-template-one-page-scroll[data-row-skin='dark'] #fp-nav ul li .fp-tooltip,
				.single-portfolio .portfolio-link a,
				.single-portfolio .portfolio-link a:hover span,
				.related-portfolio-item .post-overlay-categories,
				.single-post .page-main-content .post-tags a:hover,
				.single-post .post-link a,
				.gmap-marker-content,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-title>a,
				.comment-list .comment-datetime:before
				{
					color: {$color} 
				}";

			// Color Important.
			$css .= "
				.primary-color-important,
				.primary-color-hover-important:hover,
				.tm-box-icon.style-6 .tm-button:hover .button-text,
				.tm-box-icon.style-6 .tm-button:hover .button-link
				{
					color: {$color}!important;
				}";

			// Background Color.
			$css .= "
				.primary-background-color,
				.tm-blog.style-grid_classic .post-link,
				.tm-blog.style-grid_masonry .post-link,
				.tm-button.style-flat.tm-button-primary,
				.tm-button.style-outline.tm-button-primary:hover,
				.tm-gradation .count, .tm-gradation .count-wrap:before, .tm-gradation .count-wrap:after,
				.tm-info-boxes.style-metro .grid-item.skin-primary,
				.tm-contact-form-7.skin-light .wpcf7-submit:hover,
				.widget_categories .count, .widget_product_categories .count,
				.top-bar-01 .top-bar-button:hover,
				.tm-search-form .search-submit:hover,
				.tm-mailchimp-form.style-4 .form-submit,
				.page-preloader .object,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-tab>a,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-tabs.vc_tta-color-primary.vc_tta-style-modern .vc_tta-tab > a,
				.vc_tta-color-primary.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-tab>a,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:focus,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:focus,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:hover
				{
					background-color: {$color};
				}";

			$css .= "
				.primary-background-color-important,
				.primary-background-color-hover-important:hover,
				.mejs-controls .mejs-time-rail .mejs-time-current
				{
					background-color: {$color}!important;
				}";

			$css .= ".primary-border-color,
				.tm-button.style-outline.tm-button-primary,
				.tm-contact-form-7.skin-light .wpcf7-submit,
				.tm-mailchimp-form.style-4 .form-submit,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-controls-icon::after,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-controls-icon::before,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::after,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::before,
				.vc_tta-tabs.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab > a
				{
					border-color: {$color};
				}";


			$css .= ".primary-border-color-important,
				.primary-border-color-hover-important:hover,
				.tm-button.style-flat.tm-button-primary
				{
					border-color: {$color}!important;
				}";

			if ( class_exists( 'WooCommerce' ) ) {
				$css .= "
				.woocommerce .cart.shop_table td.product-subtotal,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce input.button.alt, .button,
				.woocommerce.single-product div.product .product-meta a:hover
				{
					color: {$color}
				}";

				$css .= "
				.tm-product-search-form .search-submit:hover,
				.woocommerce .cats .product-category:hover .cat-text,
				.woocommerce .products div.product .product-overlay
				{ 
					background-color: {$color}; 
				}";

				$css .= "
				.woocommerce.single-product div.product .images .thumbnails .item img:hover,
				.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover {
					border-color: {$color};
				}";
			}

			return $css;
		}

		function secondary_color_css() {
			$color   = Atomlab::setting( 'secondary_color' );
			$alpha90 = Atomlab_Color::hex2rgba( $color, '0.9' );
			$alpha70 = Atomlab_Color::hex2rgba( $color, '0.7' );
			$alpha47 = Atomlab_Color::hex2rgba( $color, '0.47' );

			// Color.
			$css = "
                mark,
                .page-close-mobile-menu:hover,
                .growl-close:hover,
                .secondary-color,
                .tm-button.style-flat.tm-button-secondary:hover,
				.tm-button.style-outline.tm-button-secondary,
				.tm-button.style-text.tm-button-secondary,
				.tm-button.style-text.tm-button-secondary:hover .button-icon,
				.tm-button.style-outline.tm-button-grey,
				.tm-button.style-flat.tm-button-grey:hover,
				.tm-button.style-flat.tm-button-white-alt,
				.tm-view-demo .tm-button.tm-button-view-demo,
				.tm-box-icon.style-3 .icon,
				.tm-box-icon.style-5 .icon,
				.tm-box-icon.style-6 .icon,
				.tm-box-icon.style-7 .icon,
				.tm-box-icon.style-8 .icon,
				.tm-box-icon.style-12 .icon,
				.tm-box-icon.style-13 .icon,
				.tm-box-icon.style-14 .icon,
				.tm-box-icon.style-15 .heading,
				.tm-heading.right-separator .heading,
				.tm-maps.overlay-style-02 .middle-dot,
				.tm-product-banner-slider .tm-product-banner-btn,
				.tm-countdown.skin-dark .number,
				.tm-countdown.skin-dark .separator,
				.tm-drop-cap.style-1 .drop-cap,
				.vc_progress_bar .vc_single_bar_title .vc_label_units,
				.highlight-text mark, .typed-text mark, .typed-text-2 mark,
				.typed-text .typed-cursor, .typed-text-2 .typed-cursor,
				.tm-twitter.style-slider-quote .tweet-info:before,
				.tm-twitter.style-slider-quote .tweet-text a,
				.tm-twitter.style-slider-quote-02 .tweet-info:before,
				.tm-twitter.style-slider-quote-02 .tweet-text a,
				.tm-twitter .tweet:before,
				.tm-swiper.nav-style-2 .swiper-nav-button:hover,
				.testimonial-rating .ion-android-star,
				.tm-info-boxes.style-metro .grid-item.skin-primary .box-title,
				.tm-team-member .social-networks a:hover,
				.tm-instagram .instagram-user-name,
				.tm-blog .post-title a:hover,
				.tm-blog .post-categories a:hover,
				.tm-blog.style-list .post-item .post-link a,
				.tm-portfolio [data-overlay-animation='faded-light'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='faded-light'] .post-overlay-categories a:hover,
				.tm-portfolio [data-overlay-animation='zoom'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='zoom'] .post-overlay-categories a:hover,
				.tm-portfolio [data-overlay-animation='zoom2'] .post-item-wrapper:hover .post-overlay-title,
				.tm-portfolio.style-full-wide-slider .post-overlay-categories a:hover,
				.tm-product.style-grid-simple .product-categories a:hover,
				.tm-pricing.style-1 .title,
				.tm-pricing.style-2 .icon,
				.tm-social-networks .link:hover,
				.tm-social-networks.style-icons .link:hover,
				.header-info .info-icon,
				.skin-secondary .wpcf7-text.wpcf7-text, .skin-secondary .wpcf7-textarea,
				.tm-menu .menu-price,
				.wpb-js-composer .vc_tta-style-atomlab-01 .vc_tta-tab,
				.wpb-js-composer .vc_tta-style-atomlab-03 .vc_tta-tab,
				.page-content .tm-custom-menu.style-1 .menu a:hover,
				.post-share a:hover,
				.post-share-toggle,
				.single-post .post-categories a:hover,
				.related-posts .related-post-title a:hover,
				.single-portfolio .related-portfolio-wrap .post-overlay-title a:hover,
				.return-blog-page,
				.comments-area .comment-count,
				.single-portfolio .portfolio-categories a:hover,
				.widget .mc4wp-form button[type=submit],
				.tm-mailchimp-form.style-2 .form-submit,
				.tm-mailchimp-form.style-3 .form-submit,
				.page-template-coming-soon-01 .mc4wp-form .form-submit,
				.page-template-coming-soon-02 .cs-countdown .number,
				.page-content .widget a:hover,
				.page-sidebar-fixed .widget a:hover,
				.tm-view-demo-icon .item-icon,
				.menu--primary .menu-item-feature,
				.gmap-marker-title,
				.nav-links a:hover:after,
				.page-main-content .search-form .search-submit:hover .search-btn-icon,
				.widget_search .search-submit:hover .search-btn-icon, .widget_product_search .search-submit:hover .search-btn-icon,
				.page-links > span, .page-links > a:hover, .page-links > a:focus,
				.comment-nav-links li a:hover, .comment-nav-links li a:focus, .comment-nav-links li .current,
				.page-pagination li a:hover, .page-pagination li a:focus, .page-pagination li .current
				{ 
					color: {$color} 
				}";

			// Color Important.
			$css .= "
                .secondary-color-important,
				.secondary-color-hover-important:hover,
				 .widget_categories a:hover, .widget_categories .current-cat-ancestor > a, .widget_categories .current-cat-parent > a, .widget_categories .current-cat > a
				 {
                      color: {$color}!important;
				 }";

			// Background Color.
			$css .= "
                .secondary-background-color,
                .page-scroll-up,
                .widget_calendar #today,
                .top-bar-01 .top-bar-button,
                .desktop-menu .header-09 .header-special-button,
				.tm-maps.overlay-style-01 .animated-dot .middle-dot,
				.tm-maps.overlay-style-01 .animated-dot div[class*='signal'],
				.tm-card.style-2 .icon:before,
				.tm-gallery .overlay,
				.tm-grid-wrapper .filter-counter,
				.tm-blog.style-list .post-quote,
				.tm-blog.style-grid .post-overlay,
				.tm-blog.style-carousel .post-overlay,
				.tm-blog.style-grid_masonry .post-quote,
				.tm-blog.style-grid_classic .post-quote,
				.tm-blog.style-metro .post-thumbnail,
				.tm-portfolio [data-overlay-animation='zoom2'] .post-item-wrapper:hover .post-read-more,
				.tm-drop-cap.style-2 .drop-cap,
				.tm-box-icon.style-5:hover .icon,
				.tm-box-icon.style-12:hover .content-wrap,
				.tm-info-boxes.style-metro .grid-item.skin-secondary,
				.tm-card.style-1,
				.tm-timeline ul li:after,
				.tm-button.style-flat.tm-button-secondary,
				.tm-button.style-outline.tm-button-secondary:hover,
				.tm-swiper .swiper-nav-button:hover,
				.wpb-js-composer .vc_tta-style-atomlab-01 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta-style-atomlab-03 .vc_tta-tab.vc_active > a,
				.single-post .post-quote-overlay,
				.portfolio-details-gallery .gallery-item .overlay,
				.tagcloud a:hover,
				.tm-search-form .category-list a:hover,
				.tm-mailchimp-form.style-1 .form-submit,
				.page-template-coming-soon-02 .mc4wp-form .form-submit,
				.select2-container--default .select2-results__option--highlighted[aria-selected]
				{
					background-color: {$color};
				}";

			$css .= "
                .secondary-background-color-important,
				.secondary-background-color-hover-important:hover,
				.tm-swiper.pagination-style-3 .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
				.tm-swiper.pagination-style-4 .swiper-pagination-bullet:hover:before,
				.tm-swiper.pagination-style-4 .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
				.lg-progress-bar .lg-progress
				{
					background-color: {$color}!important;
				}";

			$css .= "
				.tm-view-demo .overlay
				{
					background-color: {$alpha90};
				}";

			$css .= "
				.tm-popup-video.style-poster-02 .video-overlay,
                .btn-view-full-map
				{
					background-color: {$alpha70};
				}";

			// Border.
			$css .= "
				.secondary-border-color,
				.tm-box-icon.style-8 .icon,
                input[type='text']:focus,
                input[type='email']:focus,
                input[type='url']:focus,
                input[type='password']:focus,
                input[type='search']:focus,
                input[type='number']:focus,
                input[type='tel']:focus,
                input[type='range']:focus,
                input[type='date']:focus,
                input[type='month']:focus,
                input[type='week']:focus,
                input[type='time']:focus,
                input[type='datetime']:focus,
                input[type='datetime-local']:focus,
                input[type='color']:focus, textarea:focus,
                select:focus,
                .popup-search-wrap .search-form .search-field:focus,
                .widget .mc4wp-form input[type=email]:focus,
				.tm-button.style-outline.tm-button-secondary,
				.tm-button.style-flat.tm-button-secondary,
				.tm-blog.style-grid .post-item:hover,
				.tm-blog.style-carousel .post-item:hover,
				.tm-swiper .swiper-nav-button:hover,
				.tm-swiper .swiper-pagination-bullet:hover:before, .tm-swiper .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
				.post-share-toggle:hover,
				.return-blog-page:hover
				{
					border-color: {$color};
				}";


			// Border Important.
			$css .= "
                .secondary-border-color-important,
				.secondary-border-color-hover-important:hover,
				.tm-maps.overlay-style-02 .animated-dot .signal2,
				.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover,
				#fp-nav ul li a.active span, .fp-slidesNav ul li a.active span
				{
					border-color: {$color}!important;
				}";

			// Border Top.
			$css .= "
                .tm-grid-wrapper .filter-counter:before,
                .wpb-js-composer .vc_tta-style-atomlab-01 .vc_tta-tab.vc_active:after
                {
					border-top-color: {$color};
				}";

			$css .= "
                blockquote,
                .wpb-js-composer .vc_tta-style-atomlab-03 .vc_tta-tab.vc_active:after
                {
                    border-left-color: {$color};
                }";

			// Border Bottom.
			$css .= "
				.tm-box-icon.style-12 .content-wrap,
				.tm-box-icon.style-13:hover .content-wrap,
                .wpb-js-composer .vc_tta-style-atomlab-02 .vc_tta-tab.vc_active
                {
					border-bottom-color: {$color};
				}";

			$css .= "
				.tm-swiper.pagination-style-4 .swiper-pagination-bullet.swiper-pagination-bullet-active:before 
				{
					box-shadow: 0 3px 8px $alpha47;
				}";

			$css .= ".tm-maps.overlay-style-02 .animated-dot .signal2
			{
				box-shadow: inset 0 0 35px 10px {$color};
			}";

			if ( class_exists( 'WooCommerce' ) ) {
				$css .= "
				.woocommerce .cart_list.product_list_widget a:hover,
				.woocommerce ul.product_list_widget li .product-title:hover,
                .woocommerce.single-product div.product .single_add_to_cart_button:hover,
                .woocommerce .quantity button:hover span,
                .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
				.woocommerce-Price-amount, .amount, .woocommerce div.product p.price, .woocommerce div.product span.price,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover,
				.woocommerce-Price-amount, .amount, .woocommerce div.product p.price, .woocommerce div.product span.price {
					color: {$color}
				}";

				$css .= "
				.yith-wcwl-wishlistaddedbrowse a,
				.yith-wcwl-wishlistexistsbrowse a,
				.widget_product_categories a:hover,
				.widget_product_categories .current-cat-ancestor > a,
				.widget_product_categories .current-cat-parent > a,
				.widget_product_categories .current-cat > a
				{
					color: {$color}!important;
				}";

				$css .= "
                .tm-product.style-grid .woocommerce_loop_add_to_cart_wrap a:hover,
                .tm-product.style-grid .quickview-icon:hover,
                .tm-product.style-grid .yith-compare-btn .compare:hover,
                .tm-product.style-grid .yith-wcwl-add-to-wishlist a:hover,
                .mini-cart .mini-cart-icon:after,
                .single-product .yith-wcwl-add-to-wishlist a:hover,
                .single-product .yith-compare-btn a:hover,
				.woocommerce.single-product div.product .single_add_to_cart_button,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .price_slider_amount .button { 
					background-color: {$color}; 
				}";

				$css .= "
				.woocommerce.single-product div.product .single_add_to_cart_button,
				.single-product .yith-wcwl-add-to-wishlist a:hover,
				.single-product .yith-compare-btn a:hover,
				body.woocommerce-cart table.cart td.actions .coupon .input-text:focus,
				.woocommerce div.quantity .qty:focus,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce input.button.alt, .button {
					border-color: {$color};
				}";

				$css .= "
                .mini-cart .widget_shopping_cart_content,
				.woocommerce.single-product div.product .woocommerce-tabs ul.tabs li.active,
				.woocommerce .select2-container .select2-choice {
					border-bottom-color: {$color};
				}";
			}

			return $css;
		}

		function third_color_css() {
			$color = Atomlab::setting( 'third_color' );

			// Color.
			$css = ".third-color,
                blockquote,
                .tm-grid-wrapper .filter-text,
                .tm-blog .post-categories,
                .tm-countdown.skin-dark .text,
                .testimonial-by-line,
                .testimonial-rating,
                .tm-heading.modern-text .heading,
                .tm-social-networks.style-title .link-text,
                .tm-posts-widget .post-widget-categories,
                .tm-product.style-grid-simple .product-categories,
                .header-info .info-sub-title,
                .tagcloud a,
                .widget_text,
                .single-post .page-main-content .post-tags,
                .author-biographical-info,
                .author-social-networks a,
                .comment-list .comment-datetime,
                .comment-actions a,
                .nav-links a,
                .widget_categories a,
                .widget_product_categories a,
                .single-post .post-categories
                { 
					color: {$color} 
				}";

			$css .= "
                .tm-grid-wrapper .btn-filter:hover .filter-text,
                .tm-grid-wrapper .btn-filter.current .filter-text
                {
                    background-color: {$color}
                }
            ";

			if ( class_exists( 'WooCommerce' ) ) {
				$css .= "
                .woocommerce.single-product .product-meta,
                .woocommerce-review__published-date,
                .comment-form-rating label,
                .woocommerce.single-product div.product form.cart label
                {
                    color: {$color} 
                }";

			}

			return $css;
		}

		function light_gallery_css() {
			$css                    = '';
			$primary_color          = Atomlab::setting( 'primary_color' );
			$secondary_color        = Atomlab::setting( 'secondary_color' );
			$cutom_background_color = Atomlab::setting( 'light_gallery_custom_background' );
			$background             = Atomlab::setting( 'light_gallery_background' );

			$tmp = '';

			if ( $background === 'primary' ) {
				$tmp .= "background-color: {$primary_color} !important;";
			} elseif ( $background === 'secondary' ) {
				$tmp .= "background-color: {$secondary_color} !important;";
			} else {
				$tmp .= "background-color: {$cutom_background_color} !important;";
			}

			$css .= ".lg-backdrop { $tmp }";

			return $css;
		}

		function get_typo_css( $typography ) {
			$css = '';

			if ( ! empty( $typography ) ) {
				foreach ( $typography as $attr => $value ) {
					if ( $attr === 'subsets' ) {
						continue;
					}
					if ( $attr === 'font-family' ) {
						$css .= "{$attr}: \"{$value}\", Helvetica, Arial, sans-serif;";
					} elseif ( $attr === 'variant' ) {
						$css .= "font-weight: {$value};";
					} else {
						$css .= "{$attr}: {$value};";
					}
				}
			}

			return $css;
		}
	}

	new Atomlab_Custom_Css();
}
