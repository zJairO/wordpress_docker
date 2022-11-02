<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
</div><!--#content-->

<!-- progress-wrap -->
<?php if ( TechkitTheme::$options['back_to_top'] ) { ?>
<div class="scroll-wrap">
  <svg
	class="scroll-circle svg-content"
	width="100%"
	height="100%"
	viewBox="-1 -1 102 102"
  >
	<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>
<?php } ?>

<footer>
	<div id="footer-<?php echo esc_attr( TechkitTheme::$footer_style ); ?>" class="footer-area">
		<?php
			get_template_part( 'template-parts/footer/footer', TechkitTheme::$footer_style );
		?>
	</div>
</footer>
</div>
<?php wp_footer();?>
</body>
</html>