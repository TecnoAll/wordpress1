<?php 
/*
* Description
*/
global $inspiry_options;
global $post;
?>
<article class="hentry clearfix">
	<div class="entry-content clearfix">
		<?php
		if ( ! empty( $post->post_content ) ) {
			if ( ! empty( $inspiry_options['inspiry_property_desc_title'] ) ) {
				?>
		<h4 class="fancy-title">
				<?php echo esc_html( $inspiry_options['inspiry_property_desc_title'] ); ?></h4>
				<?php
			}
			?>
		<div class="property-content"><?php the_content(); ?></div>
			<?php
		}
	?>
	</div>
</article>
