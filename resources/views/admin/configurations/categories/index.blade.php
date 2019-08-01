@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Configuration Categories
        <small>advanced tables</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<section class="content" id="contentConfigCategoryTable">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('configuration-category.create') }}" class="btn btn-md btn-primary">
                        <i class="fa fa-plus"></i> Add Configuration Category</a>
                </div>
                <div class="box-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                            {{ session('message') }}
                        </div>
                    @endif
                    <table id="configCategoryTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection
