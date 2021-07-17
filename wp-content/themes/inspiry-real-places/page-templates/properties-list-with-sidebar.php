<?php
/*
 * Template Name: Properties List - With Sidebar
 */

get_header();

$display_google_map = get_post_meta( get_the_ID(), 'inspiry_display_google_map', true );

if ( $display_google_map ) {
    get_template_part( 'partials/header/map' );
} else {
    get_template_part( 'partials/header/banner' );
}
?>

<div class="wrapper-search-form-two">
    <?php
    global $inspiry_options;

    if ( $inspiry_options['inspiry_header_variation'] != '1' ) {
        if ( inspiry_theme_options_set( 'inspiry_search_form_two' ) && $inspiry_options['inspiry_search_form_two'] == '1' ) {
            get_template_part( 'partials/home/search' );
        }
    }
    ?>
</div>

    <div id="content-wrapper" class="site-content-wrapper site-pages">

        <div id="content" class="site-content layout-boxed">

            <div class="container">

                <div class="row">

                    <div class="col-md-9 site-main-content">

                        <main id="main" class="site-main">

                            <?php
                            get_template_part( 'partials/property/templates/compare', 'view' );
                            global $paged;
                            if ( is_front_page() ) {
                                $paged = ( get_query_var('page') ) ? get_query_var( 'page' ) : 1;
                            }

                            $properties_list_arg = array(
                                'post_type'         => 'property',
                                'paged'             => $paged,
                            );

                            // Apply properties filter
                            $properties_list_arg = apply_filters( 'inspiry_properties_filter', $properties_list_arg );

                            // Apply sorting filter
                            $properties_list_arg = apply_filters( 'inspiry_sort_properties', $properties_list_arg );

                            $properties_list_query = new WP_Query( $properties_list_arg );

                            /*
                             * Found properties heading and sorting controls
                             */
                            global $found_properties;
                            $found_properties = $properties_list_query->found_posts;
                            get_template_part( 'partials/property/templates/listing-control' );

                            /**
                             * Page Content
                             */
                            if ( have_posts() ) {
                                while ( have_posts() ) {
                                    the_post();
                                    $content = get_the_content();
                                    if ( ! empty( $content ) ) {
                                        get_template_part( 'partials/page/content' );
                                    }
                                }
                            }

                            /*
                             * Properties List
                             */
                            if ( $properties_list_query->have_posts() ) :

                                while ( $properties_list_query->have_posts() ) :

                                    $properties_list_query->the_post();

                                    // display property in list layout
                                    get_template_part( 'partials/property/templates/property-for-list-with-sidebar' );

                                endwhile;

                                inspiry_pagination( $properties_list_query );

                                wp_reset_postdata();

                            endif;
                            ?>

                        </main>
                        <!-- .site-main -->

                    </div>
                    <!-- .site-main-content -->

	                <?php if ( inspiry_is_active_custom_sidebar( 'properties-list' ) ) : ?>
                        <div class="col-md-3 site-sidebar-content">
			                <?php get_sidebar( 'properties-list' ); ?>
                        </div>
                        <!-- .site-sidebar-content -->
	                <?php endif; ?>
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
