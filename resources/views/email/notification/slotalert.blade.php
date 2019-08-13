
@component('mail::message')
Dear User,

You Have been Successfully added to a new Live Session.
Date : {{$date}}
Time : {{$start_time}}
End Time : {{$end_time}}
Duration:{{$duration}}

@component('mail::button', ['url' => 'http://localhost:8000/login'])
    View <Details></Details>
@endcomponent

Thanks,

E Learning System
@endcomponent
