@component('mail::message')
    # Magic link

    The body of your message.

    @component('mail::button', ['url' => $link])
        Login
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
