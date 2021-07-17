<?php
global $inspiry_options;
?>
<div class="option-bar property-status">
	<select name="status" id="select-status" class="search-select">
		<?php ire_generate_taxonomy_options( 'property-status',
			! empty( $inspiry_options['inspiry_search_property_status_label'] ) ?
				esc_html( $inspiry_options['inspiry_search_property_status_label'] ) :
				esc_html__( 'Property Status', 'inspiry-real-estate' )
		); ?>
	</select>
</div>