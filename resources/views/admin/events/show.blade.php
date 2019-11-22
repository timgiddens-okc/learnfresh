@extends("layouts.app")
	
@section("content")
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1>Events</h1>
				</div>
			</div>
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
			<div class="col-sm-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						@if (Auth::user()->isAdmin())
						<a href="/event/{{ $event->id }}/edit" class="btn btn-success expanded">Edit This Event</a>
						@endif
						@if (Auth::user()->isAdmin())
						<a href="/events/calendar" class="btn btn-primary expanded" style="margin-top:10px;">View All Events</a>
						@else
						<a href="/events" class="btn btn-primary expanded" style="margin-top:10px;">View All Events</a>
						@endif
						@if (Auth::user()->isAdmin())
						<a href="/event/{{ $event->id }}/send-email" class="btn btn-warning expanded show-spinner" style="margin-top:10px;">Send Championship Email</a>
						<a href="/event/{{ $event->id }}/send-training-email" class="btn btn-warning expanded show-spinner" style="margin-top:10px;">Send Training Email</a>
						<a href="/event/{{ $event->id }}/rsvp-list" class="btn btn-info expanded download-list">View Event Attendees</a>
						<a href="/event/{{ $event->id }}/pre-register" class="btn btn-info expanded" style="margin-top: 10px;" target="_blank">Pre-Registration Page</a>
						@if ($event->rsvp != 0)
							@if ($event->registration_open == 1)
								<a href="/event/{{ $event->id }}/close-registration" class="btn btn-info expanded" style="margin-top: 10px;">Close Registration</a>
							@else
								<a href="/event/{{ $event->id }}/open-registration" class="btn btn-info expanded" style="margin-top: 10px;">Open Registration</a>
							@endif
						@endif
						<a href="/event/{{ $event->id }}/delete" class="btn btn-danger delete expanded delete-event" style="margin-top: 10px;">Delete This Event</a>
						@else
							@if(\Auth::user()->id == 80)
							<a href="/event/{{ $event->id }}/rsvp-list" class="btn btn-info expanded download-list">View Event Attendees</a>
							@endif
						@endif
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="event-title" style="background: url({{ ($app == "production") ? secure_asset("/team-logos/" . $event->team . "_primary-icon.jpg") : asset("/team-logos/" . $event->team . "_primary-icon.jpg") }}) center right no-repeat;">
							<div class="row">
								<div class="col-sm-12">
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
												case "7":
													echo "Game Night";
													break;
											}	
										?>
									</div><br><br>
									@endif
									<h3>{{ $event->title }}</h3>
									<h4>
										{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->event_date)->format('F jS, Y – g:ia') }} {{ $event->timezone }}
										</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						
						<div class="event-block">
							@if($event->address)
							<div class="google-map">
								{!! Mapper::render() !!}
							</div>
							@endif
							<h4><strong>{{ $event->location }}</strong></h4>
							<h5>{{ $event->address }}</h5>
						</div>
					
						@if ($event->details)
						<div class="event-block">
							<h5><strong>Event Details</strong></h5>
							{!! $event->details !!}
						</div>
						@endif					
						
						@if ($event->parking_and_directions)
						<div class="event-block">
							<h5><strong>Parking &amp; Directions</strong></h5>
							{!! $event->parking_and_directions !!}
						</div>
						@endif
						
						@if ($event->release_form)
						<div class="event-block">
							<h5><strong>Release Form</strong></h5>
							<a href="{{ secure_url($event->release_form) }}" class="btn btn-primary" target="_blank">Download Form</a>
						</div>
						@endif
						
						@if ($event->participation_certificate)
						<div class="event-block">
							<h5><strong>Participation Certificate</strong></h5>
							<a href="{{ secure_url($event->participation_certificate) }}" class="btn btn-primary" target="_blank">Download Certificate</a>
						</div>
						@endif
						
						@if ($event->video_embed)
						<div class="event-block event-images">
							<h5><strong>Event Video</strong></h5>
							<div class="embed-responsive embed-responsive-16by9">
								{!! $event->video_embed !!}
							</div>
						</div>
						@endif
						
						@if (count($event->images) > 0)
						<div class="event-block event-images">
							<h5><strong>Event Images</strong></h5>
							<div class="row">
							@foreach($event->images as $image)
								<div class="col-xs-6 col-sm-3 col-md-2">
									<a href="{{ secure_url($image->url) }}" rel="shadowbox[gallery]" class="event-image">{!! Form::image(secure_url($image->url), '', array('width' => 95)) !!}</a>
								</div>
							@endforeach
							</div>
						</div>
						@endif
						
						@if ($event->rsvp == 1)
							@if($event->registration_open == 1)
						<div class="event-block">
							@if (!App\Rsvp::checkRsvp($event))
								<a href="/event/{{ $event->id }}/rsvp" class="btn btn-primary">RSVP For This Event</a>
							@else
								<a href="#" class="btn btn-primary disabled">RSVP For This Event</a> <div class="already-rsvp">Thank you for RSVPing!</div>
							@endif
						</div>
							@else
								<div class="event-block">
									<p>Registration is closed.</p>
								</div>
							@endif
						@elseif ($event->rsvp == 2)
							@if($event->id == 103 || $event->id == 110 || $event->registration_open == 0)
							  <p>Registration is closed.</p>
							@else
							<form action="/event/{{ $event->id }}/rsvp" method="post">
								{{ csrf_field() }}
									<div class="form-group">
									@if (!App\Rsvp::checkRsvp($event))								
										Select which students you will be bringing:
										<table class="table">
											<thead>
												<tr>
													<td>Student Name</td>
													<td>Shirt Size</td>
												</tr>
											</thead>
											<tbody>
										@foreach (\Auth::user()->students as $student)
										<tr>
											<td>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="students[]" value="{{ $student->name }}" />
												{{ $student->name }}
											</label>
										</div>
											</td>
											<td>
												<input type="text" class="form-control" style="width: 100px;" name="shirt_sizes[]"/>
											</td>
										</tr>
										@endforeach
											</tbody>
										</table>
										<br><br>
										<div class="form-group">
											<label for="additional_guests">Please list any additional guests (teachers, parents, etc) separated with a comma.</label>
											<input type="text" name="additional_guests" id="additional_guests" class="form-control" />
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary">RSVP For This Event</button>
										</div>
									@else
										<p><a href="#" class="btn btn-primary disabled">RSVP For This Event</a> <span class="already-rsvp">Thank you for RSVPing!</span></p>
										<?php
											$rsvp = \App\RSVP::where('event_id', $event->id)->where('user_id',Auth::user()->id)->first();
										?>
										<p><a href="/attendee/{{ $rsvp->id }}/edit-rsvp" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit RSVP</a> <a href="/attendee/{{ $rsvp->id }}/cancel-rsvp" class="btn btn-primary"><i class="fa fa-times"></i> Cancel RSVP</a></p>
									@endif
								</div>
							</form>
							@endif
						@endif
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection