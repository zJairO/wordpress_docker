<?php

class WPBakeryShortCode_TM_Image_Hotspot extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Image Hotspot', 'atomlab' ),
	'base'                      => 'tm_image_hotspot',
	'category'                  => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-blockquote',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'    => esc_html__( 'Image Hotspot', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'hotspot',
			'value'      => Atomlab_Helper::get_list_hotspot(),
		),
	),
) );
