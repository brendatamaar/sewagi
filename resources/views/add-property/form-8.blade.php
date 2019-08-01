@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData8" role="form" method="POST" action="{{ url('/create-property/8') }}" class="form-list-property">
@csrf
    <div class="col-md-12">
        <div class="mb-5">
            <h4 class="mb-4 required">{{ getLocale($locale_form8, 'label-1', "Set up your preferred payment options") }}</h4>
        </div>
        <div class="mb-5">
            @php
                if (session('locale')=='id') {
                    $_property = strtolower($property->type) == 'apartment' ? 'Apartemen' : 'Rumah' ;
                } else {
                    $_property = strtolower($property->type);
                }
            @endphp
            <h5 class="mb-4">{{ getLocale($locale_form8, 'label-2', 'Entire') }} {{ ucfirst($_property) }}</h5>
            <div id="length-of-stay-container">
                @if(isset($propertyPriceDetail))
                    @foreach($propertyPriceDetail as $key => $value)
                    <div class="card card-body mb-5 length-stay-row">
                        <div class="d-flex justify-content-between">
                            <label class="mb-4 text-muted">{{ getLocale($locale_form8, 'label-3', 'LENGTH OF STAY') }}</label>
                            <a href="#" class="btn btn-link btn-save-length-stay" style="display: none;">
                                {{ getLocale($locale_form8, 'label-4', 'Save') }}
                            </a>
                            <span class="btn-edit-container" style="display: none;">
                                <a href="#" class="mr-3 btn btn-link btn-edit-length-stay">
                                    {{ getLocale($locale_form8, 'label-5', 'Edit') }}
                                </a>
                                <a href="#" class="btn btn-link btn-delete-length-stay">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </span>
                        </div>
                        <select class="select2 select2-list-property length-stay" name="length" placeholder="">
                            <option value=""></option>
                            <option value="1 year" {{ $value->length == 12 ? 'selected' : '' }}>1 {{ getLocale($locale_form8, 'label-6', 'year') }}</option>
                            <option value="9 months" {{ $value->length == 9 ? 'selected' : '' }}>9 {{ getLocale($locale_form8, 'label-7', 'months') }}</option>
                            <option value="6 months" {{ $value->length == 6 ? 'selected' : '' }}>6 {{ getLocale($locale_form8, 'label-7', 'months') }}</option>
                            <option value="3 months" {{ $value->length == 3 ? 'selected' : '' }}>3 {{ getLocale($locale_form8, 'label-7', 'months') }}</option>
                        </select>
                        <div class="payment-terms mt-5">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <label class="text-muted">{{ getLocale($locale_form8, 'label-8', 'PAYMENT TERMS') }}</label>
                                    <a href="" class="btn btn-link btn-select-all">
                                        {{ getLocale($locale_form8, 'label-9', 'Select all') }}
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-muted">{{ getLocale($locale_form8, 'label-10', 'The following rates must include TAX') }}</p>
                                </div>
                                <ul class="col-md-12 list-group pl-4">
                                    <li class="list-group-item paid-once" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_once > 0 ? 'active' : '' }}">
                                                <input type="checkbox" {{ $value->paid_once > 0 ? 'checked' : '' }}>+
                                            </label>
                                            <span class="font-weight-bolder">
                                                {{ getLocale($locale_form8, 'label-11', 'Paid once') }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            <div class="form-inline row mb-4">
                                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_once" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', 'Input your rate') }}" value="{{ ($value->paid_once <= 0) ? '' : $value->paid_once }}">
                                                </div>
                                                <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form8, 'label-6', 'year') }}</p>
                                            </div>
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                                    <label class="custom-control-label" for="nego-twice-switch"></label>
                                                </div>
                                                <p id="nego-twice-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item paid-twice" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_twice > 0 ? 'active' : '' }}">
                                                <input type="checkbox" {{ $value->paid_twice > 0 ? 'checked' : '' }}>+
                                            </label>
                                            <span class="font-weight-bolder" >
                                                {{ getLocale($locale_form8, 'label-15', "Paid twice") }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            <div class="form-inline row mb-4">
                                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_twice" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', "Input your rate") }}" value="{{ ($value->paid_twice <= 0) ? '' : $value->paid_twice }}">
                                                </div>
                                                <p class="mb-0 col-auto required pl-0">/ 6 {{ getLocale($locale_form8, 'label-7', "months") }}</p>
                                            </div>
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                                    <label class="custom-control-label" for="nego-twice-switch"></label>
                                                </div>
                                                <p id="nego-twice-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item paid-quarterly" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_quarterly > 0 ? 'active' : '' }}">
                                                <input type="checkbox" {{ $value->paid_quarterly > 0 ? 'checked' : '' }}>+
                                            </label>
                                            <span class="font-weight-bolder">
                                                {{ getLocale($locale_form8, 'label-16', "Paid quarterly") }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            <div class="form-inline row mb-4">
                                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_quarterly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', "Input your rate") }}" value="{{ ($value->paid_quarterly <= 0) ? '' : $value->paid_quarterly }}">
                                                </div>
                                                <p class="mb-0 col-auto required pl-0">/ 3 {{ getLocale($locale_form8, 'label-7', "months") }}</p>
                                            </div>
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-quarterly-switch">
                                                    <label class="custom-control-label" for="nego-quarterly-switch"></label>
                                                </div>
                                                <p id="nego-quarterly-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item paid-monthly" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_monthly > 0 ? 'active' : '' }}">
                                                <input type="checkbox" {{ $value->paid_monthly > 0 ? 'checked' : '' }}>+
                                            </label>
                                            <span class="font-weight-bolder" >
                                                {{ getLocale($locale_form8, 'label-17', "Paid monthly") }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            <div class="form-inline row mb-4">
                                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_monthly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', "Input your rate") }}" value="{{ ($value->paid_monthly <= 0) ? '' : $value->paid_monthly }}">
                                                </div>
                                                <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form8, 'label-7', "month") }}</p>
                                            </div>
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-monthly-switch">
                                                    <label class="custom-control-label" for="nego-monthly-switch"></label>
                                                </div>
                                                <p id="nego-monthly-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div id="length-stay-row-clone" class="card card-body mb-5 length-stay-row" style="display: none;">
            <div class="d-flex justify-content-between">
                <label class="mb-4 text-muted">{{ getLocale($locale_form8, 'label-18', "LENGTH OF STAY") }}</label>
                <a href="#" class="btn btn-link btn-save-length-stay" style="display: none;">
                    {{ getLocale($locale_form8, 'label-4', "Save") }}
                </a>
                <span class="btn-edit-container" style="display: none;">
                    <a href="#" class="mr-3 btn btn-link btn-edit-length-stay">
                        {{ getLocale($locale_form8, 'label-5', "Edit") }}
                    </a>
                    <a href="#" class="btn btn-link btn-delete-length-stay">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </span>
            </div>
            <select class="select2 select2-list-property length-stay" name="length" placeholder="">
                <option value=""></option>
                <option value="1 year">1 {{ getLocale($locale_form8, 'label-6', "year") }}</option>
                <option value="9 months">9 {{ getLocale($locale_form8, 'label-7', "months") }}</option>
                <option value="6 months">6 {{ getLocale($locale_form8, 'label-7', "months") }}</option>
                <option value="3 months">3 {{ getLocale($locale_form8, 'label-7', "months") }}</option>
            </select>
            <div class="payment-terms mt-5">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <label class="text-muted">{{ getLocale($locale_form8, 'label-8', "PAYMENT TERMS") }}</label>
                        <a href="" class="btn btn-link btn-select-all">
                            {{ getLocale($locale_form8, 'label-9', "Select all") }}
                        </a>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted">{{ getLocale($locale_form8, 'label-10', "The following rates must include TAX") }}</p>
                    </div>
                    <ul class="col-md-12 list-group pl-4">
                        <li class="list-group-item paid-once" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form8, 'label-11', "Paid once") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_once" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form8, 'label-6', "year") }}</p>
                                </div>
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                        <label class="custom-control-label" for="nego-twice-switch"></label>
                                    </div>
                                    <p id="nego-twice-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-twice" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder" >
                                    {{ getLocale($locale_form8, 'label-15', "Paid twice") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_twice" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ 6 {{ getLocale($locale_form8, 'label-7', "months") }}</p>
                                </div>
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                        <label class="custom-control-label" for="nego-twice-switch"></label>
                                    </div>
                                    <p id="nego-twice-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-quarterly" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form8, 'label-16', "Paid quarterly") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_quarterly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ 3 {{ getLocale($locale_form8, 'label-7', "months") }}</p>
                                </div>
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-quarterly-switch">
                                        <label class="custom-control-label" for="nego-quarterly-switch"></label>
                                    </div>
                                    <p id="nego-quarterly-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-monthly" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder" >
                                    {{ getLocale($locale_form8, 'label-17', "Paid monthly") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_monthly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form8, 'label-7', "month") }}</p>
                                </div>
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-monthly-switch">
                                        <label class="custom-control-label" for="nego-monthly-switch"></label>
                                    </div>
                                    <p id="nego-monthly-switch-label">{{ getLocale($locale_form8, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-primary mb-5" id="add-more-length">
            {{ getLocale($locale_form8, 'label-18', "ADD MORE LENGTH OF STAY") }}
        </button>
        <div class="card card-body mb-5">
            <p class="text-muted required">
                {{ getLocale($locale_form8, 'label-19', "DO MY RATES ABOVE INCLUDE THE FOLLOWING MONTHLY CHARGES?") }}
            </p>
            <div class="row my-5">
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="internet-switch-label" class="font-weight-bolder">Internet</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_internet" id="internet-switch" {{ (isset($propertyPrice) && $propertyPrice->is_include_internet == 0) ? '' : 'checked' }}>
                        <label class="custom-control-label" for="internet-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="parking-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'Tempat parkir pribadi' : 'Private parking slot' }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_parking" id="parking-switch" {{ (isset($propertyPrice) && $propertyPrice->is_include_park == 0) ? '' : 'checked' }}>
                        <label class="custom-control-label" for="parking-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="tv-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'TV Kabel' : 'TV cable' }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_tv_cable" id="tv-switch" {{ (isset($propertyPrice) && $propertyPrice->is_include_tv_cable == 0) ? '' : 'checked' }}>
                        <label class="custom-control-label" for="tv-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="cleaning-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'Layanan kebersihan' : 'Cleaning service' }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_cleaning" id="cleaning-switch" {{ (isset($propertyPrice) && $propertyPrice->is_include_cleaning == 0) ? '' : 'checked' }}>
                        <label class="custom-control-label" for="cleaning-switch"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="form-inline row">
                        <label for="inlineFormInputGroup" class="required mr-4 col-auto">{{ getLocale($locale_form8, 'label-20', "RESIDENCE SERVICE CHARGE FEE") }}</label>
                        <div class="input-group mb-2 mr-2 col-md-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form8, 'label-12', 'IDR') }}
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-dashboard" name="service_fee" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form8, 'label-26', "Input value or 0 if none") }}" value="{{ (isset($propertyPrice) && $propertyPrice->service_fee > 0) ? $propertyPrice->service_fee : '' }}">
                        </div>
                        <p class="mb-0 col-auto">/ {{ getLocale($locale_form8, 'label-7', "month") }}</p>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-between">
                    <p id="fee-paid-switch-label" class="text-muted">{{ getLocale($locale_form8, 'label-21', "I would rather have the residence service charge fee paid by my renter") }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" id="fee-paid-switch" name="charge_fee" {{ (isset($propertyPrice) && $propertyPrice->charge_fee == 1) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="fee-paid-switch"></label>
                    </div>
                </div>
            </div>
        </div>
        <div id="disclaimer-section" class="p-5 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <h4>{{ getLocale($locale_form8, 'label-22', "Disclaimer") }}</h4>
                </div>
                <div class="col-md-8">
                    <p>{{ getLocale($locale_form8, 'label-23', "Property lister is responsible for all tax declaration and payment") }}.</p>
                    <p>{{ getLocale($locale_form8, 'label-24', "Sewagi cannot be held responsible for non tax declaration and payment emanating from properties perceiving revenue and listed on our platform") }}.</p>
                    <a href="" class="btn btn-link">{{ getLocale($locale_form8, 'label-25', "More information") }}</a>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="{{ $property->id }}" />
        <input value="8" type="hidden" name="step" id="step">
    </div>
</form>
@if(isset($propertyPrice))
<input value="1" type="hidden" name="update">
@endif
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/7" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form8, 'label-previous', 'Previous') }}
</a>
<button id ="submit-list-property" class="btn btn-primary btn-next-list-property">
    @if ((isset($property->is_co_living) && $property->is_co_living == 1))
        {{ getLocale($locale_form8, 'label-next', 'Next') }}
    @else
        {{ getLocale($locale_form8, 'label-send', 'REVIEW & SUBMIT MY LISTING') }}
    @endif
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</button>
@endsection
