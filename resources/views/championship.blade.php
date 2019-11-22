@extends("layouts.app")

@section("content")

	<div class="container">
				
		<div class="row">
			<div class="col-xs-12 text-center">
				<h1>NBA Math Hoops National Championship</h1>
				<h3 class="championship-location">{{ $championship->date }} – {{ $championship->location }}</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
				<div class="embed-responsive embed-responsive-16by9">
					{!! $championship->video !!}
				</div>
			</div>
		</div>
		<div class="championship-details">
			<div class="row">
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="block">
						<?php $eventDate = $championship->countdown_date; ?>
						<div class="panel panel-default championship">
							<div class="panel-body">
								<div class="row">
									<div class="small-12 columns text-center">
										<div class="trophy"><i class="fa fa-trophy"></i></div>
										<?php
											$championshipDate = new \Carbon\Carbon($championship->countdown_date, 'America/Chicago');
											$now = \Carbon\Carbon::now('America/Chicago');
											if($now < $championshipDate){
										?>
										<h3>Countdown to Qualify for the National Championship Tournament</h3>
										<div id="countdown-holder"></div>
										<?php } else { ?>
										<h3>Congratulations to everyone who has qualified for the National Championship!</h3>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="block">
						<div class="row">
							<div class="col-xs-12 col-sm-7">
								<h2>How To Qualify</h2>
								{!! $championship->how_to_qualify !!}
							</div>
							<div class="col-xs-12 col-sm-5">
								<img src="{{ ($app == "production") ? secure_asset($championship->qualify_image) : asset($championship->qualify_image) }}" />
							</div>
						</div>
					</div>
					<div class="block">
						<div class="row">
							<div class="col-xs-12 col-sm-5">
								<img src="{{ ($app == "production") ? secure_asset($championship->event_details_image) : asset($championship->event_details_image) }}" />
								
							</div>
							<div class="col-xs-12 col-sm-7">
								<h2>Event Details</h2>
								{!! $championship->event_details !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection