<?php
	$total = \App\Event::count();
	$future = \App\Event::where("event_date",">",\Carbon\Carbon::now())->count();
	$lastYear = \App\Event::where([["event_date",">",\Carbon\Carbon::parse("2018/08/01")->toDateTimeString()],["event_date","<",\Carbon\Carbon::parse("2019/07/31")->toDateTimeString()]])->count();
	$thisYear = \App\Event::where("event_date",">",\Carbon\Carbon::parse("2019/08/01")->toDateTimeString())->count();
	
	$trainingsAllTime = \App\Event::where('type',1)->count();
	$trainingsThisYear = \App\Event::where([['type',1],["event_date",">",\Carbon\Carbon::parse("2019/08/01")]])->count();
	
	$tournamentsAllTime = \App\Event::where('type',2)->count();
	$tournamentsThisYear = \App\Event::where([['type',2],["event_date",">",\Carbon\Carbon::parse("2019/08/01")]])->count();
	
	$peAllTime = \App\Event::where('type',3)->count();
	$peThisYear = \App\Event::where([['type',3],["event_date",">",\Carbon\Carbon::parse("2019/08/01")]])->count();
	
	$now = \Carbon\Carbon::now();
	$start = \Carbon\Carbon::parse("2015/08/01");
	$days = $start->diffInDays($now);
	$allEvents = \App\Event::count();
	$average = $days / $allEvents;
?>

<div class="row">
	<div class="col-sm-3 text-center">
		<h2 style="margin: 0px;">{{ number_format($total) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">All Time</h6>
	</div>
	<div class="col-sm-3 text-center">
		<h2 style="margin: 0px;">{{ number_format($future) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Future</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($lastYear) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Last Year</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($thisYear) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">This Year</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($trainingsAllTime) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Trainings All Time</h6>
	</div>
</div>
<div class="row" style="margin-top: 25px;">
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($trainingsThisYear) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Trainings This Year</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($tournamentsAllTime) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Tournaments All Time</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($tournamentsThisYear) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Tournaments This Year</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($peAllTime) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Player Events All Time</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($peThisYear) }}</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Player Events This Year</h6>
	</div>
	<div class="col-sm-2 text-center">
		<h2 style="margin: 0px;">{{ number_format($average, 1) }} days</h2>
		<h6 style="margin-bottom: 0px;margin-top: 7px;">Average Time Between Events</h6>
	</div>
</div>