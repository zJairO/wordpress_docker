<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'techkit-size1';

global $post;
$case_video_link  	= get_post_meta( $post->ID, 'case_video_link', true );
$case_button  	    = get_post_meta( $post->ID, 'case_button', true );
$case_url  	    	= get_post_meta( $post->ID, 'case_url', true );

$techkit_has_entry_meta  = ( TechkitTheme::$options['show_case_date'] || TechkitTheme::$options['show_case_cat'] ||  TechkitTheme::$options['show_case_view'] && function_exists( 'techkit_views' ) ) ? true : false;

?>
<div id="post-<?php the_ID();?>" <?php post_class( 'case-single' );?>>	
	<div class="case-header">
		<?php if ( $techkit_has_entry_meta ) { ?>
		<ul class="case-meta">
			<?php if ( TechkitTheme::$options['show_case_date'] ) { ?>
			<li><i class="far fa-calendar-alt"></i><?php echo get_the_date(); ?></li>				
			<?php } if ( TechkitTheme::$options['show_case_cat'] ) { ?>
			<li class="rtin-cat"><i class="far fa-folder-open"></i><?php
				$i = 1;
				$term_lists = get_the_terms( get_the_ID(), 'techkit_case_category' );
				foreach ( $term_lists as $term_list ){ 
				$link = get_term_link( $term_list->term_id, 'techkit_case_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ' , ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } ?></li>
				<?php } if ( TechkitTheme::$options['show_case_view'] && function_exists( 'techkit_views' ) ) { ?>
				<li><i class="far fa-eye"></i><span class="meta-views meta-item "><?php echo techkit_views(); ?></span></li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>

	<div class="rtin-case-content">
		<?php the_content();?>
	</div>
	
	<div class="rtin-thumbnail">
		<?php if ( has_post_thumbnail() ) { ?>
		<?php 
			the_post_thumbnail( $thumb_size );
		} ?>
		<?php if( $case_video_link ) { ?>
		<div class="video-icon">
			<a class="rtin-play rt-video-popup" href="<?php echo esc_url( $case_video_link ); ?>"><i class="fas fa-play"></i></a>
		</div>
		<?php } ?>
	</div>

	<?php if ( ( TechkitTheme::$options['show_case_social'] ) || ( TechkitTheme::$options['show_case_like'] ) ) { ?>
	<div class="entry-footer">
		<?php if ( ( TechkitTheme::$options['show_case_social'] ) && ( function_exists( 'techkit_post_share' ) ) ) { ?>		
			<div class="post-share"><ul><li><?php techkit_post_share(); ?></li></ul></div>
		<?php } ?>
		<?php if ( TechkitTheme::$options['show_case_like'] ) { 
			$liked_class = ' unregistered';
			if($user_id = get_current_user_id()){
				$liked_class = '';
				$current_likes = get_user_meta($user_id, '_techkit_likes', true);
				if(!empty($current_likes) && is_array($current_likes) && in_array(get_the_ID(), $current_likes)){
					$liked_class = ' liked';
				}
			}
			?>
			<div class="like-share"><span class="techkit-like<?php echo esc_attr($liked_class); ?>" data-id="<?php echo get_the_ID(); ?>"><i class="far fa-heart"></i><?php esc_html_e( 'Like', 'techkit' );?></span></div>
		<?php } ?>
	</div>
	<?php } ?>

	<!-- next/prev post -->
	<?php if ( TechkitTheme::$options['show_case_pagination'] ) { techkit_post_links_next_prev(); } ?>
	<?php if( TechkitTheme::$options['show_related_case'] == '1' && is_single() && !empty ( techkit_related_case() ) ) { ?>
	<div class="related-case">
		<?php techkit_related_case(); ?>
	</div>
	<?php } ?>
	
</div>