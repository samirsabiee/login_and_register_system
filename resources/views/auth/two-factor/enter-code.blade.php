@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            @lang('public.enter code')
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <p class="text-center">@lang('public.authentication code sent text')</p>
            <a href="#" class="btn btn-primary">@lang('public.submit code')</a>
        </div>
    </div>
@endsection
