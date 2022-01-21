@extends('layouts.app')

@section('content')
    <div id="app">
        <sms-settings-component></sms-settings-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection