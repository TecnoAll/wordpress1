(function ($) {
    "use strict";

    var $window = $(window),
        $body = $('body'),
        isRtl = $body.hasClass('rtl');

    /*-----------------------------------------------------------------------------------*/
    /* Advance Search Form
    /*-----------------------------------------------------------------------------------*/
    $('.advance-search-form #keyword-txt').keyup(function () {
        let input = $(this).val();
        $(this).val(input.replace(/[^a-zA-Z0-9 ]/g, ''));
    });

    $('.advance-search-form #property-id-txt').keyup(function () {
        let input = $(this).val();
        $(this).val(input.replace(/[^a-zA-Z0-9-_]/g, ''));
    });

    $('.advance-search-form #min-area, .advance-search-form #max-area').keyup(function () {
        let input = $(this).val();
        $(this).val(input.replace(/[^0-9]/g, ''));
    });

    /**
    * Disable empty values on submission to reduce query string size
    */
    $('.advance-search-form').submit(function (event) {
        var searchFormElements = $(this).find(':input');
        $.each(searchFormElements, function (index, element) {
            if (element.value == '' || element.value == 'any') {
                if (!element.disabled) {
                    element.disabled = true;
                }
            }
        });
    });
    
    /*-----------------------------------------------------------------------------------*/
    /* Sliders
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().flexslider) {
        var homepageSlider = $('.homepage-slider'),
            gallerySlider = $('.gallery-slider'),
            gallerySliderTwo = $('.gallery-slider-two');

        homepageSlider.flexslider({
            slideshow: true,
            slideshowSpeed: 4000,
            pauseOnHover: true,
            touch: true,
            prevText: "",
            nextText: "",
            controlNav: false,
            rtl: isRtl,
            start: function (slider) {
                slider.delay(400).removeClass('slider-loader');
                centerSlideDetails(slider.h);
            }
        });

        gallerySlider.flexslider({
            animation: "slide",
            slideshow: true,
            rtl: isRtl,
            prevText: "",
            nextText: ""
        });

        gallerySliderTwo.flexslider({
            animation: "fade",
            slideshow: true,
            rtl: isRtl,
            directionNav: false
        });
    }

    function centerSlideDetails(slideHeight) {
        var slider = '',
            siteHeader = $('.site-header'),
            isHeaderOne = siteHeader.hasClass('header-variation-one') && $window.width() > 1182;

        if (homepageSlider.hasClass('slider-variation-two')) {
            slider = $('.slider-variation-two .slides li');
        }else if (homepageSlider.hasClass('slider-variation-three')) {
            slider = $('.slider-variation-three .slides li');
        }

        if( !slideHeight && slider ){
            slideHeight = slider.first().height();
        }

        if(slider){
            slider.each(function () {
                var slideOverlay = $(this).find('.slide-inner-container');
                if (isHeaderOne) {
                    slideOverlay.css('top', siteHeader.height() + 40);
                } else {
                    slideOverlay.css('top', Math.abs(((slideHeight - slideOverlay.outerHeight()) / 2)));
                }
            });
        }
    }

    $window.on('load resize', function () {
        centerSlideDetails();
    });


    if (jQuery().lightSlider) {
        $('#image-gallery').lightSlider({
            gallery: true,
            item: 1,
            thumbItem: 10,
            loop: true,
            slideMargin: 0,
            galleryMargin: 0,
            thumbMargin: 2,
            currentPagerPosition: 'middle',
            rtl: isRtl
        });
        $('.lSPager').wrap('<div class="slider-thumbnail-nav-wrapper"></div>');
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Carousels
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().owlCarousel) {
        var similarPropertiesCarousel = $(".similar-properties-carousel .owl-carousel"),
            similarPropertiesCarouselNav = $('.similar-properties-carousel-nav'),
            similarPropertiesItem = $('.similar-properties-carousel .hentry'),
            recentPostsCarousel = $(".recent-posts-carousel .owl-carousel"),
            recentPostsCarouselNav = $('.recent-posts-carousel-nav'),
            recentPostsItem = $('.recent-posts-item'),
            carouselNext = $(".carousel-next-item"),
            carouselPrev = $(".carousel-prev-item");


        similarPropertiesCarousel.owlCarousel({
            onInitialized: navToggle(similarPropertiesItem,similarPropertiesCarouselNav,1),
            rtl: isRtl,
            items: 1,
            smartSpeed: 500,
            loop: similarPropertiesItem.length > 1,
            autoHeight: similarPropertiesItem.length > 1,
            dots: false
        });


        carouselNext.on( 'click', function () {
            similarPropertiesCarousel.trigger('next.owl.carousel');
        });

        carouselPrev.on( 'click', function () {
            similarPropertiesCarousel.trigger('prev.owl.carousel');
        });

        recentPostsCarousel.owlCarousel({
            onInitialized: navToggle(recentPostsItem,recentPostsCarouselNav,2),
            rtl: isRtl,
            smartSpeed: 500,
            margin: 20,
            dots: false,
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                1199: {
                    items: 2
                }
            }
        });


        carouselNext.on( 'click', function (event) {
            recentPostsCarousel.trigger('next.owl.carousel');
            event.preventDefault();
        });

        carouselPrev.on( 'click', function (event) {
            recentPostsCarousel.trigger('prev.owl.carousel');
            event.preventDefault();
        });
    }

    // Carousel Nav Toggle
    function navToggle(element,nav,items) {
        element.length > items ? nav.show() : nav.hide();
    }

    /*-----------------------------------------------------------------------------------*/
    /* Select2
    /* URL: http://select2.github.io/select2/
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().select2) {
        var selectOptions = {
            //minimumResultsForSearch: -1,  // Disable search feature in drop down
            width: 'off'
        };

        $('.search-select, .option-bar select').select2(selectOptions)
        .on("select2:open", function (e) {
            $('.select2-dropdown').hide();
            $('.select2-dropdown').slideDown(200);
        });

        if (isRtl) {
            selectOptions.dir = "rtl";
        }


        var AgentSelectOptions = {
            placeholder: localizeStrings.add_agent
        }

        $('select').select2(selectOptions);
        $('#agent-selectbox').select2(AgentSelectOptions);
    }
    /*-----------------------------------------------------------------------------------*/
    /* Swipebox
    /* http://brutaldesign.github.io/swipebox/
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().swipebox) {
        $('.clone .swipebox').removeClass('swipebox');
        $(".swipebox").swipebox();

        $('a[data-rel]').each(function () {
            $(this).attr('rel', $(this).data('rel'));
        });
    }
    /*-----------------------------------------------------------------------------------*/
    /* Magnific Popup
    /* https://github.com/dimsemenov/Magnific-Popup
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().magnificPopup) {
        $(".video-popup").magnificPopup({
            type: 'iframe'
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*	Scroll to Top
     /*-----------------------------------------------------------------------------------*/
    $(function(){
        var scroll_anchor = $( '#scroll-top' ),
            post_nav = $( '.inspiry-post-nav' );
        $( window ).on('scroll', function () {
            if ( $( window ).width() > 980 ) {
                if ( $(this).scrollTop() > 250 ) {
                    scroll_anchor.fadeIn( 'fast' );
                    post_nav.fadeIn( 'fast' );
                    return;
                }
            }
            scroll_anchor.fadeOut( 'fast' );
            post_nav.fadeOut( 'fast' );
        });

        scroll_anchor.on( 'click', function ( event ) {
            event.preventDefault();
            $('html, body').animate( { scrollTop:0 }, 'slow' );
        });
    });


    /*-----------------------------------------------------------------------------------*/
    /* Sticky Header Function
    /*-----------------------------------------------------------------------------------*/
    var inspiryStickyHeader = $body.hasClass('inspiry-sticky-header');

    if( inspiryStickyHeader ) {
        var siteHeader = $('.site-header');

        $window.on( 'scroll', function() {
            var HeaderClasses = 'inspiry-sticked-header slideInDown animated',
                isHeaderVariationOne = siteHeader.hasClass('header-variation-one'),
                siteHeaderHeight = siteHeader.outerHeight(),
                windowPosition = $window.scrollTop(),
                adminbarOffset = $body.is( '.admin-bar' ) ? $( '#wpadminbar' ).height() : 0;

            if( windowPosition > siteHeaderHeight && $window.width() > 992 ){
                siteHeader.css('top', adminbarOffset ).addClass( HeaderClasses );

                if( isHeaderVariationOne ){
                    siteMainNav.show();
                    menuClose.show();
                } else {
                    $body.css('padding-top', siteHeaderHeight);
                }
            } else if ( windowPosition < 1 ) {
                siteHeader.css('top', 'auto' ).removeClass( HeaderClasses );
                $body.css('padding-top', 0);
            }
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /* Main Menu
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().meanmenu) {
        $('#site-main-nav').meanmenu({
            meanMenuContainer: '#mobile-header',
            meanRevealPosition: "left",
            meanMenuCloseSize: "20px",
            meanScreenWidth: "991",
            meanExpand: '',
            meanContract: ''
        });
    }

    var mainMenuItem = $('#site-main-nav li');
    mainMenuItem.on( 'mouseenter',
        function () {
            $(this).children('ul').stop(true, true).slideDown(200);
        });

    mainMenuItem.on( 'mouseleave',
        function () {
            $(this).children('ul').stop(true, true).slideUp(200);
        }
    );

    // Code to show and hide main menu for home first variation.
    var siteMainNav = $('.header-menu-wrapper #site-main-nav'),
        menuReveal = $('.button-menu-reveal'),
        menuClose = $('.button-menu-close');

    menuReveal.css('display', 'inline-block');
    menuClose.hide();
    siteMainNav.hide();

    menuReveal.on('click', function (event) {
        $(this).stop(true, true).toggleClass('active');
        if (siteMainNav.is(":visible")) {
            siteMainNav.hide();
            menuClose.hide();
        } else {
            siteMainNav.show();
            menuClose.show();
        }
        event.preventDefault();
    });

    menuClose.on('click', function (event) {
        $(this).fadeToggle(20);
        siteMainNav.fadeToggle(20);
        menuReveal.stop(true, true).toggleClass('active');
        event.preventDefault();
    });

    // Function to add User Nav and Social Nav in Mean Menu
    function customNav() {
        var menu = $('.mean-nav'),
            meanMenuReveal = $('.meanmenu-reveal'),
            backdrop = '<div class="mobile-menu-backdrop fade in"></div>',
            mobileHeaderNav = $('.mobile-header-nav .user-nav').html();

        if ( $window.width() < 991 && menu.find('.mobile-header-nav-wrapper').length < 1 ) {
            menu.find('#menu-main-menu').append(mobileHeaderNav);
            menu.find('#menu-main-menu i').remove();
        }

        // Show and hide user and social nav. Also add menu backdrop.
        meanMenuReveal.on('click', function () {
           // menu.find('.mobile-header-nav-wrapper').stop(true, true).slideToggle();
            menu.stop(true, true).toggleClass('mobile-menu-visible');
            if (menu.hasClass('mobile-menu-visible')) {
                $('body').append(backdrop);
            } else {
                $('.mobile-menu-backdrop').remove();
            }
        });

        // Resolve Model Backdrop issue.
        $('.login-register-link').on('click', function () {
            meanMenuReveal.trigger('click');
        });
    }
    customNav();
    $window.on( 'resize', function () {
        customNav();
        menuClose.hide();
        siteMainNav.hide();
        $('.mobile-menu-backdrop').remove();
    });

    /*-----------------------------------------------------------------------------------*/
    /*	Search Form Slide Toggle
    /*-----------------------------------------------------------------------------------*/
    // Function to show hidden fields on variation one
    var hiddenFields = $('.hidden-fields');

    $('.hidden-fields-reveal-btn').on( 'click', function (event) {
        $(this).stop(true, true).toggleClass('field-wrapper-expand');
        hiddenFields.stop(true, true).slideToggle(200);
        event.preventDefault();
    });

    var featureTitle = $('.extra-search-fields > .title > span'),
        featureWrapper = $('.extra-search-fields .features-checkboxes-wrapper');

    featureTitle.on( 'click', function () {
        $(this).stop(true, true).toggleClass('is-expand');
        featureWrapper.stop(true, true).slideToggle(200);
    });

    /*-----------------------------------------------------------------------------------*/
    /*	Equal Height Function
    /*-----------------------------------------------------------------------------------*/
    function equalHeights(element) {
        var $element = $(element),
            elementHeights = [];

        $element.each(function () {
            var $this = $(this);
            elementHeights.push($this.outerHeight());
        });

        if ($window.width() > 750) {
            $element.css('height', Math.max.apply(Math, elementHeights));
        }
    }

    equalHeights('.featured-properties-one .property-description');
    equalHeights('.agent-listing-post');
    /*-----------------------------------------------------------------------------------*/
    /*	Home Property Listing hover Effect
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().hoverIntent) {
        var propertyListing = $(".property-listing-two .property-description, .featured-properties-two .property-description");

        propertyListing.each(function(){
            var $this = $(this);
            $this.css( 'height', $this.find('.entry-header').outerHeight());
        });

        propertyListing.hoverIntent(
            function () {
                var $this = $(this);

                $this.find('.property-meta').show();
                $this.stop(true, true).animate({
                    height: '100%'
                }, 300).addClass('hovered');
            },
            function () {
                var $this = $(this);

                $this.removeClass('hovered').stop(true, true).animate({
                    height: $this.find('.entry-header').outerHeight()
                }, 300);
            }
        );
    }

    /*-----------------------------------------------------------------------------------*/
    /*	Isotope for gallery pages
    /*-----------------------------------------------------------------------------------*/
    if (jQuery().isotope) {
        var galleryContainer = $('#gallery-container');

        $window.on('load', function () {
            galleryContainer.isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows'
            });
        });

        $('#gallery-items-filter').on('click', 'a', function (event) {
            var $this = $(this),
                filterValue = $this.attr('data-filter');
            $(this).addClass('active').siblings().removeClass('active');
            galleryContainer.isotope({
                filter: filterValue
            });
            event.preventDefault();
        });
    }


    /*-----------------------------------------------------------------------------------*/
    /*	Animation CSS integrated with Appear Plugin
    /*----------------------------------------------------------------------------------*/
    function ie_10_or_older() {
        // check if IE10 or older
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf('MSIE ');
        if (msie > 0) {
            // IE 10 or older => return version number
            // return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
            return true;
        }
        // other browser
        return false;
    }

    if (jQuery().appear) {
        if (($window.width() > 991) && (!ie_10_or_older())) {
            // apply animation on only big screens and browsers other than IE 10 and Older Versions of IE
            $('.animated').appear().fadeTo('fast', 0);

            $(document.body).on('appear', '.fade-in-up', function (event, $all_appeared_elements) {
                $(this).each(function () {
                    $(this).addClass('fadeInUp')
                });
            });

            $(document.body).on('appear', '.fade-in-down', function (event, $all_appeared_elements) {
                $(this).each(function () {
                    $(this).addClass('fadeInDown')
                });
            });

            $(document.body).on('appear', '.fade-in-right', function (event, $all_appeared_elements) {
                $(this).each(function () {
                    $(this).addClass('fadeInRight')
                });
            });

            $(document.body).on('appear', '.fade-in-left', function (event, $all_appeared_elements) {
                $(this).each(function () {
                    $(this).addClass('fadeInLeft')
                });
            });
        }
    }
    /*----------------------------------------------------------------------------------*/
    /* Placeholder Support for older browsers
    /*----------------------------------------------------------------------------------*/
    if (jQuery().placeholder) {
        $('input, textarea').placeholder();
    }

    /*----------------------------------------------------------------------------------*/
    /*	IE Browsers Detection
    /*----------------------------------------------------------------------------------*/
    function detectIE() {
        var ms_ie = false,
            ua = window.navigator.userAgent,
            new_ie = ua.indexOf('Trident/');
        if (ie_10_or_older() || (new_ie > -1)) {
            ms_ie = true;
        }
        if (ms_ie) {
            $(".gallery-slider-two").find('img').removeClass('img-responsive');
            $("body").addClass('ie-userAgent');
            return true;
        }
        return false;
    }

    detectIE();

    /*-----------------------------------------------------------------------------------*/
    /* WPML Language Selection
    /*-----------------------------------------------------------------------------------*/
    $(function () {
        var head = $("head"),
            inspiry_language_list = $('#inspiry_language_list'),
            headStyleLast = head.find("style[rel='stylesheet']:last"),
            styleElement = "<style rel='stylesheet' media='screen'>#inspiry_language_list{background-image: url('" + inspiry_language_list.find('li > img').attr("src") + "');}</style>";
        if (headStyleLast.length) {
            headStyleLast.after(styleElement);
        }
        else {
            head.append(styleElement);
        }
    });


    /*-----------------------------------------------------------------------------------*/
    /* Inspiry Highlighted Message
    /*-----------------------------------------------------------------------------------*/
    $('.inspiry-highlighted-message .close-message').on('click', function () {
        $('.inspiry-highlighted-message').remove();
    });


    /*-----------------------------------------------------------------------------------*/
    /* Page Loader
    /*-----------------------------------------------------------------------------------*/
    $window.on('load', function () {
        $(".page-loader-img").fadeOut();
        $(".page-loader").delay(300).fadeOut("slow", function () {
            $(this).remove();
        });

        // Trigger once to avoid the auto height issue.
        $('.similar-properties-carousel-nav .carousel-next-item').trigger('click');
    });

    /*-----------------------------------------------------------------------------------*/
    /*	Scroll to Top
    /*-----------------------------------------------------------------------------------*/
    $(function(){
        var scroll_anchor = $('#scroll-top');
        $( window ).on('scroll', function () {
            if ( $( window ).width() > 980 ) {
                if ( $(this).scrollTop() > 250 ) {
                    scroll_anchor.fadeIn('fast');
                    return;
                }
            }
            scroll_anchor.fadeOut('fast');
        });

        scroll_anchor.on( 'click', function ( event ) {
            event.preventDefault();
            $('html, body').animate( { scrollTop:0 }, 'slow' );
        });
    });

    /*-----------------------------------------------------------------*/
    /* Property Floor Plans
     /*-----------------------------------------------------------------*/
    $('.floor-plans-accordions .floor-plan:first-child').addClass('current')
        .children('.floor-plan-content').css('display', 'block').end()
        .find('i.fa').removeClass( 'fa-plus').addClass( 'fa-minus' );

    $('.floor-plan-title').on( 'click', function(){
        var parent_accordion = $(this).closest('.floor-plan');
        if ( parent_accordion.hasClass('current') ) {
            $(this).find('i.fa').removeClass( 'fa-minus').addClass( 'fa-plus' );
            parent_accordion.removeClass('current').children('.floor-plan-content').slideUp(300);
        } else {
            $(this).find('i.fa').removeClass('fa-plus').addClass( 'fa-minus' );
            parent_accordion.addClass('current').children('.floor-plan-content').slideDown(300);
        }
        var siblings = parent_accordion.siblings('.floor-plan');
        siblings.find('i.fa').removeClass( 'fa-minus').addClass( 'fa-plus' );
        siblings.removeClass('current').children('.floor-plan-content').slideUp(300);
    });

    /*-----------------------------------------------------------------------------------*/
    /* Compare Properties
     /*-----------------------------------------------------------------------------------*/
    var compare_properties_number = $( '.compare-properties .compare-carousel > div' ).length;
    if ( compare_properties_number != 0 ) {
        $( '.compare-properties' ).slideDown( 200 );
    }

    /*-----------------------------------------------------------------------------------*/
    /* Add to compare
     /*-----------------------------------------------------------------------------------*/
    $( document ).on( 'click', 'a.add-to-compare', function(e) {
        e.preventDefault();

        var slides_number = $( '.compare-carousel .compare-carousel-slide' ).length;
        if ( slides_number > 3 ) {
            var remove_last_check = 1;
            $( '.compare-carousel .compare-carousel-slide:nth-child(1) a.compare-remove' ).trigger( "click", [ $( this ), remove_last_check ] );
        } else {
            var plus            = $( this ).find( 'i' );
            var compare_target  = $( this ).parents( '.add-to-compare-span' ).find( '.compare_target' );
            var compare_link    = $( this );
            var compare_output  = $( this ).parents( '.add-to-compare-span' ).find( '.compare_output' );

            plus.addClass( 'fa-spin' );

            var add_compare_request = $.ajax({
                url         : $( compare_link ).attr('href'),
                type        : "POST",
                data        : {
                    property_id     : $( compare_link ).data( 'property-id' ),
                    action          : "inspiry_add_to_compare"
                },
                dataType    : "json"
            });

            add_compare_request.done( function( response ) {
                plus.removeClass( 'fa-spin' );
                if( response.success ) {
                    $( compare_link ).hide( 0, function() {
                        $( compare_target ).html( response.message );
                        $( compare_output ).delay( 200 ).show();
                    });
                    $( '.compare-carousel' ).append(
                        '<div class="compare-carousel-slide"><div class="compare-slide-img"><img src="' + response.img.replace(/^http:\/\//i, '//') + '"></div><a class="compare-remove" data-property-id="' + response.property_id + '" href="' + response.ajaxURL + '" width="' + response.img_width + '" height="' + response.img_height + '"><i class="fas fa-times"></i></a></div>'
                    );
                    var compare_properties_number = $( '.compare-properties .compare-carousel > div' ).length;
                    if ( compare_properties_number == 1 ) {
                        $( '.compare-properties' ).slideDown();
                    }
                } else {
                    compare_output.text( response.message );
                }
            });

            add_compare_request.fail( function( jqXHR, textStatus ) {
                compare_output.text( "Request failed: " + textStatus );
            });
        }
    });

    /*-----------------------------------------------------------------------------------*/
    /* Remove from compare
     /*-----------------------------------------------------------------------------------*/
    $( document ).on( 'click', 'a.compare-remove', function( event, add_compare_target, remove_last ) {
        event.preventDefault();
        var current_link    = $( this );
        var cross           = $( this ).find( 'i' );
        var plus            = $( add_compare_target ).find( 'i' );

        cross.addClass( 'fa-spin' );
        plus.addClass( 'fa-spin' );

        $.when(
            $.ajax({
                    url     : current_link.attr( 'href' ),
                    type    : "POST",
                    data    : {
                        property_id : current_link.data( 'property-id' ),
                        action      : "inspiry_remove_from_compare"
                    },
                    dataType        : "json"
                })

                .done( function( response ) {
                    cross.removeClass( 'fa-spin' );
                    if( response.success ) {
                        current_link.parents( 'div.compare-carousel-slide' ).remove();
                        var property_item = $( 'div.add-to-compare-span *[data-property-id="' + response.property_id + '"]' ).parents( '.add-to-compare-span' );
                        property_item.find( 'div.compare_output' ).hide().removeClass('show');
                        $( 'div.add-to-compare-span *[data-property-id="' + response.property_id + '"]' ).removeClass( 'hide' ).delay(200).show();
                        current_link.parents('.span2.compare-properties-column').remove();
                       if($('.compare-template').find('.compare-properties-column').length == 0){
                           $('.compare-template').remove();
                           $( '.compare-empty-message').removeClass('hide');
                       }
                        var compare_properties_number = $( '.compare-properties .compare-carousel > div' ).length;
                        if ( compare_properties_number == 0 ) {
                            $( '.compare-properties' ).slideUp();
                        }
                    }
                })

                .fail( function( jqXHR, textStatus ) {
                    compare_output.text( "Request failed: " + textStatus );
                })
            )

            .then( function( response ) {
                if ( remove_last ) {
                    var compare_target  = $( add_compare_target ).parents( '.add-to-compare-span' ).find( '.compare_target' );
                    var compare_link    = $( add_compare_target );
                    var compare_output  = $( add_compare_target ).parents( '.add-to-compare-span' ).find( '.compare_output' );

                    var add_compare_request = $.ajax({
                        url         : $( compare_link ).attr('href'),
                        type        : "POST",
                        data        : {
                            property_id     : $( compare_link ).data( 'property-id' ),
                            action          : "inspiry_add_to_compare"
                        },
                        dataType    : "json"
                    });

                    add_compare_request.done( function( response ) {
                        plus.removeClass( 'fa-spin' );
                        if( response.success ) {
                            $( compare_link ).hide( 0, function() {
                                $( compare_target ).html( response.message );
                                $( compare_output ).delay( 200 ).show();
                            });
                            $( '.compare-carousel' ).append(
                                '<div class="compare-carousel-slide"><div class="compare-slide-img"><img src="' + response.img.replace(/^http:\/\//i, '//') + '"></div><a class="compare-remove" data-property-id="' + response.property_id + '" href="' + response.ajaxURL + '" width="' + response.img_width + '" height="' + response.img_height + '"><i class="fas fa-times"></i></a></div>'
                            );
                        } else {
                            compare_output.text( response.message );
                        }
                    });
                };
            } );
    });

//    make equal height container for property compare thumbnails
    $(function(){
        var highestBox = 0;
        $('.compare-template .property-thumbnail', this).each(function(){
            if($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
        });
        $('.compare-template .property-thumbnail',this).height(highestBox);
    });


    //position the thumbnails on property compare buttons
        $(window).on('scroll', function () {
            if($(window).width() > 991) {

            var scroll = $(window).scrollTop();
            var headerBanner = $('.page-head').height();
            var headerHeight = $('.site-header ').height();
            var adminBarHeight = $('wpadminbar').height();
            var thumbnailHeight = $('.property-thumbnail').outerHeight();
            var totalHeight = headerHeight + adminBarHeight + headerBanner + 50;
            //>=, not <=
            if (scroll >= totalHeight) {
                //clearHeader, not clearheader - caps H
                $(".wrapper-template-compare-contents .property-thumbnail").addClass("compare-thumbnail-fix");
                $(".wrapper-cells").css('margin-top', thumbnailHeight + 'px');
            } else {
                $(".wrapper-template-compare-contents .property-thumbnail").removeClass("compare-thumbnail-fix");
                $(".wrapper-cells").css('margin-top', '0');
            }
        }

    });

    /*-----------------------------------------------------------------*/
    /* Currency Switcher
     /*-----------------------------------------------------------------*/
    $(function ()
    {
        var currencySwitcherList = $('#currency-switcher-list');
        if (currencySwitcherList.length > 0) {     // if currency switcher exists

            var currencySwitcherForm = $('#currency-switcher-form');
            var currencySwitcherOptions = {
                success: function (ajax_response, statusText, xhr, $form) {
                    var response = $.parseJSON(ajax_response);
                    if (response.success) {
                        window.location.reload();
                    }
                }
            };

            $('#currency-switcher-list > li').on('click', function (event) {
                event.stopPropagation();
                currencySwitcherList.slideUp(200);

                // get selected currency code
                var selectedCurrencyCode = $(this).data('currency-code');

                if (selectedCurrencyCode) {
                    $('#selected-currency').html(selectedCurrencyCode);
                    $('#switch-to-currency').val(selectedCurrencyCode);           // set new currency code
                    currencySwitcherForm.ajaxSubmit(currencySwitcherOptions);    // submit ajax form to update currency code cookie
                }
            });

            $('.switcher__currency #currency-switcher').on('click', function (event) {
                $(this).find("ul").slideToggle(200);
                //currencySwitcherList.slideToggle(200);
                event.stopPropagation();
            });

            $('html').on('click', function () {
                currencySwitcherList.slideUp(100);
            });

        }
    });


//Tooltip for property compare button
    $( function() {
        $( '.add-to-compare-span' ).tooltip({
            position: {
                my: "center bottom-20",
                at: "center top",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                }
            }
        });
    } );


// Google Map Half Map


    function halfMapSize(){
        var windowWidth = $(window).width();
        var halfWidth = (windowWidth / 2) - 15;
        var contentHeight = $('#content-wrapper').height();
        if($(window).width() > 991) {
            $('.properties-with-half-map .map-inner').width(halfWidth).height(contentHeight);
            $('.properties-with-half-map #listing-map').height(contentHeight);
        }else {
            $('.properties-with-half-map .map-inner').width("auto").height("500");
            $('.properties-with-half-map #listing-map').height("500");
        }
    }
//    Move Map Container For Small Devices

    function mapForSmallDevices() {

        if ($(window).width() <= 991) {
            if (!$('.map-container-sm').hasClass('small-device-map')) {
                $(".map-container").detach().appendTo('.map-container-sm');
                $('.map-container-sm').addClass("small-device-map");
                $('.map-container-md').removeClass("large-device-map");
            }
        } else if ($(window).width() > 991) {
            if (!$('.map-container-md').hasClass('large-device-map')) {
                $(".map-container").detach().appendTo('.map-container-md');
                $('.map-container-md').addClass("large-device-map");
                $('.map-container-sm').removeClass("small-device-map");
            }
        }
    }

    $window.on('load resize', function () {
        halfMapSize();
        mapForSmallDevices();

    });

})(jQuery);
