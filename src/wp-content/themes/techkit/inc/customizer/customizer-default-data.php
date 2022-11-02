<?php
// Customizer Default Data
if ( ! function_exists( 'rttheme_generate_defaults' ) ) {
    function rttheme_generate_defaults() {
        $customizer_defaults = array(

            // General  
            'logo'               	=> '',
            'logo_light'          	=> '',
			'container_width'		=> '1200',
            'preloader'          	=> 1,
            'preloader_image'    	=> '',
			'preloader_bg_color' 	=> '#ffffff',
            'back_to_top'     		=> 1,
            'display_no_preview_image'    => 0,
            'display_no_prev_img_related_post'  => 0,

            // Contact Socials
            'phone'   			=> '',
            'email'   			=> '',
            'openhour'   		=> '',
            'address'   		=> '',
            'top_bar_text'   	=> '',
            'sidetext'   		=> '',
            'address_label'   	=> '',
            'sidetext_label'   	=> '',
            'social_label'   	=> '',			
            'social_facebook'  	=> '',
            'social_twitter'   	=> '',
            'social_gplus' 		=> '',
            'social_linkedin'   => '',
            'social_behance' 	=> '',
            'social_dribbble'  	=> '',
            'social_youtube'    => '',
            'social_pinterest'  => '',
            'social_instagram'  => '',
            'social_skype'      => '',
            'social_rss'       	=> '',
            'social_snapchat'   => '',
			
			// Color
			'primary_color' 			=> '#0554f2',
			'secondary_color' 			=> '#14133b',
			'body_color' 				=> '#444444',			
			'menu_color' 				=> '#14133b',
			'menu_hover_color' 			=> '#0554f2',
			'menu_color_tr' 			=> '#ffffff',			
			'submenu_color' 			=> '#656567',
			'submenu_hover_color' 		=> '#0554f2',
			'submenu_bgcolor' 			=> '#ffffff',
			'submenu_hover_bgcolor' 	=> '#ffffff',

            // header
			'top_bar'  					=> 0,
			'top_bar_style'  			=> 1,
			'top_bar_bgcolor'			=> '#ffffff',
			'top_bar_color'				=> '#646464',
			'top_baricon_color'			=> '#0554f2',
			'top_bar_color_tr'			=> '#ffffff',
			'top_baricon_color_tr'		=> '#ffffff',			
			'top_bar_bgcolor_2'			=> '#f6f9ff',
			'top_bar_color_2'			=> '#5b6674',
			'top_baricon_color_2'		=> '#5b6674',
			'top_bar_color_tr_2'		=> '#ffffff',
			'top_baricon_color_tr_2'	=> '#ffffff',	

			'mobile_topbar'  			=> 0,
			'mobile_openhour'  			=> 0,
			'mobile_phone'  			=> 1,
			'mobile_email'  			=> 0,
			'mobile_address'  			=> 1,
			'mobile_social'  			=> 0,
			'mobile_search'  			=> 0,
			'mobile_cart'  				=> 0,
			'mobile_button'  			=> 0,
			
			'sticky_menu'       		=> 1,
			'tr_header'       			=> 0,
			'header_opt'       			=> 1,
			'header_top'       			=> 1,
            'header_style'      		=> 2,		
            'search_icon'      			=> 0,
            'cart_icon'      			=> 0,
            'vertical_menu_icon' 		=> 0,
			'online_button'				=>'1',
            'online_button_text' 		=> 'Free Consultant',
            'online_button_link' 		=> '#',
			
			// Footer
            'footer_style'        		=> 1,
            'copyright_text'      		=> '&copy; ' . date('Y') . ' techkit. All Rights Reserved by <a target="_blank" rel="nofollow" href="' . TECHKIT_AUTHOR_URI . '">RadiusTheme</a>',
			'footer_column_1'			=> 4,
            'footer_column_2'           => 4,
            'footer_column_3'           => 4,
			'footer_area'				=> 1,
			'footer_shape'				=> 0,
            'footer_shape2'             => 0,
            'footer_shape3'             => 0,
			'footer_bgtype' 			=> 'fbgcolor',
            'footer_bgtype2'            => 'fbgcolor2',
            'footer_bgtype3'            => 'fbgcolor3',
			'fbgcolor' 					=> '#181a2e',
            'fbgcolor2'                 => '#191b29',
            'fbgcolor3'                 => '#ffffff',
			'fbgimg'					=> '',
            'fbgimg2'                   => '',
            'fbgimg3'                   => '',
			'footer_title_color' 		=> '#ffffff',
			'footer_color' 				=> '#d7d7d7',
			'footer_link_color' 		=> '#d7d7d7',
			'footer_link_hover_color' 	=> '#ffffff',
            'footer_logo_light'         => '',
            'footer2_logo'              => 1,
            'footer2_social'            => 1,
            'copyright_bgcolor'         => '#1c1e2e',
            'copyright_text_color'      => '#aaaaaa',
            'copyright_link_color'      => '#d7d7d7',
            'copyright_hover_color'     => '#ffffff',

            'footer3_title_color'     	=> '#14133b',
            'footer3_color'     		=> '#5b6674',
            'footer3_link_color'     	=> '#5b6674',
            'footer3_hover_color'     	=> '#0554f2',
			
			// Banner 
			'banner_heading_color' 		=> '#ffffff',
			'breadcrumb_link_color' 	=> '#ffffff',
			'breadcrumb_link_hover_color' => '#0554f2',
			'breadcrumb_active_color' 	=> '#c7c7c7',
			'breadcrumb_seperator_color'=> '#ffffff',
			'banner_bg_opacity' 		=> 0.75,
			'banner_top_padding'    	=> 140,
            'banner_bottom_padding' 	=> 150,
            'breadcrumb_active' 		=> 0,
			
			// Post Type Slug
			'team_slug' 				=> 'team',
			'service_slug' 				=> 'service',
			'case_slug' 				=> 'case',
			'testimonial_slug' 			=> 'testimonial',
			'team_cat_slug' 			=> 'team-category',
			'service_cat_slug' 			=> 'service-category',
			'case_cat_slug' 			=> 'case-category',
			'testim_cat_slug' 			=> 'testimonial-category',			
			
            // Page Layout Setting 
            'page_layout'        => 'full-width',
			'page_padding_top'    => 130,
            'page_padding_bottom' => 120,
            'page_banner' => 1,
            'page_breadcrumb' => 1,
            'page_bgtype' => 'bgcolor',
            'page_bgcolor' => '#14133b',
            'page_bgimg' => '',
            'page_page_bgimg' => '',
            'page_page_bgcolor' => '#ffffff',
			
			//Blog Layout Setting 
            'blog_layout' => 'right-sidebar',
			'blog_padding_top'    => 130,
            'blog_padding_bottom' => 120,
            'blog_banner' => 1,
            'blog_breadcrumb' => 1,			
			'blog_bgtype' => 'bgcolor',
            'blog_bgcolor' => '#14133b',
            'blog_bgimg' => '',
            'blog_page_bgimg' => '',
            'blog_page_bgcolor' => '#ffffff',
			
			//Single Post Layout Setting 
			'single_post_layout' => 'right-sidebar',
			'single_post_padding_top'    => 120,
            'single_post_padding_bottom' => 120,
            'single_post_banner' => 1,
            'single_post_breadcrumb' => 1,			
			'single_post_bgtype' => 'bgcolor',
            'single_post_bgcolor' => '#14133b',
            'single_post_bgimg' => '',
            'single_post_page_bgimg' => '',
            'single_post_page_bgcolor' => '#ffffff',
			
			//Service Layout Setting 
			'service_archive_layout' => 'right-sidebar',
			'service_archive_padding_top'    => 120,
            'service_archive_padding_bottom' => 120,
            'service_archive_banner' => 1,
            'service_archive_breadcrumb' => 1,			
			'service_archive_bgtype' => 'bgcolor',
            'service_archive_bgcolor' => '#14133b',
            'service_archive_bgimg' => '',
            'service_archive_page_bgimg' => '',
            'service_archive_page_bgcolor' => '#ffffff',
			
			//Service Single Layout Setting 
			'service_layout' => 'right-sidebar',
			'service_padding_top'    => 120,
            'service_padding_bottom' => 120,
            'service_banner' => 1,
            'service_breadcrumb' => 1,			
			'service_bgtype' => 'bgcolor',
            'service_bgcolor' => '#14133b',
            'service_bgimg' => '',
            'service_page_bgimg' => '',
            'service_page_bgcolor' => '#ffffff',
			
			//Case Layout Setting 
			'case_archive_layout' => 'full-width',
			'case_archive_padding_top'    => 120,
            'case_archive_padding_bottom' => 120,
            'case_archive_banner' => 1,
            'case_archive_breadcrumb' => 1,			
			'case_archive_bgtype' => 'bgcolor',
            'case_archive_bgcolor' => '#14133b',
            'case_archive_bgimg' => '',
            'case_archive_page_bgimg' => '',
            'case_archive_page_bgcolor' => '#ffffff',
			
			//Case Single Layout Setting 
			'case_layout' => 'full-width',
			'case_padding_top'    => 120,
            'case_padding_bottom' => 120,
            'case_banner' => 1,
            'case_breadcrumb' => 1,			
			'case_bgtype' => 'bgcolor',
            'case_bgcolor' => '#14133b',
            'case_bgimg' => '',
            'case_page_bgimg' => '',
            'case_page_bgcolor' => '#ffffff',
			
			//Team Layout Setting 
			'team_archive_layout' => 'full-width',
			'team_archive_padding_top'    => 120,
            'team_archive_padding_bottom' => 120,
            'team_archive_banner' => 1,
            'team_archive_breadcrumb' => 1,			
			'team_archive_bgtype' => 'bgcolor',
            'team_archive_bgcolor' => '#14133b',
            'team_archive_bgimg' => '',
            'team_archive_page_bgimg' => '',
            'team_archive_page_bgcolor' => '#ffffff',
			
			//Team Single Layout Setting 
			'team_layout' => 'full-width',
			'team_padding_top'    => 120,
            'team_padding_bottom' => 120,
            'team_banner' => 1,
            'team_breadcrumb' => 1,			
			'team_bgtype' => 'bgcolor',
            'team_bgcolor' => '#14133b',
            'team_bgimg' => '',
            'team_page_bgimg' => '',
            'team_page_bgcolor' => '#ffffff',
			
			//Search Layout Setting 
			'search_layout' => 'right-sidebar',
			'search_padding_top'    => 120,
            'search_padding_bottom' => 120,
            'search_banner' => 1,
            'search_breadcrumb' => 1,			
			'search_bgtype' => 'bgcolor',
            'search_bgcolor' => '#14133b',
            'search_bgimg' => '',
            'search_page_bgimg' => '',
            'search_page_bgcolor' => '#ffffff',
            'search_excerpt_length' => 40,
			
			//Error Layout Setting 
			'error_padding_top'    => 120,
            'error_padding_bottom' => 120,
            'error_banner' => 1,
            'error_breadcrumb' => 1,			
			'error_bgtype' => 'bgcolor',
            'error_bgcolor' => '#14133b',
            'error_bgimg' => '',
            'error_page_bgimg' => '',
            'error_page_bgcolor' => '#ffffff',
			
			//Shop Archive Layout Setting 
			'shop_layout' => 'left-sidebar',
			'shop_padding_top'    => 120,
            'shop_padding_bottom' => 120,
            'shop_banner' => 1,
            'shop_breadcrumb' => 1,			
			'shop_bgtype' => 'bgcolor',
            'shop_bgcolor' => '#14133b',
            'shop_bgimg' => '',
            'shop_page_bgimg' => '',
            'shop_page_bgcolor' => '#ffffff',

            'products_cols_width' => 4,
			'products_per_page' => 12,
			'wc_shop_quickview_icon' => 1,
			'wc_shop_wishlist_icon' => 1,
			'wc_shop_compare_icon' => 1,
			'wc_shop_rating' => 0,
			
			//Product Single Layout Setting 
			'product_layout' => 'full-width',
			'product_padding_top'    => 120,
            'product_padding_bottom' => 120,
            'product_banner' => 1,
            'product_breadcrumb' => 1,			
			'product_bgtype' => 'bgcolor',
            'product_bgcolor' => '#14133b',
            'product_bgimg' => '',
            'product_page_bgimg' => '',
            'product_page_bgcolor' => '#ffffff',

            'wc_product_wishlist_icon' => 1,
			'wc_product_compare_icon' => 1,
			'wc_product_quickview_icon' => 1,

            // Blog Archive
			'blog_style'				=> 'style2',
			'post_banner_title'  		=> '',
			'post_content_limit'  		=> '20',
			'blog_content'  			=> 1,
			'blog_date'  				=> 1,
			'blog_author_name'  		=> 1,
			'blog_comment_num'  		=> 0,
			'blog_cats'  				=> 1,
			'blog_view'  				=> 0,
			'blog_length'  				=> 0,
			
			// Post
			'post_style'				=> 'style1',
			'post_featured_image'		=> 1,
			'post_author_name'			=> 1,
			'post_date'					=> 1,
			'post_comment_num'			=> 1,
			'post_cats'					=> 1,
			'post_tags'					=> 1,
			'post_share'				=> 1,
			'post_links'				=> 0,
			'post_author_bio'			=> 0,
			'post_view'					=> 1,
			'post_length'				=> 0,
			'show_related_post'			=> 0,
			'show_related_post_number'	=> 5,
			'show_related_post_title_limit'	=> 8,
			'related_post_query'		=> 'cat',
			'related_post_sort'			=> 'recent',
			
			// Post Share
			'post_share_facebook' 		=> 1,
			'post_share_twitter' 		=> 1,
			'post_share_google' 		=> 1,
			'post_share_linkedin' 		=> 1,
			'post_share_pinterest' 		=> 1,
			'post_share_whatsapp' 		=> 0,
			'post_share_stumbleupon' 	=> 0,
			'post_share_tumblr' 		=> 0,
			'post_share_reddit' 		=> 0,
			'post_share_email' 			=> 0,
			'post_share_print' 			=> 0,
            
            // Case
            'case_archive_style'     => 'style1', 
            'case_ar_category'  		=> 1,
            'show_case_date'  		    => 1,
            'show_case_cat'             => 1,
            'show_case_view'            => 1,
            'show_case_social'          => 1,
            'show_case_like'          	=> 1,
            'show_case_pagination'      => 1,


            'show_related_case'  		=> 1,
            'case_related_title'  		=> 'Related Case',
            'related_case_number'  		=> 5,
            'related_case_title_limit'  => 5,
			
			// Team
			'team_archive_style' 		=> 'style1',
			'team_arexcerpt_limit' 		=> 14,
			'team_ar_excerpt' 			=> 0,
			'team_ar_position' 			=> 1,
			'team_ar_social' 			=> 1,
			'team_info' 				=> 1,
			'team_skill' 				=> 1,
			'team_form' 				=> 0,
			'team_form_title' 			=> 'Contact Me',
			'show_related_team' 		=> 1,
			'team_related_title' 		=> 'Related Chef',
			'related_team_social' 		=> 1,
			'related_team_position' 	=> 1,
			'related_team_number' 		=> 5,
			'related_team_title_limit' 	=> 5,
			
			// Service
			'services_style' 				=> 'style1',
			'service_excerpt_limit' 		=> 17,
			'service_ar_button' 			=> 1,
			
            // Error
            'error_title' 				=> 'Error 404',
            'error_bodybg' 				=> '#ffffff',
            'error_text1_color' 		=> '#14133b',
            'error_text2_color' 		=> '#5b6674',
			'error_bg' 					=> '',
			'error_image1' 				=> '',
			'error_image2' 				=> '',
            'error_text1' 				=> 'Sorry! Page Not Found!',
            'error_text2' 				=> 'Oops! The page which you are looking for does not exist. Please return to the homepage.',
            'error_buttontext' 			=> 'Back to home',
			
			// WooCommerce Shop Page
			'wc_archive_layouts' => 'regular',
			'wc_num_product' => 9,
			'wc_num_product_shop_page' => 3,
			'wc_show_title' => 1,
			'wc_show_price' => 1,
			'wc_show_cart' => 1,
			'wc_show_excerpt' => 1,
			'wc_show_excerpt_limit' => 7,
			'wc_block_layouts' => 'techkitstyle4',
			'wc_variation_select' => 'select-size',
			
			// WooCommerce Single Page
			'wc_sku' => 1,
			'wc_cats' => 1,
			'wc_tags' => 1,
			'wc_share' => 0,
			'wc_related' => 1,
			'wc_description' => 1,
			'wc_reviews' => 1,
			'wc_additional_info' => 1,
			'wc_related_title' => 'Related Products',
			'wc_cross_sell' => 1,

            // Typography
            'typo_body' => json_encode(
                array(
                    'font' => 'Roboto',
                    'regularweight' => 'normal',
                )
            ),
            'typo_body_size' => '16px',
            'typo_body_height'=> '30px',

            //Menu Typography
            'typo_menu' => json_encode(
                array(
                    'font' => 'Barlow',
                    'regularweight' => '500',
                )
            ),
            'typo_menu_size' => '16px',
            'typo_menu_height'=> '22px',

            //Sub Menu Typography
            'typo_sub_menu' => json_encode(
                array(
                    'font' => 'Barlow',
                    'regularweight' => '500',
                )
            ),
            'typo_submenu_size' => '15px',
            'typo_submenu_height'=> '22px',


            // Heading Typography
            'typo_heading' => json_encode(
                array(
                    'font' => 'Barlow',
                    'regularweight' => '600',
                )
            ),
            //H1
            'typo_h1' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '600',
                )
            ),
            'typo_h1_size' => '41px',
            'typo_h1_height' => '44px',

            //H2
            'typo_h2' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '600',
                )
            ),
            'typo_h2_size' => '32.44px',
            'typo_h2_height'=> '35px',

            //H3
            'typo_h3' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '600',
                )
            ),
            'typo_h3_size' => '25.63px',
            'typo_h3_height'=> '35px',

            //H4
            'typo_h4' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '600',
                )
            ),
            'typo_h4_size' => '20.25px',
            'typo_h4_height'=> '30px',

            //H5
            'typo_h5' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '600',
                )
            ),
            'typo_h5_size' => '18px',
            'typo_h5_height'=> '28px',

            //H6
            'typo_h6' => json_encode(
                array(
                    'font' => '',
                    'regularweight' => '600',
                )
            ),
            'typo_h6_size' => '16px',
            'typo_h6_height'=> '26px',

            
        );

        return apply_filters( 'rttheme_customizer_defaults', $customizer_defaults );
    }
}