<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>


<?php if ( TechkitTheme::$options['search_icon'] ) { ?>
<div class="info-menu-bar" id="header-menu">
	<?php if ( TechkitTheme::$options['search_icon'] ) { ?>
	<div class="header-search-box">
		<a class="glass-icon" href="#header-search" title="<?php esc_attr_e( 'Search', 'techkit');?>">
			<i class="fas fa-search"></i>
		</a>
		<a class="cross-icon" href="#header-cross" title="<?php esc_attr_e( 'Search', 'techkit');?>">
		  <i class="fa fa-times" aria-hidden="true"></i>
		</a>
		<div class="header-search-field">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) )  ?>" class="search-form">
				<input required="" type="text" id="search-form-5f51fb188e3b0" class="search-field" placeholder="<?php esc_attr_e( 'Search …', 'techkit');?>" value="" name="s">
				<button class="search-button" type="submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</form>
		</div>
	</div>
	<?php } ?>
</div>
<?php } ?>