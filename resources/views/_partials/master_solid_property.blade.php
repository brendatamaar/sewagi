@extends('_partials.master')

@section('body')
@component('_partials.navbar', ['solid' => true, 'q' => @$q, 'hideNavbarSearch' => true])
@endcomponent
<div class="main-content">
@yield('content')
</div>
@endsection
