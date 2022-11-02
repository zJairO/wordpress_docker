<?php
$panel    = 'maintenance';
$priority = 1;

Atomlab_Kirki::add_section( 'general', array(
	'title'       => esc_html__( 'General', 'atomlab' ),
	'description' => sprintf( '<div class="desc">
			<strong class="insight-label insight-label-info">%s</strong>
			<p>%s</p>
			<p><span class="insight-label insight-label-info">%s</span></p>
			<p>%s</p>
		</div>', esc_html__( 'IMPORTANT NOTE: ', 'atomlab' ), esc_html__( 'To active maintenance mode, please add this line to wp-config.php file, before "That\'s all, stop editing! Happy blogging" comment.', 'atomlab' ), esc_html__( 'define(\'ATOMLAB_MAINTENANCE\', true);', 'atomlab' ), esc_html__( 'Then select a maintenance page below.', 'atomlab' ) ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Atomlab_Kirki::add_section( 'maintenance', array(
	'title'    => esc_html__( 'Maintenance', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'coming_soon_01', array(
	'title'    => esc_html__( 'Coming Soon 01', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Atomlab_Kirki::add_section( 'coming_soon_02', array(
	'title'    => esc_html__( 'Coming Soon 02', 'atomlab' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
