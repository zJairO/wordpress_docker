<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-feature post-thumbnail">
		<a href="<?php the_permalink(); ?>"
		   title="<?php the_title_attribute(); ?>">
			<?php
			$full_image_size = get_the_post_thumbnail_url( null, 'full' );
			Atomlab_Helper::get_lazy_load_image( array(
				'url'    => $full_image_size,
				'width'  => 420,
				'height' => 250,
				'crop'   => true,
				'echo'   => true,
				'alt'    => get_the_title(),
			) );
			?>
		</a>
	</div>
<?php } ?>
