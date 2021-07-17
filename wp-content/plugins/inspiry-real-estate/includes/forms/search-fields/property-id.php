<?php
global $inspiry_options;
?>
<div class="option-bar property-id">
	<input type="text" name="property-id" id="property-id-txt"
	       value="<?php echo isset( $_GET['property-id'] ) ? $_GET['property-id'] : ''; ?>"
	       placeholder="<?php echo ! empty( $inspiry_options['inspiry_search_property_id_label'] ) ?
		       esc_html( $inspiry_options['inspiry_search_property_id_label'] ) :
		       esc_html__( 'Property ID', 'inspiry-real-estate' ) ?>"/>
</div>