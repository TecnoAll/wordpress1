<?php
global $inspiry_options;
?>
<div class="option-bar property-keyword">
	<input type="text" name="keyword" id="keyword-txt"
	       value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>"
	       placeholder="<?php echo ! empty( $inspiry_options['inspiry_search_property_keyword_label'] ) ?
		       esc_html( $inspiry_options['inspiry_search_property_keyword_label'] ) :
		       esc_html__( 'Keyword', 'inspiry-real-estate' ); ?>"/>
</div>