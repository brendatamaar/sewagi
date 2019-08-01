@extends('_partials.master')

@section('body')
@component('_partials.navbar',['solid' => false, 'q' => @$q, 'locale' => @$locale])
@endcomponent
@yield('content')
@endsection

@push('js')
<script src="{{asset('plugins/accounting/accounting.min.js')}}"></script>
@endpush
