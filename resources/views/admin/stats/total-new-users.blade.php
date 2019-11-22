<?php
	$bronzeCount = \App\User::where('account_level',1)->where('created_at','>=',\Carbon\Carbon::parse('2019/08/01')->toDateTimeString())->count();
	$silverCount = \App\User::where('account_level',2)->where('created_at','>=',\Carbon\Carbon::parse('2019/08/01')->toDateTimeString())->count();
	$goldCount = \App\User::where('created_at','>=',\Carbon\Carbon::parse('2019/08/01')->toDateTimeString())->count();
?>

<div class="row">
	<div class="col-sm-4 text-center">
		<h2 style="margin: 0px;">{{ number_format($bronzeCount) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">MH</h6>
	</div>
	<div class="col-sm-4 text-center">
		<h2 style="margin: 0px;">{{ number_format($silverCount) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">MH+</h6>
	</div>
	<div class="col-sm-4 text-center">
		<h2 style="margin: 0px;">{{ number_format($goldCount) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Total</h6>
	</div>
</div>