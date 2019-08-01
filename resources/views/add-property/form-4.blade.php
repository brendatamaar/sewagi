@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData4" role="form" method="POST" action="{{ url('/create-property/4') }}" class="form-list-property">
    @csrf
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form4, 'label-1', 'By Give a title describing your property') }}</h4>
        <div class="form-group">
            <textarea class="form-control form-control-dashboard" placeholder="E.g. Amazing Cityscape - SCBD Apartment" rows="2" maxlength="60" name="title" required>{{ $property->title }}</textarea>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form4, 'label-2', 'Give more details to better describe your property') }}</h4>
        <div class="form-group">
            <textarea class="form-control form-control-dashboard" placeholder="E.g. Amazing Cityscape - SCBD Apartment" rows="6" maxlength="300" name="description" required>{{ $property->description }}</textarea>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form4, 'label-3', 'Select design preferences best describing your property') }}</h4>
        <p class="text-muted fs-12">{{ getLocale($locale_form4, 'label-4', 'You may select up to 2 styles') }}</p>
        <div class="row">
            @foreach($style as $value)
                <div class="col-md-3 mb-3 text-center">
                    <img src="{{$value->image}}" alt="" class="img-fluid my-4">
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-sm btn-checkbox btn-outline-primary property-style {{$property->styles->contains($value->id) ? 'active' : '' }}">
                            <input type="checkbox" name="style_id[]" value="{{$value->id}}" {{$property->styles->contains($value->id) ? 'checked' : '' }}>+ {{session('locale')=='id' ? $value->id_name : $value->name}}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if ($property->type == 'house')
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form4, 'label-5', 'Select your property land area type') }}</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="land_area_type" id="property-land-area" required>
                <option value=""></option>
                <option value="residential" {{ $property->land_area_type == 'residential' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Perumahan' : 'Residential' }}</option>
                <option value="non residential" {{ $property->land_area_type == 'non residential' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Non Perumahan' : 'Non Residential' }}</option>
            </select>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form4, 'label-6', 'Select your property arrangement') }}</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="arrangement" id="property-arrangement" required>
                <option value=""></option>
                <option value="townhouse" {{ $property->arrangement == 'townhouse' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Cluster' : 'Townhouse' }}</option>
                <option value="standalone" {{ $property->arrangement == 'standalone' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'DIbangun terpisah' : 'Standalone' }}</option>
            </select>
        </div>
    </div>
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form4, 'label-7', 'How many storeys does your property have?') }}</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="storey" id="property-floor" required>
                <option value=""></option>
                <option value="1" {{ $property->storey == '1' ? 'selected' : '' }}>{{ session('locale')=='id' ? '1 lantai' : '1 storey' }}</option>
                <option value="2" {{ $property->storey == '2' ? 'selected' : '' }}>{{ session('locale')=='id' ? '2 lantai' : '2 storeys' }}</option>
                <option value="3+" {{ $property->storey == '3+' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Diatas 3 lantai' : '3+ storeys' }}</option>
            </select>
        </div>
    </div>
    @endif
    @if ($property->type == 'apartment')
    <div class="mb-5">
        <h4 class="mb-4 required">{{ getLocale($locale_form4, 'label-7', 'On which floor is your property?') }}</h4>
        <div class="form-group">
            <select class="select2 select2-list-property" name="floor_range" id="property-floor" required>
                <option value=""></option>
                <option value="below 5" {{ $property->floor_range == 'below 5' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Dibawah 5 lantai' : 'Below 5 storeys' }}</option>
                <option value="between 5-10" {{ $property->floor_range == 'between 5-10' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Antara 5-10 lantai' : 'Between 5-10 storeys' }}</option>
                <option value="above 10" {{ $property->floor_range == 'above 10' ? 'selected' : '' }}>{{ session('locale')=='id' ? 'Diatas 10 lantai' : 'Above 10 storeys' }}</option>
            </select>
        </div>
    </div>
    @endif
    <div class="mb-5">
        <h4 class="mb-4">{{ getLocale($locale_form4, 'label-8', 'Do you have any property rules?') }}</h4>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <p id="pet-switch-label">{{ getLocale($locale_form4, 'label-9', 'Pet Friendly') }}</p>
                <div class="custom-control custom-switch">
                    <input value="1" type="checkbox" class="custom-control-input" name="is_pet_friendly" id="pet-switch" {{ $property->is_pet_friendly == '0' ? '' : 'checked' }}>
                    <label class="custom-control-label" for="pet-switch"></label>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value=" {{ $property->id }}" />
    <input value="4" type="hidden" name="step" id="step">
</form>
<input value="0" type="hidden" name="count" id="count">
@endsection
@section('next_step')
<a id="link-previous" href="/create-property/{{ $property->id }}/3" class="btn btn-link btn-prev-list-property d-flex align-items-center">
    <i class="fas fa-long-arrow-alt-left mr-2"></i>
    {{ getLocale($locale_form4, 'label-previous', 'Previous') }}
</a>
<button id="submit-list-property" class="btn btn-primary btn-next-list-property">
    {{ getLocale($locale_form4, 'label-next', 'Next') }}
    <i class="fas fa-long-arrow-alt-right ml-2"></i>
</button>
@endsection
