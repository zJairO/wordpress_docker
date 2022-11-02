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
				<div class="address">
				<i class="flaticon flaticon-location"></i><?php if ( TechkitTheme::$options['address'] ) { ?><?php echo wp_kses( TechkitTheme::$options['address'] , 'alltext_allow' );?><?php } ?></div>
				<div class="email">
				<i class="flaticon flaticon-envelope"></i><a href="mailto:<?php echo esc_attr( TechkitTheme::$options['email'] );?>"><?php echo wp_kses( TechkitTheme::$options['email'] , 'alltext_allow' );?></a></div>
			</div>
			<div class="tophead-right">
				<?php if ( TechkitTheme::$options['online_button'] == '1' ) { ?>
					<div class="header-button">
						<a target="_self" href="<?php echo esc_url( TechkitTheme::$options['online_button_link']  );?>"><i class="far fa-file-alt"></i><?php echo esc_html( TechkitTheme::$options['online_button_text'] );?></a>
					</div>
				<?php } ?>
				<?php if ( $techkit_socials ) { ?>
					<ul class="tophead-social">
						<?php foreach ( $techkit_socials as $techkit_social ): ?>
							<li><a target="_blank" href="<?php echo esc_url( $techkit_social['url'] );?>"><i class="fab <?php echo esc_attr( $techkit_social['icon'] );?>"></i></a></li>
						<?php endforeach; ?>
					</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</div>