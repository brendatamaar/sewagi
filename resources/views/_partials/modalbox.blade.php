@if (Auth::guest())
    <div id="content-modal-auth" class="modal-fox">
        {{-- Login --}}
        <div class="modal-container modal fade {{ session('error-login') ? 'modal-open' : '' }}" tabindex="-1"
            role="dialog" id="modalLogin" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-container-inside modal-dialog">
                <div class="modal-headers">
                    <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="moon-close btn-hover"></i>
                    </div>
                </div>
                <div class="modal-contents">
                    <div class="modal-titles">Hi, welcome back to Sewagi</div>
                    <form action="{{ route('login.post') }}" method="post" style="border:none" id="form-login">
                        <div class="input-container">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-mail input-icon"></i>
                            <input type="email" name="email" class="input-text" placeholder="Email address" required
                                value="{{ old('email') }}" />
                        </div>
                        <div class="input-container" id="input-password-login">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-lock input-icon"></i>
                            <i class="moon-eye-blocked input-icon-eye btn-show-password" for="password"></i>
                            <input type="password" name="password" class="input-text password" placeholder="Password"
                                required />
                        </div>
                        <label class="modal-err" id="error-password-login"></label>

                        <div class="input-bottom">
                            <div class="input-bottom-box-left input-checkbox">
                                <label class="btn-hover">
                                    <input type="checkbox" class="checkbox" />
                                    <div class="custom-checkbox btn-hover">
                                        <div class="radion-inside"></div>
                                    </div>
                                    Keep me signed in
                                </label>
                            </div>

                            <div class="input-bottom-box-right btn-hover">
                                <label data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                    data-target="#modalForget">Forgot Password</label>
                            </div>
                        </div>
                        <div class="input-container-btn btn-hover">
                            <input type="hidden" name="form" value="login">
                            <input type="submit" class="input-btn" value="Log In" />
                        </div>
                    </form>
                    <div class="line-box">
                        <label>or</label>
                    </div>
                    <div class="input-container-btn-google btn-hover">
                        <a href="{{ url('login/google') }}">
                            <i class="moon-google input-icon"></i>
                            <label>Login with Google</label>
                        </a>
                    </div>
                    <div class="input-container-btn-facebook btn-hover">
                        <a href="{{ url('login/facebook') }}">
                            <i class="moon-facebook2 input-icon"></i>
                            <label>Login with Facebook</label>
                        </a>
                    </div>
                    <div class="input-container-btn-linkedin btn-hover">
                        <a href="{{ url('login/linkedin') }}">
                            <i class="moon-linkedin input-icon"></i>
                            <label>Login with Linkedin</label>
                        </a>
                    </div>
                    <div class="line-box mb-15 mt-20"></div>
                    <div>
                        <div>
                            <label>
                                Not a Sewagi member yet? let's be one.
                                <a href="#modalRegisterHome" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                    data-target="#modalRegisterHomeSelect">Create an account. &rarr;</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Forgot Password with Email --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalForgetEmail">
            <div class="modal-dialog mar-bot-50">
                <div class="modal-container-inside">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Forgot Your Password</div>
                        <div class="mar-t">
                            <label>Tell us your registed email with sewagi and we will send you a link to reset your
                                password</label>
                        </div>
                        <form style="border:none">
                            <div id="divEmailContainer" class="input-container">
                                <div class="input-container-inside"></div>
                                <i class="moon-mail input-icon"></i>
                                <input type="email" id="txtEmail" class="input-text" placeholder="Email address" />
                            </div>
                            <label id="lblErrorForgotPasswordByEmail" class="error" style="display: none;"></label>
                            <div class="input-container-btn btn-hover">
                                <input type="submit" id="btnSendForgotPasswordByEmail" class="input-btn"
                                    value="Send me a link" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Forgot Password with Phone --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalForgetPhone">
            <div class="modal-dialog mar-bot-50">
                <div class="modal-container-inside" style="max-height: 390px;">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Forgot Your Password</div>
                        <div class="mar-t">
                            <label>Tell us your registed phone number with sewagi and well send you a link to reset your
                                password</label>
                        </div>
                        <form style="border:none">
                            <div id="divPhoneNumberContainer" class="input-container">
                                <div class="input-container-inside"></div>
                                <i class="moon-phone input-icon"></i>
                                <input id="txtPhoneNumber" type="number" class="input-text"
                                    placeholder="Phone number" />
                            </div>
                            <label id="lblErrorForgotPasswordByPhoneNumber" class="error"
                                style="display: none;"></label>

                            <div class="input-container-btn btn-hover">
                                <input id="btnSendForgotPasswordByPhoneNumber" type="submit" class="input-btn"
                                    value="Send me a link" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Forgot Password Select --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalForget">
            <div class="modal-dialog mar-bot-50">
                <div class="modal-container-inside" style="max-height: 380px;">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Forgot Your Password</div>
                        <div class="mar-t">
                            <label>Tell us your registed email with sewagi and we will send you a link to reset your
                                password</label>
                        </div>
                        <form style="border:none">
                            <div class="input-container-btn-trans btn-hover" data-dismiss="modal" aria-label="Close"
                                data-toggle="modal" data-target="#modalForgetPhone">
                                <div class="btn-transparent-box">
                                    <i class="moon-phone input-icon"></i>
                                    <label>VIA REGISTERED PHONE</label>
                                </div>
                            </div>
                            <div class="input-container-btn-trans btn-hover" data-dismiss="modal" aria-label="Close"
                                data-toggle="modal" data-target="#modalForgetEmail">
                                <div class="btn-transparent-box">
                                    <i class="moon-mail input-icon"></i>
                                    <label>VIA REGISTERED EMAIL</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Register   --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalRegisterHome"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog min-width-720  mar-bot-50">
                <div class="modal-container-inside-big">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents max-width-480">
                        <div class="modal-titles">Become our member to find your kind of home & list your property for
                            free!
                        </div>
                        <form style="border:none">
                            <div class="input-container-btn-google btn-hover">
                                <a href="{{ url('register/google') }}">
                                    <i class="moon-google input-icon"></i>
                                    <label>Sign up with Google</label>
                                </a>
                            </div>
                            <div class="input-container-btn-facebook btn-hover">
                                <a href="{{ url('register/facebook') }}">
                                    <i class="moon-facebook2 input-icon"></i>
                                    <label>Sign up with Facebook</label>
                                </a>
                            </div>
                            <div class="input-container-btn-linkedin btn-hover">
                                <a href="{{ url('register/linkedin') }}">
                                    <i class="moon-linkedin input-icon"></i>
                                    <label>Sign up with Linkedin</label>
                                </a>
                            </div>
                            <div class="input-container-btn-email btn-hover" data-dismiss="modal" aria-label="Close"
                                data-toggle="modal" data-target="#modalRegisterPerson">
                                <i class="moon-mail input-icon"></i>
                                <label>Sign up with Email</label>
                            </div>

                            <div class="mar-t-10 mar-bot-10 font-size-12">
                                <label>By signing up, your agree to </label>
                                <a href="#btnModalRegisterPerson">terms of use, </a>
                                <a href="#btnModalRegisterPerson">privacy policy, </a>
                                <label> and </label>
                                <a href="#btnModalRegisterPerson">our cookie policy. </a>
                            </div>
                            <div class="line-box mb-15 mt-20">
                            </div>
                        </form>
                        <div class="font-size-14">
                            Already have a Sewagi account?
                            <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                data-target="#modalLogin">Log In
                                &rarr;</a>
                            <div>
                                <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                    data-target="#modalRegisterHomeSelect">&larr; Go back</a>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div class="man-img">
                        <img src="{{ url('/img/run.png') }}" />
                    </div>
                </div>
            </div>
        </div>
        {{-- Register Select --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalRegisterHomeSelect"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog min-width-720  mar-bot-50">
                <div class="modal-container-inside-big">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>

                    <div class="modal-contents max-width-480">
                        <div class="modal-titles mb-30">Sign up to find your home, <br> & list your property for free
                        </div>
                        <form style="border:none;">

                            <div class="modal-titles">Sign up as :</div>
                            <div style="padding-left:90px">
                                <div class="input-container-btn btn-hover" data-dismiss="modal" aria-label="Close"
                                    data-toggle="modal" data-target="#modalRegisterHome">
                                    <div class="input-btn">INDIVIDUAL</div>
                                </div>
                                <div class="input-container-btn btn-hover" data-dismiss="modal" aria-label="Close"
                                    data-toggle="modal" data-target="#modalRegisterCompany">
                                    <div class="input-btn">COMPANY</div>
                                </div>
                            </div>

                            <div class="mar-t-10 mar-bot-10 font-size-12">
                                <label>By signing up, your agree to </label>
                                <a href="#btnModalRegisterPerson">terms of use, </a>
                                <a href="#btnModalRegisterPerson">privacy policy, </a>
                                <label> and </label>
                                <a href="#btnModalRegisterPerson">our cookie policy. </a>
                            </div>
                            <div class="line-box mb-15 mt-20">
                            </div>

                        </form>
                        <div class="font-size-14">
                            <label>Already have a Sewagi account?</label>
                            <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                data-target="#modalLogin">Log In
                                &rarr;</a>
                        </div>
                    </div>

                    <div class="man-img">
                        <img src="{{ url('/img/run.png') }}" />
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Register Individual --}}
        <div class="modal-container modal fade {{ old('form') == 'signup-individual' ? 'modal-open' : '' }}"
            tabindex="-1" role="dialog" id="modalRegisterPerson" aria-hidden="true" data-backdrop="static"
            data-keyboard="false">
            <div class=" modal-dialog mar-bot-50">
                <div class="modal-container-inside">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Sign up with email</div>
                        <form style="border:none" action="{{ route('register.post') }}" method="POST"
                            id="form-register">
                            <div class="input-double half-box">
                                <div class="input-double-inside pad-right-10">
                                    <div class="input-container pad-right-10 ">
                                        <div class="input-container-inside mandatory"></div>
                                        <i class="moon-person_outline input-icon"></i>
                                        <input type="text" class="input-text" name="first_name"
                                            placeholder="First Name" />
                                    </div>
                                </div>

                                <div class="input-double-inside pad-left-10">
                                    <div class="input-container pad-left-10">
                                        <div class="input-container-inside"></div>
                                        <input type="text" class="input-text" name="last_name"
                                            placeholder="Last Name" />
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('first_name'))
                                <label class="modal-err">{{ $errors->first('first_name') }}</label>
                            @endif

                            <div class="input-container">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-mail input-icon"></i>
                                <input type="email" class="input-text" placeholder="Email address" name="email"
                                    value="{{ old('email') }}" />
                            </div>
                            @if ($errors->has('email'))
                                <label class="modal-err">{{ $errors->first('email') }}</label>
                            @endif

                            <label class="register-phone-info mt-20 mb-0 d-none">Preferably input a valid WhatsApp
                                phone number for tour and negotiation convenience</label>
                            <div class="input-container select-phone">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-whatsapp input-icon"></i>
                                <select class="select2 select2-list-property phone-code" name="calling_code">
                                    <option value="+62" data-img="https://www.countryflags.io/id/flat/64.png"
                                            data-name="Indonesia"
                                            data-code="+62">
                                            Indonesia
                                        </option>
                                    
                                </select>
                                <input type="tel" class="input-text input-text-phone" placeholder="Phone number"
                                    name="phone_number" />
                            </div>
                            @if ($errors->has('phone_number'))
                                <label class="modal-err">{{ $errors->first('phone_number') }}</label>
                            @endif

                            <label class="register-password-info d-none mt-20 mb-0">Your password should be at least
                                six characters long with combination of numbers and letters.</label>

                            <div class="input-container">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-lock input-icon"></i>
                                <i class="moon-eye-blocked input-icon-eye btn-show-password" for="password"></i>
                                <input type="password" class="input-text password" placeholder="Password"
                                    name="password" id="password-register" value="{{ old('password') }}" />
                            </div>
                            <div class="input-container d-none password-confirm-container">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-lock input-icon"></i>
                                <i class="moon-eye-blocked input-icon-eye btn-show-password"
                                    for="password_confirmation"></i>
                                <input type="password" class="input-text password"
                                    placeholder="Confirm your password" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}" />
                            </div>
                            @if ($errors->has('password'))
                                <label class="modal-err">{{ $errors->first('password') }}</label>
                            @endif

                            <div class="input-container custom-country">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-flag input-icon"></i>
                                <select name="nationality_id"
                                    class="js-example-basic-single input-text input-nationality" id="countryPicker">
                                    <option value="">Nationality</option>
                                    @foreach ($countries as $country)
                                        <option data-img="{{ $country->flag }}" value="{{ $country->id }}"
                                            {{ old('nationality_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->demonym }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('nationality_id'))
                                <label class="modal-err">{{ $errors->first('nationality_id') }}</label>
                            @endif

                            <div class="input-container">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-cake input-icon"></i>
                                <input type="text" class="input-text" placeholder="dd / mm / yyyy" name="dob"
                                    id="dob-register" value="{{ old('dob') }}" autocomplete="off" />
                            </div>
                            @if ($errors->has('dob'))
                                <label class="modal-err">{{ $errors->first('dob') }}</label>
                            @endif

                            <div class="mar-t">
                                <div class="font-size-14">You must be 18 years old or older.
                                    <span class="light">This information won't be shared to others</span>
                                </div>
                            </div>

                            <div class="input-container input-checkbox input-gender">
                                <div class="input-container-inside mandatory">
                                    <label class="btn-hover pad-right-10" for="register_gender_m">
                                        <input type="radio" class="checkbox" id="register_gender_m" name="gender"
                                            value="M" {{ old('gender') == 'M' ? 'checked' : '' }} required />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        Male
                                    </label>

                                    <label class="btn-hover" for="register_gender_f">
                                        <input type="radio" class="checkbox" id="register_gender_f" name="gender"
                                            value="F" {{ old('gender') == 'F' ? 'checked' : '' }} />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        Female
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('gender'))
                                <label class="modal-err">{{ $errors->first('gender') }}</label>
                            @endif

                            <div class="input-container-btn btn-hover">
                                <input type="submit" class="input-btn" value="Continue" id="register-submit" />
                            </div>

                            <div class="line-box mb-15 mt-20">
                            </div>
                            @csrf
                            <input type="hidden" name="help" value="0" id="input-person-help">
                            <input type="hidden" name="form" value="signup-individual">
                        </form>
                        <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                            data-target="#modalRegisterHome">&larr;
                            Back to all sign up option</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Register Individual with Social Account --}}
        @php
            $user = session('user');
        @endphp
        <div class="modal-container modal fade {{ old('form') == 'signup-individual-social' || session('action') == 'signup-social' ? 'modal-open' : '' }}"
            tabindex="-1" role="dialog" id="modalRegisterPersonSocial" aria-hidden="true" data-backdrop="static"
            data-keyboard="false">
            <div class=" modal-dialog mar-bot-50">
                <div class="modal-container-inside">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Sign up with <span id="social-provider"></span></div>
                        <form style="border:none" action="{{ route('register-social.post') }}" method="POST"
                            id="form-register-social">
                            <div class="input-double half-box">
                                <div class="input-double-inside pad-right-10">
                                    <div class="input-container pad-right-10 ">
                                        <div class="input-container-inside mandatory"></div>
                                        <i class="moon-person_outline input-icon"></i>
                                        <input type="text" class="input-text" name="first_name"
                                            placeholder="First Name" id="social-firstname" disabled />
                                    </div>
                                </div>

                                <div class="input-double-inside pad-left-10">
                                    <div class="input-container pad-left-10">
                                        <div class="input-container-inside"></div>
                                        <input type="text" class="input-text" name="last_name"
                                            placeholder="Last Name" id="social-lastname" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="input-container">
                                <div class="input-container-inside"></div>
                                <i class="moon-mail input-icon"></i>
                                <input type="email" class="input-text" placeholder="Email address" name="email"
                                    value="{{ old('email') }}" disabled id="social-email" />
                            </div>

                            <label class="phone-info d-none">Preferably input a valid WhatsApp phone number for tour
                                and negotiation convenience</label>

                            <div class="input-container select-phone">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-whatsapp input-icon"></i>
                                <select class="select2 select2-list-property phone-code" name="calling_code"
                                    id="calling-code-register-social">
                                    <option value=""></option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->calling_code }}" data-img="{{ $country->flag }}"
                                            data-name="{{ $country->name }}"
                                            data-code="{{ $country->calling_code }}">
                                            {{ $country->calling_code }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="tel" class="input-text input-text-phone" id="phone-register-social"
                                    placeholder="Phone number" name="phone_number"
                                    value="{{ old('phone_number') }}" />
                            </div>
                            @if ($errors->has('phone_number'))
                                <label class="modal-err">{{ $errors->first('phone_number') }}</label>
                            @endif

                            <div class="input-container custom-country">
                                <div class="input-container-inside mandatory"></div>
                                <i class="moon-flag input-icon"></i>
                                <select name="nationality_id"
                                    class="js-example-basic-single input-text input-nationality"
                                    id="countryPicker-social">
                                    <option value="">Nationality</option>
                                    @foreach ($countries as $country)
                                        <option data-img="{{ $country->flag }}" value="{{ $country->id }}"
                                            {{ old('nationality_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->demonym }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('nationality_id'))
                                <label class="modal-err">{{ $errors->first('nationality_id') }}</label>
                            @endif

                            <div class="input-container">
                                <div class="input-container-inside"></div>
                                <i class="moon-cake input-icon"></i>
                                <input type="text" class="input-text" placeholder="dd / mm / yyyy" name="dob"
                                    id="dob-register-social" value="{{ old('dob') }}" />
                            </div>
                            @if ($errors->has('dob'))
                                <label class="modal-err">{{ $errors->first('dob') }}</label>
                            @endif

                            <div class="mar-t text-line">
                                <div>You must be 18 years old or older.
                                    <div class="light">This information won't be shared to others</div>
                                </div>
                            </div>

                            <div class="input-checkbox">
                                <label class="btn-hover pad-right-10">
                                    <input type="radio" class="checkbox" name="gender" value="M"
                                        {{ old('gender') == 'M' ? 'checked' : '' }} />
                                    <div class="custom-checkbox btn-hover">
                                        <div class="radion-inside"></div>
                                    </div>
                                    Male
                                </label>

                                <label class="btn-hover">
                                    <input type="radio" class="checkbox" name="gender" value="F"
                                        {{ old('gender') == 'F' ? 'checked' : '' }} />
                                    <div class="custom-checkbox btn-hover">
                                        <div class="radion-inside"></div>
                                    </div>
                                    Female
                                </label>
                            </div>
                            @if ($errors->has('gender'))
                                <label class="modal-err">{{ $errors->first('gender') }}</label>
                            @endif

                            <div class="input-container-btn btn-hover">
                                <input type="submit" class="input-btn" value="Sign up"
                                    id="submit-individual-social" />
                            </div>

                            <div class="line-box">
                            </div>
                            @csrf
                            <input type="hidden" name="help" value="0" id="input-person-help-social">
                            <input type="hidden" name="form" value="signup-individual-social">
                            <input type="hidden" name="account_id" id="input-provider-id"
                                value="{{ old('account_id', session('account_id')) }}">
                        </form>
                        <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                            data-target="#modalRegisterHome">&larr;
                            Back to all sign up option
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Alert Email Sent --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalSuccessEmail"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-container-inside centered-box " style="max-height: 420px;">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-img">
                            <img src="/img/email.png" />
                        </div>
                        <div class="modal-titles-center">Email sent!</div>
                        <div class="mar-t ta-center">
                            <label>We sent an email to <label id="lblEmail"
                                    class="t-bold">daniel@ricki.co</label>
                                with a link to reset your password.</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalSuccessPhoneNumber"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-container-inside centered-box " style="max-height: 420px;">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-img">
                            <img src="/img/sms.png" />
                        </div>
                        <div class="modal-titles-center">SMS sent!</div>
                        <div class="mar-t ta-center">
                            <label>We sent a text to <label
                                    id="lblPhoneNumber" class="t-bold"></label>
                                with a link to reset your password.</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Form Help Person --}}
        <div class="modal-container modal fade {{ session('action') == 'signup-next' ? 'modal-open' : '' }}"
            tabindex="-1" role="dialog" id="modalPersonHelp" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-container-inside centered-box " style="max-height: 420px;">
                    <div class="modal-contents">
                        <div class="mar-t">
                            <p>I want Sewagi's help to:</p>
                            <div class="input-bottom">
                                <div class="input-bottom-box input-checkbox radUserPreference">
                                    <label class="btn-hover d-block">
                                        <input type="checkbox" name="person-help" value="option_1"
                                            class="checkbox" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        Find a home
                                    </label>
                                    <label class="btn-hover d-block">
                                        <input type="checkbox" name="person-help" value="option_2"
                                            class="checkbox" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        List property as a homeowner
                                    </label>
                                    <label class="btn-hover d-block">
                                        <input type="checkbox" name="person-help" value="option_3"
                                            class="checkbox" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        List property as a property agent
                                    </label>
                                    <label class="btn-hover d-block">
                                        <input type="checkbox" name="person-help" value="option_4"
                                            class="checkbox" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        List property / bedrooms as a housemate
                                    </label>
                                </div>
                            </div>
                            <div class="input-container-btn btn-hover btn-not-active">
                                <input type="button" class="input-btn"
                                    value="Sign up" id="signup-person-process"
                                    data-type="email" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-container modal fade {{ session('action') == 'email-not-found' ? 'modal-open' : '' }}"
            tabindex="-1" role="dialog" id="modalEmailNotFound" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-container-inside centered-box " style="max-height: 420px;">
                    <div class="modal-contents">
                        <div class="mar-t">
                            <label>We can’t find a Sewagi account connected to the following email </label>
                            <p class="text-center">{{ session('email') }}</p>
                            <label for="">Would you like to create a new account?</label>
                            <div class="input-container-btn btn-hover">
                                <button class="input-btn" data-dismiss="modal" aria-label="Close"
                                    data-toggle="modal" data-target="#modalRegisterHomeSelect">CREATE AN
                                    ACCOUNT</button>
                            </div>
                            <label>Already have a Sewagi account?
                                <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                    data-target="#modalLogin">
                                    Log In &rarr;</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-container modal fade {{ session('action') == 'phone-verification' ? 'modal-open' : '' }}"
            tabindex="-1" role="dialog" id="modalRegisterVerification">
            <div class="modal-dialog mar-bot-50">
                <div class="modal-container-inside" style="max-height: 390px;">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <h3 class="mb-4">Verification code</h3>
                        <p>A message with verification code has been sent
                            <br>To ****-****-*<span
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
                            <button type="submit" id="btnVerificationCode" class="btn btn-primary disabled w-100"
                                data-dismiss="modal"
                                data-toggle="modal">VERIFY CODE</button>
                        </div>
                        <label id="lblErrorVerificationCode" class="modal-err" style="display: none;"></label>
                        <div><label id='lblVerificationCountdown'></label></div>
                        <div class="d-flex align-items-center fs-13">
                            Didn't get the code ?&nbsp;
                            <a class="btn-link d-flex align-items-center text-capitalize disabled btn-resend-otp"
                                id="send-new-code-register"
                                href="#">Send a new code ? <i
                                    class="fas fa-long-arrow-alt-right ml-2"></i></a>
                        </div>
                        <input id="hdnPhoneNumber" type="hidden">
                        <input id="otpCode" type="hidden">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-container modal fade {{ session('action') == 'signup-success-email' ? 'modal-open' : '' }}"
            tabindex="-1" role="dialog" id="modalRegisterSuccessEmail">
            <div class="modal-dialog">
                <div class="modal-container-inside centered-box " style="max-height: 420px;">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-img">
                            <img src="../img/modal/email.png" />
                        </div>
                        <div class="modal-titles-center">Email sent!</div>
                        <div class="mar-t ta-center">
                            <label>We sent an email to <label
                                    id="registeredMail" class="t-bold">{{ session('email') }}</label>
                                with a link to verify your account.</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Register Company --}}
        <div class="modal-container modal fade" role="dialog" id="modalRegisterCompany" aria-hidden="true">
            <div class=" modal-dialog mar-bot-50" style="width: 100%;">
                <div class="modal-container-inside centered-box">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Company details</div>
                        <div class="input-container">
                            <div class="input-container-inside"></div>
                            <i class="moon-office input-icon"></i>
                            <input id="txtCompanyName" type="text" class="input-text"
                                placeholder="Enter company name" />
                        </div>
                        <div class="input-container-nospace">
                            <div class="input-container-inside mandatory"></div>
                            <input id="txtCompanyStreet" type="text" class="input-text"
                                placeholder="Enter street address" />
                        </div>
                        <div class="input-double half-box">
                            <div class="input-double-inside pad-right-10">
                                <div class="input-container-nospace pad-right-10 ">
                                    <div class="input-container-inside mandatory"></div>
                                    <input id="txtCompanyStreetNo" type="text" class="input-text"
                                        placeholder="Enter address number" />
                                </div>
                            </div>
                            <div class="input-double-inside pad-left-10">
                                <div class="input-container-nospace pad-left-10">
                                    <div class="input-container-inside"></div>
                                    <input id="txtCompanyDetail" type="text" class="input-text"
                                        placeholder="Enter details" />
                                </div>
                            </div>
                        </div>
                        <div class="input-container-nospace">
                            <div class="input-container-inside mandatory"></div>
                            <input id="txtCompanyCity" type="text" class="input-text"
                                placeholder="Enter city" />
                        </div>
                        <div class="input-container-nospace">
                            <div class="input-container-inside"></div>
                            <input id="txtCompanyDistrict" type="text" class="input-text"
                                placeholder="Enter district" />
                        </div>
                        <div class="input-container-nospace">
                            <div class="input-container-inside"></div>
                            <input id="txtCompanyPostcode" type="text" class="input-text"
                                placeholder="Enter post code" />
                        </div>
                        <div class="input-container-nospace">
                            <div class="input-container-inside mandatory"></div>
                            <input id="txtCompanyPhoneNumber" class="input-text"
                                placeholder="Phone number" />
                        </div>
                        <div class="input-container-nospace">
                            <div class="input-container-inside"></div>
                            <input id="txtCompanyWebsite" class="input-text" placeholder="Website" />
                        </div>
                        <div id="divContinueRegisterCompany" class="input-container-btn btn-hover btn-not-active"
                            data-dismiss="modal" aria-label="Close" data-toggle="modal"
                            data-target="#modalRegisterCompanyPIC">
                            <input id="btnContinueRegisterCompany" type="submit" class="input-btn"
                                value="Continue" disabled />
                        </div>
                        <div class="line-box mb-15 mt-20"></div>
                        <div>
                            <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                data-target="#modalRegisterHome">
                                <label class="moon-long-arrow arrow-long-l"></label>
                            </a>
                            <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                data-target="#modalRegisterHome"> Back to all sign up option</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Register Company PIC --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalRegisterCompanyPIC"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class=" modal-dialog mar-bot-50" style="width: 100%;">
                <div class="modal-container-inside">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Person in charge of this account</div>
                        <div class="input-double">
                            <div class="input-double-inside pad-right-5">
                                <div class="input-container pad-right-10">
                                    <div class="input-container-inside mandatory"></div>
                                    <i class="moon-person_outline input-icon"></i>
                                    <input id="txtCompanyPICFirstName" type="text" class="input-text"
                                        placeholder="First Name"
                                        name="first_name" value="{{ old('first_name') }}" />
                                </div>
                            </div>
                            <div class="input-double-inside pad-left-5">
                                <div class="input-container pad-left-10">
                                    <div class="input-container-inside mandatory"></div>
                                    <input id="txtCompanyPICLastName" type="text" class="input-text"
                                        placeholder="Last Name"
                                        name="last_name" value="{{ old('last_name') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-mail input-icon"></i>
                            <input id="txtCompanyPICEmail" type="email" class="input-text"
                                placeholder="Email address"
                                name="email" value="{{ old('email') }}" />
                        </div>
                        <label id="takenEmail" class="error mb-0"
                            style="display: none">That email is already taken.</label>
                        <label
                            class="register-phone-info d-none mt-20 mb-0">Preferably input a valid WhatsApp phone number for tour and negotiation convenience</label>
                        <div id="divCompanyPICPhoneNumber" class="input-container select-phone">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-whatsapp input-icon"></i>
                            <select class="select2 select2-list-property phone-code" name="calling_code"
                                id="txtCompanyPICCallingCode">
                                <option value=""></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->calling_code }}" data-img="{{ $country->flag }}"
                                        data-name="{{ $country->name }}" data-code="{{ $country->calling_code }}">
                                        {{ $country->calling_code }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="tel" class="input-text input-text-phone" id="txtCompanyPICPhoneNumber"
                                placeholder="Phone number"
                                name="phone_number" value="{{ old('phone_number') }}" />
                        </div>
                        <label
                            class="register-password-info d-none mt-20 mb-0">Your password should be at least six characters long with combination of numbers and letters</label>
                        <div class="input-container">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-lock input-icon"></i>
                            <i class="moon-eye-blocked input-icon-eye btn-show-password" for="password"></i>
                            <input id="txtCompanyPICPassword" type="password" class="input-text password"
                                placeholder="Password"
                                name="password" value="{{ old('password') }}" />
                        </div>
                        <div id="divCompanyPICPasswordConfirmation" class="input-container" style="display: none;">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-lock input-icon"></i>
                            <i class="moon-eye-blocked input-icon-eye btn-show-password"
                                for="password_confirmation"></i>
                            <input id="txtCompanyPICPasswordConfirmation" type="password" class="input-text password"
                                placeholder="Confirm your password"
                                name="password_confirmation" value="{{ old('password_confirmation') }}" />
                            <input type="hidden" id="validPassword" value="false">
                        </div>
                        <label id="notMatchPassword" class="error mb-0"
                            style="display: none">Oops! Your new password don't match. Please try again.</label>
                        <div id="divContinueRegisterCompanyPIC" class="input-container-btn btn-hover btn-not-active">
                            <button class="input-btn" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                data-target="#modalRegisterCompanyHelp">Continue</button>
                        </div>
                        <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                            data-target="#modalRegisterCompany">&larr;
                            Back</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Form Help Company --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalRegisterCompanyHelp"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-container-inside centered-box " style="max-height: 420px;">
                    <div class="modal-contents">
                        <div class="mar-t">
                            <p>I want Sewagi's help to:</p>
                            <div class="input-bottom">
                                <div class="input-bottom-box input-checkbox">
                                    <label class="btn-hover d-block">
                                        <input id="cbRegisterCompanyUserPreference1" type="checkbox"
                                            class="checkbox checkbox-register-company-user-preference" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        Find a home for my team / co-workers / employees
                                    </label>
                                    <label class="btn-hover d-block">
                                        <input id="cbRegisterCompanyUserPreference2" type="checkbox"
                                            class="checkbox checkbox-register-company-user-preference" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        List properties as a Building Management
                                    </label>
                                    <label class="btn-hover d-block">
                                        <input id="cbRegisterCompanyUserPreference3" type="checkbox"
                                            class="checkbox checkbox-register-company-user-preference" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        List properties as a Real Estate Company
                                    </label>
                                    <label class="btn-hover d-block">
                                        <input id="cbRegisterCompanyUserPreference4" type="checkbox"
                                            class="checkbox checkbox-register-company-user-preference" />
                                        <div class="custom-checkbox btn-hover">
                                            <div class="radion-inside"></div>
                                        </div>
                                        List properties as a Real Estate Agency
                                    </label>
                                </div>
                            </div>
                            <label id="lblErrorRegisterCompany" class="error" style="display: none;"></label>
                            <div id="divSubmitRegisterCompany" class="input-container-btn btn-hover btn-not-active">
                                <input id="btnSubmitRegisterCompany" type="submit" class="input-btn"
                                    value="Continue" disabled />
                            </div>
                            <a href="#modalLogin" data-dismiss="modal" aria-label="Close" data-toggle="modal"
                                data-target="#modalRegisterCompanyPIC">&larr;
                                Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Verify Success {{ getLocale($locale_modalbox, 'label-modal-login-15', '') }} --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalVerifySuccessPhoneNumber">
            <div class="modal-dialog">
                <div class="modal-container-inside centered-box " style="max-height: 420px;">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-img">
                            <img src="../img/ok.png" />
                        </div>
                        <div class="mar-t ta-center">
                            <label>Thank you for signing-up.
                                <br>Enjoy finding home on your terms and listing your property for free.</label>
                        </div>
                        <div class="input-container-btn btn-hover" data-dismiss="modal" aria-label="Close">
                            <input type="submit" class="input-btn"
                                value="Continue" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Unable Verify {{ getLocale($locale_modalbox, 'label-modal-login-15', '') }} --}}
        <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalUnableVerifyPhoneNumber">
            <div class="modal-dialog mar-bot-50">
                <div class="modal-container-inside">
                    <div class="modal-headers"></div>
                    <div class="modal-contents">
                        <div class="modal-titles">Unable to verify number
                        </div>
                        <div class="mar-t mar-bot-20" style="background-color: #e8e1e1;">
                            <label>
                                <h5 class="h5-inside">Sorry </h5>
                                We couldn't verify the
                                Phone number ****-****-*<span
                                    id="unverifiedMaskingNumber">123</span>
                            </label>
                        </div>
                        <form style="border:none">
                            <a class="link-btn" href="javascript:;" id="send-new-otp-register">
                                Resend OTP <label
                                    class="moon-long-arrow arrow-long-r"></label></a>
                            <a class="link-btn" href="#modalLogin" data-dismiss="modal" aria-label="Close"
                                data-toggle="modal" data-target="#modalChangePhoneNumber">
                                Change
                                Phone number <label
                                    class="moon-long-arrow arrow-long-r"></label></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Change {{ getLocale($locale_modalbox, 'label-modal-login-15', '') }} --}}
        <div class="modal-container modal box" tabindex="-1" role="dialog" id="modalChangePhoneNumber"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class=" modal-dialog mar-bot-50" style="width: 100%;">
                <div class="modal-container-inside">
                    <div class="modal-headers">
                        <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="moon-close btn-hover"></i>
                        </div>
                    </div>
                    <div class="modal-contents">
                        <div class="modal-titles">Phone number
                        </div>
                        <label class="register-phone-info d-none">Preferably input a valid WhatsApp phone number for tour and negotiation convenience</label>
                        <div id="divChangePhoneNumber" class="input-container select-phone">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-whatsapp input-icon"></i>
                            <select class="select2 select2-list-property phone-code" name="calling_code"
                                id="ddlChangePhoneNumberCallingCode">
                                <option></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->calling_code }}" data-img="{{ $country->flag }}"
                                        data-name="{{ $country->name }}"
                                        data-code="{{ $country->calling_code }}">
                                        {{ $country->calling_code }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="tel" class="input-text input-text-phone" id="txtChangePhoneNumber"
                                placeholder="Phone number"
                                name="phone_number" value="{{ old('phone_number') }}" />
                        </div>
                        <div class="input-container-btn btn-hover">
                            <button id="btnChangePhoneNumber" class="input-btn" data-dismiss="modal"
                                aria-label="Close"
                                data-toggle="modal">Send OTP</button>
                        </div>
                        <input id="hdnChangePhoneNumberUserId" type="hidden">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="modal fade fullscreen" id="modalPropertyLister" tabindex="-1" role="dialog"
    aria-labelledby="modalPropertyListerTitle" aria-hidden="true">
    <div class="modal-dialog d-flex modal-fullscreen from-right m-0" role="document">
        <div class="modal-content rounded-0 border-0">
            <div class="modal-header background-primary-dark border-0 rounded-0 pt-25 px-lg-75">
                <button type="button" class="close font-weight-normal" data-dismiss="modal" aria-label="Close">
                    <span class="color-white font-size-16" aria-hidden="true"><img
                            src="{{ asset('img/ic_left_arrow.png') }}" alt="icon arrow left"> <span
                            class="ml-5 font-size-14">Back</span></span>
                </button>
            </div>
            <div class="modal-body p-0">
                <!-- start: property owner -->
                <section class="section-content background-primary-dark h-100 d-flex align-items-center">
                    <div class="container">
                        <div class="row row-property-lister">
                            <div
                                class="col-md-6 col-12 d-flex flex-column flex-wrap justify-content-start align-items-center">
                                <img class="img-fluid" src="{{ asset('img/sofa-asset.png') }}"
                                    alt="image sofa" />
                            </div>
                            <div
                                class="col-md-6 col-12 d-flex flex-column flex-wrap justify-content-center align-items-center">
                                <div class="property-lister text-center ml-xl-15">
                                    <p class="font-mono text-color-orange text-uppercase mb-5">ARE YOU A PROPERTY
                                        LISTER?</p>
                                    <h3 class="font-size-32 font-weight-bold color-white mb-40">Go for effortless
                                        leasing as a</h3>
                                    <div class="btn-list-group">
                                        <a class="btn btn-primary btn-wide"
                                            href="{{ url('/property-lister/homeowner') }}"
                                            role="button">Homeowner</a>
                                        <a class="btn btn-primary btn-wide"
                                            href="{{ url('/property-lister/agent') }}" role="button">Property
                                            agent</a>
                                        <a class="btn btn-primary btn-wide"
                                            href="{{ url('/property-lister/building-management') }}"
                                            role="button">Building management</a>
                                        <a class="btn btn-primary btn-wide"
                                            href="{{ url('/property-lister/housemate') }}" role="button">House
                                            mate</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end: property owner -->
            </div>
        </div>
    </div>
</div>
<!-- start: modal renter -->
<div class="modal fade" id="modalRenter" tabindex="-1" role="dialog" aria-labelledby="modalRenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header border-0">
                <p class="font-mono font-size-14 text-color-orange text-uppercase mb-0">
                    What is co-living?</p>
            </div>
            <div class="modal-body px-40 py-0">
                <p class="mb-15">Co-living means sharing a home along with common spaces, amidst individuals whom are compatible with urban community lifestyle.</p>
                <p class="mb-15">With your private room and live-in housemates, you’ll split accommodation costs, foster lifelong connections, discover new activities and do so much more.</p>
                <p class="mb-0">Essentially it means more flexibility to do more of what you like.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary"
                    data-dismiss="modal">Got It</button>
            </div>
        </div>
    </div>
</div>
<!-- end: modal renter -->
<!-- start: form join community -->
<div class="modal fade" id="modalJoinCommunity" tabindex="-1" role="dialog"
    aria-labelledby="modalJoinCommunity" aria-hidden="true">
    <div class="modal-dialog modal-xl border" role="document">
        <div class="modal-content rounded-0 border-0">
            <div class="border-0 rounded-0 d-flex flex-column flex-wrap px-30 pt-20">
                <div class="row w-100">
                    <div class="col-12 position-relative modal-heading mb-20">
                        <h5 class="text-color-orange text-center" id="exampleModalCenterTitle">
                            Join the community</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="row w-100">
                    <div class="col-12">
                        <p class="mb-0">In order to assess your candidacy in becoming a showing agent, please give us some details about you by filling out the form below.</p>
                    </div>
                </div>
            </div>
            <div class="modal-body p-0">
                <section class="py-20 px-30">
                    <div class="container">
                        <div class="row">
                            <form action="{{ route('register-community.post') }}" method="POST"
                                id="form-register-community" class="w-100">
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-12 col-form-label">First Name
                                        <font color="red">*</font></label>
                                    <div class="col-sm-10 col-12 input-container">
                                        <input type="text" name="first_name" id="txtFirstName"
                                            class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-12 col-form-label">Last Name
                                        <font color="red">*</font></label>
                                    <div class="col-sm-10 col-12">
                                        <input type="text" name="last_name" id="txtLastName"
                                            class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-12 col-form-label">Nationality</label>
                                    <div class="col-sm-10 col-12">
                                        <select class="custom-select" name="nationality_id" id="txtNationality">
                                            <option selected></option>
                                            @foreach ($countries as $country)
                                                <option data-img="{{ $country->flag }}"
                                                    value="{{ $country->id }}"
                                                    {{ old('nationality_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->demonym }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-12 col-form-label">Phone number
                                        <font color="red">*</font></label>
                                    <div class="col-sm-10 col-12">
                                        <input type="text" name="phone_number" id="txtPhone"
                                            class="form-control" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-12 col-form-label">Email address
                                        <font color="red">*</font></label>
                                    <div class="col-sm-10 col-12">
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-4 col-12 col-form-label">Which area do you live in?
                                        <font color="red">*</font></label>
                                    <div class="col-sm-8 col-12">
                                        <input type="text" name="area_live" id="txtAreaLive"
                                            class="form-control" placeholder="E.g. Kemang, Kuningan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-4 col-12 col-form-label">Which area do you practice your profession?
                                        <font color="red">*</font></label>
                                    <div class="col-sm-8 col-12">
                                        <input type="text" name="area_practice" id="txtAreaPractice"
                                            class="form-control" placeholder="E.g. Kemang, Kuningan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-4 col-12 col-form-label">Current employment status
                                        <font color="red">*</font></label>
                                    <div class="col-sm-8 col-12">
                                        <span class="btn-group-toggle" data-toggle="buttons">
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="employment_status"
                                                    value="Employee">Employee
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="employment_status"
                                                    value="Unemployed">Unemployed
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="employment_status"
                                                    value="Freelancer">Freelancer
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="employment_status"
                                                    value="Entrepreneur">Entrepreneur
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="employment_status"
                                                    value="Student">Student
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="employment_status"
                                                    value="Retired">Retired
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="employment_status"
                                                    value="Civil servant">Civil servant
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 col-12 col-form-label">Working field
                                        <font color="red">*</font></label>
                                    <div class="col-sm-10 col-12">
                                        <select class="custom-select" name="working_field">
                                            <option selected></option>
                                            @foreach ($workingFields as $field)
                                                <option value="{{ $field->id }}">{{ $field->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label
                                        class="col-sm-4 col-12 col-form-label">Latest education
                                        <font color="red">*</font></label>
                                    <div class="col-sm-8 col-12">
                                        <span class="btn-group-toggle" data-toggle="buttons">
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="latest_education"
                                                    value="Highschool">Highschool
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="latest_education"
                                                    value="Diploma">Diploma (D3)
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="latest_education"
                                                    value="Bachelor">Bachelor (S1)
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="latest_education"
                                                    value="Master">Master (S2)
                                            </label>
                                            <label
                                                class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                <input type="radio" name="latest_education"
                                                    value="Doctorate">Doctorate (S3)
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-12 col-form-label">
                                        <div class="form-group row px-15">
                                            <span>English proficiency<font
                                                    color="red">*</font></span>
                                            <span
                                                class="ml-auto">SPOKEN</span>
                                        </div>
                                        <div class="form-group row px-15">
                                            <span
                                                class="ml-auto">WRITTEN</span>
                                        </div>
                                    </label>
                                    <div class="col-sm-8 col-12">
                                        <div class="px-15">
                                            <div class="form-group row mb-0">
                                                <span class="btn-group-toggle" data-toggle="buttons">
                                                    <label
                                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                        <input type="radio" name="english_spoken"
                                                            value="Beginner">Beginner
                                                    </label>
                                                    <label
                                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                        <input type="radio" name="english_spoken"
                                                            value="Intermediate">Intermediate
                                                    </label>
                                                    <label
                                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                        <input type="radio" name="english_spoken"
                                                            value="Fluent">Fluent
                                                    </label>
                                                </span>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <span class="btn-group-toggle" data-toggle="buttons">
                                                    <label
                                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                        <input type="radio" name="english_written"
                                                            value="Beginner">Beginner
                                                    </label>
                                                    <label
                                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                        <input type="radio" name="english_written"
                                                            value="Intermediate">Intermediate
                                                    </label>
                                                    <label
                                                        class="btn btn-checkbox btn-rounded btn-outline-primary btn-sm rounded text-capitalize m-5">
                                                        <input type="radio" name="english_written"
                                                            value="Fluent">Fluent
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tell us a bit more about yourself</label>
                                    <textarea class="form-control" name="description" rows="3"
                                        placeholder="(Limited to 180 Characters)"></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input type="text" name="url"
                                            placeholder="Submit your linkedIn profile URL link"
                                            class="form-control">
                                    </div>
                                </div>
                                <label id="lblErrorRegisterCommunity" class="error"
                                    style="display: none;"></label>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button id="btnSubmitRegisterCommunity" type="submit"
                                            class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- end: form join community -->
<!--Success pop up Starts-->
<div class="modal fade" id="success_msg" tabindex="-1" role="dialog" aria-labelledby="modalRenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header border-0">
                <p class="font-mono font-size-14 text-color-orange text-uppercase mb-0">
                    Submit</p>
            </div>
            <div class="modal-body px-40 py-0">
                Thank you for submitting your form, we will do our best to get back to you in under 24 hours.
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end: modal renter -->
<!--Success pop up ends-->
<!-- Start: Calender -->
<div class="modal fade" id="schedule-modal1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" data-background-color="aqua">
            <input type="hidden" id="property-id" name="property-id" value="" />
            <input type="hidden" id="living-condition" name="living-condition" value="" />
            <input type="hidden" id="month" name="month" value="" />
            <input type="hidden" id="bedroom" name="bedroom" value="" />
            <input type="hidden" id="price" name="price" value="" />

            <div class="modal-headers">
                <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                    <i class="moon-close btn-hover"></i>
                </div>
            </div>

            <div class="modal-body pl-5 pr-5">
                <div class="mb-2">
                    <label for="length-stay"
                        class="label">{{ getLocale($locale_modalbox, 'label-modal-schedule-1', '') }}</label>
                    <div id="schedule-calendar"></div>
                </div>
            </div>
            <div id="select-time">
                <div>
                    {{ getLocale($locale_modalbox, 'label-modal-schedule-2', '') }}
                </div>
                <div>save</div>
                <div>
                    <select id="select-hour">
                        <option selected>H</option>
                        @for ($i = 9; $i <= 19; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <select id="select-minute">
                        <option selected>M</option>
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer pl-5 pr-5">
                <button type="button"
                    class="btn btn-primary btn-block btn-save text-uppercase btn-submit-schedule1">
                    {{ getLocale($locale_modalbox, 'label-modal-login-21', '') }}
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="schedule-message-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center pt-4" data-background-color="aqua">
            <div class="modal-body pl-5 pr-5 pb-2">
                <div><img class="img-fluid" src="{{ url('img/offer-success.svg') }}" /></div>
                <h3 class="mt-3 font-weight-600 text-color-dark">{{ getLocale($locale, 'label-thanks', '') }}!</h3>
                <div class="text-color-gray-1 font-size-14 mt-1">
                    {{ getLocale($locale_modalbox, 'label-modal-schedule-4', '') }}.</div>
            </div>
            <div class="modal-footer pl-5 pr-5">
                <button type="button" data-dismiss="modal"
                    class="btn btn-primary btn-block">{{ getLocale($locale_modalbox, 'label-modal-schedule-3', '') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End: Calender -->
<!-- Start: Datepicker Schedule -->
<div class="modal modal-styled fade" id="schedule-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-default" role="document" style="width: 337px;">
        <div class="modal-content" style="border-radius: 8px; border: 0px">
            <input type="hidden" id="property-id" name="property-id" value="" />
            <input type="hidden" id="living-condition" name="living-condition" value="" />
            <input type="hidden" id="month" name="month" value="" />
            <input type="hidden" id="bedroom" name="bedroom" value="" />
            <input type="hidden" id="price" name="price" value="" />
            <input type="hidden" id="tour_type" name="tour_type" value="" />
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="moon-close btn-hover"></i>
                </button>
            </div>
            <div class="modal-body pb-0 pt-0">
                <h5>
                    <div id="typeTourTitle">
                </h5>
                <label class="label font-size-10"
                    style="color: #8A8989;text-transform: none;">{{ getLocale($locale_modalbox, 'label-modal-schedule-6', '') }}.</label><br>
                <label for="length-stay" class="label font-size-10"
                    style="color: #8A8989">{{ getLocale($locale_modalbox, 'label-modal-schedule-1', '') }}</label>
                @for ($i = 0; $i <= 5; $i++)
                    <div class="form-group mb-9">
                        <div class="input-group date datetimepicker " id="datetimepicker{{ $i }}"
                            data-target-input="nearest"
                            style="width: 227px; box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.1)">
                            <input type="text" onkeydown="return false" id="date{{ $i }}"
                                class="form-control cuma-test datetimepicker-input border-0 pl-16 pr-16 pb-2 pt-2"
                                data-target="#datetimepicker{{ $i }}"
                                style="font-size: 12px; color: #8A8989" />
                            <div class="input-group-append px-md-0"
                                data-target="#datetimepicker{{ $i }}" data-toggle="datetimepicker">
                                <div class="input-group-text" style="background: #ffffff; font-size: 10px;"><i
                                        class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="modal-footer justify-content-center pt-0" style="border-top: 0px">
                <button type="button"
                    class="btn btn-primary btn-save text-uppercase btn-submit-schedule px-sm-41 py-sm-16">
                    {{ getLocale($locale_modalbox, 'label-modal-schedule-3', '') }}
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal-fox">
    <div class="modal-container modal fade" tabindex="-1" role="dialog" id="share-it-here-modal"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class=" modal-dialog mar-bot-50">
            <div class="modal-container-inside">
                <div class="modal-headers">
                    <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="moon-close btn-hover"></i>
                    </div>
                </div>
                <div class="modal-contents">
                    <h5 class="mb-15 modal-titles">
                        {{ getLocale($locale_modalbox, 'label-modal-share-1', 'Found a home you like but not on the terms you want?') }}
                    </h5>
                    <p class="mb-10" style="font-size: 0.85rem;">
                        {{ getLocale($locale_modalbox, 'label-modal-share-2', "We noticed you’ve haven't found what you are looking for.<br>Perhaps you may have found it somewhere else, but not on rental terms you are comfortable with?<br><p style='font-size: 0.85rem;'>In that case, please share the link below, and we’ll look into making it more acceptable.</p>.") }}
                    </p>
                    {{-- <div class="form-group">
                        <label style="font-size: 0.85rem;margin-bottom:0.25rem;">Submit URL Link</label>
                        <input type="text" class="form-control" name="url" placeholder="http://" required style="font-size: 0.85rem;padding-bottom: 0.3rem;">
                    </div> --}}

                    <div class="input-container mb-15">
                        <div class="input-container-inside mandatory"></div>
                        <i class="fas fa-link input-icon"></i>
                        <input type="text" class="input-text"
                            placeholder="{{ getLocale($locale_modalbox, 'label-modal-share-3', 'Submit URL') }}"
                            name="url" required />
                    </div>

                    @if (auth()->guest())
                        <p style="font-size: 0.85rem;">
                            {{ getLocale($locale_modalbox, 'label-modal-share-4', "Don't forget to provide us with your phone number and/or email, so that we may reach you.") }}
                        </p>
                        <div class="input-container mb-15">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-mail input-icon"></i>
                            <input type="email" class="input-text" name="email"
                                placeholder="{{ getLocale($locale_modalbox, 'label-modal-share-5', 'Email') }}">
                        </div>
                        <label
                            class="register-phone-info mt-20 mb-0 d-none">{{ getLocale($locale_modalbox, 'label-modal-share-7', 'Preferably input a valid WhatsApp phone number for tour and negotiation convenience') }}</label>
                        <div class="input-container select-phone">
                            <div class="input-container-inside mandatory"></div>
                            <i class="moon-whatsapp input-icon"></i>
                            <select class="select2 select2-list-property phone-code" name="phone_country_code">
                                <option value=""></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->calling_code }}" data-img="{{ $country->flag }}"
                                        data-name="{{ $country->name }}"
                                        data-code="{{ $country->calling_code }}">
                                        {{ $country->calling_code }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="tel" class="input-text input-text-phone"
                                placeholder="{{ getLocale($locale_modalbox, 'label-modal-share-6', 'Phone number') }}"
                                name="phone_number" />
                        </div>
                    @else
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    @endif

                    <div class="modal-footer px-0">
                        <button type="button"
                            class="btn btn-primary btn-block btn-save text-uppercase btn-submit-share-it-here">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalWhatIsColiving"
        aria-hidden="true" data-keyboard="false">
        <div class=" modal-dialog mar-bot-50">
            <div class="modal-container-inside">
                <div class="modal-headers">
                    <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="moon-close btn-hover"></i>
                    </div>
                </div>
                <div class="modal-contents">
                    <h5 class="mb-15 modal-titles">What is co-living?</h5>

                    <p class="mb-15">Co-Living is a new kind of modern housing where residents with similar interests
                        and value, share a living space.</p>
                    <p class="mb-15">By staying in a private rooms, residents will share common spaces with
                        housemates, split accomodation costs, foster livelong connections and discover community
                        activities.</p>
                    <p class="mb-15">Essentially it means having flexibility to do more of what you love.</p>

                    <div class="text-right">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Go it</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-container modal fade" tabindex="-1" role="dialog" id="modalExploreLiveVirtualTour"
        aria-hidden="true" data-keyboard="false">
        <div class=" modal-dialog min-width-720  mar-bot-50">
            <div class="modal-container-inside-big fit">
                <div class="modal-headers">
                    <div class="modal-btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="moon-close btn-hover"></i>
                    </div>
                </div>
                <div class="modal-contents">
                    <p class="h4 mb-15">360° Viewing & Live Virtual Tour <span
                            class="text-color-gray-6 font-weight-normal">Beta</span></p>
                    <p class="h4 mb-25">Be Immersed when viewing homes online with us.</p>

                    <div class="row mb-15">
                        <div class="col-2 text-center">
                            <img src="{{ asset('img/ic_360vr.svg') }}" alt="icon 360 view">
                        </div>
                        <div class="col" style="font-size: 14px;">
                            <strong>360° Viewing</strong> lets you explore our property listings in full detail.
                            Anywhere, anytime!
                        </div>
                    </div>

                    <div class="row mb-15">
                        <div class="col-2 text-center">
                            <img src="{{ asset('img/ic_view_virtual_field.svg') }}" alt="icon live virtual tour">
                        </div>
                        <div class="col" style="font-size: 14px;">
                            <p class="mb-5"><strong>Live Virtual Tour</strong> takes you a guided online showing
                                properties in real time. Anywhere, anytime!</p>
                            <p class="mb-5">Schedule a Live Virtual Tour to save on commuting time and optimize your
                                sorting of properties</p>
                        </div>
                    </div>

                    <p class="h4 mb-25">Features & Compatibility <span
                            class="text-color-gray-6 font-weight-normal">Beta</span></p>

                    <div class="row align-items-center mb-15 px-50">
                        <div class="col-6">
                            <div class="row align-items-center mb-15">
                                <div class="col-4 text-center">
                                    <img src="{{ asset('img/ic_360vr.svg') }}" alt="icon 360 view">
                                </div>
                                <div class="col" style="font-size: 14px;">
                                    360° Viewing
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center mb-15">
                                <div class="col-4 text-center">
                                    <img src="{{ asset('img/ic_view_virtual_field.svg') }}"
                                        alt="icon live virtual tour">
                                </div>
                                <div class="col" style="font-size: 14px;">
                                    Live Virtual Tour
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center mb-15">
                                <div class="col-4 text-center">
                                    <img src="{{ asset('img/ic_movie_mode.svg') }}" alt="icon movie mode">
                                </div>
                                <div class="col" style="font-size: 14px;">
                                    Movie Mode
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center mb-15">
                                <div class="col-4 text-center">
                                    <img src="{{ asset('img/ic_vr_goggles_mode.svg') }}"
                                        alt="icon vr goggles mode">
                                </div>
                                <div class="col" style="font-size: 14px;">
                                    VR Goggle Mode
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>


                    <div class="row align-items-center mb-15 px-50">
                        <div class="col-6">
                            <div class="row align-items-center mb-15">
                                <div class="col-4 text-center">
                                    <img src="{{ asset('img/ic_publish_friendly.svg') }}" alt="icon 360 view">
                                </div>
                                <div class="col" style="font-size: 14px;">
                                    Publish friendly
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center mb-15">
                                <div class="col-4 text-center">
                                    <img src="{{ asset('img/ic_mobile_friendly.svg') }}"
                                        alt="icon live virtual tour">
                                </div>
                                <div class="col" style="font-size: 14px;">
                                    Mobile friendly
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary px-50">Explore</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="test-show-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center pt-4" data-background-color="aqua">
            <div class="modal-body pl-5 pr-5 pb-2">
                <div><img class="img-fluid" src="{{ url('img/offer-success.svg') }}" /></div>
                <h3 class="mt-3 font-weight-600 text-color-dark">{{ getLocale($locale, 'label-thanks', '') }}!</h3>
                <div class="text-color-gray-1 font-size-14 mt-1">
                    {{ getLocale($locale_modalbox, 'label-modal-schedule-4', '') }}.</div>
            </div>
            <div class="modal-footer pl-5 pr-5">
                <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">
                    {{ getLocale($locale_modalbox, 'label-modal-login-21', '') }}
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End: Datepicker Schedule -->
