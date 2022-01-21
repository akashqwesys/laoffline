@extends('layouts.app')

@section('content')
    <div id="app">
        <product-component></product-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection