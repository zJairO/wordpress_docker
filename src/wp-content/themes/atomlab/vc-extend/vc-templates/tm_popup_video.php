<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $video = $poster = $image_size = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-popup-video-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-popup-video ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

wp_enqueue_style( 'lightgallery' );
wp_enqueue_script( 'lightgallery' );
?>
<?php if ( $video !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<a href="<?php echo esc_url( $video ); ?>">
			<?php if ( in_array( $style, array( 'poster-01', 'poster-02', 'poster-03' ) ) ) { ?>
				<div class="video-overlay-mark"></div>

				<div class="video-poster">
					<?php
					$image_url   = wp_get_attachment_url( $poster );
					$_image_args = array(
						'url'  => $image_url,
						'echo' => true,
					);
					if ( $image_size !== 'full' ) {
						$_sizes  = explode( 'x', $image_size );
						$_width  = $_sizes[0];
						$_height = $_sizes[1];

						$_image_args['width']  = $_width;
						$_image_args['height'] = $_height;
						$_image_args['crop']   = true;
					} else {
						$_image_args['crop']      = false;
						$_image_args['full_size'] = true;
					}

					Atomlab_Helper::get_lazy_load_image( $_image_args );
					?>
				</div>
				<div class="video-overlay">
					<div class="video-play">
						<i class="ion-ios-play"></i>
					</div>
				</div>
			<?php } else { ?>
				<div class="video-button">
					<div class="video-play">
						<i class="ion-ios-play"></i>
					</div>

					<?php if ( $video_text !== '' ) : ?>
						<div class="video-text"> <?php echo $video_text; ?></div>
					<?php endif; ?>
				</div>
			<?php } ?>
		</a>
	</div>
<?php endif;
