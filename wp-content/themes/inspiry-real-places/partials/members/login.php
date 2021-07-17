<div class="form-wrapper">

    <div class="form-heading clearfix">
        <span><i class="fas fa-sign-in-alt"></i><?php esc_html_e( 'Login', 'inspiry' ); ?></span>
        <button type="button" class="close close-modal-dialog " data-dismiss="modal" aria-hidden="true"><i class="fa fa-times fa-lg"></i></button>
    </div>

	<?php
	if ( function_exists( 'ire_user_login_form' ) ) {
		ire_user_login_form();
	}
	?>

    <div class="inspiry-social-login">
        <?php
        /*
         * For social login
         */
        do_action( 'wordpress_social_login' );
        ?>
    </div>

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
        <span class="forgot-password pull-right">
            <a href="#" class="activate-section" data-section="password-section"><?php esc_html_e( 'Forgot Password?', 'inspiry' ); ?></a>
        </span>
    </div>

</div>
<?php  /* ?>
<div class="buttons-external">

    <div class="graphic">
        <span class="or"><?php esc_html_e( 'or', 'inspiry' ); ?></span>
        <span class="vertical-line"></span>
        <span class="circle"></span>
    </div>

    <div class="clearfix">
        <a class="button facebook-button" href="#">
            <i class="fa fa-facebook"></i>
            <?php esc_html_e( 'Login with Facebook', 'inspiry' ); ?>
        </a>
        <a class="button google-button" href="#">
            <i class="fa fa-google"></i>
            <?php esc_html_e( 'Login with Google', 'inspiry' ); ?>
        </a>
    </div>

</div>
<?php */ ?>
