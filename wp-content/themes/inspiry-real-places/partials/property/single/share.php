<?php
if ( function_exists( 'ire_single_property_social_share' ) ) {
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="property-share-networks clearfix">
				<?php
				global $inspiry_options;
				if ( !empty( $inspiry_options[ 'inspiry_property_share_title' ] ) ) {
					?><h4 class="fancy-title"><?php echo esc_html( $inspiry_options[ 'inspiry_property_share_title' ] ); ?></h4><?php
				}

				ire_single_property_social_share();
				?>
			</div>
		</div>
	</div>
	<?php
}
?>