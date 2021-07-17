<?php
if ( ! class_exists( 'Inspiry_Real_Estate' ) ) {
	return;
}

$inspiry_agent = new Inspiry_Agent( get_the_ID() );
?>
<div class="inner-wrapper clearfix">

    <?php
    if ( has_post_thumbnail( get_the_ID() ) ) {
        ?>
        <figure class="agent-image">
            <a href="<?php the_permalink(); ?>" >
                <?php the_post_thumbnail( 'inspiry-agent-thumbnail', array( 'class' => 'img-circle' ) ); ?>
            </a>
        </figure>
        <?php
    }
    ?>

    <h3 class="agent-name">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
        ?><li class="mobile"><?php include( $template_svg_path . 'icon-mobile.svg' ); ?><span><?php esc_html_e( 'Mobile:', 'inspiry' ); ?></span><?php echo esc_html( $mobile ) ?></li><?php
    }

    /*
     * Office
     */
    $office_phone = $inspiry_agent->get_office_phone();
    if ( !empty( $office_phone ) ) {
        ?><li class="office"><?php include( $template_svg_path . 'icon-phone.svg' ); ?><span><?php esc_html_e( 'Office:', 'inspiry' ); ?></span><?php echo esc_html( $office_phone ); ?></li><?php
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
    echo apply_filters( 'the_content', get_inspiry_excerpt() );
    ?><a class="btn-default show-details" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Profile', 'inspiry' ); ?><i class="fa fa-angle-right"></i></a><?php
}

?>