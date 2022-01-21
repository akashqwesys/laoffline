@extends('layouts.app')

@section('content')
    <div id="app">
        <default-settings-component></default-settings-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection