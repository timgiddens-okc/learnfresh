@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Pre-Test At A Glance</h2>
		<a href="/admin/preassessment-results" class="btn btn-success btn-sm loader">View Results</a>
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
		<div class="col-sm-8">
			
			<h5>Number Completed</h5>
			<div class="row">
				<div class="col-sm-3">
					<div class="panel panel-default text-center">
						<div class="panel-heading">
							Last 24 hours
						</div>
						<div class="panel-body">
							<h2 style="margin: 0px;">{{ $twentyFourHours }}</h2>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel panel-default text-center">
						<div class="panel-heading">
							Last Week
						</div>
						<div class="panel-body">
							<h2 style="margin: 0px;">{{ $lastWeek }}</h2>
						</div>
						<div class="panel-footer" style="font-size: 0.875em;">
							{{ \Carbon\Carbon::now()->subWeek()->format("m-d-y") }} — {{ \Carbon\Carbon::now()->format("m-d-y") }}
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel panel-default text-center">
						<div class="panel-heading">
							Last 2 Weeks
						</div>
						<div class="panel-body">
							<h2 style="margin: 0px;">{{ $lastTwoWeeks }}</h2>
						</div>
						<div class="panel-footer" style="font-size: 0.875em;">
							{{ \Carbon\Carbon::now()->subDays(14)->format("m-d-y") }} — {{ \Carbon\Carbon::now()->format("m-d-y") }}
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel panel-default text-center">
						<div class="panel-heading">
							Last Month
						</div>
						<div class="panel-body">
							<h2 style="margin: 0px;">{{ $lastMonth }}</h2>
						</div>
						<div class="panel-footer" style="font-size: 0.875em;">
							{{ \Carbon\Carbon::now()->startOfMonth()->format("F") }}
						</div>
					</div>
				</div>
			</div>
			<h5>Attitudinal Questions</h5>
			<table class="table table-bordered">
				<thead>
					<tr>
						<td><strong>Question</strong></td>
						<td><strong>Never</strong></td>
						<td><strong>Sometimes</strong></td>
						<td><strong>Most Of The Time</strong></td>
						<td><strong>Always</strong></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>I stay calm when there is a problem or an argument.</td>
						<td>{{ round((\App\Preassessment::where("stay_calm",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("stay_calm",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("stay_calm",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("stay_calm",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I try to help other people when they need help.</td>
						<td>{{ round((\App\Preassessment::where("help_others",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("help_others",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("help_others",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("help_others",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I like doing things for others.</td>
						<td>{{ round((\App\Preassessment::where("doing_things",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("doing_things",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("doing_things",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("doing_things",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I am good at solving problems.</td>
						<td>{{ round((\App\Preassessment::where("solving_problems",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("solving_problems",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("solving_problems",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("solving_problems",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I do not give up.</td>
						<td>{{ round((\App\Preassessment::where("do_not_give_up",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("do_not_give_up",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("do_not_give_up",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("do_not_give_up",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I give compliments to other people.</td>
						<td>{{ round((\App\Preassessment::where("give_compliments",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("give_compliments",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("give_compliments",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("give_compliments",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I like to do the right thing.</td>
						<td>{{ round((\App\Preassessment::where("do_the_right_thing",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("do_the_right_thing",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("do_the_right_thing",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("do_the_right_thing",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I am good at making decisions.</td>
						<td>{{ round((\App\Preassessment::where("making_decisions",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("making_decisions",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("making_decisions",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("making_decisions",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I think before I act.</td>
						<td>{{ round((\App\Preassessment::where("think_before_i_act",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("think_before_i_act",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("think_before_i_act",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("think_before_i_act",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>Other people see me as a leader.</td>
						<td>{{ round((\App\Preassessment::where("leader",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("leader",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("leader",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("leader",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>Other kids respect me.</td>
						<td>{{ round((\App\Preassessment::where("respect",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("respect",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("respect",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("respect",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I make good decisions.</td>
						<td>{{ round((\App\Preassessment::where("good_decisions",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("good_decisions",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("good_decisions",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("good_decisions",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I am an honest person.</td>
						<td>{{ round((\App\Preassessment::where("honest_person",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("honest_person",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("honest_person",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("honest_person",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I understand the importance of learning.</td>
						<td>{{ round((\App\Preassessment::where("importance_of_learning",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("importance_of_learning",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("importance_of_learning",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("importance_of_learning",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I think about my problems in ways that help.</td>
						<td>{{ round((\App\Preassessment::where("think_about_problems",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("think_about_problems",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("think_about_problems",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("think_about_problems",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I am a responsible person.</td>
						<td>{{ round((\App\Preassessment::where("responsible_person",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("responsible_person",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("responsible_person",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("responsible_person",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I can work through problems with others.</td>
						<td>{{ round((\App\Preassessment::where("work_through_problems",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("work_through_problems",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("work_through_problems",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("work_through_problems",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I know how to set goals for what I want to achieve.</td>
						<td>{{ round((\App\Preassessment::where("set_goals",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("set_goals",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("set_goals",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("set_goals",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I understand how to overcome a challenge.</td>
						<td>{{ round((\App\Preassessment::where("overcome_a_challenge",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("overcome_a_challenge",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("overcome_a_challenge",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("overcome_a_challenge",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
					<tr>
						<td>I work well with other kids on school projects.</td>
						<td>{{ round((\App\Preassessment::where("work_well_with_others",1)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("work_well_with_others",2)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("work_well_with_others",3)->count() / $totalCount)*100,2) }}%</td>
						<td>{{ round((\App\Preassessment::where("work_well_with_others",4)->count() / $totalCount)*100,2) }}%</td>						
					</tr>
					
				</tbody>
			</table>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					Total Number Submitted
				</div>
				<div class="panel-body">
					<h2 style="margin: 0px;">{{ number_format($totalCount) }}</h2>
				</div>
			</div>
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					% of Users Who Submitted
				</div>
				<div class="panel-body">
					<h2 style="margin: 0px;">{{ $percentOfUsers }}%</h2>
				</div>
			</div>
			
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					% of Math Problems Answered Correctly (Timed Section)
				</div>
				<div class="panel-body">
					<h2 style="margin: 0px;">{{ $mathPercentage }}%</h2>
				</div>
			</div>
			
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					% of Math Problems Answered Correctly (Multiple Choice)
				</div>
				<div class="panel-body">
					<h2 style="margin: 0px;">{{ $multiPercentage }}%</h2>
				</div>
			</div>
			
			<h5>Demographic Info</h5>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td><strong>Male</strong></td>
						<td>{{ $male }}%</td>
					</tr>
					<tr>
						<td><strong>Female</strong></td>
						<td>{{ $female }}%</td>
					</tr>
				</tbody>
			</table>
			
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td><strong>American Indian or Alaskan Native	</strong></td>
						<td>{{ $native }}%</td>
					</tr>
					<tr>
						<td><strong>Asian, Native Hawaiian, or other Pacific Islander	</strong></td>
						<td>{{ $pacificIslander }}%</td>
					</tr>
					<tr>
						<td><strong>Black or African-American</strong></td>
						<td>{{ $black }}%</td>
					</tr>
					<tr>
						<td><strong>Hispanic or Latino</strong></td>
						<td>{{ $hispanic }}%</td>
					</tr>
					<tr>
						<td><strong>White</strong></td>
						<td>{{ $white }}%</td>
					</tr>
					<tr>
						<td><strong>Other</strong></td>
						<td>{{ $other }}%</td>
					</tr>
				</tbody>
			</table>
			
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td><strong>Third Grade or Under</strong></td>
						<td>{{ $third }}%</td>
					</tr>
					<tr>
						<td><strong>Fourth Grade</strong></td>
						<td>{{ $fourth }}%</td>
					</tr>
					<tr>
						<td><strong>Fifth Grade</strong></td>
						<td>{{ $fifth }}%</td>
					</tr>
					<tr>
						<td><strong>Sixth Grade</strong></td>
						<td>{{ $sixth }}%</td>
					</tr>
					<tr>
						<td><strong>Seventh Grade</strong></td>
						<td>{{ $seventh }}%</td>
					</tr>
					<tr>
						<td><strong>Eighth Grade</strong></td>
						<td>{{ $eighth }}%</td>
					</tr>
					<tr>
						<td><strong>Ninth Grade or Over</strong></td>
						<td>{{ $ninth }}%</td>
					</tr>
				</tbody>
			</table>
						
		</div>
	</div>
</div>
@endsection