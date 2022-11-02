<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), TechkitTheme::$options['service_excerpt_limit'], '' );
$techkit_service_icon   	= get_post_meta( get_the_ID(), 'techkit_service_icon', true );

?>
<article id="post-<?php the_ID(); ?>">
	<div class="rtin-item">
		<div class="services-item-overlay"></div>
		<div class="rtin-header">
			<i class="<?php echo wp_kses_post( $techkit_service_icon );?>"></i>
			<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		</div>
		<div class="rtin-content">			
			<div class="service-text"><?php echo wp_kses( $content , 'alltext_allow' ); ?></div>				
		</div>
	</div>
</article>