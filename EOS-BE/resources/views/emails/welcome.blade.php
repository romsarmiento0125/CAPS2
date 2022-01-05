@component('mail::message')
# Introduction

The body of your message.
<h1>gg</h1>

@component('mail::button', ['url' => 'http://erichgrocery.store/'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
