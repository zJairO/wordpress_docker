<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'post-item grid-item swiper-slide' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-feature-overlay">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-feature"
				     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
				</div>
			<?php } ?>
			<div class="post-overlay">

			</div>
		</div>
		<div class="post-info">
			<?php get_template_part( 'loop/blog/title' ); ?>
			<?php get_template_part( 'loop/blog/meta' ); ?>
			<?php get_template_part( 'loop/blog/excerpt' ); ?>
			<div class="post-footer">
				<?php get_template_part( 'loop/blog/readmore' ); ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>
