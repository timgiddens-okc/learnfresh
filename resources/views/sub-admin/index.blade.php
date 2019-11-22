@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-8">
			<div class="row">
				<div class="col-sm-12">
					@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			      @if(Session::has('alert-' . $msg))
			      <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
			      @endif
			    @endforeach
				</div>
			</div>
			<div class="page-header">
				<h1>Sites</h1>
			</div>
			<div class="list-group">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<td>Last Logged In</td>
								<td>Tier</td>
								<td>Name</td>
								<td>Email</td>
								<td>Phone</td>
								<td>Estimated Students</td>
								<td>School Program Name</td>
								<td>Funded Region?</td>
								<td>Site Address</td>
								<td>Shipping Address</td>
								<td>Billing Address</td>
								<td>Country</td>
								<td>Programs</td>
								<td>Pre-test Complete</td>
								<td># of Pre-tests Completed</td>
								<td>Post-test Complete</td>
								<td># of Post-tests Complete</td>
								<td>Joined</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($sites as $user)
							<tr>
								<td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans() }}</td>
								<td>
									@if($user->account_level == 1)
										MH
									@else
										MH+
									@endif
								</td>
								<td>{{ $user->name }}</td>
								<td><a href="/admin/{{ $user->id }}/email">{{ $user->email }}</a></td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->estimated_students }}</td>
								<td>{{ $user->school_program_name }}</td>
								<td>
									@if($user->funded == 1)
										Yes
									@else
										No
									@endif
								</td>
								<td>
									@if($user->site_address_1)
										{{ $user->site_address_1 }}<br>{{ ($user->site_address_2) ? $user->site_address_2 . "\n" : "" }}{{ $user->site_city }}, {{ $user->site_state }} {{ $user->site_zip_code }}
									@endif
								</td>
								<td>
									@if($user->shipping_address_1)
										{{ $user->shipping_address_1 }}<br>{{ ($user->shipping_address_2) ? $user->shipping_address_2 . "\n" : "" }}{{ $user->shipping_city }}, {{ $user->shipping_state }} {{ $user->shipping_zip_code }}
									@endif
								</td>
								<td>
									@if($user->billing_address_1)
										{{ $user->billing_address_1 }}<br>{{ ($user->billing_address_2) ? $user->billing_address_2 . "\n" : "" }}{{ $user->billing_city }}, {{ $user->billing_state }} {{ $user->billing_zip_code }}
									@else
										N/A
									@endif
								</td>
								<td>{{ $user->country }}</td>
								<td>
									<?php
										$programs = explode(",",$user->programs);		
										$max = count($programs);
										$count = 0;						
									?>
									@foreach ($programs as $key => $id)
										<?php
											$thisProgram = \App\Program::where("id","=",$id)->first();
											echo $thisProgram['title'];
											$count++;
											if ($count < $max){
												echo ",<br>";
											}
										?>
									@endforeach
								</td>
								<td>
									{{ ($user->pre_assessment_complete == 0) ? "No" : "Yes" }}
							
								</td>
								<?php
									$students = array();
									foreach($user->students as $student){
										$students[] = $student->id;
									}
								?>
								<td>{{ \App\Preassessment::whereIn("student_id", $students)->count() }}</td>
								<td>
									{{ ($user->post_assessment_complete == 0) ? "No" : "Yes" }}
																	</td>
								<?php
									$students = array();
									foreach($user->students as $student){
										$students[] = $student->id;
									}
								?>
								<td>{{ \App\Postassessment::whereIn("student_id", $students)->count() }}</td>
								<td>{{ $user->created_at->setTimezone('America/Chicago')->diffForHumans() }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-4">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Checkpoints
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<a href="/general-manager/checkpoints" class="btn btn-primary expanded">View Checkpoint Data</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					Assessments
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<a href="/general-manager/preassessment-results" class="btn btn-primary expanded" style="margin-bottom: 10px;">View Preassessment Results</a>
							<a href="/general-manager/postassessment-results" class="btn btn-primary expanded">View Postassessment Results</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection