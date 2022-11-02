<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;
use radiustheme\techkit\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Image_Radio_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_Woo_Product_Settings extends TechkitTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_woo_product_controls' ) );
	}

    public function register_woo_product_controls( $wp_customize ) {
		
		// Wishlist
        $wp_customize->add_setting( 'wc_product_wishlist_icon',
            array(
                'default' => $this->defaults['wc_product_wishlist_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'wc_product_wishlist_icon',
            array(
                'label' => __( 'Wishlist', 'techkit' ),
                'section' => 'product_layout_section',
            )
        ) );
		
        // Compare
        $wp_customize->add_setting( 'wc_product_compare_icon',
            array(
                'default' => $this->defaults['wc_product_compare_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'wc_product_compare_icon',
            array(
                'label' => __( 'Compare', 'techkit' ),
                'section' => 'product_layout_section',
            )
        ) );
		
        // Compare
        $wp_customize->add_setting( 'wc_product_quickview_icon',
            array(
                'default' => $this->defaults['wc_product_quickview_icon'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'wc_product_quickview_icon',
            array(
                'label' => __( 'Quickview', 'techkit' ),
                'section' => 'product_layout_section',
            )
        ) );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_Woo_Product_Settings();
}
