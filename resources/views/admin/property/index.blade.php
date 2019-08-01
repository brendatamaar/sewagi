@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Properties
        <small>Data List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Properties</li>
    </ol>
</section>

<section class="content" id="contentProperty">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                </div>
                <div class="box-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                            {{ session('message') }}
                        </div>
                    @endif
                    <p class="lead">Filter</p>
                    <hr />
                    <form method="get" id="filterPropertyForm">
                        <div class="row">
                            <div class="col-xs-3">
                                <label class="control-label">Title </label>
                                <input type="text" name="title" />
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label">Type </label>
                                <select name="type">
                                    <option value="">All</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="house">House</option>
                                </select>
                            </div>
                            <div class="col-xs-3 form-group">
                                <label class="control-label">Living condition </label>
                                <div class="input-group">
                                    <input type="checkbox" name="is_co_living" /> Co-living
                                    <input style="margin-left: 10px;" type="checkbox" name="is_entire_space" /> Entire Space
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label">Land area type </label>
                                <select name="land_area_type">
                                    <option value="">All</option>
                                    <option value="residential">Residential</option>
                                    <option value="non residential">Non-residential</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <label class="control-label">Arrangement </label>
                                <select name="arrangement">
                                    <option value="">All</option>
                                    <option value="townhouse">Townhouse</option>
                                    <option value="standalone">Standalone</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label">Floor range </label>
                                <select name="floor_range">
                                    <option value="">All</option>
                                    <option value="below 5">Below 5</option>
                                    <option value="between 5-10">Between 5-10</option>
                                    <option value="above 10">Above 10</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label">Pet friendly </label>
                                <input type="checkbox" name="is_pet_friendly" /> 
                            </div>
                            <div class="col-xs-3">
                                <label class="control-label">Status </label>
                                <select name="status">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Booked</option>
                                    <option value="3">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" style="margin-top: 15px;">
                                <button class="btn btn-primary" type="submit">Apply Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr />
                    <table id="propertyTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Draft</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection
