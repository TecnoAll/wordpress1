<?php
/**
 * Compare Properties: Container.
 *
 * @since 1.6.3
 * @package RP
 */
global $inspiry_options;
$inspiry_compare_display_option = $inspiry_options['inspiry_compare_display_options'];

if ( isset( $inspiry_options['inspiry_compare_page'] ) ) {
	$inspiry_compare_page = $inspiry_options['inspiry_compare_page'];
}

if ( ( $inspiry_compare_display_option === '1' ) && ( $inspiry_compare_page ) ) {

	$inspiry_compare_page = ( ! empty( $inspiry_compare_page ) ) ? $inspiry_compare_page : false;

	$compare_page_url = get_permalink( $inspiry_compare_page );
	$compare_page_url = ( ! empty( $compare_page_url ) ) ? $compare_page_url : false;

	if ( isset( $_COOKIE['inspiry_compare'] ) ) {
		$compare_list_items = unserialize( $_COOKIE['inspiry_compare'] );
	}

	if ( ! empty( $compare_list_items ) ) {
		foreach ( $compare_list_items as $compare_list_item ) {
			$compare_property = get_post( $compare_list_item );

			if ( ! empty( $compare_property ) ) {
				$thumbnail_id = get_post_thumbnail_id( $compare_property->ID );
				if ( ! empty( $thumbnail_id ) ) {
					$compare_property_img = wp_get_attachment_image_src(
						$thumbnail_id, 'inspiry-grid-thumbnail'
					);
				} else {
					$compare_property_img[0] = get_inspiry_image_placeholder_url( 'inspiry-grid-thumbnail' );
				}

				$compare_properties[] = array(
					'ID'    => $compare_property->ID,
					'title' => $compare_property->post_title,
					'img'   => $compare_property_img,
				);
			}
		}
	}

	?>

	<div class="compare-properties clear">

		<h3><?php esc_html_e( 'Compare Properties', 'inspiry' ); ?></h3>

		<div class="compare-carousel clear">
			<?php if ( ! empty( $compare_properties ) ) : ?>
				<?php foreach ( $compare_properties as $compare_single_property ) : ?>
					<div class="compare-carousel-slide clear">
						<div class="compare-slide-img">
							<?php if ( isset( $compare_single_property['img'] ) ) : ?>
								<img
									src="<?php echo esc_attr( $compare_single_property['img'][0] ); ?>"
									alt="<?php echo esc_attr( $compare_single_property['title'] ); ?>"
									width="<?php echo esc_attr( $compare_single_property['img'][1] ); ?>"
									height="<?php echo esc_attr( $compare_single_property['img'][2] ); ?>"
								>
							<?php endif; ?>
						</div>
						<a class="compare-remove"
						   data-property-id="<?php echo esc_attr( $compare_single_property['ID'] ); ?>"
						   href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"><i
								class="fas fa-times"></i></a>
					</div>
				<?php endforeach; ?>
				<!-- .compare-carousel-slide -->
			<?php endif; ?>
		</div>

		<a href="<?php echo esc_attr( $compare_page_url ); ?>"
		   class="compare-submit real-btn btn"><?php esc_html_e( 'Compare', 'inspiry' ); ?></a>
		<!-- .compare-submit -->

	</div>
	<!-- .compare-properties -->
	<?php
}
?>