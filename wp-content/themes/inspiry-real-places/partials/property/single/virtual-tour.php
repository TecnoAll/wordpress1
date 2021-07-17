<?php
global $inspiry_options;
$get_virtual_tour_code = get_post_meta( get_the_ID(), 'REAL_HOMES_360_virtual_tour', true );

if ( ! empty( $get_virtual_tour_code ) ) {
	?>
	<section class="property-virtual-tour">
		<?php
		if ( ! empty( $inspiry_options['inspiry_property_virtual_tour_title'] ) ) {
			?>
			<h4 class="fancy-title"><?php echo esc_html( $inspiry_options['inspiry_property_virtual_tour_title'] ); ?></h4>
			<?php
		}

		$allow_iframe_in_kses = array(
			'iframe' => array(
				'style'           => array(),
				'src'             => array(),
				'width'           => array(),
				'height'          => array(),
				'allowvr'         => array(),
				'allowfullscreen' => array(),
				'gesture'         => array(),
				'frameborder'     => array(),
			)
		);

		echo wp_kses( $get_virtual_tour_code, $allow_iframe_in_kses );
		?>
	</section>
	<?php
}
?>