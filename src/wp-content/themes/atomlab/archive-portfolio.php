<?php
/**
 * The template for displaying archive portfolio pages.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Atomlab
 * @since   1.0
 */
get_header();

$page_sidebar_position = Atomlab::setting( 'portfolio_archive_page_sidebar_position' );
$page_sidebar1         = Atomlab::setting( 'portfolio_archive_page_sidebar_1' );
$page_sidebar2         = Atomlab::setting( 'portfolio_archive_page_sidebar_2' );

$style         = Atomlab::setting( 'archive_portfolio_style' );
$columns       = Atomlab::setting( 'archive_portfolio_columns' );
$gutter        = Atomlab::setting( 'archive_portfolio_gutter' );
$image_size    = Atomlab::setting( 'archive_portfolio_thumbnail_size' );
$overlay_style = Atomlab::setting( 'archive_portfolio_overlay_style' );
$animation     = Atomlab::setting( 'archive_portfolio_animation' );
?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content">
					<?php if ( have_posts() ) : ?>
						<?php
						$args = array();

						$args[] = 'style="' . $style . '"';
						$args[] = 'columns="' . $columns . '"';
						$args[] = 'gutter="' . $gutter . '"';
						$args[] = 'image_size="' . $image_size . '"';
						$args[] = 'overlay_style="' . $overlay_style . '"';
						$args[] = 'animation="' . $animation . '"';
						$args[] = 'pagination="pagination"';
						$args[] = 'pagination_align="center"';
						$args[] = 'filter_enable=""';
						$args[] = 'main_query="1"';

						$shortcode_string = '[tm_portfolio ' . implode( ' ', $args ) . ']';

						echo do_shortcode( $shortcode_string );
						?>
					<?php else :
						get_template_part( 'components/content', 'none' );
					endif; ?>
				</div>

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();
