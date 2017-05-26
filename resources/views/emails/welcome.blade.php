@component('mail::message')
# Hello U

The body of your message.

- one 
- two
- three

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
