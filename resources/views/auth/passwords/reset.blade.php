@extends('_partials.master_full')
@section('body')
<div class="modal-container-static modal-container">
    <div class="modal-container-inside">
        <div class="modal-contents">
            <div class="modal-titles">{{ getLocale($locale_resetpass, 'label1', 'Reset password') }}</div>
            <div class="mar-t">
                <label>{{ getLocale($locale_resetpass, 'label2', 'Your password sould be at least six character long with combination of number and letter') }} </label>
            </div>
            <form action="{{route('reset-password.post', ['token' => $token])}}" method="post" style="border:none">
                <div class="input-container {{ (session('error')) ? 'input-container-err' : '' }}">
                    <div class="input-container-inside mandatory"></div>
                    <i class="moon-lock input-icon"></i>
                    <i class="moon-eye-blocked input-icon-eye btn-show-password" for="password"></i>
                    <input type="password" class="input-text password" placeholder="{{ getLocale($locale_resetpass, 'label3', 'Password') }}" name="password" />
                </div>
                <div class="input-container {{ (session('error')) ? 'input-container-err' : '' }}">
                    <div class="input-container-inside mandatory"></div>
                    <i class="moon-lock input-icon"></i>
                    <i class="moon-eye-blocked input-icon-eye btn-show-password" for="password_confirmation"></i>
                    <input type="password" class="input-text password" placeholder="{{ getLocale($locale_resetpass, 'label4', 'Confirm Password') }}" name="password_confirmation" />
                </div>
                @if($errors->any())
                <div class="error mt-10">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="input-container-btn btn-hover">
                    @csrf
                    <input type="submit" class="input-btn" value="{{ getLocale($locale_resetpass, 'label5', 'RESET MY PASSWORD') }}" />
                </div>
            </form>
        </div>
    </div>
</div>
<div
    style="background-image:url('/img/sofa-asset.png');background-repeat:no-repeat;width:100%;min-height:100vh;background-color:#0490c7">
</div>
@endsection
