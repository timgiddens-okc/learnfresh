@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>{{ $program->school_program_name }}</h2>
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
	<?php
		$sorting = array();
		$sorting[] = ["school_program_name", "=", $program->school_program_name];
	  	
	?>
	<div class="row">
		<div class="col-sm-12">
			<h3>Metrics</h3>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Male</td>
							<td>Female</td>
							<td>American Indian or Alaskan Native</td>
							<td>Asian, Native Hawaiian, or other Pacific Islander</td>
							<td>Black or African-American</td>
							<td>Hispanic or Latino</td>
							<td>White</td>
							<td>Other</td>
						</tr>
					</thead>
					<tbody>
						<?php
							$studentIds = array();
							foreach($all as $assessment){
								$studentIds[] = $assessment->student_id;
							}
							$total = \App\Preassessment::where($sorting)->count();
							$total = \App\Preassessment::where($sorting,["steph_curry","!=",null])->count();
							$total = \App\Preassessment::where($sorting,["lebron_james","!=",null])->count();
							$students = \App\Student::whereIn("id",$studentIds)->count();
						?>
						<tr>
							<td>
								<?php
									$gen = \App\Student::whereIn("id",$studentIds)->where('gender','=','Male')->count();
								?>
								{{ number_format(($gen / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$gen = \App\Student::whereIn("id",$studentIds)->where('gender','=','Female')->count();
								?>
								{{ number_format(($gen / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::whereIn("id",$studentIds)->where('ethnicity','=','American Indian or Alaskan Native')->count();
								?>
								{{ number_format(($eth / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::whereIn("id",$studentIds)->where('ethnicity','=','Asian, Native Hawaiian, or other Pacific Islander')->count();
								?>
								{{ number_format(($eth / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::whereIn("id",$studentIds)->where('ethnicity','=','Black or African-American')->count();
								?>
								{{ number_format(($eth / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::whereIn("id",$studentIds)->where('ethnicity','=','Hispanic or Latino')->count();
								?>
								{{ number_format(($eth / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::whereIn("id",$studentIds)->where('ethnicity','=','White')->count();
								?>
								{{ number_format(($eth / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::whereIn("id",$studentIds)->where('ethnicity','=','Other')->count();
								?>
								{{ number_format(($eth / $students) * 100, 2) . "%" }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>3rd Grade or Under</td>
							<td>4th Grade</td>
							<td>5th Grade</td>
							<td>6th Grade</td>
							<td>7th Grade</td>
							<td>8th Grade</td>
							<td>9th Grade or Over</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php
									$grade = \App\Student::whereIn("id",$studentIds)->where('grade','=','3 or Under')->count();
								?>
								{{ number_format(($grade / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::whereIn("id",$studentIds)->where('grade','=','4')->count();
								?>
								{{ number_format(($grade / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::whereIn("id",$studentIds)->where('grade','=','5')->count();
								?>
								{{ number_format(($grade / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::whereIn("id",$studentIds)->where('grade','=','6')->count();
								?>
								{{ number_format(($grade / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::whereIn("id",$studentIds)->where('grade','=','7')->count();
								?>
								{{ number_format(($grade / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::whereIn("id",$studentIds)->where('grade','=','8')->count();
								?>
								{{ number_format(($grade / $students) * 100, 2) . "%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::whereIn("id",$studentIds)->where('grade','=','9 or Over')->count();
								?>
								{{ number_format(($grade / $students) * 100, 2) . "%" }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
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
								<td>
									Stay Calm
								</td>
																															<td>
									Help Others
								</td>
																															<td>
									Doing Things
								</td>
																															<td>
									Solving Problems
								</td>
																															<td>
									Do Not Give Up
								</td>
																															<td>
									Give Compliments
								</td>
																															<td>
									Do The Right Thing
								</td>
																															<td>
									Making Decisions
								</td>
																															<td>
									Think Before I Act
								</td>
																															<td>
									Leader
								</td>
																															<td>
									Respect
								</td>
																															<td>
									Good Decisions
								</td>
																															<td>
									Honest Person
								</td>
																															<td>
									Importance Of Learning
								</td>
																															<td>
									Think About Problems
								</td>
																															<td>
									Responsible Person
								</td>
																															<td>
									Work Through Problems
								</td>
																															<td>
									Set Goals
								</td>
																															<td>
									Overcome A Challenge
								</td>
																															<td>
									Work Well With Others
								</td>
																															<td>
									Half Of Value
								</td>
																															<td>
									Decimal Numbers Represent
								</td>
																															<td>
									Nfl Kicker
								</td>
																															<td>
									Free Throws
								</td>
																															<td>
									Wnba Free Throws
								</td>
																															<td>
									Same Shots
								</td>
																															<td>
									Odds Of Three Point
								</td>
																															<td>
									Shot Odds
								</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("7+1","=","8")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("6-3","=","3")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("6x6","=","36")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("9/3","=","3")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("7+5","=","13")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("9x0","=","0")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("7x7","=","49")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("7-1","=","6")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("4x5","=","20")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("9/2","=","4.5")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("8x7","=","56")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("8-8","=","0")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("5/2","=","2.5")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("7x9","=","63")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("4+3","=","7")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("6+5","=","11")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("9-7","=","2")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("2x8","=","16")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("7/1","=","7")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("9-1","=","8")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("6/2","=","3")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("5x2","=","10")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("8/2","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("3x4","=","12")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("8-7","=","1")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("5x8","=","40")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("1x1","=","1")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("10/3","=","3.3")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("9+8","=","17")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("3-2","=","1")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("stay_calm","=","3")->orWhere("stay_calm","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("help_others","=","3")->orWhere("help_others","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("doing_things","=","3")->orWhere("doing_things","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("solving_problems","=","3")->orWhere("solving_problems","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("do_not_give_up","=","3")->orWhere("do_not_give_up","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("give_compliments","=","3")->orWhere("give_compliments","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("do_the_right_thing","=","3")->orWhere("do_the_right_thing","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("making_decisions","=","3")->orWhere("making_decisions","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("think_before_i_act","=","3")->orWhere("think_before_i_act","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("leader","=","3")->orWhere("leader","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("respect","=","3")->orWhere("respect","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("good_decisions","=","3")->orWhere("good_decisions","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("honest_person","=","3")->orWhere("honest_person","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("importance_of_learning","=","3")->orWhere("importance_of_learning","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("think_about_problems","=","3")->orWhere("think_about_problems","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("responsible_person","=","3")->orWhere("responsible_person","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("work_through_problems","=","3")->orWhere("work_through_problems","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("set_goals","=","3")->orWhere("set_goals","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("overcome_a_challenge","=","3")->orWhere("overcome_a_challenge","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("work_well_with_others","=","3")->orWhere("work_well_with_others","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("half_of_value","=","3")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("decimal_numbers_represent","=","4")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("nfl_kicker","=","3")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("free_throws","=","5")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("wnba_free_throws","=","2")->count(); ?>
								{{ number_format(($t / $total) * 100, 2) . "%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("same_shots","=","3")->count(); ?>
								@if($t == 0)
								{{ "0%" }}
								@else
								{{ number_format(($t / $total) * 100, 2) . "%" }}
								@endif
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("odds_of_three_point","=","3")->count(); ?>
								@if($t == 0)
								{{ "0%" }}
								@else
								{{ number_format(($t / $total) * 100, 2) . "%" }}
								@endif
							</td>
							<td>
								<?php $t = \App\Preassessment::where($sorting)->where("shot_odds","=","4")->count(); ?>
								@if($t == 0)
								{{ "0%" }}
								@else
								{{ number_format(($t / $total) * 100, 2) . "%" }}
								@endif
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12">
					<h3>Pre-tests</h3>
				</div>
			</div>
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
						@foreach ($pretests as $assessment)
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
			<div class="row">
				<div class="col-sm-12">
					<h3>Post-tests</h3>
				</div>
			</div>
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
						@foreach ($posttests as $assessment)
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
							<td>{{ $assessment->math_hoops_games }}</td>
							<td>{{ $assessment->worksheets }}</td>
							<td>{{ $assessment->math_more_fun }}</td>
							<td>{{ $assessment->confident_after }}</td>
							<td>{{ $assessment->games_completed }}</td>
							<td>{{ $assessment->skills_pieces }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection