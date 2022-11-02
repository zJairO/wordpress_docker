<?php

class WPBakeryShortCode_TM_Group extends WPBakeryShortCodesContainer {

}

vc_map( array(
	'name'                    => esc_html__( 'Group', 'atomlab' ),
	'base'                    => 'tm_group',
	'content_element'         => true,
	'show_settings_on_create' => false,
	'is_container'            => true,
	'category'                => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                    => 'insight-i insight-i-pricing-group',
	'js_view'                 => 'VcColumnView',
	'params'                  => array(
		Atomlab_VC::extra_class_field(),
	),
) );

