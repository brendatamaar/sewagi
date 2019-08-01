
function initDetailMap(data) {
    // var detailMap = initGMap({lat: -34.397, lng: 150.644}, document.getElementById('neighborhood-map'));
    // detailMap.init();
    // detailMap.addCircle(detailMap.center, 100000);

    var markerTemplate = $('.marker-template');
    var markerListTemplate = $('.marker-list-template');
    var markerTabTemplate = $('.marker-tab-template');
    var tabContent = $('#map-list .tab-content');
    var tabPanel = $('#neighborhood-tabs ul');
    tabContent.html("");
    tabPanel.html("");
    // var j = 1;
    // for(var i=0;i < data.length; i++) {
    //     generateTab(data[i], i);
    //     generateList(data[i], i, j);
    //     j+=data[i].markers.length;
    // }
    $('.btn-submit-offering').click(function(){
        $('#negotiate-modal').modal('hide');
        $('#negotiate-message-modal').modal('show');
    });

    var propertyid = $('#property-id').val();
    var type = $('input:radio[name="living-conditions"]').val();
    var month_first = $('input[name="monthly"]:checked').val();
    var bedroomid = $('#bedroom-type').val();
    var radio_value;
    var radio_value_month;
    var bedroompriseisinit = false;
    var living_type = $('input:radio[name="living-conditions"]').val();
    var getbedroominit = false;
    
    $('#schedule-modal').on('hidden.bs.modal', function (e) {
        $('#schedule-modal input').each(function(){
            $(this).val('');
        });
    });
    $(document).on('change','input[name="living-conditions"]',function(){
        var radliv = document.getElementsByName('living-conditions');

        for (var i = 0; i < radliv.length; i++) {
            if(radliv[i].checked){
                radio_value = radliv[i].value;
            }
        }
        if ($(this).is(':checked') && $(this).val() == 'entire-space') {
            $('.lets-negotiate').show();
            $('#bedroom-type-select').hide();
            $('.btn-select-room-arrangement').hide();
        }else{
            $('.lets-negotiate').hide();
            $('#bedroom-type-select').show();
            $('.btn-select-room-arrangement').show();
        }
        if(radio_value_month == null){
            radio_value_month = month_first;
        }
        bedroompriseisinit = false;       
        getLengthOfStay($(this).val()).then(()=>{});
    });
    $(document).on('change','input[name="monthly"]',function(){
        var radmonth = document.getElementsByName('monthly');
        var $self = $(this); 

        for (var i = 0; i < radmonth.length; i++) {
            if(radmonth[i].checked){
                radio_value_month = radmonth[i].value;
            }
        }

        bedroompriseisinit = false;
        getbedroominit = false;
        
        if($('input[name="living-conditions"]:checked').val() == 'entire-space'){
            check_price_bedroom('entire-space').then(function(){
                $('#lengthofstay .nav-link').removeClass('active');
                $self.closest('.nav-link').addClass('active');
            });
        }else{
            getBedroomType(radio_value,radio_value_month).then(function(){
                $('#lengthofstay .nav-link').removeClass('active');
                $self.closest('.nav-link').addClass('active');
            });        
        }
    });
    $(document).on('change','#bedroom-type',function(){
        var bedroomid = $(this).val();

        if(radio_value_month == null){
            radio_value_month = month_first;
        }
        bedroompriseisinit = false;
        check_price_bedroom();
    });
    $(document).on('change','#pricepaid',function(){
        if(radio_value_month == null){
            radio_value_month = month_first;
        }        
        check_price_bedroom('yes');
    });

    $(document).on('change','.btn-select-room-arrangement input[type="checkbox"]',function(){
        var bedroomid = $(this).val();

        if($(this).is(':checked')){
            $('.btn-select-room-arrangement input[type="checkbox"]').not(this).prop('checked', false).trigger('change');
            // $(this).closest('.btn-select').addClass('active');
            $('#bedroom-type').val(bedroomid).trigger('change');
        } else {
            $(this).closest('.btn-select').removeClass('active')
        }       
    });

    if ($('input[name="living-conditions"][value="co-living"]').length) {
        $('input[name="living-conditions"][value="co-living"]').prop('checked', true).trigger('change');
    } else {
        $('input[name="living-conditions"][value="entire-space"]').prop('checked', true).trigger('change');
    }

    function getLengthOfStay(living_type){
        return $.ajax({
            type:'POST',
            url:'/get-length-of-stay',
            data:{
                property_id : propertyid, 
                living_type : living_type
            },
        }).then(function(response){
            var len = 0;
            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                var option = '';
                for(var i=0; i<len; i++){
                    var length = response['data'][i];
                    
                    option += `<li class='nav-item'>
                                <div class='nav-link btn'>
                                <!--<div class="nav-link btn">-->
                                <input type="radio" name="monthly" value="${length}" checked="">`
                                if(length == 12){
                                    option += '1 Year'
                                }else{
                                    option += length+' Month'+(length > 1 ? 's' : '')
                                }
                    option += `</div>
                                </li>`;
                }
                $('#lengthofstay').html(option);
                $('input[name="monthly"]:last').prop('checked',true).trigger('change');
            }
        }); 
    }
    
    function getBedroomType(){
        var originalValue = $('#bedroom-type').val() || false;       
        var radio_value = $('input[name="living-conditions"]:checked').val();
        var lof = $('input[name="monthly"]:checked').val();
        var p = $.Deferred();

        $("#bedroom-type").empty();
        if(!getbedroominit){
            $.ajax({
                type:'POST',
                url:'/get-bedroom-type',
                data:{
                    property_id : propertyid, 
                    living_type : radio_value,
                    length_stay : lof
                },
                success:function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    
                    if(len > 0){
                        var option = '';
                        for(var i=0; i<len; i++){
                            var name = response['data'][i].name;
                            var id = response['data'][i].id;

                            option += "<option value='" + id+'-'+name +"'>"+name+"</option>";
                        }
                    }else{
                        option += "<option value=''>Bedroom Not Available</option>";
                        originalValue = 'not_available';
                    }
                    $('#bedroom-type').html(option);
                    if (originalValue === 'not_available') {
                        $('#bedroom-type').trigger('change');
                    } else {
                        if (!originalValue || !$('#bedroom-type option[value="'+originalValue+'"]').length) {
                            originalValue = $('#bedroom-type option:first').attr('value');
                        }
                        $('#bedroom-type').val(originalValue).trigger('change');
                    }
                    getbedroominit = true;
                    p.resolve();
                }
            });
        }
        return p; 
    }
    function check_installment(month,price){
        if(month == 6){
            $('.cicil_sewa').hide();
            $('#cicilanbulan').empty();

            var bunga = 8.75 / 100;
            var totalbunga = price * bunga;
            total = parseInt(price)+parseInt(totalbunga);
            cicilans = total / 6;
            cicilannoseparate = Math.round(cicilans / 1000) * 1000;
            cicilan = addCommas(cicilannoseparate);
            totalAll = addCommas(cicilannoseparate * month);
            $('#gradanaTable').empty();

            var $table = $('<table class="table table-bordered" border="1" style="width:100%;">');
            for(i=1;i<=month;i++){
                $table.append('<tr />').children('tr:last')
                .append('<td scope="row">Month ' + i + '</td>')
                .append('<td scope="row">IDR ' + cicilan + '</td>');

                if(i == month){
                    $table.append('<tr />').children('tr:last')
                    .append('<th scope="row">Total</th>')
                    .append('<th scope="row">IDR ' + totalAll + '</th>');
                }
                $table.appendTo('#gradanaTable');
            }
            $('#cicilanbulan').append('IDR '+ cicilan);
        }
        if(month == '12'){
            $('.cicil_sewa').show();
            $('#cicilanbulan').empty();
            $('#cicilanbulansewa').empty();
            var bunga = 17.5 / 100;

            total = price * bunga;
            cicilan = Math.ceil((parseInt(price)+parseInt(total)) / month);
            cicilans = Math.round(cicilan / 1000) * 1000;
            cicilan = addCommas(cicilans);
            totalAll = addCommas(cicilans * month);
            $('#gradanaTable').empty();
            var $table = $('<table class="table table-bordered" border="1" style="width:100%;">');
            for(i=1;i<=month;i++){
                $table.append('<tr />').children('tr:last')
                .append('<td scope="row">Month ' + i + '</td>')
                .append('<td scope="row">IDR ' + cicilan + '</td>');

                if(i == month){
                    $table.append('<tr />').children('tr:last')
                    .append('<th scope="row">Total</th>')
                    .append('<th scope="row">IDR ' + totalAll + '</th>');
                }
                $table.appendTo('#gradanaTable');
            }
            $('#cicilanbulan').append('IDR '+ cicilan);

            dpcicil = price * 30 / 100;
            totalpinjaman = parseInt(price)-parseInt(dpcicil);
            hitungan = totalpinjaman * 0.18;
            cicilanperbulan = (parseInt(totalpinjaman)+parseInt(hitungan)) / 10;
            var totalAllcicil = addCommas(parseInt(dpcicil)+parseInt((cicilanperbulan * 10)));
            $('#cicilsewaTable').empty();
            var $table1 = $('<table class="table table-bordered" border="1" style="width:100%;">');
            for(j=1;j<=11;j++){
                if(j == 1){
                    cicilanperbulan = addCommas(parseInt(dpcicil)+parseInt(cicilanperbulan));
                }else{
                    cicilanperbulan = addCommas((parseInt(totalpinjaman)+parseInt(hitungan)) / 10);
                }
                $table1.append('<tr />').children('tr:last')
                .append('<td scope="row">Month ' + j + '</td>')
                .append('<td scope="row">IDR ' + cicilanperbulan + '</td>');

                if(j == 11){
                    $table1.append('<tr />').children('tr:last')
                    .append('<th scope="row">Total</th>')
                    .append('<th scope="row">IDR ' + totalAllcicil + '</th>');
                }
                $table1.appendTo('#cicilsewaTable');
            }
            $('#cicilanbulansewa').append('IDR '+ cicilanperbulan);
        }
    }
    
    function check_price_bedroom(load_installment = true, type = 'entire-space'){
        var originalValue = $('#pricepaid').val() || false;
        var originalPaymentOption = $('#pricepaid option:selected').data('description');
        var radio_value = $('input[name="living-conditions"]:checked').val();
        var bedroomid = $('#bedroom-type').val();
        var lof = $('input[name="monthly"]:checked').val();

        var p = $.Deferred();
        if(load_installment === 'yes'){
            return p.resolve().then(function(){
                if($("#pricepaid").find(":selected").data("description") == 'PAID ONCE'){
                    var dp = $('#pricepaid').val();
                    if (lof == '6' || lof == '12') {
                        $('.installment_option').show();
                        $('#installment_term').show();

                        check_installment(lof,dp);
                    }else{
                        $('.installment_option').hide();
                        $('#installment_term').hide();
                    }
                }else{
                    $('.installment_option').hide();
                    $('#installment_term').hide();
                }
            })
        }

        if(!bedroompriseisinit){
            if (radio_value == 'entire-space') {
                $('.btn-select-room-arrangement').hide();
            }else{
                $('.btn-select-room-arrangement').show();
            }
            $("#pricepaid").empty();
            
            if(radio_value == 'co-living'){
                $.ajax({
                    type:'POST',
                    url:'/get-bedroom-price',
                    data:{
                        bedroom_id : bedroomid,
                        property_id : propertyid,
                        length : lof,
                    },
                    success:function(response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                            var option = '';
                            for(var i=0; i<len; i++){
                                var length = response['data'][i].length;

                                if(response['data'][i].paid_monthly != ''){
                                    option += "<option value='" + response['data'][i].paid_monthly +"' data-description='PAID MONTHLY'>IDR "+addCommas(response['data'][i].paid_monthly)+"</option>";
                                }
                                if(response['data'][i].paid_quarterly != ''){
                                    option += "<option value='" + response['data'][i].paid_quarterly +"' data-description='PAID QUARTERLY'>IDR "+addCommas(response['data'][i].paid_quarterly)+"</option>";
                                }
                                if(response['data'][i].paid_twice != ''){
                                    option += "<option value='" + response['data'][i].paid_twice +"' data-description='PAID TWICE'>IDR "+addCommas(response['data'][i].paid_twice)+"</option>";
                                }
                                if(response['data'][i].paid_once != ''){
                                    option += "<option value='" + response['data'][i].paid_once +"' data-description='PAID ONCE'>IDR "+addCommas(response['data'][i].paid_once)+"</option>";
                                }
                            }
                        }else{
                            option += "<option value='' data-description='' selected>Price Not Available</option>";
                            originalValue = 'not_available';
                            originalPaymentOption = 'not_available';
                        }
                        $("#pricepaid").html(option);
                        if (originalPaymentOption === 'not_available') {
                            $('#pricepaid').trigger('change');
                        } else {
                            if (!originalPaymentOption) {
                                originalValue = $('#pricepaid option:first').attr('value');
                            } else {
                                originalValue = $('#pricepaid option[data-description="'+originalPaymentOption+'"]').attr('value');
                            }

                            if (!originalValue && originalPaymentOption && !$('#pricepaid option[data-description="'+originalPaymentOption+'"]').length) {
                                originalValue = $('#pricepaid option[data-description="'+originalPaymentOption+'"]').attr('value');

                                if (!originalValue) {
                                    originalValue = $('#pricepaid option:first').attr('value');
                                }
                            }
                            $('#pricepaid').val(originalValue).trigger('change');
                        }
                        bedroompriseisinit = true;
                        p.resolve();
                    }
                });
            }else{
                $.ajax({
                    type:'POST',
                    url:'/get-bedroom-price',
                    data:{
                        property_id : propertyid,
                        length : lof,
                    },
                    success:function(response){
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }

                        if(len > 0){
                            var option = '';
                            for(var i=0; i<len; i++){
                                var length = response['data'][i].length;

                                if(response['data'][i].paid_monthly != ''){
                                    option += "<option value='" + response['data'][i].paid_monthly +"' data-description='PAID MONTHLY'>IDR "+addCommas(response['data'][i].paid_monthly)+"</option>";
                                }
                                if(response['data'][i].paid_quarterly != ''){
                                    option += "<option value='" + response['data'][i].paid_quarterly +"' data-description='PAID QUARTERLY'>IDR "+addCommas(response['data'][i].paid_quarterly)+"</option>";
                                }
                                if(response['data'][i].paid_twice != ''){
                                    option += "<option value='" + response['data'][i].paid_twice +"' data-description='PAID TWICE'>IDR "+addCommas(response['data'][i].paid_twice)+"</option>";
                                }
                                if(response['data'][i].paid_once != ''){
                                    option += "<option value='" + response['data'][i].paid_once +"' data-description='PAID ONCE'>IDR "+addCommas(response['data'][i].paid_once)+"</option>";
                                }
                            }
                        }else{
                            option += "<option value=''>Price Not Available</option>";
                            originalValue = 'not_available';
                            originalPaymentOption = 'not_available';
                        }
                        $("#pricepaid").html(option);
                        if (originalPaymentOption === 'not_available') {
                            $('#pricepaid').trigger('change');
                        } else {
                            if (!originalPaymentOption) {
                                originalValue = $('#pricepaid option[data-description="PAID MONTHLY"]').attr('value');
                            } else {
                                originalValue = $('#pricepaid option[data-description="'+originalPaymentOption+'"]').attr('value');
                            }

                            if (!originalPaymentOption) {
                                originalValue = $('#pricepaid option:first').attr('value');
                            }

                            if (!originalValue && originalPaymentOption && !$('#pricepaid option[data-description="'+originalPaymentOption+'"]').length) {
                                originalValue = $('#pricepaid option[data-description="'+originalPaymentOption+'"]').attr('value');

                                if (!originalValue) {
                                    originalValue = $('#pricepaid option:first').attr('value');
                                }
                            }

                            $('#pricepaid').val(originalValue).trigger('change');
                        }
                        bedroompriseisinit = true;
                        p.resolve();
                    }
                });
            }           
        }else{
            p.resolve();
        }
        return p.then(function(){
            if($("#pricepaid").find(":selected").data("description") == 'PAID ONCE'){
                var dp = $('#pricepaid').val();
                if (lof == '6' || lof == '12') {
                    $('.installment_option').show();
                    $('#installment_term').show();

                    check_installment(lof,dp);
                }else{
                    $('.installment_option').hide();
                    $('#installment_term').hide();
                }
            }else{
                $('.installment_option').hide();
                $('#installment_term').hide();
            }
        });
    }
    function separatorprice(price){
        return accounting.formatMoney(price, 'IDR ', 0, '.');
    }
    
    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
    $.extend($.fn.datetimepicker.Constructor.Default, {
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'far fa-calendar-check-o',
            clear: 'far fa-trash',
            close: 'far fa-times'
        } 
    });
    $('.datetimepicker').each(function () {
        $(this).datetimepicker({
            format: "MMMM DD, YYYY  LT",
            stepping: 15,
            daysOfWeekDisabled: [0],
            minDate: moment().add(2,'days'),
            //useCurrent: false,
            enabledHours: [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
        });
    });
    $('.schedule-btn').click(function(){
        $('#typeTourTitle').empty();
        $('#modalVisitThisProperty').modal('hide');

        if(radio_value == null){
            radio_value = type;
        }
        if(radio_value_month == null){
            radio_value_month = month_first;
        }
        var living_condition = radio_value;
        var monthly = radio_value_month;
        var bedrooms = $('#bedroom-type').val();
        splitBedrooms = bedrooms.split("-");
        bedroom = splitBedrooms[0];
        var price = $('#pricepaid').val();
        var property_id = $('#property-id').val();
        var tour_type = $(this).attr('data-value');
        if(tour_type == 'onsite'){
            var $word = $('<h5>Schedule onsite tour<h5>');
            $word.appendTo('#typeTourTitle');
        }
        if(tour_type == 'virtual'){
            var $word = $('<h5>Schedule live virtual tour<h5>');
            $word.appendTo('#typeTourTitle');
        }
        if(living_condition == 'entire-space'){
            bedroom = '';
        }

        $('input[name="property-id"]').val(property_id);
        $('input[name="price"]').val(price);
        $('input[name="bedroom"]').val(bedroom);
        $('input[name="living-condition"]').val(living_condition);
        $('input[name="month"]').val(monthly);
        $('input[name="tour_type"]').val(tour_type);
        $('#schedule-modal').modal('show')
    }
    );
    $('.booknow-btn').click(function(){
        if(radio_value == null){
            radio_value = type;
        }
        if(radio_value_month == null){
            radio_value_month = month_first;
        }
        var living_condition = radio_value;
        var monthly = radio_value_month;
        var bedrooms = $('#bedroom-type').val();
        splitBedrooms = bedrooms.split("-");
        bedroom = splitBedrooms[0];
        var price = $('#pricepaid').val();
        var property_id = $('#property-id').val();
        var tour_type = $(this).attr('data-value');
        if(tour_type == 'onsite'){
            var $word = $('<h5>Schedule onsite tour<h5>');
            $word.appendTo('#typeTourTitle');
        }
        if(tour_type == 'virtual'){
            var $word = $('<h5>Schedule live virtual tour<h5>');
            $word.appendTo('#typeTourTitle');
        }

        $('input[name="property-id"]').val(property_id);
        $('input[name="price"]').val(price);
        $('input[name="bedroom"]').val(bedroom);
        $('input[name="living-condition"]').val(living_condition);
        $('input[name="month"]').val(monthly);
    }
    );
    $('.btn-submit-schedule').click(function(){
        var dataTime = [];
        var checkDate = [];
        var property = $('#property-id').val();
        var price = $('#price').val();
        var bedroom = $('#bedroom').val();
        var living_condition = $('#living-condition').val();
        var month = $('#month').val();
        var type_tour = $('#tour_type').val();
        var _token= $('#token').val();

        $('#date0, #date1, #date2, #date3,#date4,#date5').each(function() {
            if ($(this).val() != '') {
                var test = new Date($(this).val());
                var dateOnly = test.setHours(0,0,0,0);
                var countDate = countElement(dateOnly,checkDate);

                if(countDate == 2){
                    $('#test-show-modal').modal('show');
                }

                checkDate.push(dateOnly);
                dataTime.push($(this).val());
            }
        });

        $.ajax({
            url: '/schedule-tours',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data: {
                property_id: property,
                price: price,
                bedroom_id: bedroom,
                living_condition: living_condition,
                length: month,
                type_tour: type_tour,
                time: dataTime
            },
            success: function(response){

              if (response['status'] > 0) {
                $('#schedule-modal').modal('hide');
                $('#schedule-message-modal').modal('show');
              }else if(response == 0){
                alert('salah');
              }else{
                alert(response);
              }
            }
        });
    });

    $('.btn-submit-booking').click(function(){
        var property = $('#property-id').val();
        var price = $('#price').val();
        var bedroom = $('#bedroom').val();
        var living_condition = $('#living-condition').val();
        var month = $('#month').val();
        var _token= $('#token').val();

        $.ajax({
            url: '/instant-booking',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data: {
                property_id: property,
                price: price,
                bedroom_id: bedroom,
                living_condition: living_condition,
                length: month
            },
            success: function(response){

              if (response['status'] > 0) {
                $('#modalVisitThisProperty').modal('hide');
                $('#booking-message-modal').modal('show');
              }else if(response == 0){
                alert('salah');
              }else{
                alert(response);
              }
            }
        });
    });

    function countElement(item,array) {
        var count = 0;
        $.each(array, function(i,v) { if (v === item) count++; });
        return count;
    }
    $('.marker-full-btn').click(function(){
        var mapList = $('#map-list');
        mapList.toggleClass('map-fullscreen');
        if(mapList.hasClass('map-fullscreen')) $(this).hide();
    });

    var offer = document.getElementById("slider-offer");
    window.setOffer = function(start, end) {
        if (offer) {
            offer.noUiSlider.updateOptions({
                start: [end],
                range: {'min': start, 'max': end}
            }, true)
        }
    }
    if (offer) {
        noUiSlider.create(offer, {
            start: [0],
            connect: [!0, !1],
            step: 1,
            tooltips: true,
            format: {
                to: function (value) {
                    return accounting.formatMoney(value, 'IDR ', 0,'.');
                },
                from: function (value) {
                    return accounting.unformat(value);
                }
            },
            range: {
                'min': 0,
                'max': 1000
            }
        });
    }

    function generateTab(element, index) {
        var clone = markerTabTemplate.clone(true);
        var navLink = clone.find('.nav-link');
        navLink.attr('href','#neighborhood-tab-'+index).text(element.name);
        tabPanel.append(clone);
        if(index == 0) navLink.addClass('active show')
        clone.removeClass('marker-tab-template d-none');
    }
    function generateList(element, index, start) {
        var clone = markerListTemplate.clone(true);
        clone.attr('id','neighborhood-tab-'+index);
        tabContent.append(clone);
        if(index == 0) clone.addClass('active show');
        clone.removeClass('marker-list-template d-none');
        for(var i=0;i < element.markers.length; i++) {
            generateMarker(clone, element.markers[i], i + start);
        };
    }
    function generateMarker(list, element, index) {
        var clone = markerTemplate.clone(true);
        clone.find('.marker-num').text(index);
        clone.find('.marker-title').text(element.name);
        clone.find('.marker-distance').text(element.distance+" km");
        list.append(clone);
        clone.removeClass('marker-template d-none');
        // listenMarker(clone, element.point);
        // detailMap.addMarker(element.point, '/img/marker.svg',index,new google.maps.Point(3, 28),'marker-text');
    }
    function listenMarker(dom, point) {
        dom.click(function(){
            detailMap.panTo(point);
        })
    }
}

// Select2
$(".js-select2").each(function() {
    $(this).select2({
        containerCssClass: "js-select2",
        placeholder: $(this).attr('placeholder'),
        width: 'resolve',
        minimumResultsForSearch: -1
   });
});

function formatOutput (item) {
    var $state = $('<span class="select2-price">' + item.text + ' '+ '<small>' + $(item.element).data('description') +'</small>'+'</span>');
    return $state;
};

 if ($('.js-select2-info')) {
    $(".js-select2-info").each(function(){
        $(this).select2({
            containerCssClass: "js-select2",
            templateResult: formatOutput,
            templateSelection: formatOutput,
            dropdownAutoWidth: true,
            escapeMarkup: function(m) {
                return m;
            },
            minimumResultsForSearch: Infinity,
        });
    });
}

// if ($('.js-select2-info')) {
//     $(".js-select2-info").each(function(){
//         $(this).select2({
//             containerCssClass: "js-select2",
//             templateResult: function(state) {
//                 if (!state.id) return state.text;
//                 return $('<span class="select2-price">' + state.text + ' '+ '<small>'+ state.title + $(state.element).data('description') +'</small>'+'</span>');
//             },
//             templateSelection: function(state) {
//                 if (!state.id) return state.text;
//                 return $('<span class="select2-price">' + state.text + ' '+ '<small>'+ state.title + $(state.element).data('description') +'</small>'+'</span>');
//             },
//             dropdownAutoWidth: true,
//             escapeMarkup: function(m) {
//                 return m;
//             },
//             minimumResultsForSearch: Infinity,
//         });
//     });
// }

// rate propotion slider
if ($('#rate-proposition-slider').length) {
    var rateSlider = document.getElementById('rate-proposition-slider');
    // var input0 = document.getElementById('rate-proposition-text-1');
    // var input1 = document.getElementById('rate-proposition-text-2');
    // var inputs = [input0, input1];

    noUiSlider.create(rateSlider, {
        start: 35000000,
        connect: [true,false],
        range: {
            'min': 20000000,
            'max': 35000000
        },
        tooltips: [wNumb({
            decimals: false,
            thousand: '.',
            prefix: 'IDR '
        })],
        format: wNumb({
            decimals: false,
            thousand: '.',
            prefix: 'IDR ',
        })
    });

    // rateSlider.noUiSlider.on('update', function (values, handle) {
    //     inputs[handle].innerHTML = values[handle];
    // });
}

$('#view-monthly-installment').on('click', function(){
    $('#monthly-installment-holder').css('display', 'block');
    $(this).css('display', 'none');
    $('#pricepaid-select').css('display', 'none');
});

$('#close-monthly-installment').on('click', function(){
    $('#monthly-installment-holder').css('display', 'none');
    $('#view-monthly-installment').css('display', 'block');
    $('#pricepaid-select').css('display', 'block');
});
$(document).on('slideleft.navlink slideright.navlink', '.booking-sticky .nav-link', function (e, offset, offsetWidth, containerWidth) {
    var $scope = $(this).closest('ul').parent();
    if (!offset) {
        $scope.find('.tabs-navigator.left').css('visibility', 'hidden');
    } else {
        $scope.find('.tabs-navigator.left').css('visibility', '');
    }

    if (offsetWidth > containerWidth) {
        $scope.find('.tabs-navigator.right').css('visibility', 'hidden');
    } else {
        $scope.find('.tabs-navigator.right').css('visibility', '');
    }
});
