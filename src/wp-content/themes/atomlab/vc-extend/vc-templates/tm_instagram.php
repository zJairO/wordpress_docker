<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style = $show_user_name = $el_class = $username = $overlay = $link_target = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-instagram-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-grid-wrapper tm-instagram ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$classes   = array( 'tm-grid' );

if ( $username !== '' ) {
	$media_array = Atomlab_Instagram::scrape_instagram( $username, $number_items );
	if ( is_wp_error( $media_array ) ) {
		?>
		<div class="tm-instagram--error">
			<?php echo '<p>' . $media_array->get_error_message() . '</p>'; ?>
		</div>
		<?php
	} else {
		?>
		<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>"
			<?php if ( in_array( $style, array( 'grid' ) ) ) : ?>
				data-type="masonry"
				<?php
				$arr = explode( ';', $columns );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
				}
				?>
			<?php endif; ?>

			<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
				data-gutter="<?php echo esc_attr( $gutter ); ?>"
			<?php endif; ?>
		>
			<?php
			?>

			<?php if ( $text !== '' ) : ?>
				<div class="instagram-text"><?php echo $text; ?></div>
			<?php endif; ?>

			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php if ( in_array( $style, array( 'grid' ) ) ) : ?>
					<div class="grid-sizer"></div>
				<?php endif; ?>

				<?php foreach ( $media_array as $item ) { ?>
					<div class="grid-item">
						<div class="inner">
							<a href="<?php echo esc_url( $item['link'] ); ?>"
								<?php if ( '1' === $link_target ) : ?>
									target="_blank"
								<?php endif; ?>
							>
								<img src="<?php echo esc_url( $item[ $size ] ); ?>" class="item-image"
								     alt="<?php esc_attr_e( 'Instagram Photo', 'atomlab' ); ?>"/>
								<?php if ( 'video' === $item['type'] ) : ?>
									<span class="play-button"></span>
								<?php endif; ?>
								<div class="overlay">
									<?php if ( '1' === $overlay ) : ?>
										<div class="item-info">
											<span class="likes"><?php echo esc_html( $item['likes'] ); ?></span>
											<span class="comments"><?php echo esc_html( $item['comments'] ); ?></span>
										</div>
									<?php endif; ?>

								</div>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>

			<?php if ( $show_user_name === '1' ) : ?>
				<div class="instagram-user-name">
					<?php echo '@' . esc_html( $username ); ?>
				</div>
			<?php endif; ?>

		</div>
	<?php }
} ?>
