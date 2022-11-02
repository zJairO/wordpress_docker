<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$techkit_socials = TechkitTheme_Helper::socials();
// Logo
if( !empty( TechkitTheme::$options['logo_light'] ) ) {
	$logo_lights = wp_get_attachment_image( TechkitTheme::$options['logo_light'], 'full' );
	$techkit_light_logo = $logo_lights;
}else {
	$techkit_light_logo = "<img width='175' height='41' src='" . TECHKIT_IMG_URL . 'logo-light.svg' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>";
}
$techkit_addit_info  = ( TechkitTheme::$options['address'] || TechkitTheme::$options['phone'] || TechkitTheme::$options['email'] ) ? true : false;

?>

<div class="additional-menu-area">
	<div class="sidenav sidecanvas">
		<div class="canvas-content">
		<a href="#" class="closebtn"><i class="far fa-times-circle"></i></a>
		<div class="additional-logo rt-anima rt-anima-one">
			<a class="light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $techkit_light_logo, 'allow_link' ); ?></a>
		</div>
		<div class="sidenav-address">
			<?php if ( !empty ( TechkitTheme::$options['sidetext_label'] ) ) { ?>
			<h4 class="rt-anima rt-anima-two"><?php echo wp_kses( TechkitTheme::$options['sidetext_label'] , 'alltext_allow' );?></h4>
			<?php } ?>
			<span class="rt-anima rt-anima-three"><?php echo wp_kses( TechkitTheme::$options['sidetext'] , 'alltext_allow' );?></span>
		<div class="rt-anima rt-anima-four">
		<?php if ( !empty ( $techkit_addit_info ) ) { ?>
			<?php if ( !empty ( TechkitTheme::$options['address_label'] ) ) { ?>
			<h4><?php echo wp_kses( TechkitTheme::$options['address_label'] , 'alltext_allow' );?></h4>
		<?php } } ?>
		<?php if ( $techkit_addit_info ) { ?>
			<?php if ( TechkitTheme::$options['address'] ) { ?>
			<span><i class="fas fa-map-marker-alt list-icon"></i><?php echo wp_kses( TechkitTheme::$options['address'] , 'alltext_allow' );?></span>
			<?php } ?>
			<?php if ( TechkitTheme::$options['email'] ) { ?>
			<span><i class="fas fa-envelope list-icon"></i><a href="mailto:<?php echo esc_attr( TechkitTheme::$options['email'] );?>"><?php echo esc_html( TechkitTheme::$options['email'] );?></a></span>
			<?php } ?>			
			<?php if ( TechkitTheme::$options['phone'] ) { ?>
			<span><i class="fas fa-phone-alt list-icon"></i><a href="tel:<?php echo esc_attr( TechkitTheme::$options['phone'] );?>"><?php echo esc_html( TechkitTheme::$options['phone'] );?></a></span>
			<?php } ?>
		<?php } ?>
		</div>
		<?php if ( !empty ( $techkit_socials ) ) { ?>
			<?php if ( !empty ( TechkitTheme::$options['social_label'] ) ) { ?>
			<h4 class="rt-anima rt-anima-five"><?php echo wp_kses( TechkitTheme::$options['social_label'] , 'alltext_allow' );?></h4>
		<?php } } ?>
			<?php if ( $techkit_socials ) { ?>
				<div class="sidenav-social rt-anima rt-anima-six">
					<?php foreach ( $techkit_socials as $techkit_social ): ?>
						<span><a target="_blank" href="<?php echo esc_url( $techkit_social['url'] );?>"><i class="fab <?php echo esc_attr( $techkit_social['icon'] );?>"></i></a></span>
					<?php endforeach; ?>					
				</div>						
			<?php } ?>
		</div>
		</div>
	</div>
    <button type="button" class="side-menu-open side-menu-trigger">
        <span class="menu-btn-icon">
          <span class="line line1"></span>
          <span class="line line2"></span>
          <span class="line line3"></span>
        </span>
      </button>
</div>