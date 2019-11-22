@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-8">
			<div class="row">
				<div class="col-sm-12">
					@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			      @if(Session::has('alert-' . $msg))
			      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
			      @endif
			    @endforeach
				</div>
			</div>
			<div class="page-header">
				<h1>Programs</h1>
			</div>
			<div class="list-group">
				@foreach ($programs as $program)
					<a href="program/{{ $program->id }}" class="list-group-item">
						<span class="badge">{{ $program->weeks->count() }}</span>
						{{ $program->title }}
					</a>
				@endforeach
			</div>
			<div class="row">
				<div class="col-sm-12">
					<a href="program/new" class="btn btn-primary pull-right">Add New Program</a>
				</div>
			</div>
			<div class="stat-container">
				<div class="row">
					<div class="col-sm-12 text-center stats">
						<div class="row">
							<div class="col-xs-6 col-sm-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										Total Users
									</div>
									<div class="panel-body">
										<div id="total-users"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-9">
								<div class="panel panel-default">
									<div class="panel-heading">
										Total New Users (since 8/1/19)
									</div>
									<div class="panel-body">
										<div id="total-new-users"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Total Returning Users (since 8/1/19)
									</div>
									<div class="panel-body">
										<div id="total-returning-users"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Gross Revenue From Registrations
									</div>
									<div class="panel-body">
										<div id="gross-revenue"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Estimated Number of Students Served
									</div>
									<div class="panel-body">
											<div id="estimated-students"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										Pre-tests Completed
									</div>
									<div class="panel-body">
										<div id="pre-tests-completed"><i class="fa fa-spinner fa-spin"></i></div>
										
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										Post-tests Completed
									</div>
									<div class="panel-body">
										<div id="post-tests-completed"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										Registered Users who have submitted pre-tests
									</div>
									<div class="panel-body">
										<div id="registered-submitted-pretest"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-8">
								<div class="panel panel-default">
									<div class="panel-heading">
										<br>Time since last Community comment
									</div>
									<div class="panel-body">
										<div id="last-comment"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-8">
								<div class="panel panel-default">
									<div class="panel-heading">
										Games Shipped
									</div>
									<div class="panel-body">
										<div id="games-shipped"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
							<div class="col-xs-6 col-sm-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										Pending Shipments
									</div>
									<div class="panel-body">
										<div id="pending-shipments"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										Events
									</div>
									<div class="panel-body">
										<div id="event-stats"><i class="fa fa-spinner fa-spin"></i></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#pre-tests-completed").load("/pre-test-count");	
				$("#post-tests-completed").load("/post-test-count");	
				$("#total-users").load("/total-users");	
				$("#total-paid-users").load("/total-paid-users");	
				$("#total-returning-users").load("/total-returning-users");	
				$("#total-new-users").load("/total-new-users");	
				$("#gross-revenue").load("/gross-revenue");	
				$("#estimated-students").load("/estimated-students");	
				$("#registered-submitted-pretest").load("/registered-submitted-pretest");	
				$("#pending-shipments").load("/pending-shipments");	
				$("#games-shipped").load("/games-shipped");	
				$("#last-comment").load("/last-comment");	
				$("#event-stats").load("/event-stats");	
			});
		</script>
		<div class="col-sm-12 col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Events
				</div>
				<div class="panel-body">
					@if (count($events))
					<div class="list-group">
						@foreach ($events as $event)
							<a href="/event/{{ $event->id }}" class="list-group-item upcoming-event" style="background: url({{ ($app == "production") ? secure_asset("/team-logos/" . $event->team . "_primary-icon.jpg") : asset("/team-logos/" . $event->team . "_primary-icon.jpg") }}) center right no-repeat;">
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
						@endforeach
					</div>
					@else
						<p>No upcoming events!</p>
					@endif
					<div class="row">
						<div class="col-sm-12">
							<a href="/admin/events" class="btn btn-primary expanded">Add New Event</a>
							<a href="/events" class="btn btn-primary expanded" style="margin-top: 10px;">View All Events</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Championship Details
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<a href="/admin/championship" class="btn btn-primary expanded">Set Championship Details</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Resources
				</div>
				<div class="panel-body">
					@if (count($resources))
					<div class="list-group">
						@foreach ($resources as $resource)
							<a href="/resources/{{ $resource->id }}" class="list-group-item">
								<h5>{{ $resource->title }}</h5>
							</a>
						@endforeach
					</div>
					@else
						<p>No available resources!</p>
					@endif
					<div class="row">
						<div class="col-sm-12">
							<a href="/admin/resources" class="btn btn-primary expanded" style="margin-bottom: 10px;">Add Resource</a>
							<a href="/admin/resources/sort" class="btn btn-primary expanded" style="margin-bottom: 10px;">Sort Resources</a>
							<a href="/resources/all" class="btn btn-primary expanded">View All  Resources</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Checkpoints
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<a href="/admin/checkpoints" class="btn btn-primary expanded">View Checkpoints</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Users
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<a href="/admin/users" class="btn btn-primary expanded">View All Users</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Upcoming Orders
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<a href="/admin/shipping" class="btn btn-primary expanded">View Upcoming Orders</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Assessments
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<a href="/admin/preassessment-results" class="btn btn-primary expanded" style="margin-bottom: 10px;">View Preassessment Results</a>
							<a href="/admin/postassessment-results" class="btn btn-primary expanded">View Postassessment Results</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection