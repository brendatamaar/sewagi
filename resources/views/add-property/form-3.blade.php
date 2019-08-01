@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData3" role="form" method="POST" action="{{ url('/create-property/3') }}" class="form-list-property">
    @csrf
    <div class="mb-5">
        <h4 class="mb-4">{{ getLocale($locale_form3, 'label-1', 'Where is the location?') }}</h4>
        <p class="text-muted fs-12">{{ getLocale($locale_form3, 'label-2', 'Your exact address will only be shared with prospective renters engaged in a tour or booking request') }}.</p>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" name="property_addr_autocomplete" class="form-control form-control-dashboard" placeholder="Enter the street address or Building Name" id="property-addr-autocomplete" autocomplete="off" required value="{{ $property->address }}">
                    <span class="input-required"></span>
                    <input type="hidden" name="property_address" id="input-property-address" value="{{ $property->address }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <input id="input-property-street-number" class="form-control form-control-dashboard required" type="text" placeholder="{{ getLocale($locale_form3, 'placeholder-1', 'Enter property number') }} (e.g.7, A5)" value="{{ $property->property_number }}" name="property_number">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <input id="input-property-details" class="form-control form-control-dashboard required" type="text" placeholder="{{ getLocale($locale_form3, 'placeholder-2', 'Enter property details') }} (e.g.Block, Tower unit)" value="{{ $property->property_detail }}" name="property_details">
                    <span class="input-required"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input id="input-property-city" class="form-control form-control-dashboard required" type="text" placeholder="{{ getLocale($locale_form3, 'placeholder-3', 'Enter city') }}" value="{{ $property->city }}" name="city">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="input-property-district" class="form-control form-control-dashboard required" type="text" placeholder="{{ getLocale($locale_form3, 'placeholder-4', 'Enter district') }}" value="{{ $property->district }}" name="district">
                    <span class="input-required"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input id="input-property-village" class="form-control form-control-dashboard required" type="text" placeholder="{{ getLocale($locale_form3, 'placeholder-5', 'Enter village') }}" value="{{ $property->village }}" name="village">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input id="input-property-province" class="form-control form-control-dashboard required" type="text" placeholder="{{ getLocale($locale_form3, 'placeholder-6', 'Enter province') }}" value="{{ $property->province }}" name="province">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input id="input-property-postcode" class="form-control form-control-dashboard" type="text" placeholder="{{ getLocale($locale_form3, 'placeholder-7', 'Enter post code') }}" value="{{ $property->postcode }}" name="post_code">
                    <span class="input-required"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-4">{{ getLocale($locale_form3, 'label-3', 'Is the pin in the right location?') }}</h4>
                <p class="text-muted fs-12">
                    {{ getLocale($locale_form3, 'label-4', 'The pin need to be precisely pointed to the location of your property. Press the adjust button to correct the pin point’s location') }}.
                </p>
            </div>
            <div class="col-md-4 d-flex justify-content-end align-items-start">
                <a id="link-adjust" class="btn btn-outline-primary" href="#">
                    {{ getLocale($locale_form3, 'label-5', 'ADJUST') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="list-property-map"></div>
                <input type="hidden" name="latitude" id="latitude" value="{{ isset($property->latitude) ? $property->latitude : -6.21462 }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ isset($property->longitude) ? $property->longitude : 106.84513 }}">
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value=" {{ $property->id }}" />
    <input value="3" type="hidden" name="step" id="step">
</form>
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/2" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form3, 'label-previous', 'Previous') }}
</a>
<button id ="submit-list-property" class="btn btn-primary btn-next-list-property">
    {{ getLocale($locale_form3, 'label-next', 'Next') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</button>
@endsection
