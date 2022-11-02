<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


// Layout class

if ( TechkitTheme::$layout == 'full-width' ) {
	$techkit_layout_class = 'col-sm-12 col-xs-12';
	$col_class    = 'col-lg-4 col-md-6 col-sm-6 col-xs-12 no-equal-item';
}
else{
	$techkit_layout_class = 'col-lg-8 col-12';
	$col_class    = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 no-equal-item';
}

// Template

$template_bg_sty		= 'bg-light-accent100';
$gutters				= '';
$container_class		= 'container';
$iso					= 'no-equal-service rt-masonry-grid';

if ( TechkitTheme::$options['services_style'] == 'style1' ){
	$service_archive_layout = "service-default service-layout1";
	$template 				 = 'service-1';
}elseif( TechkitTheme::$options['services_style'] == 'style2' ){
	$service_archive_layout = "service-default service-layout2";
	$template 				 = 'service-2';
}else{
	$service_archive_layout = "service-default service-layout1";
	$template 				 = 'service-1';
}


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
			}?>
			<div class="<?php echo esc_attr( $service_archive_layout );?> <?php echo esc_attr( $techkit_layout_class );?>">
				<main id="main" class="site-main">
					<?php if ( have_posts() ) :?>
						<div class="row">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="rt-grid-item <?php echo esc_attr( $col_class );?>">
									<?php get_template_part( 'template-parts/content', $template ); ?>
								</div>
							<?php endwhile; ?>
						</div>

					<?php TechkitTheme_Helper::pagination(); ?>	
					<?php else:?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
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
