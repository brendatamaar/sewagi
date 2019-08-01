<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        @yield('title',config('app.name')) @yield('title_postfix')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/iziToast/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/custom.css">
    <link rel="stylesheet" href="/adminlte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/custom.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @stack('css') @yield('css')
</head>

<body class="skin-green-light sidebar-mini">
    <div class="wrapper">
        @include('admin._partials.header')
        @include('admin._partials.sidemenu')
        @include('admin._partials.content')
        @include('admin._partials.footer')
        @include('admin._partials.alert')
    </div>
    <script type="text/javascript" src="{{ mix('js/sewagi-admin.js') }}"></script>
    @stack('js') @yield('js')
</body>

</html>
