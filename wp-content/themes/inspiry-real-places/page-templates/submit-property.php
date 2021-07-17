<?php
/*
 * Template Name: Submit Property
 */

global $inspiry_options;
$invalid_nonce = false;
$submitted_successfully = false;
$updated_successfully = false;

if ( function_exists( 'ire_property_submit_edit_handler' ) ) {
	ire_property_submit_edit_handler( $inspiry_options, $submitted_successfully, $updated_successfully, $invalid_nonce );
}

get_header();

get_template_part( 'partials/header/banner' );
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main">

                            <div class="white-box submit-property-box">

                                <?php
                                /*
                                 * Display page contents if any
                                 */
                                if ( have_posts() ):
                                    while ( have_posts() ):
                                        the_post();
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
                                    endwhile;
                                endif;

                                /*
                                 * Property submit and update stuff
                                 */
                                if ( is_user_logged_in() ) {
                                    if ( $invalid_nonce ) {
                                        ire_message( esc_html__( 'Oops','inspiry' ), esc_html__( 'Security check failed!', 'inspiry' ) );
                                    } else {
                                        if ( $submitted_successfully ) {
                                            ire_message( esc_html__( 'Submitted','inspiry' ), esc_html__( 'Property successfully submitted.', 'inspiry' ) );
                                        } else if ( $updated_successfully ) {
                                            ire_message( esc_html__('Updated','inspiry'), esc_html__('Property updated successfully.', 'inspiry' ) );
                                        } else {
                                            if( isset( $_GET['edit_property'] ) && ! empty( $_GET['edit_property'] ) ) { // if passed parameter is properly set to edit property
                                                get_template_part( 'partials/property/templates/edit-form' );
                                            } else {
                                                get_template_part( 'partials/property/templates/submit-form' );
                                            }
                                        }
                                    }
                                } else {
                                    ire_message( esc_html__( 'Login Required', 'inspiry' ), esc_html__( 'You need to login to submit a property!', 'inspiry' ) );
                                }
                                ?>

                            </div>
                            <!-- .submit-property-box -->


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
/*
 * Footer
 */
get_footer();
