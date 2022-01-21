@extends('layouts.app')

@section('content')
    <div id="app">
        <company-type-component></company-type-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection