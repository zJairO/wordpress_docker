<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$nav_menu_args = TechkitTheme_Helper::nav_menu_args();

if( !empty( TechkitTheme::$options['logo'] ) ) {
    $logo_dark = wp_get_attachment_image( TechkitTheme::$options['logo'], 'full' );
    $techkit_dark_logo = $logo_dark;
}else {
    $techkit_dark_logo = "<img width='175' height='41' src='" . TECHKIT_IMG_URL . 'logo-dark.svg' . "' alt='" . esc_attr( get_bloginfo('name') ) . "' loading='lazy'>"; 
}

?>

<div class="rt-header-menu mean-container" id="meanmenu"> 
    <?php if ( TechkitTheme::$options['mobile_topbar'] ) { ?>
        <?php get_template_part('template-parts/header/mobile', 'topbar');?>
    <?php } ?>
    <div class="mobile-mene-bar">
        <div class="mean-bar">
        	<a href="<?php echo esc_url(home_url('/'));?>"><?php echo wp_kses( $techkit_dark_logo, 'alltext_allow' ); ?></a>
            <span class="sidebarBtn ">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </span>
        </div>    
        <div class="rt-slide-nav">
            <div class="offscreen-navigation">
                <?php wp_nav_menu( $nav_menu_args );?>
            </div>
        </div>
    </div>
</div>
