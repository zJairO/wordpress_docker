<?php
$text = Atomlab::setting( 'top_bar_style_01_text' );

$right_col_class = 'col-md-6';

if ( $text === '' ) {
	$right_col_class = 'col-md-12';
}
?>
<div class="page-top-bar top-bar-01">
	<div class="container-fluid">
		<div class="row row-xs-center">

			<?php if ( $text !== '' ): ?>
				<div class="col-md-6">
					<div class="top-bar-wrap top-bar-left">
						<?php echo '<div class="top-bar-text">' . $text . '</div>' ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="<?php echo esc_attr( $right_col_class ); ?>">
				<div class="top-bar-wrap top-bar-right">

					<?php Atomlab_Templates::top_bar_info( '01' ); ?>

					<?php Atomlab_Templates::top_bar_button( '01' ); ?>

				</div>
			</div>
		</div>
	</div>
</div>
