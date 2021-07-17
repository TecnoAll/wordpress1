<?php
/*
 * Google reCAPTCHA
 */
global $google_reCAPTCHA_counter;
if ( ire_is_reCAPTCHA_configured() ) { ?>
    <div class="inspiry-recaptcha-wrapper clearfix">
        <div id="inspiry-<?php echo esc_attr( $google_reCAPTCHA_counter ); ?>"></div>
    </div>
	<?php
	/* increment in Google reCAPTCHA counter */
	$google_reCAPTCHA_counter ++;
}