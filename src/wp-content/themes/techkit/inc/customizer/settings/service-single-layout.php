<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;
use radiustheme\techkit\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Service_Single_Layout_Settings extends TechkitTheme_Customizer {

	public function __construct() {
        parent::instance();
        $this->populated_default_data();
        // Register Page Controls
        add_action( 'customize_register', array( $this, 'register_service_single_layout_controls' ) );
	}

    public function register_service_single_layout_controls( $wp_customize ) {

        $wp_customize->add_setting( 'service_layout',
            array(
                'default' => $this->defaults['service_layout'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'service_layout',
            array(
                'label' => __( 'Layout', 'techkit' ),
                'description' => esc_html__( 'Select the default template layout for Pages', 'techkit' ),
                'section' => 'service_single_layout_section',
                'choices' => array(
                    'left-sidebar' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-left.png',
                        'name' => __( 'Left Sidebar', 'techkit' )
                    ),
                    'full-width' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-full.png',
                        'name' => __( 'Full Width', 'techkit' )
                    ),
                    'right-sidebar' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-right.png',
                        'name' => __( 'Right Sidebar', 'techkit' )
                    )
                )
            )
        ) );

        /**
         * Separator
         */
        $wp_customize->add_setting('separator_page', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Separator_Control($wp_customize, 'separator_page', array(
            'settings' => 'separator_page',
            'section' => 'service_single_layout_section',
        )));
		
		// Content padding top
        $wp_customize->add_setting( 'service_padding_top',
            array(
                'default' => $this->defaults['service_padding_top'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'service_padding_top',
            array(
                'label' => __( 'Content Padding Top', 'techkit' ),
                'section' => 'service_single_layout_section',
                'type' => 'number',
            )
        );
        // Content padding bottom
        $wp_customize->add_setting( 'service_padding_bottom',
            array(
                'default' => $this->defaults['service_padding_bottom'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'service_padding_bottom',
            array(
                'label' => __( 'Content Padding Bottom', 'techkit' ),
                'section' => 'service_single_layout_section',
                'type' => 'number',
            )
        );
		
		$wp_customize->add_setting( 'service_banner',
            array(
                'default' => $this->defaults['service_banner'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'service_banner',
            array(
                'label' => __( 'Banner', 'techkit' ),
                'section' => 'service_single_layout_section',
            )
        ) );
		
		$wp_customize->add_setting( 'service_breadcrumb',
            array(
                'default' => $this->defaults['service_breadcrumb'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'service_breadcrumb',
            array(
                'label' => __( 'Breadcrumb', 'techkit' ),
                'section' => 'service_single_layout_section',
            )
        ) );
		
        // Banner BG Type 
        $wp_customize->add_setting( 'service_bgtype',
            array(
                'default' => $this->defaults['service_bgtype'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'service_bgtype',
            array(
                'label' => __( 'Banner Background Type', 'techkit' ),
                'section' => 'service_single_layout_section',
                'description' => esc_html__( 'This is banner background type.', 'techkit' ),
                'type' => 'select',
                'choices' => array(
                    'bgimg' => esc_html__( 'BG Image', 'techkit' ),
                    'bgcolor' => esc_html__( 'BG Color', 'techkit' ),
                ),
            )
        );

        $wp_customize->add_setting( 'service_bgimg',
            array(
                'default' => $this->defaults['service_bgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'service_bgimg',
            array(
                'label' => __( 'Banner Background Image', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'service_single_layout_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'techkit' ),
                    'change' => __( 'Change File', 'techkit' ),
                    'default' => __( 'Default', 'techkit' ),
                    'remove' => __( 'Remove', 'techkit' ),
                    'placeholder' => __( 'No file selected', 'techkit' ),
                    'frame_title' => __( 'Select File', 'techkit' ),
                    'frame_button' => __( 'Choose File', 'techkit' ),
                ),
            )
        ) );

        // Banner background color
        $wp_customize->add_setting('service_bgcolor', 
            array(
                'default' => $this->defaults['service_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'service_bgcolor',
            array(
                'label' => esc_html__('Banner Background Color', 'techkit'),
                'settings' => 'service_bgcolor', 
                'priority' => 10, 
                'section' => 'service_single_layout_section', 
            )
        ));
		
		// Page background image
		$wp_customize->add_setting( 'service_page_bgimg',
            array(
                'default' => $this->defaults['service_page_bgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'service_page_bgimg',
            array(
                'label' => __( 'Page / Post Background Image', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'service_single_layout_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'techkit' ),
                    'change' => __( 'Change File', 'techkit' ),
                    'default' => __( 'Default', 'techkit' ),
                    'remove' => __( 'Remove', 'techkit' ),
                    'placeholder' => __( 'No file selected', 'techkit' ),
                    'frame_title' => __( 'Select File', 'techkit' ),
                    'frame_button' => __( 'Choose File', 'techkit' ),
                ),
            )
        ) );
		
		$wp_customize->add_setting('service_page_bgcolor', 
            array(
                'default' => $this->defaults['service_page_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'service_page_bgcolor',
            array(
                'label' => esc_html__('Page / Post Background Color', 'techkit'),
                'settings' => 'service_page_bgcolor', 
                'section' => 'service_single_layout_section', 
            )
        ));
        

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Service_Single_Layout_Settings();
}
