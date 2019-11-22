@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Pre-Test Results</h2>
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
	@if($columns)
	<div class="row">
		<div class="col-sm-12">			
			<h3>{{ number_format($assessments->total()) }} Tests</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
								<td>School/Program Name</td>
								<td>State</td>
							@foreach ($columns as $c)
								@if ($c != 'id' && $c != 'created_at' && $c != 'updated_at' && $c != 'school_program_name' && $c != 'state')
								<td>
									{{ ucwords(str_replace("_"," ",$c)) }}
								</td>
								@endif
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach ($assessments as $assessment)
						<tr>						
							<td>{{ $assessment->school_program_name }}</td>
							<td>{{ $assessment->state }}</td>
							<td>{{ $assessment->student_id }}</td>
							<td>{{ $assessment->nba_champion }}</td>
							<td>{{ $assessment['7+1'] }}</td>
							<td>{{ $assessment['6-3'] }}</td>
							<td>{{ $assessment['6x6'] }}</td>
							<td>{{ $assessment['9/3'] }}</td>
							<td>{{ $assessment['7+5'] }}</td>
							<td>{{ $assessment['9x0'] }}</td>
							<td>{{ $assessment['7x7'] }}</td>
							<td>{{ $assessment['7-1'] }}</td>
							<td>{{ $assessment['4x5'] }}</td>
							<td>{{ $assessment['9/2'] }}</td>
							<td>{{ $assessment['8x7'] }}</td>
							<td>{{ $assessment['8-8'] }}</td>
							<td>{{ $assessment['5/2'] }}</td>
							<td>{{ $assessment['7x9'] }}</td>
							<td>{{ $assessment['4+3'] }}</td>
							<td>{{ $assessment['6+5'] }}</td>
							<td>{{ $assessment['9-7'] }}</td>
							<td>{{ $assessment['2x8'] }}</td>
							<td>{{ $assessment['7/1'] }}</td>
							<td>{{ $assessment['9-1'] }}</td>
							<td>{{ $assessment['6/2'] }}</td>
							<td>{{ $assessment['5x2'] }}</td>
							<td>{{ $assessment['8/2'] }}</td>
							<td>{{ $assessment['3x4'] }}</td>
							<td>{{ $assessment['8-7'] }}</td>
							<td>{{ $assessment['5x8'] }}</td>
							<td>{{ $assessment['1x1'] }}</td>
							<td>{{ $assessment['10/3'] }}</td>
							<td>{{ $assessment['9+8'] }}</td>
							<td>{{ $assessment['3-2'] }}</td>
							<td>{{ $assessment->stay_calm }}</td>
							<td>{{ $assessment->help_others }}</td>
							<td>{{ $assessment->doing_things }}</td>
							<td>{{ $assessment->solving_problems }}</td>
							<td>{{ $assessment->do_not_give_up }}</td>
							<td>{{ $assessment->give_compliments }}</td>
							<td>{{ $assessment->do_the_right_thing }}</td>
							<td>{{ $assessment->making_decisions }}</td>
							<td>{{ $assessment->think_before_i_act }}</td>
							<td>{{ $assessment->leader }}</td>
							<td>{{ $assessment->respect }}</td>
							<td>{{ $assessment->good_decisions }}</td>
							<td>{{ $assessment->honest_person }}</td>
							<td>{{ $assessment->importance_of_learning }}</td>
							<td>{{ $assessment->think_about_problems }}</td>
							<td>{{ $assessment->responsible_person }}</td>
							<td>{{ $assessment->work_through_problems }}</td>
							<td>{{ $assessment->set_goals }}</td>
							<td>{{ $assessment->overcome_a_challenge }}</td>
							<td>{{ $assessment->work_well_with_others }}</td>
							<td>{{ $assessment->half_of_value }}</td>
							<td>{{ $assessment->decimal_numbers_represent }}</td>
							<td>{{ $assessment->nfl_kicker }}</td>
							<td>{{ $assessment->free_throws }}</td>
							<td>{{ $assessment->wnba_free_throws }}</td>
							<td>{{ $assessment->same_shots }}</td>
							<td>{{ $assessment->odds_of_three_point }}</td>
							<td>{{ $assessment->shot_odds }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
  	<div class="col-sm-12">
    	{{ $assessments->links() }}
  	</div>
	</div>
	@endif
</div>
@endsection