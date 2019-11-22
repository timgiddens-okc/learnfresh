@extends('layouts.app')
	
@section('content')

	@if(\Auth::user()->isAdmin())
		@include("nav.events")
	@endif
	
	<div class="container">
		<div class="page-header">
			<div class="badge badge-pill type-{{$_GET['type']}}">
				<?php
					switch($_GET['type']){
						case "1":
							echo "Training Camp";
							break;
						case "2":
							echo "Tournament";
							break;
						case "3":
							echo "Player Event";
							break;
						case "4":
							echo "Conference";
							break;
						case "5":
							echo "Webinars";
							break;
						case "6":
							echo "Checkpoints";
							break;
						case "7":
							echo "Game Night";
							break;
					}	
				?>
			</div><br>
			<h2>Events</h2>
			@if(Auth::user()->isAdmin())
			<a href="/admin/events" class="btn btn-success btn-sm">Add New Event</a>
			@endif
		</div>
		<div class="row">
			<div class="col-sm-12">
				@if(\Auth::user()->isAdmin())
					<label>
					Filter By Event Type
					</label>
					<form action="/events/calendar/filter" method="get" style="margin-bottom: 30px;">
						<select name="type" class="form-control" style="max-width: 200px;display: inline-block; vertical-align: middle;">
							<option value="all">View All Events</option>
							<option value="1">Training Camp</option>
							<option value="2">Tournament</option>
							<option value="3">Player Event</option>
							<option value="4">Conference</option>
							<option value="5">Webinars</option>
							<option value="6">Checkpoints</option>
							<option value="7">Game Night</option>
						</select>
						<button type="submit" class="btn btn-primary">Filter</button>
					</form>
				@endif
				{!! $calendar->calendar() !!}
				{!! $calendar->script() !!}
			</div>
		</div>
	</div>
	
@endsection