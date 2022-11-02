<header id="page-header" <?php Atomlab::header_class(); ?>>
	<div id="page-header-inner" class="page-header-inner" data-has-fixed-section="1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">

						<div class="branding-wrap">
							<?php get_template_part( 'components/branding' ); ?>
						</div>

						<div class="header-right-wrap">

							<div class="header-left">

								<?php Atomlab_Templates::header_search_form(); ?>

							</div>

							<?php get_template_part( 'components/navigation' ); ?>

							<div class="header-right">

								<?php Atomlab_Templates::header_social_networks(); ?>

								<?php Atomlab_Woo::render_mini_cart(); ?>

								<?php Atomlab_Templates::header_open_mobile_menu_button(); ?>

								<?php Atomlab_Templates::header_button(); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="header-left-fixed" class="header-fixed-section page-sidebar-fixed">
		<div class="inner" data-slim-scroll="1">
			<div class="page-sidebar">
				<div class="page-sidebar-content">
					<?php Atomlab_Templates::generated_sidebar( 'left_header_widget' ); ?>
				</div>
			</div>
		</div>
	</div>
</header>
