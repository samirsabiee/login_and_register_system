@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.alerts')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('public.Magic link')</div>

                    <div class="card-body">
                        <form method="POST" action="#">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">@lang('public.E-Mail Address')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           readonly
                                           value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            @include('partials.validation-errors')

                            <div class="form-group row mt-3 mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('public.Send Link')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
