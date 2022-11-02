<header id="page-header" <?php Atomlab::header_class(); ?>>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">

						<?php get_template_part( 'components/branding' ); ?>

						<?php get_template_part( 'components/navigation' ); ?>

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
</header>
