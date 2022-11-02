<?php if ( has_category() ) : ?>
	<div class="post-categories">
		<?php
		$cat_ids = get_the_category();

		foreach ( $cat_ids as $term ) {
			$link       = get_term_link( $term->term_id );
			$background = Atomlab_Post::get_category_color( $term->term_id );

			$inline_css = $background !== '' ? 'style="color: ' . $background . ';"' : '';
			?>
			<a href="<?php echo esc_url( $link ); ?>" <?php echo $inline_css; ?>>
				<?php echo esc_html( $term->name ); ?>
			</a>
			<?php
		}
		?>
	</div>
<?php endif; ?>
