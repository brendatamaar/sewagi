<div class="row mb-5" id="unconfirmedIdentity">
    <div class="col-md-8">
        <h3 class="py-4">{{ session('locale') =='id' ? 'Konfirmasi profil' : 'Confirm profile' }}</h3>
        <p>{{ getLocale($locale_user_profile, 'label-digital-identity-1', "To keep Sewagi secure, enable digital contract signatures and process installment requests, we’ll
            need you to provide us with a picture of your") }} <strong>{{ session('locale') =='id' ? 'KTP' : 'ID' }}</strong> {{ session('locale') =='id' ? 'dan sebuah' : 'and a' }} <strong>{{ session('locale') =='id' ? 'Swafoto' : 'Selfie' }} </strong>.
            {{ getLocale($locale_user_profile, 'label-digital-identity-2', "Your digital identity and all related documents are classified and protected. We won’t be
            communicating them to any third party without your consent") }}</p>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between">
                <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-digital-identity-3', "IDENTITY DOCUMENT") }}</label>
                <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                    data-target="#modalAddPicture2" data-type="identity" id="addPhotoIdentity">+ {{ session('locale') =='id' ? 'Tambahkan foto dokumen' : 'Add document photo' }}</a>
            </div>
            <p>{{ getLocale($locale_user_profile, 'label-digital-identity-4', "Upload your identity card/passport") }}</p>
            <div class="doc-wrap" id="photoIdentity">
                <button type="button" class="close remove-photo" data-type="identity" data-dismiss="modal"
                    aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <img class="id-card" id="srcPhotoIdentity" src="../img/ktp.jpg" alt="">
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between">
                <label class="text-muted required">{{ session('locale') =='id' ? 'FOTO' : 'PHOTO' }} </label>
                <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                    data-target="#modalAddPicture3" data-type="selfie" id="addPhotoSelfie">+ {{ session('locale') =='id' ? 'Tambahkan foto dokumen' : 'Add document photo' }}</a>
            </div>
            <p>{{ getLocale($locale_user_profile, 'label-digital-identity-5', "Upload your selfie / current photo") }}</p>
            <div class="doc-wrap" id="photoSelfie">
                <button type="button" class="close remove-photo" data-type="selfie" data-dismiss="modal"
                    aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <h4 class="fs-14 mb-0">
                    <span id="srcPhotoSelfie">Selfie.jpg</span>&nbsp;
                    <label class="text-muted">(<span id="sizePhotoSelfie">25</span> MB)</label>
                </h4>
            </div>
        </div>
        <hr class="my-5">
        <a href="#" class="btn btn-primary disabled btnConfirmIdentity">{{ getLocale($locale_user_profile, 'label-digital-identity-6', "CONFIRM IDENTITY") }}</a>
    </div>
</div>
<div class="row mb-5" id="processingIdentity">
    <div class="col-md-8">
        <h3 class="py-4">{{ session('locale') =='id' ? 'Konfirmasi profil' : 'Confirm profile' }}</h3>
        <p>{{ getLocale($locale_user_profile, 'label-digital-identity-1', "To keep Sewagi secure, enable digital contract signatures and process installment requests, we’ll
            need you to provide us with a picture of your") }} <strong>{{ session('locale') =='id' ? 'KTP' : 'ID' }}</strong> {{ session('locale') =='id' ? 'dan sebuah' : 'and a' }} <strong>{{ session('locale') =='id' ? 'Swafoto' : 'Selfie' }} </strong>.
            {{ getLocale($locale_user_profile, 'label-digital-identity-2', "Your digital identity and all related documents are classified and protected. We won’t be
            communicating them to any third party without your consent.") }}</p>
        <hr class="my-5">
        <div id="countdown-container">
            <div id="countdown"></div>
            <svg viewbox="0 0 63.66 63.66" id="timer">
                <circle id="circle-base" cx="50%" cy="50%" r="25%" />
                <circle id="circle-fill" cx="50%" cy="50%" r="25%" /> {{ getLocale($locale_user_profile, 'label-digital-identity-7', "Sorry, your browser does not support inline SVG") }}.
            </svg>
        </div>
        <div class="text-center">
            <h3 class="text-dark fs-20 mb-5">{{ getLocale($locale_user_profile, 'label-digital-identity-8', "We're reviewing your") }} {{ session('locale') =='id' ? 'KTP' : 'ID' }}</h3>
            <p>{{ getLocale($locale_user_profile, 'label-digital-identity-9', "Now sit back and relax. This process may take awhile") }}</p>
            <p>{{ getLocale($locale_user_profile, 'label-digital-identity-10', "Feel free to browse, you'll receive a dashboard and email notifications when it's done") }}.</p>
        </div>
        <hr class="my-5">
    </div>
</div>
<div class="row mb-5" id="confirmedIdentity">
    <div class="col-md-8">
        <h3 class="py-4" id="confirmedTitle">{{ getLocale($locale_user_profile, 'label-digital-identity-11', "Profile confirmed") }}</h3>
        <p>{{ getLocale($locale_user_profile, 'label-digital-identity-1', "To keep Sewagi secure, enable digital contract signatures and process installment requests, we’ll need you to
            provide us with a picture of your") }} <strong>{{ session('locale') =='id' ? 'KTP' : 'ID' }}</strong> {{ session('locale') =='id' ? 'dan sebuah' : 'and a' }} <strong>{{ session('locale') =='id' ? 'Swafoto' : 'Selfie' }} </strong>.
            {{ getLocale($locale_user_profile, 'label-digital-identity-1', "Your digital identity and all related documents are classified and protected. We won’t be communicating them to any third party
            without your consent.") }}</p>
        <h3 class="text-dark fs-20 my-5 text-center" id="confirmedStat">“{{ getLocale($locale_user_profile, 'label-digital-identity-12', "Your digital ID is all set!") }}”</h3>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                        <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-digital-identity-3', "IDENTITY DOCUMENT") }}</label>
                    </div>
                    <p>{{ getLocale($locale_user_profile, 'label-digital-identity-14', "Identity card/passport") }}</p>
                </div>
                <div class="col-md-4">
                    <div id="identityStat"></div>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                        <label class="text-muted required">{{ session('locale') =='id' ? 'FOTO' : 'PHOTO' }} </label>
                    </div>
                    <p>{{ session('locale') =='id' ? 'Swafoto' : 'Selfie' }} </p>
                </div>
                <div class="col-md-4">
                    <div id="selfieStat"></div>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div id="reverification">
            <button class="btn btn-primary" id="btnReverification">{{ getLocale($locale_user_profile, 'label-digital-identity-15', "DO IT AGAIN") }}<</button>
            <p class="mt-5">{{ getLocale($locale_user_profile, 'label-digital-identity-16', "Problems uploading your documents for verification?") }}< <a href="">{{ session('locale')=='id' ? 'hubungi kami' : 'contact us'  }}</a> {{ session('locale')=='id' ? 'untuk bantuan' : 'For help'  }}</p>
        </div>
    </div>
</div>
<div class="row mb-5" id="reconfirmedIdentity">
    <div class="col-md-8">
        <h3 class="py-4">{{ session('locale') =='id' ? 'Konfirmasi profil' : 'Confirm profile' }}</h3>
        <p>{{ getLocale($locale_user_profile, 'label-digital-identity-1', "To keep Sewagi secure, enable digital contract signatures and process installment requests, we’ll need you to
            provide us with a picture of your") }} <strong>{{ session('locale') =='id' ? 'KTP' : 'ID' }}</strong> {{ session('locale') =='id' ? 'dan sebuah' : 'and a' }} <strong>{{ session('locale') =='id' ? 'Swafoto' : 'Selfie' }} </strong>.
            {{ getLocale($locale_user_profile, 'label-digital-identity-2', "Your digital identity and all related documents are classified and protected. We won’t be communicating them to any third party
            without your consent.") }}</p>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-digital-identity-3', "IDENTITY DOCUMENT") }}</label>
                        <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                            data-target="#modalAddPicture2" id="reAddPhotoIdentity">+ {{ session('locale') =='id' ? 'Tambah foto dokumen baru' : 'Add new document photo' }} <</a>
                    </div>
                    <p>{{ getLocale($locale_user_profile, 'label-digital-identity-4', "Upload your identity card/passport") }}</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="doc-wrap">
                        <img class="id-card" id="reSrcPhotoIdentity" src="../img/ktp.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="reStatusPhotoIdentity"></div>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <label class="text-muted required">{{ session('locale') =='id' ? 'FOTO' : 'PHOTO' }} </label>
                        <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                            data-target="#modalAddPicture3" data-type="selfie" id="reAddPhotoSelfie">+ {{ session('locale') =='id' ? 'Tambah foto dokumen baru' : 'Add new document photo' }} <</a>
                    </div>
                    <p>{{ getLocale($locale_user_profile, 'label-digital-identity-5', "Upload your selfie / current photo") }}</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="doc-wrap">
                        <h4 class="fs-14 mb-0">
                            <span id="reSrcPhotoSelfie">Selfie.jpg</span>&nbsp;
                            <label class="text-muted">(<span id="reSizePhotoSelfie">25</span> MB)</label>
                        </h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="reStatusPhotoSelfie"></div>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <a href="#" class="btn btn-primary disabled btnConfirmIdentity">{{ getLocale($locale_user_profile, 'label-digital-identity-6', "CONFIRM IDENTITY") }}</a>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalAddPicture2" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <p class="font-weight-bolder">{{ getLocale($locale_user_profile, 'label-digital-identity-17', "How do you want to upload your ID?") }}</p>
                <div class="button-group">
                    <a class="btn btn-primary mr-2" id="use-camera2" data-dismiss="modal" href="#" data-toggle="modal"
                        data-target="#modalTakePicture2">{{ getLocale($locale_user_profile, 'label-digital-identity-18', "Use device camera") }}</a>
                    <a class="btn btn-primary btn-input" href="#">{{ session('locale') =='id' ? 'Ambil dari berkas lokal' : 'Browse from file' }} <input type="file" class="custom-file-input">
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalTakePicture2" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" id="stop-camera2" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <p class="font-weight-bolder">{{ getLocale($locale_user_profile, 'label-digital-identity-19', "Take a photo of your ID card") }}</p>
                <p>{{ getLocale($locale_user_profile, 'label-digital-identity-20', "Please make sure that the image isn't blurry and clearly shows your face") }}.</p>
                <div id="picture-camera-wrap2" class="mb-3">
                    <video id="player2" width=320 height=240 autoplay></video>
                    <canvas id="snapshot2" width=320 height=240></canvas>
                    <div class="btn-camera-wrapper">
                        <button id="capture2" class="btn btn-circle-icon">
                            <i class="fas fa-camera"></i>
                        </button>
                        <button role="button" class="btn btn-pill btn-sm" id="retake2">{{ session('locale') =='id' ? 'Ambil ulang' : 'Retake' }}</button>
                    </div>
                </div>
                <div class="button-group">
                    <div>
                        <a id="submit-picture2" class="btn btn-primary disabled mb-3" href="#">{{ session('locale') =='id' ? 'KIRIM GAMBAR' : 'SUBMIT PHOTO' }}</a>
                    </div>

                    <div>
                        {{ session('locale') =='id' ? 'atau' : 'or' }} <a class="btn-link btn-input" href="#">
                            <b>{{ session('locale') =='id' ? 'Ambil dari berkas lokal' : 'Browse from file' }}</b> <input type="file" class="custom-file-input">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalAddPicture3" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <p class="font-weight-bolder">{{ getLocale($locale_user_profile, 'label-digital-identity-21', "How do you want to upload your selfie?") }}</p>
                <div class="button-group">
                    <a class="btn btn-primary mr-2" id="use-camera3" data-dismiss="modal" href="#" data-toggle="modal"
                        data-target="#modalTakePicture3">{{ getLocale($locale_user_profile, 'label-digital-identity-18', "Use device camera") }}</a>
                    <a class="btn btn-primary btn-input" href="#">{{ session('locale') =='id' ? 'Ambil dari berkas lokal' : 'Browse from file' }} <input type="file" class="custom-file-input">
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalTakePicture3" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" id="stop-camera3" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <p class="font-weight-bolder">{{ session('locale') =='id' ? 'Ambil swafoto' : 'Take a selfie' }}</p>
                <div id="picture-camera-wrap3" class="mb-3">
                    <video id="player3" width=320 height=240 autoplay></video>
                    <canvas id="snapshot3" width=320 height=240></canvas>
                    <div class="btn-camera-wrapper">
                        <button id="capture3" class="btn btn-circle-icon">
                            <i class="fas fa-camera"></i>
                        </button>
                        <button role="button" class="btn btn-pill btn-sm" id="retake3">{{ session('locale') =='id' ? 'Ambil ulang' : 'Retake' }}</button>
                    </div>
                </div>
                <div class="button-group">
                    <div>
                        <a id="submit-picture3" class="btn btn-primary disabled mb-3" href="#">{{ session('locale') =='id' ? 'KIRIM GAMBAR' : 'SUBMIT PHOTO' }}</a>
                    </div>

                    <div>
                        {{ session('locale') =='id' ? 'atau' : 'or' }} <a class="btn-link btn-input" href="#">
                            <b>{{ session('locale') =='id' ? 'Ambil dari berkas lokal' : 'Browse from file' }} <input type="file" class="custom-file-input"></b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<template id="verified">
    <span class="verified-icon">
        <i class="fas fa-check"></i>
    </span>
    <span class="font-weight-bold">
        {{ session('locale')=='id' ? 'Verifikasi berhasil' : 'Verification failed' }}
    </span>
</template>

<template id="unverified">
    <span class="unverified-icon">
        <i class="fas fa-times"></i>
    </span>
    <span class="font-weight-bold">
        {{ session('locale')=='id' ? 'Verifikasi gagal' : 'Verification failed' }}
    </span>
</template>
