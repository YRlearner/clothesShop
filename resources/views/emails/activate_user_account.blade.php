@component('mail::message')
    # activate your account

@component('mail::panel')
      ## for activate your account click
@endcomponent 

@component('mail::button', ['url' => $url])
    Activate
@endcomponent
     #thank you
     <br>
     support {{ config('app.name') }}

@endcomponent
