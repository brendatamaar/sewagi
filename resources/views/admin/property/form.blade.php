@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Property
        <small>{{ $page == 'create' ? 'Create' : 'Edit' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<section class="content" id="propertyForm">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">{{ $page == 'create' ? 'Add New' : $page == 'edit' ? 'Edit' : 'View' }} Property</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($page == 'create')
                            <form id="propertyData" role="form" method="POST" action="{{ route('property.store') }}">
                        @elseif($page == 'edit')
                            <form id="propertyData" role="form" method="POST" action="{{ route('property.update', ['data' => $data]) }}">
                            @method('PUT')
                        @else 
                            <form id="propertyData" role="form">
                        @endif
                            @csrf
                            <div class="box-body">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_overview" data-toggle="tab">Overview</a></li>
                                        <li><a href="#tab_price" data-toggle="tab">Price</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_overview">
                                             <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control" id="title" value="{{ $data->title ?? '' }}" placeholder="Enter title" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter description" required {{ $page == 'view' ? 'disabled' : '' }}>{{ $data->description ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Type</label>
                                                <select name="type" id="type" class="form-control" {{ $page == 'view' ? 'disabled' : '' }}>
                                                    <option value="apartment" {{ $data->type == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                                    <option value="house" {{ $data->type == 'house' ? 'selected' : '' }}>House</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="unit-size">Unit Size</label>
                                                <div class="input-group col-xs-2">
                                                    <input type="text" name="unit_size" class="form-control" id="unit-size" value="{{ $data->unit_size ?? '' }}" placeholder="Enter unit size" {{ $page == 'view' ? 'disabled' : '' }} />
                                                    <span class="input-group-addon">m<sup>2</sup></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="building-size">Building Size</label>
                                                <div class="input-group col-xs-2">
                                                    <input type="text" name="building_size" class="form-control" id="building-size" value="{{ $data->building_size ?? '' }}" placeholder="Enter building size" {{ $page == 'view' ? 'disabled' : '' }} />
                                                    <span class="input-group-addon">m<sup>2</sup></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Living Condition</label>
                                                <div class="input-group">
                                                    <input type="checkbox" value="1" name="is_co_living" {{ $data->is_co_living == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} /> Co-living
                                                    <input type="checkbox" value="1" style="margin-left: 30px;" name="is_entire_space" {{ $data->is_entire_space == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} /> Entire space
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Bedrooms</label>
                                                <input name="bedrooms" type="number" class="form-control" value="{{ $data->bedrooms ?? '' }}" {{ $page == 'view' ? 'disabled' : '' }} />
                                            </div>
                                            <div class="form-group">
                                                <label>Bathrooms</label>
                                                <input name="bathrooms" type="number" class="form-control" value="{{ $data->bathrooms ?? '' }}" {{ $page == 'view' ? 'disabled' : '' }} />
                                            </div>
                                            <div class="form-group">
                                                <label for="land_area_type">Land Area Type</label>
                                                <select name="land_area_type" id="land_area_type" class="form-control" {{ $page == 'view' ? 'disabled' : '' }}>
                                                    <option value="residential" {{ $data->land_area_type == 'residential' ? 'selected' : '' }}>Residential</option>
                                                    <option value="non-residential" {{ $data->land_area_type == 'non-residential' ? 'selected' : '' }}>Non-residential</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="arrangement">Arrangement</label>
                                                <select name="arrangement" id="arrangement" class="form-control" {{ $page == 'view' ? 'disabled' : '' }}>
                                                    <option value="townhouse" {{ $data->arrangement == 'townhouse' ? 'selected' : '' }}>Townhouse</option>
                                                    <option value="standalone" {{ $data->arrangement == 'standalone' ? 'selected' : '' }}>Standalone</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="floor_range">Floor Range</label>
                                                <select name="floor_range" id="floor_range" class="form-control" {{ $page == 'view' ? 'disabled' : '' }}>
                                                    <option value="below 5" {{ $data->floor_range == 'below 5' ? 'selected' : '' }}>Below 5</option>
                                                    <option value="between 5-10" {{ $data->floor_range == 'between 5-10' ? 'selected' : '' }}>Between 5 - 10</option>
                                                    <option value="above 10" {{ $data->floor_range == 'above 10' ? 'selected' : '' }}>Above 10</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pet Friendly</label>
                                                <div class="input-group">
                                                    <input value="1" type="checkbox" name="is_pet_friendly" {{ $data->is_pet_friendly == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter address" required {{ $page == 'view' ? 'disabled' : '' }}>{{ $data->address ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="property_number">Property Number</label>
                                                <input type="text" name="property_number" class="form-control" id="property_number" value="{{ $data->property_number ?? '' }}" placeholder="Enter property number" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="property_detail">Property Detail</label>
                                                <input type="text" name="property_detail" class="form-control" id="title" value="{{ $data->property_detail ?? '' }}" placeholder="Enter property detail" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="province">Province</label>
                                                <input type="text" name="province" class="form-control" id="province" value="{{ $data->province ?? '' }}" placeholder="Enter province" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" name="city" class="form-control" id="city" value="{{ $data->city ?? '' }}" placeholder="Enter city" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="district">District</label>
                                                <input type="text" name="district" class="form-control" id="district" value="{{ $data->district ?? '' }}" placeholder="Enter district" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="village">Village</label>
                                                <input type="text" name="village" class="form-control" id="village" value="{{ $data->village ?? '' }}" placeholder="Enter village" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="postcode">Postcode</label>
                                                <input type="text" name="postcode" class="form-control" id="postcode" value="{{ $data->postcode ?? '' }}" placeholder="Enter postcode" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude">Latitude</label>
                                                <input type="text" name="latitude" class="form-control" id="latitude" value="{{ $data->latitude ?? '' }}" placeholder="Enter latitude" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="longitude">Longitude</label>
                                                <input type="text" name="longitude" class="form-control" id="longitude" value="{{ $data->longitude ?? '' }}" placeholder="Enter longitude" required {{ $page == 'view' ? 'disabled' : '' }}>
                                            </div>
                                            <div class="form-group">
                                                <label for="furniture">Furniture</label>
                                                <select name="furniture" id="furniture" class="form-control" {{ $page == 'view' ? 'disabled' : '' }}>
                                                    <option value="furnished" {{ $data->furniture == 'furnished' ? 'selected' : '' }}>Furnished</option>
                                                    <option value="semi-furnished" {{ $data->furniture == 'semi-furnished' ? 'selected' : '' }}>Semi-furnished</option>
                                                    <option value="unfurnished" {{ $data->furniture == 'unfurnished' ? 'selected' : '' }}>Unfurnished</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control" {{ $page == 'view' ? 'disabled' : '' }}>
                                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Booked</option>
                                                    <option value="3" {{ $data->status == 3 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Insured</label>
                                                <div class="input-group">
                                                    <input value="1" type="checkbox" name="in_insured" {{ $data->in_insured == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Draft</label>
                                                <div class="input-group">
                                                    <input value="1" type="checkbox" name="is_draft" {{ $data->is_draft == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_price">
                                            @foreach($data->PropertyPrice as $key => $value)
                                                <div class="form-group">
                                                    <label for="living_condition">Living Condition</label>
                                                    <select name="living_condition" id="living_condition" class="form-control" {{ $page == 'view' ? 'disabled' : '' }}>
                                                        <option value="co-living" {{ $value->living_condition == 'co-living' ? 'selected' : '' }}>co-living</option>
                                                        <option value="entire-space" {{ $value->living_condition == 'entire-space' ? 'selected' : '' }}>entire-space</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">RP</span>
                                                        <input type="text" name="price" class="form-control" id="price" value="{{ number_format($value->service_fee) ?? '' }}"  required {{ $page == 'view' ? 'disabled' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                <label>Include</label>
                                                <div>
                                                    <input  value="1" type="checkbox" name="is_include_internet" {{ $value->is_include_internet == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} />
                                                    <span style="width:100px;display:inline-block;">Internet</span>
                                                    <input  value="1" type="checkbox" name="is_include_park" {{ $value->is_include_park == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} />
                                                    <span style="width:100px;display:inline-block;">Park</span>
                                                </div>           
                                                <div>
                                                    <input  value="1" type='checkbox' name="is_include_tv_cable" {{ $value->is_include_tv_cable == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} />
                                                    <span style="width:100px;display:inline-block;">Tv Cable</span>
                                                    <input  value="1" type="checkbox" name="is_include_cleaning" {{ $value->is_include_internet == 1 ? 'checked' : '' }} {{ $page == 'view' ? 'disabled' : '' }} />
                                                    <span style="width:100px;display:inline-block;">Cleaning</span>
                                                </div>
                                            </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                @if($page == 'create' || $page == 'edit')
                                <button type="submit" class="btn btn-primary">{{ $page == 'create' ? 'Save' : 'Update' }}</button>
                                @else
                                <a href="{{ route('property.index') }}" class="btn btn-primary">Back</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection
