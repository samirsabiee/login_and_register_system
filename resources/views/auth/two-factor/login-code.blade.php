@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('public.submit code panel')
        </div>
        <div class="card-body">
            <p class="text-center">@lang('public.authentication code sent text')</p>
            <form method="POST" action="{{ route('auth.login.code') }}"
                  class="form-group d-flex flex-column justify-content-center align-items-center">
                @csrf
                <input class="form-control w-50 text-center text-monospace" type="text" id="code" name="code"
                       placeholder="@lang('public.enter code')" aria-label="@lang('public.enter code')">

                @include('partials.validation-errors')
                <a href="{{ route('auth.two.factor.resent') }}" class="mt-2 mb-2">@lang('public.isCodeReceived')</a>
                <input type="submit" class="btn btn-primary mt-2" value="@lang('public.submit code')"/>
            </form>
        </div>
    </div>
@endsection
