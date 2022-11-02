<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'post-item grid-item' );

	$format = '';
	if ( get_post_format() !== false ) {
		$format = get_post_format();
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>

		<div class="post-wrapper">
			<?php get_template_part( 'loop/blog-masonry/format', $format ); ?>

			<div class="post-info">
				<?php if ( has_category() ) : ?>
					<div class="post-categories">
						<?php the_category( ', ' ); ?>
					</div>
				<?php endif; ?>

				<?php get_template_part( 'loop/blog/title' ); ?>

				<?php get_template_part( 'loop/blog-masonry/meta' ); ?>
			</div>
		</div>

	</div>
<?php endwhile; ?>
