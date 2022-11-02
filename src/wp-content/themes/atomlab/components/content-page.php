<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Atomlab
 * @since   1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	the_content();

	Atomlab_Templates::page_links();
	?>
</article>
