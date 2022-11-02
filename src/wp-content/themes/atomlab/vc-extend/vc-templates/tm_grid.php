<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style  = $el_class = $animation = $equal_height = $equal_height_elements = '';
$gutter = 0;

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-grid-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-grid-group ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$grid_classes = 'tm-grid';

if ( $animation === '' ) {
	$animation = Atomlab::setting( 'shortcode_portfolio_css_animation' );
}
$grid_classes .= Atomlab_Helper::get_grid_animation_classes( $animation );
?>
<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-item-wrap="1"
	<?php if ( in_array( $style, array( 'grid', 'masonry' ), true ) ) { ?>
		data-type="masonry"
	<?php } ?>

	<?php if ( in_array( $style, array( 'grid', 'masonry' ), true ) && $columns !== '' ): ?>
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

	<?php if ( $equal_height === '1' ) : ?>
		data-grid-fitrows="true"
		data-match-height="true"
	<?php endif; ?>
>

	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<?php if ( in_array( $style, array( 'grid', 'masonry' ), true ) ): ?>
			<div class="grid-sizer"></div>
		<?php endif; ?>

		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</div>
</div>

<?php if ( $equal_height_elements !== '' ) : ?>
	<script>
        jQuery( document ).ready( function ( $ ) {
            $( document ).on( 'insightGridInit', function ( e, $el, $grid ) {

                var _equal_elems = "<?php echo $equal_height_elements; ?>";
                if ( _equal_elems != '' ) {
                    $grid.find( _equal_elems ).matchHeight();
                }
            } );
        } );
	</script>
<?php endif; ?>
