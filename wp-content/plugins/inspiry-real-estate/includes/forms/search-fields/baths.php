<?php
global $inspiry_options;
?>
<div class="option-bar property-bathrooms">
	<select name="bathrooms" id="select-bathrooms" class="search-select">
		<?php ire_number_options( 'bathrooms', ! empty( $inspiry_options['inspiry_search_property_min_bath_label'] ) ?
			esc_html( $inspiry_options['inspiry_search_property_min_bath_label'] ) :
			esc_html__( 'Min Baths (Any)', 'inspiry-real-estate' ) ) ?>
	</select>
</div>