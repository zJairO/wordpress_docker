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
$techkit_top_meta  = ( TechkitTheme::$options['openhour'] || TechkitTheme::$options['phone'] || TechkitTheme::$options['email'] || TechkitTheme::$options['address'] || $techkit_socials ) ? true : false;

?>
<?php if ( $techkit_top_meta && TechkitTheme::$options['header_top'] ) { ?>
<div class="masthead-container container-custom" id="header-top-fix">
	<div class="header-top">				
		<div class="header-address">
			<?php if ( TechkitTheme::$options['openhour'] ) { ?>
			<div>
				<div class="icon-left">
				<i class="flaticon flaticon-clock"></i>
				</div>
				<div class="info"><span class="info-text"><?php echo wp_kses( TechkitTheme::$options['openhour'] , 'alltext_allow' );?></span></div>
			</div>
			<?php } ?>
			<?php if ( TechkitTheme::$options['phone'] ) { ?>
			<div>
				<div class="icon-left">
				<i class="flaticon flaticon-phone-call"></i>
				</div>
				<div class="info"><span class="info-text"><a href="tel:<?php echo esc_attr( TechkitTheme::$options['phone'] );?>"><?php echo wp_kses( TechkitTheme::$options['phone'] , 'alltext_allow' );?></a></span></div>
			</div>
			<?php } ?>			
			<?php if ( TechkitTheme::$options['email'] ) { ?>
			<div>
				<div class="icon-left">
				<i class="flaticon flaticon-envelope"></i>
				</div>
				<div class="info"><span class="info-text"><a href="mailto:<?php echo esc_attr( TechkitTheme::$options['email'] );?>"><?php echo wp_kses( TechkitTheme::$options['email'] , 'alltext_allow' );?></a></span></div>
			</div>
			<?php } ?>
			<?php if ( TechkitTheme::$options['address'] ) { ?>
			<div>
				<div class="icon-left">
				<i class="flaticon flaticon-location"></i>
				</div>
				<div class="info"><span class="info-text"><?php echo wp_kses( TechkitTheme::$options['address'] , 'alltext_allow' );?></span></div>
			</div>
			<?php } ?>
		</div>
		<?php if ( $techkit_socials ) { ?>
			<ul class="header-social">
				<?php foreach ( $techkit_socials as $techkit_social ): ?>
					<li><a target="_blank" href="<?php echo esc_url( $techkit_social['url'] );?>"><i class="fab <?php echo esc_attr( $techkit_social['icon'] );?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
		<?php } ?>
	</div>
</div>
<?php } ?>
<div id="sticky-placeholder"></div>
<div class="header-menu mobile-menu container-custom" id="header-menu">
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
		<?php if ( TechkitTheme::$options['search_icon'] ) { ?>
		<div class="header-search-one">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) )  ?>" class="search-form">
				<input required="" type="text" id="search-form-5f51fb188e3b0" class="search-field" placeholder="<?php esc_attr_e( 'Search …', 'techkit');?>" value="" name="s">
				<button class="search-button" type="submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</form>
		</div>	
		<?php } ?>	
	</div>
</div>