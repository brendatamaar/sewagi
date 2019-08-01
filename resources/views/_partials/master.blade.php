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
    <link rel="dns-prefetch" href="https://use.fontawesome.com">
    <link rel="dns-prefetch" href="https://developers.google.com">
    <link rel="dns-prefetch" href="https://maps.googleapis.com">
    <link rel="preload" href="{{ mix('/css/sewagi.css') }}" as="style">
    <link rel="preload" href="{{ mix('js/sewagi.js') }}" as="script">
    @if(isset($background) && is_string($background))
    <link rel="preload" href="{{ $background }}" as="image">
    @endif
    <link rel="stylesheet" href="{{ mix('/css/sewagi.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> @stack('css') @yield('css')
</head>

<body>
    @yield('body')
    @include('_partials.footer')
    @includeWhen(request()->is('search/*'), '_partials.morefilter')
    @includeWhen(url()->current() == route('homepage'), '_partials.searchbox')
    @include('_partials.modalbox')
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXocBdFpVkoj8XNn5OnqVrmsPgviAH9wU"></script>
    <script src="{{ mix('js/sewagi.js') }}"></script>
    @stack('js') @yield('js')
</body>

</html>
