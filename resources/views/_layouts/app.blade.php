@extends('_layouts.main')

@section('pagecontent')
    <div class="page-content section--center mdl-typography--text-left mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            @yield('content')
        </div>
    </div>
@stop

@section('footer')
    @include('_partials.footer')
@stop