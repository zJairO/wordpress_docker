<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
 
if ( is_404() ) {
	$techkit_title = TechkitTheme::$options['error_title'];
} else if ( is_search() ) {
	$techkit_title = esc_html__( 'Search Results for : ', 'techkit' ) . get_search_query();
} else if ( is_home() ) {
	if ( get_option( 'page_for_posts' ) ) {
		$techkit_title = get_the_title( get_option( 'page_for_posts' ) );
	}
	else {
		$techkit_title = apply_filters( 'theme_blog_title', esc_html__( 'All Posts', 'techkit' ) );
	}
} else if ( is_archive() ) {
	$techkit_title = get_the_archive_title();
} else if ( is_page() ) {
	$techkit_title = get_the_title();
} else if ( is_single() ) {
	$techkit_title = get_the_title();
}

if ( !empty( TechkitTheme::$options['post_banner_title'] ) ){
	$post_banner_title = TechkitTheme::$options['post_banner_title'];
} else {
	$post_banner_title = esc_html__( 'Our News' , 'techkit' );
}

?>
<?php if ( TechkitTheme::$has_banner === 1 || TechkitTheme::$has_banner === "on" ): ?>
	<div class="entry-banner">
		<div class="container">
			<div class="entry-banner-content">
				<?php if ( is_single() ) { ?>
				<h1 class="entry-title"><?php echo wp_kses( $techkit_title , 'alltext_allow' );?></h1>
				<?php } else if ( is_page() ) { ?>
					<h1 class="entry-title"><?php echo wp_kses( $techkit_title , 'alltext_allow' );?></h1>
				<?php } else { ?>
					<h1 class="entry-title"><?php echo wp_kses( $techkit_title , 'alltext_allow' );?></h1>
				<?php } ?>
				<?php if ( TechkitTheme::$has_breadcrumb == 1 ) { ?>
					<?php get_template_part( 'template-parts/content', 'breadcrumb' );?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php endif; ?>