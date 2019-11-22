@extends("layouts.app")
	
@section("content")

	@if(\Auth::user()->isAdmin())
		@include("national-championship.national-championship-nav")
	@endif

<div class="container">
	<div class="page-header">
		<h2>Votes</h2>
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
		<div class="col-sm-12">
			<h4>My Nominees</h4>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Region/Team</td>
							<td>Student Name</td>
							<td>Educator Name</td>	
							<td>Educator Email</td>
							<td>Educator Phone</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($votes as $vote)
						<?php 
							$application = \App\Application::where('id', $vote->application_id)->first();
							$educator = \App\User::where('id',$application->educator_id)->first(); 
						?>
						<tr>		
							<td>{{ $application->team_region }}</td>				
							<td><a href="/national-championship/application/{{ $application->id }}">{{ $application->student_name }}</a></td>
							<td>{{ $application->educator_name }}</td>							
							<td>{{ $educator->email }}</td>
							<td>{{ $educator->phone }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">
			<h4>Total Votes</h4>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td></td>
							<td>Region/Team</td>
							<td>Student Name</td>
							<td>Educator Name</td>	
							<td>Educator Email</td>
							<td>Educator Phone</td>
							<td>Votes</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>
						<?php
							$count = 0;	
						?>
						@foreach ($fullVotes as $application)
							<?php 
								$count++; 
							?>
							@if($application->votes->count() > 0)
							<?php 
								$educator = \App\User::where('id',$application->educator_id)->first(); 
								$views = \App\View::where('application_id',$application->id)->get();
							?>
							<tr>		
								<td>#{{ $count }}</td>
								<td>{{ $application->team_region }}</td>				
								<td><a href="/national-championship/application/{{ $application->id }}">{{ $application->student_name }}</a></td>
								<td>{{ $application->educator_name }}</td>							
								<td>{{ $educator->email }}</td>
								<td>{{ $educator->phone }}</td>
								<td>{{ $application->votes->count() }}</td>
								<td>
									<form action="/national-championship/application/{{ $application->id }}/status" method="post">
										<select name="status" class="status-change">
											<option value="0" {{ ($application->status == 0) ? "selected" : "" }}>Nominee</option>
											<option value="1" {{ ($application->status == 1) ? "selected" : "" }}>Participant</option>
										</select>
									</form>
								</td>
							</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>
@endsection