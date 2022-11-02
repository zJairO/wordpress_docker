<?php
while ( $atomlab_query->have_posts() ) :
	$atomlab_query->the_post();
	$classes = array( 'post-item grid-item' );

	$_width  = 370;
	$_height = 220;
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>

		<div class="post-wrapper">

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

			<div class="post-info">
				<?php get_template_part( 'loop/blog/category', 'background' ); ?>

				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-meta">
					<?php if ( function_exists( 'the_views' ) ) : ?>
						<div class="post-view meta-item">
							<span class="ion-eye"></span>
							<?php the_views(); ?>
						</div>
					<?php endif; ?>

					<span class="post-likes meta-item">
						<?php
						$atomlab_post_like = new Atomlab_Post_Like();
						$atomlab_post_like->get_simple_likes_button( get_the_ID() );
						?>
					</span>
				</div>

			</div>
		</div>

	</div>
<?php endwhile; ?>
