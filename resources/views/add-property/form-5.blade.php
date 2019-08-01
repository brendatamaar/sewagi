@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData5" role="form" method="POST" action="{{ url('/create-property/5') }}" class="form-list-property">
    @csrf
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form5, 'label-1', 'What is your property furniture arrangement?') }}</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="furniture" id="furniture-arrangement">
                <option value=""></option>
                <option value="Furnished" {{ $property->furniture == 'furnished' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Berperabot' : 'Furnished' }}</option>
                <option value="Semi-Furnished" {{ $property->furniture == 'semi-furnished' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Semi Berperabot' : 'Semi-Furnished' }}</option>
                <option value="Unfurnished" {{ $property->furniture == 'unfurnished' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Tidak Berperabot' : 'Unfurnished' }}</option>
            </select>
            @if ($errors->has('furniture'))
                <label class="form-error text-danger">{{ $errors->first('furniture') }}</label>
            @endif
        </div>
    </div>
    <div class="mb-5">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="required">{{ getLocale($locale_form5, 'label-2', 'What amenities do you provide?') }}</h4>
            @php
                $original_caption = ($property->amenities && count($property->amenities)>0) ? (session('locale')=='id' ? 'Sunting' : 'Edit') : getLocale($locale_form5, 'label-3', 'Add');
            @endphp
            <button data-property_id="{{ $property }}" data-original_caption="{{ $original_caption }}" type="button" id="btn-add-amenities" data-toggle="collapse" href="#amenities-provide" aria-expanded="false" aria-controls="amenities-provide" class="btn btn-link">{{ $original_caption }}</button>
        </div>
        @if ($errors->has('amenity_id'))
            <label class="form-error text-danger">{{ $errors->first('amenity_id') }}</label>
        @endif
        <div id="amenities-provide" class="collapse">
            <div class="row">
                @foreach($propertyAmenity as $value)
                    <div class="col-md-3">
                        <div class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-outline-primary {{$property->amenities->contains($value->id) ? 'active' : '' }}">
                                <input type="checkbox" name="amenity_id[]" value="{{$value->id}}" {{$property->amenities->contains($value->id) ? 'checked' : '' }}>+ {{session('locale')=='id' ? $value->id_name : $value->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="required">{{ getLocale($locale_form5, 'label-4', 'What are the available facilities?') }}</h4>
            @php
                $original_caption = ($property->facilities && count($property->facilities)>0) ? (session('locale')=='id' ? 'Sunting' : 'Edit') : getLocale($locale_form5, 'label-3', 'Add');
            @endphp
            <button data-property_id="{{ $property }}" data-original_caption="{{ $original_caption }}" type="button" id="btn-add-facilities" data-toggle="collapse" href="#available-facilities" aria-expanded="false" aria-controls="available-facilities" class="btn btn-link">{{ $original_caption }}</button>
        </div>
        @if ($errors->has('facility_id'))
            <label class="form-error text-danger">{{ $errors->first('facility_id') }}</label>
        @endif
        <div id="available-facilities" class="collapse">
            <div class="row">
                @foreach($facility as $value)
                    <div class="col-md-3">
                        <div class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-checkbox btn-outline-primary {{$property->facilities->contains($value->id) ? 'active' : '' }}">
                                <input type="checkbox" name="facility_id[]" value="{{$value->id}}" {{$property->facilities->contains($value->id) ? 'checked' : '' }}>+ {{session('locale')=='id' ? $value->id_name : $value->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value=" {{ $property->id }}" />
    <input value="5" type="hidden" name="step" id="step">
</form>
<input value="5" type="hidden" name="step" id="step">
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/4" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form5, 'label-previous', 'Previous') }}
</a>
<button id ="submit-list-property" class="btn btn-primary btn-next-list-property">
    {{ getLocale($locale_form5, 'label-next', 'Next') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</button>
@endsection
