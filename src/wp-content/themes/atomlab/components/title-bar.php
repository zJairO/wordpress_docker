<?php
$title_bar_layout = Atomlab_Global::instance()->get_title_bar_type();

if ( $title_bar_layout === 'none' ) {
	return;
}

$breadcrumb_enable = Atomlab::setting( "title_bar_{$title_bar_layout}_breadcrumb_enable" );

$title = Atomlab_Helper::get_post_meta( 'page_title_bar_custom_heading', '' );
if ( $title === '' ) {
	if ( is_category() || is_tax() ) {
		$title = Atomlab::setting( 'title_bar_archive_category_title' ) . single_cat_title( '', false );
	} elseif ( is_home() ) {
		$title = Atomlab::setting( 'title_bar_home_title' ) . single_tag_title( '', false );
	} elseif ( is_tag() ) {
		$title = Atomlab::setting( 'title_bar_archive_tag_title' ) . single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = Atomlab::setting( 'title_bar_archive_author_title' ) . '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = Atomlab::setting( 'title_bar_archive_year_title' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'atomlab' ) );
	} elseif ( is_month() ) {
		$title = Atomlab::setting( 'title_bar_archive_month_title' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'atomlab' ) );
	} elseif ( is_day() ) {
		$title = Atomlab::setting( 'title_bar_archive_day_title' ) . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'atomlab' ) );
	} elseif ( is_post_type_archive() ) {
		if ( function_exists( 'is_shop' ) && is_shop() ) {
			$title = esc_html__( 'Shop', 'atomlab' );
		} else {
			$title = sprintf( esc_html__( 'Archives: %s', 'atomlab' ), post_type_archive_title( '', false ) );
		}
	} elseif ( is_search() ) {
		$title = Atomlab::setting( 'title_bar_search_title' ) . '"' . get_search_query() . '"';
	} elseif ( is_singular( 'post' ) ) {
		$title = Atomlab::setting( 'title_bar_single_blog_title' );
		if ( $title === '' ) {
			$title = get_the_title();
		}
	} elseif ( is_singular( 'portfolio' ) ) {
		$title = Atomlab::setting( 'title_bar_single_portfolio_title' );
		if ( $title === '' ) {
			$title = get_the_title();
		}
	} elseif ( is_singular( 'product' ) ) {
		$title = Atomlab::setting( 'title_bar_single_product_title' );
		if ( $title === '' ) {
			$title = get_the_title();
		}
	} else {
		$title = get_the_title();
	}
}
?>
<div id="page-title-bar" class="page-title-bar">
	<div class="page-title-bar-overlay"></div>

	<div class="page-title-bar-inner">
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<div class="page-title-bar-heading">
						<h1 class="heading">
							<?php echo wp_kses( $title, array(
								'span' => array(
									'class' => array(),
								),
							) ); ?>
						</h1>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
	</div>

	<?php if ( $breadcrumb_enable === '1' ): ?>
		<?php get_template_part( 'components/breadcrumb' ); ?>
	<?php endif; ?>
</div>
