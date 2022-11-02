<?php
$footer_page = Atomlab_Helper::get_post_meta( 'footer_page', 'default' );

if ( $footer_page === 'default' ) {
	$footer_page = Atomlab::setting( 'footer_page' );
}

if ( $footer_page === '' ) {
	return;
}

$_atomlab_args = array(
	'post_type' => 'ic_footer',
	'name'      => $footer_page,
);

$_atomlab_query = new WP_Query( $_atomlab_args );
?>
<?php if ( $_atomlab_query->have_posts() ) { ?>
	<?php while ( $_atomlab_query->have_posts() ) : $_atomlab_query->the_post(); ?>
		<?php
		$footer_options      = Atomlab_Helper::get_the_footer_page_options();
		$footer_wrap_classes = "page-footer-wrapper $footer_page";
		$_effect             = Atomlab_Helper::get_the_post_meta( $footer_options, 'effect', '' );

		if ( $_effect !== '' ) {
			$footer_wrap_classes .= " {$_effect}";
		}
		?>
		<div id="page-footer-wrapper" class="<?php echo esc_attr( $footer_wrap_classes ); ?>">
			<div id="page-footer" <?php Atomlab::footer_class(); ?>>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-footer-inner">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	endwhile;
}
wp_reset_postdata();
