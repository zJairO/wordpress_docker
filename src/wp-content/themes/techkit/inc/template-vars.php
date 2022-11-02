<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

add_action( 'template_redirect', 'techkit_template_vars' );
if( !function_exists( 'techkit_template_vars' ) ) {
    function techkit_template_vars() {
        // Single Pages
        if( is_single() || is_page() ) {
            $post_type = get_post_type();
            $post_id   = get_the_id();
            switch( $post_type ) {
                case 'page':
                $prefix = 'page';
                break;
				case 'techkit_service':
                $prefix = 'service';
                break;		  
                case 'techkit_case':
                $prefix = 'case';
                break; 		  
                case 'techkit_team':
                $prefix = 'team';
                break;  
                case 'product':
                $prefix = 'product';
                break;
                default:
                $prefix = 'single_post';
                break;
            }
			
			$layout_settings    = get_post_meta( $post_id, 'techkit_layout_settings', true );
            
            TechkitTheme::$layout = ( empty( $layout_settings['techkit_layout'] ) || $layout_settings['techkit_layout']  == 'default' ) ? TechkitTheme::$options[$prefix . '_layout'] : $layout_settings['techkit_layout'];
			
			TechkitTheme::$tr_header = ( empty( $layout_settings['techkit_tr_header'] ) || $layout_settings['techkit_tr_header'] == 'default' ) ? TechkitTheme::$options['tr_header'] : $layout_settings['techkit_tr_header'];
            
            TechkitTheme::$top_bar = ( empty( $layout_settings['techkit_top_bar'] ) || $layout_settings['techkit_top_bar'] == 'default' ) ? TechkitTheme::$options['top_bar'] : $layout_settings['techkit_top_bar'];
            
            TechkitTheme::$top_bar_style = ( empty( $layout_settings['techkit_top_bar_style'] ) || $layout_settings['techkit_top_bar_style'] == 'default' ) ? TechkitTheme::$options['top_bar_style'] : $layout_settings['techkit_top_bar_style'];
			
			TechkitTheme::$header_opt = ( empty( $layout_settings['techkit_header_opt'] ) || $layout_settings['techkit_header_opt'] == 'default' ) ? TechkitTheme::$options['header_opt'] : $layout_settings['techkit_header_opt'];
            
            TechkitTheme::$header_style = ( empty( $layout_settings['techkit_header'] ) || $layout_settings['techkit_header'] == 'default' ) ? TechkitTheme::$options['header_style'] : $layout_settings['techkit_header'];
			
            TechkitTheme::$footer_style = ( empty( $layout_settings['techkit_footer'] ) || $layout_settings['techkit_footer'] == 'default' ) ? TechkitTheme::$options['footer_style'] : $layout_settings['techkit_footer'];
			
			TechkitTheme::$footer_area = ( empty( $layout_settings['techkit_footer_area'] ) || $layout_settings['techkit_footer_area'] == 'default' ) ? TechkitTheme::$options['footer_area'] : $layout_settings['techkit_footer_area'];
			
            $padding_top = ( empty( $layout_settings['techkit_top_padding'] ) || $layout_settings['techkit_top_padding'] == 'default' ) ? TechkitTheme::$options[$prefix . '_padding_top'] : $layout_settings['techkit_top_padding'];
			
            TechkitTheme::$padding_top = (int) $padding_top;
            
            $padding_bottom = ( empty( $layout_settings['techkit_bottom_padding'] ) || $layout_settings['techkit_bottom_padding'] == 'default' ) ? TechkitTheme::$options[$prefix . '_padding_bottom'] : $layout_settings['techkit_bottom_padding'];
			
            TechkitTheme::$padding_bottom = (int) $padding_bottom;
			
            TechkitTheme::$has_banner = ( empty( $layout_settings['techkit_banner'] ) || $layout_settings['techkit_banner'] == 'default' ) ? TechkitTheme::$options[$prefix . '_banner'] : $layout_settings['techkit_banner'];
            
            TechkitTheme::$has_breadcrumb = ( empty( $layout_settings['techkit_breadcrumb'] ) || $layout_settings['techkit_breadcrumb'] == 'default' ) ? TechkitTheme::$options[ $prefix . '_breadcrumb'] : $layout_settings['techkit_breadcrumb'];
            
            TechkitTheme::$bgtype = ( empty( $layout_settings['techkit_banner_type'] ) || $layout_settings['techkit_banner_type'] == 'default' ) ? TechkitTheme::$options[$prefix . '_bgtype'] : $layout_settings['techkit_banner_type'];
            
            TechkitTheme::$bgcolor = empty( $layout_settings['techkit_banner_bgcolor'] ) ? TechkitTheme::$options[$prefix . '_bgcolor'] : $layout_settings['techkit_banner_bgcolor'];
			
			if( !empty( $layout_settings['techkit_banner_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( $layout_settings['techkit_banner_bgimg'], 'full', true );
                TechkitTheme::$bgimg = $attch_url[0];
            } elseif( !empty( TechkitTheme::$options[$prefix . '_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TechkitTheme::$options[$prefix . '_bgimg'], 'full', true );
                TechkitTheme::$bgimg = $attch_url[0];
            } else {
                TechkitTheme::$bgimg = TECHKIT_IMG_URL . 'banner.jpg';
            }
			
            TechkitTheme::$pagebgcolor = empty( $layout_settings['techkit_page_bgcolor'] ) ? TechkitTheme::$options[$prefix . '_page_bgcolor'] : $layout_settings['techkit_page_bgcolor'];			
            
            if( !empty( $layout_settings['techkit_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( $layout_settings['techkit_page_bgimg'], 'full', true );
                TechkitTheme::$pagebgimg = $attch_url[0];
            } elseif( !empty( TechkitTheme::$options[$prefix . '_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TechkitTheme::$options[$prefix . '_page_bgimg'], 'full', true );
                TechkitTheme::$pagebgimg = $attch_url[0];
            }
        }
        
        // Blog and Archive
        elseif( is_home() || is_archive() || is_search() || is_404() ) {
            if( is_search() ) {
                $prefix = 'search';
            } else if( is_404() ) {
                $prefix                                = 'error';
                TechkitTheme::$options[$prefix . '_layout'] = 'full-width';
            } elseif( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
                $prefix = 'shop';
            } elseif( is_post_type_archive( "techkit_service" ) || is_tax( "techkit_service_category" ) ) {
                $prefix = 'service_archive';            
            } elseif( is_post_type_archive( "techkit_case" ) || is_tax( "techkit_case_category" ) ) {
                $prefix = 'case_archive'; 
			} elseif( is_post_type_archive( "techkit_team" ) || is_tax( "techkit_team_category" ) ) {
                $prefix = 'team_archive'; 
			} else {
                $prefix = 'blog';
            }
            
            TechkitTheme::$layout         		= TechkitTheme::$options[$prefix . '_layout'];
            TechkitTheme::$tr_header      		= TechkitTheme::$options['tr_header'];
            TechkitTheme::$top_bar        		= TechkitTheme::$options['top_bar'];
            TechkitTheme::$header_opt      		= TechkitTheme::$options['header_opt'];
            TechkitTheme::$footer_area     		= TechkitTheme::$options['footer_area'];
            TechkitTheme::$top_bar_style  		= TechkitTheme::$options['top_bar_style'];
            TechkitTheme::$header_style   		= TechkitTheme::$options['header_style'];
            TechkitTheme::$footer_style   		= TechkitTheme::$options['footer_style'];
            TechkitTheme::$padding_top    		= TechkitTheme::$options[$prefix . '_padding_top'];
            TechkitTheme::$padding_bottom 		= TechkitTheme::$options[$prefix . '_padding_bottom'];
            TechkitTheme::$has_banner     		= TechkitTheme::$options[$prefix . '_banner'];
            TechkitTheme::$has_breadcrumb 		= TechkitTheme::$options[$prefix . '_breadcrumb'];
            TechkitTheme::$bgtype         		= TechkitTheme::$options[$prefix . '_bgtype'];
            TechkitTheme::$bgcolor        		= TechkitTheme::$options[$prefix . '_bgcolor'];
			
            if( !empty( TechkitTheme::$options[$prefix . '_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TechkitTheme::$options[$prefix . '_bgimg'], 'full', true );
                TechkitTheme::$bgimg = $attch_url[0];
            } else {
                TechkitTheme::$bgimg = TECHKIT_IMG_URL . 'banner.jpg';
            }
			
            TechkitTheme::$pagebgcolor = TechkitTheme::$options[$prefix . '_page_bgcolor'];
            if( !empty( TechkitTheme::$options[$prefix . '_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( TechkitTheme::$options[$prefix . '_page_bgimg'], 'full', true );
                TechkitTheme::$pagebgimg = $attch_url[0];
            }			
			
        }
    }
}

// Add body class
add_filter( 'body_class', 'techkit_body_classes' );
if( !function_exists( 'techkit_body_classes' ) ) {
    function techkit_body_classes( $classes ) {
		
		// Header
    	if ( TechkitTheme::$options['sticky_menu'] == 1 ) {
			$classes[] = 'sticky-header';
		}
		
        $classes[] = 'header-style-'. TechkitTheme::$header_style;		
        $classes[] = 'footer-style-'. TechkitTheme::$footer_style;

        if ( TechkitTheme::$top_bar == 1 || TechkitTheme::$top_bar == 'on' ){
            $classes[] = 'has-topbar topbar-style-'. TechkitTheme::$top_bar_style;
        }
		
        if ( TechkitTheme::$tr_header === 1 || TechkitTheme::$tr_header === "on" ){
           $classes[] = 'trheader';
        }
        
        $classes[] = ( TechkitTheme::$layout == 'full-width' ) ? 'no-sidebar' : 'has-sidebar';
		
		$classes[] = ( TechkitTheme::$layout == 'left-sidebar' ) ? 'left-sidebar' : 'right-sidebar';
        
        if( isset( $_COOKIE["shopview"] ) && $_COOKIE["shopview"] == 'list' ) {
            $classes[] = 'product-list-view';
        } else {
            $classes[] = 'product-grid-view';
        }
		if ( is_singular('post') ) {
			$classes[] =  ' post-detail-' . TechkitTheme::$options['post_style'];
        }
        return $classes;
    }
}