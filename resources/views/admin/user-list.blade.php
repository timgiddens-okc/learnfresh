@extends("layouts.app")
	
@section("content")
<div class="container">
	<div class="page-header">
		<h2>Users</h2>
		<form action="/admin/get-sorted-users" method="post" style="display: inline-block;">
			{{ csrf_field() }}
			<input type="hidden" name="location" value="{{ $_GET['location'] }}" />
			<input type="hidden" name="query" value="{{ $_GET['query'] }}" />
			<button class="btn btn-success btn-sm">Download Spreadsheet</button>
		</form>
		<form action="/admin/email-specific-users" method="get" style="display: inline-block;">

			<input type="hidden" name="location" value="{{ $_GET['location'] }}" />
			<input type="hidden" name="query" value="{{ $_GET['query'] }}" />
			<button class="btn btn-success btn-sm">Email Users</button>
		</form>
		<a href="/admin/users" class="btn btn-primary btn-sm">All Users</a>
	</div>
	<div class="sort">
		<h5>Search Users:</h5>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<form action="/search-users" method="get">
				<div id="query-container">
				@if($_GET['location'] == 'account_level')
					<select name='query' class='form-control'>
						<option {{ ($_GET['query'] == '1') ? "selected" : "" }} value='bronze'>Math Hoops</option>
						<option {{ ($_GET['query'] == '2') ? "selected" : "" }} value='silver'>Math Hoops +</option>
					</select>
				@elseif($_GET['location'] == 'pre_assessment_complete')
					<select name='query' class='form-control'>
						<option {{ ($_GET['query'] == '0') ? "selected" : "" }} value='0'>Not Complete</option>
						<option {{ ($_GET['query'] == '1') ? "selected" : "" }} value='1'>Complete</option>
					</select>
				@elseif($_GET['location'] == 'post_assessment_complete')
					<select name='query' class='form-control'>
						<option {{ ($_GET['query'] == '0') ? "selected" : "" }} value='0'>Not Complete</option>
						<option {{ ($_GET['query'] == '1') ? "selected" : "" }} value='1'>Complete</option>
					</select>
				@elseif($_GET['location'] == 'checkpoint')
					<select name='query' class='form-control'>
						<option {{ ($_GET['query'] == 'not-submitted') ? "selected" : "" }} value='not-submitted'>Not Submitted</option>
						<option {{ ($_GET['query'] == 'submitted') ? "selected" : "" }} value='submitted'>Submitted</option>
					</select>
				@elseif($_GET['location'] == 'rsvp')
					<select name='query' class='form-control'>
						<option {{ ($_GET['query'] == 'no-rsvp') ? "selected" : "" }} value='no-rsvp'>No RSVP</option>
						<option {{ ($_GET['query'] == 'rsvp') ? "selected" : "" }} value='rsvp'>RSVP</option>
					</select>
				@elseif($_GET['location'] == 'inactive')
					<select name='query' class='form-control'>
						<option value='all' {{ ($_GET['query'] == 'all') ? "selected" : "" }}>Hasn't Logged In This Season</option>
						<option value='no-tier' {{ ($_GET['query'] == 'no-tier') ? "selected" : "" }}>No Tier Selected</option>
					</select>			
				@elseif($_GET['location'] == 'team')
					<select name='query' class='form-control'>
						<option {{ ($_GET['query'] == 'oakland-as') ? "selected" : "" }} value="oakland-as">Oakland A's</option>
						<option {{ ($_GET['query'] == 'atl') ? "selected" : "" }} value="atl">Atlanta Hawks</option>
						<option {{ ($_GET['query'] == 'bkn') ? "selected" : "" }} value="bkn">Brooklyn Nets</option>
						<option {{ ($_GET['query'] == 'bos') ? "selected" : "" }} value="bos">Boston Celtics</option>
						<option {{ ($_GET['query'] == 'cha') ? "selected" : "" }} value="cha">Charlotte Hornets</option>
						<option {{ ($_GET['query'] == 'chi') ? "selected" : "" }} value="chi">Chicago Bulls</option>
						<option {{ ($_GET['query'] == 'cle') ? "selected" : "" }} value="cle">Cleveland Cavaliers</option>
						<option {{ ($_GET['query'] == 'dal') ? "selected" : "" }} value="dal">Dallas Mavericks</option>
						<option {{ ($_GET['query'] == 'den') ? "selected" : "" }} value="den">Denver Nuggets</option>
						<option {{ ($_GET['query'] == 'det') ? "selected" : "" }} value="det">Detroit Pistons</option>
						<option {{ ($_GET['query'] == 'gsw') ? "selected" : "" }} value="gsw">Golden State Warriors</option>
						<option {{ ($_GET['query'] == 'hou') ? "selected" : "" }} value="hou">Houston Rockets</option>
						<option {{ ($_GET['query'] == 'ind') ? "selected" : "" }} value="ind">Indiana Pacers</option>
						<option {{ ($_GET['query'] == 'lac') ? "selected" : "" }} value="lac">Los Angeles Clippers</option>
						<option {{ ($_GET['query'] == 'lal') ? "selected" : "" }} value="lal">Los Angeles Lakers</option>
						<option {{ ($_GET['query'] == 'mem') ? "selected" : "" }} value="mem">Memphis Grizzlies</option>
						<option {{ ($_GET['query'] == 'mia') ? "selected" : "" }} value="mia">Miami Heat</option>
						<option {{ ($_GET['query'] == 'mil') ? "selected" : "" }} value="mil">Milwakee Bucks</option>
						<option {{ ($_GET['query'] == 'min') ? "selected" : "" }} value="min">Minessota Timberwolves</option>
						<option {{ ($_GET['query'] == 'nop') ? "selected" : "" }} value="nop">New Orleans Pelicans</option>
						<option {{ ($_GET['query'] == 'nyk') ? "selected" : "" }} value="nyk">New York Knicks</option>
						<option {{ ($_GET['query'] == 'okc') ? "selected" : "" }} value="okc">Oklahoma City Thunder</option>
						<option {{ ($_GET['query'] == 'orl') ? "selected" : "" }} value="orl">Orlando Magic</option>
						<option {{ ($_GET['query'] == 'phi') ? "selected" : "" }} value="phi">Philadelphia 76ers</option>
						<option {{ ($_GET['query'] == 'phx') ? "selected" : "" }} value="phx">Phoenix Suns</option>
						<option {{ ($_GET['query'] == 'por') ? "selected" : "" }} value="por">Portland Trailblazers</option>
						<option {{ ($_GET['query'] == 'sac') ? "selected" : "" }} value="sac">Sacramento Kings</option>
						<option {{ ($_GET['query'] == 'sas') ? "selected" : "" }} value="sas">San Antonio Spurs</option>
						<option {{ ($_GET['query'] == 'tor') ? "selected" : "" }} value="tor">Toronto Raptors</option>
						<option {{ ($_GET['query'] == 'uta') ? "selected" : "" }} value="uta">Utah Jazz</option>
						<option {{ ($_GET['query'] == 'was') ? "selected" : "" }} value="was">Washington Wizards</option>
						<option {{ ($_GET['query'] == 'null') ? "selected" : "" }} value="null"></option>
						<option {{ ($_GET['query'] == 'wnba_atl') ? "selected" : "" }} value="wnba_atl">Atlanta Dream</option>
						<option {{ ($_GET['query'] == 'wnba_chi') ? "selected" : "" }} value="wnba_chi">Chicago Sky</option>
						<option {{ ($_GET['query'] == 'wnba_con') ? "selected" : "" }} value="wnba_con">Connecticut Sun</option>
						<option {{ ($_GET['query'] == 'wnba_dal') ? "selected" : "" }} value="wnba_dal">Dallas Wings</option>
						<option {{ ($_GET['query'] == 'wnba_ind') ? "selected" : "" }} value="wnba_ind">Indiana Fever</option>
						<option {{ ($_GET['query'] == 'wnba_lva') ? "selected" : "" }} value="wnba_lva">Las Vegas Aces</option>
						<option {{ ($_GET['query'] == 'wnba_las') ? "selected" : "" }} value="wnba_las">Los Angeles Sparks</option>						
						<option {{ ($_GET['query'] == 'wnba_min') ? "selected" : "" }} value="wnba_min">Minnesota Lynx</option>
						<option {{ ($_GET['query'] == 'wnba_nyl') ? "selected" : "" }} value="wnba_nyl">New York Liberty</option>
						<option {{ ($_GET['query'] == 'wnba_pho') ? "selected" : "" }} value="wnba_pho">Phoenix Mercury</option>
						<option {{ ($_GET['query'] == 'wnba_sea') ? "selected" : "" }} value="wnba_sea">Seattle Storm</option>
						<option {{ ($_GET['query'] == 'wnba_was') ? "selected" : "" }} value="wnba_was">Washington Mystics</option>
					</select>
				@elseif($_GET['location'] == 'program')
					<select name='query' class='form-control'>
						<option {{ ($_GET['query'] == '1') ? "selected" : "" }} value='1'>NBA Math Hoops</option>
						<option {{ ($_GET['query'] == '2') ? "selected" : "" }} value='2'>Broncos First & 10</option>
						<option {{ ($_GET['query'] == '3') ? "selected" : "" }} value='3'>Athletics Math Hits</option>
					</select>
				@else
					<input type="text" name="query" class="form-control" placeholder="Enter your search term and select where you want to search." value="{{ $_GET['query'] }}" />
				@endif
				</div>
				<br>
				<div class="row">
				<div class="col-sm-12 col-md-6">
				Search in:
				<select name="location" class="form-control" id="query-select">
					<option {{ ($_GET['location'] == 'name') ? 'selected' : ''  }} value="name">Name</option>
					<option {{ ($_GET['location'] == 'email') ? 'selected' : ''  }} value="email">Email</option>
					<option {{ ($_GET['location'] == 'phone') ? 'selected' : ''  }} value="phone">Phone</option>
					<option {{ ($_GET['location'] == 'school_program_name') ? 'selected' : ''  }} value="school_program_name">School Program Name</option>
					<option {{ ($_GET['location'] == 'site_address_1') ? 'selected' : ''  }} value="shipping_address_1">Address</option>
					<option {{ ($_GET['location'] == 'site_city') ? 'selected' : ''  }} value="shipping_city">City</option>
					<option {{ ($_GET['location'] == 'site_state') ? 'selected' : ''  }} value="shipping_state">State</option>
					<option {{ ($_GET['location'] == 'site_zip_code') ? 'selected' : ''  }} value="shipping_zip_code">Zipcode</option>
					<option {{ ($_GET['location'] == 'country') ? 'selected' : ''  }} value="country">Country</option>
					<option {{ ($_GET['location'] == 'account_level') ? 'selected' : ''  }} value="account_level">Tier</option>
					<option {{ ($_GET['location'] == 'pre_assessment_complete') ? 'selected' : ''  }} value="pre_assessment_complete">Pre-tests</option>
					<option {{ ($_GET['location'] == 'post_assessment_complete') ? 'selected' : ''  }} value="post_assessment_complete">Post-tests</option>
					<option {{ ($_GET['location'] == 'checkpoint') ? 'selected' : ''  }} value="checkpoint">Checkpoint</option>
					<option {{ ($_GET['location'] == 'rsvp') ? 'selected' : ''  }} value="rsvp">Tournament RSVP</option>
					<option {{ ($_GET['location'] == 'team') ? 'selected' : ''  }} value="team">Team</option>
					<option {{ ($_GET['location'] == 'program') ? 'selected' : ''  }} value="program">Program</option>
					<option {{ ($_GET['location'] == 'inactive') ? 'selected' : ''  }} value="inactive">Inactive Users</option>
				</select>
				</div>
				<div class="col-sm-12 col-md-6">
				<br>
				<button type="submit" class="btn btn-primary expanded loader">Search</button>
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
							@foreach ($users as $user)
							<tr>
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
						@if($users instanceof \Illuminate\Pagination\LengthAwarePaginator )
							{{$users->links()}}
					 	@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection