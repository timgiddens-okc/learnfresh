@extends("layouts.app")
	
@section("content")

<div class="container">
	
	<div class="page-header">
		<h2>Events In Your Region</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	      @if(Session::has('alert-' . $msg))
	      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
	      @endif
	    @endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="event-list">
			@foreach($events as $event)
			<div class="event">
				@if($event->type)
				<div class="badge badge-pill type-{{$event->type}}">
					<?php
						switch($event->type){
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
						}	
					?>
				</div>
				@endif
				<h3>{{ $event->title }}</h3>
				<h4>{{ $event->location }} - {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->event_date)->format('F jS, Y – g:ia') }} {{ $event->timezone }}</h4>
				{!! $event->details !!}
				<div style="margin-top: 25px;">
					<a href="/event/{{ $event->id }}" class="btn btn-primary">Event Details</a>
					<a href="/event/{{ $event->id }}/pre-register" class="btn btn-success">RSVP</a>
				</div>
			</div>
			@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			{{ $events->links() }}	
		</div>
	</div>
</div>
@endsection