<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$techkit_socials = TechkitTheme_Helper::socials();
?>

<div id="tophead" class="header-top-bar align-items-center"> 
	<div class="container">
		<div class="top-bar-wrap">
			<div class="tophead-left">
				<div class="topbar_text">
				<?php if ( TechkitTheme::$options['address'] ) { ?><?php echo wp_kses( TechkitTheme::$options['top_bar_text'] , 'alltext_allow' );?><?php } ?><a class="button-btn" target="_self" href="<?php echo esc_url( TechkitTheme::$options['online_button_link']  );?>"><?php echo esc_html( TechkitTheme::$options['online_button_text'] );?></a></div>				
			</div>
			<div class="tophead-right">
				<div class="phone">
				<i class="fas fa-phone-alt"></i><a href="tel:<?php echo esc_attr( TechkitTheme::$options['phone'] );?>"><?php echo wp_kses( TechkitTheme::$options['phone'] , 'alltext_allow' );?></a></div>
				<div class="address">
				<i class="fas fa-map-marker-alt"></i><?php if ( TechkitTheme::$options['address'] ) { ?><?php echo wp_kses( TechkitTheme::$options['address'] , 'alltext_allow' );?><?php } ?></div>
			</div>
		</div>
	</div>
</div>

