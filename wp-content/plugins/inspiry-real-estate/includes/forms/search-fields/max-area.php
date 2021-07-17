<?php
global $inspiry_options;
?>
<div class="option-bar property-max-area">
    <input type="text" name="max-area" id="max-area" pattern="[0-9]+"
           value="<?php echo isset($_GET['max-area'])?$_GET['max-area']:''; ?>"
           placeholder="<?php echo ! empty( $inspiry_options['inspiry_search_property_max_area_label'] ) ?
               esc_html( $inspiry_options['inspiry_search_property_max_area_label'] ) :
               esc_html__( 'Max Area (sq ft)', 'inspiry-real-estate' ); ?>"
           title="<?php esc_html_e('Please only provide digits!','inspiry-real-estate'); ?>" />
</div>