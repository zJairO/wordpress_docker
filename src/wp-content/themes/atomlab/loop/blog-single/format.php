<?php if ( has_post_thumbnail() ) { ?>
	<?php
	global $atomlab_vars;
	$atomlab_thumbnail_w = 970;
	$atomlab_thumbnail_h = 9999;
	if ( $atomlab_vars->has_sidebar ) {
		$atomlab_thumbnail_w = 770;
	}

	$full_image_size = get_the_post_thumbnail_url( null, 'full' );
	?>
	<div class="post-feature post-thumbnail">
		<?php
		Atomlab_Helper::get_lazy_load_image( array(
			'url'    => $full_image_size,
			'width'  => $atomlab_thumbnail_w,
			'height' => $atomlab_thumbnail_h,
			'crop'   => false,
			'echo'   => true,
			'alt'    => get_the_title(),
		) );
		?>

	</div>
<?php } ?>
