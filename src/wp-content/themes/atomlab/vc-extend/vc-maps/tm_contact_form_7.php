<?php

class WPBakeryShortCode_TM_Contact_Form_7 extends WPBakeryShortCode {

}

/**
 * Add Shortcode To Visual Composer
 */
$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

$contact_forms = array();
if ( $cf7 ) {
	foreach ( $cf7 as $cform ) {
		$contact_forms[ $cform->post_title ] = $cform->ID;
	}
} else {
	$contact_forms[ esc_html__( 'No contact forms found', 'atomlab' ) ] = 0;
}

vc_map( array(
	'name'                      => esc_html__( 'Contact Form 7', 'atomlab' ),
	'base'                      => 'tm_contact_form_7',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-contact-form-7',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Select contact form', 'atomlab' ),
			'param_name'  => 'id',
			'value'       => $contact_forms,
			'save_always' => true,
			'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'atomlab' ),
		),
		array(
			'heading'     => esc_html__( 'Form Skin', 'atomlab' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'atomlab' ) => '',
				esc_html__( 'White', 'atomlab' )   => 'white',
				esc_html__( 'Light', 'atomlab' )   => 'light',
			),
			'std'         => '',
		),
		Atomlab_VC::extra_class_field(),
	),
) );
