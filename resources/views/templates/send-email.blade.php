@extends("layouts.app")

@section("content")

	<div class="container">
		
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="page-header">
					<h1>Send Email</h1>
				</div>
				<form action="/contact/send-email/confirm" method="post">
					<div class="form-group">
						<label>Template</label>
						<select name="template" class="form-control">
							@foreach($templates as $template)
							<option value="{{ $template->id }}">{{ $template->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Event Type</label>
						<select name="event-type" class="form-control event-type-selection">
							<option value="1">Training Camp</option> 
							<option value="2">Tournament</option> 
							<option value="3">Player Event</option> 
							<option value="4">Conference</option> 
							<option value="5">Webinars</option> 
							<option value="6">Checkpoints</option>
						</select>
					</div>
					<div id="event-section">
						<div class="form-group">
							<label>Event</label>
							<?php
								$events = \App\Event::where("type",1)->orderBy('event_date', 'desc')->get();	
							?>
							<select name="event" class="form-control">
								@foreach($events as $event)
								<option value="{{ $event->id }}">{{ $event->title }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Finalize Email</button>
					</div>
				</form>
			</div>
		</div>
		
	</div>
	
@endsection