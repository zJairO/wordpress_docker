<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php
		// Preloader	
		if ( TechkitTheme::$options['preloader'] ) {	
			if( !empty( TechkitTheme::$options['preloader_image'] ) ) {
				$pre_bg = wp_get_attachment_image_src( TechkitTheme::$options['preloader_image'], 'full', true );
				$preloader_img = $pre_bg[0];
				echo '<div id="preloader" style="background-image:url(' . esc_url($preloader_img) . ');"></div>';
			}else { ?>				
				<div id="preloader" class="loader">
			      	<div class="cssload-loader">
				        <div class="cssload-inner cssload-one"></div>
				        <div class="cssload-inner cssload-two"></div>
				        <div class="cssload-inner cssload-three"></div>
			      	</div>
			    </div>
			<?php }	            
		}
	?>
	<div id="page" class="site">		
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'techkit' ); ?></a>		
		<header id="masthead" class="site-header">	
			<div id="header-<?php echo esc_attr( TechkitTheme::$header_style ); ?>" class="header-area">
				<?php if ( TechkitTheme::$top_bar == 1 || TechkitTheme::$top_bar === "on" ){ ?>			
				<?php get_template_part( 'template-parts/header/header-top', TechkitTheme::$top_bar_style ); ?>
				<?php } ?>

				<?php if ( TechkitTheme::$header_opt == 1 || TechkitTheme::$header_opt === "on" ){ ?>
				<?php get_template_part( 'template-parts/header/header', TechkitTheme::$header_style ); ?>
				<?php } ?>
			</div>
		</header>		
		<?php get_template_part('template-parts/header/mobile', 'menu');?>		
		<div id="content" class="site-content">			
			<?php
				if ( TechkitTheme::$has_banner === 1 || TechkitTheme::$has_banner === "on" ) { 
					get_template_part('template-parts/content', 'banner');
				}
			?>
			<div id="header-search" class="header-search">
	            <button type="button" class="close">×</button>
	            <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	                <input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e( 'Type your search........', 'techkit' ); ?>">
	                <button type="submit" class="search-btn">
	                    <i class="fas fa-search"></i>
	                </button>
	            </form>
	        </div>