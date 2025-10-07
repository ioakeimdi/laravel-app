@extends('layouts.main')

@section('title', 'Home')

@section('content')
    @if (Auth::check())
        @include('layouts.dashboard')
    @else
        @include('pages.login')
    @endif
@endsection
