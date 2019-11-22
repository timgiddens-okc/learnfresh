@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Itinerary</h2>
			<a href="/schedule/{{ $schedule->id }}" class="btn btn-primary small">Back</a>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				@if($errors->any())
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
					@endforeach
				</div>
				@endif
				<form action="" method="post">
					{{ csrf_field() }}
					<?php
						$day = \App\ScheduleDay::where("id", $item->schedule_day_id)->first();	
					?>
					<h4>{{ $day->title }} - {{ \Carbon\Carbon::parse($day->date)->format('F jS, Y') }}</h4>
					<div id="days">
						<div class="day-block">
							<div class="form-group col-sm-2">
								<input type="text" name="start_time" placeholder="Start Time" class="form-control" value="{{ $item->start_time }}" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="end_time" placeholder="End Time" class="form-control" value="{{ $item->end_time }}" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="event_name" placeholder="Event Name" class="form-control" value="{{ $item->event_name }}" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="event_location" placeholder="Event Location" class="form-control" value="{{ $item->event_location }}" />
							</div>
							<div class="form-group col-sm-2">
								<input type="text" name="event_address" placeholder="Event Address" class="form-control" value="{{ $item->event_address }}" />
							</div>
							<div class="form-group col-sm-2">
								<textarea name="event_details" placeholder="Event Details" class="form-control not-rich" style="height: 36px;">{{ $item->event_details }}</textarea>
							</div>
						</div>
					</div>
					
					<div class="form-group col-sm-12">
						<button type="submit" class="btn btn-primary">Update Item</button>
					</div>
				</form>
			</div>
		</div>		
	</div>
	
@endsection