<?php
/*
 * Advance search widget
 */
if ( !class_exists('Inspiry_Property_Search_Widget') ) {

    class Inspiry_Property_Search_Widget extends WP_Widget {

        public function __construct () {
            $widget_ops = array ( 'classname' => 'Inspiry_Property_Search_Widget', 'description' => __ ( 'This widget displays properties search form.', 'inspiry-real-estate' ) );
            parent::__construct ( 'Inspiry_Property_Search_Widget', __ ( 'Inspiry Property Search', 'inspiry-real-estate' ), $widget_ops );
        }

        function widget ( $args, $instance ) {
            global $inspiry_options;
            extract ( $args );

            $title = apply_filters ( 'widget_title', $instance[ 'title' ] );

            if ( empty( $title ) ) {
                $title = false;
            }

            // custom before widget
            echo '<section class="widget widget-advance-search advance-search">';

            // custom title
            if ( $title ):
                echo '<h3 class="advance-search-widget-title"><i class="fa fa-search"></i>' . $title . '</h3>';
            endif;

            /*
             * Output search form if related theme options are configured properly
             */
            $search_fields = $inspiry_options[ 'inspiry_search_fields' ][ 'enabled' ];
            $search_page = $inspiry_options[ 'inspiry_search_page' ];

            if ( ( 0 < count ( $search_fields ) ) && ( ! empty( $search_page ) ) ) {

                // If WPML is installed then this function will return translated page id for current language against given page id
                $search_page = ire_wpml_translated_page_id ( $search_page );

                ?>
                <form class="advance-search-form" action="<?php echo get_permalink ( $search_page ); ?>" method="get">
                    <div class="row field-wrap">
                        <?php
                        foreach ( $search_fields as $key => $val ) {

                            switch ( $key ) {

                                case 'keyword':
	                                ire_get_template_part ( 'includes/widgets/fields/keyword' );
                                    break;

                                case 'location':
	                                ire_get_template_part ( 'includes/widgets/fields/locations' );
                                    break;

                                case 'status':
	                                ire_get_template_part ( 'includes/widgets/fields/property-status' );
                                    break;

                                case 'type':
	                                ire_get_template_part ( 'includes/widgets/fields/property-type' );
                                    break;

                                case 'min-beds':
	                                ire_get_template_part ( 'includes/widgets/fields/beds' );
                                    break;

                                case 'min-baths':
	                                ire_get_template_part ( 'includes/widgets/fields/baths' );
                                    break;

                                case 'min-max-price':
	                                ire_get_template_part ( 'includes/widgets/fields/min-price' );
	                                ire_get_template_part ( 'includes/widgets/fields/max-price' );
                                    break;

                                case 'min-max-area':
	                                ire_get_template_part ( 'includes/widgets/fields/min-area' );
	                                ire_get_template_part ( 'includes/widgets/fields/max-area' );
                                    break;

                                case 'property-id':
	                                ire_get_template_part ( 'includes/widgets/fields/property-id' );
                                    break;

                            }
                        }

                        // Submit Button
                        ire_get_template_part ( 'includes/widgets/fields/submit-btn' );

                        // generated sort by field
                        if ( isset( $_GET[ 'sortby' ] ) ) {
                            echo '<input type="hidden" name="sortby" value="' . $_GET[ 'sortby' ] . '" />';
                        }

                        ?>
                    </div>
                    <!-- .field-wrap -->
                    <?php

                    // Features
                    if ( $inspiry_options[ 'inspiry_search_features' ] ) {
	                    ire_get_template_part ( 'includes/widgets/fields/features' );
                    }

                    ?>
                </form><!-- .advance-search-form -->
            <?php
            }

            echo $after_widget;     // section closing tag
        }


        function form ( $instance ) {
            $instance = wp_parse_args ( (array) $instance, array ( 'title' => __ ( 'Find Your Home', 'inspiry-real-estate' ) ) );
            $title = esc_attr ( $instance[ 'title' ] );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id ( 'title' ) ); ?>"><?php _e ( 'Widget Title', 'inspiry-real-estate' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id ( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name ( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat"/>
            </p>
            <?php
        }

        function update ( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'title' ] = strip_tags ( $new_instance[ 'title' ] );
            return $instance;
        }

    } // class Inspiry_Property_Search_Widget
}



/**
 * Register property search widget
 */
function ire_register_property_search_widget() {
	register_widget( 'Inspiry_Property_Search_Widget' );
}
add_action( 'widgets_init', 'ire_register_property_search_widget' );