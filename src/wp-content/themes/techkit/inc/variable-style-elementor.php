<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$primary_color     = TechkitTheme::$options['primary_color']; // #0554f2
$primary_rgb       = TechkitTheme_Helper::hex2rgb( $primary_color ); // 5, 84, 242
$secondary_color   = TechkitTheme::$options['secondary_color']; // #14133b
$secondary_rgb     = TechkitTheme_Helper::hex2rgb( $secondary_color ); // 20, 19, 59

/*---------------------------------    
INDEX
===================================
#. EL: Section Title
#. EL: Slider
#. EL: Owl Nav 1
#. EL: Owl Nav 2
#. EL: Owl Nav 3
#. EL: Text/image With Button
#. EL: Info Box
#. EL: Counter
#. EL: Team
#. EL: Case Study
#. EL: Service Layout
#. EL: Testimonial
#. EL: Post Grid
#. EL: Pricing Table
#. EL: Tab Form
#. EL: Widget
#. EL: Others
----------------------------------*/

/*-----------------------
#. EL: Section Title
------------------------*/
?>
.sec-title .sub-title,
.sec-title .rtin-title span,
.title-text-button .rtin-title span,
.title-text-button .rtin-custom-text span {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.sec-title .section-line,
.sec-title.style3 .sub-title:before,
.title-text-button.barshow .subtitle::before {
	background: <?php echo esc_html($primary_color); ?>;
}
.title-text-button .rtin-custom-text {
    border-color: <?php echo esc_html($primary_color); ?>;
}
<?php
/*-----------------------
#. EL: Slider
------------------------*/
?>
.banner-slider .slider-content .sub-title:before {
    background: <?php echo esc_html( $primary_color );?>;
}
<?php
/*------------------------------
#. EL: Text/image With Button
-------------------------------*/
?>
.title-text-button ul.single-list li:after,
.title-text-button ul.dubble-list li:after {
	color: <?php echo esc_html($primary_color); ?>;
}
.title-text-button .subtitle {
	color: <?php echo esc_html($primary_color); ?>;
}
.title-text-button.text-style1 .subtitle:after {
	background: <?php echo esc_html($secondary_color); ?>;
}
.about-image-text .about-content .sub-rtin-title {
	color: <?php echo esc_html($primary_color); ?>;
}
.about-image-text ul li:before {
	color: <?php echo esc_html($primary_color); ?>;
}
.about-image-text ul li:after {
	color: <?php echo esc_html($primary_color); ?>;
}
.image-style1 .image-content {
	background-color: <?php echo esc_html($primary_color); ?>;
}
<?php
/*-------------------------------------
#. EL: Owl Nav 1
---------------------------------------*/
?>
.rt-owl-nav-1.slider-nav-enabled .owl-carousel .owl-nav > div {
	border-color: <?php echo esc_html($primary_color); ?>;
	color: <?php echo esc_html($primary_color); ?>;
}
.rt-owl-nav-1.slider-nav-enabled .owl-carousel .owl-nav > div:hover {
	background-color: <?php echo esc_html($primary_color); ?>;
}
<?php
/*-------------------------------------
#. EL: Owl Nav 2
---------------------------------------*/
?>
.rt-owl-nav-2.slider-dot-enabled .owl-carousel .owl-dot:hover span,
.rt-owl-nav-2.slider-dot-enabled .owl-carousel .owl-dot.active span {
	background-color: <?php echo esc_html($primary_color); ?>;
}
.rt-owl-nav-2.slider-nav-enabled .owl-carousel .owl-nav > div:hover {
	background: <?php echo esc_html($secondary_color); ?>;
}
<?php
/*-------------------------------------
#. EL: Info Box
---------------------------------------*/
?>
.info-box .rtin-item .rtin-icon {
	color: <?php echo esc_html($primary_color); ?>;
}
.info-box .rtin-title a:hover {
	color: <?php echo esc_html($primary_color); ?>;
}
.info-style1:hover,
.info-style4 .info-overlay,
.info-style5 .info-overlay,
.info-style7 .animted-bg,
.info-style8 .info-overlay {
    background-color: <?php echo esc_html($primary_color); ?>;
}
.feature-style1 .rtin-item .rtin-number,
.feature-style1 .rtin-item .rtin-title a:hover {
	color: <?php echo esc_html($primary_color); ?>;
}
.feature-style1 .rtin-item:hover .rtin-number,
.feature-style1 .rtin-item:hover::after {
    background-color: <?php echo esc_html($primary_color); ?>;
}
<?php
/*-----------------------
#. EL: Counter
------------------------*/
?>
.rt-counter .rtin-item .rtin-counter {
	color: <?php echo esc_html($primary_color); ?>;
}
.rtin-progress-bar .progress .progress-bar,
.rtin-skills .rtin-skill-each .progress .progress-bar {
	background: <?php echo esc_html($primary_color); ?>;
}
.rtin-skills .rtin-skill-each .progress .progress-bar > span:before,
.rtin-progress-bar .progress .progress-bar > span:before {
	border-top-color: <?php echo esc_html($primary_color); ?>;
}
.rt-counter.rtin-counter-style2 .rtin-item svg path {
    stroke: <?php echo esc_html($secondary_color); ?>;
}
<?php
/*------------------------------
#. EL: Team
--------------------------------*/
?>
.team-default .rtin-content .rtin-title a:hover,
.team-single .team-content-wrap ul.rtin-social li a {
	color: <?php echo esc_html($primary_color); ?>;
}
.team-single .team-content-wrap .rtin-content ul.rtin-social li a:hover {
    background-color: <?php echo esc_html($primary_color); ?>;
}
.team-single .rtin-content a:hover,
.team-single .rtin-team-info a:hover {
    color: <?php echo esc_html($primary_color); ?>;
}
.team-single .rtin-skills h3:after,
.team-single .team-contact-wrap h3:after,
.team-single .rtin-team-skill-info h3:after {
	background-color: <?php echo esc_html($primary_color); ?>;
}
.team-multi-layout-1 .rtin-item .rtin-social li a {
    color: <?php echo esc_html($primary_color); ?>;
}
.team-multi-layout-1 .rtin-item .rtin-social li a:hover {
    background-color: <?php echo esc_html($primary_color); ?>;
}
.team-multi-layout-2 .rtin-social li a {
	color: <?php echo esc_html($primary_color); ?>;
}
.team-multi-layout-2 .rtin-social li a:hover {
	background-color: <?php echo esc_html($primary_color); ?>;
}
.team-multi-layout-3 .rtin-item .rtin-content-wrap .rtin-content:after {
	background-color: <?php echo esc_html($primary_color); ?>;
}
.team-multi-layout-3 .rtin-social li a:hover {
	color: <?php echo esc_html($secondary_color); ?>;
}
<?php
/*------------------------------
#. EL: Case Study
--------------------------------*/
?>
.case-multi-layout-1 .rtin-item .rtin-content {
    background-color: <?php echo esc_html($secondary_color); ?>;
}
.case-multi-layout-1 .rtin-item:hover .rtin-content,
.case-multi-layout-2 .rtin-item .img-popup-icon:hover,
.case-multi-layout-3 .rtin-item .rtin-content,
.case-multi-layout-6 .rtin-item .rtin-figure .link:hover {
    background-color: <?php echo esc_html($primary_color); ?>;
}
.case-multi-layout-2 .rtin-item .item-overlay {
    background-color: rgba(<?php echo esc_html( $secondary_rgb );?>, 0.8);
}
.case-multi-layout-5 .rtin-item .rtin-figure:after {
    background-color: rgba(<?php echo esc_html( $primary_rgb );?>, 0.7);
}
.case-multi-layout-6 .rtin-item::before {
    background-color: rgba(<?php echo esc_html( $secondary_rgb );?>, 0.75);
}
.case-cat-tab a.current,
.case-multi-layout-3 .rtin-item .link,
.case-multi-layout-5 .rtin-item .link,
.case-multi-layout-5 .rtin-item:hover .rtin-title a,
.case-multi-layout-6 .rtin-item .rtin-figure .link,
.case-multi-isotope-1 .rt-cat a:hover, 
.case-multi-isotope-1 .rtin-item .rtin-title a:hover {
    color: <?php echo esc_html($primary_color); ?>;
}
.case-single .rtin-play:hover,
.case-single .case-header ul li i,
.case-single .case-header .rtin-title,
.case-single .case-header ul li a:hover {
    color: <?php echo esc_html($primary_color); ?>;
}
.case-single .rtin-play:before {
    background-color: <?php echo esc_html($primary_color); ?>;
}
.case-multi-layout-4 .rtin-item:hover .rtin-content::before {
	background-image: linear-gradient(transparent, <?php echo esc_html( $primary_color );?>), linear-gradient(transparent, <?php echo esc_html( $primary_color );?>);
}
.case-multi-isotope-1 .item-overlay {
    background: rgba(<?php echo esc_html( $primary_rgb );?>, 0.8);
}
<?php
/*------------------------------
#. EL: Service Layout
--------------------------------*/
?>
.service-layout1 .rtin-item .rtin-header i,
.service-layout2 .rtin-item .rtin-header i,
.service-layout3 .rtin-item .rtin-header i,
.service-layout4 .rtin-item .rtin-header i,
.service-single .single-service-inner ul li i,
.widget_techkit_download .download-list .item-icon i,
.widget_techkit_about_author .author-widget .about-social li a {
    color: <?php echo esc_html($primary_color); ?>;
}
.service-layout1 .rtin-item .services-item-overlay,
.service-layout2 .rtin-item .services-item-overlay,
.service-layout4 .rtin-item .services-item-overlay {
	background-color: <?php echo esc_html($primary_color); ?>;
}
.service-single .single-service-inner .post-thumb .service-icon {
	background-color: <?php echo esc_html($primary_color); ?>;
}
.rtel-tab-toggle .nav-item .nav-link.active {
    color: <?php echo esc_html($primary_color); ?>;
}
.rtel-tab-toggle .nav-item .nav-link::before {
	background-color: <?php echo esc_html($primary_color); ?>;
}
<?php
/*------------------------------
#. EL: Testimonial
--------------------------------*/
?>
.rtin-testimonial-2 .rtin-item .rtin-name::after,
.rtin-testimonial-2 .rtin-item .rtin-thumb .quote,
.rtin-testimonial-3 .rtin-item .item-icon .quote {
	background-color: <?php echo esc_html($primary_color); ?>;
}

<?php
/*------------------------------
#. EL: Post Grid
--------------------------------*/
?>
.post-default .rtin-item-post .blog-cat {
	background-color: <?php echo esc_html($primary_color); ?>;
}
.post-default ul.post-grid-meta li i,
.post-default ul.post-grid-meta li a:hover,
.post-grid-style1 .rtin-item-post .blog-date i,
.post-default .rtin-item-post .rtin-content h3 a:hover,
.post-default.post-grid-style4 .rtin-item-post .blog-cat a {
    color: <?php echo esc_html($primary_color); ?>;
}
.post-grid-style4 .rtin-item-post .rtin-img:after {
	background-image: linear-gradient(transparent, <?php echo esc_html( $primary_color );?>), linear-gradient(transparent, <?php echo esc_html( $primary_color );?>);
}
<?php
/*------------------------------
#. EL: Pricing Table
--------------------------------*/
?>
.offer-active .rt-price-table-box .offer,
.offer-active .rt-price-table-box .popular-shape:after {
    background: <?php echo esc_html( $primary_color );?>;
}
.rtin-pricing-layout1 .rtin-pricing-price .rtin-price,
.rtin-pricing-layout2 .rtin-pricing-price .rtin-price {
	color: <?php echo esc_html($primary_color); ?>;
}
.rtin-pricing-layout1 .rt-price-table-box:hover,
.rtin-pricing-layout1 .rt-price-table-box::before, 
.rtin-pricing-layout1 .rt-price-table-box::after,
.rtin-pricing-layout2 .rt-price-table-box:hover {
    background-color: <?php echo esc_html($primary_color); ?>;
}
.rtin-pricing-layout1 .rt-price-table-box .button-style-3,
.rtin-pricing-layout2 .rt-price-table-box .button-style-3,
.rtin-pricing-layout2 .rt-price-table-box:hover {
    border-color: <?php echo esc_html($primary_color); ?>;
}
.rtin-pricing-layout2 .rt-price-table-box .header-wrap {
    background: <?php echo esc_html( $primary_color );?>;
}
<?php
/*------------------------------
#. EL: Tab Form
--------------------------------*/
?>
.tab-form-1 .elementor-tabs .elementor-tab-title.elementor-active,
.tab-form-1 .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title a:hover {
    color: <?php echo esc_html( $primary_color );?>;
}
.tab-form-1 .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title a:after {
    background-color: <?php echo esc_html( $primary_color );?>;
}
<?php
/*------------------------------
#. EL: Widget
--------------------------------*/
?>
.fixed-sidebar-left .elementor-widget-wp-widget-nav_menu ul > li > a:hover,
.fix-bar-bottom-copyright .rt-about-widget ul li a:hover, 
.fixed-sidebar-left .rt-about-widget ul li a:hover {
	color: <?php echo esc_html( $primary_color );?>;
}
.element-side-title h5:after {
    background: <?php echo esc_html( $secondary_color );?>;
}
<?php
/*------------------------------
#. EL: Others
--------------------------------*/
?>
.fixed-sidebar-addon .rt-about-widget .footer-social li a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rtin-address-default .rtin-item .rtin-icon,
.rtin-story .story-layout .story-box-layout .rtin-year,
.apply-item .apply-footer .job-meta .item .primary-text-color,
.apply-item .job-button .button-style-2 {
	color: <?php echo esc_html( $primary_color );?>;
}
.apply-item .button-style-2.btn-common path.rt-button-cap {
    stroke: <?php echo esc_html( $primary_color );?>;
}
.img-content-left .title-small,
.img-content-right .title-small,
.multiscroll-wrapper .ms-social-link li a:hover,
.multiscroll-wrapper .ms-copyright a:hover {
	color: <?php echo esc_html( $primary_color );?>;
}
.ms-menu-list li.active {
	background: <?php echo esc_html( $primary_color );?>;
}
.video-style4 .rtin-video .shape,
.video-default .rtin-video .item-icon .rtin-play:before,
.rtin-story .story-layout .timeline-circle:before {
    background-color: <?php echo esc_html( $primary_color );?>;
}
.rt-accordion .accordion-header .accordion-button:not(.collapsed),
.elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active {
    background-color: <?php echo esc_html( $primary_color );?>;
}
.rtin-contact-info .rtin-icon,
.rtin-contact-info .rtin-text a:hover {
	color: <?php echo esc_html( $primary_color );?>;
}



