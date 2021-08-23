@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('public.two factor authentication')
        </div>
        @if(auth()->user()->phone_number)
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <p class="text-center">@lang('public.two factor authentication content',['number' => auth()->user()->phone_number])</p>
                <a href="{{ route('auth.two.factor.activate') }}" class="btn btn-primary">@lang('public.activate')</a>
            </div>
        @else
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <p class="text-center text-danger">@lang('public.for two factor add phone number')</p>
            </div>
        @endif
    </div>
@endsection
