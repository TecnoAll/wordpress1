<?php
/*
 * Single property page
 */
get_header();

get_template_part( 'partials/header/banner' );

global $inspiry_options;

// Flag for gallery images in case of 3rd variation
global $gallery_images_exists;
$gallery_images_exists = false;


// For Demo Purposes
if ( isset( $_GET['variation'] ) ) {
	$inspiry_options['inspiry_property_header_variation'] = intval( $_GET['variation'] );
}

/*
 * Slider for 3rd variation
 */
if ( $inspiry_options['inspiry_property_header_variation'] == 3 ) {
	get_template_part( 'partials/property/single/slider-3' );
}

?>
	<div id="content-wrapper" class="site-content-wrapper site-pages">

		<div id="content" class="site-content layout-boxed">

			<div class="container">

				<div class="container-property-single clearfix">

					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();

							global $inspiry_single_property;
							$inspiry_single_property = new Inspiry_Property( get_the_ID() );

							/*
							 * Property header variation one
							 */
							if ( $inspiry_options['inspiry_property_header_variation'] == 1 ) {
								?>
								<div class="col-lg-8 zero-horizontal-padding property-slider-wrapper">
									<?php
									/*
									 * Slider one
									 */
									get_template_part( 'partials/property/single/slider' );
									?>
								</div>

								<div class="col-lg-4 zero-horizontal-padding property-title-wrapper">
									<?php
									/*
									 * Title
									 */
									get_template_part( 'partials/property/single/title' );
									?>
								</div>
								<?php
							}

							?>
							<div class="col-md-8 site-main-content property-single-content">

								<main id="main" class="site-main">

										<?php
										/*
										 * Property header variation two
										 */
										if ( $inspiry_options['inspiry_property_header_variation'] == 2 ) {
											/*
											 * Slider Two
											 */
											get_template_part( 'partials/property/single/slider-2' );
										}


										/*
										 * For 3rd variation
										 */
										if ( $inspiry_options['inspiry_property_header_variation'] == 3 ) {
											if ( $gallery_images_exists ) {
												// For print.
												if ( has_post_thumbnail() ) {
													echo '<div id="property-featured-image" class="only-for-print">';
													the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) );
													echo '</div>';
												}
											} else {
												inspiry_standard_thumbnail( 'post-thumbnail' );
											}
										}


										if ( $inspiry_options['inspiry_property_header_variation'] == 2 || $inspiry_options['inspiry_property_header_variation'] == 3 ) {
											/*
											 * Title
											 */
											get_template_part( 'partials/property/single/title' );
										}


										$property_sections = $inspiry_options['inspiry_property_single_fields']['enabled'];
										$property_sections = array_keys( $property_sections );
										if ( is_array( $property_sections ) && ! empty( $property_sections ) ) {

											foreach ( $property_sections as $property_section ) {
												 get_template_part( 'partials/property/single/' . $property_section );
											}
										}
										/*
										* Comments
										*/
										if ( $inspiry_options['inspiry_property_comments'] ) {
											if ( comments_open() || '0' != get_comments_number() ) :
												comments_template();
											endif;
										}
										?>
								</main>
								<!-- .site-main -->

							</div>
							<!-- .site-main-content -->
							<?php

						endwhile;
					endif;
					?>

					<div class="col-md-4 zero-horizontal-padding">

						<aside class="sidebar sidebar-property-detail">
							<?php
							/*
							 * Agent / Author Information
							 */
							if ( $inspiry_options['inspiry_property_agent'] ) {
								get_template_part( 'partials/property/single/agent-widget' );
							}

							/*
							 * Similar Properties
							 */
							if ( $inspiry_options['inspiry_similar_properties'] ) {
								get_template_part( 'partials/property/single/similar-properties' );
							}

							/*
							 * Remaining Sidebar
							 */
							if ( inspiry_is_active_custom_sidebar( 'property-sidebar' ) ) {
								inspiry_dynamic_sidebar( 'property-sidebar' );
							}
							?>
						</aside><!-- .sidebar -->

					</div>
					<!-- .site-sidebar-content -->

				</div>
				<!-- .container-property-single -->

			</div>
			<!-- .container -->

		</div>
		<!-- .site-content -->

	</div><!-- .site-content-wrapper -->

<?php
get_footer();
