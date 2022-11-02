<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if( ! function_exists( 'techkit_related_post' )){
	
	function techkit_related_post(){
		$thumb_size = 'techkit-size7';
		$post_id = get_the_id();	
		$number_of_avail_post = '';
		$current_post = array( $post_id );	
		$title_length = TechkitTheme::$options['show_related_post_title_limit'] ? TechkitTheme::$options['show_related_post_title_limit'] : '';
		$related_post_number = TechkitTheme::$options['show_related_post_number'];

		$techkit_has_entry_meta  = ( TechkitTheme::$options['blog_date'] || TechkitTheme::$options['blog_author_name'] || TechkitTheme::$options['blog_comment_num'] || TechkitTheme::$options['blog_length'] && function_exists( 'techkit_reading_time' ) || TechkitTheme::$options['blog_view'] && function_exists( 'techkit_views' ) ) ? true : false;

		# Making ready to the Query ...
		$query_type = TechkitTheme::$options['related_post_query'];

		$args = array(
			'post__not_in'           => $current_post,
			'posts_per_page'         => $related_post_number,
			'no_found_rows'          => true,
			'post_status'            => 'publish',
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
		);

		# Checking Related Posts Order ----------
		if( TechkitTheme::$options['related_post_sort'] ){

			$post_order = TechkitTheme::$options['related_post_sort'];

			if( $post_order == 'rand' ){

				$args['orderby'] = 'rand';
			}
			elseif( $post_order == 'views' ){

				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'techkit_views';
			}
			elseif( $post_order == 'popular' ){

				$args['orderby'] = 'comment_count';
			}
			elseif( $post_order == 'modified' ){

				$args['orderby'] = 'modified';
				$args['order']   = 'ASC';
			}
			elseif( $post_order == 'recent' ){

				$args['orderby'] = '';
				$args['order']   = '';
			}
		}


		# Get related posts by author ----------
		if( $query_type == 'author' ){
			$args['author'] = get_the_author_meta( 'ID' );
		}

		# Get related posts by tags ----------
		elseif( $query_type == 'tag' ){
			$tags_ids  = array();
			$post_tags = get_the_terms( $post_id, 'post_tag' );

			if( ! empty( $post_tags ) ){
				foreach( $post_tags as $individual_tag ){
					$tags_ids[] = $individual_tag->term_id;
				}

				$args['tag__in'] = $tags_ids;
			}
		}

		# Get related posts by categories ----------
		else{
			$category_ids = array();
			$categories   = get_the_category( $post_id );

			foreach( $categories as $individual_category ){
				$category_ids[] = $individual_category->term_id;
			}

			$args['category__in'] = $category_ids;
		}

		# Get the posts ----------
		$related_query = new wp_query( $args );
		/*the_carousel*/
		if ( TechkitTheme::$layout == 'full-width' ) {
			$responsive = array(
				'0'    => array( 'items' => 1 ),
				'480'  => array( 'items' => 2 ),
				'768'  => array( 'items' => 2 ),
				'992'  => array( 'items' => 2 ),
			);
		}
		else {
			$responsive = array(
				'0'    => array( 'items' => 1 ),
				'480'  => array( 'items' => 2 ),
				'768'  => array( 'items' => 2 ),
				'992'  => array( 'items' => 2 ),
			);
		}
		
		$count_post = $related_query->post_count;
		if ( $count_post < 4 ) {
			$number_of_avail_post = false;
		} else {
			$number_of_avail_post = true;
		}
		$owl_data = array( 
			'nav'                => false,
			'dots'               => false,
			'autoplay'           => false,
			'autoplayTimeout'    => '5000',
			'autoplaySpeed'      => '200',
			'autoplayHoverPause' => true,
			'loop'               => $number_of_avail_post,
			'margin'             => 30,
			'responsive'         => $responsive
		);

		$owl_data = json_encode( $owl_data );
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
		
		
		$wrapper_class = '';
		if ( !$count_post ) {
			$wrapper_class .= ' no-nav';
		}
		
		if( $related_query->have_posts() ) { ?>
		
		<div class="owl-wrap rt-related-post related post <?php echo esc_attr( $wrapper_class );?>">
			<div class="title-section">
				<h3 class="related-title"><?php esc_html_e ( 'Related Post', 'techkit' ); ?></h3>
				<?php if ( $count_post > 3 ){ ?>
				<div class="owl-custom-nav owl-nav">
					<div class="owl-prev"><i class="flaticon flaticon-previous"></i></div><div class="owl-next"><i class="flaticon flaticon-next"></i></div>
				</div>
				<?php } ?>
				<div class="owl-custom-nav-bar"></div>
				<div class="clear"></div>
			</div>
			<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
				<?php
					while ( $related_query->have_posts() ) {
					$related_query->the_post();
					$trimmed_title = wp_trim_words( get_the_title(), $title_length, '' );

					$id = get_the_ID();
					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = wp_trim_words( get_the_excerpt(), TechkitTheme::$options['post_content_limit'], '' );

				?>
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
							<h3><a href="<?php the_permalink();?>"><?php echo esc_html ( $trimmed_title ); ?></a></h3>
							<?php if ( TechkitTheme::$options['blog_content'] ) { ?>
							<div class="blog-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
							<?php } ?>
							<?php if ( TechkitTheme::$options['blog_cats'] ) { ?>
								<span class="blog-cat"><?php echo the_category( ', ' );?></span>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php }

		wp_reset_postdata();
	}
}
?>