<?php
/*
* Google Map or Banner
*/
global $inspiry_options;

$search_layout = $inspiry_options['inspiry_search_layout'];

get_template_part( 'partials/header/banner' );
?>
<div class="wrapper-search-form-two">
	<?php
	if ( $inspiry_options[ 'inspiry_home_search' ] && $inspiry_options[ 'inspiry_header_variation' ] != '1' ) {
		get_template_part( 'partials/home/search' );
	}
	?>
</div>

<div id="content-wrapper" class="site-content-wrapper site-pages properties-with-half-map right-half-map">

	<div id="content" class="site-content">

		<div class="map-container-sm"></div>

		<div class="container">
			<?php get_template_part( 'partials/property/templates/compare', 'view' ); ?>
			<div class="row">



				<div class="col-md-6 site-main-content padding-right-zero">

					<?php
					get_template_part( 'partials/property/half-map/half-map-properties' );
					?>
					<!-- .site-main -->

				</div>
				<!-- .site-main-content -->

				<div class="col-md-6">
					<div class="map-container-md"></div>
					<div class="map-container">
						<div class="map-inner">
							<?php
							get_template_part( 'partials/header/map' );
							?>
						</div>
					</div>
				</div>

			</div>
			<!-- .row -->

		</div>
		<!-- .container -->

	</div>
	<!-- .site-content -->

</div><!-- .site-content-wrapper -->