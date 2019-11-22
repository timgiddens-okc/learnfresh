@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Checkpoints</h2>
		<a href="/admin/checkpoints/archive" class="btn btn-success btn-sm">Archive Results</a>
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
		@if(count($checkpoint) == 0)
			<h4>Open New Checkpoint</h4>
			<p>Select which fields will be displayed.</p>
			<form action="/admin/checkpoints/new" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="since_date">Data Since This Date (or Week):</label>
					<input type="text" name="since_date" class="form-control" style="max-width: 200px;" placeholder="Week or Specific Date" />
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="studentsParticipating" value="1" />  Number of students participating
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="gamesPerStudent" value="1" />  Average number of games played per student
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="curriculumPerStudent" value="1" />  Average number of curriculum pieces completed per student
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="sportsmanshipPointsPerStudent" value="1" />  Average number of sportsmanship points earned per student
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="gamesPlayed" value="1" />  Total number of games played
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="curriculumCompleted" value="1" />  Total number of curriculum pieces completed
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="sportsmanshipPoints" value="1" />  Total number of sportsmanship points earned
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="studentsEligible" value="1" />  Number of students eligible to apply for the National Championship (25 games played + 10 curriculum pieces completed)
					</label>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Open Checkpoint" />
				</div>
			</form>
		@else
			<div class="row">
				<div class="col-sm-12">
					<h3>Data Since {{ $checkpoint->since_date }}</h3>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Educator Name</td>
							<td>Educator Email</td>
							<td>School/Program Name</td>
							<td>Site Address</td>
							<td>Shipping Address</td>
							<td>Billing Address</td>
							<td>Number of estimated students</td>
							<td>Number of pre-tests completed</td>
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
						<?php $thisUser = \App\User::find($a->user_id); ?>
						<tr>
							<td>
								{{ $thisUser['name'] }}
							</td>
							<td>
								{{ $thisUser['email'] }}
							</td>
							<td>
								{{ $thisUser['school_program_name'] }}
							</td>
							<td>
								@if($thisUser['site_address_1'])
									{{ $thisUser['site_address_1'] }}<br>{{ ($thisUser['site_address_2']) ? $thisUser['site_address_2'] . "\n" : "" }}{{ $thisUser['site_city'] }}, {{ $thisUser['site_state'] }} {{ $thisUser['site_zip_code'] }}
								@endif
							</td>
							<td>
								@if($thisUser['shipping_address_1'])
									{{ $thisUser['shipping_address_1'] }}<br>{{ ($thisUser['shipping_address_2']) ? $thisUser['shipping_address_2'] . "\n" : "" }}{{ $thisUser['shipping_city'] }}, {{ $thisUser['shipping_state'] }} {{ $thisUser['shipping_zip_code'] }}
								@endif
							</td>
							<td>
								@if($thisUser['billing_address_1'])
									{{ $thisUser['billing_address_1'] }}<br>{{ ($thisUser['billing_address_2']) ? $thisUser['billing_address_2'] . "\n" : "" }}{{ $thisUser['billing_city'] }}, {{ $thisUser['billing_state'] }} {{ $thisUser['billing_zip_code'] }}
								@else
									N/A
								@endif
							</td>
							<td>{{ $thisUser['estimated_students'] }}</td>
							<?php
								$students = array();
								foreach($thisUser['students'] as $student){
									$students[] = $student->id;
								}
							?>
							<td>{{ \App\Preassessment::whereIn("student_id", $students)->count() }}</td>
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
		@endif
		</div>
	</div>
	<div class="page-header">
		<h2>Saved Checkpoint Results</h2>
		<div class="list-group">
		@if(isset($saved))
			@foreach ($saved as $t)
			<a href="{{ secure_url($t->file) }}" class="list-group-item"><span class="glyphicon glyphicon-open-file"></span> Archived on {{ $t->created_at->format('M d, Y') }}</a>
			@endforeach
		@endif
		</div>
	</div>
</div>
@endsection