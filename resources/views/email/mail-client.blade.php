@component('mail::message')
    Email provenant d'un client
    Email : {{ $contact['email'] }} <br>
    Message : <br>
        {{ $contact['message'] }}

{{ config('app.name') }}
@endcomponent
