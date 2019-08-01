$(document).ready(function(){
    let homepage = {
        init: function () {
            this.initZendesk();
            this.hideZendesk();
            this.minimizeZendesk();
            this.recentSearch();
            this.showRecentSearch();
            this.propertyFeatured();
            this.getCurrentLocation();
            this.initShareItHere();
            this.initScrollAboutUs();
            this.initSticky();
            this.initialize();
        },
        initZendesk: function() {
            window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
            $.src="https://v2.zopim.com/?pWdvZKZ1i9DQR75ycJ9P2AUjfrQ2g7o1";z.t=+new Date;$.
            type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
        },
        hideZendesk: function() {
            $zopim(function() {
                $zopim.livechat.hideAll();
            })
        },
        minimizeZendesk: function() {
            $zopim(function() {
                $zopim.livechat.window.onHide(function() {
                    $zopim.livechat.hideAll();
                });
            });
        },
        recentSearch: function() {
            $(document).on('change', '.home-recent', function() {
                let id = $(this).data('id');
                let placeId = $(this).data('place_id');
                let param = $(this).data('param');

                $('#searchbox').val(id);
                $('#homeSearch').val(id);
                $('#navbarSearch').val(id);
                $('#place_id').val(placeId);
                $('#recent_search').val(JSON.stringify(param));

                $('#removeLocation').show();
                $('#homeRemoveLocation').show();
                $('#navbarRemoveLocation').show();
                homepage.openSearchbox();
            });
        },
        setCookie: function(name, value) {
            document.cookie = name + '=' + value;
        },
        getCookie: function(name) {
            return document.cookie.split('; ').reduce((r, v) => {
                const parts = v.split('=')
                return parts[0] === name ? parts[1] : r
              }, '')
        },
        showRecentSearch: function() {
            let homeRecent = $("#homeRecentSearch");
            if (homeRecent.length) {
                $('div#homeRecentSearch').empty();
                homeRecent.closest('.recent-search-wrapper').hide();
                let token = document.head.querySelector('meta[name="csrf-token"]');
                let instanceId = this.getCookie('instanceId');

                fetch('/recent-search/find', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({ instance_id: instanceId })
                })
                .then(response => response.json())
                .then(data => {
                    let output = document.getElementById('homeRecentSearch');

                    if (!data.items.length) {
                        $(output).closest('.recent-search-wrapper').hide();
                        return false
                    }

                    // Show the "recent search" text
                    $(output).closest('.recent-search-wrapper').show();

                    return data.items.slice(0,2).forEach((q,i) => {
                        let tmpl = document.getElementById('home-recent-search').content.cloneNode(true);
                        tmpl.querySelector('.item-name').innerText = q.location;
                        tmpl.querySelector('.home-recent').setAttribute('data-param', JSON.stringify(q));
                        tmpl.querySelector('.home-recent').setAttribute('data-place_id', q.place_id);
                        tmpl.querySelector('.home-recent').setAttribute('data-id', q.full_location);
                        output.append(tmpl);
                    });
                })
                .catch(error => console.log(error));
            }
        },
        updateRecentSearch: function(place) {
            let instance_id = place.instance_id;
            let place_id = place.place_id;
            let location = place.location;
            let full_location = place.full_location;
            let token = document.head.querySelector('meta[name="csrf-token"]');

            if (this.getCookie('instanceId') != instance_id) {
                let instance = this.getCookie('instanceId');
                instance_id = instance;
            } else if (!this.getCookie('instanceId')) {
                let instance = Math.random().toString(36).substring(2);
                this.setCookie('instanceId', instance);
                instance_id = instance;
            }

            let params = { instance_id, place_id, location, full_location };

            fetch('/recent-search', {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token.content
                },
                body: JSON.stringify(params)
            })
            .then(response => response.json())
            .catch(error => console.log(error));
        },
        getCurrentLocation: function() {
            $('.homeCurrentLocation').click(function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        let geocoder = new google.maps.Geocoder;
                        geocoder.geocode({location : pos}, function(results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    let res = results[0];
                                    let saveSearch = {
                                        instance_id: homepage.getCookie('instanceId') || '',
                                        place_id: res.place_id,
                                        location: homepage.getAddressNameFromAddressComponents(res.address_components),
                                        full_location: res.formatted_address
                                    }

                                    $('#homeSearch').val(res.formatted_address);
                                    $('#searchbox').val(res.formatted_address);
                                    $('#navbarSearch').val(res.formatted_address);
                                    $('#lat').val(pos.lat);
                                    $('#lng').val(pos.lng);
                                    $('#place_id').val(res.place_id);
                                    $('#recent_search').val(JSON.stringify(saveSearch));
                                    $('#maps').val(true);
                                    $('#input-is-nearme').val(1);
                                    $('#removeLocation').show();
                                    $('#homeRemoveLocation').show();
                                    $('#navbarRemoveLocation').show();
                                    homepage.openSearchbox();
                                } else {
                                    console.log('No results found');
                                }
                            } else {
                                console.log('Geocoder failed due to: ' + status);
                            }
                        });
                    })
                } else {
                    console.log('Browser not supported');
                }
            });
        },
        propertyFeatured: function() {
            const element = $('#property-featured');
            const formatPrice = (price) => accounting.formatMoney(price, 'IDR ', 0,'.');

            if (element.length) {
                $(document).on('click', '.card-tag', function() {
                    var $scope = $(this).closest('.pp-highlight');
                    var $wrapper = $scope.closest('.pp-detail');
                    let state = $(this).data('active');
                    let type = $(this).data('type');
                    let id = $(this).data('id');
                    let price = formatPrice($(this).data('price'));
                    let img = $(this).data('img');
                    let room = $(this).data('room');

                    if ($('.pp-price[data-type="'+type+'"]', $scope).is(':hidden')) {
                        if (type === 'coliving') {
                            $(`#tag-left-${id}`).data('active', 0).removeClass('card-tag-outline');
                            $(`#tag-right-${id}`).data('active', 1).addClass('card-tag-outline');
                            $('.pp-price[data-type="'+type+'"]', $scope).show();
                            $('.pp-price:not([data-type="'+type+'"])', $scope).hide();
                            $(`#icon-${id}`).attr('src', img);
                            $(`#room-${id}`).text(room);
                            $('.pp-landsize .pp-size', $wrapper).text($(this).data('unit_size'))
                        } else if (type === 'entire') {
                            $(`#tag-left-${id}`).data('active', 1).addClass('card-tag-outline');
                            $(`#tag-right-${id}`).data('active', 0).removeClass('card-tag-outline');
                            $('.pp-price[data-type="'+type+'"]', $scope).show();
                            $('.pp-price:not([data-type="'+type+'"])', $scope).hide();
                            $(`#icon-${id}`).attr('src', img);
                            $(`#room-${id}`).text(room);
                            $('.pp-landsize .pp-size', $wrapper).text($(this).data('building_size'))
                        }
                    }
                });

                $(document).on('click', '.btn-favorite', function() {
                    let token = document.head.querySelector('meta[name="csrf-token"]');
                    let liked = $(this).hasClass('like-active');
                    let pid = $(this).data('id');

                    if (liked) {
                        fetch(`/property-favorite/${pid}`, {
                            method: 'delete',
                            headers: {
                                'X-CSRF-TOKEN': token.content
                            }
                        })
                        .then(response => response.json())
                        .then(data => $(this).removeClass('like-active'))
                        .catch(error => console.log(error));
                    } else {
                        fetch('/property-favorite', {
                            method: 'post',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': token.content
                            },
                            body: JSON.stringify({ property_id: pid })
                        })
                        .then(response => response.json())
                        .then(data => $(this).addClass('like-active'))
                        .catch(error => console.log(error));
                    }
                });
            }
        },
        openSearchbox: function() {
            $('#search-popup').addClass('show');
            $('body').addClass('search-open');
            $('.searchbox-primary').focus();

            $('span#recentSearch').empty();

            var getCookie = function(name) {
                return document.cookie.split('; ').reduce((r, v) => {
                    const parts = v.split('=')
                    return parts[0] === name ? parts[1] : r
                  }, '')
            }

            let token = document.head.querySelector('meta[name="csrf-token"]');
            let instanceId = getCookie('instanceId');

            fetch('/recent-search/find', {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token.content
                },
                body: JSON.stringify({ instance_id: instanceId })
            })
            .then(response => response.json())
            .then(data => {
                let output = document.getElementById('recentSearch');

                if (!data || !data.items || !data.items.length) {
                    $(output).parent().parent().addClass('d-none').removeClass('d-flex');
                    return [];
                }

                $(output).parent().parent().removeClass('d-none').addClass('d-flex');

                return data.items.slice(0,2).forEach(q => {
                    let tmpl = document.getElementById('recent-search').content.cloneNode(true);
                    tmpl.querySelector('.item-name').innerText = q.location;
                    tmpl.querySelector('.recent-search').setAttribute('data-param', JSON.stringify(q));
                    tmpl.querySelector('.recent-search').setAttribute('data-place_id', q.place_id);
                    tmpl.querySelector('.recent-search').setAttribute('data-id', q.full_location);
                    output.append(tmpl);
                });
            })
            .catch(error => console.log(error));
        },
        getAddressNameFromAddressComponents: function (component, i = 0) {
            if ($.isPlainObject(component[i])) {
                const comp = component[i];

                if (comp.types && comp.types.length) {
                    if ($.inArray(comp.types[0], ['street_number', 'premise', 'postal_code', 'subpremise']) === -1) {
                        return comp.long_name;
                    }

                    return homepage.getAddressNameFromAddressComponents(component, i + 1);
                }
            }

            return component[0].long_name;
        },
        initialize: function() {
            $('#homeRemoveLocation').hide();
            $('#navbarRemoveLocation').hide();

            $('#homeSearch').keyup(function() {
                if ($(this).val() == '') {
                    $('#homeRemoveLocation').hide();
                } else {
                    $('#homeRemoveLocation').show();
                }
            });

            $('#homeRemoveLocation').click(function() {
                $('#searchbox').val('');
                $('#navbarSearch').val('');
                $('#homeSearch').val('');
                $('#homeRemoveLocation').hide();
                $('#navbarRemoveLocation').hide();
                $('#removeLocation').hide();
            });

            $('#navbarRemoveLocation').click(function() {
                $('#searchbox').val('');
                $('#navbarSearch').val('');
                $('#homeSearch').val('');
                $('#homeRemoveLocation').hide();
                $('#navbarRemoveLocation').hide();
                $('#removeLocation').hide();
            });

            if ($('.navbar[solid-on-scroll]').length != 0) {
                mainToolkit.transparent = true;
                mainToolkit.checkScrollForTransparentNavbar();
                $(window).on('scroll', mainToolkit.checkScrollForTransparentNavbar);
            }
            var submitSearchbox = function (e) {
                if ($('.searchbox-primary').val() != "") {
                    let param = JSON.parse($('#recent_search').val());
                    homepage.updateRecentSearch(param);
                    $('#searchbox-form').submit();
                }
            }
            $('.searchbox-value').change(function () {
                $('.searchbox-value').not(this).val($(this).val());
            })
            $('.searchbox-btn').click(submitSearchbox)
            $('.searchbox-primary').keydown(function (e) {
                if (e.keyCode == 13) {
                    submitSearchbox();
                    e.preventDefault();
                }
            })
            $('.searchbox-trigger .input-group-text, .searchbox-trigger button, a.searchbox-trigger').click(function() {
                homepage.openSearchbox();
            });
            $('.searchbox-trigger .form-control, .searchbox-trigger.form-control').on('focus', function() {
                homepage.openSearchbox();
            });
            $('.searchbox-close').click(function () {
                $('#search-popup').removeClass('show');
                $('body').removeClass('search-open');
                homepage.showRecentSearch();
            })
            var openSearchSection = function ($elmt, className) {
                if ($elmt.hasClass('active')) {
                    $elmt.removeClass('active');
                    $('#search-section').removeClass(className);
                } else {
                    $elmt.addClass('active');
                    $('#search-section').addClass(className);
                }
            }

            // Sticky wrapper
            var resizeSticky = function () {
                var elements = document.querySelectorAll('.sticky-wrapper, .sticky-sm-wrapper, .sticky-md-wrapper');
                for (var i = 0; i < elements.length; i++) {
                    const wrapper = elements[i].closest('.main-content');
                    if (wrapper) elements[i].style.top = wrapper.offsetTop + "px";
                };

                $(window).off('scroll.stickywatch');

                if ($('[data-provide="stickywatch"]').length) {
                    var applyScrollListener = function () {
                        $('[data-provide="stickywatch"]').each(function () {
                            var top = $(this).css('top')

                            if (top) {
                                top = parseInt(top.replace('px', ''), 10);
                            }

                            if (top && $(window).scrollTop() >= top) {
                                $(this).addClass('is-sticky')
                            } else {
                                $(this).removeClass('is-sticky')
                            }
                        })
                    };

                    applyScrollListener();
                    $(window).on('scroll.stickywatch', applyScrollListener);
                }
            }
            resizeSticky();
            window.addEventListener('resize', resizeSticky);

            // Carousel watcher
            $('.carousel-watcher').on('slid.bs.carousel', function () {
                var $this = $(this);
                $this.children('.btn-prev').prop('disabled', $this.find('.carousel-inner .carousel-item:first').hasClass('active'));
                $this.children('.btn-next').prop('disabled', $this.find('.carousel-inner .carousel-item:last').hasClass('active'));
            })

            //checkbox select
            $('.btn-select input[type="checkbox"]').change(function () {
                $(this).siblings().html($(this).prop('checked') ? "Selected" : "Select");
            })

            //tab button navi
            $('.tabs-navigator').click(function () {
                if (this.dataset.navi == "next" && this.previousElementSibling.tagName.toLowerCase() == "ul") {
                    var selector = this.previousElementSibling.querySelector('.nav-link.active');
                    var next = selector ? selector.parentElement.nextElementSibling : null;
                    if (next) {
                        next.firstElementChild.click();
                    }
                } else if (this.nextElementSibling.tagName.toLowerCase() == "ul") {
                    var selector = this.nextElementSibling.querySelector('.nav-link.active');
                    var prev = selector ? selector.parentElement.previousElementSibling : null;
                    if (prev) {
                        prev.firstElementChild.click();
                    }
                }
            });
            $('.nav-link').click(function () {
                var $self = $(this);
                var navlink = this.parentElement;
                var container = navlink.parentElement;
                var offset = navlink.offsetLeft - container.offsetLeft;
                var isSlidingLeft = offset < container.scrollLeft;
                var isSlidingRight = (offset + navlink.offsetWidth) > (container.scrollLeft + container.clientWidth);
                if (container.scrollWidth != container.clientWidth &&
                    (isSlidingLeft ||
                        isSlidingRight
                    )) {
                    container.scrollTo({
                        left: navlink.offsetLeft - container.offsetLeft,
                        behavior: 'smooth'
                    })

                    if (isSlidingLeft) {
                        setTimeout(function () {
                            $self.trigger('slideleft.navlink', [offset, offset + navlink.offsetWidth, container.clientWidth])
                        }, 200);
                    }

                    if (isSlidingRight) {
                        setTimeout(function () {
                            $self.trigger('slideright.navlink', [offset, offset + navlink.offsetWidth, container.clientWidth])
                        }, 200)
                    }
                }
            });

            $(document).on({
                'shown.bs.modal': function () {
                    $('html, body').add(this).css({
                        height: '100%',
                        width: '100%',
                        paddingRight: 0,
                    });
                },
                'hidden.bs.modal': function () {
                    $('html, body').add(this).css({
                        height: '',
                        width: '',
                        paddingRight: '',
                    });
                }
            }, '.modal.fullscreen')
        },
        initShareItHere: function () {
            $(document).on('click.sharetithere', '.btn-submit-share-it-here', function (e) {
                e.preventDefault();

                var $btn = $(this).prop('disabled', true);
                var $modal = $btn.closest('.modal');
                var $fields = $('[name]', $modal).prop('readonly', true);
                var modalData = $modal.data('bs.modal');

                $.ajax({
                    url: '/send-property-request',
                    type: 'post',
                    data: {
                        phone_number: $('[name="phone_number"]', $modal).val(),
                        phone_country_code: $('[name="phone_country_code"]', $modal).val(),
                        message: $('[name="url"]', $modal).val(),
                        email: $('[name="email"]', $modal).val(),
                        user_id: $('[name="user_id"]', $modal).val(),
                    },
                    success: function (res) {
                        if (res && res.status) {
                            $modal.modal('hide');

                            var $thankYou = $('#thank-you-share-it-here-modal').modal('show');

                            setTimeout(function () {
                                $thankYou.modal('hide');
                            }, 500);
                        }
                    },
                    error: function (err, errStatus, errMsg) {
                        console.error(err)
                    },
                    complete: function () {
                        $fields.prop('readonly', false);
                        $btn.prop('disabled', false);
                    }
                })

            });
        },
        initScrollAboutUs: function () {
            if (window.location.pathname === '/' && $('#about-us').length) {
                if(window.location.hash) {
                    // to top right away
                    // if ( window.location.hash ) scroll(0,0);
                    // void some browsers issue
                    // setTimeout( function() { scroll(0,0); }, 1);

                    // smooth scroll to the anchor id
                    $(window).on('load', () => {
                        setTimeout(() => {
                            $('html, body').animate({
                                scrollTop: $('#about-us').offset().top + (-72) + 'px'
                            }, 750, 'swing');
                        }, 500);
                    })
                }
            }

            $(document).on('click', '[data-scrollto]', function(e) {
                let to = $(this).attr('href');

                if (!to) {
                    to = $(this).data('scrollto');
                }

                if (to) {
                    if (to.charAt(0) == '/') {
                        to = to.substr(1);
                    }

                    console.log(to)

                    if ($(to).length) {
                        e.preventDefault();

                        $('html, body').animate({
                            scrollTop: $(to).offset().top + (-($('.fixed-top').outerHeight() || 0)) + 'px'
                        }, 750, 'swing');
                    }
                }
            });
        },
        initSticky: function () {
            $(() => {
                if ($('#shortcut-menu').length) {
                    const sticky = new Waypoint.Sticky({
                        element: $('#shortcut-menu').get(0),
                        wrapper: '<div class="shortcut-menu-sticky-wrapper" />',
                        handler (direction) {
                            let $el = this.$element;
                            let $cloned;
                            const $navbar = $('#navbarSupportedContent');

                            if (direction == 'down') {
                                $cloned = $el.clone();

                                $navbar.children().hide();

                                $cloned.addClass('--cloned-stuck')
                                    .removeClass('stuck')
                                    .attr('id', 'shortcut-menu-cloned');

                                $cloned.prependTo($navbar);
                            } else {
                                $cloned = $navbar.find('.--cloned-stuck');

                                $cloned.remove();
                                $navbar.children().show();
                            }
                        }
                    });

                    $(document).on('click', '#shortcut-menu-cloned .nav .nav-link', function (e) {
                        e.preventDefault();

                        $('html, body').animate({
                            scrollTop: $($(this).attr('href')).offset().top + (-($('#main-navbar').outerHeight() || 0)) + 'px'
                        }, 750, 'swing');
                    })
                }
            })
        }
    }

    homepage.init();
    this.clearMarkerLabel = function () {
        this.markers.forEach(function (elmt) {
            elmt.setMap(null);
        })
        this.markers.splice(0, markers.length);
    }
});
window.initGMap = function (center, element) {
    return new GMap(center, element);
};
