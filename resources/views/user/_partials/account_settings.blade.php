<div class="row mb-5">
    <div class="col-md-8">
        <h3 class="py-4 mb-5">{{ getLocale($locale_user_profile, 'label-setting-user-1', "Security & Log in") }}</h3>
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="text-color-dark form-control-style mb-10">{{ getLocale($locale_user_profile, 'label-setting-user-2', "Change password") }}</h6>
                <a href="#" class="btn btn-link" id="toggleChangePassword">{{ session('locale')=='id' ? 'Sunting' : 'Edit' }}</a>
            </div>
            <div class="notif bg-orange-2 p-3 mb-3" id="updatedPassword">{{ getLocale($locale_user_profile, 'label-setting-user-3', "Your password has been successfully changed") }}.
            </div>
        </div>

        <hr class="my-5">
        <div id="changePassword">
            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-setting-user-4', "OLD PASSWORD") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group input-password-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-transparent" type="button">
                                    <img src="../img/dashboard/twoColor/lock.svg" alt="">
                                </button>
                            </div>
                            <input type="password" name="old_password" data-type="password"
                                class="form-control form-control-dashboard form-password bg-white"
                                placeholder="{{ getLocale($locale_user_profile, 'label-setting-user-5', "Old password") }}">
                            <div class="input-group-append">
                                <button class="btn btn-transparent btn-show-pass" for="old_password" type="button">
                                    <i class="far fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div id="invalidOldPassword">
                            {{ getLocale($locale_user_profile, 'label-setting-user-6', "Oops! You have inputted the wrong password") }}.
                            <a class="ml-auto" data-dismiss="modal" data-toggle="modal"
                                data-target="#modalForgotPassword" href="#">{{ getLocale($locale_user_profile, 'label-setting-user-7', "Forgot password") }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-setting-user-8', "NEW PASSWORD") }}</label>
                </div>
                <p class="font-size-13" id="passwordHint">{{ getLocale($locale_user_profile, 'label-setting-user-9', "Your password should be at least six characters long with combination of numbers and letters") }}.</p>
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group input-password-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-transparent" type="button">
                                    <img src="../img/dashboard/twoColor/lock.svg" alt="">
                                </button>
                            </div>
                            <input type="password" name="new_password" data-type="password"
                                class="form-control form-control-dashboard form-password bg-white"
                                placeholder="New password">
                            <div class="input-group-append">
                                <button class="btn btn-transparent btn-show-pass" for="new_password" type="button">
                                    <i class="far fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label class="text-muted">{{ getLocale($locale_user_profile, 'label-setting-user-11', "CONFIRM NEW PASSWORD") }}</label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group input-password-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-transparent" type="button">
                                    <img src="../img/dashboard/twoColor/lock.svg" alt="">
                                </button>
                            </div>
                            <input type="password" name="confirm_password" data-type="password"
                                class="form-control form-control-dashboard form-password bg-white"
                                placeholder="{{ getLocale($locale_user_profile, 'label-setting-user-12', "Confirm new password") }}">
                            <div class="input-group-append">
                                <button class="btn btn-transparent btn-show-pass" for="confirm_password" type="button">
                                    <i class="far fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div id="invalidNewPassword">
                            {{ getLocale($locale_user_profile, 'label-setting-user-13', "Oops! Your new password don’t match. Please try again") }}.
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" id="btnChangePassword" class="btn btn-primary disabled">CHANGE PASSWORD</a>
            <hr class="my-5">
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-8">
        <h3 class="py-4 mb-5">{{ getLocale($locale_user_profile, 'label-setting-user-15', "Notifications") }}</h3>
        <div class="form-group mb-5 notif-switch-group">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-setting-user-16', "RECEIVE NOTIFICATIONS ON") }}</label>
            </div>
            <div class="row mb-3">
                <div class="offset-md-3 col-md-3">
                    Email
                </div>
                <div class="col-md-6">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" data-type="notification"
                            data-name="is_email_notified" id="email-switch" checked>
                        <label class="custom-control-label" for="email-switch"></label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-md-3 col-md-3">
                    SMS
                </div>
                <div class="col-md-6">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" data-type="notification"
                            data-name="is_sms_notified" id="sms-switch" checked>
                        <label class="custom-control-label" for="sms-switch"></label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-md-3 col-md-3">
                    WhatsApp
                </div>
                <div class="col-md-6">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" data-type="notification"
                            data-name="is_whatsapp_notified" id="WhatsApp-switch" checked>
                        <label class="custom-control-label" for="WhatsApp-switch"></label>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="form-group mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="text-muted">{{ getLocale($locale_user_profile, 'label-setting-user-17', "SUBSCRIBE ME TO") }}</label>
            </div>
            <div class="row mb-3">
                <div class="offset-md-3 col-md-3">
                    {{ getLocale($locale_user_profile, 'label-setting-user-18', "Sewagi Newsletter") }}
                </div>
                <div class="col-md-6">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" data-type="notification"
                            data-name="is_newsletter_enabled" id="newsletter-switch" checked>
                        <label class="custom-control-label" for="newsletter-switch"></label>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5">
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-8">
        <h3 class="py-4 mb-5">{{ getLocale($locale_user_profile, 'label-setting-user-19', "Linked Accounts") }}</h3>
        <div class="form-group mb-4 d-flex justify-content-between align-items-center">
            <div class="social-holder d-flex align-items-center">
                <img class="social-img" src="../img/social-img/fb.png" alt="">
                <h6 class="mx-3 mb-0">Facebook</h6>
                <img src="../img/ic_check.svg" alt="" id="sa-facebook-ok">
            </div>
            <a href="/connect/facebook" class="btn btn-link" id="sa-facebook-connect">{{ session('locale')=='id' ? 'Tautan akun' : 'Link account' }}</a>
        </div>
        <div class="form-group mb-4 d-flex justify-content-between align-items-center">
            <div class="social-holder d-flex align-items-center">
                <img class="social-img" src="../img/social-img/linkedin.png" alt="">
                <h6 class="mx-3 mb-0">Linkedin</h6>
                <img src="../img/ic_check.svg" alt="" id="sa-linkedin-ok">
            </div>
            <a href="/connect/linkedin" class="btn btn-link" id="sa-linkedin-connect">{{ session('locale')=='id' ? 'Tautan akun' : 'Link account' }}</a>
        </div>
        <div class="form-group mb-4 d-flex justify-content-between align-items-center">
            <div class="social-holder d-flex align-items-center">
                <img class="social-img" src="../img/social-img/google.png" alt="">
                <h6 class="mx-3 mb-0">Google</h6>
                <img src="../img/ic_check.svg" alt="" id="sa-google-ok">
            </div>
            <a href="/connect/google" class="btn btn-link" id="sa-google-connect">{{ session('locale')=='id' ? 'Tautan akun' : 'Link account' }}</a>
        </div>
        <hr class="my-5">
        <button class="btn btn-outline-primary" id="deleteAccount">{{ getLocale($locale_user_profile, 'label-setting-user-20', "DELETE ACCOUNT") }}</button>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalToggleWarning" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" id="stop-camera2" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>
                <img class="img-fluid" src="../img/notif.png" alt="">
                <p>{{ getLocale($locale_user_profile, 'label-setting-user-21', "You need to enable at least one option") }}.</p>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary my-4" href="#" data-dismiss="modal">{{ session('locale') =='id' ? 'MENGERTI' : 'GOT IT' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalForgotPassword" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>
                <h3 class="mb-4">{{ getLocale($locale_user_profile, 'label-setting-user-23', "Forgot your password") }}</h3>
                <p class="mb-5">{{ getLocale($locale_user_profile, 'label-setting-user-24', "Don't worry. Tell us how you want to reset your password") }}.</p>

                <a class="btn btn-outline-primary my-4 btn-block" href="#" id="btnForgotPhone">
                    <img class="mr-2" src="../img/dashboard/twoColor/phone.svg" alt="">
                    {{ getLocale($locale_user_profile, 'label-setting-user-25', "VIA REGISTERED PHONE") }}
                </a>
                <a class="btn btn-outline-primary my-4 btn-block" href="#" id="btnForgotEmail">
                    <img class="mr-2" src="../img/dashboard/twoColor/email.svg" alt="">
                    {{ getLocale($locale_user_profile, 'label-setting-user-26', "VIA REGISTERED EMAIL") }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalForgotSMSSent" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>

                <img class="img-fluid" src="../img/sms.png" alt="">

                <h4 class="mb-4">{{ getLocale($locale_user_profile, 'label-setting-user-27', "SMS sent!") }}</h4>
                <p>{{ getLocale($locale_user_profile, 'label-setting-user-28', "We sent a text to") }} <strong><span id="lblForgotPhone">08122392123</span></strong> {{ getLocale($locale_user_profile, 'label-setting-user-29', "with a link to reset your password") }}.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalForgotEmailSent" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>

                <img class="img-fluid" src="../img/email.png" alt="">

                <h4 class="mb-4">{{ getLocale($locale_user_profile, 'label-setting-user-30', "Email sent!") }}</h4>
                <p>{{ getLocale($locale_user_profile, 'label-setting-user-31', "We sent an email to") }} <strong><span id="lblForgotEmail">daniel.rki@gmail.com</span></strong> {{ getLocale($locale_user_profile, 'label-setting-user-29', "with a link to reset your password") }}.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalCantDeleteAccount" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>
                <img class="mb-5" height="200" src="../img/warning.png" alt="">
                <p>{{ getLocale($locale_user_profile, 'label-setting-user-33', "You can’t delete your account because someone is living in one of your listed properties") }}.</p>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary my-4" href="#" data-dismiss="modal">{{ session('locale') =='id' ? 'MENGERTI' : 'GOT IT' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalDeleteAccount" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>
                <img class="mb-5" height="200" src="../img/warning.png" alt="">
                <p>{{ getLocale($locale_user_profile, 'label-setting-user-34', "Deleting your account will cancel any scheduled tours / ongoing negotiations and delete all of your property listings. Are you sure you want to proceed?") }}</p>
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary my-4 mr-4" href="#" data-dismiss="modal" data-toggle="modal"
                        data-target="#modalThankYouAccount">{{ session('locale') =='id' ? 'YA' : 'YES' }}</a>
                    <a class="btn btn-primary my-4" data-dismiss="modal" href="#">{{ session('locale') =='id' ? 'TIDAK' : 'NO' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-dashboard" id="modalThankYouAccount" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>
                <img class="mb-5" height="200" src="../img/thank-you.png" alt="">
                <p>
                    {{ getLocale($locale_user_profile, 'label-setting-user-35', "We thank you for using Sewagi for your property needs, we hope to see you again in the near future. Perhaps you might want to drop us a") }}
                    <a href="#">{{ session('locale')=='id' ? 'pesan' : 'message' }}</a> {{ getLocale($locale_user_profile, 'label-setting-user-36', "in order to better our services for you and our future customers") }}.
                </p>
                <p>{{ getLocale($locale_user_profile, 'label-setting-user-37', "Don’t worry, all of your personal data will not be shared to any third party without your consent") }}.
                     <a href="#">{{ session('locale') == 'id'  ? 'Klik disini' : 'Click here' }}</a> {{ getLocale($locale_user_profile, 'label-setting-user-38', "to request deleting them permanently") }}.</p>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary my-4" id="confirmedDeleteAccount">{{ session('locale')=='id' ? 'MENGERTI' : 'UNDERSTOOD' }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
