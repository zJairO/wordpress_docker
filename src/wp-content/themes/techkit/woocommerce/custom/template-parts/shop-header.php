<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( TechkitTheme::$layout == 'full-width' ) {
	$techkit_layout_class = 'col-sm-12 col-12';
}  else {
	$techkit_layout_class = TechkitTheme_Helper::has_active_widget();	
}
?>
<div id="primary" class="section content-area customize-content-selector">
	<div class="container">
		<div class="row gutters-40">	
			<?php if ( TechkitTheme::$layout == 'left-sidebar' ) { ?>
				<div class="col-lg-4 col-md-12 col-12 fixed-bar-coloum">
					<aside class="sidebar-widget-area">
						<?php if ( is_active_sidebar( 'shop-sidebar-1' ) ) dynamic_sidebar( 'shop-sidebar-1' ); ?>
					</aside>
				</div>
			<?php } ?>	
			<div class="<?php echo esc_attr( $techkit_layout_class );?>">		
				<main id="main" class="site-main page-content-main">