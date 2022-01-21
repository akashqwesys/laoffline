@extends('layouts.app')

@section('content')
    <div id="app">
        <company-component></company-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection