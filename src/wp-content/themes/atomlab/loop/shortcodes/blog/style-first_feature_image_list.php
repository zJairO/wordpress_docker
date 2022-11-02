<?php
$c = 1;

while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'post-item grid-item' );

	$_width  = 370;
	$_height = 220;

	if ( $c === 1 ) {
		$classes[] = 'first-item';
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>

		<div class="post-wrapper">

			<?php if ( $c === 1 ): ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post-feature post-thumbnail">
						<a href="<?php the_permalink(); ?>"
						   title="<?php the_title_attribute(); ?>">
							<?php
							$full_image_size = get_the_post_thumbnail_url( null, 'full' );
							Atomlab_Helper::get_lazy_load_image( array(
								'url'    => $full_image_size,
								'width'  => $_width,
								'height' => $_height,
								'crop'   => true,
								'echo'   => true,
								'alt'    => get_the_title(),
							) );
							?>
						</a>
					</div>
				<?php } ?>
			<?php endif; ?>

			<div class="post-info">
				<?php get_template_part( 'loop/blog/category', 'color' ); ?>

				<?php get_template_part( 'loop/blog/title' ); ?>
			</div>
		</div>

	</div>

	<?php $c ++; ?>
<?php endwhile; ?>
