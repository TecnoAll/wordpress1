<?php
global $inspiry_options;
?>
<div class="option-bar property-min-area">
	<input type="text" name="min-area" id="min-area" pattern="[0-9]+"
	       value="<?php echo isset( $_GET['min-area'] ) ? $_GET['min-area'] : ''; ?>"
	       placeholder="<?php echo ! empty( $inspiry_options['inspiry_search_property_min_area_label'] ) ?
		       esc_html( $inspiry_options['inspiry_search_property_min_area_label'] ) :
		       esc_html__( 'Min Area (sq ft)', 'inspiry-real-estate' ); ?>"
	       title="<?php esc_html_e( 'Please only provide digits!', 'inspiry-real-estate' ); ?>"/>
</div>