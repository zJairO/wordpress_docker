<?php
$techkit_footer_column = TechkitTheme::$options['footer_column_2'];
switch ( $techkit_footer_column ) {
	case '1':
	$techkit_footer_class = 'col-sm-12 col-12';
	break;
	case '2':
	$techkit_footer_class = 'col-sm-6 col-12';
	break;
	case '3':
	$techkit_footer_class = 'col-md-4 col-12';
	break;		
	default:
	$techkit_footer_class = 'col-lg-3 col-md-6 col-12';
	break;
}
// Logo
if( !empty( TechkitTheme::$options['footer_logo_light'] ) ) {
	$logo_lights = wp_get_attachment_image( TechkitTheme::$options['footer_logo_light'], 'full' );
	$techkit_light_logo = $logo_lights;
}else {
	$techkit_light_logo = "<img width='175' height='41' src='" . TECHKIT_IMG_URL . 'logo-light.svg' . "' alt='" . esc_attr( get_bloginfo('name') ) . "'>";
}

$techkit_socials = TechkitTheme_Helper::socials();

if( !empty( TechkitTheme::$options['fbgimg2'] ) ) {
	$f1_bg = wp_get_attachment_image_src( TechkitTheme::$options['fbgimg2'], 'full', true );
	$footer_bg_img = $f1_bg[0];
}else {
	$footer_bg_img = TECHKIT_IMG_URL . 'footer2_bg.jpg';
}

if ( TechkitTheme::$options['footer_bgtype2'] == 'fbgcolor2' ) {
	$techkit_bg = TechkitTheme::$options['fbgcolor2'];
} else {
	$techkit_bg = 'url(' . $footer_bg_img . ') no-repeat center bottom / cover';
}

?>

<?php if ( TechkitTheme::$footer_area == 1 ) { ?>	
	<div class="footer-top-area" style="background:<?php echo esc_html( $techkit_bg ); ?>">
		<?php if ( TechkitTheme::$options['footer_shape2'] ) { ?>
			<ul class="shape-holder">
				<li class="shape1 wow fadeInUp" data-wow-delay="1.5s" data-wow-duration="1.5s">
					<img width="1852" height="488" loading='lazy' src="<?php echo TECHKIT_ASSETS_URL . 'element/footer-shape-3.png'; ?>" alt="<?php echo esc_attr('footer-shape1', 'techkit'); ?>">
				</li>
			</ul>
		<?php } ?>
		<div class="container">
			<?php if ( TechkitTheme::$options['footer2_logo'] || TechkitTheme::$options['footer2_social'] ) { ?>
			<div class="footer-logo-area">
				<?php if ( TechkitTheme::$options['footer2_logo'] ) { ?>
				<div class="footer-logo"><a class="light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo wp_kses( $techkit_light_logo, 'allow_link' ); ?></a>
				</div>
				<?php } ?>
				<?php if ( $techkit_socials && ( TechkitTheme::$options['footer2_social'] ) ) { ?>
				<ul class="footer-social">
					<?php foreach ( $techkit_socials as $techkit_social ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $techkit_social['url'] );?>"><i class="fab <?php echo esc_attr( $techkit_social['icon'] );?>"></i></a></li>
					<?php endforeach; ?>
				</ul>
			<?php } ?>
			</div>
			<?php } ?>
			<div class="row">
				<?php
				for ( $i = 1; $i <= $techkit_footer_column; $i++ ) {
					echo '<div class="' . $techkit_footer_class . '">';
					dynamic_sidebar( 'footer-style-2-'. $i );
					echo '</div>';
				}
				?>
			</div>
		</div>		
	</div>
	<div class="footer-bottom-area">
		<div class="container">
			<div class="copyright"><?php echo wp_kses( TechkitTheme::$options['copyright_text'] , 'allow_link' );?></div>
		</div>
	</div>
<?php } ?>
