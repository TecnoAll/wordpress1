<?php
function ire_header_social_nav() {

	$inspiry_social_option = get_option( 'inspiry_social_option' );

	if ( empty( $inspiry_social_option ) ) {
		return;
	}

	if ( ! empty( $inspiry_social_option[ 'inspiry_facebook_url' ] )
	     || ! empty( $inspiry_social_option[ 'inspiry_twitter_url' ] )
	     || ! empty( $inspiry_social_option[ 'inspiry_linkedin_url' ] )
	     || ! empty( $inspiry_social_option[ 'inspiry_instagram_url' ] )
	     || ! empty( $inspiry_social_option[ 'inspiry_youtube_url' ] )
	     || ! empty( $inspiry_social_option[ 'inspiry_pinterest_url' ] )
	     || ! empty( $inspiry_social_option[ 'inspiry_rss_url' ] )
	     || ! empty( $inspiry_social_option[ 'inspiry_skype_username' ] ) ) {
		?>
		<div class="social-networks header-social-nav">
			<?php
			if ( ! empty( $inspiry_social_option[ 'inspiry_twitter_url' ] ) ) {
				?>
				<a class="twitter" target="_blank" href="<?php echo esc_url( $inspiry_social_option[ 'inspiry_twitter_url' ] ); ?>"><i class="fab fa-twitter"></i></a>
				<?php
			}

			if ( ! empty( $inspiry_social_option[ 'inspiry_facebook_url' ] ) ) {
				?>
				<a class="facebook" target="_blank" href="<?php echo esc_url( $inspiry_social_option[ 'inspiry_facebook_url' ] ); ?>"><i class="fab fa-facebook"></i></a>
				<?php
			}

			if ( ! empty( $inspiry_social_option[ 'inspiry_linkedin_url' ] ) ) {
				?>
				<a class="linkedin" target="_blank" href="<?php echo esc_url( $inspiry_social_option[ 'inspiry_linkedin_url' ] ); ?>"><i class="fab fa-linkedin"></i></a>
				<?php
			}

			if ( ! empty( $inspiry_social_option[ 'inspiry_instagram_url' ] ) ) {
				?>
				<a class="instagram" target="_blank" href="<?php echo esc_url( $inspiry_social_option[ 'inspiry_instagram_url' ] ); ?>"><i class="fab fa-instagram"></i></a>
				<?php
			}

			if ( ! empty( $inspiry_social_option[ 'inspiry_youtube_url' ] ) ) {
				?>
				<a class="youtube" target="_blank" href="<?php echo esc_url( $inspiry_social_option[ 'inspiry_youtube_url' ] ); ?>"><i class="fab fa-youtube"></i></a>
				<?php
			}

			if ( ! empty( $inspiry_social_option[ 'inspiry_pinterest_url' ] ) ) {
				?>
				<a class="pinterest" target="_blank" href="<?php echo esc_url( $inspiry_social_option[ 'inspiry_pinterest_url' ] ); ?>"><i class="fab fa-pinterest-p"></i></a>
				<?php
			}

			if ( ! empty( $inspiry_social_option[ 'inspiry_rss_url' ] ) ) {
				?>
				<a class="rss" target="_blank" href="<?php echo esc_url( $inspiry_social_option[ 'inspiry_rss_url' ] ); ?>"><i class="fas fa-rss"></i></a>
				<?php
			}

			if ( ! empty( $inspiry_social_option[ 'inspiry_skype_username' ] ) ) {
				?>
				<a class="skype" target="_blank" href="skype:<?php echo esc_html( $inspiry_social_option[ 'inspiry_skype_username' ] ); ?>?add"><i class="fab fa-skype"></i></a>
				<?php
			}
			?>
		</div><!-- .social-networks -->
		<?php
	}

}

/**
 * Generates agent's social profile links
 *
 * @param $inspiry_agent
 */
function ire_agent_social_profiles( Inspiry_Agent $inspiry_agent ) {
	/*
	 * Twitter
	 */
	$twitter_url = $inspiry_agent->get_twitter();
	if ( ! empty( $twitter_url ) ) {
		?><a class="twitter" target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fab fa-twitter"></i></a><?php
	}

	/*
	 * Facebook
	 */
	$facebook_url = $inspiry_agent->get_facebook();
	if ( ! empty( $facebook_url ) ) {
		?><a class="facebook" target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fab fa-facebook"></i></a><?php
	}

	/*
	 * Linkedin
	 */
	$linkedin_url = $inspiry_agent->get_linkedin();
	if ( ! empty( $linkedin_url ) ) {
		?><a class="linkedin" target="_blank" href="<?php echo esc_url( $linkedin_url ); ?>"><i class="fab fa-linkedin"></i></a><?php
	}

	/*
	 * Pinterest
	 */
	$pinterest_url = $inspiry_agent->get_pinterest();
	if ( ! empty( $pinterest_url ) ) {
		?><a class="pinterest" target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>"><i class="fab fa-pinterest"></i></a><?php
	}

	/*
	 * Instagram
	 */
	$instagram_url = $inspiry_agent->get_instagram();
	if ( ! empty( $instagram_url ) ) {
		?><a class="instagram" target="_blank" href="<?php echo esc_url( $instagram_url ); ?>"><i class="fab fa-instagram"></i></a><?php
	}
}

/**
 * Generates author social profiles
 */
function ire_author_social_profiles(){
	/*
	 * Twitter
	 */
	$twitter_url = get_the_author_meta( 'twitter_url' );
	if ( !empty( $twitter_url ) ) {
		?><a class="twitter" target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fab fa-twitter"></i></a><?php
	}

	/*
	 * Facebook
	 */
	$facebook_url = get_the_author_meta( 'facebook_url' );
	if ( !empty( $facebook_url ) ) {
		?><a class="facebook" target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fab fa-facebook"></i></a><?php
	}

	/*
	 * Linkedin
	 */
	$linkedin_url = get_the_author_meta( 'linkedin_url' );
	if ( !empty( $linkedin_url ) ) {
		?><a class="linkedin" target="_blank" href="<?php echo esc_url( $linkedin_url ); ?>"><i class="fab fa-linkedin"></i></a><?php
	}

	/*
	 * Pinterest
	 */
	$pinterest_url = get_the_author_meta( 'pinterest_url' );
	if ( !empty( $pinterest_url ) ) {
		?><a class="pinterest" target="_blank" href="<?php echo esc_url( $pinterest_url ); ?>"><i class="fab fa-pinterest"></i></a><?php
	}

	/*
	 * Instagram
	 */
	$instagram_url = get_the_author_meta( 'instagram_url' );
	if ( !empty( $instagram_url ) ) {
		?><a class="instagram" target="_blank" href="<?php echo esc_url( $instagram_url ); ?>"><i class="fab fa-instagram"></i></a><?php
	}

}

/**
 * Add required fields to user profile
 *
 * @param $user_contact_methods
 *
 * @return mixed
 */
function ire_add_profile_fields( $user_contact_methods ) {

	$user_contact_methods['job_title']      = esc_html__( 'Job Title', 'inspiry' );
	$user_contact_methods['mobile_number']  = esc_html__( 'Mobile Number', 'inspiry' );
	$user_contact_methods['office_number']  = esc_html__( 'Office Number', 'inspiry' );
	$user_contact_methods['fax_number']     = esc_html__( 'Fax Number', 'inspiry' );
	$user_contact_methods['office_address'] = esc_html__( 'Office Address', 'inspiry' );
	$user_contact_methods['facebook_url']   = esc_html__( 'Facebook URL', 'inspiry' );
	$user_contact_methods['twitter_url']    = esc_html__( 'Twitter URL', 'inspiry' );
	$user_contact_methods['linkedin_url']   = esc_html__( 'LinkedIn URL', 'inspiry' );
	$user_contact_methods['pinterest_url']  = esc_html__( 'Pinterest URL', 'inspiry' );
	$user_contact_methods['instagram_url']  = esc_html__( 'Instagram URL', 'inspiry' );

	return $user_contact_methods;
}
add_filter( 'user_contactmethods', 'ire_add_profile_fields' );

/**
 * @param $current_author_meta
 */
function ire_current_author_social_profiles( $current_author_meta ) {
	/*
	 * Twitter
	 */
	if ( isset( $current_author_meta[ 'twitter_url' ] ) && ! empty( $current_author_meta[ 'twitter_url' ][ 0 ] ) ) {
		?><a class="twitter" target="_blank" href="<?php echo esc_url( $current_author_meta[ 'twitter_url' ][ 0 ] ); ?>"><i class="fab fa-twitter"></i></a><?php
	}

	/*
	 * Facebook
	 */
	if ( isset( $current_author_meta[ 'facebook_url' ] ) && ! empty( $current_author_meta[ 'facebook_url' ][ 0 ] ) ) {
		?><a class="facebook" target="_blank" href="<?php echo esc_url( $current_author_meta[ 'facebook_url' ][ 0 ] ); ?>"><i class="fab fa-facebook"></i></a><?php
	}

	/*
	 * Linkedin
	 */
	if ( isset( $current_author_meta[ 'linkedin_url' ] ) && ! empty( $current_author_meta[ 'linkedin_url' ][ 0 ] ) ) {
		?><a class="linkedin" target="_blank" href="<?php echo esc_url( $current_author_meta[ 'linkedin_url' ][ 0 ] ); ?>"><i class="fab fa-linkedin"></i></a><?php
	}

	/*
	 * Pinterest
	 */
	if ( isset( $current_author_meta[ 'pinterest_url' ] ) && ! empty( $current_author_meta[ 'pinterest_url' ][ 0 ] ) ) {
		?><a class="pinterest" target="_blank" href="<?php echo esc_url( $current_author_meta[ 'pinterest_url' ][ 0 ] ); ?>"><i class="fab fa-pinterest"></i></a><?php
	}

	/*
	 * Instagram
	 */
	if ( isset( $current_author_meta[ 'instagram_url' ] ) && ! empty( $current_author_meta[ 'instagram_url' ][ 0 ] ) ) {
		?><a class="instagram" target="_blank" href="<?php echo esc_url( $current_author_meta[ 'instagram_url' ][ 0 ] ); ?>"><i class="fab fa-instagram"></i></a><?php
	}

}

/**
 * Property social share
 */
function ire_single_property_social_share(){
	?>
	<div id="share-button-title" class="hide"><?php esc_html_e('Share', 'inspiry-real-estate'); ?></div>
	<div class="share-this"></div>
	<?php
}