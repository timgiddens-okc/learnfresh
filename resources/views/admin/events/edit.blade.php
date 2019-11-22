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
			<div class="col-sm-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Update Event
					</div>
					<div class="panel-body">
						<a href="/events" class="btn btn-primary">View All Events</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-8">
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							{{ method_field('patch') }}
							
							<div class="form-group">
								<label for="eventTitle">Event Type</label>
								<select name="type" class="form-control">
									<option value="1" {{ ($event->type == '1') ? "selected" : "" }}>Training Camp</option>
									<option value="2" {{ ($event->type == '2') ? "selected" : "" }}>Tournament</option>
									<option value="3" {{ ($event->type == '3') ? "selected" : "" }}>Player Event</option>
									<option value="4" {{ ($event->type == '4') ? "selected" : "" }}>Conference</option>
									<option value="5" {{ ($event->type == '5') ? "selected" : "" }}>Webinars</option>
									<option value="6" {{ ($event->type == '6') ? "selected" : "" }}>Checkpoints</option>
									<option value="6" {{ ($event->type == '7') ? "selected" : "" }}>Game Night</option>
								</select>
							</div>
						
							<div class="form-group">
								<label for="eventTitle">Event Title</label>
								<input type="text" name="title" id="eventTitle" class="form-control" value="{{ $event->title }}" />
							</div>
							<div class="form-group">
								<label for="eventLocation">Event Location</label>
								<input type="text" name="location" id="eventLocation" class="form-control" value="{{ $event->location }}" />
							</div>
							<div class="form-group">
								<label for="eventAddress">Event Address</label>
								<input type="text" name="address" id="eventAddress" class="form-control" value="{{ $event->address }}" />
							</div>
							<div class="form-group">
								<label for="eventDate">Event Date</label><br>
								<input type="text" name="event_date" data-format="YYYY-MM-DD HH:mm:ss" data-template="MMM D YYYY hh : mm a" id="eventDate" class="form-control" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->event_date)->format('Y-m-d H:i:s') }}" />
							</div>
							<div class="form-group">
								<label for="endDate">End Date</label><br>
								<input type="text" name="end_date" data-format="YYYY-MM-DD HH:mm:ss" data-template="MMM D YYYY hh : mm a" id="endDate" class="form-control" value="{{ ($event->end_date) ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('Y-m-d H:i:s') : '' }}" />
							</div>
							<div class="form-group">
								<label for="eventDate">Event Timezone</label><br>
								<select name="timezone">
									<option value="PST" {{ $event->timezone == "PST" ? "selected" : "" }}>Pacific Standard Time</option>
									<option value="MST" {{ $event->timezone == "MST" ? "selected" : "" }}>Mountain Standard Time</option>
									<option value="CST" {{ $event->timezone == "CST" ? "selected" : "" }}>Central Standard Time</option>
									<option value="EST" {{ $event->timezone == "EST" ? "selected" : "" }}>Eastern Standard Time</option>
								</select>
							</div>
							<div class="form-group">
								<label for="parking">Parking & Directions</label>
								<textarea name="parking_and_directions" class="form-control" id="parking">{{ $event->parking_and_directions }}</textarea>
							</div>
							<div class="form-group">
								<label for="eventDetails">Event Details</label>
								<textarea name="details" class="form-control" id="eventDetails">{{ $event->details }}</textarea>
							</div>
							<div class="form-group">
								<label for="release-form">Release Form</label>
								<input type="file" name="release_form" id="release-form" />
								<input type="checkbox" name="remove_release_form"> Remove release form
							</div>
							<div class="form-group">
								<label for="participation-certificate">Participation Certificate</label>
								<input type="file" name="participation_certificate" id="participation-certificate" />
								<input type="checkbox" name="remove_participation_certificate"> Remove participation certificate
							</div>
							<div class="form-group">
								<label for="eventDetails">RSVP Type</label>
								<br>
								<select name="rsvp">
									@if ($event->rsvp == 0)
									<option value="0" selected>No RSVP Needed</option>
									@else
									<option value="0">No RSVP Needed</option>
									@endif
									@if ($event->rsvp == 1)
									<option value="1" selected>Training RSVP</option>
									@else
									<option value="1">Training RSVP</option>
									@endif
									@if ($event->rsvp == 2)
									<option value="2" selected>Tournament RSVP</option>
									@else
									<option value="2">Tournament RSVP</option>
									@endif
									
									
								</select>
							</div>
							<div class="form-group">
								<label for="registration_cap">Registration Cap</label>
								<input type="number" name="registration_cap" class="form-control" value="{{ $event->registration_cap }}" min="0">
							</div>
							<div class="form-group">
								<label for="eventDetails">Associated Team</label>
								<br>
								<select name="team" class="team-select">
									<option value="null">Select a team...</option>
									<option value="null">No Team</option>
									<option value="null"></option>
									<option {{ ($event->team == "oakland-as") ? "selected" : "" }} value="oakland-as">Oakland A's</option>
									<option value="null"></option>
									<option {{ ($event->team == "nba-math-hoops") ? "selected" : "" }} value="nba-math-hoops">NBA Math Hoops</option>
									<option {{ ($event->team == "learn-fresh") ? "selected" : "" }} value="learn-fresh">Learn Fresh</option>
									<option value="null"></option>
									<option {{ ($event->team == "broncos") ? "selected" : "" }} value="broncos">Denver Broncos</option>
									<option value="null"></option>
									<option {{ ($event->team == "lin") ? "selected" : "" }} value="lin">Long Island Nets</option>
									<option value="null"></option>
									<option {{ ($event->team == "atl") ? "selected" : "" }} value="atl">Atlanta Hawks</option>
									<option {{ ($event->team == "bkn") ? "selected" : "" }} value="bkn">Brooklyn Nets</option>
									<option {{ ($event->team == "box") ? "selected" : "" }} value="bos">Boston Celtics</option>
									<option {{ ($event->team == "cha") ? "selected" : "" }} value="cha">Charlotte Hornets</option>
									<option {{ ($event->team == "chi") ? "selected" : "" }} value="chi">Chicago Bulls</option>
									<option {{ ($event->team == "cle") ? "selected" : "" }} value="cle">Cleveland Cavaliers</option>
									<option {{ ($event->team == "dal") ? "selected" : "" }} value="dal">Dallas Mavericks</option>
									<option {{ ($event->team == "den") ? "selected" : "" }} value="den">Denver Nuggets</option>
									<option {{ ($event->team == "det") ? "selected" : "" }} value="det">Detroit Pistons</option>
									<option {{ ($event->team == "gsw") ? "selected" : "" }} value="gsw">Golden State Warriors</option>
									<option {{ ($event->team == "hou") ? "selected" : "" }} value="hou">Houston Rockets</option>
									<option {{ ($event->team == "ind") ? "selected" : "" }} value="ind">Indiana Pacers</option>
									<option {{ ($event->team == "lac") ? "selected" : "" }} value="lac">Los Angeles Clippers</option>
									<option {{ ($event->team == "lal") ? "selected" : "" }} value="lal">Los Angeles Lakers</option>
									<option {{ ($event->team == "mem") ? "selected" : "" }} value="mem">Memphis Grizzlies</option>
									<option {{ ($event->team == "mia") ? "selected" : "" }} value="mia">Miami Heat</option>
									<option {{ ($event->team == "mil") ? "selected" : "" }} value="mil">Milwakee Bucks</option>
									<option {{ ($event->team == "min") ? "selected" : "" }} value="min">Minessota Timberwolves</option>
									<option {{ ($event->team == "nop") ? "selected" : "" }} value="nop">New Orleans Pelicans</option>
									<option {{ ($event->team == "nyk") ? "selected" : "" }} value="nyk">New York Knicks</option>
									<option {{ ($event->team == "okc") ? "selected" : "" }} value="okc">Oklahoma City Thunder</option>
									<option {{ ($event->team == "orl") ? "selected" : "" }} value="orl">Orlando Magic</option>
									<option {{ ($event->team == "phi") ? "selected" : "" }} value="phi">Philadelphia 76ers</option>
									<option {{ ($event->team == "phx") ? "selected" : "" }} value="phx">Phoenix Suns</option>
									<option {{ ($event->team == "por") ? "selected" : "" }} value="por">Portland Trailblazers</option>
									<option {{ ($event->team == "sac") ? "selected" : "" }} value="sac">Sacramento Kings</option>
									<option {{ ($event->team == "sas") ? "selected" : "" }} value="sas">San Antonio Spurs</option>
									<option {{ ($event->team == "tor") ? "selected" : "" }} value="tor">Toronto Raptors</option>
									<option {{ ($event->team == "uta") ? "selected" : "" }} value="uta">Utah Jazz</option>
									<option {{ ($event->team == "was") ? "selected" : "" }} value="was">Washington Wizards</option>
									<option value="null"></option>
									<option {{ ($event->team == "wnba_atl") ? "selected" : "" }} value="wnba_atl">Atlanta Dream</option>
									<option {{ ($event->team == "wnba_chi") ? "selected" : "" }} value="wnba_chi">Chicago Sky</option>
									<option {{ ($event->team == "wnba_con") ? "selected" : "" }} value="wnba_con">Connecticut Sun</option>
									<option {{ ($event->team == "wnba_dal") ? "selected" : "" }} value="wnba_dal">Dallas Wings</option>
									<option {{ ($event->team == "wnba_ind") ? "selected" : "" }} value="wnba_ind">Indiana Fever</option>
									<option {{ ($event->team == "wnba_lva") ? "selected" : "" }} value="wnba_lva">Las Vegas Aces</option>
									<option {{ ($event->team == "wnba_las") ? "selected" : "" }} value="wnba_las">Los Angeles Sparks</option>
									<option {{ ($event->team == "wnba_min") ? "selected" : "" }} value="wnba_min">Minnesota Lynx</option>
									<option {{ ($event->team == "wnba_nyl") ? "selected" : "" }} value="wnba_nyl">New York Liberty</option>
									<option {{ ($event->team == "wnba_pho") ? "selected" : "" }} value="wnba_pho">Phoenix Mercury</option>
									
									<option {{ ($event->team == "wnba_sea") ? "selected" : "" }} value="wnba_sea">Seattle Storm</option>
									<option {{ ($event->team == "wnba_was") ? "selected" : "" }} value="wnba_was">Washington Mystics</option>
								</select>
							</div>
							<div class="form-group">
								<label for="video">Video</label>
								<textarea name="video_embed" class="embed form-control">{{ $event->video_embed }}</textarea>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success pull-right" value="Update Event" />
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						Add Event Images
					</div>
					<div class="panel-body">
						@if (count($event->images) > 0)
						<div class="event-block event-images">
							<h5><strong>Event Images</strong></h5>
							<div class="row">
							@foreach($event->images as $image)
								<div class="col-xs-6 col-sm-3 col-md-2">
									<div class="event-image" style="background: url({{ secure_url($image->url) }}) center center no-repeat;"></div>
									<form action="/event-photo/{{ $image->id }}/delete" method="post">
										{{ csrf_field() }}
										<button type="submit" class="delete-image"><i class="fa fa-window-close"></i></button>
									</form>
								</div>
							@endforeach
							</div>
						</div>
						@endif
					
						<form action="/event/{{ $event->id }}/add-images" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="eventImages">Upload Event Images</label>
								<input type="file" name="images[]" id="eventImages" required multiple>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success pull-right" value="Upload Images" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection