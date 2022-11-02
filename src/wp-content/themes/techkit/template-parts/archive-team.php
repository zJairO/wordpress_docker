<?php
/**
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

$iso						= 'no-equal-gallery';

if ( TechkitTheme::$options['team_archive_style'] == 'style1' ){
	$team_archive_layout 		= "team-default team-multi-layout-1 team-grid-style1";
	$template 				 	= 'team-1';
}elseif( TechkitTheme::$options['team_archive_style'] == 'style2' ){
	$team_archive_layout 		= "team-default team-multi-layout-2 team-grid-style1";
	$template 				 	= 'team-2';
}else{
	$team_archive_layout 		= "team-default team-multi-layout-1 team-grid-style1";
	$template 				 	= 'team-1';
}

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">	
		<div class="row">
			<?php
				if ( TechkitTheme::$layout == 'left-sidebar' ) {
					get_sidebar();
				}
			?>
			<div class="<?php echo esc_attr( $team_archive_layout );?> <?php echo esc_attr( $techkit_layout_class );?>">
				<main id="main" class="site-main">	
					<?php if ( have_posts() ) :?>
						<div class="row <?php echo esc_attr( $iso );?>">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
				if( TechkitTheme::$layout == 'right-sidebar' ){				
					get_sidebar();
				}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
