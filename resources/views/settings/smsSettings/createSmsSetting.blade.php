@extends('layouts.app')

@section('content')
    <div id="app">
        <create-sms-settings-component></create-sms-settings-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>    
@endsection