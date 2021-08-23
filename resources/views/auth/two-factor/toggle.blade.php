@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('public.two factor authentication')
        </div>
        @include('partials.validation-errors')
        @if(!auth()->user()->hasPhoneNumber())
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <p class="text-center text-danger">@lang('public.for two factor add phone number')</p>
            </div>
        @elseif(auth()->user()->hasPhoneNumber() && !auth()->user()->isTwoFactorActivate())
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <p class="text-center">@lang('public.two factor authentication content',['number' => auth()->user()->phone_number])</p>
                <a href="{{ route('auth.two.factor.activate') }}" class="btn btn-primary">@lang('public.activate')</a>
            </div>
        @elseif(auth()->user()->isTwoFactorActivate())
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <p class="text-center">@lang('public.authentication code activate text',['number' => auth()->user()->phone_number])</p>
                <a href="{{ route('auth.two.factor.deactivate') }}" class="btn btn-danger">@lang('public.deactivate')</a>
            </div>
        @endif
    </div>
@endsection
