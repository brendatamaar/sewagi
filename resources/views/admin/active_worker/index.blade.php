@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Active Workers
        <small>Data List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Active Workers</li>
    </ol>
</section>

<section class="content" id="activeWorkerTable">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('active-worker.create') }}" class="btn btn-md btn-primary">
                        <i class="fa fa-plus"></i> Add Active Worker</a>
                </div>
                <div class="box-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                            {{ session('message') }}
                        </div>
                    @endif
                    <table id="workerTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Place Name</th>
                                <th>Province</th>
                                <th>City</th>
                                <th>District</th>
                                <th>Postcode</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
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
