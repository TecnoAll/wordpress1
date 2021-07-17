<?php
/**
 * Property walkscore section.
 *
 * @package    realplaces
 * @subpackage modern
 */

global $inspiry_options;

if ( ! empty( $inspiry_options['inspiry_property_walkScore_api_key'] ) ) {
	?>
	<section class="rh_property__walkscore_wrap">
		<?php
		if ( ! empty( $inspiry_options['inspiry_property_walkScore_title'] ) ) {
			echo '<h4 class="fancy-title">' . esc_html( $inspiry_options['inspiry_property_walkScore_title'] ) . '</h4>';
		}
		echo '<div class="rh_property__walkscore">' . inspiry_walkscore() . '</div>';
		?>
	</section>
	<?php
};