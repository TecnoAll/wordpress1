<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="inspiry-ire-page-content">
    <form method="post" action="options.php">
		<?php
		settings_fields( 'inspiry_map_option_group' );
		do_settings_sections( 'inspiry_map_page' );

		submit_button();
		?>
    </form>
</div>