<?php
/**
 * Template Name: Maintenance
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Atomlab
 * @since   1.0
 */

get_header( 'maintenance' );

$single_image = Atomlab::setting( 'maintenance_single_image' );
$progress_bar = Atomlab::setting( 'maintenance_progress_bar' );
$percent      = Atomlab::setting( 'maintenance_percent' );
$title        = Atomlab::setting( 'maintenance_title' );
$text         = Atomlab::setting( 'maintenance_text' );
?>
	<div id="maintenance-wrap" class="maintenance-page">
		<div class="maintenance-body">
			<div class="left-content">
				<?php if ( $title !== '' ) : ?>
					<h2 class="maintenance-title">
						<?php echo esc_html( $title ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $text !== '' ) : ?>
					<div class="maintenance-text">
						<?php echo esc_html( $text ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $progress_bar === '1' ) : ?>
					<div class="maintenance-progress-wrap">
						<div class="maintenance-progress-labels">
							<div class="text">
								<?php esc_html_e( 'Progress', 'atomlab' ); ?>
							</div>
							<div class="number">
								<?php echo esc_html( $percent ); ?>%
							</div>
						</div>
						<div class="maintenance-progress-bar"
						     role="progressbar">
							<div class="maintenance-progress"></div>
						</div>
					</div>
				<?php endif; ?>

				<div class="buttons">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
					   class="tm-button style-outline tm-button-white has-icon icon-left">
						<span class="button-icon ion-home"></span>
						<span
							class="button-text"><?php esc_html_e( 'Go back to homepage', 'atomlab' ); ?></span>
					</a>
				</div>
			</div>
			<div class="right-content">

				<?php if ( $single_image !== '' ) : ?>
					<div class="photo">
						<img src="<?php echo esc_url( $single_image ); ?>" alt="<?php esc_attr_e( 'Maintenance Image', 'atomlab' ); ?>">
					</div>
				<?php endif; ?>

			</div>
		</div>

		<div class="maintenance-svg">
			<svg xmlns="https://www.w3.org/2000/svg" version="1.1" viewBox="0 0 4 0.266661" preserveAspectRatio="none">
				<polygon class="fil0" points="4,0 4,0.266661 -0,0.266661 "/>
			</svg>
		</div>
	</div>
<?php get_footer( 'blank' );
