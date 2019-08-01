$(document).ready(function () {
    $parent = $("#content-modal-auth");
    jQuery.validator.addMethod("greaterThanEighteen", function (value, el) {
        var dob = extractDate($(el).val());
        var age = checkAge(dob);
        var res = false;
        if (age >= 18) {
            res = true;
        }
        return res;
    }, "");
    let authPage = {
        init: function () {
            this.detectOpened();
            this.initLogin();
            this.initRegister();
            this.initRegisterSocial();
            this.initRegisterCompany();
            this.initForm();
            this.changePhoneNumber();
            this.forgotPasswordByEmail();
            this.forgotPasswordByPhoneNumber();
            this.verifyPhoneNumber();
        },
        state: {
            timer: 0
        },
        initLogin: function () {
            /* Attempt Login */
            $(document).on('submit', '#form-login', function (e) {
                e.preventDefault();
                var formData = $(this).serializeArray();
                $("#form-login :input").prop("disabled", true);
                $("#input-password-login").removeClass("input-container-err");
                $("#error-password-login").html('');

                $.post("/login", formData)
                    .done(function (data) {
                        $("#modalLogin").modal('hide');
                        if (data.role == 'admin') {
                            return location.replace('/admin');
                        }
                        return location.reload();
                    }).fail(function (data) {
                        var result = data.responseJSON;
                        $("#input-password-login").addClass("input-container-err");
                        $("#error-password-login").html(result.message);
                        $("#form-login :input").prop("disabled", false);
                    });
            });
        },
        initRegister: function () {
            jQuery.validator.addMethod('regexPassword', function (value, element) {
                return /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9-]{6,})$/.test(value);
            }, 'Minimum 6 characters with combination of numbers and letters.');

            $("#password-register").on('focus', function () {
                $(".password-confirm-container").removeClass('d-none');
                $('.register-password-info').removeClass('d-none');
            });

            $("#form-register").validate({
                rules: {
                    first_name: { required: true },
                    email: {
                        required: true,
                        email: true,
                        remote: "/register/check-email"
                    },
                    password: {
                        required: true,
                        regexPassword: true
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password-register"
                    },
                    phone_number: { required: true },
                    nationality_id: { required: true },
                    dob: {
                        required: true,
                        remote: "/register/check-dob"
                    },
                    gender: { required: true },
                },
                messages: {
                    email: {
                        remote: 'That email is already taken'
                    },
                    dob: {
                        remote: 'Date of birth is invalid'
                    },
                    password_confirmation: {
                        equalTo: "Oops! Your new password don't match. Please try again."
                    }
                },
                submitHandler: function (form) {
                    $("#signup-person-process").data('type', 'email');
                    $("#modalRegisterPerson").modal('hide');
                    $("#modalPersonHelp").modal();
                }
            });
            $(document).on("submit", "#form-register", function (e) {
                e.preventDefault();
            });

            $('#dob-register').mask('00/00/0000');
            $('select.selectpicker').selectpicker();

            $('input[name="phone_number"]').keyup(function () {
                if ($(this).val() !== '') $('.register-phone-info').removeClass('d-none');
                else $('.register-phone-info').addClass('d-none');
            })

            const personHelp = ['option_1', 'option_2', 'option_3', 'option_4'];
            $('input[name="person-help"]').change(function () {
                const data = personHelp.filter(q => $(`input[name="person-help"][value="${q}"]`).prop('checked') === true);
                if (data.length > 0) {
                    $('#signup-person-process').parent().removeClass('btn-not-active');
                } else {
                    $('#signup-person-process').parent().addClass('btn-not-active');
                }
            });

            $(document).on('click', "#signup-person-process", function (e) {
                if ($(this).data('type') == 'email') {
                    $("#input-person-help").val('1');
                    $("#signup-person-process").prop('disabled', true);
                    $("#signup-person-process").attr('value', 'Sending..');
                    $.ajax({
                        url: '/register',
                        method: 'post',
                        data: $("#form-register").serializeArray(),
                        success: function (response) {
                            $("#signup-person-process").prop('disabled', false);
                            $("#signup-person-process").attr('value', 'SIGN-UP');
                            $('#modalPersonHelp').modal('hide');
                            $('#registeredMail').text(response.data.email);
                            $('#modalRegisterSuccessEmail').modal('show');
                        }
                    });
                }
            });
        },
        initRegisterSocial: function () {
            $('#dob-register-social').mask('00/00/0000');
            var providerId = $("#input-provider-id").val();
            if ($("#modalRegisterPersonSocial").hasClass('modal-open')) {
                $.ajax({
                    url: "/social-account/" + providerId,
                    success: function (result) {
                        authPage.showRegisterSocial(result);
                    }
                });
            }

            $("#form-register-social").validate({
                rules: {
                    phone_number: {
                        required: true
                    },
                    nationality_id: {
                        required: true
                    },
                    dob: {
                        required: true,
                        greaterThanEighteen: true
                    },
                    gender: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        remote: 'That email is already taken'
                    }
                },
                submitHandler: function (form) {
                    $("#signup-person-process").data('type', 'social');
                    $("#modalRegisterPersonSocial").modal('hide');
                    $("#modalPersonHelp").modal();
                }
            });
        },
        showRegisterSocial: function (result) {
            $("#social-provider").html(result.provider);
            $("#social-firstname").val(result.first_name);
            $("#social-lastname").val(result.last_name);
            $("#social-email").val(result.email);

            $(document).on('click', "#signup-person-process", function (ev) {
                if ($(this).data('type') == 'social') {
                    ev.preventDefault();
                    $("#input-person-help-social").val('1');
                    var dob = extractDate($('#dob-register-social').val());
                    var phoneNo = $('#phone-register-social').val();
                    var password = generatePassword();
                    $.ajax({
                        url: '/register-social',
                        method: 'post',
                        data: {
                            first_name: result.first_name,
                            last_name: result.last_name,
                            email: result.email,
                            calling_code: $('#calling-code-register-social').val(),
                            phone_number: phoneNo,
                            gender: $("input[name='gender']:checked").val(),
                            dob: dob,
                            nationality_id: $('#countryPicker-social').val(),
                            password: password
                        },
                        success: function (response) {
                            const phone = response.data.phone_number;
                            authPage.saveUserPreferences(response);
                            $('#modalPersonHelp').modal('hide');
                            $('#modalRegisterVerification').modal('show');
                            $('#hdnPhoneNumber').val(response.data.phone_number);
                            $('#hdnChangePhoneNumberUserId').val(response.data.id);
                            // $('#lblVerificationPhoneNumber').html(maskPhoneNumber(response.data.phone_number));
                            $('#maskingNumber').text(phone.slice((phone.length - 3), phone.length));
                            countdown(response.verification_code.expired_at);
                            $('#send-new-code-register').on('click', function () {
                                clearInterval(authPage.state.timer);
                                authPage.normalizeOtpForm();
                                authPage.resendVerificationCode(response);
                            });
                            ev.preventDefault();
                        }
                    });
                }
            });
        },
        saveUserPreferences: function (result) {
            var option_1 = 0;
            var option_2 = 0;
            var option_3 = 0;
            var option_4 = 0;
            $('.radUserPreference .checkbox').each(function (i, obj) {
                if ($(obj).is(':checked')) {
                    switch ($(obj).val()) {
                        case 'option_1':
                            option_1 = 1;
                            break;
                        case 'option_2':
                            option_2 = 1;
                            break;
                        case 'option_3':
                            option_3 = 1;
                            break;
                        case 'option_4':
                            option_4 = 1;
                            break;

                    }
                }
            });
            $.ajax({
                url: '/save-user-preferences',
                method: 'post',
                data: {
                    user_id: result.data.id,
                    type: 'individual',
                    option_1: option_1,
                    option_2: option_2,
                    option_3: option_3,
                    option_4: option_4
                },
                success: function (response) {

                }
            });
        },
        resendVerificationCode: function (result) {
            $.ajax({
                url: '/resend-verification-code',
                method: 'post',
                data: {
                    user_id: result.data.id,
                },
                success: function (response) {
                    countdown(response.verification_code.expired_at);
                }
            });
        },
        initRegisterCompany: function (result) {
            $('#btnSubmitRegisterCompany').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/register-company',
                    data: {
                        'name': $('#txtCompanyName').val(),
                        'street': $('#txtCompanyStreet').val(),
                        'street_no': $('#txtCompanyStreetNo').val(),
                        'detail': $('#txtCompanyDetail').val(),
                        'city': $('#txtCompanyCity').val(),
                        'district': $('#txtCompanyDistrict').val(),
                        'postcode': $('#txtCompanyPostcode').val(),
                        'phone_number_company': $('#txtCompanyPhoneNumber').val(),
                        'website': $('#txtCompanyWebsite').val(),
                        'first_name': $('#txtCompanyPICFirstName').val(),
                        'last_name': $('#txtCompanyPICLastName').val(),
                        'email': $('#txtCompanyPICEmail').val(),
                        'calling_code': $('#txtCompanyPICCallingCode').val() || '+62',
                        'phone_number': $('#txtCompanyPICPhoneNumber').val(),
                        'password': $('#txtCompanyPICPassword').val(),
                        'password_confirmation': $('#txtCompanyPICPasswordConfirmation').val(),
                        'option_1': $('#cbRegisterCompanyUserPreference1').is(':checked') ? 1 : 0,
                        'option_2': $('#cbRegisterCompanyUserPreference2').is(':checked') ? 1 : 0,
                        'option_3': $('#cbRegisterCompanyUserPreference3').is(':checked') ? 1 : 0,
                        'option_4': $('#cbRegisterCompanyUserPreference4').is(':checked') ? 1 : 0,
                        'user_id': '',
                        'type': 'company'
                    },
                    error: function (response) {
                        var message = $.parseJSON(response.responseText);
                        $('#lblErrorRegisterCompany').html('');
                        $.each(message.errors, function (key, value) {
                            $('#lblErrorRegisterCompany').html($('#lblErrorRegisterCompany').html() + value + '<br />');
                            $('#lblErrorRegisterCompany').show();
                        });
                    },
                    success: function (response) {
                        if (response.error) {
                            $('#lblErrorRegisterCompany').html('');
                            $('#lblErrorRegisterCompany').text(response.error);
                            $('#lblErrorRegisterCompany').show();
                        }
                        else {
                            const phone = response.data.phone_number;
                            $('#modalRegisterCompanyHelp').modal('hide');
                            $('#modalRegisterVerification').modal('show');
                            $('#hdnPhoneNumber').val(response.data.phone_number);
                            $('#hdnChangePhoneNumberUserId').val(response.data.id);
                            $('#maskingNumber').text(phone.slice((phone.length - 3), phone.length))
                            countdown(response.verification_code.expired_at);
                            $('#send-new-code-register').on('click', function () {
                                clearInterval(authPage.state.timer);
                                authPage.normalizeOtpForm();
                                authPage.resendVerificationCode(response);
                            });
                            $('#txtCompanyName').val('');
                            $('#txtCompanyStreet').val('');
                            $('#txtCompanyStreetNo').val('');
                            $('#txtCompanyDetail').val('');
                            $('#txtCompanyCity').val('');
                            $('#txtCompanyDistrict').val('');
                            $('#txtCompanyPostcode').val('');
                            $('#txtCompanyPhoneNumber').val('');
                            $('#txtCompanyWebsite').val('');
                            $('#txtCompanyPICFirstName').val('');
                            $('#txtCompanyPICLastName').val('');
                            $('#txtCompanyPICEmail').val('');
                            $('#txtCompanyPICPhoneNumber').val('');
                            $('#txtCompanyPICPassword').val('');
                            $('#txtCompanyPICPasswordConfirmation').val('');
                        }
                    }
                });
            });

            $('#txtCompanyPICEmail').blur(function () {
                fetch(`/register/check-email?email=${$(this).val()}`)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data) {
                            $('#takenEmail').hide();
                        } else {
                            $('#takenEmail').show();
                        }
                    })
                    .catch((error) => console.log(error));
            })
        },
        initForm: function () {
            $('.phone-code').select2({
                placeholder: `<img src="../img/flag-indonesia.svg" alt=""> +62`,
                escapeMarkup: function (markup) { return markup; },
                width: '100%',
                dropdownAutoWidth: true,
                templateResult: function (state) {
                    let param = state.element;
                    if ($(param).data('img')) {
                        return $("<span><img class='img-square' width='30' src='" + $(param).data('img') + "'/> " + $(param).data('name') + " " + $(param).data('code') + "</span>");
                    }

                    return `${state.text}`;
                },
                templateSelection: function (state) {
                    let param = state.element;
                    if ($(param).data('img')) {
                        return $("<span><img class='img-square' width='15' src='" + $(param).data('img') + "'/> " + $(param).data('code') + "</span>");
                    }

                    return state.text;
                },
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });
        },
        verifyPhoneNumber: function () {
            $(".otp-form").keyup(function () {
                if (this.value.length == this.maxLength) {
                    var $next = $(this).parent().next().children('.otp-form');
                    if ($next.length)
                        $(this).parent().next().children('.otp-form').focus();
                    else
                        $(this).blur();
                }
            });

            $('.otp-form').change(function () {
                let otpNumber = '';
                $('.otp-form').each(function () {
                    otpNumber += $(this).val();
                });

                if (otpNumber.length === 8) {
                    $('#btnVerificationCode').removeClass('disabled');
                    $('#otpCode').val(parseInt(otpNumber));
                }
            });

            $('#btnVerificationCode').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/verify-phone-number',
                    data: {
                        'phone': $('#hdnPhoneNumber').val(),
                        'code': $('#otpCode').val()
                    },
                    success: function (response) {
                        if (response.error) {
                            const phone = $('#hdnPhoneNumber').val();                        
                            $('#unverifiedMaskingNumber').text(phone.slice((phone.length - 3), phone.length));
                            $('#modalRegisterVerification').modal('hide');
                            $('#modalUnableVerifyPhoneNumber').modal('show');
                            $('#send-new-otp-register').on('click', function () {
                                clearInterval(authPage.state.timer);
                                authPage.normalizeOtpForm();
                                authPage.resendVerificationCode(response);
                                $('#modalRegisterVerification').modal('show');
                                $('#modalUnableVerifyPhoneNumber').modal('hide');
                            });
                        }
                        else {
                            $('#modalRegisterVerification').modal('hide');
                            $('#modalVerifySuccessPhoneNumber').modal('show');
                        }
                    }
                });
            });
        },
        normalizeOtpForm: function () {
            $('.otp-form').each(function () {
                $(this).val('');
            });
            $('#btnVerificationCode').addClass('disabled');
            $('#send-new-code-register').addClass('disabled');
        },
        changePhoneNumber: function () {
            $('#btnChangePhoneNumber').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/change-phone-number',
                    data: {
                        'user_id': $('#hdnChangePhoneNumberUserId').val(),
                        'calling_code': $('#ddlChangePhoneNumberCallingCode').val() || '+62',
                        'phone_number': $('#txtChangePhoneNumber').val()
                    },
                    success: function (response) {
                        const phone = response.phoneNumber;
                        clearInterval(authPage.state.timer);
                        authPage.normalizeOtpForm();
                        $('#hdnPhoneNumber').val(response.phoneNumber);
                        $('#txtChangePhoneNumber').val('');
                        $('#modalRegisterVerification').modal('show');
                        $('#maskingNumber').text(phone.slice((phone.length - 3), phone.length));
                        countdown(response.expiredAt.date);
                    }
                });
            });
        },
        forgotPasswordByEmail: function () {
            $('#btnSendForgotPasswordByEmail').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/check-email',
                    data: {
                        'email': $('#txtEmail').val()
                    },
                    success: function (response) {
                        if (response) {
                            $('#lblErrorForgotPasswordByEmail').text(response.error);
                            $('#lblErrorForgotPasswordByEmail').show();
                            $('#divEmailContainer').addClass('input-container-err')
                        }
                        else {
                            $.ajax({
                                type: 'post',
                                url: '/forgot-password',
                                data: {
                                    'email': $('#txtEmail').val()
                                },
                                success: function (response) {
                                    $('#modalForgetEmail').modal('hide');
                                    $('#modalSuccessEmail').modal('show');
                                    $('#lblEmail').text($('#txtEmail').val());
                                    $('#txtEmail').val('');
                                }
                            });
                        }
                    }
                });
            });

            $('#txtEmail').keyup(function () {
                if ($(this).val() !== '') {
                    $('#lblErrorForgotPasswordByEmail').text('');
                    $('#lblErrorForgotPasswordByEmail').hide();
                    $('#divEmailContainer').removeClass('input-container-err');
                }
            });
        },
        forgotPasswordByPhoneNumber: function () {
            $('#btnSendForgotPasswordByPhoneNumber').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/check-phone-number',
                    data: {
                        'phone_number': $('#txtPhoneNumber').val()
                    },
                    success: function (response) {
                        if (response) {
                            $('#lblErrorForgotPasswordByPhoneNumber').text(response.error);
                            $('#lblErrorForgotPasswordByPhoneNumber').show();
                            $('#divPhoneNumberContainer').addClass('input-container-err');
                        }
                        else {
                            $.ajax({
                                type: 'post',
                                url: '/forgot-password-phone-number',
                                data: {
                                    'phone_number': $('#txtPhoneNumber').val()
                                },
                                success: function (response) {
                                    $('#modalForgetPhone').modal('hide');
                                    $('#modalSuccessPhoneNumber').modal('show');
                                    $('#lblPhoneNumber').text($('#txtPhoneNumber').val());
                                    $('#txtPhoneNumber').val('');
                                }
                            });
                        }
                    }
                });
            });

            $('#txtPhoneNumber').keyup(function () {
                if ($(this).val() !== '') {
                    $('#lblErrorForgotPasswordByPhoneNumber').text('');
                    $('#lblErrorForgotPasswordByPhoneNumber').hide();
                    $('#divPhoneNumberContainer').removeClass('input-container-err');
                }
            });
        },
        detectOpened: function () {
            if ($(".modal-open").length) {
                $(".modal-open").modal();
            }
        }
    };
    if ($parent.length) {
        authPage.init();
    }
    function extractDate(stringDate) {
        var day = stringDate.substring(0, 2);
        var month = stringDate.substring(3, 5);
        var year = stringDate.substring(6, stringDate.length);
        return year + '-' + month + '-' + day;
    }
    function generatePassword() {
        return Math.random().toString(36).substr(2);
    }

    function maskPhoneNumber(phoneNo) {
        var phoneNumber = '';
        if (phoneNo.length > 4) {
            for (var i = 0; i < phoneNo.length - 3; i++) {
                phoneNumber += '*';
            }
            phoneNumber += phoneNo.substr(phoneNo.length - 3, phoneNo.length);
        }
        return phoneNumber;
    }
    function checkAge(birthDateString) {
        var today = new Date();
        var birthDate = new Date(birthDateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    $('#txtPhoneNumberRegister').on('focus', function () {
        $('.register-phone-info').removeClass('d-none');
    });

    $('#phone-register-social').on('focus', function () {
        $('.register-phone-info').removeClass('d-none');
    });

    var modalRegisterCompany = $('#modalRegisterCompany');
    var modalRegisterCompanyPIC = $('#modalRegisterCompanyPIC');

    modalRegisterCompany.find('#txtCompanyName').keyup(function () {
        registerCompanyValidation();
    });
    modalRegisterCompany.find('#txtCompanyStreet').keyup(function () {
        registerCompanyValidation();
    });
    modalRegisterCompany.find('#txtCompanyStreetNo').keyup(function () {
        registerCompanyValidation();
    });
    modalRegisterCompany.find('#txtCompanyCity').keyup(function () {
        registerCompanyValidation();
    });
    modalRegisterCompany.find('#txtCompanyPhoneNumber').keyup(function () {
        registerCompanyValidation();
    });
    modalRegisterCompanyPIC.find('#txtCompanyPICFirstName').keyup(function () {
        registerCompanyPICValidation();
    });
    modalRegisterCompanyPIC.find('#txtCompanyPICLastName').keyup(function () {
        registerCompanyPICValidation();
    });
    modalRegisterCompanyPIC.find('#txtCompanyPICEmail').keyup(function () {
        registerCompanyPICValidation();
    });
    modalRegisterCompanyPIC.find('#txtCompanyPICPhoneNumber').keyup(function () {
        registerCompanyPICValidation();
    });
    modalRegisterCompanyPIC.find('#txtCompanyPICPassword').keyup(function () {
        registerCompanyPICValidation();
    });
    const validatePassword = (text) => /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9-]{6,})$/.test(text);
    const showErrorPassword = () => {
        $('#notMatchPassword').show();
        $('#txtCompanyPICPasswordConfirmation').parent().addClass('input-container-err');
        $('#txtCompanyPICPassword').parent().addClass('input-container-err');
    }
    const hideErrorPassword = () => {
        $('#notMatchPassword').hide();
        $('#txtCompanyPICPasswordConfirmation').parent().removeClass('input-container-err');
        $('#txtCompanyPICPassword').parent().removeClass('input-container-err');
    }
    $('#txtCompanyPICPassword').keyup(function () {
        if ($(this).val() !== '') {
            $('#divCompanyPICPasswordConfirmation').show();
            if (validatePassword($(this).val())) {
                $('.register-password-info').addClass('d-none');
                if ($(this).val() === $('#txtCompanyPICPasswordConfirmation').val()) {
                    $('#validPassword').val(true);
                    hideErrorPassword();
                } else {
                    $('#validPassword').val(false);
                    showErrorPassword();
                }
            } else {
                $('#validPassword').val(false);
                $('.register-password-info').removeClass('d-none');
                if ($(this).val() === $('#txtCompanyPICPasswordConfirmation').val()) {
                    hideErrorPassword();
                } else {
                    showErrorPassword();
                }
            }
        } else {
            $('#validPassword').val(false);
            $('#divCompanyPICPasswordConfirmation').hide();
            showErrorPassword();
        }
        registerCompanyPICValidation();
    });
    $('#txtCompanyPICPasswordConfirmation').keyup(function () {
        if ($(this).val() !== '') {
            if (validatePassword($(this).val())) {
                $('.register-password-info').addClass('d-none');
                if ($(this).val() === $('#txtCompanyPICPassword').val()) {
                    $('#validPassword').val(true);
                    hideErrorPassword();
                } else {
                    $('#validPassword').val(false);
                    showErrorPassword();
                }
            } else {
                $('#validPassword').val(false);
                $('.register-password-info').removeClass('d-none');
                if ($(this).val() === $('#txtCompanyPICPassword').val()) {
                    hideErrorPassword();
                } else {
                    showErrorPassword();
                }
            }
        } else {
            $('#validPassword').val(false);
            $('#divCompanyPICPasswordConfirmation').hide();
            showErrorPassword();
        }
        registerCompanyPICValidation();
    });
    $('.checkbox-register-company-user-preference').click(function () {
        var isChecked = false;
        $.each($('.checkbox-register-company-user-preference'), function (key, value) {
            if (this.checked) {
                isChecked = true;
            }
        });
        if (isChecked == true) {
            $('#divSubmitRegisterCompany').removeClass('btn-not-active');
            $('#btnSubmitRegisterCompany').removeAttr("disabled");
        }
        else {
            $('#divSubmitRegisterCompany').addClass('btn-not-active');
            $('#btnSubmitRegisterCompany').attr("disabled", "disabled");
        }
    });
    function registerCompanyValidation() {
        if (modalRegisterCompany.find('#txtCompanyName').val() !== '' && modalRegisterCompany.find('#txtCompanyStreet').val() !== '' && modalRegisterCompany.find('#txtCompanyStreetNo').val() !== '' && modalRegisterCompany.find('#txtCompanyCity').val() !== '' && modalRegisterCompany.find('#txtCompanyPhoneNumber').val() !== '') {
            $('#divContinueRegisterCompany').removeClass('btn-not-active');
            $('#btnContinueRegisterCompany').removeAttr("disabled");
        }
        else {
            $('#divContinueRegisterCompany').addClass('btn-not-active');
            $('#btnContinueRegisterCompany').attr("disabled", "disabled");
        }
    }
    function registerCompanyPICValidation() {
        const validPassword = modalRegisterCompanyPIC.find('#validPassword').val() === 'false' || !modalRegisterCompanyPIC.find('#validPassword').val() ? false : true;
        if (modalRegisterCompanyPIC.find('#txtCompanyPICFirstName').val() !== '' && modalRegisterCompanyPIC.find('#txtCompanyPICLastName').val() !== '' && modalRegisterCompanyPIC.find('#txtCompanyPICEmail').val() !== '' && modalRegisterCompanyPIC.find('#txtCompanyPICPhoneNumber').val() !== '' && validPassword) {
            $('#divContinueRegisterCompanyPIC').removeClass('btn-not-active');
            $('#btnContinueRegisterCompany').removeAttr("disabled");
        }
        else {
            $('#divContinueRegisterCompanyPIC').addClass('btn-not-active');
            $('#btnContinueRegisterCompany').attr("disabled", "disabled");
        }
    }
    function countdown(expiredAt) {
        authPage.state.timer = setInterval(function () {
            var now = new Date().getTime();
            var distance = new Date(expiredAt) - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            $('#lblVerificationCountdown').html(minutes + ":" + seconds);

            if (distance < 0) {
                clearInterval(authPage.state.timer);
                $('#lblVerificationCountdown').html('EXPIRED');
                $('#send-new-code-register').removeClass('disabled');
            }
        }, 1000);
    }

    function formatCompanyName(state) {
        var $state = state.text;
        if (state.text.indexOf(',') > 0) {
            $state = state.text.substr(0, state.text.indexOf(','));
        }
        return $state;
    };

    $('#txtCompanyName').autoComplete({
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
            $('#txtCompanyName').val(item.data('place'));

            $.getJSON('/place-details', { place_id: item.data('place_id') }, function (response) {
                if (response) {
                    $('#txtCompanyName').val(response.result.name);
                    $('#ddlCompanyPredictionName').val(response.result.name);
                    var addressComp = response.result.address_components;
                    for (var key in addressComp) {
                        if (addressComp[key].types[0] == 'route') {
                            $('#txtCompanyStreet').val(addressComp[key].long_name);
                        } else if (addressComp[key].types[0] == 'street_number') {
                            $('#txtCompanyStreetNo').val(addressComp[key].long_name);
                        } else if (addressComp[key].types[0] == 'administrative_area_level_2') {
                            $('#txtCompanyCity').val(addressComp[key].long_name);
                        } else if (addressComp[key].types[0] == 'administrative_area_level_3') {
                            $('#txtCompanyDistrict').val(addressComp[key].long_name);
                        } else if (addressComp[key].types[0] == 'postal_code') {
                            $('#txtCompanyPostcode').val(addressComp[key].long_name);
                        }
                    }
                    $('#txtCompanyPhoneNumber').val(response.result.formatted_phone_number);
                    $('#txtCompanyWebsite').val(response.result.website);
                    registerCompanyValidation();
                }
            });
        }
    });
});
