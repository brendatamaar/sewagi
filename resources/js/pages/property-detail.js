// /*!
//  * This file purposedly created as replacement of detail.js
//  * to handle single property page.
//  *
//  */

//  // This just a mockup of currency. You may set this somewhere.
//  // The default currency is IDR if no `window.APP_CURRENCY` set.
//  window.APP_CURRENCY = window.APP_CURRENCY || 'IDR';

// /**
//  * We'll wait for the document to be ready first. This callback
//  * also useful for scoping operation so it won't mutate the global
//  * scope.
//  */
// $(function () {
//     // Since selectors defined on HTML varies written which make
//     // it impossible to simplicity in order to call them, we'll
//     // list the elements which maintain states and values needed
//     // for submission below.
//     /**
//     * property_id: $('#property-id').val()
//     * property_type: $('input[name="living-conditions"]:checked').val()
//     * length_of_stay: $('input[name="monthly"]:checked').val()
//     * bedroom_id: $('#bedroom-type').val()
//     * bedroom_name: $('#bedroom-type option:selected').text()
//     * bedroom_price: $('#pricepaid').val()
//     * installment_type: $('#pricepaid option:selected').data('description')
//     *
//     *
//     */

//     /**
//      * This section contains events and its listeners.
//      *
//      */
//     $(document).on('change', 'input[name="living-conditions"]', function () {
//         if ($('input[name="living-conditions"]:checked').val() == 'entire-space') {
//             $('.lets-negotiate').show();
//             $('#bedroom-type-select').hide();
//         }else{
//             $('.lets-negotiate').hide();
//             $('#bedroom-type-select').show();
//         }
//     });

//     $(document).on('change', 'input[name="monthly"]', function () {
//         var $self = $(this);

//         requestGetBedroomPrice()
//             .then(function (data) {
//                 return insertBedroomPriceOptions(data);
//             })
//             .then(function () {
//                 // Everytime the checkbox of length_of_stay changed
//                 // we should notify the tab-navigation to set its `active` state.
//                 $self.closest('.nav-link').trigger('click');
//             });
//     });

//     $(document).on('change', '#pricepaid', function () {
//         var $self = $(this);

//         var length_of_stay = $('input[name="monthly"]:checked').val();

//         if ($self.data('description') == 'PAID ONCE' && (length_of_stay == 6 || length_of_stay == 12)) {
//             insertInstallment()
//                 .then(function () {
//                     // Everytime installment table built, we'll grab it's cheapest value
//                     // then change the value of bedroom_price to grabbed value
//                     var cheapestPrice = getCheapestInstallmentPrice();
//                     if (cheapestPrice) {
//                         var $el = $self.find('option[data-description="PAID ONCE"]');
//                         $el.attr('value', cheapestPrice);
//                         $el.text(window.APP_CURRENCY + ' ' + cheapestPrice);
//                     }
//                 })
//         } else {
//             $('.installment_option').hide();
//         }
//     });

//     /**
//      * This section contains DOM manipulating functions.
//      *
//      */
//      function insertBedroomPriceOptions (data) {
//         var originalValue = $('#pricepaid').val() || false;
//         var html = '';

//         $.each(data, function (key, value) {
//             // if (value.paid_once) {
//             //     html += '<option value="'+value.paid_once+'" data-description="PAID ONCE">'+window.APP_CURRENCY+' '+value.paid_once+'</option>';
//             // }
//             // if (value.paid_twice) {
//             //     html += '<option value="'+value.paid_twice+'" data-description="PAID TWICE">'+window.APP_CURRENCY+' '+value.paid_twice+'</option>';
//             // }
//             // if (value.paid_quarterly) {
//             //     html += '<option value="'+value.paid_quarterly+'" data-description="PAID QUARTERLY">'+window.APP_CURRENCY+' '+value.paid_quarterly+'</option>';
//             // }
//             // if (value.paid_yearly) {
//             //     html += '<option value="'+value.paid_yearly+'" data-description="PAID YEARLY">'+window.APP_CURRENCY+' '+value.paid_yearly+'</option>';
//             // }
//             //
//             // We'll simplifize above `if` operation as follow:
//             var dataDescription = {
//                 paid_once: 'PAID ONCE',
//                 paid_twice: 'PAID TWICE',
//                 paid_quarterly: 'PAID QUARTERLY',
//                 paid_yearly: 'PAID YEARLY',
//             };

//             $.each(value, function (k, v) {
//                 if (v && dataDescription[k]) {
//                     html += '<option value="'+v+'" data-description="'+dataDescription[k]+'">'+window.APP_CURRENCY+' '+v+'</option>';
//                 }
//             });
//         });

//         if (!html) {
//             html = '<option value="">Price Not Found</option>';
//         }

//         $('#pricepaid').html(html);

//         // If, the user already changed the bedroom price for example chose
//         // the `paid_twice` option, we'll try to change the selected value to
//         // previously/original value if available. Or else, we'll set the
//         // selected option to the `PAID ONCE` option.

//         if (!originalValue) {
//             originalValue = $('#pricepaid option[data-description="PAID ONCE"]').attr('value');
//         }

//         // If `PAID ONCE` has not been set, we'll try to set the
//         // selected option to the cheapest value available.
//         if (!originalValue) {
//             var cheapestValue;

//             $('#pricepaid option').each(function () {
//                 var intValue = parseInt($(this).val(), 10) || 0;

//                 if (!cheapestValue) {
//                     cheapestValue = intValue;
//                 } else {
//                     if (cheapestValue > intValue) {
//                         cheapestValue = intValue;
//                     }
//                 }
//             });

//             originalValue = cheapestValue;
//         }

//         // For the worst case, if no original value found, no `PAID ONCE` value found,
//         // and no cheapest value found, we'll find the first option appeared.
//         if (!originalValue) {
//             originalValue = $('#pricepaid option:first').attr('value');
//         }

//         $('#pricepaid').val(originalValue).trigger('change');
//      }

//     /**
//      * This performs insertion of installment elements
//      *
//      * @return void
//      */
//     function insertInstallment (month, price) {
//         month = parseInt($('input[name="monthly"]:checked').val(), 10)
//         price = parseInt($('#pricepaid').val(), 10);

//         // Reset latest figured cheapest installment
//         $('#gradanaTable').removeAttr('data-cheapest-installment');
//         $('#cicilsewaTable').removeAttr('data-cheapest-installment');

//         if (month == 6) {
//             $('.cicil_sewa').hide();

//             var bunga = 8.75 / 100;
//             var totalbunga = price * bunga;
//             total = parseInt(price)+parseInt(totalbunga);
//             cicilans = total / 6;
//             cicilan = Math.round(cicilans / 1000) * 1000;
//             totalAll = cicilan * month;

//             var currentCicilan6 = cicilan;
//             var totalCicilan6 = totalAll;
//             var cheapest6 = cicilan;
//             var html6 = '<table class="table table-bordered" border="1" style="width:100%;"><tr>';

//             for (var i=1;i<=month;i++) {
//                 html6 += '<td scope="row" class="month-index">Month ' + i + '</td>';
//                 html6 += '<td scope="row" class="installment-price" data-price="'+currentCicilan6+'">'+ window.APP_CURRENCY +' ' + currentCicilan6 + '</td>';
//             }

//             html6 += '<th scope="row" class="month-index-total">Total</th>';
//             html6 += '<th scope="row" class="installment-price-total">' + window.APP_CURRENCY + ' ' + totalCicilan6 + '</th></tr>';

//             $('#gradanaTable').html(html6).attr('data-cheapest-installment', cheapest6);
//             $('#cicilsewaTable').removeAttr('data-cheapest-installment');
//         }
//         if(month == '12'){
//             $('.cicil_sewa').show();
//             var bunga = 17.5 / 100;

//             total = price * bunga;
//             cicilan = Math.ceil((parseInt(price)+parseInt(total)) / month);
//             cicilan = Math.round(cicilan / 1000) * 1000;
//             totalAll = cicilan * month;

//             var currentCicilan12 = cicilan;
//             var totalCicilan12 = totalAll;
//             var cheapest12 = cicilan;
//             var html12 = '<table class="table table-bordered" border="1" style="width:100%;"><tr>';

//             for (var i=1;i<=month;i++) {
//                 html12 += '<td scope="row" class="month-index">Month ' + i + '</td>';
//                 html12 += '<td scope="row" class="installment-price" data-price="'+currentCicilan12+'">'+ window.APP_CURRENCY +' ' + currentCicilan12 + '</td>';
//             }

//             html12 += '<th scope="row" class="month-index-total">Total</th>';
//             html12 += '<th scope="row" class="installment-price-total">' + window.APP_CURRENCY + ' ' + totalCicilan12 + '</th></tr>';

//             $('#gradanaTable').html(html12).attr('data-cheapest-installment', cheapest12);

//             dpcicil = price * 30 / 100;
//             totalpinjaman = parseInt(price)-parseInt(dpcicil);
//             hitungan = totalpinjaman * 0.18;
//             cicilanperbulan = (parseInt(totalpinjaman)+parseInt(hitungan)) / 10;
//             var totalAllcicil = parseInt(dpcicil)+parseInt((cicilanperbulan * 10));
//             cheapet12 = cicilanperbulan;

//             html12 = '<table class="table table-bordered" border="1" style="width:100%;"><tr>';

//             for (var i=1;i<=11;i++) {
//                 if(i == 1){
//                     cicilanperbulan = parseInt(dpcicil)+parseInt(cicilanperbulan);
//                 }else{
//                     cicilanperbulan = (parseInt(totalpinjaman)+parseInt(hitungan)) / 10;
//                 }

//                 if (cheapest12 > cicilanperbulan) {
//                     cheapest12 = cicilanperbulan;
//                 }

//                 html12 += '<td scope="row" class="month-index">Month ' + i + '</td>';
//                 html12 += '<td scope="row" class="installment-price" data-price="'+cicilanperbulan+'">'+ window.APP_CURRENCY +' ' + cicilanperbulan + '</td>';
//             }

//             html12 += '<th scope="row" class="month-index-total">Total</th>';
//             html12 += '<th scope="row" class="installment-price-total">' + window.APP_CURRENCY + ' ' + totalAllcicil + '</th></tr>';

//             $('#cicilsewaTable').html(html12).attr('data-cheapest-installment', cheapest12);
//         }

//         // We'll mockup the process as async since dom manipulation takes
//         // times to complete eventhough just,for example, 300 ms (average click time).
//         // So we could get the actual values which already inserted properly.
//         var p = $.Deferred();

//         setTimeout(function () {
//             p.resolve();
//         }, 300);

//         return p;
//     }

//     /**
//      * This section contains AJAX request functions which should
//      * prefixed with `request`.
//      *
//      * @return array
//      */
//      var BEDROOM_PRICES_CACHE = {};
//      function requestGetBedroomPrice () {
//         // We'll first find the result from our simple variable cache
//         // If values exists, we'll simply return it using $.Deferred()
//         // to match api with $.ajax
//         var bedroom_id = $('#bedroom-type').val();
//         var property_id = $('#property-id').val();
//         var length_of_stay = $('input[name="monthly"]:checked').val();
//         var cacheKey = bedroom_id+''+property_id+''+length_of_stay;

//         if (typeof BEDROOM_PRICES_CACHE[cacheKey] !== 'undefined') {
//             return $.Deferred().resolve(BEDROOM_PRICES_CACHE[cacheKey]);
//         }

//         return $.ajax({
//             type: 'POST',
//             url: '/get-bedroom-price',
//             data: {
//                 bedroom_id: bedroom_id,
//                 property_id: property_id,
//                 length: length_of_stay,
//             }
//         })
//         // Chaining with `.then` is equal with supplying `success` callback
//         // in `$.ajax` function. We'll keep using this method so we can chain
//         // it later.
//         .then(function (res) {
//             var result = [];

//             // Here, we'll make sure the returned result from this ajax function
//             // is the items rather than raw ajax response.
//             if (res && $.isArray(res.data) && res.data.length) {
//                 result = res.data;
//             }

//             // Before returning the result, we should add it to variable cache.
//             BEDROOM_PRICES_CACHE[cacheKey] = result;

//             return result;
//         });
//      }

//     /**
//      * This section contains helpers or getters.
//      *
//      */
//     function getCheapestInstallmentPrice () {
//         var gradanaPrice = parseInt($('#gradanaTable').data('cheapest-installment'), 10) || 0;
//         var cicilSewaPrice = parseInt($('#cicilsewaTable').data('cheapest-installment'), 10) || 0;

//         if (gradanaPrice && cicilSewaPrice) {
//             return Math.min(gradanaPrice, cicilSewaPrice);
//         } else if (gradanaPrice && !cicilSewaPrice) {
//             return gradanaPrice;
//         } else if (!gradanaPrice && cicilSewaPrice) {
//             return cicilSewaPrice;
//         }
//     }


//      /*===========================================================================
//       * INITIAL ACTIONS
//       * What happens when the page first loaded?
//       *
//       *===========================================================================
//       */
//       // 1. Property Type
//       //    We'll set it to co-living if available. Or entire-space if it does not.
//       if ($('input[name="living-conditions"][value="co-living"]').length) {
//         $('input[name="living-conditions"][value="co-living"]').prop('checked', true).trigger('change');
//       } else {
//         $('input[name="living-conditions"][value="entire-space"]').prop('checked', true).trigger('change');
//       }

//       // 2. Length of stay
//       //    We'll select 1 Year if available. Or 9 months if it does not. Or 6 months and so forth.
//       if ($('input[name="monthly"][value="12"]').length) {
//         $('input[name="monthly"][value="12"]').prop('checked', true).trigger('change');
//       } else if ($('input[name="monthly"][value="9"]').length) {
//         $('input[name="monthly"][value="9"]').prop('checked', true).trigger('change');
//       } else if ($('input[name="monthly"][value="6"]').length) {
//         $('input[name="monthly"][value="6"]').prop('checked', true).trigger('change');
//       } else if ($('input[name="monthly"][value="3"]').length) {
//         $('input[name="monthly"][value="3"]').prop('checked', true).trigger('change');
//       }
// });


// $(function () {
//     /**
//      * Hide or show the arrow of sticky card
//      */
//     $(document).on('slideleft.navlink slideright.navlink', '.booking-sticky .nav-link', function (e, offset, offsetWidth, containerWidth) {
//         var $scope = $(this).closest('ul').parent();
//         if (!offset) {
//             $scope.find('.tabs-navigator.left').css('visibility', 'hidden');
//         } else {
//             $scope.find('.tabs-navigator.left').css('visibility', '');
//         }

//         if (offsetWidth > containerWidth) {
//             $scope.find('.tabs-navigator.right').css('visibility', 'hidden');
//         } else {
//             $scope.find('.tabs-navigator.right').css('visibility', '');
//         }
//     });

//     // rate propotion slider
//     if ($('#rate-proposition-slider').length) {
//         var rateSlider = document.getElementById('rate-proposition-slider');
//         // var input0 = document.getElementById('rate-proposition-text-1');
//         // var input1 = document.getElementById('rate-proposition-text-2');
//         // var inputs = [input0, input1];

//         noUiSlider.create(rateSlider, {
//             start: 35000000,
//             connect: [true,false],
//             range: {
//                 'min': 20000000,
//                 'max': 35000000
//             },
//             tooltips: [wNumb({
//                 decimals: false,
//                 thousand: '.',
//                 prefix: 'IDR '
//             })],
//             format: wNumb({
//                 decimals: false,
//                 thousand: '.',
//                 prefix: 'IDR ',
//             })
//         });

//         // rateSlider.noUiSlider.on('update', function (values, handle) {
//         //     inputs[handle].innerHTML = values[handle];
//         // });
//     }

//     $('#view-monthly-installment').on('click', function(){
//         $('#monthly-installment-holder').css('display', 'block');
//         $(this).css('display', 'none');
//     });

//     $('#close-monthly-installment').on('click', function(){
//         $('#monthly-installment-holder').css('display', 'none');
//         $('#view-monthly-installment').css('display', 'block');
//     });

//     // Select2
//     $(".js-select2").each(function() {
//         $(this).select2({
//             containerCssClass: "js-select2",
//             placeholder: $(this).attr('placeholder'),
//             width: 'resolve',
//             minimumResultsForSearch: -1
//        });
//     });

//     function formatOutput (item) {
//         var $state = $('<span class="select2-price">' + item.text + ' '+ '<small>' + $(item.element).data('description') +'</small>'+'</span>');
//         return $state;
//     };

//      if ($('.js-select2-info')) {
//         $(".js-select2-info").each(function(){
//             $(this).select2({
//                 containerCssClass: "js-select2",
//                 templateResult: formatOutput,
//                 templateSelection: formatOutput,
//                 dropdownAutoWidth: true,
//                 escapeMarkup: function(m) {
//                     return m;
//                 },
//                 minimumResultsForSearch: Infinity,
//             });
//         });
//     }
// })
