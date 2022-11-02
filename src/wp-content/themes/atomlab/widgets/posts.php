<?php
if ( ! class_exists( 'TM_Posts_Widget' ) ) {
	class TM_Posts_Widget extends Atomlab_Widget {

		public function __construct() {

			$cat_options = array(
				'recent_posts' => esc_html__( 'Recent Posts', 'atomlab' ),
				'sticky_posts' => esc_html__( 'Sticky Posts', 'atomlab' ),
			);
			$categories  = get_categories( 'hide_empty=0' );
			if ( $categories ) {
				foreach ( $categories as $category ) {
					$cat_options[ $category->term_id ] = esc_html__( 'Category: ', 'atomlab' ) . $category->name;
				}
			}

			$this->widget_cssclass    = 'tm-posts-widget';
			$this->widget_description = esc_html__( 'Get list blog post.', 'atomlab' );
			$this->widget_id          = 'tm-posts-widget';
			$this->widget_name        = esc_html__( '[Atomlab] Posts', 'atomlab' );
			$this->settings           = array(
				'style'           => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Style', 'atomlab' ),
					'options' => array(
						'01' => 'Left Thumbnail',
						'02' => 'First Feature Post',
					),
					'std'     => '01',
				),
				'title'           => array(
					'type'  => 'text',
					'label' => esc_html__( 'Title', 'atomlab' ),
					'std'   => '',
				),
				'cat'             => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Category', 'atomlab' ),
					'options' => $cat_options,
					'std'     => 'recent_posts',
				),
				'show_thumbnail'  => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show Thumbnail', 'atomlab' ),
					'std'   => 1,
				),
				'show_categories' => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show Categories', 'atomlab' ),
					'std'   => 1,
				),
				'show_date'       => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Show Date', 'atomlab' ),
					'std'   => 0,
				),
				'num'             => array(
					'type'  => 'number',
					'label' => esc_html__( 'Number Posts', 'atomlab' ),
					'step'  => 1,
					'min'   => 1,
					'max'   => 40,
					'std'   => 5,
				),
			);

			parent::__construct();
		}

		public function widget( $args, $instance ) {
			$style           = isset( $instance['style'] ) ? $instance['style'] : $this->settings['style']['std'];
			$cat             = isset( $instance['cat'] ) ? $instance['cat'] : $this->settings['cat']['std'];
			$num             = isset( $instance['num'] ) ? $instance['num'] : $this->settings['num']['std'];
			$show_thumbnail  = isset( $instance['show_thumbnail'] ) && $instance['show_thumbnail'] === 1 ? 'true' : 'false';
			$show_categories = isset( $instance['show_categories'] ) && $instance['show_categories'] === 1 ? 'true' : 'false';
			$show_date       = isset( $instance['show_date'] ) && $instance['show_date'] === 1 ? 'true' : 'false';

			$this->widget_start( $args, $instance );

			if ( $cat === 'recent_posts' ) {
				$query_args = array(
					'post_type'           => 'post',
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
					'orderby'             => 'date',
					'order'               => 'DESC',
				);
			} elseif ( $cat === 'sticky_posts' ) {
				$sticky     = get_option( 'sticky_posts' );
				$query_args = array(
					'post_type'      => 'post',
					'post__in'       => $sticky,
					'posts_per_page' => $num,
				);
			} else {
				$query_args = array(
					'post_type'           => 'post',
					'cat'                 => $cat,
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
				);
			}

			$atomlab_query = new WP_Query( $query_args );
			if ( $atomlab_query->have_posts() ) {
				$count        = $atomlab_query->post_count;
				$i            = 0;
				$wrap_classes = "tm-posts-widget-wrapper style-$style";
				?>
				<div class="<?php echo esc_attr( $wrap_classes ); ?>">
					<?php
					while ( $atomlab_query->have_posts() ) {
						$atomlab_query->the_post();
						$i ++;
						$classes = array( 'post-item' );
						if ( $i === 1 ) {
							$classes[] = 'first-post';
						} elseif ( $i === $count ) {
							$classes[] = 'last-post';
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?> >
							<?php if ( $show_thumbnail === 'true' ) : ?>
								<div class="post-widget-thumbnail">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php if ( has_post_thumbnail() ) { ?>
											<?php
											$full_image_size = get_the_post_thumbnail_url( null, 'full' );
											$image_url       = Atomlab_Helper::aq_resize( array(
												'url'    => $full_image_size,
												'width'  => 80,
												'height' => 80,
												'crop'   => true,
											) );
											?>
											<img src="<?php echo esc_url( $image_url ); ?>"
											     alt="<?php get_the_title(); ?>"/>
											<?php
										} else {
											Atomlab_Templates::image_placeholder( 80, 80 );
										}
										?>
										<div class="post-widget-overlay">
											<span class="post-overlay-icon ion-ios-search-strong"></span>
										</div>
									</a>
								</div>
							<?php endif; ?>
							<div class="post-widget-info">
								<?php if ( $show_categories === 'true' ) : ?>
									<div class="post-widget-categories">
										<?php the_category( ', ' ); ?>
									</div>
								<?php endif; ?>
								<h5 class="post-widget-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<?php if ( $show_date === 'true' ) : ?>
									<span class="post-date style-1"><?php echo get_the_date( 'F d, Y' ); ?></span>
								<?php endif; ?>
							</div>
						</div>
						<?php
					} ?>
				</div>
				<?php
			}
			wp_reset_postdata();

			$this->widget_end( $args );
		}
	}
}
