<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$techkit_socials = TechkitTheme_Helper::socials();

$techkit_mobile_meta  = ( TechkitTheme::$options['mobile_openhour'] || TechkitTheme::$options['mobile_phone'] || TechkitTheme::$options['mobile_email'] || TechkitTheme::$options['mobile_address'] || TechkitTheme::$options['mobile_social'] && $techkit_socials || TechkitTheme::$options['mobile_search'] || TechkitTheme::$options['mobile_button'] ) ? true : false;

?>
<?php if ( $techkit_mobile_meta ) { ?>
<div class="mobile-top-bar" id="mobile-top-fix">
	<div class="header-top">
		<?php if ( TechkitTheme::$options['mobile_openhour'] ) { ?>
		<div>
			<?php if ( TechkitTheme::$options['openhour'] ) { ?>
			<div class="icon-left">
			<i class="flaticon flaticon-clock"></i>
			</div><?php } ?>
			<div class="info"><span class="info-text"><?php echo wp_kses( TechkitTheme::$options['openhour'] , 'alltext_allow' );?></span></div>
		</div>
		<?php } ?>
		<?php if ( TechkitTheme::$options['mobile_phone'] ) { ?>
		<div>
			<?php if ( TechkitTheme::$options['phone'] ) { ?>
			<div class="icon-left">
			<i class="flaticon flaticon-phone-call"></i>
			</div><?php } ?>
			<div class="info"><span class="info-text"><a href="tel:<?php echo esc_attr( TechkitTheme::$options['phone'] );?>"><?php echo wp_kses( TechkitTheme::$options['phone'] , 'alltext_allow' );?></a></span></div>
		</div>
		<?php } ?>			
		<?php if ( TechkitTheme::$options['mobile_email'] ) { ?>
		<div>
			<?php if ( TechkitTheme::$options['email'] ) { ?>
			<div class="icon-left">
			<i class="flaticon flaticon-envelope"></i>
			</div><?php } ?>
			<div class="info"><span class="info-text"><a href="mailto:<?php echo esc_attr( TechkitTheme::$options['email'] );?>"><?php echo wp_kses( TechkitTheme::$options['email'] , 'alltext_allow' );?></a></span></div>
		</div>
		<?php } ?>
		<?php if ( TechkitTheme::$options['mobile_address'] ) { ?>
		<div>
			<?php if ( TechkitTheme::$options['address'] ) { ?>
			<div class="icon-left">
			<i class="flaticon flaticon-location"></i>
			</div><?php } ?>
			<div class="info"><span class="info-text"><?php echo wp_kses( TechkitTheme::$options['address'] , 'alltext_allow' );?></span></div>
		</div>
		<?php } ?>
	</div>
	<?php if ( TechkitTheme::$options['mobile_social'] && $techkit_socials ) { ?>
		<ul class="header-social">
			<?php foreach ( $techkit_socials as $techkit_social ): ?>
				<li><a target="_blank" href="<?php echo esc_url( $techkit_social['url'] );?>"><i class="fab <?php echo esc_attr( $techkit_social['icon'] );?>"></i></a></li>
			<?php endforeach; ?>
		</ul>
	<?php } ?>
	<?php if ( TechkitTheme::$options['mobile_search'] || TechkitTheme::$options['mobile_cart'] || TechkitTheme::$options['mobile_button']) { ?>
	<div class="header-right-wrap">
		<?php if ( TechkitTheme::$options['mobile_search'] ) { ?>
			<?php get_template_part( 'template-parts/header/icon', 'search' );?>
		<?php } ?>

		<?php if ( TechkitTheme::$options['mobile_cart'] ) { ?>
			<?php get_template_part( 'template-parts/header/icon', 'cart' );?>
		<?php } ?>

		<?php if ( TechkitTheme::$options['mobile_button'] ) { ?>
		<div class="header-right">
			<div class="header-button">
				<a class="button-btn" target="_self" href="<?php echo esc_url( TechkitTheme::$options['online_button_link']  );?>"><?php echo esc_html( TechkitTheme::$options['online_button_text'] );?></a>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>
<?php } ?>