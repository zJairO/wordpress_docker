<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Techkit_Core;
use Elementor\Utils;
extract($data);

$attr = '';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
}

?>
<div class="sec-title <?php echo esc_attr( $data['style'] ); ?>">
	<div class="sec-title-holder">		
		<?php if( !empty ( $data['sub_title'] ) ) { ?>
		<span class="sub-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="1s" data-wow-duration="1s"><?php echo wp_kses_post( $data['sub_title'] ); ?></span>
		<?php } ?>
		<?php if( !empty ( $data['title'] ) ) { ?>
		<h2 class="rtin-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="1.2s" data-wow-duration="1s"><?php echo wp_kses_post( $data['title'] ); ?></h2>
		<?php } ?>
		<div class="<?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="1.4s" data-wow-duration="1s">
			<span class="section-line section-line-one"></span>
			<span class="section-line section-line-two"></span>
			<span class="section-line section-line-three"></span>
		</div>
	</div>
</div>
