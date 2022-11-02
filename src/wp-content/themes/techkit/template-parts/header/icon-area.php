<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
<?php if ( TechkitTheme::$options['search_icon'] || TechkitTheme::$options['cart_icon'] ) { ?>
<div class="header-icon-area">
	<?php	
	if ( TechkitTheme::$options['search_icon'] ) {
		get_template_part( 'template-parts/header/icon', 'search' );
	}
	if ( TechkitTheme::$options['cart_icon'] ){
		get_template_part( 'template-parts/header/icon', 'cart' );
	}
	?>
</div>
<?php } ?>