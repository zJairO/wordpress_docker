<?php
/**
 * Template Name: Blog 2
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// Layout class
if ( TechkitTheme::$layout == 'full-width' ) {
	$techkit_layout_class = 'col-sm-12 col-12';
}
else{
	$techkit_layout_class = TechkitTheme_Helper::has_active_widget();
}

$args = array(
	'post_type' => "post",
);

if ( get_query_var('paged') ) {
	$args['paged'] = get_query_var('paged');
}
elseif ( get_query_var('page') ) {
	$args['paged'] = get_query_var('page');
}
else {
	$args['paged'] = 1;
}

$query = new WP_Query( $args );

global $wp_query;
$wp_query = NULL;
$wp_query = $query;
 
get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row gutters-20">
			<?php if ( TechkitTheme::$layout == 'left-sidebar' ) { get_sidebar(); } ?>
			<div class="<?php echo esc_attr( $techkit_layout_class );?>">
				<main id="main" class="site-main">
					
					<?php if ( have_posts() ) :?>
						<?php
							echo '<div class="auto-clear">';
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-2', get_post_format() );
							endwhile;
							echo '</div>';
						?>
						<div class="mt50"><?php TechkitTheme_Helper::pagination();?></div>
					<?php else:?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
					
				</main>
			</div>
			<?php if ( TechkitTheme::$layout == 'right-sidebar' ) { get_sidebar(); }	?>
		</div>
	</div>
</div>
<?php get_footer(); ?>