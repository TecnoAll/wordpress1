<?php
global $inspiry_options;
?>
<div class="option-bar property-type">
	<select name="type" id="select-property-type" class="search-select">
		<?php ire_generate_taxonomy_options( 'property-type',
			! empty( $inspiry_options['inspiry_search_property_type_label'] ) ?
				esc_html( $inspiry_options['inspiry_search_property_type_label'] ) :
				esc_html__( 'Property Type', 'inspiry-real-estate' )
		); ?>
	</select>
</div>