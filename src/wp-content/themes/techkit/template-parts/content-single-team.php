<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

global $post;

$techkit_team_position 		= get_post_meta( $post->ID, 'techkit_team_position', true );
$techkit_team_website       = get_post_meta( $post->ID, 'techkit_team_website', true );
$techkit_team_email    		= get_post_meta( $post->ID, 'techkit_team_email', true );
$techkit_team_phone    		= get_post_meta( $post->ID, 'techkit_team_phone', true );
$techkit_team_address    	= get_post_meta( $post->ID, 'techkit_team_address', true );
$techkit_team_skill       	= get_post_meta( $post->ID, 'techkit_team_skill', true );
$techkit_team_counter      	= get_post_meta( $post->ID, 'techkit_team_count', true );
$socials        			= get_post_meta( $post->ID, 'techkit_team_socials', true );
$socials        			= array_filter( $socials );
$socials_fields 			= TechkitTheme_Helper::team_socials();

$techkit_team_contact_form 	= get_post_meta( $post->ID, 'techkit_team_contact_form', true );

$thumb_size = 'techkit-size6';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'team-single' ); ?>>
	<div class="team-content-wrap">
		<div class="row">
			<div class="col-lg-5 col-12">
				<div class="rtin-thumb">
					<?php
						if ( has_post_thumbnail() ){
							the_post_thumbnail( $thumb_size );
						} else {
							if ( !empty( TechkitTheme::$options['no_preview_image']['id'] ) ) {
								echo wp_get_attachment_image( TechkitTheme::$options['no_preview_image']['id'], $thumb_size );
							} else {
								echo '<img class="wp-post-image" src="' . TechkitTheme_Helper::get_img( 'noimage_400X400.jpg' ) . '" alt="'.get_the_title().'">';
							}
						}
					?>	
				</div>
				<!-- Team info -->
				<?php if ( TechkitTheme::$options['team_info'] ) { ?>
				<?php if ( !empty( $techkit_team_website ) ||  !empty( $techkit_team_phone ) || !empty( $techkit_team_email ) || !empty( $techkit_team_address )) { ?>
				<div class="rtin-team-info">
					<h4><?php esc_html_e( 'Info', 'techkit' );?></h4>
					<ul>
						<?php if ( !empty( $techkit_team_website ) ) { ?>	
							<li><span class="rtin-label"><?php esc_html_e( 'Website', 'techkit' );?> : </span><?php echo esc_html( $techkit_team_website );?></li>
						<?php } if ( !empty( $techkit_team_phone ) ) { ?>	
							<li><span class="rtin-label"><?php esc_html_e( 'Phone', 'techkit' );?> : </span><a href="tel:<?php echo esc_html( $techkit_team_phone );?>"><?php echo esc_html( $techkit_team_phone );?></a></li>
						<?php } if ( !empty( $techkit_team_email ) ) { ?>	
							<li><span class="rtin-label"><?php esc_html_e( 'Email', 'techkit' );?> : </span><a href="mailto:<?php echo esc_html( $techkit_team_email );?>"><?php echo esc_html( $techkit_team_email );?></a></li>
						<?php } if ( !empty( $techkit_team_address ) ) { ?>	
							<li><span class="rtin-label"><?php esc_html_e( 'Address', 'techkit' );?> : </span><?php echo esc_html( $techkit_team_address );?></li>	
						<?php } ?>
					</ul>
				</div>
				<?php } } ?>
			</div>
			<div class="col-lg-7 col-12">
				<div class="rtin-content">
					<div class="rtin-heading">
						<?php if ( $techkit_team_position ) { ?>
						<span class="designation"><?php echo esc_html( $techkit_team_position );?></span>
						<?php } ?>
					</div>
					<?php the_content();?>
					<?php if ( !empty( $socials ) ) { ?>
					<ul class="rtin-social">
						<?php foreach ( $socials as $key => $value ): ?>
							<li><a target="_blank" href="<?php echo esc_url( $value ); ?>"><i class="fab <?php echo esc_attr( $socials_fields[$key]['icon'] );?>"></i></a></li>
						<?php endforeach; ?>
					</ul>						
					<?php } ?>
				</div>
				<!-- Team Skills -->
				<?php if ( TechkitTheme::$options['team_skill'] ) { ?>
					<?php if ( !empty( $techkit_team_skill ) ) { ?>
					<div class="team-skill-wrap">
						<div class="rtin-skills">
							<h4><?php esc_html_e( 'Skill', 'techkit' );?></h4>
							<?php foreach ( $techkit_team_skill as $skill ): ?>
								<?php
								if ( empty( $skill['skill_name'] ) || empty( $skill['skill_value'] ) ) {
									continue;
								}
								$skill_value = (int) $skill['skill_value'];
								$skill_style = "width:{$skill_value}%; animation-name: slideInLeft;";

								if ( !empty( $skill['skill_color'] ) ) {
									$skill_style .= "background-color:{$skill['skill_color']};";
								}
								?>
								<div class="rtin-skill-each">
									<div class="rtin-name"><?php echo esc_html( $skill['skill_name'] );?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-striped wow fadeInLeft" data-wow-delay="0s" data-wow-duration="3s" data-progress="<?php echo esc_attr( $skill_value );?>%" style="<?php echo esc_attr( $skill_style );?>"> <span><?php echo esc_html( $skill_value );?>%</span></div>
									</div>								
								</div>
							<?php endforeach;?> 
						</div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>			
		</div>
	</div>
	<!-- Contact form -->
	<?php if ( TechkitTheme::$options['team_form'] ) { ?>
	<?php if ( !empty( $techkit_team_contact_form ) ) { ?>
	<div class="team-contact-wrap"> 
		<div class="form-box">
			<h3><?php echo wp_kses( TechkitTheme::$options['team_form_title'] , 'alltext_allow' );?></h3>
			<?php echo do_shortcode( $techkit_team_contact_form );?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>
	
	<?php if( TechkitTheme::$options['show_related_team'] == '1' && is_single() && !empty ( techkit_related_team() ) ) { ?>
	<div class="related-post">
		<?php echo techkit_related_team(); ?>
	</div>
	<?php } ?>
</div>