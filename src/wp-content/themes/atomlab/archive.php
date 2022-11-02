<?php
/**
 * The template for displaying archive pages.
 *
 * @link     https://codex.wordpress.org/Template_Hierarchy
 *
 * @package  TM Atomlab
 * @since    1.0
 */
get_header();

$page_sidebar_position = Atomlab::setting( 'blog_archive_page_sidebar_position' );
$page_sidebar1         = Atomlab::setting( 'blog_archive_page_sidebar_1' );
$page_sidebar2         = Atomlab::setting( 'blog_archive_page_sidebar_2' );
?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content">
					<?php get_template_part( 'components/content', 'blog' ); ?>
				</div>

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();
