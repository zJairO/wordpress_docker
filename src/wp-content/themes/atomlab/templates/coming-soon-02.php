<?php
/**
 * Template Name: Coming Soon 02
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Atomlab
 * @since   1.0
 */

get_header();

$title            = Atomlab::setting( 'coming_soon_02_title' );
$text             = Atomlab::setting( 'coming_soon_02_text' );
$countdown        = Atomlab::setting( 'coming_soon_02_countdown' );
$mailchimp_enable = Atomlab::setting( 'coming_soon_02_mailchimp_enable' );
?>
	<div class="container">
		<div class="row row-xs-center maintenance-page" id="maintenance-wrap">
			<div class="col-md-12">

				<?php if ( $title !== '' ) : ?>
					<?php echo '<h2 class="cs-title">' . html_entity_decode( $title ) . '</h2>'; ?>
				<?php endif; ?>

				<?php if ( $countdown !== '' ) : ?>
					<div id="countdown" class="cs-countdown"
					     data-datetime="<?php echo esc_attr( $countdown ); ?>"></div>
				<?php endif; ?>

				<?php if ( $mailchimp_enable === '1' && function_exists( 'mc4wp_show_form' ) ) : ?>
					<div class="cs-form">
						<?php echo do_shortcode( '[tm_mailchimp_form skin="secondary"]' ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
<?php get_footer( 'blank' );
