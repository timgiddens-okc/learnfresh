<?php
	$total = 0.00;
	$bronze = \App\User::where('account_level',1)->where('discount_code',null)->count();
	$silver = \App\User::where('account_level',2)->where('discount_code',null)->count();
	$total += $bronze * 250;
	$total += $silver * 1000;
?>

<h1>${{ number_format($total,2) }}</h1>