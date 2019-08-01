@extends('user._partials.master')
@section('content')
<div id="userProfile">
    <div class="nav-dashboard d-flex align-items-center justify-content-between">
        <ul class="nav" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="true">{{ getLocale($locale_user_profile, 'title-1', 'PROFILE') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="digital-id-tab" data-toggle="tab" href="#digital-id" role="tab"
                    aria-controls="digital-id" aria-selected="false">{{ getLocale($locale_user_profile, 'title-2', 'DIGITAL IDENTITY') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="legal-doc-tab" data-toggle="tab" href="#legal-doc" role="tab"
                    aria-controls="legal-doc" aria-selected="false">{{ getLocale($locale_user_profile, 'title-3', 'LEGAL DOCUMENTS') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="acc-setting-tab" data-toggle="tab" href="#acc-setting" role="tab"
                    aria-controls="acc-setting" aria-selected="false">{{ getLocale($locale_user_profile, 'title-4', 'ACCOUNT SETTINGS') }}</a>
            </li>
        </ul>

        <div id="account-switch" class="d-flex justify-content-between align-items-center px-4">
            <p id="account-type-switch-label" class="text-muted mb-0 mr-5">{{ getLocale($locale_user_profile, 'title-5', 'USER ACCOUNT TYPE') }}</p>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="account-type-switch" disabled>
                <label class="custom-control-label" for="account-type-switch"></label>
            </div>
        </div>
    </div>

    <div class="tab-content" id="dashboard-tab-content">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="py-4">{{ getLocale($locale_user_profile, 'label-1-1', 'About You') }}</h3>
                    <div class="row align-items-center mb-5">
                        <div class="col-md-auto col-12 mb-md-0 mb-3">
                            @if ($user->avatar)
                            <img id="profilePic" class="img-profile" src="{{$user->avatar->url}}" alt="">
                            @else
                            <img id="profilePic" class="img-profile" src="../img/dashboard/profile-pic.png" alt="">
                            @endif
                        </div>
                        <div class="col-md-auto col-12 mb-md-0 mb-3">
                            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalAddPicture">
                                {{ getLocale($locale_user_profile, 'button-1-1', 'UPLOAD NEW PICTURE') }}
                            </a>
                        </div>
                        <div class="col-md-auto col-12 mb-md-0 mb-3">
                            <button class="btn btn-outline-primary" id="deletePic" href="#"
                                {{$user->avatar ? '':'disabled'}}>{{ getLocale($locale_user_profile, 'button-1-2', 'DELETE') }}</button>
                        </div>
                    </div>
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-1-2', 'FIRST NAME') }}</label>
                                    <input type="text" name="first_name" class="form-control form-control-dashboard"
                                        placeholder="" value="{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-1-3', 'LAST NAME') }}</label>
                                    <input type="text" name="last_name" class="form-control form-control-dashboard"
                                        placeholder="" value="{{ $user->last_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-1-4', 'EMAIL') }}</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="oldmail" class="form-control form-control-dashboard"
                                            placeholder="" value="{{ $user->email }}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-transparent" type="button" data-toggle="modal"
                                                data-target="#modalChangeEmail">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="input-group-append">
                                            @if ($user->email_verified_at == null)
                                            <a href="#" id="btn-verify-email" class="btn btn-primary">{{ getLocale($locale_user_profile, 'button-1-3', 'VERIFY EMAIL') }}</a>
                                            @else
                                            <span class="input-group-text bg-white">
                                                <img src="../img/ic_check.svg" class="mr-3" alt="">
                                                <span>{{ getLocale($locale_user_profile, 'button-1-4', 'Verified') }}</span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="notif bg-orange-2 p-3 mb-3" id="verifyAlert">
                                        <strong>{{ getLocale($locale_user_profile, 'label-1-18', 'Email sent') }}!</strong> {{ getLocale($locale_user_profile, 'label-1-19', "Please verify by clicking on the link we’ve sent your registered email") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-1-5', 'PHONE NUMBER') }}</label>
                                    <div class="row">
                                        <div class="input-group align-items-center col"
                                            style="max-width: 150px;flex: 0 0 150px;">
                                            <i class="fab fa-whatsapp mr-2"></i>
                                            <select class="select2 select2-list-property" id="dialCode" disabled>
                                                <option value=""></option>
                                                @foreach ($countries as $q)
                                                <option value="{{ $q->calling_code }}" data-name="{{$q->name}}"
                                                    data-code="{{$q->calling_code}}" data-img="{{$q->flag}}">
                                                    {{ $q->calling_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group col">
                                            <input type="number" name="oldphone"
                                                class="form-control form-control-dashboard"
                                                value="{{ $user->phone_number }}" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-transparent" type="button" data-toggle="modal"
                                                    data-target="#modalNewPhoneNumber">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <a href="#" id="btn-verify-phone"
                                                    class="btn btn-primary btn-resend-otp">{{ getLocale($locale_user_profile, 'button-1-5', 'VERIFY YOUR PHONE NUMBER') }}</a>
                                                <span class="input-group-text bg-white" id="showVerifiedPhone">
                                                    <img src="../img/ic_check.svg" class="mr-3" alt="">
                                                    <span>{{ getLocale($locale_user_profile, 'button-1-6', 'Verified') }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-1-6', 'GENDER') }}</label>
                                    <div class="input-group mb-3">
                                        <select class="select2 select2-list-property" id="gender">
                                            <option value=""></option>
                                            <option value="M" {{ $user->gender == 'M' ? 'selected' : '' }}>{{ getLocale($locale_user_profile, 'button-1-7', 'Male') }}</option>
                                            <option value="F" {{ $user->gender == 'F' ? 'selected' : '' }}>{{ getLocale($locale_user_profile, 'button-1-8', 'Female') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-1-7', 'NATIONALITY') }}</label>
                                    <div class="input-group mb-3">
                                        <select class="select2 select2-list-property" id="nationality">
                                            <option value=""></option>
                                            @foreach ($countries as $q)
                                            <option value="{{ $q->id }}" data-name="{{$q->name}}"
                                                data-img="{{$q->flag}}"
                                                {{ $q->id == $user->nationality_id ? 'selected':'' }}>{{ $q->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-muted required">{{ getLocale($locale_user_profile, 'label-1-8', 'BIRTHDAY DATE') }}</label>
                                    <div class="input-group">
                                        <input type="text" id="oldbirthdate" class="form-control form-control-dashboard"
                                            value="{{$user->dob}}" data-toggle="modal"
                                            data-target="#modalChangeBirthday" data-dismiss="modal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label class="text-muted">{{ getLocale($locale_user_profile, 'label-1-9', 'DESCRIBE YOURSELF') }}</label>
                                        <a href="#" class="btn btn-link" data-toggle="modal"
                                            data-target="#modalAddDescription">+ {{ getLocale($locale_user_profile, 'button-1-9', 'Add Description') }}</a>
                                        <input type="hidden" id="mainProfile" value='@json(auth()->user())'>
                                        <input type="hidden" id="userImages" value='@json($user->images)'>
                                        <input type="hidden" id="description" value='@json($user->informations)'>
                                        <input type="hidden" id="document" value='@json($user->documents)'>
                                        <input type="hidden" id="files" value='@json($user->files)'>
                                        <input type="hidden" id="company" value='@json($company)'>
                                        <input type="hidden" id="social" value='@json($social)'>
                                        <input type="hidden" id="enableDelete" value='@json($enable_delete)'>
                                    </div>
                                    <div class="p-4 bg-white">
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <p class="text-muted mb-0">{{ getLocale($locale_user_profile, 'label-1-10', 'HOBBIES') }}</p>
                                            </div>
                                            <div class="col-md-9">
                                                <h6 class="d-flex align-items-center" id="hobbiesData">
                                                    @if ($user->informations && $user->informations->hobbies)
                                                    @foreach ($user->informations->hobbies as $i => $q)
                                                    {{ $q->name }}
                                                    @if ($i != count($user->informations->hobbies) - 1) <span
                                                        class="dot"></span> @endif
                                                    @endforeach
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <p class="text-muted mb-0">{{ getLocale($locale_user_profile, 'label-1-11', 'STATUS') }}</p>
                                            </div>
                                            <div class="col-md-9">
                                                <h6 id="professionData">{{$user->informations->profession->name??''}}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <p class="text-muted mb-0">{{ getLocale($locale_user_profile, 'label-1-12', 'LIFESTYLE') }}</p>
                                            </div>
                                            <div class="col-md-9">
                                                <h6 class="d-flex align-items-center" id="lifestylesData">
                                                    @if ($user->informations && $user->informations->lifestyles)
                                                    @foreach ($user->informations->lifestyles as $i => $q)
                                                    {{ $q->name }}
                                                    @if ($i != count($user->informations->lifestyles) - 1) <span
                                                        class="dot"></span> @endif
                                                    @endforeach
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h4 class="py-4">{{ getLocale($locale_user_profile, 'label-1-13', 'Additional Information') }}</h4>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label class="text-muted">{{ getLocale($locale_user_profile, 'label-1-14', 'LANGUAGE') }}</label>
                                        <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                                            data-target="#modalAddLang">+ {{ getLocale($locale_user_profile, 'button-1-10', 'Add Language') }}</a>
                                    </div>
                                    @empty($user->informations->languages)
                                    <p id="emptyLanguage">{{ getLocale($locale_user_profile, 'label-1-15', 'Add any languages you speak.') }}</p>
                                    @endempty
                                    <h6 id="languagesData" class="d-flex align-items-center font-weight-600">
                                        @if ($user->informations && $user->informations->languages)
                                        @foreach ($user->informations->languages as $i => $q)
                                        {{ $q->name }}
                                        @if ($i != count($user->informations->languages) - 1) <span class="dot"></span>
                                        @endif
                                        @endforeach
                                        @endif
                                    </h6>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label class="text-muted">{{ getLocale($locale_user_profile, 'label-1-16', 'EMERGENCY CONTACT') }}</label>
                                        <a href="#" class="btn btn-link" id="btn-add-contact">+ {{ getLocale($locale_user_profile, 'button-1-11', 'Add Contact') }}</a>
                                    </div>
                                    @empty($user->informations->emergency_contact)
                                    <p id="emptyEmergency">{{ getLocale($locale_user_profile, 'label-1-17', 'Add a contact for any urgent situations which our team can get in touch with.') }}'</p>
                                    @endempty
                                    @if ($user->informations)
                                    @php
                                    $contact = $user->informations->emergency_contact;
                                    @endphp
                                    <p id="emptyEmergency" style="display: none">{{ getLocale($locale_user_profile, 'label-1-17', 'Add a contact for any urgent situations which our team can get in touch with.') }}</p>
                                    <ul id="emergencyData" class="list-unstyled"
                                        style="display: {{$contact?'block':'none'}}">
                                        <li class="d-flex align-items-center mb-3">
                                            <img class="mr-3" src="../img/dashboard/twoColor/profile.svg" alt="">
                                            <h6 id="ec_fullname" class="font-weight-600 mb-0">
                                                {{$contact->firstname??''}} {{$contact->lastname??''}}</h6>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <img class="mr-3" src="../img/dashboard/twoColor/phone.svg" alt="">
                                            <h6 id="ec_phone" class="font-weight-600 mb-0">
                                                {{$contact->code??''}} {{$contact->phone??''}}</h6>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <img class="mr-3" src="../img/dashboard/twoColor/email.svg" alt="">
                                            <h6 id="ec_email" class="font-weight-600 mb-0">{{$contact->email??''}}</h6>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <img class="mr-3" src="../img/dashboard/twoColor/relationship.svg" alt="">
                                            <h6 id="ec_relationship" class="font-weight-600 mb-0">
                                                {{$contact->relationship??''}}</h6>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade modal-dashboard" id="modalAddPicture" tabindex="-1" role="dialog">
                <div class="modal-dialog from-right" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                            <p class="font-weight-bolder">{{ getLocale($locale_user_profile, 'label-modal-image-1', 'How do you want to add your picture?') }}</p>
                            <div class="button-group">
                                <a class="btn btn-primary mr-2" id="use-camera" data-dismiss="modal" href="#"
                                    data-toggle="modal" data-target="#modalTakePicture">{{ getLocale($locale_user_profile, 'label-modal-image-2', 'Use device camera') }}</a>
                                <a class="btn btn-primary btn-input" href="#">
                                    {{ getLocale($locale_user_profile, 'label-modal-image-3', 'Browse from file') }} <input type="file" class="custom-file-input browse-picture"
                                        accept="image/*">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalTakePicture" tabindex="-1" role="dialog">
                <div class="modal-dialog from-right" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="close" id="stop-camera" data-dismiss="modal"
                                aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                            <p class="font-weight-bolder">{{ getLocale($locale_user_profile, 'label-modal-image-4', 'Take your profile picture') }}</p>
                            <div id="picture-camera-wrap" class="mb-3">
                                <video id="player" width=320 height=240 autoplay></video>
                                <canvas id="snapshot" width=320 height=240></canvas>
                                <div class="btn-camera-wrapper">
                                    <button id="capture" class="btn btn-circle-icon">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                    <button role="button" class="btn btn-pill btn-sm" id="retake">{{ getLocale($locale_user_profile, 'label-modal-image-5', 'Retake') }}</button>
                                </div>
                            </div>
                            <div class="button-group">
                                <div>
                                    <a id="submit-picture" class="btn btn-primary disabled mb-3" href="#">{{ getLocale($locale_user_profile, 'label-modal-image-6', 'SUBMIT PICTURE') }}</a>
                                </div>

                                <div>
                                    {{ session('locale')=='id' ? 'atau' : 'or' }} <a class="btn btn-link btn-input" href="#">
                                        {{ getLocale($locale_user_profile, 'label-modal-image-3', 'Browse from file') }} <input type="file" class="custom-file-input browse-picture">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalChangeEmail" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <p class="text-center">{{ getLocale($locale_user_profile, 'label-modal-email-1', 'Please input your new email') }}</p>
                            <form action="">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <button class="btn btn-transparent-color" type="button">
                                                <i class="far fa-envelope"></i>
                                            </button>
                                        </div>
                                        <input type="email" name="new_email"
                                            class="form-control form-control-dashboard pl-0"
                                            placeholder="{{ session('locale') =='id' ? 'Alamat email' : 'Email Address' }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-primary disabled" id="btn-new-email" href="" data-dismiss="modal"
                                        data-toggle="modal">{{ session('locale') =='id' ? 'KIRIM' : 'SUBMIT' }}</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalEmailSent" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <img class="img-fluid" src="../img/email.png" alt="">

                            <h4>{{ getLocale($locale_user_profile, 'label-1-18', 'Email sent') }}!</h4>
                            <p>{{ getLocale($locale_user_profile, 'label-modal-email-2', "We've sent a verification link to") }} <strong><span
                                        id="newMailSent">david.dupond@gmail.com</span></strong></p>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary" data-dismiss="modal">OK</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalNewPhoneNumber" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <p class="text-center">{{ getLocale($locale_user_profile, 'label-modal-phone-1', "Please input your new phone number") }}:</p>

                            <p>{{ getLocale($locale_user_profile, 'label-modal-phone-2', "Preferably input a valid WhatsApp phone number for tour and negotiation convenience") }}.</p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="input-group align-items-center col"
                                        style="max-width: 160px;flex: 0 0 160px;">
                                        <i class="fab fa-whatsapp mr-2"></i>
                                        <select class="select2 select2-list-property" id="dialCodeModal">
                                            <option value=""></option>
                                            @foreach ($countries as $q)
                                            <option value="{{ $q->calling_code }}" data-name="{{$q->name}}"
                                                data-code="{{$q->calling_code}}" data-img="{{$q->flag}}">
                                                {{ $q->calling_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group col pl-0">
                                        <input type="text" pattern="\d*" name="new_phone" placeholder="{{ session('locale') =='id' ? 'Nomor telepon' : 'Phone number' }}"
                                            class="form-control form-control-dashboard" maxlength="12">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary disabled" id="btn-new-phone" data-dismiss="modal"
                                    data-toggle="modal">{{ session('locale') =='id' ? 'KIRIM' : 'SUBMIT' }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalVerification" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <h3 class="mb-4">{{ getLocale($locale_user_profile, 'label-modal-phone-3', "Verification code") }}</h3>
                            <p>{{ getLocale($locale_user_profile, 'label-modal-phone-4', "A message with verification code has been sent") }} <br>{{ session('locale')=='id' ? 'ke' : 'to' }} ****-****-*<span
                                    id="maskingNumber">123</span></p>
                            <div class="form-group py-4">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="text" maxlength="2" pattern="\d{4}"
                                            class="w-100 text-center font-size-20 border-0 py-2 otp-form" size="2">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" maxlength="2" pattern="\d{4}"
                                            class="w-100 text-center font-size-20 border-0 py-2 otp-form" size="2">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" maxlength="2" pattern="\d{4}"
                                            class="w-100 text-center font-size-20 border-0 py-2 otp-form" size="2">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" maxlength="2" pattern="\d{4}"
                                            class="w-100 text-center font-size-20 border-0 py-2 otp-form" size="2">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mb-4">
                                <a href="#" id="btn-verify-otp" class="btn btn-primary disabled w-100"
                                    data-dismiss="modal" data-toggle="modal">{{ getLocale($locale_user_profile, 'label-modal-phone-5', "VERIFY CODE") }}</a>
                            </div>
                            <h6 id="otp-timeout">00:00</h6>
                            <p class="d-flex align-items-center fs-13">{{ getLocale($locale_user_profile, 'label-modal-phone-6', "Didn't get the code?") }}
                                <span class="ml-2">
                                    <a class="btn btn-link d-flex align-items-center text-capitalize disabled btn-resend-otp"
                                        id="btn-resend-code-1" href="#">{{ getLocale($locale_user_profile, 'label-modal-phone-7', "Send a new code?") }} <i class="fas fa-long-arrow-alt-right ml-2"></i></a>
                                </span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalUnableVerification" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <h3 class="mb-4">{{ getLocale($locale_user_profile, 'label-modal-phone-8', "Unable to verify number") }}</h3>
                            <div class="bg-orange-2 p-3 mb-4">
                                <p class="mb-0">
                                    <strong>{{ session('locale')=='id' ? 'Maaf' : 'Sorry' }}</strong>, {{ getLocale($locale_user_profile, 'label-modal-phone-9', "we couldn't verify the phone number") }}<br> +62 *** *** ***
                                    <span id="cantVerifyPhone">76</span>
                                </p>
                            </div>
                            <button
                                class="btn btn-link d-flex align-items-center fs-15 text-capitalize btn-resend-otp">{{ getLocale($locale_user_profile, 'label-modal-phone-10', "Resend OTP") }} <i class="fas fa-long-arrow-alt-right ml-2"></i></button>
                            <button class="btn btn-link d-flex align-items-center fs-15 text-capitalize"
                                id="changePhoneNumber">{{ getLocale($locale_user_profile, 'label-modal-phone-11', "Change phone number") }} <i
                                    class="fas fa-long-arrow-alt-right ml-2"></i></button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalAddDescription" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <h3>{{ session('locale')=='id' ? 'Tambahkan deskripsi' : 'Add description' }}</h3>
                            <div>
                                <h4 class="my-4">{{ session('locale')=='id' ? 'Hobi' : 'Hobbies' }}</h4>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @foreach ($options as $q)
                                    @if ($q->type == 'hobby')
                                    <label class="btn btn-sm btn-checkbox btn-outline-primary mr-10 mb-10">
                                        <input class="more-info" data-type="hobbies" data-id="{{$q->id}}"
                                            data-name="{{$q->name}}" type="checkbox">+ {{ session('locale')=='id' ? $q->id_name : $q->name }}
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <hr class="my-4">

                            <div>
                                <h4 class="my-4">{{ session('locale')=='id' ? 'Gaya hidup & karakter' : 'Lifestyle & Character' }}</h4>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @foreach ($options as $q)
                                    @if ($q->type == 'lifestyle')
                                    <label class="btn btn-sm btn-checkbox btn-outline-primary mr-10 mb-10">
                                        <input class="more-info" data-type="lifestyles" data-id="{{$q->id}}"
                                            data-name="{{$q->name}}" type="checkbox">+ {{ session('locale')=='id' ? $q->id_name : $q->name }}
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <hr class="my-4">

                            <div>
                                <h4 class="my-4">{{ session('locale')=='id' ? 'Pekerjaan' : 'Profession status' }}</h4>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @foreach ($options as $q)
                                    @if ($q->type == 'profession')
                                    <label class="btn btn-sm btn-checkbox btn-outline-primary mr-10 mb-10">
                                        <input class="more-info" data-type="profession" data-id="{{$q->id}}"
                                            data-name="{{$q->name}}" type="radio">+ {{ session('locale')=='id' ? $q->id_name : $q->name }}
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary my-4" id="btn-add-description">{{ session('locale')=='id' ? 'TAMBAHKAN' : 'ADD' }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalAddLang" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <h3 class="mb-5">{{ session('locale')=='id' ? 'Bahasa' : 'Language' }}</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                    $half = floor(count($languages) / 2);
                                    @endphp
                                    @foreach ($languages as $idx => $q)
                                    <div class="custom-control custom-checkbox circle-custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input more-info" id="{{$idx}}"
                                            data-type="languages" data-id="{{$q->id}}" data-name="{{$q->name}}">
                                        <label class="custom-control-label" for="{{$idx}}">{{$q->name}}</label>
                                    </div>
                                    @if ($idx == $half)
                                </div>
                                <div class="col-md-6">
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary my-4" id="btn-add-language">{{ session('locale')=='id' ? 'TAMBAHKAN' : 'ADD' }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalAddEmergency" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>

                            <h3 class="mb-5">{{ session('locale')=='id' ? 'Tambahkan kontak darurat' : 'Add emergency contact' }}</h3>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-transparent-color" type="button">
                                                    <img class="img-fluid" src="../img/dashboard/twoColor/profile.svg"
                                                        alt="">
                                                </button>
                                            </div>
                                            <input type="text" name="e_firstname"
                                                class="form-control form-control-dashboard pl-0 emergency-contact"
                                                placeholder="{{ session('locale')=='id' ? 'Nama depan' : 'First name' }}" value="{{$contact->firstname??''}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="e_lastname"
                                            class="form-control form-control-dashboard emergency-contact"
                                            placeholder="{{ session('locale')=='id' ? 'Nama belakang' : 'Last name' }}" value="{{$contact->lastname??''}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 pr-0">
                                    <div class="form-group">
                                        <div class="input-group align-items-center">
                                            <i class="fab fa-whatsapp mr-2"></i>
                                            <select class="select2 select2-list-property emergency-contact"
                                                name="e_code" id="dialCodeEmergency" required>
                                                <option value=""></option>
                                                @foreach ($countries as $q)
                                                <option value="{{ $q->calling_code }}" data-name="{{$q->name}}"
                                                    data-code="{{$q->calling_code}}" data-img="{{$q->flag}}">
                                                    {{ $q->calling_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" placeholder="{{ session('locale')=='id' ? 'Nomor telepon' : 'Phone number' }}" name="e_phone"
                                                class="form-control form-control-dashboard emergency-contact"
                                                value="{{$contact->phone??''}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <button class="btn btn-transparent-color" type="button">
                                                    <img class="img-fluid" src="../img/dashboard/twoColor/email.svg"
                                                        alt="">
                                                </button>
                                            </div>
                                            <input type="email"
                                                class="form-control form-control-dashboard pl-0 emergency-contact"
                                                name="e_email" placeholder="{{ session('locale')=='id' ? 'Alamat Email' : 'Email Address' }}"
                                                value="{{$contact->email??''}}" required>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <button class="btn btn-transparent-color" type="button">
                                                    <img class="img-fluid"
                                                        src="../img/dashboard/twoColor/relationship.svg" alt="">
                                                </button>
                                            </div>
                                            <input type="text" name="e_relationship"
                                                class="form-control form-control-dashboard pl-0 emergency-contact"
                                                placeholder="{{ session('locale')=='id' ? 'Hubungan' : 'Relationship' }}" value="{{$contact->relationship??''}}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary my-4" id="btn-add-emergency">{{ session('locale')=='id' ? 'TAMBAHKAN' : 'ADD' }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-dashboard" id="modalChangeBirthday" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm from-right" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                            <p class="font-weight-bolder">{{ session('locale')=='id' ? 'Ganti tanggal lahir' : 'Change birthday date' }}:</p>
                            <div class="input-group date" id="date-picker" data-target-input="nearest">
                                <input type="text" name="new_dob"
                                    class="form-control form-control-dashboard datetimepicker-input"
                                    data-target="#date-picker" data-toggle="datetimepicker" placeholder="dd/mm/yyyy" />
                            </div>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary my-4 disabled" href="#" id="btn-new-dob">{{ session('locale')=='id' ? 'KIRIM' : 'SUBMIT' }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="digital-id" role="tabpanel" aria-labelledby="digital-id-tab">
            @include('user._partials.digital_identity')
        </div>
        <div class="tab-pane fade" id="legal-doc" role="tabpanel" aria-labelledby="legal-doc-tab">
            @include('user._partials.legal_documents')
        </div>
        <div class="tab-pane fade" id="acc-setting" role="tabpanel" aria-labelledby="acc-setting-tab">
            @include('user._partials.account_settings')
        </div>
    </div>
</div>

<template id="unverified">
    <span class="unverified-icon">
        <i class="fas fa-times"></i>
    </span>
    <span class="font-weight-bold">{{ session('locale')=='id' ? 'Verifikasi berhasil' : 'Verification failed' }}</span>
</template>
<template id="verified">
    <span class="verified-icon">
        <i class="fas fa-check"></i>
    </span>
    <span class="font-weight-bold">{{ session('locale')=='id' ? 'Terverifikasi' : 'Verified' }}</span>
</template>
@endsection
