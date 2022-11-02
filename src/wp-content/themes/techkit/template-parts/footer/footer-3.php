<?php
$techkit_footer_column = TechkitTheme::$options['footer_column_3'];
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

$techkit_socials = TechkitTheme_Helper::socials();

if( !empty( TechkitTheme::$options['fbgimg3'] ) ) {
	$f1_bg = wp_get_attachment_image_src( TechkitTheme::$options['fbgimg3'], 'full', true );
	$footer_bg_img = $f1_bg[0];
}else {
	$footer_bg_img = TECHKIT_IMG_URL . 'footer2_bg.jpg';
}

if ( TechkitTheme::$options['footer_bgtype3'] == 'fbgcolor3' ) {
	$techkit_bg = TechkitTheme::$options['fbgcolor3'];
} else {
	$techkit_bg = 'url(' . $footer_bg_img . ') no-repeat center bottom / cover';
}

?>

<?php if ( TechkitTheme::$footer_area == 1 ) { ?>
	<div class="footer-top-area" style="background:<?php echo esc_html( $techkit_bg ); ?>">
		<?php if ( TechkitTheme::$options['footer_shape3'] ) { ?>
			<ul class="shape-holder">
				<li class="shape1 wow fadeInLeft" data-wow-delay="1.5s" data-wow-duration="1.5s">
					<img width="151" height="155" loading='lazy' src="<?php echo TECHKIT_ASSETS_URL . 'element/footer-shape-4.png'; ?>" alt="<?php echo esc_attr('footer-shape1', 'techkit'); ?>">
				</li>
				<li class="shape2 wow fadeInRight" data-wow-delay="1.5s" data-wow-duration="1.5s">
					<img width="779" height="881" loading='lazy' src="<?php echo TECHKIT_ASSETS_URL . 'element/footer-shape-5.png'; ?>" alt="<?php echo esc_attr('footer-shape2', 'techkit'); ?>">
				</li>
			</ul>
		<?php } ?>
		<div class="container">
			<?php if ( is_active_sidebar( 'footer-style-1-1' ) ) { ?>
			<div class="row">
				<?php
				for ( $i = 1; $i <= $techkit_footer_column; $i++ ) {
					echo '<div class="' . $techkit_footer_class . '">';
					dynamic_sidebar( 'footer-style-3-'. $i );
					echo '</div>';
				}
				?>
			</div>
			<?php } ?>
		</div>
		<div class="copyright"><?php echo wp_kses( TechkitTheme::$options['copyright_text'] , 'allow_link' );?></div>
	</div>
<?php } ?>
