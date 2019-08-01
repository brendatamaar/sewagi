@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData9" role="form" method="POST" action="{{ url('/create-property/9') }}" class="form-list-property">
@csrf
    <div class="col-md-10">
        <div class="mb-5">
            <h4 class="mb-4 required">{{ getLocale($locale_form8, 'label-1', 'Set up your preferred payment options') }}</h4>
        </div>
        <div class="mb-5">
            <h5 class="mb-4">{{ session('locale') =='id' ? 'Hunian Bersama' : 'Co-Living'  }}</h5>
            <div id="length-of-stay-container-co-living">
                @if(isset($propertyPriceDetail))
                    @foreach($lengthStay as $length)
                    <div class="card card-body mb-5 length-stay-row-co-living">
                        <div class="d-flex justify-content-between">
                            <label class="mb-4 text-muted">{{ getLocale($locale_form9, 'label-3', "LENGTH OF STAY") }}</label>
                            <a href="#" class="btn btn-link btn-save-length-stay" style="display: none;">
                                {{ getLocale($locale_form9, 'label-4', "Save") }}
                            </a>
                            <span class="btn-edit-container" style="display: none;">
                                <a href="#" class="mr-3 btn btn-link btn-edit-length-stay">
                                    {{ getLocale($locale_form9, 'label-5', "Edit") }}
                                </a>
                                <a href="#" class="btn btn-link btn-delete-length-stay">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </span>
                        </div>
                        <select class="select2 select2-list-property length-stay" name="length" placeholder="">
                            <option value=""></option>
                            <option value="1 year" {{ $length == 12 ? 'selected' : '' }}>1 {{ getLocale($locale_form9, 'label-6', "year") }}</option>
                            <option value="9 months" {{ $length == 9 ? 'selected' : '' }}>9 {{ getLocale($locale_form9, 'label-7', "months") }}</option>
                            <option value="6 months" {{ $length == 6 ? 'selected' : '' }}>6 {{ getLocale($locale_form9, 'label-7', "months") }}</option>
                            <option value="3 months" {{ $length == 3 ? 'selected' : '' }}>3 {{ getLocale($locale_form9, 'label-7', "months") }}</option>
                        </select>
                        <div class="payment-terms mt-5">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <label class="text-muted">{{ getLocale($locale_form9, 'label-8', "PAYMENT TERMS") }}</label>
                                    <a href="" class="btn btn-link btn-select-all">
                                        {{ getLocale($locale_form9, 'label-9', "Select all") }}
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-muted">{{ getLocale($locale_form9, 'label-10', "The following rates must include TAX") }}</p>
                                </div>
                                <ul class="col-md-12 list-group pl-4">
                                    <li class="list-group-item paid-once" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                    <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_once > 0 ? 'active' : '' }}">
                                                        <input type="checkbox" {{ $value->paid_once > 0 ? 'checked' : '' }}>+
                                                    </label>
                                                    @break
                                                @endif
                                            @endforeach
                                            <span class="font-weight-bolder">
                                                {{ getLocale($locale_form9, 'label-11', "Paid once") }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                    {{ $value->bedroom->name }}
                                                </div>
                                                <div class="form-inline row mb-4">
                                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="bedroom_id" value="{{ $value->bedroom->id }}">
                                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_once" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}" value="{{ ($value->paid_once <= 0) ? '' : $value->paid_once }}">
                                                    </div>
                                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form9, 'label-6', "year") }}</p>
                                                </div>
                                                @endif
                                            @endforeach
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                                    <label class="custom-control-label" for="nego-twice-switch"></label>
                                                </div>
                                                <p id="nego-twice-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item paid-twice" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                    <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_twice > 0 ? 'active' : '' }}">
                                                        <input type="checkbox" {{ $value->paid_twice > 0 ? 'checked' : '' }}>+
                                                    </label>
                                                    @break
                                                @endif
                                            @endforeach
                                            <span class="font-weight-bolder">
                                                {{ getLocale($locale_form9, 'label-15', "Paid twice") }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                    {{ $value->bedroom->name }}
                                                </div>
                                                <div class="form-inline row mb-4">
                                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="bedroom_id" value="{{ $value->bedroom->id }}">
                                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_twice" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}" value="{{ ($value->paid_twice <= 0) ? '' : $value->paid_twice }}">
                                                    </div>
                                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form9, 'label-6', "year") }}</p>
                                                </div>
                                                @endif
                                            @endforeach
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                                    <label class="custom-control-label" for="nego-twice-switch"></label>
                                                </div>
                                                <p id="nego-twice-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item paid-quarterly" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                    <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_quarterly > 0 ? 'active' : '' }}">
                                                        <input type="checkbox" {{ $value->paid_quarterly > 0 ? 'checked' : '' }}>+
                                                    </label>
                                                    @break
                                                @endif
                                            @endforeach
                                            <span class="font-weight-bolder">
                                                {{ getLocale($locale_form9, 'label-16', "Paid quarterly") }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                    {{ $value->bedroom->name }}
                                                </div>
                                                <div class="form-inline row mb-4">
                                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="bedroom_id" value="{{ $value->bedroom->id }}">
                                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_quarterly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}" value="{{ ($value->paid_quarterly <= 0) ? '' : $value->paid_quarterly }}">
                                                    </div>
                                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form9, 'label-6', "year") }}</p>
                                                </div>
                                                @endif
                                            @endforeach
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-quarterly-switch">
                                                    <label class="custom-control-label" for="nego-quarterly-switch"></label>
                                                </div>
                                                <p id="nego-quarterly-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item paid-monthly" style="display: none;">
                                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                    <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox {{ $value->paid_monthly > 0 ? 'active' : '' }}">
                                                        <input type="checkbox" {{ $value->paid_monthly > 0 ? 'checked' : '' }}>+
                                                    </label>
                                                    @break
                                                @endif
                                            @endforeach
                                            <span class="font-weight-bolder">
                                                {{ getLocale($locale_form9, 'label-17', "Paid monthly") }}
                                            </span>
                                        </div>
                                        <div class="input-rate-wrapper mt-4" style="display: none;">
                                            @foreach($propertyPriceDetail as $key => $value)
                                                @if($value->length == $length)
                                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                    {{ $value->bedroom->name }}
                                                </div>
                                                <div class="form-inline row mb-4">
                                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="bedroom_id" value="{{ $value->bedroom->id }}">
                                                        <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_monthly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}" value="{{ ($value->paid_monthly <= 0) ? '' : $value->paid_monthly }}">
                                                    </div>
                                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form9, 'label-6', "year") }}</p>
                                                </div>
                                                @endif
                                            @endforeach
                                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                                <div class="custom-control custom-switch mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="nego-monthly-switch">
                                                    <label class="custom-control-label" for="nego-monthly-switch"></label>
                                                </div>
                                                <p id="nego-monthly-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
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
        <div id="length-stay-row-clone-co-living" class="card card-body mb-5 length-stay-row-co-living" style="display: none;">
            <div class="d-flex justify-content-between">
                <label class="mb-4 text-muted">{{ getLocale($locale_form9, 'label-3', "LENGTH OF STAY") }}</label>
                <a href="#" class="btn btn-link btn-save-length-stay" style="display: none;">
                    {{ getLocale($locale_form9, 'label-4', "Save") }}
                </a>
                <span class="btn-edit-container" style="display: none;">
                    <a href="#" class="mr-3 btn btn-link btn-edit-length-stay">
                        {{ getLocale($locale_form9, 'label-5', "Edit") }}
                    </a>
                    <a href="#" class="btn btn-link btn-delete-length-stay">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </span>
            </div>
            <select class="select2 select2-list-property length-stay" name="length" placeholder="">
                <option value=""></option>
                <option value="1 year">1 {{ getLocale($locale_form9, 'label-6', "year") }}</option>
                <option value="9 months">9 {{ getLocale($locale_form9, 'label-7', "months") }}</option>
                <option value="6 months">6 {{ getLocale($locale_form9, 'label-7', "months") }}</option>
                <option value="3 months">3 {{ getLocale($locale_form9, 'label-7', "months") }}</option>
            </select>
            <div class="payment-terms mt-5">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <label class="text-muted">{{ getLocale($locale_form9, 'label-8', "PAYMENT TERMS") }}</label>
                        <a href="" class="btn btn-link btn-select-all">
                            {{ getLocale($locale_form9, 'label-9', "Select all") }}
                        </a>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted">{{ getLocale($locale_form9, 'label-10', "The following rates must include TAX") }}</p>
                    </div>
                    <ul class="col-md-12 list-group pl-4">
                        <li class="list-group-item paid-once" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form9, 'label-11', "Paid once") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                @foreach($bedrooms as $bedroom)
                                    <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    {{$bedroom->name}}
                                    </div>
                                    <div class="form-inline row mb-4">
                                        <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                </div>
                                            </div>
                                            <input type="hidden" name="bedroom_id" value="{{ $bedroom->id }}">
                                            <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_once" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}">
                                        </div>
                                        <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form9, 'label-6', "year") }}</p>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                        <label class="custom-control-label" for="nego-twice-switch"></label>
                                    </div>
                                    <p id="nego-twice-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-twice" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox }">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form9, 'label-15', "Paid twice") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                @foreach($bedrooms as $bedroom)
                                    <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    {{$bedroom->name}}
                                    </div>
                                    <div class="form-inline row mb-4">
                                        <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                </div>
                                            </div>
                                            <input type="hidden" name="bedroom_id" value="{{ $bedroom->id }}">
                                            <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_twice" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}">
                                        </div>
                                        <p class="mb-0 col-auto required pl-0">/ 6 {{ getLocale($locale_form9, 'label-7', "months") }}</p>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                        <label class="custom-control-label" for="nego-twice-switch"></label>
                                    </div>
                                    <p id="nego-twice-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-quarterly" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox ">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form9, 'label-16', "Paid quarterly") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                @foreach($bedrooms as $bedroom)
                                    <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    {{$bedroom->name}}
                                    </div>
                                    <div class="form-inline row mb-4">
                                        <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                </div>
                                            </div>
                                            <input type="hidden" name="bedroom_id" value="{{ $bedroom->id }}">
                                            <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_quarterly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}">
                                        </div>
                                        <p class="mb-0 col-auto required pl-0">/ 3 {{ getLocale($locale_form9, 'label-7', "months") }}</p>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-quarterly-switch">
                                        <label class="custom-control-label" for="nego-quarterly-switch"></label>
                                    </div>
                                    <p id="nego-quarterly-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-monthly" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form9, 'label-17', "Paid monthly") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                @foreach($bedrooms as $bedroom)
                                    <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    {{$bedroom->name}}
                                    </div>
                                    <div class="form-inline row mb-4">
                                        <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                                </div>
                                            </div>
                                            <input type="hidden" name="bedroom_id" value="{{ $bedroom->id }}">
                                            <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_monthly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-13', "Input your rate") }}">
                                        </div>
                                        <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form9, 'label-7', "month") }}</p>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-monthly-switch">
                                        <label class="custom-control-label" for="nego-monthly-switch"></label>
                                    </div>
                                    <p id="nego-monthly-switch-label">{{ getLocale($locale_form9, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-primary mb-5" id="add-more-length-co-living">
            {{ getLocale($locale_form9, 'label-18', "ADD MORE LENGTH OF STAY") }}
        </button>
        <div class="card card-body mb-5">
            <p class="text-muted required">
                {{ getLocale($locale_form9, 'label-19', "DO MY RATES ABOVE INCLUDE THE FOLLOWING MONTHLY CHARGES?") }}
            </p>
            <div class="row my-5">
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="internet-switch-label" class="font-weight-bolder">Internet</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_internet" id="internet-switch" {{ isset($propertyPrice) && $propertyPrice->is_include_internet == '1' ? 'checked' : ''}}>
                        <label class="custom-control-label" for="internet-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="parking-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'Tempat parkir pribadi' : 'Private parking slot' }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_parking" id="parking-switch" {{ isset($propertyPrice) && $propertyPrice->is_include_park == '1' ? 'checked' : ''}}>
                        <label class="custom-control-label" for="parking-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="tv-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'TV Kabel' : 'TV cable' }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_tv_cable" id="tv-switch" {{ isset($propertyPrice) && $propertyPrice->is_include_tv_cable == '1' ? 'checked' : ''}}>
                        <label class="custom-control-label" for="tv-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="cleaning-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'Layanan kebersihan' : 'Cleaning service' }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" name="is_cleaning" id="cleaning-switch" {{ isset($propertyPrice) && $propertyPrice->is_include_cleaning == '1' ? 'checked' : ''}}>
                        <label class="custom-control-label" for="cleaning-switch"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="form-inline row">
                        <label for="inlineFormInputGroup" class="required mr-4 col-auto">{{ getLocale($locale_form9, 'label-20', "RESIDENCE SERVICE CHARGE FEE") }}</label>
                        <div class="input-group mb-2 mr-2 col-md-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form9, 'label-12', "IDR") }}
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-dashboard" name="service_fee" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form9, 'label-26', "Input value or 0 if none") }}" value="{{ isset($propertyPrice) && $propertyPrice->service_fee > 0 ? $propertyPrice->service_fee : ''}}">
                        </div>
                        <p class="mb-0 col-auto">/ {{ getLocale($locale_form9, 'label-7', "month") }}</p>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-between">
                    <p id="fee-paid-switch-label" class="text-muted">{{ getLocale($locale_form9, 'label-21', "I would rather have the residence service charge fee paid by my renter?") }}</p>
                    <div class="custom-control custom-switch">
                        <input value="1" type="checkbox" class="custom-control-input" id="fee-paid-switch" name="charge_fee" {{ isset($propertyPrice) && $propertyPrice->charge_fee == '1' ? 'checked' : ''}}>
                        <label class="custom-control-label" for="fee-paid-switch"></label>
                    </div>
                </div>
            </div>
        </div>
        <div id="disclaimer-section" class="p-5 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <h4>{{ getLocale($locale_form9, 'label-22', "Disclaimer") }}</h4>
                </div>
                <div class="col-md-8">
                    <p>{{ getLocale($locale_form9, 'label-23', "Property lister is responsible for all tax declaration and payment") }}.</p>
                    <p>{{ getLocale($locale_form9, 'label-24', "Sewagi cannot be held responsible for non tax declaration and payment emanating from properties perceiving revenue and listed on our platform") }}.</p>
                    <a href="" class="btn btn-link">{{ getLocale($locale_form9, 'label-25', "More information") }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 float-right">
        <div id="info-payment-term">
            <p>{{ getLocale($locale_form9, 'label-27', "Monthly payments help you lease your bedrooms faster") }}.</p>
            <p>{{ getLocale($locale_form9, 'label-28', "Don’t overprice them just because it’s on monthly terms") }}. </p>
        </div>
    </div>
    <input type="hidden" name="id" value="{{ $property->id }}" />
    <input value="9" type="hidden" name="step" id="step">
</form>
@if(isset($propertyPrice))
<input value="1" type="hidden" name="update">
@endif
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/7" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form9, 'label-previous', 'Previous') }}
</a>
<button id ="submit-list-property" class="btn btn-primary btn-next-list-property">
    {{ getLocale($locale_form8, 'label-send', 'REVIEW & SUBMIT MY LISTING') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</button>
@endsection
