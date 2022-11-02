<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = TechkitTheme_Helper::nav_menu_args();
$techkit_socials = TechkitTheme_Helper::socials();
// Logo

if( !empty( TechkitTheme::$options['logo'] ) ) {
	$logo_dark = wp_get_attachment_image( TechkitTheme::$options['logo'], 'full' );
	$techkit_dark_logo = $logo_dark;
}else {
	$techkit_dark_logo = "<img width='175' height='41' src='" . TECHKIT_IMG_URL . 'logo-dark.svg' . "' alt='" . esc_attr( get_bloginfo('name') ) . "' loading='lazy'>"; 
}

if( !empty( TechkitTheme::$options['logo_light'] ) ) {
	$logo_lights = wp_get_attachment_image( TechkitTheme::$options['logo_light'], 'full' );
	$techkit_light_logo = $logo_lights;
}else {
	$techkit_light_logo = "<img width='175' height='41' src='" . TECHKIT_IMG_URL . 'logo-light.svg' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>";
}

if ( TechkitTheme::$options['vertical_menu_icon'] == 0 ) {
	$img_class ='no-vertical-menu';
}else {
	$img_class ='show-vertical-menu';
}

?>

<div class="masthead-container mobile-menu <?php echo esc_attr($img_class); ?>">
	<div id="sticky-placeholder"></div>
	<div class="header-menu container-custom" id="header-menu">
		<div class="menu-full-wrap">
			<div class="site-branding">
				<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $techkit_dark_logo, 'allow_link' ); ?></a>
				<a class="light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $techkit_light_logo, 'allow_link' ); ?></a>
			</div>
			<div class="menu-wrap">
				<div id="site-navigation" class="main-navigation">
					<?php wp_nav_menu( $nav_menu_args );?>
				</div>
			</div>	

			<?php if ( TechkitTheme::$options['search_icon'] || TechkitTheme::$options['cart_icon'] || TechkitTheme::$options['vertical_menu_icon'] ) { ?>
			<div class="header-right-wrap">
				<?php get_template_part( 'template-parts/header/icon', 'area' );?>
				<?php if ( TechkitTheme::$options['vertical_menu_icon'] ) { ?>
				<div class="header-offcanvus">
					<?php get_template_part( 'template-parts/header/icon', 'offcanvas' );?>						
				</div>	
				<?php } ?>	
			</div>
			<?php } ?>

		</div>
	</div>
</div>