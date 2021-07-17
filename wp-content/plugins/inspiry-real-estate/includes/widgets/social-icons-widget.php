<?php
/**
 * Class Inspiry_Social_Media_Icons_Widget
 *
 * @since 1.0.0
 */
class Inspiry_Social_Media_Icons_Widget extends WP_Widget {

	private $services    = array();
	private $before_list = '<div class="social-networks clearfix">';
	private $after_list  = '</div>';

	/**
	 * Basic configurations
	 */
	public function __construct() {

		$this->services = array(
			'twitter'        => esc_html__( 'Twitter URL', 'inspiry-real-estate' ),
			'facebook'       => esc_html__( 'Facebook URL', 'inspiry-real-estate' ),
			'linkedin'       => esc_html__( 'LinkedIn URL', 'inspiry-real-estate' ),
			'instagram'      => esc_html__( 'Instagram URL', 'inspiry-real-estate' ),
			'youtube-square' => esc_html__( 'YouTube URL', 'inspiry-real-estate' ),
			'pinterest'      => esc_html__( 'Pinterest URL', 'inspiry-real-estate' ),
			'rss'            => esc_html__( 'RSS URL', 'inspiry-real-estate' ),
		);

		parent::__construct(
			'inspiry_social_media_icons',
			'Inspiry Social Media Icons',
			array(
				'description' => esc_html__( 'Display social media icons.', 'inspiry-real-estate' ),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @since 1.0.0
	 * @param array $args   Widget arguments.
	 * @param array $instance   Saved values from database.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$links = array();
		foreach ( $this->services as $service_name => $service_title ) {
			$links[ $service_name ] = esc_url( $instance[ $service_name ] );
		}

		$links = array_filter( $links );

		if ( empty( $links ) ) {
			return false;
		}

		echo $before_widget;

		if ( isset( $title ) && ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}

		echo $this->before_list;

		foreach ( $links as $service_name => $service_link ) {
			if ( 'rss' == $service_name ) {
				printf(
					'<a class="%s" href="%s" target="_blank"><i class="fas fa-%s fa-lg"></i></a>',
					$service_name,
					esc_url( $service_link ),
					$service_name
				);
			} else {
				printf(
					'<a class="%s" href="%s" target="_blank"><i class="fab fa-%s fa-lg"></i></a>',
					$service_name,
					esc_url( $service_link ),
					$service_name
				);
			}
		}

		echo $this->after_list;

		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @since 1.0.0
	 * @param array $new Values just sent to be saved.
	 * @param array $old Previously saved values from database.
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new, $old ) {
		$instance = $old;

		$instance['title'] = ! empty( $new['title'] ) ? strip_tags( $new['title'] ) : null;

		foreach ( $this->services as $service_name => $service_title ) {
			$instance[ $service_name ] = ! empty( $new[ $service_name ] ) ? esc_url_raw( $new[ $service_name ] ) : null;
		}

		return $instance;
	}

	/**
	 * Backend widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @since 1.0.0
	 * @param array $instance Previously saved values from database.
	 *
	 * @return void
	 */
	public function form( $instance ) {

		$defaults = array_fill_keys(
			array_merge(
				array_keys( $this->services ),
				array( 'title' )
			),
			null
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'inspiry-real-estate' ); ?></label>
			<input type="text"
				   class="widefat"
				   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				   value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<?php
		foreach ( $this->services as $service_name => $service_title ) {
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( $service_name ) ); ?>"><?php echo esc_html( $service_title ); ?></label>
				<input type="text"
					   class="widefat"
					   name="<?php echo esc_attr( $this->get_field_name( $service_name ) ); ?>"
					   id="<?php echo esc_attr( $this->get_field_id( $service_name ) ); ?>"
					   value="<?php echo esc_url( $instance[ $service_name ] ); ?>"/>
			</p>
			<?php
		}

	}

} // class Inspiry_Social_Media_Icons_Widget



/**
 * Register social media widget
 */
function ire_register_social_media_widget() {
	register_widget( 'Inspiry_Social_Media_Icons_Widget' );
}
add_action( 'widgets_init', 'ire_register_social_media_widget' );
