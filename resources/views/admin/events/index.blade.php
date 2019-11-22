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
			<div class="col-sm-12 col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Upcoming Events
					</div>
					<div class="panel-body">
						@if (count($events))
						<div class="list-group">
							@foreach ($events as $event)
								<a href="/event/{{ $event->id }}" class="list-group-item upcoming-event" style="background: url({{ ($app == "production") ? secure_asset("/team-logos/" . $event->team . "_primary-icon.jpg") : asset("/team-logos/" . $event->team . "_primary-icon.jpg") }}) center right no-repeat;">
								<div class="row">
									<div class="col-sm-2 text-center">
										<div class="month">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('M') }}</div>
										<div class="day">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('j') }}</div>
									</div>
									<div class="col-sm-10">
										<h5>{{ $event->title }}</h5>
										<h6>{{ $event->location }}</h6>
									</div>
								</div>
							</a>
							@endforeach
						</div>
						@else
							<p>No upcoming events!</p>
						@endif
					</div>
				</div>
				<a href="/events/calendar" class="btn btn-primary">View All Events</a>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add New Event
					</div>
					<div class="panel-body">
						@if($errors->any())
							@foreach($errors->all() as $error)
								{{ $error }}
							@endforeach
						@endif
						<form action="/admin/events/new" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							
							<div class="form-group">
								<label for="eventTitle">Event Type</label>
								<select name="type" class="form-control">
									<option value="1">Training Camp</option>
									<option value="2">Tournament</option>
									<option value="3">Player Event</option>
									<option value="4">Conference</option>
									<option value="5">Webinars</option>
									<option value="6">Checkpoints</option>
									<option value="7">Game Night</option>
								</select>
							</div>
						
							<div class="form-group">
								<label for="eventTitle">Event Title</label>
								<input type="text" name="title" id="eventTitle" class="form-control" value="{{ old('title') }}" />
							</div>
							<div class="form-group">
								<label for="eventLocation">Event Location</label>
								<input type="text" name="location" id="eventLocation" class="form-control" value="{{ old('location') }}" />
							</div>
							<div class="form-group">
								<label for="eventAddress">Event Address</label>
								<input type="text" name="address" id="eventAddress" class="form-control" value="{{ old('address') }}" />
							</div>
							<div class="form-group">
								<label for="eventDate">Event Date</label><br>
								<input type="text" name="event_date" data-format="YYYY-MM-DD HH:mm:ss" data-template="MMM D YYYY hh : mm a" id="eventDate" class="form-control" value="{{ old('event_date', date('d-m-Y H:i:sa')) }}" />
							</div>
							<div class="form-group">
								<label for="endDate">End Date</label><br>
								<input type="text" name="end_date" data-format="YYYY-MM-DD HH:mm:ss" data-template="MMM D YYYY hh : mm a" id="endDate" class="form-control" value="{{ old('end_date', date('d-m-Y H:i:sa')) }}" />
							</div>
							<div class="form-group">
								<label for="eventDate">Event Timezone</label><br>
								<select name="timezone">
									<option value="PST">Pacific Standard Time</option>
									<option value="MST">Mountain Standard Time</option>
									<option value="CST">Central Standard Time</option>
									<option value="EST">Eastern Standard Time</option>
								</select>
							</div>
							<div class="form-group">
								<label for="parking">Parking & Directions</label>
								<textarea name="parking_and_directions" class="form-control" id="parking">{{ old('parking_and_directions') }}</textarea>
							</div>
							<div class="form-group">
								<label for="eventDetails">Event Details</label>
								<textarea name="details" class="form-control" id="eventDetails">{{ old('details') }}</textarea>
							</div>
							<div class="form-group">
								<label for="release-form">Release Form</label>
								<input type="file" name="release_form" class="form-control" id="release-form" />
							</div>
							<div class="form-group">
								<label for="participation-certificate">Participation Certificate</label>
								<input type="file" name="participation_certificate" class="form-control" id="participation-certificate" />
							</div>
							<div class="form-group">
								<label for="eventDetails">RSVP Type</label>
								<br>
								<select name="rsvp">
									<option value="0">No RSVP Needed</option>
									<option value="1">Training RSVP</option>
									<option value="2">Tournament RSVP</option>
								</select>
							</div>
							<div class="form-group">
								<label for="registration_cap">Registration Cap</label>
								<input type="number" name="registration_cap" class="form-control" min="0">
							</div>
							<div class="form-group">
								<label for="eventDetails">Associated Team</label>
								<br>
								<select name="team" class="team-select">
									<option value="null">Select a team...</option>
									<option value="null">No Team</option>
									<option value="null"></option>
									<option value="oakland-as">Oakland A's</option>
									<option value="null"></option>
									<option value="nba-math-hoops">NBA Math Hoops</option>
									<option value="learn-fresh">Learn Fresh</option>
									<option value="null"></option>
									<option value="broncos">Denver Broncos</option>
									<option value="null"></option>
									<option value="lin">Long Island Nets</option>
									<option value="null"></option>
									<option value="atl">Atlanta Hawks</option>
									<option value="bkn">Brooklyn Nets</option>
									<option value="bos">Boston Celtics</option>
									<option value="cha">Charlotte Hornets</option>
									<option value="chi">Chicago Bulls</option>
									<option value="cle">Cleveland Cavaliers</option>
									<option value="dal">Dallas Mavericks</option>
									<option value="den">Denver Nuggets</option>
									<option value="det">Detroit Pistons</option>
									<option value="gsw">Golden State Warriors</option>
									<option value="hou">Houston Rockets</option>
									<option value="ind">Indiana Pacers</option>
									<option value="lac">Los Angeles Clippers</option>
									<option value="lal">Los Angeles Lakers</option>
									<option value="mem">Memphis Grizzlies</option>
									<option value="mia">Miami Heat</option>
									<option value="mil">Milwakee Bucks</option>
									<option value="min">Minessota Timberwolves</option>
									<option value="nop">New Orleans Pelicans</option>
									<option value="nyk">New York Knicks</option>
									<option value="okc">Oklahoma City Thunder</option>
									<option value="orl">Orlando Magic</option>
									<option value="phi">Philadelphia 76ers</option>
									<option value="phx">Phoenix Suns</option>
									<option value="por">Portland Trailblazers</option>
									<option value="sac">Sacramento Kings</option>
									<option value="sas">San Antonio Spurs</option>
									<option value="tor">Toronto Raptors</option>
									<option value="uta">Utah Jazz</option>
									<option value="was">Washington Wizards</option>
									<option value="null"></option>
									<option value="wnba_atl">Atlanta Dream</option>
									<option value="wnba_chi">Chicago Sky</option>
									<option value="wnba_con">Connecticut Sun</option>
									<option value="wnba_dal">Dallas Wings</option>
									<option value="wnba_ind">Indiana Fever</option>
									<option value="wnba_lva">Las Vegas Aces</option>
									<option value="wnba_las">Los Angeles Sparks</option>						
									<option value="wnba_min">Minnesota Lynx</option>
									<option value="wnba_nyl">New York Liberty</option>
									<option value="wnba_pho">Phoenix Mercury</option>
									<option value="wnba_sea">Seattle Storm</option>
									<option value="wnba_was">Washington Mystics</option>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success pull-right" value="Add Event" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection