<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'techkit-size3';
$id 		= get_the_ID();

?>
<article id="post-<?php the_ID(); ?>">
	<div class="rtin-item">
		<div class="rtin-figure">
			<a href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ){
						the_post_thumbnail( $thumb_size, ['class' => 'img-fluid mb-10 width-100'] );
					} else {
						if ( !empty( TechkitTheme::$options['no_preview_image']['id'] ) ) {
							echo wp_get_attachment_image( TechkitTheme::$options['no_preview_image']['id'], $thumb_size );
						} else {
							echo '<img class="wp-post-image" src="' . TechkitTheme_Helper::get_img( 'noimage_370X328.jpg' ) . '" alt="'.get_the_title().'">';
						}
					}
				?>
			</a>
		</div>
		<div class="rtin-content">		
			<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>			
			<?php if ( TechkitTheme::$options['case_ar_category'] ) { ?>
			<div class="rtin-cat"><?php
				$i = 1;
				$term_lists = get_the_terms( get_the_ID(), 'techkit_case_category' );
				foreach ( $term_lists as $term_list ){ 
				$link = get_term_link( $term_list->term_id, 'techkit_case_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ' / ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } ?></div>
			<?php } ?>			
		</div>
	</div>
</article>