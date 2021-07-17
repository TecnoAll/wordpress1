<?php
/*
 * Template Name: Properties List - Half Map
 */
get_header();

get_template_part( 'partials/header/banner' );
$get_google_half_map_layout = get_post_meta( get_the_ID(), 'inspiry_display_google_half_map', true );

?>
	<div class="wrapper-search-form-two">
		<?php
		global $inspiry_options;

		if ( $inspiry_options['inspiry_header_variation'] != '1' ) {
			if ( inspiry_theme_options_set( 'inspiry_search_form_two' ) && $inspiry_options['inspiry_search_form_two'] == '1' ) {
				get_template_part( 'partials/home/search' );
			}
		}
		?>
	</div>


	<div id="content-wrapper"
	     class="site-content-wrapper site-pages properties-with-half-map <?php echo esc_attr( $get_google_half_map_layout == 'right' ? 'right-half-map' : '' ); ?>">

		<div id="content" class="site-content">

			<div class="map-container-sm"></div>

			<div class="wrapper"></div>

			<div class="container">
				<?php get_template_part( 'partials/property/templates/compare', 'view' );

				if ( $get_google_half_map_layout == 'left' ) {
					get_template_part( 'partials/property/half-map/listing-half-map-left' );
				} else {
					get_template_part( 'partials/property/half-map/listing-half-map-right' );
				}
				?>

			</div>
			<!-- .container -->

		</div>
		<!-- .site-content -->

	</div><!-- .site-content-wrapper -->

<?php
get_footer();
?>