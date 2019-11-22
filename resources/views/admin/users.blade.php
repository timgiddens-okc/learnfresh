@extends("layouts.app")
	
@section("content")

@if(\Auth::user()->isAdmin())
		@include("nav.users")
	@endif

<div class="container">
	
	<div class="page-header">
		<h2>All Users</h2>
		<a href="/admin/get-users" class="btn btn-success btn-sm">Download Spreadsheet</a>
		<a href="/admin/users/email" class="btn btn-success btn-sm">Email Users</a>
	</div>
	<div class="sort">
		<h5>Search Users:</h5>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<form action="/search-users" method="get">
				<div id="query-container"><input type="text" name="query" class="form-control" placeholder="Enter your search term and select where you want to search." /></div><br>
				<div class="row">
				<div class="col-sm-12 col-md-6">
				Search in:
				<select name="location" class="form-control" id="query-select">
					<option value="name">Name</option>
					<option value="email">Email</option>
					<option value="phone">Phone</option>
					<option value="school_program_name">School Program Name</option>
					<option value="site_address_1">Address</option>
					<option value="site_city">City</option>
					<option value="site_state">State</option>
					<option value="site_zip_code">Zipcode</option>
					<option value="country">Country</option>
					<option value="account_level">Tier</option>
					<option value="pre_assessment_complete">Pre-tests</option>
					<option value="post_assessment_complete">Post-tests</option>
					<option value="checkpoint">Checkpoint</option>
					<option value="rsvp">Tournament RSVP</option>
					<option value="team">Team</option>
					<option value="program">Program</option>
					<option value="inactive">Inactive Users</option>
				</select>
				</div>
				<div class="col-sm-12 col-md-6">
				<br>
				<button type="submit" class="btn btn-primary expanded">Search</button>
				</div>
				</div>
				</form>
				<br>
			</div>
		</div>
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
			<div id="users-list">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<td>
								<td>Last Logged In</td>
								<td>Tier</td>
								<td>Current Week</td>
								<td>Tournament RSVP</td>
								<td>Number of Checkpoints Submitted</td>
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
								<td>Paid</td>
								<td>Payment Reminders</td>
								<td>Joined</td>
								<td>General Manager</td>
								<td>Select General Manager</td>
								<td>Edit User</td>
								<td>Impersonate This User</td>
								@if(\Auth::user()->id == 1 || \Auth::user()->id == 2)
								<td class="text-center">Delete User</td>
								@endif
							</tr>
						</thead>
						<tbody>
							<?php $currentCount = 1; ?>
							@foreach ($users as $user)
							<tr>
								<td>{{ $currentCount }}</td>
								<?php 
									$currentCount++; 
								?>
								<td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans() }}</td>
								<td>
									@if($user->account_level == 1)
									  MH
									@else
									  MH+
									@endif
								</td>
								<td>
									<?php
										if($user->pre_assessment_complete == 0){
											echo "Pre";
										} else {
											$current = \App\CompletedWeek::where('user_id',$user->id)->orderBy('created_at','desc')->first();
											if($current){
												if ($current['week_number'] == 12) {
													if($user->post_assessment_complete == 0) {
														echo "Post";
													} else {
														echo "Completed";
													}
												} else {
													echo $current['week_number'] + 1;
												}
											} else {
												echo "1";	
											}
										}
									?>
								</td>
								<td>
									<?php
										$now = Carbon\Carbon::now();
										$rsvpEvents = \App\Rsvp::where("user_id",$user->id)->get();
										$attended = false;
										foreach($rsvpEvents as $rsvp) {
											$event = \App\Event::find($rsvp->event_id);
											if($now < $event->event_date){
												if($attended == false){
												 echo "Yes";
												 $attended = true;
												}
											}
										}
										if($attended == false){
											echo "No";
										}
									?>
								</td>
								<td>
									<?php
										$checkpoints = \App\CheckpointResult::where("user_id",$user->id)->where("created_at",">=",\Carbon\Carbon::parse('2018/08/01')->toDateTimeString())->count();
										echo $checkpoints;
									?>
								</td>
								<td>{{ ucwords($user->name) }}</td>
								<td><a href="/admin/{{ $user->id }}/email">{{ $user->email }}</a></td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->estimated_students }}</td>
								<td>{{ ucwords($user->school_program_name) }}</td>
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
									@if ($user->pre_assessment_complete == 1)
										<a href="/admin/{{ $user->id }}/open-pretest" class="btn btn-success btn-sm">Reopen Pre-test</a>
									@else
										<a href="/admin/{{ $user->id }}/complete-pretest" class="btn btn-success btn-sm">Complete Pre-test</a>
									@endif
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
									@if ($user->post_assessment_complete == 1)
										<a href="/admin/{{ $user->id }}/open-post-test" class="btn btn-success btn-sm">Reopen Post-test</a>
									@else
										<a href="/admin/{{ $user->id }}/complete-post-test" class="btn btn-success btn-sm">Complete Post-test</a>
									@endif
								</td>
								<?php
									$students = array();
									foreach($user->students as $student){
										$students[] = $student->id;
									}
								?>
								<td>{{ \App\Postassessment::whereIn("student_id", $students)->count() }}</td>
								<td>
									@if($user->paid == 0)
										{{ "Pending" }}
										<form action="/user/{{ $user->id }}/bypass-payment" method="post">
											{{ csrf_field() }}
											<input type="submit" value="Paid" class="btn btn-primary btn-sm" />
										</form>
									@elseif($user->paid == 1)
										{{ "Yes" }}
									@elseif($user->paid == 2)
										{{ "N/A" }}
									@endif
								</td>
								<td>{{ $user->payment_reminders }}</td>
								<td>{{ $user->created_at->setTimezone('America/Chicago')->diffForHumans() }}</td>
								@if($user->isSubAdmin())
								<td class="text-center">Yes</td>
								<td>
									N/A
								</td>
								@else
								<td class="text-center">
									<a href="/admin/user/{{ $user->id }}/sub-admin"><i class="fa fa-user-plus"></i></a>
								</td>
								<td class="text-center">			
									@if($user->belongsToSubAdmin())
										{{ $user->getSubAdmin() }}
									@else					
									<form action="/admin/user/{{ $user->id }}/add-to-sub-admin" method="post" class="add-sub-admin">
										{{ csrf_field() }}
										<div class="form-group">
										<select name="admin" class="form-control admin-select">
											@foreach($subs as $s)
											<option value="{{ $s->id }}">{{ $s->name }}</option>
											@endforeach
										</select>
										</div>
										<button type="submit" class="btn btn-primary btn-sm">Add To General Manager</button>
									</form>
									<div class="success-message"></div>
									@endif
								</td>
								@endif
								@if(\Auth::user()->isAdmin())
								<td class="text-center">
									<a href="/admin/user/{{ $user->id }}/edit"><i class="fa fa-pencil"></i></a>
								</td>
								<td class="text-center">
									<a href="/impersonation/{{ $user->id }}"><i class="fa fa-eye"></i></a>
								</td>
								<td class="text-center">
									<a href="/admin/user/{{ $user->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
								</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="row">
			  	<div class="col-sm-12">
			    	{{ $users->links() }}
			  	</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection