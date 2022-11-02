<div class="post-meta">
	<div class="post-author-meta">
		<span class="ion-ios-person"></span>
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
	</div>

	<?php if ( function_exists( 'the_views' ) ) : ?>
		<div class="post-view">
			<span class="ion-eye"></span>
			<?php the_views(); ?>
		</div>
	<?php endif; ?>

	<?php Atomlab_Templates::post_like(); ?>

	<div class="post-date">
		<span class="ion-android-alarm-clock"></span>
		<?php echo get_the_date(); ?></div>

	<?php if ( is_sticky() ) : ?>
		<div class="post-sticky">
			<span class="ion-flash"></span>
			<?php esc_html_e( 'Sticky Post', 'atomlab' ); ?></div>
	<?php endif; ?>
</div>
