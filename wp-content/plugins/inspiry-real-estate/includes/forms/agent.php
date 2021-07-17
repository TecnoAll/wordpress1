<?php
/**
 * Agent single page's contact form.
 *
 * @param $inspiry_options
 */
function ire_single_agent_form( $inspiry_options ) {

	$agent_email = '';
	if ( is_singular( 'agent' ) ) {
		$agent_email = get_post_meta( get_the_ID(), 'REAL_HOMES_agent_email', true );
	} else if ( is_author() ){
		global $current_author;
		$agent_email = $current_author->user_email;
	}

	$agent_email = is_email( $agent_email );

	if( $agent_email ) {
		?>
		<div class="agent-contact-form">
			<h3 class="agent-contact-form-title"><?php esc_html_e( 'Contact Agent', 'inspiry-real-estate' ); ?></h3>
			<form class="agent-form contact-form-small" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" novalidate="novalidate">
				<div class="row">
					<div class="col-sm-6 left-field">
						<input type="text" name="name" placeholder="<?php esc_html_e( 'Name', 'inspiry-real-estate' ); ?>" class="required" title="<?php esc_html_e( '* Please provide your name', 'inspiry-real-estate' ); ?>" />
					</div>
					<div class="col-sm-6 right-field">
						<input type="text" name="email" placeholder="<?php esc_html_e( 'Email', 'inspiry-real-estate' ); ?>" class="email required" title="<?php esc_html_e( '* Please provide valid email address', 'inspiry-real-estate' ); ?>" />
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 left-field">
						<input type="text" name="contact-number" placeholder="<?php esc_html_e( 'Contact Number', 'inspiry-real-estate' ); ?>" class="" title="<?php esc_html_e( '* Please provide your contact number', 'inspiry-real-estate' ); ?>" />
					</div>
				</div>

				<textarea name="message" class="required" placeholder="<?php esc_html_e( 'Message', 'inspiry-real-estate' ); ?>" title="<?php esc_html_e( '* Please provide your message', 'inspiry-real-estate' ); ?>"></textarea>

				<?php
				if ( isset( $inspiry_options[ 'gdpr_agent_contact_form' ] ) && '1' == $inspiry_options[ 'gdpr_agent_contact_form' ] ) {
					ire_gdpr_checkbox( 'agent' );
				}

				ire_get_template_part( 'public/partials/google-reCAPTCHA' );
				?>
				<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'agent_message_nonce' ); ?>"/>
				<input type="hidden" name="target" value="<?php echo antispambot( $agent_email ); ?>" />
				<input type="hidden" name="action" value="send_message_to_agent" />

				<input type="submit" name="submit" class="agent-submit btn-default btn-round" value="<?php esc_html_e( 'Send Message', 'inspiry-real-estate' ); ?>" />

				<img src="<?php echo esc_url( IRE_PLUGIN_URL ); ?>public/images/ajax-loader.gif" id="ajax-loader" class="agent-loader" alt="<?php esc_attr_e( 'Loading...', 'inspiry-real-estate' );?>">

				<div class="agent-error"></div>
				<div class="agent-message"></div>
			</form>
		</div>
		<?php
	}

}


/**
 * Agent's contact form on property single
 *
 * @param $inspiry_options
 * @param $inspiry_single_property
 * @param $contact_form_email
 * @param $agent_id_to_checkbox
 */
function ire_property_single_agent_form( $inspiry_options, $inspiry_single_property, $contact_form_email, $agent_id_to_checkbox ) {

	$property_title = get_the_title( $inspiry_single_property->get_post_ID() );
	$property_permalink = get_permalink( $inspiry_single_property->get_post_ID() );

	?>
	<div class="agent-contact-form">
		<?php
		if ( !empty( $inspiry_options[ 'inspiry_agent_contact_form_title' ] ) ) {
			?><h3 class="agent-contact-form-title"><?php echo esc_html( $inspiry_options[ 'inspiry_agent_contact_form_title' ] ); ?></h3><?php
		}
		?>
		<form class="agent-form contact-form-small" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" novalidate="novalidate">
			<div class="row">
				<div class="col-sm-6 left-field">
					<input type="text" name="name" placeholder="<?php esc_html_e('Name', 'inspiry-real-estate'); ?>" class="required" title="<?php esc_html_e('* Please provide your name', 'inspiry-real-estate'); ?>" />
				</div>
				<div class="col-sm-6 right-field">
					<input type="text" name="email" placeholder="<?php esc_html_e('Email', 'inspiry-real-estate'); ?>" class="email required" title="<?php esc_html_e('* Please provide valid email address', 'inspiry-real-estate'); ?>" />
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 left-field">
					<input type="text" name="contact-number" placeholder="<?php esc_html_e( 'Contact Number', 'inspiry-real-estate' ); ?>" class="" title="<?php esc_html_e('* Please provide your contact number', 'inspiry-real-estate'); ?>" />
				</div>
			</div>

			<textarea  name="message" class="required" placeholder="<?php esc_html_e('Message', 'inspiry-real-estate'); ?>" title="<?php esc_html_e('* Please provide your message', 'inspiry-real-estate'); ?>"></textarea>

			<?php
			if ( isset( $inspiry_options['gdpr_agent_contact_form'] ) && '1' == $inspiry_options['gdpr_agent_contact_form'] ) {
				ire_gdpr_checkbox( 'agent-' . $agent_id_to_checkbox );
			}

			ire_get_template_part( 'public/partials/google-reCAPTCHA' );
			?>

			<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'agent_message_nonce' ); ?>"/>
			<input type="hidden" name="target" value="<?php echo antispambot( $contact_form_email ); ?>" />
			<input type="hidden" name="action" value="send_message_to_agent" />
			<input type="hidden" name="property_title" value="<?php echo esc_attr( $property_title ); ?>" />
			<input type="hidden" name="property_permalink" value="<?php echo esc_url( $property_permalink ); ?>" />

			<input type="submit" name="submit" class="agent-submit btn-default btn-round" value="<?php esc_html_e( 'Send Message', 'inspiry-real-estate' ); ?>" />

			<img src="<?php echo esc_url( IRE_PLUGIN_URL ); ?>public/images/ajax-loader.gif" id="ajax-loader" class="agent-loader" alt="<?php esc_attr_e( 'Loading...', 'inspiry-real-estate' );?>">

			<div class="agent-error"></div>
			<div class="agent-message"></div>
		</form>
	</div>
	<?php

}