<div class="entry-meta blog-post-entry-meta">
    <?php
    printf(
        _x( 'By %s', 'author byline', 'inspiry' ),
        sprintf(
            '<a class="vcard author" href="%1$s"><span class="fn">%2$s</span></a>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html( get_the_author_meta( 'display_name' ) )
        )
    );

    echo ' '; esc_html_e( 'Posted in', 'inspiry' ); echo ' '; the_category( ', ' );
    echo ' '; esc_html_e( 'On ', 'inspiry' ); echo ' ';
    ?>
    <time class="entry-date published" datetime="<?php the_time( 'c' ); ?>"><?php the_time( 'M d, Y' ); ?></time>
</div>