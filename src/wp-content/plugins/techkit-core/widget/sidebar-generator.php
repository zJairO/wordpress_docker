<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'TechkitTheme_Sidebar_Generator' ) ) {

	class TechkitTheme_Sidebar_Generator {

		public $prefix = TECHKIT_CORE_THEME_PREFIX_VAR;
		public $option_name = null;

		public function __construct() {
			$this->option_name = $this->prefix . '_custom_sidebars';

			add_action( 'sidebar_admin_page', array( $this, 'sidebar_form' ) );
			add_action( 'init' , array( $this, 'register_sidebars' ) );
			
			add_action( 'wp_ajax_techkit_add_sidebar' , array( $this, 'ajax_add_sidebar' ) );
			add_action( 'wp_ajax_techkit_remove_sidebar', array( $this, 'ajax_remove_sidebar' ) );
		}

		public function sidebar_form() {
			?>
			<div class="widgets-holder-wrap">
				<div id="techkit-new-sidebar" class="widgets-sortables">
					<div class="sidebar-name">
						<div class="sidebar-name-arrow"></div>
						<h2><?php esc_html_e( 'Add New Sidebar', 'techkit-core' ); ?><span class="spinner"></span></h2>
					</div>
					<div class="sidebar-description">
						<form method="POST" action="<?php echo esc_url( admin_url( 'admin-ajax.php?action=techkit_add_sidebar' ) );?>">
							<?php wp_nonce_field( 'techkit_add_sidebar' ); ?>
							<table class="form-table">
								<tr>
									<th scope="row"><?php esc_html_e( 'Name', 'techkit-core' ) ?></th>
									<td><input type="text" class="text" name="name" value=""></td>
									<td><input type="submit" class="button-primary" value="<?php esc_html_e( 'Add', 'techkit-core' ) ?>"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<?php
			$this->sidebar_scripts();
		}

		public function register_sidebars() {
			$sidebars = get_option( $this->option_name, array() );

			if ( !$sidebars ) return;

			foreach ( $sidebars as $sidebar ) {
				register_sidebar( $sidebar );
			}
		}

		public function ajax_add_sidebar() {
			$name  = isset( $_REQUEST['name'] ) ? sanitize_text_field( $_REQUEST['name'] ) : null;
			$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

			if ( empty( $name ) ) {
				wp_send_json_error( esc_html__( "Sidebar name can\'t be empty", 'techkit-core' ) );
			}
			if ( empty( $nonce ) ) {
				wp_send_json_error( esc_html__( 'Empty nonce', 'techkit-core' ) );
			}
			if ( ! wp_verify_nonce( $nonce, 'techkit_add_sidebar' ) ) {
				wp_send_json_error( esc_html__( 'Invalid nonce', 'techkit-core' ) );
			}

			$id = 'techkit-sidebar-' . sanitize_title( $name );
			$sidebars = get_option( $this->option_name, array() );

			if ( array_key_exists( $id, $sidebars ) ) {
				wp_send_json_error( esc_html__( 'Sidebar with the same name already exists. Please choose a different name', 'techkit-core' ) );
			}

			$sidebars[$id] = array(
				'id'             => $id,
				'name'           => $name,
				'class'          => 'techkit-custom',
				'description'    => '',
				'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'   => '</aside>',
				'before_title'   => '<h2 class="widgettitle widget-title-bar title-sidebar title-bar">',
				'after_title'    => '</h2>',
			);

			update_option( $this->option_name, $sidebars );

			if ( ! function_exists( 'wp_list_widget_controls' ) ) {
				include_once ABSPATH . 'wp-admin/includes/widgets.php';
			}

			ob_start();
			?>
			<div class="widgets-holder-wrap sidebar-techkit-custom closed">
				<?php wp_list_widget_controls( $id, $name ); ?>
			</div>
			<?php
			wp_send_json_success( ob_get_clean() );
		}

		public function ajax_remove_sidebar() {
			$id    = isset( $_REQUEST['id'] ) ? sanitize_text_field( $_REQUEST['id'] ) : null;
			$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

			if ( empty( $id ) ) {
				wp_send_json_error( esc_html__( 'Sidebar ID not found', 'techkit-core' ) );
			}
			if ( empty( $nonce ) ) {
				wp_send_json_error( esc_html__( 'Empty nonce', 'techkit-core' ) );
			}
			if ( ! wp_verify_nonce( $nonce, 'techkit_remove_sidebar' ) ) {
				wp_send_json_error( esc_html__( 'Invalid nonce', 'techkit-core' ) );
			}

			$sidebars = get_option( $this->option_name, array() );

			unset( $sidebars[ $id ] );

			update_option( $this->option_name, $sidebars );

			wp_send_json_success();
		}

		public function sidebar_scripts() {
			?>
			<script type="text/javascript">
				(function($){
					// Custom functions
					function add_close_btn(){
						$('#widgets-right .sidebar-techkit-custom .sidebar-name h2').children('.spinner').each(function() {
							if ( ! $(this).prev('.sidebar-techkit-custom-closebtn').length) {
								$(this).before('<a class="sidebar-techkit-custom-closebtn" href="#">x</a>');
							}
						});	
					}

					// Initialize
					$(document).ready(function() {
						$('#techkit-new-sidebar').parent().prependTo($('#widgets-right .sidebars-column-1'));
						add_close_btn();
					});

					// Add Form submission
					$(document).on('submit','#techkit-new-sidebar form',function(event){
						event.preventDefault();

						$(this).find('input[type="submit"]').attr('disabled', 'disabled');
						$(this).closest('#techkit-new-sidebar').find('.spinner').addClass('is-active');

						$.ajax({
							context: this,
							url: $(this).attr('action'),
							type: $(this).attr('method'),
							dataType: 'json',
							data: $(this).serializeArray(),
							complete: function(response) {
								$(this).closest('#techkit-new-sidebar').find('.spinner').removeClass('is-active');
								$(this).find('input[type="submit"]').removeAttr('disabled');

								if ( ! response || ! response.responseJSON || ! response.responseJSON.success) {
									if (response && response.responseJSON && response.responseJSON.data) {
										alert(response.responseJSON.data);
									}
									else {
										alert('<?php esc_html_e( 'Operation failed', 'techkit-core' ); ?>');
									}
								}
								else {
									var html = $('#wpbody-content > .wrap').clone();
									html.find('#widgets-right .sidebars-column-2').append(response.responseJSON.data);
									$(document.body).unbind('click.widgets-toggle');
									$('#wpbody-content > .wrap').replaceWith(html.clone());
									setTimeout(function() {
										wpWidgets.init();
										add_close_btn();
									}, 200);
								}
							},
						});
					});

					// Remove button action
					$(document).on('click','#widgets-right .sidebar-techkit-custom .sidebar-name h2 .sidebar-techkit-custom-closebtn',function(event){
						event.preventDefault();
						event.stopPropagation();

						if (confirm('<?php esc_html_e( 'Are you sure you want to remove this custom sidebar', 'techkit-core' ); ?>')) {
							$(this).addClass('hidden').next('.spinner').addClass('is-active');

							$.ajax({
								context: this,
								url: '<?php echo esc_url( admin_url( 'admin-ajax.php?action=techkit_remove_sidebar' ) ); ?>',
								dataType: 'json',
								data: {
									id: $(this).closest('.widgets-sortables').attr('id'),
									_wpnonce: '<?php echo wp_create_nonce( 'techkit_remove_sidebar' ); ?>',
								},
								complete: function(response) {
									if ( ! response || ! response.responseJSON || ! response.responseJSON.success) {
										if (response && response.responseJSON && response.responseJSON.data) {
											alert(response.responseJSON.data);
										}
										else {
											alert('<?php esc_html_e( 'Operation failed', 'techkit-core' ); ?>');
										}

										$(this).removeClass('hidden').next('.spinner').removeClass('is-active');
									}
									else {
										$(this).closest('.sidebar-techkit-custom').remove();
									}
								},
							});
						}
					});
				})(jQuery);
			</script>
			<?php
		}
	}
}

new TechkitTheme_Sidebar_Generator;