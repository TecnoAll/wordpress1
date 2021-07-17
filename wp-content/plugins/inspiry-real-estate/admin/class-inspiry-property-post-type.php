<?php
/**
 * Property custom post type class.
 *
 * Defines the property post type.
 *
 * @package    Inspiry_Real_Estate
 * @subpackage Inspiry_Real_Estate/admin
 * @author     M Saqib Sarwar <saqib@inspirythemes.com>
 */

class Inspiry_Property_Post_Type {

    /**
     * Register Property Post Type
     * @since 1.0.0
     */
    public function register_property_post_type() {

        $labels = array(
            'name'                => _x( 'Properties', 'Post Type General Name', 'inspiry-real-estate' ),
            'singular_name'       => _x( 'Property', 'Post Type Singular Name', 'inspiry-real-estate' ),
            'menu_name'           => esc_html__( 'Properties', 'inspiry-real-estate' ),
            'name_admin_bar'      => esc_html__( 'Property', 'inspiry-real-estate' ),
            'parent_item_colon'   => esc_html__( 'Parent Property:', 'inspiry-real-estate' ),
            'all_items'           => esc_html__( 'All Properties', 'inspiry-real-estate' ),
            'add_new_item'        => esc_html__( 'Add New Property', 'inspiry-real-estate' ),
            'add_new'             => esc_html__( 'Add New', 'inspiry-real-estate' ),
            'new_item'            => esc_html__( 'New Property', 'inspiry-real-estate' ),
            'edit_item'           => esc_html__( 'Edit Property', 'inspiry-real-estate' ),
            'update_item'         => esc_html__( 'Update Property', 'inspiry-real-estate' ),
            'view_item'           => esc_html__( 'View Property', 'inspiry-real-estate' ),
            'search_items'        => esc_html__( 'Search Property', 'inspiry-real-estate' ),
            'not_found'           => esc_html__( 'Not found', 'inspiry-real-estate' ),
            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'inspiry-real-estate' ),
        );

        $rewrite = array(
            'slug'                => apply_filters( 'inspiry_property_slug', esc_html__( 'property', 'inspiry-real-estate' ) ),
            'with_front'          => true,
            'pages'               => true,
            'feeds'               => true,
        );

        $args = array(
            'label'               => esc_html__( 'property', 'inspiry-real-estate' ),
            'description'         => esc_html__( 'Real Estate Property', 'inspiry-real-estate' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes', 'comments' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-building',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'show_in_rest'        => true,
            'rest_base'           => apply_filters( 'inspiry_property_rest_base', esc_html__( 'properties', 'framework' ) ),
            'capability_type'     => 'post',
        );

        register_post_type( 'property', $args );

    }

    /**
     * Register Property Type Taxonomy
     * @since 1.0.0
     */
    public function register_property_type_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Property Type', 'Taxonomy General Name', 'inspiry-real-estate' ),
            'singular_name'              => _x( 'Property Type', 'Taxonomy Singular Name', 'inspiry-real-estate' ),
            'menu_name'                  => esc_html__( 'Types', 'inspiry-real-estate' ),
            'all_items'                  => esc_html__( 'All Property Types', 'inspiry-real-estate' ),
            'parent_item'                => esc_html__( 'Parent Property Type', 'inspiry-real-estate' ),
            'parent_item_colon'          => esc_html__( 'Parent Property Type:', 'inspiry-real-estate' ),
            'new_item_name'              => esc_html__( 'New Property Type Name', 'inspiry-real-estate' ),
            'add_new_item'               => esc_html__( 'Add New Property Type', 'inspiry-real-estate' ),
            'edit_item'                  => esc_html__( 'Edit Property Type', 'inspiry-real-estate' ),
            'update_item'                => esc_html__( 'Update Property Type', 'inspiry-real-estate' ),
            'view_item'                  => esc_html__( 'View Property Type', 'inspiry-real-estate' ),
            'separate_items_with_commas' => esc_html__( 'Separate Property Types with commas', 'inspiry-real-estate' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Property Types', 'inspiry-real-estate' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-real-estate' ),
            'popular_items'              => esc_html__( 'Popular Property Types', 'inspiry-real-estate' ),
            'search_items'               => esc_html__( 'Search Property Types', 'inspiry-real-estate' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-real-estate' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_property_type_slug', esc_html__( 'property-type', 'inspiry-real-estate' ) ),
            'with_front'                 => true,
            'hierarchical'               => true,
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
            'rest_base'                  => apply_filters( 'inspiry_property_type_rest_base', esc_html__( 'property-types', 'framework' ) ),
        );

        register_taxonomy( 'property-type', array( 'property' ), $args );

    }

    /**
     * Register Property Status Taxonomy
     * @since 1.0.0
     */
    public function register_property_status_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Property Status', 'Taxonomy General Name', 'inspiry-real-estate' ),
            'singular_name'              => _x( 'Property Status', 'Taxonomy Singular Name', 'inspiry-real-estate' ),
            'menu_name'                  => esc_html__( 'Statuses', 'inspiry-real-estate' ),
            'all_items'                  => esc_html__( 'All Property Statuses', 'inspiry-real-estate' ),
            'parent_item'                => esc_html__( 'Parent Property Status', 'inspiry-real-estate' ),
            'parent_item_colon'          => esc_html__( 'Parent Property Status:', 'inspiry-real-estate' ),
            'new_item_name'              => esc_html__( 'New Property Status Name', 'inspiry-real-estate' ),
            'add_new_item'               => esc_html__( 'Add New Property Status', 'inspiry-real-estate' ),
            'edit_item'                  => esc_html__( 'Edit Property Status', 'inspiry-real-estate' ),
            'update_item'                => esc_html__( 'Update Property Status', 'inspiry-real-estate' ),
            'view_item'                  => esc_html__( 'View Property Status', 'inspiry-real-estate' ),
            'separate_items_with_commas' => esc_html__( 'Separate Property Statuses with commas', 'inspiry-real-estate' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Property Statuses', 'inspiry-real-estate' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-real-estate' ),
            'popular_items'              => esc_html__( 'Popular Property Statuses', 'inspiry-real-estate' ),
            'search_items'               => esc_html__( 'Search Property Statuses', 'inspiry-real-estate' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-real-estate' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_property_status_slug', esc_html__( 'property-status', 'inspiry-real-estate' ) ),
            'with_front'                 => true,
            'hierarchical'               => true,
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
            'rest_base'                  => apply_filters( 'inspiry_property_status_rest_base', esc_html__( 'property-statuses', 'framework' ) ),
        );

        register_taxonomy( 'property-status', array( 'property' ), $args );

    }

    /**
     * Register Property City Taxonomy
     * @since 1.0.0
     */
    public function register_property_city_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Property City', 'Taxonomy General Name', 'inspiry-real-estate' ),
            'singular_name'              => _x( 'Property City', 'Taxonomy Singular Name', 'inspiry-real-estate' ),
            'menu_name'                  => esc_html__( 'Locations', 'inspiry-real-estate' ),
            'all_items'                  => esc_html__( 'All Property Cities', 'inspiry-real-estate' ),
            'parent_item'                => esc_html__( 'Parent Property City', 'inspiry-real-estate' ),
            'parent_item_colon'          => esc_html__( 'Parent Property City:', 'inspiry-real-estate' ),
            'new_item_name'              => esc_html__( 'New Property City Name', 'inspiry-real-estate' ),
            'add_new_item'               => esc_html__( 'Add New Property City', 'inspiry-real-estate' ),
            'edit_item'                  => esc_html__( 'Edit Property City', 'inspiry-real-estate' ),
            'update_item'                => esc_html__( 'Update Property City', 'inspiry-real-estate' ),
            'view_item'                  => esc_html__( 'View Property City', 'inspiry-real-estate' ),
            'separate_items_with_commas' => esc_html__( 'Separate Property Cities with commas', 'inspiry-real-estate' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Property Cities', 'inspiry-real-estate' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-real-estate' ),
            'popular_items'              => esc_html__( 'Popular Property Cities', 'inspiry-real-estate' ),
            'search_items'               => esc_html__( 'Search Property Cities', 'inspiry-real-estate' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-real-estate' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_property_city_slug', esc_html__( 'property-city', 'inspiry-real-estate' ) ),
            'with_front'                 => true,
            'hierarchical'               => true,
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
            'rest_base'                  => apply_filters( 'inspiry_property_city_rest_base', esc_html__( 'property-cities', 'framework' ) ),
        );

        register_taxonomy( 'property-city', array( 'property' ), $args );

    }

    /**
     * Register Property Feature Taxonomy
     * @since 1.0.0
     */
    public function register_property_feature_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Property Features', 'Taxonomy General Name', 'inspiry-real-estate' ),
            'singular_name'              => _x( 'Property Feature', 'Taxonomy Singular Name', 'inspiry-real-estate' ),
            'menu_name'                  => esc_html__( 'Features', 'inspiry-real-estate' ),
            'all_items'                  => esc_html__( 'All Property Features', 'inspiry-real-estate' ),
            'parent_item'                => esc_html__( 'Parent Property Feature', 'inspiry-real-estate' ),
            'parent_item_colon'          => esc_html__( 'Parent Property Feature:', 'inspiry-real-estate' ),
            'new_item_name'              => esc_html__( 'New Property Feature Name', 'inspiry-real-estate' ),
            'add_new_item'               => esc_html__( 'Add New Property Feature', 'inspiry-real-estate' ),
            'edit_item'                  => esc_html__( 'Edit Property Feature', 'inspiry-real-estate' ),
            'update_item'                => esc_html__( 'Update Property Feature', 'inspiry-real-estate' ),
            'view_item'                  => esc_html__( 'View Property Feature', 'inspiry-real-estate' ),
            'separate_items_with_commas' => esc_html__( 'Separate Property Features with commas', 'inspiry-real-estate' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Property Features', 'inspiry-real-estate' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-real-estate' ),
            'popular_items'              => esc_html__( 'Popular Property Features', 'inspiry-real-estate' ),
            'search_items'               => esc_html__( 'Search Property Features', 'inspiry-real-estate' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-real-estate' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_property_feature_slug', esc_html__( 'property-feature', 'inspiry-real-estate' ) ),
            'with_front'                 => true,
            'hierarchical'               => true,
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => false,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
            'rest_base'                  => apply_filters( 'inspiry_property_feature_rest_base', esc_html__( 'property-features', 'framework' ) ),
        );

        register_taxonomy( 'property-feature', array( 'property' ), $args );

    }


    /**
     * Register custom columns
     *
     * @param   array   $defaults
     * @since   1.0.0
     * @return  array   $defaults
     */
    public function register_custom_column_titles ( $defaults ) {

        $new_columns = array(
            "thumb"     => esc_html__( 'Photo', 'inspiry-real-estate' ),
            "id"        => esc_html__( 'Custom ID', 'inspiry-real-estate' ),
            "price"     => esc_html__( 'Price', 'inspiry-real-estate'),
        );

        $last_columns = array();

        if ( count( $defaults ) > 5 ) {

	        /* Remove Author */
            unset( $defaults['author'] );

	        /* Remove Comments */
            unset( $defaults['comments'] );

	        /* get last 4 columns Type, Status, Location and Date */
            $last_columns = array_splice( $defaults, -4, 4 );

            /* Simplify column titles */
	        $last_columns[ 'taxonomy-property-type' ]   = esc_html__( 'Type', 'inspiry-real-estate' );
	        $last_columns[ 'taxonomy-property-status' ] = esc_html__( 'Status', 'inspiry-real-estate' );
	        $last_columns[ 'taxonomy-property-city' ]   = esc_html__( 'Location', 'inspiry-real-estate' );

        }

        $defaults = array_merge( $defaults, $new_columns );
        $defaults = array_merge( $defaults, $last_columns );

        return $defaults;
    }

    /**
     * Display custom column for properties
     *
     * @access  public
     * @param   string $column_name
     * @since   1.0.0
     * @return  void
     */
    public function display_custom_column ( $column_name ) {
        global $post;

        switch ( $column_name ) {

            case 'thumb':
                if ( has_post_thumbnail ( $post->ID ) ) {
                    ?><a href="<?php the_permalink(); ?>" target="_blank"><?php the_post_thumbnail( array( 130, 130 ) );?></a><?php
                } else {
                    _e ( 'No Image', 'inspiry-real-estate' );
                }
                break;

            case 'id':
                $property_id = get_post_meta ( $post->ID, 'REAL_HOMES_property_id', true );
                if( ! empty ( $property_id ) ) {
                    echo esc_html( $property_id );
                } else {
	                esc_html_e ( 'NA', 'inspiry-real-estate' );
                }
                break;

            case 'price':
                $property_price = get_post_meta ( $post->ID, 'REAL_HOMES_property_price', true );
                if ( !empty ( $property_price ) ) {
                    $price_amount = doubleval( $property_price );
                    $price_postfix = get_post_meta ( $post->ID, 'REAL_HOMES_property_price_postfix', true );
                    echo Inspiry_Property::format_price( $price_amount, $price_postfix );
                } else {
                    _e ( 'NA', 'inspiry-real-estate' );
                }
                break;

            default:
                break;
        }
    }

    /**
     * Register meta boxes related to property post type
     *
     * @param   array   $meta_boxes
     * @since   1.0.0
     * @return  array   $meta_boxes
     */
    public function register_meta_boxes ( $meta_boxes ){

        $prefix = 'REAL_HOMES_';

        // Agents
        $agents_array = array( -1 => esc_html__( 'None', 'inspiry-real-estate' ) );
        $agents_posts = get_posts( array (
            'post_type' => 'agent',
            'posts_per_page' => -1,
            'suppress_filters' => 0,
            ) );
        if ( ! empty ( $agents_posts ) ) {
            foreach ( $agents_posts as $agent_post ) {
                $agents_array[ $agent_post->ID ] = $agent_post->post_title;
            }
        }

        // Property Details Meta Box
        $default_desc = esc_html__( 'Consult theme documentation for required image size.', 'inspiry-real-estate' );
        $gallery_images_desc = apply_filters( 'inspiry_gallery_description', $default_desc );
        $video_image_desc = apply_filters( 'inspiry_video_description', $default_desc );
        $slider_image_desc = apply_filters( 'inspiry_slider_description', $default_desc );
        $inspiry_map_option          = get_option( 'inspiry_map_option' );
        $meta_boxes[] = array(
            'id' => 'property-meta-box',
            'title' => esc_html__('Property', 'inspiry-real-estate'),
            'pages' => array('property'),
            'tabs' => array(
                'details' => array(
                    'label' => esc_html__('Basic Information', 'inspiry-real-estate'),
                    'icon' => 'dashicons-admin-home',
                ),
                'gallery' => array(
                    'label' => esc_html__('Gallery Images', 'inspiry-real-estate'),
                    'icon' => 'dashicons-format-gallery',
                ),
	            'floor-plans' => array(
		            'label' => esc_html__('Floor Plans', 'inspiry-real-estate'),
		            'icon' => 'dashicons-layout',
	            ),
                'video' => array(
                    'label' => esc_html__('Property Video', 'inspiry-real-estate'),
                    'icon' => 'dashicons-format-video',
                ),
                'agent' => array(
                    'label' => esc_html__('Agent Information', 'inspiry-real-estate'),
                    'icon' => 'dashicons-businessman',
                ),
                'misc' => array(
                    'label' => esc_html__('Misc', 'inspiry-real-estate'),
                    'icon' => 'dashicons-lightbulb',
                ),
                'home-slider' => array(
                    'label' => esc_html__('Homepage Slider', 'inspiry-real-estate'),
                    'icon' => 'dashicons-images-alt',
                ),
                'banner' => array(
                    'label' => esc_html__('Top Banner', 'inspiry-real-estate'),
                    'icon' => 'dashicons-format-image',
                ),
            ),
            'tab_style' => 'left',
            'fields' => array(

                // Details
                array(
                    'id' => "{$prefix}property_price",
                    'name' => esc_html__('Sale or Rent Price ( Only digits )', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example Value: 435000', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_price_postfix",
                    'name' => esc_html__('Price Postfix', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example Value: Per Month', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_size",
                    'name' => esc_html__('Area Size ( Only digits )', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example Value: 2500', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_size_postfix",
                    'name' => esc_html__('Size Postfix', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example Value: Sq Ft', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_bedrooms",
                    'name' => esc_html__('Bedrooms', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example Value: 4', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_bathrooms",
                    'name' => esc_html__('Bathrooms', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example Value: 2', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_garage",
                    'name' => esc_html__('Garages', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example Value: 1', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_id",
                    'name' => esc_html__('Property ID', 'inspiry-real-estate'),
                    'desc' => esc_html__('It will help you search a property directly.', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),

                array(
                    'id' => "{$prefix}property_year_built",
                    'name' => esc_html__('Year Built', 'inspiry-real-estate'),
                    'desc' => esc_html__('Example value: 2019', 'inspiry-real-estate'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),

                // Map
                array(
                    'type' => 'divider',
                    'columns' => 12,
                    'id' => 'google_map_divider', // Not used, but needed
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_address",
                    'name' => esc_html__('Property Address', 'inspiry-real-estate'),
                    'desc' => esc_html__('Leaving it empty will hide the google map on property detail page.', 'inspiry-real-estate'),
                    'type' => 'text',
                    // 'std' => 'Miami, FL, USA',
                    'columns' => 12,
                    'std' => isset( $inspiry_map_option['property_submit_default_address'] ) ? $inspiry_map_option['property_submit_default_address'] : '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}property_location",
                    'name' => esc_html__('Property Location at Google Map*', 'inspiry-real-estate'),
                    'desc' => esc_html__('Drag the google map marker to point your property location. You can also use the address field above to search for your property.', 'inspiry-real-estate'),
                    'type' => (inspiry_has_google_maps_api_key() ? 'map' : 'osm'),
                    'api_key' => (inspiry_has_google_maps_api_key() ?  $inspiry_map_option['inspiry_google_map_api_key'] : ''),
                    'std' => isset( $inspiry_map_option['property_submit_default_location'] ) ? $inspiry_map_option['property_submit_default_location'] : '25.7308309,-80.444149' ,   // 'latitude,longitude[,zoom]' (zoom is optional)
                    'style' => 'width: 95%; height: 400px',
                    'address_field' => "{$prefix}property_address",
                    'columns' => 12,
                    'tab' => 'details',
                ),

                array(
                    'name' => esc_html__('Property Gallery Images', 'inspiry-real-estate'),
                    'id' => "{$prefix}property_images",
                    'desc' => $gallery_images_desc,
                    'type' => 'image_advanced',
                    'max_file_uploads' => 48,
                    'columns' => 12,
                    'tab' => 'gallery',
                ),

                // Floor Plans
                array(
                    'id'    => "inspiry_floor_plans",
                    'type'  => 'group',
                    'columns' => 12,
                    'clone' => true,
                    'tab'   => 'floor-plans',
                    'fields' => array(
                        array(
                            'name' => esc_html__( 'Floor Name', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_name",
                            'desc' => esc_html__( 'Example: Ground Floor', 'inspiry-real-estate' ),
                            'type' => 'text',
                        ),
                        array(
                            'name' => esc_html__( 'Floor Price ( Only digits )', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_price",
                            'desc' => esc_html__( 'Example: 4000', 'inspiry-real-estate' ),
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Price Postfix', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_price_postfix",
                            'desc' => esc_html__( 'Example: Per Month', 'inspiry-real-estate' ),
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Floor Size ( Only digits )', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_size",
                            'desc' => esc_html__( 'Example: 2500', 'inspiry-real-estate' ),
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Size Postfix', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_size_postfix",
                            'desc' => esc_html__( 'Example: Sq Ft', 'inspiry-real-estate' ),
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Bedrooms', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_bedrooms",
                            'desc' => esc_html__( 'Example: 4', 'inspiry-real-estate' ),
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Bathrooms', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_bathrooms",
                            'desc' => esc_html__( 'Example: 2', 'inspiry-real-estate' ),
                            'type' => 'text',
                            'columns' => 6,
                        ),
                        array(
                            'name' => esc_html__( 'Description', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_descr",
                            'type' => 'textarea',
                        ),
                        array(
                            'name' => esc_html__( 'Floor Plan Image', 'inspiry-real-estate' ),
                            'id'   => "inspiry_floor_plan_image",
                            'desc' => esc_html__( 'The recommended minimum width is 700px and height is flexible.', 'inspiry-real-estate' ),
                            'type' => 'file_input',
                            'max_file_uploads' => 1,
                        ),
                    ),
                ),

                // Property Video
                array(
                    'id' => "{$prefix}tour_video_url",
                    'name' => esc_html__('Property Video URL', 'inspiry-real-estate'),
                    'desc' => esc_html__('Provide property video URL. YouTube, Vimeo, SWF File and MOV File are supported', 'inspiry-real-estate'),
                    'type' => 'text',
                    'columns' => 12,
                    'tab' => 'video',
                ),
                array(
                    'name' => esc_html__('Property Video Image', 'inspiry-real-estate'),
                    'id' => "{$prefix}tour_video_image",
                    'desc' => $video_image_desc,
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'video',
                ),

                array(
                    'id' => "{$prefix}360_virtual_tour",
                    'name' => esc_html__('Virtual Tour 360 Embed Code', 'inspiry-real-estate'),
                    'desc' => esc_html__('Provide iframe embed code for the 360 virtual tour.', 'inspiry-real-estate'),
                    'type' => 'textarea',
                    'sanitize_callback' => array($this, 'ire_sanitize_virtual_tour'),
                    'columns' => 12,
                    'tab' => 'video',
                ),

                // Agents
                array(
                    'name' => esc_html__('What to display in agent information box ?', 'inspiry-real-estate'),
                    'id' => "{$prefix}agent_display_option",
                    'type' => 'radio',
                    'std' => 'none',
                    'options' => array(
                        'my_profile_info' => esc_html__('Author information.', 'inspiry-real-estate'),
                        'agent_info' => esc_html__('Agent Information. ( Select the agent below )', 'inspiry-real-estate'),
                        'none' => esc_html__('None. ( Hide information box )', 'inspiry-real-estate'),
                    ),
                    'columns' => 12,
                    'tab' => 'agent',
                    'inline' => false,
                ),
                array(
                    'name' => esc_html__('Agent', 'inspiry-real-estate'),
                    'id' => "{$prefix}agents",
                    'type' => 'select',
                    'options' => $agents_array,
	                'multiple' => true,
                    'select_all_none' => true,
                    'columns' => 12,
                    'tab' => 'agent',
                ),

                // Misc
                array(
                    'name' => esc_html__('Mark this property as featured ?', 'inspiry-real-estate'),
                    'id' => "{$prefix}featured",
                    'type' => 'radio',
                    'std' => 0,
                    'options' => array(
                        1 => esc_html__('Yes ', 'inspiry-real-estate'),
                        0 => esc_html__('No', 'inspiry-real-estate')
                    ),
                    'columns' => 12,
                    'tab' => 'misc',
                    'inline' => false,
                ),
				
                array(
                    'id' => "{$prefix}attachments",
                    'name' => esc_html__('Attachments', 'inspiry-real-estate'),
                    'desc' => esc_html__('You can attach PDF files, Map images OR other documents to provide further details related to property.', 'inspiry-real-estate'),
                    'type' => 'file_advanced',
                    'mime_type' => '',
                    'columns' => 12,
                    'tab' => 'misc',
                ),
                array(
                    'id' => "{$prefix}property_private_note",
                    'name' => esc_html__('Private Note', 'inspiry-real-estate'),
                    'desc' => esc_html__('In this textarea, You can write your private note about this property. This field will not be displayed anywhere else.', 'inspiry-real-estate'),
                    'type' => 'textarea',
                    'std' => "",
                    'columns' => 12,
                    'tab' => 'misc',
                ),

                // Homepage Slider
                array(
                    'name' => esc_html__('Do you want to add this property in Homepage Slider ?', 'inspiry-real-estate'),
                    'desc' => esc_html__('If Yes, Then you need to provide a slider image below.', 'inspiry-real-estate'),
                    'id' => "{$prefix}add_in_slider",
                    'type' => 'radio',
                    'std' => 'no',
                    'options' => array(
                        'yes' => esc_html__('Yes ', 'inspiry-real-estate'),
                        'no' => esc_html__('No', 'inspiry-real-estate')
                    ),
                    'columns' => 12,
                    'tab' => 'home-slider',
                    'inline' => false,
                ),
                array(
                    'name' => esc_html__('Slider Image', 'inspiry-real-estate'),
                    'id' => "{$prefix}slider_image",
                    'desc' => $slider_image_desc,
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'home-slider',
                ),

                // Top Banner
                array(
                    'name' => esc_html__('Top Banner Image', 'inspiry-real-estate'),
                    'id' => "{$prefix}page_banner_image",
                    'desc' => esc_html__('Upload the banner image, If you want to change it for this property. Otherwise default banner image uploaded from theme options will be displayed. Image should have minimum width of 2000px and minimum height of 230px.', 'inspiry-real-estate'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'banner',
                )

            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters( 'property_meta_boxes', $meta_boxes );

        return $meta_boxes;
    }


    /*
     * Add meta box to display payment information
     =============================================== */

    /**
     * Add payment meta box
     */
    function add_payment_meta_box() {
        add_meta_box( 'payment-meta-box', esc_html__( 'Payment Information', 'inspiry-real-estate' ), array( $this, 'display_payment_info' ), 'property', 'normal', 'default' );
    }

    /**
     * Display payment information
     * @param $post
     */
    function display_payment_info( $post ) {

        $values = get_post_custom( $post->ID );
        $not_available  = esc_html__( 'Not Available', 'inspiry-real-estate' );

        $txn_id             = isset( $values['txn_id'] ) ? esc_attr( $values['txn_id'][0] ) : $not_available;
        $payment_date       = isset( $values['payment_date'] ) ? esc_attr( $values['payment_date'][0] ) : $not_available;
        $payer_email        = isset( $values['payer_email'] ) ? esc_attr( $values['payer_email'][0] ) : $not_available;
        $first_name         = isset( $values['first_name'] ) ? esc_attr( $values['first_name'][0] ) : $not_available;
        $last_name          = isset( $values['last_name'] ) ? esc_attr( $values['last_name'][0] ) : $not_available;
        $payment_status     = isset( $values['payment_status'] ) ? esc_attr( $values['payment_status'][0] ) : $not_available;
        $payment_gross      = isset( $values['payment_gross'] ) ? esc_attr( $values['payment_gross'][0] ) : $not_available;
        $payment_currency   = isset( $values['mc_currency'] ) ? esc_attr( $values['mc_currency'][0] ) : $not_available;

        ?>
        <table style="width:100%;">
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e( 'Transaction ID', 'inspiry-real-estate' );?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $txn_id ); ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e( 'Payment Date', 'inspiry-real-estate' );?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $payment_date ); ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e( 'First Name', 'inspiry-real-estate' );?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $first_name ); ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e( 'Last Name', 'inspiry-real-estate' );?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $last_name ); ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e( 'Payer Email', 'inspiry-real-estate' );?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $payer_email ); ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e('Payment Status','inspiry-real-estate');?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $payment_status ); ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e( 'Payment Amount', 'inspiry-real-estate' );?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $payment_gross ); ?></td>
            </tr>
            <tr>
                <td style="width:25%; vertical-align: top;"><strong><?php esc_html_e( 'Payment Currency', 'inspiry-real-estate' );?></strong></td>
                <td style="width:75%;"><?php echo esc_html( $payment_currency ); ?></td>
            </tr>
        </table>
        <?php
    }


    /*
     * Property custom ID search support for properties index page on admin side
     ============================================================================= */

    /**
     * Check if current page is properties index page on admin side
     * @return bool
     */
    public function is_properties_index_page() {
        global $pagenow;
        return ( is_admin() && $pagenow == 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'property' && isset($_GET['s']) );
    }


    /**
     * Joins post meta table with posts table for search purpose
     * @param $join
     * @return string
     */
    public function join_post_meta_table( $join ) {
        global $wpdb;
        if ( $this->is_properties_index_page() ) {
            $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
        }
        return $join;
    }


    /**
     * Add property custom id in search
     *
     * @param $where
     * @return mixed
     */
    public function add_property_id_in_search( $where ) {
        global $wpdb;
        if ( $this->is_properties_index_page() ) {
            $where = preg_replace(
                "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_key = 'REAL_HOMES_property_id') AND (".$wpdb->postmeta.".meta_value LIKE $1)",
                $where );
        }
        return $where;
    }


    /**
     * Add group by properties support
     * @param $group_by
     * @return string
     */
    function group_by_properties( $group_by ) {
        global $wpdb;
        if ( $this->is_properties_index_page() ) {
            $group_by = "$wpdb->posts.ID";
        }
        return $group_by;
    }

    public function ire_sanitize_virtual_tour( $value ) {
        
        $allowed_tags[ 'iframe' ] = array(
            'src'             => array(),
            'height'          => array(),
            'width'           => array(),
            'frameborder'     => array(),
            'allowfullscreen' => array(),
            'allow'           => array(),
        );

        $sanitized_value = wp_kses( $value, $allowed_tags );
        
        return $sanitized_value;
    }

    /**
	 * Property type meta boxes declaration
	 *
	 * @param $meta_boxes
	 *
	 * @return array
	 */
	public function ire_property_type_meta_boxes( $meta_boxes ) {

		$meta_boxes[] = array(
			'title'      => esc_html__( 'Custom Property Type Map Icon', 'easy-real-estate' ),
			'taxonomies' => 'property-type',
			'fields'     => array(
				array(
					'name'             => esc_html__( 'Icon Image', 'easy-real-estate' ),
					'id'               => 'inspiry_property_type_icon',
					'type'             => 'image_advanced',
					'mime_type'        => 'image/png',
					'max_file_uploads' => 1,
				),
				array(
					'name'             => esc_html__( 'Retina Icon Image', 'easy-real-estate' ),
					'id'               => 'inspiry_property_type_icon_retina',
					'type'             => 'image_advanced',
					'mime_type'        => 'image/png',
					'max_file_uploads' => 1,
				),
			),
		);

		return $meta_boxes;
	}
}