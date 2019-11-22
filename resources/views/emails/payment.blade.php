@component('mail::message')
	
![logo]

[logo]: {{ ($app == "production") ? secure_asset('/images/trophies.jpg') :  asset('/images/trophies.jpg') }}
	
## Thanks for beginning the LFCA registration process!

We look forward to having you in the community this season. Please remember to complete your profile and annual registration fee at the link below.
	
@component('mail::button', ['url' => 'https://www.mylfca.com/register-site','color' => 'blue'])
Complete Registration
@endcomponent
	
@endcomponent