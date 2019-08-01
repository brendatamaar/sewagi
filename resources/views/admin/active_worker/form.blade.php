@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Active Workers
        <small>{{ $page == 'create' ? 'Create' : 'Edit' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<section class="content" id="activeWorkerForm">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">{{ $page == 'create' ? 'Add New' : 'Edit' }} Active Worker</div>
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
                            <form id="activeWorkerData" role="form" method="POST" action="{{ route('active-worker.store') }}">
                        @else
                            <form id="activeWorkerData" role="form" method="POST" action="{{ route('active-worker.update', ['data' => $data]) }}">
                            @method('PUT')
                        @endif
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="placeName">Place Name</label>
                                    <input type="text" name="place_name" class="form-control" id="placeName" value="{{ $data->place_name ?? '' }}" placeholder="Enter place name" required>
                                </div>
                                <div class="form-group">
                                    <label for="placeId">Place ID</label>
                                    <input type="text" name="place_id" class="form-control" id="placeId" value="{{ $data->place_id ?? '' }}" placeholder="Enter place ID" required>
                                </div>
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" name="province" class="form-control" id="province" value="{{ $data->province ?? '' }}" placeholder="Enter province">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" id="city" value="{{ $data->city ?? '' }}" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label for="district">District</label>
                                    <input type="text" name="district" class="form-control" id="district" value="{{ $data->district ?? '' }}" placeholder="Enter district">
                                </div>
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" name="postcode" class="form-control" id="postcode" value="{{ $data->postcode ?? '' }}" placeholder="Enter postcode">
                                </div>
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ $data->latitude ?? '' }}" placeholder="Enter latitude" required>
                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ $data->longitude ?? '' }}" placeholder="Enter longitude" required>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{ $page == 'create' ? 'Save' : 'Update' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection
