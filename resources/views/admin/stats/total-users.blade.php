<?php
	$userCount = \App\User::count();
?>

<h1>{{ number_format($userCount) }}</h1>