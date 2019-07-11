
@component('mail::message')

    An Account for your email has been created. Login with following credentials to continue.
    Since these information are sent in plain text, on your first login please change the password.
    email : {{$email}}
    password : {{$password}}

    @component('mail::button', ['url'=>route('login')])
        Login to E Learning System
    @endcomponent


    Thanks,

    {{ config('app.name') }}
@endcomponent
