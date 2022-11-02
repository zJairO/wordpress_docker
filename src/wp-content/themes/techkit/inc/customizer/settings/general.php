<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\techkit\Customizer\Settings;

use radiustheme\techkit\Customizer\TechkitTheme_Customizer;
use radiustheme\techkit\Customizer\Controls\Customizer_Heading_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Sortable_Repeater_Control;
use radiustheme\techkit\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class TechkitTheme_General_Settings extends TechkitTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_general_controls' ) );
	}

    public function register_general_controls( $wp_customize ) {
        /**
         * Heading
         */
        $wp_customize->add_setting('logo_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'logo_heading', array(
            'label' => __( 'Site Logo', 'techkit' ),
            'section' => 'general_section',
        )));

        $wp_customize->add_setting( 'logo',
            array(
                'default' => $this->defaults['logo'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'logo',
            array(
                'label' => __( 'Main Logo', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'general_section',
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

        $wp_customize->add_setting( 'logo_light',
            array(
                'default' => $this->defaults['logo_light'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'logo_light',
            array(
                'label' => __( 'Logo Dark', 'techkit' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'techkit' ),
                'section' => 'general_section',
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

        /**
         * Heading
         */
        $wp_customize->add_setting('site_switching', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'site_switching', array(
            'label' => __( 'Site Switch Control', 'techkit' ),
            'section' => 'general_section',
        )));
		
		$wp_customize->add_setting( 'container_width',
            array(
                'default' => $this->defaults['container_width'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'container_width',
            array(
                'label' => __( 'Container width( Bootstrap Grid )', 'techkit' ),
                'section' => 'general_section',
                'type' => 'select',
                'choices' => array(
                    '1350' => esc_html__( '1350px', 'techkit' ),
					'1240' => esc_html__( '1240px', 'techkit' ),
					'1200' => esc_html__( '1200px', 'techkit' ),
					'1140' => esc_html__( '1140px', 'techkit' ),
                ),
            )
        );
		
		// Display No Preview Image
        $wp_customize->add_setting( 'display_no_preview_image',
            array(
                'default' => $this->defaults['display_no_preview_image'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'display_no_preview_image',
            array(
                'label' => __( 'Display No Preview Image on Blog', 'techkit' ),
                'section' => 'general_section',
            )
        ) );
		
		// Display No Preview Image
        $wp_customize->add_setting( 'display_no_prev_img_related_post',
            array(
                'default' => $this->defaults['display_no_prev_img_related_post'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'display_no_prev_img_related_post',
            array(
                'label' => __( 'Display No Preview Image on Related Post', 'techkit' ),
                'section' => 'general_section',
            )
        ) );
		
		// Switch for back to top button
        $wp_customize->add_setting( 'back_to_top',
            array(
                'default' => $this->defaults['back_to_top'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'back_to_top',
            array(
                'label' => __( 'Back to Top Arrow', 'techkit' ),
                'section' => 'general_section',
            )
        ) );

        // Add our Preloader
        $wp_customize->add_setting('preloader',
			array(
			 'default'           => $this->defaults['preloader'],
			 'transport'         => 'refresh',
			 'sanitize_callback' => 'rttheme_switch_sanitization',
			)
        );
        $wp_customize->add_control(new Customizer_Switch_Control($wp_customize, 'preloader',
            array(
                'label'   => esc_html__('Preloader', 'techkit'),
                'section' => 'general_section',
            )
        ));
        $wp_customize->add_setting('preloader_image',
			array(
			  'default'           => $this->defaults['preloader_image'],
			  'transport'         => 'refresh',
			  'sanitize_callback' => 'absint',
			  'active_callback'   => 'rttheme_is_preloader_enabled',  
			)
        );
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'preloader_image',
			array(
				'label'         => esc_html__('Preloader Image', 'techkit'),
				'description'   => esc_html__('This is the description for the Media Control', 'techkit'),
				'section'       => 'general_section',
				'active_callback'   => 'rttheme_is_preloader_enabled',  
				'mime_type'     => 'image',
				'button_labels' => array(
					'select'       => esc_html__('Select File', 'techkit'),
					'change'       => esc_html__('Change File', 'techkit'),
					'default'      => esc_html__('Default', 'techkit'),
					'remove'       => esc_html__('Remove', 'techkit'),
					'placeholder'  => esc_html__('No file selected', 'techkit'),
					'frame_title'  => esc_html__('Select File', 'techkit'),
					'frame_button' => esc_html__('Choose File', 'techkit'),
				)
			)
        ));
        $wp_customize->add_setting('preloader_bg_color',
			array(
				'default'           => $this->defaults['preloader_bg_color'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'rttheme_hex_rgba_sanitization',
				'active_callback'   => 'rttheme_is_preloader_enabled',  
			)
        );
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'preloader_bg_color',
			array(
				'label'   => esc_html__('Preloader Background color', 'techkit'),
				'section' => 'general_section',
				'active_callback'   => 'rttheme_is_preloader_enabled',  
			)
		));	
		
        /**
         * Heading
         */
        $wp_customize->add_setting('social_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'social_heading', array(
            'label' => __( 'Contact And Social', 'techkit' ),
            'section' => 'general_section',
        )));
		
		// Contact
		$wp_customize->add_setting( 'address_label',
            array(
                'default' => $this->defaults['address_label'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'address_label',
            array(
                'label' => __( 'Address Label', 'techkit' ),
                'section' => 'general_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'phone',
            array(
                'default' => $this->defaults['phone'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'phone',
            array(
                'label' => __( 'Phone', 'techkit' ),
                'section' => 'general_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'email',
            array(
                'default' => $this->defaults['email'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'email',
            array(
                'label' => __( 'Email', 'techkit' ),
                'section' => 'general_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'openhour',
            array(
                'default' => $this->defaults['openhour'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'openhour',
            array(
                'label' => __( 'Opening Hour', 'techkit' ),
                'section' => 'general_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'address',
            array(
                'default' => $this->defaults['address'],
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_textarea_field',
            )
        );
        $wp_customize->add_control( 'address',
            array(
                'label' => __( 'Address', 'techkit' ),
                'section' => 'general_section',
                'type' => 'textarea',
            )
        );

        $wp_customize->add_setting( 'top_bar_text',
            array(
                'default' => $this->defaults['top_bar_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_textarea_field',
            )
        );
        $wp_customize->add_control( 'top_bar_text',
            array(
                'label' => __( 'Top Bar Text', 'techkit' ),
                'section' => 'general_section',
                'type' => 'textarea',
            )
        );


		$wp_customize->add_setting( 'sidetext_label',
            array(
                'default' => $this->defaults['sidetext_label'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'sidetext_label',
            array(
                'label' => __( 'Offcanvus Sidebar Text Label', 'techkit' ),
                'section' => 'general_section',
                'type' => 'text',
            )
        );
		$wp_customize->add_setting( 'sidetext',
            array(
                'default' => $this->defaults['sidetext'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'sidetext',
            array(
                'label' => __( 'Offcanvus Sidebar Text', 'techkit' ),
                'section' => 'general_section',
                'type' => 'text',
            )
        );

        // Social link
		$wp_customize->add_setting( 'social_label',
            array(
                'default' => $this->defaults['social_label'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'social_label',
            array(
                'label' => __( 'Social Label', 'techkit' ),
                'section' => 'general_section',
                'type' => 'text',
            )
        );
        $wp_customize->add_setting( 'social_facebook',
            array(
                'default' => $this->defaults['social_facebook'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_facebook',
            array(
                'label' => __( 'Facebook', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
        $wp_customize->add_setting( 'social_twitter',
            array(
                'default' => $this->defaults['social_twitter'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_twitter',
            array(
                'label' => __( 'Twitter', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
        $wp_customize->add_setting( 'social_gplus',
            array(
                'default' => $this->defaults['social_gplus'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_gplus',
            array(
                'label' => __( 'Google Plus', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
        $wp_customize->add_setting( 'social_linkedin',
            array(
                'default' => $this->defaults['social_linkedin'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_linkedin',
            array(
                'label' => __( 'Linkedin', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
        $wp_customize->add_setting( 'social_behance',
            array(
                'default' => $this->defaults['social_behance'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_behance',
            array(
                'label' => __( 'Behance', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
        $wp_customize->add_setting( 'social_dribbble',
            array(
                'default' => $this->defaults['social_dribbble'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_dribbble',
            array(
                'label' => __( 'Dribbble', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
        $wp_customize->add_setting( 'social_youtube',
            array(
                'default' => $this->defaults['social_youtube'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_youtube',
            array(
                'label' => __( 'Youtube', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
		$wp_customize->add_setting( 'social_pinterest',
            array(
                'default' => $this->defaults['social_pinterest'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_pinterest',
            array(
                'label' => __( 'Pinterest', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
		$wp_customize->add_setting( 'social_instagram',
            array(
                'default' => $this->defaults['social_instagram'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_instagram',
            array(
                'label' => __( 'Instagram', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
		$wp_customize->add_setting( 'social_skype',
            array(
                'default' => $this->defaults['social_skype'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_skype',
            array(
                'label' => __( 'Skype', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
		$wp_customize->add_setting( 'social_rss',
            array(
                'default' => $this->defaults['social_rss'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_rss',
            array(
                'label' => __( 'RSS', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );
		
		$wp_customize->add_setting( 'social_snapchat',
            array(
                'default' => $this->defaults['social_snapchat'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_url_sanitization',
            )
        );
        $wp_customize->add_control( 'social_snapchat',
            array(
                'label' => __( 'Snapchat', 'techkit' ),
                'section' => 'general_section',
                'type' => 'url',
            )
        );

    }

}

/**
 * Initialise our Customizer settings only when they're required  
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new TechkitTheme_General_Settings();
}
