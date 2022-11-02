<?php
$section  = 'typography';
$priority = 1;
$prefix   = 'typography_';

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="desc"><strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'atomlab' ) . '</strong>' . esc_html__( 'This section contains general typography options. Additional typography options for specific areas can be found within other sections. Example: For breadcrumb typography options go to the breadcrumb section.', 'atomlab' ) . '</div>',
) );

/*--------------------------------------------------------------
# Link color
--------------------------------------------------------------*/
Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Link', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of all links.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => 'a',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'link_color_hover',
	'label'       => esc_html__( 'Hover Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of all links when hover.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => 'a:hover, a:focus,
			.woocommerce-MyAccount-navigation .is-active a',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Body Typography
--------------------------------------------------------------*/
Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Body Typography', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Font family', 'atomlab' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Atomlab::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => '1.71',
		'letter-spacing' => '0',
	),
	'choices'     => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'body_color',
	'label'       => esc_html__( 'Body Text Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of body text.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#7e7e7e',
	'output'      => array(
		array(
			'element'  => 'body',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'body_font_sensitive',
	'label'       => esc_html__( 'Font sensitivity', 'atomlab' ),
	'description' => esc_html__( 'Values below 1 decrease rate of resizing, values above 1 increase rate of resizing.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'choices'     => array(
		'min'  => 0.5,
		'max'  => 1,
		'step' => 0.05,
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'body_font_size',
	'label'     => esc_html__( 'Font size', 'atomlab' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => 'body',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Heading typography
--------------------------------------------------------------*/
Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading Typography', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading',
	'label'       => esc_html__( 'Font family', 'atomlab' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.2',
		'letter-spacing' => '0',
	),
	'choices'     => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,th',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'heading_color',
	'label'       => esc_html__( 'Heading Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the color of heading.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,th,
			.tm-table caption,
            .author-social-networks a:hover,
            .tm-card.style-2 .icon,
            .tm-box-icon.style-14 .text,
            .tm-testimonial.style-5 .testimonial-desc,
            .tm-social-networks.style-icons .link,
            .tm-social-networks.style-title .item:hover .link-text,
            .portfolio-details-list label,
            .portfolio-share a:hover,
            .nav-links a:hover,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce.single-product #reviews .comment-reply-title,
			.product-sharing-list a:hover
			',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'heading_font_sensitive',
	'label'       => esc_html__( 'Font sensitivity', 'atomlab' ),
	'description' => esc_html__( 'Values below 1 decrease rate of resizing, values above 1 increase rate of resizing.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0.7,
	'choices'     => array(
		'min'  => 0.5,
		'max'  => 1,
		'step' => 0.05,
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'atomlab' ),
	'description' => esc_html__( 'H1', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 56,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h1,.h1',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 36,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h2,.h2',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 32,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h3,.h3',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 24,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h4,.h4',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 20,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h5,.h5',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h6,.h6',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Button Color
--------------------------------------------------------------*/
Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_background_color',
	'label'       => esc_html__( 'Background Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color of all buttons.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
			button, input[type="button"], input[type="reset"], input[type="submit"],
			.woocommerce #respond input#submit.disabled,
			.woocommerce #respond input#submit:disabled,
			.woocommerce #respond input#submit:disabled[disabled],
			.woocommerce a.button.disabled,
			.woocommerce a.button:disabled,
			.woocommerce a.button:disabled[disabled],
			.woocommerce button.button.disabled,
			.woocommerce button.button:disabled,
			.woocommerce button.button:disabled[disabled],
			.woocommerce input.button.disabled,
			.woocommerce input.button:disabled,
			.woocommerce input.button:disabled[disabled],
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce a.button.alt,
			.woocommerce input.button.alt,
			.woocommerce button.button.alt,
			.button',
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_border_color',
	'label'       => esc_html__( 'Border Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the border color of all buttons.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
			button, input[type="button"], input[type="reset"], input[type="submit"],
			.woocommerce #respond input#submit.disabled,
			.woocommerce #respond input#submit:disabled,
			.woocommerce #respond input#submit:disabled[disabled],
			.woocommerce a.button.disabled,
			.woocommerce a.button:disabled,
			.woocommerce a.button:disabled[disabled],
			.woocommerce button.button.disabled,
			.woocommerce button.button:disabled,
			.woocommerce button.button:disabled[disabled],
			.woocommerce input.button.disabled,
			.woocommerce input.button:disabled,
			.woocommerce input.button:disabled[disabled],
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce a.button.alt,
			.woocommerce input.button.alt,
			.woocommerce button.button.alt,
			.button',
			'property' => 'border-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_text_color',
	'label'       => esc_html__( 'Text Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the text color of all buttons.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
			button, input[type="button"], input[type="reset"], input[type="submit"],
			.woocommerce #respond input#submit.disabled,
			.woocommerce #respond input#submit:disabled,
			.woocommerce #respond input#submit:disabled[disabled],
			.woocommerce a.button.disabled,
			.woocommerce a.button:disabled,
			.woocommerce a.button:disabled[disabled],
			.woocommerce button.button.disabled,
			.woocommerce button.button:disabled,
			.woocommerce button.button:disabled[disabled],
			.woocommerce input.button.disabled,
			.woocommerce input.button:disabled,
			.woocommerce input.button:disabled[disabled],
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce a.button.alt,
			.woocommerce input.button.alt,
			.woocommerce button.button.alt,
			.button',
			'property' => 'color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Hover Colors', 'atomlab' ) . '</div>',
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_hover_background_color',
	'label'       => esc_html__( 'Background Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the background color when hover of all buttons.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba( 0, 0, 0, 0 )',
	'output'      => array(
		array(
			'element'  => '
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover',
			'property' => 'background-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_hover_border_color',
	'label'       => esc_html__( 'Border Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the border color when hover of all buttons.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover',
			'property' => 'border-color',
		),
	),
) );

Atomlab_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_hover_text_color',
	'label'       => esc_html__( 'Text Color', 'atomlab' ),
	'description' => esc_html__( 'Controls the text color when hover of all buttons.', 'atomlab' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Atomlab::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover',
			'property' => 'color',
		),
	),
) );
