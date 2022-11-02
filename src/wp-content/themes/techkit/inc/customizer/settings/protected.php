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
use radiustheme\techkit\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Protected_Pass_Settings extends TechkitTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_protected_password_controls' ) );
	}

    /**
     * Gallery Post Controls
     */
    public function register_protected_password_controls( $wp_customize ) {

        $wp_customize->add_setting( 'pp_bgimg',
            array(
                'default' => $this->defaults['pp_bgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'pp_bgimg',
            array(
                'label' => __( 'Page Background Image', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'pp_section',
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

        // Form Title
        $wp_customize->add_setting( 'form_title_text',
            array(
                'default' => $this->defaults['form_title_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'form_title_text',
            array(
                'label' => __( 'Form Title Text', 'techkit' ),
                'section' => 'pp_section',
                'type' => 'text',
            )
        );

        // Form Label
        $wp_customize->add_setting( 'form_label_text',
            array(
                'default' => $this->defaults['form_label_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'form_label_text',
            array(
                'label' => __( 'Form Title Text', 'techkit' ),
                'section' => 'pp_section',
                'type' => 'text',
            )
        );

        // Form Title
        $wp_customize->add_setting( 'form_btn_text',
            array(
                'default' => $this->defaults['form_btn_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'form_btn_text',
            array(
                'label' => __( 'Form Button Text', 'techkit' ),
                'section' => 'pp_section',
                'type' => 'text',
            )
        );

        
        // Logo Area Width
        $wp_customize->add_setting( 'pp_form_cols_width',
            array(
                'default' => $this->defaults['pp_form_cols_width'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( 'pp_form_cols_width',
            array(
                'label' => __( 'Form Columns', 'techkit' ),
                'section' => 'pp_section',
                'description' => esc_html__( 'Width is defined by the number of bootstrap columns grid. Please note, form columns devided by the selected bootstrap grid', 'techkit' ),
                'type' => 'select',
                'choices' => array(
                    '4' => esc_html__( '4 Grid', 'techkit' ),
                    '5' => esc_html__( '5 Grid', 'techkit' ),
                    '6' => esc_html__( '6 Grid', 'techkit' ),
                    '7' => esc_html__( '7 Grid', 'techkit' ),
                    '8' => esc_html__( '8 Grid', 'techkit' ),
                    '9' => esc_html__( '9 Grid', 'techkit' ),
                    '10' => esc_html__( '10 Grid', 'techkit' ),
                    '11' => esc_html__( '11 Grid', 'techkit' ),
                    '12' => esc_html__( '12 Grid', 'techkit' ),
                )
            )
        );

        // Banner background color
        $wp_customize->add_setting('ppf_bgcolor', 
            array(
                'default' => 'rgba(0, 0, 0, 0.5)', 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
                'active_callback' => 'rttheme_single_gallery_bgcolor_type_condition',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ppf_bgcolor',
            array(
                'label' => esc_html__('Form Background Color', 'techkit'),
                'settings' => 'ppf_bgcolor', 
                'priority' => 10, 
                'section' => 'pp_section', 
                'active_callback' => 'rttheme_single_gallery_bgcolor_type_condition',
            )
        ));

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Protected_Pass_Settings();
}
