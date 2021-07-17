<?php
/**
 *
 */
function ire_profile_edit_form() {

	if ( is_user_logged_in() ) {

		// get user information
		$current_user      = wp_get_current_user();
		$current_user_meta = get_user_meta( $current_user->ID );

		?>
		<form id="inspiry-edit-user" class="submit-form" enctype="multipart/form-data" method="post">

			<div class="row">
				<div class="col-md-6">
					<div class="form-option user-profile-img-wrapper clearfix">
						<div id="user-profile-img">
							<div class="profile-thumb">
								<?php
								if ( isset( $current_user_meta[ 'profile_image_id' ] ) ) {
									$profile_image_id = intval( $current_user_meta[ 'profile_image_id' ][ 0 ] );
									if ( $profile_image_id ) {
										echo wp_get_attachment_image( $profile_image_id, 'inspiry-agent-thumbnail', false, array( 'class' => 'img-responsive' ) );
										echo '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' . $profile_image_id . '"/>';
									}
								}
								?>
							</div>
						</div>

						<div class="profile-img-controls">
							<ul class="field-description list-unstyled">
								<li>
									<span>*</span><?php esc_html_e( 'Profile image should have minimum width and height of 220px.', 'inspiry-real-estate' ); ?>
								</li>
								<li>
									<span>*</span><?php esc_html_e( 'Make sure to save changes after uploading the new image.', 'inspiry-real-estate' ); ?>
								</li>
							</ul>
							<a id="select-profile-image" class="btn-default" href="javascript:;">
								<i class="far fa-image"></i></i><?php esc_html_e( 'Change', 'inspiry-real-estate' ); ?>
							</a>

							<a id="remove-profile-image" class="btn-default btn-orange" href="#remove-profile-image">
								<i class="fas fa-trash-alt"></i><?php esc_html_e( 'Remove', 'inspiry-real-estate' ); ?>
							</a>

							<div id="errors-log"></div>
							<div id="plupload-container"></div>
						</div>

					</div>
				</div>

				<div class="col-md-6">
					<div class="form-option">
						<label for="description"><?php esc_html_e( 'Biographical Information', 'inspiry-real-estate' ) ?></label>
						<textarea name="description" id="description" rows="5" cols="30"><?php if ( isset( $current_user_meta[ 'description' ] ) ) {
								echo esc_textarea( $current_user_meta[ 'description' ][ 0 ] );
							} ?></textarea>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-4">
					<div class="form-option">
						<label for="first-name"><?php esc_html_e( 'First Name', 'inspiry-real-estate' ); ?></label>
						<input class="valid required" name="first-name" type="text" id="first-name"
							   value="<?php if ( isset( $current_user_meta[ 'first_name' ] ) ) {
							       echo esc_attr( $current_user_meta[ 'first_name' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Provide First Name!', 'inspiry-real-estate' ); ?>"
							   autofocus/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<label for="last-name"><?php esc_html_e( 'Last Name', 'inspiry-real-estate' ); ?></label>
						<input class="required" name="last-name" type="text" id="last-name"
							   value="<?php if ( isset( $current_user_meta[ 'last_name' ] ) ) {
							       echo esc_attr( $current_user_meta[ 'last_name' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Provide Last Name!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<label for="display-name"><?php esc_html_e( 'Display Name', 'inspiry-real-estate' ); ?>
							*</label>
						<input class="required" name="display-name" type="text" id="display-name"
							   value="<?php echo esc_attr( $current_user->display_name ); ?>"
							   title="<?php esc_html_e( '* Provide Display Name!', 'inspiry-real-estate' ); ?>"
							   required/>
					</div>
				</div>

			</div>
			<!-- .row -->

			<div class="row">

				<div class="col-md-4">
					<div class="form-option">
						<label for="email"><?php esc_html_e( 'Email', 'inspiry-real-estate' ); ?>
							*</label>
						<input class="email required" name="email" type="email" id="email"
							   value="<?php echo esc_attr( $current_user->user_email ); ?>"
							   title="<?php esc_html_e( '* Provide Valid Email Address!', 'inspiry-real-estate' ); ?>"
							   required/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<label for="mobile-number"><?php esc_html_e( 'Mobile Number', 'inspiry-real-estate' ); ?></label>
						<input class="digits" name="mobile-number" type="text" id="mobile-number"
							   value="<?php if ( isset( $current_user_meta[ 'mobile_number' ] ) ) {
							       echo esc_attr( $current_user_meta[ 'mobile_number' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Only Digits are allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<label for="office-number"><?php esc_html_e( 'Office Number', 'inspiry-real-estate' ); ?></label>
						<input class="digits" name="office-number" type="text" id="office-number"
							   value="<?php if ( isset( $current_user_meta[ 'office_number' ] ) ) {
							       echo esc_attr( $current_user_meta[ 'office_number' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Only Digits are allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>


			</div>
			<!-- .row -->

			<div class="row">

				<div class="col-md-4">
					<div class="form-option">
						<label for="fax-number"><?php esc_html_e( 'Fax Number', 'inspiry-real-estate' ); ?></label>
						<input class="digits" name="fax-number" type="text" id="fax-number"
							   value="<?php if ( isset( $current_user_meta[ 'fax_number' ] ) ) {
							       echo esc_attr( $current_user_meta[ 'fax_number' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Only Digits are allowed!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<label for="facebook-url"><?php esc_html_e( 'Facebook URL', 'inspiry-real-estate' ); ?></label>
						<input class="url" name="facebook-url" type="text" id="facebook-url"
							   value="<?php if ( isset( $current_user_meta[ 'facebook_url' ] ) ) {
							       echo esc_url( $current_user_meta[ 'facebook_url' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Provide Valid URL!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<label for="twitter-url"><?php esc_html_e( 'Twitter URL', 'inspiry-real-estate' ); ?></label>
						<input class="url" name="twitter-url" type="text" id="twitter-url"
							   value="<?php if ( isset( $current_user_meta[ 'twitter_url' ] ) ) {
							       echo esc_url( $current_user_meta[ 'twitter_url' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Provide Valid URL!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>


			</div>
			<!-- .row -->

			<div class="row">

				<div class="col-md-4">
					<div class="form-option">
						<label for="linkedin-url"><?php esc_html_e( 'LinkedIn URL', 'inspiry-real-estate' ); ?></label>
						<input class="url" name="linkedin-url" type="text" id="linkedin-url"
							   value="<?php if ( isset( $current_user_meta[ 'linkedin_url' ] ) ) {
							       echo esc_url( $current_user_meta[ 'linkedin_url' ][ 0 ] );
						       } ?>"
							   title="<?php esc_html_e( '* Provide Valid URL!', 'inspiry-real-estate' ); ?>"/>
					</div>
				</div>

			</div>
			<!-- .row -->

			<!-- todo: add instagram and pinterest -->

			<div class="row">

				<div class="col-md-4">
					<div class="form-option">
						<label for="pass1"><?php esc_html_e( 'Password', 'inspiry-real-estate' ); ?>
							<small><?php esc_html_e( '( Fill it only when you want to change )', 'inspiry-real-estate' ); ?></small>
						</label>
						<input name="pass1" type="password" id="pass1">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<label for="pass2"><?php esc_html_e( 'Confirm Password', 'inspiry-real-estate' ); ?></label>
						<input name="pass2" type="password" id="pass2"/>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-option">
						<?php
						//action hook for plugin and extra fields
						do_action( 'edit_user_profile', $current_user );

						// WordPress Nonce for Security Check
						wp_nonce_field( 'update_user', 'user_profile_nonce' );
						?>
						<input type="hidden" name="action" value="inspiry_update_profile"/>
					</div>
				</div>

			</div>
			<!-- .row -->

			<div class="form-option">
				<input type="submit" id="update-user" name="update-user" class="btn-small btn-orange" value="<?php esc_html_e( 'Save Changes', 'inspiry-real-estate' ); ?>">
				<img src="<?php echo esc_url( IRE_PLUGIN_URL ); ?>public/images/ajax-loader-2.gif" id="ajax-loader" alt="<?php esc_attr_e( 'Loading...', 'inspiry-real-estate' ); ?>">
			</div>

			<p id="form-message"></p>
			<ul id="form-errors"></ul>

		</form>
		<!-- #inspiry-edit-user -->
		<?php

	} else {
		ire_message( esc_html__( 'Login Required', 'inspiry-real-estate' ), esc_html__( 'You need to login to edit your profile!', 'inspiry-real-estate' ) );
	}
}