<header id="page-header" <?php Atomlab::header_class(); ?>>
	<div id="page-header-inner" class="page-header-inner" data-has-fixed-section="1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">
						<?php get_template_part( 'components/branding' ); ?>

						<div class="header-right">

							<?php Atomlab_Woo::render_mini_cart(); ?>

							<?php Atomlab_Templates::header_search_button(); ?>

							<?php Atomlab_Templates::header_open_mobile_menu_button(); ?>

							<?php Atomlab_Templates::header_button(); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="header-left-fixed" class="header-fixed-section left page-sidebar-fixed page-sidebar">
		<div class="inner">
			<?php Atomlab_Templates::header_open_canvas_menu_button( array( 'menu_title' => true ) ); ?>
		</div>
	</div>

	<div id="header-right-fixed" class="header-fixed-section right">
		<div class="inner">
			<?php Atomlab_Templates::header_social_networks(); ?>

			<?php Atomlab_Woo::render_mini_cart(); ?>

			<?php Atomlab_Templates::header_open_mobile_menu_button(); ?>

			<?php Atomlab_Templates::header_button(); ?>
		</div>
	</div>

	<?php get_template_part( 'components/off-canvas' ); ?>
</header>
