<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Atomlab
 * @since   1.0
 */

$style = Atomlab::setting( 'blog_archive_style' );

if ( have_posts() ) :
	global $wp_query;
	$atomlab_query = $wp_query;
	$count         = $atomlab_query->post_count;
	$classes       = array(
		'tm-blog',
		"style-$style",
	);
	$grid_classes  = array( 'tm-grid' );

	?>
	<div class="tm-grid-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $grid_classes ) ); ?>"
			<?php
			if ( $style === 'list' ) {
				echo 'data-grid-has-gallery="true"';
			}
			?>
		>
			<?php
			set_query_var( 'atomlab_query', $atomlab_query );

			get_template_part( 'loop/shortcodes/blog/style', $style );
			?>
		</div>
		<div class="tm-grid-pagination">
			<?php Atomlab_Templates::paging_nav(); ?>
		</div>
	</div>
<?php else : get_template_part( 'components/content', 'none' ); ?>
<?php endif; ?>
