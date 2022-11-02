<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom template tags for this theme.
 */
class Atomlab_Templates {

	public static function top_bar() {
		$top_bar_type = Atomlab_Helper::get_post_meta( 'top_bar_type', '' );

		if ( $top_bar_type === '' ) {
			$top_bar_type = Atomlab::setting( 'global_top_bar' );
		}

		if ( $top_bar_type !== 'none' ) {
			get_template_part( 'components/top-bar', $top_bar_type );
		}
	}

	public static function top_bar_button( $type = '01' ) {
		$button_text        = Atomlab::setting( "top_bar_style_{$type}_button_text" );
		$button_link        = Atomlab::setting( "top_bar_style_{$type}_button_link" );
		$button_link_target = Atomlab::setting( "top_bar_style_{$type}_button_link_target" );
		$button_classes     = 'top-bar-button';
		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<a class="<?php echo esc_attr( $button_classes ); ?>"
			   href="<?php echo esc_url( $button_link ); ?>"
				<?php if ( $button_link_target === '1' ) : ?>
					target="_blank"
				<?php endif; ?>
			>
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif;
	}

	public static function top_bar_info( $type = '01' ) {
		$info = Atomlab::setting( "top_bar_style_{$type}_info" );

		if ( ! empty( $info ) ) {
			?>
			<ul class="top-bar-info">
				<?php
				foreach ( $info as $item ) {
					$url  = isset( $item['link_url'] ) ? $item['link_url'] : '';
					$icon = isset( $item['icon_class'] ) ? $item['icon_class'] : '';
					$text = isset( $item['text'] ) ? $item['text'] : '';
					?>
					<li class="info-item">
						<?php if ( $url !== '' ) : ?>
						<a href="<?php echo esc_url( $url ); ?>" class="info-link">
							<?php endif; ?>

							<?php if ( $icon !== '' ) : ?>
								<?php
								$style = '';
								if ( isset( $item['icon_color'] ) && $item['icon_color'] !== '' ) {
									$style = 'style="color: ' . $item['icon_color'] . '"';
								}
								?>
								<i class="info-icon <?php echo esc_attr( $icon ); ?>" <?php echo $style; ?>></i>
							<?php endif; ?>

							<?php echo '<span class="info-text">' . $text . '</span>'; ?>

							<?php if ( $url !== '' ) : ?>
						</a>
					<?php endif; ?>
					</li>
				<?php } ?>
			</ul>
			<?php
		}
	}

	public static function top_bar_social_networks( $type = '01' ) {
		$social_enable = Atomlab::setting( "top_bar_style_{$type}_social_enable" );
		?>
		<?php if ( $social_enable === '1' ) : ?>
			<div class="top-bar-social-networks">
				<div class="inner">
					<?php self::social_icons( array(
						'tooltip_position' => 'bottom',
					) ); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php
	}

	public static function get_header_type() {
		$header_type = Atomlab_Helper::get_post_meta( 'header_type', '' );
		if ( $header_type === '' ) {

			if ( is_search() && ! is_post_type_archive( 'product' ) ) {
				$header_type = Atomlab::setting( 'global_header' );
			} elseif ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
				$header_type = Atomlab::setting( 'global_header' );
			} elseif ( is_post_type_archive( 'portfolio' ) || Atomlab_Portfolio::is_taxonomy() ) {
				$header_type = Atomlab::setting( 'global_header' );
			} elseif ( is_post_type_archive( 'post' ) ) {
				$header_type = Atomlab::setting( 'global_header' );
			} elseif ( is_home() ) {
				$header_type = Atomlab::setting( 'global_header' );
			} elseif ( is_singular( 'post' ) ) {
				$header_type = Atomlab::setting( 'single_post_header_type' );
			} elseif ( is_singular( 'portfolio' ) ) {
				$header_type = Atomlab::setting( 'single_portfolio_header_type' );
			} elseif ( is_singular( 'product' ) ) {
				$header_type = Atomlab::setting( 'single_product_header_type' );
			} elseif ( is_singular( 'page' ) ) {
				$header_type = Atomlab::setting( 'single_page_header_type' );
			} else {
				$header_type = Atomlab::setting( 'global_header' );
			}
		}

		if ( $header_type === '' ) {
			$header_type = Atomlab::setting( 'global_header' );
		}

		return $header_type;
	}

	public static function header( $header_type = '' ) {
		if ( $header_type === '' ) {
			$header_type = Atomlab_Global::instance()->get_header_type();
		}

		if ( $header_type === 'none' ) {
			return;
		}

		get_template_part( 'components/header', $header_type );
	}

	public static function header_info_slider() {
		$info = Atomlab::setting( 'header_style_09_info' );
		if ( empty( $info ) ) {
			return;
		}
		?>
		<div class="header-info">
			<div class="tm-swiper"
			     data-lg-items="3"
			     data-md-items="2"
			     data-sm-items="1"
			     data-lg-gutter="30"
			     data-loop="1"
			     data-autoplay="4000"
			>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php foreach ( $info as $item ) { ?>
							<div class="swiper-slide">
								<div class="info-item">
									<?php if ( isset( $item['icon_class'] ) && $item['icon_class'] !== '' ) : ?>
										<div class="info-icon">
											<span class="<?php echo esc_attr( $item['icon_class'] ); ?>"></span>
										</div>
									<?php endif; ?>

									<div class="info-content">
										<?php if ( isset( $item['title'] ) && $item['title'] !== '' ) : ?>
											<?php echo '<h6 class="info-title">' . $item['title'] . '</h6>'; ?>
										<?php endif; ?>

										<?php if ( isset( $item['sub_title'] ) && $item['sub_title'] !== '' ) : ?>
											<?php echo '<div class="info-sub-title">' . $item['sub_title'] . '</div>'; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function header_search_button() {
		$type    = Atomlab_Global::instance()->get_header_type();
		$enabled = Atomlab::setting( "header_style_{$type}_search_enable" );

		if ( '1' === $enabled ) {
			?>
			<div class="popup-search-wrap">
				<a href="#" id="btn-open-popup-search" class="btn-open-popup-search"><i
						class="ion-ios-search-strong"></i></a>
			</div>
			<?php
		}
	}

	public static function header_search_form() {
		$type    = Atomlab_Global::instance()->get_header_type();
		$enabled = Atomlab::setting( "header_style_{$type}_search_enable" );

		if ( '1' === $enabled ) {
			?>
			<div class="popup-search-wrap">
				<?php get_search_form(); ?>
			</div>
			<?php
		}
	}

	public static function header_mail_chimp_form() {
		$type    = Atomlab_Global::instance()->get_header_type();
		$enabled = Atomlab::setting( "header_style_{$type}_mailchimp_enable" );

		if ( '1' === $enabled && function_exists( 'mc4wp_show_form' ) ) {
			$heading = Atomlab::setting( "header_style_{$type}_mailchimp_heading" );
			?>
			<div class="mailchimp-form">

				<?php if ( $heading !== '' ) : ?>
					<div class="heading">
						<?php echo $heading; ?>
					</div>
				<?php endif; ?>

				<?php echo do_shortcode( '[tm_mailchimp_form skin="secondary"]' ); ?>
			</div>
			<?php
		}
	}

	public static function header_button() {
		$header_type          = Atomlab_Global::instance()->get_header_type();
		$button_text          = Atomlab::setting( "header_style_{$header_type}_button_text" );
		$button_link          = Atomlab::setting( "header_style_{$header_type}_button_link" );
		$button_link_target   = Atomlab::setting( "header_style_{$header_type}_button_link_target" );
		$button_style         = Atomlab::setting( "header_style_{$header_type}_button_style" );
		$button_extra_classes = Atomlab::setting( "header_style_{$header_type}_button_classes" );

		$header_sticky_button_style   = Atomlab::setting( "header_sticky_button_style" );
		$button_classes               = "tm-button tm-button-nm header-on-top-button $button_extra_classes";
		$header_sticky_button_classes = "tm-button tm-button-sm header-sticky-button $button_extra_classes";

		switch ( $button_style ) {
			case 'flat-black-alpha':
				$button_classes .= ' style-flat tm-button-black-alpha';
				break;

			case 'flat-black-alpha-2':
				$button_classes .= ' style-flat tm-button-black-alpha-2';
				break;

			case 'flat-black-alpha-3':
				$button_classes .= ' style-flat tm-button-black-alpha-3';
				break;

			case 'flat':
				$button_classes .= ' style-flat tm-button-secondary';
				break;

			case 'flat-white-alt':
				$button_classes .= ' style-flat tm-button-white-alt';
				break;

			default:
				$button_classes .= ' style-outline tm-button-secondary';
				break;
		}

		if ( $header_sticky_button_style === 'flat' ) {
			$header_sticky_button_classes .= ' style-flat tm-button-secondary';
		} else {
			$header_sticky_button_classes .= ' style-outline tm-button-secondary';
		}
		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<div class="header-button">
				<a class="<?php echo esc_attr( $button_classes ); ?>"
				   href="<?php echo esc_url( $button_link ); ?>"
					<?php if ( $button_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php echo esc_html( $button_text ); ?>
				</a>
				<a class="<?php echo esc_attr( $header_sticky_button_classes ); ?>"
				   href="<?php echo esc_url( $button_link ); ?>"
					<?php if ( $button_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php echo esc_html( $button_text ); ?>
				</a>
			</div>
		<?php endif;
	}

	public static function header_open_mobile_menu_button() {
		?>
		<div id="page-open-mobile-menu" class="page-open-mobile-menu">
			<div class="inner">
				<div class="icon"><i></i></div>
			</div>
		</div>
		<?php
	}

	public static function header_open_canvas_menu_button( $args = array() ) {
		$defaults = array(
			'menu_title' => false,
		);
		$args     = wp_parse_args( $args, $defaults );
		?>
		<div id="page-open-main-menu" class="page-open-main-menu">
			<?php if ( $args['menu_title'] ) : ?>
				<h6 class="page-open-main-menu-title"><?php esc_html_e( 'Menu', 'atomlab' ); ?></h6>
			<?php endif; ?>
			<div><i></i></div>
		</div>
		<?php
	}

	public static function header_social_networks() {
		$type          = Atomlab_Global::instance()->get_header_type();
		$social_enable = Atomlab::setting( "header_style_{$type}_social_enable" );

		?>
		<?php if ( $social_enable === '1' ) : ?>
			<div class="header-social-networks">
				<?php if ( $type === '14' ) : ?>
					<?php self::social_icons( array(
						'display'        => 'text',
						'link_classes'   => 'fall-down-effect',
						'tooltip_enable' => false,
					) ); ?>
				<?php else : ?>
					<?php self::social_icons( array(
						'tooltip_position' => 'bottom',
					) ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php
	}

	public static function slider( $position ) {
		$slider = Atomlab_Helper::get_post_meta( 'revolution_slider' );
		if ( function_exists( 'rev_slider_shortcode' ) && Atomlab_Helper::get_post_meta( 'slider_position' ) === $position && $slider !== '' ) {
			?>
			<div id="page-slider" class="page-slider">
				<?php putRevSlider( $slider ); ?>
			</div>
			<?php
		}

		$slider = '';
		if ( is_search() && ! is_post_type_archive( 'product' ) ) {
			$slider = Atomlab::setting( 'search_page_rev_slider' );
		} elseif ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
			$slider = Atomlab::setting( 'product_archive_page_rev_slider' );
		} elseif ( is_post_type_archive( 'portfolio' ) || Atomlab_Portfolio::is_taxonomy() ) {
			$slider = Atomlab::setting( 'portfolio_archive_page_rev_slider' );
		} elseif ( is_archive() ) {
			$slider = Atomlab::setting( 'blog_archive_page_rev_slider' );
		} elseif ( is_home() ) {
			$slider = Atomlab::setting( 'home_page_rev_slider' );
		}

		if ( $slider !== '' && function_exists( 'rev_slider_shortcode' ) ) {
			?>
			<div id="page-slider" class="page-slider">
				<?php putRevSlider( $slider ); ?>
			</div>
			<?php
		}
	}

	public static function paging_nav( $query = false ) {
		global $wp_query, $wp_rewrite;
		if ( $query === false ) {
			$query = $wp_query;
		}

		// Don't print empty markup if there's only one page.
		if ( $query->max_num_pages < 2 ) {
			return;
		}

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = esc_url( remove_query_arg( array_keys( $query_args ), $page_num_link ) );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format = '';
		if ( $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ) {
			$format = 'index.php/';
		}
		if ( $wp_rewrite->using_permalinks() ) {
			$format .= user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' );
		} else {
			$format .= '?paged=%#%';
		}

		// Set up paginated links.

		$args  = array(
			'base'      => $page_num_link,
			'format'    => $format,
			'total'     => $query->max_num_pages,
			'current'   => max( 1, $paged ),
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Prev', 'atomlab' ),
			'next_text' => esc_html__( 'Next', 'atomlab' ),
			'type'      => 'array',
		);
		$pages = paginate_links( $args );

		if ( is_array( $pages ) ) {
			echo '<ul class="page-pagination">';
			foreach ( $pages as $page ) {
				printf( '<li>%s</li>', $page );
			}
			echo '</ul>';
		}
	}

	public static function mobile_menu_button() {
		$header_type          = Atomlab_Global::instance()->get_header_type();
		$button_text          = Atomlab::setting( "header_style_{$header_type}_button_text" );
		$button_link          = Atomlab::setting( "header_style_{$header_type}_button_link" );
		$button_link_target   = Atomlab::setting( "header_style_{$header_type}_button_link_target" );
		$button_extra_classes = Atomlab::setting( "header_style_{$header_type}_button_classes" );

		$button_classes = "tm-button style-flat tm-button-nm mobile-menu-button $button_extra_classes";

		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<div class="mobile-menu-button-wrap">
				<a class="<?php echo esc_attr( $button_classes ); ?>"
				   href="<?php echo esc_url( $button_link ); ?>"
					<?php if ( $button_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php echo esc_html( $button_text ); ?>
				</a>
			</div>
		<?php endif;
	}

	public static function page_links() {
		wp_link_pages( array(
			'before'           => '<div class="page-links">',
			'after'            => '</div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'nextpagelink'     => esc_html__( 'Next', 'atomlab' ),
			'previouspagelink' => esc_html__( 'Prev', 'atomlab' ),
		) );
	}

	public static function post_nav_links() {
		$args = array(
			'prev_text'          => '%title',
			'next_text'          => '%title',
			'in_same_term'       => false,
			'excluded_terms'     => '',
			'taxonomy'           => 'category',
			'screen_reader_text' => esc_html__( 'Post navigation', 'atomlab' ),
		);

		$previous = get_previous_post_link( '<div class="nav-previous">%link</div>', $args['prev_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy'] );

		$next = get_next_post_link( '<div class="nav-next">%link</div>', $args['next_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy'] );

		// Only add markup if there's somewhere to navigate to.
		if ( $previous || $next ) { ?>

			<nav class="navigation post-navigation" role="navigation">

				<?php $return_link = Atomlab::setting( 'single_post_pagination_return_link' ); ?>
				<?php if ( $return_link !== '' ) : ?>
					<a href="<?php echo esc_url( $return_link ); ?>" class="return-blog-page"><span
							class="ion-grid"></span></a>
				<?php endif; ?>

				<?php echo '<h2 class="screen-reader-text">' . $args['screen_reader_text'] . '</h2>'; ?>

				<div class="nav-links">
					<?php echo '<div class="previous nav-item">' . $previous . '</div>'; ?>
					<?php echo '<div class="next nav-item">' . $next . '</div>'; ?>
				</div>
			</nav>
			<?php
		}
	}

	public static function comment_navigation( $args = array() ) {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			$defaults = array(
				'container_id'    => '',
				'container_class' => 'navigation comment-navigation',
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<nav id="<?php echo esc_attr( $args['container_id'] ); ?>"
			     class="<?php echo esc_attr( $args['container_class'] ); ?>">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'atomlab' ); ?></h2>

				<div class="comment-nav-links">
					<?php paginate_comments_links( array(
						'prev_text' => esc_html__( 'Prev', 'atomlab' ),
						'next_text' => esc_html__( 'Next', 'atomlab' ),
						'type'      => 'list',
					) ); ?>
				</div>
			</nav>
			<?php
		}
		?>
		<?php
	}

	public static function comment_template( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			<div class="comment-content">
				<div class="comment-header">
					<?php
					printf( '<h6 class="fn">%s</h6>', get_comment_author_link() );
					?>
					<div class="comment-datetime"><?php echo get_comment_date(); ?></div>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-messages"><?php esc_html_e( 'Your comment is awaiting moderation.', 'atomlab' ) ?></em>
					<br/>
				<?php endif; ?>
				<div class="comment-text"><?php comment_text(); ?></div>
				<div class="comment-actions">
					<?php comment_reply_link( array_merge( $args, array(
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
						'reply_text' => '<span class="ion-reply"></span>' . esc_html__( 'Reply', 'atomlab' ),
					) ) ); ?>
					<?php edit_comment_link( '<span class="ion-android-create"></span>' . esc_html__( 'Edit', 'atomlab' ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	public static function comment_form() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = '';
		if ( $req ) {
			$aria_req = " aria-required='true'";
		}

		$fields = array(
			'author' => '<div class="comment-form-wrapper"><div class="left-form"><div class="comment-form-author"><input id="author" placeholder="' . esc_html__( 'Your Name *', 'atomlab' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . '/></div>',
			'email'  => '<div class="comment-form-email"><input id="email" placeholder="' . esc_html__( 'Your Email *', 'atomlab' ) . '" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . '/></div>',
			'url'    => '<div class="comment-form-url"><input id="url" placeholder="' . esc_html__( 'Website', 'atomlab' ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" ' . $aria_req . '/></div></div>',
		);

		$comment_field = '<div class="right-form"><div class="comment-form-comment"><textarea id="comment" placeholder="' . esc_html__( 'Your Comment', 'atomlab' ) . '" name="comment" aria-required="true"></textarea></div></div></div>';

		if ( is_user_logged_in() ) {
			$comment_field = '<div class="comment-form-wrapper">' . $comment_field;
		}

		$comments_args = array(
			// Change the title of send button.
			'label_submit'         => esc_html__( 'Submit', 'atomlab' ),
			// Change the title of the reply section.
			'title_reply'          => esc_html__( 'Leave your thought here', 'atomlab' ),
			// Remove "Text or HTML to be displayed after the set of comment fields".
			'comment_notes_after'  => '',
			'comment_notes_before' => '',
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => $comment_field,
		);
		comment_form( $comments_args );
	}

	public static function post_author() {
		?>
		<div class="entry-author">
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '90' ); ?>
				</div>
				<div class="author-description">
					<h5 class="author-name"><?php the_author(); ?></h5>
					<div class="author-biographical-info">
						<?php the_author_meta( 'description' ); ?>
					</div>
				</div>
			</div>
			<?php
			$email_address = get_the_author_meta( 'email_address' );
			$facebook      = get_the_author_meta( 'facebook' );
			$twitter       = get_the_author_meta( 'twitter' );
			$google_plus   = get_the_author_meta( 'google_plus' );
			$instagram     = get_the_author_meta( 'instagram' );
			$linkedin      = get_the_author_meta( 'linkedin' );
			$pinterest     = get_the_author_meta( 'pinterest' );
			?>
			<?php if ( $facebook || $twitter || $google_plus || $instagram || $linkedin || $email_address ) : ?>
				<div class="author-social-networks">
					<?php if ( $email_address ) : ?>
						<a class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr__( 'Email', 'atomlab' ) ?>"
						   href="mailto:<?php echo esc_url( $email_address ); ?>" target="_blank">
							<i class="ion-email"></i>
						</a>
					<?php endif; ?>

					<?php if ( $facebook ) : ?>
						<a class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr__( 'Facebook', 'atomlab' ) ?>"
						   href="<?php echo esc_url( $facebook ); ?>" target="_blank">
							<i class="ion-social-facebook"></i>
						</a>
					<?php endif; ?>

					<?php if ( $twitter ) : ?>
						<a class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr__( 'Twitter', 'atomlab' ) ?>"
						   href="<?php echo esc_url( $twitter ); ?>" target="_blank">
							<i class="ion-social-twitter"></i>
						</a>
					<?php endif; ?>

					<?php if ( $google_plus ) : ?>
						<a class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr__( 'Google +', 'atomlab' ) ?>"
						   href="<?php echo esc_url( $google_plus ); ?>" target="_blank">
							<i class="ion-social-googleplus"></i>
						</a>
					<?php endif; ?>

					<?php if ( $instagram ) : ?>
						<a class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr__( 'Instagram', 'atomlab' ) ?>"
						   href="<?php echo esc_url( $google_plus ); ?>" target="_blank">
							<i class="ion-social-instagram-outline"></i>
						</a>
					<?php endif; ?>

					<?php if ( $linkedin ) : ?>
						<a class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr__( 'Linkedin', 'atomlab' ) ?>"
						   href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
							<i class="ion-social-linkedin"></i>
						</a>
					<?php endif; ?>

					<?php if ( $pinterest ) : ?>
						<a class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr__( 'Pinterest', 'atomlab' ) ?>"
						   href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
							<i class="ion-social-pinterest"></i>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	public static function post_sharing( $args = array() ) {
		$social_sharing = Atomlab::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="post-share">
				<div class="post-share-title"><?php esc_html_e( 'Share this post', 'atomlab' ); ?></div>
				<div class="post-share-toggle">
					<span class="ion-android-share-alt"></span>
					<div class="post-share-list">
						<?php self::get_sharing_list( $args ); ?>
					</div>
				</div>
			</div>
			<?php
		}
	}

	public static function post_like() {
		?>
		<span class="post-likes">
			<?php
			$atomlab_post_like = new Atomlab_Post_Like();
			$atomlab_post_like->get_simple_likes_button( get_the_ID() );
			?>
		</span>
		<?php
	}

	public static function portfolio_like() {
		if ( Atomlab::setting( 'single_portfolio_meta_like_enable' ) === '1' ) :
			?>
			<span class="post-likes">
				<?php
				$atomlab_post_like = new Atomlab_Post_Like();
				$atomlab_post_like->get_simple_likes_button( get_the_ID() );
				?>
			</span>
		<?php
		endif;
	}

	public static function portfolio_view() {
		if ( Atomlab::setting( 'single_portfolio_meta_view_enable' ) === '1' && function_exists( 'the_views' ) ) : ?>
			<div class="post-view">
				<i class="ion-eye"></i>
				<?php the_views(); ?>
			</div>
		<?php
		endif;
	}

	public static function portfolio_sharing( $args = array() ) {
		$social_sharing = Atomlab::setting( 'single_portfolio_share_enable' );
		if ( ! empty( $social_sharing ) && Atomlab::setting( 'single_portfolio_share_enable' ) === '1' ) {
			?>
			<div class="portfolio-share">
				<h6 class="portfolio-share-title"><?php esc_html_e( 'Share:', 'atomlab' ); ?></h6>
				<div class="portfolio-sharing-list"><?php self::get_sharing_list( $args ); ?></div>
			</div>
			<?php
		}
	}

	public static function portfolio_sharing_2( $args = array() ) {
		$social_sharing = Atomlab::setting( 'single_portfolio_share_enable' );
		if ( ! empty( $social_sharing ) && Atomlab::setting( 'single_portfolio_share_enable' ) === '1' ) {
			?>
			<div class="post-share">
				<div class="post-share-toggle">
					<span class="ion-android-share-alt"></span>
					<div class="post-share-list">
						<?php self::get_sharing_list( $args ); ?>
					</div>
				</div>
			</div>
			<?php
		}
	}

	public static function portfolio_view_project_button( $portfolio_url ) {
		if ( $portfolio_url !== '' ) : ?>
			<div class="portfolio-link">
				<a class="tm-button-view-project"
				   href="<?php echo esc_url( $portfolio_url ); ?>"><?php esc_html_e( 'Visit Site', 'atomlab' ); ?>
					<span class="ion-android-arrow-dropright-circle"></span>
				</a>
			</div>
		<?php endif;
	}

	public static function portfolio_details() {
		$portfolio_client = Atomlab_Helper::get_post_meta( 'portfolio_client', '' );
		$portfolio_date   = Atomlab_Helper::get_post_meta( 'portfolio_date', '' );
		$portfolio_awards = Atomlab_Helper::get_post_meta( 'portfolio_awards', '' );
		$portfolio_team   = Atomlab_Helper::get_post_meta( 'portfolio_team', '' );
		?>
		<ul class="portfolio-details-list">
			<?php if ( $portfolio_date !== '' ) : ?>
				<li>
					<label><?php esc_html_e( 'Date', 'atomlab' ); ?></label>
					<span><?php echo esc_html( $portfolio_date ); ?></span>
				</li>
			<?php endif; ?>
			<?php if ( $portfolio_client !== '' ) : ?>
				<li>
					<label><?php esc_html_e( 'Client', 'atomlab' ); ?></label>
					<span><?php echo esc_html( $portfolio_client ); ?></span>
				</li>
			<?php endif; ?>
			<?php if ( $portfolio_awards !== '' ) : ?>
				<li>
					<label><?php esc_html_e( 'Awards', 'atomlab' ); ?></label>

					<?php echo '<span>' . $portfolio_awards . '</span>'; ?>
				</li>
			<?php endif; ?>
			<?php if ( $portfolio_team !== '' ) : ?>
				<li>
					<label><?php esc_html_e( 'My Team', 'atomlab' ); ?></label>

					<?php echo '<span>' . $portfolio_team . '</span>'; ?>
				</li>
			<?php endif; ?>
		</ul>
		<?php
	}

	public static function portfolio_link_pages() {
		$args = array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atomlab' ),
			'after'  => '</div>',
		);
		wp_link_pages( $args );
	}

	public static function product_sharing( $args = array() ) {
		$social_sharing = Atomlab::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="product-share meta-item">
				<h6><?php esc_html_e( 'Share:', 'atomlab' ); ?></h6>
				<div class="product-sharing-list"><?php self::get_sharing_list( $args ); ?></div>
			</div>
			<?php
		}
	}

	public static function get_sharing_list( $args = array() ) {
		$defaults       = array(
			'target' => '_blank',
		);
		$args           = wp_parse_args( $args, $defaults );
		$social_sharing = Atomlab::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			$social_sharing_order = Atomlab::setting( 'social_sharing_order' );
			foreach ( $social_sharing_order as $social ) {
				if ( in_array( $social, $social_sharing, true ) ) {
					if ( $social === 'facebook' ) {
						if ( ! wp_is_mobile() ) {
							$facebook_url = 'https://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . rawurlencode( get_permalink() ) . '&p&#91;images&#93;&#91;0&#93;=' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '&p&#91;title&#93;=' . rawurlencode( get_the_title() );
						} else {
							$facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode( get_permalink() );
						}
						?>
						<a class="hint--bounce hint--top facebook" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Facebook', 'atomlab' ) ?>"
						   href="<?php echo esc_url( $facebook_url ); ?>">
							<i class="ion-social-facebook"></i>
						</a>
						<?php
					} elseif ( $social === 'twitter' ) {
						?>
						<a class="hint--bounce hint--top twitter" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Twitter', 'atomlab' ) ?>"
						   href="https://twitter.com/share?text=<?php echo rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="ion-social-twitter"></i>
						</a>
						<?php
					} elseif ( $social === 'google_plus' ) {
						?>
						<a class="hint--bounce hint--top google-plus"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Google+', 'atomlab' ) ?>"
						   href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="ion-social-googleplus"></i>
						</a>
						<?php
					} elseif ( $social === 'tumblr' ) {
						?>
						<a class="hint--bounce hint--top tumblr" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Tumblr', 'atomlab' ) ?>"
						   href="https://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;name=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="ion-social-tumblr"></i>
						</a>
						<?php

					} elseif ( $social === 'linkedin' ) {
						?>
						<a class="hint--bounce hint--top linkedin" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Linkedin', 'atomlab' ) ?>"
						   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="ion-social-linkedin"></i>
						</a>
						<?php
					} elseif ( $social === 'email' ) {
						?>
						<a class="hint--bounce hint--top email" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Email', 'atomlab' ) ?>"
						   href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&amp;body=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="ion-android-mail"></i>
						</a>
						<?php
					}
				}
			}
		}
	}

	public static function social_icons( $args = array() ) {
		$defaults    = array(
			'link_classes'     => '',
			'display'          => 'icon',
			'tooltip_enable'   => true,
			'tooltip_position' => 'top',
		);
		$args        = wp_parse_args( $args, $defaults );
		$social_link = Atomlab::setting( 'social_link' );

		if ( ! empty( $social_link ) ) {
			$social_link_target = Atomlab::setting( 'social_link_target' );

			$args['link_classes'] .= ' social-link';
			if ( $args['tooltip_enable'] ) {
				$args['link_classes'] .= ' hint--bounce';
				$args['link_classes'] .= " hint--{$args['tooltip_position']}";
			}
			foreach ( $social_link as $key => $row_values ) {
				?>
				<a class="<?php echo esc_attr( $args['link_classes'] ); ?>"
					<?php if ( $args['tooltip_enable'] ) : ?>
						aria-label="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php endif; ?>
                   href="<?php echo esc_url( $row_values['link_url'] ); ?>"
                   data-hover="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php if ( $social_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php if ( in_array( $args['display'], array( 'icon', 'icon_text' ), true ) ) : ?>
						<i class="social-icon <?php echo esc_attr( $row_values['icon_class'] ); ?>"></i>
					<?php endif; ?>
					<?php if ( in_array( $args['display'], array( 'text', 'icon_text' ), true ) ) : ?>
						<span class="social-text"><?php echo esc_html( $row_values['tooltip'] ); ?></span>
					<?php endif; ?>
				</a>
				<?php
			}
		}
	}

	public static function string_limit_words( $string, $word_limit ) {
		$words = explode( ' ', $string, $word_limit + 1 );
		if ( count( $words ) > $word_limit ) {
			array_pop( $words );
		}

		return implode( ' ', $words );
	}

	public static function string_limit_characters( $string, $limit ) {
		$string = substr( $string, 0, $limit );
		$string = substr( $string, 0, strripos( $string, " " ) );

		return $string;
	}

	public static function excerpt( $args = array() ) {
		$defaults = array(
			'limit' => 55,
			'after' => '&hellip;',
			'type'  => 'word',
		);
		$args     = wp_parse_args( $args, $defaults );

		$excerpt = '';

		if ( $args['type'] === 'word' ) {
			$excerpt = self::string_limit_words( get_the_excerpt(), $args['limit'] );
		} elseif ( $args['type'] === 'character' ) {
			$excerpt = self::string_limit_characters( get_the_excerpt(), $args['limit'] );
		}
		if ( $excerpt !== '' && $excerpt !== '&nbsp;' ) {
			printf( '<p>%s %s</p>', $excerpt, $args['after'] );
		}
	}

	public static function render_sidebar( $sidebar_position, $sidebar1, $sidebar2, $template_position = 'left' ) {
		if ( $sidebar1 !== 'none' ) {
			$classes = 'page-sidebar';
			$classes .= ' page-sidebar-' . $template_position;
			if ( $template_position === 'left' ) {
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1 );
				}
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			} elseif ( $template_position === 'right' ) {
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1 );
				}
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			}
		}
	}

	public static function get_sidebar( $classes, $name ) {
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<div class="page-sidebar-inner" itemscope="itemscope">
				<div class="page-sidebar-content">
					<?php self::generated_sidebar( $name ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * @param $name
	 * Name of dynamic sidebar
	 * Check sidebar is active then dynamic it.
	 */
	public static function generated_sidebar( $name ) {
		if ( is_active_sidebar( $name ) ) {
			dynamic_sidebar( $name );
		}
	}

	public static function image_placeholder_url( $width, $height ) {
		$url = 'https://via.placeholder.com/' . $width . 'x' . $height . '?text=' . esc_html__( 'No+Image', 'atomlab' );

		return $url;
	}

	public static function image_placeholder( $width, $height ) {
		$url = self::image_placeholder_url( $width, $height );

		echo '<img src="' . $url . '" alt="thumbnail"/>';
	}

	public static function grid_filters( $post_type = 'post', $filter_enable, $filter_align, $filter_counter, $filter_wrap = '0' ) {
		if ( $filter_enable == 1 ) :

			$_catPrefix = '';
			$_categories = array();

			switch ( $post_type ) {
				case 'portfolio' :
					$_categories = get_terms( array(
						'taxonomy'   => 'portfolio_category',
						'hide_empty' => true,
					) );
					$_catPrefix  = '.portfolio_category-';
					break;
				case 'product' :
					$_categories = get_terms( array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => true,
					) );

					$_catPrefix = '.product_cat-';
					break;
				default :
					$_categories = get_terms( array(
						'taxonomy'   => 'category',
						'hide_empty' => true,
					) );

					$_catPrefix = '.category-';
					break;
			}

			$filter_classes = array( 'tm-filter-button-group', $filter_align );
			if ( $filter_counter == 1 ) {
				$filter_classes[] = 'show-filter-counter';
			}
			?>

			<div class="<?php echo implode( ' ', $filter_classes ); ?>"
				<?php
				if ( $filter_counter == 1 ) {
					echo 'data-filter-counter="true"';
				}
				?>
			>
				<div class="tm-filter-button-group-inner">
					<?php if ( $filter_wrap == '1' ) { ?>
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<?php } ?>
								<a href="javascript:void(0);" class="btn-filter current"
								   data-filter="*">
									<span class="filter-text"><?php esc_html_e( 'All', 'atomlab' ); ?></span>
								</a>
								<?php
								foreach ( $_categories as $term ) {
									printf( '<a href="javascript:void(0);" class="btn-filter" data-filter="%s"><span class="filter-text">%s</span></a>', esc_attr( $_catPrefix . $term->slug ), $term->name );
								}
								?>
								<?php if ( $filter_wrap == '1' ) { ?>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		<?php
		endif;
	}

	public static function grid_pagination( $atomlab_query, $number, $pagination, $pagination_align, $pagination_button_text ) {
		if ( $pagination !== '' && $atomlab_query->found_posts > $number ) { ?>
			<div class="tm-grid-pagination" style="text-align:<?php echo esc_attr( $pagination_align ); ?>">
				<?php if ( $pagination === 'loadmore_alt' || $pagination === 'loadmore' || $pagination === 'infinite' ) { ?>
					<div class="tm-loader"></div>

					<?php if ( $pagination === 'loadmore' ) { ?>
						<a href="#" class="tm-button style-outline tm-button-grey tm-grid-loadmore-btn">
							<span><?php echo esc_html( $pagination_button_text ); ?></span>
						</a>
					<?php } ?>
				<?php } elseif ( $pagination === 'pagination' ) { ?>
					<?php Atomlab_Templates::paging_nav( $atomlab_query ); ?>
				<?php } ?>
			</div>
			<div class="tm-grid-messages" style="display: none;">
				<?php esc_html_e( 'All items displayed.', 'atomlab' ); ?>
			</div>
			<?php
		}
	}

	/**
	 * Echo rating html template.
	 *
	 * @param int $rating
	 */
	public static function get_rating_template( $rating = 5 ) {
		$full_stars = intval( $rating );
		$template   = '';

		$template .= str_repeat( '<span class="ion-android-star"></span>', $full_stars );

		$half_star = floatval( $rating ) - $full_stars;

		if ( $half_star != 0 ) {
			$template .= '<span class="ion-android-star-half"></span>';
		}

		$empty_stars = intval( 5 - $rating );
		$template    .= str_repeat( '<span class="ion-android-star-outline"></span>', $empty_stars );

		echo $template;
	}
}
