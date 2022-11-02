<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style = $el_class = '';
$nav   = $pagination = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-team-member-group-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-team-member-group tm-swiper ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-slide-wrap="1"
     data-lg-items="3"
     data-sm-items="2"
     data-xs-items="1"
     data-lg-gutter="60"
     data-md-gutter="40"
     data-sm-gutter="30"
     data-loop="1"
     data-autoplay="5000"
     data-speed="2000"

	<?php if ( $nav !== '' ) : ?>
		data-nav="1"
	<?php endif; ?>

	<?php if ( $pagination !== '' ) : ?>
		data-pagination="1"
	<?php endif; ?>
>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php echo wpb_js_remove_wpautop( $content ); ?>
		</div>
	</div>
</div>
