@extends('user._partials.master')
@section('content')
<div class="row" id="mainDashboard">
    <div class="col-md-8">
        @php
        $hour = date('H');
        $greetings = 'Halo';
        if ($hour >= 20) {
            $greetings = session('locale')=='id' ? "Selamat malam" : "Good Night";
        } elseif ($hour > 17) {
            $greetings = session('locale')=='id' ? "Selamat sore" : "Good Evening";
        } elseif ($hour > 11) {
            $greetings = session('locale')=='id' ? "Selamat siang" : "Good Afternoon";
        } elseif ($hour < 12) {
            $greetings = session('locale')=='id' ? "Selamat pagi" : "Good Morning";
        }
        @endphp
        <h6>{{ $greetings }}, {{ auth()->user()->fullname }}.</h6>
        <h3 class="mb-5">{{ session('locale')=='en' ? 'Welcome to your dashboard!' : 'Selamat datang di dasbor Anda!' }}</h3>
        <input type="hidden" id="user" value="{{json_encode($user)}}">

        @if ($activity)
        <input type="hidden" id="scheduleOptions" value="{{ $activity->options }}">
        <input type="hidden" id="scheduleId" value="{{ $activity->id }}">
        <div class="d-flex justify-content-between mb-3">
            @php
            $account = $activity->user_id == $user->id ? 'renter' : 'lister';
            @endphp
            <h6 class="text-muted">{{ $account == 'renter' ? 'My rent' : 'My published listing' }} - Ongoing activities
            </h6>
            <a href="#" class="btn btn-link">
                {{ getLocale($locale_dashboard, 'label-2', "See all ongoing activities") }}
                <img src="../img/long-arrow-right.svg" alt="">
            </a>
        </div>

        <div class="bg-white p-5 mb-5">
            <div class="row mb-2">
                <div class="col-md-4 text-center">
                    <img class="img-fluid mb-2" src="{{ $activity->property->photos[0]->thumb_images[0]->url }}" alt="">
                    <span class="text-muted">#208</span>
                </div>
                <div class="col-md-8">
                    <div class="tags mb-3">
                        <span class="card-tag tag-primary">
                            {{ $activity->living_condition == 'co-living' ? 'CO-LIVING' : 'ENTIRE APARTMENT' }}
                        </span>
                        <span class="card-tag tag-link">
                            @if (session('locale')=='id')
                                {{ $activity->type_tour == 'onsite' ? 'KUNJUNGAN LAPANGAN' : 'KUNJUNGAN VIRTUAL' }}
                            @else
                                {{ $activity->type_tour == 'onsite' ? 'ONSITE TOUR' : 'LIVE VIRTUAL TOUR' }}
                            @endif
                        </span>
                    </div>
                    <h4>{{ $activity->property->title }}</h4>
                    <span class="text-muted">
                        {{ $activity->property->address.' '.$activity->property->postcode }}
                    </span>
                    @if ($activity->confirmed_date)
                    <div>
                        <a href="https://maps.google.com/maps?saddr=My+Location&daddr={{$activity->property->latitude.','.$activity->property->longitude}}" target="_blank">
                            <b>Direction with Google Maps</b>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <ul class="list-unstyled my-status-list">
                <li>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <span class="text-muted">
                                @if (session('locale')=='id')
                                    {{ $account == 'renter' ? 'PENGIKLAN PROPERTI' : 'PERMINTAAN KUNJUNGAN' }}
                                @else
                                    {{ $account == 'renter' ? 'PROPERTY LISTER' : 'TOUR REQUEST' }}
                                @endif
                            </span>
                        </div>
                        <div class="col-md-9">
                            <h6 class="mb-0">
                                @if ($account == 'renter')
                                <b>{{ $activity->toUser->full_name }}</b>
                                <img class="img-profile-icon ml-3"
                                    src="{{ $activity->toUser->avatar ? $activity->toUser->avatar->url : '../img/dashboard/profile-pic.png' }}"
                                    alt="">
                                @else
                                <b>{{ $activity->user->full_name }}</b>
                                <img class="img-profile-icon ml-3"
                                    src="{{ $activity->user->avatar ? $activity->user->avatar->url : '../img/dashboard/profile-pic.png' }}"
                                    alt="">
                                @endif
                            </h6>
                        </div>
                    </div>
                </li>
                @if ($activity->living_condition == 'co-living')
                <li>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <span class="text-muted">
                                BEDROOM TYPE
                            </span>
                        </div>
                        <div class="col-md-9">
                            <h6 class="mb-0">
                                <b>{{ $activity->bedroom->name }}</b>
                            </h6>
                        </div>
                    </div>
                </li>
                @endif
                <li>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <span class="text-muted">
                                {{ getLocale($locale_dashboard, 'label-6', "VISIT DATE") }}
                            </span>
                        </div>
                        <div class="col-md-9">
                            <div class="visit-date d-flex justify-content-between">
                                @if (!$activity->confirmed_date && in_array($activity->status, [1,2,6]))
                                <div class="visit-date-holder">
                                    <div class="visit-date-item visit-date-head cursor-pointer collapsed"
                                        data-toggle="collapse" data-target="#visit-date-list">
                                        <h6 class="cursor-pointer mb-0 d-flex align-items-center">
                                            <b>{{ date('F d, Y', strtotime($activity->options[0]->time)) }}</b>
                                            <span class="dot d-inline-flex"></span>
                                            <b>{{ date('H:i A', strtotime($activity->options[0]->time)) }}</b>
                                        </h6>
                                    </div>
                                    <div id="visit-date-list" class="collapse">
                                        <ul class="list-unstyled">
                                            @foreach ($activity->options as $key => $q)
                                            @if ($key != 0)
                                            <li>
                                                <div class="visit-date-item">
                                                    <h6 class="cursor-pointer mb-0 d-flex align-items-center">
                                                        <b>{{ date('F d, Y', strtotime($q->time)) }}</b>
                                                        <span class="dot d-inline-flex"></span>
                                                        <b>{{ date('H:i A', strtotime($q->time)) }}</b>
                                                    </h6>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @if ($account == 'renter')
                                <a class="edit-visit-date" href="#" data-dismiss="modal" data-toggle="modal"
                                    data-target="#modalEditVisitDate">
                                    <img src="../img/dashboard/twoColor/edit.svg" alt="">
                                </a>
                                @endif
                                @endif

                                @if ($activity->confirmed_date && $activity->status == 3)
                                <div class="visit-date-item">
                                    <h6 class="cursor-pointer mb-0 d-flex align-items-center">
                                        <b>{{ date('F d, Y', strtotime($activity->confirmed_date)) }}</b>
                                        <span class="dot d-inline-flex"></span>
                                        <b>{{ date('H:i A', strtotime($activity->confirmed_date)) }}</b>
                                    </h6>
                                    <a href="#"><b>Add to my calendar</b></a>
                                </div>
                                    @php
                                    $timediff = strtotime($activity->confirmed_date) - strtotime(date('Y-m-d H:i:s'));
                                    @endphp
                                    @if ($account == 'renter' && ($timediff > 86400))
                                    <a class="edit-visit-date" id="btn-reschedule-date" href="#">
                                        <img src="../img/dashboard/twoColor/edit.svg" alt="">
                                    </a>
                                    @endif
                                @endif

                                @if ($activity->status == 4 || $activity->status == 5)
                                <div class="visit-date-item">
                                    <h6 class="cursor-pointer mb-0 d-flex align-items-center">
                                        @if ($account == 'renter')
                                            <b>Not available</b>
                                        @else
                                            @php
                                                $condition = $activity->living_condition == 'co-living' ? $activity->bedroom->name : '';    
                                            @endphp
                                            <b>Your property {{$condition}} is no longer available for visits.</b>
                                        @endif
                                    </h6>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="text-muted">
                                STATUS
                            </span>
                            <h6 class="mb-0">
                                <small>
                                    <b>{{ date('F d, Y', strtotime($activity->updated_at)) }} .
                                    {{ date('H:i A', strtotime($activity->updated_at)) }}</b>
                                </small>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-0">
                                @if ($activity->status == 4 || $activity->status == 5)
                                    @if ($activity->status == 4)
                                        @if ($account == 'renter')
                                            @php
                                                $condition = $activity->living_condition == 'co-living' ? 'This bedroom type' : 'Property'
                                            @endphp
                                            <b>{{ str_replace('[property]', $condition, $activity->tourStatus->en_renter_status) }}</b>
                                        @else
                                            @php
                                                $condition = $activity->living_condition == 'co-living' ? $activity->bedroom->name : 'Your property'
                                            @endphp
                                            <b>{{ str_replace('[property]', $condition, $activity->tourStatus->en_lister_status) }}</b>
                                        @endif
                                    @endif

                                    @if ($activity->status == 5)
                                        @if ($account == 'renter')
                                            @php
                                                $binding = ['[property]', '[date]'];
                                                $available_at = date('F d, Y', strtotime($activity->property_available_at));
                                                $condition = $activity->living_condition == 'co-living' ? ['This bedroom type', $available_at] : ['Property', $available_at];
                                            @endphp
                                            <b>{{ str_replace($binding, $condition, $activity->tourStatus->en_renter_status) }}</b>
                                        @else
                                            @php
                                                $condition = $activity->living_condition == 'co-living' ? $activity->bedroom->name : 'Your property'
                                            @endphp
                                            <b>{{ str_replace('[property]', $condition, $activity->tourStatus->en_lister_status) }}</b>
                                        @endif
                                    @endif
                                @else
                                <b>{{ $account == 'renter' ? $activity->tourStatus->en_renter_status : $activity->tourStatus->en_lister_status }}
                                    {{ $account == 'lister' && in_array($activity->status, [1,2]) && $activity->is_reschedule_tour ? 'updated' : '' }}</b>
                                @endif
                            </h6>
                        </div>

                        @if ($account == 'lister')
                        <div class="col-md-3">
                            @if ($activity->status == 1 || $activity->status == 2)
                            <a class="btn btn-primary" href="#" id="btn-reply-request">Reply
                            </a>
                            @endif

                            @if ($activity->status == 4 || $activity->status == 5)
                            <a class="btn btn-primary" href="#">Republish
                            </a>
                            @endif
                        </div>
                        @else
                        <div class="col-md-3">
                            @if ($activity->status == 4 || $activity->status == 5)
                            <a href="#"><small><b>View similar properties</b></small></a>
                            @endif
                        </div>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
        @endif

        <div class="grid mb-5" id="section-favourites">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="text-muted">{{ getLocale($locale_dashboard, 'label-8', "My favourites") }}</h6>
                <a href="#" class="btn btn-link">
                    {{ getLocale($locale_dashboard, 'label-9', "See all my favourites") }}
                    <img src="../img/long-arrow-right.svg" alt="">
                </a>
            </div>
            <div class="row" id="favourites-property"></div>
        </div>

        <div class="grid mb-5" id="section-recent-view">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="text-muted">{{ getLocale($locale_dashboard, 'label-10', "Recently viewed property") }}</h6>
                <a href="#" class="btn btn-link">
                    {{ getLocale($locale_dashboard, 'label-11', "See all recently viewed") }}
                    <img src="../img/long-arrow-right.svg" alt="">
                </a>
            </div>
            <div class="row" id="recent-view-property"></div>
        </div>

        <div class="grid mb-5" id="section-recent-searched">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="text-muted">Recent searched history</h6>
                <a href="#" class="btn btn-link">
                    See all recently searched
                    <img src="../img/long-arrow-right.svg" alt="">
                </a>
            </div>
            <div class="row" id="recent-searched-property"></div>
        </div>

        <div class="grid mb-5" id="section-nearme">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="text-muted">{{ getLocale($locale_dashboard, 'label-12', "Near me / Geolocation") }}</h6>
                <a href="#" class="btn btn-link">
                    {{ getLocale($locale_dashboard, 'label-13', "See all near me") }}
                    <img src="../img/long-arrow-right.svg" alt="">
                </a>
            </div>
            <div class="row" id="nearme-property"></div>
        </div>

        <div class="grid mb-5" id="section-most-searched">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="text-muted">Most searched area</h6>
                <a href="#" class="btn btn-link">
                    See all most sought
                    <img src="../img/long-arrow-right.svg" alt="">
                </a>
            </div>
            <div class="row" id="most-searched-property"></div>
        </div>

        <div class="grid mb-5" id="section-most-available">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="text-muted">Most availabilities area</h6>
                <a href="#" class="btn btn-link">
                    See all most availabilities
                    <img src="../img/long-arrow-right.svg" alt="">
                </a>
            </div>
            <div class="row" id="most-available-property"></div>
        </div>
    </div>
</div>

@if ($account == 'renter')
<div class="modal fade modal-dashboard" id="modalEditVisitDate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>

                <h4 class="mb-4">{{ getLocale($locale_dashboard, 'label-14', "Reschedule tour") }}</h4>
                <label class="fs-13 mb-4" for="">{{ getLocale($locale_dashboard, 'label-15', "CHANGE YOUR DATE & TIME") }}</label>
                <ol class="rescheduled-date-list">
                    @for ($i = 0; $i < 6; $i++) <li>
                        <div class="d-flex align-items-center">
                            <div id="dateTimePicker{{$i+1}}" class="input-group date-time-picker ml-3"
                                data-target-input="nearest">
                                <input type="text" class="form-control form-control-dashboard datetimepicker-input"
                                    id="time-{{$i}}" data-target="#dateTimePicker{{$i+1}}" data-toggle="datetimepicker"
                                    placeholder="{{ date('F d, Y H:i A', strtotime(date('Y-m-d H:i:s').'+1 day')) }}"
                                    data-filled="{{ count($activity->options) > $i ? 1 : 0 }}"
                                    value="{{ count($activity->options) > $i ? date('F d, Y H:i A', strtotime($activity->options[$i]->time)) : '' }}" />
                                <div class="input-group-prepend">
                                    <button class="btn btn-transparent-color delete-date" type="button">
                                        <img src="../img/close-big.png" alt="">
                                    </button>
                                </div>
                            </div>
                            <i class="far fa-calendar-alt ml-3 fs-20"></i>
                        </div>
                        </li>
                        @endfor
                </ol>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-primary" id="reschedule-time">RESCHEDULE</a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="modal fade modal-dashboard" id="modalPropertyTourRequest" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="../img/close-big.png" alt="">
                </button>

                <h4 class="mb-5">Property tour request</h4>

                <div class="row mb-2">
                    <div class="col-md-4 text-center">
                        <img class="img-fluid mb-2" src="{{ $activity->property->photos[0]->thumb_images[0]->url }}"
                            alt="">
                        <span class="text-muted">
                            #208
                        </span>
                    </div>
                    <div class="col-md-8">
                        <div class="tags mb-3">
                            <span class="card-tag tag-primary">
                                {{ $activity->living_condition == 'co-living' ? 'CO-LIVING' : 'ENTIRE APARTMENT' }}
                            </span>
                            <span class="card-tag tag-link">
                                {{ $activity->type_tour == 'onsite' ? 'ONSITE TOUR' : 'LIVE VIRTUAL TOUR' }}
                            </span>
                        </div>
                        <h4>{{ $activity->property->title }}</h4>
                        <span class="text-muted">
                            {{ $activity->property->address.' '.$activity->property->postcode }}
                        </span>
                    </div>
                </div>

                <ul class="list-unstyled my-status-list mb-0">
                    <li>
                        <div class="row align-items-center py-3">
                            <div class="col-md-3">
                                <span class="text-muted">
                                    TOUR REQUEST
                                </span>
                            </div>
                            <div class="col-md-9">
                                <h6 class="mb-0">{{ $activity->user->full_name }}
                                    <img class="img-profile-icon ml-3"
                                        src="{{ $activity->user->avatar ? $activity->user->avatar->url : '../img/dashboard/profile-pic.png' }}"
                                        alt="">
                                </h6>
                            </div>
                        </div>
                        @if ($activity->living_condition == 'co-living')
                        <div class="row align-items-center py-3">
                            <div class="col-md-3">
                                <span class="text-muted">
                                    BEDROOM TYPE
                                </span>
                            </div>
                            <div class="col-md-9">
                                <h6 class="mb-0">
                                    {{ $activity->bedroom->name }}
                                </h6>
                            </div>
                        </div>
                        @endif
                        <div class="row align-items-center py-3">
                            <div class="col-md-3">
                                <span class="text-muted">
                                    PROPERTY STATUS
                                </span>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex">
                                    <div class="custom-control custom-switch mx-3">
                                        <input type="checkbox" class="custom-control-input" id="property-status-switch"
                                            checked="true">
                                        <label class="custom-control-label" for="property-status-switch"></label>
                                    </div>
                                    <p class="mb-0" id="property-status-label">Available</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="property-available">
                        <div class="row py-3">
                            <div class="col-md-3">
                                <span class="text-muted">
                                    PICK A TOUR DATE
                                </span>
                            </div>
                            <div class="col-md-9">
                                <ul class="list-unstyled">
                                    @foreach ($activity->options as $key => $q)
                                    <li>
                                        <div class="d-flex mb-3">
                                            <div class="custom-control custom-switch mx-3">
                                                <input type="checkbox" class="custom-control-input checkbox-radio"
                                                    name="pick-time" data-id="{{ $q->id }}" id="pick-time-{{ $q->id }}">
                                                <label class="custom-control-label" for="pick-time-{{$q->id}}"></label>
                                            </div>
                                            <div class="visit-date-item">
                                                <h6 class="cursor-pointer mb-0 d-flex align-items-center">
                                                    {{ date('F d, Y', strtotime($q->time)) }}
                                                    <span class="dot d-inline-flex"></span>
                                                    {{ date('H:i A', strtotime($q->time)) }}
                                                </h6>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    <li>
                                        <div class="d-flex mb-3">
                                            <div class="custom-control custom-switch mx-3">
                                                <input type="checkbox" class="custom-control-input checkbox-radio"
                                                    name="pick-time" data-id="0" id="pick-time-unavailable">
                                                <label class="custom-control-label" for="pick-time-unavailable"></label>
                                            </div>
                                            <div class="visit-date-item">
                                                <h6 class="cursor-pointer mb-0 d-flex align-items-center">
                                                    I'm not available on these dates.
                                                </h6>
                                                <span class="text-muted">
                                                    <small>
                                                        Ask Sewagi to show property and report back.
                                                    </small>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li id="property-unavailable" style="display: none">
                        <div class="row py-3">
                            <div class="col-md-3">
                                <span class="text-muted">
                                    UNTIL WHEN
                                </span>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group date mb-3" id="date-picker" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-transparent bg-white" type="button">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-dashboard datetimepicker-input"
                                                id="unavailable-date" data-target="#date-picker"
                                                data-toggle="datetimepicker" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex mb-4">
                                            <div class="custom-control custom-switch mx-3">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="indefinitely-date">
                                                <label class="custom-control-label" for="indefinitely-date"></label>
                                            </div>
                                            <div class="visit-date-item">
                                                <h6 class="cursor-pointer mb-0 d-flex align-items-center">
                                                    Indefinitely
                                                </h6>
                                                <span class="text-muted">
                                                    <small>
                                                        Your property will be unpublished and no longer accessible to
                                                        prospect renters. You may publish it again at your own
                                                        convenience.
                                                    </small>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-primary disabled" id="btn-confirm-request">SUBMIT</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<template id="result-item">
    <div class="col-md-6">
        <div class="grid-item">
            <div class="card card-property" style="min-height:100% !important">
                @if(Auth::user())
                <button class="btn btn-icon-small btn-favorite add-favorite"><i
                        class="far fa-heart icon icon-small text-color-dark"></i></button>
                @else
                <button class="btn btn-icon-small btn-favorite" data-toggle="modal" data-target="#modalLogin"><i
                        class="far fa-heart icon icon-small text-color-dark"></i></button>
                @endif
                <div id="carousel-search-item-0" class="card-img-top carousel slide" data-ride="carousel" tabindex="0">
                    <ol class="carousel-indicators"></ol>
                    <div class="carousel-inner"></div>
                    <div class="tag-info-bottom">#INIHASTAG</div>
                </div>
                <div class="card-body box-container-card" style="z-index:10">
                    <div class="tags mb-16"></div>
                    <div class="box-container-card-info-left is-show-card">
                        <h4 class="card-title">Gading Icon</h4>
                        <p class="font-size-14 mb-0 address">Kebayoran Baru, South Jakarta</p>
                        <p class="font-size-14 mb-0">From <span class="font-weight-bold starting-price">Rp
                                20,070,000</span>
                        </p>
                        <hr />
                        <span class="d-flex">
                            <span class="font-size-12 mr-auto mb-0"><span class="font-weight-bold"></span></span>
                            <div>
                                <span class="font-size-12 mr-auto mb-0"><img class="icon-img if-img-big"
                                        src="{{ asset('/img/ic_size.png') }}" alt="icon room size"></i> <span
                                        class="room-size"></span> m<sup>2</sup> </span>
                                <span class="font-size-12 mb-0"> <img class="icon-img img-type"
                                        src="{{ asset('/img/coliving-icon.png') }}" alt="icon room availability"></i>
                                    <span class="available-room"><span class="font-weight-bold">2</span> /
                                        8</span></span>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="navigation">
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ getLocale($locale_dashboard, 'link-previous', "Previous") }}</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ getLocale($locale_dashboard, 'link-next', "Next") }}</span>
    </a>
</template>
@endsection
