
@component('mail::message')

    You Have been Successfully added to the new virtual class.
    Date : {{$date}}
    Time : {{$start_time}}
    End Time : {{$end_time}}
    Duration:{{$duration}}

    @component('mail::button', ['url'=>route('login')])
        Login to E Learning System
    @endcomponent


    Thanks,

    {{ config('app.name') }}
@endcomponent
