<?php
/**
 * Override 'WordPress' as from name in emails sent by wp_mail function
 * @return string
 */
function ire_mail_from_name() {
	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

	return $blogname;
}
add_filter( 'wp_mail_from_name', 'ire_mail_from_name' );


/**
 * contact form handler
 */
function ire_send_message() {

	if ( isset($_POST['email'] ) ):

		$nonce = $_POST['nonce'];

		if (!wp_verify_nonce($nonce, 'send_message_nonce')) {
			echo json_encode(array(
				'success' => false,
				'message' => esc_html__('Unverified Nonce!', 'inspiry-real-estate')
			));
			die;
		}

		if ( ! isset( $_POST['ISGR'] ) && ire_is_reCAPTCHA_configured() ) {
			ire_verify_reCAPTCHA();
		}

		// Sanitize and Validate Target email address that is coming from agent form
		$to_email = sanitize_email( $_POST['target'] );
		$to_email = is_email( $to_email );
		if ( !$to_email ) {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Target Email address is not properly configured!', 'inspiry-real-estate' )
			));
			die;
		}

		/*
		 *  Sanitize and Validate contact form input data
		 */
		$from_name = sanitize_text_field( $_POST['name'] );
		$phone_number = sanitize_text_field( $_POST['number'] );
		$message = wp_kses_data( $_POST['message'] );
		$from_email = sanitize_email( $_POST['email'] );
		$from_email = is_email( $from_email );
		if (! $from_email ) {
			echo json_encode(array(
				'success' => false,
				'message' => esc_html__('Provided Email address is invalid!', 'inspiry-real-estate')
			));
			die;
		}

		$email_subject = esc_html__( 'New message sent by', 'inspiry-real-estate' ) . ' ' . $from_name . ' ' . esc_html__( 'using contact form at', 'inspiry-real-estate' ) . ' ' . get_bloginfo( 'name' );
		$email_body = esc_html__( "You have received a message from: ", 'inspiry-real-estate' ) . $from_name . " <br/>";

		if ( !empty( $phone_number ) ) {
			$email_body .= esc_html__( "Phone Number : ", 'inspiry-real-estate' ) . $phone_number . " <br/>";
		}

		$email_body .= esc_html__( "Their additional message is as follows.", 'inspiry-real-estate' ) . " <br/>";
		$email_body .= wpautop( $message );
		$email_body .= wpautop( sprintf( esc_html__( 'You can contact %1$s via email %2$s', 'inspiry-real-estate'), $from_name, $from_email ) );

		/*
		 * Email Headers ( Reply To and Content Type )
		 */
		$headers = array();
		$headers[] = "Reply-To: $from_name <$from_email>";
		$headers[] = "Content-Type: text/html; charset=UTF-8";
		$headers = apply_filters( "inspiry_contact_mail_header", $headers );    // just in case if you want to modify the header in child theme

		if ( wp_mail( $to_email, $email_subject, $email_body, $headers ) ) {
			echo json_encode( array(
				'success' => true,
				'message' => esc_html__("Message Sent Successfully!", 'inspiry-real-estate')
			) );
		} else {
			echo json_encode( array(
					'success' => false,
					'message' => esc_html__( "Server Error: WordPress mail function failed!", 'inspiry-real-estate' )
				)
			);
		}

	else:
		echo json_encode( array(
				'success' => false,
				'message' => esc_html__("Invalid Request !", 'inspiry-real-estate')
			)
		);
	endif;

	die;
}

add_action( 'wp_ajax_nopriv_inspiry_send_message', 'ire_send_message' );
add_action( 'wp_ajax_inspiry_send_message', 'ire_send_message' );


/**
 * Ajax request handler for agent's contact form.
 */
function ire_agent_message_handler() {

	if ( isset( $_POST['email'] ) ):

		$nonce = $_POST['nonce'];

		if ( !wp_verify_nonce( $nonce, 'agent_message_nonce' ) ) {
			echo wp_json_encode(array(
				'success' => false,
				'message' => esc_html__('Unverified Nonce!', 'inspiry-real-estate')
			));
			die;
		}

		if ( ire_is_reCAPTCHA_configured() ) {
		    ire_verify_reCAPTCHA();
		}

		// Sanitize and Validate Target email address that is coming from agent form
		$to_email = sanitize_email( $_POST['target'] );
		$to_email = is_email( $to_email );
		if ( !$to_email ) {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Target Email address is not properly configured!', 'inspiry-real-estate' )
			));
			die;
		}


		// Sanitize and Validate contact form input data
		$from_name = sanitize_text_field($_POST['name']);
		$contact_number = sanitize_text_field( $_POST[ 'contact-number' ] );
		$message = wp_kses_data( $_POST['message'] );

		$property_title = '';
		if( isset( $_POST['property_title'] ) ) {
			$property_title = sanitize_text_field( $_POST['property_title'] );
		}

		$property_permalink = '';
		if( isset( $_POST['property_permalink'] ) ) {
			$property_permalink = esc_url( $_POST['property_permalink'] );
		}

		$from_email = sanitize_email( $_POST['email'] );
		$from_email = is_email( $from_email );
		if ( !$from_email ) {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__('Provided Email address is invalid!', 'inspiry-real-estate')
			) );
			die;
		}

		$email_subject = sprintf( esc_html__( 'New message sent by %1$s using agent contact form at %2$s', 'inspiry-real-estate') ,$from_name , get_bloginfo('name') );

		$email_body = wpautop( esc_html__( 'You have received a message from:', 'inspiry-real-estate') . ' ' . $from_name );

		if ( ! empty( $property_title ) ) {
			$email_body .= wpautop( esc_html__( 'Property Title :', 'inspiry-real-estate') . ' ' . $property_title );
		}

		if ( ! empty( $property_permalink ) ) {
			$email_body .= wpautop( esc_html__( 'Property URL :', 'inspiry-real-estate' ) . ' ' . '<a href="'. $property_permalink. '">' . $property_permalink . "</a>" );
		}

		$email_body .= wpautop( esc_html__("Their additional message is as follows.", 'inspiry-real-estate') );
		$email_body .= wpautop( $message );
		$email_body .= wpautop( sprintf( esc_html__( 'You can contact %1$s via email %2$s', 'inspiry-real-estate' ), $from_name, $from_email ) );

		if ( ! empty( $contact_number ) ) {
			$email_body .= wpautop( sprintf( esc_html__( 'You can also contact %1$s via contact number %2$s', 'inspiry-real-estate' ), $from_name, $contact_number ) );
		}


		/*
		 * Email Headers ( Reply To and Content Type )
		 */
		$headers = array();
		$headers[] = "Reply-To: $from_name <$from_email>";
		$headers[] = "Content-Type: text/html; charset=UTF-8";


		/*
		 * Add given CC email address/addresses into email header
		 */
		$cc_email = $inspiry_options['inspiry_agent_cc_email'];
		if ( !empty( $cc_email ) ) {
			if ( strpos( $cc_email, ',' ) ) {                   // For multiple emails
				$cc_emails = explode( ',', $cc_email );
				if( !empty( $cc_emails ) ){
					foreach( $cc_emails as $single_cc_email ){
						$single_cc_email = sanitize_email( $single_cc_email );
						$single_cc_email = is_email( $single_cc_email );
						if ( $single_cc_email ) {
							$headers[] = "Cc: $single_cc_email";
						}
					}
				}
			} elseif ( $cc_email = is_email( $cc_email ) ) {    // For single email
				$headers[] = "Cc: $cc_email";
			}
		}

		$bcc_email = $inspiry_options['inspiry_agent_bcc_email'];
		if ( !empty( $bcc_email ) ) {
			if ( strpos( $bcc_email, ',' ) ) {                   // For multiple emails
				$bcc_emails = explode( ',', $bcc_email );
				if( !empty( $bcc_emails ) ){
					foreach( $bcc_emails as $single_cc_email ){
						$single_cc_email = sanitize_email( $single_cc_email );
						$single_cc_email = is_email( $single_cc_email );
						if ( $single_cc_email ) {
							$headers[] = "BCc: $single_cc_email";
						}
					}
				}
			} elseif ( $bcc_email = is_email( $bcc_email ) ) {    // For single email
				$headers[] = "Bcc: $bcc_email";
			}
		}

		$headers = apply_filters( "inspiry_agent_mail_header", $headers );    // just in case if you want to modify the header in child theme

		/*
		 * Send Message
		 */
		if ( wp_mail( $to_email, $email_subject, $email_body, $headers ) ) {
			echo wp_json_encode( array(
				'success' => true,
				'message' => esc_html__("Message Sent Successfully!", 'inspiry-real-estate')
			));
		} else {
			echo wp_json_encode(array(
					'success' => false,
					'message' => esc_html__("Server Error: WordPress mail function failed!", 'inspiry-real-estate')
				)
			);
		}

	else:
		echo wp_json_encode(array(
				'success' => false,
				'message' => esc_html__("Invalid Request !", 'inspiry-real-estate')
			)
		);
	endif;
	die;
}

add_action( 'wp_ajax_nopriv_send_message_to_agent', 'ire_agent_message_handler' );
add_action( 'wp_ajax_send_message_to_agent', 'ire_agent_message_handler' );


/**
 * Check if Google reCAPTCHA is property configured and enabled or not
 * @return bool
 */
function ire_is_reCAPTCHA_configured() {

	$inspiry_recaptcha_option = get_option( 'inspiry_recaptcha_option' );
	if ( class_exists( 'Inspiry_Real_Estate' )
	     && ( isset( $inspiry_recaptcha_option['inspiry_google_reCAPTCHA'] ) && '1' === $inspiry_recaptcha_option['inspiry_google_reCAPTCHA'] )
	     && ( isset( $inspiry_recaptcha_option['inspiry_reCAPTCHA_site_key'] ) &&  ! empty( $inspiry_recaptcha_option['inspiry_reCAPTCHA_site_key'] ) )
	     && ( isset( $inspiry_recaptcha_option['inspiry_reCAPTCHA_secret_key'] ) &&  ! empty( $inspiry_recaptcha_option['inspiry_reCAPTCHA_secret_key'] ) )
	) {
		return true;
	}

	return false;
}


/**
 * Returns reCaptcha secret key if present.
 * @return string
 */
function ire_reCAPTCHA_secret_key() {

	if ( ire_is_reCAPTCHA_configured() ) {

		$inspiry_recaptcha_option = get_option( 'inspiry_recaptcha_option' );

		if ( isset( $inspiry_recaptcha_option['inspiry_reCAPTCHA_secret_key'] ) && ! empty( $inspiry_recaptcha_option['inspiry_reCAPTCHA_secret_key'] ) ) {
			return $inspiry_recaptcha_option['inspiry_reCAPTCHA_secret_key'];
		}
	}

	return false;
}


/**
 * Generates a call back JavaScript function for reCAPTCHA
 */
function ire_recaptcha_callback_generator() {
	if ( ire_is_reCAPTCHA_configured() ) {
		global $google_reCAPTCHA_counter;

		$inspiry_recaptcha_option = get_option( 'inspiry_recaptcha_option' );
		$inspiry_reCAPTCHA_site_key = '';
        if( isset( $inspiry_recaptcha_option[ 'inspiry_reCAPTCHA_site_key' ] ) && ! empty( $inspiry_recaptcha_option[ 'inspiry_reCAPTCHA_site_key' ] )){
	        $inspiry_reCAPTCHA_site_key = $inspiry_recaptcha_option[ 'inspiry_reCAPTCHA_site_key' ];
        }
        ?>
		<script type="text/javascript">
					var googleReCAPTCHACounter = <?php echo esc_js( $google_reCAPTCHA_counter ); ?>;
					var inspirySiteKey = '<?php echo esc_js( $inspiry_reCAPTCHA_site_key ); ?>';
					var reCAPTCHAWidgetIDs = [];

					/**
					 * Render Google reCAPTCHA and store their widget IDs in an array
					 */
					var loadInspiryReCAPTCHA = function(){
						while( googleReCAPTCHACounter > 1 ) {
							googleReCAPTCHACounter--;
							var tempWidgetID = grecaptcha.render( document.getElementById( 'inspiry-' + googleReCAPTCHACounter ), {
								'sitekey' : inspirySiteKey
							} );
							reCAPTCHAWidgetIDs.push( tempWidgetID );
						}
					};

					/**
					 * For Google reCAPTCHA reset
					 */
					var inspiryResetReCAPTCHA = function() {
						if( typeof reCAPTCHAWidgetIDs != 'undefined' ) {
							var arrayLength = reCAPTCHAWidgetIDs.length;
							for( var i = 0; i < arrayLength; i++ ) {
								grecaptcha.reset( reCAPTCHAWidgetIDs[i] );
							}
						}
					};
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'ire_recaptcha_callback_generator' );


/**
 * Verifies the reCAPTCHA by sending a GET request to reCAPTCHA API server.
 */
function ire_verify_reCAPTCHA() {

	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$url = add_query_arg(
		array(
			'secret'   => ire_reCAPTCHA_secret_key(),
			'response' => $_POST['g-recaptcha-response'],
			'remoteip' => $_SERVER['REMOTE_ADDR']
		),
		$url
	);

	$request = wp_safe_remote_get( $url );

	if ( is_wp_error( $request ) ) {
		echo json_encode( array(
			'success' => false,
			'message' => $request->get_error_message()
		) );

		die;
	} else {
		$response = json_decode( wp_remote_retrieve_body( $request ), true );
		if ( isset( $response['success'] ) && false === $response['success'] ) {

			// Reference for error codes - https://developers.google.com/recaptcha/docs/verify
			$error_messages = array(
				'missing-input-secret'   => 'The secret parameter is missing.',
				'invalid-input-secret'   => 'The secret parameter is invalid or malformed.',
				'missing-input-response' => 'The response parameter is missing.',
				'invalid-input-response' => 'The response parameter is invalid or malformed.',
				'bad-request'            => 'The request is invalid or malformed.',
				'timeout-or-duplicate'   => 'The response is no longer valid: either is too old or has been used previously.',
			);

			$error = '';
			if ( isset( $response['error-codes'] ) && is_array( $response['error-codes'] ) ) {
				$error = ' ' . $error_messages[ $response['error-codes']['0'] ];
			}

			echo json_encode( array(
				'success' => false,
				'message' => esc_html__( 'reCAPTCHA Failed:', 'inspiry-real-estate' ) . $error
			) );

			die;
		}
	}
}


function ire_gdpr_checkbox( $form = 'contact' ) {

	$allowed_html_tags  = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array()
		),
		'em' => array(),
		'strong' => array(),
	);

	global $inspiry_options;

	$gdpr_checkbox_label     = $inspiry_options[ 'gdpr_label_text' ];
	$gdpr_text               = $inspiry_options[ 'gdpr_text' ];
	$gdpr_validation_message = $inspiry_options['gdpr_validation_message' ];

	?>
	<div class="gdpr-checkbox-wrapper">

		<?php if ( ! empty( $gdpr_checkbox_label ) ) { ?>
			<span class="gdpr-checkbox-label"><?php echo esc_html( $gdpr_checkbox_label ); ?><span class="required-label">*</span></span>
		<?php } ?>
		<input id="<?php echo esc_attr( $form ); ?>-form-gdpr-checkbox"
			   class="required"
			   name="<?php echo esc_attr( $form ); ?>-form-gdpr-checkbox"
			   type="checkbox"
			   value="<?php echo esc_attr( $gdpr_text ) ?>"
			   aria-required="true"
			   title="<?php echo esc_attr( $gdpr_validation_message ) ?>">
		<label for="<?php echo esc_attr( $form ); ?>-form-gdpr-checkbox">
			<span class="gdpr-text"><?php echo wp_kses( $gdpr_text, $allowed_html_tags ) ?></span>
		</label>
	</div>
	<?php
}