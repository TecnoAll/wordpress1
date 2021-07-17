<?php
/**
 * Google Half Map Right
 */
?>
<div class="row">

	<div class="col-md-6 site-main-content padding-right-zero">
		<?php
		get_template_part( 'partials/property/half-map/properties-list-half-map' );
		?>
	</div>

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