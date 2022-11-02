<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TM Atomlab
 * @since   1.0
 */
get_header();

$page_sidebar_position = Atomlab_Helper::get_post_meta( 'page_sidebar_position', 'default' );
$page_sidebar1         = Atomlab_Helper::get_post_meta( 'page_sidebar_1', 'default' );
$page_sidebar2         = Atomlab_Helper::get_post_meta( 'page_sidebar_2', 'default' );

if ( $page_sidebar1 === 'default' ) {
	$page_sidebar1 = Atomlab::setting( 'post_page_sidebar_1' );
}

if ( $page_sidebar2 === 'default' ) {
	$page_sidebar2 = Atomlab::setting( 'post_page_sidebar_2' );
}

if ( $page_sidebar_position === 'default' ) {
	$page_sidebar_position = Atomlab::setting( 'post_page_sidebar_position' );
}
?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'components/content', 'single' );

						if ( Atomlab::setting( 'single_post_pagination_enable' ) === '1' ) {
							Atomlab_Templates::post_nav_links();
						}

						if ( Atomlab::setting( 'single_post_related_enable' ) ) {
							get_template_part( 'components/content', 'single-related-posts' );
						}

						// If comments are open or we have at least one comment, load up the comment template.
						if ( Atomlab::setting( 'single_post_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>

				<?php Atomlab_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer();
