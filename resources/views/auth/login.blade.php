@extends('layouts.app')

@section('css_links')
    <link rel="stylesheet" href="{{ asset('assets/css/login/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login/style.css') }}">
    <script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
@endsection

@section('content')
    <div class="row justify-content-center">
        @include('partials.alerts')
        <div class="col-md-6 contents">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="form-block">
                        <div class="mb-4">
                            <h3 class="text-center">{{ __('public.login') }}</h3>
                            <h6 class="text-center"><a href="{{ route('auth.magic.login.form') }}">@lang('public.login without pass')</a></h6>
                        </div>
                        <form action="{{ route('auth.login') }}" method="post">
                            @csrf
                            <div class="form-group first">
                                <label for="email">{{ __('public.email') }}</label>
                                <input type="text" class="form-control" id="email" name="email">

                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">{{ __('public.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password">

                            </div>

                            <div class="offset-sm-3">
                                @include('partials.recaptcha')
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="true" id="remember"
                                       name="remember">
                                <label class="form-check-label" for="remember">
                                    {{ __('public.remember') }}
                                </label>
                            </div>

                            <a href="{{ route('auth.password.forget.form') }}"
                               class="mt-3">@lang('public.forget')</a>
                            <br>

                            @include('partials.validation-errors')


                            <div class="mt-3">
                                <input type="submit" value="{{ __('public.login') }}"
                                       class="btn btn-pill text-white btn-block btn-primary">
                            </div>

                            <span class="d-block text-center my-4 text-muted">{{ __('public.sign_with') }}</span>

                            <div class="social-login d-flex flex-row justify-content-center align-items-center">
                                <a href="#" class="facebook m-2">
                                    <span class="icon-facebook mr-3"></span>
                                </a>
                                <a href="#" class="twitter m-2">
                                    <span class="icon-twitter mr-3"></span>
                                </a>
                                <a href="{{ route('auth.login.provider','google') }}"
                                   class="google m-2 d-flex flex-row justify-content-center align-items-center">
                                    <i class="bi bi-google"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
