@if(session('success'))
    <div class="alert alert-success">@lang('public.success')</div>
@elseif(session('failed'))
    <div class="alert alert-danger">@lang('public.failed')</div>
@elseif(session('registered'))
    <div class="alert alert-success">@lang('public.registered')</div>
@elseif(session('wrongCredentials'))
    <div class="alert alert-danger">@lang('public.wrongCredentials')</div>
@endif
