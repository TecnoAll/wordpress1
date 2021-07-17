<?php
/**
 * Generates user login form
 */
function ire_user_login_form(){
	?>
	<form id="login-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

		<div class="form-element">
			<label class="login-form-label" for="login-username"><?php esc_html_e( 'Username', 'inspiry-real-estate' ); ?></label>
			<input id="login-username" name="log" type="text" class="login-form-input login-form-input-common required"
			       title="<?php esc_html_e( '* Provide your username', 'inspiry-real-estate' ); ?>"
			       placeholder="<?php esc_html_e( 'Username', 'inspiry-real-estate' ); ?>" />
		</div>

		<div class="form-element">
			<label class="login-form-label" for="password"><?php esc_html_e( 'Password', 'inspiry-real-estate' ); ?></label>
			<input id="password" name="pwd" type="password" class="login-form-input login-form-input-common required"
			       title="<?php esc_html_e( '* Provide your password', 'inspiry-real-estate' ); ?>"
			       placeholder="<?php esc_html_e( 'Password', 'inspiry-real-estate' ); ?>" />
		</div>

		<?php ire_get_template_part( 'public/partials/google-reCAPTCHA' ); ?>

		<div class="form-element clearfix">
			<input type="submit" id="login-button" class="login-form-submit login-form-input-common" value="<?php esc_html_e( 'Login', 'inspiry-real-estate' ); ?>" />
			<input type="hidden" name="action" value="inspiry_ajax_login" />
			<input type="hidden" name="user-cookie" value="1" />
			<?php
			// nonce for security
			wp_nonce_field( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );

			if ( is_page() || is_single() ) {
				?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata(); global $post; the_permalink( $post->ID ); ?>" /><?php
			} else {
				?><input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" /><?php
			}

			?>

			<div class="text-center">
				<div id="login-message" class="modal-message"></div>
				<div id="login-error" class="modal-error"></div>
				<img id="login-loader" class="modal-loader" src="<?php echo esc_url( IRE_PLUGIN_URL ); ?>public/images/ajax-loader.gif" alt="<?php esc_attr_e( 'Working...', 'inspiry-real-estate' );?>">
			</div>
		</div>

	</form>
	<?php
}


/**
 * Generates user registration form.
 */
function ire_user_registration_form(){
	?>
	<form id="register-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

		<div class="form-element">
			<label class="login-form-label" for="register_username"><?php esc_html_e( 'Username', 'inspiry-real-estate' ); ?><span>*</span></label>
			<input id="register_username" name="register_username" type="text" class="login-form-input login-form-input-common"
			       title="<?php esc_html_e( '* Please enter a valid username.', 'inspiry-real-estate' ); ?>"
			       placeholder="<?php esc_html_e( 'Username', 'inspiry-real-estate' ); ?>" />
		</div>

		<div class="form-element">
			<label class="login-form-label" for="register_email"><?php esc_html_e( 'Email', 'inspiry-real-estate' ); ?><span>*</span></label>
			<input id="register_email" name="register_email" type="text" class="login-form-input login-form-input-common"
			       title="<?php esc_html_e( '* Please provide valid email address!', 'inspiry-real-estate' ); ?>"
			       placeholder="<?php esc_html_e( 'Email', 'inspiry-real-estate' ); ?>" />
		</div>

		<?php ire_get_template_part( 'public/partials/google-reCAPTCHA' ); ?>

		<div class="form-element clearfix">
			<input type="submit" id="register-button" name="user-submit" class="login-form-submit login-form-input-common" value="<?php esc_html_e( 'Register', 'inspiry-real-estate' ); ?>" />
			<input type="hidden" name="action" value="inspiry_ajax_register" />
			<?php  // nonce for security
			wp_nonce_field( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );

			if ( is_page() || is_single() ) {
				?><input type="hidden" name="redirect_to" value="<?php wp_reset_postdata(); global $post; the_permalink( $post->ID ); ?>" /><?php
			} else {
				?><input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" /><?php
			}

			?>
			<div class="text-center">
				<div id="register-message" class="modal-message"></div>
				<div id="register-error" class="modal-error"></div>
				<img id="register-loader" class="modal-loader" src="<?php echo esc_url( IRE_PLUGIN_URL ); ?>public/images/ajax-loader.gif" alt="<?php esc_attr_e( 'Working...', 'inspiry-real-estate' ); ?>">
			</div>
		</div>

	</form>
	<?php
}


/**
 * Generates user forgot password form.
 */
function ire_user_forgot_password_form(){
	?>
	<form id="forgot-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">

		<div class="form-element">
			<label class="login-form-label" for="reset_username_or_email"><?php esc_html_e( 'Username or Email', 'inspiry-real-estate' ); ?><span>*</span></label>
			<input id="reset_username_or_email" name="reset_username_or_email" type="text" class="login-form-input login-form-input-common required"
			       title="<?php esc_html_e( '* Provide a valid username or email!', 'inspiry-real-estate' ); ?>"
			       placeholder="<?php esc_html_e( 'Username or Email', 'inspiry-real-estate' ); ?>" />
		</div>

		<div class="form-element">
			<input type="submit" id="forgot-button" name="user-submit" class="login-form-submit login-form-input-common" value="<?php esc_html_e( 'Reset Password', 'inspiry-real-estate' ); ?>">
			<input type="hidden" name="action" value="inspiry_ajax_forgot" />
			<input type="hidden" name="user-cookie" value="1" />
			<?php wp_nonce_field( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' ); ?>
			<div class="text-center">
				<div id="forgot-message" class="modal-message"></div>
				<div id="forgot-error" class="modal-error"></div>
				<img id="forgot-loader" class="modal-loader" src="<?php echo esc_url( IRE_PLUGIN_URL ); ?>public/images/ajax-loader.gif" alt="<?php esc_attr_e( 'Working...', 'inspiry-real-estate' );?>">
			</div>
		</div>

	</form>
	<?php
}