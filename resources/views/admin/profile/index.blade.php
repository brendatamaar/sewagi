@extends('admin._partials.master')
@section('content')
<section class="content-header">
    <h1>
        Edit Profile
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Profile</li>
    </ol>
</section>
<section class="content">
            <!-- general form elements -->
            <div class="box box-success">
                <!-- box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">Edit My Profile</h3>
                </div>
                <!-- form start -->
                @include('admin.profile.form')
            </div>
            <!-- /.box -->
</section>
@endsection