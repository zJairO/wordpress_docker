<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style = $el_class = $icon_type = $icon_color = $icon_svg_animate_type = $image = $text = $button = $button_color = $link = $box_link = $animation = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-box-icon-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-box-icon ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Atomlab_Helper::get_animation_classes( $animation );

$box_link = vc_build_link( $box_link );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	if ( $overlay_background !== '' ) {
		$_overlay_style   = '';
		$_overlay_classes = 'overlay';
		if ( $overlay_background === 'primary' ) {
			$_overlay_classes .= ' primary-background-color';
		} elseif ( $overlay_background === 'overlay_custom_background' ) {
			$_overlay_style .= 'background-color: ' . $overlay_custom_background . ';';
		}
		$_overlay_style .= 'opacity: ' . $overlay_opacity / 100 . ';';

		printf( '<div class="%s" style="%s"></div>', esc_attr( $_overlay_classes ), esc_attr( $_overlay_style ) );
	}
	?>

	<?php
	if ( $box_link['url'] !== '' ) :
		$_target = $box_link['target'] !== '' ? ' target="_blank"' : '';
		$_rel    = $box_link['rel'] !== '' ? ' rel="' . $box_link['rel'] . '"' : '';

		echo '<a href="' . esc_url( $box_link['url'] ) . '"' . $_target . $_rel . ' class="link-secret">';
	endif;
	?>

	<div class="content-wrap">

		<?php if ( $image ) : ?>
			<div class="image">
				<?php
				$full_image_size = wp_get_attachment_url( $image );
				Atomlab_Helper::get_lazy_load_image( array(
					'url'    => $full_image_size,
					'width'  => 500,
					'height' => 286,
					'crop'   => true,
					'echo'   => true,
				) );
				?>
			</div>
		<?php endif; ?>

		<?php if ( ! in_array( $style, array( '3' ) ) ) : ?>
			<?php if ( isset( ${"icon_$icon_type"} ) && ${"icon_$icon_type"} !== '' ) { ?>
				<?php
				$_args = array(
					'type'        => $icon_type,
					'icon'        => ${"icon_$icon_type"},
					'svg_animate' => $icon_svg_animate_type,
				);

				if ( in_array( $style, array( '12', '13', '14' ) ) ) {
					$_args['parent_hover'] = "#$css_id";
				}

				Atomlab_Helper::get_vc_icon_template( $_args );
				?>
			<?php } ?>
		<?php endif; ?>

		<div class="content">
			<div class="box-header">

				<?php if ( in_array( $style, array( '3' ) ) ) : ?>
					<?php if ( isset( ${"icon_$icon_type"} ) && ${"icon_$icon_type"} !== '' ) { ?>
						<?php Atomlab_Helper::get_vc_icon_template( array(
							'type'        => $icon_type,
							'icon'        => ${"icon_$icon_type"},
							'svg_animate' => $icon_svg_animate_type,
						) ) ?>
					<?php } ?>
				<?php endif; ?>

				<?php if ( $heading ) : ?>
					<h4 class="heading">
						<?php
						// Item Link.
						$link = vc_build_link( $link );
						if ( $box_link['url'] === '' && $link['url'] !== '' ) {
						?>
						<a class="link-secret" href="<?php echo esc_url( $link['url'] ); ?>"
							<?php if ( $link['target'] !== '' ): ?>
								target="<?php echo esc_attr( $link['target'] ); ?>"
							<?php endif; ?>
						>
							<?php } ?>

							<?php echo esc_html( $heading ); ?>

							<?php if ( $box_link['url'] === '' && $link['url'] !== '' ) { ?>
						</a>
					<?php } ?>

					</h4>
				<?php endif; ?>
			</div>

			<?php if ( $text ) : ?>
				<?php echo '<div class="text">' . $text . '</div>'; ?>
			<?php endif; ?>

			<?php if ( $box_link['url'] === '' ) { ?>
				<?php
				// Button.
				if ( $button && $button !== '' ) {
					$button = vc_build_link( $button );
					if ( $button['url'] !== '' ) {
						$button_classes = 'tm-button style-text tm-button-primary tm-box-icon__btn';
						if ( $button_color === 'primary' ) {
							$button_classes .= ' tm-button-primary';
						} elseif ( $button_color === 'secondary' ) {
							$button_classes .= ' tm-button-secondary';
						}
						?>
						<a class="<?php echo esc_attr( $button_classes ); ?>"
						   href="<?php echo esc_url( $button['url'] ) ?>"
							<?php if ( $button['target'] !== '' ) { ?>
								target="<?php echo esc_attr( $button['target'] ); ?>"
							<?php } ?>
						>
							<span class="button-text"><?php echo esc_html( $button['title'] ); ?></span>
							<span class="button-icon ion-arrow-right-c"></span>
						</a>
					<?php }
				} ?>
			<?php } ?>

		</div>
	</div>

	<?php
	if ( $box_link['url'] !== '' ) :
		echo '</a>';
	endif;
	?>
</div>
