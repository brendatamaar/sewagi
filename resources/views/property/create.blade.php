@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData1" role="form" method="POST" action="{{ url('/add-property/1') }}" {{ ((isset($step) && $step == 1) || (!isset($step))) ? 'style=display:block;' : 'style=display:none;' }}>
@csrf
    <div class="mb-5">a
        <h4 class="mb-4 required">{{ getLocale($locale_form1, 'label-1', 'What is the estate type?') }}</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <select id="estate-type" class="select2 select2-list-property" name="type">
                        <option value="">{{ getLocale($locale_form1, 'label-2', 'Select estate type') }}</option>
                        <option value="apartment" {{ isset($property) ? ($property->type == 'apartment' ? "selected" : '') : '' }} {{ old('type') == 'apartment' ? 'selected' : '' }}>{{ session('locale')=='en' ? 'Apartment' : 'Apartemen' }}</option>
                        <option value="house" {{ isset($property) ? ($property->type == 'house' ? 'selected' : '') : "" }} {{ old('type') == 'house' ? 'selected' : '' }}>{{ session('locale')=='en' ? 'House' : 'Rumah' }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 estate-size" style="display: none;">
                <div class="form-group d-flex align-items-center">
                    <label class="label-special text-muted fs-12" id="estate-label" for="">{{ getLocale($locale_form1, 'label-3', 'UNIT SIZE') }}</label>
                    <input class="form-control form-control-dashboard" id="unit-size-input" type="number" placeholder="0" style="display: none" name="unit_size" value="{{($property->unit_size > 0 ? $property->unit_size : '')}}">
                    <input class="form-control form-control-dashboard" id="building-size-input" type="number" placeholder="0" style="display: none" name="building_size" value="{{($property->building_size > 0 ? $property->building_size : '')}}">
                    <span class="ml-2 fs-12">m<sup>2</sup></span>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form1, 'label-4', 'What is the ideal living condition?') }}</h4>
        <p class="text-muted fs-12">{{ getLocale($locale_form1, 'label-5', 'You can choose more than one.') }}</p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <img class="mb-4" src="../img/list-property-coliving.svg" alt="Co-living" />
                    <h5>{{ getLocale($locale_form1, 'label-co-1', 'Co-living') }}</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <div class="card-text">
                        <p>
                            {{ getLocale($locale_form1, 'label-co-2', 'You accept multiple renters leasing your property bedrooms and sharing the common areas. This option is also useful when seeking a housemate for your property') }}
                        </p>
                        <p>
                            {{ getLocale($locale_form1, 'label-co-3', 'By selecting co-living, you agree to rent your property on room by room basis, forgoing leasing all bedrooms at once. We call this progressive leasing.') }}
                        </p>
                        <a href="#">{{ getLocale($locale_form1, 'label-co-4', 'Connect with us for more info.') }}</a>
                    </div>
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-checkbox btn-rounded btn-outline-primary mr-10 mb-10 {{($property->is_co_living =='1' ? 'active': '')}}">
                            <input value ="1" type="checkbox" name="is_co_living">+ {{ session('locale')=='en' ? 'Select' : 'Pilih' }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <img class="mb-4" src="../img/list-property-entirespace.svg" alt="Co-living" />
                    <h5>{{ getLocale($locale_form1, 'label-entire-1', 'Entire Space') }}</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <div class="card-text">
                        <p>{{ getLocale($locale_form1, 'label-entire-2', 'Classic practice of leasing your property to one renter.') }}</p>
                        <p>{{ getLocale($locale_form1, 'label-entire-3', 'He is entitled to renting your entire property space for him or herself.') }}</p>
                    </div>
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-checkbox btn-rounded btn-outline-primary mr-10 mb-10 {{($property->is_entire_space =='1' ? 'active': '')}}">
                            <input value ="1" type="checkbox" name="is_entire_space">+ {{ session('locale')=='en' ? 'Select' : 'Pilih' }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-estate-type">
                <p>{{ getLocale($locale_form1, 'label-type-1', 'We will publish your property as co-living friendly and as an entire space. Giving you more opportunities to lease faster.') }}</p>
                <p>{{ getLocale($locale_form1, 'label-type-2', 'In the case where your property is rented-out as a co-living, you agree to forfeit entire space leasing for the duration of the contracted length of stay.') }}</p>
                <a class="fs-12" href="#">{{ getLocale($locale_form1, 'label-type-3', 'Terms Of Use') }}</a>
            </div>
        </div>
    </div>
    <input type="hidden" name="property_id" value="{{ $property->id }}" />
</form>
<form id="newPropertyData2" role="form" method="POST" action="{{ url('/add-property/2') }}" {{ (isset($step) && $step == 2) ? 'style=display:block;' : 'style=display:none;' }}>
    @csrf
    <div class="mb-5" id="bedroom-wrapper">
        <h4 class="mb-4">{{ getLocale($locale_form2, 'label-1', 'Bedrooms inventory') }}</h4>
        <div id="bedroom-wrapper-content">
            <div class="card mb-4 template-bedroom">
                <div class="card-body">
                    <div class="d-flex justify-content-between bedroom-title-wrap">
                            <h5 class="mb-5 bedroom-title"></h5>
                            <div class="button-group">
                                <button class="mr-3 btn btn-link">{{ getLocale($locale_form_property_create, 'label-4', 'Save') }}</button>
                                <button class="bedroom-row-reset btn btn-link">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bedType" class="required">{{ getLocale($locale_form2, 'label-bedroom-inv-1', 'Bedroom type') }}</label>
                                <select class="select2 select2-list-property bed-type" name="bedType" id="">
                                    <option value=""></option>
                                    <option value="Master Bedroom" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-1', 'Bedroom containing the most amenities, typically the largest in your property') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-4', 'Master Bedroom') }}</option>
                                    <option value="Standard Bedroom" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-2', 'Bedroom smaller in size than your master bedroom, with less amenities') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-5', 'Standard Bedroom') }}</option>
                                    <option value="Pocket Bedroom" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-3', 'Bedroom fit for the budget conscious renter, typically smaller in size than your standard bedroom, with fewer amenities') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-6', 'Pocket Bedroom') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="required" for="">Bedroom Size</label>
                                <div class="d-flex align-items-center">
                                    <input class="form-control form-control-dashboard bedroom-size" id="unit-size-input" type="number" placeholder="0" min="0" name="bedSize">
                                    <span class="ml-2 fs-12">m<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="required" for="">Bedroom quantity</label>
                                <input class="form-control form-control-dashboard mb-2 bedroom-quantity" type="number" placeholder="1" value="1" min="1" name="bedQty">
                                <a href="#" data-toggle="modal" data-target="#modalRoomNumbering" class="required modal-room-numbering-link">Room Numbering</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="bedType" class="required">Bedroom furniture arrangement</label>
                                <select class="select2 select2-list-property bed-furniture" name="bedFurniture" id="">
                                    <option value=""></option>
                                    <option value="Furnished">Furnished</option>
                                    <option value="Semi-Furnished">Semi-Furnished</option>
                                    <option value="Unfurnished">Unfurnished</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="" class="row bed-arrangement-wrapper" style="display: none">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="bedArrangement" class="required">Bed arrangement</label>
                                <select class="select2 select2-list-property bed-arrangement" name="bedArrangement" id="">
                                    <option value=""></option>
                                    <option value="Twin Bed">Twin Bed</option>
                                    <option value="Single Size Bed">Single Size Bed</option>
                                    <option value="Queen Size Bed">Queen Size Bed</option>
                                    <option value="King Size Bed">King Size Bed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bedLayout">Bedroom Layout</label>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-sm btn-checkbox btn-outline-primary mr-10 mb-10">
                                        <input type="checkbox" name="isLoft" value="1">+ Loft
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="bedAmenities">Bedroom Amenities</label>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @foreach($amenityList as $amenity)
                                        <label class="btn btn-sm btn-checkbox btn-outline-primary mr-10 mb-10">
                                            <input type="checkbox" value="{{$amenity->id}}" class="bedroom-amenities-{{$amenity->type}}" name="amenities[]">+ {{$amenity->name}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="btn-add-newbedroom" class="btn btn-primary btn-outline-primary">
            ADD NEW BEDROOM
        </button>
    </div>
    <div class="mb-5">
        <h4 class="mb-4">How many bathrooms are there?</h4>
        <div class="form-group form-inline">
            <label class="mr-5">Total bathroom</label>
            <div class='btn-counter'>
                <button class='down_count' href="#" title='Down'>
                    <i class="fas fa-minus"></i>
                </button>
                <input class='counter' type="text" placeholder="value..." value='0' name="total_bathroom"/>
                <button class='up_count' href="#" title='Up'>
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4">Total listed bedrooms: <span class="ml-4" id="total-listed-bedroom" name="total_bedroom"></span></h4>
    </div>
    <div id="modal-room-numbering-container"></div>
    <div class="modal fade modal-dashboard modal-room-numbering" id="modalRoomNumbering" tabindex="-1" role="dialog">
        <div class="modal-dialog from-right" role="document">
            <div class="modal-content bg-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label class="required font-weight-bolder">Please input your bedrooms Number / Name.</label>
                        <label class="text-muted d-block">E.g. 1A, 1B, 1C, 101, 102, Jasmin 1</label>
                        <div class="row mt-5 modal-room-numbering-container"></div>
                    </div>
                    <div class="button-group d-flex justify-content-end">
                        <a class="btn btn-primary disabled btn-room-numbering-done" href="#" data-dismiss="modal">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-room-numbering-switch-clone" style="display: none;">
        <div class="col-md-6 d-flex align-items-center mb-4 modal-room-numbering-switch">
            <input class="form-control form-control-dashboard text-center input-room-numbering" name="roomName[]" type="text" placeholder="1A">
            <div class="custom-control custom-switch custom-switch-available">
                <input type="checkbox" class="custom-control-input" id="customSwitch" name="roomAvailability" value="1">
                <label class="custom-control-label" for="customSwitch">
                    <span>
                        Not Available
                    </span>
                </label>
            </div>
        </div>
    </div>
    <div class="modal fade modal-dashboard modal-room-numbering" id="modalIncreaseBedroom" tabindex="-1" role="dialog">
        <div class="modal-dialog from-right" role="document">
            <div class="modal-content bg-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label class="required font-weight-bolder">Please input your bedrooms Number / Name.</label>
                        <label class="text-muted d-block">E.g. 1A, 1B, 1C, 101, 102, Jasmin 1</label>
                        <div class="row mt-5 modal-room-numbering-container"></div>
                    </div>
                    <div class="button-group d-flex justify-content-end">
                        <a class="btn btn-primary disabled btn-room-numbering-done" href="#" data-dismiss="modal">Done</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="property_id" value="{{ session('property_id') }}" />
</form>
<form id="newPropertyData3" role="form" method="POST" action="{{ url('/add-property/3') }}" {{ (isset($step) && $step == 3) ? 'style=display:block;' : 'style=display:none;' }}>
    @csrf
    <div class="mb-5">
        <h4 class="mb-4">Where is the location?</h4>
        <p class="text-muted fs-12">Your exact address will only be shared with prospective renters engaged in a tour or booking request.</p>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select id="select-property-prediction" class="form-control select2-company-name">
                        {{!! isset($property->address) ? '<option value="$property->address">' . $property->address . '</option>' : '' !!}}
                    </select>
                    <span class="input-required"></span>
                    <input type="hidden" name="property_address" id="input-property-address" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <input id="input-property-street-number" class="form-control form-control-dashboard required" type="text" placeholder="Enter property number (e.g.7, A5)" value="{{ $property->property_number }}" name="property_number">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <input id="input-property-details" class="form-control form-control-dashboard required" type="text" placeholder="Enter property details (e.g.Block, Tower unit)" value="{{ $property->property_detail }}" name="property_detail">
                    <span class="input-required"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input id="input-property-city" class="form-control form-control-dashboard required" type="text" placeholder="Enter city" value="{{ $property->city }}" name="city">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="input-property-district" class="form-control form-control-dashboard required" type="text" placeholder="Enter district" value="{{ $property->district }}" name="district">
                    <span class="input-required"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input id="input-property-village" class="form-control form-control-dashboard required" type="text" placeholder="Enter village" value="{{ $property->village }}" name="village">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input id="input-property-province" class="form-control form-control-dashboard required" type="text" placeholder="Enter province" value="{{ $property->province }}" name="province">
                    <span class="input-required"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input id="input-property-postcode" class="form-control form-control-dashboard" type="text" placeholder="Enter post code" value="{{ $property->postcode }}" name="postcode">
                    <span class="input-required"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-4">Is the pin in the right location ?</h4>
                <p class="text-muted fs-12">
                    The pin need to be precisely pointed to the location of your property. Press the adjust button to correct the pin point’s location.
                </p>
            </div>
            <div class="col-md-4 d-flex justify-content-end align-items-start">
                <a id="link-adjust" class="btn btn-outline-primary" href="#">
                    ADJUST
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
    <input type="hidden" name="property_id" value="{{ $property->id }}" />
</form>
<form id="newPropertyData4" role="form" method="POST" action="{{ url('/add-property/4') }}" {{ (isset($step) && $step == 4) ? 'style=display:block;' : 'style=display:none;' }}>
    @csrf
    <div class="mb-5">
        <h4 class="mb-4 required">Give a title describing your property</h4>
        <div class="form-group">
            <textarea class="form-control form-control-dashboard" placeholder="E.g. Amazing Cityscape - SCBD Apartment" rows="2" maxlength="60" name="title"></textarea>
        </div>
    </div>

    <div class="mb-5">
        <h4 class="mb-4 required">Give more details to better describe your property</h4>
        <div class="form-group">
            <textarea class="form-control form-control-dashboard" placeholder="E.g. Amazing Cityscape - SCBD Apartment" rows="6" maxlength="300" name="description"></textarea>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">Select design preferences best describing your property</h4>
        <p class="text-muted fs-12">You may select up to 2 styles</p>
        <div class="row">
            @foreach($style as $value)
                <div class="col-md-3 mb-3 text-center">
                    <img src="{{$value->image}}" alt="" class="img-fluid my-4">
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-sm btn-checkbox btn-outline-primary">
                            <input type="checkbox" name="style_id[]" value="{{$value->id}}">+ {{$value->name}}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">Select your property land area type</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="land_area_type" id="property-land-area">
                <option value=""></option>
                <option value="Residential">Residential</option>
                <option value="Non Residential">Non Residential</option>
            </select>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">Select your property arrangement</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="arrangement" id="property-arrangement">
                <option value=""></option>
                <option value="Townhouse">Townhouse</option>
                <option value="Standalone">Standalone</option>
            </select>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">On which floor is your property?</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="floor_range" id="property-floor">
                <option value=""></option>
                <option value="below 5">Below 5 stories</option>
                <option value="between 5-10">Between 5-10 stories</option>
                <option value="above 10">Above 10 stories</option>
            </select>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4">Do you have any property rules?</h4>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <p id="pet-switch-label">Pet Friendly</p>
                <div class="custom-control custom-switch">
                    <input value="1" type="checkbox" class="custom-control-input" name="is_pet_friendly" id="pet-switch" checked>
                    <label class="custom-control-label" for="pet-switch"></label>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="property_id" value=" {{ session('property_id') }}" />
</form>
<form id="newPropertyData5" role="form" method="POST" action="{{ url('/add-property/5') }}" {{ (isset($step) && $step == 5) ? 'style=display:block;' : 'style=display:none;' }}>
    @csrf
    <div class="mb-5">
        <h4 class="mb-4 required">What is your property furniture arrangement?</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="furniture" id="furniture-arrangement">
                <option value=""></option>
                <option value="Furnished">Furnished</option>
                <option value="Semi-Furnished">Semi-Furnished</option>
                <option value="Unfurnished">Unfurnished</option>
            </select>
        </div>
    </div>
    <div class="mb-5">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="required">What amenities do you provide?</h4>
            <button class="btn btn-link">Add</button>
        </div>
        <div id="amenities-provide">
            <div class="row">
                @foreach($propertyAmenity as $value)
                    <div class="col-md-3">
                        <div class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-outline-primary">
                                <input type="checkbox" name="amenity_id[]" value="{{$value->id}}">+ {{$value->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="required">What are the available facilities?</h4>
            <button class="btn btn-link">Add</button>
        </div>
        <div id="available-facilities">
            <div class="row">
                @foreach($facility as $value)
                    <div class="col-md-3">
                        <div class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-outline-primary">
                                <input type="checkbox" name="facility_id[]" value="{{$value->id}}">+ {{$value->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <input type="hidden" name="property_id" value=" {{ session('property_id') }}" />
</form>
<div id="newPropertyData6" {{ (isset($step) && $step == 6) ? 'style=display:block;' : 'style=display:none;' }}>
    @csrf
    <div class="mb-5">
        <h4 class="mb-4 required">How about uploading some photos?</h4>
        <p class="text-muted fs-12">Upload up to 6 photos per category</p>
    </div>
    <div class="card card-body mb-4">
        <div class="row">
            <div class="col-md-6">
                <h5 class="required">
                    Building exterior
                </h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#building-exterior" role="button" aria-expanded="false">
                    + Add Photos
                </a>
                <div class="custom-control custom-switch custom-switch-thumbnails">
                    <input type="checkbox" class="custom-control-input" id="building-exterior-switch">
                    <label class="custom-control-label" for="building-exterior-switch">
                        <span>
                            Thumbnail & Highlights
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="collapse" id="building-exterior">
            <form method="post" action="{{ url('/add-property/6') }}"  enctype="multipart/form-data" class="dropzone" id="building-exterior">
                @csrf
                <div class="photo-indicator">
                    <p class="mb-1">Photos Uploaded</p>
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                    </ul>
                </div>
                <div class="fallback">
                    <input type="file" name="file"/>
                </div>
            </form>
        </div>
    </div>
    <div class="card card-body mb-4">
        <div class="row">
            <div class="col-md-6">
                <h5 class="required">
                    Living exterior
                </h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#living-exterior" role="button" aria-expanded="false">
                    + Add Photos
                </a>
                <div class="custom-control custom-switch custom-switch-thumbnails">
                    <input type="checkbox" class="custom-control-input" id="living-exterior-switch">
                    <label class="custom-control-label" for="living-exterior-switch">
                        <span>
                            Thumbnail & Highlights
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="collapse" id="living-exterior">
            <form method="post" action="{{ url('/add-property/6') }}" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
            </form>
            <div class="photo-indicator">
                <p class="mb-1">Photos Uploaded</p>
                <ul class="list-inline mb-2">
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card card-body mb-4">
        <div class="row">
            <div class="col-md-6">
                <h5 class="required">
                    Kitchen
                </h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#kitchen" role="button" aria-expanded="false">
                    + Add Photos
                </a>
                <div class="custom-control custom-switch custom-switch-thumbnails">
                    <input type="checkbox" class="custom-control-input" id="kitchen-switch">
                    <label class="custom-control-label" for="kitchen-switch">
                        <span>
                            Thumbnail & Highlights
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="collapse" id="kitchen">
            <form method="post" action="{{ url('/add-property/6') }}" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
            </form>
            <div class="photo-indicator">
                <p class="mb-1">Photos Uploaded</p>
                <ul class="list-inline mb-2">
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="category-photo-wrapper">
        <div class="card card-body mb-4 template-category-photo">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="required">
                        Template
                    </h5>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a class="btn btn-link btn-add-photos mr-4" data-toggle="collapse" href="#template" role="button" aria-expanded="false">
                        + Add Photos
                    </a>
                    <div class="custom-control custom-switch custom-switch-thumbnails">
                        <input type="checkbox" class="custom-control-input" id="template-switch">
                        <label class="custom-control-label" for="template-switch">
                            <span>
                                Thumbnail & Highlights
                            </span>
                        </label>
                    </div>
                    <button class="btn btn-link ml-2 mb-2 trigger-modal-reset" data-toggle="modal" data-target="#modalConfirmationCategory">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="collapse" id="template">
                <form method="post" action="{{ url('/add-property/6') }}" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                </form>
                <div class="photo-indicator">
                    <p class="mb-1">Photos Uploaded</p>
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                        <li class="list-inline-item"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-body mb-4 category-select" style="display: none">
        <label for="">CATEGORY</label>
        <select class="select2 select2-list-property" name="" id="add-category-photos">
            <option value=""></option>
            <option value="Office room">Office room</option>
            <option value="Laundry room">Laundry room</option>
            <option value="Parking & Garage">Parking & Garage</option>
            <option value="Indoor facilities">Indoor facilities</option>
            <option value="Outdoor facilities">Outdoor facilities</option>
            <option value="Neighborhood">Neighborhood</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <button class="btn btn-outline-primary mb-4" id="add-more-category">
        ADD MORE CATEGORY
    </button>
</div>
<div {{ (isset($step) && $step == 7) ? 'style=display:block;' : 'style=display:none;' }}>
    <form id="newPropertyData7" role="form" method="POST" action="{{ url('/add-property/7') }}">
        @csrf
        <div class="mb-5">
            <h4 class="mb-4 required">Property Ownership</h4>
            <p class="text-muted fs-12">
                For more transparency and faster contract signing process, please provide us with your property's legal details. Don't worry, we won't share them with anyone.
            </p>
        </div>
        <div class="mb-5">
            <h4 class="mb-4 required">To whom does this property belong?</h4>
            <select class="select2 select2-list-property" name="belong_to" id="your-status">
                <option value=""></option>
                <option value="1">This property is under my name</option>
                <option value="2">I have legal rights to represent this property</option>
                <option value="3">I have rights to sublease bedrooms inside this property</option>
            </select>
        </div>
        <input type="hidden" name="property_id" value="" />
    </form>
    <div class="card card-body mb-5 property-right-wrapper" id="property-legal-wrapper" style="display: none;">
        <div class="row">
            <div class="col-md-9">
                <h5>
                    Provide a document naming you as the rightful appointee to legally market this property
                </h5>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos" data-toggle="collapse" href="#property-legal" role="button" aria-expanded="false">
                    + Add document
                </a>
            </div>
        </div>
        <div class="collapse" id="property-legal">
            <form action="/file-upload"
                class="dropzone"
                id="my-awesome-dropzone">
            </form>
            <div class="photo-indicator">
                <p class="mb-1">Photos Uploaded</p>
                <ul class="list-inline mb-2">
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card card-body mb-5 property-right-wrapper" id="property-sublease-wrapper" style="display: none;">
        <div class="row">
            <div class="col-md-9">
                <h5>
                    Provide ownership certificate or a document validating your authority to sublease
                </h5>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos" data-toggle="collapse" href="#living-exterior" role="button" aria-expanded="false">
                    + Add document
                </a>
            </div>
        </div>
        <div class="collapse" id="property-sublease">
            <form action="/file-upload"
                class="dropzone"
                id="my-awesome-dropzone">
            </form>
            <div class="photo-indicator">
                <p class="mb-1">Photos Uploaded</p>
                <ul class="list-inline mb-2">
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card card-body mb-5" id="property-insured-wrapper">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-between">
                <h5>
                    Is the property insured?
                </h5>
                <div class="custom-control custom-switch">
                    <input value="0" type="checkbox" class="custom-control-input" name="insurance_status" id="property-insured-switch" >
                    <label class="custom-control-label" for="property-insured-switch">
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-link btn-add-photos" style="display: none;" data-toggle="collapse" href="#property-insured" role="button" aria-expanded="false">
                    + Add document
                </a>
            </div>
        </div>
        <div class="collapse" id="property-insured">
            <form action="/file-upload"
                class="dropzone"
                id="my-awesome-dropzone">
            </form>
            <div class="photo-indicator">
                <p class="mb-1">Photos Uploaded</p>
                <ul class="list-inline mb-2">
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<form id="newPropertyData8" role="form" method="POST" action="{{ url('/add-property/8') }}" {{ (isset($step) && $step == 8) ? 'style=display:block;' : 'style=display:none;' }}>
@csrf
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form_property_create, 'label-27', 'Set up your preferred payment options') }}</h4>
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
        <div id="length-of-stay-container"></div>
    </div>
    <div id="length-stay-row-clone" class="card card-body mb-5 length-stay-row" style="display: none;">
        <div class="d-flex justify-content-between">
            <label class="mb-4 text-muted">{{ getLocale($locale_form_property_create, 'label-3', 'LENGTH OF STAY') }}</label>
            <a href="#" class="btn btn-link btn-save-length-stay" style="display: none;">
                {{ getLocale($locale_form_property_create, 'label-4', 'Save') }}
            </a>
        </div>
        <select class="select2 select2-list-property length-stay" name="length" placeholder="">
            <option value=""></option>
            <option value="1 year">1 {{ getLocale($locale_form_property_create, 'label-6', 'year') }}</option>
            <option value="9 months">9 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</option>
            <option value="6 months">6 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</option>
            <option value="3 months">3 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</option>
        </select>
        <div class="payment-terms mt-5">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <label class="text-muted">{{ getLocale($locale_form_property_create, 'label-8', 'PAYMENT TERMS') }}</label>
                    <a href="" class="btn btn-link">
                        {{ getLocale($locale_form_property_create, 'label-9', 'Select all') }}
                    </a>
                </div>
                <div class="col-md-12">
                    <p class="text-muted">{{ getLocale($locale_form_property_create, 'label-10', 'The following rates must include TAX') }}</p>
                </div>
                <ul class="col-md-12 list-group pl-4">
                    <li class="list-group-item paid-once" style="display: none;">
                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                <input type="checkbox">+
                            </label>
                            <span class="font-weight-bolder">
                                {{ getLocale($locale_form_property_create, 'label-11', "Paid once") }}
                            </span>
                        </div>
                        <div class="input-rate-wrapper mt-4" style="display: none;">
                            <div class="form-inline row mb-4">
                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_once" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                </div>
                                <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form_property_create, 'label-6', 'year') }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item paid-twice" style="display: none;">
                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                <input type="checkbox">+
                            </label>
                            <span class="font-weight-bolder" >
                                {{ getLocale($locale_form_property_create, 'label-15', "Paid twice") }}
                            </span>
                        </div>
                        <div class="input-rate-wrapper mt-4" style="display: none;">
                            <div class="form-inline row mb-4">
                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_twice" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                </div>
                                <p class="mb-0 col-auto required pl-0">/ 6 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</p>
                            </div>
                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                <div class="custom-control custom-switch mr-3">
                                    <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                    <label class="custom-control-label" for="nego-twice-switch"></label>
                                </div>
                                <p id="nego-twice-switch-label">{{ getLocale($locale_form_property_create, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item paid-quarterly" style="display: none;">
                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                <input type="checkbox">+
                            </label>
                            <span class="font-weight-bolder">
                                {{ getLocale($locale_form_property_create, 'label-16', "Paid quarterly") }}
                            </span>
                        </div>
                        <div class="input-rate-wrapper mt-4" style="display: none;">
                            <div class="form-inline row mb-4">
                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_quarterly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                </div>
                                <p class="mb-0 col-auto required pl-0">/ 3 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</p>
                            </div>
                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                <div class="custom-control custom-switch mr-3">
                                    <input type="checkbox" class="custom-control-input" id="nego-quarterly-switch">
                                    <label class="custom-control-label" for="nego-quarterly-switch"></label>
                                </div>
                                <p id="nego-quarterly-switch-label">{{ getLocale($locale_form_property_create, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item paid-monthly" style="display: none;">
                        <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                <input type="checkbox">+
                            </label>
                            <span class="font-weight-bolder" >
                                {{ getLocale($locale_form_property_create, 'label-17', "Paid monthly") }}
                            </span>
                        </div>
                        <div class="input-rate-wrapper mt-4" style="display: none;">
                            <div class="form-inline row mb-4">
                                <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                        </div>
                                    </div>
                                    <input type="text" class="form-control form-control-dashboard payment-terms" name="paid_monthly" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                </div>
                                <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form_property_create, 'label-7', 'month') }}</p>
                            </div>
                            <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                <div class="custom-control custom-switch mr-3">
                                    <input type="checkbox" class="custom-control-input" id="nego-monthly-switch">
                                    <label class="custom-control-label" for="nego-monthly-switch"></label>
                                </div>
                                <p id="nego-monthly-switch-label">{{ getLocale($locale_form_property_create, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <button class="btn btn-outline-primary mb-5" id="add-more-length">
        {{ getLocale($locale_form_property_create, 'label-18', 'ADD MORE LENGTH OF STAY') }}
    </button>
    <div class="card card-body mb-5">
        <p class="text-muted required">
            {{ getLocale($locale_form_property_create, 'label-19', "DO MY RATES ABOVE INCLUDE THE FOLLOWING MONTHLY CHARGES?") }}        </p>
        <div class="row my-5">
            <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                <p id="internet-switch-label" class="font-weight-bolder">Internet</p>
                <div class="custom-control custom-switch">
                    <input value="1" type="checkbox" class="custom-control-input" name="is_internet" id="internet-switch" checked>
                    <label class="custom-control-label" for="internet-switch"></label>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                <p id="parking-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'Tempat parkir pribadi' : 'Private parking slot' }}</p>
                <div class="custom-control custom-switch">
                    <input value="1" type="checkbox" class="custom-control-input" name="is_parking" id="parking-switch" checked>
                    <label class="custom-control-label" for="parking-switch"></label>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                <p id="tv-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'TV Kabel' : 'TV cable' }}</p>
                <div class="custom-control custom-switch">
                    <input value="1" type="checkbox" class="custom-control-input" name="is_tv_cable" id="tv-switch" checked>
                    <label class="custom-control-label" for="tv-switch"></label>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                <p id="cleaning-switch-label" class="font-weight-bolder">{{ session('locale') == 'id' ? 'Layanan kebersihan' : 'Cleaning service' }}</p>
                <div class="custom-control custom-switch">
                    <input value="1" type="checkbox" class="custom-control-input" name="is_cleaning" id="cleaning-switch" checked>
                    <label class="custom-control-label" for="cleaning-switch"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="form-inline row">
                    <label for="inlineFormInputGroup" class="required mr-4 col-auto">{{ getLocale($locale_form_property_create, 'label-20', "RESIDENCE SERVICE CHARGE FEE") }}</label>
                    <div class="input-group mb-2 mr-2 col-md-6">
                        <div class="input-group-prepend">
                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                            </div>
                        </div>
                        <input type="text" class="form-control form-control-dashboard" name="service_fee" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-26', "Input value or 0 if none") }}">
                    </div>
                    <p class="mb-0 col-auto">/ {{ getLocale($locale_form_property_create, 'label-7', 'month') }}</p>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-between">
                <p id="fee-paid-switch-label" class="text-muted">{{ getLocale($locale_form_property_create, 'label-21', "I would rather have the residence service charge fee paid by my renter?") }}</p>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="fee-paid-switch">
                    <label class="custom-control-label" for="fee-paid-switch"></label>
                </div>
            </div>
        </div>
    </div>
    <div id="disclaimer-section" class="p-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <h4>{{ getLocale($locale_form_property_create, 'label-22', "Disclaimer") }}</h4>
            </div>
            <div class="col-md-8">
                <p>{{ getLocale($locale_form_property_create, 'label-23', "Property lister is responsible for all tax declaration and payment") }}.</p>
                <p>{{ getLocale($locale_form_property_create, 'label-24', "Sewagi cannot be held responsible for non tax declaration and payment emanating from properties perceiving revenue and listed on our platform") }}.</p>
                <a href="" class="btn btn-link">{{ getLocale($locale_form_property_create, 'label-25', "More information") }}</a>
            </div>
        </div>
    </div>
    <input type="hidden" name="property_id" value="{{ session('property_id') }}" />
</form>
<form id="newPropertyData9" {{ (isset($step) && $step == 9) ? 'style=display:block;' : 'style=display:none;' }}>
    <div class="col-md-10">
        <div class="mb-5">
            <h4 class="mb-4 required">{{ getLocale($locale_form_property_create, 'label-27', 'Set up your preferred payment options') }}</h4>
        </div>
        <div class="mb-5">
            <h5 class="mb-4">Co-Living</h5>
            <div id="length-of-stay-container-co-living"></div>
        </div>
        <div id="length-stay-row-clone-co-living" class="card card-body mb-5 length-stay-row-co-living" style="display: none;">
            <div class="d-flex justify-content-between">
                <label class="mb-4 text-muted">{{ getLocale($locale_form_property_create, 'label-3', 'LENGTH OF STAY') }}</label>
                <a href="#" class="btn btn-link btn-save-length-stay-co-living" style="display: none;">
                    {{ getLocale($locale_form_property_create, 'label-4', 'Save') }}
                </a>
            </div>
            <select class="select2 select2-list-property length-stay-co-living" placeholder="">
                <option value=""></option>
                <option value="1 year">1 {{ getLocale($locale_form_property_create, 'label-6', 'year') }}</option>
                <option value="9 months">9 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</option>
                <option value="6 months">6 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</option>
                <option value="3 months">3 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</option>
            </select>
            <div class="payment-terms mt-5">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <label class="text-muted">{{ getLocale($locale_form_property_create, 'label-8', 'PAYMENT TERMS') }}</label>
                        <a href="" class="btn btn-link">
                            {{ getLocale($locale_form_property_create, 'label-9', 'Select all') }}
                        </a>
                    </div>
                    <div class="col-md-12">
                        <p class="text-muted">{{ getLocale($locale_form_property_create, 'label-10', 'The following rates must include TAX') }}</p>
                    </div>
                    <ul class="col-md-12 list-group pl-4">
                        <li class="list-group-item paid-once-co-living" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form_property_create, 'label-11', "Paid once") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms-co-living" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form_property_create, 'label-6', 'year') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-twice-co-living" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form_property_create, 'label-15', "Paid twice") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms-co-living" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ 6 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</p>
                                </div>
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-twice-switch">
                                        <label class="custom-control-label" for="nego-twice-switch"></label>
                                    </div>
                                    <p id="nego-twice-switch-label">{{ getLocale($locale_form_property_create, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-quarterly-co-living" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form_property_create, 'label-16', "Paid quarterly") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms-co-living" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ 3 {{ getLocale($locale_form_property_create, 'label-7', 'months') }}</p>
                                </div>
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-quarterly-switch">
                                        <label class="custom-control-label" for="nego-quarterly-switch"></label>
                                    </div>
                                    <p id="nego-quarterly-switch-label">{{ getLocale($locale_form_property_create, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item paid-monthly-co-living" style="display: none;">
                            <div class="btn-group-toggle d-flex align-items-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-checkbox btn-circle mb-0 mr-4 btn-paid-checkbox">
                                    <input type="checkbox">+
                                </label>
                                <span class="font-weight-bolder">
                                    {{ getLocale($locale_form_property_create, 'label-17', "Paid monthly") }}
                                </span>
                            </div>
                            <div class="input-rate-wrapper mt-4" style="display: none;">
                                <div class="form-inline row mb-4">
                                    <div class="input-group mb-2 col-9 col-md-8 offset-md-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-dashboard payment-terms-co-living" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-13', "Input your rate") }}">
                                    </div>
                                    <p class="mb-0 col-auto required pl-0">/ {{ getLocale($locale_form_property_create, 'label-7', 'month') }}</p>
                                </div>
                                <div class="d-flex justify-content-start col-md-11 offset-md-1">
                                    <div class="custom-control custom-switch mr-3">
                                        <input type="checkbox" class="custom-control-input" id="nego-monthly-switch">
                                        <label class="custom-control-label" for="nego-monthly-switch"></label>
                                    </div>
                                    <p id="nego-monthly-switch-label">{{ getLocale($locale_form_property_create, 'label-14', "I'm open to negotiate my rate with the prospective renter") }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-primary mb-5" id="add-more-length-co-living">
            {{ getLocale($locale_form_property_create, 'label-18', 'ADD MORE LENGTH OF STAY') }}
        </button>
        <div class="card card-body mb-5">
            <p class="text-muted required">
                {{ getLocale($locale_form_property_create, 'label-19', "DO MY RATES ABOVE INCLUDE THE FOLLOWING MONTHLY CHARGES?") }}            </p>
            <div class="row my-5">
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="internet-switch-label" class="font-weight-bolder">Internet</p>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="internet-switch" checked>
                        <label class="custom-control-label" for="internet-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="parking-switch-label" class="font-weight-bolder">Private parking slot</p>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="parking-switch" checked>
                        <label class="custom-control-label" for="parking-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="tv-switch-label" class="font-weight-bolder">TV cable</p>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="tv-switch" checked>
                        <label class="custom-control-label" for="tv-switch"></label>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 d-flex justify-content-between">
                    <p id="cleaning-switch-label" class="font-weight-bolder">Cleaning service</p>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="cleaning-switch" checked>
                        <label class="custom-control-label" for="cleaning-switch"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="form-inline row">
                        <label for="inlineFormInputGroup" class="required mr-4 col-auto">{{ getLocale($locale_form_property_create, 'label-20', "RESIDENCE SERVICE CHARGE FEE") }}</label>
                        <div class="input-group mb-2 mr-2 col-md-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text form-control-dashboard">{{ getLocale($locale_form_property_create, 'label-12', "IDR") }}
                                </div>
                            </div>
                            <input type="text" class="form-control form-control-dashboard" id="inlineFormInputGroup" placeholder="{{ getLocale($locale_form_property_create, 'label-26', "Input value or 0 if none") }}">
                        </div>
                        <p class="mb-0 col-auto">/ {{ getLocale($locale_form_property_create, 'label-7', 'month') }}</p>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-between">
                    <p id="fee-paid-switch-label" class="text-muted">{{ getLocale($locale_form_property_create, 'label-21', "I would rather have the residence service charge fee paid by my renter?") }}"</p>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="fee-paid-switch">
                        <label class="custom-control-label" for="fee-paid-switch"></label>
                    </div>
                </div>
            </div>
        </div>
        <div id="disclaimer-section" class="p-5 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <h4>{{ getLocale($locale_form_property_create, 'label-22', "Disclaimer") }}</h4>
                </div>
                <div class="col-md-8">
                    <p>{{ getLocale($locale_form_property_create, 'label-23', "Property lister is responsible for all tax declaration and payment") }}.</p>
                    <p>{{ getLocale($locale_form_property_create, 'label-24', "Sewagi cannot be held responsible for non tax declaration and payment emanating from properties perceiving revenue and listed on our platform") }}.</p>
                    <a href="" class="btn btn-link">{{ getLocale($locale_form_property_create, 'label-25', "More information") }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 float-right">
        <div id="info-payment-term">
            <p>Monthly payments help you lease your bedrooms faster.</p>
            <p>Don’t overprice them just because it’s on monthly terms. </p>
        </div>
    </div>
    <input type="hidden" name="property_id" value="{{ session('property_id') }}" />
</form>
<form id="newPropertyData10" {{ (isset($step) && $step == 10) ? 'style=display:block;' : 'style=display:none;' }}>
    <div class="row justify-content-between align-items-center mb-5">
        <div class="col-auto">
            <h3>Let's review your listing</h3>
        </div>
        <div class="col-auto">
            <a href="#" class="btn btn-primary">VIEW LISTING MOCKUP</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <h6 class="text-muted">STEP 1</h6>
                    <h5 style="min-height: 45px">Basic property information</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <ul class="list-unstyled list-vertical-line">
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewPropertyTypeLivingCondition ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Property type & living condition</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewBedroomBathroom ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Bedroom & bathroom</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewLocation ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Location</p>
                            </span>
                        </li>
                    </ul>
                    <a href="/add-property/1/{{$property->id}}" class="btn btn-outline-primary">EDIT</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <h6 class="text-muted">STEP 2</h6>
                    <h5 style="min-height: 45px">Tell us the details</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <ul class="list-unstyled list-vertical-line">
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewDescriptionHouseRules ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Description & house rules</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewAmenitiesFacilities ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Amenities & facilities</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewPhotos ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Photos</p>
                            </span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewLegalDetails ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Legal details</p>
                            </span>
                        </li>
                    </ul>
                    <a href="/add-property/4/{{$property->id}}" class="btn btn-outline-primary">EDIT</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <h6 class="text-muted">STEP 3</h6>
                    <h5 style="min-height: 45px">Payment preference</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <ul class="list-unstyled list-vertical-line">
                        <li class="d-flex align-items-center">
                            <span class="icon-circle d-flex align-items-center">
                                {!! $reviewPaymentPreferenceForCoLiving ? '<i class="fas fa-check"></i>' : '' !!}
                            </span>
                            <span>
                                <p class="mb-0">Payment preference for co-living</p>
                            </span>
                        </li>
                    </ul>
                    <a href="/add-property/8/{{$property->id}}" class="btn btn-outline-primary">EDIT</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 border-top py-5">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Legal documents</h5>
                    <p class="text-muted mb-4">You may skip uploading the required document for now.
                    However, you will need to upload them when signing the lease contract with the renter. <span><a href="#">Upload now.</a></span></p>
                </div>
                <div class="col-md-4">
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center form-control-dashboard p-4 mb-4">
                            <span class="icon-circle d-flex align-items-center">
                                <i class="fas fa-check"></i>
                            </span>
                            <h6 class="mb-0">Property ownership certificate</h6>
                        </li>
                        <li class="d-flex align-items-center form-control-dashboard text-muted p-4">
                                <span class="icon-circle-muted">
                                <span></span>
                            </span>
                            <h6 class="mb-0">Property insurance document</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade modal-dashboard" id="modalSubmitAgree" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img class="mb-5" src="../img/listing-submitted.svg" alt="">
                <p class="mb-5">By submitting my listing to Sewagi, I understand and agree to honor the following <a href="#">General Terms of Partnership</a> and abide by the Sewagi platform <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></p>
                <div class="button-group">
                    <button class="btn btn-outline-primary mr-2" data-dismiss="modal">DECLINE</button>
                    <button class="btn btn-primary" href="#modalSubmitSuccess" data-dismiss="modal" data-toggle="modal">AGREE</button>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-dashboard" id="modalSubmitSuccess" tabindex="-1" role="dialog">
    <div class="modal-dialog from-right" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img class="mb-5" src="../img/listing-submitted.svg" alt="">
                <h5 class="mb-5">Yeay! Your listing has been submitted.</h5>
                <p class="mb-5">We will review your listing to check if all is tip-top before publishing it online within one working day.</p>
                <div class="button-group">
                    <a class="btn btn-primary" href="#" data-dismiss="modal">GO TO DASHBOARD</a>
                </div>

            </div>
        </div>
    </div>
</div>

<input value="{{ $step }}" type="hidden" name="step" id="step">
<input value="0" type="hidden" name="count" id="count">
<input value="{{ $property->id }}" type="hidden" id="property_id" />
@endsection
@section('next_step')
<div class="col-md-12 border-top py-5 justify-content-between d-flex">
    <a id="link-previous" class="btn btn-link btn-prev-list-property d-flex align-items-center" href="#">
        <i class="fas fa-long-arrow-alt-left mr-2"></i>
        {{ getLocale($locale_form_property_create, 'label-previous', 'Previous') }}
    </a>
    <a id ="link-next" class="btn btn-primary btn-next-list-property" href="">
        {{ getLocale($locale_form_property_create, 'label-next', 'Next') }}
        <i class="fas fa-long-arrow-alt-right ml-2"></i>
    </a>
    <a id ="link-submit" class="btn btn-primary btn-next-list-property" href="#modalSubmitAgree" data-toggle="modal" style="display: none;">
        {{ getLocale($locale_form_property_create, 'label-submit', 'Submit') }}
        <i class="fas fa-long-arrow-alt-right ml-2"></i>
    </a>
</div>
@endsection
