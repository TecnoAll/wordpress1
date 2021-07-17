<?php

function ire_contact_form( $contact_meta_data, $inspiry_options ) {

	$inspiry_form_heading = null;
	if ( isset( $contact_meta_data[ 'inspiry_form_heading' ] ) ) {
		$inspiry_form_heading = $contact_meta_data[ 'inspiry_form_heading' ][ 0 ];
	}

	$inspiry_email = null;
	if ( isset( $contact_meta_data[ 'inspiry_email' ] ) ) {
		$inspiry_email = trim($contact_meta_data[ 'inspiry_email' ][ 0 ]);
		$inspiry_email = is_email( $inspiry_email );
	}

	$inspiry_contact_form_7 = null;
	if ( isset( $contact_meta_data[ 'inspiry_contact_form_7' ] ) ) {
		$inspiry_contact_form_7 = $contact_meta_data[ 'inspiry_contact_form_7' ][ 0 ];
	}

	if ( $inspiry_email ) {
		?>
		<div class="col-md-6 col-right-side contact-form-wrapper">

			<section id="contact-form-section">

				<?php
				if ( !empty( $inspiry_form_heading ) ) {
					?><h3 class="contact-form-heading"><?php echo esc_html( $inspiry_form_heading ); ?></h3><?php
				}
				?>

				<form id="contact-form" class="contact-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" novalidate="novalidate">

					<p><input id="name" class="required" name="name" type="text" placeholder="<?php esc_html_e( 'Name*', 'inspiry-real-estate' ); ?>" title="<?php esc_html_e( '* Please provide your name', 'inspiry-real-estate' ); ?>"></p>

					<p><input id="email" class="email required" name="email" type="text" placeholder="<?php esc_html_e( 'Email*', 'inspiry-real-estate' ); ?>" title="<?php esc_html_e( '* Please provide a valid email address', 'inspiry-real-estate' ); ?>"></p>

					<p><input id="number" name="number" type="text" placeholder="<?php esc_html_e( 'Number', 'inspiry-real-estate' ); ?>"></p>

					<p><textarea id="comment" class="required" name="message" placeholder="<?php esc_html_e( 'Message*', 'inspiry-real-estate' ); ?>" title="<?php esc_html_e( '* Please provide your message', 'inspiry-real-estate' ); ?>"></textarea></p>

					<?php
					if ( isset( $inspiry_options[ 'gdpr_contact_form' ] ) && '1' == $inspiry_options[ 'gdpr_contact_form' ] ) {
						ire_gdpr_checkbox( 'contact' );
					}

					ire_get_template_part( 'public/partials/google-reCAPTCHA' );
					?>

					<div class="clearfix">
						<input type="submit" id="submit-button" name="submit" class="btn-small btn-orange pull-right" value="<?php esc_html_e( 'Send Message', 'inspiry-real-estate' ); ?>">
						<img src="<?php echo esc_url( IRE_PLUGIN_URL ); ?>public/images/ajax-loader.gif" id="ajax-loader" class="pull-right" alt="<?php esc_attr_e( 'Loading...', 'inspiry-real-estate' );?>">
						<input type="hidden" name="action" value="inspiry_send_message" />
						<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('send_message_nonce'); ?>"/>
						<input type="hidden" name="target" value="<?php echo antispambot( $inspiry_email ); ?>">
					</div>

					<div id="error-container"></div>
					<div id="message-container">&nbsp;</div>

				</form>

			</section>

		</div>
		<?php
	} else if ( !empty( $inspiry_contact_form_7 ) ) {
		?>
		<div class="col-md-6 col-right-side contact-form-wrapper">

			<section id="contact-form-section">

				<?php
				if ( !empty( $inspiry_form_heading ) ) {
					?><h3 class="contact-form-heading"><?php echo esc_html( $inspiry_form_heading ); ?></h3><?php
				}
				?>

				<div class="inspiry-contact-form-wrapper">
					<?php echo do_shortcode( $inspiry_contact_form_7 ); ?>
				</div>

			</section>

		</div>
		<?php
	}

}