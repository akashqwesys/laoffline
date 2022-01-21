@extends('layouts.app')

@section('content')
    <div id="app">
        <link-companies-component></link-companies-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection