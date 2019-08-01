$(document).ready(function () {
    var id = "";
    var listProperty = {
        init: function () {
            this.toggleUnitSize();
            this.togglePetFriendly();
            this.toggleInsurance();
            this.formSubmit();
            this.formSaveDraft();
            this.initDropZone();
            this.submitReview();
            /*Step 5*/
            this.toggleAmenitiesBox();
            this.toggleFacilitiesBox();
            this.checkValidateStep5();
            this.changeFurnitureSelect();
            /*Step 7*/
            this.checkForm7Completeness();
            /*Step 8*/
            this.defaultDurationForm8();
            /*Step 9*/
            this.defaultDurationForm9();
        },
        toggleUnitSize: function(){
            var newLabel = '';
            var locale = $('#add-property-locale').val();
            $('#estate-type').on('change', function(){
                if ((this.value) == 'apartment') {
                    $('#size-input').show();
                    newLabel = locale=='id' ? 'UKURAN UNIT' : 'UNIT SIZE';
                    $('.estate-size').show();
                } else if ((this.value) == 'house') {
                    $('#size-input').show();
                    newLabel = locale=='id' ? 'UKURAN GEDUNG' : 'BUILDING SIZE';
                    $('.estate-size').show();
                }
                $('#estate-label').text(newLabel);
            });
        },
        togglePetFriendly:function(){
            $('#pet-switch').click(function (e) {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
        },
        toggleInsurance:function(){
            $('#property-insured-switch').click(function(e){
                if($(this).is(':checked')){
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }
            });
        },
        formSubmit: function(){
            var step = $('#step').val();
            $("#submit-list-property").on('click', function () {
                var formData = $('.form-list-property');

                if(step == 7){
                    var insurance_status = $('#property-insured-switch').val();
                    var insurace = $("<input>").attr("type", "hidden").attr("name", "insurance_status").val(insurance_status);
                    formData.append(insurace);
                }
                if(step == 8){
                    var arr=[];
                    var lengthStay = $('#length-of-stay-container').find('.length-stay-row');
                    lengthStay.each(function(i, obj){
                        arr[i] = {
                            'length' : $(obj).find('select[name=length]').val(),
                            'paid_method' : ''
                        };
                        var paid_method = {
                            'paid_once' : $(obj).find('input[name=paid_once]').val(),
                            'paid_twice' : $(obj).find('input[name=paid_twice]').val(),
                            'paid_quarterly' : $(obj).find('input[name=paid_quarterly]').val(),
                            'paid_monthly' : $(obj).find('input[name=paid_monthly]').val(),
                        };
                        arr[i]['paid_method'] = paid_method;
                    });
                    var arr = JSON.stringify(arr);
                    var detailRent = $ ("<input>").attr("type", "hidden").attr("name", "detail_rent").val(arr);
                    var livingCondition = $ ("<input>").attr("type", "hidden").attr("name", "living_condition").val('entire-space');
                    formData.append(detailRent);
                    formData.append(livingCondition);
                }
                if(step == 9){
                    var arr=[];
                    var lengthStay = $('#length-of-stay-container-co-living').find('.length-stay-row-co-living');
                    lengthStay.each(function(idx, obj){
                        arr[idx] = {
                            'length' : $(obj).find('select[name=length]').val(),
                            'paid_method' : ''
                        };

                        var temp = [];
                        $(obj).find('input[name=paid_once]').each(function(key, el){
                            var newData = true;
                            roomPrice = {
                                'bedroom_id'    : '',
                                'paid_once'     : 0,
                                'paid_twice'    : 0,
                                'paid_quarterly': 0,
                                'paid_monthly'  : 0,
                            }
                            if(temp.length > 0){
                                for(i = 0; i < temp.length; i++){
                                    if(temp[i].bedroom_id == $(this).prev().val()){
                                        temp[i].paid_once = $(this).val();
                                        newData = false;
                                    }
                                }
                                if(newData){
                                    roomPrice.bedroom_id = $(this).prev().val();
                                    roomPrice.paid_once = $(this).val();
                                    temp.push(roomPrice);
                                }
                            }
                            else {
                                roomPrice.bedroom_id = $(this).prev().val();
                                roomPrice.paid_once = $(this).val();
                                temp.push(roomPrice);
                            }
                        });
                        $(obj).find('input[name=paid_twice]').each(function(key, el){
                            var newData = true;
                            roomPrice = {
                                'bedroom_id' : '',
                                'paid_once': 0,
                                'paid_twice': 0,
                                'paid_quarterly': 0,
                                'paid_monthly': 0,
                            }
                            if(temp.length > 0){
                                for(i = 0; i < temp.length; i++){
                                    if(temp[i].bedroom_id == $(this).prev().val()){
                                        temp[i].paid_twice = $(this).val();
                                        newData = false;
                                    }
                                }
                                if(newData){
                                    roomPrice.bedroom_id = $(this).prev().val();
                                    roomPrice.paid_twice = $(this).val();
                                    temp.push(roomPrice);
                                }
                            }
                            else {
                                roomPrice.bedroom_id = $(this).prev().val();
                                roomPrice.paid_twice = $(this).val();
                                temp.push(roomPrice);
                            }
                        });
                        $(obj).find('input[name=paid_quarterly]').each(function(key, el){
                            var newData = true;
                            roomPrice = {
                                'bedroom_id' : '',
                                'paid_once': 0,
                                'paid_twice': 0,
                                'paid_quarterly': 0,
                                'paid_monthly': 0,
                            }
                            if(temp.length > 0){
                                for(i = 0; i < temp.length; i++){
                                    if(temp[i].bedroom_id == $(this).prev().val()){
                                        temp[i].paid_quarterly = $(this).val();
                                        newData = false;
                                    }
                                }
                                if(newData){
                                    roomPrice.bedroom_id = $(this).prev().val();
                                    roomPrice.paid_quarterly = $(this).val();
                                    temp.push(roomPrice);
                                }
                            }
                            else {
                                roomPrice.bedroom_id = $(this).prev().val();
                                roomPrice.paid_quarterly = $(this).val();
                                temp.push(roomPrice);
                            }
                        });
                        $(obj).find('input[name=paid_monthly]').each(function(key, el){
                            var newData = true;
                            roomPrice = {
                                'bedroom_id' : '',
                                'paid_once': 0,
                                'paid_twice': 0,
                                'paid_quarterly': 0,
                                'paid_monthly': 0,
                            }
                            if(temp.length > 0){
                                for(i = 0; i < temp.length; i++){
                                    if(temp[i].bedroom_id == $(this).prev().val()){
                                        temp[i].paid_monthly = $(this).val();
                                        newData = false;
                                    }
                                }
                                if(newData){
                                    roomPrice.bedroom_id = $(this).prev().val();
                                    roomPrice.paid_monthly = $(this).val();
                                    temp.push(roomPrice);
                                }
                            }
                            else {
                                roomPrice.bedroom_id = $(this).prev().val();
                                roomPrice.paid_monthly = $(this).val();
                                temp.push(roomPrice);
                            }
                        });
                        arr[idx]['paid_method'] = temp;
                    });
                    var arr = JSON.stringify(arr);
                    var detailRent = $ ("<input>").attr("type", "hidden").attr("name", "detail_rent").val(arr);
                    var livingCondition = $ ("<input>").attr("type", "hidden").attr("name", "living_condition").val('co-living');
                    formData.append(detailRent);
                    formData.append(livingCondition);
                }
                formData.submit();
            });
        },
        formSaveDraft:function(){
          $('.saveDraft').click(function(e){
            e.preventDefault();
            var step = $('#step').val();
            var formData = $('#newPropertyData' + step).serializeArray();
            formData.push({name: 'is_draft', value: 1}, {name: 'step', value: step});
            var returnToHome = false;
            if($(this).hasClass('backHome')){
                returnToHome = true;
            }
            $.post("/property/list-property/create", formData)
            .done(function (data) {
                if(returnToHome){
                    return location.replace('/');
                }
            }).fail(function (data) {
                var result = data.responseJSON;
            });
          });
        },
        buildingExteriorDropzone: function(){
            // $("#building-exterior").dropzone({
            //     uploadMultiple: true,
            //     maxFilesize: 12,
            //     renameFile: function(file) {
            //         var dt = new Date();
            //         var time = dt.getTime();
            //        return time+file.name;
            //     },
            //     acceptedFiles: ".jpeg,.jpg,.png,.gif",
            //     timeout: 10000,
            //     success: function(file, response) {
            //         console.log(file);
            //         console.log(response);
            //     },
            //     error: function(file, response){
            //        return false;
            //     }
            // });
        },
        initDropZone: function () {
            if ($(".form-dz").length) {
                var myTemplate = $("#mydz-template").html();
                var imageDropzone = [];
                $(".input-dz").each(function (index) {
                    var t = $(this);
                    photoId = $(this).data('id');
                    dzId    = $(this).attr('id');
                    var form = t.closest('form');
                    var photoIndicator = form.find('.photo-indicator').find('.list-inline').find('.list-inline-item');
                    var previewImages = form.find('.preview-images').find('.dz-complete');

                    imageDropzone[photoId] = new Dropzone("#"+dzId, {
                        previewTemplate: myTemplate,
                        paramName: "file",
                        url: '/create-property/upload-image',
                        headers: {
                            'x-csrf-token': token.content
                        },
                        parallelUploads: 3,
                        autoQueue: true,
                        addRemoveLinks: true,
                        previewsContainer: "#preview-image-"+photoId,
                        clickable: "#dropzone-button-"+photoId,
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
                            listProperty.checkImageCompleteness();
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
                                    console.log(response);
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
                    imageDropzone[photoId].photoId = photoId;
                });

                propertyId = $("#property-id").val();
                var myPdfTemplate = $("#mydz-pdf-template").html();
                var pdfDropzone = [];
                if ($(".input-pdf-dz").length) {
                    $(".input-pdf-dz").each(function (index) {
                        documentId = $(this).data('id');
                        dzId = $(this).attr('id');
                        pdfDropzone[documentId] = new Dropzone("#" + dzId, {
                            previewTemplate: myPdfTemplate,
                            paramName: "file",
                            url: '/create-property/upload-file',
                            headers: {
                                'x-csrf-token': token.content
                            },
                            parallelUploads: 3,
                            autoQueue: true,
                            addRemoveLinks: true,
                            previewsContainer: "#preview-image-" + documentId,
                            clickable: "#dropzone-button-" + documentId,
                            dictRemoveFile: '<i class="fa fa-times-circle"></i>',
                            dictCancelUpload: '',
                            success: function (file, response) {
                                file.id = response.id;
                                listProperty.checkImageCompleteness();
                            },
                            init: function () {
                                var dropzone = this;
                                $.ajax({
                                    url: '/property/files',
                                    type: 'POST',
                                    data: {id: propertyId},
                                    dataType: 'json',
                                    success: function (data) {
                                        $.each(data, function (key, row) {
                                            var media = row;
                                            if (media.type == dropzone.documentId){
                                                var mockFile = {
                                                    name: media.file_name,
                                                    size: media.size,
                                                    id: row.id
                                                };
                                                dropzone.emit("addedfile", mockFile);
                                                dropzone.emit("thumbnail", mockFile, media.url);
                                                dropzone.emit("complete", mockFile);
                                            }
                                        });
                                    },
                                    error: function (response) {
                                        console.log(response);
                                    }
                                });
                            },
                            removedfile: function (file) {
                                $.ajax({
                                    url: '/property/files/' + file.id,
                                    type: 'DELETE',
                                    dataType: 'json',
                                    success: function (response) {
                                        file.previewElement.remove();
                                    },
                                    error: function (response) {
                                        console.log(response);
                                    }
                                });
                            },
                        }).on("sending", function (file, xhr, formData) {
                            var dropzone = this;
                            formData.append("id", propertyId);
                            formData.append("documentId", dropzone.documentId);
                        });
                        pdfDropzone[documentId].documentId = documentId;
                    });
                }
            }
        },
        submitReview: function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#btnAgree").on('click', function () {
                $.ajax({
                    type: "POST",
                    url: '/create-property/10',
                    data: 'step=' + $('#step').val() +
                        '&id=' + $('input[name=id]').val(),
                    success: function() {
                        console.log("sucess")
                    }
                })
            });
        },
        toggleAmenitiesBox: function () {
            var locale = $('#add-property-locale').val();
            $('#btn-add-amenities').on('click',  function(event) {
                var t = $(this);
                var originalCaption = t.data('original_caption');
                var amenitiesProvide = $('#amenities-provide');
                if (amenitiesProvide.length) {
                    if (amenitiesProvide.hasClass('show')) {
                        /*Initial condition : div is opened*/
                        $(this).html(originalCaption);
                        $.ajax({
                            url: '/create-property/save-amenities',
                            type: 'POST',
                            data: $('#newPropertyData5').serialize(),
                            success: function (response) {
                                var x = $("#newPropertyData5").serializeArray();
                                $.each(x, function(i, field) {
                                    if (field.name=='amenity_id[]') {
                                        t.html(locale=='id' ? 'Sunting' : 'Edit');
                                        listProperty.checkValidateStep5();
                                    }
                                });
                            }
                        });
                    } else {
                        /*Initial condition : div is closed*/
                        t.html(locale=='id' ? 'Simpan' : 'Save');
                    }
                }
            });
        },
        toggleFacilitiesBox: function () {
            var locale = $('#add-property-locale').val();
            $('#btn-add-facilities').on('click',  function(event) {
                var t = $(this);
                var originalCaption = t.data('original_caption');
                var availableFacilities = $('#available-facilities');
                if (availableFacilities.length) {
                    if (availableFacilities.hasClass('show')) {
                        /*Initial condition : div is opened*/
                        $(this).html(originalCaption);
                        $.ajax({
                            url: '/create-property/save-facilities',
                            type: 'POST',
                            data: $('#newPropertyData5').serialize(),
                            success: function (response) {
                                var x = $("#newPropertyData5").serializeArray();
                                $.each(x, function(i, field) {
                                    if (field.name=='facility_id[]') {
                                        t.html(locale=='id' ? 'Sunting' : 'Edit');
                                        listProperty.checkValidateStep5();
                                    }
                                });
                            }
                        });
                    } else {
                        /*Initial condition : div is closed*/
                        t.html(locale=='id' ? 'Simpan' : 'Save');
                    }
                }
            });
        },
        checkValidateStep5: function () {
            var facility_id = 0;
            var amenity_id = 0;
            var furniture = 0;
            if ($("#newPropertyData5").length) {
                var x = $("#newPropertyData5").serializeArray();
                $.each(x, function(i, field) {
                    if (field.name=='facility_id[]') {
                        facility_id++;
                    }
                    if (field.name=='amenity_id[]') {
                        amenity_id++;
                    }
                    if (field.name=='furniture' && field.value!='') {
                        furniture++;
                    }
                });
                if (facility_id>0 && amenity_id>0 && furniture>0) {
                    $('#submit-list-property').attr('disabled', false);
                } else {
                    $('#submit-list-property').attr('disabled', true);
                }
            }
        },
        changeFurnitureSelect: function () {
            $('.select2-list-property').on('change', function(event) {
                listProperty.checkValidateStep5();
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
        checkForm7Completeness: function () {
            var $form7 = $('#newPropertyData7');
            if ($form7.length) {
                function checkCompleteness() {
                    var status = $('#your-status').val()!='' ? true : false ;
                    var ownershipStatus = $('#ownership-status').val()!='' ? true : false ;
                    var imageComplete = true;
                    setInterval(function () {
                        $('.property-right-wrapper').each(function(index, el) {
                            if ($(this).is(':visible')) {
                                var form = $(this).find('div > div.collapse').find('.input-pdf-dz');
                                if (form.length) {
                                    var preview_images = form.find('.preview-images');
                                    if (preview_images.length) {
                                        var existing_image = preview_images.find('.dz-image-preview');
                                        if (existing_image.length) {
                                            if (existing_image.length==0) {
                                                imageComplete = false;
                                            }
                                        } else {
                                            imageComplete = false;
                                        }
                                    }
                                }
                            }
                        });
                        if (status && ownershipStatus && imageComplete) {
                            $('#submit-list-property-step-7').on('click', function(event) {
                                event.preventDefault();
                                event.stopImmediatePropagation();
                                $('#newPropertyData7').trigger('submit');
                            });
                        } else {
                            console.log('YYY');
                            $('#submit-list-property-step-7').on('click', function(event) {
                                event.preventDefault();
                                event.stopImmediatePropagation();
                                $('#modalStep7Incomplete').modal('show');
                                $('#modalStep7Incomplete').on('click', '.btn-delete-category-step7-yes', function(event) {
                                    console.log('XXX');
                                    $('#newPropertyData7').trigger('submit');
                                });
                            });
                        }
                    }, 600);
                }
                checkCompleteness();
                $form7.on('change', 'input, select', function(event) {
                    /* Act on the event */
                    console.log('Change ' + $(this).attr('id'));
                    checkCompleteness();
                });
            }
        },
        defaultDurationForm8: function () {
            var form8 = $('#newPropertyData8');
            if (form8.length) {
                console.log('Form 8');
                $lengthStay = form8.find('#length-of-stay-container > div.length-stay-row');
                if (!$lengthStay.length) {
                    $('#add-more-length').trigger('click')
                }
                setInterval(function () {
                    var hasLengthStay = false;
                    $lengthStay = form8.find('#length-of-stay-container > div.length-stay-row');
                    if ($lengthStay.length) {
                        hasLengthStay = true;
                    }

                    var anotherPayment = false;
                    // if (!form8.find('#internet-switch').is(':checked') && !form8.find('#parking-switch').is(':checked') && !form8.find('#tv-switch').is(':checked') && !form8.find('#cleaning-switch').is(':checked')) {
                    if (form8.find('input[name="service_fee"]').val()=='') {
                        anotherPayment = false;
                    } else {
                        anotherPayment = true;
                    }

                    if (!hasLengthStay || !anotherPayment) {
                        $('#submit-list-property').prop('disabled', true);
                    } else {
                        $('#submit-list-property').prop('disabled', false);
                    }
                }, 400);
            }
        },
        defaultDurationForm9: function () {
            var form9 = $('#newPropertyData9');
            if (form9.length) {
                console.log('Form 9');
                $lengthStay = form9.find('#length-of-stay-container-co-living > div.length-stay-row-co-living');
                if (!$lengthStay.length) {
                    $('#add-more-length-co-living').trigger('click')
                }
                setInterval(function () {
                    var hasLengthStay = false;
                    $lengthStay = form9.find('#length-of-stay-container-co-living > div.length-stay-row-co-living');
                    if ($lengthStay.length) {
                        hasLengthStay = true;
                    }
                    console.log('hasLengthStay ' + hasLengthStay);

                    var anotherPayment = false;
                    // if (!form8.find('#internet-switch').is(':checked') && !form8.find('#parking-switch').is(':checked') && !form8.find('#tv-switch').is(':checked') && !form8.find('#cleaning-switch').is(':checked')) {
                    if (form9.find('input[name="service_fee"]').val()=='') {
                        anotherPayment = false;
                    } else {
                        anotherPayment = true;
                    }

                    if (!hasLengthStay || !anotherPayment) {
                        $('#submit-list-property').prop('disabled', true);
                    } else {
                        $('#submit-list-property').prop('disabled', false);
                    }
                }, 400);
            }
        },
    };
    listProperty.init();
});
