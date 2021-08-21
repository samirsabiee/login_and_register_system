@extends('layouts.app')

@section('css_links')
    <link rel="stylesheet" href="{{ asset('assets/css/login/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login/style.css') }}">
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
                        </div>
                        <form action="#" method="post">
                            <div class="form-group first">
                                <label for="email">{{ __('public.email') }}</label>
                                <input type="text" class="form-control" id="email" name="email">

                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">{{ __('public.password') }}</label>
                                <input type="password" class="form-control" id="password">

                            </div>

                            @include('partials.validation-errors')


                            <input type="submit" value="{{ __('public.login') }}" class="btn btn-pill text-white btn-block btn-primary">

                            <span class="d-block text-center my-4 text-muted">{{ __('public.sign_with') }}</span>

                            <div class="social-login text-center">
                                <a href="#" class="facebook">
                                    <span class="icon-facebook mr-3"></span>
                                </a>
                                <a href="#" class="twitter">
                                    <span class="icon-twitter mr-3"></span>
                                </a>
                                <a href="#" class="google">
                                    <span class="icon-google mr-3"></span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
