<!doctype html>
<html dir="rtl" lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @yield('css_links')
    <title>@yield('title')</title>
</head>
<body>
@include('partials.navbar')
@if(session('MustVerifyEmail'))
    <h6 class="alert alert-danger text-center">
        @lang('public.must email verified',['link'=> route('auth.email.send.verification')])
    </h6>
@endif
@if(session('verificationEmailSent'))
    <div class="alert alert-success text-center">@lang('public.verificationEmailSent')</div>
@endif
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
@yield('js_links')
</body>
</html>
