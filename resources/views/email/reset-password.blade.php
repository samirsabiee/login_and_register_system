@component('mail::message')
    # Introduction

    Reset Password Link

    @component('mail::button', ['url' => $link])
        Reset Your Password
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
