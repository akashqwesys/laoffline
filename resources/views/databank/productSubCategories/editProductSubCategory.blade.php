@extends('layouts.app')

@section('content')
    <div id="app">
        <create-product-sub-category-component scope="{{ $employees['scope'] }}" :id="{{ $employees['editedId'] ?? 0 }}"></create-product-sub-category-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>    
@endsection