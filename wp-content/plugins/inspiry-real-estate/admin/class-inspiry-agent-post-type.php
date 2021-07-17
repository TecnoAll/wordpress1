<?php
/**
 * Agent custom post type class.
 *
 * Defines the agent post type.
 *
 * @package    Inspiry_Real_Estate
 * @subpackage Inspiry_Real_Estate/admin
 * @author     M Saqib Sarwar <saqib@inspirythemes.com>
 */

class Inspiry_Agent_Post_Type {

    /**
     * Register Agent Post Type
     * @since 1.0.0
     */
    public function register_agent_post_type() {

        $labels = array(
            'name'                => _x( 'Agents', 'Post Type General Name', 'inspiry-real-estate' ),
            'singular_name'       => _x( 'Agent', 'Post Type Singular Name', 'inspiry-real-estate' ),
            'menu_name'           => esc_html__( 'Agents', 'inspiry-real-estate' ),
            'name_admin_bar'      => esc_html__( 'Agent', 'inspiry-real-estate' ),
            'parent_item_colon'   => esc_html__( 'Parent Agent:', 'inspiry-real-estate' ),
            'all_items'           => esc_html__( 'All Agents', 'inspiry-real-estate' ),
            'add_new_item'        => esc_html__( 'Add New Agent', 'inspiry-real-estate' ),
            'add_new'             => esc_html__( 'Add New', 'inspiry-real-estate' ),
            'new_item'            => esc_html__( 'New Agent', 'inspiry-real-estate' ),
            'edit_item'           => esc_html__( 'Edit Agent', 'inspiry-real-estate' ),
            'update_item'         => esc_html__( 'Update Agent', 'inspiry-real-estate' ),
            'view_item'           => esc_html__( 'View Agent', 'inspiry-real-estate' ),
            'search_items'        => esc_html__( 'Search Agent', 'inspiry-real-estate' ),
            'not_found'           => esc_html__( 'Not found', 'inspiry-real-estate' ),
            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'inspiry-real-estate' ),
        );

        $rewrite = array(
            'slug'                => apply_filters( 'inspiry_agent_slug', esc_html__( 'agent', 'inspiry-real-estate' ) ),
            'with_front'          => true,
            'pages'               => true,
            'feeds'               => false,
        );

        $args = array(
            'label'               => esc_html__( 'agent', 'inspiry-real-estate' ),
            'description'         => esc_html__( 'Real Estate Agent', 'inspiry-real-estate' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-businessman',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'show_in_rest'        => true,
            'rest_base'           => apply_filters( 'inspiry_agent_rest_base', esc_html__( 'agents', 'framework' ) ),
            'capability_type'     => 'post',
        );

        register_post_type( 'agent', $args );

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
            "email"     => esc_html__( 'Email', 'inspiry-real-estate' ),
            "mobile"    => esc_html__( 'Mobile', 'inspiry-real-estate'),
        );

        $last_columns = array();

        if ( count( $defaults ) > 2 ) {
            $last_columns = array_splice( $defaults, 2, 1 );
        }

        $defaults = array_merge( $defaults, $new_columns );
        $defaults = array_merge( $defaults, $last_columns );

        return $defaults;
    }

    /**
     * Display custom column for agents
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
                    ?>
                    <a href="<?php the_permalink(); ?>" target="_blank">
                        <?php the_post_thumbnail( array( 130, 130 ) );?>
                    </a>
                    <?php
                } else {
                    _e ( 'No Image', 'inspiry-real-estate' );
                }
                break;

            case 'email':
                $agent_email = is_email( get_post_meta ( $post->ID, 'REAL_HOMES_agent_email', true ) );
                if ( $agent_email ) {
                    echo esc_html( $agent_email );
                } else {
	                esc_html_e ( 'NA', 'inspiry-real-estate' );
                }
                break;

            case 'mobile':
                $mobile_number = get_post_meta ( $post->ID, 'REAL_HOMES_mobile_number', true );
                if ( !empty( $mobile_number ) ) {
                    echo esc_html( $mobile_number );
                } else {
	                esc_html_e ( 'NA', 'inspiry-real-estate' );
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

        // Agent Meta Box
        $meta_boxes[] = array(
            'id'        => 'agent-meta-box',
            'title'     => esc_html__('Contact Details', 'inspiry-real-estate'),
            'pages'     => array( 'agent' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'fields'    => array(
                array(
                    'name'  => esc_html__( 'Job Title', 'inspiry-real-estate' ),
                    'id'    => "inspiry_job_title",
                    'type'  => 'text',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__( 'Email Address', 'inspiry-real-estate' ),
                    'id'    => "{$prefix}agent_email",
                    'desc'  => esc_html__( "Agent related messages from contact form on property details page, will be sent on this email address.", "inspiry-real-estate" ),
                    'type'  => 'email',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__( 'Mobile Number', 'inspiry-real-estate' ),
                    'id'    => "{$prefix}mobile_number",
                    'type'  => 'text',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__('Office Number', 'inspiry-real-estate'),
                    'id'    => "{$prefix}office_number",
                    'type'  => 'text',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__('Fax Number', 'inspiry-real-estate'),
                    'id'    => "{$prefix}fax_number",
                    'type'  => 'text',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__( 'Office Address', 'inspiry-real-estate' ),
                    'id'    => "inspiry_office_address",
                    'type'  => 'text',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__('Facebook URL', 'inspiry-real-estate'),
                    'id'    => "{$prefix}facebook_url",
                    'type'  => 'url',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__('Twitter URL', 'inspiry-real-estate'),
                    'id'    => "{$prefix}twitter_url",
                    'type'  => 'url',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__('LinkedIn URL', 'inspiry-real-estate'),
                    'id'    => "{$prefix}linked_in_url",
                    'type'  => 'text',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__('Pinterest URL', 'inspiry-real-estate'),
                    'id'    => "inspiry_pinterest_url",
                    'type'  => 'url',
                    'columns' => 6,
                ),
                array(
                    'name'  => esc_html__('Instagram URL', 'inspiry-real-estate'),
                    'id'    => "inspiry_instagram_url",
                    'type'  => 'url',
                    'columns' => 6,
                )

            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters( 'agent_meta_boxes', $meta_boxes );

        return $meta_boxes;

    }

}