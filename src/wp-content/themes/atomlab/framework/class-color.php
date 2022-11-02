<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Atomlab_Color' ) ) {
	class Atomlab_Color {

		public static function hex2rgba( $color, $opacity = false ) {
			$default = 'rgb(0,0,0)';

			//Return default if no color provided.
			if ( empty( $color ) ) {
				return $default;
			}

			//Sanitize $color if "#" is provided.
			if ( $color[0] == '#' ) {
				$color = substr( $color, 1 );
			}

			//Check if color has 6 or 3 characters and get values.
			if ( strlen( $color ) == 6 ) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}

			//Convert hexdec to rgb.
			$rgb = array_map( 'hexdec', $hex );

			//Check if opacity is set(rgba or rgb).
			if ( $opacity ) {
				if ( abs( $opacity ) > 1 ) {
					$opacity = 1.0;
				}
				$output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
			} else {
				$output = 'rgb(' . implode( ",", $rgb ) . ')';
			}

			//Return rgb(a) color string.
			return $output;
		}

		/**
		 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
		 *
		 * @param $hex     string colour as hexadecimal (with or without hash);
		 * @param $percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
		 *
		 * @return string Lightened/Darken colour as hexadecimal (with hash);
		 */
		public static function luminance( $hex, $percent ) {

			// Validate hex string.
			$hex     = preg_replace( '/[^0-9a-f]/i', '', $hex );
			$new_hex = '#';

			if ( strlen( $hex ) < 6 ) {
				$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
			}

			// Convert to decimal and change luminosity.
			for ( $i = 0; $i < 3; $i ++ ) {
				$dec     = hexdec( substr( $hex, $i * 2, 2 ) );
				$dec     = min( max( 0, $dec + $dec * $percent ), 255 );
				$new_hex .= str_pad( dechex( $dec ), 2, 0, STR_PAD_LEFT );
			}

			return $new_hex;
		}
	}
}
