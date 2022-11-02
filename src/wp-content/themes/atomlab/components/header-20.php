<header id="page-header" <?php Atomlab::header_class(); ?>>
	<div id="page-header-inner" class="page-header-inner" data-sticky="0">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">

						<div class="header-left">
							<?php get_template_part( 'components/branding' ); ?>

							<?php get_template_part( 'components/navigation' ); ?>

							<?php Atomlab_Woo::render_mini_cart(); ?>

							<?php Atomlab_Templates::header_search_button(); ?>
						</div>

						<div class="header-right">

							<?php Atomlab_Templates::header_mail_chimp_form(); ?>

							<?php Atomlab_Templates::header_open_mobile_menu_button(); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
