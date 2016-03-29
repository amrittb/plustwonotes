@extends('_layouts.main')

@section('pagecontent')
    <div class="page-content">
        @yield('content')
    </div>
@stop

@section('footer')
    @include('_partials.footer')
@stop