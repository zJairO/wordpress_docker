<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = TechkitTheme_Helper::nav_menu_args();

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

?>
<div class="masthead-container mobile-menu" id="header-top-fix">
	<div class="container">
		<div class="header-3-wrap">
			<?php if ( TechkitTheme::$options['phone'] ) { ?>
			<div class="info-wrap">						
				<div class="info"><i class="flaticon flaticon-phone-call"></i><a href="tel:<?php echo esc_attr( TechkitTheme::$options['phone'] );?>"><?php echo wp_kses( TechkitTheme::$options['phone'] , 'alltext_allow' );?></a>
				</div>					
			</div>
			<?php } ?>	
			<div class="header-3-middle">
				<div class="site-branding">
					<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $techkit_dark_logo, 'allow_link' ); ?></a>
					<a class="light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $techkit_light_logo, 'allow_link' ); ?></a>
				</div>
			</div>	
			<?php if ( TechkitTheme::$options['address'] ) { ?>
			<div class="info-wrap">				
				<div class="info"><i class="flaticon flaticon-location"></i><?php echo wp_kses( TechkitTheme::$options['address'] , 'alltext_allow' );?>
				</div>
			</div>	
			<?php } ?>	
		</div>
	</div>
</div>
<div id="sticky-placeholder"></div>
<div class="header-menu menu-layout3" id="header-menu">
	<div class="container">
		<div class="menu-full-wrap">
			<div class="menu-wrap">
				<div id="site-navigation" class="main-navigation">
					<?php wp_nav_menu( $nav_menu_args );?>
				</div>
			</div>
			<div class="header-right-wrap">
				<?php get_template_part( 'template-parts/header/icon', 'area' );?>
				<?php if ( TechkitTheme::$options['online_button'] == '1' ) { ?>
				<div class="header-right">
					<div class="header-button">
						<a class="button-btn" target="_self" href="<?php echo esc_url( TechkitTheme::$options['online_button_link']  );?>"><?php echo esc_html( TechkitTheme::$options['online_button_text'] );?></a>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>