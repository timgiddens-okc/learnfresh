@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Applications</h2>
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
			<h3>{{ count($applications) }} Applications</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Student Name</td>
							<td>Student Grade Level</td>
							<td>School/Program Name</td>
							<td>Favorite Team</td>
							<td>Educator Name</td>
							<td>Team Region</td>
							<td>Games Played</td>
							<td>Curriculum Pieces Completed</td>
							<td>Sportsmanship Points Earned</td>
							<td>Letter Of Recommendation</td>
							<td>Applicant Video</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($applications as $application)
						<tr>						
							<td>{{ $application->student_name }}</td>
							<td>{{ $application->student_grade_level }}</td>
							<td>{{ $application->school_program_name }}</td>
							<td>{{ $application->favorite_team }}</td>
							<td>{{ $application->educator_name }}</td>
							<td>{{ $application->team_region }}</td>
							<td>{{ $application->games_played }}</td>
							<td>{{ $application->curriculum_pieces_completed }}</td>
							<td>{{ $application->sportsmanship_points_earned }}</td>
							<td><div style="max-height: 150px;overflow: auto;">{{ $application->letter_of_recommendation }}</div></td>
							<td>{{ $application->applicant_video }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection