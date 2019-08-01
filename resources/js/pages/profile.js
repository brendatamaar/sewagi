$(document).ready(function () {
    $parent = $("#userProfile");
    let userProfile = {
        init: function () {
            this.initState();
            this.select2();
            this.takePicture();
            this.browsePicture();
            this.dateTimePicker();
            this.deletePicture();
            this.moreInformation();
            this.saveInformation();
            this.mainProfile();
            this.getIdentityPicture();
            this.getSelfiePicture();
            this.digitalIdentity();
            this.accountSetting();
            this.legalDocument();
        },
        state: {
            info: {
                hobbies: [],
                lifestyles: [],
                profession: {},
                languages: [],
                emergency_contact: {},
            },
            profile: {
                user_id: '',
                first_name: '',
                last_name: '',
                email: '',
                calling_code: '',
                phone_number: '',
                dob: '',
                gender: '',
                nationality_id: '',
                is_email_notified: 1,
                is_sms_notified: 1,
                is_whatsapp_notified: 1,
                is_newsletter_enabled: 1,
            },
            identity: {
                is_verified_identity: false,
                is_verified_selfie: false,
                is_confirmed_identity: false,
                photo_identity: '',
                photo_selfie: ''
            },
            images: [],
            files: [],
            utils: {
                otp: '',
                company: false,
                reconfirmed: false,
                uploaded_identity: false,
                uploaded_selfie: false,
                can_delete_account: true,
            },
            account: {
                change_password: 0,
                old_password: '',
                new_password: '',
                confirm_password: '',
                invalid_password: 0,
            },
            document: {
                foreign_bank: 0,
            },
            legal: {
                nib: '',
                personal_npwp: '',
                company_npwp: '',
                founder_npwp: '',
                bank_account_holder: '',
                bank_name: '',
                bank_account_number: '',
                foreign_bank: {
                    bank_account_holder: '',
                    currency: '',
                    country: '',
                    city: '',
                    iban: '',
                    beneficiary_name: '',
                    swift_code: '',
                    bank_name: ''
                }
            },
            company: {
                id: '',
                name: '',
                street: '',
                street_no: '',
                detail: '',
                city: '',
                district: '',
                postcode: '',
                phone_number: '',
                website: ''
            },
            social: []
        },
        initState: function () {
            let profile = JSON.parse($('#mainProfile').val());
            let info = JSON.parse($('#description').val());
            let images = JSON.parse($('#userImages').val());
            let document = JSON.parse($('#document').val());
            let files = JSON.parse($('#files').val());
            let company = JSON.parse($('#company').val());
            let social = JSON.parse($('#social').val());

            this.state.utils.can_delete_account = JSON.parse($('#enableDelete').val());

            let user = this.state.profile;
            user.user_id = profile.id;
            user.first_name = profile.first_name;
            user.last_name = profile.last_name;
            user.email = profile.email;
            user.calling_code = profile.calling_code;
            user.phone_number = profile.phone_number;
            user.dob = profile.dob;
            user.gender = profile.gender;
            user.nationality_id = profile.nationality_id;
            user.is_email_notified = profile.is_email_notified;
            user.is_sms_notified = profile.is_sms_notified;
            user.is_whatsapp_notified = profile.is_whatsapp_notified;
            user.is_newsletter_enabled = profile.is_newsletter_enabled;

            let desc = this.state.info;
            if (info) {
                desc.hobbies = info.hobbies || [];
                desc.lifestyles = info.lifestyles || [];
                desc.profession = info.profession || {};
                desc.languages = info.languages || [];
                desc.emergency_contact = info.emergency_contact || {};
            }

            this.state.images = images;
            this.state.social = social;

            let identity = this.state.identity;
            identity.is_verified_identity = profile.is_verified_identity;
            identity.is_verified_selfie = profile.is_verified_selfie;
            identity.is_confirmed_identity = profile.is_confirmed_identity;

            if (document) this.state.legal = document;
            this.state.files = files;
            this.state.company = company;
            this.state.utils.company = profile.company_id ? true : false;

            if (document && document.foreign_bank) {
                $('#foreign-switch').prop('checked', true);
                this.state.document.foreign_bank = 1;
                $('#localBank').hide();
                $('#foreignBank').show();
            } else {
                $('#localBank').show();
                $('#foreignBank').hide();
            }

            $('#verifyAlert').hide();
            if (profile.phone_verified_at) {
                $('#showVerifiedPhone').show();
                $('#btn-verify-phone').hide();
            } else {
                $('#showVerifiedPhone').hide();
                $('#btn-verify-phone').show();
            }

            if (profile.company_id) $('#account-type-switch').prop('checked', true);
            else $('#account-type-switch').prop('checked', false);
        },
        select2: function () {
            let format = function (state) {
                let param = state.element;
                if ($(param).data('img')) {
                    return $("<span><img class='img-square' width='30' src='" + $(param).data('img') + "'/> " + state.text + "</span>");
                }

                return state.text;
            }

            $('#dialCode').select2({
                placeholder: `<img src="../img/flag-indonesia.svg" alt=""> +62`,
                escapeMarkup: function (markup) { return markup; },
                width: '80%',
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
                        return $("<span><img class='img-square' width='30' src='" + $(param).data('img') + "'/> " + $(param).data('code') + "</span>");
                    }

                    return state.text;
                },
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $('#dialCodeModal').select2({
                placeholder: `<img src="../img/flag-indonesia.svg" alt=""> +62`,
                escapeMarkup: function (markup) { return markup; },
                width: '80%',
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
                        return $("<span><img class='img-square' width='30' src='" + $(param).data('img') + "'/> " + $(param).data('code') + "</span>");
                    }

                    return state.text;
                },
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $('#dialCodeEmergency').select2({
                placeholder: `<img src="../img/flag-indonesia.svg" alt=""> +62`,
                escapeMarkup: function (markup) { return markup; },
                width: '80%',
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
                        return $("<span><img class='img-square' width='30' src='" + $(param).data('img') + "'/> " + $(param).data('code') + "</span>");
                    }

                    return state.text;
                },
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            var local_session = $("#locale-session").val();
            $("#gender").select2({
                placeholder: local_session == 'id' ? "Pilih jenis kelamin" : "Select your gender",
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#nationality").select2({
                placeholder: local_session == 'id' ? "Pilih kebangsaan" : "Select your nationality",
                width: '100%',
                templateResult: format,
                templateSelection: format,
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#legalBank").select2({
                placeholder: local_session == 'id' ? "Pilih bank" : "Select bank",
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#legalCurrency").select2({
                placeholder: local_session == 'id' ? "Pilih mata uang" : "Select currency",
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });

            $("#legalCountry").select2({
                placeholder: local_session == 'id' ? "Pilih negara" : "Select country",
                width: '100%',
                containerCssClass: "select2-list-property",
                dropdownCssClass: "select2-list-property-dropdown",
                minimumResultsForSearch: Infinity
            });
        },
        takePicture: function () {
            var player = document.getElementById('player');
            var snapshotCanvas = document.getElementById('snapshot');
            var captureButton = document.getElementById('capture');
            var stopButton = document.getElementById('stop-camera');
            var useCamera = document.getElementById('use-camera');
            var retakeCamera = document.getElementById('retake');
            var submitPic = document.getElementById('submit-picture');
            var videoTracks;

            var handleSuccess = function (stream) {
                player.srcObject = stream;
                videoTracks = stream.getVideoTracks();
            };

            captureButton.addEventListener('click', function () {
                var context = snapshot.getContext('2d');
                context.drawImage(player, 0, 0, snapshotCanvas.width, snapshotCanvas.height);
                snapshotCanvas.style.display = 'block';
                retakeCamera.style.display = 'block';
                captureButton.style.display = 'none';
                submitPic.classList.remove('disabled');
            });

            stopButton.addEventListener('click', function () {
                videoTracks.forEach(function (track) { track.stop() });
            });

            retake.addEventListener('click', function () {
                snapshotCanvas.style.display = 'none';
                retakeCamera.style.display = 'none';
                captureButton.style.display = 'block';
                submitPic.classList.add('disabled');
            });

            useCamera.addEventListener('click', function () {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(handleSuccess);
            });

            submitPic.addEventListener('click', function () {
                const token = document.head.querySelector('meta[name="csrf-token"]');
                const img = new Image();
                img.src = snapshotCanvas.toDataURL();
                $('#profilePic').attr('src', img.src);
                $('#sideProfilePic').attr('src', img.src);
                $('#modalTakePicture').modal('hide');

                fetch('/dashboard/profile/photo', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({ photo: img.src, type: 'avatar' })
                })
                    .then(response => response.json())
                    .then(data => $('#deletePic').attr('disabled', false))
                    .catch(error => console.log(error));
            });
        },
        getIdentityPicture: function () {
            var player = document.getElementById('player2');
            var snapshotCanvas = document.getElementById('snapshot2');
            var captureButton = document.getElementById('capture2');
            var stopButton = document.getElementById('stop-camera2');
            var useCamera = document.getElementById('use-camera2');
            var retakeCamera = document.getElementById('retake2');
            var submitPic = document.getElementById('submit-picture2');
            var videoTracks;

            var handleSuccess = function (stream) {
                player.srcObject = stream;
                videoTracks = stream.getVideoTracks();
                var ctx = snapshot2.getContext('2d');
                ctx.drawImage(player, 0, 0, snapshotCanvas.width, snapshotCanvas.height);
                ctx.globalCompositeOperation = "source-over";
                ctx.lineWidth = 2;
                ctx.setLineDash([5, 3]);
                ctx.strokeStyle = "#f4a142";
                ctx.strokeRect(20, 20, snapshotCanvas.width - 40, snapshotCanvas.height - 75);
            };

            captureButton.addEventListener('click', function () {
                var context = snapshot2.getContext('2d');
                context.drawImage(player, 0, 0, snapshotCanvas.width, snapshotCanvas.height);
                snapshotCanvas.style.display = 'block';
                retakeCamera.style.display = 'block';
                captureButton.style.display = 'none';
                submitPic.classList.remove('disabled');
            });

            stopButton.addEventListener('click', function () {
                videoTracks.forEach(function (track) { track.stop() });
            });

            retake2.addEventListener('click', function () {
                videoTracks.forEach(function (track) { track.stop() });
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function (stream) {
                        player.srcObject = stream;
                        videoTracks = stream.getVideoTracks();
                        var ctx = snapshot2.getContext('2d');
                        ctx.drawImage(player, 0, 0, snapshotCanvas.width, snapshotCanvas.height);
                        ctx.globalCompositeOperation = "source-over";
                        ctx.lineWidth = 2;
                        ctx.setLineDash([5, 3]);
                        ctx.strokeStyle = "#f4a142";
                        ctx.strokeRect(20, 20, snapshotCanvas.width - 40, snapshotCanvas.height - 75);

                        snapshotCanvas.style.display = 'none';
                        retakeCamera.style.display = 'none';
                        captureButton.style.display = 'block';
                        submitPic.classList.add('disabled');
                    });
            });

            useCamera.addEventListener('click', function () {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(handleSuccess);
            });

            submitPic.addEventListener('click', function () {
                const token = document.head.querySelector('meta[name="csrf-token"]');
                let utils = userProfile.state.utils;
                const img = new Image();
                img.src = snapshotCanvas.toDataURL();

                fetch('/dashboard/profile/photo', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({ photo: img.src, type: 'identity' })
                })
                    .then(response => response.json())
                    .then(data => {
                        let photo = data.data.find(q => q.thumbnail === 'medium');

                        utils.uploaded_identity = true;
                        if (utils.reconfirmed) {
                            $('#reSrcPhotoIdentity').attr('src', photo.url);
                            $('#reAddPhotoIdentity').hide();
                            $('#reStatusPhotoIdentity').empty();
                        } else {
                            $('#srcPhotoIdentity').attr('src', photo.url);
                            $('#addPhotoIdentity').hide();
                        }

                        if (utils.uploaded_identity && utils.uploaded_selfie) {
                            $('.btnConfirmIdentity').removeClass('disabled');
                        }

                        $('.remove-photo[data-type="identity"]').data('id', photo.id);
                        $('#modalTakePicture2').modal('hide');
                        $('#photoIdentity').show();
                    })
                    .catch(error => console.log(error));
            });
        },
        getSelfiePicture: function () {
            var player = document.getElementById('player3');
            var snapshotCanvas = document.getElementById('snapshot3');
            var captureButton = document.getElementById('capture3');
            var stopButton = document.getElementById('stop-camera3');
            var useCamera = document.getElementById('use-camera3');
            var retakeCamera = document.getElementById('retake3');
            var submitPic = document.getElementById('submit-picture3');
            var videoTracks;

            var handleSuccess = function (stream) {
                player.srcObject = stream;
                videoTracks = stream.getVideoTracks();
                var context = snapshot3.getContext('2d');
                var cX = 0;
                var cY = 0;
                var radius = 40;

                context.save();
                context.translate(snapshotCanvas.width / 2, snapshotCanvas.height / 2);
                context.scale(2, 2.4);
                context.beginPath();
                context.arc(cX, cY, radius, 0, 2 * Math.PI, false);
                context.restore();
                context.lineWidth = 2;
                context.strokeStyle = 'yellow';
                context.stroke();
            };

            captureButton.addEventListener('click', function () {
                var context = snapshot3.getContext('2d');
                context.drawImage(player, 0, 0, snapshotCanvas.width, snapshotCanvas.height);
                snapshotCanvas.style.display = 'block';
                retakeCamera.style.display = 'block';
                captureButton.style.display = 'none';
                submitPic.classList.remove('disabled');
            });

            stopButton.addEventListener('click', function () {
                videoTracks.forEach(function (track) { track.stop() });
            });

            retake3.addEventListener('click', function () {
                snapshotCanvas.style.display = 'none';
                retakeCamera.style.display = 'none';
                captureButton.style.display = 'block';
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(handleSuccess);
                submitPic.classList.add('disabled');
            });

            useCamera.addEventListener('click', function () {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(handleSuccess);
            });

            submitPic.addEventListener('click', function () {
                const token = document.head.querySelector('meta[name="csrf-token"]');
                let utils = userProfile.state.utils;
                const img = new Image();
                img.src = snapshotCanvas.toDataURL();

                fetch('/dashboard/profile/photo', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({ photo: img.src, type: 'selfie' })
                })
                    .then(response => response.json())
                    .then(data => {
                        let photo = data.data.find(q => q.thumbnail === 'medium');

                        utils.uploaded_selfie = true;
                        const size = photo.size / 1048576;
                        if (utils.reconfirmed) {
                            $('#reSrcPhotoSelfie').attr('src', photo.file_name);
                            $('#reSizePhotoSelfie').text(size.toFixed(2));
                            $('#reAddPhotoSelfie').hide();
                            $('#reStatusPhotoSelfie').empty();
                        } else {
                            $('#srcPhotoSelfie').attr('src', photo.file_name);
                            $('#sizePhotoSelfie').text(size.toFixed(2));
                            $('#addPhotoSelfie').hide();
                        }

                        if (utils.uploaded_identity && utils.uploaded_selfie) {
                            $('.btnConfirmIdentity').removeClass('disabled');
                        }

                        $('.remove-photo[data-type="selfie"]').data('id', photo.id);
                        $('#modalTakePicture3').modal('hide');
                        $('#photoSelfie').show();
                    })
                    .catch(error => console.log(error));
            });
        },
        browsePicture: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            $('.browse-picture').change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profilePic').attr('src', e.target.result);
                        $('#sideProfilePic').attr('src', e.target.result);

                        fetch('/dashboard/profile/photo', {
                            method: 'post',
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': token.content
                            },
                            body: JSON.stringify({ photo: e.target.result })
                        })
                            .then(response => response.json())
                            .then(data => $('#deletePic').attr('disabled', false))
                            .catch(error => console.log(error));
                    }

                    reader.readAsDataURL(this.files[0]);
                }
                $('#modalAddPicture').modal('hide');
            });
        },
        dateTimePicker: function () {
            $('#date-picker').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        },
        deletePicture: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            $('#deletePic').click(function () {
                fetch('/dashboard/profile/photo', {
                    method: 'delete',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#profilePic').attr('src', '../img/dashboard/profile-pic.png');
                        $('#deletePic').attr('disabled', true);
                    })
                    .catch(error => console.log(error));
            });
        },
        moreInformation: function () {
            $('#btn-add-description').attr('disabled', true);
            const { hobbies, lifestyles, profession, languages } = this.state.info;

            hobbies.forEach(q => {
                $(`.more-info[data-type="hobbies"][data-id=${q.id}]`).parent().addClass('active');
                $(`.more-info[data-type="hobbies"][data-id=${q.id}]`).prop('checked', true);
            })

            lifestyles.forEach(q => {
                $(`.more-info[data-type="lifestyles"][data-id=${q.id}]`).parent().addClass('active');
                $(`.more-info[data-type="lifestyles"][data-id=${q.id}]`).prop('checked', true);
            })

            languages.forEach(q => {
                $(`.more-info[data-type="languages"][data-id=${q.id}]`).prop('checked', true);
            })

            $(`.more-info[data-type="profession"][data-id=${profession.id}]`).parent().addClass('active');

            $(document).on('change', '.more-info', function () {
                let type = $(this).data('type');
                let name = $(this).data('name');
                let id = $(this).data('id');
                let checked = $(this).prop('checked');
                let { hobbies, lifestyles, languages, profession } = userProfile.state.info;

                if (type === 'hobbies' && checked) hobbies.push({ id, name });
                if (type === 'hobbies' && !checked) hobbies.splice(hobbies.indexOf({ id, name }), 1);
                if (type === 'lifestyles' && checked) lifestyles.push({ id, name });
                if (type === 'lifestyles' && !checked) lifestyles.splice(lifestyles.indexOf({ id, name }), 1);
                if (type === 'languages' && checked) languages.push({ id, name });
                if (type === 'languages' && !checked) languages.splice(languages.indexOf({ id, name }), 1);
                if (type === 'profession' && checked) userProfile.state.info.profession = { id, name };
                if (type === 'profession' && !checked) userProfile.state.info.profession = profession || {};

                let disableLang = languages.length ? false : true;
                let disableDesc = hobbies.length && lifestyles.length && !jQuery.isEmptyObject(profession) ? false : true;
                $('#btn-add-language').attr('disabled', disableLang);
                $('#btn-add-description').attr('disabled', disableDesc);
            });

            $('#btn-add-contact').click(function () {
                $('#modalAddEmergency').modal('show');
                $('#dialCodeEmergency').val(userProfile.state.info.emergency_contact.code).trigger('change');
            });
        },
        saveInformation: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            $('#btn-add-description').click(function () {
                fetch('/dashboard/profile/information', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify(userProfile.state.info)
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#hobbiesData').empty();
                        $('#lifestylesData').empty();
                        $('#professionData').empty();

                        let hobbies = lifestyles = profession = '';
                        data.hobbies.forEach((q, i) => {
                            hobbies += q.name;
                            if (i !== (data.hobbies.length - 1)) hobbies += `<span class="dot"></span>`;
                        })
                        data.lifestyles.forEach((q, i) => {
                            lifestyles += q.name;
                            if (i !== (data.lifestyles.length - 1)) lifestyles += `<span class="dot"></span>`;
                        })
                        $('#hobbiesData').html(hobbies);
                        $('#lifestylesData').html(lifestyles);
                        $('#professionData').text(data.profession.name);

                        $('#modalAddDescription').modal('hide');
                    })
                    .catch(error => console.log(error));
            });

            $('#btn-add-language').click(function () {
                fetch('/dashboard/profile/information', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify(userProfile.state.info)
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#languagesData').empty();

                        let languages = '';
                        data.languages.forEach((q, i) => {
                            languages += q.name;
                            if (i !== (data.languages.length - 1)) languages += `<span class="dot"></span>`;
                        })

                        if (data.languages.length) {
                            $('#emptyLanguage').hide();
                        } else {
                            $('#emptyLanguage').show();
                        }

                        $('#languagesData').html(languages);

                        $('#modalAddLang').modal('hide');
                    })
                    .catch(error => console.log(error));
            });

            $('#btn-add-emergency').click(function () {
                let emergency = {};
                $('.emergency-contact').each(function () {
                    const name = $(this).attr('name');
                    const value = $(this).val();

                    emergency[name.substring(2)] = value;
                });
                userProfile.state.info.emergency_contact = emergency;

                fetch('/dashboard/profile/information', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify(userProfile.state.info)
                })
                    .then(response => response.json())
                    .then(data => {
                        const contact = data.emergency_contact;

                        if (jQuery.isEmptyObject(contact)) {
                            $('#emptyEmergency').css('display', 'block');
                            $('#emergencyData').hide();
                        } else {
                            $('#emptyEmergency').css('display', 'none');
                            $('#emergencyData').show();
                            $('#ec_fullname').text(contact.firstname + ' ' + contact.lastname);
                            $('#ec_phone').text(contact.code + ' ' + contact.phone);
                            $('#ec_email').text(contact.email);
                            $('#ec_relationship').text(contact.relationship);
                        }

                        $('#modalAddEmergency').modal('hide');
                    })
                    .catch(error => console.log(error));
            });
        },
        mainProfile: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            let state = this.state.profile;
            $('#gender').on("select2:select", function (e) {
                state.gender = $(this).val();
                userProfile.updateProfile();
            });

            $('#nationality').on("select2:select", function (e) {
                state.nationality_id = $(this).val();
                userProfile.updateProfile();
            });

            $('input[name="first_name"]').blur(function () {
                state.first_name = $(this).val();
                userProfile.updateProfile();
            });

            $('input[name="last_name"]').blur(function () {
                state.last_name = $(this).val();
                userProfile.updateProfile();
            });

            $('input[name="new_email"]').keyup(function () {
                $('#btn-new-email').removeClass('disabled');
            });

            $('#btn-verify-email').click(function () {
                $('#verifyAlert').show();
            });

            $('#dialCodeModal').on("select2:select", function (e) {
                state.calling_code = $(this).val();
            });

            $('input[name="new_phone"]').keyup(function () {
                $('#btn-new-phone').removeClass('disabled');
                let newphone = $('input[name="new_phone"]').val().replace(/^0+/, '');
                $('input[name="new_phone"]').val(newphone);
            });

            $('#date-picker').on('change.datetimepicker', function (e) {
                $('#btn-new-dob').removeClass('disabled');
                state.dob = $('input[name="new_dob"]').val();
            });

            $('#btn-new-dob').click(function () {
                $('#modalChangeBirthday').modal('hide');
                userProfile.updateProfile();
            })

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
                    $('#btn-verify-otp').removeClass('disabled');
                    userProfile.state.utils.otp = parseInt(otpNumber);
                }
            });

            $('#btn-verify-otp').click(function () {
                const params = {
                    code: userProfile.state.utils.otp,
                    phone: userProfile.state.profile.phone_number
                }

                fetch('/verify-phone-number', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify(params)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            const phone = userProfile.state.profile.phone_number;
                            const newPhone = phone.substr(phone.length - 3);
                            $('#cantVerifyPhone').text(newPhone);
                            $('#modalUnableVerification').modal('show');
                        } else {
                            $('#modalVerification').modal('hide');
                            $('#showVerifiedPhone').show();
                            $('#btn-verify-phone').hide();
                            userProfile.normalizeOtpForm();
                        }
                    })
                    .catch(error => console.log(error));
            });

            $('#changePhoneNumber').click(function () {
                userProfile.normalizeOtpForm();
                $('input[name="new_phone"]').val('');
                $('#btn-new-phone').addClass('disabled');
                $('#modalUnableVerification').modal('hide');
                $('#modalNewPhoneNumber').modal('show');
            });

            $('.btn-resend-otp').click(function () {
                fetch('/resend-verification-code', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({ user_id: userProfile.state.profile.user_id })
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#modalUnableVerification').modal('hide');
                        $('#modalVerification').modal('show');

                        const phone = userProfile.state.profile.phone_number;
                        const newPhone = phone.substr(phone.length - 3);
                        $('#maskingNumber').text(newPhone);

                        userProfile.normalizeOtpForm();
                        userProfile.otpTimer(data.verification_code.expired_at);
                    })
                    .catch(error => console.log(error));
            });

            $('#btn-new-email').click(function (e) {
                const newEmail = $('input[name="new_email"]').val();
                const validate = (email) => {
                    const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    return regex.test(email);
                }

                if (validate(newEmail)) {
                    userProfile.state.profile.email = newEmail;
                    $('#modalEmailSent').modal('show');
                    $('#newMailSent').text(newEmail);

                    fetch('/dashboard/profile/email', {
                        method: 'put',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': token.content
                        },
                        body: JSON.stringify({ email: userProfile.state.profile.email })
                    })
                        .then(response => response.json())
                        .then(data => {
                            $('input[name="oldmail"]').val(data.data.email);
                        })
                        .catch(error => console.log(error));
                }
            });

            $('#btn-new-phone').click(function (e) {
                const newPhone = $('input[name="new_phone"]').val();
                $('#maskingNumber').text(newPhone.substr(newPhone.length - 3));

                userProfile.state.profile.phone_number = newPhone;
                $('#modalVerification').modal('show');
                userProfile.normalizeOtpForm();

                let timeout = new Date();
                timeout.setMinutes(timeout.getMinutes() + 1);
                timeout = new Date(timeout);
                userProfile.otpTimer(timeout);

                fetch('/dashboard/profile/phone', {
                    method: 'put',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({
                        calling_code: userProfile.state.profile.calling_code,
                        phone_number: userProfile.state.profile.phone_number
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#showVerifiedPhone').hide();
                        $('#btn-verify-phone').show();
                        $('input[name="oldphone"]').val(data.data.phone_number);
                        $('#dialCode').val(data.data.calling_code).trigger('change');
                    })
                    .catch(error => console.log(error));
            });
        },
        normalizeOtpForm: function () {
            $('.otp-form').each(function () {
                $(this).val('');
            });
            $('#btn-verify-otp').addClass('disabled');
            $('#btn-resend-code-1').addClass('disabled');
        },
        otpTimer: function (expiredAt) {
            var x = setInterval(function () {
                var now = new Date().getTime();
                var distance = new Date(expiredAt) - now;
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                $('#otp-timeout').html(minutes + ":" + seconds);

                if (distance < 0) {
                    clearInterval(x);
                    $('#otp-timeout').text('00:00');
                    $('#btn-resend-code-1').removeClass('disabled');
                }
            }, 1000);
        },
        updateProfile: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            fetch('/dashboard/profile', {
                method: 'put',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token.content
                },
                body: JSON.stringify(userProfile.state.profile)
            })
                .then(response => response.json())
                .then(data => {
                    $('#sideFullname').text(data.first_name + ' ' + data.last_name);
                    $('#oldbirthdate').val(data.dob);
                })
                .catch(error => console.log(error));
        },
        digitalIdentity: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            const images = this.state.images;
            const identity = this.state.identity;

            const photoIdentity = images.find(q => q.type === 'identity' && q.thumbnail === 'medium');
            const photoSelfie = images.find(q => q.type === 'selfie' && q.thumbnail === 'medium');

            identity.photo_identity = photoIdentity ? photoIdentity.url : '';
            identity.photo_selfie = photoSelfie ? photoSelfie.url : '';

            $('#processingIdentity').hide();
            $('#confirmedIdentity').hide();
            $('#reconfirmedIdentity').hide();
            $('#reverification').hide();

            if (photoIdentity && photoSelfie && !identity.is_confirmed_identity) {
                $('.btnConfirmIdentity').removeClass('disabled');
            }

            if (identity.is_confirmed_identity) {
                $('#unconfirmedIdentity').hide();
                $('#confirmedIdentity').show();
                if (identity.is_verified_identity && identity.is_verified_selfie) {
                    let tmpl = document.getElementById('verified').content.cloneNode(true);
                    document.getElementById('identityStat').append(tmpl);
                    let tmpl1 = document.getElementById('verified').content.cloneNode(true);
                    document.getElementById('selfieStat').append(tmpl1);
                } else {
                    this.state.utils.reconfirmed = true;

                    const tmpl = document.getElementById('unverified').content.cloneNode(true);
                    const tmpl1 = document.getElementById('unverified').content.cloneNode(true);
                    const tmpl2 = document.getElementById('unverified').content.cloneNode(true);
                    const tmpl3 = document.getElementById('unverified').content.cloneNode(true);

                    document.getElementById('identityStat').append(tmpl);
                    document.getElementById('selfieStat').append(tmpl1);
                    document.getElementById('reStatusPhotoIdentity').append(tmpl2);
                    document.getElementById('reStatusPhotoSelfie').append(tmpl3);

                    $('#confirmedTitle').text('Confirm Profile');
                    $('#confirmedStat').text('"Oops! Something didn’t match"');
                    $('#reverification').show();

                    $('#reSrcPhotoIdentity').attr('src', photoIdentity.url);
                    $('.remove-photo[data-type="identity"]').data('id', photoIdentity.id);

                    const size = photoSelfie.size / 1048576;
                    $('#reSrcPhotoSelfie').text(photoSelfie.file_name);
                    $('#reSizePhotoSelfie').text(size.toFixed(2));
                    $('.remove-photo[data-type="selfie"]').data('id', photoSelfie.id);
                }
            }

            if (photoIdentity) {
                $('#addPhotoIdentity').hide();
                $('#srcPhotoIdentity').attr('src', photoIdentity.url);
                $('.remove-photo[data-type="identity"]').data('id', photoIdentity.id);
            } else {
                $('#photoIdentity').hide();
            }

            if (photoSelfie) {
                const size = photoSelfie.size / 1048576;
                $('#addPhotoSelfie').hide();
                $('#srcPhotoSelfie').text(photoSelfie.file_name);
                $('#sizePhotoSelfie').text(size.toFixed(2));
                $('.remove-photo[data-type="selfie"]').data('id', photoSelfie.id);
            } else {
                $('#photoSelfie').hide();
            }

            $('.remove-photo').click(function () {
                const id = $(this).data('id');
                const type = $(this).data('type');

                fetch(`/dashboard/profile/identity/${id}`, {
                    method: 'delete',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            $(`.remove-photo[data-type="${type}"]`).parent().hide();
                            $(`a[data-type="${type}"`).show();
                        }
                    })
                    .catch(error => console.log(error));
            })

            $('.btnConfirmIdentity').click(function () {
                $('#processingIdentity').show();
                $('#unconfirmedIdentity').hide();
                $('#reconfirmedIdentity').hide();

                const params = {
                    ktp: identity.photo_identity,
                    selfie: identity.photo_selfie,
                }

                fetch('/dashboard/profile/verify-identity', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify(params)
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#processingIdentity').hide();
                        $('#confirmedIdentity').show();
                        $('#identityStat').empty();
                        $('#selfieStat').empty();
                        if (data.status) {
                            let tmpl = document.getElementById('verified').content.cloneNode(true);
                            document.getElementById('identityStat').append(tmpl);
                            let tmpl1 = document.getElementById('verified').content.cloneNode(true);
                            document.getElementById('selfieStat').append(tmpl1);

                            $('#confirmedTitle').text('Profile Confirmed');
                            $('#confirmedStat').text('“Your digital ID is all set!”');
                            $('#reverification').hide();
                        } else {
                            let tmpl = document.getElementById('unverified').content.cloneNode(true);
                            document.getElementById('identityStat').append(tmpl);
                            let tmpl1 = document.getElementById('unverified').content.cloneNode(true);
                            document.getElementById('selfieStat').append(tmpl1);

                            $('#confirmedTitle').text('Confirm Profile');
                            $('#confirmedStat').text('"Oops! Something didn’t match"');
                            $('#reverification').show();
                        }
                    })
                    .catch(error => console.log(error));
            })

            $('#btnReverification').click(function () {
                let utils = userProfile.state.utils;
                utils.uploaded_identity = false;
                utils.uploaded_selfie = false;

                $('#confirmedIdentity').hide();
                $('#reconfirmedIdentity').show();
            })
        },
        accountSetting: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            let user = this.state.profile;
            let state = this.state.account;
            let social = this.state.social;
            $('#changePassword').hide();
            $('#updatedPassword').hide();
            $('#invalidOldPassword').hide();
            $('#invalidNewPassword').hide();
            $('#passwordHint').hide();

            ['google', 'facebook', 'linkedin'].forEach(provider => {
                const account = social.find(q => q.provider === provider);
                if (account) {
                    $(`#sa-${provider}-ok`).show();
                    $(`#sa-${provider}-connect`).hide();
                } else {
                    $(`#sa-${provider}-ok`).hide();
                    $(`#sa-${provider}-connect`).show();
                }
            })

            const notification = ['is_email_notified', 'is_sms_notified', 'is_whatsapp_notified', 'is_newsletter_enabled'];

            notification.forEach(notif => {
                $(`input[data-name="${notif}"]`).prop('checked', user[notif]);
            });

            $(`input[data-type="notification"]`).change(function () {
                const minNotif = notification.slice(0,3).filter(q => $(`input[data-type="notification"][data-name="${q}"]`).prop('checked') === true);
                if (minNotif.length > 0) {
                    user[$(this).data('name')] = $(this).prop('checked');
                    userProfile.updateProfile();
                } else {
                    $(this).prop('checked', user[$(this).data('name')]);
                    $('#modalToggleWarning').modal('show');
                }
            })

            $('#toggleChangePassword').click(function () {
                var local_session = $("#locale-session").val();
                if (state.change_password) {
                    state.change_password = 0;


                    $('#changePassword').slideUp(500);
                    $('#toggleChangePassword').text(local_session == 'id' ? "Sunting" : "Edit");
                } else {
                    state.change_password = 1;
                    $('#changePassword').slideDown(500);
                    $('#toggleChangePassword').text(local_session == 'id' ? "Tutup" : "Close");
                }
            })

            const closeChangePassword = () => {
                state.change_password = 0;
                var local_session = $("#locale-session").val();
                $('#changePassword').slideUp(500);
                $('#toggleChangePassword').text(local_session == 'id' ? "Sunting" : "Edit");
            }

            const validatePassword = (text) => /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9-]{6,})$/.test(text);

            $('#btnForgotPhone').click(function () {
                fetch('/forgot-password-phone-number', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({ phone_number: user.phone_number })
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#modalForgotPassword').modal('hide');
                        $('#lblForgotPhone').text(`${user.calling_code}${user.phone_number}`);
                        $('#modalForgotSMSSent').modal('show');
                        closeChangePassword();
                    })
                    .catch(error => console.log(error));
            });

            $('#btnForgotEmail').click(function () {
                $('#modalForgotPassword').modal('hide');
                $('#lblForgotEmail').text(`${user.email}`);
                $('#modalForgotEmailSent').modal('show');
                closeChangePassword();
            });

            $('input[name="old_password"]').blur(function () {
                if ($(this).val() === '') {
                    $('input[name="old_password"]').removeClass('is-invalid');
                    $('#invalidOldPassword').removeClass('invalid-feedback d-flex').hide();
                } else {
                    fetch('/check-password', {
                        method: 'post',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': token.content
                        },
                        body: JSON.stringify({ password: $(this).val() })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                state.invalid_password = false;
                                state.old_password = $(this).val();
                                $(this).removeClass('is-invalid');
                                $('#invalidOldPassword').removeClass('invalid-feedback d-flex').hide();
                            } else {
                                state.invalid_password = true;
                                $(this).addClass('is-invalid');
                                $('#invalidOldPassword').addClass('invalid-feedback d-flex').show();
                            }
                        })
                        .catch(error => console.log(error));
                }
            });

            $('input[name="new_password"]').focus(function () {
                if (state.old_password) {
                    $('#passwordHint').show();
                }
            });

            const showErrorPassword = () => {
                $('input[name="new_password"]').addClass('is-invalid');
                $('input[name="confirm_password"]').addClass('is-invalid');
                $('#invalidNewPassword').addClass('invalid-feedback d-flex');
            }

            const hideErrorPassword = () => {
                $('input[name="new_password"]').removeClass('is-invalid');
                $('input[name="confirm_password"]').removeClass('is-invalid');
                $('#invalidNewPassword').removeClass('invalid-feedback d-flex');
            }

            $('input[name="new_password"]').keyup(function () {
                if ($(this).val() !== '') {
                    state.new_password = $(this).val();
                    if (validatePassword($(this).val())) {
                        if ($(this).val() === state.confirm_password) {
                            state.invalid_password = false;
                            hideErrorPassword();
                        } else {
                            showErrorPassword();
                        }
                    } else {
                        state.invalid_password = true;
                        if ($(this).val() === state.confirm_password) {
                            $('#passwordHint').show();
                            hideErrorPassword();
                        } else {
                            showErrorPassword();
                        }
                    }
                } else {
                    state.invalid_password = true;
                    showErrorPassword();
                }
            });

            $('input[name="confirm_password"]').keyup(function () {
                if ($(this).val() !== '') {
                    state.confirm_password = $(this).val();
                    if (validatePassword($(this).val())) {
                        if (state.new_password === $(this).val()) {
                            state.invalid_password = false;
                            hideErrorPassword();
                        } else {
                            state.invalid_password = true;
                            showErrorPassword();
                        }
                    } else {
                        state.invalid_password = true;
                        if ($(this).val() === state.new_password) {
                            $('#passwordHint').show();
                            hideErrorPassword();
                        } else {
                            showErrorPassword();
                        }
                    }
                } else {
                    state.invalid_password = true;
                    showErrorPassword();
                }
            });

            $('input[name="confirm_password"]').blur(function () {
                if (state.new_password === state.confirm_password && state.old_password !== '') {
                    if (state.invalid_password) {
                        $('#passwordHint').show();
                        $('#btnChangePassword').addClass('disabled');
                    } else {
                        $('#passwordHint').hide();
                        $('#btnChangePassword').removeClass('disabled');
                        hideErrorPassword();
                    }
                } else {
                    $('#btnChangePassword').addClass('disabled');
                    if (state.old_password === '') {
                        $('input[name="old_password"]').removeClass('is-invalid');
                        $('#invalidOldPassword').addClass('invalid-feedback d-flex').show();
                    } else {
                        showErrorPassword();
                    }
                }
            });

            $('#btnChangePassword').click(function () {
                fetch('/dashboard/profile/password', {
                    method: 'put',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({ new_password: state.new_password, confirm_password: state.confirm_password })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            closeChangePassword();
                            $('#passwordHint').hide();
                            $('#updatedPassword').show();

                            $('input[data-type="password"]').each(function () {
                                $(this).val('');
                                let name = $(this).attr('name');
                                state[name] = '';
                            });

                            setTimeout(function () {
                                $('#updatedPassword').hide();
                            }, 5000);
                        }
                    })
                    .catch(error => console.log(error));
            })

            $('#deleteAccount').click(function() {
                const canDelete = userProfile.state.utils.can_delete_account;

                if (canDelete) {
                    $('#modalDeleteAccount').modal('show');
                } else {
                    $('#modalCantDeleteAccount').modal('show');
                }
            })

            $('#confirmedDeleteAccount').click(function() {
                fetch('/dashboard/deactivate-account', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                    body: JSON.stringify({})
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#modalThankYouAccount').modal('hide');
                        window.location.href = '/logout';
                    })
                    .catch(error => console.log(error));
            })
        },
        legalDocument: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            let user = this.state.profile;
            let state = this.state.document;
            let legal = this.state.legal;
            let docs = this.state.files;
            let company = this.state.company;
            let foreignBank = this.state.legal.foreign_bank;

            let legalDocsCompany = ['certificate', 'nib', 'company_npwp', 'founder_npwp', 'pkp'];
            let legalDocsPersonal = ['personal_npwp', 'stay_permit', 'kartu_keluarga'];

            if (this.state.utils.company) {
                legalDocsCompany.forEach(doc => {
                    const data = docs.find(q => q.type === doc);
                    if (data) {
                        $(`input[data-name="${doc}"]`).parent().hide();
                        let tmpl = document.getElementById('uploadedDocs').content.cloneNode(true);
                        tmpl.querySelector('.docs-name').innerText = data.file_name;
                        tmpl.querySelector('.docs-size').innerText = (data.size / 1048576).toFixed(2);
                        tmpl.querySelector('.remove-docs').setAttribute('data-id', data.id);
                        tmpl.querySelector('.remove-docs').setAttribute('data-type', data.type);
                        document.getElementById(`docs-${doc}`).append(tmpl);
                    } else {
                        $(`input[data-name="${doc}"]`).parent().show();
                        $(`#docs-${doc}`).hide();
                    }
                });
            } else {
                legalDocsPersonal.forEach(doc => {
                    const data = docs.find(q => q.type === doc);
                    if (data) {
                        $(`input[data-name="${doc}"]`).parent().hide();
                        let tmpl = document.getElementById('uploadedDocs').content.cloneNode(true);
                        tmpl.querySelector('.docs-name').innerText = data.file_name;
                        tmpl.querySelector('.docs-size').innerText = (data.size / 1048576).toFixed(2);
                        tmpl.querySelector('.remove-docs').setAttribute('data-id', data.fileable_id);
                        tmpl.querySelector('.remove-docs').setAttribute('data-type', data.type);
                        document.getElementById(`docs-${doc}`).append(tmpl);
                    } else {
                        $(`input[data-name="${doc}"]`).parent().show();
                        $(`#docs-${doc}`).hide();
                    }
                });
            }

            $('input[data-type="legal"]').each(function () {
                $(this).val(legal[$(this).attr('name')]);
            });

            $('input[data-type="local"]').each(function () {
                $(this).val(legal[$(this).attr('name')]);
            });

            if (legal.bank_name) $('#legalBank').val(legal.bank_name).trigger('change');

            if (state.foreign_bank) {
                $('input[data-type="foreign"]').each(function () {
                    $(this).val(foreignBank[$(this).attr('name')]);
                });
                $('#legalCountry').val(legal.foreign_bank.country).trigger('change');
                $('#legalCurrency').val(legal.foreign_bank.currency).trigger('change');
            }

            $('input[data-type="company"]').each(function () {
                $(this).val(company[$(this).attr('name')]);
            })

            $('#foreign-switch').change(function () {
                if ($(this).prop('checked')) {
                    state.foreign_bank = 1;
                    $('#localBank').slideUp(500);
                    $('#foreignBank').slideDown(500);
                } else {
                    state.foreign_bank = 0;
                    $('#localBank').slideDown(500);
                    $('#foreignBank').slideUp(500);
                }
            })

            $('input:file').change(function (e) {
                const type = $(this).data('name');

                const data = new FormData();
                data.append('file', e.target.files[0]);
                data.append('type', type);

                fetch('/dashboard/profile/document', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': token.content
                    },
                    body: data
                })
                    .then(response => response.json())
                    .then(data => {
                        $(this).parent().hide();
                        let tmpl = document.getElementById('uploadedDocs').content.cloneNode(true);
                        tmpl.querySelector('.docs-name').innerText = data.data.file_name;
                        tmpl.querySelector('.docs-size').innerText = (data.data.size / 1048576).toFixed(2);
                        tmpl.querySelector('.remove-docs').setAttribute('data-id', data.data.fileable_id);
                        tmpl.querySelector('.remove-docs').setAttribute('data-type', data.data.type);
                        document.getElementById(`docs-${type}`).append(tmpl);
                        $(`#docs-${type}`).show();
                    })
                    .catch(error => console.log(error));
            });

            $('.remove-docs').click(function () {
                const id = $(this).data('id');
                const type = $(this).data('type');

                fetch(`/dashboard/profile/document/${id}`, {
                    method: 'delete',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': token.content
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            $(`input[data-name="${type}"]`).parent().show();
                            $(`#docs-${type}`).hide();
                        }
                    })
                    .catch(error => console.log(error));
            })

            $('input[data-type="legal"]').blur(function () {
                legal[$(this).attr('name')] = $(this).val();
                userProfile.saveLegalDocument();
            });

            $('input[data-type="local"]').blur(function () {
                legal[$(this).attr('name')] = $(this).val();
                userProfile.saveLegalDocument();
            });

            $('input[data-type="foreign"]').blur(function () {
                foreignBank[$(this).attr('name')] = $(this).val();
                userProfile.saveLegalDocument();
            });

            $('#legalBank').on("select2:select", function (e) {
                legal.bank_name = $(this).val();
                userProfile.saveLegalDocument();
            });

            $('#legalCountry').on("select2:select", function (e) {
                legal.foreign_bank.country = $(this).val();
                userProfile.saveLegalDocument();
            });

            $('#legalCurrency').on("select2:select", function (e) {
                legal.foreign_bank.currency = $(this).val();
                userProfile.saveLegalDocument();
            });

            $('input[data-type="company"]').blur(function () {
                company[$(this).attr('name')] = $(this).val();
                userProfile.saveCompanyData();
            });

            $('#companyLocation').autoComplete({
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
                    $.getJSON('/place-details', { place_id: item.data('place_id') }, function (data) {
                        const addressComp = data.result.address_components;
                        for (let key in addressComp) {
                            if (addressComp[key].types[0] == 'route') {
                                $('input[data-name="street"]').val(addressComp[key].long_name);
                                company.street = addressComp[key].long_name;
                            } else if (addressComp[key].types[0] == 'street_number') {
                                $('input[data-name="street_no"]').val(addressComp[key].long_name);
                                company.street_no = addressComp[key].long_name;
                            } else if (addressComp[key].types[0] == 'administrative_area_level_2') {
                                $('input[data-name="city"]').val(addressComp[key].long_name);
                                company.city = addressComp[key].long_name;
                            } else if (addressComp[key].types[0] == 'administrative_area_level_3') {
                                $('input[data-name="district"]').val(addressComp[key].long_name);
                                company.district = addressComp[key].long_name;
                            } else if (addressComp[key].types[0] == 'postal_code') {
                                $('input[data-name="postcode"]').val(addressComp[key].long_name);
                                company.postcode = addressComp[key].long_name;
                            }
                        }
                    });
                }
            });
        },
        saveLegalDocument: function () {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            let params = userProfile.state.legal;
            if (userProfile.state.document.foreign_bank) {
                params.bank_account_holder = null;
                params.bank_account_number = null;
                params.bank_name = null;
            } else {
                params.foreign_bank = null;
            }

            fetch('/dashboard/profile/legal', {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token.content
                },
                body: JSON.stringify(params)
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => console.log(error));
        },
        saveCompanyData: function() {
            const token = document.head.querySelector('meta[name="csrf-token"]');
            fetch('/dashboard/profile/company', {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token.content
                },
                body: JSON.stringify(userProfile.state.company)
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => console.log(error));
        }
    }
    if ($parent.length) {
        userProfile.init();
    }
});
