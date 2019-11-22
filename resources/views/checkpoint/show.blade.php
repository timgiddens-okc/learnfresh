@extends("layouts.app")
	
@section('content')
	
	<div class="container">
		<div class="page-header">
			<h2>Checkpoint</h2>
			<p>Please report participation data that hs been accumulated since <strong>{{ $checkpoint->since_date }}</strong>.</p>
		</div>
		<form action="/checkpoint/submit" method="post">
			{{ csrf_field() }}
			
			<div class="row">
				<div class="col-sm-12 col-md-8 col-md-offset-2">
					@if($checkpoint->studentsParticipating)
						<div class="form-group">
							<label>Number of students participating</label>
							<input type="text" name="studentsParticipating" class="form-control" />
						</div>
					@endif
					
					@if($checkpoint->gamesPerStudent)
						<div class="form-group">
							<label>Average number of games played per student</label>
							<input type="text" name="gamesPerStudent" class="form-control" />
						</div>
					@endif
					
					@if($checkpoint->curriculumPerStudent)
						<div class="form-group">
							<label>Average number of curriculum pieces completed per student</label>
							<input type="text" name="curriculumPerStudent" class="form-control" />
						</div>
					@endif
					
					@if($checkpoint->sportsmanshipPointsPerStudent)
						<div class="form-group">
							<label>Average number of sportsmanship points earned per student</label>
							<input type="text" name="sportsmanshipPointsPerStudent" class="form-control" />
						</div>
					@endif
					
					@if($checkpoint->gamesPlayed)
						<div class="form-group">
							<label>Total number of games played</label>
							<input type="text" name="gamesPlayed" class="form-control" />
						</div>
					@endif
					
					@if($checkpoint->curriculumCompleted)
						<div class="form-group">
							<label>Total number of curriculum pieces completed</label>
							<input type="text" name="curriculumCompleted" class="form-control" />
						</div>
					@endif
					
					@if($checkpoint->sportsmanshipPoints)
						<div class="form-group">
							<label>Total number of sportsmanship points earned</label>
							<input type="text" name="sportsmanshipPoints" class="form-control" />
						</div>
					@endif
					
					@if($checkpoint->studentsEligible)
						<div class="form-group">
							<label>Number of students eligible to apply for the National Championship<br>(25 games played + 10 curriculum pieces completed)</label>
							<input type="text" name="studentsEligible" class="form-control" />
						</div>
					@endif
					
					<div class="form-group">
						<input type="submit" class="btn btn-primary expanded" value="Submit Checkpoint" />
					</div>
				</div>
			</div>
			
		</form>
	</div>
	
@endsection