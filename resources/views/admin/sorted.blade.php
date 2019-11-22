@extends("layouts.app")
	
@section("content")

@if(\Auth::user()->isAdmin())
	@include("nav.users")
@endif

<div class="container">
	<div class="page-header">
		<h2>All Users</h2>
		<form action="/admin/get-sorted-users" method="post" style="display: inline-block;">
			{{ csrf_field() }}
			<input type="hidden" name="city" value="{{ $_GET['city'] }}" />
			<input type="hidden" name="state" value="{{ $_GET['state'] }}" />
			<input type="hidden" name="zip" value="{{ $_GET['zip'] }}" />
			<input type="hidden" name="country" value="{{ $_GET['country'] }}" />
			<input type="hidden" name="team" value="{{ $_GET['team'] }}" />
			<input type="hidden" name="paid" value="{{ $_GET['paid'] }}" />
			<input type="hidden" name="first_year" value="{{ $_GET['first_year'] }}" />
			<input type="hidden" name="pre_assessment_complete" value="{{ $_GET['pre_assessment_complete'] }}" />
			<input type="hidden" name="post_assessment_complete" value="{{ $_GET['post_assessment_complete'] }}" />
			<input type="hidden" name="payment_reminders" value="{{ $_GET['payment_reminders'] }}" />
			<input type="hidden" name="program" value="{{ $_GET['program'] }}" />
			<button class="btn btn-success btn-sm">Download Spreadsheet</button>
		</form>
		<a href="/admin/users/email" class="btn btn-success btn-sm">Email Users</a>
		<a href="/admin/users" class="btn btn-success btn-sm">All Users</a>
	</div>
	<div class="sort">
	<h5>Show Users By Field(s):</h5>
	<form action="/admin/users/sorted" method="get" class="form-inline sort-users">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="week">Current Week</label><br>
			<select name="currentWeek">
				<option value="null"></option>
				<option {{ ("pre" == $_GET['currentWeek']) ? "selected" : "" }} value="pre">Pre-test</option>
				<option {{ ("1" == $_GET['currentWeek']) ? "selected" : "" }} value="1">Week 1</option>
				<option {{ ("2" == $_GET['currentWeek']) ? "selected" : "" }} value="2">Week 2</option>
				<option {{ ("3" == $_GET['currentWeek']) ? "selected" : "" }} value="3">Week 3</option>
				<option {{ ("4" == $_GET['currentWeek']) ? "selected" : "" }} value="4">Week 4</option>
				<option {{ ("5" == $_GET['currentWeek']) ? "selected" : "" }} value="5">Week 5</option>
				<option {{ ("6" == $_GET['currentWeek']) ? "selected" : "" }} value="6">Week 6</option>
				<option {{ ("7" == $_GET['currentWeek']) ? "selected" : "" }} value="7">Week 7</option>
				<option {{ ("8" == $_GET['currentWeek']) ? "selected" : "" }} value="8">Week 8</option>
				<option {{ ("9" == $_GET['currentWeek']) ? "selected" : "" }} value="9">Week 9</option>
				<option {{ ("10" == $_GET['currentWeek']) ? "selected" : "" }} value="10">Week 10</option>
				<option {{ ("11" == $_GET['currentWeek']) ? "selected" : "" }} value="11">Week 11</option>
				<option {{ ("12" == $_GET['currentWeek']) ? "selected" : "" }} value="12">Week 12</option>
				<option {{ ("post" == $_GET['currentWeek']) ? "selected" : "" }} value="post">Post-test</option>
				<option {{ ("completed" == $_GET['currentWeek']) ? "selected" : "" }} value="completed">Completed</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="city">City</label><br>
			<select name="city">
				<option value="null"></option>
				<?php
					$used = array();
					$cities = \App\User::orderBy('shipping_city')->get();
				?>
				@foreach ($cities as $user)
					@if(!in_array($user->shipping_city, $used))
						<option value="{{ $user->shipping_city }}" {{ ($user->shipping_city == $_GET['city']) ? "selected" : "" }}>{{ $user->shipping_city }}</option>
					<?php 
						$used[] = $user->shipping_city;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="state">State</label><br>
			<select name="state">
				<option value="null"></option>
				<?php
					$used = array();
					$states = \App\User::orderBy('shipping_state')->get();
				?>
				@foreach ($states as $user)
					@if(!in_array($user->shipping_state, $used))
						<option value="{{ $user->shipping_state }}" {{ ($user->shipping_state == $_GET['state']) ? "selected" : "" }}>{{ $user->shipping_state }}</option>
					<?php 
						$used[] = $user->shipping_state;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="zip">Zip Code</label><br>
			<select name="zip">
				<option value="null"></option>
				<?php
					$used = array();
					$zips = \App\User::orderBy('shipping_zip_code')->get();
				?>
				@foreach ($zips as $user)
					@if(!in_array($user->shipping_zip_code, $used))
						<option value="{{ $user->shipping_zip_code }}" {{ ($user->shipping_zip_code == $_GET['zip']) ? "selected" : "" }}>{{ $user->shipping_zip_code }}</option>
					<?php 
						$used[] = $user->shipping_zip_code;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="country">Country</label><br>
			<select name="country">
				<option value="null"></option>
				<?php
					$used = array();
					$countries = \App\User::orderBy('country')->get();
				?>
				@foreach ($countries as $user)
					@if(!in_array($user->country, $used))
						<option value="{{ $user->country }}">{{ $user->country }}</option>
					<?php 
						$used[] = $user->country;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="team">Favorite Team</label><br>
			<select name="team">
				<option value="null"></option>
				<?php
					$used = array();
					$teams = \App\User::orderBy('favorite_team')->get();
				?>
				@foreach ($teams as $user)
					@if(!in_array($user->favorite_team, $used))
						<option value="{{ $user->favorite_team }}" {{ ($user->favorite_team == $_GET['team']) ? "selected" : "" }}>{{ $user->favorite_team }}</option>
					<?php 
						$used[] = $user->favorite_team;	 
					?>
					@endif
				@endforeach
			</select>			
		</div>
		<div class="form-group">
			<label for="city">Paid</label><br>
			<select name="paid">
				<option value="null"></option>
				<option value="1" {{ ($_GET['paid'] == "1") ? "selected" : "" }}>Yes</option>
				<option value="0" {{ ($_GET['paid'] == "0") ? "selected" : "" }}>Pending</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="city">First Year?</label><br>
			<select name="first_year">
				<option value="null"></option>
				<option value="1" {{ ($_GET['first_year'] == "1") ? "selected" : "" }}>Yes</option>
				<option value="0" {{ ($_GET['first_year'] == "0") ? "selected" : "" }}>No</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="pre_assessment_complete">Pretest Complete</label><br>
			<select name="pre_assessment_complete">
				<option value="null"></option>
				<option value="1" {{ ($_GET['pre_assessment_complete'] == "1") ? "selected" : "" }}>Yes</option>
				<option value="0" {{ ($_GET['pre_assessment_complete'] == "0") ? "selected" : "" }}>No</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="post_assessment_complete">Posttest Complete</label><br>
			<select name="post_assessment_complete">
				<option value="null"></option>
				<option value="1" {{ ($_GET['post_assessment_complete'] == "1") ? "selected" : "" }}>Yes</option>
				<option value="0" {{ ($_GET['post_assessment_complete'] == "0") ? "selected" : "" }}>No</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="payment_reminders">Payment Reminders</label><br>
			<select name="payment_reminders">
				<option value="null"></option>
				<option value="0" {{ ($_GET['payment_reminders'] == "0") ? "selected" : "" }}>0</option>
				<option value="1" {{ ($_GET['payment_reminders'] == "1") ? "selected" : "" }}>1</option>
				<option value="2" {{ ($_GET['payment_reminders'] == "2") ? "selected" : "" }}>2</option>
				<option value="3" {{ ($_GET['payment_reminders'] == "3") ? "selected" : "" }}>3</option>
				<option value="4" {{ ($_GET['payment_reminders'] == "4") ? "selected" : "" }}>4</option>
			</select>			
		</div>
		<div class="form-group">
			<label for="city">Program</label><br>
			<select name="program">
				<option value="null"></option>
				@foreach (\App\Program::all() as $program)
				<option value="{{ $program->id }}" {{ ($_GET['program'] == $program->id) ? "selected" : "" }}>{{ $program->title }}</option>
				@endforeach
			</select>			
		</div><br>
		<button type="submit" class="btn btn-primary">Sort Users</button>
	</form>
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
			<h4>{{ $users->count() }} Results</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
								<td>Last Logged In</td>
								<td>Tier</td>
								<td>Current Week</td>
								<td>Tournament RSVP</td>
								<td>Checkpoint Submitted</td>
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
								@if(\Auth::user()->id == 1 || \Auth::user()->id == 2)
								<td class="text-center">Delete User</td>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans() }}</td>
								<td>
									@if($user-account_level == 1)
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
											if($current)
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
										$checkpoints = \App\CheckpointResult::where("user_id",$user->id)->where("archived",0)->get();
										if(count($checkpoints) > 0){
											echo "Yes";
										} else {
											echo "No";
										}
									?>
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
									@if ($user->pre_assessment_complete == 1)
										<a href="/admin/{{ $user->id }}/open-pretest" class="btn btn-success btn-sm">Reopen Pre-test</a>
									@else
										<a href="/admin/{{ $user->id }}/complete-pretest" class="btn btn-success btn-sm">Complete Pre-test</a>
									@endif
								</td>
								<td>{{ $user->students->count() }}</td>
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
									<a href="/admin/user/{{ $user->id }}/delete" class="delete"><i class="fa fa-minus-circle"></i></a>
								</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
  	<div class="col-sm-12">
    	{{ $users->appends($_GET)->links() }}
  	</div>
	</div>
	<div class="page-header">
		<h2>Email Users</h2>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
			<form action="" method="post">
				{{ csrf_field() }}
			
				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" id="subject" name="subject" class="form-control" />
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea name="message" id="message" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success expanded" value="Send Email" />
				</div>
			</form>
		</div>
	</div>
</div>
@endsection