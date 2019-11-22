@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Checkpoints</h2>
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
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Educator Name</td>
							<td>School/Program Name</td>
							<td>Number of students participating</td>
							<td>Average number of games played per student</td>
							<td>Average number of curriculum pieces completed per student</td>
							<td>Average number of sportsmanship points earned per student</td>
							<td>Total number of games played</td>
							<td>Total number of curriculum pieces completed</td>
							<td>Total number of sportsmanship points earned</td>
							<td>Number of students eligible to apply for the National Championship</td>
							
						</tr>
					</thead>
					<tbody>
						@foreach ($results as $a)
						<tr>
							<td>
								<?php
									$thisUser = \App\User::find($a->user_id);									
								?>
								{{ $thisUser['name'] }}
							</td>
							<td>
								<?php
									$thisUser = \App\User::find($a->user_id);									
								?>
								{{ $thisUser['school_program_name'] }}
							</td>
							<td>{{ $a->studentsParticipating }}</td>
							<td>{{ $a->gamesPerStudent }}</td>
							<td>{{ $a->curriculumPerStudent }}</td>
							<td>{{ $a->sportsmanshipPointsPerStudent }}</td>
							<td>{{ $a->gamesPlayed }}</td>
							<td>{{ $a->curriculumCompleted }}</td>
							<td>{{ $a->sportsmanshipPoints }}</td>
							<td>{{ $a->studentsEligible }}</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="row">
		  	<div class="col-sm-12">
		    	{{ $results->links() }}
		  	</div>
			</div>
		</div>
	</div>
</div>
@endsection