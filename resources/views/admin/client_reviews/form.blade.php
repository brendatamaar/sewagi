@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Client Reviews
        <small>{{ $page == 'create' ? 'Create' : 'Edit' }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<section class="content" id="clientReviewForm">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">{{ $page == 'create' ? 'Add New' : 'Edit' }} Client Reviews</div>
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
                            <form id="clientReviewData" role="form" method="POST" action="{{ route('client-review.store') }}">
                        @else
                            <form id="clientReviewData" role="form" method="POST" action="{{ route('client-review.update', ['data' => $data]) }}">
                            @method('PUT')
                        @endif
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="placeName">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $data->name ?? '' }}" placeholder="Enter name" required>
                                </div>
                                <div class="form-group">
                                    <label for="placeId">Message</label>
                                    <input type="text" name="message" class="form-control" id="message" value="{{ $data->message ?? '' }}" placeholder="Enter message" required>
                                </div>
                                <div class="form-group">
                                    <label for="province">Role</label>
                                    <input type="text" name="role" class="form-control" id="role" value="{{ $data->role ?? '' }}" placeholder="Enter role" required>
                                </div>
                                <div class="form-group">
                                    <label for="city">Picture</label>
                                    <input type="text" name="picture" class="form-control" id="picture" value="{{ $data->picture ?? '' }}" placeholder="Enter picture" required>
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
