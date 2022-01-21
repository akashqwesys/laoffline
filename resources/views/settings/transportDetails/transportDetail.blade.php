@extends('layouts.app')

@section('content')
    <div id="app">
        <transport-details-component></transport-details-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection