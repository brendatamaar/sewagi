$(document).ready(function(){
    $parent = $("#searchbox-form");
    let searchBox = {
        init: function () {
            this.initialize();
            this.autoCompleteLocation();
            this.removeLocation();
            this.priceSlider();
            this.recentSearch();
            this.getCurrentLocation();
            this.updatePrice();
            this.updateState();
        },
        state: {
            _token: document.head.querySelector('meta[name="csrf-token"]').content,
            q: $('#searchbox').val(),
            cond_co_living: 1,
            cond_entire_space: 1,
            type_apartment: 0,
            type_house: 0,
            min_price: 0,
            max_price: 0,
            place_id: '',
            bedroom: 0,
        },
        initialize: function() {
            this.updatePrice(JSON.stringify(this.state));

            $('input[name="range_of_stay"]').change(function() {
                [1,3,6,12].forEach(q => {
                    $(`input[name="payment_options"][value="${q}"]`).attr('disabled', false).prop('checked', false)
                        .parent().show().removeClass('active');
                });
                switch ($(this).val()) {
                    case '3':
                        [3,6].forEach(q => {
                            $(`input[name="payment_options"][value="${q}"]`).attr('disabled', true).parent().hide();
                        })
                    break;
                    case '6':
                        $(`input[name="payment_options"][value="3"]`).attr('disabled', true).parent().hide();
                    break;
                    case '9':
                        $(`input[name="payment_options"][value="6"]`).attr('disabled', true).parent().hide();
                    break;
                }
            });

            $('#collapseAddCommute').on('show.bs.collapse', function () {
                $("#span-commute-title").html("Commute Time");
            });
            $('#collapseAddCommute').on('hide.bs.collapse', function () {
                $("#span-commute-title").html("Add Commute Time");
            });

            $('.commute-time').select2({
                containerCssClass: "js-select2",
                width: 'resolve',
                minimumResultsForSearch: -1
           });
        },
        triggerAction: function () {
            $('.searchbox-trigger .input-group-text, .searchbox-trigger button, a.searchbox-trigger').on('click', searchBox.openSearchbox());
            $('.searchbox-trigger .form-control, .searchbox-trigger.form-control').on('focus', searchBox.openSearchbox());

            $('.searchbox-close').click(function () {
                $('#search-popup').removeClass('show');
                $('body').removeClass('search-open');
            });
        },
        openSearchbox: function () {
            $('#search-popup').addClass('show');
            $('body').addClass('search-open');
            $('.searchbox-primary').focus();
        },
        autoCompleteLocation: function() {
            $('#searchbox').autoComplete({
                minChars: 3,
                source: function(term, response){
                    $.getJSON('/place-auto-complete', { place_name: term, restrict_place: true }, function(data){
                        response(data.predictions);
                    });
                },
                renderItem: function (item, search){
                    return `<div class="autocomplete-suggestion" data-id="${item.id}" data-place_id="${item.place_id}"
                    data-place="${item.description}">${item.description}</div>`;
                },
                onSelect: function(e, term, item){
                    $('#removeLocation').show();
                    $('#homeRemoveLocation').show();
                    $('#navbarRemoveLocation').show();
                    $('#searchbox').val(item.data('place'));
                    $('#navbarSearch').val(item.data('place'));
                    $('#homeSearch').val(item.data('place'));
                    $("#place_id").val(item.data('place_id'));

                    $.getJSON('/place-details', { place_id: item.data('place_id') }, function(data) {
                        let saveSearch = {
                            instance_id: searchBox.getCookie('instanceId') || '',
                            place_id: data.result.place_id,
                            location: data.result.name,
                            full_location: data.result.formatted_address
                        }
                        $('#recent_search').val(JSON.stringify(saveSearch));
                        $('#lat').val(data.result.geometry.location.lat);
                        $('#lng').val(data.result.geometry.location.lng);
                        $('#maps').val(false);
                        $('#input-is-commute').val(0);
                        $('#input-is-nearme').val(0);

                        searchBox.state.q = data.result.formatted_address;
                        searchBox.state.place_id = data.result.place_id;
                        searchBox.updatePrice(JSON.stringify(searchBox.state));
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
                    $('#searchbox').val(item.data('place'));
                    $('#commute-location').val(item.data('place'));
                    $('#removeLocation').show();
                    $('#homeRemoveLocation').show();
                    $('#navbarRemoveLocation').show();
                    $("#input-is-commute").val(1);
                    $('#input-is-nearme').val(0);
                    $("#place_id").val(item.data('place_id'));

                    $.getJSON('/place-details', { place_id: item.data('place_id') }, function(data) {
                        let saveSearch = {
                            instance_id: searchBox.getCookie('instanceId') || '',
                            place_id: data.result.place_id,
                            location: data.result.name,
                            full_location: data.result.formatted_address
                        }
                        $('#recent_search').val(JSON.stringify(saveSearch));
                        $('#lat').val(data.result.geometry.location.lat);
                        $('#lng').val(data.result.geometry.location.lng);
                        $('#maps').val(true);

                        searchBox.state.q = data.result.formatted_address;
                        searchBox.state.place_id = data.result.place_id;
                        searchBox.updatePrice(JSON.stringify(searchBox.state));
                    });
                }
            });

            // $inpCommute = $("#commute-location").select2({
            //     placeholder: 'Add details location',
            //     minimumInputLength: 3,
            //     maximumSelectionSize: 1,
            //     multiple: true,
            //     allowClear: true,
            //     // templateSelection: searchBox.formatCompanyName,
            //     ajax: {
            //         url: '/place-auto-complete',
            //         data: function (params) {
            //             var query = {
            //                 'restrict_place': 1,
            //                 'place_name': params.term
            //             }
            //             return query;
            //         },
            //         processResults: function (data) {
            //             return {
            //                 results: $.map(data.predictions, function (item) {
            //                     return {
            //                         text: item.description,
            //                         id: item.place_id
            //                     }
            //                 })
            //             };
            //         },
            //         success: function (response) {

            //         }
            //     }
            // });

            // $inpCommute.on("select2:select", function (e) {
            //     $(this).val([]).trigger('change');
            //     $(this).val([e.params.data.id]).trigger("change");

            //     $("#input-is-commute").val(1);
            //     data = e.params.data;
            //     $("#place_id").val(data.id);
            //     $('#searchbox').val(data.text);
            // });
            // $inpCommute.on("select2:unselect", function (e) {
            //     $("#input-is-commute").val(0);
            // });
            // $(".select2-search__field").on('focus', function() {
            //     $(".select2-selection__choice").hide();

            //     console.log($(".select2-selection__choice").length);
            // });
        },
        formatPrice: function(price) {
            return accounting.formatMoney(price, 'IDR ', 0,'.');
        },
        formatCompanyName: function(state) {
            var $state = state.text;
            if (state.text.indexOf(',') > 0) {
                $state = state.text.substr(0, state.text.indexOf(','));
            }
            return $state;
        },
        getCookie: function(name) {
            return document.cookie.split('; ').reduce((r, v) => {
                const parts = v.split('=');
                return parts[0] === name ? parts[1] : r;
              }, '')
        },
        recentSearch: function() {
            $(document).on('change', '.recent-search', function() {
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
            });
        },
        removeLocation: function() {
            $('#removeLocation').hide();
            $('#homeRemoveLocation').hide();
            $('#navbarRemoveLocation').hide();

            $('#searchbox').keyup(function() {
                if ($(this).val() == '') {
                    $('#removeLocation').hide();
                    $('#homeRemoveLocation').hide();
                    $('#navbarRemoveLocation').hide();
                } else {
                    $('#removeLocation').show();
                    $('#homeRemoveLocation').show();
                    $('#navbarRemoveLocation').show();
                }
            });

            $('#removeLocation').click(function() {
                $('#searchbox').val('');
                $('#navbarSearch').val('');
                $('#homeSearch').val('');
                $('#removeLocation').hide();
                $('#homeRemoveLocation').hide();
                $('#navbarRemoveLocation').hide();
            });
        },
        priceSlider: function() {
            let price = document.getElementById('searchbox-slider');
            noUiSlider.create(price, {
                start: [1, 3000000000],
                connect: true,
                range: {
                    'min': 0,
                    'max': 3000000000
                }
            }).on('slide', function (values, handle) {
                let formatMinPrice = accounting.formatMoney(values[0], 'IDR ', 0,'.');
                let formatMaxPrice = accounting.formatMoney(values[1], 'IDR ', 0,'.');
                $('#searchbox-slider-text-1').html(formatMinPrice);
                $('#searchbox-slider-text-2').html(formatMaxPrice);
                $('input[name="min_price"]').val(parseInt(values[0]));
                $('input[name="max_price"]').val(parseInt(values[1]));
            });
        },
        getCurrentLocation: function() {
            $('#currentLocation').click(function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        let geocoder = new google.maps.Geocoder;
                        geocoder.geocode({location : pos}, function(results, status) {
                            if (status === 'OK') {
                                if (results && results.length) {
                                    let res = results[0]
                                    let saveSearch = {
                                        instance_id: searchBox.getCookie('instanceId') || '',
                                        place_id: results[0].place_id,
                                        location: searchBox.getAddressNameFromAddressComponents(res.address_components),
                                        full_location: results[0].formatted_address
                                    }

                                    $('#homeSearch').val(results[0].formatted_address);
                                    $('#searchbox').val(results[0].formatted_address);
                                    $('#navbarSearch').val(results[0].formatted_address);
                                    $('#lat').val(pos.lat);
                                    $('#lng').val(pos.lng);
                                    $('#place_id').val(results[0].place_id);
                                    $('#recent_search').val(JSON.stringify(saveSearch));
                                    $('#maps').val(true);
                                    $('#input-is-nearme').val(1);
                                    $('#removeLocation').show();
                                    $('#homeRemoveLocation').show();
                                    $('#navbarRemoveLocation').show();
                                } else {
                                    console.log('No results found');
                                }
                            } else {
                                console.log('Geocoder failed due to: ' + status);
                            }
                        });
                    })
                } else {
                    console.log('Drowser not supported');
                }
            });
        },
        getAddressNameFromAddressComponents: function (component, i = 0) {
            if ($.isPlainObject(component[i])) {
                const comp = component[i];

                if (comp.types && comp.types.length) {
                    if ($.inArray(comp.types[0], ['street_number', 'premise', 'postal_code', 'subpremise']) === -1) {
                        return comp.long_name;
                    }

                    return searchBox.getAddressNameFromAddressComponents(component, i+1);
                }
            }

            return component[0].long_name;
        },
        updatePrice: function(data) {
            let token = document.head.querySelector('meta[name="csrf-token"]');

            fetch('/search/price', {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token.content
                },
                body: data
            })
            .then(response => response.json())
            .then(data => {
                const element = document.getElementById('searchbox-slider');
                element.noUiSlider.set([data.price.min_price, data.price.max_price]);
                element.noUiSlider.updateOptions({
                    range: {
                        'min': data.price.min_price,
                        'max': data.price.max_price
                    }
                });
                $('#searchbox-slider-text-1').text(searchBox.formatPrice(data.price.min_price));
                $('#searchbox-slider-text-2').text(searchBox.formatPrice(data.price.max_price));
            }).catch(error => console.log('Error :(', error));
        },
        updateState: function() {
            $('.home-filter').change(function() {
                let param = $(this).data('param');
                let state = $(this).prop('checked');

                let data = searchBox.state;
                data[param] = state ? 1 : 0;

                searchBox.updatePrice(JSON.stringify(searchBox.state));
            });
        }
    }
    if ($parent.length) {
        searchBox.init();
    }

    $('#collapseAddCommute').on('show.bs.collapse hide.bs.collapse', function () {
            const $title = $('#titleAddCommute');
            let data = $title.data('text');
            let text = $title.text();

            $title.text(data);
            $title.data('text', text);
    });
});
