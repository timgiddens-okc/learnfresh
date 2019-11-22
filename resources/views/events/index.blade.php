@extends('layouts.app')
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Events</h2>
			@if(Auth::user()->isAdmin())
			<a href="/admin/events" class="btn btn-success btn-sm">Add New Event</a>
			@endif
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Upcoming Events
			</div>
			<div class="panel-body event-list">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
						@if(count($events) > 0)
							<?php 
								$count = 1; 
							?>
							@foreach ($events as $event)
								<td>
									<a href="/event/{{ $event->id }}" class="upcoming-event" style="background: url({{ ($app == "production") ? secure_asset("/team-logos/" . $event->team . "_primary-icon.jpg") : asset("/team-logos/" . $event->team . "_primary-icon.jpg") }}) center right no-repeat;">
											<div class="row">
												<div class="col-sm-3 text-center">
													<div class="month">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('M') }}</div>
													<div class="day">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('j') }}</div>
												</div>
												<div class="col-sm-9">
													<h5>{{ $event->title }}</h5>
													<h6>{{ $event->location }}</h6>
												</div>
											</div>
										</a>
								</td>
								<?php
									$count++;
									if($count > 4){
										$count = 1;
										echo "</tr><tr>";
									}
								?>
							@endforeach
						@else
							<div class="col-xs-12">
								<p>No upcoming events!</p>
							</div>
						@endif
						</tr>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-12 event-pagination">
						{{ $events->links() }}
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Past Events
			</div>
			<div class="panel-body event-list">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
						@if(count($pastevents) > 0)
							<?php 
								$count = 1; 
							?>
							@foreach ($pastevents as $event)
								<td>
									<a href="/event/{{ $event->id }}" class="upcoming-event" style="background: url({{ ($app == "production") ? secure_asset("/team-logos/" . $event->team . "_primary-icon.jpg") : asset("/team-logos/" . $event->team . "_primary-icon.jpg") }}) center right no-repeat;">
											<div class="row">
												<div class="col-sm-3 text-center">
													<div class="month">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('M') }}</div>
													<div class="day">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s T', $event->event_date . ' ' . $event->timezone)->format('j') }}</div>
												</div>
												<div class="col-sm-9">
													<h5>{{ $event->title }}</h5>
													<h6>{{ $event->location }}</h6>
												</div>
											</div>
										</a>
								</td>
								<?php
									$count++;
									if($count > 4){
										$count = 1;
										echo "</tr><tr>";
									}
								?>
							@endforeach
						@else
							<div class="col-xs-12">
								<p>No past events!</p>
							</div>
						@endif
						</tr>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-12 event-pagination">
						{{ $pastevents->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection