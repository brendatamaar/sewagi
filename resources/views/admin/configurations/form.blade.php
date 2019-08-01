@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Configuration
        <small>{{ $page == 'create' ? 'Create' : 'Edit' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<section class="content" id="configForm">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">{{ $page == 'create' ? 'Add New' : 'Edit' }} Configuration Category</div>
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
                            <form id="configData" role="form" method="POST" action="{{ route('configuration.store') }}">
                        @else
                            <form id="configData" role="form" method="POST" action="{{ route('configuration.update', ['data' => $data]) }}">
                            @method('PUT')
                        @endif
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="select-category form-control" name="category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (isset($data) && $data->category_id ==  $category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $data->name ?? '' }}" placeholder="Enter configuration name" required>
                                </div>
                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="text" name="value" class="form-control" id="value" value="{{ $data->value ?? '' }}" placeholder="Enter configuration value" required>
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
