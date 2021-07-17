<?php
/*
 * Template Name: Properties Search
 */

get_header();
global $inspiry_options;

$search_layout = $inspiry_options['inspiry_search_layout'];

if ( $search_layout == 'half-left' ) {
	get_template_part( 'partials/property/half-map/properties-search-half-map-left' );
}elseif($search_layout == 'half-right'){
	get_template_part( 'partials/property/half-map/properties-search-half-map-right' );
} else {
	get_template_part( 'partials/property/templates/property-search' );
}
get_footer();
?>

