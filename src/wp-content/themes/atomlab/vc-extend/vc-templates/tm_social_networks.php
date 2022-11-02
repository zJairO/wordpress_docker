<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$el_class         = $style = $layout = $tooltip_enable = $items = $target = '';
$tooltip_position = 'top';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-social-networks-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-social-networks ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style layout-$layout";

$items = (array) vc_param_group_parse_atts( $items );

$link_class = 'link';

if ( $tooltip_enable === '1' ) {
	$link_class .= " hint--bounce hint--{$tooltip_position}";
}

?>
<?php if ( count( $items ) > 0 ) { ?>
	<ul class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<?php foreach ( $items as $item ) { ?>
			<li class="item">
				<?php
				$_icon = $link_content = '';

				$icon_class = '';
				if ( isset( $item['icon_type'] ) && isset( $item["icon_{$item['icon_type']}"] ) ) {
					vc_icon_element_fonts_enqueue( $item['icon_type'] );

					$icon_class .= esc_attr( $item["icon_{$item['icon_type']}"] );
				}

				if ( $icon_class !== '' ) {
					$icon_class .= ' link-icon';
					$_icon      = '<i class="' . $icon_class . '"></i>';
				}

				if ( in_array( $style, array( 'icons', 'icon-title' ) ) ) {
					$link_content .= $_icon;
				}

				if ( in_array( $style, array(
						'title',
						'icon-title',
					) ) && isset( $item['title'] ) && $item['title'] !== '' ) {
					$link_content .= '<span class="link-text">' . $item['title'] . '</span>';
				}
				?>
				<a href="<?php echo esc_url( $item['link'] ); ?>"
					<?php if ( $target === '1' ): ?>
						target="_blank"
					<?php endif; ?>

					<?php if ( isset( $item['title'] ) ): ?>
						aria-label="<?php echo esc_attr( $item['title'] ); ?>"
					<?php endif; ?>

					<?php if ( $link_class !== '' ): ?>
						class="<?php echo esc_attr( $link_class ); ?>"
					<?php endif; ?>
				>
					<?php echo "{$link_content}"; ?>
				</a>
			</li>
		<?php } ?>
	</ul>
<?php }
