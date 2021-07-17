<?php
global $inspiry_options;
if ( isset( $inspiry_options['inspiry_compare_display_options'] ) && isset( $inspiry_options['inspiry_compare_page'] ) ) {

    $inspiry_compare_display_option = $inspiry_options['inspiry_compare_display_options'];
	$inspiry_compare_page           = $inspiry_options['inspiry_compare_page'];

	if ( ( $inspiry_compare_display_option === '1' ) && ( $inspiry_compare_page ) ) {
		?>
        <div class="add-to-compare-span">
			<?php
			$property_id = get_the_ID();
			if ( inspiry_is_added_to_compare( $property_id ) ) {
				?>
                <div class="compare_output show">
                    <i title="<?php esc_html_e( 'Added To Compare', 'inspiry' ); ?>">
						<?php include( get_template_directory() . '/images/svg/icon-compare.svg' ); ?>
                    </i>
                </div>
                <a class="add-to-compare hide" data-property-id="<?php echo esc_attr( $property_id ); ?>"
                   href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
                    <i title="<?php esc_html_e( 'Add To Compare', 'inspiry' ) ?>">
						<?php include( get_template_directory() . '/images/svg/icon-compare.svg' ); ?>
                    </i>

                </a>
				<?php
			} else {
				?>
                <div class="compare_output">
                    <i title="<?php esc_html_e( 'Added To Compare', 'inspiry' ); ?>">
						<?php include( get_template_directory() . '/images/svg/icon-compare.svg' ); ?>
                    </i>
                </div>
                <a class="add-to-compare" data-property-id="<?php echo esc_attr( $property_id ); ?>"
                   href="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>">
                    <i title="<?php esc_html_e( 'Add To Compare', 'inspiry' ); ?>">
						<?php include( get_template_directory() . '/images/svg/icon-compare.svg' ); ?>
                    </i>
                </a>
				<?php
			}
			?>
        </div>
		<?php
	}
}
?>