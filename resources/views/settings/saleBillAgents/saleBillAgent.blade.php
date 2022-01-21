@extends('layouts.app')

@section('content')
    <div id="app">
        <sale-bill-agent-component></sale-bill-agent-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection