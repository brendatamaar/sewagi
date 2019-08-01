@extends('_partials.master_trans')
@section('content')
<!-- start: cookie -->
@if (!Cookie::get('cookie-policy'))
<div class="navbar-on-top" style="display: none;">
    <div class="container">
        <span class="color-main-dark font-size-13">{{ getLocale($locale, 'label-cookie', '') }} <a href="#">{{ getLocale($locale, 'link-cookie', '') }}</a>.</span>
        <a class="close-btn" href="javascript:void(0);">
            <span class="clear-cross"></span>
        </a>
    </div>
</div>
@endif
<!-- end: cookie -->

<!-- start: home -->
<section class="section-content d-flex flex-column flex-wrap justify-content-center align-items-center vh-min-100 background-gradient-1">
    <div class=""></div>
    <button onclick="$zopim.livechat.window.show()" class="btn-chat background-primary">
        <i class="fas fa-comment-alt"></i>
    </button>
    <!-- start: home slider -->
    <div id="homeSlider">
        <div class="home-slider">
            <div class="home-slider-item">
                <img src="{{ $background }}" class="d-block w-100" alt="Slider">
            </div>
            <!-- <div class="carousel-item active">
        <img src="../img/slide-2.jpg" class="d-block w-100" alt="...">
      </div> -->
        </div>
    </div>
    <!-- end: home -->
    <div class="hero-filter position-absolute">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <h1 class="main-heading">
                    {!! $pageTitle !!}
                </h1>
                <div class="home-search">
                    <div class="input-group input-homepage">
                        <div class="input-group-prepend searchbox-trigger">
                            <span class="input-group-text icon-location">A</span>
                        </div>
                        <input id="homeSearch" type="text" class="form-control searchbox-trigger searchbox-value border-0"
                            placeholder="{{ getLocale($locale, 'placeholder-search', 'Enter location, property name, company or education ...') }}" autocomplete="off">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="homeRemoveLocation"><i class="fas fa-times"></i></span>
                            <span class="input-group-text input-group-target">
                                <button class="btn btn-grey btn-target homeCurrentLocation"><i class="fanicon-target-two"></i></button>
                            </span>
                        </div>
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-primary searchbox-btn">{{ getLocale($locale, 'link-discover', 'Discover') }}</button>
                        </div>
                    </div>
                </div>
                <div class="recent-search-wrapper" style="display: none;">
                    <p class="text-uppercase recent-search font-size-12 mb-10">{{ getLocale($locale, 'label-recent-search', 'Recent searches') }}</p>
                    <div class="mb-15 btn-group-toggle" data-toggle="buttons" id="homeRecentSearch"></div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<!-- end: home -->
<!-- start: most viewed listings -->
<section class="section-content background-aqua py-65">
    <!-- <div class="background-shadow"></div> -->
    {{-- <div class="container prop-content">
        <div class="row">
            <div class="col-12">
                <h3 class="font-size-34 font-weight-bold mb-150 pt-20 pl-xl-55">Properties recommended by us</h3>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="font-size-34 font-weight-bold mb-150 pt-20 pl-xl-55">{{ getLocale($locale, 'label-property-recommend', 'Properties recommended by us') }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1 slider-viewed-listings" id="property-featured">
                <div class="owl-carousel main-listings">
                    @foreach ($featured as $idx => $q)
                    <!-- start: property item -->
                    <div class="col-12 property-wrapper">
                        <div class="property-item">
                            <div id="" class="pp-images position-relative">
                                @foreach ($q->photos[0]->thumb_images as $i => $photo)
                                    @if ($loop->index <= 2)
                                        <a class="pp-image-content image-wrapper-{{ $i+1 }}" href="/property/{{$q->id}}/{{$q->slug_url}}" target="_blank">
                                            <div class="image-sizing-{{ $i+1 }}">
                                                <img src="{{ $photo->url }}" alt="image">
                                                @if ($i == 1)
                                                    <div class="main-tag">
                                                        @if(count($q->propertyStyle) && ($firstPropertyStyle = $q->propertyStyle->first()) && $firstPropertyStyle->style)
                                                            <span>#{{ $firstPropertyStyle->style->name }}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="pp-detail">
                                <div class="row">
                                    <div class="col-md-10 col-12">
                                        <div class="pp-highlight">
                                            <div class="pp-tags">
                                                @php
                                                $price = moneyFormat($q->co_living_min_price, true);
                                                $room = $q->rented_room.' / '.$q->total_room;
                                                $isTagExists = false;
                                                $showTagEntire = true;
                                                @endphp

                                                @if ($q->rented_room < $q->total_room && $q->is_co_living)
                                                <span id="tag-left-{{$idx}}" class="card-tag" data-id="{{$idx}}" data-type="coliving" data-active="1" data-img="../img/coliving-icon.png" data-room="{{$room}}" data-price="{{$q->co_living_min_price}}" data-building_size="{{ $q->building_size }}" data-unit_size="{{ $q->unit_size }}">Co Living</span>
                                                @php
                                                $isTagExists = true;
                                                $showTagEntire = false;
                                                @endphp
                                                @endif

                                                @if ($q->available_room == $q->total_room && $q->is_entire_space)
                                                @php
                                                if (!$q->is_co_living) $price = moneyFormat($q->entire_space_min_price, true);
                                                $outline = !$showTagEntire ? 'card-tag-outline' : '';
                                                $isTagExists = true;
                                                @endphp
                                                <span id="tag-right-{{$idx}}" class="card-tag {{$outline}}" data-id="{{$idx}}" data-type="entire" data-active="0" data-img="../img/ic_bedroom.png" data-room="{{$q->total_room}}" data-price="{{$q->entire_space_min_price}}" data-building_size="{{ $q->building_size }}" data-unit_size="{{ $q->unit_size }}">Entire Space</span>
                                                @endif

                                                @if(!$isTagExists)
                                                &nbsp;
                                                @endif
                                            </div>
                                            <h4 class="pp-title">
                                                <a href="/property/{{$q->id}}/{{$q->slug_url}}" target="_blank">
                                                    {{ $q->title }}
                                                </a>
                                            </h4>
                                            <p class="pp-location">{{ $q->district }}, {{ $q->city }}</p>
                                            <p class="pp-price" data-type="coliving" style="{{ $showTagEntire ? 'display:none;' : '' }}">{{ session('locale')=='en' ? 'From' : 'Mulai' }} <strong><span class="starting-price">{{ moneyFormat($q->co_living_min_price, true) }} {{ getLocale($locale, 'label-perroom-month', '/ Room / Month') }}</span></strong></p>
                                            <p class="pp-price" data-type="entire" style="{{ !$showTagEntire ? 'display:none;' : '' }}">From <strong><span class="starting-price">{{ moneyFormat($q->entire_space_min_price, true) }} {{ getLocale($locale, 'label-permonth', '/ Month') }}</span></strong></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12 d-flex flex-md-column flex-row flex-wrap align-items-md-end align-items-center justify-content-md-end justify-content-between mt-md-0 mt-10">
                                        @if (auth()->user())
                                        @php
                                        $favorites = json_decode(json_encode(auth()->user()->property_favorites), true);
                                        $liked = in_array($q->id, $favorites) ? 'like-active' : 'halo';
                                        @endphp
                                        <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40 {{ $liked }}" data-id="{{$q->id}}">
                                            <i class="far fa-heart icon icon-small"></i>
                                        </button>
                                        @else
                                        <button class="btn btn-icon-small btn-favorite background-white mb-auto mt-md-40" data-toggle="modal" data-target="#modalLogin">
                                            <i class="far fa-heart icon icon-small"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                <hr class="pp-divider">
                                <div class="row">
                                    <div class="col-md-9 col-12">
                                        <div class="pp-spec d-flex flex-row flex-wrap">
                                            {{-- <span class="pp-rates">
                                                <span class="pp-stars">4.5</span>
                                                <i class="fas fa-star text-color-orange"></i>
                                                <span class="pp-raters color-light-brown pl-2">(35)</span>
                                            </span> --}}
                                            <span class="pp-landsize d-flex flex-row flex-wrap justify-content-start align-items-start">
                                                <img src="{{ asset('img/ic_size.png') }}" alt="icon landsize">
                                                <span><span class="pp-size">{{ $q->unit_size }}</span>m<sup>2</sup></span>
                                            </span>
                                            @if ($q->rented_room < $q->total_room && $q->is_co_living)
                                            <span class="pp-room d-flex flex-row flex-wrap justify-content-start align-items-start">
                                                <img id="icon-{{$idx}}" src="{{ asset('img/coliving-icon.png') }}" alt="icon room">
                                                <span id="room-{{$idx}}"><span class="font-weight-bold">{{ $q->rented_room }}</span>/<span>{{ $q->total_room }}</span></span>
                                            </span>
                                            @endif
                                            @if ($q->available_room == $q->total_room && $q->is_entire_space && !$q->is_co_living)
                                            <span class="pp-bed d-flex flex-row flex-wrap justify-content-start align-items-start">
                                                <img id="icon-{{$idx}}" src="{{ asset('img/ic_bedroom.png') }}" alt="icon bed">
                                                <span id="room-{{$idx}}"><span>{{ $q->total_room }}</span></span>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <a href="/property/{{$q->id}}/{{$q->slug_url}}" class="pp-goto-detail outline-none font-weight-bold" target="_blank">{{ session('locale')=='en' ? 'Details' : 'Detail' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: property item -->
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">
                <a href="#" class="btn-more-properties outline-none font-weight-bold">{{ getLocale($locale, 'label-see-more', 'See more') }} <img src="{{ asset('img/long-arrow-right.svg') }}" class="ml-10" alt="long arrow right"></a>
            </div>
        </div>
    </div>
</section>
<!-- end: most viewed listings -->
<!-- start: what we provide -->
<section class="section-content about-sewagi">
    <div class="container pt-90 pb-100">
        <div class="row">
            <div class="col-12">
                <p class="font-mono text-uppercase text-color-orange text-center mb-60">{{ getLocale($locale, 'label-we-provide', 'What We Provide') }}</p>
            </div>
        </div>
        <div class="row what-we-provide">
            <!-- start: item -->
            <div class="col-xl-2-4 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/main-monthly-payment.png') }}" alt="Monthly payments">
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16">{{ getLocale($locale, 'label-we-provide-1-title', 'Monthly payments') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale, 'label-we-provide-1-content', 'Pay as you go') }}.</p>
                    </div>
                </div>
            </div>
            <!-- end: item -->
            <!-- start: item -->
            <div class="col-xl-2-4 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/main-flexibility.png') }}" alt="Flexibility">
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16">{{ getLocale($locale, 'label-we-provide-2-title', 'Flexibility') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale, 'label-we-provide-2-content', 'Rent the way you want. Choose your payment and staying terms') }}.</p>
                    </div>
                </div>
            </div>
            <!-- end: item -->
            <!-- start: item -->
            <div class="col-xl-2-4 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/main-location.png') }}" alt="Preferred locations">
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16">{{ getLocale($locale, 'label-we-provide-3-title', 'Preferred locations') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale, 'label-we-provide-3-1-content', 'Use our') }} <a href="javascript:void(0);" class="font-weight-bold">{{ getLocale($locale, 'label-we-provide-3-2-content', 'commute time') }}</a> {{ getLocale($locale, 'label-we-provide-3-3-content', 'feature to be close to your activity hubs') }}.</p>
                    </div>
                </div>
            </div>
            <!-- end: item -->
            <!-- start: item -->
            <div class="col-xl-2-4 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/main-compatibility.png') }}" alt="Co-living compatibility">
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16">{{ getLocale($locale, 'label-we-provide-4-title', 'Co-living compatibility') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale, 'label-we-provide-4-title', 'We match you with like minded housemates') }}.</p>
                    </div>
                </div>
            </div>
            <!-- end: item -->
            <!-- start: item -->
            <div class="col-xl-2-4 col-md-6 col-12">
                <div class="we-provide-item mb-lg-0 mb-40">
                    <div class="provide-image mb-15">
                        <img src="{{ url('img/homepage/main-piece-of-mind.png') }}" alt="Peace of mind">
                    </div>
                    <div class="provide-desc text-center">
                        <h5 class="font-size-16">{{ getLocale($locale, 'label-we-provice-5-title', 'Peace of mind') }}</h5>
                        <p class="font-size-14 mb-0">{{ getLocale($locale, 'label-we-provide-5-content', 'Unified dashboard paired with customer support for a seamless renting experience') }}.</p>
                    </div>
                </div>
            </div>
            <!-- end: item -->
        </div>
    </div>
</section>
<!-- end: what we provide -->
<!-- start: about sewagi -->
<section id="about-us" class="section-content about-sewagi">
    <div class="container">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 col-md-10">
                    <p class="font-mono title mini text-color-orange text-uppercase mb-24">{{ getLocale($locale, 'label-about-us', 'What is Sewagi') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-10">
                    <div>
                        <h3 class="font-size-32 font-weight-bold mb-50">{{ getLocale($locale, 'p-about-us-1', 'SEWAGI lets you rent on your terms & list your property for free') }}.</h3>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-md-3">
                    <div>
                        <p class="font-size-20 mb-15">{{ getLocale($locale, 'p-about-us-2', 'Our marketplace provides you with rental flexibility, proximity & shareability') }}.</p>
                        <p class="font-size-20">{{ getLocale($locale, 'p-about-us-3', 'While giving your property the edge in leasing out faster & safer') }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: about sewagi -->
<!-- start: how sewagi helps you -->
<section class="section-content service-type-info">
    <div class="container-fluid info-content">
        <div class="row info-tab-row">
            <div class="col-12">
                <p class="font-mono title mini text-color-orange text-uppercase mb-24 text-center">{{ getLocale($locale, 'label-how-sewagi-1', 'How Sewagi Helps You as a') }}</p>
            </div>
            <div class="col-12">
                <div id="menu-tabs" class="mb-lg-15">
                    <ul class="nav nav-tabs tabs-slash justify-content-center padding-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-size-28 font-weight-bold active" data-toggle="tab" href="#renter-tab"
                                role="tab">{{ getLocale($locale, 'label-how-sewagi-2', 'Renter') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-size-28 font-weight-bold" data-toggle="tab" href="#coliving-tab"
                                role="tab">{{ getLocale($locale, 'label-how-sewagi-3', 'Co-Living Renter') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-size-28 font-weight-bold" data-toggle="tab" href="#owner-tab" role="tab">
                                {{ getLocale($locale, 'label-how-sewagi-4', 'Property Lister') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active show" id="renter-tab" role="tabpanel">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/renter_illustrasi1.png') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-2-1-title', 'Find and collect the listings you like') }}</p>

                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-2-1-content', 'Check out our listing and refine your filters to get the best match') }}. {{ getLocale($locale, 'label-how-sewagi-4-4-2-content', 'Whenever you see this logo on our listing you may check it out in') }} <a href="#" class="font-weight-bold">{{ session('locale')=='en' ? '360° view' : 'mode 360°' }}</a>
                                    </p>

                                    <div class="tab-footer-icon text-center">
                                        <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour"><img src="{{ asset('img/ic_360vr_grey.svg') }}" class="icon"></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/renter_illustrasi2.png') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-2-2-title', 'Schedule for a room tour') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-2-2-content', 'Have a closer look at your future home. No strings attached') }}.<br>
                                        {{ getLocale($locale, 'label-how-sewagi-2-2-1-content', 'Whenever you see this logo on our listing, you may schedule a') }} <a href="#" class="font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-2-2-2-content', 'Live Virtual Tour') }}</a></p>

                                    <div class="tab-footer-icon text-center">
                                        <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour"><img src="{{ asset('img/ic_view_virtual_field_grey.svg') }}" class="icon"></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/renter_illustrasi3.png') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-2-3-title', 'Set up your digital identity') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-2-3-content', 'Like what you see? Sign the contract digitally and the place is yours') }}</p>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/renter_illustrasi4.png') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold"><i>{{ getLocale($locale, 'label-how-sewagi-2-4-title', 'MOVE IN!') }}</i></p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-2-4-content', 'You are all set! Move in and be part of the community') }}.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="coliving-tab" role="tabpanel">
                        <div class="container">
                            <div class="row mb-15">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/renter_illustrasi1.png') }}" />
                                    </div>

                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-5-1-title', 'Find and collect the listings you like') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-5-1-1-content', 'Check out our co-living listing and refine your filters to get the best match') }}.<br>
                                        {{ getLocale($locale, 'label-how-sewagi-5-1-2-content', 'Whenever you see this logo on our listing, you may check it out in') }} <a href="#" class="font-weight-bold">{{ session('locale')=='en' ? '360° view' : 'model 360°' }}</a>
                                    </p>

                                    <div class="tab-footer-icon text-center">
                                        <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour"><img src="{{ asset('img/ic_360vr_grey.svg') }}" class="icon"></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/connect.svg') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-3-2-title', 'Connect with the existing renters') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-2-2-content', 'Have a closer look at your future home. No strings attached') }}. {{ getLocale($locale, 'label-how-sewagi-2-2-1-content', 'Whenever you see this logo on our listing, you may schedule a') }} <a href="#" target="_blank" class="font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-2-2-2-content', 'Live Virtual Tour') }}</a> {{ getLocale($locale, 'label-how-sewagi-2-2-2-content', 'and meet with your potential roommates') }}.</p>

                                    <div class="tab-footer-icon text-center">
                                        <a href="#" data-toggle="modal" data-target="#modalExploreLiveVirtualTour"><img src="{{ asset('img/ic_view_virtual_field_grey.svg') }}" class="icon"></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/renter_illustrasi3.png') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-3-3-title', 'Set up your digital identity') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-3-3-content', 'Like what you see? Sign the contract digitally and the place is yours') }}.</p>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/renter_illustrasi4.png') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold"><i>{{ getLocale($locale, 'label-how-sewagi-3-4-title', 'MOVE IN!') }}</i></p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-3-4-content', 'You are all set! Move in and be part of the community') }}.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mt-30 text-center">
                                        <button class="btn btn-primary btn-wide" type="button" class="close font-weight-normal" data-toggle="modal" data-target="#modalWhatIsColiving">{{ getLocale($locale, 'label-what-is-coliving', 'What is co-living?') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="owner-tab" role="tabpanel">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/owner1.svg') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-4-1-title', 'Tell us about your property') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-4-1-content', 'Give us your property details. The more details the better') }}.</p>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/owner2.svg') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-4-2-title', 'Let us do the heavy lifting') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-4-2-content', 'Sewagi will help you price it right, market it to the right prospects and take care of the paperwork') }}.</p>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/owner3.svg') }}" />
                                    </div>

                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{!! getLocale($locale, 'label-how-sewagi-4-3-title', 'Approve and sign the digital contract') !!}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{!! getLocale($locale, 'label-how-sewagi-4-3-content', 'Safe yourself the hassle,<br>sign your contract digitally') !!}.</p>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="mb-15 image-card">
                                        <img src="{{ asset('img/owner4.svg') }}" />
                                    </div>
                                    <p class="mb-15 text-center text-color-dark font-size-20 title-card font-weight-bold">{{ getLocale($locale, 'label-how-sewagi-4-4-title', 'Get your passive income') }}</p>
                                    <p class="mb-15 text-center text-color-gray-1 text-card">{{ getLocale($locale, 'label-how-sewagi-4-4-content', 'Kick back and see your income grow') }}.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mt-30 text-center">
                                        <button class="btn btn-primary btn-wide" type="button" class="close font-weight-normal"
                                            data-toggle="modal" data-target="#modalPropertyLister">{{ getLocale($locale, 'label-do-it', "Let's do it") }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- end: how sewagi helps you -->
<!-- start: discover listings -->
<section class="section-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="font-size-32 font-weight-bold text-center mb-40">{{ getLocale($locale, 'label-discover-fit', "Discover listings that fit you the most") }}</h3>
            </div>
        </div>
        <div class="row row-discover-lists">
            <div class="col-lg-4 col-md-6 col-12 px-0 d-flex align-items-center background-primary-dark">
                <div class="discover-item co-living">
                    <div class="banner-tag mb-25 background-white">{{ getLocale($locale, 'label-discover-fit-1-1', 'Co-Living') }}</div>
                    <p class="font-size-13 color-white mb-15">{{ getLocale($locale, 'label-discover-fit-1-2', 'Willing to share living space with others?') }}</p>
                    <h4 class="font-size-20 font-weight-bold color-white mb-35">{{ getLocale($locale, 'label-discover-fit-1-3', 'We can help you find the best housemates match') }}.</h4>
                    <a class="btn btn-primary btn-wide btn-block" href="#">{{ getLocale($locale, 'label-discover-fit-1-4', 'Find me a co-living') }}</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 px-0 d-flex align-items-center background-aqua">
                <div class="discover-item active-worker">
                    <div class="banner-tag mb-25 background-white">{{ getLocale($locale, 'label-discover-fit-2-1', 'Active Worker') }}</div>
                    <p class="font-size-13 mb-15">{{ getLocale($locale, 'label-discover-fit-2-2', "Can’t find a living space near your office area?") }}</p>
                    <h4 class="font-size-20 font-weight-bold mb-35">{{ getLocale($locale, 'label-discover-fit-2-3', 'We have listings within walking distance near your office') }}.</h4>
                    <a class="btn btn-primary btn-wide btn-block" href="#">{{ getLocale($locale, 'label-discover-fit-2-4', 'Find a pad near my office') }}</a>
                </div>
            </div>
            <div class="col-lg-4 col-12 px-0 d-flex align-items-center background-primary-orange">
                <div class="discover-item family-friendly">
                    <div class="banner-tag mb-25 background-white">{{ getLocale($locale, 'label-discover-fit-3-1', 'Family Friendly') }}</div>
                    <p class="font-size-13 color-white mb-15">{{ getLocale($locale, 'label-discover-fit-3-2', 'Need a living area for your kids?') }}</p>
                    <h4 class="font-size-20 font-weight-bold color-white mb-35">{{ getLocale($locale, 'label-discover-fit-3-3', 'Worry no more. We can provide listings with school nearby') }}.</h4>
                    <a class="btn btn-primary btn-wide btn-block" href="#">{{ getLocale($locale, 'label-discover-fit-3-4', 'Find a pad near school') }}</a>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: discover listings -->
<!-- start: property owner -->
<section class="section-content background-primary-dark py-60 mt-120">
    <div class="container">
        <div class="row row-property-lister">
            <div class="col-md-6 col-12 d-flex flex-column flex-wrap justify-content-start align-items-center">
                <img class="img-fluid" src="{{ asset('img/sofa-asset.png') }}" />
            </div>
            <div class="col-md-6 col-12 d-flex flex-column flex-wrap justify-content-center align-items-center">
                <div class="property-lister text-center ml-xl-15">
                    <p class="font-mono text-color-orange text-uppercase mb-5">{{ getLocale($locale, 'label-as-role-1', 'Are you a property lister?') }}</p>
                    <h3 class="font-size-32 font-weight-bold color-white mb-40">{{ getLocale($locale, 'label-as-role-2', 'Go for effortless leasing as a') }}</h3>
                    <div class="btn-list-group">
                        <a class="btn btn-primary btn-wide" href="{{url('/property-lister/homeowner')}}" role="button">{{ getLocale($locale, 'label-as-role-3', 'Homeowner') }}</a>
                        <a class="btn btn-primary btn-wide" href="{{url('/property-lister/agent')}}" role="button">{{ getLocale($locale, 'label-as-role-4', 'Property Agent') }}</a>
                        <a class="btn btn-primary btn-wide" href="{{url('/property-lister/building-management')}}" role="button">{{ getLocale($locale, 'label-as-role-5', 'Building Management') }}</a>
                        <a class="btn btn-primary btn-wide" href="{{url('/property-lister/housemate')}}" role="button">{{ getLocale($locale, 'label-as-role-6', 'Housemate') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: property owner -->
@if($reviews->count() > 0)
<section class="section-content">
    <div class="container pt-100 pb-100">
        <div class="row">
            <div class="col-12">
                <p class="font-mono font-size-16 font-weight-bold text-color-orange text-uppercase text-center mb-35">{{ getLocale($locale, 'label-testimoni', '') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel owl-sewagi-testimonials">
                    @foreach($reviews as $review)
                    <div class="col-12">
                        <div class="testimonial-item">
                            <div class="testimonial-icon text-center">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <div class="testimonial-text text-center">
                                <p class="font-size-20 mb-0">{{ $review->message }}</p>
                            </div>
                            <div class="testimonial-image text-center">
                                <img class="rounded-circle" src="{{ $review->picture }}" alt="testimonial User">
                                <span class="testimonial-name d-block mb-10">{{ $review->name }}</span>
                                <span class="testimonial-role d-block">{{ $review->role }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- start: work with us -->
<section class="section-content background-light-orange section-work-with-us">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="work-with-us d-flex flex-column flex-wrap justify-content-center align-items-center pt-50 pb-75">
                    <p class="font-mono text-color-orange text-uppercase text-center mb-35">{{ getLocale($locale, 'label-work-with-us-1', '') }}</p>
                    <h3 class="font-size-22 font-weight-bold text-center mb-20">{{ getLocale($locale, 'label-work-with-us-2', '') }}</h3>
                    <a class="btn btn-primary btn-wide" href="{{url('/join/agent')}}">{{ getLocale($locale, 'label-work-with-us-3', '') }}</a>
                    <h3 class="font-size-22 font-weight-bold text-center mt-40 mb-20">{{ getLocale($locale, 'label-work-with-us-4', '') }}</h3>
                    <a class="btn btn-primary btn-wide" href="{{url('/join/company-client')}}">{{ getLocale($locale, 'label-work-with-us-5', '') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<template id="home-recent-search">
    <label class="btn btn-checkbox btn-rounded btn-outline-primary btn-overlay mr-10">
        <input class="home-recent" type="radio" /><span class="item-name"></span>
    </label>
</template>
<!-- end: work with us -->
<!-- start: recommend us -->
@component('_partials.recommend_us')
@endcomponent
<!-- end: recommend us -->
@endsection
