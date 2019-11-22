@extends("layouts.blank")
@section("content")

	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="row">
					<div class="col-sm-12">
						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
				      @if(Session::has('alert-' . $msg))
				      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
				      @endif
				    @endforeach
					</div>
				</div>
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
						
						@if($open)
						<div class="event-block">
							<h5>Pre-Register for this Event</h5>
							<form action="" method="post">
								{{ csrf_field() }}
								<div class="form-group" style="margin-bottom: 20px;display: block;overflow: hidden;">
									<div class="col-sm-6">
										<label for="school_program_name">School/Program Name <span class="required">*</span></label>
										<input type="text" class="form-control" name="school_program_name" id="school_program_name" required>
									</div>
									<div class="col-sm-6">
										<label for="name">Name <span class="required">*</span></label>
										<input type="text" class="form-control" name="name" id="name" required>
									</div>
								</div>
								
								<div class="form-group" style="margin-bottom: 20px;display: block;overflow: hidden;">
									<div class="col-sm-6">
										<label for="email">Email <span class="required">*</span></label>
										<input type="text" class="form-control" name="email" id="email" required>
									</div>
									<div class="col-sm-6">
										<label for="phone">Phone</label>
										<input type="text" class="form-control" name="phone" id="phone">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12 text-right">
										<button type="submit" class="btn btn-primary">Submit Registration</button>
									</div>
								</div>
							</form>
						</div>
						@else
						<div class="event-block">
							<h3>Pre-Registration is closed.</h3>
							@if(count($events) > 0)
							<p>Unfortunately, this event is full, but there are more events in your area coming up! Click below to pre-register for another event.</p>
							<ul>
								@foreach($events as $event)
								<li><a href="/event/{{ $event->id }}/pre-register">{{ $event->title }} - {{ \Carbon\Carbon::parse($event->event_date)->format("F jS - h:ia") }}</a></li>
								@endforeach
							</ul>
							@endif
						</div>
						@endif
						
						
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection