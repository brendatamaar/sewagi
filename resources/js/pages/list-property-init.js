$(document).ready(function(){
    $parent = $("#list-property, #dashboard");
    let listPropertyInit = {
        init: function () {
            this.listPropertyEstateType();
            this.listPropertyBedroom();
            this.btnCounter();
            this.totalListedBedroom();
            this.resetRowBedroom();
            this.customSwitch();
            this.listPropertyLocation();
            this.listPropertyLocationMap();
            this.listPropertyDescription();
            this.listPropertyAmenities();
            this.listPropertyPhotos();
            this.listPropertyLegal();
            this.listPropertyEntire();
            this.listPropertyCoLiving();
            //this.selectStyled();
            this.dateTimePicker();
            this.formPassword();
            this.itemShowCard();
            this.popover();
            this.select2General();
            this.checkboxRadio();
            /*Handle delete custom category*/
            this.deleteNewCategory();
            /*Check form completeness*/
            this.checkImageCompleteness();
            this.popoverCustom();
            if ($("#circle-fill").length)
                this.countDown();
        },
        listPropertyEstateType: function() {
            var locale = $('#add-property-locale').val();
            $("#estate-type").select2({
                placeholder: locale=='id' ? "Pilih jenis tempat tinggal" : "Select estate type",
                dropdownAutoWidth: true,
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            // List property estate type
            function enableNextBtn() { // test value is selected AND checkbox is checked
                setTimeout(function() {
                    // if ($("#estate-type").val() == 'Apartment'){
                    //     var ok = $(".card-list-property .btn-checkbox.active").length && $("#estate-type").val() !== '' && $("#unit-size-input").val() !== '';
                    // }
                    // else if ($("#estate-type").val() == 'House'){
                    //     var ok = $(".card-list-property .btn-checkbox.active").length && $("#estate-type").val() !== '' && $("#building-size-input").val() !== '';
                    // }
                    // if (ok) {
                    //     $(".btn-next-list-property").removeClass("disabled");
                    // } else {
                    //     $(".btn-next-list-property").addClass("disabled");
                    // }
                }, 200);
            }

            function checkActiveCheckbox() {
                setTimeout(function() {
                    if ($(".card-list-property .btn-checkbox.active").length == 2) {
                        $(".info-estate-type").fadeIn();
                    } else {
                        $(".info-estate-type").fadeOut();
                    }
                }, 200);
            }
            $(document).ready(function() {
                $("#estate-type").on("change", enableNextBtn).change(); // run on change and run change on load
                $(".card-list-property .btn-checkbox").on("click", enableNextBtn); // run on click
                $("#unit-size-input").on("change", enableNextBtn).change();
                $("#building-size-input").on("change", enableNextBtn).change();

                $(".card-list-property .btn-checkbox").on("click", checkActiveCheckbox); // run on click
            });
            // End of List property estate type
        },

        listPropertyBedroom: function() {
            var updateBedroom = $('input[name=updateBedroom]');
            var isUpdateBedroom = updateBedroom ? true : false;

            if(!updateBedroom){
                initBedroom();
            } else {
                var locale = $('#add-property-locale').val();
                $('.bedroom-row-active').each(function(i, obj){
                    $(".bed-type", $(this)).select2({
                        placeholder: locale=='id' ? "Pilih tipe" : "Select the type",
                        width: '100%',
                        containerCssClass: "select2-list-property",
                        dropdownCssClass: "select2-list-property-dropdown bed-dropdown",
                        minimumResultsForSearch: Infinity,
                        templateResult: formatBedroom
                    });

                    $(".bed-furniture", $(this)).select2({
                        placeholder: locale=='id' ? "Pilih penataan furnitur" : "Select the furniture arrangement",
                        dropdownAutoWidth: true,
                        width: '100%',
                        containerCssClass: "select2-list-property",
                        dropdownCssClass: "select2-list-property-dropdown",
                        minimumResultsForSearch: Infinity
                    });

                    $(".bed-arrangement", $(this)).select2({
                        placeholder: locale=='id' ? "Pilih penataan kamar" : "Select the bed arrangement",
                        dropdownAutoWidth: true,
                        width: '100%',
                        containerCssClass: "select2-list-property",
                        dropdownCssClass: "select2-list-property-dropdown",
                        minimumResultsForSearch: Infinity
                    });

                    var roomId = i+1;
                    var bedFurniture = $(obj).find('.bed-furniture');
                    if (bedFurniture.val() == 'furnished' || bedFurniture.val() == 'semi-furnished') {
                        $(obj).find('.bedroom-amenities-furnished').parent().show();
                        $(obj).find('.bedroom-amenities-unfurnished').parent().hide();
                        $(obj).find('.bed-arrangement-wrapper').fadeIn();
                        $(obj).find('.checkbox-furnished').fadeIn();
                    } else {
                        $(obj).find('.bedroom-amenities-furnished').parent().hide();
                        $(obj).find('.bedroom-amenities-unfurnished').parent().show();
                        $(obj).find('.bed-arrangement-wrapper').fadeOut();
                        $(obj).find('.checkbox-furnished').fadeOut();
                        // Clear bed arrangement value when bed furniture change
                        $(obj).find('.bed-arrangement').val('').trigger('change');
                    }

                    bedFurniture.change(function() {
                        if (bedFurniture.val() == 'unfurnished') {
                            $(obj).find('.bedroom-amenities-furnished').parent().hide();
                            $(obj).find('.bedroom-amenities-unfurnished').parent().show();
                            $(obj).find('.bed-arrangement-wrapper').fadeOut();
                            $(obj).find('.checkbox-furnished').fadeOut();
                            // Clear bed arrangement value when bed furniture change
                            $(obj).find('.bed-arrangement').val('').trigger('change');
                        } else {
                            $(obj).find('.bedroom-amenities-furnished').parent().show();
                            $(obj).find('.bedroom-amenities-unfurnished').parent().hide();
                            $(obj).find('.bed-arrangement-wrapper').fadeIn();
                            $(obj).find('.checkbox-furnished').fadeIn();
                        }
                    });
                    buildRoomNumbering();
                    toggleRoomAvailabilityModal()
                    var qty = $(obj).find('.bedroom-quantity').val();
                    $(obj).find('.bedroom-quantity').change(function(){
                        if(qty < $(this).val()){
                            $('#popUpIncreaseBedroom').modal('show');
                        } else{
                            $('#popUpDecreaseBedroom').modal('show');
                        }
                        qty = $(this).val();
                    });
                })
            }

            $('#btn-add-newbedroom').on('click', function(e) {
                e.preventDefault();
                add_row($('#bedroom-wrapper'));
                listPropertyInit.totalListedBedroom();
                listPropertyInit.resetRowBedroom();
            });
            initBedroomSelect2();
            initBedroomValidation();
            listPropertyInit.totalListedBedroom();

            function add_row($wrapper) {
                var propertyId = $("#property-id").val();
                var section_id = $wrapper.find('.card').length;
                var $template = $wrapper.find('.template-bedroom');
                var bedroomName = 'Bedroom '+ section_id;

                $.post("/create-property/add-bedroom", {property_id:propertyId,name: bedroomName})
                .done(function (data) {
                    var $tr = $template.clone()
                                .removeClass('template-bedroom')
                                .prop('id', 'bedroom' + section_id)
                                .addClass('bedroom-row-active form-bedroom')
                                .attr('data-id', data.id);
                    $tr.find('.bed-type').addClass('select2inp');
                    $tr.find('.bed-furniture').addClass('select2inp');
                    $tr.find('.bed-arrangement').addClass('select2inp');
                    $tr.find('.bed_id').val(data.id);
                    // $tr.find('.bedroom-wrapper-content').attr('data-id', data.id);

                    $wrapper.find('#bedroom-wrapper-content').append($tr);

                    initBedroomSelect2();
                    // Bedroom title default
                    $('#bedroom' + section_id).find('.bedroom-title').html('Bedroom ' + section_id);
                    $('#bedroom' + section_id + ' .bed-type').on('change', function() {
                        var val = $(this).val();
                        // Change title
                        $(this).parents().find('#bedroom' + section_id).find('.bedroom-title').html(val);
                    });

                    initBedroomValidation();
                    buildRoomNumbering();
                    toggleRoomAvailabilityModal()
                    listPropertyInit.totalListedBedroom();

                    var qty = $('#bedroom' + section_id).find('.bedroom-quantity').val();
                    $('#bedroom' + section_id).find('.bedroom-quantity').change(function(){
                        if(qty < $(this).val()){
                            $('#popUpIncreaseBedroom').modal('show');
                        } else{
                            $('#popUpDecreaseBedroom').modal('show');
                        }
                        qty = $(this).val();
                    });

                });
            }

            function initBedroomSelect2 () {
                $(".select2inp.bed-type").select2({
                    placeholder: locale=='id' ? "Pilih tipe" : "Select the type",
                    width: '100%',
                    containerCssClass: "select2-list-property",
                    dropdownCssClass: "select2-list-property-dropdown bed-dropdown",
                    minimumResultsForSearch: Infinity,
                    templateResult: formatBedroom
                });

                $(".select2inp.bed-furniture").select2({
                    placeholder: locale=='id' ? "Pilih penataan furnitur" : "Select the furniture arrangement",
                    dropdownAutoWidth: true,
                    width: '100%',
                    containerCssClass: "select2-list-property",
                    dropdownCssClass: "select2-list-property-dropdown",
                    minimumResultsForSearch: Infinity
                });

                $(".select2inp.bed-arrangement").select2({
                    placeholder: locale=='id' ? "Pilih penataan kamar" : "Select the bed arrangement",
                    dropdownAutoWidth: true,
                    width: '100%',
                    containerCssClass: "select2-list-property",
                    dropdownCssClass: "select2-list-property-dropdown",
                    minimumResultsForSearch: Infinity
                });

                $('.bed-furniture').on('change', function() {
                    if ($(this).val() == 'furnished' || $(this).val() == 'semi-furnished') {
                        $(this).closest('.form-bedroom').find('.bed-arrangement-wrapper').fadeIn();
                        $(this).closest('.form-bedroom').find('.checkbox-furnished').fadeIn();
                    } else {
                        // $(this).parents().find('#bedroom' + section_id).find('.bed-arrangement-wrapper').fadeOut();
                        // $(this).parents().find('#bedroom' + section_id).find('.checkbox-furnished').fadeOut();
                        // // Clear bed arrangement value when bed furniture change
                        // $(this).parents().find('#bedroom' + section_id).find('.bed-arrangement').val('').trigger('change');
                    }
                });
            }

            function initBedroom() {
                add_row($('#bedroom-wrapper'));

                $(".form-bedroom").on('submit', function (e) {
                    e.preventDefault();
                    formData = $(this).serializeArray();
                });
            }

            function formatBedroom(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "/img/bedroom";
                var $state = $(
                    '<div class="d-flex"><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.svg" class="img-bedroom mr-3" /> ' + '<div>' + '<h6 class="mb-0">' + state.text + '</h6>' + '<span class="fs-12">' + state.title + '</span>' + '</div>' + '</div>'
                );
                return $state;
            };

            function rebuildRoomNumberingSwitch(key) {
                var roomNumber = $('.bedroom-row-active').eq(key).find('.bedroom-quantity').val();
                var currentRoomNumber = $('.modal-room-numbering-active').eq(key).find('.modal-room-numbering-switch').length;
                if (roomNumber > currentRoomNumber) {
                    for (i = 0; i < roomNumber - currentRoomNumber; i++) {
                        var count = $('#count').val();
                        var clone = $('#modal-room-numbering-switch-clone').html().replace(new RegExp("customSwitch", "g"), 'customSwitch' + (parseInt(count) + 1))
                        $('#count').val((parseInt(count) + 1));
                        $('.modal-room-numbering-active').eq(key).find('.modal-room-numbering-container').append(clone);
                    }
                    var roomNumbering = $('.modal-room-numbering-active').eq(key).find($('.input-room-numbering'));
                    var buttonNumbering = $('.modal-room-numbering-active').eq(key).find($('.btn-room-numbering-done'));
                    roomNumbering.on('keyup', function() {
                        var isEmpty = false;
                        $.each(roomNumbering, function(key, value) {
                            if ($(this).val() == '') {
                                isEmpty = true;
                            }
                        });
                        if (isEmpty) {
                            buttonNumbering.addClass('disabled');
                        } else {
                            buttonNumbering.removeClass('disabled');
                        }
                    })
                } else if (roomNumber < currentRoomNumber) {
                    for (i = 0; i < currentRoomNumber - roomNumber; i++) {
                        var temp = $('.modal-room-numbering-active').eq(key).find('.modal-room-numbering-switch');
                        temp.last().remove();
                    }
                }
            }

            function buildRoomNumbering() {
                var modalRoomNumberingClone = $('#modalRoomNumbering').clone();
                modalRoomNumberingClone.addClass('modal-room-numbering-active');
                var countBedroomRowActive = 1;
                if ($('.modal-room-numbering-active').length > 0) {
                    countBedroomRowActive = parseInt($('.modal-room-numbering-active').length) + 1;
                }
                modalRoomNumberingClone.attr('id', 'modalRoomNumbering' + countBedroomRowActive);
                $('#modal-room-numbering-container').append(modalRoomNumberingClone);
                $.each($('.bedroom-row-active'), function(key, value) {
                    var bedroomRowActive = $(this);
                    bedroomRowActive.find('.modal-room-numbering-link').attr('data-target', '#modalRoomNumbering' + (key + 1));
                    rebuildRoomNumberingSwitch(key);
                    bedroomRowActive.find('.bedroom-quantity').change(function() {
                        rebuildRoomNumberingSwitch(key);
                    });
                    var bedFurniture = bedroomRowActive.find('.bed-furniture');
                    bedFurniture.change(function() {
                        if (bedFurniture.val() == 'unfurnished') {
                            bedroomRowActive.find('.bedroom-amenities-furnished').parent().hide();
                            bedroomRowActive.find('.bedroom-amenities-unfurnished').parent().show();
                        } else {
                            bedroomRowActive.find('.bedroom-amenities-furnished').parent().show();
                            bedroomRowActive.find('.bedroom-amenities-unfurnished').parent().hide();
                        }
                    });
                });
            }

            function toggleRoomAvailabilityModal() {
                $('.custom-switch').find('input[name=roomAvailability]').change(function(){
                    if(!$(this).is(':checked')){
                        $('#popUpAvailabilityBedroom').modal('show');
                    }
                });
            }

            function initBedroomValidation () {
                $(".form-bedroom").each(function( index ) {
                    $(this).validate({
                        errorPlacement: function ( error, element ) {
                            if (element.parent().hasClass('input-group')) {
                                error.insertAfter( element.parent() );
                            } else {
                                error.appendTo(element.parent());
                            }
                        },
                        submitHandler: function (form) {
                            saveBedroom($(form));
                        }
                    });
                });
            }

            function saveBedroom($form) {
                var formData = $form.serializeArray();
                $.post("/create-property/update-bedroom", formData)
                .done(function (data) {
                    $form.find(".bedroom-title").html(data.name);
                });
            }

        },

        btnCounter: function() {
            $('.btn-counter > button').click(function(e) {
                e.preventDefault();
                var button_classes, value = +$('.btn-counter .counter').val();
                button_classes = $(e.currentTarget).prop('class');
                if (button_classes.indexOf('up_count') !== -1) {
                    value = (value) + 1;
                } else {
                    value = (value) - 1;
                }
                value = value < 0 ? 0 : value;
                $('.btn-counter .counter').val(value);
                $("#total-bathroom").val(value);
            });
            $('.btn-counter .counter').click(function() {
                $(this).focus().select();
            });
        },

        totalListedBedroom: function() {
            var sum = 0;
            $('.form-bedroom .bedroom-quantity').each(function() {
                sum += Number($(this).val());
            });
            $('#total-listed-bedroom').html(sum);
            $("#total-bedroom").val(sum);

            // totalListBedroomVal();

            // $('.bedroom-quantity').on('keyup', function() {
            //     totalListBedroomVal();
            // })
        },

        resetRowBedroom: function() {

            $('#bedroom-wrapper-content').on('click', '.bedroom-row-reset', function() {
                var bedroomId = $(this).closest(".form-bedroom").data('id');
                $formDeleted = $(".form-bedroom[data-id='"+ bedroomId +"']");
                $.ajax({
                    url: '/create-property/delete-bedroom',
                    method: 'DELETE',
                    data: {id: bedroomId}
                }).then(function() {
                    $formDeleted.remove();
                    listPropertyInit.totalListedBedroom();
                });
            });

            var locale = $('#add-property-locale').val();
            $('#bedroom1 .bedroom-row-reset').on('click', function() {
                // $('#bedroom1 .select2').val('').trigger('change');
                // $('#bedroom1 .bedroom-size').val('');
                // $('#bedroom1 .bedroom-quantity').val('1');
                // $('#bedroom1 .btn-checkbox').removeClass('active').end().find('[type="checkbox"]').prop('checked', false);
                // $('#bedroom1 .bedroom-title').html((locale=='id' ? 'Kamar ' : 'Bedroom ') + ' 1');
            });

        },

        customSwitch: function() {
            $('.custom-switch-available input').on('change', function() {
                if ($('.custom-switch-available input').is(':checked')) {
                    $(this).parent().find('.custom-control-label span').html('Available');
                } else {
                    $(this).parent().find('.custom-control-label span').html('Not Available');
                }
            });

            $('#pet-switch').on('change', function() {
                var locale = $('#add-property-locale').val();
                if ($('#pet-switch').is(':checked')) {
                    $('#pet-switch-label').html(locale=='id' ? 'Boleh membawa hewan peliharaan' : 'Pet Friendly');
                } else {
                    $('#pet-switch-label').html(locale=='id' ? 'Dilarang membawa hewan peliharaan' : 'Not Pet Friendly');
                }
            });

            $('.custom-switch-thumbnails').on('change', 'input', function(event) {
                event.stopImmediatePropagation();
                listPropertyInit.toggleMainImage($(this));
            });
        },

        toggleMainImage: function (element) {
            var id = element.data('id');
            if (element.is(':checked')) {
                /*Set thumbnail*/
                $.ajax({
                    url: '/create-property/set-as-thumbnail',
                    type: 'POST',
                    data: {
                        id: id
                    }
                });
                element.parent().find('.custom-control-label span').addClass('active');
                $('.custom-switch-thumbnails').each(function(index, el) {
                    var input = $(this).find('input');
                    if (input.data('id')!=id) {
                        input.prop('checked', false);
                        $(this).find('.custom-control-label span').removeClass('active');
                    }
                });
            } else {
                element.parent().find('.custom-control-label span').removeClass('active');
            }
        },

        listPropertyLocation: function() {
            $("#newPropertyData3").validate();
        },

        listPropertyLocationMap: function() {
            function initMap() {
                var geocoder = new google.maps.Geocoder;
                var infowindow = new google.maps.InfoWindow;
                var myLatLng = { lat: parseFloat($('#latitude').val()), lng: parseFloat($('#longitude').val()) };
                var map = new google.maps.Map(document.getElementById('list-property-map'), {
                    zoom: 16,
                    center: myLatLng
                });
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: '/img/pin-point.svg',
                    draggable: true
                });
                google.maps.event.addListener(marker, 'dragend', function(evt) {
                    $('#latitude').val(evt.latLng.lat());
                    $('#longitude').val(evt.latLng.lng());
                });
                $('#link-adjust').on('click', function(e) {
                    e.preventDefault();
                    $('#input-property-street-number').val('');
                    $('#input-property-city').val('');
                    $('#input-property-district').val('');
                    $('#input-property-province').val('');
                    $('#input-property-village').val('');
                    $('#input-property-postcode').val('');
                    var latlng = { lat: parseFloat($('#latitude').val()), lng: parseFloat($('#longitude').val()) };
                    geocoder.geocode({ 'location': latlng }, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                var addressComp = results[0].address_components;
                                for (var key in addressComp) {
                                    if (addressComp[key].types[0] == 'route') {
                                        var newOption = new Option(addressComp[key].long_name, addressComp[key].long_name, true, true);
                                        $('#select-property-prediction').append(newOption).trigger('select');
                                        $('#input-property-address').val(addressComp[key].long_name);
                                    } else if (addressComp[key].types[0] == 'street_number') {
                                        $('#input-property-street-number').val(addressComp[key].long_name);
                                    } else if (addressComp[key].types[0] == 'administrative_area_level_2') {
                                        $('#input-property-city').val(addressComp[key].long_name);
                                    } else if (addressComp[key].types[0] == 'administrative_area_level_3') {
                                        $('#input-property-district').val(addressComp[key].long_name);
                                    } else if (addressComp[key].types[0] == 'administrative_area_level_1') {
                                        $('#input-property-province').val(addressComp[key].long_name);
                                    } else if (addressComp[key].types[0] == 'administrative_area_level_4') {
                                        $('#input-property-village').val(addressComp[key].long_name);
                                    } else if (addressComp[key].types[0] == 'postal_code') {
                                        $('#input-property-postcode').val(addressComp[key].long_name);
                                    }
                                }
                            } else {
                                console.log('No results found');
                            }
                        }
                    });
                });
            };

            function autocomplete() {
                var locale = $('#add-property-locale').val();
                $('#property-addr-autocomplete').autoComplete({
                    minChars: 3,
                    source: function(term, response){
                        $.getJSON('/place-auto-complete', { place_name: term, restrict_place: true }, function(data){
                            response(data.predictions);
                        });
                    },
                    renderItem: function (item, search) {
                        return `<div class="autocomplete-suggestion suggestion-item" data-id="${item.id}" data-place_id="${item.place_id}"
                        data-place="${item.description}">${item.description}</div>`;
                    },
                    onSelect: function(e, term, item) {
                        var placeId = item.data('place_id');
                        $('#property-addr-autocomplete').val(item.data('place'));

                        $.ajax({
                            type: 'get',
                            url: '/place-details',
                            data: {place_id: placeId},
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#select-property-prediction').val(response.result.name);
                                    var addressComp = response.result.address_components;
                                    for (var key in addressComp) {
                                        if (addressComp[key].types[0] == 'route') {
                                            var newOption = new Option(addressComp[key].long_name, addressComp[key].long_name, true, true);
                                            $('#select-property-prediction').append(newOption).trigger('select');
                                            $('#input-property-address').val(addressComp[key].long_name);
                                        } else if (addressComp[key].types[0] == 'street_number') {
                                            $('#input-property-street-number').val(addressComp[key].long_name);
                                        } else if (addressComp[key].types[0] == 'administrative_area_level_2') {
                                            $('#input-property-city').val(addressComp[key].long_name);
                                        } else if (addressComp[key].types[0] == 'administrative_area_level_3') {
                                            $('#input-property-district').val(addressComp[key].long_name);
                                        } else if (addressComp[key].types[0] == 'administrative_area_level_1') {
                                            $('#input-property-province').val(addressComp[key].long_name);
                                        } else if (addressComp[key].types[0] == 'administrative_area_level_4') {
                                            $('#input-property-village').val(addressComp[key].long_name);
                                        } else if (addressComp[key].types[0] == 'postal_code') {
                                            $('#input-property-postcode').val(addressComp[key].long_name);
                                        }
                                    }
                                    $('#latitude').val(response.result.geometry.location.lat);
                                    $('#longitude').val(response.result.geometry.location.lng);
                                    initMap();
                                }
                            }
                        });
                    }
                });

                $("#select-property-prediction").select2({
                    placeholder: locale=='id' ? 'Masukkan alamat jalan atau nama gedung' : 'Enter the street address or Building Name',
                    tags: true,
                    templateSelection: formatCompanyName,
                    ajax: {
                        url: '/place-auto-complete',
                        data: function(params) {
                            $('#input-property-address').val(params.term);
                            var query = {
                                'place_name': params.term
                            }
                            return query;
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data.predictions, function(item) {
                                    return {
                                        text: item.description,
                                        id: item.place_id
                                    }
                                })
                            };
                        },
                        success: function(response) {
                            $('#select-property-prediction').change(function() {
                                $('#input-property-street-number').val('');
                                $('#input-property-city').val('');
                                $('#input-property-district').val('');
                                $('#input-property-province').val('');
                                $('#input-property-village').val('');
                                $('#input-property-postcode').val('');
                                $('#input-property-address').val($('#select-property-prediction').val());
                                $.ajax({
                                    type: 'get',
                                    url: '/place-details',
                                    data: {
                                        'place_id': $('#select-property-prediction').val()
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response) {
                                            $('#select-property-prediction').val(response.result.name);
                                            var addressComp = response.result.address_components;
                                            for (var key in addressComp) {
                                                if (addressComp[key].types[0] == 'route') {
                                                    var newOption = new Option(addressComp[key].long_name, addressComp[key].long_name, true, true);
                                                    $('#select-property-prediction').append(newOption).trigger('select');
                                                    $('#input-property-address').val(addressComp[key].long_name);
                                                } else if (addressComp[key].types[0] == 'street_number') {
                                                    $('#input-property-street-number').val(addressComp[key].long_name);
                                                } else if (addressComp[key].types[0] == 'administrative_area_level_2') {
                                                    $('#input-property-city').val(addressComp[key].long_name);
                                                } else if (addressComp[key].types[0] == 'administrative_area_level_3') {
                                                    $('#input-property-district').val(addressComp[key].long_name);
                                                } else if (addressComp[key].types[0] == 'administrative_area_level_1') {
                                                    $('#input-property-province').val(addressComp[key].long_name);
                                                } else if (addressComp[key].types[0] == 'administrative_area_level_4') {
                                                    $('#input-property-village').val(addressComp[key].long_name);
                                                } else if (addressComp[key].types[0] == 'postal_code') {
                                                    $('#input-property-postcode').val(addressComp[key].long_name);
                                                }
                                            }
                                            $('#latitude').val(response.result.geometry.location.lat);
                                            $('#longitude').val(response.result.geometry.location.lng);
                                            initMap()
                                        }
                                    }
                                });
                            });
                        }
                    }
                });
            };

            function formatCompanyName(state) {
                var $state = state.text;
                if (state.text.indexOf(',') > 0) {
                    $state = state.text.substr(0, state.text.indexOf(','));
                }
                return $state;
            };
            if ($('#list-property-map').length) {
                autocomplete();
                initMap();
            }
        },

        listPropertyDescription: function() {
            var locale = $('#add-property-locale').val();
            $("#property-land-area").select2({
                placeholder: locale=='id' ? 'Masukkan jenis lahan' : 'Select the land area type',
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#property-arrangement").select2({
                placeholder: locale=='id' ? 'Pilih penataan properti' : 'Select the property arrangement',
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#property-floor").select2({
                placeholder: locale=='id' ? 'Masukkan jumlah lantai' : 'Select floor stories range',
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#newPropertyData4").validate({
                errorPlacement: function ( error, element ) {
                    if (element.parent().hasClass('input-group')) {
                        error.insertAfter( element.parent() );
                    } else {
                        error.appendTo(element.parent());
                    }
                }
            });
        },

        listPropertyAmenities: function() {
            var locale = $('#add-property-locale').val();
            $("#furniture-arrangement").select2({
                placeholder: locale=='id' ? 'Masukkan penataan perabot' : 'Select the furniture arrangement',
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });
        },

        listPropertyPhotos: function() {
            function btnPhotosToggle() {
                var locale = $('#add-property-locale').val();
                $(".btn-add-photos").click(function() {
                    if (locale=='id') {
                        $(this).text($(this).text() == 'Simpan Foto' ? '+ Tambahkan Foto' : 'Simpan Foto');
                    } else {
                        $(this).text($(this).text() == 'Save Photos' ? '+ Add Photos' : 'Save Photos');
                    }
                });
            }

            btnPhotosToggle();

            var locale = $('#add-property-locale').val();
            $("#add-category-photos").select2({
                placeholder: locale=='id' ? 'Pilih kategori' : 'Select category',
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#add-more-category").click(function() {
                $('.category-select').fadeToggle();
            });

            $('#add-category-photos').on('change', function() {
                add_row_category($('#category-photo-wrapper'), $(this));
            });

            function add_row_category($wrapper, element) {
                var section_id = $wrapper.find('.card').length;
                var $template = $('#template-category-new-photo').html();
                var $addCategoryVal = $('option:selected', element).html();
                $addCategoryValLow = $addCategoryVal.replace(/\s+/g, '-').toLowerCase();

                var $tr = $($template).appendTo($wrapper).removeClass('template-category-photo').addClass('category-' + section_id);
                // $wrapper.append($tr);
                $tr.find('h5').text($addCategoryVal);
                $tr.find('.btn-add-photos').attr('href', '#category-' + $addCategoryValLow);
                $tr.find('.collapse').attr('id', 'category-' + $addCategoryValLow);
                $tr.find('.custom-switch-thumbnails input').attr('id', $addCategoryValLow + '-switch');
                $tr.find('.custom-switch-thumbnails label').attr('for', $addCategoryValLow + '-switch');

                $('.category-select').fadeOut();

                $('.trigger-modal-reset').on('click', function() {
                    $('#modalConfirmationCategory').find('.category-row-reset').addClass('category-row-reset-' + section_id);
                    $('.category-row-reset-' + section_id).on('click', function() {
                        $('body').find('.category-' + section_id).remove();
                    });
                });
                /*Save to new category*/
                $.ajax({
                    url: '/create-property/add-additional-category',
                    type: 'POST',
                    data: {property_id: $('#property-id').val(), photable_id: element.val() },
                    success: function(response) {
                        $tr.find('.custom-switch-thumbnails input').data('id', response);
                        $tr.find('.upload-image-video').attr('id', 'upload-media-' + response);
                        $tr.find('.upload-image-video').attr('data-id', response);
                        $tr.find('.preview-images').attr('id', 'preview-image-' + response);
                        $tr.find('.dropzone-area').attr('id', 'dropzone-button-' + response);
                        $tr.find('.delete-category-step-6').attr('data-id', response);
                        /*Init main image switch*/
                        listPropertyInit.customSwitch();
                        listPropertyInit.deleteNewCategory();

                        /*Init drop zone*/
                        var imageDropzone = [];
                        var myTemplate = $("#mydz-template").html();
                        var t = $tr.find(".input-new-dz");
                        photoId = $(this).data('id');
                        dzId    = $(this).attr('id');

                        var form = t.closest('form');
                        var photoIndicator = form.find('.photo-indicator').find('.list-inline').find('.list-inline-item');
                        var previewImages = form.find('.preview-images').find('.dz-complete');
                        imageDropzone[response] = new Dropzone("#upload-media-" + response, {
                            previewTemplate: myTemplate,
                            paramName: "file",
                            url: '/create-property/upload-image',
                            headers: {
                                'x-csrf-token': token.content
                            },
                            parallelUploads: 3,
                            autoQueue: true,
                            addRemoveLinks: true,
                            previewsContainer: '#preview-image-' + response,
                            clickable: '#dropzone-button-' + response,
                            dictRemoveFile: '<i class="fa fa-times-circle"></i>',
                            dictCancelUpload: '',
                            success: function (file, response) {
                                file.id = response.id;
                                var previewImages = form.find('.preview-images').find('.dz-complete');
                                var uploadedImage = previewImages.length ? parseInt(previewImages.length) + 1 : 1 ;

                                var maxUploadedImage = photoIndicator.length ? photoIndicator.length : 0 ;
                                /*Set Indicator*/
                                if (photoIndicator.length) {
                                    photoIndicator.each(function(index, el) {
                                        /*Remove class First*/
                                        $(this).removeClass('bg-success');
                                        if (index<uploadedImage) {
                                            /*And then add class*/
                                            $(this).addClass('bg-success')
                                        }
                                    });
                                }
                                listPropertyInit.checkImageCompleteness();
                            },
                            init: function () {
                                var dropzone = this;
                                $.ajax({
                                    url: '/property/photos',
                                    type: 'POST',
                                    data: {id: photoId},
                                    dataType: 'json',
                                    success: function (data) {
                                        // if (data.length >= 6) {
                                        //     $("#dropzone-button-"+photoId).addClass('d-none');
                                        // }
                                        $.each(data, function (key, row) {
                                            var media = row;
                                            var mockFile = {
                                                name: media.file_name,
                                                size: media.size,
                                                id: row.id
                                            };
                                            dropzone.emit("addedfile", mockFile);
                                            dropzone.emit("thumbnail", mockFile, media.url);
                                            dropzone.emit("complete", mockFile);
                                        });
                                        var previewImages = form.find('.preview-images').find('.dz-complete');
                                        var uploadedImage = previewImages.length ? parseInt(previewImages.length) : 0 ;

                                        var maxUploadedImage = photoIndicator.length ? photoIndicator.length : 0 ;
                                        /*Set Indicator*/
                                        if (photoIndicator.length) {
                                            photoIndicator.each(function(index, el) {
                                                /*Remove class First*/
                                                $(this).removeClass('bg-success');
                                                if (index<uploadedImage) {
                                                    /*And then add class*/
                                                    $(this).addClass('bg-success')
                                                }
                                            });
                                        }
                                    },
                                    error: function (response) {
                                        console.log("Error:"+response);
                                    }
                                });
                            },
                            removedfile: function (file) {
                                $.ajax({
                                    url: '/property/photos/' + file.id,
                                    type: 'DELETE',
                                    dataType: 'json',
                                    success: function (response) {
                                        file.previewElement.remove();
                                        var previewImages = form.find('.preview-images').find('.dz-complete');
                                        var uploadedImage = previewImages.length ? parseInt(previewImages.length) : 0 ;
                                        console.log('removed uploadedImage ' + uploadedImage);
                                        var maxUploadedImage = photoIndicator.length ? photoIndicator.length : 0 ;
                                        /*Set Indicator*/
                                        if (photoIndicator.length) {
                                            photoIndicator.each(function(index, el) {
                                                /*Remove class First*/
                                                $(this).removeClass('bg-success');
                                                if (index<uploadedImage) {
                                                    /*And then add class*/
                                                    $(this).addClass('bg-success')
                                                }
                                            });
                                        }
                                    },
                                    error: function (response) {
                                        console.log(response);
                                    }
                                });
                            },
                        }).on("sending", function (file, xhr, formData) {
                            var dropzone = this;
                            formData.append("id", dropzone.photoId);

                            var previewImages = form.find('.preview-images').find('.dz-complete');
                            var uploadedImage = previewImages.length ? parseInt(previewImages.length) : 1 ;
                            var maxUploadedImage = photoIndicator.length ? photoIndicator.length : 0 ;
                            console.log('Already uploadedImage ' + uploadedImage);
                            if (uploadedImage>=maxUploadedImage) {
                                dropzone.removeFile(file);
                                $('#modal-upload-limit').modal();
                                return false;
                            }
                        });
                        imageDropzone[response].photoId = response;
                    }
                });

                btnPhotosToggle();
            }
        },

        listPropertyLegal: function() {
            var locale = $('#add-property-locale').val();
            $("#your-status").select2({
                placeholder: locale=='id' ? 'Pilih status Anda' : 'Select your status',
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });
            $("#ownership-status").select2({
                placeholder: locale=='id' ? 'Pilih status kepemilikan properti' : 'Select property ownership status',
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            var belong_to = $('#your-status').val();
            if (belong_to){
                if (belong_to === '1') {
                    $('#property-legal-certificate-ownership').fadeIn();
                    $('#property-legal-certificate-wrapper').fadeIn();
                    $('#property-legal-certificate-authority').fadeOut();
                } else if (belong_to === '2') {
                    $('#property-legal-certificate-ownership').fadeIn();
                    $('#property-legal-certificate-wrapper').fadeIn();
                    $('#property-legal-certificate-authority').fadeOut();
                } else if (belong_to === '3') {
                    $('#property-legal-certificate-ownership').fadeOut();
                    $('#property-legal-certificate-wrapper').fadeOut();
                    $('#property-legal-certificate-authority').fadeIn();
                } else {
                    $('#property-legal-certificate-ownership').fadeOut();
                    $('#property-legal-certificate-wrapper').fadeOut();
                    $('#property-legal-certificate-authority').fadeOut();
                }
            }
            else{
                $('#property-legal-certificate-ownership').fadeOut();
                $('#property-legal-certificate-wrapper').fadeOut();
                $('#property-legal-certificate-authority').fadeOut();
            }

            $('#your-status').on('change', function() {
                var belong_to = $(this).val();
                /*Save property status*/
                listPropertyInit.savePropertyStatus();

                if (belong_to){
                    $('#property-legal-certificate-wrapper').fadeIn();
                    if (belong_to === '1') {
                        $('#property-legal-certificate-ownership').fadeIn();
                        $('#property-legal-certificate-wrapper').fadeIn();
                        $('#property-legal-certificate-authority').fadeOut();
                    } else if (belong_to === '2') {
                        console.log('2');
                        $('#property-legal-certificate-ownership').fadeIn();
                        $('#property-legal-certificate-wrapper').fadeIn();
                        $('#property-legal-certificate-authority').fadeOut();
                    } else if (belong_to === '3') {
                        console.log('3');
                        $('#property-legal-certificate-ownership').fadeOut();
                        $('#property-legal-certificate-wrapper').fadeOut();
                        $('#property-legal-certificate-authority').fadeIn();
                    } else {
                        $('#property-legal-certificate-ownership').fadeOut();
                        $('#property-legal-certificate-wrapper').fadeOut();
                        $('#property-legal-certificate-authority').fadeOut();
                    }
                }
                else{
                    $('#property-legal-certificate-wrapper').fadeOut();
                }
            });
            /*Ownership status*/
            $('#ownership-status').on('change', function() {
                listPropertyInit.savePropertyStatus();
            });

            if ($('#property-insured-switch').is(':checked')) {
                $('#property-insurance-document-wrapper').fadeIn();
            } else {
                $('#property-insurance-document-wrapper').fadeOut();
            }

            /*Insurance status*/
            $('#property-insured-switch').on('change', function() {
                listPropertyInit.savePropertyStatus();
                if ($('#property-insured-switch').is(':checked')) {
                    $('#property-insurance-document-wrapper').fadeIn();
                } else {
                    $('#property-insurance-document-wrapper').fadeOut();
                }
            });
        },

        savePropertyStatus: function () {
            $.ajax({
                url: '/create-property/save-property-status',
                type: 'POST',
                data: {
                    id : $('#property-id').val(),
                    step : $('#step').val(),
                    belong_to : $('#your-status').val(),
                    ownership_status : $('#ownership-status').val(),
                    insurance_status : $('#property-insured-switch').is(':checked') ? 1 : 0 ,
                },
                success: function (response) {
                    console.log(response);
                }
            });
        },

        listPropertyEntire: function() {
            var update = $('input[name=update]');
            var isUpdate = update ? true : false;
            initLengthStay(true);
            initLengthStay(false);
            if(!isUpdate){
                add_length_stay();
            }
            $('#add-more-length').on('click', function(e){
                e.preventDefault();
                add_length_stay();
            });
            function add_length_stay() {
                var lengthStayRowClone = $('#length-stay-row-clone').clone();
                lengthStayRowClone.removeAttr('id');
                $('#length-of-stay-container').append(lengthStayRowClone.show());
                initLengthStay(false);
            }
            function initLengthStay(init){
                var locale = $('#add-property-locale').val();
                $('#length-of-stay-container').find('.length-stay').select2({
                    placeholder: locale=='id' ? 'Pilih lama tinggal' : 'Select the length of stay',
                    width: '100%',
                    containerCssClass: "select2-list-property",
                    dropdownCssClass: "select2-list-property-dropdown",
                    minimumResultsForSearch: Infinity
                });
                $('#length-of-stay-container').find('.length-stay-row').each(function(key, value) {
                    listPropertyInit.toggleLengthStay(init, $(this), key, true);
                    listPropertyInit.toggleButtonSaveLengthStay(init, $(this), key, true);
                });
                listPropertyInit.togglePaymentTerms(init);
            }
        },

        listPropertyCoLiving: function(){
            var update = $('input[name=update]');
            var isUpdate = update ? true : false;
            initLengthStay(true);
            initLengthStay(false);
            if(!isUpdate){
                add_length_stay();
            }
            $('#add-more-length-co-living').on('click', function(e){
                e.preventDefault();
                add_length_stay();
            });
            function add_length_stay() {
                var lengthStayRowClone = $('#length-stay-row-clone-co-living').clone();
                lengthStayRowClone.removeAttr('id');
                $('#length-of-stay-container-co-living').append(lengthStayRowClone.show());
                initLengthStay(false);
            }
            function initLengthStay(init){
                var locale = $('#add-property-locale').val();
                $('#length-of-stay-container-co-living').find('.length-stay').select2({
                    placeholder: locale=='id' ? 'Pilih lama tinggal' : 'Select the length of stay',
                    width: '100%',
                    containerCssClass: "select2-list-property",
                    dropdownCssClass: "select2-list-property-dropdown",
                    minimumResultsForSearch: Infinity
                });
                $('#length-of-stay-container-co-living').find('.length-stay-row-co-living').each(function(key, value) {
                    listPropertyInit.toggleLengthStay(init, $(this), key, false);
                    listPropertyInit.toggleButtonSaveLengthStay(init, $(this), key, false);
                });
                listPropertyInit.togglePaymentTerms(init);
            }
        },

        dateTimePicker: function() {
            // date picker
            $('#date-picker').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('.date-time-picker').datetimepicker({
                format: 'MMMM D, YYYY h:mm A',
                icons: {
                    time: 'far fa-clock',
                }
             });
        },

        countDown: function() {

            var timerID;
            var line = 0;
            var workTime = 300; //5 minutes
            var running = false;
            var startTime;
            var minutes = workTime / 60;
            var seconds = 0;
            var tickCheck;

            //empty the timer circle on load
            if ($("#circle-fill").length) {
                document.getElementById('circle-fill').setAttributeNS(null, 'stroke-dasharray', "0 100");
            }

            //set the default times display in minutes
            $('#work-box').text("Work: " + (workTime / 60) + " min");
            $('#countdown').text(workTime / 60 + ":00");

            //This function controls the clock display and ticking
            function countDown(num) {
                seconds -= num;
                //roll over to the next minute
                if (seconds <= 0) {
                    seconds = 59.9;
                    minutes -= 1;
                }
                //prevent minutes from displaying -1
                if (minutes < 0) {
                    minutes = 0;
                }
                //change the countdown text
                $('#countdown').text(minutes + ":" + ("0" + Math.floor(seconds)).slice(-2));
            }

            //This is the primary timing function that is called in setInterval()
            function timer() {
                var currentTime = new Date().getTime();
                //Time to work. Fill the circle.
                if (line < 100) {
                    line += (((currentTime - startTime) / 1000) / workTime) * 100;
                    countDown((currentTime - startTime) / 1000);
                    startTime = currentTime;
                    document.getElementById('circle-fill').setAttributeNS(null, 'stroke-dasharray', line + " 100");
                    //When break is done, start work again
                }
            }

            //functions for the start
            if (!running) {
                $('#circle-fill').css('transition', 'stroke-dasharray 0.1s');
                startTime = new Date().getTime();
                timerID = setInterval(timer, 50);
                running = true;
            }
        },

        formPassword: function() {
            $('.form-password + .input-group-append .btn-show-pass').on('click', function() {
                $(this).find('i').toggleClass('far fa-eye-slash').toggleClass('far fa-eye'); // toggle our classes for the eye icon
                if('password' == $(`.form-password[name="${$(this).attr('for')}"]`).attr('type')){
                     $(`.form-password[name="${$(this).attr('for')}"]`).attr('type', 'text');
                }else{
                    $(`.form-password[name="${$(this).attr('for')}"]`).attr('type', 'password');
                }
            });
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

        popover: function(){
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        },

        toggleLengthStay: function(init, el, index, isEntire){
            var lengthStayRow = null;
            if(isEntire){
                lengthStayRow = $('.length-stay-row');
            } else{
                lengthStayRow = $('.length-stay-row-co-living');
            }
            if(init){
                lengthStayRow.eq(index).find('.list-group-item').show();
                if(el.find('.length-stay').val() == '3 months'){
                    lengthStayRow.eq(index).find('.paid-twice').hide();
                    lengthStayRow.eq(index).find('.paid-quarterly').hide();
                }
                else if(el.find('.length-stay').val() == '6 months'){
                    lengthStayRow.eq(index).find('.paid-quarterly').hide();
                }
                else if(el.find('.length-stay').val() == '9 months'){
                    lengthStayRow.eq(index).find('.paid-twice').hide();
                }
            } else {
                el.find('.length-stay').on('change', function(){
                    lengthStayRow.eq(index).find('.payment-terms').val('');
                    lengthStayRow.eq(index).find('.list-group-item').show();
                    if(el.find('.length-stay').val() == '3 months'){
                        lengthStayRow.eq(index).find('.paid-twice').hide();
                        lengthStayRow.eq(index).find('.paid-quarterly').hide();
                    }
                    else if(el.find('.length-stay').val() == '6 months'){
                        lengthStayRow.eq(index).find('.paid-quarterly').hide();
                    }
                    else if(el.find('.length-stay').val() == '9 months'){
                        lengthStayRow.eq(index).find('.paid-twice').hide();
                    }
                });
            }
        },

        toggleButtonSaveLengthStay: function(init, el, index, isEntire){
            var lengthStayRow = null;
            if(isEntire){
                lengthStayRow = $('.length-stay-row');
            } else{
                lengthStayRow = $('.length-stay-row-co-living');
            }
            if(init){
                var temp = false;
                lengthStayRow.eq(index).find('.payment-terms').each(function(key, value) {
                    if ($(this).val() != ''){
                        temp = true;
                    }
                });
                if (temp){
                    lengthStayRow.eq(index).find('.btn-save-length-stay').show();
                }
                else{
                    lengthStayRow.eq(index).find('.btn-save-length-stay').hide();
                }
            } else {
                el.find('.payment-terms').on('change', function(){
                    var temp = false;
                    lengthStayRow.eq(index).find('.payment-terms').each(function(key, value) {
                        if ($(this).val() != ''){
                            temp = true;
                        }
                    });
                    if (temp){
                        lengthStayRow.eq(index).find('.btn-save-length-stay').show();
                    }
                    else{
                        lengthStayRow.eq(index).find('.btn-save-length-stay').hide();
                    }
                });
            }
            lengthStayRow.eq(index).find('.btn-save-length-stay').on('click', function(e){
                e.preventDefault();
                $(this).fadeOut();
                lengthStayRow.eq(index).find('.payment-terms').fadeOut();
                lengthStayRow.eq(index).find('.btn-edit-container').fadeIn();
            });
            lengthStayRow.eq(index).find('.btn-edit-length-stay').on('click', function(e){
                e.preventDefault();
                lengthStayRow.eq(index).find('.payment-terms').fadeIn();
                lengthStayRow.eq(index).find('.btn-save-length-stay').fadeIn();
                lengthStayRow.eq(index).find('.btn-edit-container').fadeOut();
            });
            lengthStayRow.eq(index).find('.btn-delete-length-stay').on('click', function(e){
                e.preventDefault();
                lengthStayRow.eq(index).remove();
            });
            lengthStayRow.eq(index).find('.btn-select-all').on('click', function(e){
                e.preventDefault();
                lengthStayRow.eq(index).find('.btn-paid-checkbox').addClass('active');
                lengthStayRow.eq(index).find('.input-rate-wrapper').fadeIn();
            });
        },

        togglePaymentTerms: function(init){
            if(init){
                $('.btn-paid-checkbox input').each(function(key, value){
                    if ($(value).is(':checked')) {
                        $(value).parent().parent().parent().find('.input-rate-wrapper').fadeIn();
                    } else {
                        $(value).parent().parent().parent().find('.input-rate-wrapper').fadeOut();
                    }
                });
            } else {
                $('.btn-paid-checkbox input').on('change', function(){
                    if ($(this).is(':checked')) {
                        $(this).parent().parent().parent().find('.input-rate-wrapper').fadeIn();
                    } else {
                        $(this).parent().parent().parent().find('.input-rate-wrapper').fadeOut();
                    }
                });
            }
        },

        select2General: function() {
            $(".js-select2").each(function() {
                $(this).select2({
                    placeholder: $(this).attr('placeholder'),
                    width: '100%',
                    dropdownAutoWidth: true,
                    containerCssClass: "select2-list-property",
                    dropdownCssClass: "select2-list-property-dropdown",
                    minimumResultsForSearch: Infinity
                });
            });
        },

        checkboxRadio: function() {
            $('.checkbox-radio').change(function () {
                var x = $(this).attr('name');
                $('.checkbox-radio[name="'+ x +'"]').not(this).prop('checked', false);
            });
        },

        deleteNewCategory: function () {
            $('.delete-category-step-6').each(function(index, el) {
                $(this).on('click', function(event) {
                    var id = $(this).attr('data-id');
                    var main_body = $(this).closest('.card-body');
                    $('#modalConfirmationCategory').find('#category-id').val(id);
                    var button_yes = $('#modalConfirmationCategory').find('.btn-delete-category-step6-yes');
                    button_yes.on('click', function(event) {
                        event.preventDefault();
                        var checkbox_main_image = main_body.find('input.custom-control-input');
                        $.ajax({
                            url: '/create-property/delete-category',
                            type: 'DELETE',
                            data: {id : id},
                            success: function (response) {
                                if (response=='1') {
                                    if (checkbox_main_image.is(':checked')) {
                                        $('input.custom-control-input:first').trigger('click');
                                    }
                                    main_body.fadeOut('slow', function() {
                                        $(this).remove();
                                    });
                                }
                            }
                        });
                    });
                });
            });
        },

        checkImageCompleteness: function () {
            if ($('#step').val()=='6') {
                $(document).ready(function() {
                    var container = $('.form-dz > div.collapse > form > .input-dz');
                    setTimeout(function () {
                        $('.form-dz').each(function(index, el) {
                            var form = $(this).find('div.collapse').find('form > .input-dz');
                            var preview_images = form.find('.preview-images');
                            var existing_image = preview_images.find('.dz-image-preview');
                            if (existing_image.length==0) {
                                $('.btn-next-list-property').click(false);
                                $('.btn-next-list-property').attr('disabled', true);
                            }
                        });
                    }, 1);
                });
            }
        },

        popoverCustom: function(){
            // $('[data-toggle="popover"]').popover();
            // $('[data-toggle="tooltip"]').tooltip();

            // $.fn.popover.Constructor.Default.whiteList.table = [];
            // $.fn.popover.Constructor.Default.whiteList.tr = [];
            // $.fn.popover.Constructor.Default.whiteList.td = [];
            // $.fn.popover.Constructor.Default.whiteList.th = [];
            // $.fn.popover.Constructor.Default.whiteList.div = [];
            // $.fn.popover.Constructor.Default.whiteList.button = [];
            // $.fn.popover.Constructor.Default.whiteList.tbody = [];
            // $.fn.popover.Constructor.Default.whiteList.thead = [];
            // $("[data-toggle=popover]").each(function(i, obj) {
            //     $(this).popover({
            //         html: true,
            //         content: function() {
            //             var id = $(this).attr("id");
            //             return $("#popover-content-" + id).html();
            //         }
            //     });
            // });
            // $(document).on('click','.close-popover',function(){
            //     $('.popover').popover('hide');
            // });
        }
    }
    if ($parent.length) {
        listPropertyInit.init();
    }
});
