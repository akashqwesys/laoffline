@extends('layouts.app')

@section('content')
    <div id="app">
        <create-states-component></create-states-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>    
@endsection