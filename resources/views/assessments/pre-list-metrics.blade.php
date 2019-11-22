<div class="sort">
	<h5>Sort Assessments By Field(s):</h5>
	<form action="/admin/preassessment-results/sorted" method="get" class="form-inline sort-users">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="city">School/Program Name</label><br>
			<select name="school_program_name">
				<option value="null"></option>
				<?php
					$used = array();
				?>
				@foreach ($programs as $user)
					@if(!in_array($user->school_program_name, $used))
						<option value="{{ $user->school_program_name }}">{{ $user->school_program_name }}</option>
					<?php 
						$used[] = $user->school_program_name;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="city">State</label><br>
			<select name="state">
				<option value="null"></option>
				<?php
					$used = array();
				?>
				@foreach ($states as $user)
					@if(!in_array($user->state, $used))
						<option value="{{ $user->state }}">{{ $user->state }}</option>
					<?php 
						$used[] = $user->state;	 
					?>
					@endif
				@endforeach
			</select>			
		</div><br>
		<button type="submit" class="btn btn-primary">Sort Assessments</button>
	</form>
	</div>
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
						<tr>
							<td>
								<?php
									$gen = \App\Student::where('gender','=','Male')->count();
								?>
								{{ ($gen > 0) ? (number_format(($gen / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$gen = \App\Student::where('gender','=','Female')->count();
								?>
								{{ ($gen > 0) ? (number_format(($gen / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::where('ethnicity','=','American Indian or Alaskan Native')->count();
								?>
								{{ ($eth > 0) ? (number_format(($eth / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::where('ethnicity','=','Asian, Native Hawaiian, or other Pacific Islander')->count();
								?>
								{{ ($eth > 0) ? (number_format(($eth / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::where('ethnicity','=','Black or African-American')->count();
								?>
								{{ ($eth > 0) ? (number_format(($eth / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::where('ethnicity','=','Hispanic or Latino')->count();
								?>
								{{ ($eth > 0) ? (number_format(($eth / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::where('ethnicity','=','White')->count();
								?>
								{{ ($eth > 0) ? (number_format(($eth / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$eth = \App\Student::where('ethnicity','=','Other')->count();
								?>
								{{ ($eth > 0) ? (number_format(($eth / $students) * 100, 2) . "%") : "0%" }}
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
									$grade = \App\Student::where('grade','=','3 or Under')->count();
								?>
								{{ ($grade > 0) ? (number_format(($grade / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::where('grade','=','4')->count();
								?>
								{{ ($grade > 0) ? (number_format(($grade / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::where('grade','=','5')->count();
								?>
								{{ ($grade > 0) ? (number_format(($grade / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::where('grade','=','6')->count();
								?>
								{{ ($grade > 0) ? (number_format(($grade / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::where('grade','=','7')->count();
								?>
								{{ ($grade > 0) ? (number_format(($grade / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::where('grade','=','8')->count();
								?>
								{{ ($grade > 0) ? (number_format(($grade / $students) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php
									$grade = \App\Student::where('grade','=','9 or Over')->count();
								?>
								{{ ($grade > 0) ? (number_format(($grade / $students) * 100, 2) . "%") : "0%" }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Try Hard</td>
							<td>Complete Assignments</td>
							<td>Scare</td>
							<td>Rarely Use</td>
							<td>Give Up</td>
							<td>Future Work</td>
							<td>Math Related Activities</td>
							<td>Competitive</td>
							<td>Respectful</td>
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
								Steph Curry
							</td>
							<td>
								Dwight Howard
							</td>
							<td>
								Weight
							</td>
							<td>
								Rookie
							</td>
							<td>
								Grid
							</td>
							<td>
								Lebron James
							</td>
							<td>
								Draft
							</td>
							<td>
								Shooting Percentage
							</td>
							<td>
								Missed Shot
							</td>
							<td>
								Circle Graph
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php $t = \App\Preassessment::where("try_hard","=","4")->orWhere("try_hard","=","5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("complete_assignments","=","4")->orWhere("complete_assignments","=","5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("scare","=","1")->orWhere("scare","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("rarely_use","=","1")->orWhere("rarely_use","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("give_up","=","1")->orWhere("give_up","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("future_work","=","4")->orWhere("future_work","=","5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("math_related_activities","=","4")->orWhere("math_related_activities","=","5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("competitive","=","4")->orWhere("competitive","=","5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("respectful","=","4")->orWhere("respectful","=","5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("7+1","=","8")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("6-3","=","3")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("6x6","=","36")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("9/3","=","3")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("7+5","=","13")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("9x0","=","0")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("7x7","=","49")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("7-1","=","6")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("4x5","=","20")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("9/2","=","4.5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("8x7","=","56")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("8-8","=","0")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("5/2","=","2.5")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("7x9","=","63")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("4+3","=","7")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("6+5","=","11")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("9-7","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("2x8","=","16")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("7/1","=","7")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("9-1","=","8")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("6/2","=","3")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("5x2","=","10")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("8/2","=","4")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("3x4","=","12")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("8-7","=","1")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("5x8","=","40")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("1x1","=","1")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("10/3","=","3.3")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("9+8","=","17")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("3-2","=","1")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $assessments->total()) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("steph_curry","=","3")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $lower) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("dwight_howard","=","1")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $lower) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("weight","=","4")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $lower) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("rookie","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $lower) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("grid","=","3")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $lower) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("lebron_james","=","4")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $higher) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("draft","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $higher) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("shooting_percentage","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $higher) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("missed_shot","=","4")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $higher) * 100, 2) . "%") : "0%" }}
							</td>
							<td>
								<?php $t = \App\Preassessment::where("circle_graph","=","2")->count(); ?>
								{{ ($t > 0) ? (number_format(($t / $higher) * 100, 2) . "%") : "0%" }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>