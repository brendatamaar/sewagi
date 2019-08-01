$(document).ready(function () {
    $parent = $("#search-section");
    let searchPage = {
        init: function () {
            this.initialize();
            this.initSearch();
            this.initMaps();
            this.mainFilter();
            this.moreFilter();
            this.paginateData();
            this.filterPrice();
            this.togglePropertyType();
            this.addFavorite();
            this.autoCompleteLocation();
            this.removeLocation();
            this.actionFilter();
            this.searchPreference();
            this.recentSearch();
            this.getCurrentLocation();
            this.dropdownNav();
        },
        showMaps: function (lat = -6.21462, lng = 106.84513) {
            var searchMap = new this.initMaps({ lat, lng }, document.getElementById('search-map'));
            searchMap.init();
            if (this.state.data.nearme || this.state.data.is_commute) {
                if (this.state.data.nearme) {
                    searchMap.addCircle({ lat, lng }, 2000);
                    searchMap.addMarker({ lat, lng }, window.location.origin + '/img/ic_pin_point.png');
                }

                
                if (typeof this.state.data.commute_detail != "undefined") {
                    var commuteDetail = this.state.data.commute_detail;
                    var coordinates = commuteDetail.features[0].geometry.coordinates[0];
                    searchMap.showIsochrone(coordinates);
                }
                
                searchMap.setZoom(14);
            }
            window.searchMap = searchMap;

            $(document).on('change', '#moveMap', function () {
                if ($(this).prop('checked')) {
                    if (searchPage.state.data.is_commute) {
                        $('#modalMoveMap').modal('show');
                        $(this).prop('checked', false);
                    } else {
                        searchMap.moveSearch = true;
                        searchPage.state.data.move_map = true;
                    }
                } else {
                    searchMap.moveSearch = false;
                    searchPage.state.data.move_map = false;
                }
            })

            $(document).on('click', '#overrideCommute', function() {
                searchMap.moveSearch = true;
                searchPage.state.data.move_map = true;
                $('#moveMap').prop('checked', true);
                $('#modalMoveMap').modal('hide');
            })
        },
        state: {
            data: {
                _token: document.head.querySelector('meta[name="csrf-token"]').content,
                q: $('#keyword').val(),
                cond_co_living: 0,
                cond_entire_space: 0,
                type_apartment: 0,
                type_house: 0,
                page: 1,
                min_price: 0,
                max_price: 0,
                bedroom: 0,
                maps: false,
                id: '',
                move_map: false,
                commute_detail: 0,
                time: 0,
                commute_type: 0,
                geocode: {
                    ne: {},
                    sw: {}
                },
                nearme: 0,
                is_commute: 0,
                moreFilter: {
                    amenities: [],
                    facilities: [],
                    styles: [],
                    floor_level: [],
                    land_area: [],
                    arrangement: [],
                    property_furniture: [],
                    pet_friendly: 0,
                    bedroom_type: [],
                    bedroom_furniture: [],
                    ensuite_bathroom: 0,
                    view_360: 0
                },
                preference: {
                    is_mostly_male: 0,
                    is_mostly_female: 0,
                    hobbies: [],
                    lifestyles: [],
                    professions: [],
                    from: '',
                    min_age: 0,
                    max_age: 60,
                }
            },
            utils: {
                filterPrice: false,
                totalPage: 0,
                totalData: 0,
                init: true,
                lat: '',
                lng: ''
            }
        },
        initState: function () {
            let { data, utils } = this.state;
            let prev = JSON.parse($('#prevSearch').val());

            data.open_commute_filter  = prev.open_commute_filter === 'true' || prev.open_commute_filter === 1
                            || prev.open_commute_filter === '1' || prev.open_commute_filter === true;
            // if (data.open_commute_filter) {
            //     $('.commute-time-dropdown').dropdown('show');
            //     $('#keyword').val(prev.keyword);
            //     searchPage.state.data.open_commute_filter = false;
            //     data.open_commute_filter = false;

            //     if ($('.commute-time-dropdown').length && window.history && window.history.replaceState) {
            //         const currentUrlSplit = location.href.split( '?' );

            //         if (currentUrlSplit && currentUrlSplit.length > 1) {
            //             window.history.replaceState({}, document.title, currentUrlSplit[0] + '?' + currentUrlSplit[1].replace(/&?open_commute_filter=(1|true|0|false)&?/, ''))
            //         }

            //     }

            //     delete prev.open_commute_filter;
            //     $('#prevSearch').val(JSON.stringify(prev));
            // }

            $('#searchbox').val(prev.keyword);
            if (prev.living_cond.length) $('#livingCondReset').removeClass('invisible');
            if (prev.living_cond.find(q => q === 'co-living')) {
                data.cond_co_living = 1;
                $('.main-filter[data-param="cond_co_living"]').prop('checked', true);
            }
            if (prev.living_cond.find(q => q === 'entire-space')) {
                data.cond_entire_space = 1;
                $('.main-filter[data-param="cond_entire_space"]').prop('checked', true);
            }
            if (prev.type.length) $('#propertyTypeReset').removeClass('invisible');
            if (prev.type.find(q => q === 'apartment')) {
                data.type_apartment = 1;
                $('.main-filter[data-param="type_apartment"]').prop('checked', true);
            }
            if (prev.type.find(q => q === 'house')) {
                data.type_house = 1;
                $('.main-filter[data-param="type_house"]').prop('checked', true);
            }
            if (prev.price.length > 1) {
                $('#searchbox-slider-1-text-1').html(this.formatPrice(parseInt(prev.price[0])));
                $('#searchbox-slider-1-text-2').html(this.formatPrice(parseInt(prev.price[1])));
                data.min_price = parseInt(prev.price[0]);
                data.max_price = parseInt(prev.price[1]);
                utils.filterPrice = true;
                $('#priceReset').removeClass('invisible');
            }
            if (prev.bedroom.length) {
                data.bedroom = prev.bedroom;
                prev.bedroom.forEach(q => {
                    $(`.more-filter[data-type="bedroom"][data-id=${q}]`).parent().addClass('active');
                    $(`.more-filter[data-type="bedroom"][data-id=${q}]`).prop('checked', true);
                })
            }

            data.maps = (prev.maps === 'true' || prev.maps === '1' || prev.maps === 1 || prev.maps === true ? true : false) || false;

            data.id = prev.place_id;
            data.commute_detail = prev.commute_detail || 0;
            data.nearme = prev.nearme === 'true' || prev.nearme === '1' || prev.nearme === 1 || prev.nearme === true;
            data.time = prev.time || 0;
            data.commute_type = prev.commute_type || 0;
            data.is_commute = data.commute_detail && data.time && data.commute_type ? 1 : 0;

            if (data.is_commute) {
                $('#main-commute').val($('#keyword').val());
                $('.main-commute[data-type="time"]').val(prev.time).trigger('change');
                $('.main-commute[data-type="commute_type"]').val(prev.commute_type).trigger('change');
                $('#commute-location').val(prev.keyword);
                $('.commute-time[data-type="time"]').val(prev.time).trigger('change');
                $('.commute-time[data-type="commute_type"]').val(prev.commute_type).trigger('change');
                $('#commuteReset').removeClass('invisible');
            } else {
                $('.removeLocation[data-type="commute"]').hide();
                $('#commuteReset').addClass('invisible');
            }

            if (typeof prev.place_detail !== 'undefined') {
                let { lat, lng } = prev.place_detail.geometry.location;
                this.state.utils.lat = lat;
                this.state.utils.lng = lng;
                this.showMaps(lat, lng);
            } else {
                this.showMaps();
            }

            if (data.maps) {
                $(document).trigger('searchresult:map:show');
                $('#search-section').addClass('map-open');
                $('#btn-filter-show-map').addClass('active');
            }
        },
        initSearch: function () {
            let search = $('#prevSearch').val();
            this.initState();
            this.fetchData('/search/init', JSON.stringify({ search }))
                    .then(() => {
                        searchPage.state.init = 1;
                        $('html, body').animate({
                            scrollTop: 0
                        }, 500, 'swing');

                        searchPage.initStickyMaps();
                    })
        },
        mainFilter: function () {
            $('.main-filter').change(function () {
                let param = $(this).data('param');
                let type = $(this).data('type');
                let state = $(this).prop('checked');

                if (type === 'condition' && state) $('#livingCondReset').removeClass('invisible');
                if (type === 'property_type' && state) $('#propertyTypeReset').removeClass('invisible');

                let data = searchPage.state.data;
                data[param] = state ? 1 : 0;

                if (!data.cond_co_living && !data.cond_entire_space) $('#livingCondReset').addClass('invisible');
                if (!data.type_apartment && !data.type_house) $('#propertyTypeReset').addClass('invisible');
            });

            $('.search-filter-item').on('hide.bs.dropdown', function () {
                searchPage.state.data.page = 1;
                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false);
            });
            $('#livingCondApply').click(function () {
                searchPage.state.data.page = 1;
                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false);
            });

            $('#propertyTypeApply').click(function () {
                searchPage.state.data.page = 1;
                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false);
            });

            $('#livingCondReset').click(function () {
                $('.main-filter[data-type="condition"]').each(function () {
                    let param = $(this).data('param');
                    $(this).prop('checked', false);
                    searchPage.state.data[param] = 0;
                });
                $('#livingCondReset').addClass('invisible');
            });

            $('#propertyTypeReset').click(function () {
                $('.main-filter[data-type="property_type"]').each(function () {
                    let param = $(this).data('param');
                    $(this).prop('checked', false);
                    searchPage.state.data[param] = 0;
                });
                $('#propertyTypeReset').addClass('invisible');
            });

            $('#priceReset').click(function () {
                const range = document.getElementById('searchbox-slider-1').noUiSlider.options.range;
                document.getElementById('searchbox-slider-1').noUiSlider.set([range.min, range.max]);
                $('#searchbox-slider-1-text-1').html(searchPage.formatPrice(range.min));
                $('#searchbox-slider-1-text-2').html(searchPage.formatPrice(range.max));
                searchPage.state.data.min_price = range.min;
                searchPage.state.data.max_price = range.max;
                searchPage.state.utils.filterPrice = false;
                $('#priceReset').addClass('invisible');
            });

            $('#commuteReset').click(function() {
                $('.main-commute[data-type="time"]').val(5).trigger('change');
                $('.main-commute[data-type="commute_type"]').val('car').trigger('change');

                $('#commuteReset').addClass('invisible');
                $('.removeLocation[data-type="commute"]', '.commute-time-dropdown').hide();
                // $('#homeSearch').val('');
                $('#commute-location').val('');
                $('#main-commute').val('');

                $('#searchbox').val(searchPage.state.data.q);
                $('#keyword').val(searchPage.state.data.q);
                $('#lblMenu3').removeAttr('title').text($('#lblMenu3').data('placeholder'));

                searchPage.state.data.is_commute = false;
                searchPage.state.data.maps = false;
                searchPage.state.data.move_map = false;

                setTimeout(() => {
                    $(this).closest('.commute-time-dropdown').removeClass('show').data('halt', false);
                    $(this).closest('.dropdown-menu').dropdown('hide');
                }, 10);

                $.getJSON('/place-details', { place_id: searchPage.state.data.id }, function (data) {
                    let params = searchPage.buildParam();
                    searchPage.fetchData('/search/ajax', JSON.stringify(params), false, true)
                        .then(() => {
                            $(document).trigger('searchresult:refreshlayout');
                        });
                });

            })

            // $('body').on('click', function (e) {
            //     if (!$('.search-filterbox .fox-dropdown-nav').is(e.target)
            //         && $('.search-filterbox .fox-dropdown-nav').has(e.target).length === 0
            //         && $('.search-filterbox .show').has(e.target).length === 0
            //     ) {
            //         $('.search-filterbox .fox-dropdown-nav').removeClass('show');
            //         $('.search-filterbox .flying-dropdown').removeClass('show');
            //         searchPage.state.data.page = 1;
            //         let params = searchPage.buildParam();
            //         searchPage.fetchData('/search/ajax', JSON.stringify(params), false);
            //     }
            // });
        },
        filterPrice: function () {
            $('.apply-price').click(function () {
                searchPage.state.data.page = 1;
                searchPage.state.utils.filterPrice = true;
                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false);

                $('.search-filterbox .fox-dropdown-nav').removeClass('show');
                $('.search-filterbox .flying-dropdown').removeClass('show');

                $(this).closest('.fox-dropdown-nav').dropdown('hide');
            });
        },
        moreFilter: function () {
            $(document).on('change', '.more-filter', function () {
                let type = $(this).data('type');
                let id = $(this).data('id');
                let checked = $(this).prop('checked');
                let main = searchPage.state.data;
                let more = searchPage.state.data.moreFilter;

                if (type === 'cond' && id === 'co_living' && checked) {
                    main.cond_co_living = 1;
                    $('#colivingFiltered').show();
                }
                if (type === 'cond' && id === 'co_living' && !checked) {
                    main.cond_co_living = 0;
                    $('#colivingFiltered').hide();
                }
                if (type === 'cond' && id === 'entire_space' && checked) {
                    main.cond_entire_space = 1;
                    if (main.cond_co_living) $('#colivingFiltered').show();
                    else $('#colivingFiltered').hide();
                }
                if (type === 'cond' && id === 'entire_space' && !checked) {
                    main.cond_entire_space = 0;
                    $('#colivingFiltered').hide();
                }

                if (type === 'type_apartment' && checked) {
                    main.type_apartment = 1;
                    $('#apartmentFiltered').show();
                }
                if (type === 'type_apartment' && !checked) {
                    main.type_apartment = 0;
                    $('#apartmentFiltered').hide();
                }
                if (type === 'type_house' && checked) {
                    main.type_house = 1;
                    $('#houseFiltered').show();
                }
                if (type === 'type_house' && !checked) {
                    main.type_house = 0;
                    $('#houseFiltered').hide();
                }

                if (type === 'styles' && checked) more.styles.push(id);
                if (type === 'styles' && !checked) more.styles.splice(more.styles.indexOf(id), 1);
                if (type === 'amenities' && checked) more.amenities.push(id);
                if (type === 'amenities' && !checked) more.amenities.splice(more.amenities.indexOf(id), 1);
                if (type === 'facilities' && checked) more.facilities.push(id);
                if (type === 'facilities' && !checked) more.facilities.splice(more.facilities.indexOf(id), 1);
                if (type === 'floor_level' && checked) more.floor_level.push(id);
                if (type === 'floor_level' && !checked) more.floor_level.splice(more.floor_level.indexOf(id), 1);
                if (type === 'land_area' && checked) more.land_area.push(id);
                if (type === 'land_area' && !checked) more.land_area.splice(more.land_area.indexOf(id), 1);
                if (type === 'arrangement' && checked) more.arrangement.push(id);
                if (type === 'arrangement' && !checked) more.arrangement.splice(more.arrangement.indexOf(id), 1);
                if (type === 'property_furniture' && checked) more.property_furniture.push(id);
                if (type === 'property_furniture' && !checked) more.property_furniture.splice(more.property_furniture.indexOf(id), 1);
                if (type === 'bedroom_type' && checked) more.bedroom_type.push(id);
                if (type === 'bedroom_type' && !checked) more.bedroom_type.splice(more.bedroom_type.indexOf(id), 1);
                if (type === 'bedroom_furniture' && checked) more.bedroom_furniture.push(id);
                if (type === 'bedroom_furniture' && !checked) more.bedroom_furniture.splice(more.bedroom_furniture.indexOf(id), 1);

                if (type === 'pet_friendly') more.pet_friendly = checked;
                if (type === 'ensuite_bathroom') more.ensuite_bathroom = checked;
                if (type === 'view_360') more.view_360 = checked;

                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false, false);
            });

            $('input[name="range_of_stay"]').change(function () {
                [1, 3, 6, 12].forEach(q => {
                    $(`input[name="payment_options"][value="${q}"]`).attr('disabled', false).prop('checked', false).parent().show().removeClass('active');
                    if (!$('#search-popup').hasClass('show')) {
                        $(`input[name="payment_options"][value="${q}"]`).parent().prev().show();
                    }
                });
                switch ($(this).val()) {
                    case '3':
                        [3, 6].forEach(q => {
                            $(`input[name="payment_options"][value="${q}"]`).attr('disabled', true).parent().hide();
                            if (!$('#search-popup').hasClass('show')) {
                                $(`input[name="payment_options"][value="${q}"]`).parent().prev().hide();
                            }
                        })
                        break;
                    case '6':
                        $(`input[name="payment_options"][value="3"]`).attr('disabled', true).parent().hide();
                        if (!$('#search-popup').hasClass('show')) {
                            $(`input[name="payment_options"][value="3"]`).parent().prev().hide();
                        }
                        break;
                    case '9':
                        $(`input[name="payment_options"][value="6"]`).attr('disabled', true).parent().hide();
                        if (!$('#search-popup').hasClass('show')) {
                            $(`input[name="payment_options"][value="6"]`).parent().prev().hide();
                        }
                        break;
                }
            });
        },
        searchPreference: function () {
            $(document).on('change', '.search-preference', function () {
                let type = $(this).data('type');
                let id = $(this).data('id');
                let checked = $(this).prop('checked');
                let state = searchPage.state.data.preference;

                if (type === 'gender' && checked) state[id] = 1;
                if (type === 'gender' && !checked) state[id] = 0;
                if (type === 'hobbies' && checked) state.hobbies.push(id);
                if (type === 'hobbies' && !checked) state.hobbies.splice(state.hobbies.indexOf(id), 1);
                if (type === 'lifestyles' && checked) state.lifestyles.push(id);
                if (type === 'lifestyles' && !checked) state.lifestyles.splice(state.lifestyles.indexOf(id), 1);
                if (type === 'professions' && checked) state.professions.push(id);
                if (type === 'professions' && !checked) state.professions.splice(state.professions.indexOf(id), 1);
            });
        },
        actionFilter: function () {
            $('#cancelListing').click(function () {
                searchPage.state.data.moreFilter = {};
                const checkbox = ['floor_level', 'land_area', 'arrangement', 'property_furniture', 'bedroom_type', 'bedroom_furniture'];
                checkbox.forEach(type => {
                    $(`.more-filter[data-type="${type}"]`).each(function () {
                        $(this).parent().removeClass('active');
                        $(this).prop('checked', false);
                    });
                });

                const toggle = ['pet_friendly', 'ensuite_bathroom', 'view_360'];
                toggle.forEach(type => $(`.more-filter[data-type="${type}"]`).prop('checked', false));

                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false);
                $('#search-popup').removeClass('show');
                $('body').removeClass('search-open');
            });

            $('#resetListing').click(function () {
                searchPage.resetFilter();
                searchPage.filterLabel();
                $('#search-popup').removeClass('show');
                $('body').removeClass('search-open');
            });

            $('#showListing').click(function () {
                console.log(searchPage.state.data.nearme);
                debugger
                searchPage.state.data.page = 1;
                searchPage.state.data.q = $('#searchbox').val();
                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false);

                $('#keyword').val($('#searchbox').val());
                $('#search-popup').removeClass('show');
                $('body').removeClass('search-open');
                let lat = searchPage.state.utils.lat;
                let lng = searchPage.state.utils.lng;
                if (lat && lng) searchPage.showMaps(lat, lng);

                searchPage.savePreference();
                searchPage.saveRecentSearch(JSON.parse($('#recent_search').val()));
            });
        },
        savePreference: function () {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            let params = this.state.data.preference;
            if (params.from) {
                fetch('/search-preference', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify(params)
                })
                    .then(response => response.json())
                    .catch(error => console.log(error));
            }
        },
        resetFilter: function () {
            this.state.data = {
                _token: document.head.querySelector('meta[name="csrf-token"]').content,
                q: $('#searchbox').val(),
                cond_co_living: 0,
                cond_entire_space: 0,
                type_apartment: 0,
                type_house: 0,
                page: 1,
                min_price: 1,
                max_price: 3000000000,
                bedroom: 0,
                moreFilter: {
                    amenities: [],
                    facilities: [],
                    styles: [],
                    floor_level: [],
                    land_area: [],
                    arrangement: [],
                    property_furniture: [],
                    pet_friendly: 0,
                    bedroom_type: [],
                    bedroom_furniture: [],
                    ensuite_bathroom: 0
                },
                preference: {
                    is_mostly_male: 0,
                    is_mostly_female: 0,
                    hobbies: [],
                    lifestyles: [],
                    professions: [],
                    from: '',
                    min_age: 1,
                    max_age: 60,
                }
            };
            this.state.utils.filterPrice = false;

            const mainfilter = ['lbl_coliving', 'lbl_entire', 'lbl_apartment', 'lbl_house'];
            mainfilter.forEach(label => $(`#${label}`).removeClass('focus active'));

            $('#searchbox-slider-1-text-1').html(1);
            $('#searchbox-slider-1-text-2').html(3000000000);

            const bedrooms = [1, 2, 3, 4, 5];
            bedrooms.forEach(q => {
                $(`.more-filter[data-type="bedroom"][data-id=${q}]`).parent().removeClass('active');
                $(`.more-filter[data-type="bedroom"][data-id=${q}]`).prop('checked', false);
            });

            const checkbox = ['floor_level', 'land_area', 'arrangement', 'property_furniture', 'bedroom_type', 'bedroom_furniture'];
            checkbox.forEach(type => {
                $(`.more-filter[data-type="${type}"]`).each(function () {
                    $(this).parent().removeClass('active');
                    $(this).prop('checked', false);
                });
            });

            const toggle = ['pet_friendly', 'ensuite_bathroom', 'view_360'];
            toggle.forEach(type => $(`.more-filter[data-type="${type}"]`).prop('checked', false));

            const slider = ['searchbox-slider', 'searchbox-slider-1'];
            slider.forEach(slide => {
                const element = document.getElementById(slide);
                element.noUiSlider.set([1, 3000000000]);
            });

            const ageSlider = document.getElementById('searchbox-slider-3');
            ageSlider.noUiSlider.set([18, 60]);
            $('#searchbox-slider-3-text-1').html('18');
            $('#searchbox-slider-3-text-2').html('60+');
            $('#hometown').val('');
            $(`.search-preference[data-type="gender"]`).each(function () {
                $(this).parent().removeClass('active');
                $(this).prop('checked', false);
            });
        },
        paginateData: function () {
            $(document).on('click', '.page-filter', function () {
                let param = $(this).data('page');
                searchPage.state.data.page = param;
                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false);
            })
        },
        autoCompleteLocation: function () {
            $('#searchbox').autoComplete({
                minChars: 3,
                source: function (term, response) {
                    $.getJSON('/place-auto-complete', { place_name: term, restrict_place: true }, function (data) {
                        response(data.predictions);
                    });
                },
                renderItem: function (item, search) {
                    return `<div class="autocomplete-suggestion" data-id="${item.id}" data-place_id="${item.place_id}"
                    data-place="${item.description}">${item.description}</div>`;
                },
                onSelect: function (e, term, item) {
                    $('#searchbox').val(item.data('place'));
                    $('#keyword').val(item.data('place'));
                    $('#homeSearch').val(item.data('place'));
                    $('.removeLocation').show();
                    $('.removeLocation[data-type="commute"]').hide();

                    $.getJSON('/place-details', { place_id: item.data('place_id') }, function (data) {
                        let saveSearch = {
                            instance_id: searchPage.getCookie('instanceId') || '',
                            place_id: data.result.place_id,
                            location: searchPage.getAddressNameFromAddressComponents(data.result.address_components),
                            full_location: data.result.formatted_address
                        }
                        $('#recent_search').val(JSON.stringify(saveSearch));

                        searchPage.state.data.q = data.result.formatted_address;
                        searchPage.state.data.page = 1;
                        searchPage.state.data.id = item.data('place_id');
                        searchPage.state.data.nearme = 0;
                        searchPage.state.data.location = saveSearch.location;
                        searchPage.state.data.is_commute = 0;
                        searchPage.state.data.move_map = false;
                        searchPage.state.utils.lat = data.result.geometry.location.lat;
                        searchPage.state.utils.lng = data.result.geometry.location.lng;

                        if (searchPage.state.data.maps) $('#moveMap').prop('checked', false);

                        let params = searchPage.buildParam();
                        searchPage.fetchData('/search/ajax', JSON.stringify(params), false, false);
                    });
                }
            });

            $('#hometown').autoComplete({
                minChars: 3,
                source: function (term, response) {
                    $.getJSON('/place-auto-complete', { place_name: term }, function (data) {
                        response(data.predictions);
                    });
                },
                renderItem: function (item, search) {
                    return `<div class="autocomplete-suggestion" data-id="${item.id}" data-place_id="${item.place_id}"
                    data-place="${item.description}">${item.description}</div>`;
                },
                onSelect: function (e, term, item) {
                    $('#hometown').val(item.data('place'));
                    searchPage.state.data.preference.from = item.data('place');
                }
            });

            $('#keyword').autoComplete({
                minChars: 3,
                source: function (term, response) {
                    $.getJSON('/place-auto-complete', { place_name: term, restrict_place: true }, function (data) {
                        response(data.predictions);
                    });
                },
                renderItem: function (item, search) {
                    return `<div class="autocomplete-suggestion" data-id="${item.id}" data-place_id="${item.place_id}"
                    data-place="${item.description}">${item.description}</div>`;
                },
                onSelect: function (e, term, item) {
                    $('#keyword').val(item.data('place'));
                    $('#searchbox').val(item.data('place'));
                    $('#homeSearch').val(item.data('place'));
                    $('.removeLocation').show();
                    $('.removeLocation[data-type="commute"]').hide();
                    $('.commute-time-dropdown').data('halt', true);

                    $.getJSON('/place-details', { place_id: item.data('place_id') }, function (data) {
                        let saveSearch = {
                            instance_id: searchPage.getCookie('instanceId') || '',
                            place_id: data.result.place_id,
                            location: searchPage.getAddressNameFromAddressComponents(data.result.address_components),
                            full_location: data.result.formatted_address
                        }
                        searchPage.saveRecentSearch(saveSearch);

                        searchPage.state.data.q = data.result.formatted_address;
                        searchPage.state.data.page = 1;
                        searchPage.state.data.id = item.data('place_id');
                        searchPage.state.data.maps = true;
                        searchPage.state.data.move_map = false;
                        searchPage.state.data.nearme = 0;
                        searchPage.state.data.location = saveSearch.location;
                        searchPage.state.data.is_commute = 0;
                        searchPage.state.utils.lat = data.result.geometry.location.lat;
                        searchPage.state.utils.lng = data.result.geometry.location.lng;

                        if (searchPage.state.data.maps) $('#moveMap').prop('checked', false);
                        if (!$('#btn-filter-show-map').hasClass('active')) {
                            searchPage.openSearchSection($('#btn-filter-show-map'), 'map-open');
                        }

                        let params = searchPage.buildParam();
                        searchPage.fetchData('/search/ajax', JSON.stringify(params), false, true);
                    });
                }
            });

            $('#commute-location').autoComplete({
                minChars: 3,
                source: function(term, response){
                    $.getJSON('/place-auto-complete', { place_name: term, restrict_place: true }, function(data){
                        response(data.predictions);
                    });
                },
                renderItem: function (item, search) {
                    return `<div class="autocomplete-suggestion" data-id="${item.id}" data-place_id="${item.place_id}"
                    data-place="${item.description}">${item.description}</div>`;
                },
                onSelect: function(e, term, item) {
                    $('#commute-location').val(item.data('place'));
                    $('#searchbox').val(item.data('place'));
                    $('#keyword').val(item.data('place'));
                    $('#homeSearch').val(item.data('place'));
                    $('.removeLocation').show();

                    $.getJSON('/place-details', { place_id: item.data('place_id') }, function(data) {
                        let saveSearch = {
                            instance_id: searchPage.getCookie('instanceId') || '',
                            place_id: data.result.place_id,
                            location: searchPage.getAddressNameFromAddressComponents(data.result.address_components),
                            full_location: data.result.formatted_address
                        }
                        $('#recent_search').val(JSON.stringify(saveSearch));

                        searchPage.state.data.q = data.result.formatted_address;
                        searchPage.state.data.page = 1;
                        searchPage.state.data.id = item.data('place_id');
                        searchPage.state.data.nearme = 0;
                        searchPage.state.data.is_commute = 1;
                        searchPage.state.data.maps = true;
                        searchPage.state.data.move_map = false;
                        searchPage.state.utils.lat = data.result.geometry.location.lat;
                        searchPage.state.utils.lng = data.result.geometry.location.lng;
                        searchPage.state.data.time = $('.commute-time[data-type="time"] option:selected').val();
                        searchPage.state.data.commute_type = $('.commute-time[data-type="commute_type"] option:selected').val();

                        if (searchPage.state.data.maps) $('#moveMap').prop('checked', false);
                        if (!$('#btn-filter-show-map').hasClass('active')) {
                            searchPage.openSearchSection($('#btn-filter-show-map'), 'map-open');
                        }

                        let params = searchPage.buildParam();
                        searchPage.fetchData('/search/ajax', JSON.stringify(params), false, false);
                    });
                }
            });

            $('#main-commute').autoComplete({
                minChars: 3,
                source: function(term, response){
                    $.getJSON('/place-auto-complete', { place_name: term, restrict_place: true }, function(data){
                        response(data.predictions);
                    });
                },
                renderItem: function (item, search) {
                    return `<div class="autocomplete-suggestion" data-id="${item.id}" data-place_id="${item.place_id}"
                    data-place="${item.description}">${item.description}</div>`;
                },
                onSelect: function(e, term, item) {
                    $('#main-commute').val(item.data('place'));
                    $('#commute-location').val(item.data('place'));
                    // $('#searchbox').val(item.data('place'));
                    // $('#keyword').val(item.data('place'));
                    $('#homeSearch').val(item.data('place'));
                    $('.removeLocation').show();
                    // $('#commuteReset').removeClass('invisible');
                    //debugger

                    $('.commute-time-dropdown').data('halt', true).data('has_autocomplete', true);

                    $.getJSON('/place-details', { place_id: item.data('place_id') }, function(data) {
                        let saveSearch = {
                            instance_id: searchPage.getCookie('instanceId') || '',
                            place_id: data.result.place_id,
                            location: searchPage.getAddressNameFromAddressComponents(data.result.address_components),
                            full_location: data.result.formatted_address
                        }
                        $('#recent_search').val(JSON.stringify(saveSearch));

                        searchPage.state.data.q = data.result.formatted_address;
                        searchPage.state.data.location = searchPage.getAddressNameFromAddressComponents(data.result.address_components),
                        searchPage.state.data.page = 1;
                        searchPage.state.data.id = item.data('place_id');
                        searchPage.state.data.nearme = 0;
                        searchPage.state.data.is_commute = 1;
                        searchPage.state.data.maps = true;
                        searchPage.state.data.move_map = false;
                        searchPage.state.utils.lat = data.result.geometry.location.lat;
                        searchPage.state.utils.lng = data.result.geometry.location.lng;
                        searchPage.state.data.time = $('.main-commute[data-type="time"] option:selected').val();
                        searchPage.state.data.commute_type = $('.main-commute[data-type="commute_type"] option:selected').val();
                    });
                }
            });


            $('.commute-time-dropdown').on({
                'hide.bs.dropdown': function (e) {
                    if ($('.commute-time-dropdown').data('halt')) {
                        e.preventDefault();
                    } else {
                        $(document).off('click.commutetimedropdown');
                        $('.commute-time-dropdown').removeClass('show');
                    }
                },
                'hidden.bs.dropdown': function () {
                    setTimeout(() => {
                        $('.commute-time-dropdown').removeClass('show');
                    }, 10);
                },
                'show.bs.dropdown': function (e) {
                    $('.commute-time-dropdown').data('halt', true).data('has_autocomplete', false);

                    $(document).on('click.commutetimedropdown', function (e) {
                        const $el = $(e.target);

                        if ((!($el.closest('.commute-time-dropdown') && $el.hasClass('dropdown-menu') || $el.closest('.dropdown-menu').length)) || !($el.hasClass('.autocomplete-suggestions') || $el.closest('.autocomplete-suggestions').length)) {
                            if (!$('.commute-time-dropdown').data('has_autocomplete')) {
                                $('.commute-time-dropdown').data('halt', false);
                                $('.commute-time-dropdown .dropdown-menu').dropdown('hide');
                            } else {
                                $('.commute-time-dropdown').data('has_autocomplete', false);
                            }
                         }
                    });
                }
            });
        },
        setCookie: function (name, value) {
            document.cookie = name + '=' + value;
        },
        getCookie: function (name) {
            return document.cookie.split('; ').reduce((r, v) => {
                const parts = v.split('=');
                return parts[0] === name ? parts[1] : r;
            }, '')
        },
        saveRecentSearch: function (place) {
            let instance_id = '';
            let place_id = place.place_id;
            let location = place.location;
            let full_location = place.full_location;
            let token = document.head.querySelector('meta[name="csrf-token"]');

            if (this.getCookie('instanceId')) {
                let instance = this.getCookie('instanceId');
                instance_id = instance;
            } else {
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
        recentSearch: function () {
            $(document).on('change', '.recent-search', function () {
                let id = $(this).data('id');
                let placeId = $(this).data('place_id');
                let param = $(this).data('param');

                $('#searchbox').val(id);
                $('#keyword').val(id);
                $('#recent_search').val(JSON.stringify(param));
                $('.removeLocation').show();
                if (!searchPage.state.data.is_commute) $('.removeLocation[data-type="commute"]').hide();

                searchPage.state.data.q = id;
                searchPage.state.data.id = placeId;

                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false, false);
            });
        },
        removeLocation: function () {
            $('.searchbox-input').keyup(function () {
                if ($(this).val() == '') {
                    $('.removeLocation').hide();
                } else {
                    if ($(this).data('type') === 'commute') {
                        $('.removeLocation').hide();
                        $('.removeLocation[data-type="commute"]').show();
                    } else {
                        $('.removeLocation').show();
                        $('.removeLocation[data-type="commute"]').hide();
                    }
                }
            });

            $('.removeLocation:not([data-type="commute"])').click(function () {
                $('.removeLocation').hide();
                $('#searchbox').val('');
                $('#homeSearch').val('');
                $('#keyword').val('');
                $('#commute-location').val('');
                $('#main-commute').val('');
                searchPage.state.data.q = '';
            });
            $('.removeLocation[data-type="commute"]', '.commute-time-dropdown').click(function () {
                $(this).hide();
                $('#main-commute').val('');
            });
        },
        slider: function () {
            let state = this.state.data;
            let pricePopupSlider = document.getElementById('searchbox-slider-2');
            noUiSlider.create(pricePopupSlider, {
                start: [state.min_price, state.max_price],
                connect: true,
                range: {
                    'min': 0,
                    'max': 3000000000,
                },
            }).on('slide', function (values, handle) {
                let formatMinPrice = searchPage.formatPrice(values[0]);
                let formatMaxPrice = searchPage.formatPrice(values[1]);
                $('#searchbox-slider-2-text-1').html(formatMinPrice);
                $('#searchbox-slider-2-text-2').html(formatMaxPrice);
                state.min_price = parseInt(values[0]) || 1;
                state.max_price = parseInt(values[1]);
                searchPage.state.utils.filterPrice = true;
            });

            let priceSlider = document.getElementById('searchbox-slider-1');
            noUiSlider.create(priceSlider, {
                start: [state.min_price, state.max_price],
                connect: true,
                range: {
                    'min': 0,
                    'max': 3000000000,
                },
            }).on('slide', function (values, handle) {
                let formatMinPrice = searchPage.formatPrice(values[0]);
                let formatMaxPrice = searchPage.formatPrice(values[1]);
                $('#searchbox-slider-1-text-1').html(formatMinPrice);
                $('#searchbox-slider-1-text-2').html(formatMaxPrice);
                state.min_price = parseInt(values[0]) || 1;
                state.max_price = parseInt(values[1]);
                searchPage.state.utils.filterPrice = true;
                $('#priceReset').removeClass('invisible');
            });

            let ageSlider = document.getElementById('searchbox-slider-3');
            noUiSlider.create(ageSlider, {
                start: [18, 60],
                connect: true,
                step: 1,
                range: {
                    'min': 18,
                    'max': 60,
                },
                format: {
                    from: function (value) {
                        return parseInt(value);
                    },
                    to: function (value) {
                        return parseInt(value);
                    }
                },
            }).on('slide', function (values, handle) {
                let maxAge = values[1] === 60 ? '60+' : values[1];
                $('#searchbox-slider-3-text-1').html(values[0]);
                $('#searchbox-slider-3-text-2').html(maxAge);
                searchPage.state.data.preference.min_age = parseInt(values[0]);
                searchPage.state.data.preference.max_age = parseInt(values[1]);
            });
        },
        buildParam: function () {
            let state = this.state.data;
            Object.filter = (obj, predicate) => Object.assign(...Object.keys(obj)
            .filter(key => predicate(obj[key]))
            .map(key => ({ [key]: obj[key] })));
            
            let filteredState = Object.filter(state, q => q !== 0);

            if (state.bedroom.length) {
                state.bedroom.forEach(q => {
                    filteredState[`bedroom_${q}`] = 1
                });
                delete filteredState.bedroom;
            }

            return filteredState;
        },
        filterLabel: function () {
            const { data, utils } = this.state;

            if (data.cond_co_living && data.cond_entire_space) $('#lblMenu1').text('Co-living, Entire space');
            if (!data.cond_co_living && !data.cond_entire_space) $('#lblMenu1').text('Select living condition');
            if (data.cond_co_living && !data.cond_entire_space) $('#lblMenu1').text('Co-Living');
            if (!data.cond_co_living && data.cond_entire_space) $('#lblMenu1').text('Entire-Space');
            if (data.type_apartment && data.type_house) $('#lblMenu2').text('Apartment, House');
            if (!data.type_apartment && !data.type_house) $('#lblMenu2').text('Select property type');
            if (data.type_apartment && !data.type_house) $('#lblMenu2').text('Apartment');
            if (!data.type_apartment && data.type_house) $('#lblMenu2').text('House');

            if (data.is_commute && data.time && data.commute_type) {
                // let lblCommute = `${data.time} to ${data.q.split(',')[0]} by ${data.commute_type}`;
                // lblCommute = lblCommute.length > 20 ? `${lblCommute.slice(0,20)}...` : lblCommute;
                let lblCommute = $(`.main-commute[data-type="time"] option[value="${data.time}"]`).text();
                lblCommute += ' ' + $(`.main-commute[data-type="time"]`).closest('.row').children().eq(1).text();
                lblCommute += ' ' + (searchPage.state.data.location || searchPage.state.data.q.split(',')[0]);
                lblCommute += ' ' + $(`.main-commute[data-type="time"]`).closest('.row').children().eq(3).text();
                lblCommute += ' ' + ($(`.main-commute[data-type="commute_type"] option[value="${data.commute_type}"]`).text() || '').toLowerCase();
                lblCommute = lblCommute.replace(/\s+/g,' ');

                let maxLblLength = 29;
                $('#lblMenu3').attr('title', lblCommute).html(lblCommute.slice(0, maxLblLength) + (lblCommute.length > maxLblLength ? '&hellip;' : ''));
                $('#searchbox').val(lblCommute);
                $('#keyword').val(lblCommute);
            } else {
                $('#lblMenu3').removeAttr('title').text($('#lblMenu3').data('placeholder'));
                $('.commute-time-dropdown').removeClass('show');
            }

            if (data.cond_co_living) $('.main-filter[data-param="cond_co_living"]').prop('checked', true);
            else $('.main-filter[data-param="cond_co_living"]').prop('checked', false);

            if (data.cond_entire_space) $('.main-filter[data-param="cond_entire_space"]').prop('checked', true);
            else $('.main-filter[data-param="cond_entire_space"]').prop('checked', false);

            if (data.type_apartment) $('.main-filter[data-param="type_apartment"]').prop('checked', true);
            else $('.main-filter[data-param="type_apartment"]').prop('checked', false);

            if (data.type_house) $('.main-filter[data-param="type_house"]').prop('checked', true);
            else $('.main-filter[data-param="type_house"]').prop('checked', false);

            if (utils.filterPrice) {
                let priceRange = `${this.formatPrice(data.min_price)} - ${this.formatPrice(data.max_price)}`;
                $('#lblMenu5').text(priceRange);
                const element = document.getElementById('searchbox-slider-1');
                element.noUiSlider.set([data.min_price, data.max_price]);
                $('#searchbox-slider-1-text-1').html(searchPage.formatPrice(data.min_price));
                $('#searchbox-slider-1-text-2').html(searchPage.formatPrice(data.max_price));
            }
            if (!utils.filterPrice) {
                $('#lblMenu5').text('Select budget range');
            }
        },
        formatPrice: function (price) {
            return accounting.formatMoney(price, 'IDR ', 0, '.');
        },
        togglePropertyType: function () {
            $(document).on('click', '.card-tag', function () {
                if (!$(this).hasClass('card-tag-outline')) {
                    return;
                }

                let state = $(this).data('active');
                let type = $(this).data('type');
                let id = $(this).data('id');
                let price = searchPage.formatPrice($(this).data('price'));
                let img = $(this).data('img');
                let room = $(this).data('room');

                if (type === 'coliving') {
                    $(`#tag-left-${id}`).data('active', 0).removeClass('card-tag-outline');
                    $(`#tag-right-${id}`).data('active', 1).addClass('card-tag-outline');
                    $(`#price-${id}`).text(`${price} / Room / Month`);
                    $(`#icon-${id}`).attr('src', img);
                    $(`#room-${id}`).text(room);
                } else {
                    $(`#tag-left-${id}`).data('active', 1).addClass('card-tag-outline');
                    $(`#tag-right-${id}`).data('active', 0).removeClass('card-tag-outline');
                    $(`#price-${id}`).text(`${price} / Month`);
                    $(`#icon-${id}`).attr('src', img);
                    $(`#room-${id}`).text(room);
                }
            });
        },
        setNewLocation: function (latitude, longitude, radius = 50) {
            let earth = 6378.137;
            let lat = (1 / ((2 * Math.PI / 360) * earth)) / 1000
            let lng = (1 / ((2 * Math.PI / 360) * earth)) / 1000;

            let newLongitude = longitude + (radius * lng) / Math.cos(latitude * (Math.PI / 180));
            let newLatitude = latitude + (radius * lat);

            return {
                lat: newLatitude,
                lng: newLongitude
            }
        },
        addFavorite: function () {
            if ($('#auth').length) {
                $(document).on('click', '.add-favorite', function () {
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
        fetchData: function (url, data, init = 1, renderData = 1) {
            let token = document.head.querySelector('meta[name="csrf-token"]');

            if (init || !this.state.data.maps) {
                $(".main-content").hide();
                $('#loading-wrapper').show();
            } else {
                $("#search-section .grid-content").hide();
                $(".loading-wrapper-grid").show();
            }

            $('html, body').animate({
                scrollTop: 0
            }, 500, 'swing');

            return fetch(url, {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token.content
                },
                body: data
            })
                .then(response => response.json())
                .then(data => {
                    if (!init) {
                        searchPage.state.utils.init = false;
                        history.pushState('', '', `/${data.url}`);
                    } else {
                        $('#showListing span').text(data.items.total);
                        if (!searchPage.state.utils.filterPrice) {
                            searchPage.state.data.min_price = data.price.min_price;
                            searchPage.state.data.max_price = data.price.max_price;
                            ['searchbox-slider-1', 'searchbox-slider-2'].forEach(q => {
                                $('#' + q + '-text-1').html(searchPage.formatPrice(data.price.min_price));
                                $('#' + q + '-text-2').html(searchPage.formatPrice(data.price.max_price));
                            });
                        } else {
                            ['searchbox-slider-1', 'searchbox-slider-2'].forEach(q => {
                                $('#' + q + '-text-1').html(searchPage.formatPrice(searchPage.state.data.min_price));
                                $('#' + q + '-text-2').html(searchPage.formatPrice(searchPage.state.data.max_price));
                            });
                        }
                    }
                    
                    if (!renderData) {
                        $('#showListing span').text(data.items.total);
                        return data.items.total;
                    }
                    console.log('test commute');
                    
                    const slider = ['searchbox-slider-1', 'searchbox-slider-2'];
                    slider.forEach(slide => {
                        const element = document.getElementById(slide);
                        if (init && !searchPage.state.utils.filterPrice) {
                            element.noUiSlider.set([data.price.min_price, data.price.max_price]);
                        }
                        if (init && searchPage.state.utils.filterPrice) {
                            element.noUiSlider.set([searchPage.state.data.min_price, searchPage.state.data.max_price]);
                        }
                        element.noUiSlider.updateOptions({
                            range: {
                                'min': data.price.min_price,
                                'max': data.price.max_price
                            }
                        });
                    });

                    this.normalizeResult();

                    let utils = searchPage.state.utils;
                    utils.totalData = data.items.total;
                    utils.totalPage = data.items.last_page;

                    if (typeof data.search.commute_detail != "undefined") {
                        var commuteDetail = data.search.commute_detail;
                        var coordinates = commuteDetail.features[0].geometry.coordinates[0];
                        searchMap.showIsochrone(coordinates);
                    }

                    if (data.items.total) {
                        $('#resultCount').show();
                        $('#listingFound').text(data.items.total);

                        searchPage.state.data.page = data.items.current_page;
                        searchPage.filterLabel();
                        return searchPage.renderData(data.items.data);
                    }

                    if (searchPage.state.data.nearme) {
                        // searchMap.clearCircle();
                    }
                    

                    return this.showEmptyResult();
                })
                .catch(error => console.log(error));
        },
        renderData: function (data) {
            let resultList = document.getElementById('results');
            let count = data.length;

            if (!searchPage.state.data.move_map) {
                searchMap.panTo({
                    lat: searchPage.state.utils.lat,
                    lng: searchPage.state.utils.lng
                })
            } else {
                searchMap.clearCircle();
                if (searchPage.state.data.is_commute) {
                    searchMap.addMarker({
                        lat: searchPage.state.utils.lat,
                        lng: searchPage.state.utils.lng,
                    })
                } else {
                    searchMap.clearMarker();
                }
            }

            searchMap.fitBounds(data);
            // debugger

            data.forEach((q, i) => {
                const tmpl = searchPage.renderCard(q, i);
                resultList.appendChild(tmpl);

                if (i === 7) {
                    let discover = searchPage.renderDiscover();
                    resultList.appendChild(discover);
                }

                if (i === 15) {
                    let pagination = searchPage.renderPagination();
                    resultList.appendChild(pagination);
                }

                if (i + 1 === count && count < 8) {
                    let discover = searchPage.renderDiscover();
                    resultList.appendChild(discover);
                }

                if (i + 1 === count && count < 16) {
                    let pagination = searchPage.renderPagination();
                    resultList.appendChild(pagination);
                }

                if (searchPage.state.data.maps) {
                    $('#promo').children().addClass('cols-discover-lists');
                } else {
                    $('#promo').children().removeClass('cols-discover-lists');
                }

                var $price = 0;
                var divPrice = document.createElement("div");
                if (q.rented_room < q.total_room && q.is_co_living) {
                    $price = q.co_living_min_price;
                }
                if (q.available_room === q.total_room && q.is_entire_space) {
                    if (!q.is_co_living) {
                        $price = q.entire_space_min_price;
                    }
                }

                const param = JSON.stringify(q);
                const element = '{}';//JSON.stringify($(this));

                divPrice.innerHTML = '<div class="popup-bubble-content"></div>';
                divPrice.innerHTML += `<div class="popup-property open-popup" data-index='${i+16}' property-id="${q.id}" data-element='${element}' data-param='${param}' data-lat="${q.latitude}" data-lng="${q.longitude}">${searchPage.formatPrice($price)}</div>`;

                //let setRadius = (max, min) => Math.floor(Math.random() * (max - min + 1)) + min;
                let { lat, lng } = this.setNewLocation(parseFloat(q.latitude), parseFloat(q.longitude), 30);
                window.searchMap.addPopup(lat, lng, divPrice);
            });

            if (searchPage.state.utils.init || !searchPage.state.data.maps) {
                $('#loading-wrapper').hide();
                $(".main-content").show();
            } else {
                $(".loading-wrapper-grid").hide();
                $("#search-section .grid-content").show();
            }

            $('html, body').animate({
                scrollTop: 0
            }, 500, 'swing');

            searchPage.mapsEvent();
        },
        renderCard: function (q, i) {
            let tmpl = document.getElementById('result-item').content.cloneNode(true);
            const url = `/property/${q.id}/${q.slug_url}`;

            tmpl.querySelector('.card-property').id = q.id;
            tmpl.querySelector('.card-title').innerHTML = `<a href="${url}" title="${q.title}" target="_blank">${q.title}</a>`;
            tmpl.querySelector('.address').innerText = `${q.district}, ${q.city}`;
            tmpl.querySelector('.address').setAttribute('title', `${q.district}, ${q.city}`);
            tmpl.querySelector('.room-size').innerText = q.unit_size;
            tmpl.querySelector('.tag-info-bottom').innerText = ''

            if (q.property_style && q.property_style.length && q.property_style[0].style && q.property_style[0].style.name) {
                tmpl.querySelector('.tag-info-bottom').innerText = '#'+q.property_style[0].style.name;
            }

            let tags = '';
            if (q.rented_room < q.total_room && q.is_co_living) {
                let price = searchPage.formatPrice(q.co_living_min_price);
                let room = `${q.rented_room} / ${q.total_room}`;

                tags += `<span id="tag-left-${i}" class="card-tag fox-btn-left" data-id="${i}" data-type="coliving" data-active="1" data-img="/img/coliving-icon.png" data-room="${room}" data-price="${q.co_living_min_price}">Co Living</span> `;
                tmpl.querySelector('.starting-price').id = `price-${i}`;
                tmpl.querySelector('.starting-price').innerText = `${price} / Room / Month`;
                tmpl.querySelector('.img-type').id = `icon-${i}`;
                tmpl.querySelector('.available-room').id = `room-${i}`;
                tmpl.querySelector('.available-room').innerText = room;
            }
            if (q.available_room === q.total_room && q.is_entire_space) {
                let state = q.rented_room === 0 && q.is_co_living ? 'card-tag-outline' : '';
                let price = searchPage.formatPrice(q.entire_space_min_price);

                tags += `<span id="tag-right-${i}" class="card-tag fox-btn-right ${state}" data-id="${i}" data-type="entire" data-active="0" data-img="/img/ic_bedroom.png" data-room="${q.total_room}" data-price="${q.entire_space_min_price}">Entire House</span>`;
                if (!q.is_co_living) {
                    tmpl.querySelector('.starting-price').id = `price-${i}`;
                    tmpl.querySelector('.starting-price').innerText = `${price} / Month`;
                    tmpl.querySelector('.img-type').id = `icon-${i}`;
                    tmpl.querySelector('.img-type').src = `/img/ic_bedroom.png`;
                    tmpl.querySelector('.available-room').id = `room-${i}`;
                    tmpl.querySelector('.available-room').innerText = `${q.total_room}`;
                }
            }

            if (!tags) {
                tags = '&nbsp;';
            }

            tmpl.querySelector('.tags').innerHTML = tags;

            let navigation = document.getElementById('navigation').content.cloneNode(true);
            navigation.querySelector('.carousel-control-prev').href = `#carousel-search-item-${i}`;
            navigation.querySelector('.carousel-control-next').href = `#carousel-search-item-${i}`;
            tmpl.querySelector('.carousel').appendChild(navigation);

            let carousel = searchPage.renderImage({ photos: q.photos, pageUrl: url, id: i });
            tmpl.querySelector('.card-img-top').id = `carousel-search-item-${i}`;
            tmpl.querySelector('.carousel-inner').innerHTML = carousel[0];
            tmpl.querySelector('.carousel-indicators').innerHTML = carousel[1];

            if ($('#auth').length) {
                let liked = $('#auth').data('liked');
                tmpl.querySelector('.btn-favorite').setAttribute('data-id', q.id);
                if (liked.includes(q.id)) {
                    tmpl.querySelector('.btn-favorite').classList.add('like-active');
                }
            }

            return tmpl;
        },
        renderDiscover: function (emptyResult = false) {
            let state = this.state.data;

            let discover = document.getElementById('discover').content.cloneNode(true);
            let coliving = document.getElementById('d_coliving').content.cloneNode(true);
            let worker = document.getElementById('d_worker').content.cloneNode(true);
            let family = document.getElementById('d_family').content.cloneNode(true);

            if (state.cond_entire_space || emptyResult) discover.querySelector('.discover-list').appendChild(coliving);
            discover.querySelector('.discover-list').appendChild(worker);
            if (state.cond_co_living || emptyResult) discover.querySelector('.discover-list').appendChild(family);

            return discover;
        },
        renderPagination: function () {
            let pagination = document.getElementById('pagination').content.cloneNode(true);

            let totalPage = this.state.utils.totalPage;
            let currentPage = this.state.data.page;
            let prev = currentPage === 1 ? 1 : currentPage - 1;
            let next = currentPage === totalPage ? totalPage : currentPage + 1;

            let pages = `<li class="mr-30"><button class="btn btn-primary page-filter custom-btn-pagination-cursor left-arrow" data-page="${prev}"><i class="moon-long-arrow"></i></button></li>`;
            for (let i = 1; i <= totalPage; i++) {
                let active = currentPage === i ? 'active' : '';
                pages += `<li class="mr-5"><button class="btn btn-primary page-filter custom-btn-pagination ${active}" data-page=${i}>${i}</button></li>`
            }
            pages += `<li class="ml-30"><button class="btn btn-primary page-filter custom-btn-pagination-cursor right-arrow" data-page="${next}"><i class="moon-long-arrow"></i></button></li>`;

            pagination.querySelector('.pagination').innerHTML = pages;
            return pagination;
        },
        renderImage: function ({ photos, pageUrl, id }) {
            let images = '';
            let buttons = '';

            photos && photos.length && photos[0].thumb_images && photos[0].thumb_images.length && photos[0].thumb_images.forEach((q, i) => {
                images += `<a href="${pageUrl}" class="carousel-item ${i === 0 ? 'active' : ''}" target="_blank"><img class="d-block w-100" src="${q.url}"></a>`;
                buttons += `<li data-target="#carousel-search-item-${id}" data-slide-to="${i}" class="${i === 0 ? 'active' : ''}"></li>`
            });

            return [images, buttons];
        },
        showEmptyResult: function () {
            let notFound = document.getElementById('resultEmpty');
            let tmplNotFound = document.getElementById('not-found').content.cloneNode(true);
            let tmplDiscover = this.renderDiscover(true);

            $('#resultCount').hide();
            notFound.appendChild(tmplNotFound);
            notFound.appendChild(tmplDiscover);

            if (searchPage.state.data.maps) {
                $('#promo').children().addClass('cols-discover-lists');
            } else {
                $('#promo').children().removeClass('cols-discover-lists');
            }

            $('#loading-wrapper').hide();
            $(".main-content").show();
            $(".loading-wrapper-grid").hide();
            $("#search-section .grid-content").show();
        },
        normalizeResult: function () {
            $('div#resultEmpty').empty();
            $('div#results').empty();
            $('.map').removeClass('invisible');
            window.searchMap.clearPopup();
        },
        fetchAmenities: function () {
            let amenities = this.state.data.moreFilter.amenities;
            $('span#amenities').empty();
            fetch('/amenities')
                .then(response => response.json())
                .then(data => {
                    let output = document.getElementById('amenities');

                    return data.items.forEach(q => {
                        let tmpl = document.getElementById('amenityFacility').content.cloneNode(true);
                        if (amenities.includes(q.id)) tmpl.querySelector('.btn-checkbox').classList.add('active');
                        tmpl.querySelector('.item-name').innerText = q.name;
                        tmpl.querySelector('.more-filter').setAttribute('data-id', q.id);
                        tmpl.querySelector('.more-filter').setAttribute('data-type', 'amenities');
                        output.append(tmpl);
                    })
                }).catch(error => console.log(error));
        },
        fetchFacilities: function () {
            let facilities = this.state.data.moreFilter.facilities;
            $('span#facilities').empty();
            fetch('/facilities')
                .then(response => response.json())
                .then(data => {
                    let output = document.getElementById('facilities');

                    return data.items.forEach(q => {
                        let tmpl = document.getElementById('amenityFacility').content.cloneNode(true);
                        if (facilities.includes(q.id)) tmpl.querySelector('.btn-checkbox').classList.add('active');
                        tmpl.querySelector('.item-name').innerText = q.name;
                        tmpl.querySelector('.more-filter').setAttribute('data-id', q.id);
                        tmpl.querySelector('.more-filter').setAttribute('data-type', 'facilities');
                        output.append(tmpl);
                    })
                }).catch(error => console.log(error));
        },
        fetchStyles: function () {
            let styles = this.state.data.moreFilter.styles;
            $('span#design-styles').empty();
            fetch('/styles')
                .then(response => response.json())
                .then(data => {
                    let output = document.getElementById('design-styles');

                    return data.items.forEach(q => {
                        let tmpl = document.getElementById('designPreference').content.cloneNode(true);
                        if (styles.includes(q.id)) tmpl.querySelector('.btn-checkbox').classList.add('active');
                        tmpl.querySelector('.style-name').innerText = q.name;
                        tmpl.querySelector('.more-filter').setAttribute('data-id', q.id);
                        tmpl.querySelector('img').setAttribute('src', '/img/' + q.name + '.jpg');
                        output.append(tmpl);
                    })
                }).catch(error => console.log(error));
        },
        fetchOptions: function () {
            $('span#hobbies').empty();
            $('span#lifestyles').empty();
            $('span#professions').empty();
            fetch('/options')
                .then(response => response.json())
                .then(data => {
                    data.items.filter(q => q.type === 'hobby').forEach(q => {
                        let hobby = document.getElementById('hobbies');
                        let tmpl = document.getElementById('searchPreference').content.cloneNode(true);
                        tmpl.querySelector('.item-name').innerText = q.name;
                        tmpl.querySelector('.search-preference').setAttribute('data-id', q.id);
                        tmpl.querySelector('.search-preference').setAttribute('data-type', 'hobbies');
                        hobby.append(tmpl);
                    })

                    data.items.filter(q => q.type === 'lifestyle').forEach(q => {
                        let lifestyle = document.getElementById('lifestyles');
                        let tmpl = document.getElementById('searchPreference').content.cloneNode(true);
                        tmpl.querySelector('.item-name').innerText = q.name;
                        tmpl.querySelector('.search-preference').setAttribute('data-id', q.id);
                        tmpl.querySelector('.search-preference').setAttribute('data-type', 'lifestyles');
                        lifestyle.append(tmpl);
                    })

                    data.items.filter(q => q.type === 'profession').forEach(q => {
                        let profession = document.getElementById('professions');
                        let tmpl = document.getElementById('searchPreference').content.cloneNode(true);
                        tmpl.querySelector('.item-name').innerText = q.name;
                        tmpl.querySelector('.search-preference').setAttribute('data-id', q.id);
                        tmpl.querySelector('.search-preference').setAttribute('data-type', 'professions');
                        profession.append(tmpl);
                    })
                }).catch(error => console.log(error));
        },
        checkMainFilter: function () {
            let state = searchPage.state.data;
            if (state.cond_co_living) {
                $('.more-filter[data-id="co_living"]').parent().addClass('active');
                $('.more-filter[data-id="co_living"]').prop('checked', true);
            } else {
                $('.more-filter[data-id="co_living"]').parent().removeClass('active');
                $('.more-filter[data-id="co_living"]').prop('checked', false);
            }
            if (state.cond_entire_space) {
                $('.more-filter[data-id="entire_space"]').parent().addClass('active');
                $('.more-filter[data-id="entire_space"]').prop('checked', true);
            } else {
                $('.more-filter[data-id="entire_space"]').parent().removeClass('active');
                $('.more-filter[data-id="entire_space"]').prop('checked', false);
            }
            if (state.type_apartment) {
                $('.more-filter[data-id="apartment"]').parent().addClass('active');
                $('.more-filter[data-id="apartment"]').prop('checked', true);
            } else {
                $('.more-filter[data-id="apartment"]').parent().removeClass('active');
                $('.more-filter[data-id="apartment"]').prop('checked', false);
            }
            if (state.type_house) {
                $('.more-filter[data-id="house"]').parent().addClass('active');
                $('.more-filter[data-id="house"]').prop('checked', true);
            } else {
                $('.more-filter[data-id="house"]').parent().removeClass('active');
                $('.more-filter[data-id="house"]').prop('checked', false);
            }
            $('#searchbox-slider-2-text-1').html(this.formatPrice(parseInt(state.min_price)));
            $('#searchbox-slider-2-text-2').html(this.formatPrice(parseInt(state.max_price)));
            const element = document.getElementById('searchbox-slider-2');
            element.noUiSlider.set([state.min_price, state.max_price]);
        },
        removePreference: function () {
            this.state.data.preference = {
                is_mostly_male: 0,
                is_mostly_female: 0,
                hobbies: [],
                lifestyles: [],
                professions: [],
                from: '',
                min_age: 1,
                max_age: 60,
            }

            const ageSlider = document.getElementById('searchbox-slider-3');
            ageSlider.noUiSlider.set([18, 60]);
            $('#searchbox-slider-3-text-1').html('18');
            $('#searchbox-slider-3-text-2').html('60+');
            $('#hometown').val('');
            $(`.search-preference[data-type="gender"]`).each(function () {
                $(this).parent().removeClass('active');
                $(this).prop('checked', false);
            });
        },
        showRecentSearch: function () {
            $('span#moreRecentSearch').empty();
            let token = document.head.querySelector('meta[name="csrf-token"]');
            let instanceId = this.getCookie('instanceId');

            $('#moreRecentSearch').parent().parent().addClass('d-none').removeClass('d-flex');

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
                    let output = document.getElementById('moreRecentSearch');

                    if (!data || !data.items || !data.items.length) {
                        $(output).parent().parent().addClass('d-none').removeClass('d-flex');
                        return [];
                    }

                    $(output).parent().parent().removeClass('d-none').addClass('d-flex');

                    return data.items.slice(0, 2).forEach(q => {
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
        openSearchbox: function () {
            $('#search-popup').addClass('show');
            $('body').addClass('search-open');
            $('.searchbox-primary').focus();

            this.checkMainFilter();
            this.fetchAmenities();
            this.fetchFacilities();
            this.fetchStyles();
            this.fetchOptions();
            this.removePreference();
            this.showRecentSearch();

            if (this.state.data.q) {
                $('.removeLocation').show();
                if (!this.state.data.is_commute) {
                    $('.removeLocation[data-type="commute"]').hide();
                }
            } else {
                $('.removeLocation').hide();
            }
            ($('.more-filter[data-type="type_apartment"]').prop('checked')) ? $('#apartmentFiltered').show() : $('#apartmentFiltered').hide();
            ($('.more-filter[data-type="type_house"]').prop('checked')) ? $('#houseFiltered').show() : $('#houseFiltered').hide();
        },
        getCurrentLocation: function () {
            if (navigator.geolocation) {
                $('.currentLocation').click(function () {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        let geocoder = new google.maps.Geocoder;
                        geocoder.geocode({ location: pos }, function (results, status) {
                            if (status === 'OK') {
                                if (results && results.length) {
                                    let res = results[0]
                                    let saveSearch = {
                                        instance_id: searchPage.getCookie('instanceId') || '',
                                        place_id: res.place_id,
                                        location: searchPage.getAddressNameFromAddressComponents(res.address_components),
                                        full_location: res.formatted_address
                                    }

                                    $('#keyword').val(res.formatted_address);
                                    $('#searchbox').val(res.formatted_address);
                                    $('#recent_search').val(JSON.stringify(saveSearch));

                                    searchPage.openSearchbox();
                                    searchPage.state.data.q = res.formatted_address;
                                    searchPage.state.data.id = res.place_id;
                                    searchPage.state.data.nearme = 1;
                                    searchPage.state.data.is_commute = 0;
                                    searchPage.state.utils.lat = pos.lat;
                                    searchPage.state.utils.lng = pos.lng;
                                    $('.removeLocation').show();
                                    $('.removeLocation[data-type="commute"]').hide();
                                    if (!$('#btn-filter-show-map').hasClass('active')) {
                                        searchPage.openSearchSection($('#btn-filter-show-map'), 'map-open');
                                    }

                                    let params = searchPage.buildParam();
                                    searchPage.fetchData('/search/ajax', JSON.stringify(params), false, false);
                                } else {
                                    console.log('No results found');
                                }
                            } else {
                                console.log('Geocoder failed due to: ' + status);
                            }
                        });
                    })
                });

                $('.currentCommuteLocation').click(function () {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        let geocoder = new google.maps.Geocoder;
                        geocoder.geocode({ location: pos }, function (results, status) {
                            if (status === 'OK') {
                                if (results && results.length) {
                                    let res = results[0];

                                    $('#main-commute').val(res.formatted_address);

                                    searchPage.state.data.commute_filter_states = {
                                        data: {
                                            q: res.formatted_address,
                                            id: res.place_id,
                                            nearme: 1,
                                            is_commute: 1,
                                        },
                                        utils: {
                                            lat: pos.lat,
                                            lng: pos.lng,
                                        }
                                    }

                                    $('.removeLocation[data-type="commute"]').show();
                                } else {
                                    console.log('No results found');
                                }
                            } else {
                                console.log('Geocoder failed due to: ' + status);
                            }
                        });
                    })
                });
            } else {
                console.error('Browser not supported');
            }
        },
        openSearchSection: function ($elmt, className) {
            $elmt.trigger('click');

            // if ($elmt.hasClass('active')) {
            //     $elmt.removeClass('active');
            //     $('#search-section').removeClass(className);
            //     if ($('.row-discover-lists').hasClass('cols-discover-lists')) {
            //         $('.row-discover-lists').removeClass('cols-discover-lists');
            //         $('.discover-box').addClass('width-max');
            //         $('#search-map').removeClass('map-fixed');
            //     }

            // } else {
            //     $elmt.addClass('active');
            //     $('#search-section').addClass(className);
            //     if (!$('.row-discover-lists').hasClass('cols-discover-lists')) {
            //         $('.row-discover-lists').addClass('cols-discover-lists');
            //         $('#search-map').addClass('map-fixed');
            //     }
            // }
        },
        getAddressNameFromAddressComponents: function (component, i = 0) {
            if ($.isPlainObject(component[i])) {
                const comp = component[i];

                if (comp.types && comp.types.length) {
                    if ($.inArray(comp.types[0], ['street_number', 'premise', 'postal_code', 'subpremise']) === -1) {
                        return comp.long_name;
                    }

                    return searchPage.getAddressNameFromAddressComponents(component, i + 1);
                }
            }

            return component[0].long_name;
        },
        initialize: function () {
            // scroll page to top on page load

            if ($('.navbar[solid-on-scroll]').length != 0) {
                mainToolkit.transparent = true;
                mainToolkit.checkScrollForTransparentNavbar();
                $(window).on('scroll', mainToolkit.checkScrollForTransparentNavbar);
            }
            $('.searchbox-value').change(function () {
                $('.searchbox-value').not(this).val($(this).val());
            });
            $(document).on('click', '.morefilter-trigger', function () {
                searchPage.openSearchbox();
            });
            $('.morefilter-trigger .form-control, .searchbox-trigger.form-control').on('focus', function () {
                searchPage.openSearchbox();
            });
            $(document).on('click', '.notfound-filter', function () {
                const placeId = $(this).data('place_id') || false;
                const name = $(this).data('name') || false;

                searchPage.openSearchbox();

                if (placeId && name) {
                    $('#searchbox').val(name);
                    $('#keyword').val(name);
                    $('.removeLocation').show();

                    searchPage.state.data.q = name;
                    searchPage.state.data.id = placeId;
                } else {
                    $('.removeLocation').hide();
                    $('#searchbox').val('');
                    $('#keyword').val('');
                }
            });
            $('.searchbox-close').click(function () {
                $('#search-popup').removeClass('show');
                $('body').removeClass('search-open');
            })

            if ($("#search-section").length) {
                $('#btn-filter-show-grid').click(function () {
                    var $self = $(this);
                    var $sibling = $('#btn-filter-show-map');
                    var $section = $('#search-section');

                    if ($self.hasClass('active')) {
                        if ($sibling.hasClass('active')) {
                            $(document).trigger('searchresult:grid:hide');
                        }
                    } else {
                        $(document).trigger('searchresult:grid:show');

                        if ($sibling.hasClass('active')) {
                            $(document).trigger('searchresult:map:show');
                        }
                    }
                });

                $('#btn-filter-show-map').click(function () {
                    var $self = $(this);
                    var $sibling = $('#btn-filter-show-grid');
                    var $section = $('#search-section');

                    if ($self.hasClass('active')) {
                        if ($sibling.hasClass('active')) {
                            $(document).trigger('searchresult:map:hide');
                        }
                    } else {
                        $(document).trigger('searchresult:map:show');

                        if ($sibling.hasClass('active')) {
                            $(document).trigger('searchresult:grid:show');
                        }
                    }
                });

                $(document).on({
                    'searchresult:grid:show': function () {
                        var $btnGrid = $('#btn-filter-show-grid');
                        var $btnMap = $('#btn-filter-show-map');
                        var $section = $('#search-section');

                        $section.addClass('grid-open');
                        $btnGrid.addClass('active');

                        $(document).trigger('searchresult:refreshlayout');
                    },
                    'searchresult:grid:hide': function () {
                        var $btnGrid = $('#btn-filter-show-grid');
                        var $btnMap = $('#btn-filter-show-map');
                        var $section = $('#search-section');

                        $section.removeClass('grid-open');
                        $btnGrid.removeClass('active');

                        $(document).trigger('searchresult:refreshlayout');
                    },
                    'searchresult:map:show': function () {
                        var $btnGrid = $('#btn-filter-show-grid');
                        var $btnMap = $('#btn-filter-show-map');
                        var $section = $('#search-section');

                        $section.addClass('map-open');
                        $btnMap.addClass('active');

                        $(document).trigger('searchresult:refreshlayout');
                    },
                    'searchresult:map:hide': function () {
                        var $btnGrid = $('#btn-filter-show-grid');
                        var $btnMap = $('#btn-filter-show-map');
                        var $section = $('#search-section');

                        $section.removeClass('map-open');
                        $btnMap.removeClass('active');

                        $(document).trigger('searchresult:refreshlayout');
                    },
                    'searchresult:refreshlayout': function () {
                        var $btnGrid = $('#btn-filter-show-grid');
                        var $btnMap = $('#btn-filter-show-map');
                        var $section = $('#search-section');
                        var gridShown = $section.hasClass('grid-open');
                        var mapShown = $section.hasClass('map-open');

                        if (gridShown && mapShown) {
                            $('.row-discover-lists').addClass('cols-discover-lists');
                            $('.discover-box').addClass('width-max');
                            $('#search-map').addClass('map-fixed');
                            searchPage.state.data.maps = true;
                            // searchPage.stickyMapsInstance && searchPage.stickyMapsInstance.destroy && searchPage.stickyMapsInstance.destroy();
                            // searchPage.initStickyMaps();
                        } else if (gridShown) {
                            $('.row-discover-lists').removeClass('cols-discover-lists');
                            $('.discover-box').removeClass('width-max');
                            $('#search-map').removeClass('map-fixed');
                            searchPage.state.data.maps = false;
                        } else {
                            $('.row-discover-lists').removeClass('cols-discover-lists');
                            $('.discover-box').removeClass('width-max');
                            $('#search-map').removeClass('map-fixed');
                            searchPage.state.data.maps = true;
                            // searchPage.stickyMapsInstance && searchPage.stickyMapsInstance.destroy && searchPage.stickyMapsInstance.destroy();
                            // searchPage.initStickyMaps();
                        }
                    }
                })
            } else if ($('#isNotFound')) {
                $('#btn-filter-show-map').removeClass('active');
            }

            $('#menu1').click(function () {
                if (!$('#menuFly1').hasClass('isShowFly')) {
                    $('#menuFly1').addClass('isShowFly');
                } else {
                    $('#menuFly1').removeClass('isShowFly');
                }
                $('.flying-dropdown').not('#menuFly1').removeClass('isShowFly');
            })
            $('#menu2').click(function () {
                if (!$('#menuFly2').hasClass('isShowFly')) {
                    $('#menuFly2').addClass('isShowFly');
                } else {
                    $('#menuFly2').removeClass('isShowFly');
                }
                $('.flying-dropdown').not('#menuFly2').removeClass('isShowFly');
            })
            $('#menu3').click(function () {
                if (!$('#menuFly3').hasClass('isShowFly')) {
                    $('#menuFly3').addClass('isShowFly');
                } else {
                    $('#menuFly3').removeClass('isShowFly');
                }
                $('.flying-dropdown').not('#menuFly3').removeClass('isShowFly');
            })
            $('#lblMenu3').data('placeholder', $('#lblMenu3').text());
            $('#menu4').click(function () {
                if (!$('#menuFly4').hasClass('isShowFly')) {
                    $('#menuFly4').addClass('isShowFly');
                } else {
                    $('#menuFly4').removeClass('isShowFly');
                }
                $('.flying-dropdown').not('#menuFly4').removeClass('isShowFly');
            })
            $('#menu5').click(function () {
                if (!$('#menuFly5').hasClass('isShowFly')) {
                    $('#menuFly5').addClass('isShowFly');
                } else {
                    $('#menuFly5').removeClass('isShowFly');
                }
                $('.flying-dropdown').not('#menuFly5').removeClass('isShowFly');
            })
            $('#menu6').click(function () {
                if (!$('#menuFly6').hasClass('isShowFly')) {
                    $('#menuFly6').addClass('isShowFly');
                } else {
                    $('#menuFly6').removeClass('isShowFly');
                }
                $('.flying-dropdown').not('#menuFly6').removeClass('isShowFly');
            });

            var resizeSticky = function () {
                var elements = document.querySelectorAll('.sticky-wrapper, .sticky-sm-wrapper, .sticky-md-wrapper');
                for (var i = 0; i < elements.length; i++) {
                    const wrapper = elements[i].closest('.main-content');
                    if (wrapper) elements[i].style.top = wrapper.offsetTop + "px";
                };
            }
            resizeSticky();
            window.addEventListener('resize', resizeSticky);

            $('.carousel-watcher').on('slid.bs.carousel', function () {
                var $this = $(this);
                $this.children('.btn-prev').prop('disabled', $this.find('.carousel-inner .carousel-item:first').hasClass('active'));
                $this.children('.btn-next').prop('disabled', $this.find('.carousel-inner .carousel-item:last').hasClass('active'));
            })

            $('.btn-select input[type="checkbox"]').change(function () {
                $(this).siblings().html($(this).prop('checked') ? "Selected" : "Select");
            })

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
                var navlink = this.parentElement;
                var container = navlink.parentElement;
                var offset = navlink.offsetLeft - container.offsetLeft;
                if (container.scrollWidth != container.clientWidth &&
                    (offset < container.scrollLeft ||
                        (offset + navlink.offsetWidth) > (container.scrollLeft + container.clientWidth)
                    )) {
                    container.scrollTo({
                        left: navlink.offsetLeft - container.offsetLeft,
                        behavior: 'smooth'
                    })
                }
            })
            this.slider();

            $('.commute-time').select2({
                containerCssClass: "js-select2",
                width: 'resolve',
                minimumResultsForSearch: -1
            });

            $('.main-commute').select2({
                containerCssClass: "js-select2",
                width: '100%',
                minimumResultsForSearch: -1
            });

            $('.commute-time').on("select2:select", function (e) {
                if ($('#commute-location').val() !== '') {
                    searchPage.state.data[$(this).data('type')] = $(this).val();

                    let params = searchPage.buildParam();
                    searchPage.fetchData('/search/ajax', JSON.stringify(params), false, false);
                }
            });

            $('.main-commute').on("select2:select", function (e) {
                if ($('#main-commute').val() !== '') {
                    searchPage.state.data[$(this).data('type')] = $(this).val();
                }
            });
        },
        adjustMapsHeight: function () {
            $('#search-map').css('height', ($(window).height() - ($('body > .navbar:first').outerHeight() || 0)) + 'px');
        },
        initStickyMaps: function () {
            if (!$('#search-map').length) {
                return;
            }

            searchPage.adjustMapsHeight();

            $(window).on('resize', $.debounce(function () {
                searchPage.adjustMapsHeight();
            }, 300));

            searchPage.stickyMapsInstance = new Waypoint.Inview({
                element: $('footer.section-content.footer').get(0),
                enter: function(direction) {
                    $('#search-map').addClass('on-bottom').parent().css('position', 'relative');
                },
                exit: function () {
                    $('#search-map').removeClass('on-bottom').css('position', '');
                },
                exited: function () {
                    $('#search-map').removeClass('on-bottom').css('position', '');
                }
            });
        },
        mapsEvent: function () {
            $('.card-property').mouseover(function () {
                const id = $(this).attr('id');
                $(`.popup-property[property-id="${id}"]`).parent().addClass('popup-bubble-hovered');
            })

            $('.card-property').mouseout(function () {
                const id = $(this).attr('id');
                $(`.popup-property[property-id="${id}"]`).parent().removeClass('popup-bubble-hovered');
            })

            $(document).on('click', '.open-popup', function () {
                const q = $(this).data('param');
                const idx = parseInt($(this).data('index'));

                $('.popup-bubble-anchor').removeClass('popup-bubble-anchor-detail');
                $('.popup-bubble').removeClass('popup-bubble-detail');
                $('.popup-bubble-content').hide();
                $('.popup-bubble-content').html('');
                $('.popup-property').show();
                var container = $(this).parent().find('.popup-bubble-content');
                container.show();
                $('.popup-bubble-content').html(`<div><div class="close-popup"><i class="moon-close btn-hover"></i></div></div>`);

                const tmpl = searchPage.renderCard(q, idx);
                container.append(tmpl);

                $(this).hide();
                $(this).parent().addClass('popup-bubble-detail');
                $(this).parents().eq(1).addClass('popup-bubble-anchor-detail');

                window.searchMap.panTo({ lat: parseFloat(q.latitude), lng: parseFloat(q.longitude) });
            })

            $(document).on('click', '.close-popup', function () {
                const element = $(this).parent().parent();
                element.hide();
                element.next().show();
                element.parent().removeClass('popup-bubble-detail');
                element.parents().eq(1).removeClass('popup-bubble-anchor-detail');
            })
        },
        dropdownNav: function () {
            $(document).on('click', '.search-filterbox .dropdown-menu', function (e) {
                e.stopPropagation();
            });

            // $('#livingCondApply').on('click', function (e) {
            //     $('.search-filterbox .fox-dropdown-nav').removeClass('show');
            //     $('.search-filterbox .flying-dropdown').removeClass('show');
            //     $(this).closest('.dropdown-menu').dropdown('hide');
            // });

            $('#propertyTypeApply').on('click', function (e) {
                $('.search-filterbox .fox-dropdown-nav').removeClass('show');
                $('.search-filterbox .flying-dropdown').removeClass('show');
                $(this).closest('.dropdown-menu').dropdown('hide');
            });

            $('#commuteApply').on('click', function (e) {
                if (!$('#main-commute').val()) {
                    return;
                }

                if (searchPage.state.data.commute_filter_states) {
                    $.extend(searchPage.state.data, searchPage.state.data.commute_filter_states.data);
                    $.extend(searchPage.state.utils, searchPage.state.data.commute_filter_states.utils);
                    searchPage.state.data.commute_filter_states = null;
                }

                $(this).closest('.commute-time-dropdown').data('halt', false);

                $('#commuteReset').removeClass('invisible');
                if (searchPage.state.data.maps) $('#moveMap').prop('checked', false);
                if (!$('#btn-filter-show-map').hasClass('active')) {
                    searchPage.openSearchSection($('#btn-filter-show-map'), 'map-open');
                }

                let params = searchPage.buildParam();
                searchPage.fetchData('/search/ajax', JSON.stringify(params), false, true)
                        .then(() => {
                            $(document).trigger('searchresult:refreshlayout');
                        });

                setTimeout(() => {
                    $(this).closest('.commute-time-dropdown').data('halt', false).removeClass('show');
                    $(this).closest('.dropdown-menu').dropdown('hide');
                }, 10);
            });

            $('#termApply').on('click', function (e) {
                setTimeout(() => {
                    $(this).closest('.dropdown-menu').dropdown('hide');
                }, 350);
            });

            $(document).click(function (e) {
                var $tgt = $(e.target);
                if ($tgt.closest('.flying-dropdown[aria-labelledby="dropdownMenuFly1"]').length === 0) {
                    $('.main-filter[data-type="condition"]').each(function () {
                        if ($(this).prop('checked')) {
                            // Insert your code here
                        }
                    });
                }
            });
        },
        initMaps: function (center, element) {
            this.element = element || document.getElementById('search-map');
            this.center = center || {
                lat: -34.397,
                lng: 150.644
            };
            this.circles = [];
            this.markers = [];
            this.popups = [];
            this.map = null;
            this.moveSearch = false;
            this.init = function () {
                this.map = new google.maps.Map(this.element, {
                    center: this.center,
                    zoom: 11,
                    mapTypeControl: false,
                    fullscreenControl: false,
                    streetViewControl: false,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.TOP_RIGHT
                    }
                });
                const marker = new google.maps.Marker({
                    position: center,
                    map: this.map,
                    draggable: true,
                });
                marker.setMap(null);
                const centerControlDiv = document.createElement('div');
                const centerControl = new searchPage.controlMaps(centerControlDiv, this.map, marker);

                centerControlDiv.index = 1;
                this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(centerControlDiv);
                this.eventMoveSearch();
            }
            this.setCenter = function (center) {
                this.map.setCenter(center);
            }
            this.panTo = function (point) {
                this.map.panTo(point);
            }
            this.setZoom = function (point) {
                this.map.setZoom(point);
            }
            this.addCircle = function (center, radius) {
                if (this.map) {
                    this.circles.push(new google.maps.Circle({
                        strokeColor: '#6DC7BE',
                        strokeOpacity: 1,
                        strokeWeight: 2,
                        fillColor: '#6DC7BE',
                        fillOpacity: 0.3,
                        map: this.map,
                        center: center,
                        radius: radius
                    }));
                }
            }
            this.clearCircle = function () {
                this.circles.forEach(function (elmt) {
                    elmt.setMap(null);
                })
                this.circles.splice(0, this.circles.length);
            }
            this.addMarker = function (center, icon, label, anchor, labelClass) {
                if (this.map) {
                    const marker = new google.maps.Marker({
                        position: center,
                        map: this.map,
                        icon
                    });
                    this.markers.push(marker);
                }
            }
            this.showIsochrone = function (ArrayLatLng) {
                var coordinates = ArrayLatLng.map(function (item) {
                    return {lng:item[0],lat:item[1]};
                });
                var newBounds = new google.maps.LatLngBounds();
                coordinates.forEach(q => {
                    let position = new google.maps.LatLng(q.lat, q.lng);
                    newBounds.extend(position);
                })
                console.log(newBounds);
                this.map.fitBounds(newBounds);

                if (typeof this.isochrone != "undefined") {
                    this.isochrone.setMap(null);
                }
                this.isochrone = new google.maps.Polygon({
                    paths: coordinates,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });
                this.isochrone.setMap(this.map);
            }
            this.clearMarker = function () {
                this.markers.forEach(function (elmt) {
                    elmt.setMap(null);
                })
                this.markers.splice(0, this.markers.length);
            }
            this.addMarkerLabel = function (center, label) {
                if (this.map) {
                    var marker = new MarkerWithLabel({
                        position: center,
                        opacity: 0,
                        labelContent: label,
                        labelClass: 'marker-bubble-label',
                        labelAnchor: new google.maps.Point(0, 8),
                        map: this.map
                    });
                    this.markers.push(marker);
                }
            }
            this.clearMarkerLabel = function () {
                this.markers.forEach(function (elmt) {
                    elmt.setMap(null);
                })
                this.markers.splice(0, markers.length);
            }
            this.showMarkerCluster = function () {
                const markers = this.markers.map(function (location, i) {
                    return new google.maps.Marker({
                        position: location
                    });
                });
                return new MarkerClusterer(this.map, markers,
                    { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });
            }
            this.addPopup = function (latitude, longitude, content) {
                if (this.map) {
                    var Popup = createPopupClass();
                    var popup = new Popup(
                        new google.maps.LatLng(latitude, longitude),
                        content
                    );
                    popup.setMap(this.map);
                    this.popups.push(popup);
                }
            }
            this.clearPopup = function () {
                this.popups.forEach(function (elmt) {
                    elmt.setMap(null);
                })
                this.popups.splice(0, this.popups.length);
            },
                this.eventMoveSearch = function () {
                    const that = this;
                    google.maps.event.addListener(this.map, 'dragend', function () {
                        if (that.moveSearch) {
                            that.geocodePosition(this.center);
                        }
                    });
                },
                this.geocodePosition = function (pos) {
                    var that = this;
                    const geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        latLng: pos
                    }, function (responses) {
                        if (responses && responses.length > 0) {
                            const bounds = that.map.getBounds();
                            const ne = bounds.getNorthEast();
                            const sw = bounds.getSouthWest();

                            searchPage.state.data.geocode.ne.lat = ne.lat();
                            searchPage.state.data.geocode.ne.lng = ne.lng();
                            searchPage.state.data.geocode.sw.lat = sw.lat();
                            searchPage.state.data.geocode.sw.lng = sw.lng();
                            searchPage.state.data.q = responses[0].formatted_address;
                            searchPage.state.data.id = responses[0].place_id;
                            searchPage.state.data.page = 1;

                            let params = searchPage.buildParam();
                            searchPage.fetchData('/search/ajax', JSON.stringify(params), false);
                        }
                    });
                }
            this.fitBounds = function (location) {
                let bounds = new google.maps.LatLngBounds();

                location.forEach(q => {
                    let position = new google.maps.LatLng(q.latitude, q.longitude);
                    bounds.extend(position);
                })
                this.map.fitBounds(bounds);

                const that = this;
                const listener = google.maps.event.addListener(this.map, "idle", function () {
                    if (that.map.getZoom() > 16) {
                        that.map.setZoom(16);
                    }
                    if (that.map.getZoom() < 12) {
                        that.map.setZoom(12)
                    }
                    google.maps.event.removeListener(listener);
                });
            }
            this.makePolygon = function (markers) {
                console.log(markers)

                // var triangleCoords = [
                //   {lat: 25.774, lng: -80.190},
                //   {lat: 18.466, lng: -66.118},
                //   {lat: 32.321, lng: -64.757},
                //   {lat: 25.774, lng: -80.190}
                // ];

                // // Construct the polygon.
                // var bermudaTriangle = new google.maps.Polygon({
                //   paths: triangleCoords,
                //   strokeColor: '#FF0000',
                //   strokeOpacity: 0.8,
                //   strokeWeight: 2,
                //   fillColor: '#FF0000',
                //   fillOpacity: 0.35
                // });
                // bermudaTriangle.setMap(map);
            }
            this.clearPolygon = function () {

            }
        },
        controlMaps: function (controlDiv, map, marker) {
            let controlUI = document.createElement('label');
            controlUI.style.backgroundColor = '#fff';
            controlUI.style.border = '2px solid #fff';
            controlUI.style.borderRadius = '3px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI.style.cursor = 'pointer';
            controlUI.style.marginTop = '10px';
            controlUI.style.textAlign = 'center';
            controlUI.title = 'Click to recenter the map';
            controlDiv.appendChild(controlUI);

            let checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'moveMap';
            checkbox.id = 'moveMap';
            checkbox.style.marginRight = '10px';

            let controlText = document.createElement('div');
            controlText.style.color = '#424242';
            controlText.style.fontSize = '13px';
            controlText.style.lineHeight = '25px';
            controlText.style.paddingLeft = '10px';
            controlText.style.paddingRight = '10px';
            controlText.style.display = 'flex';
            controlText.style.alignItems = 'center';
            controlText.append(checkbox);
            controlText.append(`Search as I move the map`);
            controlUI.appendChild(controlText);
        }
    }
    if ($parent.length) {
        searchPage.init();
    }

    $(document).scrollTop(0);

});

var mainToolkit;

mainToolkit = {
    transparent: true,
    scroll_distance: 100,
    checkScrollForTransparentNavbar: debounce(function () {
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
    }, 17),
}

function debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        }, wait);
        if (immediate && !timeout) func.apply(context, args);
    };
};

function createPopupClass() {
    function Popup(position, content) {
        this.position = position;

        content.classList.add('popup-bubble');

        var bubbleAnchor = document.createElement('div');
        bubbleAnchor.classList.add('popup-bubble-anchor');
        bubbleAnchor.appendChild(content);

        this.containerDiv = document.createElement('div');
        this.containerDiv.classList.add('popup-container');
        this.containerDiv.appendChild(bubbleAnchor);

        google.maps.OverlayView.preventMapHitsAndGesturesFrom(this.containerDiv);
    }
    Popup.prototype = Object.create(google.maps.OverlayView.prototype);

    Popup.prototype.onAdd = function () {
        this.getPanes().floatPane.appendChild(this.containerDiv);
    };

    Popup.prototype.onRemove = function () {
        if (this.containerDiv.parentElement) {
            this.containerDiv.parentElement.removeChild(this.containerDiv);
        }
    };

    Popup.prototype.draw = function () {
        var divPosition = this.getProjection().fromLatLngToDivPixel(this.position);

        var display =
            Math.abs(divPosition.x) < 4000 && Math.abs(divPosition.y) < 4000 ?
                'block' :
                'none';

        if (display === 'block') {
            this.containerDiv.style.left = divPosition.x + 'px';
            this.containerDiv.style.top = divPosition.y + 'px';
        }
        if (this.containerDiv.style.display !== display) {
            this.containerDiv.style.display = display;
        }
    };

    return Popup;
}

window.scrollTo && window.scrollTo(0, 0);
