<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$ul_class = $post_classes = '';

$thumb_size = 'techkit-size3';

$techkit_has_entry_meta  = ( TechkitTheme::$options['blog_author_name'] || TechkitTheme::$options['blog_cats'] || TechkitTheme::$options['blog_comment_num'] || TechkitTheme::$options['blog_length'] && function_exists( 'techkit_reading_time' ) || TechkitTheme::$options['blog_view'] && function_exists( 'techkit_views' ) ) ? true : false;

$techkit_time_html = sprintf( '<span><span>%s</span><br>%s<br>%s<br></span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
$techkit_time_html = apply_filters( 'techkit_single_time', $techkit_time_html );

$techkit_time_html_2  = apply_filters( 'techkit_single_time_no_thumb', get_the_time( get_option( 'date_format' ) ) );

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

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), TechkitTheme::$options['post_content_limit'], '' );
	
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
	<div class="blog-box">
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
								$thumbnail = '<img class="wp-post-image" src="'.TECHKIT_IMG_URL.'noimage_520X350.jpg" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
							}
							echo wp_kses( $thumbnail , 'alltext_allow' );
						}
					}
					?>
				</a>
			</div>
		</div>
		<?php } ?>
		<div class="entry-content">
			<?php if ( TechkitTheme::$options['blog_date'] ) { ?>
				<div class="blog-date"><i class="far fa-calendar-alt"></i><?php echo get_the_date(); ?></div>
			<?php } ?>
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php if ( TechkitTheme::$options['blog_content'] ) { ?>
			<div class="blog-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
			<?php } ?>
			<?php if ( $techkit_has_entry_meta ) { ?>
			<ul class="top-meta">
				<?php if ( !has_post_thumbnail() && ( TechkitTheme::$options['display_no_preview_image'] == '0'  ) ) { ?>				
				<?php } if ( TechkitTheme::$options['blog_author_name'] ) { ?>
				<li class="item-author"><i class="fas fa-user"></i><?php esc_html_e( 'by ', 'techkit' );?><?php the_author_posts_link(); ?></li>
				<?php } if ( TechkitTheme::$options['blog_cats'] ) { ?>
				<li class="blog-cat"><i class="fas fa-tag"></i><?php echo the_category( ', ' );?></li>
				<?php } if ( TechkitTheme::$options['blog_comment_num'] ) { ?>
				<li class="blog-comment"><i class="far fa-comment"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $techkit_comments_html , 'alltext_allow' );?></a></li>
				<?php } if ( TechkitTheme::$options['blog_length'] && function_exists( 'techkit_reading_time' ) ) { ?>
				<li class="meta-reading-time meta-item"><i class="far fa-clock"></i><?php echo techkit_reading_time(); ?></li>
				<?php } if ( TechkitTheme::$options['blog_view'] && function_exists( 'techkit_views' ) ) { ?>
				<li><i class="far fa-heart"></i><span class="meta-views meta-item "><?php echo techkit_views(); ?></span></li>
				<?php } ?>
			</ul>
			<?php } ?>			
		</div>
	</div>
</div>