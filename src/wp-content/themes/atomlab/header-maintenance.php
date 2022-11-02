<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  TM Atomlab
 * @since    1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php Atomlab::body_attributes(); ?>>
<?php get_template_part( 'components/preloader' ); ?>
<div id="page" class="site">
	<div class="content-wrapper">
		<?php Atomlab_Templates::top_bar(); ?>
		<?php Atomlab_Templates::slider( 'above' ); ?>
		<?php Atomlab_Templates::header( '03' ); ?>
		<?php Atomlab_Templates::slider( 'below' ); ?>
