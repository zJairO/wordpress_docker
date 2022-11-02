<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$ul_class = $post_classes = '';

$thumb_size = 'techkit-size2';

$techkit_has_entry_meta  = ( TechkitTheme::$options['blog_date'] || TechkitTheme::$options['blog_author_name'] || TechkitTheme::$options['blog_comment_num'] || TechkitTheme::$options['blog_length'] && function_exists( 'techkit_reading_time' ) || TechkitTheme::$options['blog_view'] && function_exists( 'techkit_views' ) ) ? true : false;

$techkit_time_html = sprintf( '<span>%s</span> <span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );

$techkit_comments_number = number_format_i18n( get_comments_number() );
$techkit_comments_html = $techkit_comments_number == 1 ? esc_html__( 'Comment: ' , 'techkit' ) : esc_html__( 'Comments: ' , 'techkit' );
$techkit_comments_html = $techkit_comments_html . '<span class="comment-number">'. $techkit_comments_number .'</span> ';

$thumbnail = false;

if (  TechkitTheme::$layout == 'right-sidebar' || TechkitTheme::$layout == 'right-sidebar' ){
	$post_classes = array( 'col-lg-6 col-md-6 col-sm-6 col-12 rt-grid-item blog-layout-1' );
	$ul_class = 'side_bar';
} else {
	$post_classes = array( 'col-lg-4 col-md-4 col-sm-4 col-12 rt-grid-item blog-layout-1' );
	$ul_class = '';
}

if ( empty(has_post_thumbnail() ) ) {
	$img_class ='no_image';
}else {
	$img_class ='show_image';
}

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), TechkitTheme::$options['post_content_limit'], '' );
	
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
	<div class="blog-box <?php echo esc_attr($img_class); ?>">
		<?php if ( has_post_thumbnail() || TechkitTheme::$options['display_no_preview_image'] == '1'  ) { ?>
		<div class="blog-img-holder">
			<div class="blog-img">
				<a href="<?php the_permalink(); ?>" class="img-opacity-hover"><?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( $thumb_size, ['class' => 'img-responsive'] ); ?>
						<?php } else {
						if ( TechkitTheme::$options['display_no_preview_image'] == '1' ) {
							if ( !empty( TechkitTheme::$options['no_preview_image']['id'] ) ) {
								$thumbnail = wp_get_attachment_image( TechkitTheme::$options['no_preview_image']['id'], $thumb_size );						
							}
							elseif ( empty( TechkitTheme::$options['no_preview_image']['id'] ) ) {
								$thumbnail = '<img class="wp-post-image" src="'.TECHKIT_IMG_URL.'noimage_420X435.jpg" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
							}
							echo wp_kses( $thumbnail , 'alltext_allow' );
						}
					}
					?>
				</a>
			</div>
			<?php if ( $techkit_has_entry_meta ) { ?>
			<ul>
				<?php if ( TechkitTheme::$options['blog_author_name'] ) { ?>
				<li class="item-author"><i class="far fa-user"></i><?php esc_html_e( 'by ', 'techkit' );?><?php the_author_posts_link(); ?></li>
				<?php } if ( TechkitTheme::$options['blog_date'] ) { ?>	
				<li class="blog-date"><i class="far fa-calendar"></i><?php echo get_the_date(); ?></li>				
				<?php } if ( TechkitTheme::$options['blog_comment_num'] ) { ?>
				<li class="blog-comment"><i class="far fa-comments"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $techkit_comments_html , 'alltext_allow' );?></a></li>
				<?php } if ( TechkitTheme::$options['blog_length'] && function_exists( 'techkit_reading_time' ) ) { ?>
				<li class="meta-reading-time meta-item"><i class="far fa-clock"></i><?php echo techkit_reading_time(); ?></li>
				<?php } if ( TechkitTheme::$options['blog_view'] && function_exists( 'techkit_views' ) ) { ?>
				<li><span class="meta-views meta-item "><i class="far fa-eye"></i><?php echo techkit_views(); ?></span></li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>
		<?php } ?>
		<div class="entry-content">			
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php if ( TechkitTheme::$options['blog_content'] ) { ?>
			<div class="blog-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
			<?php } ?>
			<?php if ( TechkitTheme::$options['blog_cats'] ) { ?>
				<span class="blog-cat"><?php echo the_category( ', ' );?></span>
			<?php } ?>
		</div>
	</div>
</div>