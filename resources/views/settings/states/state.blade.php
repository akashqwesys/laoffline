@extends('layouts.app')

@section('content')
    <div id="app">
        <states-component></states-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection