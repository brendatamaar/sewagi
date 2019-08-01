@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Content Services
        <small>Data List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Content Services</li>
    </ol>
</section>

<section class="content" id="contentServiceTable">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('content-service.create') }}" class="btn btn-md btn-primary">
                        <i class="fa fa-plus"></i> Add Content Service</a>
                </div>
                <div class="box-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                            {{ session('message') }}
                        </div>
                    @endif
                    <table id="serviceTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th width="120px">ID Name</th>
                                <th width="120px">EN Name</th>
                                <th>ID Description</th>
                                <th>EN Description</th>
                                <th class="text-right" width="80px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection
