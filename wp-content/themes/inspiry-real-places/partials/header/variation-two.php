<header class="site-header header header-variation-two">

    <div class="container">

        <div class="row zero-horizontal-margin">

            <div class="col-lg-2 zero-horizontal-padding">
                <?php get_template_part( 'partials/header/logo' ); ?>
            </div>
            <!-- .left-column -->

            <div class="col-lg-10 zero-horizontal-padding hidden-xs hidden-sm">

                <div class="header-top clearfix">
                    <?php
                    get_template_part( 'partials/header/social-networks' );
                    get_template_part( 'partials/header/user-nav' );
                    get_template_part( 'partials/header/currency-switcher' );
                    get_template_part( 'partials/header/contact-number' );
                    ?>
                </div>
                <!-- .header-top -->

                <div class="header-bottom clearfix">
                    <?php get_template_part( 'partials/header/menu' ); ?>
                </div>
                <!-- .header-bottom -->

            </div>
            <!-- .right-column -->

        </div>
        <!-- .row -->

    </div>
    <!-- .container -->

</header><!-- .site-header -->