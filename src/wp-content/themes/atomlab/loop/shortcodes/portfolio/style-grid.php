<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'portfolio-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-item-wrapper">
			<div class="post-thumbnail-wrapper">
				<a href="<?php Atomlab_Portfolio::the_permalink(); ?>">
					<div class="post-thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php
							$image_url = get_the_post_thumbnail_url( null, 'full' );

							if ( $image_size !== '' ) {
								$_sizes  = explode( 'x', $image_size );
								$_width  = $_sizes[0];
								$_height = $_sizes[1];

								Atomlab_Helper::get_lazy_load_image( array(
									'url'    => $image_url,
									'width'  => $_width,
									'height' => $_height,
									'crop'   => true,
									'echo'   => true,
									'alt'    => get_the_title(),
								) );
							}
							?>
						<?php } else { ?>
							<?php Atomlab_Templates::image_placeholder( 480, 480 ); ?>
						<?php } ?>

					</div>
				</a>
				<?php if ( $overlay_style !== '' ) : ?>
					<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>
