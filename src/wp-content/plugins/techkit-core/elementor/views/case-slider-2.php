<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Techkit_Core;

use TechkitTheme;
use TechkitTheme_Helper;
use \WP_Query;

$thumb_size = 'techkit-size5';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$number_of_post = $data['itemnumber'];
$post_sorting = $data['orderby'];
$post_ordering = $data['post_ordering'];
$title_count = $data['title_count'];
$cat_single_grid = $data['cat_single'];
$args = array(
	'post_type' => 'techkit_case',
	'post_status' => 'publish',
	'orderby' => $post_sorting,
	'order' => $post_ordering,
	'posts_per_page' => $number_of_post,
	'paged'          => $paged,
);

if ( $cat_single_grid != 0 ) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'techkit_case_category',
			'field'    => 'ID',
			'terms'    => $cat_single_grid,
		)
	);
}

$query = new WP_Query( $args );
$temp = TechkitTheme_Helper::wp_set_temp_query( $query );

$slider_nav_class = $data['slider_nav'] == 'yes' ? 'slider-nav-enabled' : '';
$slider_dot_class = $data['slider_dots'] == 'yes' ? ' slider-dot-enabled' : '';

?>
<div class="case-default case-multi-layout-2 <?php echo esc_attr( $data['button_style'] ); ?> owl-wrap case-slider-<?php echo esc_attr( $data['layout'] );?> <?php echo esc_attr( $slider_nav_class ); ?><?php echo esc_attr( $slider_dot_class ); ?>">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] );?>">
		<?php $j = $data['delay']; $k = $data['duration'];
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
				$query->the_post();		
				$id 				= get_the_ID();	
				$trim_title 		= wp_trim_words( get_the_title(), $title_count, '' );
		?>
			<div class="rtin-item multi-side-hover <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $j );?>s" data-wow-duration="<?php echo esc_attr( $k );?>s">
				<div class="rtin-figure">
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
					<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="techkit-popup-zoom img-popup-icon" title="<?php echo get_the_title(); ?>"><i class="fas fa-search"></i></a>
					<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php echo wp_kses( $trim_title , 'alltext_allow' ); ?></a></h3>

					<?php if ( $data['cat_display'] ) { ?>
					<span class="rtin-cat"><?php
						$i = 1;
						$term_lists = get_the_terms( get_the_ID(), 'techkit_case_category' );
						foreach ( $term_lists as $term_list ){ 
						$link = get_term_link( $term_list->term_id, 'techkit_case_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ' / ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } ?></span>
					<?php } ?>	
				</div>
				<div class="item-overlay"></div>
			</div>
		<?php $j = $j + 0.2; $k = $k + 0.2; } ?>
	<?php } ?>
	</div>
	<?php TechkitTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>