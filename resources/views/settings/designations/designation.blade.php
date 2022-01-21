@extends('layouts.app')

@section('content')
    <div id="app">
        <designation-component></designation-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection