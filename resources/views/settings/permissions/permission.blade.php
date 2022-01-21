@extends('layouts.app')

@section('content')
    <div id="app">
        <permission-component></permission-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection