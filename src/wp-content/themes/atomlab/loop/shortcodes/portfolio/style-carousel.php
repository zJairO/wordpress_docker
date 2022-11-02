<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'portfolio-item grid-item swiper-slide' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-item-wrapper">
			<div class="post-thumbnail-wrapper">
				<div class="post-thumbnail">
					<a href="<?php Atomlab_Portfolio::the_permalink(); ?>">
						<?php
						if ( has_post_thumbnail() ) { ?>
							<?php
							$full_image_size = get_the_post_thumbnail_url( null, 'full' );
							Atomlab_Helper::get_lazy_load_image( array(
								'url'    => $full_image_size,
								'width'  => 370,
								'height' => 560,
								'crop'   => true,
								'echo'   => true,
								'alt'    => get_the_title(),
							) );
							?>
						<?php } else {
							Atomlab_Templates::image_placeholder( 370, 560 );
						}
						?>
					</a>
				</div>
				<?php if ( $overlay_style !== '' ) : ?>
					<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>
