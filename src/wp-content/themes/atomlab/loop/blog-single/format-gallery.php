<?php
$post_options = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_gallery'] ) ) {
	$gallery = $post_options['post_gallery'];

	global $atomlab_vars;
	$atomlab_thumbnail_w = 970;
	$atomlab_thumbnail_h = 650;
	if ( $atomlab_vars->has_sidebar ) {
		$atomlab_thumbnail_w = 770;
		$atomlab_thumbnail_h = 400;
	}
	?>
	<div class="post-feature post-gallery tm-swiper" data-pagination="1" data-loop="1">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ( $gallery as $image ) { ?>
					<div class="swiper-slide">
						<?php
						$full_image_size = wp_get_attachment_url( $image['id'] );
						Atomlab_Helper::get_lazy_load_image( array(
							'url'    => $full_image_size,
							'width'  => $atomlab_thumbnail_w,
							'height' => $atomlab_thumbnail_h,
							'crop'   => true,
							'echo'   => true,
							'alt'    => get_the_title(),
						) );
						?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
