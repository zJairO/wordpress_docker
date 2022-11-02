<?php
global $product;
do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="isw-swatches isw-swatches--in-single variations_form cart"
      method="post"
      enctype="multipart/form-data"
      data-product_id="<?php echo absint( get_the_ID() ); ?>"
      data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php
	do_action( 'woocommerce_before_variations_form' );
	if ( empty( $available_variations ) && false !== $available_variations ) {
		?>
		<p class="stock out-of-stock"><?php esc_html__( 'This product is currently out of stock and unavailable.', 'insight-swatches' ) ?></p>
	<?php } else {
		?>
		<table class="variations" cellspacing="0">
			<tbody>
			<?php
			foreach ( $attributes as $attribute_name => $options ) {
				$attr_id        = wc_attribute_taxonomy_id_by_name( $attribute_name );
				$attr_info      = wc_get_attribute( $attr_id );
				$term_sanitized = Insight_Swatches_Utils::utf8_urldecode( $attribute_name );
				$curr['type']   = isset( $attr_info->type ) ? $attr_info->type : 'select';
				$curr['slug']   = isset( $attr_info->slug ) ? $attr_info->slug : '';
				$curr['name']   = isset( $attr_info->name ) ? $attr_info->name : '';
				if ( taxonomy_exists( $term_sanitized ) ) {
					$curr['terms'] = wp_get_post_terms( $product->get_id(), $term_sanitized, array( 'hide_empty' => false ) );
				}
				?>
				<tr>
					<td class="label">
						<label for="<?php echo esc_attr( $curr['slug'] ); ?>">
							<span><?php echo( $curr['name'] ? $curr['name'] : wc_attribute_label( $attribute_name ) ); ?></span>
						</label>
					</td>
					<td class="value">
						<?php if ( ( $curr['type'] != '' ) && ( $curr['type'] != 'select' ) ) { ?>
							<div class="isw-swatch isw-swatch--isw_<?php echo esc_attr( $curr['type'] ); ?>"
							     data-attribute="<?php echo esc_attr( $attribute_name ); ?>">
								<?php
								switch ( $curr['type'] ) {
									case 'text' :
										foreach ( $curr['terms'] as $l => $b ) {
											$val     = get_term_meta( $b->term_id, 'sw_text', true ) ? get_term_meta( $b->term_id, 'sw_text', true ) : $b->name;
											$tooltip = get_term_meta( $b->term_id, 'sw_tooltip', true ) ? get_term_meta( $b->term_id, 'sw_tooltip', true ) : $val;
											?>
											<span
												class="isw-term <?php echo apply_filters( 'isw_term_class', '', $b ); ?>"
												aria-label="<?php echo esc_attr( $tooltip ); ?>"
												title="<?php echo esc_attr( $tooltip ); ?>"
												data-term="<?php echo esc_attr( $b->slug ); ?>"><?php echo esc_html( $val ); ?></span>
											<?php
										}
										break;
									case 'color':
										foreach ( $curr['terms'] as $l => $b ) {
											$val     = get_term_meta( $b->term_id, 'sw_color', true ) ? get_term_meta( $b->term_id, 'sw_color', true ) : '#fff';
											$tooltip = get_term_meta( $b->term_id, 'sw_tooltip', true ) ? get_term_meta( $b->term_id, 'sw_tooltip', true ) : $b->name;
											?>
											<div
												class="isw-term hint--top hint--rounded hint--bounce <?php echo apply_filters( 'isw_term_class', '', $b ); ?>"
												data-term="<?php echo esc_attr( $b->slug ); ?>"
												aria-label="<?php echo esc_attr( $tooltip ); ?>"
												title="<?php echo esc_attr( $tooltip ); ?>"
											>
												<?php echo $b->name; ?>
												<span style="background-color: <?php echo esc_attr( $val ); ?>"></span>
											</div>
											<?php
										}
										break;
									case 'image':
										foreach ( $curr['terms'] as $l => $b ) {
											$val     = get_term_meta( $b->term_id, 'sw_image', true ) ? wp_get_attachment_thumb_url( get_term_meta( $b->term_id, 'sw_image', true ) ) : wc_placeholder_img_src();
											$tooltip = get_term_meta( $b->term_id, 'sw_tooltip', true ) ? get_term_meta( $b->term_id, 'sw_tooltip', true ) : $b->name;
											?>
											<span
												class="isw-term <?php echo apply_filters( 'isw_term_class', '', $b ); ?>"
												aria-label="<?php echo esc_attr( $tooltip ); ?>"
												title="<?php echo esc_attr( $tooltip ); ?>"
												data-term="<?php echo esc_attr( $b->slug ); ?>"><img
													src="<?php echo esc_url( $val ); ?>"
													alt="<?php echo $b->name; ?>"/></span>
											<?php
										}
										break;
									default:
										break;
								}
								?>
							</div>
						<?php }
						if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) {
							$selected = $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ];
						} else if ( isset( $selected_attributes[ sanitize_title( $attribute_name ) ] ) ) {
							$selected = $selected_attributes[ sanitize_title( $attribute_name ) ];
						} else {
							$selected = '';
						}
						if ( ! $attr_info ) {
							$attr_data      = $options->get_data();
							$attribute_name = $attr_data['name'];
						}
						$args = array(
							'options'   => $variation_attributes[ $attribute_name ],
							'attribute' => $attribute_name,
							'product'   => $product,
							'selected'  => $selected,
							'class'     => 'isw-dropdown-' . $curr['type'],
						);
						wc_dropdown_variation_attribute_options( $args );
						?>
						<a class="reset_variations reset_variations--single"
						   href="#"><?php esc_html_e( 'Clear', 'insight-swatches' ); ?></a>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<div class="single_variation_wrap">
			<?php
			/**
			 * woocommerce_before_single_variation Hook
			 */
			do_action( 'woocommerce_before_single_variation' );

			/**
			 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
			 *
			 * @since  2.4.0
			 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
			 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
			 */
			do_action( 'woocommerce_single_variation' );

			/**
			 * woocommerce_after_single_variation Hook
			 */
			do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php } ?>
	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
