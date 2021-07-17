<?php
if( !function_exists( 'inspiry_property_meta' ) ) :
    /**
     * @param object $inspiry_property
     * @param array $property_meta_array
     */
    function inspiry_property_meta( $inspiry_property, $property_meta_array = array()  ) {

        ?>
        <div class="property-meta entry-meta clearfix <?php if ( isset( $property_meta_array['container_classes'] ) ) { echo esc_attr( $property_meta_array[ 'container_classes' ] ); } ?>"><?php

            $meta_array = array( 'id', 'area', 'beds', 'baths', 'garages', 'type', 'status', 'location','year' );

            if ( isset( $property_meta_array['meta'] ) && is_array( $property_meta_array['meta'] ) ) {

                $meta_array = $property_meta_array['meta'];

            } elseif ( isset( $property_meta_array['exclude'] ) && is_array( $property_meta_array['exclude'] ) ) {
                $meta_array = array_diff( $meta_array, $property_meta_array['exclude'] );

            }

            $temp_dir = get_template_directory();

            foreach ( $meta_array as $meta_type ) {

                switch ( $meta_type ):

                    case 'id':
                        $inspiry_property_custom_ID = $inspiry_property->get_custom_ID();
                        if ( $inspiry_property_custom_ID ) {
                            ?>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-pid"><?php include( $temp_dir . '/images/svg/icon-pid.svg' ); ?></i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label"><?php esc_html_e('Property ID', 'inspiry'); ?></span>
                                    <span class="meta-item-value"><?php echo esc_html( $inspiry_property_custom_ID ); ?></span>
                                </div>
                            </div>
                            <?php
                        }
                        break;

                    case 'area':
                        $inspiry_property_area = $inspiry_property->get_area();
                        if ( $inspiry_property_area ) {
                            ?>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-area"><?php include( $temp_dir . '/images/svg/icon-area.svg' ); ?></i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label"><?php esc_html_e( 'Area', 'inspiry' ); ?></span>
                            <span class="meta-item-value"><?php
                                // area
                                echo esc_html( $inspiry_property_area );

                                // area postfix
                                $inspiry_property_area_postfix = $inspiry_property->get_area_postfix();
                                if ( $inspiry_property_area_postfix ) {
                                    ?><sub class="meta-item-unit"><?php echo esc_html( $inspiry_property_area_postfix ); ?></sub><?php
                                }
                                ?></span>
                                </div>
                            </div>
                            <?php
                        }
                        break;

                    case 'beds':
                        $inspiry_property_beds = $inspiry_property->get_beds();
                        if ( $inspiry_property_beds ) {
                            ?>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-bed"><?php include( $temp_dir . '/images/svg/icon-bed.svg' ); ?></i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label"><?php esc_html_e( 'Bedrooms', 'inspiry' ); ?></span>
                                    <span class="meta-item-value"><?php echo esc_html( $inspiry_property_beds ); ?></span>
                                </div>
                            </div>
                            <?php
                        }
                        break;

                    case 'baths':
                        $inspiry_property_baths = $inspiry_property->get_baths();
                        if ( $inspiry_property_baths ) {
                            ?>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-bath"><?php include( $temp_dir . '/images/svg/icon-bath.svg' ); ?></i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label"><?php esc_html_e( 'Bathrooms', 'inspiry' ); ?></span>
                                    <span class="meta-item-value"><?php echo esc_html( $inspiry_property_baths ); ?></span>
                                </div>
                            </div>
                            <?php
                        }
                        break;

                    case 'garages':
                        $inspiry_property_garages = $inspiry_property->get_garages();
                        if ( $inspiry_property_garages ) {
                            ?>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-garage"><?php include( $temp_dir . '/images/svg/icon-garage.svg' ); ?></i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label"><?php esc_html_e('Garages', 'inspiry'); ?></span>
                                    <span class="meta-item-value"><?php echo esc_html( $inspiry_property_garages ); ?></span>
                                </div>
                            </div>
                            <?php
                        }
                        break;

                    case 'type':
                        $inspiry_property_types = $inspiry_property->get_types();
                        if ( $inspiry_property_types ) {
                            ?>
                            <div class="meta-item meta-property-type">
                                <i class="meta-item-icon icon-ptype"><?php include( $temp_dir . '/images/svg/icon-ptype.svg'); ?></i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label"><?php esc_html_e('Type', 'inspiry'); ?></span>
                                    <span class="meta-item-value"><?php echo esc_html( $inspiry_property_types ); ?></span>
                                </div>
                            </div>
                            <?php
                        }
                        break;

                    case 'status':
                        $inspiry_property_status = $inspiry_property->get_status();
                        if ( $inspiry_property_status ) {
                            ?>
                            <div class="meta-item">
                                <i class="meta-item-icon icon-tag"><?php include( $temp_dir . '/images/svg/icon-tag.svg'); ?></i>
                                <div class="meta-inner-wrapper">
                                    <span class="meta-item-label"><?php esc_html_e('Status', 'inspiry'); ?></span>
                                    <span class="meta-item-value"><?php echo esc_html( $inspiry_property_status ); ?></span>
                                </div>
                            </div>
                            <?php
                        }
                        break;

                    case 'location':
						if ( method_exists( $inspiry_property, 'get_city' ) ) {
							$inspiry_property_city = $inspiry_property->get_city();
							if ( $inspiry_property_city ) {
								?>
								<div class="meta-item">
									<i class="meta-item-icon icon-location"><?php include( $temp_dir . '/images/svg/icon-location.svg'); ?></i>
									<div class="meta-inner-wrapper">
										<span class="meta-item-label"><?php esc_html_e('Location', 'inspiry'); ?></span>
										<span class="meta-item-value"><?php echo esc_html( $inspiry_property_city ); ?></span>
									</div>
								</div>
								<?php
							}
						}
                        break;

                    case 'year':
                        if ( method_exists( $inspiry_property, 'get_year' ) ) {
                            $inspiry_property_year = $inspiry_property->get_year();
                            if ( $inspiry_property_year ) {
                                ?>
                                <div class="meta-item">
                                    <i class="meta-item-icon icon-location"><?php include( $temp_dir . '/images/svg/icon-calendar.svg'); ?></i>
                                    <div class="meta-inner-wrapper">
                                        <span class="meta-item-label"><?php esc_html_e('Year Built', 'inspiry'); ?></span>
                                        <span class="meta-item-value"><?php echo esc_html( $inspiry_property_year ); ?></span>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        break;

                endswitch;

            }

            ?>
        </div><!-- .property-meta -->
        <?php

    }

endif;



if( !function_exists( 'inspiry_get_file_icon' ) ) :
    /**
     * Return font awesome icon based on file extnsion
     * @param string $extension file extension
     * @return string
     */
    function inspiry_get_file_icon( $extension ) {

        switch ( $extension ) {
            /* PDF */
            case 'pdf':
                return '<i class="far fa-file-pdf"></i>';

            /* Images */
            case 'jpg':
            case 'png':
            case 'gif':
            case 'bmp':
            case 'jpeg':
            case 'tiff':
            case 'tif':
                return '<i class="far fa-file-image"></i>';

            /* Text */
            case 'txt':
            case 'log':
            case 'tex':
                return '<i class="far fa-file-alt"></i>';

            /* Documents */
            case 'doc':
            case 'odt':
            case 'msg':
            case 'docx':
            case 'rtf':
            case 'wps':
            case 'wpd':
            case 'pages':
                return '<i class="far fa-file-word"></i>';

            /* Spread Sheets */
            case 'csv':
            case 'xlsx':
            case 'xls':
            case 'xml':
            case 'xlr':
                return '<i class="far fa-file-excel"></i>';

            /* Zip */
            case 'zip':
            case 'rar':
            case '7z':
            case 'zipx':
            case 'tar.gz':
            case 'gz':
            case 'pkg':
                return '<i class="far fa-file-zip"></i>';

            /* Audio */
            case 'mp3':
            case 'wav':
            case 'm4a':
            case 'aif':
            case 'wma':
            case 'ra':
            case 'mpa':
            case 'iff':
            case 'm3u':
                return '<i class="far fa-file-audio"></i>';

            /* Video */
            case 'avi':
            case 'flv':
            case 'm4v':
            case 'mov':
            case 'mp4':
            case 'mpg':
            case 'rm':
            case 'swf':
            case 'wmv':
                return '<i class="far fa-file-video"></i>';

            /* Others */
            default:
                return '<i class="far fa-file-alt"></i>';
        }

    }

endif;



if( !function_exists( 'inspiry_property_gallery' ) ) :
    /**
     * Generated gallery for a property
     * @param int $property_id
     * @param int $gallery_limit
     */
    function inspiry_property_gallery( $property_id = 0, $gallery_limit = 3, $size = 'inspiry-grid-thumbnail' ) {

        if ( !$property_id ) {
            $property_id = get_the_ID();
        }

        $gallery_images = inspiry_get_post_meta (
            'REAL_HOMES_property_images',
            array(
                'type' => 'image_advanced',
                'size' => $size
            ),
            $property_id
        );

        if ( !empty( $gallery_images ) && 0 < count( $gallery_images ) ) {
            ?>
            <div class="gallery-slider-two flexslider">
                <ul class="slides">
                    <?php
                    $gallery_image_count = 1;
                    foreach( $gallery_images as $gallery_image ) {
                        $caption = ( !empty( $gallery_image['caption'] ) ) ? $gallery_image['caption'] : $gallery_image['alt'];

                        echo '<li>';
                        echo '<a class="swipebox" data-rel="gallery-'. $property_id  .'" href="'. esc_url( $gallery_image['full_url'] ) .'" title="'. $caption .'" >';
                        echo '<img class="img-responsive" src="'. esc_url( $gallery_image['url'] ) .'" alt="'. $gallery_image['title'] .'" />';
                        echo '</a>';
                        echo '</li>';

                        if ( $gallery_image_count == $gallery_limit ) {
                            break;
                        }
                        $gallery_image_count++;
                    }
                    ?>
                </ul>
            </div>
            <?php
        } else {
            inspiry_thumbnail( $size );
        }
    }
endif;



if( !function_exists( 'inspiry_generate_location_data' ) ) {
    /**
     * Generates locations related data that is consumed by js to product locations related UI
     */
    function inspiry_generate_location_data() {
        global $inspiry_options;
        $get_sort_order = $inspiry_options['inspiry_search_taxonomy_order'];

        if ( ! is_admin() ) {

            // all property city terms
            $all_locations = get_terms( 'property-city', array(
                'hide_empty' => false,
                'orderby' => $get_sort_order,
                'order' => ($get_sort_order === 'count' ? 'DESC' : 'ASC'),
            ));

            // select boxes names
            $location_select_names = ire_get_location_select_names();
            $location_select_count = ire_get_locations_number();

            // location parameters in request, if any
            $locations_in_params = array();
            foreach ( $location_select_names as $location_name ) {
                if( isset( $_GET[ $location_name ] ) ) {
                    $locations_in_params[ $location_name ] = $_GET[ $location_name ];
                }
            }

            // combine all data into one array
            $location_data_array = array(
                'any' => esc_html__('(Any)','inspiry'),
                'all_locations' => $all_locations,
                'select_names' => $location_select_names,
                'select_count' => $location_select_count,
                'locations_in_params' => $locations_in_params,
            );

            // provide location data array before property search form script
            wp_localize_script( 'inspiry-search-form', 'locationData', $location_data_array );

        }
    }

    add_action( 'inspiry_after_location_fields', 'inspiry_generate_location_data' );

}



if( !function_exists( 'inspiry_hierarchical_options' ) ){
    /**
     * Output hierarchical select options with selection based on slug
     *
     * @param $taxonomy_name
     * @param $taxonomy_terms
     * @param $searched_term
     * @param string $prefix
     */
    function inspiry_hierarchical_options( $taxonomy_name, $taxonomy_terms, $searched_term, $prefix = " " ){

        if ( ! empty( $taxonomy_terms ) && ! is_wp_error( $taxonomy_terms ) ){

            foreach ( $taxonomy_terms as $term ) {

                if ( $searched_term == $term->slug ) {
                    echo '<option value="' . $term->slug . '" selected="selected">' . $prefix . $term->name . '</option>';
                } else {
                    echo '<option value="' . $term->slug . '">' . $prefix . $term->name . '</option>';
                }

                $child_terms = get_terms( $taxonomy_name, array(
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hide_empty' => false,
                    'parent' => $term->term_id
                ) );

                if ( ! empty( $child_terms ) && !is_wp_error( $child_terms ) ){
                    /* Recursive Call */
                    inspiry_hierarchical_options( $taxonomy_name, $child_terms, $searched_term, "- ".$prefix );
                }

            }

        }

    }
}



if( !function_exists( 'inspiry_property_search' ) ) {
    /**
     * Offers property search functionality
     *
     * @param $search_args  Array   search arguments
     * @return mixed    Array   modified search arguments
     */
    function inspiry_property_search( $search_args ) {

        /* taxonomy query and meta query arrays */
        $tax_query = array();
        $meta_query = array();

        /* Keyword Based Search */
        if( isset ( $_GET['keyword'] ) ) {
            $keyword = trim( $_GET['keyword'] );
            if ( ! empty( $keyword ) ) {
                $search_args['s'] = $keyword;
            }
        }

        /* property type taxonomy query */
        if( ( !empty( $_GET['type'] ) ) && ( $_GET['type'] != 'any') ){
            $tax_query[] = array(
                'taxonomy' => 'property-type',
                'field' => 'slug',
                'terms' => $_GET['type']
            );
        }

        /* property location taxonomy query */
        $location_select_names = ire_get_location_select_names();
        $locations_count = count( $location_select_names );
        for ( $l = $locations_count - 1; $l >= 0; $l-- ) {
            if( isset( $_GET[ $location_select_names[$l] ] ) ){
                $current_location = $_GET[ $location_select_names[$l] ];
                if( ( ! empty ( $current_location ) ) && ( $current_location != 'any' ) ){
                    $tax_query[] = array (
                        'taxonomy' => 'property-city',
                        'field' => 'slug',
                        'terms' => $current_location
                    );
                    break;
                }
            }
        }

        /* property feature taxonomy query */
        if ( isset( $_GET['features'] ) ) {
            $required_features_slugs = $_GET['features'];
            if ( is_array ( $required_features_slugs ) ) {

                $slugs_count = count ( $required_features_slugs );
                if ( $slugs_count > 0 ) {

                    /* build an array of existing features slugs to validate required feature slugs */
                    $existing_features_slugs = array();
                    $existing_features = get_terms( 'property-feature', array( 'hide_empty' => false ) );
                    $existing_features_count = count ( $existing_features );
                    if ( $existing_features_count > 0 ) {
                        foreach ($existing_features as $feature) {
                            $existing_features_slugs[] = $feature->slug;
                        }
                    }

                    foreach ( $required_features_slugs as $feature_slug ) {
                        if( in_array( $feature_slug, $existing_features_slugs ) ){  // validate slug
                            $tax_query[] = array (
                                'taxonomy' => 'property-feature',
                                'field' => 'slug',
                                'terms' => $feature_slug
                            );
                        }
                    }
                }
            }

        }

        /* property status taxonomy query */
        if((!empty($_GET['status'])) && ( $_GET['status'] != 'any' ) ){
            $tax_query[] = array(
                'taxonomy' => 'property-status',
                'field' => 'slug',
                'terms' => $_GET['status']
            );
        }

        /* Property Bedrooms Parameter */
        if((!empty($_GET['bedrooms'])) && ( $_GET['bedrooms'] != 'any' ) ){
            $meta_query[] = array(
                'key' => 'REAL_HOMES_property_bedrooms',
                'value' => $_GET['bedrooms'],
                'compare' => '>=',
                'type'=> 'DECIMAL'
            );
        }

        /* Property Bathrooms Parameter */
        if((!empty($_GET['bathrooms'])) && ( $_GET['bathrooms'] != 'any' ) ){
            $meta_query[] = array(
                'key' => 'REAL_HOMES_property_bathrooms',
                'value' => $_GET['bathrooms'],
                'compare' => '>=',
                'type'=> 'DECIMAL'
            );
        }

        /* Property ID Parameter */
        if( isset($_GET['property-id']) && !empty($_GET['property-id'])){
            $property_id = trim($_GET['property-id']);
            $meta_query[] = array(
                'key' => 'REAL_HOMES_property_id',
                'value' => $property_id,
                'compare' => 'LIKE',
                'type'=> 'CHAR'
            );
        }

        /* Logic for Min and Max Price Parameters */
        if( isset($_GET['min-price']) && ($_GET['min-price'] != 'any') && isset($_GET['max-price']) && ($_GET['max-price'] != 'any') ){
            $min_price = doubleval($_GET['min-price']);
            $max_price = doubleval($_GET['max-price']);
            if( $min_price >= 0 && $max_price > $min_price ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => array( $min_price, $max_price ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
            }
        }elseif( isset($_GET['min-price']) && ($_GET['min-price'] != 'any') ){
            $min_price = doubleval($_GET['min-price']);
            if( $min_price > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                );
            }
        }elseif( isset($_GET['max-price']) && ($_GET['max-price'] != 'any') ){
            $max_price = doubleval($_GET['max-price']);
            if( $max_price > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => $max_price,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                );
            }
        }


        /* Logic for Min and Max Area Parameters */
        if( isset($_GET['min-area']) && !empty($_GET['min-area']) && isset($_GET['max-area']) && !empty($_GET['max-area']) ){
            $min_area = intval($_GET['min-area']);
            $max_area = intval($_GET['max-area']);
            if( $min_area >= 0 && $max_area > $min_area ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => array( $min_area, $max_area ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
            }
        }elseif( isset($_GET['min-area']) && !empty($_GET['min-area']) ){
            $min_area = intval($_GET['min-area']);
            if( $min_area > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => $min_area,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                );
            }
        }elseif( isset($_GET['max-area']) && !empty($_GET['max-area']) ){
            $max_area = intval($_GET['max-area']);
            if( $max_area > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_size',
                    'value' => $max_area,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                );
            }
        }


        /* if more than one taxonomies exist then specify the relation */
        $tax_count = count( $tax_query );
        if( $tax_count > 1 ){
            $tax_query['relation'] = 'AND';
        }

        /* if more than one meta query elements exist then specify the relation */
        $meta_count = count( $meta_query );
        if( $meta_count > 1 ){
            $meta_query['relation'] = 'AND';
        }

        if( $tax_count > 0 ){
            $search_args['tax_query'] = $tax_query;
        }

        /* if meta query has some values then add it to base home page query */
        if( $meta_count > 0 ){
            $search_args['meta_query'] = $meta_query;
        }

        /* Sort By Price */
        if( (isset($_GET['min-price']) && ($_GET['min-price'] != 'any')) || ( isset($_GET['max-price']) && ($_GET['max-price'] != 'any') ) ){
            $search_args['orderby'] = 'meta_value_num';
            $search_args['meta_key'] = 'REAL_HOMES_property_price';
            $search_args['order'] = 'ASC';
        }

        return $search_args;
    }
    add_filter( 'inspiry_property_search', 'inspiry_property_search' );
}



if( !function_exists( 'inspiry_sort_properties' ) ){
    /**
     * Add sorting parameters to query arguments
     *
     * @param $properties_query_args  Array   query arguments
     * @return mixed    Array   modified query arguments
     */
    function inspiry_sort_properties( $properties_query_args ) {

        global $inspiry_options;
        $sort_by = null;

        if ( isset( $_GET['sortby'] ) ) {
            $sort_by = $_GET['sortby'];
        } else {
            if ( is_page_template( 'page-templates/properties-search.php' ) ) {
                $sort_by = $inspiry_options[ 'inspiry_search_order' ];
            } elseif ( is_page_template( array (
                'page-templates/properties-list.php',
                'page-templates/properties-list-with-sidebar.php',
                'page-templates/properties-grid.php',
                'page-templates/properties-grid-with-sidebar.php' ,
                'page-templates/properties-list-half-map.php'

            ) ) ) {
                $sort_by = get_post_meta( get_the_ID(), 'inspiry_properties_order', true );
            } elseif ( is_tax( 'property-city' ) || is_tax( 'property-status' ) || is_tax( 'property-type' ) || is_tax( 'property-feature' ) ) {
                $sort_by = $inspiry_options[ 'inspiry_archive_order' ];
            } elseif ( is_post_type_archive( 'property' ) ) {
                $sort_by = $inspiry_options[ 'inspiry_archive_order' ];
            }
        }

        if ( $sort_by == 'price-asc' ) {
            $properties_query_args['orderby'] = 'meta_value_num';
            $properties_query_args['meta_key'] = 'REAL_HOMES_property_price';
            $properties_query_args['order'] = 'ASC';
        } elseif ( $sort_by == 'price-desc' ) {
            $properties_query_args['orderby'] = 'meta_value_num';
            $properties_query_args['meta_key'] = 'REAL_HOMES_property_price';
            $properties_query_args['order'] = 'DESC';
        } elseif ( $sort_by == 'date-asc' ) {
            $properties_query_args['orderby'] = 'date';
            $properties_query_args['order'] = 'ASC';
        } elseif ( $sort_by == 'date-desc' ) {
            $properties_query_args['orderby'] = 'date';
            $properties_query_args['order'] = 'DESC';
        } elseif ( $sort_by == 'random' ) {
            $properties_query_args['orderby'] = 'rand';
        }

        return $properties_query_args;
    }
    add_filter( 'inspiry_sort_properties', 'inspiry_sort_properties' );
}



if( !function_exists( 'inspiry_properties_filter' ) ) {
    /**
     * Add properties filter parameters to given query arguments
     *
     * @param $properties_query_args  Array   query arguments
     * @return mixed    Array   modified query arguments
     */
    function inspiry_properties_filter( $properties_query_args ) {

        $page_id = get_the_ID();
        $tax_query = array();
        $meta_query = array();

        /*
         * number of properties on each page
         */
        $number_of_properties = get_post_meta( $page_id, 'inspiry_posts_per_page', true );
        if ( $number_of_properties ) {
            $number_of_properties = intval( $number_of_properties );
            if( $number_of_properties < 1 ) {
                $properties_query_args['posts_per_page'] = 6;
            } else {
                $properties_query_args['posts_per_page'] = $number_of_properties;
            }
        } else {
            $properties_query_args['posts_per_page'] = 6;
        }


        /*
         * Locations
         */
        $locations = get_post_meta( $page_id, 'inspiry_properties_locations', false );
        if ( !empty( $locations ) && is_array( $locations ) ) {
            $tax_query[] = array (
                'taxonomy' => 'property-city',
                'field' => 'slug',
                'terms' => $locations
            );
        }

        /*
         * Statuses
         */
        $statuses = get_post_meta( $page_id, 'inspiry_properties_statuses', false );
        if ( !empty( $statuses ) && is_array( $statuses ) ) {
            $tax_query[] = array (
                'taxonomy'  => 'property-status',
                'field'     => 'slug',
                'terms'     => $statuses
            );
        }

        /*
         * Types
         */
        $types = get_post_meta( $page_id, 'inspiry_properties_types', false );
        if ( !empty( $types ) && is_array( $types ) ) {
            $tax_query[] = array (
                'taxonomy'  => 'property-type',
                'field'     => 'slug',
                'terms'     => $types
            );
        }

        /*
         * Features
         */
        $features = get_post_meta( $page_id, 'inspiry_properties_features', false );
        if ( !empty( $features ) && is_array( $features ) ) {
            $tax_query[] = array (
                'taxonomy'  => 'property-feature',
                'field'     => 'slug',
                'terms'     => $features
            );
        }

        // if more than one taxonomies exist then specify the relation
        $tax_count = count( $tax_query );
        if( $tax_count > 1 ){
            $tax_query['relation'] = 'AND';
        }
        if( $tax_count > 0 ){
            $properties_query_args['tax_query'] = $tax_query;
        }

        /*
         * Minimum Bedrooms
         */
        $min_beds = get_post_meta( $page_id, 'inspiry_properties_min_beds', true );
        if ( !empty( $min_beds ) ) {
            $min_beds = intval( $min_beds );
            if ( $min_beds > 0 ) {
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_bedrooms',
                    'value' => $min_beds,
                    'compare' => '>=',
                    'type'=> 'DECIMAL'
                );
            }
        }

        /*
         * Minimum Bathrooms
         */
        $min_baths = get_post_meta( $page_id, 'inspiry_properties_min_baths', true );
        if ( !empty( $min_baths ) ) {
            $min_baths = intval( $min_baths );
            if ( $min_baths > 0 ) {
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_bathrooms',
                    'value' => $min_baths,
                    'compare' => '>=',
                    'type'=> 'DECIMAL'
                );
            }
        }

        /*
         * Min & Max Price
         */
        $min_price = get_post_meta( $page_id, 'inspiry_properties_min_price', true );
        $max_price = get_post_meta( $page_id, 'inspiry_properties_max_price', true );
        if( !empty( $min_price ) && !empty( $max_price ) ) {
            $min_price = doubleval( $min_price );
            $max_price = doubleval( $max_price );
            if ( $min_price >= 0 && $max_price > $min_price ) {
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => array( $min_price, $max_price ),
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                );
            }
        } elseif ( !empty( $min_price ) ) {
            $min_price = doubleval( $min_price );
            if ( $min_price > 0 ) {
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => $min_price,
                    'type' => 'NUMERIC',
                    'compare' => '>='
                );
            }
        } elseif ( !empty( $max_price ) ) {
            $max_price = doubleval( $max_price );
            if( $max_price > 0 ){
                $meta_query[] = array(
                    'key' => 'REAL_HOMES_property_price',
                    'value' => $max_price,
                    'type' => 'NUMERIC',
                    'compare' => '<='
                );
            }
        }

        // if more than one meta query elements exist then specify the relation
        $meta_count = count( $meta_query );
        if ( $meta_count > 1 ) {
            $meta_query['relation'] = 'AND';
        }
        if ( $meta_count > 0 ) {
            $properties_query_args['meta_query'] = $meta_query;
        }

        return $properties_query_args;
    }

    add_filter( 'inspiry_properties_filter', 'inspiry_properties_filter' );
}



if( !function_exists( 'inspiry_home_properties_filter' ) ) {
    /**
     * Add home properties filter parameters to given query arguments
     *
     * @param $properties_query_args  Array   query arguments
     * @return mixed    Array   modified query arguments
     */
    function inspiry_home_properties_filter( $properties_query_args ) {

        global $inspiry_options;

        /*
         * Sorting
         */
        $sort_by = null;
        if ( isset( $inspiry_options[ 'inspiry_home_properties_order' ] ) ) {
            $sort_by = $inspiry_options[ 'inspiry_home_properties_order' ];
            if ( $sort_by == 'price-asc' ) {
                $properties_query_args['orderby'] = 'meta_value_num';
                $properties_query_args['meta_key'] = 'REAL_HOMES_property_price';
                $properties_query_args['order'] = 'ASC';
            } elseif ( $sort_by == 'price-desc' ) {
                $properties_query_args['orderby'] = 'meta_value_num';
                $properties_query_args['meta_key'] = 'REAL_HOMES_property_price';
                $properties_query_args['order'] = 'DESC';
            } elseif ( $sort_by == 'date-asc' ) {
                $properties_query_args['orderby'] = 'date';
                $properties_query_args['order'] = 'ASC';
            } elseif ( $sort_by == 'date-desc' ) {
                $properties_query_args['orderby'] = 'date';
                $properties_query_args['order'] = 'DESC';
            }
        }

        $properties_kind = $inspiry_options[ 'inspiry_home_properties_kind' ];

        if ( $properties_kind == 'default' ) {
            /*
             * Exclude Featured Properties
             */
            if( ( $inspiry_options[ 'inspiry_home_exclude_featured' ] ) ) {
                $properties_query_args['meta_query'] = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'REAL_HOMES_featured',
                        'compare' => 'NOT EXISTS',
                    ),
                    array(
                        'key' => 'REAL_HOMES_featured',
                        'value' => 0,
                        'compare' => '=',
                        'type' => 'NUMERIC'
                    )
                );
            }
        } elseif ( $properties_kind == 'random' ) {
            /*
             * Random Properties
             */
            $properties_query_args['orderby'] = 'rand';

        } elseif ( $properties_kind == 'featured' ) {
            /*
             * Featured Properties
             */
            $properties_query_args['meta_query'] = array(
                array(
                    'key'       => 'REAL_HOMES_featured',
                    'value'     => 1,
                    'compare'   => '=',
                    'type'      => 'NUMERIC'
                )
            );

        } elseif ( $properties_kind == 'selection' ) {
            /*
             * custom selection
             */
            $tax_query = array();

            // Locations
            if( !empty( $inspiry_options[ 'inspiry_home_properties_locations' ] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-city',
                    'field'     => 'term_id',
                    'terms'     => $inspiry_options[ 'inspiry_home_properties_locations' ]
                );
            }

            // Statuses
            if( !empty( $inspiry_options[ 'inspiry_home_properties_statuses' ] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-status',
                    'field'     => 'term_id',
                    'terms'     => $inspiry_options[ 'inspiry_home_properties_statuses' ]
                );
            }

            // Types
            if( !empty( $inspiry_options[ 'inspiry_home_properties_types' ] ) ) {
                $tax_query[] = array(
                    'taxonomy'  => 'property-type',
                    'field'     => 'term_id',
                    'terms'     => $inspiry_options[ 'inspiry_home_properties_types' ]
                );
            }

            $tax_count = count( $tax_query );

            // Add relation
            if( $tax_count > 1 ){
                $tax_query['relation'] = 'AND';
            }

            // Add taxonomy query to main query
            if( $tax_count > 0 ){
                $properties_query_args['tax_query'] = $tax_query;
            }

        }

        return $properties_query_args;
    }

    add_filter( 'inspiry_home_properties', 'inspiry_home_properties_filter' );
}



if( !function_exists( 'inspiry_mortgage_calculator_amount' ) ) :
    /**
     * Function to pass property price value to mortgage calculator
     */
    function inspiry_mortgage_calculator_amount( $mortgage_amount ) {
        if ( is_singular( 'property' ) ) {
            global $post;
            /* get property price */
            $price_digits = doubleval( get_post_meta( $post->ID, 'REAL_HOMES_property_price', true ) );
            if ( $price_digits ) {
                return $price_digits;
            }
        }
        return $mortgage_amount;
    }
    add_filter( 'mc_total_amount', 'inspiry_mortgage_calculator_amount' );
endif;
