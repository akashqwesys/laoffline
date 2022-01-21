@extends('layouts.app')

@section('content')
    <div id="app">
        <bank-details-component></bank-details-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection