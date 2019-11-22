<?php
	$userCount = \App\User::where('account_level',2)->count();
	$submitted = \App\User::where('account_level',2)->where('pre_assessment_complete',1)->count();
?>

<h1>
	@if($userCount != 0 && $submitted != 0)
		{{ round(($submitted / $userCount)*100,2) }}%
	@else 
		0
	@endif
</h1>