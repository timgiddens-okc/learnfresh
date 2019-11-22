@component('mail::message')
	
Thank You!
==========

Here is your receipt for your Home Court Series Tournament Kit. Your order will be fulfilled by the end of March 2019.

@component('mail::table')
|Item    						 |Quantity    |Price   							  |
|:-------------------------------|:-----------|:----------------------------------|
|Home Court Series Tournament Kit|1           |$249.99							  |
@foreach($order as $key=>$value)
|{{$key}}						 |{{$value}}  |${{ number_format($value*14.99,2) }}|
@endforeach
|LFCA Discount					 |			  |-$50.00							  |
|Total							 |			  |${{ $grandTotal }}				  |


@endcomponent
	
@endcomponent