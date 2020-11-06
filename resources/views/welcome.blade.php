@extends('template.app-home')

@section('tab-active')
    <script>
        $(document).ready(function ()
        {
            $('#home-link').tab('show');
        })
    </script>
@endsection

@section('main')
    <div class="container">
        <div class="main-title">
            <img class="img-fluid img-logo" src="{{asset('img/logo.svg')}}" alt="Escola" title="Escola">
        </div>
    </div>
@endsection