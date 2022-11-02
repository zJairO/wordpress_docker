<?php

class WPBakeryShortCode_TM_Gmaps extends WPBakeryShortCode {

	public function convertAttributesToNewMarker( $atts ) {
		if ( isset( $atts['markers'] ) && strlen( $atts['markers'] ) > 0 ) {
			$markers = vc_param_group_parse_atts( $atts['markers'] );

			if ( ! is_array( $markers ) ) {
				$temp         = explode( ',', $atts['markers'] );
				$paramMarkers = array();

				foreach ( $temp as $marker ) {
					$data = explode( '|', $marker );

					$newMarker            = array();
					$newMarker['address'] = isset( $data[0] ) ? $data[0] : '';
					$newMarker['icon']    = isset( $data[1] ) ? $data[1] : '';
					$newMarker['title']   = isset( $data[2] ) ? $data[2] : '';
					$newMarker['info']    = isset( $data[3] ) ? $data[3] : '';

					$paramMarkers[] = $newMarker;
				}

				$atts['markers'] = urlencode( json_encode( $paramMarkers ) );

			}

			return $atts;
		}
	}
}

vc_map( array(
	'name'     => esc_html__( 'Google Maps', 'atomlab' ),
	'base'     => 'tm_gmaps',
	'icon'     => 'insight-i insight-i-map',
	'category' => ATOMLAB_VC_SHORTCODE_CATEGORY,
	'params'   => array(
		array(
			'heading'     => esc_html__( 'Height', 'atomlab' ),
			'description' => esc_html__( 'Enter map height (in pixels or %)', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'map_height',
			'value'       => '480',
		),
		array(
			'heading'     => esc_html__( 'Width', 'atomlab' ),
			'description' => esc_html__( 'Enter map width (in pixels or %)', 'atomlab' ),
			'type'        => 'textfield',
			'param_name'  => 'map_width',
			'value'       => '100%',
		),
		array(
			'heading'    => esc_html__( 'Button', 'atomlab' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
			'value'      => esc_html__( 'Button', 'atomlab' ),
		),
		array(
			'heading'     => esc_html__( 'Zoom Level', 'atomlab' ),
			'description' => esc_html__( 'Map zoom level', 'atomlab' ),
			'type'        => 'number',
			'param_name'  => 'zoom',
			'value'       => 16,
			'max'         => 17,
			'min'         => 0,
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'zoom_enable',
			'value'      => array(
				esc_html__( 'Enable mouse scroll wheel zoom', 'atomlab' ) => 'yes',
			),
		),
		array(
			'heading'     => esc_html__( 'Map Type', 'atomlab' ),
			'description' => esc_html__( 'Choose a map type', 'atomlab' ),
			'type'        => 'dropdown',
			'admin_label' => true,
			'param_name'  => 'map_type',
			'value'       => array(
				esc_html__( 'Roadmap', 'atomlab' )   => 'roadmap',
				esc_html__( 'Satellite', 'atomlab' ) => 'satellite',
				esc_html__( 'Hybrid', 'atomlab' )    => 'hybrid',
				esc_html__( 'Terrain', 'atomlab' )   => 'terrain',
			),
		),
		array(
			'heading'     => esc_html__( 'Map Style', 'atomlab' ),
			'description' => esc_html__( 'Choose a map style. This approach changes the style of the Roadmap types (base imagery in terrain and satellite views is not affected, but roads, labels, etc. respect styling rules)', 'atomlab' ),
			'type'        => 'image_radio',
			'admin_label' => true,
			'param_name'  => 'map_style',
			'value'       => array(
				'grayscale'               => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/greyscale.png',
					'title' => esc_attr__( 'Grayscale', 'atomlab' ),
				),
				'subtle_grayscale'        => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/subtle-grayscale.png',
					'title' => esc_attr__( 'Subtle Grayscale', 'atomlab' ),
				),
				'apple_paps_esque'        => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/apple-maps-esque.png',
					'title' => esc_attr__( 'Apple Maps-esque', 'atomlab' ),
				),
				'pale_dawn'               => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/pale-dawn.png',
					'title' => esc_attr__( 'Pale Dawn', 'atomlab' ),
				),
				'midnight_commander'      => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/midnight-commander.png',
					'title' => esc_attr__( 'Midnight Commander', 'atomlab' ),
				),
				'blue_water'              => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/blue-water.png',
					'title' => esc_attr__( 'Blue Water', 'atomlab' ),
				),
				'retro'                   => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/retro.png',
					'title' => esc_attr__( 'Retro', 'atomlab' ),
				),
				'paper'                   => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/paper.png',
					'title' => esc_attr__( 'Paper', 'atomlab' ),
				),
				'ultra_light_with_labels' => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/ultra-light-with-labels.png',
					'title' => esc_attr__( 'Ultra Light with Labels', 'atomlab' ),
				),
				'shades_of_grey'          => array(
					'url'   => ATOMLAB_THEME_IMAGE_URI . '/maps/shades-of-grey.png',
					'title' => esc_attr__( 'Shades Of Grey', 'atomlab' ),
				),
			),
			'std'         => 'ultra_light_with_labels',
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'overlay_enable',
			'value'      => array(
				esc_html__( 'Use overlay instead of marker items', 'atomlab' ) => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Overlay Style', 'atomlab' ),
			'type'       => 'dropdown',
			'param_name' => 'overlay_style',
			'value'      => array(
				esc_html__( 'Style 01', 'atomlab' ) => '01',
				esc_html__( 'Style 02', 'atomlab' ) => '02',
			),
			'std'        => '01',
		),
		array(
			'group'       => esc_html__( 'Markers', 'atomlab' ),
			'heading'     => esc_html__( 'Markers', 'atomlab' ),
			'description' => esc_html__( 'You can add multiple markers to the map', 'atomlab' ),
			'type'        => 'param_group',
			'param_name'  => 'markers',
			'value'       => urlencode( json_encode( array(
				array(
					'address' => '40.7590615,-73.969231',
				),
			) ) ),
			'params'      => array(
				array(
					'heading'     => esc_html__( 'Address or Coordinate', 'atomlab' ),
					'description' => sprintf( wp_kses( __( 'Enter address or coordinate. Find coordinates using the name and/or address of the place using <a href="%s" target="_blank">this simple tool here.</a>', 'atomlab' ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) ), esc_url( 'https://universimmedia.pagesperso-orange.fr/geo/loc.htm' ) ),
					'type'        => 'textfield',
					'param_name'  => 'address',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Marker icon', 'atomlab' ),
					'description' => esc_html__( 'Choose a image for marker address', 'atomlab' ),
					'type'        => 'attach_image',
					'param_name'  => 'icon',
				),
				array(
					'heading'    => esc_html__( 'Marker Title', 'atomlab' ),
					'type'       => 'textfield',
					'param_name' => 'title',
				),
				array(
					'heading'     => esc_html__( 'Marker Information', 'atomlab' ),
					'description' => esc_html__( 'Content for info window', 'atomlab' ),
					'type'        => 'textarea',
					'param_name'  => 'info',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Google Maps API Key (optional)', 'atomlab' ),
			'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button. If you leave it empty, the API Key will be put in by default from our key.', 'atomlab' ), array(
				'a'      => array(
					'href'   => array(),
					'target' => array(),
				),
				'strong' => array(),
			) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
			'type'        => 'textfield',
			'param_name'  => 'api_key',
		),
	),
) );
