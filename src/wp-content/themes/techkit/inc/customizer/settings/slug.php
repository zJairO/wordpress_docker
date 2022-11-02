<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Slug_Settings extends TechkitTheme_Customizer {

	public function __construct() {
        parent::instance();
        $this->populated_default_data();
        // Register Page Controls
        add_action( 'customize_register', array( $this, 'register_slug_controls' ) );
	}

    public function register_slug_controls( $wp_customize ) {
	
		$wp_customize->add_setting( 'team_slug',
            array(
                'default' => $this->defaults['team_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'team_slug',
            array(
                'label' => __( 'Team Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'service_slug',
            array(
                'default' => $this->defaults['service_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'service_slug',
            array(
                'label' => __( 'Service Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'case_slug',
            array(
                'default' => $this->defaults['case_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'case_slug',
            array(
                'label' => __( 'Case Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'testimonial_slug',
            array(
                'default' => $this->defaults['testimonial_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'testimonial_slug',
            array(
                'label' => __( 'Testimonial Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		// Category
		$wp_customize->add_setting( 'team_cat_slug',
            array(
                'default' => $this->defaults['team_cat_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'team_cat_slug',
            array(
                'label' => __( 'Team Category Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'service_cat_slug',
            array(
                'default' => $this->defaults['service_cat_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'service_cat_slug',
            array(
                'label' => __( 'Service Category Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'case_cat_slug',
            array(
                'default' => $this->defaults['case_cat_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'case_cat_slug',
            array(
                'label' => __( 'Case Category Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'testim_cat_slug',
            array(
                'default' => $this->defaults['testim_cat_slug'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'testim_cat_slug',
            array(
                'label' => __( 'Testimonial Category Slug', 'techkit' ),
                'section' => 'slug_layout_section',
                'type' => 'text',
            )
        );	
        

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Slug_Settings();
}
