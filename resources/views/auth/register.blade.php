@extends('layouts.app')

@section('title','register')

@section('content')
    <div class="row justify-content-center">
        @include('partials.alerts')
        <div class="col-md-6 contents">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="form-block">
                        <div class="mb-4">
                            <h3 class="text-center">{{ __('public.register') }}</h3>
                        </div>
                        <form action="{{ route('auth.register') }}" method="post">
                            @csrf
                            <div class="form-group first">
                                <label for="email">{{ __('public.email') }}</label>
                                <input type="text" value="{{ old('email') }}" class="form-control" id="email"
                                       name="email">

                            </div>
                            <div class="form-group first">
                                <label for="name">{{ __('public.name') }}</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name">

                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">{{ __('public.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password">

                            </div>
                            <div class="form-group last mb-4">
                                <label for="password_confirmation">{{ __('public.confirm_password') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation">

                            </div>
                            <div class="form-group last mb-4">
                                <label for="phone_number">{{ __('public.phone_number') }}</label>
                                <input type="tel" class="form-control" id="phone_number"
                                       value="{{ old('phone_number') }}" name="phone_number">

                            </div>

                            @include('partials.validation-errors')

                            <input type="submit" value="{{ __('public.register') }}"
                                   class="btn btn-pill text-white btn-block btn-primary">

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
