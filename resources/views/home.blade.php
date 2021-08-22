@extends('layouts.app')
@section('title','welcome page')

@section('content')
    @include('partials.alerts')
    @guest
        <h1 class="text-center mt-5">Login And Register System</h1>
    @endguest
    @auth
        <h1 class="text-center mt-5">Welcome {{ auth()->user()->name }}</h1>
    @endauth
    <p class="text-center mt3">Laravel Tutorial Course</p>
@endsection
