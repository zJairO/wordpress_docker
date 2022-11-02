<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$pagination = $nav = $auto_play = $loop = $text_color = $name_color = $by_line_color = $style = $skin = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-testimonial-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-testimonial tm-swiper ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

if ( in_array( $style, array( '1', '2' ) ) ) {
	$css_class .= " equal-height";
} elseif ( in_array( $style, array( '5', ) ) ) {
	$css_class .= " c-bottom";
}

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}

$text_classes    = array( 'testimonial-desc' );
$name_classes    = array( 'testimonial-name' );
$by_line_classes = array( 'testimonial-by-line' );

if ( $skin === 'custom' ) {
	if ( $text_color === 'primary' ) {
		$text_classes[] = 'primary-color-important';
	}

	if ( $name_color === 'primary' ) {
		$name_classes[] = 'primary-color-important';
	}

	if ( $by_line_color === 'primary' ) {
		$by_line_classes[] = 'primary-color-important';
	}
}

$atomlab_post_args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ), true ) ) {
	$atomlab_post_args['meta_key'] = $meta_key;
}

$atomlab_post_args = Atomlab_VC::get_tax_query_of_taxonomies( $atomlab_post_args, $taxonomies );

$atomlab_query = new WP_Query( $atomlab_post_args );
?>
<?php if ( $atomlab_query->have_posts() ) : ?>

	<?php
	$testimonial_slides_template = '';
	$testimonial_thumbs_template = '';
	?>

	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( $carousel_items_display !== '' ) {
			$arr = explode( ';', $carousel_items_display );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
			}
		}
		?>
		<?php if ( $carousel_gutter !== '' ) {
			$arr = explode( ';', $carousel_gutter );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-gutter="' . $tmp[1] . '"';
			}
		}
		?>
		<?php if ( $nav !== '' ) : ?>
			data-nav="1"
		<?php endif; ?>
		<?php if ( $pagination !== '' ) : ?>
			data-pagination="1"
		<?php endif; ?>
		<?php if ( $auto_play !== '' ) : ?>
			data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
		<?php endif; ?>
		<?php if ( $loop === '1' ) : ?>
			data-loop="1"
		<?php endif; ?>
		 data-equal-height="1"

		<?php if ( $style === '1' ) { ?>
			data-queue-init="0"
		<?php } elseif ( $style === '4' ) { ?>
			data-centered="1"
		<?php } ?>
	>

		<?php if ( $style === '1' ) { ?>

			<?php while ( $atomlab_query->have_posts() ) : $atomlab_query->the_post(); ?>
				<?php

				$image_url = ATOMLAB_THEME_IMAGE_URI . '/avatar-placeholder.jpg';

				if ( has_post_thumbnail() ) {
					$full_image_size = get_the_post_thumbnail_url( null, 'full' );
					$image_url       = Atomlab_Helper::aq_resize( array(
						'url'    => $full_image_size,
						'width'  => 100,
						'height' => 100,
						'crop'   => true,
					) );
				}

				$testimonial_thumbs_template .= '<div class="swiper-slide"><div class="post-thumbnail"><img src="' . esc_url( $image_url ) . '" alt="' . esc_attr__( 'Slide Image', 'atomlab' ) . '"/></div></div>';

				?>

				<?php ob_start(); ?>

				<div class="swiper-slide">

					<?php $_meta = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) ); ?>
					<div class="testimonial-item">
						<div
							class="<?php echo esc_attr( join( ' ', $text_classes ) ); ?>"><?php the_content(); ?></div>

						<?php if ( isset( $_meta['rating'] ) && $_meta['rating'] !== '' ): ?>
							<div class="testimonial-rating">
								<?php Atomlab_Templates::get_rating_template( $_meta['rating'] ); ?>
							</div>
						<?php endif; ?>

						<div class="testimonial-info">
							<h6 class="<?php echo esc_attr( join( ' ', $name_classes ) ); ?>"><?php the_title(); ?></h6>

							<?php if ( isset( $_meta['by_line'] ) ) : ?>
								<div class="<?php echo esc_attr( join( ' ', $by_line_classes ) ); ?>">
									/&nbsp;<?php echo esc_html( $_meta['by_line'] ); ?></div>
							<?php endif; ?>
						</div>
					</div>

				</div>

				<?php
				$testimonial_slides_template .= ob_get_contents();
				ob_end_clean();
				?>

			<?php endwhile; ?>


			<div class="tm-swiper tm-testimonial-pagination equal-height v-center h-center"
			     data-lg-items="3"
			     data-lg-gutter="10"
			     data-centered="1"
			     data-queue-init="0"
			>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php echo "{$testimonial_thumbs_template}"; ?>
					</div>
				</div>
			</div>


			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php echo "{$testimonial_slides_template}"; ?>
				</div>
			</div>

		<?php } else { ?>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php while ( $atomlab_query->have_posts() ) : $atomlab_query->the_post(); ?>
						<div class="swiper-slide">

							<?php if ( $style === '2' ) { ?>
								<?php $_meta = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) ); ?>
								<div class="testimonial-item">
									<?php if ( has_post_thumbnail() ): ?>
										<?php
										$full_image_size = get_the_post_thumbnail_url( null, 'full' );
										$image_url       = Atomlab_Helper::aq_resize( array(
											'url'    => $full_image_size,
											'width'  => 90,
											'height' => 90,
											'crop'   => true,
										) );
										?>
										<div class="post-thumbnail">
											<img src="<?php echo esc_url( $image_url ); ?>"
											     alt="<?php echo esc_attr( get_the_title() ); ?>"/>
										</div>
									<?php endif; ?>
									<div
										class="<?php echo esc_attr( join( ' ', $text_classes ) ); ?>"><?php the_content(); ?></div>

									<?php if ( isset( $_meta['rating'] ) && $_meta['rating'] !== '' ): ?>
										<div class="testimonial-rating">
											<?php Atomlab_Templates::get_rating_template( $_meta['rating'] ); ?>
										</div>
									<?php endif; ?>

									<div class="testimonial-info">
										<h6 class="<?php echo esc_attr( join( ' ', $name_classes ) ); ?>"><?php the_title(); ?></h6>

										<?php if ( isset( $_meta['by_line'] ) ) : ?>
											<div class="<?php echo esc_attr( join( ' ', $by_line_classes ) ); ?>">
												/&nbsp;<?php echo esc_html( $_meta['by_line'] ); ?></div>
										<?php endif; ?>
									</div>
								</div>
							<?php } elseif ( $style === '3' ) { ?>
								<?php $_meta = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) ); ?>
								<div class="testimonial-item">
									<div
										class="<?php echo esc_attr( join( ' ', $text_classes ) ); ?>"><?php the_content(); ?></div>

									<div class="testimonial-info">
										<?php if ( has_post_thumbnail() ): ?>
											<?php
											$full_image_size = get_the_post_thumbnail_url( null, 'full' );
											$image_url       = Atomlab_Helper::aq_resize( array(
												'url'    => $full_image_size,
												'width'  => 90,
												'height' => 90,
												'crop'   => true,
											) );
											?>
											<div class="post-thumbnail">
												<img src="<?php echo esc_url( $image_url ); ?>"
												     alt="<?php esc_attr_e( 'Slide Image', 'atomlab' ); ?>"/>
											</div>
										<?php endif; ?>
										<div class="testimonial-main-info">
											<h6 class="<?php echo esc_attr( join( ' ', $name_classes ) ); ?>"><?php the_title(); ?></h6>

											<?php if ( isset( $_meta['by_line'] ) ) : ?>
												<div class="<?php echo esc_attr( join( ' ', $by_line_classes ) ); ?>">
													/&nbsp;<?php echo esc_html( $_meta['by_line'] ); ?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php } elseif ( $style === '4' ) { ?>
								<?php $_meta = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) ); ?>
								<div class="testimonial-item">
									<div
										class="<?php echo esc_attr( join( ' ', $text_classes ) ); ?>"><?php the_content(); ?></div>

									<div class="testimonial-info">
										<?php if ( has_post_thumbnail() ): ?>
											<?php
											$full_image_size = get_the_post_thumbnail_url( null, 'full' );
											$image_url       = Atomlab_Helper::aq_resize( array(
												'url'    => $full_image_size,
												'width'  => 90,
												'height' => 90,
												'crop'   => true,
											) );
											?>
											<div class="post-thumbnail">
												<img src="<?php echo esc_url( $image_url ); ?>"
												     alt="<?php esc_attr_e( 'Slide Image', 'atomlab' ); ?>"/>
											</div>
										<?php endif; ?>
										<div class="testimonial-main-info">
											<h6 class="<?php echo esc_attr( join( ' ', $name_classes ) ); ?>"><?php the_title(); ?></h6>

											<?php if ( isset( $_meta['by_line'] ) ) : ?>
												<div class="<?php echo esc_attr( join( ' ', $by_line_classes ) ); ?>">
													/&nbsp;<?php echo esc_html( $_meta['by_line'] ); ?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php } elseif ( $style === '5' ) { ?>
								<?php $_meta = maybe_unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) ); ?>
								<div class="container">
									<div class="row testimonial-item">
										<div class="col-md-5 post-thumbnail">
											<?php if ( has_post_thumbnail() ): ?>
												<?php
												$full_image_size = get_the_post_thumbnail_url( null, 'full' );
												$image_url       = Atomlab_Helper::aq_resize( array(
													'url'    => $full_image_size,
													'width'  => 9999,
													'height' => 628,
													'crop'   => false,
												) );
												?>
												<img src="<?php echo esc_url( $image_url ); ?>"
												     alt="<?php esc_attr_e( 'Slide Image', 'atomlab' ); ?>"/>
											<?php endif; ?>
										</div>
										<div class="col-md-6 col-md-push-1 testimonial-content">
											<div class="testimonial-info">
												<div
													class="<?php echo esc_attr( join( ' ', $text_classes ) ); ?>"><?php the_content(); ?></div>

												<?php if ( isset( $_meta['rating'] ) && $_meta['rating'] !== '' ): ?>
													<div class="testimonial-rating">
														<?php Atomlab_Templates::get_rating_template( $_meta['rating'] ); ?>
													</div>
												<?php endif; ?>

												<div class="testimonial-main-info">
													<h6 class="<?php echo esc_attr( join( ' ', $name_classes ) ); ?>"><?php the_title(); ?></h6>

													<?php if ( isset( $_meta['by_line'] ) ) : ?>
														<div
															class="<?php echo esc_attr( join( ' ', $by_line_classes ) ); ?>">
															/&nbsp;<?php echo esc_html( $_meta['by_line'] ); ?></div>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>

						</div>

					<?php endwhile; ?>
				</div>
			</div>
		<?php } ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
