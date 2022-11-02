<?php
/**
 * The template for displaying all single portfolio posts.
 *
 * @package TM Atomlab
 * @since   1.0
 */
$style = Atomlab_Helper::get_post_meta( 'portfolio_layout_style', '' );
if ( $style === '' ) {
	$style = Atomlab::setting( 'single_portfolio_style' );
}

if ( $style === 'fullscreen' ) {
	get_template_part( 'components/content-single-portfolio', 'fullscreen' );
} else {
	get_template_part( 'components/content-single-portfolio' );
}
