@extends("layouts.app")
	
@section("content")

<div class="national-championship-nav">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<a href="/my-class">My Class</a>
				<a href="/pretest">Pre-Test</a>
				<a href="/posttest">Post-Test</a>
			</div>
		</div>
	</div>
</div>

<div class="container">
	
	<div class="page-header">
		<h2>Pre-Test</h2>
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
	@if(\Auth::user()->pre_assessment_complete == 0)
	<div class="row">
		<div class="col-sm-6">
			<p style="font-size: 0.9em;">In order to receive games and get started with the season, please have all participating students take the NBA Math Hoops pre-test! This will allow us to evaluate the effectiveness of our work throughout the season, and also ensure that we ship the correct number of games for your program or classroom. One game will be shipped for every four students who have taken the assessment, as soon as you press the "Complete Pretest" button!</p>
						
			<p style="font-size: 0.9em;">
				<a href="{{ ($app == "production") ? secure_asset("/assessments/learn-fresh-pre-test.pdf") : asset("/assessments/learn-fresh-pre-test.pdf") }}" target="_blank">Printable Pretest</a>
			</p>
			
			<div class="address-container">
				{{ \Auth::user()->shipping_address_1 }}<br>
				{{ \Auth::user()->shipping_city }}, {{ \Auth::user()->shipping_state }} {{ \Auth::user()->shipping_zip_code }}
			</div>
		</div>
		<div class="col-sm-6">
			<a href="{{ ($app == "production") ? secure_url("/assessment/" . Auth::user()->id)  : url("/assessment/" . Auth::user()->id)  }}" class="btn btn-primary expanded take-pretest">Take Pretest</a><br><br>
						<a href="/assessment/submit" class="btn btn-primary expanded">Submit All Pretests</a>
		</div>
	</div>
	@endif
	<div class="row">
			<div class="col-sm-12">
				<h5>Pre-tests</h5>
				@if (count($students))
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
								@if(!\Session::has('original_user'))
									<td>Student Name</td>
								@else
									<td>Student ID</td>
								@endif
									<td>
									Nba Champion
								</td> 
								<td>
								7+1
							</td>
							<td>
								6-3
							</td>
							<td>
								6x6
							</td>
							<td>
								9/3
							</td>
							<td>
								7+5
							</td>
							<td>
								9x0
							</td>
							<td>
								7x7
							</td>
							<td>
								7-1
							</td>
							<td>
								4x5
							</td>
							<td>
								9/2
							</td>
							<td>
								8x7
							</td>
							<td>
								8-8
							</td>
							<td>
								5/2
							</td>
							<td>
								7x9
							</td>
							<td>
								4+3
							</td>
							<td>
								6+5
							</td>
							<td>
								9-7
							</td>
							<td>
								2x8
							</td>
							<td>
								7/1
							</td>
							<td>
								9-1
							</td>
							<td>
								6/2
							</td>
							<td>
								5x2
							</td>
							<td>
								8/2
							</td>
							<td>
								3x4
							</td>
							<td>
								8-7
							</td>
							<td>
								5x8
							</td>
							<td>
								1x1
							</td>
							<td>
								10/3
							</td>
							<td>
								9+8
							</td>
							<td>
								3-2
							</td>
							<td>Stay Calm</td>
							<td>Help Others</td>
							<td>Doing Things</td>
							<td>Solving Problems</td>
							<td>Do Not Give Up</td>
							<td>Give Compliments</td>
							<td>Do The Right Thing</td>
							<td>Making Decisions</td>
							<td>Think Before I Act</td>
							<td>Leader</td>
							<td>Respect</td>
							<td>Good Decisions</td>
							<td>Honest Person</td>
							<td>Importance Of Learning</td>
							<td>Think About Problems</td>
							<td>Responsible Person</td>
							<td>Work Through Problems</td>
							<td>Set Goals</td>
							<td>Overcome A Challenge</td>
							<td>Work Well With Others</td>
							<td>Half Of Value</td>
							<td>Decimal Numbers Represent</td>
							<td>NFL Kicker</td>
							<td>Free Throws</td>
							<td>WNBA Free Throws</td>
							<td>Same Shots</td>
							<td>Odds Of Three Point</td>
							<td>Shot Odds</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($students as $s)
									<?php 
										$results = \App\Preassessment::where('student_id',$s->id)->get()->toArray(); 
									?>
									<?php 
										if(!$results) 
											continue;
									?>
									<?php $results = $results[0]; ?>
								<tr>
									@if(!\Session::has('original_user'))
									<td>
										{{ $s->name }} 
										<a href="/student/{{ $s->id }}/edit"><i class="fa fa-pencil"></i></a>
										<a href="/student/{{ $s->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
									</td>
									@else
									<td>
										{{ $s->id }}
									</td>
									@endif
									<td>{{ $results['nba_champion'] }}</td>
									<td>{{ $results['7+1'] }}</td>
									<td>{{ $results['6-3'] }}</td>
									<td>{{ $results['6x6'] }}</td>
									<td>{{ $results['9/3'] }}</td>
									<td>{{ $results['7+5'] }}</td>
									<td>{{ $results['9x0'] }}</td>
									<td>{{ $results['7x7'] }}</td>
									<td>{{ $results['7-1'] }}</td>
									<td>{{ $results['4x5'] }}</td>
									<td>{{ $results['9/2'] }}</td>
									<td>{{ $results['8x7'] }}</td>
									<td>{{ $results['8-8'] }}</td>
									<td>{{ $results['5/2'] }}</td>
									<td>{{ $results['7x9'] }}</td>
									<td>{{ $results['4+3'] }}</td>
									<td>{{ $results['6+5'] }}</td>
									<td>{{ $results['9-7'] }}</td>
									<td>{{ $results['2x8'] }}</td>
									<td>{{ $results['7/1'] }}</td>
									<td>{{ $results['9-1'] }}</td>
									<td>{{ $results['6/2'] }}</td>
									<td>{{ $results['5x2'] }}</td>
									<td>{{ $results['8/2'] }}</td>
									<td>{{ $results['3x4'] }}</td>
									<td>{{ $results['8-7'] }}</td>
									<td>{{ $results['5x8'] }}</td>
									<td>{{ $results['1x1'] }}</td>
									<td>{{ $results['10/3'] }}</td>
									<td>{{ $results['9+8'] }}</td>
									<td>{{ $results['3-2'] }}</td>
									<td>{{ $results['stay_calm'] }}</td>
									<td>{{ $results['help_others'] }}</td>
									<td>{{ $results['doing_things'] }}</td>
									<td>{{ $results['solving_problems'] }}</td>
									<td>{{ $results['do_not_give_up'] }}</td>
									<td>{{ $results['give_compliments'] }}</td>
									<td>{{ $results['do_the_right_thing'] }}</td>
									<td>{{ $results['making_decisions'] }}</td>
									<td>{{ $results['think_before_i_act'] }}</td>
									<td>{{ $results['leader'] }}</td>
									<td>{{ $results['respect'] }}</td>
									<td>{{ $results['good_decisions'] }}</td>
									<td>{{ $results['honest_person'] }}</td>
									<td>{{ $results['importance_of_learning'] }}</td>
									<td>{{ $results['think_about_problems'] }}</td>
									<td>{{ $results['responsible_person'] }}</td>
									<td>{{ $results['work_through_problems'] }}</td>
									<td>{{ $results['set_goals'] }}</td>
									<td>{{ $results['overcome_a_challenge'] }}</td>
									<td>{{ $results['work_well_with_others'] }}</td>
									<td>{{ $results['half_of_value'] }}</td>
									<td>{{ $results['decimal_numbers_represent'] }}</td>
									<td>{{ $results['nfl_kicker'] }}</td>
									<td>{{ $results['free_throws'] }}</td>
									<td>{{ $results['wnba_free_throws'] }}</td>
									<td>{{ $results['same_shots'] }}</td>
									<td>{{ $results['odds_of_three_point'] }}</td>
									<td>{{ $results['shot_odds'] }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
				  <p>No students added. Please have your students take the pre-test to log them here.</p>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection