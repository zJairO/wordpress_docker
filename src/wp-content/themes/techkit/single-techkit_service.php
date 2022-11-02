<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// Layout class
if ( TechkitTheme::$layout == 'full-width' ) {
	$techkit_layout_class = 'col-sm-12 col-12';
} else {
	$techkit_layout_class = TechkitTheme_Helper::has_active_widget();
}
$service_layout_ops = get_post_meta( get_the_ID() ,'techkit_service_style', true );
$f_layout = ( empty( $service_layout ) || ( $service_layout  == 'default' ) ) ? $service_layout_ops : $service_layout;

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
		<div class="row">
			<?php
			if ( TechkitTheme::$layout == 'left-sidebar' ) {
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('techkit_service');
				}
			}
			?>
			<div class="<?php echo esc_attr( $techkit_layout_class );?>">
				<main id="main" class="site-main <?php echo esc_attr( $f_layout );?>">						
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content-single', 'service' );?>
					<?php endwhile; ?>
				</main>
			</div>
			<?php
			if ( TechkitTheme::$layout == 'right-sidebar' ) {				
				if ( is_active_sidebar( 'service-sidebar' ) ) {
					get_sidebar('techkit_service');
				}
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
