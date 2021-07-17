<div class="breadcrumb-wrapper">
    <div class="container">
        <?php
        global $post;
        $inspiry_breadcrumbs_items = inspiry_get_breadcrumbs_items( $post->ID, 'property-type' );
        if ( is_array( $inspiry_breadcrumbs_items ) && ( 0 < count( $inspiry_breadcrumbs_items ) ) ) {
            ?>
            <nav>
                <ol class="breadcrumb">
                <?php
                foreach( $inspiry_breadcrumbs_items as $item ) :
                    $class = ( !empty( $item['class'] ) ) ? $item['class'] : '';
                    if ( !empty ( $item['url'] ) ) :
                        ?>
                        <li class="<?php echo esc_attr( $class ); ?>">
                            <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['name'] ); ?></a>
                        </li>
                        <?php
                    else :
                        ?><li class="<?php echo esc_attr( $class ); ?>"><?php echo esc_html( $item['name'] ); ?></li><?php
                    endif;
                endforeach;
                ?>
                </ol>
            </nav>
            <?php
        }
        ?>
    </div>
</div><!-- .breadcrumb-wrapper -->