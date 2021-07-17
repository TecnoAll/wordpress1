<?php
/*
 * Template for property archives
 */

get_header();

/*
 * Google Map or Banner
 */
global $inspiry_options;
if ( $inspiry_options[ 'inspiry_archive_module_below_header' ] == 'google-map' ) {
    // Image Banner
    get_template_part( 'partials/header/map' );
} else {
    // Image Banner
    get_template_part( 'partials/header/banner' );
}
?>
    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 site-main-content">

                        <main id="main" class="site-main">
                            <?php
                            get_template_part( 'partials/property/templates/compare', 'view' );
                            /*
                             * Sorting for archive page
                             */
                            global $wp_query;
                            $sort_query_args = array();
                            $sort_query_args = apply_filters( 'inspiry_sort_properties', $sort_query_args );

                            query_posts( array_merge( $wp_query->query_vars, $sort_query_args ) );

                            /*
                             * Found properties heading and sorting controls
                             */
                            global $found_properties;
                            $found_properties = $wp_query->found_posts;
                            get_template_part( 'partials/property/templates/listing-control' );

                            /*
                             * Properties
                             */
                            if ( have_posts() ) :

                                global $property_list_counter;
                                $property_list_counter = 1;

                                $archive_layout = $inspiry_options[ 'inspiry_archive_layout' ];
                                if ( $archive_layout == 'grid' ) {
                                    echo '<div class="row">';
                                }

                                while ( have_posts() ) :

                                    the_post();

                                    if ( $archive_layout == 'grid' ) {
                                        // display property in grid layout
                                        get_template_part( 'partials/property/templates/property-for-grid' );
                                    } else {
                                        // display property in list layout
                                        get_template_part( 'partials/property/templates/property-for-list' );
                                    }

                                    $property_list_counter++;

                                endwhile;

                                if ( $archive_layout == 'grid' ) {
                                    echo '</div>';
                                }

                                inspiry_pagination( $wp_query );

                            endif;
                            ?>

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

