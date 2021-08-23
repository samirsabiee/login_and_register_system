@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('public.submit code panel')
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <p class="text-center">@lang('public.authentication code sent text')</p>
            <form action="#" class="form-group">
                <input class="form-control col-6 text-center text-monospace" type="text" id="code" name="code" placeholder="@lang('public.enter code')" aria-label="@lang('public.enter code')">
            </form>
            <a href="#" class="mt-2 mb-2">@lang('public.isCodeReceived')</a>
            <a href="#" class="btn btn-primary mt-2">@lang('public.submit code')</a>
        </div>
    </div>
@endsection
