@extends('layouts.app')

@section('content')
    <div id="app">
        <company-category-component></company-category-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection