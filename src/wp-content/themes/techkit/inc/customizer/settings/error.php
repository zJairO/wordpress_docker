<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Error_Settings extends TechkitTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_error_controls' ) );
	}

    public function register_error_controls( $wp_customize ) {
        // Error Page Banner Title
        $wp_customize->add_setting( 'error_title',
            array(
                'default' => $this->defaults['error_title'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'error_title',
            array(
                'label' => __( 'Page Title', 'techkit' ),
                'section' => 'error_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting('error_bodybg', 
            array(
                'default' => $this->defaults['error_bodybg'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'error_bodybg',
            array(
                'label' => esc_html__('Body Background Color', 'techkit'),
                'section' => 'error_section', 
            )
        ));
		// Bckground Image
        $wp_customize->add_setting( 'error_bg',
            array(
                'default' => $this->defaults['error_bg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'error_bg',
            array(
                'label' => __( 'Body Background Image', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'error_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'techkit' ),
                    'change' => __( 'Change File', 'techkit' ),
                    'default' => __( 'Default', 'techkit' ),
                    'remove' => __( 'Remove', 'techkit' ),
                    'placeholder' => __( 'No file selected', 'techkit' ),
                    'frame_title' => __( 'Select File', 'techkit' ),
                    'frame_button' => __( 'Choose File', 'techkit' ),
                )
            )
        ) );
		// Body Image 1
        $wp_customize->add_setting( 'error_image1',
            array(
                'default' => $this->defaults['error_image1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'error_image1',
            array(
                'label' => __( 'Body Image 1', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'error_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'techkit' ),
                    'change' => __( 'Change File', 'techkit' ),
                    'default' => __( 'Default', 'techkit' ),
                    'remove' => __( 'Remove', 'techkit' ),
                    'placeholder' => __( 'No file selected', 'techkit' ),
                    'frame_title' => __( 'Select File', 'techkit' ),
                    'frame_button' => __( 'Choose File', 'techkit' ),
                )
            )
        ) );
        // Body Image 2
        $wp_customize->add_setting( 'error_image2',
            array(
                'default' => $this->defaults['error_image2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'error_image2',
            array(
                'label' => __( 'Body Image 2', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'error_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'techkit' ),
                    'change' => __( 'Change File', 'techkit' ),
                    'default' => __( 'Default', 'techkit' ),
                    'remove' => __( 'Remove', 'techkit' ),
                    'placeholder' => __( 'No file selected', 'techkit' ),
                    'frame_title' => __( 'Select File', 'techkit' ),
                    'frame_button' => __( 'Choose File', 'techkit' ),
                )
            )
        ) );
		
        // Error Text
        $wp_customize->add_setting( 'error_text1',
            array(
                'default' => $this->defaults['error_text1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'error_text1',
            array(
                'label' => __( 'Error Text 1', 'techkit' ),
                'section' => 'error_section',
                'type' => 'text',
            )
        );
        $wp_customize->add_setting( 'error_text2',
            array(
                'default' => $this->defaults['error_text2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'error_text2',
            array(
                'label' => __( 'Error Text 2', 'techkit' ),
                'section' => 'error_section',
                'type' => 'text',
            )
        );
        // Button Text
        $wp_customize->add_setting( 'error_buttontext',
            array(
                'default' => $this->defaults['error_buttontext'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'error_buttontext',
            array(
                'label' => __( 'Button Text', 'techkit' ),
                'section' => 'error_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting('error_text1_color', 
            array(
                'default' => $this->defaults['error_text1_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'error_text1_color',
            array(
                'label' => esc_html__('Error Text 1 Color', 'techkit'),
                'section' => 'error_section', 
            )
        ));
		
		$wp_customize->add_setting('error_text2_color', 
            array(
                'default' => $this->defaults['error_text2_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'error_text2_color',
            array(
                'label' => esc_html__('Error Text 2 Color', 'techkit'),
                'section' => 'error_section', 
            )
        ));
		
		
    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Error_Settings();
}
