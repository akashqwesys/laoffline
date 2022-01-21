@extends('layouts.app')

@section('content')
    <div id="app">
        <type-of-address-component></type-of-address-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection