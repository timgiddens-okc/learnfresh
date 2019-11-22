<?php
	$userCount = \App\User::where('account_level','!=',"")->count();
?>

<h1>{{ number_format($userCount) }}</h1>