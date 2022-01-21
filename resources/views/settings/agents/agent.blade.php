@extends('layouts.app')

@section('content')
    <div id="app">
        <agent-component></agent-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection