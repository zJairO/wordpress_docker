<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'techkit-size6';
$id = get_the_ID();

$position   	= get_post_meta( $id, 'techkit_team_position', true );
$socials       	= get_post_meta( $id, 'techkit_team_socials', true );
$social_fields 	= TechkitTheme_Helper::team_socials();

$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), TechkitTheme::$options['team_arexcerpt_limit'], '' );

?>
<article id="post-<?php the_ID(); ?>">
	<div class="rtin-item">
		<div class="rtin-content-wrap">		
			<div class="rtin-thums">
				<a href="<?php the_permalink();?>">
					<?php
					if ( has_post_thumbnail() ){
						the_post_thumbnail( $thumb_size );
					}
					else {
						if ( !empty( TechkitTheme::$options['no_preview_image']['id'] ) ) {
							echo wp_get_attachment_image( TechkitTheme::$options['no_preview_image']['id'], $thumb_size );
						}
						else {
							echo '<img class="wp-post-image" src="' . TechkitTheme_Helper::get_img( 'noimage_400X400.jpg' ) . '" alt="'.get_the_title().'">';
						}
					}
					?>
				</a>
				<?php if ( TechkitTheme::$options['team_ar_social'] ) { ?>
					<ul class="rtin-social">
						<?php foreach ( $socials as $key => $social ): ?>
							<?php if ( !empty( $social ) ): ?>
								<li><a target="_blank" href="<?php echo esc_url( $social );?>"><i class="fab <?php echo esc_attr( $social_fields[$key]['icon'] );?>" aria-hidden="true"></i></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php } ?>
			</div>
			<div class="mask-wrap">
				<div class="rtin-content">
					<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a><?php if ( TechkitTheme::$options['team_ar_position'] ) { ?><span> - <?php echo esc_html( $position );?></span><?php } ?></h3>
				</div>
			</div>
		</div>
	</div>
</article>