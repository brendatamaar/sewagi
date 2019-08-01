<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white nav-border {{ $solid ? "fox-statis sticky-top" : "fixed-top navbar-transparent" }} {{ $solid ? "" : "solid-on-scroll" }}">
    <div class="container">
        <a class="navbar-brand" href="{{ url('') }}" style="max-height: 36px;">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" data-scrollto href="/#about-us">{{ getLocale($locale, 'link-about', 'About') }}</a>
                </li>
            </ul>
            @if(! isset($hideNavbarSearch) || ! $hideNavbarSearch)
            <div class="navbar-search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text location-icon pl-20">A</span>
                    </div>
                    <input id="navbarSearch" type="text" class="form-control searchbox-value border-0 searchbox-trigger" placeholder="{{ getLocale($locale, 'placeholder-search', 'Enter location, property name, company or education ...') }}" aria-label="Text input with segmented dropdown button" autocomplete="off">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="input-group-icon d-flex align-items-center pr-15"><i
                                id="navbarRemoveLocation" class="fas fa-times"></i></span>
                            <button class="btn btn-target btn-grey homeCurrentLocation" type="button">
                                <i class="fanicon-target-two"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            @endif
            <ul class="navbar-nav ml-auto">
                @if (empty(Auth::user()))
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#modalLogin" >{{ getLocale($locale, 'link-login', 'Log in') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown user-logged">
                        <a href="#" class="dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                            <span class="icon-user-logged border"></span>
                            <strong>{{ auth()->user()->full_name }}</strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/dashboard/profile') }}">{{ getLocale($locale, 'link-myprofile', 'My Profile') }}</a></li>
                            <li><a href="{{ url('/logout') }}">{{ getLocale($locale, 'link-logout', 'Log Out') }}</a></li>
                        </ul>
                    </li>
                    {{-- <a class="nav-link" href="{{url('/logout')}}" >Log Out</a> --}}
                @endif
                <li class="nav-item d-flex align-items-center">
                    @guest
                    <a class="nav-link primary" href="#" data-toggle="modal" data-target="#modalPropertyLister">{{ getLocale($locale, 'link-list-your-property', 'List Your Property') }} <img src="{{ asset('img/long-arrow-right.svg') }}" class="ml-10" alt="long arrow right"></a>
                    @else
                    <a class="nav-link primary" href="{{ url('create-property') }}">{{ getLocale($locale, 'link-list-your-property', 'List Your Property') }} <img src="{{ asset('img/long-arrow-right.svg') }}" class="ml-10" alt="long arrow right"></a>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
