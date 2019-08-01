$(document).ready(function() {
    var customSewagi = {
        init: function() {
            customSewagi.fox();
            //customSewagi.closeCookie();
            customSewagi.easing();
            customSewagi.mainNavScroll();
            // customSewagi.navScroll();
            customSewagi.triggerAction();
            customSewagi.equalTitle();
            customSewagi.owlMostView();
            customSewagi.owlPropertList();
            customSewagi.sewagiTestimonials();
            customSewagi.propertySlider1();
            customSewagi.propertySlider2();
            customSewagi.propertySlider3();
            customSewagi.propertySlider4();
            customSewagi.propertySlider5();
            customSewagi.propertySlider6();
            customSewagi.hideShowCloseSearch();
            customSewagi.detectFirefoxWindow();
            customSewagi.scrollOnePage();
            customSewagi.checkCookie();
            customSewagi.itemShowCard();
            // customSewagi.PropertySelectedBtn();
            // customSewagi.scrollStickySidebar();
            customSewagi.fancyBox();
        },

        triggerAction: function() {
            $(document).on('click.coopol', '.navbar-on-top .close-btn', function () {
                customSewagi.closeCookie();
            });
        },

        fox: function() {
            $(document).ready(function() {
                if ($('.input-nationality')) {
                    $(".input-nationality").select2({
                        placeholder: "Nationality",
                        templateResult: function(state) {
                            if (!state.id) return state.text;
                            return '<span class="flags-select2"><img src="' + $(state.element).data('img') + '" class="img-flag" /> ' + state.text + '</span>';
                        },
                        escapeMarkup: function(m) {
                            return m;
                        },
                        minimumResultsForSearch: Infinity,

                    })
                }
                $('.btn-show-password').click(function(e) {
                    e.preventDefault();
                    if ($(this).hasClass('moon-eye-blocked')) {
                        $(this).removeClass('moon-eye-blocked').addClass('moon-eye');
                        $(`input[name="${$(this).attr('for')}"]`).prop('type', 'text');
                    } else {
                        $(`input[name="${$(this).attr('for')}"]`).prop('type', 'password');
                        $(this).removeClass('moon-eye').addClass('moon-eye-blocked');
                    }
                });

                let format = function(state) {
                    //if (!state.id) return state.text; // optgroup
                    return '<span class="flags-select2"><img src="' + $(state.element).data('img') + '" class="img-flag" /> ' + state.text + '</span>';
                }
                if ($('.fox-phone')) {
                    $(".fox-phone").select2({
                        templateResult: function(state) {
                            if (!state.id) return state.text;
                            return '<span class="flags-select2"><img src="' + $(state.element).data('img') + '" class="img-flag" /> ' + state.text + '</span>';
                        },
                        templateSelection: function(state) {
                            if (!state.id) return state.text;
                            return '<span class="flags-select2"><img src="' + $(state.element).data('img') + '" class="img-flag" />&nbsp;</span>';
                        },
                        dropdownAutoWidth: true,
                        escapeMarkup: function(m) {
                            return m;
                        },
                        minimumResultsForSearch: Infinity,

                    });
                }
                if ($('.fox-select-custom')) {
                    $(".fox-select-custom").select2({
                        // templateResult: function(state){
                        //   if (!state.id) return state.text;
                        //   return '<span class="flags-select2"><img src="' + $(state.element).data('img') + '" class="img-flag" /> ' + state.text + '</span>';
                        // },
                        // templateSelection: function(state){
                        //   if (!state.id) return state.text;
                        //   return '<span class="flags-select2"><img src="' + $(state.element).data('img') + '" class="img-flag" /> ' + $(state.element).val() + '</span>';
                        // },
                        dropdownAutoWidth: true,
                        escapeMarkup: function(m) {
                            return m;
                        },
                        minimumResultsForSearch: Infinity,

                    });
                }
            });
        },

        easing: function() {
            jQuery(function() {
                jQuery('.navbar .navbar-nav a.nav-link').bind('click', function(event) {
                    var $anchor = jQuery(this);
                    jQuery('html, body').stop().animate({
                        scrollTop: jQuery($anchor.attr('href')).offset().top
                    }, 1500);
                    event.preventDefault();
                });
            });
        },

        mainNavScroll: function() {
            var toNav = jQuery('.navbar');
            if (!$(toNav).hasClass('fox-statis')) {
                jQuery(document).scroll(function() {
                    fromTop = jQuery(window).scrollTop();
                    if (fromTop > 50) {
                        toNav.removeClass('navbar-transparent');
                    } else {
                        toNav.addClass('navbar-transparent');
                    }
                });
            }
        },
        itemShowCard: function() {
            $(function() {
                $(".box-container-card").each(function(index) {
                    $(this).attr("id", "box-container-card" + index);
                    var childBtnLeft = $(this).find('.fox-btn-left');
                    var childBtnRight = $(this).find('.fox-btn-right');
                    var childCardLeft = $(this).find('.box-container-card-info-left');
                    var childCardRight = $(this).find('.box-container-card-info-right');
                    $(childBtnLeft).on('click', function() {
                        $(childCardLeft).addClass('is-show-card');
                        $(childCardRight).removeClass('is-show-card');
                        $(this).removeClass('card-tag-outline');
                        $(childBtnRight).addClass('card-tag-outline');
                    });
                    $(childBtnRight).click(function() {
                        $(childCardRight).addClass('is-show-card');
                        $(childCardLeft).removeClass('is-show-card');
                        $(this).removeClass('card-tag-outline');
                        $(childBtnLeft).addClass('card-tag-outline');
                    });
                });
            });
        },

        closeCookie: function() {
            $.get("/set-cookie", function () {
                $('.navbar-on-top').remove();
                $('.has-navbar-on-top').removeClass('has-navbar-on-top');
                $("#main-navbar").removeClass('cookie-active');
                // $(document).trigger('resize:sticky');
                $(document).trigger('navbarontop:closed');
            });
        },

        navScroll: function() {
            var mainToolkit;
            mainToolkit = {
                transparent: true,
                scroll_distance: 100,
                checkScrollForTransparentNavbar: debounce(function() {
                    if ($(document).scrollTop() > mainToolkit.scroll_distance) {
                        if (mainToolkit.transparent) {
                            mainToolkit.transparent = false;
                            $('.navbar[solid-on-scroll]').removeClass('navbar-transparent');
                        }
                    } else {
                        if (!mainToolkit.transparent) {
                            mainToolkit.transparent = true;
                            $('.navbar[solid-on-scroll]').addClass('navbar-transparent');
                        }
                    }
                }, 17)
            };

            function debounce(func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    }, wait);
                    if (immediate && !timeout) func.apply(context, args);
                };
            };
        },

        equalTitle: function() {
            // max-height what we provide title
            function titleHeight() {
                var maxHeight = 0;
                jQuery(".what-we-provide .we-provide-item .provide-desc > h5").each(function() {
                    if (jQuery(this).height() > maxHeight) {
                        maxHeight = jQuery(this).height();
                    }
                });
                jQuery(".what-we-provide .we-provide-item .provide-desc > h5").css("min-height", maxHeight + "px");

                jQuery(".info-tab-row .tab-content .tab-pane .title-card").each(function() {
                    if (jQuery(this).height() > maxHeight) {
                        maxHeight = jQuery(this).height();
                    }
                });
                jQuery(".info-tab-row .tab-content .tab-pane .title-card").css("min-height", maxHeight + "px");

                // Add class when has icon
                $(".tab-footer-icon").closest('.tab-pane').addClass('has-tab-icon');

                // Add height when has icon
                setTimeout(function(){
                    jQuery(".info-tab-row .tab-content .has-tab-icon .text-card").each(function() {
                        if (jQuery(this).height() > maxHeight) {
                            maxHeight = jQuery(this).height();
                        }
                    });
                    jQuery(".info-tab-row .tab-content .has-tab-icon .text-card").css("min-height", maxHeight + "px");
                }, 500);
            }

            jQuery(window).resize(function() {
                titleHeight()
            });
            jQuery(window).ready(function() {
                titleHeight()
            });
        },

        owlMostView: function() {
            // main-listings
            jQuery(document).ready(function() {
                var owlMost = jQuery(".main-listings");
                owlMost.owlCarousel({
                    loop: true,
                    // margin: 425,
                    // autoplay: true,
                    nav:true,
                    // navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    navText: [
                        `<img src="../img/ic_left_arrow.png" class="icon-arrow-left" alt="icon arrow left">`,
                        `<img src="../img/ic_right_arrow.png" class="icon-arrow-right" alt="icon arrow right">`
                    ],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true,
                            loop:true
                        },
                        1200: {
                            items: 2,
                            nav: true,
                            loop: true,
                            margin: 240
                        },
                    }
                });
            });
        },

        sewagiTestimonials: function() {
            jQuery(document).ready(function() {
                var owlTestimonials = jQuery(".owl-sewagi-testimonials");
                owlTestimonials.owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        }
                    }
                });
            });
        },

        owlPropertList: function() {
            jQuery(document).ready(function() {
                var owlMost = jQuery(".main-listings-prop");
                owlMost.owlCarousel({
                    loop: true,
                    margin: 20,
                    autoplay: true,
                    dots: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 2,
                            nav: true
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: false
                        },
                    }
                });
            });
        },
        propertySlider1: function() {
            // property-slider-1
            jQuery(document).ready(function() {
                var ppSlider1 = jQuery(".property-slider-1");
                ppSlider1.owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        768: {
                            items: 2,
                            nav: true
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: false
                        },
                        1900: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                });
            });
        },

        propertySlider2: function() {
            // property-slider-2
            jQuery(document).ready(function() {
                var ppSlider2 = jQuery(".property-slider-2");
                ppSlider2.owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        768: {
                            items: 2,
                            nav: true
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: false
                        },
                        1900: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                });
            });
        },

        propertySlider3: function() {
            // property-slider-3
            jQuery(document).ready(function() {
                var ppSlider3 = jQuery(".property-slider-3");
                ppSlider3.owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        768: {
                            items: 2,
                            nav: true
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: false
                        },
                        1900: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                });
            });
        },

        propertySlider4: function() {
            // property-slider-4
            jQuery(document).ready(function() {
                var ppSlider4 = jQuery(".property-slider-4");
                ppSlider4.owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        768: {
                            items: 2,
                            nav: true
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: false
                        },
                        1900: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                });
            });
        },

        propertySlider5: function() {
            // property-slider-5
            jQuery(document).ready(function() {
                var ppSlider5 = jQuery(".property-slider-5");
                ppSlider5.owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        768: {
                            items: 2,
                            nav: true
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: false
                        },
                        1900: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                });
            });
        },

        propertySlider6: function() {
            // property-slider-6
            jQuery(document).ready(function() {
                var ppSlider6 = jQuery(".property-slider-6");
                ppSlider6.owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        768: {
                            items: 2,
                            nav: true
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: false
                        },
                        1900: {
                            items: 5,
                            nav: true,
                            loop: false
                        }
                    }
                });
            });
        },

        hideShowCloseSearch: function() {
            jQuery(document).ready(function() {
                $(".input-homepage .searchbox-value.searchbox-primary").keyup(function() {
                    if ($(this).val()) {
                        $("#searchbox-form .input-homepage .input-group-icon.pr-15").show();
                        $("#searchbox-form .input-homepage .input-group-icon.pr-15").css("display", "flex");
                    } else {
                        $("#searchbox-form .input-homepage .input-group-icon.pr-15").hide();
                    }
                });
                $("#searchbox-form .input-homepage .input-group-icon.pr-15").click(function() {
                    $(".input-homepage .searchbox-value.searchbox-primary").val('');
                    $(this).hide();
                });

            });
        },

        checkCookie: function() {
            $(function () {
                if ($('.navbar-on-top').length) {
                    $('.navbar-on-top').show();
                    $('#main-navbar').addClass('cookie-active');
                }
            });
        },

        detectFirefoxWindow: function() {
            jQuery(document).ready(function() {
                if (navigator.userAgent.indexOf("Firefox") > 0) {
                    $("body").addClass("ffox");
                }
            });
        },

        scrollOnePage: function() {
            jQuery(document).ready(function() {
                function scrollNav() {
                    $('#nav-sections a').click(function(e) {
                        e.preventDefault();

                        if ($(this).parent().hasClass('collapse')) {
                            $(this).parent().parent().addClass("active");
                        } else {
                            $("#nav-sections li a").removeClass("active");
                            $(this).addClass("active");
                        }

                        //Animate
                        $('html, body').stop().animate({
                            scrollTop: $($(this).attr('href')).offset().top - 80
                        }, 400);
                        return false;
                    });
                    $('.scrollTop a').scrollTop();
                }
                scrollNav();
            });
        },

        PropertySelectedBtn: function() {
            jQuery(document).ready(function() {

                $('.btn-select').click(function() {
                    // $(this).closest('.list-n-divider > div').toggleClass('selected');
                    //
                    // var thisAtr = $(this).closest('.list-n-divider > div');
                    // if (thisAtr.hasClass("selected")) {
                    //   console.log(thisAtr, "12345");
                    //    $(this).find(".btn-select span").html("Selected");
                    // } else {
                    //    $(this).find(".btn-select span").html("Select");
                    // }
                });

            });
        },

        scrollStickySidebar: function() {
            jQuery(document).ready(function() {
                var $window = $(window);
                var lastScrollTop = $window.scrollTop();
                var wasScrollingDown = true;

                var $sidebar = $(".booking-sticky-new");
                if ($sidebar.length > 0) {

                    var initialSidebarTop = $sidebar.position().top;

                    $window.scroll(function(event) {

                        var windowHeight = $window.height();
                        var sidebarHeight = $sidebar.outerHeight();

                        var scrollTop = $window.scrollTop();
                        var scrollBottom = scrollTop + windowHeight;

                        var sidebarTop = $sidebar.position().top;
                        var sidebarBottom = sidebarTop + sidebarHeight;

                        var heightDelta = Math.abs(windowHeight - sidebarHeight);
                        var scrollDelta = lastScrollTop - scrollTop;

                        var isScrollingDown = (scrollTop > lastScrollTop);
                        var isWindowLarger = (windowHeight > sidebarHeight);

                        if ((isWindowLarger && scrollTop > initialSidebarTop) || (!isWindowLarger && scrollTop > initialSidebarTop + heightDelta)) {
                            $sidebar.addClass('fixed');
                        } else if (!isScrollingDown && scrollTop <= initialSidebarTop) {
                            $sidebar.removeClass('fixed');
                        }

                        var dragBottomDown = (sidebarBottom <= scrollBottom && isScrollingDown);
                        var dragTopUp = (sidebarTop >= scrollTop && !isScrollingDown);

                        if (dragBottomDown) {
                            if (isWindowLarger) {
                                $sidebar.css('top', 0);
                            } else {
                                $sidebar.css('top', -heightDelta);
                            }
                        } else if (dragTopUp) {
                            $sidebar.css('top', 0);
                        } else if ($sidebar.hasClass('fixed')) {
                            var currentTop = parseInt($sidebar.css('top'), 160);

                            var minTop = -heightDelta;
                            var scrolledTop = currentTop + scrollDelta;

                            var isPageAtBottom = (scrollTop + windowHeight >= $(document).height());
                            var newTop = (isPageAtBottom) ? minTop : scrolledTop;

                            $sidebar.css('top', newTop);
                        }

                        lastScrollTop = scrollTop;
                        wasScrollingDown = isScrollingDown;
                    });
                }

            });
        },

        fancyBox: function() {
            jQuery(document).ready(function() {

                $('.fancybox-thumbs').fancybox({
                    padding: 0,
                    prevEffect: 'none',
                    nextEffect: 'none',
                    closeBtn: true,
                    arrows: true,
                    nextClick: true,

                    helpers: {
                        thumbs: {
                            width: 80,
                            height: 50,
                            autoStart: true,
                            axis: 'x'
                        },
                    }
                });
                $.fancybox.helpers.thumbs.onUpdate = function() {};

            });
        },
    };
    customSewagi.init();
});
