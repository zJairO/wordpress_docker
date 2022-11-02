<?php

if ( ! class_exists( 'TM_Flickr_Widget' ) ) {
	class TM_Flickr_Widget extends Atomlab_Widget {

		function __construct() {
			$this->widget_cssclass    = 'flickr';
			$this->widget_description = esc_html__( 'The most recent photos from flickr.', 'atomlab' );
			$this->widget_id          = 'flickr-widget';
			$this->widget_name        = esc_html__( '[Atomlab]: Flickr', 'atomlab' );
			$this->settings           = array(
				'title'          => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Photos from Flickr', 'atomlab' ),
					'label' => esc_html__( 'Title', 'atomlab' ),
				),
				'flickr_id'      => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Flickr ID', 'atomlab' ),
				),
				'number'         => array(
					'type'  => 'number',
					'step'  => 1,
					'min'   => 1,
					'max'   => '',
					'std'   => 6,
					'label' => esc_html__( 'Number of photos', 'atomlab' ),
				),
				'type'           => array(
					'type'    => 'select',
					'std'     => 'user',
					'label'   => esc_html__( 'Type', 'atomlab' ),
					'options' => array(
						'user'  => esc_html__( 'User', 'atomlab' ),
						'group' => esc_html__( 'Group', 'atomlab' ),
					),
				),
				'display'        => array(
					'type'    => 'select',
					'std'     => 'latest',
					'label'   => esc_html__( 'Display', 'atomlab' ),
					'options' => array(
						'latest' => esc_html__( 'Latest', 'atomlab' ),
						'random' => esc_html__( 'Random', 'atomlab' ),
					),
				),
				'number_columns' => array(
					'type'  => 'number',
					'step'  => 1,
					'min'   => 1,
					'max'   => 10,
					'std'   => 3,
					'label' => esc_html__( 'Number of columns', 'atomlab' ),
				),
			);

			parent::__construct();
		}

		function widget( $args, $instance ) {
			$number         = $instance['number'];
			$flickr_id      = $instance['flickr_id'];
			$type           = $instance['type'];
			$display        = $instance['display'];
			$number_columns = $instance['number_columns'];

			if ( empty( $flickr_id ) ) {
				$flickr_id = '95572727@N00';
			}

			$this->widget_start( $args, $instance );

			$wrapper_classes = 'tm-flickr';
			$wrapper_classes .= ' tm-flickr-' . $number_columns;
			$flickr_src      = '//www.flickr.com/badge_code_v2.gne?count=' . $number . '&amp;display=' . $display . '&amp;size=s&amp;layout=x&amp;source=' . $type . '&amp;' . $type . '=' . $flickr_id;
			?>
			<div class="<?php echo esc_attr( $wrapper_classes ); ?>">
				<script src="<?php echo esc_attr( $flickr_src ); ?>"></script>
				<p class="flickr_stream_wrap">
					<a class="wpb_follow_btn wpb_flickr_stream"
					   href="<?php echo esc_url( "//www.flickr.com/photos/$flickr_id" ); ?>"><?php esc_html_e( 'View stream on flickr', 'atomlab' ); ?></a>
				</p>
			</div>
			<?php

			$this->widget_end( $args );
		}
	}
}
