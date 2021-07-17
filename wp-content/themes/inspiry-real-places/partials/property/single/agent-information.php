<?php
global $inspiry_options;
global $inspiry_single_property;

/* get agents ids */
$agents_ids = array_unique( $inspiry_single_property->get_agents_ids() );
$agents_count = count( $agents_ids );

if ( 0 < $agents_count ) {

	foreach( $agents_ids as $agent_id ) {

		if ( $agent_id > 0 ) {

			$inspiry_agent = new Inspiry_Agent( $agent_id );
			$agent_post = get_post( $agent_id );
			$agent_permalink = get_permalink( $agent_id );
			?>
			<div class="inner-wrapper clearfix">

				<?php
				if ( has_post_thumbnail( $agent_id ) ) {
					?>
					<figure class="agent-image">
						<a href="<?php echo esc_url( $agent_permalink ); ?>" >
							<?php echo get_the_post_thumbnail( $agent_id, 'inspiry-agent-thumbnail', array( 'class' => 'img-circle' ) ); ?>
						</a>
					</figure>
					<?php
				}
				?>

				<h3 class="agent-name">
					<a href="<?php echo esc_url( $agent_permalink ); ?>"><?php echo esc_html( $agent_post->post_title ); ?></a>
					<?php
					$agent_job_title = $inspiry_agent->get_job_title();
					if ( !empty( $agent_job_title ) ) {
						?><span><?php echo esc_html( $agent_job_title ); ?></span><?php
					}
					?>
				</h3>

				<div class="agent-social-profiles">
					<?php
					if ( function_exists( 'ire_agent_social_profiles' ) ) {
						ire_agent_social_profiles( $inspiry_agent );
					}
					?>
				</div>

			</div>

			<ul class="agent-contacts-list">
				<?php
				$template_svg_path = get_template_directory() . '/images/svg/';

				/*
				 * Mobile
				 */
				$mobile = $inspiry_agent->get_mobile();
				if ( !empty( $mobile ) ) {
					?><li class="mobile"><?php include( $template_svg_path . 'icon-mobile.svg' ); ?><span><?php esc_html_e( 'Mobile:', 'inspiry' ); ?></span><a href="tel://<?php echo esc_attr( $mobile ); ?>" title="<?php esc_html_e( 'Make a Call', 'inspiry' ); ?>"><?php echo esc_html( $mobile ); ?></a></li><?php
				}

				/*
				 * Office
				 */
				$office_phone = $inspiry_agent->get_office_phone();
				if ( !empty( $office_phone ) ) {
					?><li class="office"><?php include( $template_svg_path . 'icon-phone.svg' ); ?><span><?php esc_html_e( 'Office:', 'inspiry' ); ?></span><a href="tel://<?php echo esc_attr( $office_phone ); ?>" title="<?php esc_html_e( 'Make a Call', 'inspiry' ); ?>"><?php echo esc_html( $office_phone ); ?></a></li><?php
				}

				/*
				 * Fax
				 */
				$fax = $inspiry_agent->get_fax();
				if ( !empty( $fax ) ) {
					?><li class="fax"><?php include( $template_svg_path . 'icon-fax.svg' ); ?><span><?php esc_html_e( 'Fax:', 'inspiry' ); ?></span><?php  echo esc_html( $fax ); ?></li><?php
				}

				/*
				 * Email
				 */
				$get_email = $inspiry_agent->get_email();
	
				if ( !empty( $get_email ) ) {
					?><li class="office"><?php include( $template_svg_path . 'icon-email.svg' ); ?><span><?php esc_html_e( 'Email:', 'inspiry' ); ?></span><a href="mailto:<?php echo esc_attr( $get_email ); ?>" title="<?php esc_html_e( 'Email Us!', 'inspiry' ); ?>"><?php echo esc_html( $get_email ); ?></a></li><?php
				}

				/*
				 * Address
				 */
				$office_address = $inspiry_agent->get_office_address();
				if ( !empty( $office_address ) ) {
					?><li class="map-pin"><?php include( $template_svg_path . 'map-marker.svg' ); echo esc_html( $office_address ); ?></li><?php
				}
				?>

			</ul>
			<?php

			if ( ! is_singular( 'agent' ) ) {
				/*
				 * Agent intro text and view profile button
				 */
				echo apply_filters( 'the_content', get_inspiry_custom_excerpt( $agent_post->post_content ) );
				?>
				<a class="btn-default show-details" href="<?php echo esc_url( $agent_permalink ); ?>"><?php esc_html_e( 'View Profile', 'inspiry' ); ?><i class="fa fa-angle-right"></i></a>
				<?php
			}

			/*
			 * Agent Contact Form
			 */
			$agent_email = $inspiry_agent->get_email();
			if ( $agent_email && $inspiry_options['inspiry_agent_contact_form'] ) {

				if ( function_exists( 'ire_property_single_agent_form' ) ) {
					ire_property_single_agent_form( $inspiry_options, $inspiry_single_property, $agent_email, $agent_id );
				}

			}

		}

	}
}
