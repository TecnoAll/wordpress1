<div class="form-wrapper">

    <div class="form-heading clearfix">
        <span><?php esc_html_e( 'Forgot Password', 'inspiry' ); ?></span>
        <button type="button" class="close close-modal-dialog" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
    </div>

	<?php
	if ( function_exists( 'ire_user_forgot_password_form' ) ) {
		ire_user_forgot_password_form();
	}
	?>

    <div class="clearfix">

        <?php
        if( get_option( 'users_can_register' ) ) :
            ?>
            <span class="sign-up pull-left">
                <?php esc_html_e( 'Not a Member?', 'inspiry' ); ?>
                <a href="#" class="activate-section" data-section="register-section"><?php esc_html_e( 'Sign up now', 'inspiry' ); ?></a>
            </span>
        <?php
        endif;
        ?>

        <span class="login-link pull-right">
            <a href="#" class="activate-section" data-section="login-section"><?php esc_html_e( 'Login', 'inspiry' ); ?></a>
        </span>

    </div>

</div>

