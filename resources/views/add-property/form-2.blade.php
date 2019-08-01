@extends('_partials.master_solid_nosearch')
@section('content')
<div id="newPropertyData2" class="form-list-property">
    @csrf
    <div class="mb-5" id="bedroom-wrapper">
        <h4 class="mb-4">{{ getLocale($locale_form2, 'label-1', 'Bedrooms inventory') }}</h4>
        <div id="bedroom-wrapper-content">
            <form action="#" method="POST" class="card mb-4 template-bedroom" data-id="0">
                <div class="card-body">
                    <div class="d-flex justify-content-between bedroom-title-wrap">
                        <h5 class="mb-5 bedroom-title"></h5>
                        <div class="button-group">
                            <input type="hidden" name="id" value="0" class="bed_id">
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <button type="submit" class="mr-3 btn btn-link">{{ session('locale')=='id' ? 'Simpan' : 'Save'}}</button>
                            <button type="submit" class="bedroom-row-reset btn btn-link">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-relative">
                                <label for="bedType" class="required" style="font-size: 12px;font-weight: 500;color: #A6B2B8; letter-spacing: 1.8px;text-transform: uppercase;">{{ getLocale($locale_form2, 'label-bedroom-inv-1', 'Bedroom type') }}</label>
                                <select class="select2 select2-list-property bed-type" name="type" id="" required>
                                    <option value=""></option>
                                    <option value="master" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-1', 'Bedroom containing the most amenities, typically the largest in your property') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-4', 'Master Bedroom') }}</option>
                                    <option value="standard" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-2', 'Bedroom smaller in size than your master bedroom, with less amenities') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-5', 'Standard Bedroom') }}</option>
                                    <option value="pocket" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-3', 'Bedroom fit for the budget conscious renter, typically smaller in size than your standard bedroom, with fewer amenities') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-6', 'Pocket Bedroom') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="required" for="" style="font-size: 12px;font-weight: 500;color: #A6B2B8; letter-spacing: 1.8px;text-transform: uppercase;">{{ getLocale($locale_form2, 'label-bedroom-inv-2', 'Bedroom Size') }}</label>
                                <div class="input-group">
                                    <input class="form-control form-control-dashboard bedroom-size" id="unit-size-input" type="number" placeholder="0" min="0" name="size" value="" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="required" for="" style="font-size: 12px;font-weight: 500;color: #A6B2B8; letter-spacing: 1.8px;text-transform: uppercase;">{{ getLocale($locale_form2, 'label-bedroom-inv-3', 'Bedroom quantity') }}</label>
                                <input class="form-control form-control-dashboard mb-2 bedroom-quantity" type="number" placeholder="1" value="1" min="1" name="quantity" required>
                                <a href="#" data-toggle="modal" data-target="#modalRoomNumbering" class="required modal-room-numbering-link">{{ getLocale($locale_form2, 'label-bedroom-inv-4', 'Room Numbering') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="bedType" class="required" style="font-size: 12px;font-weight: 500;color: #A6B2B8; letter-spacing: 1.8px;text-transform: uppercase;">{{ getLocale($locale_form2, 'label-bedroom-inv-5', 'Bedroom furniture arrangement') }}</label>
                                <select class="select2 select2-list-property bed-furniture" name="furniture" id="" required>
                                    <option value=""></option>
                                    <option value="furnished">{{ getLocale($locale_form2, 'label-bedroom-inv-5-1', 'Furnished') }}</option>
                                    <option value="semi-furnished">{{ getLocale($locale_form2, 'label-bedroom-inv-5-2', 'Semi-Furnished') }}</option>
                                    <option value="unfurnished">{{ getLocale($locale_form2, 'label-bedroom-inv-5-3', 'Unfurnished') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="" class="row bed-arrangement-wrapper" style="display: none">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="bedArrangement" class="required" style="font-size: 12px;font-weight: 500;color: #A6B2B8; letter-spacing: 1.8px;text-transform: uppercase;">{{ getLocale($locale_form2, 'label-bedroom-inv-6', 'Bed arrangement') }}</label>
                                <select class="select2 select2-list-property bed-arrangement" name="bed_arrangement" id="">
                                    <option value=""></option>
                                    <option value="twin">{{ getLocale($locale_form2, 'label-bedroom-inv-6-1', 'Twin Bed') }}</option>
                                    <option value="single">{{ getLocale($locale_form2, 'label-bedroom-inv-6-2', 'Single Size Bed') }}</option>
                                    <option value="queen">{{ getLocale($locale_form2, 'label-bedroom-inv-6-3', 'Queen Size Bed') }}</option>
                                    <option value="king">{{ getLocale($locale_form2, 'label-bedroom-inv-6-4', 'King Size Bed') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bedLayout">{{ getLocale($locale_form2, 'label-bedroom-inv-7', 'Bedroom Layout') }}</label>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-rounded btn-checkbox btn-outline-primary mr-10 mb-10">
                                        <input type="checkbox" name="is_loft" value="1">{{ session('locale') =='id' ? 'Loteng' : 'Loft' }}

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="bedAmenities">{{ getLocale($locale_form2, 'label-bedroom-inv-8', 'Bedroom Amenities') }}</label>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    @foreach($amenityList as $amenity)
                                        <label class="btn btn-rounded btn-checkbox btn-outline-primary mr-10 mb-10">
                                            <input type="checkbox" value="{{$amenity->id}}" class="bedroom-amenities-{{$amenity->type}}" name="amenities[]">{{ session('locale')=='id' ? $amenity->id_name : $amenity->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if (isset($bedrooms))
                @foreach($bedrooms as $key => $bedroom)
                <form action="#" method="POST" class="card mb-4 form-bedroom" data-id="{{ $bedroom->id }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between bedroom-title-wrap">
                            <h5 class="mb-5 bedroom-title">{{ $bedroom->name }}</h5>
                            <div class="button-group">
                                <input type="hidden" name="id" value="{{ $bedroom->id }}" class="bed_id">
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <button type="submit" class="mr-3 btn btn-link">{{ session('locale')=='id' ? 'Simpan' : 'Save'}}</button>
                                <button type="button" class="bedroom-row-reset btn btn-link" data-id="{{ $bedroom->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bedType" class="required">{{ getLocale($locale_form2, 'label-bedroom-inv-1', 'Bedroom type') }}</label>
                                    <select class="select2 select2-list-property bed-type select2inp" name="type" id="" required>
                                        <option value=""></option>
                                        <option value="master" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-1', 'Bedroom containing the most amenities, typically the largest in your property') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-4', 'Master Bedroom') }}</option>
                                        <option value="standard" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-2', 'Bedroom smaller in size than your master bedroom, with less amenities') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-5', 'Standard Bedroom') }}</option>
                                        <option value="pocket" title="{{ getLocale($locale_form2, 'label-bedroom-inv-1-3', 'Bedroom fit for the budget conscious renter, typically smaller in size than your standard bedroom, with fewer amenities') }}">{{ getLocale($locale_form2, 'label-bedroom-inv-1-6', 'Pocket Bedroom') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required" for="">{{ getLocale($locale_form2, 'label-bedroom-inv-2', 'Bedroom Size') }}</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-dashboard bedroom-size" id="unit-size-input" type="number" placeholder="0" min="0" name="size" value="{{ $bedroom->size }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="required" for="">{{ getLocale($locale_form2, 'label-bedroom-inv-3', 'Bedroom quantity') }}</label>
                                    <input class="form-control form-control-dashboard mb-2 bedroom-quantity" type="number" placeholder="1" min="1" name="quantity" value="{{ $bedroom->quantity }}" required>
                                    <a href="#" data-toggle="modal" data-target="#modalRoomNumbering" class="required modal-room-numbering-link">{{ getLocale($locale_form2, 'label-bedroom-inv-4', 'Room Numbering') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="bedType" class="required">{{ getLocale($locale_form2, 'label-bedroom-inv-5', 'Bedroom furniture arrangement') }}</label>
                                    <select class="select2 select2-list-property bed-furniture select2inp" name="furniture" id="" required>
                                        <option value=""></option>
                                        <option value="furnished" {{ $bedroom->furniture == 'furnished' ? 'selected' : '' }}>{{ getLocale($locale_form2, 'label-bedroom-inv-5-1', 'Furnished') }}</option>
                                        <option value="semi-furnished" {{ $bedroom->furniture == 'semi-furnished' ? 'selected' : '' }}>{{ getLocale($locale_form2, 'label-bedroom-inv-5-2', 'Semi-Furnished') }}</option>
                                        <option value="unfurnished"{{ $bedroom->furniture == 'unfurnished' ? 'selected' : '' }}>{{ getLocale($locale_form2, 'label-bedroom-inv-5-3', 'Unfurnished') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="" class="row bed-arrangement-wrapper" data-id="{{ $bedroom->id }}" style="{{ (empty($bedroom->furniture) OR $bedroom->furniture == 'unfurnished') ? 'display: none' : '' }}">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="bedArrangement" class="required">{{ getLocale($locale_form2, 'label-bedroom-inv-6', 'Bed arrangement') }}</label>
                                    <select class="select2 select2-list-property bed-arrangement select2inp" name="bed_arrangement" id="">
                                        <option value=""></option>
                                        <option value="twin" {{ $bedroom->bed_arrangement == 'twin' ? 'selected' : '' }}>{{ getLocale($locale_form2, 'label-bedroom-inv-6-1', 'Twin Bed') }}</option>
                                        <option value="single" {{ $bedroom->bed_arrangement == 'single' ? 'selected' : '' }}>{{ getLocale($locale_form2, 'label-bedroom-inv-6-2', 'Single Size Bed') }}</option>
                                        <option value="queen" {{ $bedroom->bed_arrangement == 'queen' ? 'selected' : '' }}>{{ getLocale($locale_form2, 'label-bedroom-inv-6-3', 'Queen Size Bed') }}</option>
                                        <option value="king" {{ $bedroom->bed_arrangement == 'king' ? 'selected' : '' }}>{{ getLocale($locale_form2, 'label-bedroom-inv-6-4', 'King Size Bed') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bedLayout">{{ getLocale($locale_form2, 'label-bedroom-inv-7', 'Bedroom Layout') }}</label>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-sm btn-checkbox btn-outline-primary mr-10 mb-10 {{ $bedroom->is_loft == 1 ? 'active' : '' }}">
                                            <input type="checkbox" name="is_loft" value="1" {{ $bedroom->is_loft == 1 ? 'checked' : '' }}>+ {{ session('locale') =='id' ? 'Loteng' : 'Loft' }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bedAmenities">{{ getLocale($locale_form2, 'label-bedroom-inv-8', 'Bedroom Amenities') }}</label>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                            @foreach($amenityList as $amenity)
                                                @php $isChecked = (in_array($amenity->id, $bedroom->amenity_values) ? true : false); @endphp
                                                <label class="btn btn-sm btn-checkbox btn-outline-primary mr-10 mb-10 {{ $isChecked ? 'active' : '' }}">
                                                    <input type="checkbox" value="{{$amenity->id}}" class="bedroom-amenities-{{$amenity->type}}" name="amenities[]" {{ $isChecked ? 'checked' : '' }}>{{ session('locale') == 'id' ? $amenity->id_name : $amenity->name }}
                                                </label>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            @endif
        </div>
        @if ($errors->count())
        <div>
            <label for="" class="error">
                {{ $errors->first('msg') }}
            </label>
        </div>
        @endif
        <button id="btn-add-newbedroom" class="btn btn-primary btn-outline-primary">
            {{ getLocale($locale_form2, 'label-2', 'ADD NEW BEDROOM') }}
        </button>
    </div>
    <div class="mb-5">
        <h4 class="mb-4">{{ getLocale($locale_form2, 'label-3', 'How many bathrooms are there?') }}</h4>
        <div class="form-group form-inline">
            <label class="mr-5">{{ getLocale($locale_form2, 'label-5', 'Total bathroom') }}</label>
            <div class='btn-counter'>
                <button class='down_count' href="#" title='Down'>
                    <i class="fas fa-minus"></i>
                </button>
                <input class='counter' type="text" placeholder="value..." value="{{ $property->bathrooms > 0 ? $property->bathrooms : 0 }}" name="total_bathroom"/>
                <button class='up_count' href="#" title='Up'>
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4">{{ getLocale($locale_form2, 'label-5', 'Total listed bedrooms') }}: <span class="ml-4" id="total-listed-bedroom" name="total_bedroom"></span></h4>
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
                        <label class="required font-weight-bolder">{{ getLocale($locale_form2, 'label-modal-numbering-1', 'Please input your bedrooms Number / Name.') }}</label>
                        <label class="text-muted d-block">E.g. 1A, 1B, 1C, 101, 102, Jasmin 1</label>
                        <div class="row mt-5 modal-room-numbering-container"></div>
                    </div>
                    <div class="button-group d-flex justify-content-end">
                        <a class="btn btn-primary disabled btn-room-numbering-done" href="#" data-dismiss="modal">{{ getLocale($locale_form2, 'label-modal-numbering-2', 'Done') }}</a>
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
                        {{ getLocale($locale_form2, 'label-not-available', 'Not Available') }}
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
                        <label class="required font-weight-bolder">{{ getLocale($locale_form2, 'label-modal-numbering-1', 'Please input your bedrooms Number / Name.') }}</label>
                        <label class="text-muted d-block">E.g. 1A, 1B, 1C, 101, 102, Jasmin 1</label>
                        <div class="row mt-5 modal-room-numbering-container"></div>
                    </div>
                    <div class="button-group d-flex justify-content-end">
                        <a class="btn btn-primary disabled btn-room-numbering-done" href="#" data-dismiss="modal">{{ getLocale($locale_form2, 'label-modal-numbering-2', 'Done') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal face modal-dashboard modal-derease-room modal-decrease-room" id="popUpDecreaseBedroom" tabindex="-1" role="dialog">
        <div class="modal-dialog from-right" role="document">
            <div class="modal-content bg-grey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="moon-close btn-hover"></i>
                </button>
                <div class="modal-body text-center">
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-decrease-2', 'Are you sure want to decrease the bedroom quantity ?') }}</label>
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-decrease-2', 'if you decrease, it will update bedrooms Number/Name.') }}</label>
                </div>
                <div class="modal-footer no-border justify-content-center">
                    <a class="btn btn-primary mr-2" href="#" data-dismiss="modal">{{ getLocale($locale_form2, 'label-modal-decrease-2', 'YES') }}</a>
                    <a class="btn btn-primary mr-2" href="#" data-dismiss="modal">{{ getLocale($locale_form2, 'label-modal-decrease-2', 'NO') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal face modal-dashboard modal-increase-room" id="popUpIncreaseBedroom" tabindex="-1" role="dialog">
        <div class="modal-dialog from-right" role="document">
            <div class="modal-content bg-grey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="moon-close btn-hover"></i>
                </button>
                <div class="modal-body text-center">
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-increase-1', 'By increasing the bedroom quantity you will need to') }}</label>
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-increase-2', 'update the bedrooms Number/Name.') }}'</label>
                </div>
                <div class="modal-footer no-border justify-content-center">
                    <a class="btn btn-primary mb-2" href="#" data-dismiss="modal">{{ getLocale($locale_form2, 'label-modal-increase-3', 'GOT IT') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal face modal-dashboard modal-confrim-availability-room" id="popUpAvailabilityBedroom" tabindex="-1" role="dialog">
        <div class="modal-dialog from-right" role="document">
            <div class="modal-content bg-grey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="moon-close btn-hover"></i>
                </button>
                <div class="modal-body text-center">
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-availability-1', 'Toggling OFF the bedroom, will readjust the number of') }}</label>
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-availability-2', 'available bedroom for the corresponding bedroom type, and') }}</label>
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-availability-3', "won't be publish it.") }}</label>
                    <label class="mb-5"></label>
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-availability-4', 'Later, you willbe able to toggle ON the bedroom in your') }}</label>
                    <label class="mb-5">{{ getLocale($locale_form2, 'label-modal-availability-5', 'dashboard, in order to publish and make it available for rent') }}</label>
                </div>
                <div class="modal-footer no-border justify-content-center">
                    <a class="btn btn-primary mr-2" href="#" data-dismiss="modal">{{ getLocale($locale_form2, 'label-modal-availability-6', 'GOT IT') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<form role="form" method="POST" action="{{ url('/create-property/2') }}" class="form-list-property">
    @csrf
    <input type="hidden" name="id" value="{{ $property->id }}" id="property-id"/>
    <input type="hidden" name="total_bedroom" value="{{ $property->bedrooms }}" id="total-bedroom">
    <input type="hidden" name="total_bathroom" value="{{ $property->bathrooms }}" id="total-bathroom">
    <input value="2" type="hidden" name="step" id="step">
</form>
<input value="0" type="hidden" name="count" id="count">
@if(isset($bedrooms))
<input value="1" type="hidden" name="updateBedroom">
@endif
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/1" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form2, 'label-previous', 'Previous') }}
</a>
<button id ="submit-list-property" class="btn btn-primary btn-next-list-property" style="padding-left: 32px;padding-right: 32px;padding-top: 15px;padding-bottom: 15px;letter-spacing: 1px">
    {{ getLocale($locale_form2, 'label-next', 'Next') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</button>
@endsection
