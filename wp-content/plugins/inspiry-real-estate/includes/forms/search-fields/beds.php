<?php
global $inspiry_options;
?>
<div class="option-bar property-bedrooms">
	<select name="bedrooms" id="select-bedrooms" class="search-select">
		<?php ire_number_options( 'bedrooms', ! empty( $inspiry_options['inspiry_search_property_min_bed_label'] ) ?
			esc_html( $inspiry_options['inspiry_search_property_min_bed_label'] ) :
			esc_html__( 'Min Beds (Any)', 'inspiry-real-estate' ) ) ?>
	</select>
</div>