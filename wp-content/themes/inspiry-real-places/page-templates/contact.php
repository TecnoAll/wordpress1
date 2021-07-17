<?php
/*
 * Template Name: Contact
 */

get_header();

get_template_part( 'partials/header/banner' );

global $inspiry_options;

// Get all custom post meta information related to contact page
$contact_meta_data = get_post_custom( get_the_ID() );

    /*
     * Google Map
     */
    if ( isset( $contact_meta_data['inspiry_map_address'] ) && isset( $contact_meta_data['inspiry_map_location'] ) ) : ?>
        <div class="google-map-wrapper">
            <div id="map-canvas"></div>
        </div>
    <?php endif; ?>

    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main">

                            <div class="row zero-horizontal-margin column-container">

                            <?php
                            if ( have_posts() ):
                                while ( have_posts() ):
                                    the_post();
                                    ?>
                                    <div class="col-md-6 col-left-side contact-details">
                                        <?php
                                        /*
                                         * Content
                                         */
                                        $content = get_the_content();
                                        if ( !empty( $content ) ) {
                                            ?>
                                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                                <div class="entry-content clearfix">
                                                    <?php the_content(); ?>
                                                </div>
                                            </article>
                                            <?php
                                        }

                                        /*
                                         * Address
                                         */
                                        $inspiry_address = null;
                                        if ( isset( $contact_meta_data[ 'inspiry_address' ] ) ) {
                                            $inspiry_address = $contact_meta_data[ 'inspiry_address' ][ 0 ];
                                        }

                                        if ( !empty( $inspiry_address ) ) {
                                            ?>
                                            <div class="address-wrapper">
                                                <h3 class="list-title"><?php esc_html_e( 'Address', 'inspiry' ); ?></h3>
                                                <address>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <?php echo esc_html( $inspiry_address ); ?>
                                                </address>
                                            </div>
                                            <?php
                                        }
                                        ?>


                                        <div class="row">

                                            <?php
                                            $inspiry_phone = null;
                                            if ( isset( $contact_meta_data[ 'inspiry_phone' ] ) ) {
                                                $inspiry_phone = $contact_meta_data[ 'inspiry_phone' ][ 0 ];
                                            }

                                            $inspiry_mobile = null;
                                            if ( isset( $contact_meta_data[ 'inspiry_mobile' ] ) ) {
                                                $inspiry_mobile = $contact_meta_data[ 'inspiry_mobile' ][ 0 ];
                                            }

                                            $inspiry_fax = null;
                                            if ( isset( $contact_meta_data[ 'inspiry_fax' ] ) ) {
                                                $inspiry_fax = $contact_meta_data[ 'inspiry_fax' ][ 0 ];
                                            }

                                            $inspiry_display_email = null;
                                            if ( isset( $contact_meta_data[ 'inspiry_display_email' ] ) ) {
                                                $inspiry_display_email = trim($contact_meta_data[ 'inspiry_display_email' ][ 0 ]);
                                                $inspiry_display_email = is_email( $inspiry_display_email );
                                            }

                                            if ( !empty( $inspiry_phone ) || !empty( $inspiry_mobile ) || !empty( $inspiry_fax ) ) {
                                                $template_svg_path = get_template_directory() . '/images/svg/';
                                                ?>
                                                <div class="col-sm-6">
                                                    <h3 class="list-title"><?php esc_html_e( 'Contact Details', 'inspiry' ); ?></h3>
                                                    <ul class="contacts-list">
                                                        <?php
                                                        /*
                                                         * Phone
                                                         */
                                                        if ( !empty( $inspiry_phone ) ) {
                                                            ?>
                                                            <li class="phone">
                                                            <?php include( $template_svg_path . 'icon-phone.svg' ); ?>
                                                            <a href="tel://<?php echo esc_attr( $inspiry_phone ); ?>" title="<?php esc_html_e( 'Make a Call', 'inspiry' ); ?>"><?php echo esc_html( $inspiry_phone ); ?></a>
                                                            </li>
                                                            <?php
                                                        }

                                                        /*
                                                         * Mobile
                                                         */
                                                        if ( !empty( $inspiry_mobile ) ) {
                                                            ?>
                                                            <li class="mobile">
                                                                <?php include( $template_svg_path . 'icon-mobile.svg' ); ?>
                                                                <a href="tel://<?php echo esc_attr( $inspiry_mobile ); ?>" title="<?php esc_html_e( 'Make a Call', 'inspiry' ); ?>"><?php echo esc_html( $inspiry_mobile ); ?></a>
                                                            </li>
                                                            <?php
                                                        }

                                                        /*
                                                         * Fax
                                                         */
                                                        if ( !empty( $inspiry_fax ) ) {
                                                            ?><li class="fax"><?php include( $template_svg_path . 'icon-fax.svg' ); ?><?php echo esc_html( $inspiry_fax ); ?></li><?php
                                                        }

                                                        /*
                                                         * Display Email
                                                         */
                                                        if ( !empty( $inspiry_display_email ) ) {
                                                            ?>
                                                            <li class="email">
                                                                <?php include( $template_svg_path . 'icon-email.svg' ); ?><a href="mailto:<?php echo antispambot( $inspiry_display_email ); ?>"><?php echo esc_html( $inspiry_display_email ); ?></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <?php
                                            }

                                            /*
                                             * Working Hours
                                             */
                                            $inspiry_work_hours = null;
                                            if ( isset( $contact_meta_data[ 'inspiry_work_hours' ] ) ) {
                                                $inspiry_work_hours = maybe_unserialize( $contact_meta_data[ 'inspiry_work_hours' ][ 0 ] );
                                            }

                                            if ( !empty( $inspiry_work_hours ) ) {
                                                ?>
                                                <div class="col-sm-6">
                                                    <h3 class="list-title"><?php esc_html_e( 'Working Hours', 'inspiry' ); ?></h3>
                                                    <ul class="contacts-list">
                                                        <?php
                                                        foreach ( $inspiry_work_hours as $key=>$value ) {
                                                            if ( $key == 0 ) {
                                                                ?><li class="icon-clock"><?php include( $template_svg_path . 'icon-clock.svg' ); ?><?php echo esc_html( $value ); ?></li><?php
                                                            } else {
                                                                ?><li class="icon-clock"><?php echo esc_html( $value ); ?></li><?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>

                                    </div>


                                    <?php
                                    /*
                                     * Contact form
                                     */
                                    if ( function_exists( 'ire_contact_form' ) ) {
	                                    ire_contact_form( $contact_meta_data, $inspiry_options );	//function resides in plugin
                                    }

                                endwhile;

                            endif;
                            ?>

                            </div>

                        </main>
                        <!-- .site-main -->

                    </div>
                    <!-- .site-main-content -->

                </div>
                <!-- .row -->

            </div>
            <!-- .container -->

        </div>
        <!-- .site-content -->

    </div><!-- .site-content-wrapper -->

<?php
get_footer();
?>