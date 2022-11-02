<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;
use radiustheme\techkit\Customizer\Controls\Customizer_Separator_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Color_Settings extends TechkitTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_color_controls' ) );
	}

    public function register_color_controls( $wp_customize ) {	
	
		// Main Color
		$wp_customize->add_setting('primary_color', 
            array(
                'default' => $this->defaults['primary_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color',
            array(
                'label' => esc_html__('Primary Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		$wp_customize->add_setting('secondary_color', 
            array(
                'default' => $this->defaults['secondary_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color',
            array(
                'label' => esc_html__('Secondary Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));		
				
		$wp_customize->add_setting('body_color', 
            array(
                'default' => $this->defaults['body_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_color',
            array(
                'label' => esc_html__('Body Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		// Separator
        $wp_customize->add_setting('separator_color', array(
            'default'           => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Separator_Control($wp_customize, 'separator_color', 
			array(
				'settings' => 'separator_color',
				'section'  => 'color_section',
			)
		));
		
		// Menu Color
		$wp_customize->add_setting('menu_color', 
            array(
                'default' => $this->defaults['menu_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color',
            array(
                'label' => esc_html__('Menu Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		$wp_customize->add_setting('menu_hover_color', 
            array(
                'default' => $this->defaults['menu_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_hover_color',
            array(
                'label' => esc_html__('Menu Hover Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		$wp_customize->add_setting('menu_color_tr', 
            array(
                'default' => $this->defaults['menu_color_tr'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color_tr',
            array(
                'label' => esc_html__('Transparent Menu Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		// Separator
        $wp_customize->add_setting('separator_sub_color', array(
            'default'           => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Separator_Control($wp_customize, 'separator_sub_color', 
			array(
				'settings' => 'separator_sub_color',
				'section'  => 'color_section',
			)
		));
		
		// Sub menu color		
		$wp_customize->add_setting('submenu_color', 
            array(
                'default' => $this->defaults['submenu_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_color',
            array(
                'label' => esc_html__('Submenu Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		$wp_customize->add_setting('submenu_hover_color', 
            array(
                'default' => $this->defaults['submenu_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_hover_color',
            array(
                'label' => esc_html__('Submenu Hover Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		$wp_customize->add_setting('submenu_bgcolor', 
            array(
                'default' => $this->defaults['submenu_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_bgcolor',
            array(
                'label' => esc_html__('Submenu Background Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));
		
		$wp_customize->add_setting('submenu_hover_bgcolor', 
            array(
                'default' => $this->defaults['submenu_hover_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_hover_bgcolor',
            array(
                'label' => esc_html__('Submenu Hover Background Color', 'techkit'),
                'section' => 'color_section', 
            )
        ));

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Color_Settings();
}
