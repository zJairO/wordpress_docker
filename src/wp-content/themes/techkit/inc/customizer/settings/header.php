<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;
use radiustheme\techkit\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Heading_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Header_Settings extends TechkitTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_header_controls' ) );
	}

    public function register_header_controls( $wp_customize ) {
		
		// Top Bar Style
		$wp_customize->add_setting( 'top_bar',
            array(
                'default' => $this->defaults['top_bar'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'top_bar',
            array(
                'label' => __( 'Top Bar On/Off', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
		
        $wp_customize->add_setting( 'top_bar_style',
            array(
                'default' => $this->defaults['top_bar_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',

            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'top_bar_style',
            array(
                'label' => __( 'Top Bar Layout', 'techkit' ),
                'description' => esc_html__( 'You can override this settings only Mobile', 'techkit' ),
                'section' => 'header_section',
                'choices' => array(
                    '1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/top-1.jpg',
                        'name' => __( 'Layout 1', 'techkit' )
                    ),                  
                    '2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/top-2.jpg',
                        'name' => __( 'Layout 2', 'techkit' )
                    ),
                    '3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/top-3.jpg',
                        'name' => __( 'Layout 3', 'techkit' )
                    ),
                ),
                'active_callback'   => 'rttheme_is_topbar_enabled',
            )
        ) );
		// Topbar one option
		$wp_customize->add_setting('top_bar_bgcolor', 
            array(
                'default' => $this->defaults['top_bar_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_bgcolor',
            array(
                'label' => esc_html__('Top Bar Background Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_bar_color', 
            array(
                'default' => $this->defaults['top_bar_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_color',
            array(
                'label' => esc_html__('Top Bar Text Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_baricon_color', 
            array(
                'default' => $this->defaults['top_baricon_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_baricon_color',
            array(
                'label' => esc_html__('Top Bar Icon Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_bar_color_tr', 
            array(
                'default' => $this->defaults['top_bar_color_tr'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_color_tr',
            array(
                'label' => esc_html__('Transparent Top Bar Text Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_baricon_color_tr', 
            array(
                'default' => $this->defaults['top_baricon_color_tr'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_baricon_color_tr',
            array(
                'label' => esc_html__('Transparent Top Bar Icon Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar1_enabled', 	
            )
        ));
		
		// Topbar two option
		$wp_customize->add_setting('top_bar_bgcolor_2', 
            array(
                'default' => $this->defaults['top_bar_bgcolor_2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_bgcolor_2',
            array(
                'label' => esc_html__('Top Bar Background Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_bar_color_2', 
            array(
                'default' => $this->defaults['top_bar_color_2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_color_2',
            array(
                'label' => esc_html__('Top Bar Text Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_baricon_color_2', 
            array(
                'default' => $this->defaults['top_baricon_color_2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_baricon_color_2',
            array(
                'label' => esc_html__('Top Bar Icon Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_bar_color_tr_2', 
            array(
                'default' => $this->defaults['top_bar_color_tr_2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_color_tr_2',
            array(
                'label' => esc_html__('Transparent Top Bar Text Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        ));
		
		$wp_customize->add_setting('top_baricon_color_tr_2', 
            array(
                'default' => $this->defaults['top_baricon_color_tr_2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_baricon_color_tr_2',
            array(
                'label' => esc_html__('Transparent Top Bar Icon Color', 'techkit'),
                'section' => 'header_section', 
				'active_callback'   => 'rttheme_is_topbar2_enabled', 	
            )
        ));

        /**
         * Heading for Header Variation
         */
        $wp_customize->add_setting('header_variation_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'header_variation_heading', array(
            'label' => __( 'Header Variation', 'techkit' ),
            'section' => 'header_section',
        )));
		
		$wp_customize->add_setting( 'sticky_menu',
            array(
                'default' => $this->defaults['sticky_menu'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'sticky_menu',
            array(
                'label' => __( 'Sticky Header', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
		
		$wp_customize->add_setting( 'tr_header',
            array(
                'default' => $this->defaults['tr_header'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'tr_header',
            array(
                'label' => __( 'Transparent Header', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
		
		$wp_customize->add_setting( 'header_opt',
            array(
                'default' => $this->defaults['header_opt'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'header_opt',
            array(
                'label' => __( 'Header On/Off', 'techkit' ),
                'section' => 'header_section',
            )
        ) );

        $wp_customize->add_setting( 'header_top',
            array(
                'default' => $this->defaults['header_top'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'header_top',
            array(
                'label' => __( 'Header 1 Top On/Off', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
		

        // Header Style
        $wp_customize->add_setting( 'header_style',
            array(
                'default' => $this->defaults['header_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'header_style',
            array(
                'label' => __( 'Header Layout', 'techkit' ),
                'description' => esc_html__( 'You can override this settings only Mobile', 'techkit' ),
                'section' => 'header_section',
                'choices' => array(
                    '1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-1.jpg',
                        'name' => __( 'Layout 1', 'techkit' )
                    ),                  
                    '2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-2.jpg',
                        'name' => __( 'Layout 2', 'techkit' )
                    ),
                    '3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-3.jpg',
                        'name' => __( 'Layout 3', 'techkit' )
                    ),
                    '4' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-4.jpg',
                        'name' => __( 'Layout 4', 'techkit' )
                    ),
                    '5' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-5.jpg',
                        'name' => __( 'Layout 5', 'techkit' )
                    ),
                    '6' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-6.jpg',
                        'name' => __( 'Layout 6', 'techkit' )
                    ),
                )
            )
        ) );

        //Header Search
		$wp_customize->add_setting( 'search_icon',
            array(
                'default' => $this->defaults['search_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'search_icon',
            array(
                'label' => __( 'Search Icon', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
		
		$wp_customize->add_setting( 'vertical_menu_icon',
            array(
                'default' => $this->defaults['vertical_menu_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'vertical_menu_icon',
            array(
                'label' => __( 'Vertical Menu Icon', 'techkit' ),
                'section' => 'header_section',
            )
        ) );

        //Header Cart
        $wp_customize->add_setting( 'cart_icon',
            array(
                'default' => $this->defaults['cart_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'cart_icon',
            array(
                'label' => __( 'Cart Icon', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
		
		
		$wp_customize->add_setting( 'online_button',
            array(
                'default' => $this->defaults['online_button'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'online_button',
            array(
                'label' => __( 'Make a Claim Button', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
		
		$wp_customize->add_setting( 'online_button_text',
            array(
                'default' => $this->defaults['online_button_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
				'active_callback'   => 'rttheme_is_claim_enabled',
            )
        );
        $wp_customize->add_control( 'online_button_text',
            array(
                'label' => __( 'Button Text', 'techkit' ),
                'section' => 'header_section',
                'type' => 'text',
				'active_callback'   => 'rttheme_is_claim_enabled',
            )
        );
		
		$wp_customize->add_setting( 'online_button_link',
            array(
                'default' => $this->defaults['online_button_link'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
				'active_callback'   => 'rttheme_is_claim_enabled',
            )
        );
        $wp_customize->add_control( 'online_button_link',
            array(
                'label' => __( 'Button Link', 'techkit' ),
                'section' => 'header_section',
                'type' => 'url',
				'active_callback'   => 'rttheme_is_claim_enabled',
            )
        );
        /**
         * Heading for Header Variation
         */
        $wp_customize->add_setting('header_mobile_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'header_mobile_heading', array(
            'label' => __( 'Mobile Header Option', 'techkit' ),
            'section' => 'header_section',
        )));

        $wp_customize->add_setting( 'mobile_topbar',
            array(
                'default' => $this->defaults['mobile_topbar'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_topbar',
            array(
                'label' => __( 'Mobile Topbar', 'techkit' ),
                'section' => 'header_section',
            )
        ) );

        $wp_customize->add_setting( 'mobile_openhour',
            array(
                'default' => $this->defaults['mobile_openhour'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_openhour',
            array(
                'label' => __( 'Mobile Opening Hour', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
        $wp_customize->add_setting( 'mobile_phone',
            array(
                'default' => $this->defaults['mobile_phone'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_phone',
            array(
                'label' => __( 'Mobile Phone No', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
        $wp_customize->add_setting( 'mobile_email',
            array(
                'default' => $this->defaults['mobile_email'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_email',
            array(
                'label' => __( 'Mobile Email', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
        $wp_customize->add_setting( 'mobile_address',
            array(
                'default' => $this->defaults['mobile_address'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_address',
            array(
                'label' => __( 'Mobile Address', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
        $wp_customize->add_setting( 'mobile_social',
            array(
                'default' => $this->defaults['mobile_social'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_social',
            array(
                'label' => __( 'Mobile Social', 'techkit' ),
                'section' => 'header_section',
            )
        ) );

        $wp_customize->add_setting( 'mobile_search',
            array(
                'default' => $this->defaults['mobile_search'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_search',
            array(
                'label' => __( 'Mobile Search', 'techkit' ),
                'section' => 'header_section',
            )
        ) );

        $wp_customize->add_setting( 'mobile_cart',
            array(
                'default' => $this->defaults['mobile_cart'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_cart',
            array(
                'label' => __( 'Mobile Cart', 'techkit' ),
                'section' => 'header_section',
            )
        ) );

        $wp_customize->add_setting( 'mobile_button',
            array(
                'default' => $this->defaults['mobile_button'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'mobile_button',
            array(
                'label' => __( 'Mobile Button', 'techkit' ),
                'section' => 'header_section',
            )
        ) );
    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Header_Settings();
}
