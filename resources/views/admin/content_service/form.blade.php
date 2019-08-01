@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Content Service
        <small>{{ $page == 'create' ? 'Create' : 'Edit' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<section class="content" id="contentServiceForm">
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
                            <form id="contentServiceData" role="form" method="POST" action="{{ route('content-service.store') }}">
                        @else
                            <form id="contentServiceData" role="form" method="POST" action="{{ route('content-service.update', ['data' => $data]) }}">
                            @method('PUT')
                        @endif
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="idName">ID Name</label>
                                    <input type="text" name="id_name" class="form-control" id="idName" value="{{ $data->id_name ?? '' }}" placeholder="Enter ID name" required>
                                </div>
                                <div class="form-group">
                                    <label for="enName">EN Name</label>
                                    <input type="text" name="en_name" class="form-control" id="enName" value="{{ $data->en_name ?? '' }}" placeholder="Enter EN name" required>
                                </div>
                                <div class="form-group">
                                    <label for="idDescription">ID Description</label>
                                    <textarea name="id_description" class="form-control" rows="3" id="idDescription" placeholder="Enter ID Description...">{{ $data->id_description ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="enDescription">EN Description</label>
                                    <textarea name="en_description" class="form-control" rows="3" id="enDescription" placeholder="Enter EN Description...">{{ $data->en_description ?? '' }}</textarea>
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
