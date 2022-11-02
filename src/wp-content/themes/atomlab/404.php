<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package TM Atomlab
 * @since   1.0
 */

get_header( 'blank' );

$copyright = Atomlab::setting( 'error404_page_copyright' );
?>
	<div class="error404--header">
		<div class="branding__logo">
			<?php
			$logo_url = Atomlab::setting( 'logo_dark' );
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( $logo_url ); ?>"
				     alt="<?php esc_attr_e( 'Logo', 'atomlab' ); ?>"/>
			</a>
		</div>
	</div>
	<div class="error404--content-wrap">
		<div class="error404--content">
			<img src="<?php echo get_template_directory_uri() . '/assets/images/image_404.jpg' ?>"
			     alt="<?php esc_attr_e( '404 Image', 'atomlab' ); ?>">
			<div class="error404--title">
				<?php echo esc_html( Atomlab::setting( 'error404_page_title' ) ); ?>
			</div>
			<div class="error-buttons">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				   class="tm-button style-outline tm-button-grey  has-icon icon-left">
					<span class="button-icon ion-home"></span>
					<span class="button-text"><?php esc_html_e( 'Go back to homepage', 'atomlab' ); ?></span>
				</a>
			</div>
		</div>
	</div>
<?php get_footer( 'blank' );
