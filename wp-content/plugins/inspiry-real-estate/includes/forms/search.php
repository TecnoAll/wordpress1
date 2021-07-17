<?php
/**
 * Generates search form
 *
 * @param $inspiry_options
 */
function ire_properties_search_form( $inspiry_options ) {
	// Search Fields
	$search_fields = $inspiry_options[ 'inspiry_search_fields' ][ 'enabled' ];
	$search_page   = $inspiry_options[ 'inspiry_search_page' ];     // search page id

	if ( ( 0 < count( $search_fields ) ) && ( ! empty( $search_page ) ) ) {

		// If WPML is installed then this function will return translated page id for current language against given page id
		$search_page = ire_wpml_translated_page_id( $search_page );

		?>
		<form class="advance-search-form" action="<?php echo get_permalink( $search_page ); ?>" method="get">
			<?php
			foreach ( $search_fields as $key => $val ) {

				switch ( $key ) {

					case 'keyword':
						ire_get_template_part( 'includes/forms/search-fields/keyword' );
						break;

					case 'location':
						ire_get_template_part( 'includes/forms/search-fields/locations' );
						break;

					case 'status':
						ire_get_template_part( 'includes/forms/search-fields/property-status' );
						break;

					case 'type':
						ire_get_template_part( 'includes/forms/search-fields/property-type' );
						break;

					case 'min-beds':
						ire_get_template_part( 'includes/forms/search-fields/beds' );
						break;

					case 'min-baths':
						ire_get_template_part( 'includes/forms/search-fields/baths' );
						break;

					case 'min-max-price':
						ire_get_template_part( 'includes/forms/search-fields/min-price' );
						ire_get_template_part( 'includes/forms/search-fields/max-price' );
						break;

					case 'min-max-area':
						ire_get_template_part( 'includes/forms/search-fields/min-area' );
						ire_get_template_part( 'includes/forms/search-fields/max-area' );
						break;

					case 'property-id':
						ire_get_template_part( 'includes/forms/search-fields/property-id' );
						break;

				}
			}

			// Submit Button
			ire_get_template_part( 'includes/forms/search-fields/submit-btn' );

			// Features
			if ( $inspiry_options[ 'inspiry_search_features' ] ) {
				ire_get_template_part( 'includes/forms/search-fields/features' );
			}

			// generated sort by field
			if ( isset( $_GET[ 'sortby' ] ) ) {
				echo '<input type="hidden" name="sortby" value="' . $_GET[ 'sortby' ] . '" />';
			}
			?>
		</form><!-- .advance-search-form -->
		<?php
	}
}


/**
 * @param $inspiry_options
 * @param $number_search_fields
 * @param $field_counter
 */
function ire_header_search_form( $inspiry_options, &$number_search_fields, &$field_counter ) {

	// Search Fields
	$search_fields = $inspiry_options[ 'inspiry_search_fields' ][ 'enabled' ];
	$search_page   = "";
	if ( isset( $inspiry_options[ 'inspiry_search_page' ] ) ) {
		$search_page = $inspiry_options[ 'inspiry_search_page' ];
	}

	// A redux fix
	if ( isset( $search_fields[ 'placebo' ] ) ) {
		unset( $search_fields[ 'placebo' ] );
	}

	$number_search_fields = count( $search_fields );

	// increment the number of search fields as min max has two fields
	if ( isset( $search_fields[ 'min-max-price' ] ) ) {
		$number_search_fields ++;
	}

	// increment the number of search fields as min max has two fields
	if ( isset( $search_fields[ 'min-max-area' ] ) ) {
		$number_search_fields ++;
	}

	if ( ( 0 < $number_search_fields ) && ( ! empty( $search_page ) ) ) {

		// If WPML is installed then this function will return translated page id for current language against given page id
		$search_page = ire_wpml_translated_page_id( $search_page );

		?>
		<form class="advance-search-form" action="<?php echo get_permalink( $search_page ); ?>" method="get">
			<div class="inline-fields clearfix">
				<?php

				$field_counter = 0;
				foreach ( $search_fields as $key => $val ) {

					switch ( $key ) {

						case 'keyword':
							ire_get_template_part( 'includes/forms/search-fields/keyword' );
							$field_counter ++;
							break;

						case 'location':
							ire_get_template_part( 'includes/forms/search-fields/locations' );

							// code to display hidden field separator at right place
							$number_of_location_boxes = ire_get_locations_number();
							if ( $number_of_location_boxes > 1 ) {
								$field_counter += $number_of_location_boxes;
							} else {
								$field_counter ++;
							}
							break;

						case 'status':
							ire_get_template_part( 'includes/forms/search-fields/property-status' );
							$field_counter ++;
							break;

						case 'type':
							ire_get_template_part( 'includes/forms/search-fields/property-type' );
							$field_counter ++;
							break;

						case 'min-beds':
							ire_get_template_part( 'includes/forms/search-fields/beds' );
							$field_counter ++;
							break;

						case 'min-baths':
							ire_get_template_part( 'includes/forms/search-fields/baths' );
							$field_counter ++;
							break;

						case 'min-max-price':
							ire_get_template_part( 'includes/forms/search-fields/min-price' );
							$field_counter ++;

							if ( $field_counter == 3 ) {
								ire_get_template_part( 'partials/search/hidden-fields-separator' );
							}

							ire_get_template_part( 'includes/forms/search-fields/max-price' );
							$field_counter ++;
							break;

						case 'min-max-area':
							ire_get_template_part( 'includes/forms/search-fields/min-area' );
							$field_counter ++;

							if ( $field_counter == 3 ) {
								ire_get_template_part( 'partials/search/hidden-fields-separator' );
							}

							ire_get_template_part( 'includes/forms/search-fields/max-area' );
							$field_counter ++;
							break;

						case 'property-id':
							ire_get_template_part( 'includes/forms/search-fields/property-id' );
							$field_counter ++;
							break;

					}

					if ( ( $field_counter == 3 ) || ( $field_counter < 3 && $field_counter == $number_search_fields ) ) {
						ire_get_template_part( 'includes/forms/search-fields/hidden-fields-separator' );
					}
				}

				if ( $inspiry_options[ 'inspiry_search_features' ] ) {
					ire_get_template_part( 'includes/forms/search-fields/features' );
				}

				if ( $field_counter > 3 ) {
				?>
			</div>
			<?php
			}

			// generated sort by field
			if ( isset( $_GET[ 'sortby' ] ) ) {
				echo '<input type="hidden" name="sortby" value="' . $_GET[ 'sortby' ] . '" />';
			}
			?>
		</form>
		<?php
	}
}