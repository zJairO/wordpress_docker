<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'techkit-size1';

$techkit_has_entry_meta  = ( TechkitTheme::$options['blog_date'] || TechkitTheme::$options['blog_author_name'] || TechkitTheme::$options['blog_comment_num'] || TechkitTheme::$options['blog_length'] && function_exists( 'techkit_reading_time' ) || TechkitTheme::$options['blog_view'] && function_exists( 'techkit_views' ) ) ? true : false;

$techkit_time_html       = sprintf( '<span>%s</span><span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
$techkit_time_html       = apply_filters( 'techkit_single_time', $techkit_time_html );

$techkit_comments_number = number_format_i18n( get_comments_number() );
$techkit_comments_html = $techkit_comments_number == 1 ? esc_html__( 'Comment: ' , 'techkit' ) : esc_html__( 'Comments: ' , 'techkit' );
$techkit_comments_html = $techkit_comments_html . '<span class="comment-number">'. $techkit_comments_number .'</span> ';

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), TechkitTheme::$options['post_content_limit'], '' );

if ( empty(has_post_thumbnail() ) ) {
	$img_class ='no_image';
}else {
	$img_class ='show_image';
}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-layout-2' ); ?>>
	<div class="blog-box <?php echo esc_attr($img_class); ?>">		
		<div class="entry-content">
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php the_excerpt();?>
			<?php if ( TechkitTheme::$options['blog_cats'] ) { ?>
				<span class="blog-cat"><?php echo the_category( ', ' );?></span>
			<?php } ?>
		</div>
	</div>
</div>