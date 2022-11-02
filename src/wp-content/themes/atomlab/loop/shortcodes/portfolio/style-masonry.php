<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();

	$classes = array( 'portfolio-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-item-wrapper">
			<a href="<?php Atomlab_Portfolio::the_permalink(); ?>">
				<div class="post-thumbnail">
					<?php
					if ( has_post_thumbnail() ) { ?>
						<?php
						$full_image_size = get_the_post_thumbnail_url( null, 'full' );
						Atomlab_Helper::get_lazy_load_image( array(
							'url'    => $full_image_size,
							'width'  => 480,
							'height' => 9999,
							'crop'   => false,
							'echo'   => true,
							'alt'    => get_the_title(),
						) );
						?>
					<?php } else {
						Atomlab_Templates::image_placeholder( 480, 480 );
					}
					?>
				</div>
			</a>

			<?php if ( $overlay_style !== '' ) : ?>
				<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endwhile; ?>
