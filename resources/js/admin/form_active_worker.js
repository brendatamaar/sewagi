$(document).ready(function(){
    $parent = $('#activeWorkerForm');
    let activeWorkerForm = {
        init: function () {
            this.autoCompleteLocation();
            this.validateForm();
            this.autoCloseAlert();
        },
        autoCompleteLocation: function() {
            $('#placeName').autoComplete({
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
                    $('#placeName').val(item.data('place'));
                    $.ajax({
                        type: 'get',
                        url: '/place-details',
                        data: {
                            'place_id': item.data('place_id')
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response) {
                                response.result.address_components.forEach(q => {
                                    if (q.types[0] === 'administrative_area_level_1') {
                                        $('#province').val(q.long_name);
                                    }
                                    if (q.types[0] === 'administrative_area_level_2') {
                                        $('#city').val(q.long_name);
                                    }
                                    if (q.types[0] === 'administrative_area_level_3') {
                                        $('#district').val(q.long_name);
                                    }
                                    if (q.types[0] === 'postal_code') {
                                        $('#postcode').val(q.long_name);
                                    }
                                });

                                $('#placeId').val(response.result.place_id);
                                $('#latitude').val(response.result.geometry.location.lat);
                                $('#longitude').val(response.result.geometry.location.lng);

                                let ids = ['placeId', 'latitude', 'longitude'];
                                ids.forEach(q => {
                                    $(`#${q}`).parents(".form-group").addClass("has-success").removeClass("has-error");
                                    $(`#${q}-error`).css('display', 'none');
                                });
                            }
                        }
                    });
                }
            });
        },
        validateForm: function() {
            $("#activeWorkerData").validate({
                rules: {
                    place_name: {
                        required: true,
                        minlength: 3
                    },
                    place_id: 'required',
                    latitude: 'required',
                    longitude: 'required'
                },
                errorElement: 'em',
                errorPlacement: function(error, element) {
                    error.addClass("help-block");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
                }
            });
        },
        autoCloseAlert: function() {
            setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3000);
        },
    }
    if ($parent.length) {
        activeWorkerForm.init();
    }
});
