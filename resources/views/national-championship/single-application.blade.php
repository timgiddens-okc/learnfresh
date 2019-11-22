@extends("layouts.app")
	
@section("content")
	@if(\Auth::user()->isAdmin())
		@include("national-championship.national-championship-nav")
	@endif

<div class="container">
	<div class="page-header">
		<h2>Application 
		@if(\App\View::where('application_id',$application->id)->where('user_id',\Auth::user()->id)->exists())
			<span class='badge badge-secondary' style="font-size: 21px;margin-left: 5px; padding: 7px 7px 3px 7px;">Viewed</span>
		@endif
		@if(\App\Vote::where('application_id',$application->id)->where('user_id',\Auth::user()->id)->exists())
			<span class='badge badge-success' style="background:#28a745;font-size: 21px;margin-left: 5px; padding: 7px 7px 3px 7px;">Nominated</span>
		@endif
		</h2>
		<a href="/national-championship/applicants">View All Applicants</a>
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

	<div class="application-nav">
		<div class="row">
			<div class="col-sm-6">
				@if($previous)
					<a href="/national-championship/application/{{ $previous->id }}" class="btn btn-primary">View Previous</a>
				@endif
			</div>
			<div class="col-sm-6 text-right">
				@if($next)
					<a href="/national-championship/application/{{ $next->id }}" class="btn btn-primary">View Next</a>
				@endif
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
				<tr>
					<td style="width: 15%;"><strong>Student</strong></td>
					<td>{{ $application->student_name }}</td>
				</tr>
				<tr>
					<td><strong>Grade</strong></td>
					<td>{{ $application->student_grade_level }}</td>
				</tr>
				<tr>
					<td><strong>School</strong></td>
					<td>{{ $application->school_program_name }}</td>
				</tr>
				<tr>
					<td><strong>Favorite Team</strong></td>
					<td>{{ $application->favorite_team }}</td>
				</tr>
				<tr>
					<td><strong>Educator</strong></td>
					<td>{{ $application->educator_name }}</td>
				</tr>
				<tr>
					<td><strong>Games Played</strong></td>
					<td>{{ $application->games_played }}</td>
				</tr>
				<tr>
					<td><strong>Lessons Completed</strong></td>
					<td>{{ $application->curriculum_pieces_completed }}</td>
				</tr>
				<tr>
					<td><strong>Good Sport Points Earned</strong></td>
					<td>{{ $application->sportsmanship_points_earned }}</td>
				</tr>
				<tr>
					<td><strong>Video</strong></td>
					<td><a href="{{ $application->applicant_video }}" target="_blank">{{ $application->applicant_video }}</a></td>
				</tr>
				<tr>
					<td><strong>Recommendation</strong></td>
					<td>{{ nl2br($application->letter_of_recommendation) }}</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12 text-center">
			<form action="" method="post">
				{{ csrf_field() }}
				@if(\App\Vote::where('application_id',$application->id)->where('user_id',\Auth::user()->id)->exists())
				<button type="submit" class="btn btn-primary nominate">Remove Nomination</button>
				@else
				<button type="submit" class="btn btn-primary nominate">Nominate</button>
				@endif
			</form>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-6">
			@if($previous)
				<a href="/national-championship/application/{{ $previous->id }}" class="btn btn-primary">View Previous</a>
			@endif
		</div>
		<div class="col-sm-6 text-right">
			@if($next)
				<a href="/national-championship/application/{{ $next->id }}" class="btn btn-primary">View Next</a>
			@endif
		</div>
	</div>
	
</div>
@endsection