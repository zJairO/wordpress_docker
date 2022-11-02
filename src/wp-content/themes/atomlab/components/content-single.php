<?php
/**
 * Template part for displaying single post pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Atomlab
 * @since   1.0
 */

$_post_title = Atomlab::setting( 'single_post_title_enable' );
$format      = '';
if ( get_post_format() !== false ) {
	$format = get_post_format();
}
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( in_array( $format, array( 'video', 'gallery', 'audio' ) ) ) : ?>

			<div class="entry-header">
				<?php if ( Atomlab::setting( 'single_post_categories_enable' ) === '1' && has_category() ) : ?>
					<div class="post-categories"><?php the_category( ', ' ); ?></div>
				<?php endif; ?>
				<?php if ( $_post_title === '1' ) : ?>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php endif; ?>
				<?php get_template_part( 'loop/blog-single/meta' ); ?>
			</div>
			<?php if ( Atomlab::setting( 'single_post_feature_enable' ) === '1' ) : ?>
				<?php get_template_part( 'loop/blog-single/format', $format ); ?>
			<?php endif; ?>
		<?php else : ?>
			<?php if ( Atomlab::setting( 'single_post_feature_enable' ) === '1' ) : ?>
				<?php get_template_part( 'loop/blog-single/format', $format ); ?>
			<?php endif; ?>
			<div class="entry-header">
				<?php if ( Atomlab::setting( 'single_post_categories_enable' ) === '1' && has_category() ) : ?>
					<div class="post-categories"><?php the_category( ', ' ); ?></div>
				<?php endif; ?>
				<?php if ( $_post_title === '1' ) : ?>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php endif; ?>
				<?php get_template_part( 'loop/blog-single/meta' ); ?>
			</div>
		<?php endif; ?>

		<div class="entry-content">
			<?php
			the_content( sprintf( /* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'atomlab' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

			Atomlab_Templates::page_links();
			?>
		</div>

		<div class="entry-footer">
			<div class="row row-xs-center">
				<div class="col-md-6">
					<?php if ( Atomlab::setting( 'single_post_tags_enable' ) === '1' && has_tag() ) : ?>
						<div class="post-tags">
							<span class="ion-ios-pricetags"></span>
							<?php the_tags( '', ', ', '' ); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-md-6">
					<?php if ( Atomlab::setting( 'single_post_share_enable' ) === '1' ) : ?>
						<?php Atomlab_Templates::post_sharing(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</article>
<?php
$author_desc = get_the_author_meta( 'description' );
if ( Atomlab::setting( 'single_post_author_box_enable' ) === '1' && ! empty( $author_desc ) ) {
	Atomlab_Templates::post_author();
}
