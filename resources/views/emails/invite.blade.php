@component('mail::message')

{{ $name }},

You have been invited to be an admin for the Learn Fresh Coaches Association. Below is your login information – remember to change your password after you log in!

Email: {{ $email }}<br>
Password: {{ $password }}

@component('mail::button', ['url' => 'https://www.mylfca.com'])
Login
@endcomponent

@endcomponent