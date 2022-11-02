
<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

wp_head();

if( !empty( TechkitTheme::$options['error_image1'] ) ) {
	$error_bg = wp_get_attachment_image( TechkitTheme::$options['error_image1'], 'full', true );
	$techkit_error_img = $error_bg;
}else {
	$techkit_error_img = "<img width='374' height='356' src='" . TECHKIT_IMG_URL . '404.png' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>";
}

if( !empty( TechkitTheme::$options['error_image2'] ) ) {
	$error_bg2 = wp_get_attachment_image( TechkitTheme::$options['error_image2'], 'full', true );
	$techkit_error_img2 = $error_bg2;
}else {
	$techkit_error_img2 = "<img width='281' height='267' src='" . TECHKIT_IMG_URL . '404_2.png' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>";
}

if( !empty( TechkitTheme::$options['error_bg'] ) ) {
	$body_bg2 = wp_get_attachment_image_url( TechkitTheme::$options['error_bg'], 'full', true );
	$techkit_error_bg_img = $body_bg2;
}else {
	$techkit_error_bg_img = TECHKIT_IMG_URL . 'error-bg.png';
}

?>
<div id="primary" class="content-area error-page-area" data-bg-image="<?php echo wp_kses( $techkit_error_bg_img, 'allow_link' ); ?>" >
	<div class="container">
		<div class="error-page-content">
			<div class="item-img">
				<span class="left-img wow fadeInUp animated" data-wow-delay=".6s" data-wow-duration="1.5s"><?php echo wp_kses( $techkit_error_img2, 'allow_link' ); ?></span>
				<span class="right-img wow fadeInDown animated" data-wow-delay=".6s" data-wow-duration="1.5s"><?php echo wp_kses( $techkit_error_img, 'allow_link' ); ?></span>
			</div>
			<?php if ( !empty( TechkitTheme::$options['error_text1']) ) { ?>
			<h2 class="text-1"><?php echo wp_kses( TechkitTheme::$options['error_text1'] , 'alltext_allow' );?></h2>
			<?php } ?>
			<?php if ( !empty(TechkitTheme::$options['error_text2'])) { ?>
			<p class="text-2"><?php echo wp_kses( TechkitTheme::$options['error_text2'] , 'alltext_allow' );?></p>
			<?php } ?>
			<div class="go-home">
			  <a class="button-style-2 btn-common rt-animation-out" href="<?php echo esc_url( home_url( '/' ) );?>">
			  	<?php echo esc_html( TechkitTheme::$options['error_buttontext'] );?><?php echo radius_arrow_shape(); ?></a>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>