@component('mail::message')
    # Introduction

    Dear {{ $name }}

    @component('mail::button', ['url' => $link])
        Verify Your Email
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
