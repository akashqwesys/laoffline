@extends('layouts.app')

@section('content')
    <div id="app">
        <cities-component></cities-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection