<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <title>
        @yield('title',config('app.name')) @yield('title_postfix')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="{{ mix('/css/sewagi.css') }}"> -->
    <link rel="stylesheet" href="{{ mix('/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> @stack('css') @yield('css')

</head>
<body id="list-property">
    <input type="hidden" id="add-property-locale" name="add-property-locale" value="{{ session('locale') }}">
    @include('_partials.navbar_list_property')
    <div class="list-property-wrapper">
        <div class="container">
            <div class="row">
                @include('_partials.sidebar_list_property')
                <div class="col-md-10">
                    <div class="list-property-content">
                        @yield('content')
                    </div>
                    <div class="row">
                        <div class="col-md-12 border-top py-5 justify-content-between d-flex">
                            @yield('next_step')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-dashboard" id="modalConfirmation" tabindex="-1" role="dialog">
            <div class="modal-dialog from-right" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                        <p class="font-weight-bolder">{{ getLocale($locale_master_solid, 'label-1', 'Are you sure you want to leave this page?') }}</p>
                        <p class="font-weight-bolder">{{ getLocale($locale_master_solid, 'label-2', 'You might lose all inputted information.') }}</p>
                        <div class="button-group">
                            <a class="btn btn-primary mr-2" href="{{url('')}}">{{ getLocale($locale_master_solid, 'label-3', 'Yes') }}</a>
                            <a class="btn btn-primary saveDraft backHome" href="#">{{ getLocale($locale_master_solid, 'label-4', 'Save As Draft') }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ mix('js/sewagi.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXocBdFpVkoj8XNn5OnqVrmsPgviAH9wU"></script>
    @stack('js') @yield('js')
</body>

</html>
