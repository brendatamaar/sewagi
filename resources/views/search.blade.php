@extends('_partials.master')
@section('body')
<nav id="main-navbard" class="navbar fox-statis navbar-expand-lg navbar-light bg-white sticky-top fox-header-custom" >
    <div class="container px-0">
        <a class="navbar-brand" href="{{ url('') }}" style="max-height: 36px">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/#about-us">{{ getLocale($locale, 'link-about', 'About') }}</a>
            </li>
        </ul>
        <div class="navbar-search">
            <div class="input-group ">
                <div class="input-group-prepend">
                    <span class="input-group-text location-icon pl-20">A</span>
                </div>
                <input id="keyword" type="text" value="{{ request()->q }}" class="form-control border-0 searchbox-input" placeholder="{{ getLocale($locale, 'placeholder-search', 'Enter location, property name, company or education entity') }}" aria-label="Text input with segmented dropdown button">
                <input type="hidden" id="prevSearch" value="{{ json_encode($search) }}">
                <div class="input-group-prepend">
                    <span class="input-group-text removeLocation"><i class="fas fa-times"></i></span>
                    <span class="input-group-text input-group-target">
                        <button type="button" class="btn btn-grey btn-target currentLocation"><i class="fanicon-target-two"></i></button>
                    </span>
                </div>
            </div>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                @if(empty(Auth::user()))
                <a href="#" class="nav-link" data-toggle="modal" data-target="#modalLogin" >{{ getLocale($locale, 'link-login', 'Log in') }}</a>
                @else
                <a class="nav-link" href="{{url('/logout')}}" >{{ getLocale($locale, 'link-logout', 'Log out') }}</a>
                @endif
            </li>
            <li class="nav-item">
                <a class="nav-link primary" href="#" data-toggle="modal" data-target="#modalPropertyLister">{{ getLocale($locale, 'link-list-your-property', 'List Your Property') }} <img src="{{ asset('img/long-arrow-right.svg') }}" class="ml-10" alt="long arrow right"></a>
            </li>
        </ul>
    </div>
</div>
<div class="headre-line"></div>

<section class="filter collapse navbar-collapse" data-background-color="aqua" style="width: 100%;padding-top: 10px;">
    <div class="container wide d-flex flex-wrap px-0">
        <div class="search-filterbox fox-search-custom">
            <div class="filterbox-divider"></div>
            <div class="filterbox-content flex-column justify-content-end pt-1 pb-1">
                <p class="font-size-11 text-color-gray-6 mb-0 text-uppercase filterbox-label">{{ getLocale($locale_search, 'label-title-1', 'Living Condition') }}</p>
                <div class="fox-dropdown-nav search-filter-item">
                    <div id="menu1" class="form-control font-size-12 btn-dropdown-nav" role="button" id="dropdownMenuFly1" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"><span id="lblMenu1">{{ getLocale($locale_search, 'label-sub-title-1', '') }}</span><i class="fas fa-caret-down icon-arrow"></i></div>
                    <div class="flying-dropdown dropdown-menu" aria-labelledby="dropdownMenuFly1">
                        <div class="d-flex align-items-center justify-content-between mb-5" >
                            <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-1-1', '') }}</label>
                            <label class="switch">
                                <input type="checkbox" class="main-filter" data-param="cond_co_living" data-type="condition">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-5" >
                            <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-1-2', '') }}</label>
                            <label class="switch">
                                <input type="checkbox" class="main-filter" data-param="cond_entire_space" data-type="condition">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button id="livingCondReset" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12 invisible">{{ session('locale')=='id' ? 'Atur Ulang' : 'Reset' }}</button>
                            <button id="livingCondApply" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12">{{ getLocale($locale_search, 'label-apply', '') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-filterbox fox-search-custom">
            <div class="filterbox-divider"></div>
            <div class="filterbox-content flex-column justify-content-end pt-1 pb-1">
                <p class="font-size-11 text-color-gray-6 mb-0 text-uppercase filterbox-label">{{ getLocale($locale_search, 'label-title-2', 'Property Type') }}</p>
                <div class="fox-dropdown-nav search-filter-item">
                    <div id="menu2" class="form-control font-size-12 btn-dropdown-nav" data-toggle="dropdown" role="button" id="dropdownMenuFly2" aria-haspopup="true" aria-expanded="false"><span id="lblMenu2">{{ getLocale($locale_search, 'label-sub-title-2', '') }}</span><i class="fas fa-caret-down icon-arrow"></i></div>
                    <div class="flying-dropdown dropdown-menu" aria-labelledby="dropdownMenuFly2">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-2-1', '') }}</label>
                            <label class="switch">
                                <input type="checkbox" class="main-filter" data-param="type_apartment" data-type="property_type">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-5" >
                            <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-2-2', '') }}</label>
                            <label class="switch">
                                <input type="checkbox" class="main-filter" data-param="type_house" data-type="property_type">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button id="propertyTypeReset" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12 invisible">{{ session('locale')=='id' ? 'Atur Ulang' : 'Reset' }}</button>
                            <button id="propertyTypeApply" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12">{{ getLocale($locale_search, 'label-apply', '') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-filterbox fox-search-custom">
            <div class="filterbox-divider"></div>
            <div class="filterbox-content flex-column justify-content-end pt-1 pb-1">
                <p class="font-size-11 text-color-gray-6 mb-0 text-uppercase filterbox-label">{{ getLocale($locale_search, 'label-title-3', '') }} <sup class="text-color-gray-6 font-weight-normal" style="text-transform: none;">Beta</sup></p>
                <div class="fox-dropdown-nav commute-time-dropdown search-filter-item">

                    <div id="menu3" class="form-control font-size-12 btn-dropdown-nav" data-toggle="dropdown" role="button" id="dropdownMenuFly3" aria-haspopup="true" aria-expanded="false">
                        <span id="lblMenu3">{{ getLocale($locale_search, 'label-sub-title-3', 'Add commute time') }}</span> <i class="fas fa-caret-down icon-arrow"></i>
                    </div>
                    <div class="flying-dropdown dropdown-menu" aria-labelledby="dropdownMenuFly3">
                        <div class="">
                            <div class="pb-10">
                                <div class="row align-items-center" style="min-width: 750px;">
                                    <div class="col-lg-2 pr-0">
                                        <div class="form-group">
                                            <select class="select2 select2-list-property main-commute form-control" data-type="time" name="time">
                                                <option value="5">5 {{ session('locale', 'en') == 'en' ? 'min' : 'menit' }}</option>
                                                <option value="15">15 {{ session('locale', 'en') == 'en' ? 'min' : 'menit' }}</option>
                                                <option value="30">30 {{ session('locale', 'en') == 'en' ? 'min' : 'menit' }}</option>
                                                <option value="45">45 {{ session('locale', 'en') == 'en' ? 'min' : 'menit' }}</option>
                                                <option value="60">60 {{ session('locale', 'en') == 'en' ? 'min' : 'menit' }}</option>
                                                <option value="90">90 {{ session('locale', 'en') == 'en' ? 'min' : 'menit' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto pr-0">
                                         <div class="form-group form-control-style text-color-dark px-2">{{ getLocale($locale_search, 'label-search-3-1', '') }}</div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="input-group input-homepage mb-20 custom-input-group background-white">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text icon-location">A</span>
                                                </div>
                                                <input type="text" name="main-commute" class="form-control searchbox-input searchbox-primary border-0" data-type="commute" id="main-commute" placeholder="{{ getLocale($locale, 'placeholder-search', 'Enter location, property name, company or education entity') }}">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text removeLocation" data-type="commute"><i class="fas fa-times"></i></span>
                                                    <span class="input-group-text input-group-target">
                                                        <button type="button" class="btn btn-grey btn-target currentCommuteLocation"><i class="fanicon-target-two"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto px-0">
                                         <div class="form-group form-control-style text-color-dark px-2">{{ getLocale($locale_search, 'label-search-3-2', '') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <select class="select2 select2-list-property form-control main-commute" data-type="commute_type" name="commute_type">
                                                <option value="car">{{ getLocale($locale, 'label-car', 'Car') }}</option>
                                                <option value="cycle">{{ getLocale($locale, 'label-motorbike', 'Motorcycle') }}</option>
                                                <option value="walk">{{ getLocale($locale, 'label-walking', 'Walking') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <input type="hidden" name="is_commute" value="0" id="input-is-commute">
                                <button href="#" id="commuteReset" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12">{{ getLocale($locale_search, 'label-reset', 'Reset') }}</button>
                                <button href="#" id="commuteApply"class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12">{{ getLocale($locale_search, 'label-apply', 'Apply') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-filterbox fox-search-custom">
            <div class="filterbox-divider"></div>
            <div class="filterbox-content flex-column justify-content-end pt-1 pb-1">
                <p class="font-size-11 text-color-gray-6 mb-0 text-uppercase filterbox-label">{{ getLocale($locale_search, 'label-title-4', '') }}</p>
                <div class="fox-dropdown-nav search-filter-item">
                    <div id="menu4" class="form-control font-size-12 btn-dropdown-nav" data-toggle="dropdown" role="button" id="dropdownMenuFly3" aria-haspopup="true" aria-expanded="false"><span>{{ getLocale($locale_search, 'label-sub-title-4', '') }}</span> <i class="fas fa-caret-down icon-arrow"></i> </div>
                    <div class="flying-dropdown dropdown-menu dropdown-menu-lg" aria-labelledby="dropdownMenuFly4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group-title dropdown-menu-item">{{ getLocale($locale_search, 'label-search-4-1', '') }}</div>
                                <div class="mb-10">
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">3 {{ getLocale($locale_search, 'label-search-4-2', '') }}</label>
                                        <label class="switch">
                                            <input type="radio" name="range_of_stay" value="3" data-type="3-months">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">6 {{ getLocale($locale_search, 'label-search-4-2', '') }}</label>
                                        <label class="switch">
                                            <input type="radio" name="range_of_stay" value="6" data-type="6-months">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">9 {{ getLocale($locale_search, 'label-search-4-2', '') }}</label>
                                        <label class="switch">
                                            <input type="radio" name="range_of_stay" value="9" data-type="9-months">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">1 {{ getLocale($locale_search, 'label-search-4-3', '') }}</label>
                                        <label class="switch">
                                            <input type="radio" name="range_of_stay" value="12" data-type="1-year">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group-title dropdown-menu-item">{{ getLocale($locale_search, 'label-search-4-4', 'Payment terms') }}</div>
                                <div class="mb-10">
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-4-5', '') }}</label>
                                        <label class="switch">
                                            <input type="checkbox" name="payment_options" value="12" data-type="monthly">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-4-6', '') }}</label>
                                        <label class="switch">
                                            <input type="checkbox" name="payment_options" value="3" data-type="quarterly">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-4-7', '') }}</label>
                                        <label class="switch">
                                            <input type="checkbox" name="payment_options" value="6" data-type="twice">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-5" >
                                        <label class="dropdown-menu-item">{{ getLocale($locale_search, 'label-search-4-8', '') }}</label>
                                        <label class="switch">
                                            <input type="checkbox" name="payment_options" value="1" data-type="once">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button id="termReset" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12 invisible">{{ getLocale($locale_search, 'label-reset', 'Reset') }}</button>
                            <button id="termApply" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12">{{ getLocale($locale_search, 'label-apply', 'Apply') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-filterbox fox-search-custom">
            <div class="filterbox-divider"></div>
            <div class="filterbox-content flex-column justify-content-end pt-1 pb-1">
                <p class="font-size-11 text-color-gray-6 mb-0 text-uppercase filterbox-label">{{ getLocale($locale_search, 'label-title-5', 'Monthly Budget') }}</p>
                <div class="fox-dropdown-nav search-filter-item">
                    <div id="menu5" class="form-control font-size-12 btn-dropdown-nav" data-toggle="dropdown" role="button" id="dropdownMenuFly5" aria-haspopup="true" aria-expanded="false"><span id="lblMenu5">{{ getLocale($locale_search, 'label-sub-title-5', '') }}</span> <i class="fas fa-caret-down icon-arrow"></i> </div>
                    <div class="flying-dropdown dropdown-menu" aria-labelledby="dropdownMenuFly5">
                        <div class="min-width-400">
                            <div id="searchbox-slider-1" class="mt-20 mb-10"></div>
                            <input type="text" class="fox-hide" id="searchbox-slider-1-input-1">
                            <input type="text" class="fox-hide" id="searchbox-slider-1-input-2">
                            <div class="d-flex mb-5">
                                <span class="mr-auto" id="searchbox-slider-1-text-1">{{ session('locale')=='id' ? 'RP' : 'IDR' }} 1</span>
                                <span id="searchbox-slider-1-text-2">{{ session('locale')=='id' ? 'RP' : 'IDR' }} 3.000.000.000</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <button id="priceReset" class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12 invisible">{{ getLocale($locale_search, 'label-reset', 'Reset') }}</button>
                                <button class="btn p-0 text-capitalize text-muted font-weight-normal text-color-gray-6 font-size-12 apply-price">{{ getLocale($locale_search, 'label-apply', 'Apply') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-filterbox search-filterbox-more-filter">
            <div class="filterbox-divider"></div>
            <div class="filterbox-content flex-column justify-content-center pt-1 pb-1">
                <a href="javascript:void(0);" class="morefilter-trigger font-size-13">{{ getLocale($locale_search, 'label-title-6', '+ More Filter') }}</a>
            </div>
        </div>
        <div class="search-filterbox fox-search-custom">
            <div class="filterbox-content flex-column justify-content-end pt-1 pb-1">
                <p class="font-size-11 text-color-gray-6 mb-0 text-uppercase filterbox-label">{{ getLocale($locale_search, 'label-title-7', '') }}</p>
                <div class="fox-dropdown-nav">
                    <div id="menu6" class="form-control font-size-12 btn-dropdown-nav text-color-dark" role="button" id="dropdownMenuFly6" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false"><span>{{ getLocale($locale_search, 'label-search-7-1', 'Most Viewed') }}</span> <i class="fas fa-caret-down icon-arrow"></i> </div>
                    <div class="flying-dropdown dropdown-menu" aria-labelledby="dropdownMenuFly6">
                        <a href="#" class="border-bottom dropdown-item dropdown-menu-item px-0">{{ getLocale($locale_search, 'label-search-7-2', 'Latest') }}</a>
                        <a href="#" class="border-bottom dropdown-item dropdown-menu-item px-0">{{ getLocale($locale_search, 'label-search-7-3', 'Lowest rate') }}</a>
                        <a href="#" class="border-bottom dropdown-item dropdown-menu-item px-0">{{ getLocale($locale_search, 'label-search-7-4', 'Highest rate') }}</a>
                        <a href="#" class="dropdown-item dropdown-menu-item px-0">{{ getLocale($locale_search, 'label-search-7-5', 'Most Reviewed') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-filterbox filterbox-wrap">
            <div class="filterbox-divider"></div>
            <div class="filterbox-content align-items-center pt-1 pb-1 pr-0">
                <button id="btn-filter-show-grid" class="btn active btn-checkbox btn-outline-orange btn-borderless btn-icon mr-5"><i class="fas fa-th"></i></button>
                <button id="btn-filter-show-map" class="btn btn-checkbox btn-outline-orange btn-borderless btn-icon"><i class="far fa-map"></i></button>
            </div>
        </div>
    </div>
</section>
</nav>
<div id="loading-wrapper">
    <div class="loading loading-0"></div>
    <div class="loading loading-1"></div>
    <div class="loading loading-2"></div>
</div>
<div class="main-content">
    <section id="search-section" class="grid-open">
        <div class="grid">
            <div class="grid-content">
                <div id="resultEmpty" class="grid-container container wide"></div>
                    <div id="resultCount" class="grid-container container wide" style="display:none">
                    <div class="result-count-found-text"><span id="listingFound">56</span> {{ getLocale($locale, 'link-found', 'LISTINGS FOUND') }}</div>
                </div>
                <div id="results" class="grid-container container wide"></div>
            </div>
            <div class="loading-wrapper-grid" style="display: none">
                <div class="loading loading-0"></div>
                <div class="loading loading-1"></div>
                <div class="loading loading-2"></div>
            </div>
        </div>
        <div class="map">
            <div id="search-map"></div>
        </div>
    </section>
    @if(Auth::user())
    <div id="auth" data-liked="@json(Auth::user()->property_favorites)"></div>
    @endif
</div>

<div class="modal fade modal-dashboard" id="modalMoveMap" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p>If you navigate the map while commute time is
                    enabled, commute time details will be overridden.</p>
                <p>Do you wish to proceed ?</p>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="overrideCommute">OK</button>
                </div>

            </div>
        </div>
    </div>
</div>

<template id="result-item">
    <div class="grid-item">
        <div class="card card-property" style="min-height:100% !important">
            @if(Auth::user())
            <button class="btn btn-icon-small btn-favorite add-favorite"><i class="far fa-heart icon icon-small text-color-dark"></i></button>
            @else
            <button class="btn btn-icon-small btn-favorite" data-toggle="modal" data-target="#modalLogin"><i class="far fa-heart icon icon-small text-color-dark"></i></button>
            @endif
            <div id="carousel-search-item-0" class="card-img-top carousel slide" data-ride="carousel" tabindex="0">
                <ol class="carousel-indicators"></ol>
                <div class="carousel-inner"></div>
                <div class="tag-info-bottom"></div>
            </div>
            <div class="card-body box-container-card" style="z-index:10">
                <div class="tags mb-16"></div>
                <div class="box-container-card-info-left is-show-card">
                    <h4 class="card-title">Gading Icon</h4>
                    <p class="font-size-14 mb-0 address">Kebayoran Baru, {{ getLocale($locale, 'label-direction-s', '') }}</p>
                    <p class="font-size-14 mb-0">{{ getLocale($locale_search, 'label-from', '') }} <span class="font-weight-bold starting-price">-</span></p>
                    <hr/>
                    <span class="d-flex">
                        {{-- <span class="font-size-12 mr-auto mb-0"><span class="font-weight-bold"></span></span> --}}
                        <div>
                            <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big" src="{{ asset('/img/ic_size.png') }}" alt="icon room size"></i> <span class="room-size"></span> m<sup>2</sup> </span>
                            <span class="font-size-12 mb-0"> <img class="icon-img img-type" src="{{ asset('/img/coliving-icon.png') }}" alt="icon room availability"></i> <span class="available-room"><span class="font-weight-bold">2</span> / 8</span></span>
                        </div>
                    </span>
                </div>

                <div class="box-container-card-info-right">
                    <h4 class="card-title">bukan gading baru</h4>
                    <p class="font-size-14 mb-0">kebayoran lama</p>
                    <p class="font-size-14 mb-0">{{ getLocale($locale_search, 'label-from', '') }} <span class="font-weight-600">Rp 5000</span></p>
                    <hr/>
                    <span class="d-flex">
                        <span class="font-size-12 ml-auto mb-0"><img class="icon-img if-img-big" src="{{ asset('/img/ic_size.png') }}" alt="icon room size"></i> <span>8788</span>m<sup>2</sup> </span>
                        <span class="font-size-12 mb-0"> <img class="icon-img" src="{{ asset('/img/coliving-icon.png') }}" alt="icon room availability"> <span class="font-weight-bold">2</span> / 8</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="navigation">
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icon-arrow" aria-hidden="true"></span>
        <span class="sr-only">{{ getLocale($locale, 'link-previous', '') }}</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon icon-arrow" aria-hidden="true"></span>
        <span class="sr-only">{{ getLocale($locale, 'link-next', '') }}</span>
    </a>
</template>

<template id="not-found">
    <div class="px-15 w-100">
        <div class="mt-15 mb-15">0 {{ getLocale($locale, 'link-found', '') }}</div>
        <div class="search-not-found-box mb-70 mt-15">
            <div class="mb-15">
                <div class="search-not-found-text-yellow d-none">
                    <strong>{{ getLocale($locale_search, 'label-search-other-1', 'At this time, we only serve the city of') }}
                        <a href="#" class="notfound-filter" data-place_id="ChIJnUvjRenzaS4RoobX2g-_cVM" data-name="Jakarta, Indonesia">Jakarta</a>.
                    </strong>
                </div>
                <div class="search-not-found-text-yellow">
                    <strong>{{ getLocale($locale_search, 'label-search-other-2', "Oops! We didn't find anything matching your search") }}.</strong>
                </div>
                <div class="search-not-found-text-yellow">
                    <strong>At this time we only serve the city of <a href="#" class="notfound-filter">Jakarta</a>,</strong>
                </div>
                <div class="search-not-found-text-yellow">
                    <strong>{{ getLocale($locale_search, 'label-search-other-3', 'you can adjust your filters') }}  <a href="#" class="notfound-filter">{{ getLocale($locale_search, 'label-search-other-4', 'here') }}</a>.</strong>
                </div>
            </div>
            <div class="mb-15">
                <div class="text-color-dark">
                    <strong>{{ getLocale($locale_search, 'label-search-other-5', '') }},</strong>
                </div>
                <div class="text-color-dark">
                    <strong>{{ getLocale($locale_search, 'label-search-other-6', '') }}</strong>
                </div>
            </div>
            <div class="mb-15">
                <button type="button" class="btn btn-primary btn-wide" data-toggle="modal" data-target="#share-it-here-modal">{{ getLocale($locale_footer, 'label-footer-right-2', '') }}</button>
            </div>
        </div>
    </div>
</template>

<template id="discover">
    <div id="promo" class="container wide">
        <div class="row row-discover-lists discover-list" style="padding: 15px;"></div>
    </div>
</template>

<template id="d_coliving">
    <div class="discover-box col-lg-4 col-md-6 col-12 px-0 d-flex align-items-center background-primary-dark width-max">
        <div class="discover-item co-living">
            <div class="banner-tag mb-25 background-white">{{ getLocale($locale_search, 'label-discover-fit-1-1', 'Co-Living') }}</div>
            <p class="font-size-13 color-white mb-15">{{ getLocale($locale_search, 'label-discover-fit-1-2', 'Willing to share living space with others?') }}</p>
            <h4 class="font-size-20 font-weight-bold color-white mb-25">{{ getLocale($locale_search, 'label-discover-fit-1-3', 'We can help you get matched with housemates') }}.</h4>
            <a class="btn btn-primary btn-wide" href="#">{{ getLocale($locale_search, 'label-discover-fit-1-4', 'Find me a co-living') }}</a>
        </div>
    </div>
</template>

<template id="d_worker">
    <div class="discover-box col-lg-4 col-md-6 col-12 px-0 d-flex align-items-center background-aqua width-max">
        <div class="discover-item active-worker">
            <div class="banner-tag mb-25 background-white">{{ getLocale($locale_search, 'label-discover-fit-2-1', 'Active Worker') }}</div>
            <p class="font-size-13 mb-15">{{ getLocale($locale_search, 'label-discover-fit-2-2', "Can't find a living space near your office area?") }}</p>
            <h4 class="font-size-20 font-weight-bold mb-25">{{ getLocale($locale_search, 'label-discover-fit-2-3', 'We have listings within walking distance of your office') }}.</h4>
            <a class="btn btn-primary btn-wide" href="#">{{ getLocale($locale_search, 'label-discover-fit-2-4', 'Find a pad near my office') }}</a>
        </div>
    </div>
</template>

<template id="d_family">
    <div class=" discover-box col-lg-4 col-12 px-0 d-flex align-items-center background-primary-orange width-max">
        <div class="discover-item family-friendly">
            <div class="banner-tag mb-25 background-white">{{ getLocale($locale_search, 'label-discover-fit-3-1', 'Family Friendly') }}</div>
            <p class="font-size-13 color-white mb-15">{{ getLocale($locale_search, 'label-discover-fit-3-2', 'Need a living area for your kids?') }}</p>
            <h4 class="font-size-20 font-weight-bold color-white mb-25">{{ getLocale($locale_search, 'label-discover-fit-3-3', 'Worry no more. We can help you find homes near schools') }}.</h4>
            <a class="btn btn-primary btn-wide" href="#">{{ getLocale($locale_search, 'label-discover-fit-3-4', 'Find a home near schools') }}</a>
        </div>
    </div>
</template>

<template id="pagination">
    <div class="container wide d-flex justify-content-center align-items-center pagination-wrapper">
        <ul class="pagination"></ul>
    </div>
</template>

@endsection

@push('js')
<script src="{{asset('plugins/accounting/accounting.min.js')}}"></script>
<script>
    $('#main-navbar').removeClass('cookie-active');
</script>
@endpush
