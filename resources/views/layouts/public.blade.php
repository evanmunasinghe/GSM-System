@extends('layouts.app')

@section('content')
    <x-theme-toggle />
    @yield('page-content')
    <x-app-footer />
@endsection
