<?php

class WPBakeryShortCode_TM_Hotspot_Content extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Image Hotspot Content', 'atomlab' ),
	'base'                      => 'tm_hotspot_content',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-blockquote',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Heading', 'atomlab' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
		),

		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Text', 'atomlab' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
	),
) );
