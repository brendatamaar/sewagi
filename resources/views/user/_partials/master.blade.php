<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sewagi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/css/dashboard.css">
    @stack('css') @yield('css')
</head>

<body>
<div id="dashboard">
    <input type="hidden" id="locale-session" name="locale-session" value="{{ session('locale')=='id' ? 'id' : 'en' }}">
    <div id="page-wrapper" class="d-flex">
        @include('user._partials.sidemenu')
        <div id="page-container">
            @yield('content')
        </div>
    </div>
    @include('_partials.footer')
</div>

<script type="text/javascript" src="{{ mix('js/sewagi.js') }}"></script>
<script src="{{asset('plugins/accounting/accounting.min.js')}}"></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script>
$('#modalLogin').modal('show');
</script>
@stack('js') @yield('js')
</body>

</html>
