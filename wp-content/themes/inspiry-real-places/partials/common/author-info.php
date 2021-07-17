<?php
// Get Author Information
global $current_author;
global $current_author_meta;
?>
<div class="inner-wrapper clearfix">

    <?php
    if ( isset( $current_author_meta['profile_image_id'] ) ) {
        ?>
        <figure class="agent-image">
            <?php echo wp_get_attachment_image( $current_author_meta['profile_image_id'][0], 'inspiry-agent-thumbnail', false, array( 'class' => 'img-circle' ) ); ?>
        </figure>
        <?php
    } else if ( function_exists( 'get_avatar' ) ) {
        ?>
        <figure class="agent-image">
            <?php echo get_avatar( $current_author->user_email, 220, '', '', array( 'class' => 'img-circle' ) ); ?>
        </figure>
        <?php
    }
    ?>

    <h3 class="agent-name">
        <?php echo esc_html( $current_author->display_name ); ?>
        <?php
        if ( isset( $current_author_meta[ 'job_title' ] ) && !empty( $current_author_meta[ 'job_title' ][0] ) ) {
            ?><span><?php echo esc_html( $current_author_meta[ 'job_title' ][0] ); ?></span><?php
        }
        ?>
    </h3>

    <div class="agent-social-profiles">
        <?php
		if ( function_exists( 'ire_current_author_social_profiles' ) ) {
			ire_current_author_social_profiles( $current_author_meta );
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
    if ( isset( $current_author_meta[ 'mobile_number' ] ) && !empty( $current_author_meta[ 'mobile_number' ][0] ) ) {
        ?><li class="mobile"><?php include( $template_svg_path . 'icon-mobile.svg' ); ?><span><?php esc_html_e( 'Mobile:', 'inspiry' ); ?></span><?php echo esc_html( $current_author_meta[ 'mobile_number' ][0] ); ?></li><?php
    }

    /*
     * Office
     */
    if ( isset( $current_author_meta[ 'office_number' ] ) && !empty( $current_author_meta[ 'office_number' ][0] ) ) {
        ?><li class="office"><?php include( $template_svg_path . 'icon-phone.svg' ); ?><span><?php esc_html_e( 'Office:', 'inspiry' ); ?></span><?php echo esc_html( $current_author_meta[ 'office_number' ][0] ); ?></li><?php
    }

    /*
     * Fax
     */
    if ( isset( $current_author_meta[ 'fax_number' ] ) && !empty( $current_author_meta[ 'fax_number' ][0] ) ) {
        ?><li class="fax"><?php include( $template_svg_path . 'icon-fax.svg' ); ?><span><?php esc_html_e( 'Fax:', 'inspiry' ); ?></span><?php echo esc_html( $current_author_meta[ 'fax_number' ][0] ); ?></li><?php
    }

    /*
     * Address
     */
    if ( isset( $current_author_meta[ 'office_address' ] ) && !empty( $current_author_meta[ 'office_address' ][0] ) ) {
        ?><li class="map-pin"><?php include( $template_svg_path . 'map-marker.svg' ); echo esc_html( $current_author_meta[ 'office_address' ][0] ); ?></li><?php
    }
    ?>

</ul>