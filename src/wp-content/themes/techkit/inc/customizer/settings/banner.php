<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;
use radiustheme\techkit\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Switch_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Banner_Settings extends TechkitTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_banner_controls' ) );
	}

    public function register_banner_controls( $wp_customize ) {
	
		// Banner Color
		$wp_customize->add_setting('banner_heading_color', 
            array(
                'default' => $this->defaults['banner_heading_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'banner_heading_color',
            array(
                'label' => esc_html__('Banner Heading Color', 'techkit'),
                'section' => 'banner_section', 
            )
        ));
		
		$wp_customize->add_setting('breadcrumb_link_color', 
            array(
                'default' => $this->defaults['breadcrumb_link_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_link_color',
            array(
                'label' => esc_html__('Breadcrumb Link Color', 'techkit'),
                'section' => 'banner_section', 
            )
        ));
		
		$wp_customize->add_setting('breadcrumb_link_hover_color', 
            array(
                'default' => $this->defaults['breadcrumb_link_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_link_hover_color',
            array(
                'label' => esc_html__('Breadcrumb Link Hover Color', 'techkit'),
                'section' => 'banner_section', 
            )
        ));
		
		$wp_customize->add_setting('breadcrumb_active_color', 
            array(
                'default' => $this->defaults['breadcrumb_active_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_active_color',
            array(
                'label' => esc_html__('Active Breadcrumb Color', 'techkit'),
                'section' => 'banner_section', 
            )
        ));
		
		$wp_customize->add_setting('breadcrumb_seperator_color', 
            array(
                'default' => $this->defaults['breadcrumb_seperator_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_seperator_color',
            array(
                'label' => esc_html__('Breadcrumb Seperator Color', 'techkit'),
                'section' => 'banner_section', 
            )
        ));		
		
		$wp_customize->add_setting( 'banner_bg_opacity',
            array(
                'default' => $this->defaults['banner_bg_opacity'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'banner_bg_opacity',
            array(
                'label' => __( 'Banner Background Overlay opacity', 'techkit' ),
                'section' => 'banner_section',
                'type' => 'text',
            )
        );
		// Banner padding top
        $wp_customize->add_setting( 'banner_top_padding',
            array(
                'default' => $this->defaults['banner_top_padding'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'banner_top_padding',
            array(
                'label' => __( 'Banner Padding Top', 'techkit' ),
                'section' => 'banner_section',
                'type' => 'number',
            )
        );
        // Banner padding bottom
        $wp_customize->add_setting( 'banner_bottom_padding',
            array(
                'default' => $this->defaults['banner_bottom_padding'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'banner_bottom_padding',
            array(
                'label' => __( 'Banner Padding Top', 'techkit' ),
                'section' => 'banner_section',
                'type' => 'number',
            )
        );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Banner_Settings();
}
