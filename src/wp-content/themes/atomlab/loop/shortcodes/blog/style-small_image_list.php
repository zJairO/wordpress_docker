<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'grid-item', 'post-item' );

	$format = '';
	if ( get_post_format() !== false ) {
		$format = get_post_format();
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-item-wrap">
			<?php get_template_part( 'loop/blog-small-image/format', $format ); ?>

			<div class="post-info">
				<?php if ( has_category() ) : ?>
					<div class="post-categories">
						<?php the_category( ', ' ); ?>
					</div>
				<?php endif; ?>

				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-excerpt">
					<?php Atomlab_Templates::excerpt( array(
						'limit' => 21,
						'type'  => 'word',
					) ); ?>
				</div>

				<?php get_template_part( 'loop/blog/meta' ); ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>
