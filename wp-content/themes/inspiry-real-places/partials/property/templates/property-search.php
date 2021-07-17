<?php
/*
* Google Map or Banner
*/
global $inspiry_options;
if ( $inspiry_options['inspiry_search_module_below_header'] == 'google-map' ) {
// Image Banner
	get_template_part( 'partials/header/map' );
} else {
// Image Banner
	get_template_part( 'partials/header/banner' );
}

$search_layout = $inspiry_options['inspiry_search_layout'];

if ( ( 'grid' == $search_layout ) || ( 'list' == $search_layout ) ) {
	?>
	<div class="wrapper-search-form-two">
		<?php
		if ( $inspiry_options['inspiry_home_search'] && $inspiry_options['inspiry_header_variation'] != '1' ) {
			get_template_part( 'partials/home/search' );
		}
		?>
	</div>
	<?php
}
?>
<div id="content-wrapper" class="site-content-wrapper site-pages">

	<div id="content" class="site-content layout-boxed">

		<div class="container">
<?php get_template_part( 'partials/property/templates/compare', 'view' ); ?>
			<div class="row">

				<div class="col-xs-12 site-main-content">

					<main id="main" class="site-main">
						<?php
						global $inspiry_options;


						// Number of properties to display
						$number_of_properties = intval( $inspiry_options['inspiry_search_properties_number'] );
						if ( ! $number_of_properties ) {
							$number_of_properties = 6;
						}

						// Current Page
						global $paged;
						if ( is_front_page() ) {
							$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
						}

						// Basic query arguments
						$properties_search_arg = array(
							'post_type'      => 'property',
							'posts_per_page' => $number_of_properties,
							'paged'          => $paged,
						);

						// Apply search filter
						$properties_search_arg = apply_filters( 'inspiry_property_search', $properties_search_arg );

						// Apply sorting filter
						$properties_search_arg = apply_filters( 'inspiry_sort_properties', $properties_search_arg );

						// Create custom query
						$properties_search_query = new WP_Query( $properties_search_arg );


						if ( 'list-sidebar' == $search_layout || 'grid-sidebar' == $search_layout ) {
							echo '<div class="row"><div class="col-md-9">';
						}

						/*
						 * Found properties heading and sorting controls
						 */
						global $found_properties;
						$found_properties = $properties_search_query->found_posts;
						get_template_part( 'partials/property/templates/listing-control' );

						/*
						 * Properties
						 */
						if ( $properties_search_query->have_posts() ) :

							global $property_list_counter;
							$property_list_counter = 1;

							if ( $search_layout == 'grid' || $search_layout == 'grid-sidebar' ) {
								echo '<div class="row">';
							}

							while ( $properties_search_query->have_posts() ) :

								$properties_search_query->the_post();

								if ( 'list-sidebar' == $search_layout ) {
									// display property in list layout with sidebar
									get_template_part( 'partials/property/templates/property-for-list-with-sidebar' );
								} else if ( 'grid-sidebar' == $search_layout ) {
									// display property in grid layout with sidebar
									get_template_part( 'partials/property/templates/property-for-grid-with-sidebar' );
								} else if ( 'grid' == $search_layout ) {
									// display property in grid layout
									get_template_part( 'partials/property/templates/property-for-grid' );
								} else {
									// display property in list layout
									get_template_part( 'partials/property/templates/property-for-list' );
								}

								$property_list_counter ++;

							endwhile;

							if ( $search_layout == 'grid' || $search_layout == 'grid-sidebar' ) {
								echo '</div>';
							}

							inspiry_pagination( $properties_search_query );

							wp_reset_postdata();

						endif;

						if ( ( 'list-sidebar' == $search_layout || 'grid-sidebar' == $search_layout ) && is_active_sidebar( 'properties-list' ) ) {
							echo '</div><div class="col-md-3 site-sidebar-content">';
							get_sidebar( 'properties-list' );
							echo '</div></div>'; // .site-sidebar-content & .row
						}

						?>

					</main>
					<!-- .site-main -->

				</div>
				<!-- .site-main-content -->

			</div>
			<!-- .row -->

		</div>
		<!-- .container -->

	</div>
	<!-- .site-content -->

</div><!-- .site-content-wrapper -->