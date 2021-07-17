<?php
global $inspiry_options;
global $number_search_fields;
global $field_counter;

if ( function_exists( 'ire_header_search_form' ) ) {
	ire_header_search_form( $inspiry_options, $number_search_fields, $field_counter );
}