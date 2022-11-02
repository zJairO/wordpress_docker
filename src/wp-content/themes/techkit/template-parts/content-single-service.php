<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$thumb_size = 'techkit-size1';
$techkit_service_icon   	= get_post_meta( get_the_ID(), 'techkit_service_icon', true );

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'service-single' ); ?>>
	<div class="single-service-inner">
		<div class="post-thumb">
			<?php
				if ( has_post_thumbnail() ){
					the_post_thumbnail( $thumb_size );
				} else {
					if ( !empty( TechkitTheme::$options['no_preview_image']['id'] ) ) {
						echo wp_get_attachment_image( TechkitTheme::$options['no_preview_image']['id'], $thumb_size );
					} else {
						echo '<img class="wp-post-image" src="' . TechkitTheme_Helper::get_img( 'noimage_1210X584.jpg' ) . '" alt="'.get_the_title().'">';
					}
				}
			?>
			<div class="service-icon"><i class="<?php echo wp_kses_post( $techkit_service_icon );?>"></i></div>
		</div>		
		<?php the_content(); ?>
	</div>
</div>