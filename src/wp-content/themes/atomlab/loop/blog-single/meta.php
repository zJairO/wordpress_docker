<div class="post-meta">
	<?php if ( Atomlab::setting( 'single_post_author_enable' ) === '1' ) : ?>
		<div class="post-author-meta">
			<span class="ion-ios-person"></span>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
		</div>
	<?php endif; ?>

	<?php if ( Atomlab::setting( 'single_post_view_enable' ) === '1' && function_exists( 'the_views' ) ) : ?>
		<div class="post-view">
			<span class="ion-eye"></span>
			<?php the_views(); ?>
		</div>
	<?php endif; ?>

	<?php if ( Atomlab::setting( 'single_post_like_enable' ) === '1' ) : ?>
		<?php Atomlab_Templates::post_like(); ?>
	<?php endif; ?>

	<?php if ( Atomlab::setting( 'single_post_date_enable' ) === '1' ) : ?>
		<div class="post-date">
			<span class="ion-android-alarm-clock"></span>
			<?php echo get_the_date(); ?></div>
	<?php endif; ?>
</div>
