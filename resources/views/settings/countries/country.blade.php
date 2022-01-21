@extends('layouts.app')

@section('content')
    <div id="app">
        <countries-component></countries-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection