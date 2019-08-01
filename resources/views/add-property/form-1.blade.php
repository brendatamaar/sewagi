@extends('_partials.master_solid_nosearch')
@section('content')
<form id="newPropertyData1" role="form" method="POST" action="{{ url('/create-property') }}" class="form-list-property">
@csrf
    <div class="mb-5">
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
                @if ($errors->has('type'))
                    <label class="form-error text-danger">{{ $errors->first('type') }}</label>
                @endif
            </div>
            <div class="col-md-4 estate-size" style="display: none;">
                <div class="form-group d-flex align-items-center">
                    <label class="label-special text-muted fs-12" id="estate-label" for="">{{ getLocale($locale_form1, 'label-3', 'UNIT SIZE') }}</label>
                    <?php $size = isset($property) ? ($property->unit_size ? $property->unit_size : $property->building_size) : ''; ?>
                    <input class="form-control form-control-dashboard" id="size-input" type="number" placeholder="0" style="display: none" name="size" value="{{ old('size', $size) }}">
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
                    <img class="mb-4" src="/img/list-property-coliving.svg" alt="Co-living" />
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
                        <label class="btn btn-checkbox btn-rounded btn-outline-primary mr-10 mb-10 {{ isset($property) ? ($property->is_co_living == '1' ? 'active' : '') : '' }}">
                            <input value="co-living" type="checkbox" name="living_cond[]" {{ isset($property) ? ($property->is_co_living == '1' ? 'checked' : '') : '' }}>{{ session('locale')=='en' ? 'Select' : 'Pilih' }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-list-property">
                <div class="card-header">
                    <img class="mb-4" src="/img/list-property-entirespace.svg" alt="Co-living" />
                    <h5>{{ getLocale($locale_form1, 'label-entire-1', 'Entire Space') }}</h5>
                </div>
                <div class="card-body justify-content-between d-flex flex-column">
                    <div class="card-text">
                        <p>{{ getLocale($locale_form1, 'label-entire-2', 'Classic practice of leasing your property to one renter.') }}</p>
                        <p>{{ getLocale($locale_form1, 'label-entire-3', 'He is entitled to renting your entire property space for him or herself.') }}</p>
                    </div>
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-checkbox btn-rounded btn-outline-primary mr-10 mb-10 {{ isset($property) ? ($property->is_entire_space == '1' ? 'active' : '') : '' }}">
                            <input value="entire-space" type="checkbox" name="living_cond[]" {{ isset($property) ? ($property->is_entire_space == '1' ? 'checked' : '') : '' }}>{{ session('locale')=='en' ? 'Select' : 'Pilih' }}
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
    @if ($errors->has('living_cond'))
        <label class="form-error text-danger">{{ $errors->first('living_cond') }}</label>
    @endif
    <input type="hidden" name="id" value="{{ isset($property) ? $property->id : '' }}" />
    <input value="1" type="hidden" name="step" id="step">
</form>
@endsection
@section('next_step')
<div class="col-md-12 py-5 justify-content-end d-flex">
    <button id ="submit-list-property" class="btn btn-primary btn-next-list-property" style="padding-left: 32px;padding-right: 32px;padding-top: 15px;padding-bottom: 15px;letter-spacing: 1px">
        {{ getLocale($locale_form1, 'label-next', 'Next') }}
        <i class="fas fa-long-arrow-alt-right ml-2"></i>
    </button>
</div>
@endsection
