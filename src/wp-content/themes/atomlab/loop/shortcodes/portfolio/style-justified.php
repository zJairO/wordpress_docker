<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'portfolio-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>

		<a href="<?php Atomlab_Portfolio::the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'insight-grid-masonry' );
			} else {
				Atomlab_Templates::image_placeholder( 600, 600 );
			}
			?>
		</a>
		<div class="post-thumbnail">
			<?php if ( $overlay_style !== '' ) : ?>
				<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endwhile; ?>
