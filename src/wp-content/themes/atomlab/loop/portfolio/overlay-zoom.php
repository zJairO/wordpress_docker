<div class="post-overlay-content">
	<div class="post-overlay-content-inner">
		<div class="post-overlay-info">
			<h5 class="post-overlay-title">
				<a href="<?php Atomlab_Portfolio::the_permalink(); ?>"
				   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h5>
			<div class="post-overlay-categories">
				<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
			</div>
		</div>
	</div>
</div>
