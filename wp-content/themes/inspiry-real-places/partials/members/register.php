<div class="form-wrapper">

    <div class="form-heading clearfix">
        <span><?php esc_html_e( 'Register', 'inspiry' ); ?></span>
        <button type="button" class="close close-modal-dialog" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
    </div>

    <?php
	if ( function_exists( 'ire_user_registration_form' ) ) {
		ire_user_registration_form();
	}
	?>

    <div class="clearfix">
        <span class="login-link pull-left">
            <a href="#" class="activate-section" data-section="login-section"><?php esc_html_e( 'Login', 'inspiry' ); ?></a>
        </span>
        <span class="forgot-password pull-right">
            <a href="#" class="activate-section" data-section="password-section"><?php esc_html_e( 'Forgot Password?', 'inspiry' ); ?></a>
        </span>
    </div>

</div>

