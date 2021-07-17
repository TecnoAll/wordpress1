<?php
/**
 * Homepage: Properties Varition 4
 *
 * @since 1.3.3
 */

global $inspiry_options;
?>

<div class="property-listing-four fade-in-up <?php echo inspiry_animation_class(); ?>">

    <div class="container">

		<?php
	        $number_of_properties = intval( $inspiry_options[ 'inspiry_home_properties_number_4' ] );
	        if ( empty( $number_of_properties ) ) {
	            $number_of_properties = 3;
	        }

	        $home_properties_args = array(
		        'post_type' 		=> 'property',
		        'posts_per_page'	=> $number_of_properties,
	        );

	        $home_properties_query = new WP_Query( apply_filters( 'inspiry_home_properties', $home_properties_args ) );

	        // Homepage Properties Loop
	        if ( $home_properties_query->have_posts() ) : ?>

	       		<div class="row property-wrapper">

	       			<?php
		                $properties_count = 1;
		                $columns_count = 3;

			        $clearfix_counter = 1;
		                while ( $home_properties_query->have_posts() ) :

		                	$home_properties_query->the_post();

                    		$home_property = new Inspiry_Property( get_the_ID() ); ?>

                    		<div class="col-xs-6 custom-col-xs-12 col-sm-6 col-md-4 <?php echo inspiry_col_animation_class( $columns_count, $properties_count ) .' '. inspiry_animation_class(); ?>">

								<article class="hentry property-listing-four-post image-transition">

									<div class="property-thumbnail">
										<?php
										inspiry_thumbnail( 'post-thumbnail' );
		                                $first_status_term = $home_property->get_taxonomy_first_term( 'property-status', 'all' );
		                                if ( $first_status_term ) {
		                                    ?>
		                                    <a href="<?php echo esc_url( get_term_link( $first_status_term ) ); ?>">
		                                        <span class="property-status <?php echo ( 'for-sale' == $first_status_term->slug ) ? 'for-sale' : $first_status_term->slug; ?>">
		                                        	<?php echo esc_html( $first_status_term->name ); ?>
		                                        </span>
		                                    </a>
		                                    <?php
		                                }
		                                ?>
									</div>
									<!-- /.property-thumbnail -->

									<div class="property-description">
										<h4 class="entry-title">
	                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_inspiry_custom_excerpt( get_the_title(), 9 ); ?></a>
	                                    </h4>
	                                    <div class="price-and-status">
	                                        <span class="price"><?php echo esc_html( $home_property->get_price() ); ?></span>
	                                    </div>
									</div>
									<!-- /.property-description -->

									<div class="property-meta clearfix">

										<?php
	                                    /*
	                                     * Area
	                                     */
	                                    $inspiry_property_area = $home_property->get_area();
	                                    if ( $inspiry_property_area ) {
	                                        ?>
	                                        <div class="meta-wrapper">
	                                        	<span class="meta-icon"><?php include( get_template_directory() . '/images/svg/icon-area-two.svg' ); ?></span>
	                                        	<span class="meta-unit"><?php echo esc_html( $home_property->get_area_postfix() ); ?></span>
	                                            <span class="meta-value"><?php echo esc_html( $inspiry_property_area ); ?></span>
	                                        </div>
	                                        <?php
	                                    }

	                                    /*
	                                     * Beds
	                                     */
	                                    $inspiry_property_beds = $home_property->get_beds();
	                                    if ( $inspiry_property_beds ) {
	                                        ?>
	                                        <div class="meta-wrapper">
	                                        	<span class="meta-icon"><?php include( get_template_directory() . '/images/svg/icon-bed-two.svg' ); ?></span>
	                                        	<span class="meta-label"><?php echo _n( 'Bedroom', 'Bedrooms', $inspiry_property_beds, 'inspiry' ); ?></span>
	                                            <span class="meta-value"><?php echo esc_html( $inspiry_property_beds ); ?></span>
	                                        </div>
	                                        <?php
	                                    }

	                                    /*
	                                    * Beds
	                                    */
	                                    $inspiry_property_baths = $home_property->get_baths();
	                                    if ( $inspiry_property_baths ) {
	                                        ?>
	                                        <div class="meta-wrapper">
	                                        	<span class="meta-icon"><?php include( get_template_directory() . '/images/svg/icon-shower.svg' ); ?></span>
	                                        	<span class="meta-label"><?php echo _n( 'Bathroom', 'Bathrooms', $inspiry_property_baths, 'inspiry' ); ?></span>
	                                            <span class="meta-value"><?php echo esc_html( $inspiry_property_baths ); ?></span>
	                                        </div>
	                                        <?php
	                                    }

	                                    /*
	                                    * Garages
	                                    */
	                                    $inspiry_property_garages = $home_property->get_garages();
	                                    if ( $inspiry_property_garages ) {
	                                        ?>
	                                        <div class="meta-wrapper">
	                                        	<span class="meta-icon"><?php include( get_template_directory() . '/images/svg/icon-garage-two.svg' ); ?></span>
	                                        	<span class="meta-label"><?php echo _n( 'Garage', 'Garages', $inspiry_property_garages, 'inspiry' ); ?></span>
	                                            <span class="meta-value"><?php echo esc_html( $inspiry_property_garages ); ?></span>
	                                        </div>
	                                        <?php
	                                    }
	                                    ?>

									</div>
									<!-- /.property-meta -->

								</article>
								<!-- /.property-listing-four-post -->

                    		</div>

			                <?php
			                if ( ( $clearfix_counter % 3 ) == 0 ) {
				                ?>
				                <div class="clearfix visible-md visible-lg"></div>
				                <?php
			                }
			                if ( ( $clearfix_counter % 2 ) == 0 ) {
				                ?>
				                <div class="clearfix visible-sm"></div>
				                <?php
			                }
			                $clearfix_counter++;
                    		$properties_count++;

                    	endwhile;
                    ?>

	       		</div>
	       		<!-- /.row -->

	       		<?php

	       	endif;

	       	wp_reset_postdata();

	    ?>

    </div>
    <!-- /.container -->

</div>
<!-- /.property-listing-four -->
