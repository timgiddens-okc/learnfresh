<?php
	$total = 0;
	$thisYear = 0;
	$total += \App\User::where('account_level',1)->count() * 32;
	$thisYear += \App\User::where([['account_level',2],['created_at','>',\Carbon\Carbon::parse('2019/08/01')->toDateTimeString()]])->count() * 32;
	$goldUsers = \App\User::where('account_level',2)->get();
	$thisGoldUsers = \App\User::where([['account_level',2],['created_at','>',\Carbon\Carbon::parse('2019/08/01')->toDateTimeString()]])->get();
	foreach($goldUsers as $user){
		if($user->estimated_students){
			if(count($user->students) > $user->estimated_students){
				$total += count($user->students);
			} else {
				$total += (int)$user->estimated_students;
			}
		} else {
			if(count($user->students) > 32){
				$total += count($user->students);
			} else {
				$total += 32;
			}
		}
	}
	
	foreach($thisGoldUsers as $user){
		if($user->estimated_students){
			if(count($user->students) > $user->estimated_students){
				$thisYear += count($user->students);
			} else {
				$thisYear += (int)$user->estimated_students;
			}
		} else {
			if(count($user->students) > 32){
				$thisYear += count($user->students);
			} else {
				$thisYear += 32;
			}
		}
	}
	
?>

<div class="row">
	<div class="col-sm-6 text-center">
		<h2 style="margin: 0px;">{{ number_format($total) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">All Time</h6>
	</div>
	<div class="col-sm-6 text-center">
		<h2 style="margin: 0px;">{{ number_format($thisYear) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Since 8/1/19</h6>
	</div>
</div>