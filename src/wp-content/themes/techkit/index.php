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
$techkit_is_post_archive = is_home() || ( is_archive() && get_post_type() == 'post' ) ? true : false;

if ( is_post_type_archive( "techkit_service" ) || is_tax( "techkit_service_category" ) ) {
		get_template_part( 'template-parts/archive', 'service' );
	return;
}
if ( is_post_type_archive( "techkit_case" ) || is_tax( "techkit_case_category" ) ) {
		get_template_part( 'template-parts/archive', 'case' );
	return;
}
if ( is_post_type_archive( "techkit_team" ) || is_tax( "techkit_team_category" ) ) {
		get_template_part( 'template-parts/archive', 'team' );
	return;
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
			<div class="<?php echo esc_attr( $techkit_layout_class );?>">
				<main id="main" class="site-main">				
					<?php
					if ( have_posts() ) { ?>
						<?php
						if ( $techkit_is_post_archive && TechkitTheme::$options['blog_style'] == 'style1' ) {
							echo '<div class="row rt-masonry-grid">';
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-1', get_post_format() );
							endwhile;
							echo '</div>';
						} else if ( $techkit_is_post_archive && TechkitTheme::$options['blog_style'] == 'style2' ) {
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-2', get_post_format() );
							endwhile;
						} else if ( class_exists( 'Techkit_Core' ) ) {
							if ( is_tax( 'techkit_portfolio_category' ) ) {
								echo '<div class="row rt-masonry-grid">';
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content-1', get_post_format() );
								endwhile;
								echo '</div>';
							}							
						}
						else {
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-1', get_post_format() );
							endwhile;
						}

						?>
						<?php TechkitTheme_Helper::pagination(); ?>
						
					<?php } else {?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php } ?>					
				</main>
			</div>
			<?php
			if( TechkitTheme::$layout == 'right-sidebar' ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>